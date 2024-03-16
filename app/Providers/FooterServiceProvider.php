<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use view;
class FooterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
            
            view()->composer('sections/footer','App\Http\ViewComposers\FooterComposer');
   
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
