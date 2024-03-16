<?php

namespace App\Http\Controllers;

use App\Board;
use App\Classes;
use App\CreativeQuestion;
use App\Examination;
use App\McqQuestion;
use App\NormalExamQuestion;
use App\Section;
use App\Subject;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class PDFController extends BaseController
{
    // Create PDF School/ Madrasha
    public function createpdf($type, $cssecid)
    {
        $cid = substr($cssecid, 0, 1); // Get Class id
        $sid = substr($cssecid, 1, 1); // Get Subject id


        // Get Section id from cssecid
        if (strlen($cssecid) > '4') {
            $secid = substr($cssecid,2,3);
        }
        else{
            $secid = substr($cssecid,2,2);
        }

        $class = Classes::find($cid);

        if ($class->type == 'madrasha') {
            $type = $class->class;
            $class = Classes::where('class','=',$type)->first();
            $cid = $class->id;
        }

        $subject = Subject::find($sid);

        $classsubject = DB::table('classsubject')
        ->where([
            ['class_id', '=', $cid],
            ['subject_id', '=', $sid],
        ])
        ->first();
        
        if ($type =='creative') {

            if (Auth::user()) {
                $question = CreativeQuestion::where([
                    ['classsubject_id', '=', $classsubject->id],
                    ['section_id', '=',  $secid],
                ])
                ->get();
            }
            else{
                $question = CreativeQuestion::where([
                    ['classsubject_id', '=', $classsubject->id],
                    ['section_id', '=',  $secid],
                ])->limit(20)
                ->get();
            }


            $subsection = Section::where('id','=',$secid)->first();

           // return view('PDF.creativepdf', compact(['class', 'subsection', 'question', 'subject']));
            $pdf=PDF::loadView('PDF.creativepdf',['class' => $class,'subsection' => $subsection,'question' => $question,'subject' => $subject]);

            return $pdf->download('question.pdf');

        } 
        else{
            if (Auth::user()) {
                $question = NormalExamQuestion::where([
                    ['classsubject_id', '=', $classsubject->id],
                    ['section_id', '=',  $secid],
                ])
                ->get();
            }
            else{
                $question = NormalExamQuestion::where([
                    ['classsubject_id', '=', $classsubject->id],
                    ['section_id', '=',  $secid],
                ])->limit(20)
                ->get();
            }

            $subsection = Section::where('id','=',$secid)->first();


            //return view('PDF.mcqpdf', compact(['class', 'subsection', 'question', 'subject']));

            $pdf=PDF::loadView('PDF.mcqpdf',['class' => $class,'subsection' => $subsection,'question' => $question,'subject' => $subject]);
            return $pdf->download('question.pdf');

        }
    }




    // Create Normal PDF for University/BCS/Recruitment 
    public function createnormalpdf($clasubcid)
    {
        $cid = substr($clasubcid, 0, 2); // Get Class id
        $sid = substr($clasubcid, 2, 3); // Get Subject id


        $class = Classes::find($cid);

        $subject = Subject::find($sid);

        $classsubject = DB::table('classsubject')
        ->where([
            ['class_id', '=', $cid],
            ['subject_id', '=', $sid],
        ])
        ->first();
        

        if (Auth::user()) {
            $question = NormalExamQuestion::where([
                ['classsubject_id', '=', $classsubject->id]
            ])
            ->get();
        }
        else{
            $question = NormalExamQuestion::where([
                ['classsubject_id', '=', $classsubject->id]
            ])->limit(20)
            ->get();
        }

      
            //return view('PDF.mcqpdf', compact(['class', 'subsection', 'question', 'subject']));

        $pdf=PDF::loadView('PDF.normalmcqpdf',['class' => $class,'question' => $question,'subject' => $subject]);
        return $pdf->download('question.pdf');



    }




}
