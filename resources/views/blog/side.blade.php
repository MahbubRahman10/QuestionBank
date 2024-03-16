<link rel="stylesheet" type="text/css" href="{{ asset('css/forum/side.css') }}">
<div id='side'>
	<div id='side_title'>
		@lang('forum.latest')
	</div>						
	<div id='side_desc'>
		@foreach($blogpost as $post)
		<a href="/blog/post/{{ $post->id}}"> {{ $post->title }} </a><br><br>
		@endforeach
	</div>						
</div>

