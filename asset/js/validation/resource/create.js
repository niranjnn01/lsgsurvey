$(document).ready(function(){
	$("#resourceCreateForm").validate({
		rules: {
			title: {required:true},
			excerpt: {required:true},
			description: {required:true},
			//category:{required:true},
			resource_type:{
					required:true,
					min:1,
					}
		},
		errorPlacement: function(error, element) {
			
			if (element.attr("name") == "description"){
				error.insertAfter('.resource_desc_err_position');
			} else {
				error.insertAfter(element);
			}
		},
		messages: {
			resource_type:{min:"This field is required."}
		},
		success: function(span) {
			// set &nbsp; as text for IE
			span.html("&nbsp;").addClass("form_label_success");
		}
	});
	
	$('#excerpt').limit(500,'#charsLeft');
	
	
	
	
	<?php /*THIS IS APPLICABLE ONLY FOR THE EDIT FORM*/?>
	$('#add_to_image_gallery').click(function(){
		
		if( $( this ).is(':checked') == true ) {
			$('#image_gallery_category_cnt') .show();
			$('#image_gallery_share_cnt') .show();
            
		} else {
			$('#image_gallery_category_cnt').hide();
            $('#image_gallery_share_cnt') .hide();
		}
	});
	
	<?php /*THIS IS APPLICABLE ONLY FOR THE EDIT FORM*/?>
	$('#add_to_video_gallery').click(function(){
		if( $(this).attr('checked') == undefined || $(this).attr('checked') == 'checked' ) {
			$('#video_gallery_category_cnt').show();
		} else {
            console.log( $(this).attr('checked') );
			$('#video_gallery_category_cnt').hide();
		}
	});
	
	
});