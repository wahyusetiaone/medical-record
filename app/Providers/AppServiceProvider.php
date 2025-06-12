<?php

namespace App\Providers;

use App\Pagination\CustomPaginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Helpers\RefactorPaginate;
use App\Models\PatientVisit;
use App\Observers\PatientVisitObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->alias(CustomPaginator::class, LengthAwarePaginator::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        PatientVisit::observe(PatientVisitObserver::class);
    }
}
