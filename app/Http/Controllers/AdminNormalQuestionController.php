<?php

namespace App\Http\Controllers;

use App\ClassSubject;
use App\Classes;
use App\CreativeQuestion;
use App\NormalExamQuestion;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;

class AdminNormalQuestionController extends Controller
{

    public function __construct()
    {


    }

    public function index($id)
    {   
        $creative = DB::table('creative_questions')
        ->join('classsubject', 'classsubject.id', '=', 'creative_questions.classsubject_id')
        ->join('classes', 'classes.id', '=', 'classsubject.class_id')
        ->where('classes.type', '=' , 'school')
        ->count();

        $mcq = DB::table('normal_exam_questions')
        ->join('classsubject', 'classsubject.id', '=', 'normal_exam_questions.classsubject_id')
        ->join('classes', 'classes.id', '=', 'classsubject.class_id')
        ->where('classes.type', '=' , 'school')
        ->count();

        $subject = DB::table('classes')
        ->join('classsubject', 'classsubject.class_id', '=', 'classes.id')
        ->where('classes.type', '=' , $id)
        ->count();

        return Response()->json(array('creative'=>$creative,'mcq'=>$mcq,'subject'=>$subject));

    }

	/* Get Class Subject */
    public function getAllSubject(Request $request)
    {	
        $subjects = DB::table('subjects')
        ->join('classsubject', 'classsubject.subject_id', '=', 'subjects.id')
        ->where('classsubject.class_id', '=' , $request->id)
        ->get();

        $sections = Section::where('ClassSubject_id', '=', $subjects[0]->id)->get();

        return Response()->json(array('subjects'=>$subjects,'sections'=>$sections));
    }

	/* Get Subject sections */
    public function getsection(Request $request)
    {
        $class = Classes::find($request->cid);

        if ($class->type == 'madrasha') {
           $madclass = Classes::where('class','=',$class->class)->first();
           $mcid = $madclass->id;
           
           $madclasssubject = ClassSubject::find($request->sid);
           $madsubject = $madclasssubject->subject_id;

           $classsubject = ClassSubject::where([
                            ['class_id', '=', $mcid],
                            ['subject_id', '=', $madsubject]
                        ])->first();

            if ($classsubject){
                $sections = DB::table('classsubject')
                ->join('sections', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->where([
                    ['sections.ClassSubject_id', '=', $classsubject->id],
                    ['classsubject.class_id', '=', $mcid]
                ])
                ->get();
            }
            else{
                $sections = DB::table('classsubject')
                ->join('sections', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->where([
                    ['sections.ClassSubject_id', '=', $request->sid],
                    ['classsubject.class_id', '=', $request->cid]
                ])
                ->get();
            }
        }
        else{            
            $sections = DB::table('classsubject')
            ->join('sections', 'classsubject.id', '=', 'sections.ClassSubject_id')
            ->where([
                ['sections.ClassSubject_id', '=', $request->sid],
                ['classsubject.class_id', '=', $request->cid]
            ])
            ->get();            
        }


    	return Response()->json(array('sections'=>$sections,'post'=>$sections));
    }

	/* Get Creative Question */
    public function getquestion(Request $request)
    {

        $classsubject = ClassSubject::find($request->clsubid);
        $class = Classes::find($classsubject->class_id);

        if ($class->type == 'madrasha') {
           $madclass = Classes::where('class','=',$class->class)->first();
           $mcid = $madclass->id; 

           $madclasssubject =  $classsubject = ClassSubject::where([
                                    ['class_id', '=', $mcid],
                                    ['subject_id', '=', $classsubject->subject_id]
                                ])->first();

            if ($madclasssubject) {
                $question = DB::table('sections')
                ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->join('creative_questions', 'creative_questions.section_id', '=', 'sections.id')
                ->where([
                    ['sections.ClassSubject_id', '=', $madclasssubject->id],
                    ['sections.id', '=', $request->secid],
                ])
                ->orderBy('creative_questions.created_at', 'asc')
                ->paginate(20);

                $total = DB::table('sections')
                ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->join('creative_questions', 'creative_questions.section_id', '=', 'sections.id')
                ->where([
                    ['sections.ClassSubject_id', '=', $madclasssubject->id],
                    ['sections.id', '=', $request->secid],
                ])
                ->count();
            }
            else{
                $question = DB::table('sections')
                ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->join('creative_questions', 'creative_questions.section_id', '=', 'sections.id')
                ->where([
                    ['sections.ClassSubject_id', '=', $request->clsubid],
                    ['sections.id', '=', $request->secid],
                ])
                ->orderBy('creative_questions.created_at', 'asc')
                ->paginate(20); 

                $total = DB::table('sections')
                ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->join('creative_questions', 'creative_questions.section_id', '=', 'sections.id')
                ->where([
                    ['sections.ClassSubject_id', '=', $request->clsubid],
                    ['sections.id', '=', $request->secid],
                ])
                ->count(); 
            }

        }
        else{
            $question = DB::table('sections')
            ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
            ->join('creative_questions', 'creative_questions.section_id', '=', 'sections.id')
            ->where([
                ['sections.ClassSubject_id', '=', $request->clsubid],
                ['sections.id', '=', $request->secid],
            ])
            ->orderBy('creative_questions.created_at', 'asc')
            ->paginate(20); 

            $total = DB::table('sections')
            ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
            ->join('creative_questions', 'creative_questions.section_id', '=', 'sections.id')
            ->where([
                ['sections.ClassSubject_id', '=', $request->clsubid],
                ['sections.id', '=', $request->secid],
            ])
            ->count();  
        }

    	

    	return Response()->json(array('question'=>$question,'total'=>$total));
    }

	/* Add Creative Question */
    public function addquestion(Request $request)
    {
    

        $sections = Section::find($request->secid);


        if($request->file){
            $exploded = explode(',',$request->file);
            $decode = base64_decode($exploded[1]);

            $ext ='xlsx';

            $filename = str_random().'.'.$ext;
            $destinationpath =  public_path().'/upload/'.$filename;
            $image = file_put_contents($destinationpath, $decode);


            $data = \Excel::load($destinationpath)->get();

            foreach ($data as $key => $value) {
                $question[] = ['classsubject_id' => $sections->ClassSubject_id, 'section_id' => $request->secid, 'question_name' => str_replace(' ', '', $value->question), 'question_no_1' => str_replace(' ', '', $value->question1), 'question_no_2' => str_replace(' ', '', $value->question2), 'question_no_3' => str_replace(' ', '', $value->question3), 'question_no_4' => str_replace(' ', '', $value->question4)];
            }

            if(!empty($question))
            {
                echo $destinationpath;
                DB::table('creative_questions')->insert($question);
                \File::delete($destinationpath);
            }
        
        }
        else{


            $question = new CreativeQuestion();

            $question->classsubject_id = $sections->ClassSubject_id;
            $question->section_id = $request->secid;
            $question->institution = $request->institution;
            $question->question_name = $request->question;
            $question->question_no_1 = $request->question1;
            $question->question_no_2 = $request->question2;
            $question->question_no_3 = $request->question3;
            if ($request->question4 == "NULL") {
                $question->question_no_4 = null;
            }else{
                $question->question_no_4 = $request->question4;
            }

            $question->save();

           
        }

        return Response()->json($question,200);

    }

    /* Edit Creative Question */
    public function editquestion(Request $request)
    {

        $question = CreativeQuestion::find($request->id);
        $question->institution = $request->institution;
        $question->question_name = $request->question;
        $question->question_no_1 = $request->question1;
        $question->question_no_2 = $request->question2;
        $question->question_no_3 = $request->question3;

        if ($request->question4 == "NULL") {
            $question->question_no_4 = null;
        }else{
            $question->question_no_4 = $request->question4;
        }

        $question->save();
        
        return Response()->json($question,200);

    }

    /* Delete Creative Question */
    public function deletequestion(Request $request)
    {
        $question = CreativeQuestion::find($request->id);
        $question->delete();
        return Response()->json($question,200);
    }

    /* Get Filter Creative Question */
    public function getfilterquestion(Request $request)
    {
        $classsubject = ClassSubject::find($request->ClsSubid);
        $class = Classes::find($classsubject->class_id);

        if ($class->type == 'madrasha') {            
            $madclass = Classes::where('class','=',$class->class)->first();
            $mcid = $madclass->id; 
            $madclasssubject =  $classsubject = ClassSubject::where([
                ['class_id', '=', $mcid],
                ['subject_id', '=', $classsubject->subject_id]
            ])->first();
            

            if ($madclasssubject) {
                $question = DB::table('sections')
                ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->join('creative_questions', 'creative_questions.section_id', '=', 'sections.id')
                ->where([
                    ['sections.ClassSubject_id', '=', $madclasssubject->id],
                    ['sections.id', '=', $request->secid],
                ])
                ->orderBy('creative_questions.created_at', 'desc')
                ->take($request->data)
                ->get();
            }
            else{
                $question = DB::table('sections')
                ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->join('creative_questions', 'creative_questions.section_id', '=', 'sections.id')
                ->where([
                    ['sections.ClassSubject_id', '=', $request->ClsSubid],
                    ['sections.id', '=', $request->secid],
                ])
                ->orderBy('creative_questions.created_at', 'desc')
                ->take($request->data)
                ->get();
            }

        }
        else{
            $question = DB::table('sections')
            ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
            ->join('creative_questions', 'creative_questions.section_id', '=', 'sections.id')
            ->where([
                ['sections.ClassSubject_id', '=', $request->ClsSubid],
                ['sections.id', '=', $request->secid],
            ])
            ->orderBy('creative_questions.created_at', 'desc')
            ->take($request->data)
            ->get();  
        }

        

        return Response()->json($question,200);
    }

    /* Get Search Creative Question */
    public function getsearchquestion(Request $request)
    {   

        $search = $request->data; 

        $classsubject = ClassSubject::find($request->ClsSubid);
        $class = Classes::find($classsubject->class_id);

        if ($class->type == 'madrasha') {            
            $madclass = Classes::where('class','=',$class->class)->first();
            $mcid = $madclass->id; 
            $madclasssubject =  $classsubject = ClassSubject::where([
                ['class_id', '=', $mcid],
                ['subject_id', '=', $classsubject->subject_id]
            ])->first();

            if ($madclasssubject) {
                $question = DB::table('sections')
                ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->join('creative_questions', 'creative_questions.section_id', '=', 'sections.id')
                ->where([
                    ['sections.ClassSubject_id', '=', $madclasssubject->id],
                    ['sections.id', '=', $request->secid],
                ])
                ->where('question_name','LIKE',"%{$search}%")
                ->orderBy('creative_questions.created_at', 'asc')
                ->get(); 
            }
            else{
                $question = DB::table('sections')
                ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
                 ->join('creative_questions', 'creative_questions.section_id', '=', 'sections.id')
                 ->where([
                    ['sections.ClassSubject_id', '=', $request->ClsSubid],
                    ['sections.id', '=', $request->secid],
                ])
                 ->where('question_name','LIKE',"%{$search}%")
                 ->orderBy('creative_questions.created_at', 'asc')
                 ->get(); 
            }

        }
        else{
             $question = DB::table('sections')
             ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
             ->join('creative_questions', 'creative_questions.section_id', '=', 'sections.id')
             ->where([
                ['sections.ClassSubject_id', '=', $request->ClsSubid],
                ['sections.id', '=', $request->secid],
            ])
             ->where('question_name','LIKE',"%{$search}%")
             ->orderBy('creative_questions.created_at', 'asc')
             ->get(); 
        }

        

        return Response()->json($question,200);
    }




    /* Get MCQ Question */
    public function mcqgetquestion(Request $request)
    {
        $classsubject = ClassSubject::find($request->ClsSubid);
        $class = Classes::find($classsubject->class_id);

        if ($class->type == 'madrasha') {
           $madclass = Classes::where('class','=',$class->class)->first();
           $mcid = $madclass->id; 

           $madclasssubject =  $classsubject = ClassSubject::where([
                                    ['class_id', '=', $mcid],
                                    ['subject_id', '=', $classsubject->subject_id]
                                ])->first();


            if ($madclasssubject) {
                $question = DB::table('sections')
                ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->join('normal_exam_questions', 'normal_exam_questions.section_id', '=', 'sections.id')
                ->where([
                    ['sections.ClassSubject_id', '=', $madclasssubject->id],
                    ['sections.id', '=', $request->secid],
                ])
                ->orderBy('normal_exam_questions.created_at', 'desc')
                ->paginate(20);

                $total = DB::table('sections')
                ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->join('normal_exam_questions', 'normal_exam_questions.section_id', '=', 'sections.id')
                ->where([
                    ['sections.ClassSubject_id', '=', $madclasssubject->id],
                    ['sections.id', '=', $request->secid],
                ])
                ->orderBy('normal_exam_questions.created_at', 'desc')
                ->count();
            }
            else{
                 $question = DB::table('sections')
                ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->join('normal_exam_questions', 'normal_exam_questions.section_id', '=', 'sections.id')
                ->where([
                    ['sections.ClassSubject_id', '=', $request->ClsSubid],
                    ['sections.id', '=', $request->secid],
                ])
                ->orderBy('normal_exam_questions.created_at', 'desc')
                ->paginate(20); 

                $total = DB::table('sections')
                ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->join('normal_exam_questions', 'normal_exam_questions.section_id', '=', 'sections.id')
                ->where([
                    ['sections.ClassSubject_id', '=', $request->ClsSubid],
                    ['sections.id', '=', $request->secid],
                ])
                ->orderBy('normal_exam_questions.created_at', 'desc')
                ->count(); 
            }

        }
        else{
            $question = DB::table('sections')
            ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
            ->join('normal_exam_questions', 'normal_exam_questions.section_id', '=', 'sections.id')
            ->where([
                ['sections.ClassSubject_id', '=', $request->ClsSubid],
                ['sections.id', '=', $request->secid],
            ])
            ->orderBy('normal_exam_questions.created_at', 'desc')
            ->paginate(20);

            $total = DB::table('sections')
            ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
            ->join('normal_exam_questions', 'normal_exam_questions.section_id', '=', 'sections.id')
            ->where([
                ['sections.ClassSubject_id', '=', $request->ClsSubid],
                ['sections.id', '=', $request->secid],
            ])
            ->orderBy('normal_exam_questions.created_at', 'desc')
            ->count();
        }     
       

        return Response()->json(array('question'=>$question,'total'=>$total));
    }

    /* Add MCQ Question */
    public function mcqaddquestion(Request $request)
    {

        $sections = Section::find($request->secid);


        if($request->file){

            $exploded = explode(',',$request->file);
            $decode = base64_decode($exploded[1]);
            $ext ='xlsx';

            $filename = str_random().'.'.$ext;
            $destinationpath =  public_path().'/upload/'.$filename;
            $image = file_put_contents($destinationpath, $decode);


            $data = \Excel::load($destinationpath)->get();

            foreach ($data as $key => $value) {
                if ($value->mcq_type == 2) {                    
                    $question = ['classsubject_id' => $sections->ClassSubject_id, 'section_id' => $request->secid, 'mcq_type' => $value->mcq_type,'question_name' => $value->question, 'c1' => $value->c1, 'c2' => $value->c2, 'c3' => $value->c3, 'option_no_1' => $value->option1, 'option_no_2' => $value->option2, 'option_no_3' => $value->option3, 'option_no_4' => $value->option4, 'correct_answer' => $value->answer];

                    DB::table('normal_exam_questions')->insert($question);
                }
                else{                    
                    $question = ['classsubject_id' => $sections->ClassSubject_id, 'section_id' => $request->secid, 'mcq_type' => $value->mcq_type,'question_name' => $value->question, 'option_no_1' => $value->option1, 'option_no_2' => $value->option2, 'option_no_3' => $value->option3, 'option_no_4' => $value->option4, 'correct_answer' => $value->answer];
                    DB::table('normal_exam_questions')->insert($question);
                }
            }
            if(!empty($question))
            {
                echo $destinationpath;   
                \File::delete($destinationpath);
            }
        }
        elseif ($request->advancedata) {
            
            $token =  $this->Token(10);
            foreach ($request->advancedata as $key => $data) {

                if ($data['selecttype'] == 'Normal') {
                    $mcq_type = 1;
                }
                else{
                    $mcq_type = 2;
                }

                $question = new NormalExamQuestion();
                $question->classsubject_id = $sections->ClassSubject_id;
                $question->section_id = $request->secid;
                $question->parent_id = $token;
                $question->paragraph = $request->paragraph;
                $question->question_name = $data['question'];
                $question->mcq_type = $mcq_type;


                if($mcq_type == 2) {
                    $question->c1 = $data['question1'];
                    $question->c2 = $data['question2'];
                    $question->c3 = $data['question3']; 
                }

                $question->option_no_1 = $data['option1'];
                $question->option_no_2 = $data['option2'];
                $question->option_no_3 = $data['option3'];
                $question->option_no_4 = $data['option4'];

                if ($data['correctans'] == 'option 1') {
                    $question->correct_answer = $data['option1'];
                }
                elseif ($data['correctans'] == 'option 2') {
                    $question->correct_answer = $data['option2'];
                }
                elseif ($data['correctans'] == 'option 3') {
                    $question->correct_answer = $data['option3'];
                }
                elseif ($data['correctans'] == 'option 4') {
                    $question->correct_answer = $data['option4'];
                }
                $question->save();
            }
        }
        else{
            $question = new NormalExamQuestion();
            $question->classsubject_id = $sections->ClassSubject_id;
            $question->section_id = $request->secid;
            $question->question_name = $request->question;
            $question->mcq_type = $request->mcq_type;

            if($request->mcq_type == 2) {
                $question->c1 = $request->question1;
                $question->c2 = $request->question2;
                $question->c3 = $request->question3; 
            }
            $question->option_no_1 = $request->option1;
            $question->option_no_2 = $request->option2;
            $question->option_no_3 = $request->option3;
            $question->option_no_4 = $request->option4;
            $question->correct_answer = $request->correct;
            $question->save();
        }

        return Response()->json($question,200);

    }

    /* Edit MCQ Question */
    public function mcqeditquestion(Request $request)
    {

        $question = NormalExamQuestion::find($request->id);
        $question->question_name = $request->question;
        $question->option_no_1 = $request->option1;
        $question->option_no_2 = $request->option2;
        $question->option_no_3 = $request->option3;
        $question->option_no_4 = $request->option4;
        $question->correct_answer = $request->correct;

        $question->save();
        
        return Response()->json($question,200);

    }

    /* Delete MCQ Question */
    public function mcqdeletequestion(Request $request)
    {
        $question = NormalExamQuestion::find($request->id);
        $question->delete();
        return Response()->json($question,200);
    }

    /* Get Filter MCQ Question */
    public function mcqgetfilterquestion(Request $request)
    {
        $classsubject = ClassSubject::find($request->ClsSubid);
        $class = Classes::find($classsubject->class_id);

        if ($class->type == 'madrasha') {            
            $madclass = Classes::where('class','=',$class->class)->first();
            $mcid = $madclass->id; 
            $madclasssubject =  $classsubject = ClassSubject::where([
                ['class_id', '=', $mcid],
                ['subject_id', '=', $classsubject->subject_id]
            ])->first();
        
            if ($madclasssubject) {
                $question = DB::table('sections')
                ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->join('normal_exam_questions', 'normal_exam_questions.section_id', '=', 'sections.id')
                ->where([
                    ['sections.ClassSubject_id', '=', $madclasssubject->id],
                    ['sections.id', '=', $request->secid],
                ])
                ->orderBy('normal_exam_questions.created_at', 'asc')
                ->take($request->data)
                ->get();        
            }
            else{
                $question = DB::table('sections')
                ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->join('normal_exam_questions', 'normal_exam_questions.section_id', '=', 'sections.id')
                ->where([
                    ['sections.ClassSubject_id', '=', $request->ClsSubid],
                    ['sections.id', '=', $request->secid],
                ])
                ->orderBy('normal_exam_questions.created_at', 'asc')
                ->take($request->data)
                ->get();
            }

        }
        else{
            $question = DB::table('sections')
            ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
            ->join('normal_exam_questions', 'normal_exam_questions.section_id', '=', 'sections.id')
            ->where([
                ['sections.ClassSubject_id', '=', $request->ClsSubid],
                ['sections.id', '=', $request->secid],
            ])
            ->orderBy('normal_exam_questions.created_at', 'asc')
            ->take($request->data)
            ->get();
        }

        return Response()->json($question,200);
    }

    /* Get Search MCQ Question */
    public function mcqgetsearchquestion(Request $request)
    {   
        $search = $request->data; 

        $classsubject = ClassSubject::find($request->ClsSubid);
        $class = Classes::find($classsubject->class_id);

        if ($class->type == 'madrasha') {            
            $madclass = Classes::where('class','=',$class->class)->first();
            $mcid = $madclass->id; 
            $madclasssubject =  $classsubject = ClassSubject::where([
                ['class_id', '=', $mcid],
                ['subject_id', '=', $classsubject->subject_id]
            ])->first();
            
            if ($madclasssubject) {
                $question = DB::table('sections')
                ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->join('normal_exam_questions', 'normal_exam_questions.section_id', '=', 'sections.id')
                ->where([
                    ['sections.ClassSubject_id', '=', $madclasssubject->id],
                    ['sections.id', '=', $request->secid],
                ])
                ->where('question_name','LIKE',"%{$search}%")
                ->orderBy('normal_exam_questions.created_at', 'asc')
                ->get();
            }
            else{
                $question = DB::table('sections')
                ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->join('normal_exam_questions', 'normal_exam_questions.section_id', '=', 'sections.id')
                ->where([
                    ['sections.ClassSubject_id', '=', $request->ClsSubid],
                    ['sections.id', '=', $request->secid],
                ])
                ->where('question_name','LIKE',"%{$search}%")
                ->orderBy('normal_exam_questions.created_at', 'asc')
                ->get(); 
            }

        }
        else{

            $question = DB::table('sections')
            ->join('classsubject', 'classsubject.id', '=', 'sections.ClassSubject_id')
            ->join('normal_exam_questions', 'normal_exam_questions.section_id', '=', 'sections.id')
            ->where([
                ['sections.ClassSubject_id', '=', $request->ClsSubid],
                ['sections.id', '=', $request->secid],
            ])
            ->where('question_name','LIKE',"%{$search}%")
            ->orderBy('normal_exam_questions.created_at', 'asc')
            ->get();
        }
           
        return Response()->json($question,200);
    }

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