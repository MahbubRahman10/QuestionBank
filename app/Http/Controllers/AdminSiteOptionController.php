<?php

namespace App\Http\Controllers;

use App\SiteOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AdminSiteOptionController extends Controller
{
    public function __construct()
    {

    }
    // Get Site Data
    public function getdata()
    { 
      $adminrole = Auth::guard('admin')->user()->role;
      $site = SiteOption::find(1);
      return Response()->json(array('site'=>$site,'adminrole'=>$adminrole));
    }
    // Site Title
    public function sitetitle(Request $request)
    { 
      $site = SiteOption::find(1);
      $site->title = $request->title;
      $site->subtitle = $request->subtitle;
      $site->save(); 
      return response()->json(200);
    }
    // Site Theme
    public function sitetheme(Request $request)
    { 
      $site = SiteOption::find(1);
      $site->theme = $request->theme;
      $site->save(); 
      return response()->json(200);
    }
    // Site Social
    public function sitesocial(Request $request)
    { 
      $site = SiteOption::find(1);
      $site->facebook = $request->facebook;
      $site->twitter = $request->twitter;
      $site->googleplus = $request->googleplus;
      $site->youtube = $request->youtube;
      $site->save(); 
      return response()->json(200);
    }
    // Site Footer
    public function sitefooter(Request $request)
    { 
      $site = SiteOption::find(1);
      $site->copyright  = $request->copyright;
      $site->footerdes  = $request->description;
      $site->save(); 
      return response()->json(200);
    }
    
}
