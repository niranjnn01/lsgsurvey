<?php
class Question_model extends CI_Model{

	function __construct(){
		parent::__construct();

		$this->load->config('question_config');
	}



	/**
	 * given the answer option of a question(in config), convert it to key=>value format
	 *
	 * @param  [type] $aAnswerOptions [description]
	 * @return [type]                 [description]
	 */
	function convertAnswerOptionsToKeyValueFormat($aAnswerOptions) {

		$aKeyValueFormat = array();

		foreach($aAnswerOptions AS $aData) {

			$aKeyValueFormat[$aData['value']] = $aData['title'];
		}

		return $aKeyValueFormat;
	}



	function getTrueFalseAnswer($iValue, $aQuestion) {

		$sAnswerText = '';
		if( ! is_null($iValue) ) {
				// null indicates a skipped question. so we will show blank. for the moment.
				$sAnswerText = $aQuestion['answer_options'][$iValue]['title'];
		}

		return $sAnswerText;
	}

	/**
	 *
	 * Get question by one of its attributes. First match will be returned
	 *
	 * @param  [type] $sValue         [description]
	 * @param  string $sSearchBy      [description]
	 * @param  string $sSpecificField [description]
	 * @return [type]                 [description]
	 */
	function getQuestionBy($sValue, $sSearchBy='field_name', $sSpecificField = ''){


		$return = array();

		$questions_master_data = $this->getQuestionMasterData_raw();

		foreach($questions_master_data AS $aQuestionData) {
			if($aQuestionData[$sSearchBy] == $sValue) {
				$return = $aQuestionData;
			}
		}

		if($sSpecificField) {
			$return = $return[$sSpecificField];
		}

		return $return;
	}


/**
 *
 * Get the answer options for a multi-answer type question
 * @return [type] [description]
 */
function getAnswerOptions($iQuestionUid, $bAttachNonSelectionOption = false) {

	$aOptions = array();

	$aQuestionsMasterData = $this->getQuestionMasterData_raw();
	$aQuestion = $aQuestionsMasterData[$iQuestionUid];

	$this->db->where('question_uid', $iQuestionUid);
	$oSource = $this->db->get('question_multiple_value_answer_option_source')->row();

	if($oSource) {

		if($oSource->table_name != 'ans_option_true_false_variances') {

			if($aOptionsData = $this->db->get($oSource->table_name)->result()) {

				$sIdFieldName = $oSource->id_field_name;
				$sTitleFieldName = $oSource->title_field_name;

				foreach($aOptionsData AS $oRow) {
					$aOptions[$oRow->$sIdFieldName] = $oRow->$sTitleFieldName;
				}

			}
		} else {

			$this->db->where('id', $aQuestion['true_false_variant']);
			if($oTrueFalseVarient = $this->db->get($oSource->table_name)->row()) {

				$aOptions[0] = $oTrueFalseVarient->false_title;
				$aOptions[1] = $oTrueFalseVarient->true_title;
			}
		}

		//attach the non-selection option
		if($bAttachNonSelectionOption) {

			// insme cases , we do not need / have a non-selection option.
			// so always check for non-selection-title
			if($oSource->non_selection_title) {

				$aOptions = array($oSource->non_selection_value => $oSource->non_selection_title) + $aOptions;
				/*
				array_unshift(
					$aOptions,
					array($oSource->non_selection_value => $oSource->non_selection_title)
				);
				*/
			}

		}
	}

	return $aOptions;
}

	/**
	 *
	 * get Questions For Sorting purposes
	 * @return [type] [description]
	 */
	function getQuestionsForSorting() {

		$this->db->select('uid, title, question_order');
		$this->db->where('collection_question_uid');
		$this->db->order_by('question_order', 'ASC');

		return $this->db->get('questions')->result();
	}



	/**
	 *
	 * Get question details, given the QUID
	 * @return [type] [description]
	 */
	function getQuestionDetailsByUID($sUid) {

		$aQuestionsMasterData = $this->getQuestionMasterData();
//p((array_column($aQuestionsMasterData, 'uid')));exit;
		$aData = array();
		$key = array_search($sUid, array_column($aQuestionsMasterData, 'uid'));
		if($key !== FALSE) {

			$key ++;
			$aData = $aQuestionsMasterData[$key];
		}
		if(!$aData) {
			p($sUid);
		}

		//normalize it
		$aData = $this->normalizeQuestion($aData);

		return $aData;
	}



	/**
	 *
	 * Get question details, given the order of appearance of question
	 * @return [type] [description]
	 */
	function getQuestionDetailsByOrder($iOrder) {

		--$iOrder;

		$aQuestionsMasterData = $this->getQuestionMasterData();

		$aData = array();

		if($iOrder >= 0 && $iOrder <= count($aQuestionsMasterData)) {
			$aSlice = array_slice($aQuestionsMasterData, $iOrder, 1);
			$aData = $aSlice[0];
		}

//p($aData);
		//normalize it
		$aData = $this->normalizeQuestion($aData);

		return $aData;
	}



	/**
	 *
	 * used for those types of input fields which contain multiple options
	 *
	 * @param  [type] $sUid [description]
	 * @return [type]       [description]
	 */
	function prepareAnswerOptionsFor_FormElements($aQuestionDetails) {

		//$sFromElement = '';
		$aData = array();


		$aAnswerTypes = $this->config->item('answer_types');


		if( $aQuestionDetails ) {
//p($aQuestionDetails);exit;

			if(
				$aQuestionDetails['answer_type'] == $aAnswerTypes['single_value_radio']
				|| $aQuestionDetails['answer_type'] == $aAnswerTypes['single_value_select']
				|| $aQuestionDetails['answer_type'] == $aAnswerTypes['multi_value_checkbox']
			) {

				foreach($aQuestionDetails['answer_options'] AS $aAnswerOption) {
					$aData[$aAnswerOption['value']] = $aAnswerOption['title'];
				}

			}
		}


		return $aData;
	}



	function constructFormRow_forSearch($aQuestionDetails) {

		$sFormRow = '';

		$sFormElementName = strtolower($aQuestionDetails['field_name']);

		$sFormRow .= '<h5><b>'. $aQuestionDetails['title'] .'</b></h5>';

		$sOutterStart = '';
		$sOutterEnd = '';

		$aAnswerTypes = $this->config->item('answer_types');

			if( $aQuestionDetails['answer_type'] == $aAnswerTypes['single_value_radio'] ) {
				$sOutterStart = '<div class="radio">';
				$sOutterEnd = '</div>';
			}
			if( $aQuestionDetails['answer_type'] == $aAnswerTypes['multi_value_checkbox'] ) {
				$sOutterStart = '<div class="checkbox">';
				$sOutterEnd = '</div>';
			}
			if( $aQuestionDetails['answer_type'] == $aAnswerTypes['single_value_text'] ) {
				$sOutterStart = '<div class="form-group">';
				$sOutterEnd = '</div>';
			}


			$sFormRow .= $sOutterStart;

			$aAnswerOptions = $aQuestionDetails['answer_options'];

				if( $aQuestionDetails['answer_type'] == $aAnswerTypes['single_value_radio'] ) {

					$aAnswerOptions = $this->prepareAnswerOptionsFor_FormElements($aQuestionDetails);
					foreach($aAnswerOptions AS $iValue => $sTitle) {

						$sFormRow .= '<label class="radio">';
							$sFormRow .= '<input type="radio" name="'. $sFormElementName .'" value="'.$iValue.'"/>'. $sTitle;
						$sFormRow .= '</label>';
					}
				}

				if( $aQuestionDetails['answer_type'] == $aAnswerTypes['multi_value_checkbox'] ) {

					$aAnswerOptions = $this->prepareAnswerOptionsFor_FormElements($aQuestionDetails);
					foreach($aAnswerOptions AS $iValue => $sTitle) {

						$sFormRow .= '<label class="checkbox">';
							$sFormRow .= '<input type="checkbox" name="'. $sFormElementName .'[]" value="'.$iValue.'"/>'. $sTitle;
						$sFormRow .= '</label>';
					}
				}


				if( $aQuestionDetails['answer_type'] == $aAnswerTypes['single_value_select'] ) {

					$aAnswerOptions = $this->prepareAnswerOptionsFor_FormElements($aQuestionDetails);
					$sFormRow .= '<select name="'. $sFormElementName .'" class="form-control">';
					foreach($aAnswerOptions AS $iValue => $sTitle) {
						$sFormRow .= '<option value="'.$iValue.'">';
							$sFormRow .= $sTitle;
						$sFormRow .= '</option>';
					}
					$sFormRow .= '</select>';
				}

			$sFormRow .= $sOutterEnd;


		return $sFormRow;
	}

	/**
	 *
	 * Temporary fix. until question number (question order) is handled by the DB,
	 * and there is proper logic implemented for dynamically determining what the
	 * next question is.
	 *
	 * @return [type] [description]
	 */
	function getQuestionMasterData() {


		// fetch the questions master data.
		$this->load->config('question_master_data_config');
		//$aQuestionsMasterData = array_values($this->config->item('questions_master_data_new'));
		$aQuestionsMasterData = $this->config->item('questions_master_data_new');
//p($aQuestionsMasterData);
		// adding an empty array. to unset later on.
		//array_unshift($aQuestionsMasterData, array());

		// we unset it because we need the question numbers(array indexes) to be starting from 1 onwards.
		//unset($aQuestionsMasterData[0]);

		return $aQuestionsMasterData;
	}

	/**
	 *
	 * Temporary fix. until question number (question order) is handled by the DB,
	 * and there is proper logic implemented for dynamically determining what the
	 * next question is.
	 *
	 * the raw listing of questions. without grouping them into collections
	 * @return [type] [description]
	 */
	function getQuestionMasterData_raw() {


		// fetch the raw questions master data.
		$this->load->config('question_master_data_config_raw');

		return $this->config->item('questions_master_data_raw_new');
	}
	function normalizeQuestion($aQuestion) {

		$aQuestionTypes = $this->config->item('question_types');
		$aAnswerTypesDetails = $this->config->item('answer_types_details');
		$aAnswerTypes = $this->config->item('answer_types');



		$aNormalizedQuestionStructure = array(

			'title' 											=> '',
			'answer_type' 								=> $aQuestion['answer_type'],
			'answer_options' 							=> array(),
			'answer_non_selection_option' => array(),
			'field_name' 									=> $aAnswerTypesDetails[$aQuestion['answer_type']]['field_name'],
			'table_name' 									=> '',
			'question_type' 							=> $aQuestionTypes['individual'],
			'questions' 									=> array(),
			'default_value' 							=> null,

			'question_template' 					=> '',
			'multiple_answer_sets' 				=> false,
		);

		return array_merge($aNormalizedQuestionStructure, $aQuestion);
	}

	/**
	 *
	 * generate questions in order and save to config. for quick access.
	 *
	 * @return [type] [description]
	 */
	function generateConfig_QuestionsInOrder() {


			$aQuestions = $this->getQuestionsForSorting();

		 	// questions in order
			$aQuestionsInOrder = array();
			foreach($aQuestions AS $iKey => $oItem) {
				$aQuestionsInOrder[++$iKey] = (int)$oItem->uid;
			}

			$sContent = '<?php  if ( ! defined(\'BASEPATH\')) exit("No direct script access allowed");'.

			"

			/*
			|--------------------------------------------------------------------------
			| PROGRAMATICALLY GENERATED FILE. DO NOT EDIT MANUALLY
			|
			| The order of questions is calculated once and stored in array. so that
			| queries for the same information can be avoided.
			|--------------------------------------------------------------------------
			|
			|
			*/

			";

			$sContent .= '$config[\'questions_in_order\'] = ';
			$sContent .= var_export($aQuestionsInOrder, true);
			$sContent .= ';';


			$sConfigFile = $this->config->item('base_path') . 'application/config/question_in_order_config.php';
				$fh = fopen($sConfigFile, 'w');
				if(fwrite($fh, $sContent)) {
					echo 'success';
				} else {
					echo 'could not write to file';
				}

				fclose($fh);
	}
}
