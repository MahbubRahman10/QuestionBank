@extends('layouts.master')
@section('title')
    @section('titlename')Blog
@endsection
@section('content')
	<meta name="locale" id="locale" content="{{LaravelLocalization::getCurrentLocale() }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/forum/blog.css') }}">
    <div class="container">
        <div class="question">
                    <?php 
                    $lang =  LaravelLocalization::getCurrentLocale();
                    $english =array('0','1','2','3','4','5','6','7','8','9');
                    $bangla =array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
                    use Jenssegers\Date\Date; 
                    ?>
                    @if ($lang == 'bn')
                    {{ Date::setLocale('bd') }}
                    @endif
                	<div class="col-md-8">
	                	@foreach ($blogposts as $blogpost)
                		<div class="blogpost">      
                			<h3><a href="/blog/post/{{ $blogpost->id }}"> {{ $blogpost->title }} </a></h3>
                			<p class="timediff"> @if($lang == 'en') {{ Carbon\Carbon::parse($blogpost->created_at)->format('d M Y') }}  @else {!! str_replace($english, $bangla,Date::parse($blogpost->created_at)->format('j F Y')) !!} @endif  | {{ $blogpost->admin->name }}</p>   
                			<div class="des"> {!!  substr($blogpost->description,0,strpos($blogpost->description, ' ', 400)) !!}... </div>
                           
                			<a href="/blog/post/{{ $blogpost->id }}" class="btn btn-primary" style="margin-top: 10px; ">@lang('forum.readmore')</a>
                		</div>
                		@endforeach
	                </div>
                    <div class="col-md-4">
                    	@include('blog.side')    
                    </div>
                
        </div>  
    </div>  


@endsection


