@extends('layouts.master')
@section('title')
    @section('titlename')Activities
@endsection
@section('content')

	{{-- Profile Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/profile.css') }}">
	
	<br>

	<div class="container" id="dashboard">
		<div class="col-md-12">	
			<div class="col-md-3" id="sidebar">
				<div class="user-menu">
					<a href="" class="user-icon">
						<i class="fa fa-bars fa-2x" id="qicon"></i>
					</a>
				</div>
				<div class="user">
					<div class="user-image">
						@if (Auth::user()->image == True)
						    <img src="/{{ Auth::user()->image }}" alt="users">
						@else								
							<img src="{{ asset('img/profile-default.jpg') }}" alt="users">
						@endif
					</div>
					<div class="user-details">
						<h1>Mahbub</h1>
						<span><i class="fa fa-circle text-success"></i>@lang('user.Online')</span>
					</div>
				</div>
				<hr>
				<div class="sidebar-menu">
					<ul>
{{-- 						<li><a href="/user/dashboard"><i class="fa fa-tachometer"></i> @lang('user.Dashboard')</a></li> --}}
						<li><a href="/user/profile"><i class="fa fa-user-secret"></i> @lang('user.Profile')</a></li>
						<li><a href="" class="sidebar-menu active"><i class="fa fa-calendar-check-o"></i> @lang('user.Activities')</a></li>
						<li><a href="/user/exam" ><i class="fa fa-check-circle"></i> @lang('user.Exam') </a></li>
						<li><a href="/user/saved"><i class="fa fa-save"></i> @lang('user.Saved') </a></li>
						<li><a href="/user/forum"><i class="fa fa-foursquare"></i> @lang('user.Forum') </a></li>
						<li><a href="/user/settings"><i class="fa fa-cogs"></i> @lang('user.Setting') </a></li>
						<li><a href="/logout"><i class="fa fa-user"></i> @lang('user.Logout') </a></li>
					</ul>
				</div>
			</div>

			<?php 
				$lang =  LaravelLocalization::getCurrentLocale();
				use Carbon\Carbon;
				Carbon::setLocale($lang);
				$english =array('0','1','2','3','4','5','6','7','8','9');
				$bangla =array('০','১','২','৩','৪','৫','৬','৭','৮','৯'); 
			?>

			<div class="col-md-9">
				<div id="activities-content">
					@php
						$now = Carbon::now()->format('d F Y');
						$yesterday =  Carbon::yesterday()->format('d F Y');
					@endphp
					@foreach ($activities as $key =>$element)
						@if ($key == $now)
							<div class="header">Today</div>
						@elseif ($key == $yesterday)
							<div class="header">Yesterday</div>
						@else
							<div class="header">{{ $key }}</div>
						@endif
						
						<ul class="content">					
							@foreach ($element as $value)
								@if ($value->forum_id != null)
									<li> <a href="/user/profile"> @php echo Auth::user()->name; @endphp </a>  {{ $value->activity }}  <a href="/forum/view/{{ $value->forum_id }}">Question</a></li>
								@elseif($value->reply_id != null)
									<li> <a href="/user/profile"> @php echo Auth::user()->name; @endphp </a>  {{ $value->activity }}  <a href="/forum/view/{{ $value->reply_id }}">Question</a></li>
								@elseif($value->question_id != null)
									@if ($value->question_type == 'creative')
										<li> <a href="/user/profile"> @php echo Auth::user()->name; @endphp </a>  {{ $value->activity }}  <a href="/user/saved/creative/view/{{ $value->question_id }}">Question</a></li>
									@else
										<li> <a href="/user/profile"> @php echo Auth::user()->name; @endphp </a>  {{ $value->activity }}  <a href="/user/saved/mcq/view/{{ $value->question_id }}">Question</a></li>
									@endif
								@elseif($value->exam_id != null)
									<li> <a href="/user/profile"> @php echo Auth::user()->name; @endphp </a>  {{ $value->activity }}  <a href="/user/exam/{{ $value->exam_id }}">Exam</a></li>
								@elseif($value->user_id != null)
									<li> <a href="/user/profile"> @php echo Auth::user()->name; @endphp </a>  {{ $value->activity }} </li>	
								@endif
							@endforeach
						</ul>
					@endforeach
				</div>
			</div>
		</div>
	</div>







@endsection



