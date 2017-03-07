$(document).ready(function(){
	$("#resourceCreateTypeForm").validate({
		rules: {
			title: {required:true}
		},
		success: function(span) {
			// set &nbsp; as text for IE
			span.html("&nbsp;").addClass("form_label_success");
		}
	});
});