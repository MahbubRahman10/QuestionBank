<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;
use Webklex\IMAP\Client;
use Webklex\IMAP\Folder;
use Auth;


class MailController extends BaseController
{
    public function __construct()
    {
        
    }

    // Compose Mail
    public function composeMail(Request $request)
    {
        
        $to  = $request->To;
        $subject  = $request->Subject;
        $content  = $request->Content;    
        
        $adminname = Auth::guard('admin')->user()->name;

        $data = array('name'=>$adminname);
        $mail = array('to'=>$request->To,'subject'=>$request->Subject,'content'=>$request->Content,'name'=>$adminname);

        Mail::raw($mail['content'], function($message) use($mail) {
        $message->to($mail['to'])->subject($mail['subject']);
        $message->from('nullstackbd@gmail.com',$mail['name']);
         });

        echo "Basic Email Sent. Check your inbox.";

    }

    public function unread()
    {
        $login = "nullstackbd@gmail.com";
        $password = "nullstackbd";
        $host = '{imap.gmail.com:993/imap/ssl}INBOX';
        $mail_con = imap_open($host, $login, $password);

        $mailboxes = imap_list($mail_con, $host, '*');
        
        //  imap_reopen($mail_con, "{imap.gmail.com:993/ssl}[Gmail]/Sent Mail");
        
        $unread = 0;
        $count = imap_num_msg($mail_con);
        for($i = 1; $i <= $count; $i++) {
            $msg[$i] = imap_headerinfo($mail_con, $i);
            if($msg[$i] ->Unseen == 'U') {
                $unread++;
            }
        }

        return $unread;
    }


    // Get all Inbox Messages
    public function getInbox()
    {
        $login = "nullstackbd@gmail.com";
        $password = "nullstackbd";
        $host = '{imap.gmail.com:993/imap/ssl}INBOX';
        $mail_con = imap_open($host, $login, $password);
     
        $mailboxes = imap_list($mail_con, $host, '*');
        
        //  imap_reopen($mail_con, "{imap.gmail.com:993/ssl}[Gmail]/Sent Mail");
        
        $count = imap_num_msg($mail_con);
        for($i = 1; $i <= $count; $i++) {
            $msg[$i] = imap_headerinfo($mail_con, $i);
        }

        imap_close($mail_con);
        
        $inbox = array_reverse($msg);

        $unread = $this->unread();

        return Response()->json(array('inbox'=>$inbox,'unread'=>$unread));

    }

    // View Inbox Message
    public function getInboxMessage($subject)
    {
        $oClient = new Client([
            'host'          => 'imap.gmail.com',
            'port'          => 993,
            'encryption'    => 'ssl',
            'validate_cert' => true,
            'username'      => 'nullstackbd@gmail.com',
            'password'      => 'nullstackbd',
        ]);

        $oClient->connect();

       $oFolder = new Folder($oClient, (object)['name' => '{imap.gmail.com:993/imap/novalidate-cert/ssl}INBOX', 'attributes' => 32, 'delimiter' => '.']);

        $result = array();

        foreach($oFolder->getMessages() as $oMessage){
            if($oMessage->subject == $subject){                  
                $result[0] =  $oMessage->getHTMLBody(true);
            }
            else{
                continue;
            }
        }
        // return Response()->json($result[0],200);

        $unread = $this->unread();

        return Response()->json(array('inbox'=>$result[0],'unread'=>$unread));
    }

    // Delete Inbox Message
    public function deleteInboxMessage($subject)
    {

        $login = "nullstackbd@gmail.com";
        $password = "nullstackbd";
        $host = '{imap.gmail.com:993/ssl}';
        $connection = imap_open($host, $login, $password);

        $result = imap_search($connection, 'SUBJECT "'.$subject.'"');
        $msgno = $result[0];
        //$overview = imap_fetch_overview($connection, "$msgno:$msgno");
        //imap_delete($connection, $overview[0]->uid, FT_UID);
        //imap_expunge($connection);
        imap_mail_move($connection, "$msgno:$msgno", '[Gmail]/Bin');
        imap_close($connection);

        return Response()->json("ok");

    }

    // Delete Multiple Inbox Message
    public function deleteMultiInboxMessage($category,$subject)
    {

        $sj = explode(',', $subject);
        $login = "nullstackbd@gmail.com";
        $password = "nullstackbd";
        if ($category == 'inbox') {
            $host = '{imap.gmail.com:993/ssl}';
        }
        elseif ($category =='sent') {
            $host = '{imap.gmail.com:993/ssl}[Gmail]/Sent Mail';
        }
        elseif ($category == 'draft') {
            $host = '{imap.gmail.com:993/ssl}[Gmail]/Drafts';
        }
        
        $connection = imap_open($host, $login, $password);


        for ($i=0; $i <count($sj) ; $i++) { 
            $result = imap_search($connection, 'SUBJECT "'.$sj[$i].'"');
            $msgno = $result[0];
            imap_mail_move($connection, "$msgno:$msgno", '[Gmail]/Bin');
        }
        

        imap_close($connection);

       
        $mail_con = imap_open($host, $login, $password);
        $count = imap_num_msg($mail_con);
        for($i = 1; $i <= $count; $i++) {
            $msg[$i] = imap_headerinfo($mail_con, $i);
        }
        $inbox = array_reverse($msg);
        return Response()->json($inbox,200);
        

    }

    // Get all Sent Messages
    public function getSent()
    {

        $login = "nullstackbd@gmail.com";
        $password = "nullstackbd";
        $host = '{imap.gmail.com:993/ssl}';
        $mail_con = imap_open($host, $login, $password);

        $mailboxes = imap_list($mail_con, $host, '*');
        
        imap_reopen($mail_con, "{imap.gmail.com:993/ssl}[Gmail]/Sent Mail");
        
        $count = imap_num_msg($mail_con);
        
        for($i = 1; $i <= $count; $i++) {
            $msg[$i] = imap_headerinfo($mail_con, $i);
        }

        imap_close($mail_con);
        
        $inbox = array_reverse($msg);


        // return Response()->json($inbox,200);

        $unread = $this->unread();

        return Response()->json(array('sent'=>$inbox,'unread'=>$unread));

    }

    // View Sent Message
    public function getSentMessage($subject)
    {
        $oClient = new Client([
            'host'          => 'imap.gmail.com',
            'port'          => 993,
            'encryption'    => 'ssl',
            'validate_cert' => true,
            'username'      => 'nullstackbd@gmail.com',
            'password'      => 'nullstackbd',
        ]);

        $oClient->connect();

        $oFolder = new Folder($oClient, (object)['name' => '{imap.gmail.com:993/imap/novalidate-cert/ssl}[Gmail]/Sent Mail', 'attributes' => 32, 'delimiter' => '.']);

        $result = array();

        

        foreach($oFolder->getMessages() as $oMessage){
            if($oMessage->subject == $subject){                  
                $result[0] =  $oMessage->getHTMLBody(true);
            }
            else{
                continue;
            }
        }
        // return Response()->json($result[0],200);

        $unread = $this->unread();

        return Response()->json(array('sent'=>$result[0],'unread'=>$unread));
    }

    // Delete Sent Message
    public function deleteSentMessage($subject)
    {
        $login = "nullstackbd@gmail.com";
        $password = "nullstackbd";
        $host = '{imap.gmail.com:993/imap/novalidate-cert/ssl}[Gmail]/Sent Mail';
        $connection = imap_open($host, $login, $password);


        $result = imap_search($connection, 'SUBJECT "'.$subject.'"');
        $msgno = $result[0];
        //$overview = imap_fetch_overview($connection, "$msgno:$msgno");
        //imap_delete($connection, $overview[0]->uid, FT_UID);
        //imap_expunge($connection);
        imap_mail_move($connection, "$msgno:$msgno", '[Gmail]/Bin');
        
        imap_close($connection);

        return Response()->json("ok");

    }

    // Get all Draft Messages
    public function getDraft()
    {

        $login = "nullstackbd@gmail.com";
        $password = "nullstackbd";
        $host = '{imap.gmail.com:993/ssl}';
        $mail_con = imap_open($host, $login, $password);

        $mailboxes = imap_list($mail_con, $host, '*');
        
        imap_reopen($mail_con, "{imap.gmail.com:993/ssl}[Gmail]/Drafts");
        
        $count = imap_num_msg($mail_con);

        if ($count == 0) {
            $inbox = null;
        }
        else{
            for($i = 1; $i <= $count; $i++) {
                $msg[$i] = imap_headerinfo($mail_con, $i);
            }

            imap_close($mail_con);
        
            $inbox = array_reverse($msg);

        }


        // return Response()->json($inbox,200);

        $unread = $this->unread();

        return Response()->json(array('draft'=>$inbox,'unread'=>$unread));

    }

    // View Draft Message
    public function getDraftMessage($subject)
    {
        $oClient = new Client([
            'host'          => 'imap.gmail.com',
            'port'          => 993,
            'encryption'    => 'ssl',
            'validate_cert' => true,
            'username'      => 'nullstackbd@gmail.com',
            'password'      => 'nullstackbd',
        ]);

        $oClient->connect();

        $oFolder = new Folder($oClient, (object)['name' => '{imap.gmail.com:993/imap/novalidate-cert/ssl}[Gmail]/Drafts', 'attributes' => 32, 'delimiter' => '.']);

        $result = array();

        foreach($oFolder->getMessages() as $oMessage){
            if($oMessage->subject == $subject){                  
                $result[0] =  $oMessage->getHTMLBody(true);
            }
            else{
                continue;
            }
        }
        // return Response()->json($result[0],200);

        $unread = $this->unread();

        return Response()->json(array('draft'=>$result[0],'unread'=>$unread));
    }

    // Delete Sent Message
    public function deleteDraftsMessage($subject)
    {
        $login = "nullstackbd@gmail.com";
        $password = "nullstackbd";
        $host = '{imap.gmail.com:993/imap/novalidate-cert/ssl}[Gmail]/Drafts';
        $connection = imap_open($host, $login, $password);

        $result = imap_search($connection, 'SUBJECT "'.$subject.'"');
        $msgno = $result[0];
        //$overview = imap_fetch_overview($connection, "$msgno:$msgno");
        //imap_delete($connection, $overview[0]->uid, FT_UID);
        //imap_expunge($connection);
        imap_mail_move($connection, "$msgno:$msgno", '[Gmail]/Bin');
        
        imap_close($connection);

        return Response()->json("ok");

    }


    // Get all Trash Messages
    public function getTrash()
    {

        $login = "nullstackbd@gmail.com";
        $password = "nullstackbd";
        $host = '{imap.gmail.com:993/ssl}';
        $mail_con = imap_open($host, $login, $password);

        $mailboxes = imap_list($mail_con, $host, '*');
        
        imap_reopen($mail_con, "{imap.gmail.com:993/ssl}[Gmail]/Bin");
        
        $count = imap_num_msg($mail_con);
        
        for($i = 1; $i <= $count; $i++) {
            $msg[$i] = imap_headerinfo($mail_con, $i);
        }

        imap_close($mail_con);
        
        $inbox = array_reverse($msg);


        // return Response()->json($inbox,200);

        $unread = $this->unread();

        return Response()->json(array('trash'=>$inbox,'unread'=>$unread));

    }

    // View Trash Message
    public function getTrashMessage($subject)
    {
        $oClient = new Client([
            'host'          => 'imap.gmail.com',
            'port'          => 993,
            'encryption'    => 'ssl',
            'validate_cert' => true,
            'username'      => 'nullstackbd@gmail.com',
            'password'      => 'nullstackbd',
        ]);

        $oClient->connect();

        $oFolder = new Folder($oClient, (object)['name' => '{imap.gmail.com:993/imap/novalidate-cert/ssl}[Gmail]/Bin', 'attributes' => 32, 'delimiter' => '.']);

        $result = array();

        foreach($oFolder->getMessages() as $oMessage){
            if($oMessage->subject == $subject){                  
                $result[0] =  $oMessage->getHTMLBody(true);
            }
            else{
                continue;
            }
        }
        // return Response()->json($result[0],200);

        $unread = $this->unread();

        return Response()->json(array('draft'=>$result[0],'unread'=>$unread));
    }


    // Delete Trash Message
    public function deleteTrashMessage($subject)
    {
        $login = "nullstackbd@gmail.com";
        $password = "nullstackbd";
        $host = '{imap.gmail.com:993/imap/novalidate-cert/ssl}[Gmail]/Bin';
        $connection = imap_open($host, $login, $password);

        $result = imap_search($connection, 'SUBJECT "'.$subject.'"');
        $msgno = $result[0];
        
        $overview = imap_fetch_overview($connection, "$msgno:$msgno");
        imap_delete($connection, $overview[0]->uid, FT_UID);
        imap_expunge($connection);
         
        imap_close($connection);

        return Response()->json("ok");

    }


}
