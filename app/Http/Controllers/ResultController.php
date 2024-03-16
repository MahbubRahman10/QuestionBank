<?php

namespace App\Http\Controllers;

use App\Board;
use App\BoardQuestion;
use App\Charts\BarChart;
use App\Charts\PieChart;
use App\Charts\SampleChart;
use App\ClassSubject;
use App\Classes;
use App\CreativeQuestion;
use App\Examination;
use App\Http\Controllers\ActivityController;
use App\McqQuestion;
use App\NormalExamQuestion;
use App\Result;
use App\Section;
use App\Subject;
use App\TestQuestion;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Session;

class ResultController extends BaseController
{   

    public function index()
    {
        dd("OK");
    }    
    public function overview($token)
    {

        // $length = strlen($token);
        
        // if ($length == '5') {
        //     $category = 'full';
        // }
        // else{
        //     $category = 'part';
        // }




        $result  = Result::where('etoken','=',$token)->first();
       
        $class = Classes::find($result->class_id);
        $subject = Subject::find($result->subject_id);
        $section = Section::find($result->section_id);


        if ($subject == null) {
             // Average
            $average = Result::where([['class_id','=',$result->class_id],['subject_id','=',null]])->avg('right_answer');
            $average = (int)$average;

        // Participate
            $users = Result::where([['class_id','=',$result->class_id],['subject_id','=',null]])->get();
            $users = $users->unique('user_id');
            $participate = count($users); 

        // Higest Mark
            $highest = Result::where([['class_id','=',$result->class_id],['subject_id','=',null]])->max('percentage');

        // Lowests Mark
            $lowest = Result::where([['class_id','=',$result->class_id],['subject_id','=',null]])->min('percentage');


        // Pie Chart
            $results= DB::table('results')
            ->where([['class_id','=',$result->class_id],['subject_id','=',null]])
            ->select('percentage', DB::raw('count(*) as total'))
            ->groupBy('percentage')
            ->get();
            $percentagename = array();
            $totalpercentage = array();
            $percentagecolor = array();
            for ($i=0; $i <count($results); $i++) { 
                $percentagename[$i]=$results[$i]->percentage.'%';
                $totalpercentage[$i]=$results[$i]->total;
                $percentagecolor[$i] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            }
            $chart = new PieChart;
            $chart->dataset('Sample', 'pie', $totalpercentage)->options(['backgroundColor' => $percentagecolor]);
            $chart->labels($percentagename);
            $chart->width('350');
            $chart->height('250');

        // Doughnut Chart
            $barresults= DB::table('results')
            ->join('users', 'users.id', '=', 'results.user_id')
            ->where([['class_id','=',$result->class_id],['subject_id','=',null]])
            ->select('users.name', DB::raw('AVG(results.percentage) as total'))
            ->groupBy('users.name')
            ->get();


            $barpercentagename = array();
            $bartotalpercentage = array();
            $barpercentagecolor = array();
            for ($i=0; $i <count($barresults); $i++) { 
                $barpercentagename[$i]=$barresults[$i]->name;
                $bartotalpercentage[$i]=$barresults[$i]->total;
                $barpercentagecolor[$i] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            }

            $doughnutchart = new BarChart;
            $doughnutchart->dataset('Score','bar', $bartotalpercentage)->options(['backgroundColor' => $barpercentagecolor]);
            $doughnutchart->labels($barpercentagename);
            $doughnutchart->width('350');
            $doughnutchart->height('250');
        }
        else{
            // Average
            $average = Result::where([['class_id','=',$result->class_id],['subject_id','=',$result->subject_id]])->avg('right_answer');
            $average = (int)$average;

        // Participate
            $users = Result::where([['class_id','=',$result->class_id],['subject_id','=',$result->subject_id]])->get();
            $users = $users->unique('user_id');
            $participate = count($users); 

        // Higest Mark
            $highest = Result::where([['class_id','=',$result->class_id],['subject_id','=',$result->subject_id]])->max('percentage');

        // Lowests Mark
            $lowest = Result::where([['class_id','=',$result->class_id],['subject_id','=',$result->subject_id]])->min('percentage');


        // Pie Chart
            $results= DB::table('results')
            ->where([['class_id','=',$result->class_id],['subject_id','=',$result->subject_id]])
            ->select('percentage', DB::raw('count(*) as total'))
            ->groupBy('percentage')
            ->get();
            $percentagename = array();
            $totalpercentage = array();
            $percentagecolor = array();
            for ($i=0; $i <count($results); $i++) { 
                $percentagename[$i]=$results[$i]->percentage.'%';
                $totalpercentage[$i]=$results[$i]->total;
                $percentagecolor[$i] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            }
            $chart = new PieChart;
            $chart->dataset('Sample', 'pie', $totalpercentage)->options(['backgroundColor' => $percentagecolor]);
            $chart->labels($percentagename);
            $chart->width('350');
            $chart->height('250');

        // Doughnut Chart
            $barresults= DB::table('results')
            ->join('users', 'users.id', '=', 'results.user_id')
            ->where([['class_id','=',$result->class_id],['subject_id','=',$result->subject_id]])
            ->select('users.name', DB::raw('AVG(results.percentage) as total'))
            ->groupBy('users.name')
            ->get();


            $barpercentagename = array();
            $bartotalpercentage = array();
            $barpercentagecolor = array();
            for ($i=0; $i <count($barresults); $i++) { 
                $barpercentagename[$i]=$barresults[$i]->name;
                $bartotalpercentage[$i]=$barresults[$i]->total;
                $barpercentagecolor[$i] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            }

            $doughnutchart = new BarChart;
            $doughnutchart->dataset('Score','bar', $bartotalpercentage)->options(['backgroundColor' => $barpercentagecolor]);
            $doughnutchart->labels($barpercentagename);
            $doughnutchart->width('350');
            $doughnutchart->height('250');

        }



        
        return view('exam.overview',compact(['average','participate','highest','lowest','class','subject','section','chart','doughnutchart']));
        


    }
}
