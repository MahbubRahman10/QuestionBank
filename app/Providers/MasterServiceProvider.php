<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use view;
class MasterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
            view()->composer('layouts.master','App\Http\ViewComposers\MasterComposer');
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
