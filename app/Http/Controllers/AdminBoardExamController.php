<?php

namespace App\Http\Controllers;

use App\Board;
use App\BoardExamQuestion;
use App\BoardQuestion;
use App\ClassSubject;
use App\Section;
use App\TestQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminBoardExamController extends Controller
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
        $sections = DB::table('classsubject')
        ->join('sections', 'classsubject.id', '=', 'sections.ClassSubject_id')
        ->where([
            ['sections.ClassSubject_id', '=', $request->sid],
            ['classsubject.class_id', '=', $request->cid]
        ])
        ->get();

        return Response()->json(array('sections'=>$sections,'post'=>$sections));
    }


    /* Get Question */
    public function getquestion(Request $request)
    {
        $classsubject = ClassSubject::find($request->ClsSubid);

        $question = DB::table('sections')
        ->join('board_exam_questions', 'board_exam_questions.section_id', '=', 'sections.id')
        ->where([
            ['board_exam_questions.subject_id', '=', $classsubject->subject_id],
            ['sections.id', '=', $request->secid],
        ])
        ->orderBy('board_exam_questions.created_at', 'desc')
        ->get();

        return Response()->json($question,200);
    }


    /* Add Question */
    public function addquestion(Request $request)
    {
        $sections = Section::find($request->secid); //Sec id

        $classsubject = ClassSubject::find($sections->ClassSubject_id); //Sub id


        $question = new BoardExamQuestion();
        $question->examination_id = $request->eid;
        $question->subject_id = $classsubject->subject_id;
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

       return Response()->json($question,200);

    }  


    /* Edit Question */
    public function editquestion(Request $request)
    {

        $question = BoardExamQuestion::find($request->id);
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
        $question = BoardExamQuestion::find($request->id);
        $question->delete();
        return Response()->json($question,200);
    }

    /* Get Filter MCQ Question */
    public function getfilterquestion(Request $request)
    {
        $classsubject = ClassSubject::find($request->ClsSubid);

        $question = DB::table('sections')
        ->join('board_exam_questions', 'board_exam_questions.section_id', '=', 'sections.id')
        ->where([
            ['board_exam_questions.subject_id', '=', $classsubject->subject_id],
            ['sections.id', '=', $request->secid],
        ])
        ->orderBy('board_exam_questions.created_at', 'asc')
        ->take($request->data)
        ->get();

        return Response()->json($question,200);
    }

    /* Get Search MCQ Question */
    public function getsearchquestion(Request $request)
    {   
        $search = $request->data; 

        $classsubject = ClassSubject::find($request->ClsSubid);

        $question = DB::table('sections')
        ->join('board_exam_questions', 'board_exam_questions.section_id', '=', 'sections.id')
        ->where([
            ['board_exam_questions.subject_id', '=', $classsubject->subject_id],
            ['sections.id', '=', $request->secid],
        ])
        ->where('question_name','LIKE',"%{$search}%")
        ->orderBy('board_exam_questions.created_at', 'asc')
        ->get();

        return Response()->json($question,200);
    }




}