<?php

namespace App\Http\ViewComposers;

use App\Repositories\UserRepository;
use DB;
use Illuminate\View\View;
use Sarfraznawaz2005\VisitLog\Facades\VisitLog;

class VisitlogComposer
{
    public function compose(view $view)
    {
    	VisitLog::save();
    }
}