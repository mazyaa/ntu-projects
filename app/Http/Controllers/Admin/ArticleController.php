<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ArticleStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Media;
use App\Models\Tag;
use App\Services\UploadSecurityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __construct(
        private readonly UploadSecurityService $uploadSecurity,
    ) {}

    public function index(Request $request): View
    {
        $query = Article::with('author', 'category')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        // Editors only see their own articles unless granted otherwise.
        if (! auth()->user()->hasAnyPermission(['articles.view_all'])) {
            $query->where('author_id', auth()->id());
        }

        $articles = $query->paginate(15)->withQueryString();

        return view('admin.articles.index', compact('articles'));
    }

    public function create(): View
    {
        $this->authorize('articles.create');

        return view('admin.articles.create', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(ArticleRequest $request): RedirectResponse
    {
        $this->authorize('articles.create');

        $article = DB::transaction(function () use ($request) {
            $article = Article::create([
                'author_id' => auth()->id(),
                'title' => $request->input('title'),
                'slug' => $request->input('slug', Str::slug($request->input('title'))),
                'excerpt' => $request->input('excerpt'),
                'content' => $request->input('content'),
                'thumbnail' => $request->input('thumbnail'),
                'cover' => $request->input('cover'),
                'category_id' => $request->input('category_id'),
                'status' => $this->resolveStatus($request),
                'is_featured' => $request->boolean('is_featured'),
                'reading_time' => $this->calculateReadingTime($request->input('content')),
            ]);

            $this->applyScheduling($article, $request);

            $this->syncTags($article, $request->input('tags', []));

            return $article;
        });

        return redirect(panel_route('articles.index'))->with('success', 'Artikel berhasil dibuat.');
    }

    public function edit(Article $article): View
    {
        $this->authorize('articles.edit', $article);

        return view('admin.articles.edit', [
            'article' => $article->load('tags'),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        $this->authorize('articles.edit', $article);

        DB::transaction(function () use ($request, $article) {
            $article->update([
                'title' => $request->input('title'),
                'slug' => $request->input('slug'),
                'excerpt' => $request->input('excerpt'),
                'content' => $request->input('content'),
                'thumbnail' => $request->input('thumbnail'),
                'cover' => $request->input('cover'),
                'category_id' => $request->input('category_id'),
                'is_featured' => $request->boolean('is_featured'),
                'reading_time' => $this->calculateReadingTime($request->input('content')),
            ]);

            $this->applyScheduling($article, $request);

            $this->syncTags($article, $request->input('tags', []));
        });

        return redirect(panel_route('articles.index'))->with('success', 'Artikel berhasil diperbarui.');
    }

    public function publish(Article $article): RedirectResponse
    {
        $this->authorize('articles.publish');

        abort_unless(in_array($article->status, [ArticleStatus::Draft, ArticleStatus::Scheduled]), 422, 'Hanya artikel berstatus Draft/Scheduled yang dapat dipublikasikan.');

        $article->update([
            'status' => ArticleStatus::Published,
            'published_at' => $article->published_at ?? now(),
        ]);

        return back()->with('success', 'Artikel berhasil dipublikasikan.');
    }

    public function archive(Article $article): RedirectResponse
    {
        $this->authorize('articles.archive');

        abort_unless($article->status === ArticleStatus::Published, 422, 'Hanya artikel berstatus Published yang dapat diarsipkan.');

        $article->update([
            'status' => ArticleStatus::Archived,
            'archived_at' => now(),
        ]);

        return back()->with('success', 'Artikel berhasil diarsipkan.');
    }

    public function restore(Article $article): RedirectResponse
    {
        $article->update([
            'status' => ArticleStatus::Draft,
            'archived_at' => null,
        ]);

        return back()->with('success', 'Artikel dipulihkan ke status Draft.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $this->authorize('articles.delete', $article);

        $article->delete();

        return redirect(panel_route('articles.index'))->with('success', 'Artikel berhasil dihapus.');
    }

    private function syncTags(Article $article, array $tagNames): void
    {
        $ids = collect($tagNames)
            ->flatMap(fn ($value) => is_string($value) ? explode(',', $value) : [$value])
            ->map(fn ($name) => trim((string) $name))
            ->filter(fn ($name) => ! empty($name))
            ->unique()
            ->map(function (string $name) {
                return Tag::firstOrCreate(
                    ['name' => $name],
                    ['slug' => Str::slug($name)],
                )->getKey();
            });

        $article->tags()->sync($ids);
    }

    /**
     * Resolve the article status based on a scheduled_at date.
     * A future scheduled_at sets status to Scheduled; a past/now one publishes
     * immediately (no extra review step for scheduled articles).
     */
    private function resolveStatus(Request $request): string
    {
        $scheduledAt = $request->filled('scheduled_at') ? $request->date('scheduled_at') : null;

        if ($scheduledAt && $scheduledAt->isFuture()) {
            return ArticleStatus::Scheduled->value;
        }

        if ($scheduledAt) {
            return ArticleStatus::Published->value;
        }

        return $request->input('status', ArticleStatus::Draft->value);
    }

    /**
     * Persist scheduling fields and reconcile published/archived timestamps.
     * A directly-published article (no scheduled_at) gets published_at = now().
     */
    private function applyScheduling(Article $article, Request $request): void
    {
        $scheduledAt = $request->filled('scheduled_at') ? $request->date('scheduled_at') : null;

        $article->update(['scheduled_at' => $scheduledAt]);

        if ($scheduledAt && $scheduledAt->isPast() && $article->status === ArticleStatus::Published) {
            $article->update([
                'published_at' => $scheduledAt,
                'archived_at' => null,
            ]);
        }

        if (! $scheduledAt && $article->status === ArticleStatus::Published && $article->published_at === null) {
            $article->update([
                'published_at' => now(),
                'archived_at' => null,
            ]);
        }
    }

    /**
     * Inline image upload for the rich-text editor. Returns a JSON URL that the
     * editor embeds into the content. Records the media row for housekeeping.
     */
    public function uploadImage(Request $request): JsonResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'max:8192'],
        ]);

        $file = $request->file('image');

        if (! $this->uploadSecurity->validate($file, ['image/jpeg', 'image/png', 'image/webp', 'image/gif'])) {
            return response()->json(['error' => 'Tipe gambar tidak diizinkan.'], 422);
        }

        $path = $file->store('articles', 'public');

        $media = Media::create([
            'uploaded_by' => auth()->id(),
            'name' => $this->uploadSecurity->secureFilename($file),
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'type' => $this->uploadSecurity->categorize($file->getMimeType()),
            'disk' => 'public',
        ]);

        return response()->json(['url' => $media->url()]);
    }

    /**
     * Thumbnail upload for the article form. Returns the public URL.
     */
    public function uploadThumbnail(Request $request): JsonResponse
    {
        $request->validate([
            'thumbnail' => ['required', 'image', 'max:8192'],
        ]);

        $file = $request->file('thumbnail');

        if (! $this->uploadSecurity->validate($file, ['image/jpeg', 'image/png', 'image/webp', 'image/gif'])) {
            return response()->json(['error' => 'Tipe gambar tidak diizinkan.'], 422);
        }

        $path = $file->store('articles', 'public');

        $media = Media::create([
            'uploaded_by' => auth()->id(),
            'name' => $this->uploadSecurity->secureFilename($file),
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'type' => $this->uploadSecurity->categorize($file->getMimeType()),
            'disk' => 'public',
        ]);

        return response()->json(['url' => $media->url()]);
    }

    private function calculateReadingTime(?string $content): int
    {
        $words = str_word_count(strip_tags((string) $content));

        return max(1, (int) ceil($words / 200));
    }
}
