@extends('layouts.master')
@section('title')
	@section('titlename'){{ $forum->title }}
@endsection
@section('content')
	<meta name="locale" id="locale" content="{{LaravelLocalization::getCurrentLocale() }}" />

	
    <link rel="stylesheet" type="text/css" href="{{ asset('css/forum/ask.css') }}">
    <div class="container">
        <div class="question">
            <div class="col-md-12">
                <div class="row">
                	<div class="col-md-8">
	                	<div class="seper"></div>
							<form method="post" action="{{ LaravelLocalization::localizeURL('/forum/question/'.$id) }}" id="ask" class="form-inline" role="form">
							    {{ csrf_field() }}
							    <div class="form-group">
							        <td ><h6 class="cc"> @lang('forum.title') : </h6></td>
							        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
							            <h6>
							                <input type="text" class="title" name="title" value="{!! $forum->title !!} "><br>
							                @if ($errors->has('title'))
							                <span class="help-block">
							                    <strong>{{ $errors->first('title') }}</strong>
							                </span>
							                @endif
							            </h6>
							        </div> <br><br><br>
							        <td>
							            <h6>@lang('forum.category')  :</h6>
							            <h6>
							                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
							                    <select  class="category" id="category" name="category">
							                        <option value="0" selected="selected" >@lang('forum.scategory') </option> 
							                        @foreach($category as $value)
							                        <option @if($forum->category == $value->category_name)  selected="selected" @endif value="{{ $value->category_name }}">{{ $value->category_name }}</option>
							                        @endforeach
							                    </select>
							                    @if ($errors->has('category'))
							                    <span class="help-block">
							                        <strong>{{ $errors->first('category') }}</strong>
							                    </span>
							                    @endif
							                    <br>
							                </div>
							            </h6>
							        </td>
							        <br><br>  
							        <td><h6>@lang('forum.question')  :  <span id="textinfo" style="color:#00529B; padding: 2px 2px;"></span></h6></td>
							        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
							            <h5><textarea name='description' id="textareas" cols='60' rows='10'  class="s" onkeyup="countChar(this)" > {!! $forum->description !!} </textarea><input type="file" name="image" id="upload" class="hidden" onchange=""></h5><br>  
							            <div Class="ss"></div>
							            @if ($errors->has('description'))
							            <span class="help-block">
							                <strong>{{ $errors->first('description') }}</strong>
							            </span>
							            @endif
							        </div>

							  {{--       <td>
							            <h6>@lang('forum.tags')  :</h6>
							            <h6>
							                <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
							                    
							                    <input data-role="tagsinput" type="text"   @foreach($forum->tags as $tag) value="{{ $tag->name }}"  @endforeach >

							                    @if ($errors->has('tags'))
							                    <span class="help-block">
							                        <strong>{{ $errors->first('tags') }}</strong>
							                    </span>
							                    @endif
							                    <br>
							                </div>
							            </h6>
							        </td>
 --}}

							        <div class="sss" style="color: red; color: #9F6000; padding: 10px 10px; background-color: "></div>
							        <div class="g-recaptcha" data-sitekey="6LeFpCUUAAAAAOUioXa31zlGk6XfBI-mwfNoC-kz"></div> 
							        <button type="submit" class="btn btn-info btn-lg" name="submit"  role="button">@lang('user.Update') </button>
							    </div>
							</form>
	                </div>
                    <div class="col-md-4">
                    	@include('forum.side')    
                    </div>
                </div>
            </div>
        </div>  
    </div>  


<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>

<script type="text/javascript">

	var lang = $("meta[name=locale]").attr('content');;    
	if (lang != 'en') {
		var lang = 'bn_BD';
	}
	
	tinymce.init({
		selector: "textarea",
		theme: "modern",
		paste_data_images: true,
		language: lang,
		plugins: [
		"advlist autolink lists link image charmap print preview hr anchor pagebreak",
		"searchreplace wordcount visualblocks visualchars code fullscreen",
		"insertdatetime media nonbreaking save table contextmenu directionality",
		"emoticons template paste textcolor colorpicker textpattern"
		],
		toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
		toolbar2: "print preview media | forecolor backcolor emoticons",
		image_advtab: true,
		file_picker_callback: function(callback, value, meta) {
			if (meta.filetype == 'image') {
				$('#upload').trigger('click');
				$('#upload').on('change', function() {
					var file = this.files[0];
					var reader = new FileReader();
					reader.onload = function(e) {
						callback(e.target.result, {
							alt: ''
						});
					};
					reader.readAsDataURL(file);
				});
			}
		},
		setup: function(editor) {
			editor.on('keydown', function(e) {
				var key = e.keyCode || e.which;
			}).on('keyup', function(e) {
				var len = tinymce.activeEditor.getContent().length;
				var s="500";
				if (len>s) {
					if (lang == 'en') {
						$('.sss').html("Warning:::  Description must be between 2000 characters.");
					}
					else{
						$('.sss').html("সাবধানবাণী:::  বর্ণনা ২০০০ অক্ষরের মধ্যে হতে হবে।");
					}
					$('.sss').css("background-color","#FEEFB3")  
				}
				else{
					$('.sss').html("")
					$('.sss').css("background-color","white")
				}
			}).on('click',function(e) {
				if (lang == 'en') {
					$('#textinfo').html(" Description must be between 2000 characters.")
				}
				else{
					$('#textinfo').html(" বর্ণনা অবশ্যই ২০০০ অক্ষরের মধ্যে হতে হবে।")
				}
				$('#textinfo').css("background-color","#BDE5F8").delay(100);
				$('#textinfo').attr("class","fa fa-info-circle")
				setTimeout(function() {
					$("#textinfo").fadeOut(1500);
				},3000);
			});
		}, 
		templates: [{
			title: 'Test template 1',
			content: 'Test 1'
		}, {
			title: 'Test template 2',
			content: 'Test 2'
		}]
	});
</script>


<script type="text/javascript">
	$('#textareas').css('opacity', 0);
	$(window).load(function() {
		$('#textareas').css('opacity', 1);
	});
</script>





@endsection


