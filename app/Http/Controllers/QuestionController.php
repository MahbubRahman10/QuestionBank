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
use App\Questionsolution;
use App\SavedQuestion;
use App\Section;
use App\Subject;
use App\TestQuestion;
use App\UniversityQuestion;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Response;

class QuestionController extends BaseController
{

    protected $activity;

    public function __construct(ActivityController $activity)
    {
      $this->activity = $activity;
    }

    // view question
    public function viewquestion($category,$type,$subjectid,$csecid)
    {   

        $cid = substr($csecid, 0, 1); // Get Class id
            
        $getsection = Subject::where('id', '=', $subjectid)->first();
        $sname = $getsection->subject_name;

        $sid = $getsection->id; // Get Subject id


        // Get Section id from csubsecid
        if (strlen($csecid) > '2') {
            $secid = substr($csecid,1,3);
        }
        else{
            $secid = substr($csecid,1,2);
        }


        $class = Classes::find($cid);


        if ($category == 'school') {
            $classsubject = DB::table('classsubject')
            ->where([
                ['class_id', '=', $cid],
                ['subject_id', '=', $sid],
            ])
            ->first();
        }
        else if($category == 'madrasha'){
            $madclass = Classes::where('class','=',$class->class)->first();
            $mcid = $madclass->id;
            $classsubject = DB::table('classsubject')
            ->where([
                ['class_id', '=', $mcid],
                ['subject_id', '=', $sid],
            ])
            ->first();
            if ($classsubject) {
                
            }
            else{
                $classsubject = DB::table('classsubject')
                ->where([
                    ['class_id', '=', $cid],
                    ['subject_id', '=', $sid],
                ])
                ->first();
            }
        }

        
        $section = Section::where('classsubject_id','=',$classsubject->id)->get();

        // IF Type is Creative 
        if ($type =='creative') {
            if ($secid == 0) {
                $secid = $section[0]->id;
                $question = CreativeQuestion::where([
                    ['classsubject_id', '=', $classsubject->id],
                    ['section_id', '=',  $secid],
                ])
                ->get();

                $subsection = Section::where('id','=',$secid)->first();
            }
            else{
                $question = CreativeQuestion::where([
                    ['classsubject_id', '=', $classsubject->id],
                    ['section_id', '=',  $secid],
                ])
                ->get();
                $subsection = Section::where('id','=',$secid)->first();
            }


            return view('viewcreativequestion', compact(['class', 'section', 'subsection', 'question', 'category', 'sname', 'sid']))->with('secid',$secid);
        }
        // IF Type is MCQ
        elseif ($type == 'mcq'){
            if ($secid == 0) {
                $secid = $section[0]->id;
                $question = NormalExamQuestion::where([
                    ['classsubject_id', '=', $classsubject->id],
                    ['section_id', '=',  $secid],
                ])
                ->get();
                $subsection = Section::where('id','=',$secid)->first();
            }
            else{
                $question = NormalExamQuestion::where([
                    ['classsubject_id', '=', $classsubject->id],
                    ['section_id', '=',  $secid],
                ])
                ->get();
                $subsection = Section::where('id','=',$secid)->first();
            }

            return view('viewmcqquestion', compact(['type','class', 'section', 'subsection', 'question', 'category', 'sname', 'sid']))->with('secid',$secid);
        }  
    }
    /* View Board Question */
    public function viewboardquestion($besubid)
    {
        
        $bid = substr($besubid, 0, 1); // Get Class id
        $eid = substr($besubid, 1, 1); // Get Subject id


        // Get Section id from csubsecid
        if (strlen($besubid) > '6') {
            $year = substr($besubid,2,5);
        }
        else{
            $year = substr($besubid,2,4);
        }


        $board = Board::find($bid);

        // For JSC Question
        // if ($eid == 1) {
        // 	$boards = Board::where('board_name','=','Dhaka Board')->first();
        // 	$bid  = $boards->id;
        // }

        $board_exam = DB::table('board_examinations')
        ->where([
            ['board_id', '=', $bid],
            ['examination_id', '=', $eid],
        ])
        ->first();


        // For JSC Question
        if ($eid == 1) {
        	$bid  = $board->id;
        }

        // dd($board);

        $examination = Examination::find($eid);

        $classsubject = DB::table('classsubject')
        ->where([
            ['class_id', '=', $examination->class_id],
        ])
        ->first();

        $class = Classes::find($examination->class_id);


        // $subject = DB::table('classsubject')
        // ->join('subjects', 'subjects.id', '=', 'classsubject.subject_id')
        // ->where([
        //         ['classsubject.class_id', '=',  $examination->class_id],
        //     ])
        // ->get();
        // if ($subid == 0) {
        //     $subid = $subject[0]->id;
        //     $getsubject  = Subject::find($subid);
        //     $question = BoardQuestion::where([
        //         ['board_examinations_id', '=', $board_exam->id],
        //         ['subject_id', '=',  $subid],
        //     ])
        //     ->get();
        // }
        // else{
        //     $getsubject  = Subject::find($subid);
        //     $question = BoardQuestion::where([
        //         ['board_examinations_id', '=', $board_exam->id],
        //         ['subject_id', '=',  $subid],
        //     ])
        //     ->get();
        // }
        $activieyear = $year;

        $years = BoardQuestion::where('board_examinations_id', '=', $board_exam->id)->select('year')->groupBy('year')->orderby('year','desc')->get();

        if (Auth::user()) {
            $question = BoardQuestion::where([
                ['board_examinations_id', '=', $board_exam->id],
                ['year', '=',  $year],
            ])
            ->get();
        }
        else{
            $question = BoardQuestion::where([
                ['board_examinations_id', '=', $board_exam->id],
                ['year', '=',  $year],
            ])->limit(4)
            ->get();
        }

        if (count($question) == 0) {
            $year = $year - 1;
            if ($year == '2010') {
                return view('viewboardquestion', compact(['class', 'activieyear', 'question', 'board', 'examination','type', 'bid', 'eid', 'years']));
            }
            else{
                return Redirect('board/question/'.$board->id.$examination->id.$year);  
            }
            
        }


        return view('viewboardquestion', compact(['class', 'activieyear', 'question', 'board', 'examination','type', 'bid', 'eid', 'years']));
    }


    /* View University Question */
    public function viewuniversityquestion($type,$clasubid)
    {
        
        if ($type == 'normal') {
            $class  = Classes::where('class', '=','Normal')->first(); 
            $clipc = "normal";               
        }
        else if ($type == 'engineering') {
            $class  = Classes::where('class', '=','Engineering')->first(); 
            $clipc = "engineering";  
        }
        else if ($type == 'technology') {
            $class  = Classes::where('class', '=','Technology')->first(); 
            $clipc = "technology";  
        }
        else if ($type == 'agriculture') {
            $class  = Classes::where('class', '=','Agriculture')->first(); 
            $clipc = "agriculture";  
        }
        else {
            return view('errors.404');  
        }

        $subid = substr($clasubid, 0, 2); 
       
        $subject = DB::table('classsubject')
        ->join('subjects', 'subjects.id', '=', 'classsubject.subject_id')
        ->where([
            ['classsubject.class_id', '=',  $class->id],
        ])->get();

        if ($subid == 10) {
            $subject_id = $subject[0]->id;
            $classsubject  = ClassSubject::where([
                                ['class_id', '=',  $class->id],
                                ['subject_id', '=',  $subject_id],
                            ])->first();

            $question = NormalExamQuestion::where([
                ['classsubject_id', '=', $classsubject->id]
            ])->limit(20)
            ->get();

            $total = NormalExamQuestion::where('classsubject_id', '=', $classsubject->id)->count();
        }
        else{
            $subject_id = $subid;
            $classsubject  = ClassSubject::where([
                                ['class_id', '=',  $class->id],
                                ['subject_id', '=',  $subject_id],
                            ])->first();

            $question = NormalExamQuestion::where([
                ['classsubject_id', '=', $classsubject->id]
            ])->limit(20)
            ->get();

            $total = NormalExamQuestion::where('classsubject_id', '=', $classsubject->id)->count();
        }

        $getsubject = Subject::find($subject_id);


        return view('viewuniversityquestion', compact(['subject', 'question','getsubject','clipc','class','total']));;
    }

    // view BCS question
    public function viewbcsquestion($id)
    {   
        $subid = substr($id, 0, 2); 

        $class  = Classes::where('class', '=','bcs')->first();    
       
        if($class == null) {
            return view('errors.404');  
        }

        $subject = DB::table('classsubject')
        ->join('subjects', 'subjects.id', '=', 'classsubject.subject_id')
        ->where([
            ['classsubject.class_id', '=',  $class->id],
        ])->get();

        if ($subid == 10) {
            $subject_id = $subject[0]->id;
            $classsubject  = ClassSubject::where([
                                ['class_id', '=',  $class->id],
                                ['subject_id', '=',  $subject_id],
                            ])->first();

            $question = NormalExamQuestion::where([
                ['classsubject_id', '=', $classsubject->id]
            ])->limit(20)
            ->get();

            $total = NormalExamQuestion::where('classsubject_id', '=', $classsubject->id)->count();
        }
        else{
            $subject_id = $subid;
            $classsubject  = ClassSubject::where([
                                ['class_id', '=',  $class->id],
                                ['subject_id', '=',  $subject_id],
                            ])->first();

            $question = NormalExamQuestion::where([
                ['classsubject_id', '=', $classsubject->id]
            ])->limit(20)
            ->get();

            $total = NormalExamQuestion::where('classsubject_id', '=', $classsubject->id)->count();
        }

        $getsubject = Subject::find($subject_id);
        return view('viewbcsquestion', compact(['subject', 'question','getsubject','class','total']));

    }

    // view Recruitment Question
    public function viewrecruitmentquestion($type,$id)
    {   
        if ($type == 'ntrca') {
            $class  = Classes::where('class', '=','NTRCA')->first(); 
            $clipc = "ntrca";               
        }
        else if ($type == 'dpe') {
            $class  = Classes::where('class', '=','DPE')->first(); 
            $clipc = "dpe";  
        }
        else if ($type == 'bank') {
            $class  = Classes::where('class', '=','BANK')->first(); 
            $clipc = "bank";  
        }
        else{
            return view('errors.404');  
        }

        $subid = substr($id, 0, 2); 

       
        $subject = DB::table('classsubject')
        ->join('subjects', 'subjects.id', '=', 'classsubject.subject_id')
        ->where([
            ['classsubject.class_id', '=',  $class->id],
        ])->get();

        if ($subid == 10) {
            $subject_id = $subject[0]->id;
            $classsubject  = ClassSubject::where([
                                ['class_id', '=',  $class->id],
                                ['subject_id', '=',  $subject_id],
                            ])->first();

            $question = NormalExamQuestion::where([
                ['classsubject_id', '=', $classsubject->id]
            ])->limit(20)
            ->get();

             $total = NormalExamQuestion::where('classsubject_id', '=', $classsubject->id)->count();

        }
        else{
            $subject_id = $subid;
            $classsubject  = ClassSubject::where([
                                ['class_id', '=',  $class->id],
                                ['subject_id', '=',  $subject_id],
                            ])->first();

            $question = NormalExamQuestion::where([
                ['classsubject_id', '=', $classsubject->id]
            ])->limit(20)
            ->get();

            $total = NormalExamQuestion::where('classsubject_id', '=', $classsubject->id)->count();
        }
        $getsubject = Subject::find($subject_id);

        return view('viewreqquestion', compact(['subject', 'question','getsubject','clipc','class','total']));

    }

    public function viewquestionsolution($category)
    {   
        if (Auth::user()) {
            $questions = Questionsolution::where('category','=',$category)->get();  
        }
        else{
            $questions = Questionsolution::where('category','=',$category)->limit(4)->get();
        }

        return view('viewquestionsolution',compact(['category','questions']));
    }

    // Saved Question
    public function savedquestion($type,Request $request)
    {   
        $data = $request->data;
        if ($type == 'creative') {
            $question = CreativeQuestion::where('id','=',$data)->first();


            $checkquestion  = SavedQuestion::where([['question_id','=',$question->id],['user_id','=',Auth::id()],['classsubject_id','=',$question->classsubject_id]])->first();

            if ($checkquestion) {
                return Response()->json(400); 
            }
            else{
                $saved = new SavedQuestion(); 
                $saved->type = 'creative';
                $saved->question_id = $question->id;
                $saved->user_id = Auth::id();
                $saved->classsubject_id = $question->classsubject_id;
                $saved->section_id = $question->section_id;
                $saved->save();

                $this->activity->savedactivity("savedcreativequestion","saved a",$question->id);
            }


            

            return Response()->json(200);
        }
        elseif ($type == 'mcq') {
            $question = NormalExamQuestion::where('id','=',$data)->first();


            $checkquestion  = SavedQuestion::where([['question_id','=',$question->id],['user_id','=',Auth::id()],['classsubject_id','=',$question->classsubject_id]])->first();

            if ($checkquestion) {
                return Response()->json(400);    
            }
            else{
                $saved = new SavedQuestion(); 
                $saved->type = 'mcq';
                $saved->question_id = $question->id;
                $saved->user_id = Auth::id();
                $saved->classsubject_id = $question->classsubject_id;
                $saved->section_id = $question->section_id;
                $saved->save();
                $this->activity->savedactivity("savedmcqquestion","saved a",$question->id);

                return Response()->json(200); 
            } 
        }
    }



    // Load More Question
    public function loadmore(Request $request)
    {
        if ($request->type == "bcs") {
            $result = $this->loadbcs($request->subid, $request->id, $request->index);
            return Response()->json($result);
        }
        else if ($request->type == "recruitment") {
            $result = $this->loadrecruitment($request->category,$request->subid, $request->id, $request->index);
            return Response()->json($result);
        }
        else if ($request->type == "university") {
            $result = $this->loaduniversity($request->category,$request->subid, $request->id, $request->index);
            return Response()->json($result);
        }
    }

    public function loadbcs($subid,$id,$i)
    {
        $result = '';

        $class  = Classes::where('class', '=','bcs')->first();    

        $classsubject  = ClassSubject::where([
            ['class_id', '=',  $class->id],
            ['subject_id', '=',  $subid],
        ])->first();

        $total = $questions = NormalExamQuestion::where('classsubject_id', '=', $classsubject->id)
        ->count();

        $questions = NormalExamQuestion::where([
            ['id', '>', $id],
            ['classsubject_id', '=', $classsubject->id]
        ])->limit(20)
        ->get();

        
        $english =array('0','1','2','3','4','5','6','7','8','9');
        $bangla =array('০','১','২','৩','৪','৫','৬','৭','৮','৯'); 
            
        if (Auth::user()) {
            $saved = '<a href=""  title="Saved" class="saved" style="color: black;"> <i class="fa fa-save" style="padding: 0px 8px;"></i> </a>';
        }
        else{
            $saved = null;
        }

        $i++;
        if ($questions->isEmpty()) {
            $result = "null";
            return $result;
        }
        else{
            foreach ($questions as $key => $question) {
                $result.='<div class="bcsquestion"> 
                <span>প্রশ্ন '.str_replace($english, $bangla, $i++).' : </span></span> '.$saved.'
                <h3><strong id="q">'.$question->question_name.'</strong></h3>
                <br>
                <p>১) '.$question->option_no_1.'</p>
                <p>২) '.$question->option_no_2.'</p>
                <p>৩) '.$question->option_no_3.'</p>
                <p>৪) '.$question->option_no_4.'</p>
                <br>
                <p> <strong>সঠিক উত্তর : </strong> '.$question->correct_answer.'</p>
                <br>
                </div>';
            }
            if ($i <  $total) {
                $i = $i - 1;
                $result.='<a href="" class="loadmore" data-subid="'.$subid.'" data-id="'.$question->id.'" data-index="'.$i.'" style="">Load More</a>';
            }
            
            return $result;
        }
        
    }

    // Load Recruitment Question
    public function loadrecruitment($type,$subid,$id,$i)
    {   
        $result = '';

        if ($type == 'ntrca') {
            $class  = Classes::where('class', '=','NTRCA')->first(); 
        }
        else if ($type == 'dpe') {
            $class  = Classes::where('class', '=','DPE')->first(); 
        }
        else if ($type == 'bank') {
            $class  = Classes::where('class', '=','BANK')->first(); 
        }
 
        $classsubject  = ClassSubject::where([
            ['class_id', '=',  $class->id],
            ['subject_id', '=',  $subid],
        ])->first();


        $total = $questions = NormalExamQuestion::where('classsubject_id', '=', $classsubject->id)
        ->count();

        $questions = NormalExamQuestion::where([
            ['id', '>', $id],
            ['classsubject_id', '=', $classsubject->id]
        ])->limit(20)
        ->get();

        $english =array('0','1','2','3','4','5','6','7','8','9');
        $bangla =array('০','১','২','৩','৪','৫','৬','৭','৮','৯'); 

        if (Auth::user()) {
            $saved = '<a href=""  title="Saved" class="saved" style="color: black;"> <i class="fa fa-save" style="padding: 0px 8px;"></i> </a>';
        }
        else{
            $saved = null;
        }

        $i++;
        if ($questions->isEmpty()) {
            $result = "null";
            return $result;
        }
        else{
            foreach ($questions as $key => $question) {
                $result.='<div class="bcsquestion"> 
                <span>প্রশ্ন '.str_replace($english, $bangla, $i++).' : </span></span> '.$saved.'
                <h3><strong id="q">'.$question->question_name.'</strong></h3>
                <br>
                <p>১) '.$question->option_no_1.'</p>
                <p>২) '.$question->option_no_2.'</p>
                <p>৩) '.$question->option_no_3.'</p>
                <p>৪) '.$question->option_no_4.'</p>
                <br>
                <p> <strong>সঠিক উত্তর : </strong> '.$question->correct_answer.'</p>
                <br>
                </div>';
            }
            if ($i <  $total) {
                $i = $i - 1;
                $result.='<a href="" class="loadmore" data-subid="'.$subid.'" data-id="'.$question->id.'" data-index="'.$i.'" data-category="'.$type.'" style="">Load More</a>';
            }
            
            return $result;
        }
    }



    // Load University Question
    public function loaduniversity($type,$subid,$id,$i)
    {   
        $result = '';

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
 
        $classsubject  = ClassSubject::where([
            ['class_id', '=',  $class->id],
            ['subject_id', '=',  $subid],
        ])->first();


        $total = $questions = NormalExamQuestion::where('classsubject_id', '=', $classsubject->id)
        ->count();

        $questions = NormalExamQuestion::where([
            ['id', '>', $id],
            ['classsubject_id', '=', $classsubject->id]
        ])->limit(20)
        ->get();

        $english =array('0','1','2','3','4','5','6','7','8','9');
        $bangla =array('০','১','২','৩','৪','৫','৬','৭','৮','৯'); 

        if (Auth::user()) {
            $saved = '<a href=""  title="Saved" class="saved" style="color: black;"> <i class="fa fa-save" style="padding: 0px 8px;"></i> </a>';
        }
        else{
            $saved = null;
        }

        $i++;
        if ($questions->isEmpty()) {
            $result = "null";
            return $result;
        }
        else{
            foreach ($questions as $key => $question) {
                $result.='<div class="bcsquestion"> 
                <span>প্রশ্ন '.str_replace($english, $bangla, $i++).' : </span></span> '.$saved.'
                <h3><strong id="q">'.$question->question_name.'</strong></h3>
                <br>
                <p>১) '.$question->option_no_1.'</p>
                <p>২) '.$question->option_no_2.'</p>
                <p>৩) '.$question->option_no_3.'</p>
                <p>৪) '.$question->option_no_4.'</p>
                <br>
                <p> <strong>সঠিক উত্তর : </strong> '.$question->correct_answer.'</p>
                <br>
                </div>';
            }
            if ($i <  $total) {
                $i = $i - 1;
                $result.='<a href="" class="loadmore" data-subid="'.$subid.'" data-id="'.$question->id.'" data-index="'.$i.'" data-category="'.$type.'" style="">Load More</a>';
            }
            
            return $result;
        }
    }



    public function downloadsolutionquestion($id)
    {   
        $question = Questionsolution::find($id);
        $file= $question->file;
        $path =  public_path()."\SolveQuestion/";
        return Response::download($path.$file);
    }

}
