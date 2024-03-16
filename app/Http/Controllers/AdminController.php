<?php

namespace App\Http\Controllers;

use App\User;
use  Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getalladmin()
    {
        $admin  = User::where('id','!=', Auth::id())->get();
        return response()->json($admin,200); 
    }


    public function index()
    {
        //
    }


    public function create()
    {
        
    }

    public function store(Request $request)
    {
   
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        //
    }
}
