<?php

namespace App\Http\Controllers;

use App\Board;
use App\BoardExamination;
use App\BoardQuestion;
use App\ClassSubject;
use App\Classes;
use App\NormalExamQuestion;
use App\Subject;
use App\UniversityQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminUniversityQuestionController extends Controller
{
	/* Get University list */
    public function getAlluniversity(Request $request)
    {	
        $university = Classes::where('type','=','university')->get();
        return Response()->json($university,200);
    }

    /* Get Exam all Subject */
    public function getAllSubject(Request $request)
    {   

        $class =  Classes::where('class','=',$request->id)->first();


        $subjects = DB::table('subjects')
         ->join('classsubject', 'classsubject.subject_id', '=', 'subjects.id')
         ->where('classsubject.class_id', '=' , $class->id)
         ->get();
        return Response()->json(array('subjects'=>$subjects));
    
    }

    /* Get University Question */
    public function getquestion(Request $request)
    {
        $class =  Classes::where('class','=',$request->university)->first();

        $question = DB::table('classsubject')
        ->join('normal_exam_questions', 'normal_exam_questions.classsubject_id', '=', 'classsubject.id')
        ->where([
            ['normal_exam_questions.classsubject_id', '=', $request->clasubid]
        ])
        ->orderBy('normal_exam_questions.created_at', 'desc')
        ->paginate(20);

        $total = DB::table('classsubject')
        ->join('normal_exam_questions', 'normal_exam_questions.classsubject_id', '=', 'classsubject.id')
        ->where([
            ['normal_exam_questions.classsubject_id', '=', $request->clasubid]
        ])
        ->count();


        return Response()->json(array('question'=>$question,'total'=>$total));
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
                $question[] = ['classsubject_id' => $request->clasubid,'mcq_type' => $request->mcq_type,'pexam' => '2016', 'question_name' => $value->question, 'option_no_1' => $value->option1, 'option_no_2' => $value->option2, 'option_no_3' => $value->option3, 'option_no_4' => $value->option4, 'correct_answer' => $value->answer];
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
            $question->pexam = $request->pexam;

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
        $question->pexam = $request->pexam;

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
            ['normal_exam_questions.classsubject_id', '=', $request->clasubid]
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
            ['normal_exam_questions.classsubject_id', '=', $request->clasubid]
        ])
        ->where('question_name','LIKE',"%{$search}%")
        ->orderBy('normal_exam_questions.created_at', 'asc')
        ->get();

        return Response()->json($question,200);
    }



}