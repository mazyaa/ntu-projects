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
            'company' => company(),
        ]);
    }

    public function leadership()
    {
        return view('pages.leadership.index', [
            'people' => company('people', 'company-leadership'),
        ]);
    }

    public function leadershipShow(string $slug)
    {
        $person = collect(company('people', 'company-leadership'))
            ->firstWhere('slug', $slug);

        abort_unless($person, 404);

        return view('pages.leadership.show', [
            'person' => $person,
            'company' => company(),
        ]);
    }

    public function services()
    {
        return view('pages.services.index', [
            'services' => Service::active()->orderBy('sort_order')->get(),
            'company' => company(),
        ]);
    }

    public function serviceShow(string $slug)
    {
        $service = Service::active()
            ->where(fn ($query) => $query->where('slug', $slug)->orWhere('slug_en', $slug))
            ->firstOrFail();

        return view('pages.services.show', [
            'service' => $service,
            'services' => Service::active()->orderBy('sort_order')->get(),
            'company' => company(),
        ]);
    }

    public function research()
    {
        return view('pages.research.index', [
            'personnel' => company('personnel', 'company-research'),
            'company' => company(),
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
            'company' => company(),
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

        return view('pages.articles.show', [
            'article' => $article,
            'related' => $related,
            'authorArticleCount' => $authorArticleCount,
            'company' => company(),
        ]);
    }
}
