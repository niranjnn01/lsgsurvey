$(document).ready(function(){
	$("#eventCreateForm").validate({
		rules: {
			 title: {required:true},
			 description: {required: true},
			 event_type: {
				required: true,
				min:1,
			 },
			 admission_type: {
				required: true,
				min:1,
			 },
			 starting_on: {required: true},
			 ending_on: {required: true},
			 venue: {required: true},
		},
		groups: {
			starting_date : "starting_on, starting_time, starting_time_period",
			ending_date : "ending_on, ending_time, ending_time_period"
			},
		
		errorPlacement: function(error, element) {
			//alert(element.attr("name"));
			if (
				element.attr("name") == "starting_on" ||
				element.attr("name") == "starting_time" ||
				element.attr("name") == "starting_time_period" ){
				
				error.insertAfter('#starting_on_period');
			}
			else if (
				element.attr("name") == "ending_on" ||
				element.attr("name") == "ending_time" ||
				element.attr("name") == "ending_time_period" )
			
				error.insertAfter('#ending_on_period');
			else
				error.insertAfter(element);
		},
		messages: {
			event_type:{min:"This field is required."},
			admission_type:{min:"This field is required."}
		},
		success: function(span) {
			// set &nbsp; as text for IE
			span.html("&nbsp;").addClass("form_label_success");
			
		}
		
	});
	
	$('#excerpt').limit($('#excerpt_character_limit').val(),'#charsLeft');
});