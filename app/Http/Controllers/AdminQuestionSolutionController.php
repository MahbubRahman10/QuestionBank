<?php

namespace App\Http\Controllers;

use App\Board;
use App\BoardExamination;
use App\BoardQuestion;
use App\ClassSubject;
use App\Subject;
use App\Questionsolution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminQuestionSolutionController extends Controller
{

       public function index()
       {   

        $bcs = Questionsolution::where('category','=','bcs')->count();
        $university = Questionsolution::where('category','=','university')->count();
        $bank = Questionsolution::where('category','=','bank')->count();
        $teacher = Questionsolution::where('category','=','teacher')->count();


        return Response()->json(array('bcs'=>$bcs, 'university'=>$university, 'bank'=>$bank, 'teacher'=>$teacher));

    }

     // Get Tag
    public function gettags(Request $request)
    {
      $questionsolution = DB::table('tagging_tagged')
      ->where([['taggable_type','=','App\Questionsolution'],['taggable_id','=',$request->id]])
      ->get();

      return Response()->json($questionsolution);
    }

    /* Get Board Question */
    public function getquestion(Request $request)
    {
        $category =  $request->category;
        $question = Questionsolution::where('category','=',$category)->paginate(20);
        $total = Questionsolution::where('category','=',$category)->count();
        return Response()->json(array('question'=>$question, 'total'=>$total));
    }

    /* Add Board Question */
    public function addquestion(Request $request)
    {
        $category = $request->category;
        $question = new Questionsolution();
        $question->title = $request->title;   
        $question->category = $category;     
        $question->year = $request->year;
 
        $exploded = explode(',',$request->file);
        $decode = base64_decode($exploded[1]);
        $ext ='pdf';


        $token = $this->token();

        $filename = $token.'.'.$ext;

        //$f1 = 'BoardQuestion-'.$filename;

        $destinationpath =  public_path().'/SolveQuestion/'.$filename;
        $boardquestion = file_put_contents($destinationpath, $decode);
       
        $question->file = $filename;       

        $question->save();

        if ($request->tags != null) {
            foreach ($request->tags as $key => $value) {
              DB::table('tagging_tagged')->insert(
                ['taggable_id' => $question->id, 'taggable_type' => 'App\Questionsolution', 'tag_name' => $value['text'], 'tag_slug' => $value['text']]
              );
            }
        }
        
        return Response()->json($question,200);

    }

     /* Edit Creative Question */
    public function editquestion(Request $request)
    {

        $category = $request->category;
        $question = Questionsolution::find($request->id);
        $question->title = $request->title;       
        $question->year = $request->year;
 
        // $exploded = explode(',',$request->file);
        // $decode = base64_decode($exploded[1]);
        // $ext ='pdf';

        // $filename = $request->title.' - '.$request->year.'.'.$ext;

        // //$f1 = 'BoardQuestion-'.$filename;

        // $destinationpath =  public_path().'/SolveQuestion/'.$filename;
        // $boardquestion = file_put_contents($destinationpath, $decode);
       
        // $question->file = $filename;       

        $question->save();

        $questionsolution = DB::table('tagging_tagged')
        ->where([['taggable_type','=','App\Questionsolution'],['taggable_id','=',$request->id]])
        ->delete();

        if ($request->tags != null) {
            foreach ($request->tags as $key => $value) {
              DB::table('tagging_tagged')->insert(
                ['taggable_id' => $question->id, 'taggable_type' => 'App\Questionsolution', 'tag_name' => $value['text'], 'tag_slug' => $value['text']]
            );
          }
        }
        
        return Response()->json($question,200);

    }

    /* Delete Creative Question */
    public function deletequestion(Request $request)
    {
        $question = Questionsolution::find($request->id);
        $question->delete();

        $questionsolution = DB::table('tagging_tagged')
        ->where([['taggable_type','=','App\Questionsolution'],['taggable_id','=',$request->id]])
        ->delete();

        return Response()->json($question,200);
    }

    /* Get Filter Creative Question */
    public function getfilterquestion(Request $request)
    {
        
        $category = $request->category;
        $question = DB::table('questionsolutions')
        ->where('category', '=', $category)
        ->orderBy('created_at', 'desc')
        ->take($request->data)
        ->get();
        return Response()->json($question,200);
    }

    /* Get Search Creative Question */
    public function getsearchquestion(Request $request)
    {   
        $search = $request->data; 
        $question = DB::table('questionsolutions')
        ->where('category', '=', $request->category)
        ->Where('title','LIKE',"%{$search}%")
        ->orderBy('created_at', 'asc')
        ->get();

        return Response()->json($question,200);
    }

    // Get Random Token
    public function token() {
          $token = "";
          $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
          $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
          $codeAlphabet.= "0123456789";
          $max = strlen($codeAlphabet); // edited

          for ($i=0; $i < 10; $i++) {
            $token .= $codeAlphabet[random_int(0, $max-1)];
        }
        return $token;;
    }

}