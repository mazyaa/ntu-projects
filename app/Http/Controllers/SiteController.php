<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Service;
use App\Services\ArticleSchedulerService;
use App\Services\ArticleViewService;

class SiteController extends Controller
{
    public function about()
    {
        return view('pages.about', [
            'company' => config('company'),
        ]);
    }

    public function leadership()
    {
        return view('pages.leadership.index', [
            'people' => config('company-leadership.people'),
        ]);
    }

    public function leadershipShow(string $slug)
    {
        $person = collect(config('company-leadership.people'))
            ->firstWhere('slug', $slug);

        abort_unless($person, 404);

        return view('pages.leadership.show', [
            'person' => $person,
            'company' => config('company'),
        ]);
    }

    public function services()
    {
        return view('pages.services.index', [
            'services' => Service::active()->orderBy('sort_order')->get(),
            'company' => config('company'),
        ]);
    }

    public function serviceShow(string $slug)
    {
        $service = Service::active()->where('slug', $slug)->firstOrFail();

        return view('pages.services.show', [
            'service' => $service,
            'services' => Service::active()->orderBy('sort_order')->get(),
            'company' => config('company'),
        ]);
    }

    public function research()
    {
        return view('pages.research.index', [
            'personnel' => config('company-research.personnel'),
            'company' => config('company'),
        ]);
    }

    public function articles(ArticleSchedulerService $scheduler)
    {
        // Lazy-publish due scheduled articles even when the scheduler is idle.
        $scheduler->publishDue();

        return view('pages.articles.index', [
            'articles' => Article::published()
                ->with('category')
                ->latest('published_at')
                ->paginate(9),
            'company' => config('company'),
        ]);
    }

    public function articleShow(string $slug, ArticleViewService $views)
    {
        app(ArticleSchedulerService::class)->publishDue();

        $article = Article::published()
            ->with('author')
            ->where('slug', $slug)
            ->firstOrFail();

        $views->track($article);

        $related = Article::published()
            ->with('category')
            ->where('slug', '!=', $slug)
            ->latest('published_at')
            ->take(5)
            ->get();

        $authorArticleCount = $article->author
            ? Article::published()->where('author_id', $article->author_id)->count()
            : 0;

        return view('pages.articles.show', [
            'article' => $article,
            'related' => $related,
            'authorArticleCount' => $authorArticleCount,
            'company' => config('company'),
        ]);
    }
}
