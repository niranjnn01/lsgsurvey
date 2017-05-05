<?php
class Question_model extends CI_Model{

	function __construct(){
		parent::__construct();

		$this->load->config('question_config');
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
		$this->load->config('question_config');
		$aQuestionsMasterData = array_values($this->config->item('questions_master_data'));

		// adding an empty array. to unset later on.
		array_unshift($aQuestionsMasterData, array());

		// we unset it because we need the question numbers(array indexes) to be starting from 1 onwards.
		unset($aQuestionsMasterData[0]);

		return $aQuestionsMasterData;
	}

	function normalizeQuestion($aQuestion) {

		$aQuestionTypes = $this->config->item('question_types');
		$aAnswerTypesDetails = $this->config->item('answer_types_details');
		$aAnswerTypes = $this->config->item('answer_types');
//p($aQuestion);

if( ! isset($aQuestion['answer_type']) ) {
	p($aQuestion);exit;
}

		$aNormalizedQuestionStructure = array(

			'title' 								=> '',
			'answer_type' 					=> $aQuestion['answer_type'],
			'answer_options' 				=> array(),
			'field_name' 						=> $aAnswerTypesDetails[$aQuestion['answer_type']]['field_name'],
			'table_name' 						=> '',
			'question_type' 				=> $aQuestionTypes['individual'],
			'questions' 						=> array(),
			'default_value' 				=> null,

			'question_template' 		=> '',
			'multiple_answer_sets' 	=> false,
		);

		return array_merge($aNormalizedQuestionStructure, $aQuestion);
	}


}
