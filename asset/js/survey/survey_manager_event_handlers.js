

  // Bind Date picker for this page

  $("#question_container").on('click', '.datepicker', function () {

    //console.log('loading date picker');

    $( this ).datepicker(
      {
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: '1910:2017'
      }
    );
    $( this ).datepicker( "show" );
  });



  $('#next_btn').click(function (event) {

		//showOverlay(); - moved to handleCurrentAnswer() . so that overlay can be shown only if validation is OK.

		event.preventDefault();

    // handle the current answer
    handleCurrentAnswer('next');
  });

  $('#previous_btn').click(function (event) {


    event.preventDefault();

    // handle the current answer
    handleCurrentAnswer('prev');
  });


  $('#cancel_survey').click(function(event) {

    event.stopPropagation();
    event.preventDefault();

    if( confirm("Are you sure you want to cancel the survey?. \n data entered till now will be lost.") ) {
      gotoPage('survey/cancel/' + localStorage.getItem('temporary_survey_number'));
    }
  });
