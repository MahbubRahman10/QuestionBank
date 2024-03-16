@extends('layouts.master')
@section('title')
	@section('titlename')Search Result for {{ $search }} 
@endsection
@section('content')

	{{-- Search page Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/search.css') }}">
	<?php
	$lang =  LaravelLocalization::getCurrentLocale();

	if ($lang == 'en'){ $localeCode = 'bn'; }else{ $localeCode = 'en'; }
	?>

	<div class="container">
		<div class="row">
			<div class="search">
				<div class="searchbox">
					@if($lang == 'en')
					<form method="get" action="{{ LaravelLocalization::localizeURL('/search') }}">
						<div class="col-md-4"> 
							<label>Keyword</label><br>
							<input type="text" name="search" class="form-control" value="{{ $searchvalue }}">
						</div>
						<div class="col-md-4"> 
							<label>Category</label><br>
							<select class="form-control" name="category">
								<option>--Category--</option>
								<option @if($categoryvalue == "board") selected="selected" @endif value="board">Board Question</option>
								<option @if($categoryvalue == "bcs") selected="selected" @endif value="bcs">BCS</option>
								<option @if($categoryvalue == "teacher") selected="selected" @endif value="teacher">Teacher Requirement</option>
								<option @if($categoryvalue == "university") selected="selected" @endif value="university">University</option>
								<option @if($categoryvalue == "bank") selected="bank" @endif value="bank">Bank</option>
								<option @if($categoryvalue == "forum") selected="selected" @endif value="forum">Forum</option>
								<option @if($categoryvalue == "blog") selected="selected" @endif value="blog">Blog</option>
							</select>
						</div>
						<div class="col-md-4"> 
							<label></label><br>
							<input type="submit" value="Search"  class="btn btn-success searchbtn">
						</div>
					</form>
					@else
					<form method="get" action="{{ LaravelLocalization::localizeURL('/search') }}">
						<div class="col-md-4"> 
							<label> কিওয়ার্ড {{ $categoryvalue }} </label><br>
							<input type="text" name="search" class="form-control" value="{{ $searchvalue }}">
						</div>
						<div class="col-md-4"> 
							<label> ক্যাটেগরি </label><br>
							<select class="form-control" name="category">
								<option>--ক্যাটেগরি--</option>
								<option @if($categoryvalue == "board") selected="selected" @endif value="board">বোর্ড প্রশ্ন</option>
								<option @if($categoryvalue == "bcs") selected="selected" @endif value="bcs">বিসিএস</option>
								<option @if($categoryvalue == "teacher") selected="selected" @endif value="teacher">শিক্ষক নিবন্ধন</option>
								<option @if($categoryvalue == "university") selected="selected" @endif value="university">বিশ্ববিদ্যালয় </option>
								<option @if($categoryvalue == "bank") selected="selected" @endif value="bank">ব্যাংক</option>
								<option @if($categoryvalue == "forum") selected="selected" @endif value="forum">ফোরাম</option>
								<option @if($categoryvalue == "blog") selected="selected" @endif value="blog">ব্লগ</option>
							</select>
						</div>
						<div class="col-md-4"> 
							<label></label><br>
							<input type="submit" value="Search"  class="btn btn-success searchbtn">
						</div>
					</form>
					@endif
				</div>

				@if($search == null)
				<br><br><br><br><br>
				@else
				<div class="searchfor">
					<h1>Search Result for: {{ $search  }}</h1>
				</div>
				<div class="searchresult">
					<div class="row">
					@if($questionarchives != null)
					@foreach($questionarchives as $questionarchive)
					@if ($questionarchive->category == 'bcs')
					<div class="col-md-3" id="searchdata">
						<a href="/SolutionQuestion/{{ $questionarchive->id }}">
							<img src="http://localhost:8000/img/bcs.jpg">
							<p>{{ $questionarchive->title }}</p>
						</a>	
					</div>
					@endif
					@if ($questionarchive->category == 'teacher')
					<div class="col-md-3" id="searchdata">
						<a href="/SolutionQuestion/{{ $questionarchive->id }}">
							<img src="http://localhost:8000/img/job.jpg">
							<p>{{ $questionarchive->title }}</p>
						</a>	
					</div>
					@endif
					@if ($questionarchive->category == 'university')
					<div class="col-md-3" id="searchdata">
						<a href="/SolutionQuestion/{{ $questionarchive->id }}"><img src="http://localhost:8000/img/university.jpg">
							<p>{{ $questionarchive->title }} {{ $questionarchive->year }}</p></a>	
					</div>
					@endif
					@if ($questionarchive->category == 'bank')
					<div class="col-md-3" id="searchdata">
						<a href="/SolutionQuestion/{{ $questionarchive->id }}">
							<img src="http://localhost:8000/img/banks.jpg">
							<p>{{ $questionarchive->title }}</p>
						</a>	
					</div>
					@endif
					@endforeach
					@endif
					
					@if($boardquestions != null)
					@foreach($boardquestions as $boardquestion)
					@php 
					$i = 0; 
					$english =array('Dhaka Board','Sylhet Board','Rajshahi Board','Comilla Board','Dinajpur Board','Barisal Board','Chittagong Board','Jessore Board','Madrasah Board');
					$bangla =array('ঢাকা বোর্ড','সিলেট বোর্ড','রাজশাহী বোর্ড','কুমিল্লা বোর্ড','দিনাজপুর বোর্ড','বরিশাল বোর্ড','চট্টগ্রাম বোর্ড','যশোর বোর্ড','মাদ্রাসা বোর্ড');

					$englishexam =array('JSC','SSC','HSC','JDC','Dakhil','Alim');
					$banglaexam =array('জেএসসি','এসএসসি','এইচএসসিস','জেডিসি','দাখিল','আলিম'); 
					@endphp
					<div class="col-md-3" id="searchdata">
						<a href="http://localhost:8000/BoardQuestion/{{$boardquestion->question }}">
							<img src="http://localhost:8000/img/boardsearch1.jpg">
							<p> {{ str_replace($english, $bangla, $boardquestion->board_name) }} {{ str_replace($englishexam, $banglaexam, $boardquestion->exam_name) }} {{ $boardquestion->subject_name }} {{ $boardquestion->year }} প্রশ্ন  </p>
						</a>	
					</div>
					@endforeach
					@endif

					@if($blogs != null)		
					@foreach($blogs as $blog)
					<div class="col-md-3" id="searchdata">
						<a href="/blog/post/{{$blog->id }}">
							<img src="http://localhost:8000/img/blog.jpg">
							<p>  {{ $blog->title }}  </p>
						</a>	
					</div>
					@endforeach
					@endif

					@if($forums != null)
					@foreach($forums as $forum)
					<div class="col-md-3" id="searchdata">
						<a href="/forum/view/{{$forum->id }}">
							<img src="http://localhost:8000/img/forum.jpg">
							<p>  {{ $forum->title }}  </p>
						</a>	
					</div>
					@endforeach
					@endif


					@if (count($questionarchives) == 0 && count($boardquestions) == null &&  count($blogs) == null && count($forums) == null)
						@if($lang == 'en')
						<h4 class="nodata">No Data Found for <span style="font-size: 27px;">{{ $search }} </span> </h4>
						@else
						<h4 class="nodata" style="font-family: 'Kalpurush', sans-serif; font-size: 30px;"><span style="font-size: 40px;">{{ $search }} </span> খুঁজে পাওয়া যায়নি </h4>
						@endif
					@endif


					</div>
				</div>

				@endif

			</div>

		</div>
	</div>
		


@endsection



