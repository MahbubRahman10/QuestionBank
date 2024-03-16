<?php

namespace App\Http\Controllers;

use App\NormalExamQuestion;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Delete Duplicate Data
    // public function index()
    // {
    // 	$questions = DB::table('classsubject')
    // 	->join('normal_exam_questions', 'normal_exam_questions.classsubject_id', '=', 'classsubject.id')
    // 	->where([
    // 		['normal_exam_questions.classsubject_id', '=', '78']
    // 	])
    // 	->get();
    // 	// dd($questions);
    // 	// dd($questions->unique('question_name'));
    // 	$a = array();
    // 	$b = array();
    // 	foreach ($questions as $key => $question) {
    // 		if(in_array($question->question_name, $a) == true){
    // 			array_push($b,$question->id);
    // 		}
    // 		else{
    // 			array_push($a,$question->question_name);
    // 		}
    // 	}
    // 	for ($i=0; $i <count($b) ; $i++) { 
    // 		$u = NormalExamQuestion::find($b[$i]);
    // 		$u->delete();
    // 	}	
    // }





    // public function space()
    // {
    // 	$questions = NormalExamQuestion::all();
    // 	foreach ($questions as $key => $question) {
    // 		$data  = NormalExamQuestion::find($question->id);
    // 		$data->question_name = rtrim($data->question_name);
    // 		$data->option_no_1 = rtrim($data->option_no_1);
    // 		$data->option_no_2 = rtrim($data->option_no_2);
    // 		$data->option_no_3 = rtrim($data->option_no_3);
    // 		$data->option_no_4 = rtrim($data->option_no_4);
    // 		$data->save();
    		

    // 	}
    // }








}
