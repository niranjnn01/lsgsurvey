$(document).ready(function(){
  
	$('#create_meeting').click(function (eventObj){
	
		console.log($('#ward_id').val());
		
		gotoPage('meeting/create_ward_meeting?ward_id=' + $('#ward_id').val());
		
		eventObj.preventDefault();
	});

});
	
  