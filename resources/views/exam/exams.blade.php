@extends('layouts.master')

@section('content')

	<style type="text/css">	
	.startexam strong {
		padding-left: 10px;
		font-size: 17px;
	}

	</style>

	{{-- Index/Home page Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/getexam.css') }}">
	
	<div class="container" id="startexam">
		<div class="row">
			{{-- Exam --}}
			<div class="startexam">
			
				@if (Session::get('Exam.section') != null)					
					<div > <label>@lang('exam.subject') :</label> <span> {{Session::get('Exam.subject')}} </span>	 </div> 
					<h3 > <label> @lang('exam.category') : </label> </h3>  <span class="exams type"> {{Session::get('Exam.category')}} </span>
					<h3 > <label> @lang('exam.section') : </label> </h3>  <span class="exams section"> {{Session::get('Exam.section')}} </span>	
					<h3 > <label> @lang('exam.question') : </label> </h3><span class="exams question"> {{Session::get('Exam.toatlquestion')}} টি </span>	
					<h3 class="exams time"><label> @lang('exam.time') : </label> <span> {{Session::get('Exam.time')}} মিনিট </span>	 </h3>

				@else
					<div> <label> @lang('exam.subject') : </label> <strong> {{Session::get('Exam.subject')}} </strong>	 </div> 
					<div><label> @lang('exam.category') : </label> <strong> {{Session::get('Exam.category')}} </strong>	 </div> 	
					<div> <label>@lang('exam.question') :  </label><strong> {{Session::get('Exam.toatlquestion')}} টি </strong>	</div>	
					<div> <label> @lang('exam.time') : </label> <strong> {{Session::get('Exam.time')}} মিনিট </strong>	 </div>
				@endif
				<br>

				<a href="/exam/question" class="btn btn-primary">Start Exam</a>

			</div>
		</div>
	</div>

	{{-- GET script File --}}
	@include('sections/scripts/getexam')
	


@endsection



