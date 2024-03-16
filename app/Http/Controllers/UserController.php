<?php

namespace App\Http\Controllers;

use App\Activities;
use App\ClassSubject;
use App\CreativeQuestion;
use App\Forum;
use App\Http\Controllers\ActivityController;
use App\McqQuestion;
use App\NormalExamQuestion;
use App\Reply;
use App\Result;
use App\SavedQuestion;
use App\User;
use App\Classes;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $activity;

    public function __construct(ActivityController $activity)
    {
      $this->activity = $activity;
    }

    public function index()
    {
      $id = Auth::id();
      $user = User::find($id);
      return view('users.dashboard',compact('user'));
    }
    public function profile()
    {
      $id = Auth::id();
      $user = User::find($id);
      return view('users.profile',compact('user'));
    }
    public function activities()
    {
      $id = Auth::id();
      $activities = Activities::where('user_id','=',$id)->OrderBy('created_at', 'DESC')->get()->groupBy(function($item){ return $item->created_at->format('d F Y'); });
      $user = User::find($id);

      return view('users.activities',compact(['user','activities']));
    }
    public function exam()
    {
      $id = Auth::id();
      $user = User::find($id);

      // Get Result from Results table
      $result = Result::where('user_id','=',$id)->get();
      
      // Get exam question by token from normal_exam_question_user table
      $examuser = [];
      foreach ($result as $key => $value) {
        $data = DB::table('normal_exam_question_user')
                ->where('exam_token','=',$value->etoken)->first();  
        $examuser[] = $data;
      }
      // Get exam details normal_exam_questions table
      $exam = [];
      foreach ($examuser as $key => $value) {
        $data = DB::table('normal_exam_questions')
                ->where('id','=',$value->normal_exam_question_id)->first();  
        $exam[] = $data;
      }
      // Get exam details with exam name and subject from normal_exam_question_user table
      $data = [];
      foreach ($exam as $key => $value) {
        $data[] = DB::table('subjects')
        ->join('classsubject', 'classsubject.subject_id', '=', 'subjects.id')
        ->join('classes', 'classes.id', '=', 'classsubject.class_id')
        ->where('classsubject.id', '=' , $value->classsubject_id)
        ->get()->toArray(); 
      }
      // Object to Array of result data 
      $examtoken = $result->toArray();
      // Convert multidimensional array into single array
      $data = array_column($data, '0');

      return view('users.exam',compact(['user','data','examtoken']));
    }
    // Result Sheet
    public function resultsheet($token)
    {    
      
        $result = [];
        $total = 0;
        $correct = 0;
        $worng = 0;

        $user = User::find(Auth::id());
        foreach ($user->normalexams as $exam) {
            if ($exam->pivot->exam_token == $token) {
                $total++;
                if($exam->pivot->result == 'Correct'){
                    $correct++;
                }
                else if($exam->pivot->result == null){
                    $question = NormalExamQuestion::find($exam->pivot->normal_exam_question_id);
                    $user->normalexams()->updateExistingPivot($question->id,['result'=>'Worng']);
                    $worng++;
                }
                else{
                    $worng++;
                }
            }
        }
        
        $i = 0;
        $user = User::find(Auth::id());

        foreach ($user->normalexams as $exam) {
            if ($exam->pivot->exam_token == $token) {
                $result[$i]['qid']  = $exam->id;
                $result[$i]['answer']  = $exam->pivot->answer; 
                $result[$i]['result']  = $exam->pivot->result; 
                $i++; 
            }
        }

        foreach ($user->normalexams as $exam) {
            if ($exam->pivot->exam_token == $token) {       
                $question [] =  $exam;
            }
        }

        $fresult = DB::table('normal_exam_question_user')->where('exam_token','=',$token)->first();
        $fexam = NormalExamQuestion::find($fresult->normal_exam_question_id); 
        $fclasub = ClassSubject::find($fexam->classsubject_id); 
        $fclass = Classes::find($fclasub->class_id); 
        
        if ($fclass->class == "৬ষ্ঠ") {
            $class = "৬ষ্ঠ শ্রেণি";
        }
        elseif ($fclass->class == "৭ম") {
          $class = "৭ম শ্রেণি";
        }
        elseif ($fclass->class == "৮ম") {
          $class = "৮ম শ্রেণি";
        }
        elseif ($fclass->class == "৯-১০ম") {
          $class = "৯-১০ম শ্রেণি";
        }
        elseif ($fclass->class == "১১-১২তম") {
          $class = "১১-১২তম শ্রেণি";
        }
        elseif ($fclass->class == "BCS") {
          $class = "বাংলাদেশ সিভিল সার্ভিস (বিসিএস) প্রস্তুতি";
        }
        elseif ($fclass->class == "NTRCA") {
          $class = "বেসরকারি শিক্ষক নিবন্ধন পরীক্ষা (এনটিআরসিএ) প্রস্তুতি";
        }
        elseif ($fclass->class == "DPE") {
          $class = "প্রাথমিক শিক্ষক নিয়োগ (ডিপিই) প্রস্তুতি";
        }
        elseif ($fclass->class == "BANK") {
          $class = "ব্যাংক নিয়োগ প্রস্তুতি";
        }
        elseif ($fclass->class == "Normal") {
          $class = "সাধারণ বিশ্ববিদ্যালয় ভর্তি প্রস্তুতি";
        }
        elseif ($fclass->class == "Engineering") {
          $class = "ইঞ্জিনিয়ারিং বিশ্ববিদ্যালয় ভর্তি প্রস্তুতি";
        }
        elseif ($fclass->class == "Technology") {
          $class = "প্রযুক্তি বিশ্ববিদ্যালয় ভর্তি প্রস্তুতি";
        }
        elseif ($fclass->class == "Agriculture") {
          $class = "কৃষি বিশ্ববিদ্যালয় ভর্তি প্রস্তুতি";
        }


        return view('users.resultsheet',compact(['question','result','correct','worng','class']));

    }
    public function saved()
    {
      $id = Auth::id();
      $user = User::find($id);

      $data = SavedQuestion::where('user_id','=',$id)->get();
      $saved = array();
      foreach ($data as $key => $value) {
        if ($value->type == 'creative') {
          $question = CreativeQuestion::find($value->question_id);
          $saved[] = $question;
        }
        elseif ($value->type == 'mcq') {
          $question = NormalExamQuestion::find($value->question_id);
          $saved[] = $question;
        }
      }



      return view('users.saved',compact(['user','saved']));
    }
    public function viewsaved($type,$qid)
    {
      $id = Auth::id();
      $user = User::find($id);


      if ($type == 'creative') {
        $question = CreativeQuestion::find($qid);
      }
      elseif ($type == 'mcq') {
        $question = NormalExamQuestion::find($qid);
      }

     

      if($question == null){
         return view('errors/404');
      }

      return view('users.viewsaved',compact(['user','question','type']));
    }

    public function deletesaved($type,$qid)
    {
      $id = Auth::id();
      $user = User::find($id);

      if ($type == 'creative') {
        $question = SavedQuestion::where([['question_id','=',$qid],['user_id','=',$id]])->first();
        $question->delete();
      }
      elseif ($type == 'mcq') {
        $question = SavedQuestion::where([['question_id','=',$qid],['user_id','=',$id]])->first();
        $question->delete();
      }
      return back()->with('msg', 'Question Remove Successfully!');
    }

    public function forum()
    {
      $id = Auth::id();
      $user = User::find($id);
      $forum = Forum::where('user_id','=',$id)->orderBy('created_at', 'desc')->get();
      $reply = DB::table('replies')
              ->join('forums', 'forums.id', '=', 'replies.forum_id')
              ->where('replies.user_id', '=' , $id)
              ->get();
      return view('users.forum',compact(['user','forum','reply']));
    }

    public function setting()
    {
      $id = Auth::id();
      $user = User::find($id);
      return view('users.setting',compact('user'));
    }



    public function accountsetting()
    {
      $id = Auth::id();
      $user = User::find($id);
      return view('users.accountsetting',compact('user'));
    }

    public function updateprofile(Request $request)
    {
      $id = Auth::id();
      $user=User::find($id);

      // Validation
      $validator = Validator::make($request->all(), [
        'name' => 'required',
        'mobile' => 'required'
      ]);

      if ($validator->fails()) {
        return back()
        ->withErrors($validator)
        ->withInput();
      }

      $user->name=$request->name;
      $user->mobile=$request->mobile;   
      $user->about = $request->about;
     
      // IF EXIST
      $files = $request->image;
      if($files==TRUE){
          if ($user->image == True) {
            \File::delete($user->image);
          }
          $destinationPath = 'upload/users';
          $filename = $files->getClientOriginalName();
          $upload_success = $files->move($destinationPath, $filename);
          $user->image=$upload_success;
      }

      // Remove Image
      if ($request->fileremove == 'remove') {
        \File::delete($user->image);
        $user->image= null;
      }

      $user->save();
      $this->activity->savedactivity("user","update their profile",$id);
      return back()->with('msg', 'Successfully Updated!');

    }

    public function passwordchange(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'oldpassword' => ' required',
        'password' => 'required|string|min:6|confirmed',
      ]);
      // Validation
      if ($validator->fails()) {
        return back()
        ->withErrors($validator)
        ->withInput();
      }

      $current_password = Auth::User()->password;
      if(Hash::check($request->oldpassword, $current_password))
      {           
        $user_id = Auth::User()->id;                       
        $user = User::find($user_id);

        $user->password =bcrypt($request->password);
        $user->save();
        
        $this->activity->savedactivity("user","changed their password",$user_id);

        return back()->with('msg', 'Your password has been changed successfully!');
      }
      else{
        $validator->errors()->add('oldpassword', 'Please enter the correct password');
        return back()
        ->withErrors($validator)
        ->withInput();
      }
    }

}
