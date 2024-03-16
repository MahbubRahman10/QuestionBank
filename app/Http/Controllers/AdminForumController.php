<?php

namespace App\Http\Controllers;

use App\Category;
use App\Forum;
use App\ForumVisitor;
use App\Like;
use App\Reply;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AdminForumController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
      $category = category::count();
      $visitor = ForumVisitor::count();
      $forum = Forum::count();
      $reply = Reply::count();

      return Response()->json(array('category'=>$category,'visitor'=>$visitor,'forum'=>$forum,'reply'=>$reply));
    }

    // Get all Question
    public function getquestion()
    { 
      $question = Forum::orderBy('created_at', 'desc')->paginate(20);
      $total = Forum::count();
      return Response()->json(array('question'=>$question,'total'=>$total));
    }
    // Get all Reply
    public function getreply()
    { 
      $reply = Reply::orderBy('created_at', 'desc')->paginate(20);
      $total = Reply::count();
      return Response()->json(array('reply'=>$reply,'total'=>$total));
    }
    // Get all Category
    public function getcategory()
    { 
      $category = Category::orderBy('created_at', 'desc')->paginate(20);
      $total = Category::count();
      return Response()->json(array('category'=>$category,'total'=>$total));
    }
    /* Delete Question */
     public function deletequestion(Request $request)
     {

        $visitor  = ForumVisitor::where('forum_id','=',$request->id)->first();
        if ($visitor) {          
          $visitor->delete();
        }
        $question = Forum::find($request->id);
        $question->delete();
        return Response()->json($question,200);
     }
     /* Delete Reply */
     public function deletereply(Request $request)
     {
         $reply = Reply::find($request->id);
         $reply->delete();
         return Response()->json($reply,200);
     }
     /* Delete Category */
     public function deletecategory(Request $request)
     {
         $category = Category::find($request->id);
         $category->delete();
         return Response()->json($category,200);
     }
     /* Add Category */
     public function addcategory(Request $request)
     {
      $category  = new Category();
      $category->category_name = $request->category;
      $category->save();
      return response()->json($category,200); 
    }
    /* Edit Category */
     public function editcategory(Request $request)
     {
      $category  = Category::find($request->id);
      $category->category_name = $request->category;
      $category->save();
      return response()->json($category,200); 
    }
    /* Get Search Question */
    public function getsearchquestion(Request $request)
    {   
        $search = $request->data; 

        $question = DB::table('forums')
        ->where('title','LIKE',"%{$search}%")
        ->orderBy('created_at', 'asc')
        ->get();

        return Response()->json($question,200);
    }
     /* Get Search Reply */
    public function getsearchreply(Request $request)
    {   
        $search = $request->data; 

        $reply = DB::table('replies')
        ->where('description','LIKE',"%{$search}%")
        ->orderBy('created_at', 'asc')
        ->get();
        return Response()->json($reply,200);
    }
    /* Get Search Category */
    public function getsearchcategory(Request $request)
    {   
        $search = $request->data; 

        $category = DB::table('categories')
        ->where('category_name','LIKE',"%{$search}%")
        ->orderBy('created_at', 'asc')
        ->get();

        return Response()->json($category,200);
    }
   
}
