@extends('layouts.master')

@section('title')
	@section('titlename')University Question
@endsection


@section('content')

	{{-- Nav page Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/QuestionCategory.css') }}">

	<div class="container">		
		<div class="row" id="viewcategory" style="margin-bottom:13%; margin-top:13%;">
			<div class="col-md-12">
				<div class="col-md-3" id="recruitment">
					<a href="/university/question/normal/10">
						<div  id="recruitmentquestion">
							<h3><i class="fa fa-book" style="font-size: 50px; margin-bottom: 12px;"> </i> <br>@lang('index.Normal')</h3>
						</div>
					</a>
				</div>
				<div class="col-md-3" id="recruitment">
					<a href="/university/question/engineering/10">
						<div  id="recruitmentquestion">
							<h3><i class="fa fa-cogs" style="font-size: 50px; margin-bottom: 12px;"> </i> <br>@lang('index.Engineering')</h3>
						</div>	
					</a>
				</div>
				<div class="col-md-3" id="recruitment">
					<a href="/university/question/technology/10">
						<div id="recruitmentquestion">
							<h3><i class="fa fa-laptop" style="font-size: 50px; margin-bottom: 12px;"> </i> <br>@lang('index.Technology')</h3>
						</div>
					</a>
				</div>
				<div class="col-md-3" id="recruitment">
					<a href="/university/question/agriculture/10">
						<div id="recruitmentquestion">
							<h3><i class="fa fa-fort-awesome" style="font-size: 50px; margin-bottom: 12px;"> </i> <br>@lang('index.Agriculture')</h3>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>

	
@endsection
