<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$CI = & get_instance();


//$CI->config->config['base_url']


$config['question_types'] = array(
  'individual' => 1,
  'collection' => 2,
);

$config['answer_types'] = array(
  'single_value_text' => 1,
  'single_value_radio' => 2,
  'multi_value_checkbox' => 3,
  'single_value_textarea' => 4,
  'single_value_select' => 5,
);

$config['form_fields'] = array(
  'text'      => 1,
  'radio'     => 2,
  'checkbox'  => 3,
  'textarea'  => 4,
  'select'    => 5,
);

$config['answer_types_details'] = array(
  1 => array(
              'field_name' => 'single_value_text'
            ),
  2 => array(
              'field_name' => 'single_value_radio'
            ),
  3 => array(
              'field_name' => 'multi_value_checkbox'
            ),
  4 => array(
      'field_name' => 'single_value_textarea'
    ),

  5 => array(
      'field_name' => 'single_value_select'
  ),
);

$config['question_groups'] = array(
  1 => array(
              	'title' => 'അടിസ്ഥാന വിവരങ്ങൾ'
            ),
  2 => array(
              	'title' => 'ഗൃഹനാഥൻ്റെ വ്യക്തിപരമായ വിവരങ്ങൾ'
            ),
  3 => array(
             	'title' => 'വാഹനങ്ങൾ'
            ),
  4 => array(
      			'title' => 'വീട്ടുപകരണങ്ങൾ'
    		),
  5 => array(
      			'title' => 'താമസം മാറിയതിന്റെ വിവരം'
    		),
  6	 => array(
      			'title' => 'ഗതാഗത സാമീപ്യം'
    		),
  7	 => array(
      			'title' => 'നഗരസഭാ സേവനങ്ങളുടെ സാമീപ്യം'
    		),
  8	 => array(
      			'title' => 'ഭൗതിക പശ്ചാത്തല സൗകര്യങ്ങൾ'
    		),
  9	 => array(
      			'title' => 'വൈദ്യുതി'
    		),
  10	 => array(
      			'title' => 'വളർത്തുമൃഗങ്ങൾ/പക്ഷികൾ'
    		),
  11	 => array(
      			'title' => 'കൃഷി'
    		),
  12	 => array(
      			'title' => 'വിളകൾ'
    		),
  13	 => array(
      			'title' => 'അലങ്കാര മത്സ്യങ്ങൾ'
    		),
  14	 => array(
      			'title' => 'സാമ്പത്തിക സാക്ഷരത	'
    		)


);
