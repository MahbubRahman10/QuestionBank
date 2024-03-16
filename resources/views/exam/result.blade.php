@extends('layouts.master')
	@section('title')
		@section('titlename')Result
	@endsection
@section('content')
	<style type="text/css">
	span.exams {
		font-size: 18px;
	}
	</style>
	
	<?php
	$lang =  LaravelLocalization::getCurrentLocale();
     ?>
	@if ($lang == 'bn')
	<style type="text/css">
		span.exams.subject{
			font-size:20px;
		}
	</style>
	@endif


	{{-- Index/Home page Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/getexam.css') }}">
	
	<div class="container" id="exam">
		<div class="row">
			{{-- Exam --}}
			<div class="startexam">
			
				@if (Session::get('Exam.section') != null)					
					<div>  <label> @lang('exam.subject') : 	</label>  <span class="exams subject"> {{Session::get('Exam.subject')}} </span>  </div>
					<div>  <label>  @lang('exam.type') :  </label>  <span class="exams type"> {{Session::get('Exam.category')}} </span> </div>
					<div>  <label>  @lang('exam.section') : </label> <span class="exams section"> {{Session::get('Exam.section')}} </span>	 </div>
					<div>  <label>  @lang('exam.question') : 	</label> <span class="exams question"> {{ $result['total'] }} @lang('exam.t') </span> </div>

				@else
				@if (Session::get('Exam.subject') == '')
				
				@else
				<div>  <label>  @lang('exam.subject') :  </label> <span class="exams subject"> {{Session::get('Exam.subject')}} </span>	 </h3>  </div>
				@endif
					<div> <label> @lang('exam.type') :  </label> <span class="exams type"> {{Session::get('Exam.category')}} </span> 	 </h3> 	 </div>
					<div> <label> @lang('exam.tquestion') : </label>  <span class="exams question"> {{ $result['total'] }} @lang('exam.t') </span> </h3> </div>	
				@endif
					<div> <label> @lang('exam.right') @lang('exam.answer') : </label>  <span class="exams correct">  {{ $result['correct'] }} @lang('exam.t') </span>	</h3> </div>	
					<div> <label> @lang('exam.worng') @lang('exam.answer') :  </label> <span class="exams worng"> {{ $result['worng'] }} @lang('exam.t') </span>	 </h3> 	</div>
				<br> 

				<div style="display: inline-block;">
					<div class="aleft">						
						<a href="/exam/resultsheet" class="btn btn-primary" style="font-weight: bold;">@lang('exam.sheet') </a>
					</div>
					<div class="aright">
						@if (Session::get('Exam.category') == 'পরীক্ষা')
						<a href="/exam/overview/{{ $token }}" class="btn btn-primary" style="font-weight: bold;"> See Overview </a>
						@endif
					</div>
					
				</div>


			</div>
		</div>
	</div>


	{{-- GET script File --}}
	@include('sections/scripts/getexam')
	



@endsection



