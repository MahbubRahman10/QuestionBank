<?php

namespace App\Http\Controllers;

use App\Board;
use App\Classes;
use App\Examination;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class IndexController extends BaseController
{

    public function questiondetails($category, $id)
    {
        $subjects = DB::table('classes')
        ->join('classsubject', 'classsubject.class_id', '=', 'classes.id')
        ->join('subjects', 'subjects.id', '=', 'classsubject.subject_id')
        ->where('classes.type', '=' , $category)
        ->where('classes.id', '=' , $id)
        ->get();

        if ($subjects == null) {
            return view('errors.404');
        }

        if ($id == '1') { $class = "Class VI"; } elseif ($id == '2') { $class = "Class VII"; } elseif ($id == '3') { $class = "Class VIII"; } elseif ($id == '4') { $class = "Class IX - X"; } elseif ($id == '6') { $class = "Class VI"; } elseif ($id == '7') { $class = "Class VII"; } elseif ($id == '8') { $class = "Class VIII"; } elseif ($id == '4') { $class = "Class IX - X"; }

        $classes = Classes::find($id);

        return view('view.viewdetailsquestion')->with('subject',$subjects)->with('class',$class)->with('classes',$classes);
    }

    // School Category
    public function schoolcategory()
    {
    	$subjects = DB::table('classes')
    	->join('classsubject', 'classsubject.class_id', '=', 'classes.id')
    	->join('subjects', 'subjects.id', '=', 'classsubject.subject_id')
    	->where('classes.type', '=' , 'school')
    	->get();

    	return view('QuestionCategory.school')->with('subject',$subjects);
    }

    // Madrasha Category
    public function madrashacategory()
    {
    	$subjects = DB::table('classes')
    	->join('classsubject', 'classsubject.class_id', '=', 'classes.id')
    	->join('subjects', 'subjects.id', '=', 'classsubject.subject_id')
    	->where('classes.type', '=' , 'madrasha')
    	->get();

    	return view('QuestionCategory.madrasha')->with('subject',$subjects);
    }

    // Madrasha Category
    public function boardcategory()
    {
        $board = Board::all();
        $exam = Examination::all();

        return view('QuestionCategory.board', compact(['board','exam']));
    }

    // // Madrasha Category
    // public function testcategory()
    // {
    //     $board = Board::all();
    //     $exam = Examination::all();

    //     return view('QuestionCategory.test', compact(['board','exam']));
    // }

}
