@extends('layouts.master')
@section('title')
	@section('titlename')Contact Us
@endsection
@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/contact.css') }}">
<div class="container">
	<div class="contact">
		<div class="col-md-12">
			<div class="row" id="contact-us">

				<div class="seper"></div>
				<form method="post" action="{{ LaravelLocalization::localizeURL('/contact-us') }}" id="ask" class="form-inline" role="form">
					@if (Session::has('msg'))
						<div class="alert alert-success" id="alert" style="">
							<ul>
								<li style="list-style: none; font-size: 12px; font-weight: bold; color: #3c763d;">{!! Session::get('msg') !!}</li>
							</ul>
						</div>
					@endif
					{{ csrf_field() }}
					<div class="form-group" id="contact">
						<td ><h6 class="cc"> @lang('loginregister.name') : </h6></td>
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<h6>
								<input type="name" class="form-control" name="name" ><br>
								@if ($errors->has('name'))
								<span class="help-block">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
								@endif
							</h6>
						</div> 
						<br><br>
						<td ><h6 class="cc"> @lang('loginregister.email') : </h6></td>
						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<h6>
								<input type="email" class="form-control" name="email" ><br>
								@if ($errors->has('email'))
								<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
								@endif
							</h6>
						</div> 
						<br><br>  
						<td>
							<h6 class="cc">@lang('loginregister.message')  :</h6></td>
							<div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
								<h5><textarea name='message' class="form-control" id="" cols='60' rows='10'  class="s"></textarea></h5> 
								<div Class="ss"></div>
								@if ($errors->has('message'))
								<span class="help-block">
									<strong>{{ $errors->first('message') }}</strong>
								</span>
								@endif
							</div>
							<br>
						<button type="submit" class="btn btn-info btn-lg" name="submit"  role="button">@lang('forum.submit') </button>
					</div>
				</form>

			</div>
		</div>
	</div>  
</div>  

@endsection

