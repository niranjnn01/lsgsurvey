<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Survey extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->config('survey_config');
		$this->load->model('survey_model');

		$this->load->model('question_model');

		$this->aErrorTypes = c('error_types');

	}


	function view_template() {

		loadTemplate('survey/tpl_view');
	}


	/**
	 * Load the survey form
	 *
	 */
	public function index() {

		$this->authentication->is_user_logged_in(true, 'user/login');


		$this->load->config('question_config');
//exit('locked');
		// Initialize stuff
		$this->mcontents['iCurrentTemporarySurveyNumber']	= 0;
		$this->mcontents['iNextQuestion']	= 1;
		$this->mcontents['iLastProcessedQuestion']	= 0;
		$this->mcontents['bIsLastQuestion']	= FALSE;
		$this->mcontents['sQuestionUname']	= '';
		$this->mcontents['iTotalNumberOfQuestions']	= 0;

		// this has to be moved to another place where the logged in user
		// chooses to start a new survey

		$oCurrentSurvey = $this->survey_model->getCurrentSurvey( s('ACCOUNT_NO') );
/*
		p($this->db->last_query());
		p($oCurrentSurvey);
		exit;
	*/
	$this->mcontents['aSurveyStatus'] = $this->config->item('survey_status');

	$aQuestionsMasterData = $this->question_model->getQuestionMasterData();

	$this->mcontents['iTotalNumberOfQuestions'] = count($aQuestionsMasterData);

		if( $oCurrentSurvey ) {

			if( count($aQuestionsMasterData) == $oCurrentSurvey->last_processed_question ) {
				$this->mcontents['iSurveyStatus'] = $this->mcontents['aSurveyStatus']['processed_last_question'];
			} else {
				$this->mcontents['iSurveyStatus'] = $this->mcontents['aSurveyStatus']['in_progress'];
			}

			$this->mcontents['iCurrentTemporarySurveyNumber']	= $oCurrentSurvey->id;
			$this->mcontents['iNextQuestion']	= $oCurrentSurvey->last_processed_question + 1;
			$this->mcontents['iLastProcessedQuestion']	= $oCurrentSurvey->last_processed_question;
			$this->mcontents['bIsLastQuestion']	= $this->survey_model->isLastQuestion($this->mcontents['iNextQuestion']);
			//$this->mcontents['sQuestionUname']	= $oCurrentSurvey->uname;
//exit;

		} else {

			$this->mcontents['iSurveyStatus'] = $this->mcontents['aSurveyStatus']['in_progress'];


			$oNewTemporarySurveyId = $this->survey_model->createTemporarySurvey();

			$this->survey_model->setTemporarySurveyAsCurrent($oNewTemporarySurveyId, s('ACCOUNT_NO'));

			$this->mcontents['iCurrentTemporarySurveyNumber']	= $oNewTemporarySurveyId;
			$this->mcontents['iNextQuestion']	= 1;
			$this->mcontents['iLastProcessedQuestion']	= 0;
			$this->mcontents['bIsLastQuestion']	= $this->survey_model->isLastQuestion($this->mcontents['iNextQuestion']);
		}

		//which menu item is currently active?
		$this->mcontents['menu_active']	= 'survey_new';


		$this->load->config('question_config');
		$this->mcontents['question_groups'] = json_encode($this->config->item('question_groups'));
		//p($this->mcontents['question_groups']);
		$this->mcontents['load_js']['data']['question_groups'] = json_encode($this->config->item('question_groups'));


		//load datepicker
		$this->mcontents['load_js'][] = 'jquery/jquery-ui.min-datepicker.js';
		$this->mcontents['load_common_css'][] = 'jquery/jquery-ui.min.css';
		$this->mcontents['load_common_css'][] = 'jquery/jquery-ui.structure.min.css';
		//$this->mcontents['load_css'][] = 'jquery/jquery-ui.structure.min.css';


		// load the js files that will manipulate this page.
		$this->mcontents['load_js'][] = 'survey/survey_manager_new.js';
		$this->mcontents['load_js'][] = 'survey/survey_manager_construct_QA.js';
		$this->mcontents['load_js'][] = 'survey/survey_manager_handle_answer.js';
		$this->mcontents['load_js'][] = 'survey/survey_manager_event_handlers.js';
		$this->mcontents['load_js'][] = 'survey/survey_manager_server_error_handler.js';



		$this->mcontents['load_js'][] = "jquery/jquery.validate.min.1.17.0.js";
		$this->mcontents['load_js'][] = 'survey/survey_validation.js';

		$this->mcontents['load_common_css'][] = 'common/css/survey.css';
		//$this->mcontents['load_js'][] = 'datepicker/survey.js';


		loadTemplate('survey/index');
	}



	function accept_answer($iQuestionNo=0) {

		// sanitize the data
		$iQuestionNo = safeText($iQuestionNo, false, '', TRUE);

		// get answer_type for the question
		$iAnswerType = 1;

		$iEnumeratorAccountNo = s('ACCOUNT_NO');
		$sError = '';
		$bProceed = TRUE;

		if(! $oCurrentTemporarySurvey = $this->survey_model->getCurrentTemporarySurvey($iEnumeratorAccountNo)) {
			$bProceed = FALSE;
			$sError = 'Survey was not found';
		}

		$this->load->model('Processanswer_model');


		if($iQuestionNo == 1) { // people details (family details)
			list($iAnswerProcessingStatus, $sError) = $this->Processanswer_model->process_Answers_FamilyQuestion($oCurrentTemporarySurvey->id);
		} elseif ($iQuestionNo == 2) { // house address
			list($iAnswerProcessingStatus, $sError) = $this->Processanswer_model->process_Answers_Address_Question($oCurrentTemporarySurvey->id);
		} else {
			list($iAnswerProcessingStatus, $sError) = $this->Processanswer_model->processAnswerForQuestion($iQuestionNo, $oCurrentTemporarySurvey->id);
		}

		//$sError = 'There is a server side error'; // testing

		if(! $sError) {

			$bLocalizedTestingInProgress = false; // For local testing purposes only. to be removed in production code.

			if( ! $bLocalizedTestingInProgress) {
				// set this question as last_processed_question
				if( $iEnumeratorAccountNo ) {

					if( $oRow = $this->survey_model->getCurrentSurvey( $iEnumeratorAccountNo ) ) {

						// "last_processed_question" is to be used to see how far the survey has progressed.
						//  This check is done, because we have a "previous button".
						if($oRow->last_processed_question < $iQuestionNo) {

							$this->db->where('enumerator_account_no', $iEnumeratorAccountNo);
							$this->db->where('id', $oRow->id);
							$this->db->set('last_processed_question', $iQuestionNo);
							$this->db->update('temporary_survey');
						}

					}
				}
			}
		}


		$aJsonData = array(
										'error' => $sError,
										'status' => $iAnswerProcessingStatus,
									);

		$sJsonData = json_encode($aJsonData);

		$this->output->set_header('Content-type: application/json');
		$this->load->view('output', array('output' => $sJsonData));
	}




	/**
	 *
	 * Cancel the temporary survey
	 *
	 * @param  integer $iTemporarySurveyNumber [description]
	 * @return [type]                          [description]
	 */
	function cancel($iTemporarySurveyId=0){

				$aJsonData = array(
											'error' => '',
											'success' => ''
										);
				if(	$this->authentication->is_user_logged_in(false) ) {

					$iEnumeratorAccountNo = s('ACCOUNT_NO');

					if( $oTemporarySurvey = $this->survey_model->getCurrentTemporarySurvey($iEnumeratorAccountNo) ) {

						if( $oTemporarySurvey->id == $iTemporarySurveyId ){

							$this->db->where('id', $iTemporarySurveyId);
							$this->db->delete('temporary_survey');
						}
					}

				}

				sf('success_message', 'The Survey has been cancelled');
				redirect('home');
	}



	/**
	 *
	 * Get details of the current survey that is going on
	 * @return [type] [description]
	 */
	public function current_survey() {

		$aJsonData = array();
		$aJsonData = array(
									'temporary_survey_number' => 0,
									'current_question' => '1'
								);
		if(	$this->authentication->is_user_logged_in(false) ) {

			$oCurrentSurvey = $this->survey_model->getCurrentSurvey();

			if($oCurrentSurvey) {
				$aJsonData = array(
											'temporary_survey_number' => $oCurrentSurvey->id,
											'current_question' => '1'
										);

			} else {
				//error JSON
			}

		}

		$sJsonData = json_encode($aJsonData);

		$this->output->set_header('Content-type: application/json');
		$this->load->view('output', array('output' => $sJsonData));
	}



	/**
	 * This function is called, when a question is skipped
	 * @return [type] [description]
	 */
	function skip($iQuestionNo=0) {

		// add data to skipped array
		// update the last processed question in DB
		// return success to server
	}



	/**
	 * This function will do the survey complete routines
	 * @return [type] [description]
	 */
	function complete () {

		$bProceed = TRUE;

		$sErrorMessage = '';
		$aJsonData = array('error' => '', 'success' => 0);


		if(! $this->authentication->is_user_logged_in(FALSE)) {
			$aJsonData['error'] = 'Not logged In';
			$bProceed = FALSE;
		}


		// do verification of input data
		// TO DO
		//
		//


		// get the current survey details
		$iEnumeratorAccountNo = s('ACCOUNT_NO');
		if( ! $oTemporarySurvey = $this->survey_model->getCurrentTemporarySurvey($iEnumeratorAccountNo) ) {
			$aJsonData['error'] = 'Invalid Survey no:';
			$bProceed = FALSE;
		}

		// if all ok, then proceed to save Survey Data.
		if($bProceed) {

			$iTemporarySurveyNumber = $oTemporarySurvey->id;


			// create the survey
			$this->load->model('survey_model');
			list($iSurveyId, $aErrorMessages) = $this->survey_model->createSurvey($iTemporarySurveyNumber);


			$aJsonData['survey_id'] = $iSurveyId;

			if($aErrorMessages) {
				$aJsonData['error'] = $aErrorMessages;

			} else {
				$aJsonData['success'] = '1';
				$aJsonData['success_msg'] = 'Survey has been completed !';

			}

		}


		$sJsonData = json_encode($aJsonData);

		$this->output->set_header('Content-type: application/json');
		$this->load->view('output', array('output' => $sJsonData));
	}


}

/* End of file account.php */
/* Location: ./application/controllers/account.php */
