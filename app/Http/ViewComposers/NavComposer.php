<?php

namespace App\Http\ViewComposers;


use App\Notification;
use App\Repositories\UserRepository;
use App\SiteOption;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NavComposer
{
    public function compose(view $view)
    {

        $siteoption = SiteOption::find(1);
	   
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            $user->created_at = Carbon::now()->format('Y-m-d h:i:s');
            $user->save();
        }

    	if (Auth::user()) {
    		$id = Auth::user()->id;
    		$notifications = Notification::where('u_id','=',$id)->limit(10)->Orderby('created_at','desc')->get();
    		$unseennotification = Notification::where([['u_id','=',$id],['seen','=','0']])->count();
    		$view->with('notifications',$notifications)->with('unseennotification',$unseennotification)->with('siteoption',$siteoption);
    	}
        else{
            $view->with('siteoption',$siteoption);
        }
    }
}