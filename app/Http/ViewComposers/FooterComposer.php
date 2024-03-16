<?php

namespace App\Http\ViewComposers;


use App\Notification;
use App\Repositories\UserRepository;
use App\SiteOption;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FooterComposer
{
    public function compose(view $view)
    {
		$siteoption = SiteOption::find(1);
        $view->with('siteoption',$siteoption);
    }
}