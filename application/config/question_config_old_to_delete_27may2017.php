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

$config['questions_master_data'] = array(

  array(
		'title' 		=> '',
		'field_name' 	=> 'name',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 1,
		'answer_type' 	=> $config['answer_types']['single_value_text'],
		'answer_options'=> array(),
    'uid' => 1,
    'question_type' => $config['question_types']['group'],
    'question_template' => 'question/tpl_family_member_details',
    'multiple_answer_sets' => TRUE,
    'questions' => array(
      array(
    		'title' 		=> 'പേര്',
    		'field_name' 	=> 'name',
    		'table_name'	=> 'surveyee_users',
    		'group_id'		=> 1,
        'uid' => 2,
    		'answer_type' 	=> $config['answer_types']['single_value_text'],
    	),
      array(
    		'title' 		=> 'സ്ത്രീ / പുരുഷൻ',
    		'field_name' 	=> 'gender',
    		'table_name'	=> 'surveyee_users',
    		'group_id'		=> 1,
        'uid' => 3,
    		'answer_type' 	=> $config['answer_types']['single_value_select'],
    		'answer_options'=> array(
            array(
              'value' => 1,
              'title' => 'സ്ത്രീ',
            ),
            array(
              'value' => 2,
              'title' => 'പുരുഷൻ',
            ),
        ),
    	),
      array(
    		'title' 		=> 'ഇലക്ഷൻ ഐ. ഡി.',
    		'field_name' 	=> 'election_id',
    		'table_name'	=> 'surveyee_users',
    		'group_id'		=> 1,
        'uid' => 4,
    		'answer_type' 	=> $config['answer_types']['single_value_text'],
    		'answer_options'=> array(),
    	),
      array(
        	'title' 		=> 'ആധാർ നം',
    		'field_name' 	=> 'aadhar_id',
    		'table_name'	=> 'surveyee_users',
    		'group_id'		=> 1,
        'uid' => 5,
        	'answer_type' 	=> $config['answer_types']['single_value_text'],
        	'answer_options'=> array(),
      ),
      array(
    		'title' 		=> 'സംവരണം',
    		'field_name' 	=> 'reservation',
    		'table_name'	=> 'surveyee_users',
    		'group_id'		=> 2,
        'uid' => 6,
    		'answer_type' 	=> $config['answer_types']['single_value_select'],
    		'answer_options'=> array(
    			array(
            		'value' => 0,
            		'title' => 'ഇല്ലാ',
          		),
    			array(
            		'value' => 1,
            		'title' => 'പട്ടികജാതി/വർഗം',
          		),
    			array(
            		'value' => 2,
            		'title' => 'പിന്നോക്ക സമുദായം',
          		),
    		),
    	),
      array(
    		'title' 		=> 'മൊബൈൽ നമ്പർ',
    		'field_name' 	=> 'mobile_number',
    		'table_name'	=> 'surveyee_users',
    		'group_id'		=> 2,
        'uid' => 7,
    		'answer_type' 	=> $config['answer_types']['single_value_text'],
    		'answer_options'=> array(),
    	),
      array(
    		'title' 		=> 'ഇമെയിൽ വിലാസം',
    		'field_name' 	=> 'email_id',
    		'table_name'	=> 'surveyee_users',
    		'group_id'		=> 2,
        'uid' => 8,
    		'answer_type' 	=> $config['answer_types']['single_value_text'],
    		'answer_options'=> array(),
    	),
      array(
    		'title' 		=> 'വാട്സപ്പ്‍ നമ്പർ',
    		'field_name' 	=> 'whatsapp_number',
    		'table_name'	=> 'surveyee_users',
    		'group_id'		=> 2,
        'uid' => 9,
    		'answer_type' 	=> $config['answer_types']['single_value_text'],
    		'answer_options'=> array(),
    	),


      array(
        'title' 		=> 'ഗൃഹനാഥൻ / ഗൃഹനാഥയാണോ',
        'field_name' 	=> 'is_head_of_house',
        'table_name'	=> '',
        'group_id'		=> 2,
        'uid' => 10,
        'answer_type' 	=> $config['answer_types']['single_value_select'],
        'answer_options'=> array(
          'answer_options'=> array(
              array(
                'value' => 1,
                'title' => 'അതെ',
              ),
              array(
                'value' => 2,
                'title' => 'അല്ലാ',
              ),
          ),
        ),
      ),

      array(
        'title' 		=> 'ഗൃഹനാഥൻ / നാഥ യുമായുള്ള ബന്ധം',
        'field_name' 	=> 'relationship_to_head_of_house',
        'table_name'	=> '',
        'group_id'		=> 2,
        'uid' => 11,
        'answer_type' 	=> $config['answer_types']['single_value_select'],
        'answer_options'=> array(
          array(
  				'value' => 0,
  				'title' => 'ബാധകമല്ലാ',
  			  ),
          array(
  				'value' => 1,
  				'title' => 'അച്ഛൻ',
  			  ),
          array(
  				'value' => 2,
  				'title' => 'അമ്മ',
  			  ),
          array(
  				'value' => 3,
  				'title' => 'അപ്പൂപ്പൻ',
  			  ),
          array(
  				'value' => 4,
  				'title' => 'അമ്മൂമ്മാ',
  			  ),
          array(
  				'value' => 5,
  				'title' => 'സഹോദരി',
  			  ),
          array(
  				'value' => 6,
  				'title' => 'സഹോദരൻ',
  			  ),
          array(
  				'value' => 7,
  				'title' => 'മകൻ',
  			  ),
          array(
  				'value' => 8,
  				'title' => 'മകൾ',
  			  ),
          array(
          'value' => 9,
          'title' => 'ഭാര്യ',
          ),
          array(
          'value' => 10,
          'title' => 'ഭർത്താവ്',
          ),
        ),
      ),

      array(
        'title' 		=> 'വിദ്യാഭ്യാസ യോഗ്യത',
        'field_name' 	=> 'educational_qualification',
        'table_name'	=> '',
        'group_id'		=> 2,
        'uid' => 12,
        'answer_type' 	=> $config['answer_types']['single_value_select'],
        'answer_options'=> array(
          array(
          'value' => 1,
          'title' => '10 - ൽ താഴെ',
          ),
          array(
          'value' => 2,
          'title' => '10 വരെ',
          ),
          array(
          'value' => 3,
          'title' => 'Plus Two',
          ),
          array(
          'value' => 4,
          'title' => 'ITI',
          ),
          array(
          'value' => 5,
          'title' => 'Poly',
          ),
          array(
          'value' => 6,
          'title' => 'Diploma',
          ),
          array(
          'value' => 7,
          'title' => 'Degree',
          ),
        ),
      ),

      array(
        'title' 		  => 'തൊഴിൽ മേഖല',
        'field_name' 	=> 'employment_category',
        'table_name'	=> '',
        'group_id'		=> 2,
        'uid' => 13,
        'answer_type' 	=> $config['answer_types']['single_value_select'],
        'answer_options'=> array(
          array(
          'value' => 1,
          'title' => 'തൊഴിൽ ഇല്ലാ',
          ),
          array(
          'value' => 2,
          'title' => 'സർക്കാർ ജോലി',
          ),
          array(
          'value' => 3,
          'title' => 'അർദ്ധ സർക്കാർ ജോലി',
          ),
          array(
          'value' => 4,
          'title' => 'സ്വകാര്യ സ്ഥാപനത്തിൽ',
          ),
          array(
          'value' => 5,
          'title' => 'ബിസിനസ്',
          ),
          array(
          'value' => 6,
          'title' => 'വിദേശത്തു തൊഴിൽ',
          ),
        ),
      ),
    ),

	),

  array(
		'title' 		=> 'വിലാസം',
		'field_name' 	=> 'address',
		'table_name'	=> 'houses',
		'group_id'		=> 1,
    'uid' => 14,
		'answer_type' 	=> $config['answer_types']['single_value_textarea'],
		'answer_options'=> array(),
    'question_type' => $config['question_types']['group'],
    'questions' => array(
      array(
    		'title' 		=> 'കെട്ടിട നമ്പർ',
    		'field_name' 	=> 'address_house_no',
    		'table_name'	=> '',
    		'group_id'		=> 1,
        'uid' => 15,
    		'answer_type' 	=> $config['answer_types']['single_value_text'],
    	),
      array(
    		'title' 		=> 'വീട്ട്  പേര്',
    		'field_name' 	=> 'address_house_name',
    		'table_name'	=> '',
    		'group_id'		=> 1,
        'uid' => 16,
    		'answer_type' 	=> $config['answer_types']['single_value_text'],
    	),

      array(
    		'title' 		=> 'തെരുവ് (Street Name)',
    		'field_name' 	=> 'address_street_name',
    		'table_name'	=> '',
    		'group_id'		=> 1,
        'uid' => 17,
    		'answer_type' 	=> $config['answer_types']['single_value_text'],
    	),

      array(
    		'title' 		=> 'പിൻകോഡ്',
    		'field_name' 	=> 'address_pincode',
    		'table_name'	=> '',
    		'group_id'		=> 1,
        'uid' => 18,
    		'answer_type' 	=> $config['answer_types']['single_value_text'],
    	),
    )
	),


  array(
		'title' 		=> 'വീടിൻ്റെ ഉടമസ്ഥത',
		'field_name' 	=> 'HOUSE_OWNERSHIP',
		'table_name'	=> 'TEMP',
		'group_id'		=> 1,
    'uid' => 19,
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

  array(
		'title' 		=> 'സ്ഥലത്തിൻ്റെ ഉടമസ്ഥത',
		'group_id'		=> 1,
		'field_name' 	=> 'LAND_OWNERSHIP',
		'table_name'	=> 'TEMP',
    'uid' => 20,
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
	    ),
	),


  array(
  		'title' 		=> 'പാരമ്പര്യമായി കിട്ടിയ ഭൂമിയാണോ ?',
  		'group_id'		=> 1,
  		'field_name' 	=> 'IS_LEGACY_LAND',
  		'table_name'	=> 'TEMP',
      'uid' => 21,
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

  array(
		'title' 		=> 'വീടിന്റെ വിസ്തീർണം',
		'field_name' 	=> 'house_area_range_id',
		'table_name'	=> 'houses',
		'group_id'		=> 1,
    'uid' => 22,
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

  array(
		'title' 		=> 'വീട് നിൽക്കുന്ന സ്ഥലത്തിന്റെ വിസ്തീർണം',
		'field_name' 	=> 'area_range',
		'table_name'	=> 'lands',
		'master_field'	=> 'owner_user_id',
		'group_id'		=> 1,
    'uid' => 23,
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

  array(
		'title' 		=> 'വീടിന്റെ തരം',
		'field_name' 	=> 'house_type_id',
		'table_name'	=> 'house_house_type_map',
		'master_field'	=> 'house_id',
		'group_id'		=> 1,
    'uid' => 24,
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

  array(
  		'title' 		=> 'വീടിന്റെ നിലകളുടെ എണ്ണം',
		'field_name' 	=> 'num_floors',
		'table_name'	=> 'houses',
		'group_id'		=> 1,
    'uid' => 25,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
    	'answer_options'=> array(
      		array(
        		'value' => 1,
        		'title' => 'ഒരു നില',
      		),
			array(
        		'value' => 2,
        		'title' => 'ഇരുനില',
      		),
			array(
        		'value' => 3,
        		'title' => 'മൂന്നു നിലകൾ',
      		),
			array(
        		'value' => 4,
        		'title' => 'മൂന്നിൽ കൂടുതൽ നിലകൾ',
      		),
	  	)
  ),

  array(
  		'title' 		=> 'വീടിൻ്റെ തറ',
		'field_name' 	=> 'floor_type_id',
		'table_name'	=> 'house_floor_type_map',
		'master_field'	=> 'house_id',
		'group_id'		=> 1,
    'uid' => 26,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'], //is that multiple choice
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
        		'title' => 'വിട്രിഫൈഡ് ടൈൽസ്',
      		),
			array(
        		'value' => 8,
        		'title' => 'മറ്റുള്ളവ',
      		),

	  	)
  ),
  array(
  		'title' 		=> 'മുറികളുടെ എണ്ണം',
		'field_name' 	=> 'num_rooms',
		'table_name'	=> 'houses',
		'group_id'		=> 1,
    'uid' => 27,
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
        		'title' => '5 ൽ  കൂടുതൽ',
      		),
		)
	),
	array(
		'title' 		=> 'വാർഷിക കെട്ടിട നികുതി',
		'field_name' 	=> 'amount',
		'table_name'	=> 'house_tax',
		'group_id'		=> 1,
    'uid' => 28,
		'answer_type' 	=> $config['answer_types']['single_value_text'],
		'answer_options'=> array(),
	),

	array(
		'title' 		=> 'ഗൃഹനാഥൻ്റെ മതം',
		'field_name' 	=> 'belief_in_religion_id',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
    'uid' => 29,
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

	array(
		'title' 		=> 'ലാൻറ്  ഫോൺ',
		'field_name' 	=> 'landline_number',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
    'uid' => 30,
		'answer_type' 	=> $config['answer_types']['single_value_text'],
		'answer_options'=> array(),
	),


  array(
		'title' 		=> 'റേഷൻ കാർഡ് നമ്പർ',
		'field_name' 	=> 'ration_card_no',
		'table_name'	=> 'families',
		'group_id'		=> 2,
    'uid' => 31,
		'answer_type' 	=> $config['answer_types']['single_value_text'],
		'answer_options'=> array(),
	),
	array(
		'title' 		=> 'റേഷൻ കാർഡ് തരം',
		'field_name' 	=> 'ration_card_type_id',
		'table_name'	=> 'families',
		'group_id'		=> 2,
    'uid' => 32,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'Non Priority(എ.പി.ൽ)',
      		),
			array(
        		'value' => 2,
        		'title' => 'മുൻഗണന (ബി.പി.ൽ)',
      		),
			array(
        		'value' => 3,
        		'title' => 'AAY',
      		),
			array(
        		'value' => 4,
        		'title' => 'APL SS',
      		)
		),
	),
  array(
		'title' 		=> 'ഏതെങ്കിലും അയൽക്കൂട്ടം അംഗമാണോ?',
		'field_name' 	=> 'is_member_ayalkoottam',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
    'uid' => 33,
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
	array(
		'title' 		=> 'അയൽക്കൂട്ടം ഭാരവാഹിയാണോ?',
		'field_name' 	=> 'is_office_bearer_ayalkoottam',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
    'uid' => 34,
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
	array(
		'title' 		=> 'രാഷ്ട്രീയ പാർട്ടിയിൽ അംഗത്വമുണ്ടോ?',
		'field_name' 	=> 'is_member_political_party',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
    'uid' => 35,
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
	array(
		'title' 		=> 'സാമൂഹിക സാംസ്‌കാരിക സംഘടനകളിൽ അംഗത്വം ഉണ്ടോ?',
		'field_name' 	=> 'is_memeber_socio_cultural_organization',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
    'uid' => 36,
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
	array(
		'title' 		=> 'മതസംഘടനയിൽ ഭാരവാഹിയാണോ?',
		'field_name' 	=> 'is_office_bearer_religious_organization',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
    'uid' => 37,
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
	array(
		'title' 		=> 'ലൈബ്രറി അംഗത്വം ഉണ്ടോ?',
		'field_name' 	=> 'is_member_library',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 2,
    'uid' => 38,
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
	array(
		'title' 		=> 'വാർഡ് സഭകളിൽ പങ്കെടുക്കാറുണ്ടോ?',
		'field_name' 	=> 'status',
		'table_name'	=> 'ward_sabha_participation',
		'master_field'	=> 'surveyee_user_id',
		'group_id'		=> 2,
    'uid' => 39,
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
	array(
		'title' 		=> 'വാർഡ് സഭകളിൽ പങ്കെടുക്കാറില്ല എങ്കില്‍ എന്തുകൊണ്ട്?',
		'field_name' 	=> 'reason',
		'table_name'	=> 'ward_sabha_participation',
		'master_field'	=> 'surveyee_user_id',
		'group_id'		=> 2,
    'uid' => 40,
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
	array(
		'title' 		=> 'പങ്കെടുക്കുന്നുണ്ടെങ്കിൽ  വാർഡ് സഭകളിൽ സംതൃപ്തിയുണ്ടോ',
		'field_name' 	=> 'is_satisfied',
		'table_name'	=> 'ward_sabha_participation',
		'master_field'	=> 'surveyee_user_id',
		'group_id'		=> 2,
    'uid' => 41,
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
    'default_value' => null
	),
  array(
		'title' 		=> 'വാർഡ് സഭകളിൽ പങ്കെടുക്കാറുണ്ടെങ്കിൽ വാർഡ് സഭകൾ മെച്ചപ്പെടുത്താനുള്ള നിർദേശങ്ങൾ ഉണ്ടോ?',
		'field_name' 	=> 'have_suggestion',
		'table_name'	=> 'ward_sabha_participation',
		'master_field'	=> 'surveyee_user_id',
		'group_id'		=> 2,
    'uid' => 42,
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
	array(
		'title' 		=> 'വീട്ടിൽ സ്വന്തമായുള്ള വാഹനങ്ങൾ',
		'field_name' 	=> 'vehicle_type_id',
		'table_name'	=> 'family_vehicle_type_map',
		'master_field'	=> 'family_id',
		'group_id'		=> 3,
    'uid' => 43,
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
        		'title' => 'നാല് ചക്ര വാഹനം',
      		),
			array(
        		'value' => 5,
        		'title' => 'ആറ് ചക്ര വാഹനം',
      		)
		),
	),
	array(
		'title' 		=> 'താഴെ പറയുന്നവ വീട്ടിൽ ഉപയോഗിക്കുന്നുണ്ടോ?',
		'field_name' 	=> 'house_appliance_id',
		'table_name'	=> 'family_appliance_map',
		'master_field'	=> 'family_id',
		'group_id'		=> 4,
    'uid' => 44,
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
	array(
		'title' 		=> 'ജനനസ്ഥലം ഈ വാർഡ് തന്നെയാണോ?',
		'field_name' 	=> 'is_birth_same_ward',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 5,
    'uid' => 45,
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
	array(
		'title' 		=> 'ജനനസ്ഥലം  ഈ വാർഡ് അല്ലെങ്കിൽ, ജനനസ്ഥലത്തിന്റെ പേര്',
		'field_name' 	=> 'ifnot_birth_place',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 5,
    'uid' => 46,
		'answer_type' 	=> $config['answer_types']['single_value_text'],
		'answer_options'=> array(),
	),
	array(
		'title' 		=> 'എത്ര വർഷമായി ഈ വാർഡിൽ താമസമായിട്ട്',
		'field_name' 	=> 'YEARS_OF_STAYING',
		'table_name'	=> 'TEMP',
		'master_field'	=> 'family_id|ward_id',
		'group_id'		=> 5,
    'uid' => 47,
		'answer_type' 	=> $config['answer_types']['single_value_text'],
		'answer_options'=> array(),
	),
	array(
		'title' 		=> 'വീട്ടിനുള്ളിൽ  എത്തിച്ചേരുന്ന വാഹനത്തിന്റെ തരം',
		'field_name' 	=> 'largest_accessible_vehicle',
		'table_name'	=> 'houses',
		'group_id'		=> 6,
    'uid' => 48,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(

      array(
        		'value' => 1,
        		'title' => 'നടവഴി മാത്രം',
      		),
			array(
        		'value' => 2,
        		'title' => 'സൈക്കിൾ',
      		),
			array(
        		'value' => 3,
        		'title' => 'ഇരുചക്രവാഹനം',
      		),
			array(
        		'value' => 4,
        		'title' => 'മുച്ചക്രവാഹനം',
      		),
			array(
        		'value' => 5,
        		'title' => 'നാലുചക്രവാഹനം',
      		),
			array(
        		'value' => 6,
        		'title' => 'ലോറി',
      		),
		),
	),
	array(
		'title' 		=> 'വീടിന് തൊട്ടടുത്തുള്ള പൊതു ഗതാഗത സൗകര്യം',
		'field_name' 	=> 'road_type_id',
		'table_name'	=> 'house_road_map',
		'master_field'	=> 'house_id',
		'group_id'		=> 6,
    'uid' => 49,
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
	array(
		'title' 		=> 'അടുത്തുള്ള ഓട്ടോ സ്റ്റാൻദിലേക്ക്  എത്താൻ എടുക്കുന്ന സമയം',
		'field_name' 	=> 'nearest_auto_stand_access_time',
		'table_name'	=> 'houses',
		'master_field'	=> 'house_id',		// need to hard code public_utility_id = 4 of autorikshaw stand
		'group_id'		=> 6,
    'uid' => 50,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
      array(
        		'value' => 1,
        		'title' => 'പെട്ടെന്ന് എത്താം',
      		),
      array(
        		'value' => 2,
        		'title' => 'സമയം എടുക്കും',
      		),
      array(
        		'value' => 3,
        		'title' => 'ഒരുപാട് സമയം എടുക്കും',
      		),
    ),
	),
	array(
		'title' 		=> 'നഗരസഭാ സേവനങ്ങളുടെ സാമീപ്യം',
		'field_name' 	=> 'public_utility_id',
		'table_name'	=> 'house_public_utility_proximity',
		'master_field'	=> 'house_id',
		'group_id'		=> 7,
    'uid' => 51,
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
      		),
			array(
        		'value' => 4,
        		'title' => 'അംഗനവാടി',
      		),
			array(
        		'value' => 5,
        		'title' => 'വയോ മിത്രാ ആശുപത്രി',
      		),
			array(
        		'value' => 6,
        		'title' => 'ലൈബ്രറി',
      		),
		)
	),
	array(
		'title' 		=> 'വീട്ടാവശ്യത്തിനുള്ള വെള്ളം എവിടുന്നു എടുക്കുന്നു',
		'field_name' 	=> 'house_water_source_id',
		'table_name'	=> 'house_water_source_map',
		'master_field'	=> 'house_id',
		'group_id'		=> 8,
    'uid' => 52,
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
        		'title' => 'സ്വന്തം വാട്ടർ കണക്ഷൻ',
      		),
			array(
        		'value' => 4,
        		'title' => 'കുഴൽക്കിണർ',
      		),
			array(
        		'value' => 5,
        		'title' => 'കുളം',
      		)
		)
	),
	array(
		'title' 		=> 'വീട്ടിലെ കക്കൂസുകൾ സെപ്റ്റിക് ടാങ്കുമായി ബന്ധിപ്പിച്ചിട്ടുണ്ടോ',
		'field_name' 	=> 'connection_type_to_septic_tank',
		'table_name'	=> 'houses',
		'group_id'		=> 8,
    'uid' => 53,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'ബന്ധിപ്പിച്ചിട്ടുണ്ട്',
      			),
			array(
        		'value' => 2,
        		'title' => 'ബന്ധിപ്പിച്ചിട്ടില്ലാ',
      		),
      array(
          'value' => 3,
          'title' => 'ഭാഗികമായി ബന്ധിപ്പിച്ചുണ്ട്',
        )
		)
	),
	array(
		'title' 		=> 'കക്കൂസിന്റെ എണ്ണം',
		'field_name' 	=> 'toilet_count',
		'table_name'	=> 'houses',
		'group_id'		=> 8,
    'uid' => 54,
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
        		'title' => 'അഞ്ചിന് മുകളിൽ',
      		)


		)
	),
	array(
		'title' 		=> 'അഴുകിച്ചേരുന്ന ഖരമാലിന്യം എന്ത് ചെയ്യുന്നു',
		'field_name' 	=> 'biodegradable_solution_id',
		'table_name'	=> 'house_biodegradable_waste_management_solution_map',
		'master_field'	=> 'house_id',
		'group_id'		=> 8,
    'uid' => 55,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'സ്വന്തം പറമ്പിൽ സംസ്കരിക്കുന്നു',
      		),
			array(
        		'value' => 2,
        		'title' => 'മാലിന്യ സംസ്കരണകേന്ദ്രത്തിൽ കൊടുക്കുന്നു',
      		)
		)
	),
  array(
		'title' 		=> 'അഴുകി ചേരാത്ത മാലിന്യങ്ങൾ എന്ത് ചെയ്യുന്നു',
		'field_name' 	=> 'nonbiodegradable_solution_id',
		'table_name'	=> 'house_nonbiodegradable_waste_management_solution_map',
		'master_field'	=> 'house_id',
		'group_id'		=> 8,
    'uid' => 56,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'കത്തിച്ചു കളയുന്നു',
      		),
			array(
        		'value' => 2,
        		'title' => 'സർക്കാരിന്റെ മാലിന്യ സംസ്കരണകേന്ദ്രത്തിൽ കൊടുക്കുന്നു',
      		),
			array(
        		'value' => 3,
        		'title' => 'ആക്രിക്കാർക്ക് കൊടുക്കുന്നു',
      		)
		)
	),
	array(
		'title' 		=> 'വീട് വൈദ്യുതീകരിച്ചതാണോ?',
		'field_name' 	=> 'is_electrified',
		'table_name'	=> 'houses',
		'group_id'		=> 9,
    'uid' => 57,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'അതെ',
      		),
			array(
        		'value' => 2,
        		'title' => 'അല്ലാ',
      		)
		),
	),
	array(
		'title' 		=> 'പാചകത്തിന് ഉപയോഗിക്കുന്ന ഇന്ധനം ഏതൊക്കെ ?',
		'field_name' 	=> 'domestic_fuel_type_id',
		'table_name'	=> 'family_domestic_fuel_type_map',
		'master_field'	=> 'house_id',
		'group_id'		=> 9,
    'uid' => 58,
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

  array(
    'title' 		=> 'ഏതൊക്കെ അരുമ വളർത്തുമൃഗങ്ങൾ (Pets) ഉണ്ട്',
    'field_name' 	=> 'pet_id',
    'table_name'	=> 'family_pet_map',
    'master_field'	=> 'family_id',
    'group_id'		=> 10,
    'uid' => 59,
    'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
    'answer_options'=> array(
      array(
            'value' => 1,
            'title' => 'നായ',
          ),
      array(
            'value' => 2,
            'title' => 'പൂച്ച',
          ),
      array(
            'value' => 3,
            'title' => 'അലങ്കാര മൽസ്യങ്ങൾ',
          ),
    ),
  ),

  array(
    'title' 		=> 'വളർത്ത നായയ്‌ക്കു ലൈസൻസ് ഉണ്ടോ ?',
    'field_name' 	=> 'has_license',
    'table_name'	=> 'family_pet_map',
    'master_field'	=> 'family_id|pet_id',
    'group_id'		=> 10,
    'uid' => 60,
    'answer_type' 	=> $config['answer_types']['single_value_select'],
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

  array(
		'title' 		=> 'ഉപജീവനത്തിനായി ഉപയോഗിക്കുന്ന മൃഗങ്ങൾ (Live Stock )?',
		'field_name' 	=> 'livestock_id',
		'table_name'	=> 'family_livestock_map',
		'master_field'	=> 'family_id',
		'group_id'		=> 10,
    'uid' => 61,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'പശു',
      		),
			array(
        		'value' => 2,
        		'title' => 'ആട്',
      		),
			array(
        		'value' => 3,
        		'title' => 'കോഴി',
      		),
			array(
        		'value' => 4,
        		'title' => 'താറാവ്',
      		),
      array(
            'value' => 5,
            'title' => 'മൽസ്യം',
          ),
      array(
        		'value' => 6,
        		'title' => 'മറ്റുള്ളവ',
      		)
		)
	),

	array(
		'title' 		=> 'കൃഷി ഉണ്ടോ ?',
		'field_name' 	=> 'has_agriculture',
		'table_name'	=> 'families',
		'group_id'		=> 11,
    'uid' => 62,
		'answer_type' 	=> $config['answer_types']['single_value_radio'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'ഉണ്ട്',
      		),
			array(
        		'value' => 2,
        		'title' => 'ഇല്ലാ',
      		),
		)
	),

  	array(
  		'title' 		=> 'കൃഷി ഇടം ?',
  		'field_name' 	=> 'agriculture_location_id',
  		'table_name'	=> 'family_agriculture_location_map',
  		'group_id'		=> 11,
      'uid' => 63,
  		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
  		'answer_options'=> array(
  			array(
          		'value' => 1,
          		'title' => 'മട്ടുപ്പാവിൽ',
        		),
  			array(
          		'value' => 2,
          		'title' => 'പറമ്പിൽ',
        		),
  		)
  	),

	array(
		'title' 		=> 'ഭലവൃക്ഷങ്ങൾ ഏതെല്ലാം ഉണ്ട് ?',
		'field_name' 	=> 'fruit_tree_id',
		'table_name'	=> 'land_fruit_tree_map',
    'master_field'	=> 'land_id',
		'group_id'		=> 12,
    'uid' => 64,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
		'answer_options'=> array(

			array(
        		'value' => 1,
        		'title' => 'മാവ്',
      		),
			array(
        		'value' => 2,
        		'title' => 'പേര',
      		),
			array(
        		'value' => 3,
        		'title' => 'പ്ലാവ്',
      		),
			array(
        		'value' => 4,
        		'title' => 'മറ്റുള്ളവ',
      		)
		)
	),




  array(
  'title' 		=> 'നാണ്യ വിളകൾ ഏതെല്ലാം ഉണ്ട് ?',
  'field_name' 	=> 'cash_crop_id',
  'table_name'	=> 'land_cash_crop_map',
  'master_field'	=> 'land_id',
  'group_id'		=> 12,
  'uid' => 65,
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
          'title' => 'റബ്ബർ',
        ),
    array(
          'value' => 4,
          'title' => 'കുരുമുളക്',
        ),
    array(
          'value' => 5,
          'title' => 'വാനില',
        )
  )
  ),




	array(
		'title' 		=> 'ബാങ്ക് അക്കൗണ്ട്',
		'field_name' 	=> 'bank_account_type_id',
		'table_name'	=> 'surveyee_user_bank_account_type_map',
		'group_id'		=> 13,
    'uid' => 66,
		'answer_type' 	=> $config['answer_types']['multi_value_checkbox'],
		'answer_options'=> array(
			array(
        		'value' => 1,
        		'title' => 'സേവിoഗ്‌സ് അക്കൗണ്ട്',
      		),
			array(
        		'value' => 2,
        		'title' => 'കറണ്ട് അക്കൗണ്ട്',
      		),
			array(
        		'value' => 3,
        		'title' => 'പോസ്റ്റ് ഓഫീസ്',
      		)
		),
	),
	array(
		'title' 		=> 'ക്രെഡിറ്റ് / ഡെബിറ്റ് കാർഡ്',
		'field_name' 	=> 'has_credit_or_debit_card',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 13,
    'uid' => 67,
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
	array(
		'title' 		=> 'ഇന്റർനെറ്റ് ബാംങ്കിംഗ്',
		'field_name' 	=> 'has_internet_banking',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 13,
    'uid' => 68,
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
	array(
		'title' 		=> 'മൊബൈൽ ബാംങ്കിംഗ്',
		'field_name' 	=> 'has_mobile_banking',
		'table_name'	=> 'surveyee_users',
		'group_id'		=> 13,
    'uid' => 69,
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

	array(
		'title' 		=> 'നിക്ഷേപം',
		'field_name' 	=> 'investment_type_id',
		'table_name'	=> 'surveyee_user_investment_type_map',
		'group_id'		=> 13,
    'uid' => 70,
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
	array(
		'title' 		=> 'കടബാധ്യതയ്ക്ക് കാരണം',
		'field_name' 	=> 'loan_purpose_id',
		'table_name'	=> 'family_loan_purpose_map',
		'group_id'		=> 13,
    'uid' => 71,
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
	array(
		'title' 		=> 'കടമെടുത്തിട്ടുള്ളത്',
		'field_name' 	=> 'loan_source_id',
		'table_name'	=> 'family_loan_sources_map',
		'group_id'		=> 13,
    'uid' => 72,
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
