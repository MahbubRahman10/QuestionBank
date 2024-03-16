@extends('layouts.master')

@section('title')
	@section('titlename', 'Home')
@endsection
@section('content')
	

	

	{{-- Index/Home page Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/index.css') }}">
	<?php
	$lang =  LaravelLocalization::getCurrentLocale();
     ?>
	@if ($lang == 'bn')
	<style type="text/css">
		.submitsearch{
			padding: 10px 35px 12px 35px;
			font-size:20px;
		}
	</style>
	@endif

	{{-- <style type="text/css">
	.etype{
		font-family: 'Kalpurush', sans-serif;		
	}
	</style> --}}


	{{-- Tab image and search input --}}
	<div class="tab">
		<div class="search">
			<form action="{{ LaravelLocalization::localizeURL('/search') }}" method="get" class="form">
				<input type="text" name="search" id="searchinput" class="form-control" placeholder="{{ __('index.Search Question') }}"  >
				 <button type="submit" name="" class="submitsearch"> @lang('index.SEARCH') </button>
			</form>
		</div>
	</div>

	<br>

	<div class="container" id="question">
		<div class="row">
			{{-- Question --}}
			<div class="animated zoomIn">
				<div class="col-md-12">
					<div class="col-md-4" id="questionimage">
						<a href="school">
							<img src="{{ asset('img/school.jpg') }}"> 
							<div class="qutitle">
								<h3 >@lang('index.School Question')</h3>
							</div>
						</a>
					</div>
					<div class="col-md-4" id="questionimage">
						<a href="madrasha">
							<img src="{{ asset('img/madrasha.jpg') }}"> 
							<div class="qutitle">
								<h3 >@lang('index.Madrasha Question')</h3>
							</div>
						</a>
					</div>
					<div class="col-md-4" id="questionimage">
						<a href="board">
							<img src="{{ asset('img/board.jpg') }}"> 
							<div class="qutitle">
								<h3 >@lang('index.Board Question')</h3>
							</div>
						</a>
					</div>
				</div>
				<br>
				<div class="col-md-12">
					<div class="col-md-4" id="questionimage">
						<a href="university/question">
							<img src="{{ asset('img/university.jpg') }}"> 
							<div class="qutitle">
								<h3 >@lang('index.University Question')</h3>
							</div>
						</a>
						
					</div>

					<div class="col-md-4" id="questionimage">
						<a href="bcs/10">
							<img src="{{ asset('img/bcs.jpg') }}"> 
							<div class="qutitle">
								<h3 >@lang('index.BCS Question')</h3>
							</div>
						</a>
					</div>

					<div class="col-md-4" id="questionimage">
						<a href="recruitment/question">
							<img src="{{ asset('img/job.jpg') }}"> 
							<div class="qutitle">
								<h3 >@lang('index.Recruitment Question')</h3>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>


	{{-- Exam --}}

	<div class="container" id="exam">
		<div class="row">
			<h1 class="etitle">{{-- @lang('index.EXAM') --}}</h1>
			<div class="col-md-12">
				<div class="col-md-3">
					<h3 class="etype"> <span class="glyphicon glyphicon-book" id="eicon"></span>  @lang('index.School Exam')</h3>
					<h4 class="esection"> <span class="arrow">>  </span> <a href="exams/school/class/6">  @lang('index.Class VI') </a></h4> 
					<h4 class="esection"> <span class="arrow">>  </span> <a href="exams/school/class/7"> @lang('index.Class VII')  </a></h4> 
					<h4 class="esection"> <span class="arrow">>  </span> <a href="exams/school/class/8"> @lang('index.Class VIII') </a></h4> 
					<h4 class="esection"> <span class="arrow">>  </span> <a href="exams/school/class/9-10"> @lang('index.Class IX - X') </a></h4>
				</div>
				<div class="col-md-3">
					<h3 class="etype"> <span class="glyphicon glyphicon-book" id="eicon"></span>  @lang('index.Madrasha Exam') </h3>
					<h4 class="esection"> <span class="arrow">>  </span> <a href="exams/madrasha/class/6">  @lang('index.Class VI') </a></h4> 
					<h4 class="esection"> <span class="arrow">>  </span> <a href="exams/madrasha/class/7"> @lang('index.Class VII')  </a></h4> 
					<h4 class="esection"> <span class="arrow">>  </span> <a href="exams/madrasha/class/8"> @lang('index.Class VIII') </a></h4> 
					<h4 class="esection"> <span class="arrow">>  </span> <a href="exams/madrasha/class/9-10"> @lang('index.Class IX - X') </a></h4>
				</div>
				<div class="col-md-3">
					<h3 class="etype"><span class="glyphicon glyphicon-book" id="eicon"></span> @lang('index.University Exam') </h3>
					<h4 class="esection"> <span class="arrow">>  </span> <a href="exams/university/normal">  @lang('index.Normal') </a></h4> 
					<h4 class="esection"> <span class="arrow">>  </span> <a href="exams/university/engineering">  @lang('index.Engineering') </a></h4> 
					<h4 class="esection"> <span class="arrow">>  </span> <a href="exams/university/technology">  @lang('index.Technology') </a></h4> 
					<h4 class="esection"> <span class="arrow">>  </span> <a href="exams/university/agriculture">  @lang('index.Agriculture') </a></h4>
				</div>
				<div class="col-md-3">
					<h3 class="etype"><span class="glyphicon glyphicon-book" id="eicon"></span>  @lang('index.Govt Exam')</h3>
					<h4 class="esection"> <span class="arrow">>  </span> <a href="exams/bcs">  @lang('index.BCS Exam') </a></h4> 
					<h4 class="esection"> <span class="arrow">>  </span> <a href="exams/ntrca">  @lang('index.NTRCA Exam') </a></h4> 
					<h4 class="esection"> <span class="arrow">>  </span> <a href="exams/dpe">  @lang('index.Primary') </a></h4> 
					<h4 class="esection"> <span class="arrow">>  </span> <a href="exams/bank">  @lang('index.Bank Exam') </a></h4> 
				</div>
			</div>			
		</div>
	</div>





@endsection



