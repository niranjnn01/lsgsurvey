<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Survey extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->model('survey_model');

		$this->aErrorTypes = c('error_types');


	}


	/**
	 * Load the survey form
	 *
	 */
	public function index() {



		$this->authentication->is_user_logged_in(true, 'user/login');

//exit('locked');

		// this has to be moved to another place where the logged in user
		// chooses to start a new survey
		$this->survey_model->createTemporarySurvey();

		$this->mcontents['load_js'][] = 'survey/survey_manager.js';


		loadTemplate('survey/index');
	}





function accept_answer($iQuestionNo=0) {

	// get answer_type for the question
	$iAnswerType = 1;

	$this->load->model('ProcessAnswer_model');

	$sFunctionName = 'processAnswerForQuestion_' . $iQuestionNo;

	list($iAnswerProcessingStatus, $sError) = $this->ProcessAnswer_model->$sFunctionName();


	$aJsonData = array(
									'error' => $sError,
									'status' => $iAnswerProcessingStatus,
								);

	$sJsonData = json_encode($aJsonData);

	$this->output->set_header('Content-type: application/json');
	$this->load->view('output', array('output' => $sJsonData));
}

function preview_data() {

	//$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));
	$this->mcontents['oRow'] = $this->db->get('temporary_survey')->row();

	loadTemplate('survey/preview_data');
	//p( unserialize($oRow->general_data) );
}


function test() {

	$this->survey_model->createSurvey(111);
}



function purge_test_data() {


	$this->db->truncate('surveys');
	$this->db->truncate('surveyee_users');
	$this->db->truncate('surveyee_user_family_map');
	$this->db->truncate('families');

	$this->db->truncate('houses');
	$this->db->truncate('house_house_type_map');
	$this->db->truncate('family_house_map');

	$this->db->truncate('lands');
	$this->db->truncate('leased_lands');
	$this->db->truncate('land_house_map');


}


/**
 *
 * Get details of the current survey that is going on
 * @return [type] [description]
 */
	public function current_survey() {

		$aJsonData = array();

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
	 * This function will do the survey complete routines
	 * @return [type] [description]
	 */
	function complete () {

		$bProceed = TRUE;

		$sErrorMessage = '';
		$aJsonData = array('error' => '');

/*
		if(! $this->authentication->is_user_logged_in(FALSE)) {
			$aJsonData['error'] = 'Not logged In';
			$bProceed = FALSE;
		}
*/
		// do verification of input data


		// if all ok, then proceed to save Survey Data.
		if($bProceed) {


			$iTemporarySurveyNumber = $this->db->get('temporary_survey')->row()->id;

			$this->survey_model->createSurvey($iTemporarySurveyNumber);

			if($sErrorMessage) {
				$aJsonData['error'] = $sErrorMessage;
			} else {
				$aJsonData['success'] = '1';
			}

		}


		$sJsonData = json_encode($aJsonData);

		$this->output->set_header('Content-type: application/json');
		$this->load->view('output', array('output' => $sJsonData));
	}

}

/* End of file account.php */
/* Location: ./application/controllers/account.php */
