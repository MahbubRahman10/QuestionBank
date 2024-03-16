<?php

namespace App\Http\Controllers;

use App\Board;
use App\BoardExamination;
use App\BoardQuestion;
use App\ClassSubject;
use App\NormalExamQuestion;
use App\Section;
use App\TestQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOtherQuestionController extends Controller
{
	
    public function index($id)
    {   

        if ($id == 'req') {
            $id = null;
        }

        $mcq = DB::table('normal_exam_questions')
        ->join('classsubject', 'classsubject.id', '=', 'normal_exam_questions.classsubject_id')
        ->join('classes', 'classes.id', '=', 'classsubject.class_id')
        ->where('classes.type', '=' , 'school')
        ->count();

        $subject = DB::table('classes')
        ->join('classsubject', 'classsubject.class_id', '=', 'classes.id')
        ->where('classes.type', '=' , $id)
        ->count();
        
        return Response()->json(array('mcq'=>$mcq,'subject'=>$subject));

    }

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
        ->paginate(20);

        $total = DB::table('classsubject')
        ->join('normal_exam_questions', 'normal_exam_questions.classsubject_id', '=', 'classsubject.id')
        ->where([
            ['normal_exam_questions.classsubject_id', '=', $request->ClsSubid]
        ])
        ->orderBy('normal_exam_questions.created_at', 'desc')
        ->count();

        return Response()->json(array('total'=>$total,'question'=>$question));
    }


    /* Add Question */
    public function addquestion(Request $request)
    {

        if ($request->file) {
        $exploded = explode(',',$request->file);
        $decode = base64_decode($exploded[1]);
        $ext ='xlsx';

        $filename = str_random().'.'.$ext;
        $destinationpath =  public_path().'/upload/'.$filename;
        $image = file_put_contents($destinationpath, $decode);


            // $files = $request->file;
            // $destinationPath = 'upload/supplier';
            // $filename = $files->getClientOriginalName();
            // $destinationpath = $files->move($destinationPath, $filename);


            $data = \Excel::load($destinationpath)->get();



            foreach ($data as $key => $value) {

                if($value->question != null){
                $question = new NormalExamQuestion();
                $question->classsubject_id = $request->clasubid;
                $question->mcq_type = $request->mcq_type;
                $question->question_name = $value->question;
                $question->option_no_1 = rtrim($value->option1);
                $question->option_no_2 = rtrim($value->option2);
                $question->option_no_3 = rtrim($value->option3);
                $question->option_no_4 = rtrim($value->option4);
                $question->correct_answer = rtrim($value->answer);
                // $question->pexam = str_replace(' ', '', $value->pexam);
                $question->save();
                
                    // $question[] = ['classsubject_id' => $request->clasubid,'mcq_type' => $request->mcq_type, 'question_name' => $value->question, 'option_no_1' => str_replace(' ', '', $value->option1), 'option_no_2' => str_replace(' ', '', $value->option2), 'option_no_3' => str_replace(' ', '', $value->option3), 'option_no_4' => str_replace(' ', '', $value->option4), 'correct_answer' => str_replace(' ', '', $value->answer)];
                }
            }
            // if(!empty($question))
            // {
               // echo $destinationpath;
               //  DB::table('normal_exam_questions')->insert($question);
                \File::delete($destinationpath);
            // }
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
            $question->correct_answer = $request->answer;
            $question->pexam = $request->pexam;

            $question->save();

            return Response()->json($question,200);
        }

    }  


    /* Edit Question */
    public function editquestion(Request $request)
    {

        $question = NormalExamQuestion::find($request->id);

        $dataquestions = NormalExamQuestion::where('question_name','=',strip_tags($question->question_name))->get();


        $question->question_name = $request->question;
        $question->option_no_1 = $request->option1;
        $question->option_no_2 = $request->option2;
        $question->option_no_3 = $request->option3;
        $question->option_no_4 = $request->option4;
        $question->correct_answer = $request->correct;
        $question->pexam = $request->pexam;

        $question->save();


        foreach ($dataquestions as $key => $dataquestion) {
            $data  = NormalExamQuestion::find($dataquestion->id);
            $data->question_name = $question->question_name;
            $data->option_no_1 = $question->option_no_1;
            $data->option_no_2 = $question->option_no_2;
            $data->option_no_3 = $question->option_no_3;
            $data->option_no_4 = $question->option_no_4;
            $data->correct_answer = $question->correct_answer;
            $data->save();            
        }

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