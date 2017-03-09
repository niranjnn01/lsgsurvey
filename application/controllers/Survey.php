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


/**
 *
 * get details of a survey
 *
 * @param  [type] $iSurveyId [description]
 * @return [type]            [description]oUserPersonalData
 */
	function data($iSurveyId){

		$aConfig = array(
			'table' 		        	=> 'residence_types',
			'id_field' 		       	=> 'id',
			'title_field' 	     	=> 'title',
			'show_default_value' 	=> FALSE
		);
		$this->mcontents['aResidenceTypes'] = $this->common_model->getDropDownArray($aConfig);

		$aConfig = array(
			'table' 		        	=> 'land_area_ranges',
			'id_field' 		       	=> 'id',
			'title_field' 	     	=> 'title',
			'show_default_value' 	=> FALSE
		);
		$this->mcontents['aLandAreaRange'] = $this->common_model->getDropDownArray($aConfig);


		$aConfig = array(
			'table' 		        	=> 'house_area_ranges',
			'id_field' 		       	=> 'id',
			'title_field' 	     	=> 'title',
			'show_default_value' 	=> FALSE
		);
		$this->mcontents['aHouseAreaRange'] = $this->common_model->getDropDownArray($aConfig);


		$this->mcontents['aLandOwnershipTypes'] = array(
			1 => 'സ്വന്തം',
			2 => 'പാട്ടം',
			3 => 'പാരമ്പര്യമായി  കിട്ടിയത്',
		);



		// get basic details
		$this->db->where('id', $iSurveyId);
		$this->mcontents['oSurveyData'] = $this->db->get('surveys')->row();

		// get house Details
		$this->mcontents['oHouseData'] = $this->db->get('houses')->row();

		// get personal details
		$this->db->select('
			SU.name,
			SU.id surveyee_user_id,
			FHM.id residence_type_id,
			H.id house_id,
			H.id house_area_range_id
			');
		$this->db->join('surveyee_user_family_map SUFM', 'SU.id = SUFM.surveyee_user_id');
		$this->db->join('families F', 'SUFM.family_id = F.id');
		$this->db->join('family_house_map FHM', 'F.id = FHM.family_id');
		$this->db->join('houses H', 'FHM.house_id = H.id');
		$this->db->join('surveys S', 'S.house_id = H.id');
		$this->db->where('S.id', $iSurveyId);
		$this->mcontents['oUserPersonalData'] = $this->db->get('surveyee_users SU')->row();

//		p($this->mcontents['oUserPersonalData']);

		$this->db->select('L.*, LL.lessee_user_id');
		$this->db->where('H.id', $this->mcontents['oUserPersonalData']->house_id);
		$this->db->join('land_house_map LHM', 'L.id = LHM.land_id');
		$this->db->join('houses H', 'LHM.house_id = H.id');
		$this->db->join('leased_lands LL', 'L.id = LL.land_id', 'LEFT');
		$this->mcontents['oLandData'] = $this->db->get('lands L')->row();


		if($this->mcontents['oLandData']->lessee_user_id) {
			$this->mcontents['oLandData']->sLandOwnershipType = $this->mcontents['aLandOwnershipTypes'][2];
		} elseif($this->mcontents['oLandData']->is_legacy) {
			$this->mcontents['oLandData']->sLandOwnershipType = $this->mcontents['aLandOwnershipTypes'][3];
		} elseif($this->mcontents['oUserPersonalData']->surveyee_user_id == $this->mcontents['oLandData']->owner_user_id) {
			$this->mcontents['oLandData']->sLandOwnershipType = $this->mcontents['aLandOwnershipTypes'][1];
		}


		if( safeText('p', false, 'get') == 'iframe' ) {
			$this->load->view('iframe_header', $this->mcontents);
			$this->load->view('survey/data');
			$this->load->view('iframe_footer');
		} else {
			loadTemplate('survey/data');
		}

	}


}

/* End of file account.php */
/* Location: ./application/controllers/account.php */
