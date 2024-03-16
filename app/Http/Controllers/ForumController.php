<?php

namespace App\Http\Controllers;

use App\Category;
use App\Contact;
use App\Forum;
use App\ForumVisitor;
use App\Http\Controllers\ActivityController;
use App\Like;
use App\Reply;
use App\Report;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Dislike;

class ForumController extends Controller
{ 

    protected $activity;
    protected $notification;

    public function __construct(ActivityController $activity, NotificationController $notification)
    {
      $this->activity = $activity;
      $this->notification = $notification;
    }

    // all forum question
    public function index()
    { 
      $question = Forum::orderBy('created_at', 'desc')->paginate(6);

      return view('forum.index',compact('question'));
    }
    // View forum question
    public function view($id)
    { 
      $question=Forum::find($id);
  
      // If Data not found, Show Error Page      
      if($question == null){
         return view('errors/404');
      }

      $like=Like::all();
      $viewerip = \Request::ip();
      $data = ForumVisitor::where([['forum_id', '=', $id], ['visitor_ip', '=', $viewerip],])->get();
      if(count($data) == 0){
        $ip=array("forum_id"=>$id,"visitor_ip"=>$viewerip);
        $userip=DB::table('forum_visitors')->insert($ip);
        $visitor=$question->visitor;
        $add=$visitor+1;
        $question->visitor=$add;
        $question->save();  
      }

      return view('forum.view')->with('question',$question);
    }

    public function category($id)
    {
      $category = Category::find($id); 
      // If Data not found, Show Error Page      
      if($category == null){
         return view('errors/404');
      }
      $question = Forum::where('category','=',$category->category_name)->orderBy('created_at', 'desc')->paginate(6);
      return view('forum.category',compact(['question','category']));
    }


    // Reply forum question
    public function reply(Request $request, $id)
    {

     

      $validator = Validator::make($request->all(), [
        'reply' => ' required',
      ]);
      // Validation
      if ($validator->fails()) {
        return back()
        ->withErrors($validator)
        ->withInput();
      }

      $string = app('profanityFilter')->filter($request->reply);

      if (strpos($string, '*') == true){
        $validator->errors()->add('reply', 'Please dont use slang word');
        return back()
        ->withErrors($validator)
        ->withInput();
      }

      

      

      $user_id=Auth::User()->id;
      $name=Auth::user()->name;
      $post_id=$id;
      $description=$request->reply;
      
      $reply=new Reply;
      $reply->forum_id=$post_id;
      $reply->user_id=$user_id;
      $reply->name=$name;
      $reply->description=$description;
      $reply->save();

      $replys=DB::table('forums')->where('id',$id)->first();
      $num_reply=$replys->num_reply;
      $add_reply=$num_reply+1;

      $forum = Forum::find($id);
      $forum->num_reply= $add_reply;
      $forum->save();

      // Activity //
      $this->activity->savedactivity("forumreply","reply a",$reply->forum_id);
      // Notification //
      $notification = ucfirst(Auth::User()->name)." Reply on your Question";
      $this->notification->savednotification($forum->user_id,$forum->id,"reply",$reply->id,$notification);


      // Save Point
      $user = User::find($user_id);
      $user->point = $user->point + 5;
      $user->save();


      return Redirect()->back();
    }
    // Edit Reply
    public function editreply(Request $request){

      $validator = Validator::make($request->all(), [
        'description' => ' required',
      ]);
      // Validation
      if ($validator->fails()) {
        return back()
        ->withErrors($validator)
        ->withInput();
      }

      $Reply =Reply::find($request->id);
      $Reply->description=$request->description;
      $Reply->save();
      $description=$Reply->description; 
      return response ()->json (['description' => $description]);
    }
    // Delete Reply
    public function deletereply($id){

      $Reply =Reply::find($id);
      $forum_id=$Reply->forum_id;
      $Forum = Forum::find($forum_id);
      $num_reply = $Forum->num_reply;
      $bestreply = $Forum->bestreply;
      
      $num=$num_reply-1;

      $Reply->delete();

      if($bestreply==$id){
        $Forum->bestreply=null;
        $Forum->num_reply=$num;
        $Forum->save();

        // Notification 
        $this->notification->deletenotification($Forum->user_id,$Forum->id,"reply",$id);

        return back()->withInput();
     }
     else{
        $Forum->num_reply=$num;
        $Forum->save();

         // Notification 
        $this->notification->deletenotification($Forum->user_id,$Forum->id,"reply",$id);

        return back()->withInput();
      }
    }

    // Like Reply
    public function likereply(Request $req){


      $like=new Like;
      $id=$req->id;
      $userid = Auth::id();
      $data=DB::table('likes')->where([['user_id', '=', $userid], ['reply_id', '=', $id]])->first();

      if(count($data)==0){

        $like->user_id=$userid;
        $like->reply_id=$req->id;
        $like->save();
        $data=DB::table('replies')->where('id',$id)->first();
        $likes=$data->Like;
        if($likes=="null"){
          $con=0+1;
        }
        else{
          $con=$likes+1;
        }

        $reply = Reply::find($id);
        $reply->Like= $con;
        $reply->save();
        $userlike=$reply->Like;


        // Delete Dislike
        $dislike = Dislike::where([['user_id','=',$userid],['reply_id','=',$id]])->first();
        if ($dislike != null) {
          $reply = Reply::find($id);
          $total = $reply->Dislike - 1;
          if ($total == 0) {
            $reply->dislike =  null;
          }
          else{
            $reply->dislike =  $total;
          }
          $reply->save();
          $dislike->delete();
        }


        // Activity //
        $this->activity->savedactivity("forumreply","like a",$reply->forum_id);
        // Notification //
        $notification = ucfirst(Auth::User()->name)." like your Reply";
        $forum = Forum::find($reply->forum_id);
        $this->notification->savednotification($reply->user_id,$forum->id,"like",$reply->id,$notification);


        $user = User::find(Auth::id());
        $user->point = $user->point + 2;
        $user->save();


        return response ()->json (['like' => $userlike,'status' => 'rise']);
      }
      else{

        DB::table('likes')->where([['user_id', '=', $userid], ['reply_id', '=', $id]])->delete();

        $data=DB::table('replies')->where('id',$id)->first();
        $likes=$data->Like;
        $con=$likes-1;

        $reply = Reply::find($id);
        if($con<=0){
          $reply->Like= null;
        }
        else{
          $reply->Like= $con;
        }
        $reply->save();
        $userlike=$reply->Like;

        // Activity //
        $this->activity->deleteactivity("forumreply","like a",$reply->forum_id);
        // Notification 
        $forum = Forum::find($reply->forum_id);
        $this->notification->deletenotification($reply->user_id,$forum->id,"like",$reply->id);

        return response ()->json (['like' => $userlike,'status' => 'decrease']);
      }

    }


    // Dislike Reply
    public function dislikereply(Request $req){
    


      $like=new Dislike;
      $id=$req->id;
      $userid = Auth::id();
      $data=DB::table('dislikes')->where([['user_id', '=', $userid], ['reply_id', '=', $id]])->first();

      if(count($data)==0){

        $like->user_id=$userid;
        $like->reply_id=$req->id;
        $like->save();
        $data=DB::table('replies')->where('id',$id)->first();
        $likes=$data->Dislike;
        if($likes=="null"){
          $con=0+1;
        }
        else{
          $con=$likes+1;
        }
        $reply = Reply::find($id);
        $reply->Dislike= $con;
        $reply->save();
        $userlike=$reply->Dislike;


        // Delete Like
        $like = Like::where([['user_id','=',$userid],['reply_id','=',$id]])->first();
        if ($like != null) {
          $reply = Reply::find($id);
          $total = $reply->Like - 1;
          if ($total == 0) {
            $reply->Like =  null;
          }
          else{
            $reply->Like =  $total;
          }
          $reply->save();
          $like->delete();
        }



        // Activity //
        $this->activity->savedactivity("forumreply","unlike a",$reply->forum_id);
        // Notification //
        $notification = ucfirst(Auth::User()->name)." unlike your Reply";
        $forum = Forum::find($reply->forum_id);
        $this->notification->savednotification($reply->user_id,$forum->id,"unlike",$reply->id,$notification);


        $user = User::find(Auth::id());
        $user->point = $user->point + 2;
        $user->save();


        return response ()->json (['like' => $userlike,'status' => 'rise']);
      }
      else{

        DB::table('dislikes')->where([['user_id', '=', $userid], ['reply_id', '=', $id]])->delete();

        $data=DB::table('replies')->where('id',$id)->first();
        $likes=$data->Dislike;
        $con=$likes-1;

        $reply = Reply::find($id);
        if($con<=0){
          $reply->Dislike= null;
        }
        else{
          $reply->Dislike= $con;
        }
        $reply->save();
        $userlike=$reply->Dislike;

        // Activity //
        $this->activity->deleteactivity("forumreply","unlike a",$reply->forum_id);
        // Notification 
        $forum = Forum::find($reply->forum_id);
        $this->notification->deletenotification($reply->user_id,$forum->id,"unlike",$reply->id);

        return response ()->json (['like' => $userlike,'status' => 'decrease']);
      }

    }

    // Best Reply
    public function bestreply($id){


      $user = User::find(Auth::id());
      $user->point = $user->point + 2;
      $user->save();


      $reply = Reply::find($id);
      $fid=$reply->forum_id;
      $forum = Forum::find($fid);
      $data=DB::table('replies')->where([['forum_id', '=', $fid],['best', '=', "Yes"]])->first();
      if (count($data)==0) {
        $best=$reply->best;
        if ($best=="No") {
          $reply->best= "Yes";
          $forum->bestreply=$reply->id;
          // Activity //
          $this->activity->savedactivity("forumreply","choose best reply on a",$reply->forum_id);
          // Notification
          $notification = ucfirst(Auth::User()->name)." Choose your Reply as a Best Reply";
          $this->notification->savednotification($reply->user_id,$forum->id,"bestreply",$reply->id,$notification);
        }
        else{
          $reply->best= "No";
          $forum->bestreply=null;
          // Activity //
          $this->activity->deleteactivity("forumreply","choose best reply on a",$reply->forum_id);
          // Notification 
          $this->notification->deletenotification($reply->user_id,$forum->id,"bestreply",$reply->id);
        }
      }
      else{
        $updateid=$data->id;
        DB::table('replies')->where('id', $updateid)->update(['best' => "No"]);
        $best=$reply->best;
        if ($best=="No") {
          $reply->best= "Yes";
          $forum->bestreply=$reply->id;
          // Activity //
          $this->activity->savedactivity("forumreply","choose best reply on a",$reply->forum_id);
        }
        else{
          $reply->best= "No";
          $forum->bestreply=null;
          // Activity //
          $this->activity->deleteactivity("forumreply","choose best reply on a",$reply->forum_id);
           // Notification 
          $this->notification->deletenotification($reply->user_id,$forum->id,"bestreply",$reply->id);
        }
      }
      $reply->save();
      $forum->save();
      return back()->withInput();
    }

    // Report Reply
    public function reportreply($id)
    {
      $reply = Reply::find($id);
      $url = '/forum/view/'.$reply->forum_id;

      return view('forum.report',compact(['url','reply']));
    }
    public function report(Request $request, $id)
    {


      $user = User::find(Auth::id());
      $user->point = $user->point + 1;
      $user->save();


      $data = Input::all();                 
      $rules=array(
        'report' => 'required',
      );
      $valid=Validator::make($data,$rules);
      if($valid->fails()){
        return Redirect()->back()->withErrors($valid);
      }


      $reply = Reply::find($id);
      $report = new Contact();
      $report->category = 'report';
      $report->name = 'Reply';
      $report->email = $reply->id;
      $report->message = $request->report;
      $report->save();

      $url = '/forum/view/'.$reply->forum_id;

      return back()->with('msg','Your Report is Accepted.We take action as soon as possible.')->with('url',$url);
    }


    //Show ask question page
    public function ask()
    {
      $category=Category::all();    
      return view('forum.ask')->with('category',$category);
    }
    // Add Ask Question
    public function askquestion(Request $request)
    {
      // Validation
      $data = Input::all();                 
      $rules=array(
        'title' => 'required',
        'category' => 'required|not_in:0',
        'description' => 'required'  
      );
      $valid=Validator::make($data,$rules);
      if($valid->fails()){
        return Redirect()->back()->withErrors($valid);
      }
  
      else{

        $title = app('profanityFilter')->filter($request->title);


        if (preg_match("/[*]/i", $title) == '1' || strpos($title, '*') == true){
          $valid->errors()->add('title', 'Please dont use slang word');
          return back()
          ->withErrors($valid)
          ->withInput();
        }


        $description = app('profanityFilter')->filter($request->description);
        if (strpos($description, '*') == true || preg_match("/[*]/i", $title) == '1'){
          $valid->errors()->add('description', 'Please dont use slang word');
          return back()
          ->withErrors($valid)
          ->withInput();
        }

        $userid = Auth::user()->id;
        $request->request->add(['user_id' => $userid]);
        $input = $request->all();
    
        // $tags = explode(",", $request->tags);

        $ask = Forum::create($input);
        // $ask->tag($tags);

        // Activity //
        $this->activity->savedactivity("forum","create a",$ask->id);


        $user = User::find(Auth::id());
        $user->point = $user->point + 5;
        $user->save();


        return Redirect('/forum');
      }
    }

    // Edit Page
    public function edit($id)
    {
      $forum = Forum::find($id);
      // If Data not found, Show Error Page      
      if($forum == null){
         return view('errors/404');
      }
      $category=Category::all();    
      return view('forum.update')->with('forum',$forum)->with('category',$category)->with('id',$id);
    }
    // Add Ask Question
    public function update(Request $request,$id)
    {

      // Validation
      $data = Input::all();                 
      $rules=array(
        'title' => 'required',
        'category' => 'required|not_in:0',
        'description' => 'required'   
      );
      $valid=Validator::make($data,$rules);
      if($valid->fails()){
        return Redirect()->back()->withErrors($valid);
      }
      else{
        $ask=Forum::find($id);
        $ask->title=$request->title;
        $ask->category=$request->category;
        $ask->description=$request->description;
        $ask->save();

        // Activity //
        $this->activity->savedactivity("forum","update ",$ask->id);

        return Redirect::intended('/forum/view/'.$id);
      }
    }


    public function userprofile($id)
    {
      $user = User::find($id);
      if($user == null){
         return view('errors/404');
      }
      $questions = Forum::where('user_id','=',$user->id)->get();
      return view('forum.profile',compact(['user','questions']));
    }
}
