@extends('layouts.master')
@section('title')
@section('titlename'){{ $user->name }}
@endsection
@section('content')

<meta name="locale" id="locale" content="{{LaravelLocalization::getCurrentLocale() }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
<script src="{{ asset('js/bootstrap/bootstrap-tagsinput.js') }}"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('css/forum/user.css') }}">
<div class="container">
	<div class="question">
		<div class="col-md-12">
			<div class="row">
				<div class="seper"></div>

				<div class="col-md-3" id="user-info">
					@if ($user->image == True)
					<img src="/{{$user->image}}" alt="users">
					@else								
					<img src="{{ asset('img/profile-default.jpg') }}" alt="users">
					@endif
					<br>
					<?php 
					$lang =  LaravelLocalization::getCurrentLocale();
					$english =array('0','1','2','3','4','5','6','7','8','9');
					$bangla =array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
					use Jenssegers\Date\Date; 
					?>
					@if ($lang == 'bn')
					{{ Date::setLocale('bd') }}
					@endif
					<div>
						<span class="user-name">{{ $user->name }}</span><br>
						@if($lang =='en')
						<span class="user-time"><i class="fa fa-clock"></i> Member Since {{ Carbon\Carbon::parse($user->created_at)->format('d F Y') }} 
						</span>
						@elseif($lang =='bn')
						<span class="user-time"><i class="fa fa-clock"></i>  {!! str_replace($english, $bangla,Date::parse($user->created_at)->format('j F Y')) !!} থেকে যুক্ত আছেন
						</span>
						@endif
					</div>
					<div class="user-bio">
						{{ $user->about }}
					</div>
				</div>
				<div class="col-md-9" id="questions">
					
					<h4>@lang('forum.question') @if($lang == 'bn') ({{ str_replace($english, $bangla, count($questions)) }}) @elseif($lang =='en') ({{ count($questions) }}) @endif </h4>
					
					@foreach ($questions as $question)
					<div class="viewquestion">
						<div id="question"> <a href="/forum/view/{{ $question->id }}"> {{ $question->title }} </a> </div>
						<div class="time">@if($lang == 'en') {{ Carbon\Carbon::parse($question->created_at)->format('d M Y') }}  @else {!! str_replace($english, $bangla,Date::parse($question->created_at)->format('j F Y')) !!} @endif </div>
						<br>
						</div>
					@endforeach
					
				</div>

			</div>
		</div>
	</div>  
</div>  


@endsection


