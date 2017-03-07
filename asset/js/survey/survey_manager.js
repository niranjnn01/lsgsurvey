


$(document).ready(function(){


  if (storageAvailable('localStorage')) {

    var temporary_survey_number = localStorage.getItem('temporary_survey_number');

    //if( temporary_survey_number == null) {

      // get te survey information
      $.ajax({
        url:"http://localhost/johnson/lsg_survey/survey/current_survey",
        type:"GET",
        success:function (data) {


          // store survey information locally.
          localStorage.setItem('temporary_survey_number', data.temporary_survey_number);
          localStorage.setItem('current_question', data.current_question);

          //contact the server for first question
          $.ajax({
            url:"http://localhost/johnson/lsg_survey/question/get/" + data.temporary_survey_number + "/" + data.current_question,
            type:"GET",
            success:function (data) {

              //console.log('success called');

              localStorage.setItem('answer_type', data.answer_type);

              console.log(JSON.stringify(data));

              appendQuestion(data);

            },
            dataType : "json"
          });


        },
        dataType : "json"
      });
    //}






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
    url:"http://localhost/johnson/lsg_survey/question/get/" + temporary_survey_number + "/" + (parseInt(current_question) + 1),
    type:"GET",
    success:function (data) {

      //console.log('success called');

      console.log(JSON.stringify(data));

      localStorage.setItem('current_question', (parseInt(current_question) + 1));


      appendQuestion(data);

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
      }


    //Submit data back to server
    $.ajax({
      url:"http://localhost/johnson/lsg_survey/survey/accept_answer/" + current_question,
      data: oDataObject,
      method:"POST",
      success:function (data) {

        if(data.error == '') {



          fetchNextQuestion();

          //console.log(JSON.stringify(data));
          //console.log(bWasSuccessful);

        }

      },
      error:function (data) {

        alert('There was some problem loading the question');
      },
      dataType : "json"
    });
  }

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
  }


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
