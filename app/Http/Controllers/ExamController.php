<?php

namespace App\Http\Controllers;

use App\Board;
use App\BoardQuestion;
use App\ClassSubject;
use App\Classes;
use App\CreativeQuestion;
use App\Examination;
use App\Http\Controllers\ActivityController;
use App\McqQuestion;
use App\NormalExamQuestion;
use App\Result;
use App\Section;
use App\Subject;
use App\TestQuestion;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Session;


class ExamController extends BaseController
{   

    protected $activity;

    public function __construct(ActivityController $activity)
    {
      $this->activity = $activity;
    }


    // view question
    public function viewexam($category,$id)
    {   
        if ($category == 'school') {
            if ($id == '6') {$cid = 1;} else if ($id == '7') {$cid = 2;} else if ($id == '8') {$cid = 3;} else if ($id == '9-10') {$cid = 4;} else if ($id == '11-12') {$cid = 5;} else{ return view('errors.404');}
        }
        elseif ($category == 'madrasha') {
            if ($id == '6') {$cid = 6;} else if ($id == '7') {$cid = 7;} else if ($id == '8') {$cid = 8;} else if ($id == '9-10') {$cid = 9;} else if ($id == '11-12') {$cid = 10;} else{ return view('errors.404');}
        }
        else{
            return view('errors.404');
        }


        // Get Class with type
        $class = Classes::where([
            ['id', '=', $cid],
            ['type', '=', $category],
        ])->first();



        // Get all Subject
        $subject = DB::table('subjects')
        ->join('classsubject', 'classsubject.subject_id', '=', 'subjects.id')
        ->where('classsubject.class_id', '=' , $class->id)
        ->get();

       // $section = Section::where('classsubject_id','=',$classsubject->id)->get();

        return view('exam.getexam', compact(['class', 'subject']));
    }  

    // View University Exam
    public function viewuniversityexam($type)
    {
        if ($type == 'normal') {
            $class  = Classes::where('class', '=','Normal')->first(); 
        }
        else if ($type == 'engineering') {
            $class  = Classes::where('class', '=','Engineering')->first(); 
        }
        else if ($type == 'technology') {
            $class  = Classes::where('class', '=','Technology')->first(); 
        }
        else if ($type == 'agriculture') {
            $class  = Classes::where('class', '=','Agriculture')->first(); 
        }
        else{
            return view('errors.404');
        }


        $subject = DB::table('subjects')
        ->join('classsubject', 'classsubject.subject_id', '=', 'subjects.id')
        ->where('classsubject.class_id', '=' , $class->id)
        ->get();

         return view('exam.getexam', compact(['class', 'subject']));
    }

    // View Other Exam (BCS, NTRCA, DPE, BANK )
    public function viewotherexam($type)
    {
        if ($type == 'ntrca') {
            $class  = Classes::where('class', '=','NTRCA')->first(); 
            $clipc = "ntrca";               
        }
        else if ($type == 'dpe') {
            $class  = Classes::where('class', '=','DPE')->first(); 
            $clipc = "dpe";  
        }
        else if ($type == 'bcs') {
            $class  = Classes::where('class', '=','BCS')->first(); 
            $clipc = "bcs";  
        }
        else if ($type == 'bank') {
            $class  = Classes::where('class', '=','BANK')->first(); 
            $clipc = "bank";  
        }
        else{
            return view('errors.404');
        }

        

        $subject = DB::table('subjects')
        ->join('classsubject', 'classsubject.subject_id', '=', 'subjects.id')
        ->where('classsubject.class_id', '=' , $class->id)
        ->get();

         return view('exam.getexam', compact(['class', 'subject']));
    }

    public function getsection(Request $request)
    {   
        // Get Section
        $section = Section::where('ClassSubject_id','=',$request->csid)->get();
        return Response()->json($section);
    }

    // Get Exam Notify
    public function getexam(Request $request, $id)
    {
        $classin = Classes::find($id);
        if ($classin->type == 'madrasha') {
            $classout  = Classes::where('class','=',$classin->class)->first();
            $classsubjectin = ClassSubject::where([
                ['class_id', '=', $classout->id],
                ['subject_id', '=', $request->subject]
            ])->first();

            if ($classsubjectin) {
                $classsubject = ClassSubject::where([['class_id','=',$classout->id],['subject_id','=',$request->subject]])->first();
            }
            else{
                $classsubject = ClassSubject::where([['class_id','=',$classin->id],['subject_id','=',$request->subject]])->first();   
            }
        }
        else{
            $classsubject = ClassSubject::where([['class_id','=',$id],['subject_id','=',$request->subject]])->first();
        }


        if ($request->category == 1) {
            $category = "অনুশীলন";
        }
        else{
            $category = "পরীক্ষা";
        }


        if($request->test != null && $request->test != 'university'){
            if($request->optradio == 2){
                $sections = $request->sections;
                $subject = Subject::where('id', '=' , $request->subject)->first(); 
                $section = Section::find($request->sections);
                
                // Session
                session::put('section_id',$section->id);

                $Data = ['clsubid' => $classsubject->id,'subject' => $subject->subject_name,'section_id' => $section->id,'section' => $section->section_name, 'category' => $category , 'toatlquestion' => $request->question, 'time' => $request->question ];
            }
            else{
                $subject = Subject::where('id', '=' , $request->subject)->first(); 
                
                // Session
                session::put('class_id',$classsubject->class_id);
                session::put('subject_id',$classsubject->subject_id);

                $Data = ['clsubid' => $classsubject->id,'subject' => $subject->subject_name, 'category' => $category , 'toatlquestion' => $request->question, 'time' => $request->question ];
            }
        }
        else{
            if($request->optradio == 2){
                $subject = Subject::where('id', '=' , $request->subject)->first();
                
                // Session
                session::put('class_id',$classsubject->class_id);
                session::put('subject_id',$classsubject->subject_id); 
                
                $Data = ['clsubid' => $classsubject->id,'subject' => $subject->subject_name, 'category' => $category , 'toatlquestion' => $request->question, 'time' => $request->question ];
                }
            else{
               $class = Classes::where('class','=',$request->examname)->first();
               
               // Session
               session::put('class_id',$class->id);
               
               $Data = ['classid' => $class->id,'category' => $category , 'toatlquestion' => $request->question, 'time' => $request->question ];
            }
        }

      
        session(['Exam' => $Data]);

       return redirect('exam/question');


    }
    // Start EXAM
    public function startexam(Request $request)
    {   

        $user = User::find(Auth::id());
        $user->point = $user->point + 5;
        $user->save();

        session_start();
        $id = Auth::id();
        $all = [];  

        // Replace number
        $english =array('0','1','2','3','4','5','6','7','8','9');
        $bangla =array('০','১','২','৩','৪','৫','৬','৭','৮','৯'); 


        // Get value from Session(Exam)
        $section  = Session::get('Exam.section_id');
        $clsubid  = Session::get('Exam.clsubid');
        $classid = Session::get('Exam.classid');
        $category  = Session::get('Exam.category');
        $total  =   str_replace($bangla,$english,Session::get('Exam.toatlquestion'));
        $time  = Session::get('Exam.time');
        $thistime = str_replace($bangla,$english,$time);

        // add Exam minute with now time 
        $addtime  = Carbon::now()->addMinutes($thistime);
        // Format Exam time after add minutes
        $endtime = Carbon::parse($addtime)->format('F d, Y H:i:s');  


        // unset($_SESSION['token']);
        // unset($_SESSION['time']);
        // unset($_SESSION['question']);
        // dd("ok");


        $now = Carbon::now(); 
    
        if (isset($_SESSION['time'])) {
            $diff =  Carbon::parse($_SESSION['time'])->diffForHumans($now);
            if (strpos($diff, 'before') == true) {
                unset($_SESSION['time']);
                unset($_SESSION['question']);
                return Response()->json(array('msg'=>'errortime'));
            }
        }
        

        if (!isset($_SESSION['token'])) {


            // Generate Exam Token 
            if ($section == null) {
                $token = $this->Token(5);
            }
            else{
                $token = $this->Token(4);
            }
            

            $_SESSION['token'] = $token;

             //Exam time keep in session
            if(!isset($_SESSION['time']))
            {   
                $_SESSION['time'] =  $endtime;
            }


            // IF Exam is BSC/University/NTRCA/BANK/FPE
            if ($classid != null) {
                // $question = NormalExamQuestion::inRandomOrder()->limit($total)->where('class_id','=',$classid)->get(); 
                $question = DB::table('classsubject')
                ->join('classes', 'classes.id', '=', 'classsubject.class_id')
                ->join('normal_exam_questions', 'normal_exam_questions.classsubject_id', '=', 'classsubject.id')
                ->where('classes.id', '=' , $classid)
                ->inRandomOrder()
                ->limit($total)
                ->get();  

                foreach ($question as $key => $value) {
                    DB::table('normal_exam_question_user')->insert([
                        ['normal_exam_question_id' => $value->id, 'user_id' => Auth::user()->id, 'exam_token' => $token]
                    ]);
                }
 
            }
            // IF Exam is session wise
            elseif ($section == null) {
                $question = NormalExamQuestion::inRandomOrder()->limit($total)->where('classsubject_id','=',$clsubid)->get();            
            }
            // IF Exam is Full book
            else{
                $question = NormalExamQuestion::inRandomOrder()->limit($total)->where([['classsubject_id','=',$clsubid],['section_id','=',$section]])->get();
            }


            if ($classid == null) {
                // Working with Pivot table Normal_exam_euestion_user
                foreach ($question as $key => $value) {
                    // $value->users()->sync($id, false);    
                    $value->users()->attach($id, ['exam_token' => $token]);
                }

           }

            $_SESSION['question'] = $question;
        }


        return Response()->json(array('question'=>$_SESSION['question'] ,'time'=>$_SESSION['time'] ));
    }

    public function answer(Request $request)
    {   
        $id = Auth::id();
        $user = User::find($id);
        $exam = NormalExamQuestion::find($request->id);
        if($exam->correct_answer == $request->answer){
            $user->normalexams()->updateExistingPivot($exam->id,['answer'=>$request->answer, 'result'=>'Correct']);
        }
        else{
            $user->normalexams()->updateExistingPivot($exam->id,['answer'=>$request->answer, 'result'=>'Worng']);
        }
    }


    public function endexam()
    {   
        session_start();

        if (isset($_SESSION['token'])) {
            $etoken = $_SESSION['token'];            
            $_SESSION['etoken'] = $etoken;
        }

        $token = $_SESSION['etoken'];


        // Replace number
        $english =array('0','1','2','3','4','5','6','7','8','9');
        $bangla =array('০','১','২','৩','৪','৫','৬','৭','৮','৯'); 

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

        $lang =  LaravelLocalization::getCurrentLocale();
        if ($lang != 'en') {
            $total = str_replace($english,$bangla,$total);
            $correct = str_replace($english,$bangla,$correct);
            $worng = str_replace($english,$bangla,$worng);
        }


        $result = [
            'total' => $total,
            'correct' => $correct,
            'worng' => $worng 
        ];



        if (isset($_SESSION['token']) && Session::get('Exam.category') == 'পরীক্ষা') {
            // Save Final Result on Result table
            $results  = new Result;
            $results->etoken = $token;
            $results->user_id = $user->id;
            
            $results->class_id = session::get('class_id');
            $results->subject_id = session::get('subject_id');
            $results->section_id = session::get('section_id');

            $results->total_question = $total;
            $results->right_answer = $correct;

            $results->percentage = ($correct/$total)*100;

            $this->activity->savedactivity("exam","participated in an",$token);

            $results->save();
        }
                
        unset($_SESSION['token']);
        unset($_SESSION['time']);
        unset($_SESSION['question']);
        // Session::forget('Exam');
        // Session::pull('Exam');
        // Session::save();
        // Session::put('Exam', []);

        return view('exam.result',compact(['results','result','token']));
    }   


    // Result Sheet
    public function resultsheet()
    {
        session_start();
        $token  = $_SESSION['etoken'];   
        
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


         // Replace number
        $english =array('0','1','2','3','4','5','6','7','8','9');
        $bangla =array('০','১','২','৩','৪','৫','৬','৭','৮','৯'); 
        $lang =  LaravelLocalization::getCurrentLocale();
        if ($lang != 'en') {
            $total = str_replace($english,$bangla,$total);
            $correct = str_replace($english,$bangla,$correct);
            $worng = str_replace($english,$bangla,$worng);
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


        return view('exam.resultsheet',compact(['question','result','total','correct','worng','token']));

    }

    // Token 
    public function Token($length){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max-1)];
        }
        return $token;  
    }

    
}
