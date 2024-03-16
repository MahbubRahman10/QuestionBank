@extends('layouts.master')
@section('title')
@section('titlename')Notifications
@endsection
@section('content')

{{-- Profile Style Link  --}}
<link rel="stylesheet" type="text/css" href="{{ asset('/css/profile.css') }}">

<br>

<div class="container" id="dashboard">
	<div class="col-md-12" id="notifications">	
		<div id="saved-content">
			<div class="content-heading">
				<span> @lang('user.notification') </span>
			</div>
			<div class="content-body">
				<div class="viewnotification">
					<ul>
						@if(count($notifications) == '0')
							<h1 style="font-style: italic;text-decoration: underline;">You have no notifications</h1>
						@else
						@foreach ($notifications as $notification)
						<li style="list-style: none;" @if($notification->seen == 0) id="notification-list-unseen"  @endif>
							<a href="/notification/view/{{ $notification->id }}"> {{ $notification->notification }}  
								<br>
								<span> {{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }} </span>
							</a>
						</li>
						@endforeach
						@endif
						
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>







@endsection



