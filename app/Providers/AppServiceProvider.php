<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function map()
    {
    $this->mapApiRoutes();

    // Jika pakai web juga:
    $this->mapWebRoutes();
    }

    protected function mapApiRoutes()
    {
    Route::middleware('api')
        ->prefix('api') // Ini penting untuk prefix endpoint /api
        ->group(base_path('routes/api.php'));
    }

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
