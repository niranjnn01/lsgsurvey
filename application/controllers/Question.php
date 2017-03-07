<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Question extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->model('survey_model');

		$this->aErrorTypes = c('error_types');

		$this->aAnswerTypes = array(
			'single_value_text' => 1,
			'single_value_select' => 2,
			'multiple_value_checkbox' => 2,
		);

	}


	public function index() {

	}




/**
 * get the next question
 * @return [type] [description]
 */
	public function get($iTemporarySurveyNumber=0, $iQuestionNo=0) {

		$aQuestionData = array();
		$sJsonData = '{}';

		$iTotalQuestionCount = 50;
		$bProceed = TRUE;

		//$iQuestionNo = ltrim($sQuestion, 'q');
		// validate the input data
		//p($iQuestionNo);
		//echo "\n";
		$iQuestionNo = safeText($iQuestionNo, FALSE, 'get', TRUE);
		$iTemporarySurveyNumber = safeText($iTemporarySurveyNumber, FALSE, 'get', TRUE);

//p($iQuestionNo);
		$sError = '';


		// check conditions.
		if(! $iQuestionNo) {
			$bProceed = FALSE;
			$sError = 'No question no:';
		}

		if(
				$bProceed  &&
				(
					$iQuestionNo < 1
					||
					($iQuestionNo > $iTotalQuestionCount)
				)
			) {
				$bProceed = FALSE;
				$sError = 'shady question no:';
		}


/*
		if( ! $this->survey_model->isValidTemporarySurveyNumber($iTemporarySurveyNumber) ) {
			$bProceed = FALSE;
		}
*/


		// all ok. we can proceed
		if($bProceed) {

				$aQuestionsMasterData = array(
					1 => array(
						'title' => 'Name of Head of Family',
						'answer_type' => $this->aAnswerTypes['single_value_text'],
						'answer_options' => array(),
					),
					2 => array(
						'title' => 'Aadhaar Number',
						'answer_type' => $this->aAnswerTypes['single_value_text'],
						'answer_options' => array(),
					),
					3 => array(
						'title' => 'Election ID',
						'answer_type' => $this->aAnswerTypes['single_value_text'],
						'answer_options' => array(),
					),
				);


				if(isset($aQuestionsMasterData[$iQuestionNo])) {
					$aQuestionData = $aQuestionsMasterData[$iQuestionNo];

					$sJsonData = json_encode($this->_normalizeQuestion($aQuestionData));
				} else {
					$sError = 'question not found';
				}

		}

		if($sError) {
			$sJsonData = json_encode(array('error' => $sError));
		}



		$this->output->set_header('Content-type: application/json');
		$this->load->view('output', array('output' => $sJsonData));
	}



	function _normalizeQuestion($aQuestion) {


		$aNormalizedQuestionStructure = array(
			'title' => '',
			'answer_type' => $this->aAnswerTypes['single_value_text'],
			'answer_options' => array(),
			'field_name' => 'single_value_text',
			'end_of_section' => FALSE

		);

		return array_merge($aNormalizedQuestionStructure, $aQuestion);
	}

}

/* End of file account.php */
/* Location: ./application/controllers/account.php */
