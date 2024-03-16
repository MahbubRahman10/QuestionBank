<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use view;
class VisitlogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
            
            view()->composer('sections/nav','App\Http\ViewComposers\VisitlogComposer');
   
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}
