@extends('layouts.master')
@section('title')
    @section('titlename')Madrasha Question
@endsection
@section('content')

	{{-- Nav page Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/QuestionCategory.css') }}">


	<div class="container" >
		<div class="row" id="viewcategory">
			<h1 class="questioncategory"> @lang('index.creative')</h1>
			<hr id="questioncategory">
			<div class="col-md-3">
				<div class="details">
					<h1 class="vtitle">Class VI</h1>
					<ul>
					@foreach ($subject as $data)
						@if ($data->class == '৬ষ্ঠ')
							<li> <a href="madrasha/questions/creative/{{ $data->id }}/{{ $data->class_id }}0">  {{ $data->subject_name }} </a> </li>	
						@endif
					@endforeach
					</ul>
				</div>
			</div>
			<div class="col-md-3">
				<div class="details">
					<h1 class="vtitle">Class VII</h1>
					<ul>
					@foreach ($subject as $data)
						@if ($data->class == '৭ম')
							<li> <a href="madrasha/questions/creative/{{ $data->id }}/{{ $data->class_id }}0">  {{ $data->subject_name }} </a> </li>	
						@endif
					@endforeach
					</ul>
				</div>
			</div>
			<div class="col-md-3">
				<div class="details">
					<h1 class="vtitle">Class VIII</h1>
					<ul>
					@foreach ($subject as $data)
						@if ($data->class == '৮ম')
							<li> <a href="madrasha/questions/creative/{{ $data->id }}/{{ $data->class_id }}0">  {{ $data->subject_name }} </a> </li>
						@endif
					@endforeach
					</ul>
				</div>
			</div>
			<div class="col-md-3">
				<div class="details">
					<h1 class="vtitle">Class IX-X</h1>
					<ul>			
					@foreach ($subject as $data)
						@if ($data->class == '৯-১০ম')
							<li> <a href="madrasha/questions/creative/{{ $data->id }}/{{ $data->class_id }}0">  {{ $data->subject_name }} </a> </li>
						@endif
					@endforeach
					</ul>
				</div>
			</div>
			{{-- <div class="col-md-4">
				<div class="details">
					<h1 class="vtitle">Class XI-XII</h1>
					@foreach ($subject as $data)
						@if ($data->class == '১১-১২')
							<p> <span> > </span> {{$data->subject_name}} </p>
						@endif
					@endforeach
				</div>
			</div> --}}
		</div>
	</div>

	<div class="container">		
		<div class="row" id="viewcategory">
			<h1 class="questioncategory"> @lang('index.mcq')</h1>
			<hr id="questioncategory">
			<div class="col-md-3">
				<div class="details">
					<h1 class="vtitle">@lang('index.Class VI')</h1>
					<ul>
					@foreach ($subject as $data)
						@if ($data->class == '৬ষ্ঠ')
							<li> <a href="madrasha/questions/mcq/{{ $data->id }}/{{ $data->class_id }}0">  {{ $data->subject_name }} </a> </li>	
						@endif
					@endforeach
					</ul>
				</div>
			</div>
			<div class="col-md-3">
				<div class="details">
					<h1 class="vtitle">@lang('index.Class VII')</h1>
					<ul>
					@foreach ($subject as $data)
						@if ($data->class == '৭ম')
							<li> <a href="madrasha/questions/mcq/{{ $data->id }}/{{ $data->class_id }}0">  {{ $data->subject_name }} </a> </li>	
						@endif
					@endforeach
					</ul>
				</div>
			</div>
			<div class="col-md-3">
				<div class="details">
					<h1 class="vtitle">@lang('index.Class VIII')</h1>
					<ul>
					@foreach ($subject as $data)
						@if ($data->class == '৮ম')
							<li> <a href="madrasha/questions/mcq/{{ $data->id }}/{{ $data->class_id }}0">  {{ $data->subject_name }} </a> </li>
						@endif
					@endforeach
					</ul>
				</div>
			</div>
			<div class="col-md-3">
				<div class="details">
					<h1 class="vtitle">@lang('index.Class IX - X')</h1>
					<ul>			
					@foreach ($subject as $data)
						@if ($data->class == '৯-১০ম')
							<li> <a href="madrasha/questions/mcq/{{ $data->id }}/{{ $data->class_id }}0">  {{ $data->subject_name }} </a> </li>
						@endif
					@endforeach
					</ul>
				</div>
			</div>
			{{-- <div class="col-md-4">
				<div class="details">
					<h1 class="vtitle">Class XI-XII</h1>
					@foreach ($subject as $data)
						@if ($data->class == '১১-১২')
							<p> <span> > </span> {{$data->subject_name}} </p>
						@endif
					@endforeach
				</div>
			</div> --}}
		</div>
	</div>


@endsection
