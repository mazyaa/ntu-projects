<?php

namespace App\Services;

use App\Models\Article;
use App\Models\ArticleView;
use App\Models\Setting;
use Illuminate\Support\Facades\Request;

class ArticleViewService
{
    /**
     * Track a view of an article for the current visitor. Deduplicates the
     * same visitor (ip + user agent hash) within a configurable window.
     *
     * @return bool true when a new view was recorded
     */
    public function track(Article $article): bool
    {
        $ip = Request::ip() ?? 'unknown';
        $visitorHash = $this->visitorHash($ip);

        $windowHours = $this->windowHours();

        $existing = ArticleView::query()
            ->where('article_id', $article->getKey())
            ->where('visitor_hash', $visitorHash)
            ->where('viewed_at', '>=', now()->subHours($windowHours))
            ->exists();

        if ($existing) {
            return false;
        }

        ArticleView::create([
            'article_id' => $article->getKey(),
            'visitor_hash' => $visitorHash,
            'ip_address' => $ip,
            'viewed_at' => now(),
        ]);

        $article->increment('views_count');

        return true;
    }

    /**
     * Deterministic hash of the visitor identity so raw IPs are never stored as
     * searchable keys. sha256 keeps the same visitor stable across requests.
     */
    private function visitorHash(string $ip): string
    {
        return substr(hash('sha256', $ip.'|'.(Request::userAgent() ?? '')), 0, 64);
    }

    /**
     * Unique-visit dedup window from settings (default 24 hours).
     */
    private function windowHours(): int
    {
        $setting = Setting::query()
            ->where('group', 'analytics')
            ->where('key', 'unique_visit_window_hours')
            ->first();

        $hours = $setting ? (int) $setting->decodedValue() : 24;

        return max(1, $hours);
    }
}
