<!DOCTYPE html>
<html>
<head>
    @include('admin/sections/head')
</head>
<body>
    <style type="text/css">
        .infinite-loading-container{
            
        }
    </style>
	<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
    <div id="app">
        @yield('content')
    </div>
    @include('admin/sections/script')
    <link rel="stylesheet" type="text/css" href="/css/admin/scrolltop.css">
    <div class="scroll">
    	<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
    </div>
    <script type="text/javascript" src="/js/admin/scrolltop.js"></script>
</body>
</html>
