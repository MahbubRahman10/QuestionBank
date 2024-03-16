{{-- Tinymce HtmlEditor --}}
<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">

	var lang = $("meta[name=locale]").attr('content');;    
	if (lang != 'en') {
		var lang = 'bn_BD';
	}
	
	tinymce.init({
		selector: "#description",
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
					  
				}
				else{
					
				}
			}).on('click',function(e) {
				if (lang == 'en') {
					
				}
				else{
					
				}
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
						
					}
					else{
						
					} 
				}
				else{
					
				}
			}).on('click',function(e) {
				if (lang == 'en') {
					
				}
				else{
					
				}
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
	
	$(document).ready(function() { 
		// Open/Close Edit Reply Textarea
		$('.editreply').on('click', function() {	
			var id=$(this).attr("data-id");
			var n=parseInt(id);
			var display=$('.editsreplys' + n).css("display");
			if (display=="none") {
				$('.editsreplys' + n).fadeIn(800);
				$('#descs' + n).css("display","none");
				$('#replydescription').css('display', 'none');
			}
			else{
				$('#descs' + n).fadeIn(800);
				$('.editsreplys' + n).css("display","none");
				$('#replydescription').css('display', 'block');
			}
		});
		// Close Edit Reply Textarea on Cancel Button
 		$('.btn').on('click', function(e) {	
			e.preventDefault();
			var id=$(this).attr("data-id");
			var n=parseInt(id);
			$('.editsreplys' + n).css("display","none");
			$('#replydescription').css('display', 'block');
			$('#descs' + n).fadeIn(800);
		});

 		// Edit Reply
		$('.btns').on('click', function(e) {	
			e.preventDefault();
			var id=$(this).attr("data-id");
			var n=parseInt(id);
			tinyMCE.triggerSave();
			var description=$('.editdescription'+id).val();
			$.ajax({
				url :"/forum/reply/editreply",
				type:"GET",
				data:{'id':n,'description':description},
				dataType:"JSON",
				success:function(data){
					var descriptions=data.description;
					$('#descs' + n).html(descriptions);
					$('.editsreplys' + n).css("display","none");
					$('#descs' + n).fadeIn(800);
				},
				error:function(error){
					console.log(error)
				},
			});
		});

		// Like Reply
		$('.d').on('click', function() {	
			var reply_id=$(this).attr("data-id");
			var value=$('.likes').attr("value");

			$('.colorfont'+reply_id).animate({
				fontSize: "21px"
			}, 200);

			$.ajax({
				url : "/forum/reply/likereply",
				type: "GET",
				data: {'id':reply_id,'value':value},
				dataType: "JSON",
				success: function (data){

					// Withdraw Dislike
					var dislike = $('.userdislikecolor'+reply_id).data('status')
					if (dislike == 'dislike') {
						$('.userdislikecolor'+reply_id).css({
							'color': '',
							'font-weight': ''
						});
						var dislikevalue = $('#dislike'+reply_id).html()
						var dislikevalue = parseInt(dislikevalue) - 1
						
						if (dislikevalue == '0') {
							$('#dislike'+reply_id).html('')
						}
						else{
							$('#dislike'+reply_id).html(dislikevalue)
						}
						
						$('.userdislikecolor'+reply_id).attr('data-status', 'none');
						$('.dislikecolor'+reply_id).removeClass('userdislikecolor'+reply_id)
					}

					var like=data.like;
					if(data.status == 'rise'){
						$('.likecolor'+reply_id).css('color', 'black')

						$('.likecolor'+reply_id).addClass('userlikecolor'+reply_id)
						$('.userlikecolor'+reply_id).attr('data-status', 'like');
					}
					else{
						$('.likecolor'+reply_id).css('color', '#357868')

					}
					$('.colorfont'+reply_id).animate({
						fontSize: "20px"
					}, 200);
					$('#like' + reply_id).html(like);
					$('#blike' + reply_id).html(like);
				},
				error:function(){
					alert("error")
				},
			});
		});


		// Dislike Reply
		$('.dis').on('click', function() {	
			var reply_id=$(this).attr("data-id");
			var value=$('.dislikes').attr("value");

			$('.discolorfont'+reply_id).animate({
				fontSize: "21px"
			}, 200);
			$.ajax({
				url : "/forum/reply/dislikereply",
				type: "GET",
				data: {'id':reply_id,'value':value},
				dataType: "JSON",
				success: function (data){

					// Withdraw Like
					var like = $('.userlikecolor'+reply_id).data('status')
					if (like == 'like') {
						$('.userlikecolor'+reply_id).css({
							'color': '',
							'font-weight': ''
						});
						var likevalue = $('#like'+reply_id).html()
						var likevalue = parseInt(likevalue) - 1
						
						if (likevalue == '0') {
							$('#like'+reply_id).html('')
						}
						else{
							$('#like'+reply_id).html(dislikevalue)
						}

						$('.userlikecolor'+reply_id).attr('data-status', 'none');
						$('.likecolor'+reply_id).removeClass('userlikecolor'+reply_id)
						
					}

					var like=data.like;
					if(data.status == 'rise'){
						$('.dislikecolor'+reply_id).css('color', 'black')

						$('.dislikecolor'+reply_id).addClass('userdislikecolor'+reply_id)
						$('.userdislikecolor'+reply_id).attr('data-status', 'dislike');
					}
					else{
						$('.dislikecolor'+reply_id).css('color', '#357868')
					}
					$('.discolorfont'+reply_id).animate({
						fontSize: "20px"
					}, 200);
					$('#dislike' + reply_id).html(like);
				},
				error:function(){
					alert("error")
				},
			});
		});

	});

</script>
