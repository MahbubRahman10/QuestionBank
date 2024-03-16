@extends('layouts.master')
@section('title')
    @section('titlename')Resultsheet
@endsection
@section('content')

	{{-- Index/Home page Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/resultsheet.css') }}">
	
	<div class="container" >
		<div class="row rows" id="result">
			{{-- Exam --}}
				<div class="resulttitle">
					<h3> <strong> {{ $class }} </strong>   </h3>
					<h3>বিষয় : {{Session::get('Exam.subject')}}   </h3>
					<h3>মোট প্রশ্ন : {{Session::get('Exam.toatlquestion')}} টি   </h3>
					<h3>সঠিক : {{ $correct }} টি   </h3>
					<h3>ভুল : {{ $worng }} টি   </h3>
					<br>
				</div>

				<div class="note">
					<h4><span> নোট:</span> সঠিক উত্তরগুলি <span style="color: #28a745;"> সবুজ </span> এবং ভুল উত্তর <span style="color: #dc3545;"> লাল </span> রং দিয়ে চিহ্নিত করা হয়েছে।</h4>
				</div>

				<hr style="width: 95%; ">
				
				<div class="col-md-12">
					 	
					<div class="col-md-12" style="text-align: center;">
						
						@php $i = 1; @endphp

						@foreach ($question as $data)
							<div class="questionnumber">
								@foreach ($result as $element)
									@if ($element['qid'] == $data->id)
										@if ($element['result']  == 'Correct')
											<h3 style="float: left;"> <strong class="circle"> &#x2713; {{ $i++ }}) </strong> </h3>
										@else
											<h3 style="float: left;"> <strong class="circle"> &#x2716; {{ $i++ }}) </strong> </h3>
											
										@endif
									@endif
								@endforeach

								<h3 class="questiontitle">	{{ $data->question_name }} {{ $data->question_name }} </h3>
								<div class="question">
								 
								 <div class="questionoption" >
								 	
								 	@foreach ($result as $element)
								 		@if ($element['qid'] == $data->id)
								 			
								 			@if ($element['answer'] == $data->option_no_1)
								 				@if ($data->option_no_1 == $data->correct_answer)
									 				<h3> <strong style="color: #28a745!important">  ক) {{ $data->option_no_1 }} </strong> </h3>
									 			@else
									 				<h3> <strong  style="color: #dc3545"> ক) {{ $data->option_no_1 }}  </strong> </h3>
									 			@endif

									 			@if ($data->option_no_2 == $data->correct_answer)
									 				<h3> <strong style="color: #28a745!important">  খ) {{ $data->option_no_2 }} </strong> </h3>
									 			@else
									 				<h3> খ) {{ $data->option_no_2 }}  </h3>
									 			@endif

									 			@if ($data->option_no_3 == $data->correct_answer)
								 					<h3> <strong style="color: #28a745!important"> গ) {{ $data->option_no_3 }}  </strong></h3>
								 				@else
								 					<h3> গ) {{ $data->option_no_3 }} </h3>	
								 				@endif

								 				@if($data->option_no_4 == $data->correct_answer)
									 				<h3> <strong style="color: #28a745!important"> ঘ) {{ $data->option_no_4  }} </strong> </h3>
									 			@else
									 				<h3> ঘ) {{ $data->option_no_4 }} </h3>
									 			@endif

									 		@elseif($element['answer'] == $data->option_no_2)
									 			@if ($data->option_no_1 == $data->correct_answer)
									 				<h3> <strong style="color: #28a745!important">  ক) {{ $data->option_no_1 }} </strong> </h3>
									 			@else
									 				<h3> ক) {{ $data->option_no_1 }}  </h3>
									 			@endif

									 			@if ($data->option_no_2 == $data->correct_answer)
									 				<h3> <strong style="color: #28a745!important">  খ) {{ $data->option_no_2 }} </strong> </h3>
									 			@else
									 				<h3> <strong style="color: #dc3545;"> খ) {{ $data->option_no_2 }} </strong> </h3>
									 			@endif

									 			@if ($data->option_no_3 == $data->correct_answer)
								 					<h3> <strong style="color: #28a745!important"> গ) {{ $data->option_no_3 }}  </strong></h3>
								 				@else
								 					<h3> গ) {{ $data->option_no_3 }} </h3>	
								 				@endif

								 				@if($data->option_no_4 == $data->correct_answer)
									 				<h3> <strong style="color: #28a745!important"> ঘ) {{ $data->option_no_4  }} </strong> </h3>
									 			@else
									 				<h3> ঘ) {{ $data->option_no_4  }} </h3>
									 			@endif

									 		@elseif($element['answer'] == $data->option_no_3)
									 			@if ($data->option_no_1 == $data->correct_answer)
									 				<h3> <strong style="color: #28a745!important">  ক) {{ $data->option_no_1 }} </strong> </h3>
									 			@else
									 				<h3> ক) {{ $data->option_no_1 }}  </h3>
									 			@endif

									 			@if ($data->option_no_2 == $data->correct_answer)
									 				<h3> <strong style="color: #28a745!important">  খ) {{ $data->option_no_2 }} </strong> </h3>
									 			@else
									 				<h3> খ) {{ $data->option_no_2 }}  </h3>
									 			@endif

									 			@if ($data->option_no_3 == $data->correct_answer)
								 					<h3> <strong style="color: #28a745!important"> গ) {{ $data->option_no_3 }}  </strong></h3>
								 				@else
								 					<h3> <strong style="color: #dc3545;"> গ) {{ $data->option_no_3 }}  </strong></h3>	
								 				@endif

								 				@if($data->option_no_4 == $data->correct_answer)
									 				<h3> <strong style="color: #28a745!important"> ঘ) {{ $data->option_no_4  }} </strong> </h3>
									 			@else
									 				<h3> ঘ) {{ $data->option_no_4  }}  </h3>
									 			@endif

									 		@elseif($element['answer'] == $data->option_no_4)
									 			@if ($data->option_no_1 == $data->correct_answer)
									 				<h3> <strong style="color: #28a745!important">  ক) {{ $data->option_no_1 }} </strong> </h3>
									 			@else
									 				<h3> ক) {{ $data->option_no_1 }}  </h3>
									 			@endif

									 			@if ($data->option_no_2 == $data->correct_answer)
									 				<h3> <strong style="color: #28a745!important">  খ) {{ $data->option_no_2 }} </strong> </h3>
									 			@else
									 				<h3> খ) {{ $data->option_no_2 }}  </h3>
									 			@endif

									 			@if ($data->option_no_3 == $data->correct_answer)
								 					<h3> <strong style="color: #28a745!important"> গ) {{ $data->option_no_3 }}  </strong></h3>
								 				@else
								 					<h3> গ) {{ $data->option_no_3 }} </h3>	
								 				@endif

								 				@if($data->option_no_4 == $data->correct_answer)
									 				<h3> <strong style="color: #28a745!important"> ঘ) {{ $data->option_no_4  }} </strong> </h3>
									 			@else
									 				<h3> <strong style="color: #dc3545;"> ঘ) {{ $data->option_no_4 }}  </strong></h3>
									 			@endif
									 		@elseif($element['answer'] == null)
									 			@if ($data->option_no_1 == $data->correct_answer)
									 				<h3> <strong style="color: #28a745!important">  ক) {{ $data->option_no_1 }} </strong> </h3>
									 			@else
									 				<h3> ক) {{ $data->option_no_1 }}  </h3>
									 			@endif

									 			@if ($data->option_no_2 == $data->correct_answer)
									 				<h3> <strong style="color: #28a745!important">  খ) {{ $data->option_no_2 }} </strong> </h3>
									 			@else
									 				<h3> খ) {{ $data->option_no_2 }}  </h3>
									 			@endif

									 			@if ($data->option_no_3 == $data->correct_answer)
								 					<h3> <strong style="color: #28a745!important"> গ) {{ $data->option_no_3 }}  </strong></h3>
								 				@else
								 					<h3> গ) {{ $data->option_no_3 }} </h3>	
								 				@endif

								 				@if($data->option_no_4 == $data->correct_answer)
									 				<h3> <strong style="color: #28a745!important"> ঘ) {{ $data->option_no_4  }} </strong> </h3>
									 			@else
									 				<h3> <strong style="color: #dc3545;"> ঘ) {{ $data->option_no_4 }}  </strong></h3>
									 			@endif

								 			@endif
								 		@endif
								 	@endforeach

								 </div>
								</div>
							</div>
							<br><br><br><br><br><br>
						@endforeach
					</div>
				</div>

		</div>
	</div>


	{{-- GET script File --}}
	@include('sections/scripts/getexam')
	



@endsection



