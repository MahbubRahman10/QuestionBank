<?php

namespace App\Http\Controllers;

use App\Board;
use App\BoardExamination;
use App\BoardQuestion;
use App\ClassSubject;
use App\Subject;
use App\Examination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminBoardQuestionController extends Controller
{

       public function index()
       {   
        $questions = DB::table('board_questions')
        ->count();

        $item = array();
        $totals = array();
        $backcolors = array();
        $hovcolors = array();

        $j=DB::table('board_questions')
        ->join('board_examinations', 'board_examinations.id', '=', 'board_questions.board_examinations_id')
        ->join('boards', 'boards.id', '=', 'board_examinations.board_id')
        ->select(DB::raw('boards.board_name as name'), DB::raw('count(question) as total'))
        ->groupBy('name')
        ->get();


        $result = count($j);

        for ($i=0; $i <$result; $i++) { 
            $items[$i]=$j[$i]->name;
            $totals[$i]=$j[$i]->total;
            $backcolors[$i]='#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            $hovcolors[$i]='#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        }


        // $response = [
        //     'backcolor' => $backcolors,
        //     'hovcolor' => $hovcolors,
        //     'label' => $items,
        //     'data'  => $totals 
        // ];

        return Response()->json(array('questions'=>$questions, 'totals'=>$totals, 'label'=>$items, 'backcolors'=>$backcolors, 'hovcolors'=>$hovcolors));

    }

    // Get Tag
    public function gettags(Request $request)
    {
      $boardquestion = DB::table('tagging_tagged')
      ->where([['taggable_type','=','App\BoardQuestion'],['taggable_id','=',$request->id]])
      ->get();

      return Response()->json($boardquestion);
    }

	/* Get Board list */
    public function getallboard(Request $request)
    {	
        $boards = Board::all();
        return Response()->json($boards,200);
    }

    /* Get Exam all Subject */
    public function getAllSubject(Request $request)
    {   

     $subjects = DB::table('subjects')
     ->join('classsubject', 'classsubject.subject_id', '=', 'subjects.id')
     ->where('classsubject.class_id', '=' , $request->id)
     ->get();
     return Response()->json(array('subjects'=>$subjects));
    
    }

    /* Get Board Question */
    public function getquestion(Request $request)
    {
       
    	$board = Board::where('board_name', $request->board)->first();
    	$exam  = $request->exam;

        $subject = ClassSubject::find($request->subjectid);
        $board_exam = DB::table('board_examinations')
        ->where([
            ['board_id', '=', $board->id],
            ['examination_id','=', $exam]
        ])->first();

        $question = DB::table('board_questions')
        ->where([
            ['subject_id', '=', $subject->subject_id],
            ['board_examinations_id','=', $board_exam->id]
        ])->paginate(20);

        $total = DB::table('board_questions')
        ->where([
            ['subject_id', '=', $subject->subject_id],
            ['board_examinations_id','=', $board_exam->id]
        ])->count();

        return Response()->json(array('question'=>$question,'total'=>$total));
    }

    /* Add Board Question */
    public function addquestion(Request $request)
    {
        $subject = ClassSubject::find($request->subjectid);
        // Get Jsc Question
        
        $board = Board::where('board_name', $request->board)->first();
        $exam  = $request->exam;

        $examination = Examination::find($exam);
		        

        $getsubjects = Subject::find($subject->subject_id);

        $board_exam = DB::table('board_examinations')
        ->where([
            ['board_id', '=', $board->id],
            ['examination_id','=', $exam]
        ])->first();

        $question = new BoardQuestion();

        $question->subject_id = $subject->subject_id;        
        $question->board_examinations_id = $board_exam->id;
 
        $exploded = explode(',',$request->question);
        $decode = base64_decode($exploded[1]);
        $ext ='pdf';

        $type = $request->type;

        if($board->board_name == 'Dhaka Board'){ 
        	$bname = "ঢাকা বোর্ড";
        }
        elseif($board->board_name == 'Chittagong Board'){
        	$bname = "চট্রগ্রাম বোর্ড";
        }elseif($board->board_name == 'Rajshahi Board') {
        	$bname = "রাজশাহী বোর্ড"; 
        }elseif($board->board_name == 'Sylhet Board'){
        	$bname = "সিলেট বোর্ড"; 
        }elseif($board->board_name == 'Dinajpur Board'){ 
        	$bname="দিনাজপুর বোর্ড"; 
        }elseif($board->board_name == 'Comilla Board'){ 
        	$bname="কুমিল্লা বোর্ড"; 
        }elseif($board->board_name == 'Jessore Board'){ 
        	$bname="যশোর বোর্ড"; 
        }
        elseif ($board->board_name == 'Jessore Board') {
        	$bname="বরিশাল বোর্ড"; 
        }elseif($board->board_name == 'Madrasah Board'){ 
        	$bname="মাদ্রাসা বোর্ড";
        }

        if($examination->exam_name == 'JSC'){
        	$ename = "জেএসসি";
        }elseif($examination->exam_name == 'SSC'){ 
        	$ename = "এসএসসি ";
        }elseif($examination->exam_name == 'HSC'){
        	$ename = "এইচএসসি";
        }elseif($examination->exam_name == 'JDC'){
        	$ename = "জেডিসি";
        }
        elseif($examination->exam_name == 'DAKHIL'){
        	$ename = "দাখিল";
        }elseif($examination->exam_name == 'ALIM'){
        	$ename = "আলিম";
        }


        $filename = $bname.' '.$ename.' '.$type.' - '.$request->year.'.'.$ext;

        //$f1 = 'BoardQuestion-'.$filename;


        $destinationpath =  public_path().'/BoardQuestion/'.$filename;
        $boardquestion = file_put_contents($destinationpath, $decode);
       
        $question->question = $filename;
        $question->subject_name = $request->type;
        $question->year = $request->year;

        $question->save();

        if ($request->tags != null) {
        foreach ($request->tags as $key => $value) {
          DB::table('tagging_tagged')->insert(
            ['taggable_id' => $question->id, 'taggable_type' => 'App\BoardQuestion', 'tag_name' => $value['text'], 'tag_slug' => $value['text']]
          );
        }
      }
        
        return Response()->json($question,200);

    }

     /* Edit Creative Question */
    public function editquestion(Request $request)
    {

        $question = BoardQuestion::find($request->id);

        if ($request->question) {
        	$boardexamination = BoardExamination::find($question->board_examinations_id);
        	$board = Board::find($boardexamination->board_id);
        	$examination = Examination::find($boardexamination->examination_id);

        	$exploded = explode(',',$request->question);
        	$decode = base64_decode($exploded[1]);
        	$ext ='pdf';

        	$type = $request->type;

        	if($board->board_name == 'Dhaka Board'){ 
        		$bname = "ঢাকা বোর্ড";
        	}
        	elseif($board->board_name == 'Chittagong Board'){
        		$bname = "চট্রগ্রাম বোর্ড";
        	}elseif($board->board_name == 'Rajshahi Board') {
        		$bname = "রাজশাহী বোর্ড"; 
        	}elseif($board->board_name == 'Sylhet Board'){
        		$bname = "সিলেট বোর্ড"; 
        	}elseif($board->board_name == 'Dinajpur Board'){ 
        		$bname="দিনাজপুর বোর্ড"; 
        	}elseif($board->board_name == 'Comilla Board'){ 
        		$bname="কুমিল্লা বোর্ড"; 
        	}elseif($board->board_name == 'Jessore Board'){ 
        		$bname="যশোর বোর্ড"; 
        	}
        	elseif ($board->board_name == 'Jessore Board') {
        		$bname="বরিশাল বোর্ড"; 
        	}elseif($board->board_name == 'Madrasah Board'){ 
        		$bname="মাদ্রাসা বোর্ড";
        	}

        	if($examination->exam_name == 'JSC'){
        		$ename = "জেএসসি";
        	}elseif($examination->exam_name == 'SSC'){ 
        		$ename = "এসএসসি ";
        	}elseif($examination->exam_name == 'HSC'){
        		$ename = "এইচএসসি";
        	}elseif($examination->exam_name == 'JDC'){
        		$ename = "জেডিসি";
        	}
        	elseif($examination->exam_name == 'DAKHIL'){
        		$ename = "দাখিল";
        	}elseif($examination->exam_name == 'ALIM'){
        		$ename = "আলিম";
        	}


        	$filename = $bname.' '.$ename.' '.$type.' - '.$request->year.'.'.$ext;

        //$f1 = 'BoardQuestion-'.$filename;


        	$destinationpath =  public_path().'/BoardQuestion/'.$filename;
        	$boardquestion = file_put_contents($destinationpath, $decode);

        	$question->question = $filename;
        }
        

        $question->subject_name = $request->type;
        $question->year = $request->year;

        $question->save();

        $BoardQuestion = DB::table('tagging_tagged')
        ->where([['taggable_type','=','App\BoardQuestion'],['taggable_id','=',$request->id]])
        ->delete();


        if ($request->tags != null) {
            foreach ($request->tags as $key => $value) {
              DB::table('tagging_tagged')->insert(
                ['taggable_id' => $question->id, 'taggable_type' => 'App\BoardQuestion', 'tag_name' => $value['text'], 'tag_slug' => $value['text']]
            );
          }
      }
        
        return Response()->json($question,200);

    }

    /* Delete Creative Question */
    public function deletequestion(Request $request)
    {
        $question = BoardQuestion::find($request->id);
        $question->delete();

        $BoardQuestion = DB::table('tagging_tagged')
        ->where([['taggable_type','=','App\BoardQuestion'],['taggable_id','=',$request->id]])
        ->delete();

        return Response()->json($question,200);
    }

    /* Get Filter Creative Question */
    public function getfilterquestion(Request $request)
    {
        
        $subject = ClassSubject::find($request->subjectid);
        $board = Board::where('board_name', $request->board)->first();
        $board_exam = DB::table('board_examinations')
        ->where([
            ['board_id', '=', $board->id],
            ['examination_id','=', $request->exam]
        ])->first();

        $question = DB::table('board_questions')
        ->where([
            ['subject_id', '=', $subject->subject_id],
            ['board_examinations_id','=', $board_exam->id]
        ])
        ->orderBy('created_at', 'desc')
        ->take($request->data)
        ->get();

        return Response()->json($question,200);
    }

    /* Get Search Creative Question */
    public function getsearchquestion(Request $request)
    {   
        $search = $request->data; 

        $subject = ClassSubject::find($request->subjectid);
        $board = Board::where('board_name', $request->board)->first();
        $board_exam = DB::table('board_examinations')
        ->where([
            ['board_id', '=', $board->id],
            ['examination_id','=', $request->exam]
        ])->first();


        $question = DB::table('board_questions')
        ->where([
            ['subject_id', '=', $subject->subject_id],
            ['board_examinations_id','=', $board_exam->id],
            ['subject_name','LIKE',"%{$search}%"]
        ])
        ->orwhere([
            ['subject_id', '=', $subject->subject_id],
            ['board_examinations_id','=', $board_exam->id],
            ['year','LIKE',"%{$search}%"]
        ])
        ->orderBy('created_at', 'asc')
        ->get();

        return Response()->json($question,200);
    }



}