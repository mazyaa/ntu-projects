<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'categories' => config('company-services.categories'),
            'company' => config('company'),
        ]);
    }

    public function serviceShow(string $slug)
    {
        $category = collect(config('company-services.categories'))
            ->firstWhere('slug', $slug);

        abort_unless($category, 404);

        return view('pages.services.show', [
            'category' => $category,
            'categories' => config('company-services.categories'),
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

    public function articles()
    {
        return view('pages.articles.index', [
            'articles' => config('company-insights.articles'),
            'company' => config('company'),
        ]);
    }

    public function articleShow(string $slug)
    {
        $article = collect(config('company-insights.articles'))
            ->firstWhere('slug', $slug);

        abort_unless($article, 404);

        $related = collect(config('company-insights.articles'))
            ->where('slug', '!=', $slug)
            ->take(3)
            ->values();

        return view('pages.articles.show', [
            'article' => $article,
            'related' => $related,
            'company' => config('company'),
        ]);
    }
}
