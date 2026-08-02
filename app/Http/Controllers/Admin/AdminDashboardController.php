<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleView;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'articles' => Article::count(),
            'published_articles' => Article::published()->count(),
            'total_views' => ArticleView::count(),
            'unique_visitors' => ArticleView::query()->distinct('visitor_hash')->count('visitor_hash'),
        ];

        $viewsByCategory = $this->viewsByCategory();

        [$labels, $series] = $this->dailyViews();

        $topArticles = Article::query()
            ->select('id', 'title', 'views_count')
            ->orderByDesc('views_count')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'viewsByCategory', 'labels', 'series', 'topArticles'));
    }

    /**
     * Daily article views for the last 30 days.
     *
     * @return array{0: Collection<int, string>, 1: Collection<int, int>}
     */
    private function dailyViews(): array
    {
        $start = now()->subDays(29)->startOfDay();

        $daily = ArticleView::query()
            ->where('viewed_at', '>=', $start)
            ->get()
            ->groupBy(fn (ArticleView $view) => $view->viewed_at->toDateString())
            ->map->count();

        $labels = collect();
        $series = collect();

        for ($i = 29; $i >= 0; $i--) {
            $day = now()->subDays($i)->toDateString();
            $labels->push(Carbon::parse($day)->format('d M'));
            $series->push($daily->get($day, 0));
        }

        return [$labels, $series];
    }

    /**
     * Total article views grouped by category.
     *
     * @return Collection<int, array{name: string, total: int}>
     */
    private function viewsByCategory()
    {
        return ArticleView::query()
            ->join('articles', 'articles.id', '=', 'article_views.article_id')
            ->leftJoin('categories', 'categories.id', '=', 'articles.category_id')
            ->selectRaw('COALESCE(categories.name, "Tanpa Kategori") as name')
            ->selectRaw('COUNT(*) as total')
            ->groupByRaw('COALESCE(categories.name, "Tanpa Kategori")')
            ->orderByDesc('total')
            ->get()
            ->map(fn ($row) => [
                'name' => $row->name,
                'total' => (int) $row->total,
            ])
            ->values();
    }
}
