<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Controllers\ActivityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{ 
    public function index()
    {
      return view('contact.contact');
    }

    // Save Message
    public function create(Request $request)
    {

      $validator = Validator::make($request->all(), [
        'name' => ' required',
        'email' => 'required|email',
        'message' => 'required',

      ]);
      // Validation
      if ($validator->fails()) {
        return back()
        ->withErrors($validator)
        ->withInput();
      }

      $contact = new Contact();
      $contact->name = $request->name;
      $contact->email = $request->email;
      $contact->message = $request->message;
      $contact->save();

      return back()->with('msg','Thank you for your message. We will contact you as soon as possible.');
    }
}
