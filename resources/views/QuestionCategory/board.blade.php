@extends('layouts.master')
@section('title')
	@section('titlename')Board Question
@endsection

@section('content')

	{{-- Nav page Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/QuestionCategory.css') }}">


	<div class="container" >
		<div class="row" id="viewcategory">			
			@foreach ($board as $boards)
			<div class="col-md-3">
				<div class="details boards">
					<h1 class="vtitle">{{ $boards->board_name }}</h1>
					@php $year = Carbon\Carbon::now()->format('Y');   @endphp 
					<ul>
						@foreach ($exam as $exams)
							@if ($boards->board_name != 'Madrasah Board')
								@if ($exams->exam_name == 'JDC' || $exams->exam_name == 'Dakhil' || $exams->exam_name == 'Alim')	
								@else
									<li> <a href="board/question/{{ $boards->id }}{{ $exams->id }}{{ $year }}">  {{ $exams->exam_name }} </a></li>					
								@endif 
							@else
								@if ($exams->exam_name == 'JSC' || $exams->exam_name == 'SSC' || $exams->exam_name == 'HSC')	
								@else
								<li> <a href="board/question/{{ $boards->id }}{{ $exams->id }}{{ $year }}">  {{ $exams->exam_name }} </a></li>					
								@endif
							@endif
						@endforeach
					</ul>
				</div>
			</div>
			@endforeach
		</div>
	</div>


@endsection
