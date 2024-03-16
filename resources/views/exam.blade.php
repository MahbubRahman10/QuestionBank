@extends('layouts.master')
	@section('title')
		@section('Exam', 'Home')
		@section('titlename')Exam
	@endsection
@section('content')

<link href="https://fonts.maateen.me/adorsho-lipi/font.css" rel="stylesheet">
<link href="https://fonts.maateen.me/kalpurush/font.css" rel="stylesheet">
<link href="https://fonts.maateen.me/bangla/font.css" rel="stylesheet">

		{{-- Font Link --}}
       	<link href="{{ asset('/fonts/kal.css') }}" rel="stylesheet">
        <link href="{{ asset('/fonts/bangla.css') }}" rel="stylesheet">
		
	<style type="text/css">
		.footer{
			display: none;
		}
	</style>
	<?php
	$lang =  LaravelLocalization::getCurrentLocale();
	if ($lang == 'en'){ $localeCode = 'bn'; }else{ $localeCode = 'en'; }
	?>

	<style type="text/css">
	.titleimage {
		position: relative;
		font-size: 30px;
		margin-top: 0;
		font-family: 'Lobster', helvetica, arial;
		padding: 12px;
		margin-left: 70px;
		padding-right: 50px;
	}
	</style>

	@if($lang == 'bn')
	<style type="text/css">
		.nav nav ul a li{
			font-family: 'Kalpurush', sans-serif;
		}
		.titleimage{
			margin-top: -4px;
		}
		.nav .nav-right .user-dropdown ul a li {
			background: none;
			color: #333333;
			font-weight: normal;
			font-size: 14px;
		}
		.footer{
			font-family: 'Kalpurush', sans-serif;
		}
	</style>
	@else
	<style type="text/css">
	.nav nav ul li {
		padding: 16px 15px;
	}
	</style>
	@endif


	<div class="appcsslink" style="display: none;">
			<link href="/css/app.css" rel="stylesheet" type="text/css">
	</div>

	
{{-- 	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}

	<div class="container">
		<div id="app">
			<exam> </exam>			
		</div>
	</div>
	<script type="text/javascript" src="/js/app.js"></script>


	<script type="text/javascript">
		$(document).ready(function() {
			$('.appcsslink').css('display', 'block');
		});
	</script>



@endsection

