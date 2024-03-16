@extends('layouts.master')
	@section('title')
		@section('titlename') Result Overview 
	@endsection
@section('content')

	{{-- Index/Home page Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/resultoverview.css') }}">
	
	<div class="container" >
		<div class="row" id="resultoverview">
			
			<h1 class="classsubject">{{ $class->class }} @if($subject != null) | {{ $subject->subject_name }} @endif</h1>

			<div class="container">
				<div class="col-md-3" id="participate">
					<i class="pull-left fa fa-users user1 icon-rounded" style="background-color: #6FB3E0;padding: 10px 10px; font-size: 30px; color: white; border-radius: 50%;">
					</i>
					<div class="info" style="margin-left: 75px;">
						<h5 style="margin-top: 0px;"><strong> Participate </strong></h5>
						<span style="color: #3E3A3A; font-size: 20px;font-weight: bold;"> {{ $participate }} </span>
					</div>

				</div>

				<div class="col-md-3" id="average">
					<i class="pull-left fa fa-line-chart user1 icon-rounded" style="background-color: #6FB3E0;padding: 10px 10px; font-size: 30px; color: white; border-radius: 50%;">
					</i>
					<div class="info" style="margin-left: 75px;">
						<h5 style="margin-top: 0px;"><strong> Average </strong></h5>
						<span style="color: #3E3A3A; font-size: 20px;font-weight: bold;"> {{ $average }} </span>
					</div>

				</div>

				<div class="col-md-3" id="highest">
					<i class="pull-left fa fa-angle-double-up user1 icon-rounded" style="background-color: #6FB3E0;padding: 10px 17px; font-size: 30px; color: white; border-radius: 50%;">
					</i>
					<div class="info" style="margin-left: 75px;">
						<h5 style="margin-top: 0px;"><strong> Higest(Percentage) </strong></h5>
						<span style="color: #3E3A3A; font-size: 20px;font-weight: bold;"> {{ $highest }} </span>
					</div>

				</div>

				<div class="col-md-3" id="lowest">
					<i class="pull-left fa fa-angle-double-down user1 icon-rounded" style="background-color: #6FB3E0;padding: 10px 17px; font-size: 30px; color: white; border-radius: 50%;">
					</i>
					<div class="info" style="margin-left: 75px;">
						<h5 style="margin-top: 0px;"><strong> Lowest(Percentage)  </strong></h5>
						<span style="color: #3E3A3A; font-size: 20px;font-weight: bold;"> {{ $lowest }} </span>
					</div>
				</div>
			</div>

			<br><br><br><br>
			<div class="container">
				
				<div class="col-md-6">
					<h1 class="percentagemarkingchart">Percantage Result</h1>
					<div>{!! $chart->container() !!}</div>
				</div>

				<div class="col-md-6">
					<h1 class="percentagemarkingchart">User Score(Average)</h1>
					<div>{!! $doughnutchart->container() !!}</div>
				</div>

			</div>
					

		</div>
	</div>

	<script src="{{ asset('/js/Chart.min.js') }}" charset="utf-8"></script>
	{!! $chart->script() !!}
	{!! $doughnutchart->script() !!}



@endsection



