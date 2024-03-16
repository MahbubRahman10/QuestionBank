@extends('layouts.master')
@section('title')
	@section('titlename')Setting
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
						<li><a href="/user/exam" ><i class="fa fa-check-circle"></i> @lang('user.Exam') </a></li>
						<li><a href="/user/saved" ><i class="fa fa-save"></i> @lang('user.Saved') </a></li>
						<li><a href="/user/forum" ><i class="fa fa-foursquare"></i> @lang('user.Forum') </a></li>
						<li><a href="#" class="sidebar-menu active"><i class="fa fa-cogs"></i> @lang('user.Setting') </a></li>
						<li><a href="/logout"><i class="fa fa-user"></i> @lang('user.Logout') </a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-9">				
				@if (Session::has('msg'))
				<div id="settingalert" class="alert alert-info">{!! Session::get('msg') !!}</div>
				@endif
				<div id="basicsetting-content">
					<div class="content-heading">
						<h3>@lang('user.Basic') <a href="" class="basicsetting-content-icon" id="arrow"> <i id="arrow-basic" class="fa fa-angle-up" ></i></a></h3>
					</div>
					<div class="content-body">
						<div id="basic">							
							<form method="post" action="{{ LaravelLocalization::localizeURL('/user/profile/update') }}" enctype="multipart/form-data">
									<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
									@if(isset($user->image))
									<img src="/{{$user->image}}"  id="uimg" alt="Paris" >
									@else
									<img src="/img/profile-default.jpg" alt="Paris" id="uimg" >
									@endif
									<br><br>
									<div class="userimage">
										<button id="imageupload" onclick="document.getElementById('fileupload').click()">@lang('user.Image') </button>
										@if(isset($user->image))
											<a href="" id="imageremove" >@lang('user.Remove')</a>
										@endif
									</div>
									<input type="file" id="fileupload" name="image" id="ifiles" onchange="document.getElementById('uimg').src = window.URL.createObjectURL(this.files[0])" style="display: none;">
									<input type="text" class="fileremove" name="fileremove" id="ifiles" style="display: none;">
									<br>
									<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
										<h6><label>@lang('user.Name') : </label></h6>
										<input type="text" class="form-control" name="name" value="{{ $user->name }}">
										@if ($errors->has('name'))
										<span class="help-block">
											<strong>{{ $errors->first('name') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
										<h6><label>@lang('user.Mobile') : </label></h6>
										<input type="text" class="form-control" name="mobile" value="{{ $user->mobile }}">
										@if ($errors->has('mobile'))
										<span class="help-block">
											<strong>{{ $errors->first('mobile') }}</strong>
										</span>
										@endif
									</div>
									<div class="form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
										<h6><label>@lang('user.Bio') : </label></h6>
										<textarea type="text" class="form-control" name="about" cols="4" rows="7" >{{ $user->about }} </textarea>
										@if ($errors->has('bio'))
										<span class="help-block">
											<strong>{{ $errors->first('bio') }}</strong>
										</span>
										@endif
									</div>
									<br>
									<button class="btn btn-primary">@lang('user.Update')</button>
							</form>
						</div>
					</div>
				</div>		

				<div id="passwordsetting-content">
					<div class="content-heading">
						<h3>@lang('user.Password') <a href="" class="passwordsetting-content-icon" id="arrow"> <i id="arrow-password" class="fa fa-angle-up" ></i></a> </h3>
					</div>
					<div class="content-body">
						<div id="password">							
							<form method="post" action="{{ LaravelLocalization::localizeURL('/user/profile/password/change') }}">
								<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
								<br>
								<h6><label>@lang('user.Old') :</label></h6>
								<div class="form-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}">
									<input  type="password" class="form-control" name="oldpassword"  style="width: 250px;">
									@if ($errors->has('oldpassword'))
									<span class="help-block">
										<strong>{{ $errors->first('oldpassword') }}</strong>
									</span>
									@endif
								</div>
								<br>
								<h6><label>@lang('user.New') :</label></h6>
								<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
									<input type="password" class="form-control" name="password"  style="width: 250px;">

									@if ($errors->has('password'))
									<span class="help-block">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
									@endif
								</div>
								<br>
								<h6><label>@lang('user.Confirm') :</label></h6>
								<div class="form-group">
									<div class="col-md-6">
										<input type="password" class="form-control" name="password_confirmation"  style="width: 250px;">
									</div>
								</div>
								<br><br><br>
								<button class="btn btn-primary">@lang('user.Update')</button>
							</form>
						</div>
					</div>
				</div>		
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$('#imageupload').on("click",function(e){
			e.preventDefault();
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#imageremove').on('click',function(event) {
				event.preventDefault();
				$('#uimg').attr('src', '/img/profile-default.jpg');
				$('.fileremove').val('remove')
			});
		});
	</script>

	{{-- Basicsetting menu script  --}}
	<script type="text/javascript"> 
		$(document).ready(function(){
			$('.basicsetting-content-icon').on('click', function(e){
				e.preventDefault();
				var check = $("#basic").hasClass("basicshowing");
				if(check == false){
					$("#basic").addClass("basicshowing");
					$('#arrow-basic').removeClass('fa fa-angle-up').addClass('fa fa-angle-down');
					$("#basic").slideUp();
				}
				else{
					$("#basic").removeClass("basicshowing");
					$('#arrow-basic').removeClass('fa fa-angle-down').addClass('fa fa-angle-up');
					$("#basic").slideDown();
				}
			});
		});
	</script>
	{{-- Basicsetting menu script  --}}
	<script type="text/javascript"> 
		$(document).ready(function(){
			$('.passwordsetting-content-icon').on('click', function(e){
				e.preventDefault();
				var check = $("#password").hasClass("passwordshowing");
				if(check == false){
					$("#password").addClass("passwordshowing");
					$('#arrow-password').removeClass('fa fa-angle-up').addClass('fa fa-angle-down');
					$("#password").slideUp();
				}
				else{
					$("#password").removeClass("passwordshowing");
					$('#arrow-password').removeClass('fa fa-angle-down').addClass('fa fa-angle-up');
					$("#password").slideDown();
				}
			});
		});
	</script>



@endsection



