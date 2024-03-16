@extends('layouts.master')

@section('title')
    @section('titlename'){{$class->class}} শ্রেণি - {{ $sname }}
@endsection

@section('content')

	{{-- Index/Home page Style Link  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/viewquestion.css') }}">
	
	<br>
	<div class="container" id="viewquestion">
		<div class="col-md-12" >
			<div class="col-md-3" id="sections">
				<h3>{{$sname}}
					<a href="" class="question-icon">
						<i class="fa fa-bars fa-2x" id="qicon"></i>
					</a>
				 </h3>
				<ul id="qmenu">
					@foreach ($section as $data)
						<a @if ($data->id == $secid ) id="sectionactive"   @else href="/{{$category}}/questions/creative/{{$sid}}/{{$class->id}}{{$data->id}}" @endif><li> {{ $data->section_name }} </li></a>
					@endforeach
				</ul>
			</div>
			<div class="col-md-9" id="question" >
				<h1>{{$class->class}} শ্রেণি - {{ $sname }}  </h1>
				<h4 style="font-weight: normal;"> সৃজনশীল প্রশ্ন</h4>
				<h4 style="font-weight: normal;">{{ $subsection->section_no }} অধ্যায়</h4>
				<h4>{{ $subsection->section_name }}</h4>

				<div class="pdf">
					<a href="/pdf/creative/create/{{$class->id}}{{$sid}}{{ $subsection->id }}" target="_blank"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF </a>
					<a href="" class="print"> <i class="fa fa-print" aria-hidden="true"></i> Print </a>
				</div>

				<br>
				@php 
					$i = 0; 
					$english =array('0','1','2','3','4','5','6','7','8','9');
					$bangla =array('০','১','২','৩','৪','৫','৬','৭','৮','৯'); 
				@endphp		
				@foreach ($question as $questions)
					@php $i++ @endphp	
					<span>উদ্দীপক {{ str_replace($english, $bangla, $i) }} :  </span> @auth() <a href=""  title="Saved" class="saved" style="color: black;" data-id="{{ $questions->id }}"> <i class="fa fa-save" style="padding: 0px 8px;"></i> </a> @endauth 
					<span style="font-weight: normal; border-bottom: none;"> ({{ $questions->institution }})</span>
					<h3 class="q">{!! $questions->question_name !!}</h3>
					<br>
					<p>১) {{ $questions->question_no_1 }}</p>
					<p>২) {{ $questions->question_no_2 }}</p>
					<p>৩) {{ $questions->question_no_3 }}</p>
					@if($questions->question_no_4 != null)
					<p>৪) {{ $questions->question_no_4 }}</p>
					@endif
					<br><br>
				@endforeach
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
					url :"/saved/question/creative",
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

	{{-- Print Question --}}
	<script type="text/javascript">
		$(document).ready(function() {
			$('.print').click(function() {
				window.print();
			});
		});
	</script>
	
@endsection


