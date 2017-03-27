<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Question extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->model('survey_model');

		$this->aErrorTypes = c('error_types');

		$this->load->config('question_config');

		$this->aAnswerTypes = $this->config->item('answer_types');

		$this->aAnswerTypesDetails = $this->config->item('answer_types_details');

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
		$questions_master_data	= $this->config->item('questions_master_data');
		$iTotalQuestionCount = count($questions_master_data);
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

			$aQuestionsMasterData = $this->config->item('questions_master_data');
	/*
				$aQuestionsMasterData = array(
					1 => array(
						'title' => 'Name of Head of Family',
						'answer_type' => $this->aAnswerTypes['single_value_text'],
						'answer_options' => array(),
					),
					2 => array(
						'title' => 'Nature of ownership of house',
						'answer_type' => $this->aAnswerTypes['single_value_radio'],
						'answer_options' => array(
							array(
								'value' => 1,
								'title' => 'Own House'
							),
							array(
								'value' => 2,
								'title' => 'Rental'
							),
						),
					),

				);
*/

				// Is this the last question ?
				//$bIsLastQuestion = $iQuestionNo == count($aQuestionsMasterData) ? TRUE : FALSE;
				$bIsLastQuestion = $this->survey_model->isLastQuestion($iQuestionNo);


				if(isset($aQuestionsMasterData[$iQuestionNo])) {

					//get the question data
					$aQuestionData = $aQuestionsMasterData[$iQuestionNo];

					// normalize the question data
					$aQuestionData = $this->_normalizeQuestion($aQuestionData);

					// add custom fields
					$aQuestionData['end_of_section'] = false;
					$aQuestionData['last_question'] = $bIsLastQuestion;

					// encode the data
					$sJsonData = json_encode($aQuestionData);

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
			'title' 					=> '',
			'answer_type' 		=> $aQuestion['answer_type'],
			'answer_options' 	=> array(),
			'field_name' 			=> $this->aAnswerTypesDetails[$aQuestion['answer_type']]['field_name'],
		);

		return array_merge($aNormalizedQuestionStructure, $aQuestion);
	}

}

/* End of file account.php */
/* Location: ./application/controllers/account.php */
