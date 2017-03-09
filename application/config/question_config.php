<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$CI = & get_instance();


//$CI->config->config['base_url']

$config['answer_types'] = array(
  'single_value_text' => 1,
  'single_value_radio' => 2,
  'multi_value_checkbox' => 3,
  'single_value_textarea' => 4,
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
);

$config['questions_master_data'] = array(

  1 => array(
		'title' => 'പേര്',
		'answer_type' => $config['answer_types']['single_value_text'],
		'answer_options' => array(),
	),

  2 => array(
		'title' => 'വിലാസം',
		'answer_type' => $config['answer_types']['single_value_textarea'],
		'answer_options' => array(),
	),

  3 => array(
		'title' => 'കെട്ടിട നമ്പർ',
		'answer_type' => $config['answer_types']['single_value_text'],
		'answer_options' => array(),
	),

  4 => array(
    'title' => 'ആധാർ നം',
    'answer_type' => $config['answer_types']['single_value_text'],
    'answer_options' => array(),
  ),

  5 => array(
		'title' => 'ഇലക്ഷൻ ഐ. ഡി.',
		'answer_type' => $config['answer_types']['single_value_text'],
		'answer_options' => array(),
	),

  6 => array(
		'title' => 'വീടിൻ്റെ ഉടമസ്ഥത',
		'answer_type' => $config['answer_types']['single_value_radio'],
    'answer_options' => array(
      array(
        'value' => 1,
        'title' => 'സ്വന്തം',
      ),
      array(
        'value' => 2,
        'title' => 'വാടക',
      ),
	   ),
  ),

  7 => array(
		'title' => 'സ്ഥലത്തിൻ്റെ ഉടമസ്ഥത',
		'answer_type' => $config['answer_types']['single_value_radio'],
		'answer_options' => array(
      array(
        'value' => 1,
        'title' => 'സ്വന്തം',
      ),
      array(
        'value' => 2,
        'title' => 'പാട്ടം',
      ),
      array(
        'value' => 3,
        'title' => 'പാരമ്പര്യമായി  കിട്ടിയത്',
      ),
    ),
	),

  8 => array(
		'title' => 'വീടിന്റെ വിസ്തീർണം',
		'answer_type' => $config['answer_types']['single_value_radio'],
    'answer_options' => array(
      array(
        'value' => 1,
        'title' => '300 ച: അടി വരെ',
      ),
      array(
        'value' => 2,
        'title' => '300 - 600 ച: അടി',
      ),
      array(
        'value' => 3,
        'title' => '600 - 1500 ച: അടി',
      ),
      array(
        'value' => 4,
        'title' => '2000 ച: അടിയ്ക്ക് മുകളിൽ',
      ),
    ),
	),

  9 => array(
		'title' => 'വീട് നിൽക്കുന്ന സ്ഥലത്തിന്റെ വിസ്തീർണം',
		'answer_type' => $config['answer_types']['single_value_radio'],
    'answer_options' => array(
      array(
        'value' => 1,
        'title' => '3 സെന്റിൽ താഴെ',
      ),
      array(
        'value' => 2,
        'title' => '3 - 5 സെന്റ്',
      ),
      array(
        'value' => 3,
        'title' => '5 - 10  സെന്റ്',
      ),
      array(
        'value' => 4,
        'title' => '10 സെന്റിനു മുകളിൽ',
      ),
    ),
	),

  10 => array(
		'title' => 'വീടിന്റെ തരം',
		'answer_type' => $config['answer_types']['multi_value_checkbox'],
    'answer_options' => array(
      array(
        'value' => 1,
        'title' => 'കുടിൽ',
      ),
      array(
        'value' => 2,
        'title' => 'ഓല',
      ),
      array(
        'value' => 3,
        'title' => 'ഷീറ്റ്',
      ),
      array(
        'value' => 4,
        'title' => 'ഓട്',
      ),
      array(
        'value' => 5,
        'title' => 'കോൺക്രീറ്റ്',
      ),
      array(
        'value' => 6,
        'title' => 'ആസ്ബറ്റോസ് ഷീറ്റ്',
      ),
      array(
        'value' => 7,
        'title' => 'അലുമിനിയം',
      ),
      array(
        'value' => 8,
        'title' => 'ടിൻ ഷീറ്റ്',
      ),
    ),
	),


);
