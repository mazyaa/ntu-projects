<?php

namespace App\Services;

use App\Enums\ArticleStatus;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class ArticleSchedulerService
{
    /**
     * Publish every scheduled article whose scheduled_at has passed.
     * Idempotent: only transitions status === scheduled -> published.
     *
     * @return int number of published articles
     */
    public function publishDue(): int
    {
        $due = Article::query()
            ->where('status', ArticleStatus::Scheduled->value)
            ->whereNotNull('scheduled_at')
            ->where('scheduled_at', '<=', now())
            ->get();

        $count = 0;

        foreach ($due as $article) {
            DB::transaction(function () use ($article): void {
                $article->update([
                    'status' => ArticleStatus::Published,
                    'published_at' => $article->scheduled_at,
                    'archived_at' => null,
                ]);
            });

            $count++;
        }

        return $count;
    }
}
