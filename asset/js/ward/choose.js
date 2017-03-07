$(document).ready(function(){
	

	$('#district').change(function() {
		
		var district_id = $(this).val();
		var url = '<?php echo $base_url;?>' + 'address/get_ward/' + district_id;
		
		
		var num = $(this).attr('data-num');
		
		if( district_id !=0 ) {
		
		
			$.get( url, function (data) {
				
				ward_data = data.page;
				
				if( data.success == 1 ) {
					
					var ward_id = '#ward_id';
					
					$(ward_id).empty();
					
					$.each(ward_data, function (key, value) {
						console.log(value);
						$(ward_id).append(new Option(value, key));	
					});	
				}
			});	
		}
		
		
	});

});

