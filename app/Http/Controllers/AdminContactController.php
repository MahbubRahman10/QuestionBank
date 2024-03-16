<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Controllers\ActivityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AdminContactController extends Controller
{ 
    public function index()
    {

       // $login = "nullstackbd@gmail.com";
       // $password = "nullstackbd";
       // $host = '{imap.gmail.com:993/imap/ssl}INBOX';
       // $mail_con = imap_open($host, $login, $password);

       // $mailboxes = imap_list($mail_con, $host, '*');

       //  //  imap_reopen($mail_con, "{imap.gmail.com:993/ssl}[Gmail]/Sent Mail");
       // $c = 0;
       // $count = imap_num_msg($mail_con);
       //  for($i = 1; $i <= $count; $i++) {
       //      $msg = imap_headerinfo($mail_con, $i);
       //      if($msg->Unseen == 'U') { 
       //          $c++;
       //      }
       //  }
       //  dd($c);

        $contact = Contact::orderby('created_at','=','desc')->get();
        $seen = Contact::where('status','=',0)->count();


        return Response()->json(array('contact'=>$contact,'seen'=>$seen));
    }

    /* Seen Message */
     public function seen(Request $request)
     {
         $contact = Contact::find($request->id);
         
         if ($contact->status == 0) {
           $contact->status = "1";
         }

         $contact->save();

         $seen = Contact::where('status','=',0)->count();

         return Response()->json($seen,200);
     }


    /* Delete Message */
     public function destroy(Request $request)
     {
         $contact = Contact::find($request->id);
         $contact->delete();
         return Response()->json($contact,200);
     }

}
