<?php
class Question_model extends CI_Model{

	function __construct(){
		parent::__construct();

		$this->load->config('question_config');
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

		$aNormalizedQuestionStructure = array(
			'title' 			=> '',
			'answer_type' 		=> $aQuestion['answer_type'],
			'answer_options' 	=> array(),
			'field_name' 		=> $aAnswerTypesDetails[$aQuestion['answer_type']]['field_name'],
			'table_name' => '',
			'question_type' => $aQuestionTypes['individual'],
			'questions' => array(),
			'default_value' => null,
		);

		return array_merge($aNormalizedQuestionStructure, $aQuestion);
	}


}
