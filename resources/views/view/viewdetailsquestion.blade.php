@extends('layouts.master')
@section('title')
	@section('titlename')Question
@endsection
@section('content')

	{{-- Nav page Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/view.css') }}">

	<div class="container">		
		<div class="row" id="viewquestion">
			<h1 style="text-align: center; padding-bottom: 20px; "><span style="border-bottom: 1px solid black;line-height: 1em;">{{$classes->class}} শ্রেণি</span></h1>
{{-- 			<h1 class="question"> Question </h1> --}}
			<div class="viewquestiondetails"> 
				<div class="col-sm-3">
					<div class="details">						
						{{-- <h1 class="vtitle" style="font-size: 15px; line-height: 1.6em;">@lang('index.'.$class) @lang('index.creative') </h1> --}}
						<h1 class="vtitle" style="font-size: 15px; line-height: 1.6em;"> @lang('index.creative') </h1>
						<ul>
						@foreach ($subject as $data)
								<li> <a href="/school/questions/creative/{{ $data->id }}/{{ $data->class_id }}0">  {{ $data->subject_name }} </a> </li>	
						@endforeach
						</ul>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="details">
						{{-- <h1 style="font-size: 15px; line-height: 1.6em;" class="vtitle">@lang('index.'.$class) @lang('index.mcq')</h1> --}}
						<h1 style="font-size: 15px; line-height: 1.6em;" class="vtitle"> @lang('index.mcq')</h1>
						<ul>
						@foreach ($subject as $data)
								<li> <a  href="/school/questions/mcq/{{ $data->id }}/{{ $data->class_id }}0">  {{ $data->subject_name }} </a> </li>	
						@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
			
	
@endsection
