<?php

namespace App\Http\Controllers;

use App\Activities;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Session;


class ActivityController extends BaseController
{   
    // save Activity
    public function savedactivity($activityname,$activitydetail,$id){
        $activities =  new Activities();

        $activities->user_id = Auth::User()->id;

        if ($activityname == "user") {
            $activities->user_id = $id;
            $activities->activity = $activitydetail;
        }
        elseif ($activityname == 'forum') {
            $activities->activity = $activitydetail;
            $activities->forum_id = $id;
        }
        elseif ($activityname == 'forumreply') {
            $activities->activity = $activitydetail;
            $activities->reply_id = $id;
        }
        elseif ($activityname == 'question') {
            $activities->activity = $activitydetail;
            $activities->question_id = $id;
        }
        elseif ($activityname == 'savedcreativequestion') {
            $activities->activity = $activitydetail;
            $activities->question_id = $id;
            $activities->question_type = 'creative';
        }
        elseif ($activityname == 'savedmcqquestion') {
            $activities->activity = $activitydetail;
            $activities->question_id = $id;
            $activities->question_type = 'mcq';
        }
        elseif ($activityname == 'exam') {
            $activities->activity = $activitydetail;
            $activities->exam_id = $id;
        }

        $activities->save();

    }

    // Delete Activity
    public function deleteactivity($activityname ,$activitydetail , $id){
       
        $user_id = Auth::User()->id;

        if ($activityname == "user") {
        
        }
        elseif ($activityname == 'forum') {
            DB::table('activities')
            ->where([
                ['activity', '=', $activitydetail],
                ['forum_id', '=', $id],
                ['user_id', '=', $user_id]
            ])
            ->delete();
        }
        elseif ($activityname == 'forumreply') {
            DB::table('activities')
            ->where([
                ['activity', '=', $activitydetail],
                ['reply_id', '=', $id],
                ['user_id', '=', $user_id]
            ])
            ->delete();
        }
        elseif ($activityname == 'question') {
            
        }
        elseif ($activityname == 'exam') {
            
        }


    }

}
