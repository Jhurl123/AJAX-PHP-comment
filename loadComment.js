
$(document).ready( function () {
	
	
	$('.load').on('click', function() {
		
		
		var row = Number($('#row').val());
		var allCount = Number($('#allRows').val());
		var rowPerPage = 3;
		
		row = row + rowPerPage;
		
		if(row <= allCount){
			
			$('#row').val(row);
			
			$.ajax({
				url: 'commentHandler.php',
				type: 'post',
				data: {'row':row},
				success: function (data){
					
					$(".wrap:last").after(data).show().fadeIn("slow");
					
					var rowno = row + rowPerPage;
					
					
					if(rowno > allCount){
						
						
						$('.load').text("Hide");
						$('.load').css("background","blue");
						
					}
					else{
						
						$('.load').text("Load Many");
						
						$('.wrap:nth-child(3)').nextAll('.post').remove();
						
						$('#post').val(0);
					}
				}
			});
		}
		
		else{
			
			$('.load').text("Loading...");
			
		}
		
		
		 
		
	});
	
	
	
	$("#commForm").submit(function(e) {
		
		
		e.preventDefault();
		var formData = {
            'name'              : $('input[name=authorName]').val(),
            'comment'             : $('textarea[name=comment]').val(),
		};
		
		console.log("gfd");
		var add="add";
		
		$.ajax({
			url:'commentHandler.php',
			type: 'post',
			data:{'add':add, 'data': formData},
			
			success:function(data) {
				console.log(data);
				
				$(".wrap:last").after(data).show().fadeIn("slow");
			}
			
			
			
			
		})
		$("#commForm" ).each(function(){
            this.reset();
});
		e.preventDefault();
		
	});
	
	
	
	
	
$('.newComment').on('click', function() {
	$(window).scrollTop($('#commentDiv').offset().top);
});

$(document).on('click','.scroll', function() {
	$(window).scrollTop($('#commentDiv').offset().top);
});


$('.reply').on('click', function() {
	
	var newForm = $('#commForm');
    var butt = $('#submitButton');
	  newForm.css("width" ,"40%");
	  butt.css("width", "100%");
	$(this).parent().parent().parent().parent().after(newForm);
	
});






	
});