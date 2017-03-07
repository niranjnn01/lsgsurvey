$(document).ready(function(){
$( ".datepicker" ).datepicker(
	{ 
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
        minDate: '-4M',
        maxDate: '0M',
		yearRange: $('#datepicker_from').val() + ':' + $('#datepicker_to').val()
	}
);
});

