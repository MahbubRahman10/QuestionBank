@extends('layouts.master')
@section('title')
    @section('titlename'){{ Auth::user()->name }}
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
{{-- 						<li><a href="/user/dashboard"><i class="fa fa-tachometer"></i> @lang('user.Dashboard')</a></li> --}}
						<li><a href="#" class="sidebar-menu active"><i class="fa fa-user-secret"></i> @lang('user.Profile') </a></li>
						<li><a href="/user/activities"><i class="fa fa-calendar-check-o"></i> @lang('user.Activities') </a></li>
						<li><a href="/user/exam"><i class="fa fa-check-circle"></i> @lang('user.Exam') </a></li>
						<li><a href="/user/saved"><i class="fa fa-save"></i> @lang('user.Saved') </a></li>
						<li><a href="/user/forum"><i class="fa fa-foursquare"></i> @lang('user.Forum') </a></li>
						<li><a href="/user/settings"><i class="fa fa-cogs"></i> @lang('user.Setting') </a></li>
						<li><a href="/logout"><i class="fa fa-user"></i> @lang('user.Logout') </a></li>
					</ul>
				</div>
			</div>

			<div class="col-md-9">				
				<!-- Tab panes -->
				<div role="tabpanel" class="tab-pane active" id="home">
					<div class="col-md-12">
						<div class="col-md-4" id="userimage">
							@if(isset($user->image))
							<img src="/{{$user->image}}" alt="Paris">
							@else
							<img src="/img/profile-default.jpg" alt="Paris">
							@endif
							<?php 
							use Carbon\Carbon;
							$lang =  LaravelLocalization::getCurrentLocale();
							if ($lang  == 'en'){
								Carbon::setLocale('en');
							}
							else{
								Carbon::setLocale('bn');
							}
							
							$english =array('0','1','2','3','4','5','6','7','8','9');
							$bangla =array('০','১','২','৩','৪','৫','৬','৭','৮','৯'); 
							?>
							<div id="usertime">
								@if($lang =='en')
								<h6><i class="fa fa-user" aria-hidden="true"></i></i> Member from {{ Carbon::parse($user->created_at)->diffForHumans() }}</h6>

								@else
								<h6><i class="fa fa-user" aria-hidden="true"></i></i> সদস্য হয়েছেন {{ str_replace($english, $bangla,Carbon::parse($user->created_at)->diffForHumans()) }}</h6>
								@endif
{{-- 								<h6><i class="fa fa-clock-o" aria-hidden="true"></i> সর্বশেষ অনলাইনে ছিলেন ২ মিনিট আগে</h6> --}}
							</div>
						</div>
						<div class="col-md-6" id="info">
							<h3>{{ $user->name }}</h3>
{{-- 							<span class="title">Metropolitan University Sylhet</span> --}}
							{{-- <p class="tag"> PHP  </p> --}}
							<p class="bio">{{-- I am a full stack software developer mainly working on backend with PHP. I have good experience with Laravel and Vue.js. I also have some experience with Python --}} {{ $user->about }} </p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>







@endsection



