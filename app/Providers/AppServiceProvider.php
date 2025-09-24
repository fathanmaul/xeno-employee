<?php

namespace App\Providers;

use App\Models\EmpPresence;
use App\Observers\EmpPresenceObserver;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrapFive();
        EmpPresence::observe(EmpPresenceObserver::class);

    }
}
