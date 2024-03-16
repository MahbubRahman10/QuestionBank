<?php

namespace App\Http\Controllers;


use App\Blog;
use App\Comment;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    protected $activity;

    public function __construct(ActivityController $activity)
    {
      $this->activity = $activity;
    }

    public function blog()
    {
      $blogposts = Blog::Orderby('created_at','=','asc')->paginate(10);
      return view('blog.blog',compact('blogposts'));
    }

    public function index($id)
    {
      $blogpost = Blog::find($id);
      if($blogpost == null){
         return view('errors/404');
      }
      $blogposttags = DB::table('tagging_tagged')
      ->where([['taggable_type','=','App\Blog'],['taggable_id','=',$blogpost->id]])
      ->get();

      if (Auth::user()) {
        $user = User::find(Auth::id());
        $user->point = $user->point + 1;
        $user->save();
      }

      return view('blog.blogpost',compact(['blogpost','blogposttags']));
    }
    public function addcomment(Request $request,$id)
    {
      $validator = Validator::make($request->all(), [
        'name' => ' required',
        'email' => ' required',
        'comment' => ' required',
      ]);
      // Validation
      if ($validator->fails()) {
        return back()
        ->withErrors($validator)
        ->withInput($request->all);
      }

      if (Auth::user()) {
        $user = User::find(Auth::id());
        $user->point = $user->point + 2;
        $user->save();
      }

      $comment = new Comment();
      $comment->blog_id = $id;
      $comment->name = $request->name;
      $comment->email = $request->email;
      $comment->description = $request->comment;
      $comment->save();

      return Redirect()->back();
    }

}
