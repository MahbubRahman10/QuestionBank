@extends('layouts.master')
@section('title')
    @section('titlename'){{ $blogpost->title }}
@endsection
@section('content')
<meta name="locale" id="locale" content="{{LaravelLocalization::getCurrentLocale() }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/forum/blog.css') }}">
<div class="container">
	<div class="question">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-8"> 	
					<?php 
					$lang =  LaravelLocalization::getCurrentLocale();
					$english =array('0','1','2','3','4','5','6','7','8','9');
					$bangla =array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
					use Jenssegers\Date\Date; 
					?>
					@if ($lang == 'bn')
					{{ Date::setLocale('bd') }}
					@endif
					<div id='sst'>
						<h3>{{  $blogpost->title  }}</h3>
						<span >@if($lang == 'en') {{ Carbon\Carbon::parse($blogpost->created_at)->format('d M Y') }}  @else {!! str_replace($english, $bangla,Date::parse($blogpost->created_at)->format('j F Y')) !!} @endif </span> | <span style="color: ; ">{{ $blogpost->admin->name }}</span>

						<social-sharing >
                            <div id="social">
                                <a  href="https://www.facebook.com/sharer/sharer.php?u=http://qbank.mahbubslash.com/blog/post/{{$blogpost->id}}" id="facebook" target="blank"><network network="facebook" >
                                <i class="fa fa-fw fa-facebook"></i> <span class="mobilesocial"  style="color: white;font-weight: bold;"> Facebook </span>
                                </network></a>
                                <a href="https://twitter.com/intent/tweet?text=my share text&amp;url=http://qbank.mahbubslash.com/blog/post/{{$blogpost->id}}" id="twitter" target="blank"><network network="twitter">
                                <i class="fa fa-fw fa-twitter"></i> <span class="mobilesocial" style="color: white;font-weight: bold;"> Twitter </span>
                                </network></a>
                                <a href="https://plus.google.com/share?url=http://qbank.mahbubslash.com/blog/post/{{$blogpost->id}}" id="googleplus" target="blank"><network network="googleplus" >
                                <i class="fa fa-fw fa-google-plus"></i> <span class="mobilesocial" style="color: white;font-weight: bold;"> Google + </span>
                                </network></a>
                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://qbank.mahbubslash.com/blog/post/{{$blogpost->id}}" id="linkedin" target="blank"><network network="linkedin">
                                <i class="fa fa-fw fa-linkedin"></i> <span class="mobilesocial" style="color: white;font-weight: bold;"> LinkedIn </span>
                                </network></a>
                            </div>
                        </social-sharing>   
                        

						<div id='pt'>
							{!!  $blogpost->description  !!}<br/>
						</div><br />
					</div>
					<div class="blogposttag">
						@foreach($blogposttags as $tag)
						<label class="label label-info">{{ $tag->tag_name }}</label>
						@endforeach
					</div>
					<hr/>

					<div class='comment'>
						@foreach($blogpost->comments as $comment)
						<li class='comments' id="comment">
							<h1>{{ $comment->name }}  :</h1>
							<h3>{{ Carbon\Carbon::parse($comment->created_at)->format('d F Y') }} </h3>
							<h6>{{ $comment->description }}</h6>

						</li>
						@endforeach
					</div>


					<div class="replys">
						<div id="blogreply">
							<div id="reply">
								<h4>@lang('forum.opinion')</h4>
								<p> @lang('forum.notice') </p>
							</div>
							{{-- <h4 class="cancel-comment-reply-links" style="display: none" data-id="" value=""><a id="cancel-comment-reply-link">Cancel Reply</a></h4> --}}
							<form method="post" action="/blog/post/comment/{{ $blogpost->id }}" id="form" class="form">
								{{ csrf_field() }}
								<table>
									<tr>
										<td><label for="name">@lang('forum.name') :*</label></td>
										<td><input name="name" id="name" placeholder="" required/>
											@if ($errors->has('name'))
											<span class="help-block">
												<strong style="color: #dc3545!important">{{ $errors->first('name') }}</strong>
											</span>
											@endif
										</td>
									</tr>
									<tr>
										<td><label for="email">@lang('forum.email') :*</label></td>
										<td><input name="email" id="email" placeholder="" required/>
											@if ($errors->has('email'))
											<span class="help-block">
												<strong style="color: #dc3545!important">{{ $errors->first('email') }}</strong>
											</span>
											@endif
										</td>
									</tr>
									<tr>
										<td><label for="content">@lang('forum.comment') :*</label></td>
										<td><textarea name="comment" rows="5" cols="40" iid="comment" placeholder="" required></textarea>
											@if ($errors->has('comment'))
											<span class="help-block">
												<strong style="color: #dc3545!important">{{ $errors->first('comment') }}</strong>
											</span>
											@endif
										</td>
									</tr>
									<tr>
										<td></td>
										<td ><button type="submit" name="btn-comment" class="btncomment" id="btncomment" role="button">@lang('forum.submit')</button></td>
									</tr>

								</table>
							</form>
						</div>
					</div>

				</div>
				<div class="col-md-4">
					@include('blog.side')
				</div>
			</div>
		</div>
	</div>  
</div>  



@endsection

























