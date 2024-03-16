@extends('layouts.master')
@section('title')
    <title>  @if ($clipc == 'normal') Normal University  @elseif($clipc == 'engineering') Engineering University  @elseif($clipc == 'technology') Technology University @elseif($clipc == 'agriculture') Agriculture University @endif  | Qbank</title>
@endsection
@section('content')

	{{-- Index/Home page Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/viewquestion.css') }}">
	
	<br>
	<div class="container" id="viewquestion">
		<div class="col-md-12" >
			<div class="col-md-3" id="sections">
				<h3> @if ($clipc == 'normal') @lang('index.Normal')  @elseif($clipc == 'engineering') @lang('index.Engineering')  @elseif($clipc == 'technology') @lang('index.Technology') @elseif($clipc == 'agriculture') @lang('index.Agriculture') @endif
					<a href="" class="question-icon">
						<i class="fa fa-bars fa-2x" id="qicon"></i>
					</a>
				</h3>
				<ul id="qmenu">
					@foreach ($subject as $data)
						<a @if ($data->id == $getsubject->id ) id="sectionactive"   @else href="/university/question/{{ $clipc }}/{{$data->subject_id}}" @endif><li> {{ $data->subject_name }} </li></a>
					@endforeach
				</ul>
			</div>
			<div class="col-md-9" id="question" >
				<h1 style="font-size: 22px;"> @if ($clipc == 'normal') @lang('index.Normal') @lang('index.Admission')  @elseif($clipc == 'engineering') @lang('index.Engineering') @lang('index.Admission')   @elseif($clipc == 'technology') @lang('index.Technology') @lang('index.Admission') @elseif($clipc == 'agriculture') @lang('index.Agriculture') @lang('index.Admission') @endif </h1>
				<h4>{{ $getsubject->subject_name }}</h4>
				<div class="pdf" style="padding-top: 10px;">
					<a href="/pdf/create/{{ $class->id }}{{ $getsubject->id }}" target="_blank"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF </a>
					<a href="" class="print"> <i class="fa fa-print" aria-hidden="true"></i> Print </a>
				</div>
				@php 
					$i = 0; 
					$english =array('0','1','2','3','4','5','6','7','8','9');
					$bangla =array('০','১','২','৩','৪','৫','৬','৭','৮','৯'); 
				@endphp	
				<div id="universityquestion">	
				@foreach ($question as $questions)
					@php $i++ @endphp	
					<span>প্রশ্ন {{ str_replace($english, $bangla, $i) }} : </span></span> @auth() <a href=""  title="Saved" class="saved" style="color: black;" data-id="{{ $questions->id }}"> <i class="fa fa-save" style="padding: 0px 8px;"></i> </a> @endauth
					<h3><strong class="q">{!! $questions->question_name !!}</strong></h3>
					<br>
					<p>১) {{ $questions->option_no_1 }}</p>
					<p>২) {{ $questions->option_no_2 }}</p>
					<p>৩) {{ $questions->option_no_3 }}</p>
					<p>৪) {{ $questions->option_no_4 }}</p>
					<br>
					<p> <strong>সঠিক উত্তর : </strong> {{ $questions->correct_answer }} </p>
					<br>
				@endforeach
				</div>
				
				@if (Auth::user())
				@if (count($question) < $total)
				<a href="" class="loadmore" data-subid="{{ $getsubject->id }}" data-id="{{ $questions->id }}" data-index="{{ $i }}" data-category="{{ $clipc }}">@lang('index.load')</a>
				@endif
				@else
				<h1 class="getmore">Get <a href="/login">Login</a>/<a href="/register">Register</a> to view more Question</h1> 
				@endif

			</div>
		</div>
	</div>

	{{-- Question Section menu script  --}}
	<script type="text/javascript"> 
		$(document).ready(function(){
			$('.question-icon').on('click', function(e){
				e.preventDefault();
				var check = $("#qmenu").hasClass("qshowing");
				if(check == false){
					$("#qmenu").addClass("qshowing");
					$(".qshowing").css("display","block");
				}
				else{
					$("#qmenu").removeClass("qshowing");
					$("#qmenu").css("display","none");
				}
			});
		});
	</script>

	{{-- Saved Question Script --}}
	<script type="text/javascript"> 
		$(document).ready(function(){
			$('.saved').on('click', function(e){
				e.preventDefault();
				var data = $(this).data('id');
				$.ajax({
					type:"POST",
					url :"/saved/question/mcq",
					data:{'data':data},
					dataType:"JSON",
					success:function(data){
						if (data == '400') {
							alert("This Question already Saved")
						}
						else{
							alert("Saved Question Successfully")	
						}
					},
					error:function(){
						alert("error")
					},
				});
			});
		});
	</script>

	{{-- Load More Question  --}}
	<script type="text/javascript"> 
		$(document).ready(function(){
			$(document).on('click','.loadmore',function(e){
				e.preventDefault();
				$('.loadmore').html('');
				var subid = $('.loadmore').attr('data-subid');
				var id = $('.loadmore').data('id');
				var category = $('.loadmore').data('category');
				var index = $('.loadmore').data('index');
				var type = "university";

				$('.loadmore').html('Loading...');

				$.ajax({
					type:"POST",
					url :"/question/loadmore",
					data:{'category':category,'type':type,'subid':subid,'id':id,'index':index},
					dataType:"JSON",
					success:function(data){
						if(data == "null"){
							$('.loadmore').remove();
						}else{
							$('.loadmore').remove();
							$('#universityquestion').append(data);
						}
					},
					error:function(error){
						console.log(error)
					},
				});
			});
		});
	</script>

	{{-- Print Question --}}
	<script type="text/javascript">
		$(document).ready(function() {
			$('.print').click(function() {
				window.print();
			});
		});
	</script>

	
@endsection
