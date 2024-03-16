<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LanguageController extends Controller
{
   public function __construct()
   {

   }

    public function index()
    {
     

      // $b =  LaravelLocalization::setLocale('bn');

      // $d = LaravelLocalization::getCurrentLocale();
     
      // return Redirect()->back();


    }

}   