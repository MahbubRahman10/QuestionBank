@extends('layouts.master')

@section('title')
	@section('titlename')Question Archive
@endsection


@section('content')

	{{-- Nav page Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/QuestionCategory.css') }}">

	<div class="container">		
		<div class="row" id="viewcategory" style="margin-bottom:13%; margin-top:13%;">
			<div class="col-md-12">
				<br><br>
				<div class="col-md-3" id="recruitment">
					<a href="/question/archive/bcs" >
						<div  id="questionsolve"  style="margin-bottom: 10px">
							 <img src="{{ asset('img/bcss2.jpg') }}" height="100%" width="100%">
							 <p class="qutitle">@lang('index.bcssolution')</p>
						</div>
					</a>
				</div>
				<div class="col-md-3" id="recruitment">
					<a href="/question/archive/teacher" >
						<div  id="questionsolve" style="margin-bottom: 10px">
							<img src="{{ asset('img/teacher.jpg') }}" height="100%" width="100%">
							 	<p class="qutitle">@lang('index.teachersolution')</p>
						</div>	
					</a>
				</div>
				<div class="col-md-3" id="recruitment">
					<a href="/question/archive/university" >
						<div id="questionsolve" style="margin-bottom: 10px">
							<img src="{{ asset('img/universitys.jpg') }}" height="100%" width="100%">
							 <p class="qutitle">@lang('index.universitysolution')</p>
						</div>
					</a>
				</div>
				<div class="col-md-3" id="recruitment">
					<a href="/question/archive/bank" >
						<div id="questionsolve" style="margin-bottom: 10px">
							<img src="{{ asset('img/banks.jpg') }}" height="100%" width="100%">
							<p class="qutitle">@lang('index.banksolution')</p>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>

	
@endsection
