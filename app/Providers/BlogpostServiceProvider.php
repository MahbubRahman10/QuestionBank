<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use view;
class BlogpostServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
            
            view()->composer('blog/side','App\Http\ViewComposers\BlogpostComposer');
   
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
