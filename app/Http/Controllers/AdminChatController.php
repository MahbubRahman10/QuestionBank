<?php

namespace App\Http\Controllers;

use App\Adminchat;
use App\Events\AdminChatEvent;
use App\Admin;
use Auth;
use Illuminate\Http\Request;

class AdminChatController extends Controller
{
     public function send(Request $request)
     {
		$id = Auth::guard('admin')->user()->id;
     	$user = Admin::find($id);
     	$destination_id = $request->destination_id;
     	$this->savechatdata($request);
     	event(new AdminChatEvent($request->message,$destination_id,$user));
     }
     public function getalladmin()
     {
		$id = Auth::guard('admin')->user()->id;
     	$admin  = Admin::where('id','!=', $id)->get();
     	return response()->json($admin,200); 
     }
     public function savechatdata(Request $request)
     {
     	$chat = new Adminchat();
     	$chat->sender_id = Auth::guard('admin')->user()->id;
     	$chat->sender_name = Auth::guard('admin')->user()->name;
     	$chat->destination_id = $request->destination_id;
     	$chat->message = $request->message;
     	$chat->save();

     }

     public function getOldMessage($id)
     {
     	$getoldmessage = array();
		
		$uid = Auth::guard('admin')->user()->id;

     	$send = Adminchat::where([
     		['sender_id', '=', $id],
     		['destination_id', '=', $uid ],
     	])->get();

     	$recieve = Adminchat::where([
     		['sender_id', '=', $uid ],
     		['destination_id', '=', $id],
     	])->get();


     	for ($i=0; $i < count($send) ; $i++) { 
     		$getoldmessage[$i]  = $send[$i];
     	}

     	$total = count($send)+count($recieve); 

     	$i = 0;
     	for ($j= count($send); $j < $total  ; $j++) { 
     		$getoldmessage[$j]  = $recieve[$i];
     		$i++;
     	}
     	sort($getoldmessage);


     	return response()->json($getoldmessage,200);
     }

     public function adminOnline(Request $request)
     {
          $admin = Admin::find($request->id);
          if ($admin->status != "online") {
               $admin->status = "online";
               $admin->save();
          }
     }

     public function adminOffline(Request $request)
     {
          $admin = User::find($request->id);
          if ($admin->status != "offline") {
               $admin->status = "offline";
               $admin->save();
          }
     }


}
