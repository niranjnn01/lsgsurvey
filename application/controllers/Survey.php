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
		// Initialize stuff
		$this->mcontents['iCurrentTemporarySurveyNumber']	= 0;
		$this->mcontents['iNextQuestion']	= 1;
		$this->mcontents['iLastProcessedQuestion']	= 0;
		$this->mcontents['bIsLastQuestion']	= FALSE;

		// this has to be moved to another place where the logged in user
		// chooses to start a new survey

		$oCurrentSurvey = $this->survey_model->getCurrentSurvey( s('ACCOUNT_NO') );
/*
		p($this->db->last_query());
		p($oCurrentSurvey);
		exit;
	*/
		if( $oCurrentSurvey ) {

			$this->mcontents['iCurrentTemporarySurveyNumber']	= $oCurrentSurvey->id;
			$this->mcontents['iNextQuestion']	= $oCurrentSurvey->last_processed_question + 1;
			$this->mcontents['iLastProcessedQuestion']	= $oCurrentSurvey->last_processed_question;
			$this->mcontents['bIsLastQuestion']	= $this->survey_model->isLastQuestion($this->mcontents['iNextQuestion']);

		} else {

			$oNewTemporarySurveyId = $this->survey_model->createTemporarySurvey();
			$this->survey_model->setTemporarySurveyAsCurrent($oNewTemporarySurveyId, s('ACCOUNT_NO'));

			$this->mcontents['iCurrentTemporarySurveyNumber']	= $oNewTemporarySurveyId;
			$this->mcontents['iNextQuestion']	= 1;
			$this->mcontents['iLastProcessedQuestion']	= 0;
			$this->mcontents['bIsLastQuestion']	= $this->survey_model->isLastQuestion($this->mcontents['iNextQuestion']);
		}



		$this->load->config('question_config');
		$this->mcontents['question_groups'] = json_encode($this->config->item('question_groups'));

		$this->mcontents['menu_active']	= 'survey_new';
		$this->mcontents['load_js'][] = 'survey/survey_manager.js';

		loadTemplate('survey/index');
	}





function accept_answer($iQuestionNo=0) {

	// sanitize the data
	$iQuestionNo = safeText($iQuestionNo, false, '', TRUE);

	// get answer_type for the question
	$iAnswerType = 1;

	$this->load->model('ProcessAnswer_model');

	$sFunctionName = 'processAnswerForQuestion_' . $iQuestionNo;

	//list($iAnswerProcessingStatus, $sError) = $this->ProcessAnswer_model->$sFunctionName();
	list($iAnswerProcessingStatus, $sError) = $this->ProcessAnswer_model->processAnswerForQuestion($iQuestionNo);


if(! $sError) {

	// set this question as last_processed_question

	$iEnumeratorAccountNo = s('ACCOUNT_NO');

	//$bIsLastQuestion = $this->survey_model->isLastQuestion($iQuestionNo);

	if( $iEnumeratorAccountNo ) {

		if( $oRow = $this->survey_model->getCurrentSurvey( $iEnumeratorAccountNo ) ) {
			$this->db->where('enumerator_account_no', $iEnumeratorAccountNo);
			$this->db->where('id', $oRow->id);
			$this->db->set('last_processed_question', $iQuestionNo);
			$this->db->update('temporary_survey');
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

function preview_data($iTemporarySurveyId) {

	$this->db->where('id', $iTemporarySurveyId);
	$this->mcontents['oRow'] = $this->db->get('temporary_survey')->row();

	loadTemplate('survey/preview_data');
	//p( unserialize($oRow->general_data) );
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


	$this->db->truncate('family_appliance_map');
	$this->db->truncate('family_domestic_fuel_type_map');
	$this->db->truncate('family_pet_map');
	$this->db->truncate('family_residence_history_map');
	$this->db->truncate('family_vehicle_type_map');
	$this->db->truncate('house_agricultural_produce_map');
	$this->db->truncate('house_livestock_map');
	$this->db->truncate('house_road_map');
	$this->db->truncate('house_public_utility_proximity');
	$this->db->truncate('house_tax');

	$this->db->truncate('surveyee_user_family_map');
	$this->db->truncate('house_waste_management_solution_map');
	$this->db->truncate('house_water_source_map');
	$this->db->truncate('ward_sabha_participation');

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


			$oTemporarySurvey = $this->survey_model->getCurrentTemporarySurvey();


			$iTemporarySurveyNumber = $oTemporarySurvey->id;

/*
						p($this->db->last_query());
						p($oTemporarySurvey);
						exit;
						*/
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


		$aConfig = array(
			'table' 		        	=> 'house_types',
			'id_field' 		       	=> 'id',
			'title_field' 	     	=> 'title',
			'show_default_value' 	=> FALSE
		);
		$this->mcontents['aHouseTypes'] = $this->common_model->getDropDownArray($aConfig);


		$this->mcontents['aHouseOwnershipTypes'] = array(
			1 => 'സ്വന്തം',
			2 => 'വാടകയ്ക്ക്',
		);

		$this->mcontents['aLandOwnershipTypes'] = array(
			1 => 'സ്വന്തം',
			2 => 'പാട്ടം',
			3 => 'പാരമ്പര്യമായി  കിട്ടിയത്',
		);



		// get basic details
		$this->db->where('id', $iSurveyId);
		$this->mcontents['oSurveyData'] = $this->db->get('surveys')->row();

		// get house Details
		$this->db->where('S.id', $this->mcontents['oSurveyData']->id);
		$this->db->join('surveys S', 'H.id = S.house_id');
		$this->mcontents['oHouseData'] = $this->db->get('houses H')->row();


		// get personal details
		$this->db->select('
			SU.name,
			SU.id surveyee_user_id,
			SU.aadhar_id,
			SU.election_id,
			FHM.residence_type_id,
			H.id house_id,
			H.house_area_range_id
			');
		$this->db->join('surveyee_user_family_map SUFM', 'SU.id = SUFM.surveyee_user_id');
		$this->db->join('families F', 'SUFM.family_id = F.id');
		$this->db->join('family_house_map FHM', 'F.id = FHM.family_id');
		$this->db->join('houses H', 'FHM.house_id = H.id');
		$this->db->join('surveys S', 'S.house_id = H.id');
		$this->db->where('S.id', $iSurveyId);
		$this->mcontents['oUserPersonalData'] = $this->db->get('surveyee_users SU')->row();
		//p($this->mcontents['oUserPersonalData']);

if( $this->mcontents['oUserPersonalData']->residence_type_id == 1 ) {
	//rented stay
	$this->mcontents['oHouseData']->sResidenceType = $this->mcontents['aResidenceTypes'][1];
} elseif( $this->mcontents['oUserPersonalData']->residence_type_id == null ) {

	// see if is_owner
	if( $this->mcontents['oUserPersonalData']->surveyee_user_id == $this->mcontents['oHouseData']->owner_id ) {
		$this->mcontents['oHouseData']->sResidenceType = $this->mcontents['aHouseOwnershipTypes'][1];
	}
}
//p($this->mcontents['oUserPersonalData']);

		// house types
		$this->db->select('HT.title');
		$this->db->where('HHTM.house_id', $this->mcontents['oUserPersonalData']->house_id);
		$this->db->join('house_house_type_map HHTM', 'HT.id = HHTM.house_type_id');
		$aHouseTypes = $this->db->get('house_types HT')->result();

		$this->mcontents['oHouseData']->sHouseTypes = '';
		foreach($aHouseTypes AS $oItem) {
			$this->mcontents['oHouseData']->sHouseTypes .= $oItem->title . ', ';
		}
		$this->mcontents['oHouseData']->sHouseTypes = rtrim($this->mcontents['oHouseData']->sHouseTypes, ', ');



		$this->db->select('L.*, LL.lessee_user_id, LL.id leased_land_id');
		$this->db->where('H.id', $this->mcontents['oUserPersonalData']->house_id);
		$this->db->join('land_house_map LHM', 'L.id = LHM.land_id');
		$this->db->join('houses H', 'LHM.house_id = H.id');
		$this->db->join('leased_lands LL', 'L.id = LL.land_id', 'LEFT');
		$this->mcontents['oLandData'] = $this->db->get('lands L')->row();

		//p($this->mcontents['oLandData']);
		// determine the land ownership
		if($this->mcontents['oLandData']->leased_land_id) {
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

	function sync_demo_data() {
		$this->db->where('pushed_to_main', 1);
		foreach($this->db->get('temporary_survey')->result() AS $oItem) {
			$this->survey_model->createSurvey($oItem->id);
		}
	}

}

/* End of file account.php */
/* Location: ./application/controllers/account.php */
