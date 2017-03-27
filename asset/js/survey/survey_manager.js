
var base_url = '<?php echo $base_url;?>';
var dont_confirm_leave = 1; //set dont_confirm_leave to 1 when you want the user to be able to leave withou confirmation
$(document).ready(function(){

	console.log(question_groups[1]);
  if (storageAvailable('localStorage')) {

		var temporary_survey_number = null;
		var temporary_survey_current_question = 0;
		var temporary_survey_last_processed_question = 0;
		var temporary_survey_is_last_question = false;


		if($('#current_temporary_survey_number').val()) {
			temporary_survey_number = $('#current_temporary_survey_number').val();
			temporary_survey_current_question = $('#current_temporary_survey_next_question').val();
			temporary_survey_last_procesed_question = $('#current_temporary_survey_last_procesed_question').val();

			temporary_survey_is_last_question = $('#current_temporary_survey_is_last_question').val() == 1 ? true : false;

		}

    //var temporary_survey_number = localStorage.getItem('temporary_survey_number');

    if( temporary_survey_number == null) {

      // get the survey information
      $.ajax({
        url: base_url + "survey/current_survey",
        type:"GET",
        success:function (data) {


          // store survey information locally.
          localStorage.setItem('temporary_survey_number', data.temporary_survey_number);
          localStorage.setItem('current_question', data.current_question);
          localStorage.setItem('last_question', 'false');

					if(data.temporary_survey_number != 0) {
						//contact the server for first question
	        	fetchNextQuestion();
					} else {
						alert("Error: No Survey found");
					}

          /*
          $.ajax({
            url: base_url + "question/get/" + data.temporary_survey_number + "/" + data.current_question,
            type:"GET",
            success:function (data) {

              //console.log('success called');

              localStorage.setItem('answer_type', data.answer_type);

              appendQuestion(data);

						  $('#survey_container').addClass('animated fadeInLeft');
						  $('#survey_container').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function (){$('#survey_container').addClass('animated fadeInLeft');});

            },
            dataType : "json"
          });
					*/

        },
        dataType : "json"
      });

    } else {


			// store survey information locally.
			localStorage.setItem('temporary_survey_number', temporary_survey_number);
			localStorage.setItem('current_question', temporary_survey_last_procesed_question); // TO Do : fetchNextQuestion() should use "last_processed_question" instead of current_question. for more clarity in code
			localStorage.setItem('last_question', temporary_survey_is_last_question);

			//contact the server for next question
			fetchNextQuestion();
		}

  }
  else {
  	alert("Please use a modern browser to access this page");
  }





  $('#next_btn').click(function (event) {


    event.preventDefault();

    // handle the current answer
    handleCurrentAnswer();
  });

});

function fetchNextQuestion() {
  //clear the container
  $('#question_container').html('');

  var temporary_survey_number = localStorage.getItem('temporary_survey_number');
  var current_question = localStorage.getItem('current_question');


  //contact the server for next question
  $.ajax({
    url:base_url + "question/get/" + temporary_survey_number + "/" + (parseInt(current_question) + 1),
    type:"GET",
    success:function (data) {


      localStorage.setItem('current_question', (parseInt(current_question) + 1));
      localStorage.setItem('last_question', data.last_question);
      localStorage.setItem('answer_type', data.answer_type);
      appendQuestion(data);
	  $('#survey_container').removeClass('animated fadeInLeft');
	  $('#survey_container').addClass('animated fadeInLeft');
			  $('#survey_container').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function (){$('#survey_container').removeClass('animated fadeInLeft');});

    },
    dataType : "json"
  });
}


function handleCurrentAnswer() {


  var bWasSuccessful = false;

  if($('#question_container').html() != '') {

    var answer_type = localStorage.getItem('answer_type');
    var current_question = localStorage.getItem('current_question');



    var oDataObject = new Object();


      switch(answer_type) {

        case "1":
          var input = $('#question_container .answer_block input[name="single_value_text"]').val();

          oDataObject.single_value_text = input;
          break;

        case "2":
          var input = $('#question_container .answer_block input[name="single_value_radio"]:checked').val();

          oDataObject.single_value_radio = input;
          break;

        case "3":
          oDataObject.multi_value_checkbox = $('#question_container .answer_block input[name="multi_value_checkbox"]:checked').map(function () {
            return $(this).val();
          }).get();
        case "4":
          var input = $('#question_container .answer_block textarea[name="single_value_textarea"]').val();

          oDataObject.single_value_textarea = input;
          break;

      }

    //Submit data back to server
    $.ajax({
      url: base_url + "survey/accept_answer/" + current_question,
      data: oDataObject,
      method:"POST",
      success:function (data) {

        if(data.error == '') {


          var last_question = localStorage.getItem('last_question');



          if(last_question == "true") {
            surveyCompleteRoutines();
          } else {
			dont_confirm_leave = 0;
            fetchNextQuestion();
          }

        }

      },
      error:function (data) {

        alert('There was some problem loading the question');
      },
      dataType : "json"
    });
  }

}

function showSurveyCompleteView() {

  // remove all buttons etc
  $('#survey_container').html('');

  $('#question-group-id').text('');
  // show link to access the survey result page. => view page of an individual survey!
  $('#survey_container').html(
    $(
      '<div style="text-align:center;">' +
        '<h4>Survey has been completed !</h4>' +
        '<a href="'+base_url+'search/" style="align:center" class="btn btn-primary">Search the data collected' +
        '</a>' +
      '</div>'
      )
  );
}


function surveyCompleteRoutines() {

  //just let the server know that the survey was completed.

  $.ajax({
    url: base_url + "survey/complete",
    type:"GET",
    success:function (data) {

      if(data.error == '') {

        showSurveyCompleteView();
		dont_confirm_leave = 1;
      } else {

        alert("There was some problem completing the survey.");
      }

    },
    dataType : "json"
  });

}

function appendQuestion(data) {

  var answer_html = '';

  //console.log(JSON.stringify(data));

  switch(data.answer_type) {
    case 1:
      answer_html =
      '<div class="form-group">'+
      '<input type="text" name="single_value_text" class="form-control"/>' +
      '</div>'
      break;
    case 2:

      answer_html =
      '<div class="radio">';

      $.each(data.answer_options, function (index, answer_option){
		// name="'+ data.field_name +'"
        answer_html +=
        '<label class="radio-inline">' +
          '<input type="radio" name="single_value_radio" value="'+ answer_option.value +'"/> ' + answer_option.title +
        '</label>';

      });

      answer_html += '</div>';
      break;

    case 3:

      answer_html =
      '<div class="radio">';

      $.each(data.answer_options, function (index, answer_option){
		// name="'+ data.field_name
        answer_html +=
        '<label class="checkbox-inline">' +
          '<input type="checkbox" name="multi_value_checkbox" value="'+ answer_option.value +'"/> ' + answer_option.title +
        '</label>';

      });

      answer_html += '</div>';
      break;
    case 4:
      answer_html =
      '<div class="form-group">'+
      '<textarea name="single_value_textarea" class="form-control" rows="4"></textarea>' +
      '</div>'
      break;


  }

  $('#question-group-id').text(question_groups[data.group_id].title);
  $('#question_container').html(
    $(
      '<h3>'+
      data.title +
      '</h3>'+
      '<div class="answer_block">'+

      answer_html +

      '</div>'
    )
  );
}





function storageAvailable(type) {
	try {
		var storage = window[type],
			x = '__storage_test__';
		storage.setItem(x, x);
		storage.removeItem(x);
		return true;
	}
	catch(e) {
		return false;
	}
}
