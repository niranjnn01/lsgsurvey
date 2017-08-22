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
