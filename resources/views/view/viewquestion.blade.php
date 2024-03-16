@extends('layouts.master')
@section('title')
	@section('titlename')Question
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
					<h1 class="vtitle">@lang('index.School Question')</h1>
					<ul>
						<li> <a href="question/view/school/1"> @lang('index.Class VI')  </a> </li>
						<li> <a href="question/view/school/2"> @lang('index.Class VII')  </a> </li>
						<li> <a href="question/view/school/3"> @lang('index.Class VIII')  </a> </li>
						<li> <a href="question/view/school/4"> @lang('index.Class IX - X')  </a> </li>
					</ul>
				</div>
			</div>
			<div class="col-md-3">
				<div class="details">
					<h1 class="vtitle">@lang('index.Madrasha Question')</h1>
					<ul>
						<li> <a href="question/view/madrasha/6"> @lang('index.Class VI')  </a> </li>
						<li> <a href="question/view/madrasha/7"> @lang('index.Class VII')  </a> </li>
						<li> <a href="question/view/madrasha/8"> @lang('index.Class VIII')  </a> </li>
						<li> <a href="question/view/madrasha/9"> @lang('index.Class IX - X')  </a> </li>
					</ul>
				</div>
			</div>
			{{-- <div class="col-md-3">
				<div class="details">
					<h1 class="vtitle">@lang('index.Board') Question</h1>
					<ul>
						<li> <a href=""> @lang('index.Dhaka') @lang('index.Board')  </a> </li>
						<li> <a href=""> @lang('index.Chittagong') @lang('index.Board') </a> </li>
						<li> <a href=""> @lang('index.Comilla') @lang('index.Board') </a> </li>
						<li> <a href=""> @lang('index.Sylhet') @lang('index.Board') </a> </li>
						<li> <a href=""> @lang('index.Rajshahi') @lang('index.Board') </a> </li>
						<li> <a href=""> @lang('index.Jessore') @lang('index.Board') </a> </li>	
						<li> <a href=""> @lang('index.Dinajpur') @lang('index.Board') </a> </li>
						<li> <a href=""> @lang('index.Barisal') @lang('index.Board') </a> </li>
						<li> <a href=""> @lang('index.Madrasha') @lang('index.Board') </a> </li>
					</ul>
				</div>
			</div> --}}

			<div class="col-md-3">
				<div class="details">
					<h1 class="vtitle">@lang('index.University Question') </h1>
					<ul>
						<li> <a href="/university/question/normal/10"> @lang('index.Normal')  </a> </li>
						<li> <a href="/university/question/engineering/10"> @lang('index.Engineering') </a> </li>
						<li> <a href="/university/question/technology/10"> @lang('index.Technology') </a> </li>
						<li> <a href="/university/question/agriculture/10"> @lang('index.Agriculture') </a> </li>
					</ul>
				</div>
			</div>
			<div class="col-md-3">
				<div class="details">
					<h1 class="vtitle">@lang('index.Other Question')</h1>
					<ul>
						<li> <a href="/recruitment/question/ntrca/10"> @lang('index.NTRCA Exam')  </a> </li>
						<li> <a href="/bcs/10"> @lang('index.BCS Exam') </a> </li>
						<li> <a href="/recruitment/question/dpe/10"> @lang('index.Primary') </a> </li>
						<li> <a href="/recruitment/question/bank/10"> @lang('index.Bank Exam') </a> </li>
					</ul>
				</div>
			</div>
		</div>
		{{-- <div class="row">
			
		</div> --}}
	</div>

	
@endsection
