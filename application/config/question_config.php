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

$config['questions_master_data'] = array(

  1 => array(
		'title' 		=> 'പേര്',
		'field_name' 	=> 'name',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 1,
		'answer_type' 	=> $config['answer_types']['single_value_text'],
		'answer_options'=> array(),
	),

  2 => array(
		'title' 		=> 'വിലാസം',
		'field_name' 	=> 'address',
		'table_name'	=> 'houses',
		'group_id'		=> 1,
		'answer_type' 	=> $config['answer_types']['single_value_textarea'],
		'answer_options'=> array(),
	),

  3 => array(
		'title' 		=> 'കെട്ടിട നമ്പർ',
		'field_name' 	=> 'house_number',
		'table_name'	=> 'houses',
		'group_id'		=> 1,
		'answer_type' 	=> $config['answer_types']['single_value_text'],
		'answer_options'=> array(),
	),

  4 => array(
    	'title' 		=> 'ആധാർ നം',
		'field_name' 	=> 'aadhar_id',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 1,
    	'answer_type' 	=> $config['answer_types']['single_value_text'],
    	'answer_options'=> array(),
  ),

  5 => array(
		'title' 		=> 'ഇലക്ഷൻ ഐ. ഡി.',
		'field_name' 	=> 'election_id',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 1,
		'answer_type' 	=> $config['answer_types']['single_value_text'],
		'answer_options'=> array(),
	),

  6 => array(
		'title' 		=> 'വീടിൻ്റെ ഉടമസ്ഥത',
		'field_name' 	=> 'HOUSE_OWNERSHIP',
		'table_name'	=> 'TEMP',
		'group_id'		=> 1,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
    	'answer_options'=> array(
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
		'title' 		=> 'സ്ഥലത്തിൻ്റെ ഉടമസ്ഥത',
		'group_id'		=> 1,
		'field_name' 	=> 'LAND_OWNERSHIP',
		'table_name'	=> 'TEMP',
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
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
		'title' 		=> 'വീടിന്റെ വിസ്തീർണം',
		'field_name' 	=> 'house_area_range_id',
		'table_name'	=> 'houses',
		'group_id'		=> 1,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
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
		'title' 		=> 'വീട് നിൽക്കുന്ന സ്ഥലത്തിന്റെ വിസ്തീർണം',
		'field_name' 	=> 'area_range',
		'table_name'	=> 'lands',
		'master_field'	=> 'owner_user_id',
		'group_id'		=> 1,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
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
		'title' 		=> 'വീടിന്റെ തരം',
		'field_name' 	=> 'house_type_id',
		'table_name'	=> 'house_house_type_map',
		'master_field'	=> 'house_id',
		'group_id'		=> 1,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
		'answer_options'=> array(
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

  11 => array(
  		'title' 		=> 'നിലകളുടെ എണ്ണം(ഒന്നിൽ കൂടുതൽ ഉണ്ടെങ്കിൽ)',
		'field_name' 	=> 'num_floors',
		'table_name'	=> 'houses',
		'group_id'		=> 1,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
    	'answer_options'=> array(
      		array(
        		'value' => 1,
        		'title' => 'ഇരുനില',
      		),
			array(
        		'value' => 2,
        		'title' => 'ഇരുനിലയ്ക്ക് മുകളിൽ', // should we need to 2, 3, 4
      		),
	  	)
  ),
  12 => array(
  		'title' 		=> 'വീടിൻ്റെ തറ',
		'field_name' 	=> 'floor_type_id',
		'table_name'	=> 'houses',
		'group_id'		=> 1,
		'answer_type' 	=> $config['answer_types']['single_value_radio'], //is that multiple choice
    	'answer_options'=> array(
      		array(
        		'value' => 1,
        		'title' => 'മൺതറ',
      		),
			array(
        		'value' => 2,
        		'title' => 'സാധാരണ തറയോട്',
      		),
			array(
        		'value' => 3,
        		'title' => 'സിമൻറ്',
      		),
			array(
        		'value' => 4,
        		'title' => 'മൊസൈക്ക്',
      		),
			array(
        		'value' => 5,
        		'title' => 'മാർബിൾ',
      		),
			array(
        		'value' => 6,
        		'title' => 'ഗ്രാനൈറ്റ്',
      		),
			array(
        		'value' => 7,
        		'title' => 'മറ്റുള്ളവ',
      		),

	  	)
  ),
  13 => array(
  		'title' 		=> 'മുറികളുടെ എണ്ണം',
		'field_name' 	=> 'num_rooms',
		'table_name'	=> 'houses',
		'group_id'		=> 1,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
    	'answer_options'=> array(
      		array(
        		'value' => 1,
        		'title' => 'ഒന്ന്',
      		),
			array(
        		'value' => 2,
        		'title' => 'രണ്ട്',
      		),
			array(
        		'value' => 3,
        		'title' => 'മൂന്ന്',
      		),
			array(
        		'value' => 4,
        		'title' => 'നാല്',
      		),
			array(
        		'value' => 5,
        		'title' => 'അഞ്ച്',
      		),
			array(
        		'value' => 6,
        		'title' => '6 ൽ  കൂടുതൽ',
      		),
		)
	),
	14 => array(
		'title' 		=> 'വാർഷിക കെട്ടിട നികുതി',
		'field_name' 	=> 'amount',
		'table_name'	=> 'house_tax',
		'group_id'		=> 1,
		'answer_type' 	=> $config['answer_types']['single_value_text'],
		'answer_options'=> array(),
	),
	15 => array(
		'title' 		=> 'ഗൃഹനാഥൻ്റെ മതം',
		'field_name' 	=> 'belief_in_religion_id',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
 			array(
        		'value' => 1,
        		'title' => 'ഹിന്ദു',
      		),
			array(
        		'value' => 2,
        		'title' => 'മുസ്ലിം',
      		),
			array(
        		'value' => 3,
        		'title' => 'ക്രിസ്ത്യൻ',
      		),
			array(
        		'value' => 4,
        		'title' => 'മതമില്ല',
      		),
			array(
        		'value' => 5,
        		'title' => 'മറ്റുള്ളവ',
      		),
		),
	),
	16 => array(
		'title' 		=> 'പട്ടികജാതി/വർഗം',
		'field_name' 	=> 'is_scst',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'അതെ',
      		),
			array(
        		'value' => 2,
        		'title' => 'അല്ല',
      		),
		),
	),
	17 => array(
		'title' 		=> 'പിന്നോക്ക സമുദായം',
		'field_name' 	=> 'is_obc',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'അതെ',
      		),
			array(
        		'value' => 2,
        		'title' => 'അല്ല',
      		),
		),
	),
	18 => array(
		'title' 		=> 'ലാൻറ്  ഫോൺ',
		'field_name' 	=> 'landline_number',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
		'answer_type' 	=> $config['answer_types']['single_value_text'],
		'answer_options'=> array(),
	),
	19 => array(
		'title' 		=> 'മൊബൈൽ ഫോൺ',
		'field_name' 	=> 'mobile_number',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
		'answer_type' 	=> $config['answer_types']['single_value_text'],
		'answer_options'=> array(),
	),
	20 => array(
		'title' 		=> 'റേഷൻ കാർഡ് നമ്പർ',
		'field_name' 	=> 'ration_card_no',
		'table_name'	=> 'families',
		'group_id'		=> 2,
		'answer_type' 	=> $config['answer_types']['single_value_text'],
		'answer_options'=> array(),
	),
	21 => array(
		'title' 		=> 'റേഷൻ കാർഡ് തരം',
		'field_name' 	=> 'ration_card_type_id',
		'table_name'	=> 'families',
		'group_id'		=> 2,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'എ.പി.ൽ',
      		),
			array(
        		'value' => 2,
        		'title' => 'ബി.പി.ൽ',
      		)
		),
	),
	22 => array(
		'title' 		=> 'ഇമെയിൽ വിലാസം',
		'field_name' 	=> 'email_id',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
		'answer_type' 	=> $config['answer_types']['single_value_text'],
		'answer_options'=> array(),
	),
	23 => array(
		'title' 		=> 'വാട്സപ്പ്‍ നമ്പർ',
		'field_name' 	=> 'whatsapp_number',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
		'answer_type' 	=> $config['answer_types']['single_value_text'],
		'answer_options'=> array(),
	),
	24 => array(
		'title' 		=> 'ഫേസ്ബുക്ക് അക്കൗണ്ട്',
		'field_name' 	=> 'facebook_link',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
		'answer_type' 	=> $config['answer_types']['single_value_text'],
		'answer_options'=> array(),
	),
	25 => array(
		'title' 		=> 'ഏതെങ്കിലും അയൽക്കൂട്ടം അംഗമാണോ?',
		'field_name' 	=> 'is_member_ayalkoottam',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'അതെ',
      		),
			array(
        		'value' => 2,
        		'title' => 'അല്ല',
      		),
		),
	),
	26 => array(
		'title' 		=> 'അയൽക്കൂട്ടം ഭാരവാഹിയാണോ?',
		'field_name' 	=> 'is_office_bearer_ayalkoottam',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'ആണ്',
      		),
			array(
        		'value' => 2,
        		'title' => 'അല്ല',
      		),
		),
	),
	27 => array(
		'title' 		=> 'രാഷ്ട്രീയ പാർട്ടിയിൽ അംഗത്വമുണ്ടോ?',
		'field_name' 	=> 'is_member_political_party',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'ഉണ്ട്',
      		),
			array(
        		'value' => 0,
        		'title' => 'ഇല്ല',
      		)
		),
	),
	28 => array(
		'title' 		=> 'സാമൂഹിക സാംസ്‌കാരിക സംഘടനകളിൽ അംഗത്വം ഉണ്ടോ?',
		'field_name' 	=> 'is_memeber_socio_cultural_organization',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'ഉണ്ട്',
      		),
			array(
        		'value' => 0,
        		'title' => 'ഇല്ല',
      		)
		),
	),
	29 => array(
		'title' 		=> 'മതസംഘടനയിൽ ഭാരവാഹിയാണോ?',
		'field_name' 	=> 'is_office_bearer_religious_organization',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'ആണ്',
      		),
			array(
        		'value' => 2,
        		'title' => 'അല്ല',
      		)
		),
	),
	30 => array(
		'title' 		=> 'ലൈബ്രറി അംഗത്വം ഉണ്ടോ?',
		'field_name' 	=> 'is_member_library',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'ഉണ്ട്',
      		),
			array(
        		'value' => 0,
        		'title' => 'ഇല്ല',
      		)
		),
	),
	31 => array(
		'title' 		=> 'വാർഡ് സഭകളിൽ പങ്കെടുക്കാറുണ്ടോ?',
		'field_name' 	=> 'status',
		'table_name'	=> 'ward_sabha_participation',
		'master_field'	=> 'surveyee_user_id',
		'group_id'		=> 2,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'ഉണ്ട്',
      		),
			array(
        		'value' => 0,
        		'title' => 'ഇല്ല',
      		)
		),
	),
	32 => array(
		'title' 		=> 'ഇല്ലെങ്കിൽ എന്തുകൊണ്ട്?',
		'field_name' 	=> 'reason',
		'table_name'	=> 'ward_sabha_participation',
		'master_field'	=> 'surveyee_user_id',
		'group_id'		=> 2,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'പ്രാധാന്യമില്ല',
      		),
			array(
        		'value' => 2,
        		'title' => 'സമയമില്ല',
      		),
			array(
        		'value' => 3,
        		'title' => 'അറിയാറില്ല',
      		)
		),
	),
	33 => array(
		'title' 		=> 'പങ്കെടുക്കുന്നുണ്ടെങ്കിൽ  വാർഡ് സഭകളിൽ സംതൃപ്തിയുണ്ടോ',
		'field_name' 	=> 'is_satisfied',
		'table_name'	=> 'ward_sabha_participation',
		'master_field'	=> 'surveyee_user_id',
		'group_id'		=> 2,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'ഉണ്ട്',
      		),
			array(
        		'value' => 0,
        		'title' => 'ഇല്ല',
      		)
		),
	),
	34 => array(
		'title' 		=> 'വാർഡ് സഭകളിൽ പങ്കെടുക്കാറുണ്ടെങ്കിൽ വാർഡ് സഭകൾ മെച്ചപ്പെടുത്താനുള്ള നിർദേശങ്ങൾ ഉണ്ടോ?',
		'field_name' 	=> 'have_suggestion',
		'table_name'	=> 'ward_sabha_participation',
		'master_field'	=> 'surveyee_user_id',
		'group_id'		=> 2,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'നിർദേശങ്ങൾ ഉണ്ട്',
      		),
			array(
        		'value' => 2,
        		'title' => 'നിർദേശങ്ങൾ ഇല്ല',
      		)
		),
	),
	35 => array(
		'title' 		=> 'വീട്ടിൽ സ്വന്തമായുള്ള വാഹനങ്ങൾ',
		'field_name' 	=> 'vehicle_type_id',
		'table_name'	=> 'family_vehicle_type_map',
		'master_field'	=> 'family_id',
		'group_id'		=> 3,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'സൈക്കിൾ',
      		),
			array(
        		'value' => 2,
        		'title' => 'ഇരുചക്രവാഹനം',
      		),
			array(
        		'value' => 3,
        		'title' => 'മുച്ചക്രവാഹനം',
      		),
			array(
        		'value' => 4,
        		'title' => 'നാലുചക്രവാഹനം/മറ്റുള്ളവ',
      		)
		),
	),
	36 => array(
		'title' 		=> 'താഴെ പറയുന്നവ വീട്ടിൽ ഉപയോഗിക്കുന്നുണ്ടോ?',
		'field_name' 	=> 'house_appliance_id',
		'table_name'	=> 'family_appliance_map',
		'master_field'	=> 'family_id',
		'group_id'		=> 4,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'സോളാർ പാനൽ',
      		),
			array(
        		'value' => 2,
        		'title' => 'ഇൻവെർട്ടർ',
      		),
			array(
        		'value' => 3,
        		'title' => 'എയർകണ്ടിഷണർ',
      		),
			array(
        		'value' => 4,
        		'title' => 'റിവേഴ്‌സ് ഓസ്മോസിസ് (RO Filter)',
      		),
			array(
        		'value' => 5,
        		'title' => 'റഫ്രിജറേറ്റർ',
      		),
			array(
        		'value' => 6,
        		'title' => 'ഓവൻ',
      		),
			array(
        		'value' => 7,
        		'title' => 'വാഷിംഗ്‌ മെഷീൻ',
      		),
			array(
        		'value' => 8,
        		'title' => 'ടെലിവിഷൻ',
      		),
			array(
        		'value' => 9,
        		'title' => 'കമ്പ്യൂട്ടർ',
      		),
			array(
        		'value' => 10,
        		'title' => 'ഇന്റർനെറ്റ്',
      		),
			array(
        		'value' => 12,
        		'title' => 'സ്മാർട്ഫോൺ',
      		),
			array(
        		'value' => 13,
        		'title' => 'സോളാർ വാട്ടർഹീറ്റർ',
      		),
			array(
        		'value' => 14,
        		'title' => 'സോളാർ ലാമ്പ്',
      		)
		),
	),
	37 => array(
		'title' 		=> 'ജനനസ്ഥലം ഈ വാർഡ് തന്നെയാണോ?',
		'field_name' 	=> 'is_birth_same_ward',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 5,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'ആണ്',
      		),
			array(
        		'value' => 2,
        		'title' => 'അല്ല',
      		)
		),
	),
	38 => array(
		'title' 		=> 'അല്ലെങ്കിൽ സ്ഥലത്തിന്റെ പേര്',
		'field_name' 	=> 'ifnot_birth_place',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 5,
		'answer_type' 	=> $config['answer_types']['single_value_text'],
		'answer_options'=> array(),
	),
	39 => array(
		'title' 		=> 'എത്ര വർഷമായി ഈ വാർഡിൽ താമസമായിട്ട്',
		'field_name' 	=> 'YEARS_OF_STAYING',
		'table_name'	=> 'TEMP',
		'master_field'	=> 'family_id|ward_id',
		'group_id'		=> 5,
		'answer_type' 	=> $config['answer_types']['single_value_text'],
		'answer_options'=> array(),
	),
	40 => array(
		'title' 		=> 'വീട്ടിനുള്ളിൽ  എത്തിച്ചേരുന്ന വാഹനത്തിന്റെ തരം',
		'field_name' 	=> 'largest_accessible_vehicle',
		'table_name'	=> 'houses',
		'group_id'		=> 6,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'സൈക്കിൾ',
      		),
			array(
        		'value' => 2,
        		'title' => 'ഇരുചക്രവാഹനം',
      		),
			array(
        		'value' => 3,
        		'title' => 'മുച്ചക്രവാഹനം',
      		),
			array(
        		'value' => 4,
        		'title' => 'നാലുചക്രവാഹനം',
      		),
			array(
        		'value' => 5,
        		'title' => 'ലോറി',
      		),
			array(
        		'value' => 6,
        		'title' => 'ബസ്സ്',
      		)
		),
	),
	41 => array(
		'title' 		=> 'വീടിന് തൊട്ടടുത്തുള്ള പൊതു ഗതാഗത സൗകര്യം',
		'field_name' 	=> 'road_type_id',
		'table_name'	=> 'house_road_map',
		'master_field'	=> 'house_id',
		'group_id'		=> 6,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'ഇടുങ്ങിയ പൊതുവഴി',
      		),
			array(
        		'value' => 2,
        		'title' => 'മുനിസിപ്പാലിറ്റി റോഡ്',
      		),
			array(
        		'value' => 3,
        		'title' => 'പി.ഡബ്ള്യു.ഡി റോഡ്',
      		),
			array(
        		'value' => 4,
        		'title' => 'എൻ.എച്ച്',
      		)
		)
	),
	42 => array(
		'title' 		=> 'വീട്ടിൽ നിന്നും ഓട്ടോ സ്റ്റാന്റിലേക്കുള്ള ദൂരം',
		'field_name' 	=> 'proximity',
		'table_name'	=> 'house_public_utility_proximity',
		'master_field'	=> 'house_id',		// need to hard code public_utility_id = 4 of autorikshaw stand
		'group_id'		=> 6,
		'answer_type' 	=> $config['answer_types']['single_value_text'],
		'answer_options'=> array(),
	),
	43 => array(
		'title' 		=> 'നഗരസഭാ സേവനങ്ങളുടെ സാമീപ്യം',
		'field_name' 	=> 'public_utility_id',
		'table_name'	=> 'house_public_utility_proximity',
		'master_field'	=> 'house_id',
		'group_id'		=> 7,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'സ്ട്രീറ്റ് ലൈറ്റ്',
      		),
			array(
        		'value' => 2,
        		'title' => 'കാണ',
      		),
			array(
        		'value' => 3,
        		'title' => 'മാലിന്യ നിക്ഷേപ സ്ഥലം',
      		)
		)
	),
	44 => array(
		'title' 		=> 'ജലം',
		'field_name' 	=> 'house_water_source_id',
		'table_name'	=> 'house_water_source_map',
		'master_field'	=> 'house_id',
		'group_id'		=> 8,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'പൊതുടാപ്പ്',
      			),
			array(
        		'value' => 2,
        		'title' => 'കിണർ',
      		),
			array(
        		'value' => 3,
        		'title' => 'സ്വന്തം ടാപ്പ്',
      		),
			array(
        		'value' => 4,
        		'title' => 'കുഴൽക്കിണർ',
      		)
		)
	),
	45 => array(
		'title' 		=> 'കക്കൂസ്',
		'field_name' 	=> 'toilet_type',
		'table_name'	=> 'houses',
		'group_id'		=> 8,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'സെപ്റ്റിക് ടാങ്ക്',
      			),
			array(
        		'value' => 2,
        		'title' => 'കുഴി കക്കൂസ്',
      		)
		)
	),
	46 => array(
		'title' 		=> 'കക്കൂസിന്റെ എണ്ണം',
		'field_name' 	=> 'toilet_count',
		'table_name'	=> 'houses',
		'group_id'		=> 8,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'ഒന്ന്',
      			),
			array(
        		'value' => 2,
        		'title' => 'രണ്ട്',
      		),
			array(
        		'value' => 3,
        		'title' => 'മൂന്ന്',
      		),
			array(
        		'value' => 4,
        		'title' => 'നാല്',
      		)

		)
	),
	47 => array(
		'title' 		=> 'ഖരമാലിന്യം നീക്കം ചെയ്യുന്നത് എവിടേക്കാണ്',
		'field_name' 	=> 'waste_management_solution_id',
		'table_name'	=> 'house_waste_management_solution_map',
		'master_field'	=> 'house_id',
		'group_id'		=> 8,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'സ്വന്തം പറമ്പിൽ',
      		),
			array(
        		'value' => 2,
        		'title' => 'മാലിന്യ സംസ്കരണകേന്ദ്രത്തിൽ',
      		)
		)
	),
	48 => array(
		'title' 		=> 'വീട് വൈദ്യുതീകരിച്ചതാണോ?',
		'field_name' 	=> 'is_electrified',
		'table_name'	=> 'houses',
		'group_id'		=> 9,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'ആണ്',
      		),
			array(
        		'value' => 2,
        		'title' => 'അല്ല',
      		)
		),
	),
	49 => array(
		'title' 		=> 'വീട്ടാവശ്യത്തിനുള്ള ഇന്ധനം',
		'field_name' 	=> 'domestic_fuel_type_id',
		'table_name'	=> 'family_domestic_fuel_type_map',
		'master_field'	=> 'house_id',
		'group_id'		=> 9,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'വിറക്',
      		),
			array(
        		'value' => 2,
        		'title' => 'മണ്ണെണ്ണ',
      		),
			array(
        		'value' => 3,
        		'title' => 'എൽ .പി.ജി',
      		),
			array(
        		'value' => 4,
        		'title' => 'വൈദ്യുതി',
      		),
			array(
        		'value' => 5,
        		'title' => 'ബയോഗ്യാസ്',
      		)
		),
	),
	50 => array(
		'title' 		=> 'വളർത്തു മൃഗങ്ങൾ ഉണ്ടോ?',
		'field_name' 	=> 'HAS_DOMESTIC_ANIMALS',
		'table_name'	=> 'TEMP',
		'group_id'		=> 10,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'ഉണ്ട്',
      		),
			array(
        		'value' => 0,
        		'title' => 'ഇല്ല',
      		)
		),
	),
	51 => array(
		'title' 		=> 'താഴെ പറയുന്നവയിൽ ഏതെല്ലാമാണ് ഉള്ളത്?',
		'field_name' 	=> 'pet_id',
		'table_name'	=> 'family_pet_map',
		'master_field'	=> 'family_id',
		'group_id'		=> 10,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'നായ',
      		),
			array(
        		'value' => 2,
        		'title' => 'പശു',
      		),
			array(
        		'value' => 3,
        		'title' => 'ആട്',
      		),
			array(
        		'value' => 4,
        		'title' => 'കോഴി',
      		),
			array(
        		'value' => 5,
        		'title' => 'താറാവ്',
      		),
			array(
        		'value' => 5,
        		'title' => 'മറ്റുള്ളവ',
      		)
		)
	),
	52 => array(
		'title' 		=> 'നായയ്‌ക്ക് ലൈസൻസ് ഉണ്ടോ?',
		'field_name' 	=> 'has_license',
		'table_name'	=> 'family_pet_map',
		'master_field'	=> 'family_id|pet_id',
		'group_id'		=> 10,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'ഉണ്ട്',
      		),
			array(
        		'value' => 0,
        		'title' => 'ഇല്ല',
      		)
		),
	),
	53 => array(
		'title' 		=> 'കൃഷി',
		'field_name' 	=> 'agriculture_location_id',
		'table_name'	=> 'family_agriculture_location_map',
		'group_id'		=> 11,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'മട്ടുപ്പാവ്',
      		),
			array(
        		'value' => 2,
        		'title' => 'പറമ്പിൽ',
      		),
			array(
        		'value' => 3,
        		'title' => 'കൃഷി ഇല്ല',
      		)
		)
	),
	54 => array(
		'title' 		=> 'വിളകൾ',
		'field_name' 	=> 'agricultural_produce_id',
		'table_name'	=> 'family_agricultural_produce_map',
		'group_id'		=> 12,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'തെങ്ങ്',
      		),
			array(
        		'value' => 2,
        		'title' => 'കവുങ്ങ്',
      		),
			array(
        		'value' => 3,
        		'title' => 'മാവ്',
      		),
			array(
        		'value' => 4,
        		'title' => 'പേര',
      		),
			array(
        		'value' => 5,
        		'title' => 'പ്ലാവ്',
      		),
			array(
        		'value' => 6,
        		'title' => 'പച്ചക്കറി',
      		),
			array(
        		'value' => 7,
        		'title' => 'മറ്റുള്ളവ',
      		)
		)
	),
	55 => array(
		'title' 		=> 'അലങ്കാര മത്സ്യങ്ങൾ ഉണ്ടോ?',
		'field_name' 	=> 'has_aquarium_fish',
		'table_name'	=> 'families',		
		'group_id'		=> 13,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => TRUE,
        		'title' => 'ഉണ്ട്',
      		),
			array(
        		'value' => FALSE,
        		'title' => 'ഇല്ല',
      		)
		),
	),
	56 => array(
		'title' 		=> 'ബാങ്ക് അക്കൗണ്ട്',
		'field_name' 	=> 'bank_account_type_id',
		'table_name'	=> 'surveyee_user_bank_account_type_map',
		'group_id'		=> 13,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'സേവിoഗ്‌സ്',
      		),
			array(
        		'value' => 2,
        		'title' => 'കറണ്ട്',
      		),
			array(
        		'value' => 3,
        		'title' => 'പോസ്റ്റ് ഓഫീസ്',
      		)
		),
	),
	57 => array(
		'title' 		=> 'ക്രെഡിറ്റ് / ഡെബിറ്റ് കാർഡ്',
		'field_name' 	=> 'has_credit_or_debit_card',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 13,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => TRUE,
        		'title' => 'ഉണ്ട്',
      		),
			array(
        		'value' => FALSE,
        		'title' => 'ഇല്ല',
      		)
		),
	),
	58 => array(
		'title' 		=> 'ഇന്റർനെറ്റ് ബാംങ്കിംഗ്',
		'field_name' 	=> 'has_internet_banking',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 13,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => TRUE,
        		'title' => 'ഉണ്ട്',
      		),
			array(
        		'value' => FALSE,
        		'title' => 'ഇല്ല',
      		)
		),
	),
	59 => array(
		'title' 		=> 'മൊബൈൽ ബാംങ്കിംഗ്',
		'field_name' 	=> 'has_mobile_banking',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 13,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => TRUE,
        		'title' => 'ഉണ്ട്',
      		),
			array(
        		'value' => FALSE,
        		'title' => 'ഇല്ല',
      		)
		),
	),
	60 => array(
		'title' 		=> 'വൈദ്യുതി, വെള്ളം, ട്രെയിൻ, ബസ്, സിനിമ തുടങ്ങിയവ',
		'field_name' 	=> 'surveyee_user_id',
		'table_name'	=> 'surveyee_user_payment_type_map',
		'group_id'		=> 13,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'നേരിട്ടടയ്ക്കുന്നു',
      		),
			array(
        		'value' => 2,
        		'title' => 'ഓൺലൈൻ വഴി',
      		)
		),
	),
	61 => array(
		'title' 		=> 'ഇൻഷുറൻസ്',
		'field_name' 	=> 'has_insurance',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 13,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => TRUE,
        		'title' => 'ഉണ്ട്',
      		),
			array(
        		'value' => FALSE,
        		'title' => 'ഇല്ല',
      		)
		)
	),
	62 => array(
		'title' 		=> 'നിക്ഷേപം',
		'field_name' 	=> 'investment_type_id',
		'table_name'	=> 'surveyee_user_investment_type_map',
		'group_id'		=> 13,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'സേവിoഗ്‌സ്',
      		),
			array(
        		'value' => 2,
        		'title' => 'ഫിക്സഡ് ',
      		),
			array(
        		'value' => 3,
        		'title' => 'ഓഹരി',
      		),
			array(
        		'value' => 4,
        		'title' => 'ചിട്ടി',
      		),
			array(
        		'value' => 5,
        		'title' => 'പോസ്റ്റ് ഓഫീസ്',
      		),
			array(
        		'value' => 6,
        		'title' => 'മറ്റുള്ളവ',
      		)

		)
	),
	63 => array(
		'title' 		=> 'കടബാധ്യത',
		'field_name' 	=> 'debit_type_id',
		'table_name'	=> 'surveyee_user_debit_type_map',
		'group_id'		=> 13,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'ഭവന',
      		),
			array(
        		'value' => 2,
        		'title' => 'സ്വയംസംരംഭം',
      		),
			array(
        		'value' => 3,
        		'title' => 'വിദ്യാഭ്യാസം',
      		),
			array(
        		'value' => 4,
        		'title' => 'സ്വകാര്യ ആവശ്യങ്ങൾ',
      		)

		)
	),
	64 => array(
		'title' 		=> 'കടമെടുത്തിട്ടുള്ളത്',
		'field_name' 	=> 'debit_debit_bank_type_id',
		'table_name'	=> 'surveyee_user_debit_bank_type_map',
		'group_id'		=> 13,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'ദേശസാൽകൃത ബാങ്കുകൾ',
      		),
			array(
        		'value' => 2,
        		'title' => 'സ്വകാര്യ ബാങ്കുകൾ',
      		),
			array(
        		'value' => 3,
        		'title' => 'അയൽക്കൂട്ടം',
      		),
			array(
        		'value' => 4,
        		'title' => 'സാമ്പത്തിക സ്ഥാപനങ്ങൾ',
      		),
			array(
        		'value' => 5,
        		'title' => 'സഹകരണ ബാങ്കുകൾ',
      		),
			array(
        		'value' => 6,
        		'title' => 'മറ്റുള്ളവ',
      		)

		)
	)





);
