<?php

namespace App\Providers;

use App\Models\couple;
use App\Models\User;
use App\Observers\CoupleObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        couple::observe(CoupleObserver::class);
    }
}
