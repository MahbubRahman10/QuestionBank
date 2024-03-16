<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use DB;
use App\Http\Controllers\controllertechforum;

use Request;
use App\Blog;


class BlogpostComposer
{

    public function __construct()
    {

    }
    public function compose(view $view) {
			$blogpost=Blog::Orderby('created_at','=','asc')->limit(4)->get();
			$view->with('blogpost',$blogpost);
    }
}