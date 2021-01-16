<?php

namespace App\Providers;

use Spatie\Ray\Ray;
use App\Models\Incident;
use App\Observers\IncidentObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Incident::observe(IncidentObserver::class);
    }
}
