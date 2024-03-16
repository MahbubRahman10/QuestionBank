<!DOCTYPE html>
<html>
<head>
	
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


	<title>Question Bank</title>
	<style type="text/css">

	@font-face {
		font-family: 'kalpurush';
		font-style: normal;
		font-weight: normal;
		src: url(kalpurush.ttf) format('truetype');
	}

	* {
		font-family: "kalpurush";
	}

	body {
		font-family: "kalpurush";
	}


	.container{
		padding-right: 0px; 
		padding-left: 0px; 
		margin-right: auto; 
		margin-left: 0px; 
	}
	#viewquestion{
		margin-top: 50px;
	}

	/* Question Style */
	#question{
		margin-top: 20px;
		
	}
	#question span{
		font-size: 15px;
		font-family: ;
		border-bottom: 1px solid black;
		font-weight:bold;
	}
	#question h3{
		font-size: 15px;
		font-weight: normal;
		line-height: 1.7em;
	}
	#question h1{
		text-align: center;
		font-weight: normal;
	}
	#question h4{
		font-size: 20px;
		font-weight:bold;
		text-align: center;
	}
	.copy{
		margin-bottom: 50px;
		font-style: italic; 
	}


	</style>
</head>
<body>
	<br>
	<div class="container" id="viewquestion">
		<div class="col-md-12" id="question">

			<div class="copy" style="text-align: center;color: #4c4c4c;">
				<h6 > Qbank.com ©2018 Copyright. All Rights Reserved.</h6>
			</div>

			<h1 style="text-align: center;">{{ $class->class }} শ্রেণী || {{ $subject->subject_name }}</h1>
			<h1>{{ $subsection->section_no }} অধ্যায়</h1>
			<h1>{{ $subsection->section_name }}</h1>

			<br><br>
			
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
							<p style="border-bottom: 0px solid black; font-size: 17px; font-weight: normal;">* নিচের উদ্দীপকটি পড়ে  </p>
						@endif
							@php $k++;   @endphp
							{{ str_replace($english, $bangla, $k) }},
						@php  $j++; @endphp

						@php $otp = 1;  array_push($que,$questions); @endphp

						@if(count($question) == $k)
							@php $n = 0; @endphp
							@for ($m = 0; $m < count($que) ; $m++)
								@if($n == 0)
								<p style="border-bottom: 0px solid black;  font-size: 17px; font-weight: normal;">প্রশ্নের এর উত্তর দাও : </p>
								<br><br>
								<p>{{ $que[$m]->paragraph }}</p>
								<br>
								@endif
								@php $j =0; $i++ @endphp									
								<h3>প্রশ্ন {{ str_replace($english, $bangla, $i) }} : </h3>
								<h3>{!!  $que[$m]->question_name !!}</h3>
								<br>
								@if ($que[$m]->mcq_type == '2')
								<p>i) {{ $que[$m]->c1 }}</p>	
								<p>ii) {{ $que[$m]->c2 }}</p>	
								<p>iii) {{ $que[$m]->c3 }}</p><br>
								<p>নিচের কোনটি সঠিক?</p><br><br>	
								<h6>১) {{ $que[$m]->option_no_1 }}</h6>
								<h6>২) {{ $que[$m]->option_no_2 }}</h6>
								<h6>৩) {{ $que[$m]->option_no_3 }}</h6>
								<h6>৪) {{ $que[$m]->option_no_4 }}</h6>
								<h3>সঠিক উত্তর : </h3> <h6>{{ $que[$m]->correct_answer }}</h6>	
								@else
								<p>১) {{ $que[$m]->option_no_1 }}</p>
								<p>২) {{ $que[$m]->option_no_2 }}</p>
								<p>৩) {{ $que[$m]->option_no_3 }}</p>
								<p>৪) {{ $que[$m]->option_no_4 }}</p>
								<br>
								<p> সঠিক উত্তর :  {{ $que[$m]->correct_answer }} </p>
								@endif
								<br>
								@php $n++; @endphp
							@endfor
						@endif
					@else
						@if ($otp == 1)
							@php $n = 0; @endphp
							@for ($m = 0; $m < count($que) ; $m++)
								@if($n == 0)
								<p style="border-bottom: 0px solid black;  font-size: 17px; font-weight: normal;">প্রশ্নের এর উত্তর দাও : </p>
								<br><br>
								<p>{{ $que[$m]->paragraph }}</p>
								<br>
								@endif
								@php $j =0; $i++ @endphp									
								<h3>প্রশ্ন {{ str_replace($english, $bangla, $i) }} : </h3>
								<h3>{!!  $que[$m]->question_name !!}</h3>
								<br>
								@if ($que[$m]->mcq_type == '2')
								<p>i) {{ $que[$m]->c1 }}</p>	
								<p>ii) {{ $que[$m]->c2 }}</p>	
								<p>iii) {{ $que[$m]->c3 }}</p><br>
								<p>নিচের কোনটি সঠিক?</p><br><br>	
								<h6>১) {{ $que[$m]->option_no_1 }}</h6>
								<h6>২) {{ $que[$m]->option_no_2 }}</h6>
								<h6>৩) {{ $que[$m]->option_no_3 }}</h6>
								<h6>৪) {{ $que[$m]->option_no_4 }}</h6>
								<h3>সঠিক উত্তর : </h3> <h6>{{ $que[$m]->correct_answer }}</h6>	
								@else
								<p>১) {{ $que[$m]->option_no_1 }}</p>
								<p>২) {{ $que[$m]->option_no_2 }}</p>
								<p>৩) {{ $que[$m]->option_no_3 }}</p>
								<p>৪) {{ $que[$m]->option_no_4 }}</p>
								<br>
								<p> সঠিক উত্তর :  {{ $que[$m]->correct_answer }} </p>
								@endif
								<br>
								@php $n++; @endphp
							@endfor
							@php $otp = 0; $que = array(); @endphp
						@endif

						@php $j =0; $i++ @endphp	
						<h3>প্রশ্ন {{ str_replace($english, $bangla, $i) }} : </h3>
						<h3>{!! $questions->question_name !!}</h3>
						<br>
						@if ($questions->mcq_type == '2')
						<p>i) {{ $questions->c1 }}</p>	
						<p>ii) {{ $questions->c2 }}</p>	
						<p>iii) {{ $questions->c3 }}</p><br>
						<p>নিচের কোনটি সঠিক?</p><br><br>
						<h6>১) {{ $questions->option_no_1 }}</h6>
						<h6>২) {{ $questions->option_no_2 }}</h6>
						<h6>৩) {{ $questions->option_no_3 }}</h6>
						<h6>৪) {{ $questions->option_no_4 }}</h6>	
						<h3>সঠিক উত্তর : </h3> <h6>{{ $questions->correct_answer }}</h6>
						@else
						<p>১) {{ $questions->option_no_1 }}</p>
						<p>২) {{ $questions->option_no_2 }}</p>
						<p>৩) {{ $questions->option_no_3 }}</p>
						<p>৪) {{ $questions->option_no_4 }}</p>
						<br>
						<p>সঠিক উত্তর : {{ $questions->correct_answer }} </p>  
						@endif

						<br>
					@endif
				@endforeach


		</div>
	</div>



</body>
</html>

