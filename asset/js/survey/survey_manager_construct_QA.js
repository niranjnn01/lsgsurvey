

function constructAnswerFormParts(data, bProvideWrapper){


//console.log(data.uid + ' , ' + data.answer_type);

	var answer_html = '';
  bProvideWrapper = defaultFor(bProvideWrapper, true);

	var q_uid_class_name = 'q_uid_' + data.uid;


	switch(data.answer_type) {

		case '1':

			answer_html += bProvideWrapper ? '<div class="form-group">' : '';
			answer_html += '<span class="'+ q_uid_class_name +'">'
      answer_html += '<input type="text" name="single_value_text" '
      answer_html += ' class="form-control" '
        +' '+ data.ui_validation +' '
        +'/>';
      answer_html += '</span>';

			answer_html += bProvideWrapper ? '</div>' : '';
			break;

		case '2':

			answer_html += bProvideWrapper ? '<div class="radio">' : '';

			answer_html +=
			'<span class="'+ q_uid_class_name +'">';

			$.each(data.answer_options, function (index, answer_option){
				// name="'+ data.field_name +'"
				answer_html += bProvideWrapper ? '<label class="radio-inline">' : '';
				answer_html += '<input type="radio" name="single_value_radio" '
          +' value="'+ answer_option.value +'" '
          +' '+ data.ui_validation +' '
          +'/> ';
        answer_html +=  answer_option.title;

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
			   /*
			   if(data.answer_non_selection_option) {
           $.each(data.answer_non_selection_option, function (index, answer_option){
            answer_html +=
            '<option value="'+ answer_option.value +'">' +
             ((answer_option.title == undefined) ? '' : answer_option.title) +
            '</option>';
          });
         }
*/
        if(data.answer_non_selection_option) {
           answer_html +=
           '<option value="'+ data.answer_non_selection_option.value +'">' +
            ((data.answer_non_selection_option.title == undefined) ? '' : data.answer_non_selection_option.title) +
           '</option>';
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
