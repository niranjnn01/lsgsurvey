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
	 * Enables the admin user to order the questions in the survey
	 * @return [type] [description]
	 */
	public function sort_questions() {

		$this->mcontents['page_heading'] = $this->mcontents['page_title'] = 'Change the order in which the questions appear in survey';

		$this->authentication->is_admin_logged_in(true, 'user/login');


		$this->mcontents['aQuestions'] = $this->question_model->getQuestionsForSorting();


		$this->mcontents['load_js'][] = 'jquery/jquery-ui-1.12.1.custom/jquery-ui.min.js';
		$this->mcontents['load_js'][] = 'survey/sort_questions.js';

		loadAdminTemplate('question/sort_questions');
	}


	/**
	 *
	 * Update order of questions in survey.
	 * sorted questions are submitted to this controller.
	 * @return [type] [description]
	 */
	function update_order() {

		$aQuestionData = array();
		$sError = '';
		$aJsonData = array('error' => '');

		//log_message('error', $_POST['sorted_questions']);

		$aSortedQuestions = safeText('sorted_questions');

		//log_message('error', print_r($aSortedQuestions, true));

		// get the questions in the original order
		$aOriginalOrder_Questions = array();
		foreach($this->question_model->getQuestionsForSorting() AS $oItem) {
			$aOriginalOrder_Questions[] = $oItem->uid;
		}


		// verification - make sure we have only the data we really want.
		if( ! empty($aIntersect = array_diff($aSortedQuestions, $aOriginalOrder_Questions )) ) {
			$sError = 'Invalid data' . print_r($aIntersect, true);
		}

		// If there are no errors, update new order of questions to DB.
		if( ! $sError ) {

			//we want the the indexing to start from 1.
			array_unshift($aOriginalOrder_Questions, '');
			unset($aOriginalOrder_Questions[0]);

			//we want the the indexing to start from 1.
			array_unshift($aSortedQuestions, '');
			unset($aSortedQuestions[0]);


			$aOriginalOrder_Questions_flipped = array_flip($aOriginalOrder_Questions);

			//update the order as a single transaction.
			$this->db->trans_start();
			log_message('error', 'sorted questions count' . count($aSortedQuestions));
			log_message('error', 'original questions count' . count($aOriginalOrder_Questions_flipped));

			foreach($aSortedQuestions AS $iNewOrder => $iUid ) {


				$iOriginalOrder = $aOriginalOrder_Questions_flipped[$iUid];

				if($iOriginalOrder != $iNewOrder) {

					//log_message( 'error', $iUid . ' -> ' . $iNewOrder );

					$this->db->where('uid', $iUid);
					$this->db->set('question_order', $iNewOrder);
					$this->db->update('questions');

				}

			}
			$this->db->trans_complete();

			// update to config array, the updated order
			$this->question_model->generateConfig_QuestionsInOrder();


		} else {
			log_message( 'error', 'error msg : ' . $sError);
		}


		$aJsonData['error'] = $sError;
		$sJsonData = json_encode($aJsonData);

		$this->output->set_header('Content-type: application/json');
		$this->load->view('output', array('output' => $sJsonData));
	}

	/**
	 * get the next question
	 * @return [type] [description]
	 */
	public function get($iTemporarySurveyNumber=0, $iQuestionNo=0) {

		$aQuestionData = array();
		$sJsonData = '{}';

		// see if we are requested a specific question.
		$bIsSpecificQuestionRequested = safeText('specific', false, 'get') == 'true' ? TRUE : FALSE;

		$questions_master_data	= $this->question_model->getQuestionMasterData();

		$iTotalQuestionCount = count($questions_master_data);
		$bProceed = TRUE;

		// validate the input data
		$iTemporarySurveyNumber = safeText($iTemporarySurveyNumber, FALSE, 'get', TRUE);


		$sError = '';

		$sErrorMessage = '';

		// find the question number
		if($bIsSpecificQuestionRequested) {

			// fetch details of the given question number
			list($iQuestionNo, $iQuestionUid, $sErrorMessage) = $this->survey_model->getQuestionDetailsFromChronologicalOrderNumber($iQuestionNo);
			//log_message('error', 'Next specified question : question_number('.$iQuestionNo.') , question_uid('.$iQuestionUid.')');
		} else {

			// fetch details of the next question number in chronological order
			list($iQuestionNo, $iQuestionUid, $sErrorMessage) = $this->survey_model->getNextQuestionNumber($iTemporarySurveyNumber);
			//log_message('error', 'Next calculated question : question_number('.$iQuestionNo.') , question_uid('.$iQuestionUid.')');
		}


		if($iQuestionNo == FALSE || $sErrorMessage != '' || ! $iQuestionUid) {
			$bProceed = FALSE;
			$sErrorMessage = '';
		}


		// all ok. we can proceed
		if($bProceed) {

			$aQuestionsMasterData = $this->question_model->getQuestionMasterData();

			// Is this the last question ?
			$bIsLastQuestion = $this->survey_model->isLastQuestion($iQuestionNo);

			if(isset($aQuestionsMasterData[$iQuestionUid])) {

				//get the question data
				$aQuestionData = $aQuestionsMasterData[$iQuestionUid];

				// normalize the question data
				$this->load->model('question_model');
				$aQuestionData = $this->question_model->normalizeQuestion($aQuestionData);

				// add custom fields
				$aQuestionData['question_count']	= count($aQuestionsMasterData);
				$aQuestionData['question_no']		= $iQuestionNo;
				$aQuestionData['question_uid']		= $iQuestionUid;
				$aQuestionData['ui_validation']		= $aQuestionData['ui_validation'];

				$aQuestionData['end_of_section']	= false;
				$aQuestionData['last_question'] 	= $bIsLastQuestion;

				if( isset($aQuestionData['template']) && !empty($aQuestionData['template']) ) {

					$aQuestionData['question_form_body'] = $this->load->view($aQuestionData['template'], $aQuestionData, TRUE);
				}

				// If a question was alrady asnwered, then get the data that was populated.
				if( $bIsSpecificQuestionRequested ) {
					$aQuestionData['populated_answer'] = $this->survey_model->getPopulatedAnswer($iTemporarySurveyNumber, $iQuestionNo);
				}


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
