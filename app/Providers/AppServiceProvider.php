<?php

namespace App\Providers;

use App\Enums\ActivityAction;
use App\Services\ActivityLogService;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();

        Event::listen(function (Login $event) {
            if ($event->user) {
                app(ActivityLogService::class)->log(
                    ActivityAction::Login,
                    'Pengguna masuk ke sistem.',
                    userId: $event->user->getKey(),
                );
            }
        });

        Event::listen(function (Logout $event) {
            if ($event->user) {
                app(ActivityLogService::class)->log(
                    ActivityAction::Logout,
                    'Pengguna keluar dari sistem.',
                    userId: $event->user->getKey(),
                );
            }
        });
    }
}
