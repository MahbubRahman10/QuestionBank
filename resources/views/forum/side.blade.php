<link rel="stylesheet" type="text/css" href="{{ asset('css/forum/side.css') }}">
<div id='side'>
	<div id='side_title'>
		@lang('forum.latest')
	</div>						
	<div id='side_desc'>
		@foreach($blogpost as $post)
		<a href="/blog/post/{{ $post->id}}"> {{ $post->title }} </a><br>
		@endforeach
	</div>

	<div id='side_title'>
		@lang('forum.hot')
	</div>						
	<div id='side_desc'>
		@foreach($selectpost as $post)
		<a href="/forum/view/{{ $post->id}}"> {{ $post->title }} </a><br>
		@endforeach
	</div>
	<div id='side_title'>
		@lang('forum.categories')
	</div>						
	<div id='' style="display: inline-block; margin-top: 18px;">
		@foreach($categories as $category)
			<h4 style="display: inline-block"><a href="/forum/category/{{ $category->id }}" class="categoriesnav"> {{ $category->category_name }} </a></h4>
		@endforeach
	</div>
	@php
	$lang =  LaravelLocalization::getCurrentLocale();
	@endphp
	@if ($lang == 'bn')
	<style type="text/css">
		#side_title{
			font-size: 18px;
		}
	</style>
	@endif
</div>

