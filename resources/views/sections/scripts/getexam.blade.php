<script type="text/javascript">
	 
		 $(document).ready(function() {
				// Get id from Subject for Section		 		
		 		$('#subject').change(function() {
		 			var selected = $(':selected').val(); 
		 			$('#section').attr('data-id', selected);
		 			$('#ful').attr('data-id', selected);
		 		});

		 		// Open Section Option for Get Sections
		 		$('#section').click(function() {
		 			var classsubid = $('#section').attr('data-id');
		 			if (classsubid != '') {
			 			$.ajax({
			 				url: '/exams/section/getsection',
			 				type: 'GET',
			 				dataType: 'json',
			 				data: {csid: classsubid},
			 			})
			 			.done(function(data) {
			 				var myJSONText = JSON.stringify(data);
			 				
			 				$('#sections').append("<option value='0' class='selected'>নির্বাচন করুন</option>")

			 				for (i = 0; i < data.length; i++) { 
			 					$('#sections').append("<option value='"+ data[i].id +"' data-id='"+ classsubid +"'>"+ data[i].section_name +"</option>")
			 				}	
			 				$('.sections').css('display', 'block');
			 			})
			 			.fail(function() {
			 				console.log("error");
			 			})
			 			.always(function() {
			 				console.log("complete");
			 			});
			 		}
		 		});
		 		// Close Section Option On Click on full
		 		$('#full').click(function() {
		 			$('.sections').css('display', 'none');
		 		});



		 		// Close Subject Option On Click on full
		 		$('#fulls').click(function() {
		 			$('.subjects').css('display', 'none');
		 		});
		 		// Open Subject Option for Get Subject
		 		$('#subjects').click(function() {
		 			$('.subjects').css('display', 'block');
		 		});



		 		// Validtion form
		 		$('.form').submit(function(event){

		 			var category = $('#category').val(); 
		 			var question = $('#question').val(); 

		 			var test = $('.test').val();
		 			if (test == '' || test == 'university') {

		 				var radio = $('input[name=optradio]:checked').val();

		 				if (radio == 2) {
		 					var subject = $('#subject').val();	
		 				}

		 				if (radio == undefined && category == 0 && question == 0) {
		 					$('.errorRadio').html("Please Fill ot this field");
			 				$('.errorCategory').html("Please Fill ot this field");
			 				$('.errorQuestion').html("Please Fill ot this field");

			 				$('.form-control').addClass('e');
		 					event.preventDefault();
			 			}
			 			else if(radio == undefined){
			 				$('.errorRadio').html("Please Fill ot this field");
			 				event.preventDefault();
			 			}
			 			else if(radio == 2 && subject == 0){
			 				$('.errorSubject').html("Please Fill ot this field");
			 				$('#subject').addClass('e');
			 				event.preventDefault();
			 			}
			 			else if(category == 0){
			 				$('.errorCategory').html("Please Fill ot this field");
			 				$('#category').addClass('e');
			 				event.preventDefault();
			 			}
			 			else if(question == 0){
			 				$('.errorQuestion').html("Please Fill ot this field");
			 				event.preventDefault();
			 				$('#question').addClass('e');
			 			}

		 			}
		 			else{

		 				var radio = $('input[name=optradio]:checked').val();
		 				if (radio == 2) {
		 					var sections = $('#sections').val();	
		 				}

		 				if (subject == 0 && category == 0 && radio == undefined && question == 0) {
			 				$('.errorSubject').html("Please Fill ot this field");
			 				$('.errorCategory').html("Please Fill ot this field");
			 				$('.errorRadio').html("Please Fill ot this field");
			 				$('.errorQuestion').html("Please Fill ot this field");

			 				$('.form-control').addClass('e');
		 					event.preventDefault();
			 			}
			 			else if(subject == 0){
			 				$('.errorSubject').html("Please Fill ot this field");
			 				$('#subject').addClass('e');
			 				event.preventDefault();
			 			}
			 			else if(category == 0){
			 				$('.errorCategory').html("Please Fill ot this field");
			 				$('#category').addClass('e');
			 				event.preventDefault();
			 			}
			 			else if(radio == undefined){
			 				$('.errorRadio').html("Please Fill ot this field");
			 				event.preventDefault();
			 			}
			 			else if(radio == 2 && sections == 0){
			 				$('.errorSection').html("Please Fill ot this field");
			 				event.preventDefault();
			 				$('#sections').addClass('e');
			 			}
			 			else if(question == 0){
			 				$('.errorQuestion').html("Please Fill ot this field");
			 				event.preventDefault();
			 				$('#question').addClass('e');
			 			}
		 			}




		 		});
		 });
	</script>