@extends('layouts.master')
@section('title')
     @section('titlename'){{ucfirst($category)}} Question
@endsection
@section('content')

	{{-- Index/Home page Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/viewquestion.css') }}">
	
	<br>
	<div class="container" id="viewquestionsolution" >
		<div class="col-md-12" >
			@php 
			$i = 0; 
			$english =array('0','1','2','3','4','5','6','7','8','9');
			$bangla =array('০','১','২','৩','৪','৫','৬','৭','৮','৯'); 
			@endphp		
			@foreach ($questions as $question)
			<div class="col-sm-3" id="boardquestion">
				<a href="/SolutionQuestion/{{$question->id }}" style="">
					<h3 class="boardquestion" >
						<div  id="questionsolve" >
							@if($category == 'bcs')
							<img src="{{ asset('img/bcs.jpg') }}" height="100%" width="100%" style="border: 1px solid darkgray;">
							@elseif($category == 'teacher')
							<img src="{{ asset('img/teacher.jpg') }}" height="100%" width="100%" style="border: 1px solid darkgray;">
							@elseif($category == 'university')
							<img src="{{ asset('img/universitys.jpg') }}" height="100%" width="100%" style="border: 1px solid darkgray;">
							@elseif($category == 'bank')
							<img src="{{ asset('img/banks.jpg') }}" height="100%" width="100%" style="border: 1px solid darkgray;">
							@endif
							

							<div class="qutitle">
								<h3>{{ $question->title }} {{ $question->year }}	</h3>
							</div>
						</div>
					</h3>
				</a>
			</div>
			@endforeach 
		</div>
	</div>
	@if (!Auth::user())
	<h1 class="getmore" style="margin-top:0px;">Get <a href="/login">Login</a>/<a href="/register">Register</a> to view more Question</h1>
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
