

$(document).ready(function(){
	
	$('#file_upload').uploadify({
		
		'swf'      		: '<?php echo $uploadify_swf;?>',
		'uploader'      : '<?php echo $base_url;?>resource/upload',
		'cancelImg'   	: '<?php echo $uploadify_cancelImg;?>',
		'auto'       	: true,
		'fileTypeExts' 	: '<?php echo $uploadify_sFileExt;?>',
		'fileTypeDesc'  : '<?php echo $uploadify_fileDesc?>',
		'fileObjName' 	: 'resource',
		'uploadLimit'	: '<?php echo $uploadify_uploadLimit;?>',
		'wmode'       	: 'transparent',
		'buttonText'  	: 'Browse',
		'buttonCursor'	: 'hand',
		'buttonClass'	: 'uploadify_button_custom_style',
		'multi'			: false,
		'debug'			: false,
		'formData'  	: {
			'uploadify_session_token':'<?php echo $uploadify_session_token;?>',
			'uploadify_user_acc_no':'<?php echo $uploadify_user_acc_no;?>'
			},
		'onUploadSuccess'  	: function( file, data, response ) {

		// alert(data);
			var jsonResponse = $.parseJSON(data);
			
			if(jsonResponse.error == '') {
				
				//Upload was a success
				//$.fancybox.close();
				
				$('#file_upload_section').hide();
				$('#upload_success').show();
				
				$('#upload_success').prepend( '<span class="pull-left">' + jsonResponse.file_name + '</span>' );
				
			} else {
				
				//There was some error
				
				//remove any error messages shown previously.
				//$('.upload_resource_form').prev('.error_msg').remove();
				alert(jsonResponse.error);
                
				if(jsonResponse.error_type == <?php echo $error_types['not_logged_in'];?>){
					
					
					//window.parent.location = '<?php echo $base_url;?>user/login';
                    
					gotoPage('user/login');
				} else {
					
					//$('.upload_resource_form').before(jsonResponse.error);
					$('#upload_errors').html(jsonResponse.error);
				}
			}
		},
		'onCancel' : function(file) {
            alert('The file ' + file.name + ' was cancelled.');
        } 

	});
	
	
	
	$('.cancel_resource_upload_2').on('click', function(event) {
		
		event.preventDefault();
		
		
		//cancel the upload(if any) that happened
		// this is not working. cant see why.
		//$('#file_upload').uploadify('cancel', true);
		
		$.ajax({
			url: '<?php echo $base_url, "resource/cancel_resource_upload";?>',
		});
		
		$('#file_upload_section').show();
		$('#upload_success').html('').hide();
		
	});
	
	
});
