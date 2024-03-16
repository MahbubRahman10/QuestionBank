<div class="col-md-4">
   	<div id='side'>
		<div id='side_title'>
			প্রাসঙ্গিক বিষয়
		</div>						
		<div id='blog_post'>
		
			@foreach($blogpost as $post)
			<a href="/viewpost/{{ $post->id}}"> {{ $post->postTitle }} </a><br><br>
			@endforeach
		</div>

	</div>	





		
		<div id='side'>
			
	
	</div>




	</div>




<div class="col-md-4">
<br>
   	<div id='side'>
		<div id='side_title'>
			নির্বাচিত প্রশ্ন
		</div>						
		<div id='blog_post'>
		
			@foreach($selectpost as $post)
			<a href="/viewpost/{{ $post->id}}"> {{ $post->title }} </a><br><br>
			@endforeach
		</div>

	</div>	





		
		<div id='side'>
			
	
	</div>




	</div>

