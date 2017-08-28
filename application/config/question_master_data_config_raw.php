<?php  if ( ! defined('BASEPATH')) exit("No direct script access allowed");

/*
|--------------------------------------------------------------------------
| PROGRAMATICALLY GENERATED FILE. DO NOT EDIT MANUALLY
|--------------------------------------------------------------------------
|
|
*/


$config['questions_master_data_raw_new'] =
array (
  61776713 => 
  array (
    'title' => 'ഏതൊക്കെ പെൻഷൻ ഉണ്ട് ?',
    'answer_type' => '3',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'ഗവണ്മെന്റ് പെൻഷൻ',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'മുതിർന്ന പൗരനുള്ള പെൻഷൻ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
      'value' => '',
      'title' => 'പെൻഷൻ ഇല്ലാ',
    ),
    'field_name' => 'pension_type_id',
    'table_name' => '',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '61776713',
    'uname' => 'pension_type_id',
    'help_text' => NULL,
    'form_field' => '3',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '1',
    'collection_question_uid' => '15207088',
    'template' => NULL,
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  30138200 => 
  array (
    'title' => 'ഡ്രൈവിങ് ലൈസൻസ് ഉണ്ടോ ?',
    'answer_type' => '5',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'ഇല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'ഉണ്ട്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'has_driving_license',
    'table_name' => 'surveyee_users',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '30138200',
    'uname' => 'has_driving_license',
    'help_text' => NULL,
    'form_field' => '5',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '1',
    'collection_question_uid' => '15207088',
    'template' => NULL,
    'true_false_variant' => '2',
    'group_id' => '1',
  ),
  49851225 => 
  array (
    'title' => 'ഏതൊക്കെ ഇൻഷുറൻസ് പരിരക്ഷ ഉണ്ട് ?',
    'answer_type' => '3',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'ലൈഫ് ഇൻഷുറൻസ്',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'മെഡിക്കൽ ഇൻഷുറൻസ്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
      'value' => '',
      'title' => 'ഇൻഷുറൻസ്  ഇല്ലാ',
    ),
    'field_name' => 'insurance_type_id',
    'table_name' => '',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '49851225',
    'uname' => 'insurance_type_id',
    'help_text' => NULL,
    'form_field' => '3',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '1',
    'collection_question_uid' => '15207088',
    'template' => NULL,
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  13767273 => 
  array (
    'title' => 'വിവാഹാവസ്ഥ',
    'answer_type' => '5',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'കല്യാണം കഴിച്ചിട്ടില്ലാ',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'കല്യാണം കഴിച്ചു',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'ഡിവോഴ്സ് ചെയ്തു',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'പുനർ വിവാഹം ചെയ്തു',
      ),
    ),
    'answer_non_selection_option' => 
    array (
      'value' => '',
      'title' => ' -- തിരഞ്ഞെടുക്കു -- ',
    ),
    'field_name' => 'marital_status',
    'table_name' => 'surveyee_users',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '13767273',
    'uname' => 'marital_status',
    'help_text' => NULL,
    'form_field' => '5',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '1',
    'collection_question_uid' => '15207088',
    'template' => NULL,
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  20468652 => 
  array (
    'title' => 'പാസ്പോര്ട്ട് ഉണ്ടോ ?',
    'answer_type' => '5',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'ഇല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'ഉണ്ട്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'has_passport',
    'table_name' => 'surveyee_users',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '20468652',
    'uname' => 'has_passport',
    'help_text' => NULL,
    'form_field' => '5',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '1',
    'collection_question_uid' => '15207088',
    'template' => NULL,
    'true_false_variant' => '2',
    'group_id' => '1',
  ),
  15207088 => 
  array (
    'title' => 'കുടുംബ വിവരങ്ങൾ',
    'answer_type' => '1',
    'answer_options' => 
    array (
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => '',
    'table_name' => 'surveyee_users',
    'question_type' => '2',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '15207088',
    'uname' => 'family_details',
    'help_text' => NULL,
    'form_field' => '1',
    'type' => '2',
    'is_multipliable' => '1',
    'is_required_question' => '0',
    'question_order' => '1',
    'collection_question_uid' => NULL,
    'template' => 'question/tpl_family_member_details_new',
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  49482177 => 
  array (
    'title' => 'ബ്ലഡ് ഗ്രൂപ്പ്',
    'answer_type' => '5',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'A +ve',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'A -ve',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'B +ve',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'B -ve',
      ),
      4 => 
      array (
        'value' => '5',
        'title' => 'AB +ve',
      ),
      5 => 
      array (
        'value' => '6',
        'title' => 'AB -ve',
      ),
      6 => 
      array (
        'value' => '7',
        'title' => 'O +ve',
      ),
      7 => 
      array (
        'value' => '8',
        'title' => 'O -ve',
      ),
    ),
    'answer_non_selection_option' => 
    array (
      'value' => '',
      'title' => 'അറിയില്ലാ',
    ),
    'field_name' => 'blood_group',
    'table_name' => 'surveyee_users',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '49482177',
    'uname' => 'blood_group',
    'help_text' => NULL,
    'form_field' => '5',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '1',
    'collection_question_uid' => '15207088',
    'template' => NULL,
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  41060327 => 
  array (
    'title' => 'ജനന തീയതി',
    'answer_type' => '1',
    'answer_options' => 
    array (
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'date_of_birth',
    'table_name' => 'surveyee_users',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '41060327',
    'uname' => 'date_of_birth',
    'help_text' => NULL,
    'form_field' => '1',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '1',
    'collection_question_uid' => '15207088',
    'template' => NULL,
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  31786733 => 
  array (
    'title' => 'ബാങ്ക് അക്കൗണ്ട് ഉണ്ടോ ?',
    'answer_type' => '5',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'ഇല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'ഉണ്ട്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'has_bank_account',
    'table_name' => 'surveyee_users',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '31786733',
    'uname' => 'has_bank_account',
    'help_text' => NULL,
    'form_field' => '5',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '1',
    'collection_question_uid' => '15207088',
    'template' => NULL,
    'true_false_variant' => '2',
    'group_id' => '1',
  ),
  35467066 => 
  array (
    'title' => 'വിലാസം',
    'answer_type' => '4',
    'answer_options' => 
    array (
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'address',
    'table_name' => 'houses',
    'question_type' => '2',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '35467066',
    'uname' => 'address',
    'help_text' => NULL,
    'form_field' => '4',
    'type' => '2',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '2',
    'collection_question_uid' => NULL,
    'template' => 'question/tpl_address',
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  33447379 => 
  array (
    'title' => 'പേര്',
    'answer_type' => '1',
    'answer_options' => 
    array (
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'name',
    'table_name' => 'surveyee_users',
    'question_type' => '2',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '33447379',
    'uname' => 'name',
    'help_text' => NULL,
    'form_field' => '1',
    'type' => '2',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '2',
    'collection_question_uid' => '15207088',
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  41292120 => 
  array (
    'title' => 'സ്ത്രീ / പുരുഷൻ',
    'answer_type' => '5',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'സ്ത്രീ',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'പുരുഷൻ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'gender',
    'table_name' => 'surveyee_users',
    'question_type' => '2',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '41292120',
    'uname' => 'gender',
    'help_text' => NULL,
    'form_field' => '5',
    'type' => '2',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '3',
    'collection_question_uid' => '15207088',
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  28539294 => 
  array (
    'title' => 'വീട് സ്വന്തമാണോ ?',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'അല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'അതെ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'is_own_house',
    'table_name' => 'TEMP',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '28539294',
    'uname' => 'is_own_house',
    'help_text' => '',
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '1',
    'question_order' => '3',
    'collection_question_uid' => NULL,
    'template' => NULL,
    'true_false_variant' => '1',
    'group_id' => '1',
  ),
  54694286 => 
  array (
    'title' => 'വീട്ടിലെ താമസം',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'വാടകയ്ക്ക്',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'സ്ഥിര താമസം',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'മറ്റ്  തരം',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'RESIDENCE_TYPE',
    'table_name' => 'TEMP',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '54694286',
    'uname' => 'residence_type',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '4',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  74021845 => 
  array (
    'title' => 'ഇലക്ഷൻ ഐ. ഡി.',
    'answer_type' => '1',
    'answer_options' => 
    array (
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'election_id',
    'table_name' => 'surveyee_users',
    'question_type' => '2',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '74021845',
    'uname' => 'election_id',
    'help_text' => NULL,
    'form_field' => '1',
    'type' => '2',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '4',
    'collection_question_uid' => '15207088',
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  72641368 => 
  array (
    'title' => 'സ്ഥലത്തിൻ്റെ ഉടമസ്ഥത',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'സ്വന്തം',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'പാട്ടം',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'LAND_OWNERSHIP',
    'table_name' => 'TEMP',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '72641368',
    'uname' => 'land_ownership',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '5',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  81516510 => 
  array (
    'title' => 'ആധാർ നം',
    'answer_type' => '1',
    'answer_options' => 
    array (
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'aadhar_id',
    'table_name' => 'surveyee_users',
    'question_type' => '2',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '81516510',
    'uname' => 'aadhar_id',
    'help_text' => NULL,
    'form_field' => '1',
    'type' => '2',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '5',
    'collection_question_uid' => '15207088',
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  89610671 => 
  array (
    'title' => 'പാരമ്പര്യമായി കിട്ടിയ ഭൂമിയാണോ ?',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'അല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'അതെ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'IS_LEGACY_LAND',
    'table_name' => 'TEMP',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '89610671',
    'uname' => 'is_legacy_land',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '6',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => '1',
    'group_id' => '1',
  ),
  82775786 => 
  array (
    'title' => 'സംവരണം',
    'answer_type' => '5',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'പട്ടികജാതി/വർഗം',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'പിന്നോക്ക സമുദായം',
      ),
    ),
    'answer_non_selection_option' => 
    array (
      'value' => '',
      'title' => 'ഇല്ലാ',
    ),
    'field_name' => 'reservation',
    'table_name' => '',
    'question_type' => '2',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '82775786',
    'uname' => 'reservation',
    'help_text' => NULL,
    'form_field' => '5',
    'type' => '2',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '6',
    'collection_question_uid' => '15207088',
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '2',
  ),
  11253038 => 
  array (
    'title' => 'വീടിന്റെ വിസ്തീർണം',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => '300 ച: അടി വരെ',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => '300 - 600 ച: അടി',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => '600 - 1500 ച: അടി',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => '2000 ച: അടിയ്ക്ക് മുകളിൽ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'house_area_range_id',
    'table_name' => 'houses',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '11253038',
    'uname' => 'house_area_range_id',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '7',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  59336358 => 
  array (
    'title' => 'മൊബൈൽ നമ്പർ',
    'answer_type' => '1',
    'answer_options' => 
    array (
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'mobile_number',
    'table_name' => 'surveyee_users',
    'question_type' => '2',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => 'numeric|min_length[10]|max_length[10]',
    'ui_validation' => 'data-rule-minlength="10" data-rule-maxlength="10" data-rule-number="true"',
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '59336358',
    'uname' => 'mobile_number',
    'help_text' => NULL,
    'form_field' => '1',
    'type' => '2',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '7',
    'collection_question_uid' => '15207088',
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '2',
  ),
  72955692 => 
  array (
    'title' => 'വീട് നിൽക്കുന്ന സ്ഥലത്തിന്റെ വിസ്തീർണം',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => '3 സെന്റിൽ താഴെ',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => '3 - 5 സെന്റ്',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => '5 - 10  സെന്റ്',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => '10 സെന്റിനു മുകളിൽ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'area_range',
    'table_name' => 'lands',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '72955692',
    'uname' => 'area_range',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '8',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  71360678 => 
  array (
    'title' => 'ഇമെയിൽ വിലാസം',
    'answer_type' => '1',
    'answer_options' => 
    array (
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'email_id',
    'table_name' => 'surveyee_users',
    'question_type' => '2',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '71360678',
    'uname' => 'email_id',
    'help_text' => NULL,
    'form_field' => '1',
    'type' => '2',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '8',
    'collection_question_uid' => '15207088',
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '2',
  ),
  15937133 => 
  array (
    'title' => 'വീടിന്റെ തരം',
    'answer_type' => '3',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'കുടിൽ',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'ഓല',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'ഷീറ്റ്',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'ഓട്',
      ),
      4 => 
      array (
        'value' => '5',
        'title' => 'കോൺക്രീറ്റ്',
      ),
      5 => 
      array (
        'value' => '6',
        'title' => 'ആസ്ബറ്റോസ് ഷീറ്റ്',
      ),
      6 => 
      array (
        'value' => '7',
        'title' => 'അലുമിനിയം',
      ),
      7 => 
      array (
        'value' => '8',
        'title' => 'ടിൻ ഷീറ്റ്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'house_type_id',
    'table_name' => 'house_house_type_map',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '15937133',
    'uname' => 'house_type_id',
    'help_text' => NULL,
    'form_field' => '3',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '9',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  29424043 => 
  array (
    'title' => 'വാട്സപ്പ്‍ നമ്പർ',
    'answer_type' => '1',
    'answer_options' => 
    array (
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'whatsapp_number',
    'table_name' => 'surveyee_users',
    'question_type' => '2',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '29424043',
    'uname' => 'whatsapp_number',
    'help_text' => NULL,
    'form_field' => '1',
    'type' => '2',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '9',
    'collection_question_uid' => '15207088',
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '2',
  ),
  29392142 => 
  array (
    'title' => 'ഗൃഹനാഥൻ / ഗൃഹനാഥയാണോ',
    'answer_type' => '5',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'അല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'അതെ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'is_head_of_house',
    'table_name' => '',
    'question_type' => '2',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '29392142',
    'uname' => 'is_head_of_house',
    'help_text' => NULL,
    'form_field' => '5',
    'type' => '2',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '10',
    'collection_question_uid' => '15207088',
    'template' => '',
    'true_false_variant' => '1',
    'group_id' => '2',
  ),
  19999673 => 
  array (
    'title' => 'വീടിന്റെ നിലകളുടെ എണ്ണം',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'ഒരു നില',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'ഇരുനില',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'മൂന്നു നിലകൾ',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'മൂന്നിൽ കൂടുതൽ നിലകൾ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'num_floors',
    'table_name' => 'houses',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '19999673',
    'uname' => 'num_floors',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '10',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  59780386 => 
  array (
    'title' => 'ഗൃഹനാഥൻ / നാഥ യുമായുള്ള ബന്ധം',
    'answer_type' => '5',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'അച്ഛൻ',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'അമ്മ',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'അപ്പൂപ്പൻ',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'അമ്മൂമ്മാ',
      ),
      4 => 
      array (
        'value' => '5',
        'title' => 'സഹോദരി',
      ),
      5 => 
      array (
        'value' => '6',
        'title' => 'സഹോദരൻ',
      ),
      6 => 
      array (
        'value' => '7',
        'title' => 'മകൻ',
      ),
      7 => 
      array (
        'value' => '8',
        'title' => 'മകൾ',
      ),
      8 => 
      array (
        'value' => '9',
        'title' => 'ഭാര്യ',
      ),
      9 => 
      array (
        'value' => '10',
        'title' => 'ഭർത്താവ്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
      'value' => '',
      'title' => 'ബാധകമല്ലാ',
    ),
    'field_name' => 'relationship_to_head_of_house',
    'table_name' => '',
    'question_type' => '2',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '59780386',
    'uname' => 'relationship_to_head_of_house',
    'help_text' => NULL,
    'form_field' => '5',
    'type' => '2',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '11',
    'collection_question_uid' => '15207088',
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '2',
  ),
  26427170 => 
  array (
    'title' => 'വീടിൻ്റെ തറ',
    'answer_type' => '3',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'മൺതറ',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'സാധാരണ തറയോട്',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'സിമൻറ്',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'മൊസൈക്ക്',
      ),
      4 => 
      array (
        'value' => '5',
        'title' => 'മാർബിൾ',
      ),
      5 => 
      array (
        'value' => '6',
        'title' => 'ഗ്രാനൈറ്റ്',
      ),
      6 => 
      array (
        'value' => '7',
        'title' => 'വിട്രിഫൈഡ് ടൈൽസ്',
      ),
      7 => 
      array (
        'value' => '8',
        'title' => 'മറ്റുള്ളവ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'floor_type_id',
    'table_name' => 'house_floor_type_map',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '26427170',
    'uname' => 'floor_type_id',
    'help_text' => NULL,
    'form_field' => '3',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '11',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  73633608 => 
  array (
    'title' => 'വിദ്യാഭ്യാസ യോഗ്യത',
    'answer_type' => '5',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => '10 - ൽ താഴെ',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => '10 വരെ',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'Plus Two',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'ITI',
      ),
      4 => 
      array (
        'value' => '5',
        'title' => 'Poly',
      ),
      5 => 
      array (
        'value' => '6',
        'title' => 'Diploma',
      ),
      6 => 
      array (
        'value' => '7',
        'title' => 'Degree',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'educational_qualification',
    'table_name' => '',
    'question_type' => '2',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '73633608',
    'uname' => 'educational_qualification',
    'help_text' => NULL,
    'form_field' => '5',
    'type' => '2',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '12',
    'collection_question_uid' => '15207088',
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '2',
  ),
  57485538 => 
  array (
    'title' => 'മുറികളുടെ എണ്ണം',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'ഒന്ന്',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'രണ്ട്',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'മൂന്ന്',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'നാല്',
      ),
      4 => 
      array (
        'value' => '5',
        'title' => 'അഞ്ച്',
      ),
      5 => 
      array (
        'value' => '6',
        'title' => '5 ൽ  കൂടുതൽ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'num_rooms',
    'table_name' => 'houses',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '57485538',
    'uname' => 'num_rooms',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '12',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  86756639 => 
  array (
    'title' => 'വാർഷിക കെട്ടിട നികുതി',
    'answer_type' => '1',
    'answer_options' => 
    array (
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'amount',
    'table_name' => 'house_tax',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => 'numeric',
    'ui_validation' => 'data-rule-number="true"',
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '86756639',
    'uname' => 'amount',
    'help_text' => NULL,
    'form_field' => '1',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '13',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  75506728 => 
  array (
    'title' => 'തൊഴിൽ മേഖല',
    'answer_type' => '5',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'തൊഴിൽ ഇല്ലാ',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'അർദ്ധ സർക്കാർ ജോലി',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'സ്വകാര്യ സ്ഥാപനത്തിൽ',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'ബിസിനസ്',
      ),
      4 => 
      array (
        'value' => '5',
        'title' => 'വിദേശത്തു തൊഴിൽ',
      ),
      5 => 
      array (
        'value' => '6',
        'title' => 'സർക്കാർ ജോലി',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'employment_category',
    'table_name' => '',
    'question_type' => '2',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '75506728',
    'uname' => 'employment_category',
    'help_text' => NULL,
    'form_field' => '5',
    'type' => '2',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '13',
    'collection_question_uid' => '15207088',
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '2',
  ),
  74853345 => 
  array (
    'title' => 'ഗൃഹനാഥൻ്റെ മതം',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'ഹിന്ദു',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'മുസ്ലിം',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'ക്രിസ്ത്യൻ',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'മതമില്ല',
      ),
      4 => 
      array (
        'value' => '5',
        'title' => 'മറ്റുള്ളവ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'belief_in_religion_id',
    'table_name' => 'surveyee_users',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '74853345',
    'uname' => 'belief_in_religion_id',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '14',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '2',
  ),
  28539295 => 
  array (
    'title' => 'കെട്ടിട നമ്പർ',
    'answer_type' => '1',
    'answer_options' => 
    array (
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'address_house_no',
    'table_name' => '',
    'question_type' => '2',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '28539295',
    'uname' => 'address_house_no',
    'help_text' => NULL,
    'form_field' => '1',
    'type' => '2',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '15',
    'collection_question_uid' => '35467066',
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  17372667 => 
  array (
    'title' => 'ലാൻറ്  ഫോൺ',
    'answer_type' => '1',
    'answer_options' => 
    array (
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'landline_number',
    'table_name' => 'surveyee_users',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => 'numeric',
    'ui_validation' => 'data-rule-number="true"',
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '17372667',
    'uname' => 'landline_number',
    'help_text' => NULL,
    'form_field' => '1',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '15',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '2',
  ),
  33106339 => 
  array (
    'title' => 'റേഷൻ കാർഡ് നമ്പർ',
    'answer_type' => '1',
    'answer_options' => 
    array (
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'ration_card_no',
    'table_name' => 'families',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '33106339',
    'uname' => 'ration_card_no',
    'help_text' => NULL,
    'form_field' => '1',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '16',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '2',
  ),
  49367725 => 
  array (
    'title' => 'വീട്ട്  പേര്',
    'answer_type' => '1',
    'answer_options' => 
    array (
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'address_house_name',
    'table_name' => '',
    'question_type' => '2',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '49367725',
    'uname' => 'address_house_name',
    'help_text' => NULL,
    'form_field' => '1',
    'type' => '2',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '16',
    'collection_question_uid' => '35467066',
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  77629391 => 
  array (
    'title' => 'തെരുവ് (Street Name)',
    'answer_type' => '1',
    'answer_options' => 
    array (
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'address_street_name',
    'table_name' => '',
    'question_type' => '2',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '77629391',
    'uname' => 'address_street_name',
    'help_text' => NULL,
    'form_field' => '1',
    'type' => '2',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '17',
    'collection_question_uid' => '35467066',
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  44658149 => 
  array (
    'title' => 'റേഷൻ കാർഡ് തരം',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'Non Priority(എ.പി.ൽ)',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'മുൻഗണന (ബി.പി.ൽ)',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'AAY',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'APL SS',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'ration_card_type_id',
    'table_name' => 'families',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '44658149',
    'uname' => 'ration_card_type_id',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '17',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '2',
  ),
  35334671 => 
  array (
    'title' => 'ഏതെങ്കിലും അയൽക്കൂട്ടം അംഗമാണോ?',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'അല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'അതെ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'is_member_ayalkoottam',
    'table_name' => 'surveyee_users',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '35334671',
    'uname' => 'is_member_ayalkoottam',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '18',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => '1',
    'group_id' => '2',
  ),
  39980947 => 
  array (
    'title' => 'പിൻകോഡ്',
    'answer_type' => '1',
    'answer_options' => 
    array (
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'address_pincode',
    'table_name' => '',
    'question_type' => '2',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '39980947',
    'uname' => 'address_pincode',
    'help_text' => NULL,
    'form_field' => '1',
    'type' => '2',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '18',
    'collection_question_uid' => '35467066',
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '1',
  ),
  56883834 => 
  array (
    'title' => 'അയൽക്കൂട്ടം ഭാരവാഹിയാണോ?',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'അല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'അതെ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'is_office_bearer_ayalkoottam',
    'table_name' => 'surveyee_users',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '56883834',
    'uname' => 'is_office_bearer_ayalkoottam',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '19',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => '1',
    'group_id' => '2',
  ),
  89176226 => 
  array (
    'title' => 'രാഷ്ട്രീയ പാർട്ടിയിൽ അംഗത്വമുണ്ടോ?',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'ഇല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'ഉണ്ട്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'is_member_political_party',
    'table_name' => 'surveyee_users',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '89176226',
    'uname' => 'is_member_political_party',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '20',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => '2',
    'group_id' => '2',
  ),
  27229808 => 
  array (
    'title' => 'സാമൂഹിക സാംസ്‌കാരിക സംഘടനകളിൽ അംഗത്വം ഉണ്ടോ?',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'ഇല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'ഉണ്ട്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'is_memeber_socio_cultural_organization',
    'table_name' => 'surveyee_users',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '27229808',
    'uname' => 'is_memeber_socio_cultural_organization',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '21',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => '2',
    'group_id' => '2',
  ),
  82690469 => 
  array (
    'title' => 'മതസംഘടനയിൽ ഭാരവാഹിയാണോ?',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'അല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'അതെ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'is_office_bearer_religious_organization',
    'table_name' => 'surveyee_users',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '82690469',
    'uname' => 'is_office_bearer_religious_organization',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '22',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => '1',
    'group_id' => '2',
  ),
  50327633 => 
  array (
    'title' => 'ലൈബ്രറി അംഗത്വം ഉണ്ടോ?',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'ഇല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'ഉണ്ട്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'is_member_library',
    'table_name' => 'surveyee_users',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '50327633',
    'uname' => 'is_member_library',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '23',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => '2',
    'group_id' => '2',
  ),
  65636584 => 
  array (
    'title' => 'വാർഡ് സഭകളിൽ പങ്കെടുക്കാറുണ്ടോ?',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'ഇല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'ഉണ്ട്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'status',
    'table_name' => 'ward_sabha_participation',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '65636584',
    'uname' => 'status',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '24',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => '2',
    'group_id' => '2',
  ),
  41465497 => 
  array (
    'title' => 'വാർഡ് സഭകളിൽ പങ്കെടുക്കാറില്ല എങ്കില്‍ എന്തുകൊണ്ട്?',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'പ്രാധാന്യമില്ല',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'സമയമില്ല',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'അറിയാറില്ല',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'reason',
    'table_name' => 'ward_sabha_participation',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '41465497',
    'uname' => 'reason',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '25',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '2',
  ),
  83009381 => 
  array (
    'title' => 'പങ്കെടുക്കുന്നുണ്ടെങ്കിൽ  വാർഡ് സഭകളിൽ സംതൃപ്തിയുണ്ടോ',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'ഇല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'ഉണ്ട്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'is_satisfied',
    'table_name' => 'ward_sabha_participation',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '83009381',
    'uname' => 'is_satisfied',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '26',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => '2',
    'group_id' => '2',
  ),
  10789400 => 
  array (
    'title' => 'വാർഡ് സഭകളിൽ പങ്കെടുക്കാറുണ്ടെങ്കിൽ വാർഡ് സഭകൾ മെച്ചപ്പെടുത്താനുള്ള നിർദേശങ്ങൾ ഉണ്ടോ?',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'ഇല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'ഉണ്ട്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'have_suggestion',
    'table_name' => 'ward_sabha_participation',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '10789400',
    'uname' => 'have_suggestion',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '27',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => '2',
    'group_id' => '2',
  ),
  79469429 => 
  array (
    'title' => 'വീട്ടിൽ സ്വന്തമായുള്ള വാഹനങ്ങൾ',
    'answer_type' => '3',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'സൈക്കിൾ',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'ഇരുചക്രവാഹനം',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'മുച്ചക്രവാഹനം',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'നാല് ചക്ര വാഹനം',
      ),
      4 => 
      array (
        'value' => '5',
        'title' => 'ആറ് ചക്ര വാഹനം',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'vehicle_type_id',
    'table_name' => 'family_vehicle_type_map',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '79469429',
    'uname' => 'vehicle_type_id',
    'help_text' => NULL,
    'form_field' => '3',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '28',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '3',
  ),
  55734763 => 
  array (
    'title' => 'താഴെ പറയുന്നവ വീട്ടിൽ ഉപയോഗിക്കുന്നുണ്ടോ?',
    'answer_type' => '3',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'സോളാർ പാനൽ',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'ഇൻവെർട്ടർ',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'എയർകണ്ടിഷണർ',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'റിവേഴ്‌സ് ഓസ്മോസിസ് (RO Filter)',
      ),
      4 => 
      array (
        'value' => '5',
        'title' => 'റഫ്രിജറേറ്റർ',
      ),
      5 => 
      array (
        'value' => '6',
        'title' => 'ഓവൻ',
      ),
      6 => 
      array (
        'value' => '7',
        'title' => 'വാഷിംഗ്‌ മെഷീൻ',
      ),
      7 => 
      array (
        'value' => '8',
        'title' => 'ടെലിവിഷൻ',
      ),
      8 => 
      array (
        'value' => '9',
        'title' => 'കമ്പ്യൂട്ടർ',
      ),
      9 => 
      array (
        'value' => '10',
        'title' => 'ഇന്റർനെറ്റ്',
      ),
      10 => 
      array (
        'value' => '11',
        'title' => 'സ്മാർട്ഫോൺ',
      ),
      11 => 
      array (
        'value' => '12',
        'title' => 'സോളാർ വാട്ടർഹീറ്റർ',
      ),
      12 => 
      array (
        'value' => '13',
        'title' => 'സോളാർ ലാമ്പ്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'house_appliance_id',
    'table_name' => 'family_appliance_map',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '55734763',
    'uname' => 'house_appliance_id',
    'help_text' => NULL,
    'form_field' => '3',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '29',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '4',
  ),
  11712443 => 
  array (
    'title' => 'ജനനസ്ഥലം ഈ വാർഡ് തന്നെയാണോ?',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'അല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'അതെ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'is_birth_same_ward',
    'table_name' => 'surveyee_users',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '11712443',
    'uname' => 'is_birth_same_ward',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '30',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => '1',
    'group_id' => '5',
  ),
  31222946 => 
  array (
    'title' => 'ജനനസ്ഥലം  ഈ വാർഡ് അല്ലെങ്കിൽ, ജനനസ്ഥലത്തിന്റെ പേര്',
    'answer_type' => '1',
    'answer_options' => 
    array (
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'ifnot_birth_place',
    'table_name' => 'surveyee_users',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '31222946',
    'uname' => 'ifnot_birth_place',
    'help_text' => NULL,
    'form_field' => '1',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '31',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '5',
  ),
  59884992 => 
  array (
    'title' => 'എത്ര വർഷമായി ഈ വാർഡിൽ താമസമായിട്ട്',
    'answer_type' => '1',
    'answer_options' => 
    array (
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'YEARS_OF_STAYING',
    'table_name' => 'TEMP',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => 'numeric',
    'ui_validation' => 'data-rule-number="true"',
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '59884992',
    'uname' => 'years_of_staying',
    'help_text' => NULL,
    'form_field' => '1',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '32',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '5',
  ),
  53645109 => 
  array (
    'title' => 'വീട്ടിനുള്ളിൽ  എത്തിച്ചേരുന്ന വാഹനത്തിന്റെ തരം',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'നടവഴി മാത്രം',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'സൈക്കിൾ',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'ഇരുചക്രവാഹനം',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'മുച്ചക്രവാഹനം',
      ),
      4 => 
      array (
        'value' => '5',
        'title' => 'നാലുചക്രവാഹനം',
      ),
      5 => 
      array (
        'value' => '6',
        'title' => 'ലോറി',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'largest_accessible_vehicle',
    'table_name' => 'houses',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '53645109',
    'uname' => 'largest_accessible_vehicle',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '33',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '6',
  ),
  89774358 => 
  array (
    'title' => 'വീടിന് തൊട്ടടുത്തുള്ള പൊതു ഗതാഗത സൗകര്യം',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'ഇടുങ്ങിയ പൊതുവഴി',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'മുനിസിപ്പാലിറ്റി റോഡ',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'പി.ഡബ്ള്യു.ഡി റോഡ്',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'നാഷണൽ ഹൈവേ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'road_type_id',
    'table_name' => 'house_road_map',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '89774358',
    'uname' => 'road_type_id',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '34',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '6',
  ),
  27755791 => 
  array (
    'title' => 'അടുത്തുള്ള ഓട്ടോ സ്റ്റാൻദിലേക്ക്  എത്താൻ എടുക്കുന്ന സമയം',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'പെട്ടെന്ന് എത്താം',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'സമയം എടുക്കും',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'ഒരുപാട് സമയം എടുക്കും',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'nearest_auto_stand_access_time',
    'table_name' => 'houses',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '27755791',
    'uname' => 'nearest_auto_stand_access_time',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '35',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '6',
  ),
  65148853 => 
  array (
    'title' => 'നഗരസഭാ സേവനങ്ങളുടെ സാമീപ്യം',
    'answer_type' => '3',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'സ്ട്രീറ്റ് ലൈറ്റ്',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'കാണ',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'മാലിന്യ നിക്ഷേപ സ്ഥലം',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'അംഗനവാടി',
      ),
      4 => 
      array (
        'value' => '5',
        'title' => 'വയോ മിത്രാ ആശുപത്രി',
      ),
      5 => 
      array (
        'value' => '6',
        'title' => 'ലൈബ്രറി',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'public_utility_id',
    'table_name' => 'house_public_utility_proximity',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '65148853',
    'uname' => 'public_utility_id',
    'help_text' => NULL,
    'form_field' => '3',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '36',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '7',
  ),
  60631519 => 
  array (
    'title' => 'വീട്ടാവശ്യത്തിനുള്ള വെള്ളം എവിടുന്നു എടുക്കുന്നു',
    'answer_type' => '3',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'പൊതുടാപ്പ്',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'കിണർ',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'സ്വന്തം വാട്ടർ കണക്ഷൻ',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'കുഴൽക്കിണർ',
      ),
      4 => 
      array (
        'value' => '5',
        'title' => 'കുളം',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'house_water_source_id',
    'table_name' => 'house_water_source_map',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '60631519',
    'uname' => 'house_water_source_id',
    'help_text' => NULL,
    'form_field' => '3',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '37',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '8',
  ),
  35266201 => 
  array (
    'title' => 'വീട്ടിലെ കക്കൂസുകൾ സെപ്റ്റിക് ടാങ്കുമായി ബന്ധിപ്പിച്ചിട്ടുണ്ടോ',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'ഇല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'ഉണ്ട്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'connection_type_to_septic_tank',
    'table_name' => 'houses',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '35266201',
    'uname' => 'connection_type_to_septic_tank',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '38',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => '2',
    'group_id' => '8',
  ),
  37709361 => 
  array (
    'title' => 'കക്കൂസിന്റെ എണ്ണം',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'ഒന്ന്',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'രണ്ട്',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'മൂന്ന്',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'നാല്',
      ),
      4 => 
      array (
        'value' => '5',
        'title' => 'അഞ്ച്',
      ),
      5 => 
      array (
        'value' => '6',
        'title' => 'അഞ്ചിന് മുകളിൽ',
      ),
      6 => 
      array (
        'value' => '7',
        'title' => 'കക്കൂസ് ഇല്ലാ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'toilet_count',
    'table_name' => 'houses',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '37709361',
    'uname' => 'toilet_count',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '39',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '8',
  ),
  45970216 => 
  array (
    'title' => 'അഴുകിച്ചേരുന്ന ഖരമാലിന്യം എന്ത് ചെയ്യുന്നു',
    'answer_type' => '3',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'സ്വന്തം പറമ്പിൽ സംസ്കരിക്കുന്നു',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'മാലിന്യ സംസ്കരണകേന്ദ്രത്തിൽ കൊടുക്കുന്നു',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'biodegradable_solution_id',
    'table_name' => 'house_biodegradable_waste_management_solution_map',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '45970216',
    'uname' => 'biodegradable_solution_id',
    'help_text' => NULL,
    'form_field' => '3',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '40',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '8',
  ),
  22737254 => 
  array (
    'title' => 'അഴുകി ചേരാത്ത മാലിന്യങ്ങൾ എന്ത് ചെയ്യുന്നു',
    'answer_type' => '3',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'കത്തിച്ചു കളയുന്നു',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'സർക്കാരിന്റെ മാലിന്യ സംസ്കരണകേന്ദ്രത്തിൽ കൊടുക്കുന്നു',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'ആക്രിക്കാർക്ക് കൊടുക്കുന്നു',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'nonbiodegradable_solution_id',
    'table_name' => 'house_nonbiodegradable_waste_management_solution_map',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '22737254',
    'uname' => 'nonbiodegradable_solution_id',
    'help_text' => NULL,
    'form_field' => '3',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '41',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '8',
  ),
  83246896 => 
  array (
    'title' => 'വീട് വൈദ്യുതീകരിച്ചതാണോ?',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'അല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'അതെ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'is_electrified',
    'table_name' => 'houses',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '83246896',
    'uname' => 'is_electrified',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '42',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => '1',
    'group_id' => '9',
  ),
  54320877 => 
  array (
    'title' => 'പാചകത്തിന് ഉപയോഗിക്കുന്ന ഇന്ധനം ഏതൊക്കെ ?',
    'answer_type' => '3',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'വിറക്',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'മണ്ണെണ്ണ',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'എൽ .പി.ജി',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'വൈദ്യുതി',
      ),
      4 => 
      array (
        'value' => '5',
        'title' => 'ബയോഗ്യാസ്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'domestic_fuel_type_id',
    'table_name' => 'family_domestic_fuel_type_map',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '54320877',
    'uname' => 'domestic_fuel_type_id',
    'help_text' => NULL,
    'form_field' => '3',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '43',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '9',
  ),
  60852407 => 
  array (
    'title' => 'ഏതൊക്കെ അരുമ വളർത്തുമൃഗങ്ങൾ (Pets) ഉണ്ട്',
    'answer_type' => '3',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'നായ',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'പൂച്ച',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'അലങ്കാര മൽസ്യങ്ങൾ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'pet_id',
    'table_name' => 'family_pet_map',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '60852407',
    'uname' => 'pet_id',
    'help_text' => NULL,
    'form_field' => '3',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '44',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '10',
  ),
  37967486 => 
  array (
    'title' => 'വളർത്ത നായയ്‌ക്കു ലൈസൻസ് ഉണ്ടോ ?',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'ഇല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'ഉണ്ട്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'has_license',
    'table_name' => 'family_pet_map',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '37967486',
    'uname' => 'has_license',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '45',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => '2',
    'group_id' => '10',
  ),
  18367150 => 
  array (
    'title' => 'ഉപജീവനത്തിനായി ഉപയോഗിക്കുന്ന മൃഗങ്ങൾ (Live Stock )?',
    'answer_type' => '3',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'പശു',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'ആട്',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'കോഴി',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'താറാവ്',
      ),
      4 => 
      array (
        'value' => '5',
        'title' => 'മൽസ്യം',
      ),
      5 => 
      array (
        'value' => '6',
        'title' => 'മറ്റുള്ളവ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'livestock_id',
    'table_name' => 'family_livestock_map',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '18367150',
    'uname' => 'livestock_id',
    'help_text' => NULL,
    'form_field' => '3',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '46',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '10',
  ),
  41849760 => 
  array (
    'title' => 'കൃഷി ഉണ്ടോ ?',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'ഇല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'ഉണ്ട്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'has_agriculture',
    'table_name' => 'families',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '41849760',
    'uname' => 'has_agriculture',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '47',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => '2',
    'group_id' => '11',
  ),
  84900905 => 
  array (
    'title' => 'കൃഷി ഇടം ?',
    'answer_type' => '3',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'മട്ടുപ്പാവിൽ',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'പറമ്പിൽ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'agriculture_location_id',
    'table_name' => 'family_agriculture_location_map',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '84900905',
    'uname' => 'agriculture_location_id',
    'help_text' => NULL,
    'form_field' => '3',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '48',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '11',
  ),
  57676016 => 
  array (
    'title' => 'ഭലവൃക്ഷങ്ങൾ ഏതെല്ലാം ഉണ്ട് ?',
    'answer_type' => '3',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'മാവ്',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'പേര',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'പ്ലാവ്',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'മറ്റുള്ളവ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'fruit_tree_id',
    'table_name' => 'land_fruit_tree_map',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '57676016',
    'uname' => 'fruit_tree_id',
    'help_text' => NULL,
    'form_field' => '3',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '49',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '12',
  ),
  67062525 => 
  array (
    'title' => 'നാണ്യ വിളകൾ ഏതെല്ലാം ഉണ്ട് ?',
    'answer_type' => '3',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'തെങ്ങ്',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'കവുങ്ങ്',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'റബ്ബർ',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'കുരുമുളക്',
      ),
      4 => 
      array (
        'value' => '5',
        'title' => 'വാനില',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'cash_crop_id',
    'table_name' => 'land_cash_crop_map',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '67062525',
    'uname' => 'cash_crop_id',
    'help_text' => NULL,
    'form_field' => '3',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '50',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '12',
  ),
  51011910 => 
  array (
    'title' => 'ബാങ്ക് അക്കൗണ്ട്',
    'answer_type' => '3',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'സേവിoഗ്‌സ് അക്കൗണ്ട്',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'കറണ്ട് അക്കൗണ്ട്',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'പോസ്റ്റ് ഓഫീസ്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'bank_account_type_id',
    'table_name' => 'surveyee_user_bank_account_type_map',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '51011910',
    'uname' => 'bank_account_type_id',
    'help_text' => NULL,
    'form_field' => '3',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '51',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '13',
  ),
  85997543 => 
  array (
    'title' => 'ക്രെഡിറ്റ് / ഡെബിറ്റ് കാർഡ്',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'ഇല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'ഉണ്ട്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'has_credit_or_debit_card',
    'table_name' => 'surveyee_users',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '85997543',
    'uname' => 'has_credit_or_debit_card',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '52',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => '2',
    'group_id' => '13',
  ),
  62959357 => 
  array (
    'title' => 'ഇന്റർനെറ്റ് ബാംങ്കിംഗ്',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'ഇല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'ഉണ്ട്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'has_internet_banking',
    'table_name' => 'surveyee_users',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '62959357',
    'uname' => 'has_internet_banking',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '53',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => '2',
    'group_id' => '13',
  ),
  88993570 => 
  array (
    'title' => 'മൊബൈൽ ബാംങ്കിംഗ്',
    'answer_type' => '2',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => 0,
        'title' => 'ഇല്ലാ',
      ),
      1 => 
      array (
        'value' => 1,
        'title' => 'ഉണ്ട്',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'has_mobile_banking',
    'table_name' => 'surveyee_users',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '88993570',
    'uname' => 'has_mobile_banking',
    'help_text' => NULL,
    'form_field' => '2',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '54',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => '2',
    'group_id' => '13',
  ),
  79179632 => 
  array (
    'title' => 'നിക്ഷേപം',
    'answer_type' => '3',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'സേവിoഗ്‌സ്',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'ഫിക്സഡ് ',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'ഓഹരി',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'ചിട്ടി',
      ),
      4 => 
      array (
        'value' => '5',
        'title' => 'പോസ്റ്റ് ഓഫീസ്',
      ),
      5 => 
      array (
        'value' => '6',
        'title' => 'മറ്റുള്ളവ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'investment_type_id',
    'table_name' => 'surveyee_user_investment_type_map',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '79179632',
    'uname' => 'investment_type_id',
    'help_text' => NULL,
    'form_field' => '3',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '55',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '13',
  ),
  59340480 => 
  array (
    'title' => 'കടബാധ്യതയ്ക്ക് കാരണം',
    'answer_type' => '3',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'ഭവന',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'സ്വയംസംരംഭം',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'വിദ്യാഭ്യാസം',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'സ്വകാര്യ ആവശ്യങ്ങൾ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'loan_purpose_id',
    'table_name' => 'family_loan_purpose_map',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '59340480',
    'uname' => 'loan_purpose_id',
    'help_text' => NULL,
    'form_field' => '3',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '56',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '13',
  ),
  13549751 => 
  array (
    'title' => 'കടമെടുത്തിട്ടുള്ളത്',
    'answer_type' => '3',
    'answer_options' => 
    array (
      0 => 
      array (
        'value' => '1',
        'title' => 'ദേശസാൽകൃത ബാങ്കുകൾ',
      ),
      1 => 
      array (
        'value' => '2',
        'title' => 'സ്വകാര്യ ബാങ്കുകൾ',
      ),
      2 => 
      array (
        'value' => '3',
        'title' => 'അയൽക്കൂട്ടം',
      ),
      3 => 
      array (
        'value' => '4',
        'title' => 'സാമ്പത്തിക സ്ഥാപനങ്ങൾ',
      ),
      4 => 
      array (
        'value' => '5',
        'title' => 'സഹകരണ ബാങ്കുകൾ',
      ),
      5 => 
      array (
        'value' => '6',
        'title' => 'മറ്റുള്ളവ',
      ),
    ),
    'answer_non_selection_option' => 
    array (
    ),
    'field_name' => 'loan_source_id',
    'table_name' => 'family_loan_sources_map',
    'question_type' => '1',
    'questions' => 
    array (
    ),
    'default_value' => NULL,
    'ci_validation' => '',
    'ui_validation' => NULL,
    'question_template' => '',
    'multiple_answer_sets' => false,
    'uid' => '13549751',
    'uname' => 'loan_source_id',
    'help_text' => NULL,
    'form_field' => '3',
    'type' => '1',
    'is_multipliable' => '0',
    'is_required_question' => '0',
    'question_order' => '57',
    'collection_question_uid' => NULL,
    'template' => '',
    'true_false_variant' => NULL,
    'group_id' => '13',
  ),
);