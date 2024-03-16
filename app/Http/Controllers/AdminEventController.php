<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Event;
use App\Http\Controllers\ActivityController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AdminEventController extends Controller
{ 
    public function index(Request $request)
    {

      $date = $request->date;

      if ($date == "current") {
        $date = Carbon::now()->format('d-m-Y');
      }
      else{
        $date =  $date = Carbon::parse($request->date)->format('d-m-Y');
      }
      $event = Event::where('date','=',$date)->get();
      return Response()->json($event,200);
    }

    public function addevent(Request $request)
    {
      $event = new Event();
      $event->event_title = $request->title;
      $event->event_description = $request->description;
      $event->date = Carbon::parse($request->date)->format('d-m-Y');
      $event->save(); 

      return Response()->json($event,200);
    }

    public function editevent(Request $request)
    {
      $event = Event::find($request->id);
      $event->event_title = $request->title;
      $event->event_description = $request->description;
      $event->date = $request->date;
      $event->save(); 

      return Response()->json($event,200);
    }

    public function deleteevent(Request $request)
    {
      $event = Event::find($request->id);;
      $event->delete(); 
      return Response()->json(200);
    }





}
