@extends('layouts.master')
@section('title')
	@section('titlename'){{ $question->title }}
@endsection
@section('content')

	<meta name="locale" id="locale" content="{{LaravelLocalization::getCurrentLocale() }}" />
    
    <link rel="stylesheet" type="text/css" href="{{ asset('css/forum/view.css') }}">
    <div class="container">
        <div class="question">
            <div class="col-md-12">
                <div class="row">
                	<div class="col-md-8">
	                	{{-- <ul class="breadcrumb" section="bc">
	                		<li>
	                			<a href="\">হোম</a>
	                		</li>
	                		<li>
	                			<a>{!! $question->category !!}</a>
	                		</li>
	                	</ul> --}}
	                	<?php 
		                	$lang =  LaravelLocalization::getCurrentLocale();
		                	use Carbon\Carbon;
		                	Carbon::setLocale($lang);
		                	$english =array('0','1','2','3','4','5','6','7','8','9');
		                	$bangla =array('০','১','২','৩','৪','৫','৬','৭','৮','৯'); 


		                	use Jenssegers\Date\Date;
		                	// $dt = Carbon::now();
		                	// setlocale(LC_TIME, 'bangla');
		                	// echo $dt->formatLocalized('%A %d %B %Y');
	                	?>
	                	@if ($lang == 'bn')
	                		{{ Date::setLocale('bd') }}
	                	@endif
	                	<div id='st'>									
	                		<div id='sst'>
	                			<h3>{!! $question->title !!}</h3>
	                		</div>
	                		@auth()
	                		@if ($question->user_id == Auth::user()->id)
	                		<div class="editquestion">
	                			<a href="/forum/question/{{ $question->id }}">Edit</a>
{{-- 	                			<a href="/forum/question/{{ $question->id }}">Share</a> --}}
	                		</div>
	                		@endif
	                		@endauth
	                		<div id='sstt'>
	                			<i class="fa fa-clock-o" aria-hidden="true"></i>  @if($lang == 'en') {{ Carbon::parse($question->created_at)->format('d M Y') }}  @else {!! str_replace($english, $bangla,Date::parse($question->created_at)->format('j F Y')) !!} @endif	<i class="fa fa-user" aria-hidden="true" style="margin-left: 10px;"></i> <a href="/user/profile/{{$question->user_id}}"> {!! ucwords($question->user->name) !!} </a>
	                		</div>
	                		<div id='ssttt'>
	                			{!! $question->description !!}
	                		</div>

	                		@if($question->bestreply!=null)	
	                		<div class="panel panel-default">
	                			<div class="panel-heading">
	                				<span>সেরা উত্তর</span> 
	                				<span style="float: right;">উত্তরটি নির্বাচিত করেছেন {{ucwords($question->user->name)}}</span>
	                			</div>
	                			<div class="panel-body">
	                				<li id="comments">
	                					@foreach ($question->reply as $comments)
	                						@if($comments->id==$question->bestreply)
			                					<div id='ssttt'>
			                						<p>{!! $comments->description !!}</p>

			                					</div>
			                					<div id='sstt'>
			                						<div id='c' style="float: right;">
			                							<a href="report" class="report" style="font-size: 10px;">Report</a>
			                							@if($lang == 'en') {{ Carbon::parse($question->created_at)->format('d M Y') }}  @else {!! str_replace($english, $bangla,Date::parse($question->created_at)->format('j F Y')) !!} @endif <br> <a href="/user/profile/{{$comments->user_id}}"> {{ ucwords($comments->name)}}  </a> {{-- এই উত্তরটি দিয়েছেন 	 --}}
			                						</div>
			                						<div  class="alllikse"  style="float:  left;">
			                							{{-- @if(Auth::user())
			                							<span class="d" data-id="{!! $comments->id !!}"> <a  id="color"><i class="fa fa-thumbs-o-up" aria-hidden="true" style="float:left; "></i></a><p class="likes"  id="blike{!! $comments->id !!}" value="{!! $comments->Like !!}">{!! $comments->Like!!}</p> </span>

			                							@if(Auth::user()->id=="$question->user_id")	
			                							<span> <a href="\forum\reply\bestreply\{!! $comments->id !!}"><i  @if($comments->best=="Yes") style="font-size: 20px; color:#21b384;" @endif  class="fa fa-check-circle-o" aria-hidden="true"></i> </a></span>
			                							@endif
			                							@endif --}}
			                						</div>
			                					</div>
		                					@endif
	                					@endforeach
	                				</li>	
	                			</div>
	                		</div>
	                		@endif

{{-- 	                		<a href="#comments" class="linkbtn answer">@lang('forum.answer')</a> --}}
	                		{{-- <div class="questiontag">
	                			@foreach($question->tags as $tag)
	                			<label class="label label-info">{{ $tag->name }}</label>
	                			@endforeach
	                		</div> --}}
	                		<hr>
	                		<h3 style="text-align:  right;"><b>{!! $question->num_reply !!}</b> @lang('forum.qreply')</h3>
	                		<hr>
	                	</div>

	                	@foreach ($question->reply as $comments)
	                		<li id="comments" style="border-bottom: 1px solid #f5f5f5; margin-bottom:16px;list-style: none;" >	<div id="reply{{ $comments->id }}">
			                		<div class="mainreply" >
			                			<div class='description'>
		    	            				<div id="a" class="maindescription" >
			                					<h5 id="descs{!! $comments->id !!}" style="display:block;">{!! $comments->description !!}</h5>
			                					<div class="editsreplys{{ $comments->id }}"  style="display: none;">
		    	            						<form id="forms">
			                							<textarea id="editdescription" style=" margin-left:-100px;" cols="85" rows="7" class="editdescription{!! $comments->id !!}" name="editdescription{!! $comments->id !!}">{!! $comments->description !!}</textarea><input type="file" name="image" id="upload" class="hidden" onchange="">
			                							<br>
			                							<button type="submit" data-id="{{ $comments->id }}" class="btns btn-success">@lang('forum.edit')</button>
			                							<button class="btn btn-danger" data-id="{{ $comments->id }}">@lang('forum.cancel')</button>
			                						</form>
		    	            					</div>
		        	        				</div>
			                				

			                				<div id='sstt' >
			                					<div id='b' class="alllikse">
		    	            						@if(Auth::user())	
		        		        						<span class="d" data-id="{!! $comments->id !!}">
		        		        							@php $status = 0; @endphp
				                							@if (count($comments->likes) < 1)
				                							<a  id="color" class="likecolor{{ $comments->id }}" ><i class="fa fa-thumbs-o-up colorfont{{ $comments->id }}" aria-hidden="true" style="float:left; "></i></a>
				                							@else
				                							@foreach ($comments->likes as $like)
				                							@if ($like->user_id == Auth::user()->id)
				                							@php $status = 1; @endphp
				                							@endif
				                							@endforeach

				                							@if($status == 1)
				                							<a  id="color" class="likecolor{{ $comments->id }} userlikecolor{{ $comments->id }}"  style="color: black;font-weight: bold;" data-status="like"><i class="fa fa-thumbs-o-up colorfont{{ $comments->id }}" aria-hidden="true" style="float:left; "></i></a>
				                							@else
				                							<a  id="color" class="likecolor{{ $comments->id }}"  style="font-weight: bold;" ><i class="fa fa-thumbs-o-up colorfont{{ $comments->id }}" aria-hidden="true" style="float:left; "></i></a>
				                							@endif

				                							@endif
				                							<p class="likes"  id="like{!! $comments->id !!}" value="{!! $comments->Like !!}"> {!! $comments->Like!!} </p>
				                						</span>

				                						<span class="dis" data-id="{!! $comments->id !!}">

				                							@php $status = 0; @endphp
				                							@if (count($comments->dislikes) < 1)
				                							<a  id="discolor" class="dislikecolor{{ $comments->id }}" ><i class="fa fa-thumbs-o-down discolorfont{{ $comments->id }}" aria-hidden="true" style="float:left; " ></i></a>
				                							@else
				                							@foreach ($comments->dislikes as $dislike)
				                							@if ($dislike->user_id == Auth::user()->id)
				                							@php $status = 1; @endphp
				                							@endif
				                							@endforeach

				                							@if($status == 1)
				                							<a  id="color" class="dislikecolor{{ $comments->id }} userdislikecolor{{ $comments->id }}"  style="color: black;font-weight: bold;" data-status="dislike"><i class="fa fa-thumbs-o-down discolorfont{{ $comments->id }}" aria-hidden="true" style="float:left; "></i></a>
				                							@else
				                							<a  id="color" class="dislikecolor{{ $comments->id }}"  style="font-weight: bold;" ><i class="fa fa-thumbs-o-down discolorfont{{ $comments->id }}" aria-hidden="true" style="float:left; "></i></a>
				                							@endif

				                							@endif
				                							<p class="dislikes"  id="dislike{!! $comments->id !!}" value="{!! $comments->Like !!}"> {!! $comments->Dislike!!} </p>

				                						</span>

				                						
		                								@if(Auth::user()->id==$question->user_id)
				                							<span>
				                								<form id="bestbutton" method="GET" action="\forum\reply\bestreply\{{ $comments->id }}">	
				                									<button type="submit" class="bestbutton">  <i @if($comments->best=="Yes") style="font-size: 20px; color:#21b384;" @endif  class="fa fa-check-circle-o" aria-hidden="true"></i> </button>
				                								</form>
				                							</span>
			                							@endif
			                						@endif
			                					</div>

		                						<div id='b' style="float: right;">
		                							@if(Auth::user())
			                							@if (Auth::user()->id != $comments->user_id)
			                								<a href="/forum/report/{{ $comments->id }}" class="report" style="font-size: 15px; color: #A53F3F;">Report</a>
			                							@endif
		                							@endif
		                							@if(Auth::user())
		                							@if(Auth::user()->id==$comments->user_id)
		                							<a class="editreply" id="ud" data-id=" {!! $comments->id !!} " ><i class="fa fa-pencil" aria-hidden="true"></i></a>
		                							<a href="/forum/reply/deletereply/{{$comments->id}}" id="ud"><i class="fa fa-trash-o" aria-hidden="true"></i></a> 	           			    					
		                							@endif
		                							@endif
		                							<br>
		                							@if($lang == 'en') {{ Carbon::parse($question->created_at)->format('d M Y') }}  @else {!! str_replace($english, $bangla,Date::parse($question->created_at)->format('j F Y')) !!} @endif <br> <a href="/user/profile/{{$comments->user_id}}"> {{ ucwords($comments->name)}}  </a>{{-- এই উত্তরটি দিয়েছেন --}} 	
		                						</div>
		                					</div>
		                				</div>
		                			</div>
		                		</div>
	                		</li>				
	                		@endforeach	 	
	                		@if(Auth::user())
	                		<form class="comment" action="\forum\reply\{{$question->id}}" method="post" enctype="multipart/form-data" id="replydescription">
	                			{{ csrf_field() }}
	                			<div class="form-group">
	                				<textarea id="description" name="reply" class="form-control" rows="7"></textarea><input type="file" name="image" id="upload" class="hidden" onchange="">
	                				<div class="sss" style="margin-top: 10px;color: red; color: #9F6000; padding: 10px 10px; background-color: "></div>
	                				@if ($errors->has('reply'))
	                				<span class="help-block">
	                					<strong style="color: red;">{{ $errors->first('reply') }}</strong>
	                				</span>
	                				@endif
	                			</div>
	                			<button type="submit" class="btn-info btn-lg" name="submit">@lang('forum.panswer')</button>
	                		</form>

	                		@else
	                		<div id='pp'>
	                			<h7 style="font-size: 20px;">@lang('forum.logged') <a href="\login">@lang('forum.member')?</a></h7>
	                		</div>
	                		@endif
                	</div>	
                    <div class="col-md-4">
                    	@include('forum.side')
                    </div>
                </div>
            </div>
        </div>  
    </div>  
    @include('forum.script.view');
@endsection




