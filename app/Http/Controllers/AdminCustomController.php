<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Category;
use App\ClassSubject;
use App\Classes;
use App\Comment;
use App\Forum;
use App\ForumVisitor;
use App\Like;
use App\Reply;
use App\Section;
use App\Subject;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AdminCustomController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
      $blog = Blog::count();
      $comment = Comment::count();

      return Response()->json(array('post'=>$blog,'comment'=>$comment));
    }


    // Get Subject
    public function getsubject()
    { 
      $subject = Subject::orderBy('created_at', 'asc')->paginate(20);
      $total = Subject::count();

      return Response()->json(array('subject'=>$subject,'total'=>$total));
    }
    /* Delete Subject */
     public function deletesubject(Request $request)
     {
        $subject = Subject::find($request->id);
        $subject->delete();
        return Response()->json($subject,200);
     }
     /* Add Subject */
     public function addsubject(Request $request)
     {

      $subject  = new Subject();
      $subject->subject_name = $request->subject;
      $subject->save();

      return response()->json($subject,200); 
    }

    /* Edit Subject */
     public function editsubject(Request $request)
     {

      $subject  = Subject::find($request->id);
      $subject->subject_name = $request->subject;
      $subject->save();

      return response()->json($subject,200); 
    }

    /* Get Search Subject */
    public function getsearchsubject(Request $request)
    {   
        $search = $request->data; 

        $subject = DB::table('subjects')
        ->where('subject_name','LIKE',"%{$search}%")
        ->orderBy('created_at', 'asc')
        ->get();

        return Response()->json($subject,200);
    }
  

    /* Get Search Subject with Category */
    public function getcustomsearchsubject(Request $request)
    {   
        $search = $request->data; 

        $class =  Classes::where('class','=',$request->category)->first();

        $subject = DB::table('classsubject')
        ->join('subjects', 'subjects.id', '=', 'classsubject.subject_id')
        ->where([['classsubject.class_id', '=', $class->id],['subjects.subject_name','LIKE',"%{$search}%"]])
        ->orderBy('subjects.created_at', 'asc')
        ->get();

        return Response()->json($subject,200);
    }
  

    // Get all Class
    public function getallclass(Request $request)
    { 
      $classes = Classes::where([['type','=',$request->category],['class','=','১১-১২তম শ্রেণি']])->get();
      return Response()->json($classes);
    }

    // Get all University
    public function getalluniversity(Request $request)
    { 
      $university = Classes::where('type','=','university')->get();
      return Response()->json($university);
    }

    // Get all All Job Category
    public function getalljobcategory(Request $request)
    { 
      $category = Classes::where('type','=',null)->get();
      return Response()->json($category);
    }


     /* Get University Subject */
    public function getalljobcategorysubject(Request $request)
    {
        $class =  Classes::where('class','=',$request->category)->first();

        $subject = DB::table('classsubject')
        ->join('classes', 'classes.id', '=', 'classsubject.class_id')
        ->join('subjects', 'subjects.id', '=', 'classsubject.subject_id')
        ->where('classsubject.class_id','=',$class->id)
        ->paginate(20);

         $total = DB::table('classsubject')
        ->join('classes', 'classes.id', '=', 'classsubject.class_id')
        ->join('subjects', 'subjects.id', '=', 'classsubject.subject_id')
        ->where('classsubject.class_id','=',$class->id)
        ->count();


        return Response()->json(array('subject'=>$subject,'total'=>$total));
    }

     /* Get University Subject */
    public function getuniversitysubject(Request $request)
    {
        $class =  Classes::where('class','=',$request->university)->first();

        $subject = DB::table('classsubject')
        ->join('classes', 'classes.id', '=', 'classsubject.class_id')
        ->join('subjects', 'subjects.id', '=', 'classsubject.subject_id')
        ->where('classsubject.class_id','=',$class->id)
        ->paginate(20);

         $total = DB::table('classsubject')
        ->join('classes', 'classes.id', '=', 'classsubject.class_id')
        ->join('subjects', 'subjects.id', '=', 'classsubject.subject_id')
        ->where('classsubject.class_id','=',$class->id)
        ->count();


        return Response()->json(array('subject'=>$subject,'total'=>$total));
    }


    /* Add Subject to class */
     public function addsubjecttoclass(Request $request)
     {

      $class =  Classes::where('class','=',$request->category)->first();
      $subject = Subject::where('subject_name','=',$request->subject)->first();
     

     $classsubject = new  ClassSubject();
     $classsubject->class_id = $class->id;
     $classsubject->subject_id = $subject->id;
     $classsubject->save();

      $subject = DB::table('classsubject')
        ->join('classes', 'classes.id', '=', 'classsubject.class_id')
        ->join('subjects', 'subjects.id', '=', 'classsubject.subject_id')
        ->where('classsubject.id','=',$classsubject->id)
        ->first();


      return response()->json($subject,200); 
    }

    /* Delete ClassSubject */
     public function deleteclasssubject(Request $request)
     {  
        $class =  Classes::where('class','=',$request->category)->first();
        $subject = Subject::where('id','=',$request->id)->first();

        $classsubject = ClassSubject::where([['class_id','=',$class->id],['subject_id','=',$subject->id]])->first();
        $classsubject->delete();
        return Response()->json($classsubject,200);
     }


      /* Get Subject sections */
    public function getsection(Request $request)
    {
        $class = Classes::find($request->cid);


        if ($class->type == 'madrasha') {
           $madclass = Classes::where('class','=',$class->class)->first();
           $mcid = $madclass->id;
           
           $madclasssubject = ClassSubject::find($request->sid);
           $madsubject = $madclasssubject->subject_id;

           $classsubject = ClassSubject::where([
                            ['class_id', '=', $mcid],
                            ['subject_id', '=', $madsubject]
                        ])->first();

            if ($classsubject){
                $sections = DB::table('classsubject')
                ->join('sections', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->where([
                    ['sections.ClassSubject_id', '=', $classsubject->id],
                    ['classsubject.class_id', '=', $mcid]
                ])
                ->paginate(20);

                $total = DB::table('classsubject')
                ->join('sections', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->where([
                    ['sections.ClassSubject_id', '=', $classsubject->id],
                    ['classsubject.class_id', '=', $mcid]
                ])
                ->count();
            }
            else{
                $sections = DB::table('classsubject')
                ->join('sections', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->where([
                    ['sections.ClassSubject_id', '=', $request->sid],
                    ['classsubject.class_id', '=', $request->cid]
                ])
                ->paginate(20);

                $total = DB::table('classsubject')
                ->join('sections', 'classsubject.id', '=', 'sections.ClassSubject_id')
                ->where([
                    ['sections.ClassSubject_id', '=', $request->sid],
                    ['classsubject.class_id', '=', $request->cid]
                ])
                ->count();
            }
        }
        else{            
            $sections = DB::table('classsubject')
            ->join('sections', 'classsubject.id', '=', 'sections.ClassSubject_id')
            ->where([
                ['sections.ClassSubject_id', '=', $request->sid],
                ['classsubject.class_id', '=', $request->cid]
            ])
            ->paginate(20);



            $total = DB::table('classsubject')
            ->join('sections', 'classsubject.id', '=', 'sections.ClassSubject_id')
            ->where([
                ['sections.ClassSubject_id', '=', $request->sid],
                ['classsubject.class_id', '=', $request->cid]
            ])
            ->count();            
        }


      return Response()->json(array('section'=>$sections,'total'=>$total));
    }


    public function addsectiontosubject(Request $request)
    {
        $section = new Section();
        $section->section_no = $request->sectionno;
        $section->section_name = $request->section;
        $section->ClassSubject_id = $request->clasubid;
        $section->save();

        return Response()->json($section);
    } 

    public function editsection(Request $request)
    {
        $section = Section::find($request->id);
        $section->section_no = $request->sectionno;
        $section->section_name = $request->section;
        $section->save();

        return Response()->json($section);
    } 

    /* Delete Section */
     public function deletesubjectsection(Request $request)
     {
        $section = Section::find($request->id);
        $section->delete();
        return Response()->json($section,200);
     }

      /* Get Search Subject */
      public function getsearchsection(Request $request)
      {   
        $search = $request->data; 

        $section = DB::table('sections')
        ->where([['ClassSubject_id','=',$request->id],['section_name','LIKE',"%{$search}%"]])
        ->orderBy('created_at', 'asc')
        ->get();

        return Response()->json($section,200);
      }

}



