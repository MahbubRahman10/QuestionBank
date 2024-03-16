	<!DOCTYPE html>
	<html>
	<head>
		@include('sections/head')

	</head>
	<body>
		
		@include('sections/nav')
		<div class="content">
			@yield('content')
		</div>  
		@include('sections.footer')    
		@include('sections.script')
	</body>      