<?php

namespace App\Console\Commands;

use App\Services\ArticleSchedulerService;
use Illuminate\Console\Command;

class PublishScheduledArticles extends Command
{
    protected $signature = 'articles:publish-scheduled';

    protected $description = 'Publish all scheduled articles whose scheduled_at time has passed';

    public function handle(ArticleSchedulerService $scheduler): int
    {
        $published = $scheduler->publishDue();

        $this->info("Published {$published} scheduled article(s).");

        return self::SUCCESS;
    }
}
