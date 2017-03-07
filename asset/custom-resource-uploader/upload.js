
/*
var uploader2 = new qq.FineUploader({

	element: document.getElementById("uploader"),
	request: {
		endpoint: "http://localhost/johnson/lsg/resource_uploader/receive",
		params:{
			"uploadify_session_token":"123",
			"uploadify_user_acc_no":"345"
		}
	},
	validation: {
		itemLimit: 2
	},
	deleteFile: {
		enabled: true,
		endpoint: "http://localhost/johnson/lsg/resource_uploader/delete_file"
	},
	resume: {
		enabled: true
	},
	retry: {
		enableAuto: true,
		showButton: true
	}
});
*/

$(document).ready(function () {


	$("#uploader").fineUploader({
		request: {
			endpoint: "http://localhost/johnson/lsg/resource_uploader/receive",
			params:{
				"uploadify_session_token":$('#uploadify_session_token').val(),
				"uploadify_user_acc_no":$('#uploadify_user_acc_no').val(),
				"upload_scenario":$('#upload_scenario').val()
			}
		},
		validation: {
			itemLimit: $('#file_num_limit').val()
		},
		deleteFile: {
			enabled: true,
			forceConfirm: true,
			endpoint: "http://localhost/johnson/lsg/resource_uploader/delete_file"
		},
		resume: {
			enabled: true
		},
		retry: {
			enableAuto: true,
			showButton: true
		},
		callbacks: {
			onAllComplete: function(succeeded, failed) {
				console.log(JSON.stringify(succeeded));

				if(succeeded) {
						$.each(succeeded, function(index, item) {

								$('#auxillary_form_upload').append('<input type="text" name="uploaded_items[]" value="'+ item +'"/>');
						});
				}
			},
			onComplete: function(id, name, response) {
				console.log(JSON.stringify(response));
				console.log(id);
				console.log(name);
if(response.success = "true") {
	//$('#auxillary_form_upload').append('<input type="text" name="uploaded_items[]" value="'+ response.queue_id +'"/>');
	$('#target_form_id', parent.document).append('<input type="text" name="uploaded_items[]" value="'+ response.queue_id +'"/>');
}
/*
				if(succeeded) {
						$.each(succeeded, function(index, item) {


						});
				}
				*/
			},

			onSubmitDelete: function(id) {

        this.setDeleteFileParams(
					{
						upload_scenario: $('#upload_scenario').val()
					},
					id);
    	}
		}
	});

	//

});
