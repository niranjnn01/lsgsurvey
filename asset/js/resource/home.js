$(document).ready(function(){
/*
	$('.resource_type_filter, .ext_filter, .category_filter').change(function(){
		gotoPage("resource/index/" +
				 $('#f_resource_type').val() + "/" +
				 $('#f_category').val());
	});
	*/

	$('#resource_search_form').submit(function (event) {
		
		event.preventDefault();
		submit_for_search();
	});
	
	$('#search').click(function (){
		
		submit_for_search();
	});


});

function submit_for_search() {
	
	var search_string = $('#search_query').val() ? '&q=' + encodeURIComponent( $('#search_query').val() ) : '';
	
	//query_string = query_string ? '?' + query_string : '';
	
		gotoPage(
			'resource/index?' + 
			'type=' + $('#f_resource_type').val() + 
			'&category=' + $('#f_category').val() +
			search_string
		);
}