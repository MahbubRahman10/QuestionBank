@extends('layouts.master')
@section('title')
    @section('titlename')Forum
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
						<h1>{{ Auth::user()->name }}</h1>
						<span><i class="fa fa-circle text-success"></i>@lang('user.Online')</span>
					</div>
				</div>
				<hr>
				<div class="sidebar-menu">
					<ul>
						{{-- <li><a href="/user/dashboard"><i class="fa fa-tachometer"></i> @lang('user.Dashboard')</a></li> --}}
						<li><a href="/user/profile"><i class="fa fa-user-secret"></i> @lang('user.Profile')</a></li>
						<li><a href="/user/activities"><i class="fa fa-calendar-check-o"></i> @lang('user.Activities')</a></li>
						<li><a href="/user/exam" ><i class="fa fa-check-circle"></i> @lang('user.Exam')</a></li>
						<li><a href="/user/saved" ><i class="fa fa-save"></i> @lang('user.Saved')</a></li>
						<li><a href="#" class="sidebar-menu active"><i class="fa fa-foursquare"></i> @lang('user.Forum') </a></li>
						<li><a href="/user/settings"><i class="fa fa-cogs"></i> @lang('user.Setting')</a></li>
						<li><a href="/logout"><i class="fa fa-user"></i> @lang('user.Logout')</a></li>
					</ul>
				</div>
			</div>

			<div class="col-md-9">
				<div id="forum-content">
					<div class="content-heading">
						<h3>@lang('user.Questions')({{ count($forum) }}) </h3>
					</div>
					<div class="content-body">
						@foreach ($forum as $element)
							<div class="question">
								<a href="/forum/view/{{ $element->id }}"> {{ $element->title }} </a>
							</div>
						@endforeach
					</div>
				</div>
				<div id="forum-content">
					<div class="content-heading">
						<h3>@lang('user.Answers')({{ count($reply) }}) </h3>
					</div>
					<div class="content-body">
						@foreach ($reply as $element)
							<div class="question">
								<a href="/forum/view/{{ $element->forum_id }}"> {{ $element->title }} </a>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>







@endsection



