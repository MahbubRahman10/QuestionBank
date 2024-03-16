<?php

namespace App\Http\ViewComposers;

use App\Blog;
use App\Category;
use App\Forum;
use App\Repositories\UserRepository;
use DB;
use Illuminate\View\View;

class ForumSiteComposer
{
    public function compose(view $view)
    {
		  $selectpost=Forum::where('visitor', '>=','1')->paginate(4);
		  $blogpost=Blog::Orderby('created_at','=','asc')->limit(4)->get();;
		  $categories = Category::all();
          $view->with('selectpost',$selectpost)->with('blogpost',$blogpost)->with('categories',$categories);
    }
}