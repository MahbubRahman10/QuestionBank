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
						<a @if ($data->id == $secid ) id="sectionactive"   @else href="/{{$category}}/questions/mcq/{{$sid}}/{{$class->id}}{{$data->id}}" @endif><li> {{ $data->section_name }} </li></a>
					@endforeach
				</ul>
			</div>
			<div class="col-md-9" id="question" >
				<h1>{{$class->class}} শ্রেণি - {{ $sname }}</h1>
				<h4 style="font-weight: normal;">বহু নির্বাচনী প্রশ্ন</h4>
				<h4 style="font-weight: normal;">{{ $subsection->section_no }} অধ্যায়</h4>
				<h4>{{ $subsection->section_name }}</h4>
				<div class="pdf">
					<a href="/pdf/mcq/create/{{$class->id}}{{$sid}}{{ $subsection->id }}" target="_blank"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF </a>
					<a href="" class="print"> <i class="fa fa-print" aria-hidden="true"></i> Print </a>
				</div>
				@php 
					$i = 0; 
					$j = 0;
					$otp = 0;
					$que = array();
					$english =array('0','1','2','3','4','5','6','7','8','9');
					$bangla =array('০','১','২','৩','৪','৫','৬','৭','৮','৯'); 
				@endphp		
				@foreach ($question as $questions)
					@if ($questions->parent_id != null)
						@if ($j == 0)
							@php  $k=$i; @endphp
							<span style="border-bottom: 0px solid black; font-size: 17px; font-weight: normal;">* নিচের উদ্দীপকটি পড়ে  </span>
						@endif
							@php $k++;   @endphp
							{{ str_replace($english, $bangla, $k) }},
						@php  $j++; @endphp

						@php $otp = 1;  array_push($que,$questions); @endphp

						@if(count($question) == $k)
							@php $n = 0; @endphp
							@for ($m = 0; $m < count($que) ; $m++)
							@if($n == 0)
							<span style="border-bottom: 0px solid black;  font-size: 17px; font-weight: normal;">প্রশ্নের এর উত্তর দাও : </span>
							<br><br>
							<p>{!! $que[$m]->paragraph !!}</p>
							<br>
							@endif
							@php $j =0; $i++ @endphp	
							<span>প্রশ্ন {{ str_replace($english, $bangla, $i) }} : </span> @auth() <a href=""  title="Saved" class="saved" data-id="{{ $que[$m]->id }}" style="color: black;"> <i class="fa fa-save" style="padding: 0px 8px;"></i> </a> @endauth
							<h3><strong  class="q">{!! $que[$m]->question_name !!}</strong></h3>
							<br>
							@if ($que[$m]->mcq_type == '2')
							<p>i) {{ $que[$m]->c1 }}</p>	
							<p>ii) {{ $que[$m]->c2 }}</p>	
							<p>iii) {{ $que[$m]->c3 }}</p><br>
							<strong>নিচের কোনটি সঠিক?</strong><br><br>	
							@endif
							<p>১) {{ $que[$m]->option_no_1 }}</p>
							<p>২) {{ $que[$m]->option_no_2 }}</p>
							<p>৩) {{ $que[$m]->option_no_3 }}</p>
							<p>৪) {{ $que[$m]->option_no_4 }}</p>
							<br>
							<p> <strong>সঠিক উত্তর : </strong> {{ $que[$m]->correct_answer }} </p>
							<br>
							@php $n++; @endphp
							@endfor
						@endif
					@else
						@if ($otp == 1)
							@php $n = 0; @endphp
							@for ($m = 0; $m < count($que) ; $m++)
								@if($n == 0)
								<span style="border-bottom: 0px solid black;  font-size: 17px; font-weight: normal;">প্রশ্নের এর উত্তর দাও : </span>
								<br><br>
								<p>{!! $que[$m]->paragraph !!}</p>
								<br>
								@endif
								@php $j =0; $i++ @endphp	
								<span>প্রশ্ন {{ str_replace($english, $bangla, $i) }} : </span> @auth() <a href=""  title="Saved" class="saved"  data-id="{{ $que[$m]->id }}" style="color: black;"> <i class="fa fa-save" style="padding: 0px 8px;"></i> </a> @endauth
								<h3><strong  class="q">{!! $que[$m]->question_name !!}</strong></h3>
								<br>
								@if ($que[$m]->mcq_type == '2')
								<p>i) {{ $que[$m]->c1 }}</p>	
								<p>ii) {{ $que[$m]->c2 }}</p>	
								<p>iii) {{ $que[$m]->c3 }}</p><br>
								<strong>নিচের কোনটি সঠিক?</strong><br><br>	
								@endif
								<p>১) {{ $que[$m]->option_no_1 }}</p>
								<p>২) {{ $que[$m]->option_no_2 }}</p>
								<p>৩) {{ $que[$m]->option_no_3 }}</p>
								<p>৪) {{ $que[$m]->option_no_4 }}</p>
								<br>
								<p> <strong>সঠিক উত্তর : </strong> {{ $que[$m]->correct_answer }} </p>
								<br>
								@php $n++; @endphp
							@endfor
							@php $otp = 0; $que = array(); @endphp
						@endif

						@php $j =0; $i++ @endphp	
						<span>প্রশ্ন {{ str_replace($english, $bangla, $i) }} : </span> @auth() <a href=""  title="Saved" class="saved" style="color: black;" data-id="{{ $questions->id }}"> <i class="fa fa-save" style="padding: 0px 8px;"></i> </a> @endauth
						<h3><strong  class="q">{!! $questions->question_name !!}</strong></h3>
						<br>
						@if ($questions->mcq_type == '2')
						<p>i) {{ $questions->c1 }}</p>	
						<p>ii) {{ $questions->c2 }}</p>	
						<p>iii) {{ $questions->c3 }}</p><br>
						<strong>নিচের কোনটি সঠিক?</strong><br><br>	
						@endif
						<p>১) {{ $questions->option_no_1 }}</p>
						<p>২) {{ $questions->option_no_2 }}</p>
						<p>৩) {{ $questions->option_no_3 }}</p>
						<p>৪) {{ $questions->option_no_4 }}</p>
						<br>
						<p> <strong>সঠিক উত্তর : </strong> {{ $questions->correct_answer }} </p>
						<br>
					@endif
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

	{{-- Saved Question Script  --}}
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
