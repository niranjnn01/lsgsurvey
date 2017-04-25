<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Question extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->model('survey_model');
		$this->load->model('question_model');

		$this->aErrorTypes = c('error_types');

		$this->load->config('question_config');

		$this->aAnswerTypes = $this->config->item('answer_types');

		$this->aAnswerTypesDetails = $this->config->item('answer_types_details');

		$this->mcontents['aQuestionTypes'] = $this->config->item('question_types');

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


		$questions_master_data	= $this->question_model->getQuestionMasterData();

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

			$aQuestionsMasterData = $this->question_model->getQuestionMasterData();

			/*
			$oTemporarySurvey = $this->survey_model->getCurrentTemporarySurvey();

			$iTemporarySurveyNumber = $oTemporarySurvey->id;
			$this->db->where('id', $iTemporarySurveyNumber);

			if($oSurveyData = $this->db->get('temporary_survey')->row()) {

				$aRawData	= unserialize($oSurveyData->raw_data);
				echo '<pre>';
				print_r($aRawData[$aQuestionsMasterData[$iQuestionNo]['table_name']][$aQuestionsMasterData[$iQuestionNo]['field_name']]);
				exit;
			}

			*/
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
					$this->load->model('question_model');
					$aQuestionData = $this->question_model->normalizeQuestion($aQuestionData);

					// add custom fields
					$aQuestionData['question_count']	= count($aQuestionsMasterData);
					$aQuestionData['question_no']		= $iQuestionNo;
					$aQuestionData['end_of_section']	= false;
					$aQuestionData['last_question'] 	= $bIsLastQuestion;

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





}

/* End of file account.php */
/* Location: ./application/controllers/account.php */
