<!DOCTYPE html>
<html>
<head>
	
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


	<title>Question Bank</title>
	<style type="text/css">

	@font-face {
		font-family: 'Bangla';
		font-style: normal;
		font-weight: normal;
		src: url(Bangla.ttf) format('truetype');
	}

	* {
		font-family: "Bangla";
	}

	body {
		font-family: "Bangla";
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
			<h6 style="text-align: center;font-size: 30px;">{{ $class->class }}</h6>
			<h1 style="text-align: center;"> {{ $subject->subject_name }}</h1>
			

			<br><br>
			@php 
			$i = 0; 
			$english =array('0','1','2','3','4','5','6','7','8','9');
			$bangla =array('০','১','২','৩','৪','৫','৬','৭','৮','৯'); 
			@endphp		
			@foreach ($question as $questions)
			@php $i++ @endphp	
			<h3>প্রশ্ন {{ str_replace($english, $bangla, $i) }} : </h3>
			<h3>{{ $questions->question_name }}</h3>
			<br>
			<p>১) {{ $questions->option_no_1 }}</p>
			<p>২) {{ $questions->option_no_2 }}</p>
			<p>৩) {{ $questions->option_no_3 }}</p>
			<p>৪) {{ $questions->option_no_4 }}</p>
			<br>
			<p>  সঠিক ঊত্তর :  {{ $questions->correct_answer }}</p>
			<br>
			@endforeach

		</div>
	</div>



</body>
</html>

