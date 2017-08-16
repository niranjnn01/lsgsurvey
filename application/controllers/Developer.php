<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Developer extends CI_Controller {


	function __construct() {

		parent::__construct();


		$this->load->model('common_model');
	}

	function index() {

		$this->db->order_by('created_on', 'desc');
		$this->mcontents['aTemporarySurveys'] = $this->db->get('temporary_survey')->result();

		$this->mcontents['aLinks'] = array(
			array(
				'uri' => 'preview_data/',
				'title' => 'Temporary Survey -> view raw data',
			),
		);
		loadTemplate('developer/index');
	}

	function generate_family_template() {

		$this->load->model('display_model');

		$this->display_model->generateQuestionTemplate_FamilyDetails();
	}


function create_questions___renamed () {

	$this->load->config('question_config');

	$aAnswerTypes = $this->config->item('answer_types');
	$aQuestionTypes = $this->config->item('question_types');




	$aQuestionToMake_MinInfo = array(
		 array(
			'to_merge' =>array(
				'form_field' => '1',
				'table_name' => 'surveyee_users',
				'field_name' => 'date_of_birth',
				'title' => 'ജനന തീയതി',
				'answer_type' => '1',
				'true_false_variant' => NULL,
			),
			'group_id' => 1,
		),
		array(
			'to_merge' =>array(
				'true_false_variant' => NULL,
				'form_field' => 5,
				'table_name' => 'surveyee_users',
				'field_name' => 'marital_status',
				'title' => 'വിവാഹാവസ്ഥ',
				'answer_type' => 5,
			),
			'group_id' => 1,
			'answer_options' => array(
				1 => 'കല്യാണം കഴിച്ചിട്ടില്ലാ',
				2 => 'കല്യാണം കഴിച്ചു',
				3 => 'ഡിവോഴ്സ് ചെയ്തു',
				4 => 'പുനർ വിവാഹം ചെയ്തു',
			),
			'ans_option_source_table_name' => 'ans_option_marital_status',
			'non_selection_title' => ' -- തിരഞ്ഞെടുക്കു -- '
		),
		array(
			'to_merge' =>array(
				'true_false_variant' => 2,
				'form_field' => 5,
				'table_name' => 'surveyee_users',
				'field_name' => 'has_passport',
				'title' => 'പാസ്പോര്ട്ട് ഉണ്ടോ ?',
				'answer_type' => 5,
			),
			'group_id' => 1,

		),
		array(
			'to_merge' =>array(
				'true_false_variant' => 2,
				'form_field' => 5,
				'table_name' => 'surveyee_users',
				'field_name' => 'has_bank_account',
				'title' => 'ബാങ്ക് അക്കൗണ്ട് ഉണ്ടോ ?',
				'answer_type' => 5,
			),
			'group_id' => 1,
		),
		array(
			'to_merge' =>array(
				'true_false_variant' => 2,
				'form_field' => 5,
				'table_name' => 'surveyee_users',
				'field_name' => 'has_driving_license',
				'title' => 'ഡ്രൈവിങ് ലൈസൻസ് ഉണ്ടോ ?',
				'answer_type' => 5,
			),
			'group_id' => 1,
		),
		array(
			'to_merge' =>array(
				'true_false_variant' => NULL,
				'form_field' => 5,
				'table_name' => 'surveyee_users',
				'field_name' => 'blood_group',
				'title' => 'ബ്ലഡ് ഗ്രൂപ്പ്',
				'answer_type' => 5,
			),
			'group_id' => 1,
			'answer_options' => array(
				1 => 'A +ve',
				2 => 'A -ve',
				3 => 'B +ve',
				4 => 'B -ve',
				5 => 'AB +ve',
				6 => 'AB -ve',
				7 => 'O +ve',
				8 => 'O -ve',
			),
			'ans_option_source_table_name' => 'ans_option_blood_groups',
			'non_selection_title' => ''
		),
		array(
			'to_merge' =>array(
				'true_false_variant' => NULL,
				'form_field' => 3,
				'table_name' => 'surveyee_users',
				'field_name' => 'pension_type',
				'title' => 'ഏതൊക്കെ പെൻഷൻ ഉണ്ട് ?',
				'answer_type' => 3,
			),
			'group_id' => 1,
			'answer_options' => array(
				1 => 'ഗവണ്മെന്റ് പെൻഷൻ',
				2 => 'മുതിർന്ന പൗരനുള്ള പെൻഷൻ',
			),
			'ans_option_source_table_name' => 'ans_option_pension_types',
			'non_selection_title' => ''
		),
		array(
			'to_merge' =>array(
				'true_false_variant' => NULL,
				'form_field' => 3,
				'table_name' => 'surveyee_users',
				'field_name' => 'insurance_type',
				'title' => 'ഏതൊക്കെ ഇൻഷുറൻസ് പരിരക്ഷ ഉണ്ട് ?',
				'answer_type' => 3,
			),
			'group_id' => 1,
			'answer_options' => array(
				1 => 'ലൈഫ് ഇൻഷുറൻസ്',
				2 => 'മെഡിക്കൽ ഇൻഷുറൻസ്',
			),
			'ans_option_source_table_name' => 'ans_option_insurance_types',
			'non_selection_title' => ''
		),
	);

	foreach($aQuestionToMake_MinInfo AS $iMainKey => $aMinInfo) {

/*
		if($iMainKey !== 7) {
			echo 'continueing ... ', $iMainKey, "<br/>";
			continue;
		}
*/
		$aData = $aMinInfo['to_merge'];


    $aConfig = array(
      'table' => 'questions',
      'field' => 'uid'
    );

    $iQuestionUid = $this->common_model->generateUniqueNumber($aConfig);

		$aData['uid'] = $iQuestionUid;
		$aData['type'] = 1;
		$aData['help_text'] = NULL;
		$aData['is_multipliable'] = 0;
		$aData['is_required_question'] = 0;
		$aData['ci_validation'] = '';
		$aData['question_order'] = 1;
		$aData['collection_question_uid'] = 15207088;
		$aData['template'] = null;

		//p(var_dump($aData));
		$this->db->insert('questions', $aData);

		// make relationship with groups
		$aData_local = array(
			'question_uid' => $iQuestionUid,
			'question_group_id' => $aMinInfo['group_id'],
		);
		//p($aData_local);
		$this->db->insert('question_question_group_map', $aData_local);


		// if true false type question, make entry to the question_multiple_value_answer_option_source table
		if( ! is_null($aData['true_false_variant']) ) {

			$aData_local = array(
				'question_uid' => $iQuestionUid,
				'table_name' => 'ans_option_true_false_variances',
				'id_field_name' => '',
				'title_field_name' => '',
				'non_selection_value' => 0,
				'non_selection_title' => ''
			);
			//p($aData_local);
			$this->db->insert('question_multiple_value_answer_option_source', $aData_local);
		}

		if( ! empty($aMinInfo['answer_options']) && is_null($aData['true_false_variant'])) {

			// populate multiple option source mentioned
			$aData_local = array(
				'question_uid' => $iQuestionUid,
				'table_name' => $aMinInfo['ans_option_source_table_name'],
				'id_field_name' => 'id',
				'title_field_name' => 'title',
				'non_selection_value' => 0,
				'non_selection_title' => $aMinInfo['non_selection_title']
			);
			//p($aData_local);
			$this->db->insert('question_multiple_value_answer_option_source', $aData_local);


			// populate the multiple options
			//first create the table
			$fields = array(
				'id' => array(
								'type' => 'INT',
								'constraint' => 9,
								'unsigned' => false,
								'auto_increment' => TRUE
				),
				'title' => array(
								'type' => 'VARCHAR',
								'constraint' => 75,
				)
			);
			$this->load->dbforge();
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			$attributes = array('ENGINE' => 'InnoDB');
			$this->dbforge->create_table($aMinInfo['ans_option_source_table_name'], true, $attributes);


			foreach( $aMinInfo['answer_options'] AS $iId => $sTitle ) {

				$aData_local = array(
					'id' => $iId,
					'title' => $sTitle
				);
				//p($aData_local);
				$this->db->insert($aMinInfo['ans_option_source_table_name'], $aData_local);
			}
		}

	}

}




	function generate_template() {

		$this->load->model('display_model');

		$this->display_model->generateSurveyResultTemplate();
	}


	function get_by($sFieldName = '') {

		$this->load->model('question_model');

		p($this->question_model->getQuestionBy($sFieldName, 'field_name')	);
	}


function options($iQuid = 0) {
	$this->load->model('question_model');

	p($this->question_model->getAnswerOptions($iQuid));
}


function slice() {
	$aArray = array(
		99292 => array(
			'name' => 'fruits',
			'options' => array(
				1 => 'apple',
				2 => 'pinapple'
			),
		),
		47652 => array(
			'name' => 'Vegetables',
			'options' => array(
				1 => 'Brinjal',
				2 => 'Ladies finger'
			),
		),
		78652 => array(
			'name' => 'Pets',
			'options' => array(
				1 => 'Dogs',
				2 => 'Ducks',
				3 => 'Fishes'
			),
		),
	);

	$aData = array();
	$iOrder = 0;
	--$iOrder;
	if($iOrder >= 0 && $iOrder <= count($aArray)) {
		$aData = array_slice($aArray, $iOrder, 1);
		p('Inside');
	}

	p($aData);

}

/*
	function create_option_tables() {

		$this->load->model('QuestionTransfer_model');

		$this->QuestionTransfer_model->deleteOptionTables();

		$this->QuestionTransfer_model->createOptionTables();
	}


	function delete_option_tables() {

		$this->load->model('QuestionTransfer_model');
		$this->QuestionTransfer_model->deleteOptionTables();
	}
*/
/*
	function populate_questions_from_config() {


		$this->db->truncate('questions');
		$this->db->truncate('question_groups');
		$this->db->truncate('question_question_group_map');

		$this->db->truncate('question_multiple_value_answer_option_source');


		$this->load->model('QuestionTransfer_model');

		list($aQuestions, $aGroups) = $this->QuestionTransfer_model->transfer();

		$this->mcontents['aGroups'] = $aGroups;
		$this->mcontents['aQuestions'] = $aQuestions;

		loadTemplate('developer/transfer');
	}
*/

	/**
	 *
	 * given the temporary id of a survey, we can do the last step.
	 * ie, creation of the survey.
	 * @return [type] [description]
	 */
	function complete_survey($iTemporarySurveyNumber=0) {

		if($iTemporarySurveyNumber) {

			list($iSurveyId, $aErrorMessages) = $this->survey_model->createSurvey($iTemporarySurveyNumber);

			if($aErrorMessages) {

				p($aErrorMessages);

			} else {
				echo "success";
			}

		}

	}


	function generate_config_array() {

		$this->load->model('QuestionTransfer_model');
		$this->QuestionTransfer_model->generateConfigArray();

		$this->load->model('question_model');
		$this->question_model->generateConfig_QuestionsInOrder();
	}

	function index_old() {
		p(s('ACCOUNT_NO'));
		$this->load->model('survey_model');
		$oTemporarySurvey = $this->survey_model->getCurrentTemporarySurvey(s('ACCOUNT_NO'));
		p($this->db->last_query());
		p($oTemporarySurvey);
	}


	function complete_survey__to_delete() {


				$bProceed = TRUE;

				$sErrorMessage = '';
				$aJsonData = array('error' => '');

				// if all ok, then proceed to save Survey Data.
				if($bProceed) {


					$iTemporarySurveyNumber = 1;

					$this->load->model('survey_model');

					$aJsonData['survey_id'] = $this->survey_model->createSurvey($iTemporarySurveyNumber);

					if($sErrorMessage) {
						$aJsonData['error'] = $sErrorMessage;
					} else {
						$aJsonData['success'] = '1';
					}

				}




	}


	function preview_data($iTemporarySurveyId) {

		$this->db->where('id', $iTemporarySurveyId);
		$this->mcontents['oRow'] = $this->db->get('temporary_survey')->row();

		loadTemplate('survey/preview_data');
		//p( unserialize($oRow->general_data) );
	}

	function sync_demo_data() {
		$this->db->where('pushed_to_main', 0);
		$this->db->where('id', 17);
		foreach($this->db->get('temporary_survey')->result() AS $oItem) {
			$this->survey_model->createSurvey($oItem->id);
		}
	}


function question_master_data() {


	p($this->question_model->getQuestionMasterData());
}



	function show_log() {

		$sFilePath = APPPATH . '/logs/';

		$sFileName = 'log-' . date('Y-m-d') . '.php';
		$sText = file_get_contents($sFilePath . $sFileName);
		$sText = str_replace("\n","<br/>",$sText);
		echo $sText;
	}


	function purge_log(  ) {

		$sFileName = 'log-' . date('Y-m-d') . '.php';
		purge_log($sFileName);
		redirect('developer/show_log');
	}

	function truncate_all_data_________use_only_when_neeeded() {

		$aTables = array(

			'families',
			'family_agriculture_location_map',
			'family_appliance_map',
			'family_domestic_fuel_type_map',
			'family_house_map',
			'family_livestock_map',
			'family_loan_purpose_map',
			'family_loan_sources_map',
			'family_pet_map',
			'family_residence_history_map',
			'family_vehicle_type_map',

			'houses',
			'house_biodegradable_waste_management_solution_map',
			'house_floor_type_map',
			'house_house_type_map',
			'house_nonbiodegradable_waste_management_solution_map',
			'house_public_utility_proximity',
			'house_road_map',
			'house_tax',
			'house_water_source_map',

			'lands',
			'land_cash_crop_map',
			'land_fruit_tree_map',
			'land_house_map',

			'surveyee_users',
			'surveyee_user_bank_account_type_map',
			'surveyee_user_family_map',
			'surveyee_user_investment_type_map',
			'surveyee_user_payment_type_map',

			'surveys',

			'temporary_survey',

			'ward_sabha_participation'
		);

		foreach($aTables AS $sTableName) {
			$this->db->truncate($sTableName);
		}

	}

}

/* End of file developer.php */
/* Location: ./application/controllers/developer.php */
