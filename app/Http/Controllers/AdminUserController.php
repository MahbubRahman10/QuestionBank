<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Adminchat;
use App\Events\AdminChatEvent;
use App\Role;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
     public function __construct()
     {
         
     }
     /* Get all Users */
     public function getallusers()
     {
     	$users  = User::paginate(20);
      $total  = User::count(); 

     	return response()->json(array('users'=>$users, 'total'=>$total)); 
     }

     /* Add Admin */
     public function addadmin(Request $request)
     {
          $admin  = new Admin();
          $admin->name = $request->name;
          $admin->email = $request->email;
          $admin->role = $request->role;
          $admin->verified = 1;
          $admin->password = bcrypt($request->password);
          $admin->save();
          return response()->json($admin,200); 
     }

     /* Get all Admins */
     public function getalladmins()
     {
          $admins  = Admin::all();
          $total  = Admin::count();
          $role = Auth::guard('admin')->user()->role;
          return Response()->json(array('admins'=>$admins,'role'=>$role,'total'=>$total));
     }
     /* Delete User */
     public function deleteuser(Request $request)
     {
         $user = User::find($request->id);
         $user->delete();
         return Response()->json($user,200);
     }
     /* Delete Admin */
     public function deleteadmin(Request $request)
     {
      $admin = Admin::find($request->id);
      $admin->delete();
      return Response()->json($admin,200);
     }

     /* Get all Role */
     public function getrole()
     {
          $role  = Role::all();
          $total  = Role::count();
          $adminrole = Auth::guard('admin')->user()->role;
          return Response()->json(array('role'=>$role,'adminrole'=>$adminrole,'total'=>$total));
     }
      /* Add Role */
     public function addrole(Request $request)
     {
          $role  = new Role();
          $role->name = $request->role;
          $role->save();
          return response()->json($role,200); 
     }
      /* Edit Role */
     public function editrole(Request $request)
     {
          $role = Role::find($request->id);
          $role->name = $request->role;
          $role->save();
          return response()->json($role,200); 
     }
     /* Delete Role */
     public function deleterole(Request $request)
     {
         $role = Role::find($request->id);
         $role->delete();
         return Response()->json($role,200);
     }
     /* Get Search Role */
    public function getsearchrole(Request $request)
    {   
        $search = $request->data; 

        $role = DB::table('roles')
        ->where('name','LIKE',"%{$search}%")
        ->orderBy('created_at', 'asc')
        ->get();

        return Response()->json($role,200);
    }
    /* Get Admin */
    public function getadmin(Request $request)
    {   
      $id = Auth::guard('admin')->user()->id;
      $admin = Admin::find($id);
      return Response()->json($admin,200);
    }
    /* Change Admin Name */
    public function changename(Request $request)
    {   
      $id = Auth::guard('admin')->user()->id;
      $name = $request->name;
      $admin = Admin::find($id);
      $admin->name = $name;
      $admin->save();
      return Response()->json($name,200);
    }
     /* Change Admin Image */
    public function changeimage(Request $request)
    {   
      $id = Auth::guard('admin')->user()->id;
      $admin = Admin::find($id);

      $exploded = explode(',',$request->image);
      $decode = base64_decode($exploded[1]);
      if(str_contains($exploded[0],'jpeg')){
        $ext ='jpeg';
      }
      elseif(str_contains($exploded[0],'jpg')){
        $ext ='jpg';
      }
      else{
        $ext ='png'; 
      }

      $filename = str_random().'.'.$ext;
      $destinationpath =  public_path().'/upload/admins/'.$filename;
      // $destinationpath =  '/upload/admins/'.$filename;
      $image = file_put_contents($destinationpath, $decode);

      $admin->image = $filename;
      $admin->save();

      $data = "http://localhost:8000/upload/admins/".$filename;

      return Response()->json($data,200);

    }

    public function changepassword(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'oldpassword' => ' required',
        'password' => 'required|string|min:6|confirmed',
      ]);
      // Validation
      if ($validator->fails()) {
        return Response()->json(400);
      }

      $current_password = Auth::guard('admin')->User()->password;
      if(Hash::check($request->oldpassword, $current_password))
        {           
          $user_id = Auth::guard('admin')->User()->id;                       
          $user = Admin::find($user_id);

          $user->password =bcrypt($request->password);
          $user->save();

          return Response()->json(200);
        }
        else{
          return Response()->json(401);
        }
    }

}
