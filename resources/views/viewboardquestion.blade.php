@extends('layouts.master')
@section('title')
	@section('titlename'){{$board->board_name}} - {{$examination->exam_name}}
@endsection
@section('content')

	{{-- Index/Home page Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/viewquestion.css') }}">
	
	<br>
	<div class="container" id="viewquestion">
		<div class="col-md-12" >
			<div class="col-md-3" id="sections">
				<h3>{{$board->board_name}} - {{$examination->exam_name}}
					<a href="" class="question-icon">
						<i class="fa fa-bars fa-2x" id="qicon"></i>
					</a>
				</h3>
				<ul id="qmenu">
					@php
					$english =array('0','1','2','3','4','5','6','7','8','9');
					$bangla =array('০','১','২','৩','৪','৫','৬','৭','৮','৯'); 
					@endphp
					{{-- @foreach ($subject as $data)
						<a @if ($data->id == $subid ) id="sectionactive"   @else href="/board/question/{{$bid}}{{$eid}}{{$data->id}}" @endif><li> {{ $data->subject_name }} </li></a>
					@endforeach --}}
					@foreach ($years as $year)
					<a @if (str_replace($bangla,$english,$year->year) == $activieyear ) id="sectionactive"   @else href="/board/question/{{$bid}}{{$eid}}{{ str_replace($bangla,$english,$year->year) }}" @endif><li> {{ $year->year }} </li></a>
					@endforeach
					


				</ul>
			</div>
			<div class="col-md-9" id="question" >
				
				<h1> @if($board->board_name == 'Dhaka Board') @lang('index.Dhaka') @lang('index.Board') @elseif($board->board_name == 'Chittagong Board') @lang('index.Chittagong') @lang('index.Board') @elseif($board->board_name == 'Rajshahi Board') @lang('index.Rajshahi') @lang('index.Board') @elseif($board->board_name == 'Sylhet Board') @lang('index.Sylhet') @lang('index.Board') @elseif($board->board_name == 'Dinajpur Board') @lang('index.Dinajpur') @lang('index.Board') @elseif($board->board_name == 'Barisal Board') @lang('index.Barisal') @lang('index.Board') @elseif($board->board_name == 'Comilla Board') @lang('index.Comilla') @lang('index.Board') @elseif($board->board_name == 'Jessore Board') @lang('index.Jessore') @lang('index.Board') @elseif($board->board_name == 'Madrasah Board') @lang('index.Madrasha') @lang('index.Board')  @endif - @if($examination->exam_name == 'JSC') @lang('index.jsc')  @elseif($examination->exam_name == 'SSC') @lang('index.ssc') @elseif($examination->exam_name == 'HSC') @lang('index.hsc') @elseif($examination->exam_name == 'JDC') @lang('index.jdc') @elseif($examination->exam_name == 'DAKHIL') @lang('index.dakhil')  @elseif($examination->exam_name == 'ALIM') @lang('index.alim') @endif @lang('index.EXAM') </h1>
				{{-- <h4> বিষয় :  {{ $getsubject->subject_name }}</h4> --}}
				<hr class="bhr">  
				<br>

				@php 
					$i = 0; 
					$english =array('0','1','2','3','4','5','6','7','8','9');
					$bangla =array('০','১','২','৩','৪','৫','৬','৭','৮','৯'); 
				@endphp		
				@if (count($question) == '0')
					<h1 class="nodata">@lang('index.nodata')</h1>
				@endif
				@foreach ($question as $questions)
					<div class="col-sm-3" id="boardquestion">
					<a href="http://localhost:8000/BoardQuestion/{{$questions->question }}" style="">
					<h3 class="boardquestion" >
							<p class="bquestion">{{ $questions->subject_name }}</p>  <p class="year"> {{ $questions->year }}</p>
						
					</h3>
					</a>
					</div>
				@endforeach
			</div>
		</div>
	</div>
	@if (!Auth::user())
	<h1 class="getmore" style="margin-top:30px;">Get <a href="/login" >Login</a>/<a href="/register">Register</a> to view more Question</h1> 
	@endif

	{{-- Question Section menu script  --}}
	<script type="text/javascript"> 
		$(document).ready(function(){
			$('.question-icon').on('click', function(e){
				e.preventDefault();
				var check = $("#qmenu").hasClass("qshowing");
				if(check == false){
					$("#qmenu").addClass("qshowing");
					$(".qshowing").css("display","block");
				}
				else{
					$("#qmenu").removeClass("qshowing");
					$("#qmenu").css("display","none");
				}
			});
		});
	</script>
	
@endsection
