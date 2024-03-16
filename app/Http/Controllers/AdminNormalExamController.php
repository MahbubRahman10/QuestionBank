<?php

namespace App\Http\Controllers;

use App\Board;
use App\BoardExamination;
use App\BoardQuestion;
use App\ClassSubject;
use App\Classes;
use App\NormalExamQuestion;
use App\Section;
use App\TestQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminNormalExamController extends Controller
{
	
    /* Get Exam all Subject */
    public function getAllSubject(Request $request)
    {   

     $subjects = DB::table('subjects')
     ->join('classsubject', 'classsubject.subject_id', '=', 'subjects.id')
     ->where('classsubject.class_id', '=' , $request->id)
     ->get();
     return Response()->json($subjects,200);
    
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

    /* Get Question */
    public function getquestion(Request $request)
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
                ->orderBy('normal_exam_questions.created_at', 'desc')
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
            ->orderBy('normal_exam_questions.created_at', 'desc')
            ->get();
        }     
       

        return Response()->json($question,200);
    }

    /* Add Question */
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


    /* Edit Question */
    public function editquestion(Request $request)
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


    /* Delete Question */
    public function deletequestion(Request $request)
    {
        $question = NormalExamQuestion::find($request->id);
        $question->delete();
        return Response()->json($question,200);
    }

    /* Get Filter Question */
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

    /* Get Search Question */
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




}