<?php

namespace App\Http\Controllers;

use App\Backup;
use App\SiteOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Response;

class AdminBackupController extends Controller
{
    public function __construct()
    {

    }
    // Get Backup Data
    public function getbackup()
    { 
      $adminrole = Auth::guard('admin')->user()->role;
      $backup = Backup::paginate(20);
      $total = Backup::count();
      return Response()->json(array('backup'=>$backup,'adminrole'=>$adminrole,'total'=>$total));
    }

    // Search Backup
    public function searchbackup(Request $request)
    {   
        $search = $request->data; 

        $backup = DB::table('backups')
        ->where('type','LIKE',"%{$search}%")
        ->orwhere('file','LIKE',"%{$search}%")
        ->orwhere('date','LIKE',"%{$search}%")
        ->orderBy('created_at', 'asc')
        ->get();

        return Response()->json($backup,200);
    }

     /* Delete Backup */
     public function deletebackup(Request $request)
     {
        $backup = Backup::find($request->id);
        $backup->delete();
        return Response()->json($backup,200);
     }

     public function download($id)
     {
        $backup = Backup::find($id);   
        $file  = $backup->file; 
        return Response::download($file);
     }

     public function backupdata(Request $request)
     {
        
     }

}
