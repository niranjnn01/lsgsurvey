                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php
class QuestionTransfer_model extends CI_Model{

	function __construct(){

		parent::__construct();

    $this->load->config('question_config');

    $this->aQuestions = array();
    $this->aGroups = array();

    $this->iQuestionOrder = 1;

    $this->aQuestionTypes = $this->config->item('question_types');
    $this->aAnswerTypes = $this->config->item('answer_types');

		$this->aQuestionGroups = $this->config->item('question_groups');

    $this->aAnswerType_FormField_Map = array(

      $this->aAnswerTypes['single_value_text']      => 'text',
      $this->aAnswerTypes['single_value_radio']     => 'radio',
      $this->aAnswerTypes['multi_value_checkbox']  => 'checkbox',
      $this->aAnswerTypes['single_value_textarea']  => 'textarea',
      $this->aAnswerTypes['single_value_select']    => 'select',
    );

		$this->aFormFields = array(
			'text' => 1,
			'radio' => 2,
			'checkbox' => 3,
			'textarea' => 4,
			'select' => 5
		);


		$this->load->model('Common_model');
		$this->load->model('question_model');
		$this->load->dbforge();

		$this->aCurrentUid_TableName_Map = array(
			 3 => 'ans_option_genders',
			 6 => 'ans_option_reservation',
			 11 => 'ans_option_relationship_to_head_of_house',
			 12 => 'ans_option_educational_qualification',
			 13 => 'ans_option_employment_category',
			 22 => 'ans_option_house_area_ranges',
			 23 => 'ans_option_land_area_ranges',
			 24 => 'ans_option_house_types',
			 25 => 'ans_option_num_floors',
			 26 => 'ans_option_floor_types',
			 27 => 'ans_option_num_rooms',
			 29 => 'ans_option_religions',
			 32 => 'ans_option_ration_card_types',
			 40 => 'ans_option_ward_sabha_nonparticipation_reasons',
			 43 => 'ans_option_vehicle_types',
			 44 => 'ans_option_appliances',
			 48 => 'ans_option_largest_accessible_vehicle',
			 50 => 'ans_option_nearest_auto_stand_access_time',
			 51 => 'ans_option_public_utilities',
			 52 => 'ans_option_water_sources',
			 54 => 'ans_option_num_toilets',
			 55 => 'ans_option_biodegradable_waste_management_solutions',
			 56 => 'ans_option_nonbiodegradable_waste_management_solutions',
			 58 => 'ans_option_cooking_fuel_types',
			 59 => 'ans_option_pets',
			 61 => 'ans_option_livestocks',
			 64 => 'ans_option_fruit_trees',
			 65 => 'ans_option_cash_crops',
			 66 => 'ans_option_savings_account_types',
			 70 => 'ans_option_investment_types',
			 71 => 'ans_option_loan_purposes',
			 72 => 'ans_option_loan_sources',
		);

	}



	function transfer() {

    $aQuestionsMasterData =$this->question_model->getQuestionMasterData();

    foreach($aQuestionsMasterData AS $aQuestionDetails) {

      $aQuestionDetails = $this->question_model->normalizeQuestion($aQuestionDetails);
//p($aQuestionDetails);

      if($aQuestionDetails['question_type'] == $this->aQuestionTypes['group']) {

				$iCollectionQuestionUid = $this->createCollectionQuestion($aQuestionDetails);

				//echo "Question Type : ", $aQuestionDetails['question_type'], "<br/>";
				//echo "collection question uid : ", $iCollectionQuestionUid, "<br/>";
				$iGroupId = 0;

        foreach($aQuestionDetails['questions'] AS $aQuestionDetails2) {

          $aQuestionDetails2 = $this->question_model->normalizeQuestion($aQuestionDetails2);

					$this->iQuestionOrder++;

					//create all questions under this collection
					list($iQuestionUid, $iGroupId) = $this->processQuestion($aQuestionDetails2, TRUE, $iCollectionQuestionUid);
        }

				// add collection question to the group
				$this->aGroups[$aQuestionDetails['group_id']]['title'] = $this->aQuestionGroups[$aQuestionDetails['group_id']]['title'];
				$this->aGroups[$aQuestionDetails['group_id']]['question_uids'][] = $iCollectionQuestionUid;

      } elseif($aQuestionDetails['question_type'] == $this->aQuestionTypes['individual']) {

        $this->processQuestion($aQuestionDetails);
      }

      $this->iQuestionOrder++;
    }

		// create groups in DB
		foreach($this->aGroups AS $aGroupData) {

			$this->db->set('title', $aGroupData['title']);
			$this->db->insert('question_groups');

			$iGroupId = $this->db->insert_id();


			foreach($aGroupData['question_uids'] AS $iQuestionUid) {
				$this->db->set('question_uid', $iQuestionUid);
				$this->db->set('question_group_id', $iGroupId);
				$this->db->insert('question_question_group_map');
			}

		}

    return array($this->aQuestions, $this->aGroups);
  }



	// populate options start
	function populate_option_sources_new($aQuestionDetails, $iQuestionUid) {

		$aAnswerOptions = $aQuestionDetails['answer_options'];
		$sTableName = $this->aCurrentUid_TableName_Map[$aQuestionDetails['uid']];

		//populate the table "question_multiple_value_answer_option_source"
		$this->db->set('question_uid', $iQuestionUid);
		$this->db->set('table_name', $sTableName);
		$this->db->set('id_field_name', 'id');
		$this->db->set('title_field_name', 'title');
		$this->db->insert('question_multiple_value_answer_option_source');
	}



  function processQuestion($aQuestionDetails, $bIsCollection = FALSE, $iCollectionQuestionUid=NULL) {

    $aConfig = array(
      'table' => 'questions',
      'field' => 'uid'
    );

    $iQuestionUid = $this->Common_model->generateUniqueNumber($aConfig);

    $aQuestionData = array(
      'uid' 						=> $iQuestionUid,
      'title' 					=> $aQuestionDetails['title'],

      'answer_type' 		=> $aQuestionDetails['answer_type'],
      'form_field' 			=> $this->aFormFields[ $this->aAnswerType_FormField_Map[$aQuestionDetails['answer_type']] ],
      'type' 						=> $bIsCollection ? $this->aQuestionTypes['group'] : $this->aQuestionTypes['individual'],
      'is_multipliable' => $aQuestionDetails['multiple_answer_sets'] == TRUE ? 1 : 0,

      'field_name' 			=> $aQuestionDetails['field_name'],
      'table_name' 			=> $aQuestionDetails['table_name'],
      //'is_required_question' => 0,
      //'ci_validation' => '',
      //'group_id' => $aQuestionDetails['table_name'],
      'question_order' 	=> $this->iQuestionOrder,
			'template' 				=> $aQuestionDetails['question_template']
    );

    if( $bIsCollection ) {
      $aQuestionData['collection_question_uid'] = $iCollectionQuestionUid;
    }


		// insert into DB
		$this->db->insert('questions', $aQuestionData);


		// link question with option tables
		if( FALSE !== array_key_exists($aQuestionDetails['uid'], $this->aCurrentUid_TableName_Map) ) {

			$this->populate_option_sources_new($aQuestionDetails, $iQuestionUid);
		}



    $this->aQuestions[] = $aQuestionData;

    // group information
    if( ! isset($this->aGroups[$aQuestionDetails['group_id']]) ) {
      $this->aGroups[$aQuestionDetails['group_id']] = array();
    }
    $this->aGroups[$aQuestionDetails['group_id']]['question_uids'][] = $iQuestionUid;
		$this->aGroups[$aQuestionDetails['group_id']]['title'] = $this->aQuestionGroups[$aQuestionDetails['group_id']]['title'];

		return array($iQuestionUid, $aQuestionDetails['group_id']);
  }



function createCollectionQuestion($aQuestionDetails) {

	$aConfig = array(
		'table' => 'questions',
		'field' => 'uid'
	);

	$iQuestionUid = $this->Common_model->generateUniqueNumber($aConfig);


	$aData = array(
		'uid' 						=> $iQuestionUid,
		'title' 					=> $aQuestionDetails['title'],

		'answer_type' 		=> $aQuestionDetails['answer_type'],
		'form_field' 			=> $this->aFormFields[ $this->aAnswerType_FormField_Map[$aQuestionDetails['answer_type']] ],
		'type' 						=> $this->aQuestionTypes['group'],
		'is_multipliable' => $aQuestionDetails['multiple_answer_sets'] == TRUE ? 1 : 0,

		'field_name' 			=> $aQuestionDetails['field_name'],
		'table_name' 			=> $aQuestionDetails['table_name'],
		'question_order' 	=> $this->iQuestionOrder,
		'template' 				=> $aQuestionDetails['question_template']
	);

	$this->db->insert('questions', $aData);

	return $iQuestionUid;
}





	function createOptionTables() {


			foreach($this->aCurrentUid_TableName_Map AS $iCurrentUid => $sTableName) {
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
					),
					'description' => array(
									'type' => 'VARCHAR',
									'constraint' => 250,
									'default' => '',
									'null' => TRUE
					)
				);
				$this->dbforge->add_field($fields);
				$this->dbforge->add_key('id', TRUE);
				$attributes = array('ENGINE' => 'InnoDB');
				$this->dbforge->create_table($sTableName, false, $attributes);

//$iCount = 0;
				if($aQuestionDetails = $this->question_model->getQuestionDetailsByUID($iCurrentUid)) {
//$iCount++;
					//populate with data
					foreach($aQuestionDetails['answer_options'] AS $aOptionDetails) {

						$this->db->set('title', $aOptionDetails['title']);
						$this->db->insert($sTableName);
					}
				} else {
					p($iCurrentUid);
				}

			}



			$aCustomONes = array(
			array(
				'table_name' => 'ans_option_genders',
				'answer_options' => array(
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
				'table_name' => 'ans_option_reservation',
				'answer_options' => array(
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
				'table_name' => 'ans_option_relationship_to_head_of_house',
				'answer_options' => array(
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
				'table_name' => 'ans_option_educational_qualification',
				'answer_options' => array(
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
				'table_name' => 'ans_option_employment_category',
				'answer_options' => array(
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


		); // $aCustomONes - End


			foreach($aCustomONes AS $aQuestionDetails) {
				$sTableName = $aQuestionDetails['table_name'];
				foreach($aQuestionDetails['answer_options'] AS $aOptionDetails) {

					$this->db->set('title', $aOptionDetails['title']);
					$this->db->insert($sTableName);
				}
			}


	}


function deleteOptionTables() {
	foreach($this->aCurrentUid_TableName_Map AS $sTableName) {
		$this->dbforge->drop_table($sTableName,TRUE);
	}
}


function generateConfigArray() {


	$aMasterArray = [];
	//$sContent = '';


	// get questions
	$this->db->select('Q.*, Q.type question_type');
	$this->db->order_by('question_order', 'ASC');
	$aQuestions = $this->db->get('questions Q')->result();

	// make a list of questions for which we need to populate answer options
	$aQuestionsWithMultipleAnswerOptions = array();

	$question_multiple_value_answer_option_source = $this->db->get('question_multiple_value_answer_option_source')->result();
	foreach($question_multiple_value_answer_option_source AS $oRow_2){
		$aQuestionsWithMultipleAnswerOptions[$oRow_2->question_uid] = array(
			'id_field' => $oRow_2->id_field_name,
			'title_field' => $oRow_2->title_field_name,
			'table_name' => $oRow_2->table_name,
			'non_selection_value' => $oRow_2->non_selection_value,
			'non_selection_title' => $oRow_2->non_selection_title

		);
	}

	//get the question -> group mapping
	$aQuestionGroupMap_Data = $this->db->get('question_question_group_map')->result();
	$aQuestionGroupMap = array();

	foreach($aQuestionGroupMap_Data AS $oRow1){
		$aQuestionGroupMap[$oRow1->question_uid] = $oRow1->question_group_id;
	}

	$aFieldName_Qid_map = array();


	foreach($aQuestions AS & $oRow) {

		//p($aQuestionsWithMultipleAnswerOptions);exit;

		$aNonSelectionOption = array();

		// see if we need to fetch the answer options as well
		if( array_key_exists($oRow->uid, $aQuestionsWithMultipleAnswerOptions) ) {

			if( ! is_null($oRow->true_false_variant) ) {

				//populate answer option with the specified true false variant.

				$this->db->where('id', $oRow->true_false_variant);
				$oTrueFalseVariant = $this->db->get('ans_option_true_false_variances')->row();

				$aOptionsArray = array();
				if($oTrueFalseVariant){
					$aOptionsArray[] = array('value' => 0, 'title' => $oTrueFalseVariant->false_title);
					$aOptionsArray[] = array('value' => 1, 'title' => $oTrueFalseVariant->true_title);

				}

				$oRow->answer_options = $aOptionsArray;

			} else {
				$sSelect = $aQuestionsWithMultipleAnswerOptions[$oRow->uid]['id_field'] . ' id_field, ' .
												$aQuestionsWithMultipleAnswerOptions[$oRow->uid]['title_field'] .' title_field';

				$this->db->select($sSelect);
				$aOptions = $this->db->get($aQuestionsWithMultipleAnswerOptions[$oRow->uid]['table_name'])->result();



				$aOptionsArray = array();
				foreach($aOptions AS $oRow_3) {

					$aOptionsArray[] = array('value' => $oRow_3->id_field, 'title' => $oRow_3->title_field);
				}



				$oRow->answer_options = $aOptionsArray;
			}


			//append the non selection option to the question
			if($aQuestionsWithMultipleAnswerOptions[$oRow->uid]['non_selection_title']) {

				$aNonSelectionOption = array(
					'value' => $aQuestionsWithMultipleAnswerOptions[$oRow->uid]['non_selection_value'],
					'title' => $aQuestionsWithMultipleAnswerOptions[$oRow->uid]['non_selection_title']
				);
			}
			$oRow->answer_non_selection_option = $aNonSelectionOption;

		}


		//create a field_name => quiestion_uid array
		if($oRow->field_name) {
			$aFieldName_Qid_map[$oRow->field_name] = $oRow->uid;
		}



		if(isset($aQuestionGroupMap[$oRow->uid])) {
			$oRow->group_id = $aQuestionGroupMap[$oRow->uid];
		} else {
			$oRow->group_id = NULL;
		}

		//push to array
		$aMasterArray[$oRow->uid] = (array)$this->makeArray($oRow);
/*
		if($oRow->field_name == 'has_license') {
			p($oRow);
		}
		*/
	}



	//take a copy.
	$aMasterArray_raw = $aMasterArray;



	//group questions into collections
	foreach($aMasterArray AS $iMasterArrayKey => & $aQuestion) {

		if(isset($aQuestion['collection_question_uid']) && !empty($aQuestion['collection_question_uid'])) {


			//$iSearchKey = array_search($aQuestion['collection_question_uid'], array_column($aMasterArray, 'uid'));
			$iCollectionQuestionKey = $aQuestion['collection_question_uid'];
			//echo $iSearchKey , '<br/>';

			if(!isset($aMasterArray[$iCollectionQuestionKey]['questions'])) {
				$aMasterArray[$iCollectionQuestionKey]['questions'] = array();
			}
			$aMasterArray[$iCollectionQuestionKey]['questions'][] = $aQuestion;

			unset($aMasterArray[$iMasterArrayKey]);
		}
	}






	$sConfigFile = $this->config->item('base_path') . 'application/config/question_master_data_config.php';
	$sConfigFile_raw = $this->config->item('base_path') . 'application/config/question_master_data_config_raw.php';
	$field_name_quid_map_config_filename = $this->config->item('base_path') . 'application/config/field_name_quid_map_config.php';



/*
	echo '<pre>';
	var_export($aMasterArray);
	echo '</pre>';
*/


$sContent = '<?php  if ( ! defined(\'BASEPATH\')) exit("No direct script access allowed");'.

"

/*
|--------------------------------------------------------------------------
| PROGRAMATICALLY GENERATED FILE. DO NOT EDIT MANUALLY
|--------------------------------------------------------------------------
|
|
*/

".

'
$config[\'questions_master_data_new\'] =
';


	$sContent .= var_export($aMasterArray, true);
	$sContent .= ';';




	$fh = fopen($sConfigFile, 'w');
	if(fwrite($fh, $sContent)) {
		echo 'success';
	} else {
		echo 'could not write to file';
	}

	fclose($fh);


// make the raw config file, where all questions are listed without being grouped into collections

$sContent = '<?php  if ( ! defined(\'BASEPATH\')) exit("No direct script access allowed");'.

"

/*
|--------------------------------------------------------------------------
| PROGRAMATICALLY GENERATED FILE. DO NOT EDIT MANUALLY
|--------------------------------------------------------------------------
|
|
*/

".

'
$config[\'questions_master_data_raw_new\'] =
';


	$sContent .= var_export($aMasterArray_raw, true);
	$sContent .= ';';




	$fh = fopen($sConfigFile_raw, 'w');
	if(fwrite($fh, $sContent)) {
		echo 'success';
	} else {
		echo 'could not write to file';
	}

	fclose($fh);



	// make the config file with FieldName => Qid mapping

	$sContent = '<?php  if ( ! defined(\'BASEPATH\')) exit("No direct script access allowed");'.

	"

	/*
	|--------------------------------------------------------------------------
	| PROGRAMATICALLY GENERATED FILE. DO NOT EDIT MANUALLY
	|--------------------------------------------------------------------------
	|
	|
	*/

	".

	'
	$config[\'field_name_quid_map\'] =
	';


		$sContent .= var_export($aFieldName_Qid_map, true);
		$sContent .= ';';




		$fh = fopen($field_name_quid_map_config_filename, 'w');
		if(fwrite($fh, $sContent)) {
			echo 'success';
		} else {
			echo 'could not write to file';
		}

		fclose($fh);

}



function generateQuestionGroupConfigArray() {


	$aGroups = array();

	foreach($this->db->get('question_groups')->result() AS $oRow) {
		$aGroups[$oRow->id] = array(
			'title' => $oRow->title
		);
	}


	$sContent = '<?php  if ( ! defined(\'BASEPATH\')) exit("No direct script access allowed");'.

"

/*
|--------------------------------------------------------------------------
| PROGRAMATICALLY GENERATED FILE. DO NOT EDIT MANUALLY
|--------------------------------------------------------------------------
|
|
*/

".

'
$config[\'question_groups\'] =
';


		$sContent .= var_export($aGroups, true);
		$sContent .= ';';
		$sFilename = APPPATH . 'config/generated_question_group_config.php';
		$fh = fopen($sFilename, 'w');
		if(fwrite($fh, $sContent)) {
			echo 'success';
		} else {
			echo 'could not write to file';
		}

		fclose($fh);

}


function makeArray($oQuestion) {

	$aQuestion = (array)$oQuestion;

	$this->load->model('question_model');
//p($oQuestion);
//p($aQuestion);exit;

	return $this->question_model->normalizeQuestion($aQuestion);
}

}
