@extends('layouts.master')
@section('title')
	@section('titlename')Exam
@endsection
@section('content')

	{{-- Nav page Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/view.css') }}">

	<div class="container">		
		<div class="row" id="viewquestion">
{{-- 			<h1 class="question"> Question </h1> --}}
			<hr id="questioncategory">
			<div class="col-md-3">
				<div class="details">
					<h1 class="vtitle">@lang('index.School') @lang('index.EXAM')</h1>
					<ul>
						<li> <a href="exams/school/class/6"> @lang('index.Class VI')  </a> </li>
						<li> <a href="exams/school/class/7"> @lang('index.Class VII')  </a> </li>
						<li> <a href="exams/school/class/8"> @lang('index.Class VIII')  </a> </li>
						<li> <a href="exams/school/class/9"> @lang('index.Class IX - X')  </a> </li>
					</ul>
				</div>
			</div>
			<div class="col-md-3">
				<div class="details">
					<h1 class="vtitle">@lang('index.Madrasha') @lang('index.EXAM')</h1>
					<ul>
						<li> <a href="exams/madrasha/class/6"> @lang('index.Class VI')  </a> </li>
						<li> <a href="exams/madrasha/class/7"> @lang('index.Class VII')  </a> </li>
						<li> <a href="exams/madrasha/class/8"> @lang('index.Class VIII')  </a> </li>
						<li> <a href="exams/madrasha/class/9"> @lang('index.Class IX - X')  </a> </li>	
					</ul>
				</div>
			</div>
			<div class="col-md-3">
				<div class="details">
					<h1 class="vtitle">@lang('index.University Exam')</h1>
					<ul>
						<li> <a href="exams/university/normal"> @lang('index.Normal')  </a> </li>
						<li> <a href="exams/university/engineering"> @lang('index.Engineering') </a> </li>
						<li> <a href="exams/university/technology"> @lang('index.Technology') </a> </li>
						<li> <a href="exams/university/agriculture"> @lang('index.Agriculture') </a> </li>

					</ul>
				</div>
			</div>
			<div class="col-md-3">
				<div class="details">
					<h1 class="vtitle">@lang('index.Govt Exam')</h1>
					<ul>
						<li> <a href="exams/bcs"> @lang('index.BCS Exam')  </a> </li>
						<li> <a href="exams/ntrca"> @lang('index.NTRCA Exam') </a> </li>
						<li> <a href="exams/dpe"> @lang('index.Primary') </a> </li>
						<li> <a href="exams/bank"> @lang('index.Bank Exam') </a> </li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	
@endsection
