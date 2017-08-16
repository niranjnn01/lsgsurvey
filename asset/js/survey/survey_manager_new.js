
var base_url = '<?php echo $base_url;?>';
var dont_confirm_leave = 1; //set dont_confirm_leave to 1 when you want the user to be able to leave withou confirmation

var question_groups = <?php echo $question_groups;?>;

/**
 * This function will append row number to questions name field
 * @return {[type]} [description]
 */
function template_append_row_num_to_name_field(question_form_body, row_num) {

  //console.log(question_form_body);
  //console.log(row_num);
  return question_form_body.replace(/{row_number}/g, row_num);
}

$(document).ready(function() {

	//console.log(question_groups[1]);
  if (storageAvailable('localStorage')) {

		var temporary_survey_number = null;
		var temporary_survey_current_question = 0;
		var temporary_survey_last_processed_question = 0;
		var temporary_survey_is_last_question = false;
    var current_temporary_survey_status = null;



		if($('#current_temporary_survey_number').val()) {

			temporary_survey_number = $('#current_temporary_survey_number').val();
			temporary_survey_current_question = $('#current_temporary_survey_next_question').val();
      //temporary_survey_current_question_uname = $('#current_temporary_survey_current_question_uname').val();
			temporary_survey_last_procesed_question = $('#current_temporary_survey_last_procesed_question').val();
			temporary_survey_is_last_question = $('#current_temporary_survey_is_last_question').val() == 1 ? true : false;

      current_temporary_survey_status = $('#current_temporary_survey_status').val();

			// not to be used in production
			displayTemporarySurveyNumber(temporary_survey_number);

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


					// not to be used in production
					displayTemporarySurveyNumber(data.temporary_survey_number);


					if(data.temporary_survey_number != 0) {
						//contact the server for first question
	        	fetchNextQuestion();
					} else {
						alert("Error: No Survey found");
					}

        },
        dataType : "json"
      });

    } else {

      //console.log(current_temporary_survey_status);

			// store survey information locally.
			localStorage.setItem('temporary_survey_number', temporary_survey_number);
			localStorage.setItem('current_question', temporary_survey_last_procesed_question); // TO Do : fetchNextQuestion() should use "last_processed_question" instead of current_question. for more clarity in code
			localStorage.setItem('last_question', temporary_survey_is_last_question);

      localStorage.setItem('current_temporary_survey_status', current_temporary_survey_status);

      switch(current_temporary_survey_status) {

        case '1':
          //contact the server for next question
          fetchNextQuestion();
          break;

        case '2':
          surveyCompleteRoutines();
          break;
      }

		}

  }
  else {
  	alert("Please use a modern browser to access this page");
  }


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

});


function displayTemporarySurveyNumber(temporary_survey_number) {

	$('#survey_no_display_counter').html(temporary_survey_number);
}

function showOverlay(){
	$('#overlay').show();
}
function hideOverlay(){
	$('#overlay').hide();
}

function defaultFor(arg, val) {
	return typeof arg !== 'undefined' ? arg : val;
}

function defaultForInteger(arg, val) {
	return typeof arg !== NaN ? arg : val;
}

function fetchNextQuestion(question_id) {

  //clear the container
  $('#question_container').html('');

  var temporary_survey_number = localStorage.getItem('temporary_survey_number');
  var current_question = localStorage.getItem('current_question');

	var next_question_id = (parseInt(current_question) + 1);

	// see if a question id is specified. else, we default to the next question WRT current_question.
	next_question_id = defaultFor(question_id, next_question_id);


  //contact the server for next question
  $.ajax({
    url:base_url + "question/get/" + temporary_survey_number + "/" + next_question_id,
    type:"GET",
    success:function (data) {

      localStorage.setItem('current_question', next_question_id);


      localStorage.setItem('last_question', data.last_question);
      localStorage.setItem('answer_type', data.answer_type);
			localStorage.setItem('question_type', data.question_type);

      localStorage.setItem('question_form_body', ( typeof data.question_form_body !== "undefined" ) ? data.question_form_body : '');



			// append the question to the viewing area.
			appendQuestion(data);

      //remove overlay
		  $('#survey_container').removeClass('animated fadeInLeft');
		  $('#survey_container').addClass('animated fadeInLeft');
			$('#survey_container').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function (){$('#survey_container').removeClass('animated fadeInLeft');});
		  hideOverlay();
    },
    dataType : "json"
  });
}


function handleCurrentAnswer(direction) {


  var bWasSuccessful = false;

  if($('#question_container').html() != '') {

    var answer_type = localStorage.getItem('answer_type');
		var question_type = localStorage.getItem('question_type');
    var current_question = localStorage.getItem('current_question');



    var oDataObject = new Object();

		if( question_type == 2 ) { //question type = group

			switch(current_question) {

				case "1" :
        $('#question_container .answer_block .repeating-row').each(function(index, elem){

          oDataObject_New = {};

          // all form inputs which are of type "text"
          $(elem).find('input[type="text"]').each(function(index, elem){

            oDataObject_New[$(elem).attr('name')] = $(elem).val();
          });

          // all form inputs which are select
          $(elem).find('select').each(function(index, elem){

            oDataObject_New[$(elem).attr('name')] = $(elem).val();
          });


          oDataObject[index] = oDataObject_New;
        });


          break;

				case "2" :

        // all form inputs which are of type "text"
        $('#question_container .answer_block').find('input[type="text"]').each(function(index, elem){

          oDataObject[$(elem).attr('name')] = $(elem).val();
        });

					break;
			}

		} else { //question type = individual

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

				case "5":
					var input = $('#question_container .answer_block select[name="single_value_select"]').val();

					oDataObject.single_value_select = input;
					break;
      }
		}

/*
console.log(JSON.stringify(oDataObject));
return false;
*/

    // see if this data is valid
    if( is_data_valid() ) {

      // show over lay
      showOverlay();

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

}

function showSurveyCompleteView(survey_id) {

  // remove all buttons etc
  $('#survey_container').html('');
  hideOverlay();

  $('#question-group-id,#question-status').text('');
  // show link to access the survey result page. => view page of an individual survey!
  $('#survey_container').html(
    $(
      '<div style="text-align:center;">' +
        '<h4>Survey has been completed !</h4>' +
        '<a href="'+base_url+'survey/data/'+survey_id+'" style="align:center" class="btn btn-primary">View the data collected' +
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

        showSurveyCompleteView(data.survey_id);
	      dont_confirm_leave = 1;

      } else {

        alert("There was some problem completing the survey.");
      }

    },
    dataType : "json"
  });

}


function constructAnswerFormParts(data, bProvideWrapper){


//console.log(data.uid + ' , ' + data.answer_type);

	var answer_html = '';
  bProvideWrapper = defaultFor(bProvideWrapper, true);

	var q_uid_class_name = 'q_uid_' + data.uid;


	switch(data.answer_type) {

		case '1':

			answer_html += bProvideWrapper ? '<div class="form-group">' : '';
			answer_html += '<span class="'+ q_uid_class_name +'"><input type="text" name="single_value_text" class="form-control"/></span>';
			answer_html += bProvideWrapper ? '</div>' : '';
			break;

		case '2':



			answer_html += bProvideWrapper ? '<div class="radio">' : '';

			answer_html +=
			'<span class="'+ q_uid_class_name +'">';

			$.each(data.answer_options, function (index, answer_option){
				// name="'+ data.field_name +'"
				answer_html += bProvideWrapper ? '<label class="radio-inline">' : '';
				answer_html += '<input type="radio" name="single_value_radio" value="'+ answer_option.value +'"/> ' + answer_option.title;
				answer_html += bProvideWrapper ? '</label>' : '';
			});

			answer_html += '</span>';

			answer_html += bProvideWrapper ? '</div>' : '';


			break;

		case '3':

			answer_html += bProvideWrapper ? '<div class="radio">' : '';

			answer_html += '<span class="'+ q_uid_class_name +'">';

			$.each(data.answer_options, function (index, answer_option){
				answer_html +=
				'<label class="checkbox-inline">' +
					'<input type="checkbox" name="multi_value_checkbox" value="'+ answer_option.value +'"/> ' +
					((answer_option.title == undefined) ? '' : answer_option.title)  +
				'</label>';
			});

			answer_html += '</span>';

			answer_html += bProvideWrapper ? '</div>' : '';
			break;

		case '4':

			answer_html += bProvideWrapper ? '<div class="form-group">' : '';
			answer_html +=
			'<span class="'+ q_uid_class_name +'">'+
			'<textarea name="single_value_textarea" class="form-control" rows="4"></textarea>' +
			'</span>';
			answer_html += bProvideWrapper ? '</div>' : '';
			break;

		case '5':

			answer_html += bProvideWrapper ? '<div class="form-group">' : '';
			answer_html +=
			'<span class="'+ q_uid_class_name +'">'+
			'<select name="single_value_select" class="form-control">';
			//console.log(JSON.stringify(data.answer_options));

			   //attach the non-selection option first
			   if(data.answer_non_selection_option) {
           $.each(data.answer_non_selection_option, function (index, answer_option){
            answer_html +=
            '<option value="'+ answer_option.value +'">' +
             ((answer_option.title == undefined) ? '' : answer_option.title) +
            '</option>';
          });
         }

				$.each(data.answer_options, function (index, answer_option){

					answer_html +=
					'<option value="'+ answer_option.value +'">' +
					 ((answer_option.title == undefined) ? '' : answer_option.title) +
					'</option>';
				});
			answer_html += '</select>' + '</span>';
			answer_html += bProvideWrapper ? '</div>' : '';
			break;

	}

	return answer_html;
}

function appendQuestion(data) {

  var answer_html = '';


  // clear any control buttons activated during the last question
  $('#add_button_cnt').html('');


  // construct the question body

	if(data.question_type == 1) {

    //console.log(data.question_type);

    //console.log(JSON.stringify(data));
		answer_html = constructAnswerFormParts(data);

    //console.log(answer_html);

	} else if(data.question_type == 2) {



    if(data.question_form_body) {
      var row_number = 1; // if we are appending a question, then naturally, the row number will be one.
      answer_html += template_append_row_num_to_name_field(data.question_form_body, row_number);
    } else {
      var wrapping = 'table';

      switch(wrapping) {
      	case 'table':
      			answer_html = '<table>';

      				answer_html += '<tr>';
      				$.each(data.questions, function (index, question_data){

      					answer_html += '<th class="text-center">' + question_data.title + '</th>';

      				});
      				answer_html += '</tr>';


      				answer_html += '<tr>';
      				$.each(data.questions, function (index, question_data){

      					answer_html += '<td class="text-center">';
      					answer_html += constructAnswerFormParts(question_data, false);
      					answer_html += '</td>';
      				});
      				answer_html += '</tr>';

      			answer_html += '</table>';
      			break;


      }
    }

	}


  if(data.is_multipliable == true) {

    // add the addition button
    $('#add_button_cnt').html('<a href="#" class="btn btn-primary" id="add_question_set"> + </a>');

    // store the form body locally
    localStorage.setItem('question_form_body', data.question_form_body);

    // set the row number
    localStorage.setItem('row_num', 1);

    // make the add button clickable.
    $('#add_question_set').on('click', function(event){

      event.preventDefault();
      event.stopPropagation();

      

      var row_num = parseInt(localStorage.getItem('row_num'));

      var question_form_body = $(localStorage.getItem('question_form_body'));

      if( row_num % 2 != 0 ) {
        question_form_body.removeClass('odd-row');
      }

      // place the updated counter
      row_num++;
      $(question_form_body).find('.counter').html(row_num);


      // access the form HTML
      var question_form_body_html = question_form_body.prop('outerHTML');

      //append the row number to all names of the form.
      question_form_body_html = template_append_row_num_to_name_field(question_form_body_html, row_num)


      $('#question_container .answer_block').append(question_form_body_html);

      localStorage.setItem('row_num', row_num );
    });

  }



	// --- Handle the display of controls (buttons etc)

  //$('#previous_btn').prop('disabled', false);
  if(data.question_no == data.question_count){
  	$('#next_btn').text('Save & Complete Survey');
  }else if(data.question_no == 1){
	  //$('#previous_btn').prop('disabled', true);
  }else{
	  $('#next_btn').text('Next Question');
  }



	// update question number to the display
	$('#question-status').text(data.question_no+' of '+data.question_count);

	// update the group information of the question
  $('#question-group-id').text(question_groups[data.group_id].title);

	// place question in its container

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




$(document).ready(function(){
  //load date picker if applicable



});


//console.log('question loaded');

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


$(document).ready(function() {

  $('#cancel_survey').click(function(event) {

    event.stopPropagation();
    event.preventDefault();

    if( confirm("Are you sure you want to cancel the survey?. \n data entered till now will be lost.") ) {
      gotoPage('survey/cancel/' + localStorage.getItem('temporary_survey_number'));
    }
  });


});
