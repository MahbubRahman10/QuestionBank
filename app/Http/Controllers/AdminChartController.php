<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Blog;
use App\Board;
use App\BoardExamQuestion;
use App\BoardQuestion;
use App\ClassSubject;
use App\Forum;
use App\NormalExamQuestion;
use App\Questionsolution;
use App\Role;
use App\Section;
use App\TestQuestion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminChartController extends Controller
{
    // Visitor
    public function visitorchart()
    {
        $now = date('Y-m-d h:m:s ' , strtotime('-7 days'));

        $items = array();
        $totals = array();
        $j=DB::table('visitlogs')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'))
        ->where('created_at','>=', $now)
        ->groupBy('date')
        ->get();
        $result = count($j);

        for ($i=0; $i <$result; $i++) { 
            $items[$i]=$j[$i]->date;
            $totals[$i]=$j[$i]->views;
        }

        $response = [
            'label' => $items,
            'data'  => $totals 
        ];
        return response()->json($response,200);
    }


    // User
    public function piechart()
    {

        $question = NormalExamQuestion::count();
        $forum  = Forum::count();
        $user  = User::count();
        $solution  = Questionsolution::count();
        $blog  = Blog::count();


        $response = [
            'question' => $question,
            'forum' => $forum,
            'user' => $user,
            'solution'  => $solution,
            'blog'  => $blog 
        ];
        return response()->json($response,200);
    }



    // User
    public function userchart()
    {
        $now = date('Y-m-d h:m:s ' , strtotime('-7 days'));

        $total = User::count();
        $new  = User::where('created_at','>=', $now)->count();

        $items = array();
        $totals = array();
        $j=DB::table('users')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'))
        // ->where('created_at','>=', $now)
        ->groupBy('date')
        ->get();
        $result = count($j);

        for ($i=0; $i <$result; $i++) { 
            $items[$i]=$j[$i]->date;
            $totals[$i]=$j[$i]->views;
        }

        $response = [
            'new' => $new,
            'total' => $total,
            'label' => $items,
            'data'  => $totals 
        ];
        return response()->json($response,200);
    }






    // Admin
    public function adminchart()
    {
        $now = date('Y-m-d h:m:s ' , strtotime('-7 days'));

        $role = Role::count();
        $admin  = Admin::count();

        $items = array();
        $totals = array();
        
        $j=DB::table('roles')
        ->join('admins', 'admins.role', '=', 'roles.name')
        ->select(DB::raw('roles.name as name'), DB::raw('count(*) as total'))
        // ->where('created_at','>=', $now)
        ->groupBy('name')
        ->get();
        
        $result = count($j);

        for ($i=0; $i <$result; $i++) { 
            $items[$i]=$j[$i]->name;
            $totals[$i]=$j[$i]->total;
        }
        $adminrole = Auth::guard('admin')->user()->role;
        $response = [
            'admin' => $admin,
            'role' => $role,
            'label' => $items,
            'data'  => $totals,
            'adminrole' => $adminrole
        ];
        return response()->json($response,200);
    }



}