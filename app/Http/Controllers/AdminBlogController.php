<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Forum;
use App\ForumVisitor;
use App\Like;
use App\Reply;
use App\Blog;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AdminBlogController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
      $blog = Blog::count();
      $comment = Comment::count();

      return Response()->json(array('post'=>$blog,'comment'=>$comment));
    }

    public function gettags(Request $request)
    {
      $blogposttags = DB::table('tagging_tagged')
      ->where([['taggable_type','=','App\Blog'],['taggable_id','=',$request->id]])
      ->get();

      return Response()->json($blogposttags);
    }

    // Get all Post
    public function getpost()
    { 
      $post = Blog::orderBy('created_at', 'desc')->paginate(20);
      $total = Blog::count();

      return Response()->json(array('post'=>$post,'total'=>$total));
    }
    // Get all Comment
    public function getcomment()
    { 
      $comment = Comment::orderBy('created_at', 'desc')->paginate(20);
      $total = Comment::count();
     return Response()->json(array('comment'=>$comment,'total'=>$total));
    }
   

    /* Delete Question */
     public function deletepost(Request $request)
     {
        $blog = Blog::find($request->id);
        $blog->delete();
        return Response()->json($blog,200);
     }
     /* Delete Reply */
     public function deletecomment(Request $request)
     {
         $comment = Comment::find($request->id);
         $comment->delete();
         return Response()->json($comment,200);
     }

     /* Add Post */
     public function addpost(Request $request)
     {

      $blog  = new Blog();
      $blog->admin_id = Auth::guard('admin')->user()->id;
      $blog->title = $request->title;
      $blog->description = $request->description;
      $blog->save();

      if ($request->tags != null) {
        foreach ($request->tags as $key => $value) {
          DB::table('tagging_tagged')->insert(
            ['taggable_id' => $blog->id, 'taggable_type' => 'App\Blog', 'tag_name' => $value['text'], 'tag_slug' => $value['text']]
          );
        }
      }

      return response()->json($blog,200); 
    }

    /* Edit Category */
     public function editpost(Request $request)
     {
      $blog  = Blog::find($request->id);
      $blog->title = $request->title;
      $blog->description = $request->description;
      $blog->save();

      $blogposttags = DB::table('tagging_tagged')
      ->where([['taggable_type','=','App\Blog'],['taggable_id','=',$request->id]])
      ->delete();


      if ($request->tags != null) {
        foreach ($request->tags as $key => $value) {
          DB::table('tagging_tagged')->insert(
            ['taggable_id' => $blog->id, 'taggable_type' => 'App\Blog', 'tag_name' => $value['text'], 'tag_slug' => $value['text']]
          );
        }
      }


      return response()->json($blog,200); 
    }

    /* Get Search Post */
    public function getsearchpost(Request $request)
    {   
        $search = $request->data; 

        $post = DB::table('blogs')
        ->where('title','LIKE',"%{$search}%")
        ->where('description','LIKE',"%{$search}%")
        ->orderBy('created_at', 'asc')
        ->get();

        return Response()->json($post,200);
    }
     /* Get Search Comment */
    public function getsearchcomment(Request $request)
    {   
        $search = $request->data; 

        $comment = DB::table('comments')
        ->where('name','LIKE',"%{$search}%")
        ->where('email','LIKE',"%{$search}%")
        ->where('description','LIKE',"%{$search}%")
        ->orderBy('created_at', 'asc')
        ->get();
        return Response()->json($comment,200);
    }
   
}
