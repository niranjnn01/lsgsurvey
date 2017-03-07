$(document).ready(function(){
	$("#resourceCreateCategoryForm").validate({
		rules: {
			 title: {required:true},
		},
		errorPlacement: function(error, element) {
			if (element.attr("name") == "description"){
				error.insertAfter('.article_desc_err_position');
			} else {
				error.insertAfter(element);
			}
		},
		success: function(span) {
			// set &nbsp; as text for IE
			span.html("&nbsp;").addClass("form_label_success");
		}
	});
});