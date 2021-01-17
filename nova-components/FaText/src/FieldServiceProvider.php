<?php

namespace Brunocfalcao\FaText;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('fa-text', __DIR__.'/../dist/js/field.js');
            Nova::script('fa-assets', 'https://kit.fontawesome.com/3eba543b35.js');
            Nova::style('fa-text', __DIR__.'/../dist/css/field.css');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
