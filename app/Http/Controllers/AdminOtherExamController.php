<?php

namespace App\Http\Controllers;

use App\Board;
use App\BoardExamination;
use App\BoardQuestion;
use App\ClassSubject;
use App\McqQuestion;
use App\NormalExamQuestion;
use App\Section;
use App\TestQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOtherExamController extends Controller
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

    /* Get Question */
    public function getquestion(Request $request)
    {
        $question = DB::table('classsubject')
        ->join('normal_exam_questions', 'normal_exam_questions.classsubject_id', '=', 'classsubject.id')
        ->where([
            ['normal_exam_questions.classsubject_id', '=', $request->ClsSubid]
        ])
        ->orderBy('normal_exam_questions.created_at', 'desc')
        ->get();

        return Response()->json($question,200);
    }


    /* Add Question */
    public function addquestion(Request $request)
    {
        if($request->file){

            $exploded = explode(',',$request->file);
            $decode = base64_decode($exploded[1]);
            $ext ='xlsx';

            $filename = str_random().'.'.$ext;
            $destinationpath =  public_path().'/upload/'.$filename;
            $image = file_put_contents($destinationpath, $decode);


            $data = \Excel::load($destinationpath)->get();

            foreach ($data as $key => $value) {
                $question[] = ['classsubject_id' => $request->clasubid,'mcq_type' => $request->mcq_type,'question_name' => $value->question, 'option_no_1' => $value->option1, 'option_no_2' => $value->option2, 'option_no_3' => $value->option3, 'option_no_4' => $value->option4, 'correct_answer' => $value->answer];
            }
            if(!empty($question))
            {
                echo $destinationpath;
                DB::table('normal_exam_questions')->insert($question);
                \File::delete($destinationpath);
            }
        }
        else{
            $question = new NormalExamQuestion();
            $question->classsubject_id = $request->clasubid;
            $question->question_name = $request->question;
            $question->mcq_type = $request->mcq_type;

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

    /* Get Filter MCQ Question */
    public function getfilterquestion(Request $request)
    {
        $question = DB::table('classsubject')
        ->join('normal_exam_questions', 'normal_exam_questions.classsubject_id', '=', 'classsubject.id')
        ->where([
            ['normal_exam_questions.classsubject_id', '=', $request->ClsSubid]
        ])
        ->orderBy('normal_exam_questions.created_at', 'asc')
        ->take($request->data)
        ->get();

        return Response()->json($question,200);
    }

    /* Get Search MCQ Question */
    public function getsearchquestion(Request $request)
    {   
        $search = $request->data; 

        $question = DB::table('classsubject')
        ->join('normal_exam_questions', 'normal_exam_questions.classsubject_id', '=', 'classsubject.id')
        ->where([
            ['normal_exam_questions.classsubject_id', '=', $request->ClsSubid]
        ])
        ->where('question_name','LIKE',"%{$search}%")
        ->orderBy('normal_exam_questions.created_at', 'asc')
        ->get();

        return Response()->json($question,200);
    }




}