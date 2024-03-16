@extends('layouts.master')
@section('title')
    @section('titlename')Account Setting
@endsection
@section('content')

	{{-- Profile Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/profile.css') }}">

	<br>

	<div class="container" id="profile">
		<div class="col-md-12">
			<div class="row">
            <!-- Nav tabs -->
            	<div class="card">
                	<ul class="nav nav-tabs" role="tablist">
                    	<li role="presentation"><a href="/user/{{Auth::id()}}/profile">প্রোফাইল</a></li>
                      <li ><a href="/user/exam">পরীক্ষাসমূহ</a></li>
                      <li ><a href="/user/question">প্রশ্নসমূহ</a></li>         
                      <li role="presentation" class="active"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">প্রোফাইল সম্পাদনা</a></li>
                   	</ul>
                   	<!-- Tab panes -->
                   	<div role="tabpanel" class="tab-pane" id="settings">

                   		<div class="container">
                   			<div class="col-md-12">
                   				<div class="row">
                   					<div class="col-md-3" id="bhoechie-tab-container">
                   						<div class="bhoechie-tab-menu">
                   							<div class="list-group">
                   								<a href="/user/profile/setting" class="list-group-item text-center">
                   									<i class="fa fa-user-o" aria-hidden="true"></i><br/>ব্যক্তিগত তথ্য
                   								</a>
                   								<a href="/users/settings/tags" class="list-group-item text-center">
                   									<i class="fa fa-asterisk" aria-hidden="true"></i><br/>
                   									ট্যাগ
                   								</a>
                   								<a href="/users/settings/accountsettings" class="list-group-item active text-center">
                   									<i class="fa fa-cogs" aria-hidden="true"></i><br/>অ্যাকাউন্ট সেটিংস
                   								</a>
                   							</div>
                   						</div>
                   					</div>
                   					<div class="col-md-9" id="passwordchange">
                   						<h5>পাসওয়ার্ড পরিবর্তন করুন</h5>
                   						<hr>
                   						<div class="passwords">
                   							<form method="post" action="{{ LaravelLocalization::localizeURL('/user/profile/password/change') }}">
                   								<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                   								<br>
                   								<h6><label>আগের পাসওয়ার্ডটি দিন :</label></h6>
                   								<div class="form-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}">
                   									<input  type="password" class="form-control" name="oldpassword"  style="width: 250px;">
                   									@if ($errors->has('oldpassword'))
                   									<span class="help-block">
                   										<strong>{{ $errors->first('oldpassword') }}</strong>
                   									</span>
                   									@endif
                   								</div>
                   								<br>
                   								<h6><label>নতুন পাসওয়ার্ডটি দিন :</label></h6>
                   								<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                   									<input type="password" class="form-control" name="password"  style="width: 250px;">

                   									@if ($errors->has('password'))
                   									<span class="help-block">
                   										<strong>{{ $errors->first('password') }}</strong>
                   									</span>
                   									@endif
                   								</div>
                   								<br>
                   								<h6><label>পাসওয়ার্ডটি কনফার্ম করুন :</label></h6>
                                  <div class="form-group">
                                    <div class="col-md-6">
                                      <input type="password" class="form-control" name="password_confirmation"  style="width: 250px;">
                                    </div>
                                  </div>
                   								<br><br><br>
                   								<button class="btn btn-primary">ঠিক আছে</button>
                   							</form>
                   						</div>														
                   					</div>
	                   			</div>
    	               		</div>
        	           	</div>
        	        </div>
        	   	</div>
        	</div>
    	 </div>
    </div>


@endsection
