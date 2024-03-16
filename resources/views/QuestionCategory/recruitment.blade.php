@extends('layouts.master')
@section('title')
	@section('titlename')Recruitment Question
@endsection

@section('content')

	{{-- Nav page Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/QuestionCategory.css') }}">

	<div class="container">		
		<div class="row" id="viewcategory" style="margin-top: 140px; margin-bottom: 120px;">
			<div class="col-md-12">
				<div class="col-md-4" id="recruitment">
					<a href="/recruitment/question/ntrca/10">
						<div  id="recruitmentquestion">
							<h3>@lang('index.ntrca') @lang('index.preparation')</h3>
						</div>
					</a>
				</div>
				<div class="col-md-4" id="recruitment">
					<a href="/recruitment/question/dpe/10">
						<div  id="recruitmentquestion">
							<h3> @lang('index.dpe') @lang('index.preparation') </h3>
						</div>	
					</a>
				</div>
				<div class="col-md-4" id="recruitment">
					<a href="/recruitment/question/bank/10">
						<div id="recruitmentquestion">
							<h3>@lang('index.bank') @lang('index.preparation')</h3>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>

	
@endsection
