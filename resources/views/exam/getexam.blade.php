@extends('layouts.master')
	@section('title')
		@section('titlename')Exam
	@endsection
@section('content')

	{{-- Index/Home page Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/getexam.css') }}">
	
	<div class="container" id="exam">
		<div class="row">
			{{-- Exam --}}
			<div class="exam">
				
				<form class="form" method="post" action="{{ LaravelLocalization::localizeURL('/exams/getexam/'.$class->id.'') }}">
					<input type="hidden" name="test" class="test" value={{ $class->type }}>
					@if ($class->type == null || $class->type == 'university')
					<input type="hidden" name="examname" class="test" value={{ $class->class }}>
					<div class="radio">
						<label id="label"> @lang('exam.seltype')  :  </label>
						<div id="radio">
							<label><input type="radio" name="optradio" id="fulls" data-id="" value="1" >@lang('exam.fullbook')</label>
							<label><input type="radio" name="optradio" id="subjects" data-id="" value="2" >@lang('exam.sectionwise')</label>
						</div>
					</div>
					<span class="errorRadio" id="error" ></span>
					<br>
					<div class="subjects" style="display: none;">
						<label id="label"> @lang('exam.selsubject') : </label>
						<select  class="form-control" id="subject" name="subject" >
							<option value="0" selected="selected" >@lang('exam.selection')</option>	
							@foreach($subject as $data)
							<option value="{{ $data->subject_id }}">{{ $data->subject_name }}</option>
							@endforeach
						</select><br>
						<span class="errorSubject" id="error" ></span>
						<br><br>
					</div>
					@else
					<label id="label"> @lang('exam.selsubject') : </label>
					<select  class="form-control" id="subject" name="subject" >
						<option value="0" selected="selected" >@lang('exam.selection')</option>	
						@foreach($subject as $data)
						<option value="{{ $data->subject_id }}">{{ $data->subject_name }}</option>
						@endforeach
					</select><br>
					<span class="errorSubject" id="error" ></span>
					<br><br>	
					@endif	

					
					<label id="label"> @lang('exam.selcategory')  : </label>
					<select  class="form-control" id="category"  name="category">
						<option value="0" selected="selected">@lang('exam.selection')</option>	
							<option value="1">@lang('exam.practice')</option>
							<option value="2">@lang('exam.exam')</option>
					</select><br>
					<span class="errorCategory" id="error" ></span>	
					<br><br>

					@if ($class->type != null && $class->type != 'university')
						<div class="radio">
							<label id="label"> @lang('exam.seltype')  :  </label>
							<div id="radio">
								<label><input type="radio" name="optradio" id="full" data-id="" value="1" >@lang('exam.fullbook')</label>
								<label><input type="radio" name="optradio" id="section" data-id="" value="2" >@lang('exam.sectionwise')</label>
							</div>
						</div>
						<span class="errorRadio" id="error" ></span>
						<br>
						
						
						<?php $section = array(); ?>
						<div class="sections" style="display: none;">
						<label id="label"> @lang('exam.selsection') : </label>
						<select  class="form-control" id="sections" name="sections">	
							
						</select><br>
						<span class="errorSection" id="error" ></span>
						
						</div><br>				
					@endif
					<label id="label">@lang('exam.selquestion')  : </label>
					<select  class="form-control" id="question" name="question">
						<option value="0" selected="selected" >@lang('exam.selection')</option>	
						<option value="১০">@lang('exam.10')</option>
						<option value="২০">@lang('exam.20')</option>
						<option value="৩০">@lang('exam.30')</option>
						<option value="৪০">@lang('exam.40')</option>
						<option value="৫০">@lang('exam.50')</option>
					</select><br>
					<span class="errorQuestion" id="error" ></span>
					<br><br>
					<button type="submit" id="submit" class="btn btn-primary" name="submit" >@lang('exam.startexam')</button>
				</form>
			</div>
		</div>
	</div>

	{{-- GET script File --}}
	@include('sections/scripts/getexam')
	



@endsection



