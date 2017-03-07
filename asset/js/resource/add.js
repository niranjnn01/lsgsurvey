$(document).ready(function(){

	<?php //file upload popup box?>
	/*
	$("a#resource_add_popup").fancybox({
		width:550,
		height:200,
		fitToView	: false
	});
*/
	<?php //when back button of form is pressed?>
	$('.cancel_resource_upload_form').click(function(){
		
		$.ajax({
			url: '<?php echo $base_url, "resource/cancel_resource_upload";?>',
		});
		
		
	});
	
});
