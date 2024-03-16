<?php

namespace App\Http\ViewComposers;


use App\Notification;
use App\Repositories\UserRepository;
use App\SiteOption;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class MasterComposer
{
    public function compose(view $view)
    {
     $lang =  LaravelLocalization::getCurrentLocale();
     $view->with('lang',$lang);
    }
}