<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use view;
class ForumSiteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
            
            view()->composer('forum/side','App\Http\ViewComposers\ForumSiteComposer');
   
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
