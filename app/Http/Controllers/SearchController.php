<?php

namespace App\Http\Controllers;

use App\Board;
use App\BoardQuestion;
use App\ClassSubject;
use App\CreativeQuestion;
use App\Examination;
use App\Forum;
use App\McqQuestion;
use App\NormalExamQuestion;
use App\QuestionSolution;
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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Session;


class SearchController extends BaseController
{
    public function search(Request $request)
    {

        $search = $request->search;

        $questionarchives = null;
        $boardquestions = null;
        $blogs = null; 
        $forums = null;
        $searchvalue = null;
        $categoryvalue = null;


        if ($search == null) {
            return view('search.index',compact(['search','searchvalue','categoryvalue']));
        }

        if ($request->category == null) {
            $questionarchives = QuestionSolution::where('category','LIKE',"%{$search}%")->orWhere('title','LIKE',"%{$search}%")->get();

            $boardquestions = DB::table('examinations')
            ->join('board_examinations','board_examinations.examination_id','=','examinations.id')
            ->join('boards','boards.id','=','board_examinations.board_id')
            ->join('board_questions','board_questions.board_examinations_id','=','board_examinations.id')
            ->where('examinations.exam_name','LIKE',"%{$search}%")
            ->orwhere('boards.board_name','LIKE',"%{$search}%")
            ->get();
            

            $blogs = DB::table('tagging_tagged')
            ->join('blogs', 'blogs.id', '=', 'tagging_tagged.taggable_id')
            ->where('blogs.title','LIKE',"%{$search}%")
            ->orwhere('tagging_tagged.taggable_id','LIKE',"%{$search}%")
            ->get();

            $blogs = $blogs->unique('id');

            $forums  = Forum::where('category','LIKE',"%{$search}%")->orWhere('title','LIKE',"%{$search}%")->get();

        }
        else{
           if ($request->category == 'board') {
             $boardquestions = DB::table('examinations')
             ->join('board_examinations','board_examinations.examination_id','=','examinations.id')
             ->join('boards','boards.id','=','board_examinations.board_id')
             ->join('board_questions','board_questions.board_examinations_id','=','board_examinations.id')
             ->join('tagging_tagged','tagging_tagged.taggable_id','=','board_questions.id')
             ->where([['tagging_tagged.taggable_type','=','App\BoardQuestion'],['examinations.exam_name','LIKE',"%{$search}%"]])
             ->orwhere([['tagging_tagged.taggable_type','=','App\BoardQuestion'],['boards.board_name','LIKE',"%{$search}%"]])
             ->orwhere([['tagging_tagged.taggable_type','=','App\BoardQuestion'],['tagging_tagged.tag_name','LIKE',"%{$search}%"]])
             ->get();

             $boardquestions = $boardquestions->unique('taggable_id');

            }
            elseif ($request->category == 'bcs') {
               
             $questionarchives = DB::table('questionsolutions')
             ->join('tagging_tagged','tagging_tagged.taggable_id','=','questionsolutions.id')
             ->where([['questionsolutions.category','=','bcs'],['tagging_tagged.taggable_type','=','App\Questionsolution'],['questionsolutions.title','LIKE',"%{$search}%"]])
             ->orwhere([['questionsolutions.category','=','bcs'],['tagging_tagged.taggable_type','=','App\Questionsolution'],['questionsolutions.year','LIKE',"%{$search}%"]])
             ->orwhere([['questionsolutions.category','=','bcs'],['tagging_tagged.taggable_type','=','App\Questionsolution'],['tagging_tagged.tag_name','LIKE',"%{$search}%"]])
             ->get();

             $questionarchives = $questionarchives->unique('taggable_id');

            }
            elseif ($request->category == 'teacher') {
             
               $questionarchives = DB::table('questionsolutions')
               ->join('tagging_tagged','tagging_tagged.taggable_id','=','questionsolutions.id')
               ->where([['questionsolutions.category','=','teacher'],['tagging_tagged.taggable_type','=','App\Questionsolution'],['questionsolutions.title','LIKE',"%{$search}%"]])
               ->orwhere([['questionsolutions.category','=','teacher'],['tagging_tagged.taggable_type','=','App\Questionsolution'],['questionsolutions.year','LIKE',"%{$search}%"]])
               ->orwhere([['questionsolutions.category','=','teacher'],['tagging_tagged.taggable_type','=','App\Questionsolution'],['tagging_tagged.tag_name','LIKE',"%{$search}%"]])
               ->get();

               $questionarchives = $questionarchives->unique('taggable_id');


            }
            elseif ($request->category == 'university') {
                $questionarchives = DB::table('questionsolutions')
                ->join('tagging_tagged','tagging_tagged.taggable_id','=','questionsolutions.id')
                ->where([['questionsolutions.category','=','university'],['tagging_tagged.taggable_type','=','App\Questionsolution'],['questionsolutions.title','LIKE',"%{$search}%"]])
                ->orwhere([['questionsolutions.category','=','university'],['tagging_tagged.taggable_type','=','App\Questionsolution'],['questionsolutions.year','LIKE',"%{$search}%"]])
                ->orwhere([['questionsolutions.category','=','university'],['tagging_tagged.taggable_type','=','App\Questionsolution'],['tagging_tagged.tag_name','LIKE',"%{$search}%"]])
                ->get();

                $questionarchives = $questionarchives->unique('taggable_id');
               

            }
            elseif ($request->category == 'bank') {
               $questionarchives = DB::table('questionsolutions')
               ->join('tagging_tagged','tagging_tagged.taggable_id','=','questionsolutions.id')
               ->where([['questionsolutions.category','=','bank'],['tagging_tagged.taggable_type','=','App\Questionsolution'],['questionsolutions.title','LIKE',"%{$search}%"]])
               ->orwhere([['questionsolutions.category','=','bank'],['tagging_tagged.taggable_type','=','App\Questionsolution'],['questionsolutions.year','LIKE',"%{$search}%"]])
               ->orwhere([['questionsolutions.category','=','bank'],['tagging_tagged.taggable_type','=','App\Questionsolution'],['tagging_tagged.tag_name','LIKE',"%{$search}%"]])
               ->get();

               $questionarchives = $questionarchives->unique('taggable_id');
            }
            elseif ($request->category == 'blog') {
               $blogs = DB::table('tagging_tagged')
               ->join('blogs', 'blogs.id', '=', 'tagging_tagged.taggable_id')
               ->where('blogs.title','LIKE',"%{$search}%")
               ->orwhere('tagging_tagged.tag_name','LIKE',"%{$search}%")
               ->get();

               $blogs = $blogs->unique('id');

            }
            elseif ($request->category == 'forum') {
                $forums  = Forum::where('category','LIKE',"%{$search}%")->orWhere('title','LIKE',"%{$search}%")->get();
            }

            $searchvalue = $request->search;
            $categoryvalue = $request->category;
        }

        return view('search.index',compact(['search','questionarchives','boardquestions','blogs','forums','searchvalue','categoryvalue']));





    }
}