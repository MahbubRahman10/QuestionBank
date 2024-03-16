@extends('layouts.master')
@section('title')
    @section('titlename')Saved Question
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
						<li><a href="/user/profile"><i class="fa fa-user-secret"></i> @lang('user.Profile')</a></li>
						<li><a href="/user/activities"><i class="fa fa-calendar-check-o"></i> @lang('user.Activities')</a></li>
						<li><a href="/user/exam" ><i class="fa fa-check-circle"></i> @lang('user.Exam')</a></li>
						<li><a href="#" class="sidebar-menu active"><i class="fa fa-save"></i> @lang('user.Saved')</a></li>
						<li><a href="/user/forum"><i class="fa fa-foursquare"></i> @lang('user.Forum') </a></li>
						<li><a href="/user/settings"><i class="fa fa-cogs"></i> @lang('user.Setting')</a></li>
						<li><a href="/logout"><i class="fa fa-user"></i> @lang('user.Logout') </a></li>
					</ul>
				</div>
			</div>

			<div class="col-md-9">
				@if (Session::has('msg'))
					<div id="" style="width: 95%;" class="alert alert-info">{!! Session::get('msg') !!}</div>
				@endif
				<div id="saved-content">
					<div class="content-heading">
						<span> @lang('user.Saved') </span>
					</div>
					<div class="content-body">
						<div class="saved">
							 <div class="row">
							 	@foreach ($saved as $key =>$element)
									<div class="col-md-8">
										@if (isset($element->mcq_type))											
											<a href="/user/saved/mcq/view/{{$element['id']}}"> <?php echo substr($element['question_name'],0,strpos($element['question_name'], ' ', 40)); ?> ...... </a>
										@else
											<a href="/user/saved/creative/view/{{$element['id']}} "> <?php echo substr($element['question_name'],0,strpos($element['question_name'], ' ', 105)); ?> ...... </a>
										@endif
									</div>
									<div class="col-md-4">
										@if (isset($element->mcq_type))
											<a href="/user/saved/mcq/delete/{{$element['id']}}">@lang('user.Remove')</a>
										@else
											<a href="/user/saved/creative/delete/{{$element['id']}}">@lang('user.Remove')</a>
										@endif
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>







@endsection



