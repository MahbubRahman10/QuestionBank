@extends('layouts.master')

@section('content')

	{{-- Profile Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/profile.css') }}">
	
	<br>

	<div class="container" id="profile">
		<div class="col-md-12">
			<div class="row">
				
				<div class="card">
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation"><a href="/user/{{ Auth::user()->id}}/profile">প্রোফাইল</a></li>
						<li ><a href="/user/exam">পরীক্ষাসমূহ</a></li>
						<li ><a href="/user/question">প্রশ্নসমূহ</a></li>
						<li role="presentation" class="active"><a href="#" aria-controls="settings" role="tab" data-toggle="tab">প্রোফাইল সম্পাদনা</a></li>
					</ul>

					<div role="tabpanel" class="tab-pane" id="settings">
						<div class="container">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3" id="bhoechie-tab-container">
										<div class="bhoechie-tab-menu">
											<div class="list-group">
												<a href="#" class="list-group-item active text-center">
													<i class="fa fa-user-o" aria-hidden="true"></i><br/>ব্যক্তিগত তথ্য
												</a>
												<a href="/users/settings/tags"  class="list-group-item text-center">
													<i class="fa fa-asterisk" aria-hidden="true"></i></h4><br/>ট্যাগ
												</a>
												<a href="/user/profile/accountsettings" class="list-group-item text-center">
													<i class="fa fa-cogs" aria-hidden="true"></i><br/>অ্যাকাউন্ট সেটিংস
												</a>
											</div>
										</div>
									</div>

									<div class="col-md-9">
										<form method="post" action="{{ LaravelLocalization::localizeURL('/user/profile/update') }}" enctype="multipart/form-data">
											<div class="col-md-4" id="editimage">
												<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
												@if(isset($user->image))
												<img src="/{{$user->image}}"  id="uimg" alt="Paris" height="250px" width="200px">
												@else
												<img src="/img/q.jpg" alt="Paris" id="uimg" height="250px" width="200px">
												@endif
												<br><br>
												<button id="imageupload" onclick="document.getElementById('fileupload').click()">Change Image</button>
												<input type="file" id="fileupload" name="image"  id="ifiles" onchange="document.getElementById('uimg').src = window.URL.createObjectURL(this.files[0])" style="display: none;">
											</div>
											<div class="col-md-3" id="editinfo">
												<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
													<h6><label>নাম</label></h6>
													<input type="text" class="form-control" name="name" value="{{ $user->name }}">
													@if ($errors->has('name'))
													<span class="help-block">
														<strong>{{ $errors->first('name') }}</strong>
													</span>
													@endif
												</div>
												<br>
												<h6><label>টাইটেল</label></h6>
												<input type="text" class="form-control" name="title" value="{{ $user->Title }}"><br>
												<br>
												<h6><label>আমার সম্পর্কে</label></h6>
												<textarea type="text" class="form-control" name="user" cols="4" rows="7" >{{ $user->About }} </textarea>
												<br><br><br>
												</a><button class="btn btn-primary">আপটেড করুন</button>
											</div>
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

	<script type="text/javascript">
		$('#imageupload').on("click",function(e){
			e.preventDefault();
		});
	</script>


@endsection



