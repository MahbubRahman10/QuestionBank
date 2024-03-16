@extends('layouts.master')
@section('title')
    @section('titlename')Exam Report
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
						<li><a href="#" class="sidebar-menu active"><i class="fa fa-check-circle"></i> @lang('user.Exam') </a></li>
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
				<div id="exam-content">
					<div class="content-heading">
						<span> @lang('user.Progress') </span>
					</div>
					<div class="content-body">
						<table >
							<thead>
								<th>@lang('user.TestName') </th>
								<th>@lang('user.TestSubject') </th>
								<th>@lang('user.TestDate')</th>
								<th>@lang('user.TestQuestion')</th>
								<th>@lang('user.Correct')</th>
								<th>@lang('user.Action')</th>
							</thead>
							<tbody>
								@for ($i = 0; $i < count($examtoken); $i++)
									@for ($j = $i; $j < $i+1 ; $j++)							
										<tr>
											<td>{{ $data[$j]->class }}</td>
											<td>{{ $data[$j]->subject_name }}</td>
											<td>{{ Carbon::parse($examtoken[$i]['created_at'])->format('d M Y') }}</td>
											<td>{{ $examtoken[$i]['total_question'] }}</td>
											<td>{{ $examtoken[$i]['right_answer'] }}</td>
											<td><a href="/user/exam/{{ $examtoken[$i]['etoken'] }}">Resultsheet</a></td>
										</tr>
									@endfor
								@endfor
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>







@endsection



