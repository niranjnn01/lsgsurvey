$(document).ready(function(){
	
	$('.remove').click(function (event) {
		
		event.stopPropagation();
		event.preventDefault();
		
		
		var ward_id = $(this).attr('id');
		
		var url = '<?php echo $base_url;?>' + 'ward/remove_from_user/' + ward_id;
		
		if( confirm('are you sure you want to remove the ward?') ) {
		
			$.get( url, function (data) {
				
				if( data.success == 1 ) {
					
					gotoPage('<?php echo $base_url;?>' + 'ward/manage');
				}
			});		
		}
	});

});

