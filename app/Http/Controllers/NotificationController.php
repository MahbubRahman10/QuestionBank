<?php

namespace App\Http\Controllers;

use App\Activities;
use App\Notification;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Session;


class NotificationController extends BaseController
{   
    // save Notification
    public function savednotification($uid,$parent,$category,$id,$detail){
        $notification =  new Notification();

        $notification->user_id = Auth::User()->id;
        $notification->u_id = $uid;

        if (Auth::user()->id != $uid) {
            if ($category == "forum") {
                $notification->category_id = 'forum';
                $notification->category = $id;
                $notification->notification = $detail;
            }
            elseif ($category == 'reply') {
                $notification->parent_id = $parent;
                $notification->category_id = $id;
                $notification->category = 'reply';
                $notification->notification = $detail;
            }
            elseif ($category == 'like') {
                $notification->parent_id = $parent;
                $notification->category_id = $id;
                $notification->category = 'like';
                $notification->notification = $detail;
            }
            elseif ($category == 'unlike') {
                $notification->parent_id = $parent;
                $notification->category_id = $id;
                $notification->category = 'unlike';
                $notification->notification = $detail;
            }
            elseif ($category == 'bestreply') {
                $notification->parent_id = $parent;
                $notification->category = 'bestreply';
                $notification->category_id = $id;
                $notification->notification = $detail;
            }
            elseif ($category == 'admin') {
                $notification->category_id = 'admin';
                $notification->category = $id;
                $notification->notification = $detail;
            }
        
            $notification->save();
        }

    }


    // Delete Notification
    public function deletenotification($uid,$parent,$category,$id){
        if (Auth::user()->id != $uid) {
            $user_id = Auth::User()->id;
            $notification = Notification::where([['user_id','=',$user_id],['u_id','=',$uid],['parent_id','=',$parent],['category','=',$category],['category_id','=',$id]])->first();
            $notification->delete();
            return true;
        }

    }

    // View Notification
    public function viewnotification($id)
    {
        $notification = Notification::find($id);
        if ($notification->seen == 0) {
            $notification->seen = '1';
            $notification->save();
        }
        if ($notification->category == 'reply') {
            return Redirect('forum/view/'.$notification->parent_id.'#reply'.$notification->category_id);
        }
        elseif ($notification->category == 'like') {
            return Redirect('forum/view/'.$notification->parent_id.'#reply'.$notification->category_id);
        }
        elseif ($notification->category == 'bestreply') {
            return Redirect('forum/view/'.$notification->parent_id.'#reply'.$notification->category_id);
        }
    }  

     // View All Notification
    public function viewallnotification()
    {
        $id = Auth::user()->id;
        $notifications = Notification::where('u_id','=',$id)->Orderby('created_at','desc')->get();
        return view('users.notification',compact('notifications'));
    }   


}
