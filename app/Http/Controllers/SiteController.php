<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Equipment;
use App\Models\RiksaUjiCategory;
use App\Models\Service;
use App\Models\TeamMember;
use App\Services\ArticleSchedulerService;
use App\Services\ArticleViewService;

class SiteController extends Controller
{
    public function about()
    {
        $seo = [
            'title' => __('ui.page_titles.about'),
            'description' => __('ui.meta.about_description'),
        ];

        return view('pages.about', [
            'company' => company(),
            'seo' => $seo,
        ]);
    }

    public function leadership()
    {
        $people = TeamMember::active()->ordered()->get();

        $seo = [
            'title' => __('ui.page_titles.leadership'),
            'description' => __('ui.meta.leadership_description'),
        ];

        return view('pages.leadership.index', [
            'people' => $people,
            'company' => company(),
            'seo' => $seo,
        ]);
    }

    public function leadershipShow(string $slug)
    {
        $person = TeamMember::active()
            ->with('skills')
            ->where('slug', $slug)
            ->firstOrFail();

        $seo = [
            'title' => $person->name.' — '.$person->position,
            'description' => $person->short_bio ?? $person->name.' — '.$person->position.' at '.company('name'),
            'image' => $person->image ? asset($person->image) : null,
            'type' => 'profile',
        ];

        return view('pages.leadership.show', [
            'person' => $person,
            'company' => company(),
            'seo' => $seo,
        ]);
    }

    public function services()
    {
        $allServices = Service::active()->ordered()->get();
        $riksaUji = $allServices->where('category', 'riksa_uji');
        $konsultasi = $allServices->where('category', 'konsultasi');
        $perizinan = $allServices->where('category', 'perizinan');

        $seo = [
            'title' => __('ui.page_titles.services'),
            'description' => __('ui.meta.services_description'),
        ];

        return view('pages.services.index', compact('riksaUji', 'konsultasi', 'perizinan', 'seo'));
    }

    public function serviceShow(string $slug)
    {
        $service = Service::active()
            ->where(fn ($query) => $query->where('slug', $slug)->orWhere('slug_en', $slug))
            ->firstOrFail();

        $seo = [
            'title' => $service->name,
            'description' => $service->short_description ?? $service->description,
            'type' => 'article',
        ];

        return view('pages.services.show', [
            'service' => $service,
            'services' => Service::active()->orderBy('sort_order')->get(),
            'company' => company(),
            'seo' => $seo,
        ]);
    }

    public function riksaUji()
    {
        $seo = [
            'title' => __('ui.page_titles.riksa_uji'),
            'description' => __('ui.meta.riksa_uji_description'),
        ];

        return view('pages.riksa-uji.index', [
            'categories' => RiksaUjiCategory::active()->with('types')->ordered()->get(),
            'equipment' => Equipment::active()->ordered()->get(),
            'company' => company(),
            'seo' => $seo,
        ]);
    }

    public function equipment()
    {
        $seo = [
            'title' => __('ui.page_titles.equipment'),
            'description' => __('ui.meta.equipment_description'),
        ];

        return view('pages.equipment.index', [
            'company' => company(),
            'seo' => $seo,
        ]);
    }

    public function articles(ArticleSchedulerService $scheduler)
    {
        $scheduler->publishDue();

        $seo = [
            'title' => __('ui.page_titles.articles'),
            'description' => __('ui.meta.articles_description'),
        ];

        return view('pages.articles.index', [
            'articles' => Article::published()
                ->with('category')
                ->latest('published_at')
                ->paginate(9),
            'company' => company(),
            'seo' => $seo,
        ]);
    }

    public function articleShow(string $slug, ArticleViewService $views)
    {
        app(ArticleSchedulerService::class)->publishDue();

        $article = Article::published()
            ->with('author')
            ->where(fn ($query) => $query->where('slug', $slug)->orWhere('slug_en', $slug))
            ->firstOrFail();

        $views->track($article);

        $related = Article::published()
            ->with('category')
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(5)
            ->get();

        $authorArticleCount = $article->author
            ? Article::published()->where('author_id', $article->author_id)->count()
            : 0;

        $seo = [
            'title' => $article->title,
            'description' => $article->excerpt ?? strip_tags(Str::limit($article->content, 160)),
            'image' => $article->thumbnail ? asset('storage/'.$article->thumbnail) : null,
            'type' => 'article',
            'author' => $article->author?->name,
            'published_time' => $article->published_at?->toIso8601String(),
            'modified_time' => $article->updated_at?->toIso8601String(),
        ];

        return view('pages.articles.show', [
            'article' => $article,
            'related' => $related,
            'authorArticleCount' => $authorArticleCount,
            'company' => company(),
            'seo' => $seo,
        ]);
    }
}
