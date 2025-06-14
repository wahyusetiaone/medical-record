<?php

namespace App\Providers;

use App\Pagination\CustomPaginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Helpers\RefactorPaginate;
use App\Models\PatientVisit;
use App\Observers\PatientVisitObserver;
use Illuminate\Support\Facades\Auth;
use App\Auth\Guards\JwtGuard; // Import custom guard Anda
use App\Providers\JwtUserProvider; // Import custom user provider Anda

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
        // Daftarkan Custom Guard
        Auth::extend('jwt', function ($app, $name, array $config) {
            $provider = Auth::createUserProvider($config['provider']);
            return new JwtGuard($provider, $app['request']);
        });

        // Daftarkan Custom User Provider (driver)
        Auth::provider('jwt_provider', function ($app, array $config) {
            return new JwtUserProvider();
        });
        PatientVisit::observe(PatientVisitObserver::class);
    }
}
