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


		// this has to be moved to another place where the logged in user
		// chooses to start a new survey

		$oCurrentSurvey = $this->survey_model->getCurrentSurvey( s('ACCOUNT_NO') );
/*
		p($this->db->last_query());
		p($oCurrentSurvey);
		exit;
	*/
	$this->mcontents['aSurveyStatus'] = $this->config->item('survey_status');

		if( $oCurrentSurvey ) {

			//p('HERE');


			$aQuestionsMasterData = $this->question_model->getQuestionMasterData();
			//p($aQuestionsMasterData);
			//p(count($aQuestionsMasterData));
			//p($oCurrentSurvey->last_processed_question);
			//exit;
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
		$this->mcontents['load_js']['data']['question_groups'] = json_encode($this->config->item('question_groups'));


		//load datepicker
		$this->mcontents['load_js'][] = 'jquery/jquery-ui.min-datepicker.js';
		$this->mcontents['load_common_css'][] = 'jquery/jquery-ui.min.css';
		$this->mcontents['load_common_css'][] = 'jquery/jquery-ui.structure.min.css';
		//$this->mcontents['load_css'][] = 'jquery/jquery-ui.structure.min.css';


		// load the js files that will manipulate this page.
		$this->mcontents['load_js'][] = 'survey/survey_manager_construct_QA.js';
		$this->mcontents['load_js'][] = 'survey/survey_manager_handle_answer.js';
		$this->mcontents['load_js'][] = 'survey/survey_manager_event_handlers.js';
		$this->mcontents['load_js'][] = 'survey/survey_manager_server_error_handler.js';
		$this->mcontents['load_js'][] = 'survey/survey_manager_new.js';


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
			list($iAnswerProcessingStatus, $sError) = $this->Processanswer_model->processAnswerForQuestion($iQuestionNo);
		}

		//$sError = 'There is a server side error'; // testing

		if(! $sError) {

			$bLocalizedTestingInProgress = false; // For local testing purposes only. to be removed in production code.

			if( ! $bLocalizedTestingInProgress) {
				// set this question as last_processed_question
				if( $iEnumeratorAccountNo ) {

					if( $oRow = $this->survey_model->getCurrentSurvey( $iEnumeratorAccountNo ) ) {
						$this->db->where('enumerator_account_no', $iEnumeratorAccountNo);
						$this->db->where('id', $oRow->id);
						$this->db->set('last_processed_question', $iQuestionNo);
						$this->db->update('temporary_survey');
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
				$aJsonData['survey_id'] = $iSurveyId;
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
 *
 *
 *  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * 	!!!!!!!!!! NEW FUNCTION is SUVEY_RESULT/VIEW/ !!!!!!!!!!
 *  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 *
 *
 * @param  [type] $iSurveyId [description]
 * @return [type]            [description]oUserPersonalData
 */
	function data_to_delete($iSurveyId){

		$this->load->model('question_model');
		$this->authentication->is_user_logged_in('true', 'user/login');

		$this->mcontents['aTrueFalseVariants'] = array();
		foreach($this->db->get('ans_option_true_false_variances')->result() AS $oRow) {

			$this->mcontents['aTrueFalseVariants'][$oRow->id] = array(
				0 => $oRow->false_title,
				1 => $oRow->true_title
			);
		}
//p($this->mcontents['aTrueFalseVariants']);

		$aConfig = array(
			'table' 		        => 'ans_option_residence_types',
			'id_field' 		       	=> 'id',
			'title_field' 	     	=> 'title',
			'show_default_value' 	=> FALSE
		);
		$this->mcontents['aResidenceTypes'] = $this->common_model->getDropDownArray($aConfig);

		$aConfig = array(
			'table' 		        => 'ans_option_land_area_ranges',
			'id_field' 		       	=> 'id',
			'title_field' 	     	=> 'title',
			'show_default_value' 	=> FALSE
		);
		$this->mcontents['aLandAreaRange'] = $this->common_model->getDropDownArray($aConfig);


		$aConfig = array(
			'table' 		        => 'ans_option_house_area_ranges',
			'id_field' 		       	=> 'id',
			'title_field' 	     	=> 'title',
			'show_default_value' 	=> FALSE
		);
		$this->mcontents['aHouseAreaRange'] = $this->common_model->getDropDownArray($aConfig);

/*
		$aConfig = array(
			'table' 		        => 'house_types',
			'id_field' 		       	=> 'id',
			'title_field' 	     	=> 'title',
			'show_default_value' 	=> FALSE
		);
		$this->mcontents['aHouseTypes'] = $this->common_model->getDropDownArray($aConfig);


		$this->mcontents['aHouseOwnershipTypes'] = array(
			1 => 'സ്വന്തം',
			2 => 'വാടകയ്ക്ക്',
		);

*/

		$aConfig = array(
			'table' 		        => 'ans_option_land_ownership',
			'id_field' 		       	=> 'id',
			'title_field' 	     	=> 'title',
			'show_default_value' 	=> FALSE
		);
		$this->mcontents['aLandOwnershipTypes'] = $this->common_model->getDropDownArray($aConfig);






		$this->load->config('question_config');
		//$this->mcontents['questions_master_data']	= $this->config->item('questions_master_data');

		// get basic details
		$this->db->select("
			CONCAT(U.first_name, ' ', U.last_name) as enumerator_name,
			S.*
			", FALSE);
		$this->db->where('S.id', $iSurveyId);
		$this->db->join('users U', 'U.account_no = S.enumerator_account_no');
		$this->mcontents['oSurveyData'] = $this->db->get('surveys S')->row();

		// get house Details
		$this->db->where('S.id', $this->mcontents['oSurveyData']->id);
		$this->db->join('surveys S', 'H.id = S.house_id');
		$this->mcontents['oHouseData'] = $this->db->get('houses H')->row();
//p($this->mcontents['oHouseData']);


		// get house floor types
		$this->mcontents['oHouseData']->aFloorTypes = [];

		$this->db->select('HFTM.floor_type_id as id');
 		$this->db->where('HFTM.house_id', $this->mcontents['oHouseData']->house_id);
 		$aHomeFloorTypesMap = $this->db->get('house_floor_type_map HFTM')->result();
		//p($this->db->last_query());
		foreach($aHomeFloorTypesMap as $oFloorType){
			array_push($this->mcontents['oHouseData']->aFloorTypes, $oFloorType->id);
		}

//p($this->mcontents['oHouseData']->aFloorTypes);


		// get personal details
		$this->db->select('
			SU.name,
			SU.id surveyee_user_id,
			SU.aadhar_id,
			SU.election_id,
			SU.gender,
			SU.belief_in_religion_id,
			SU.mobile_number,
			SU.landline_number,
			SU.email_id,
			SU.whatsapp_number,
			SU.is_member_ayalkoottam,
			SU.is_member_political_party,
			SU.is_memeber_socio_cultural_organization,
			SU.is_office_bearer_ayalkoottam,
			SU.is_office_bearer_religious_organization,
			SU.is_member_library,
			SU.is_birth_same_ward,
			SU.ifnot_birth_place,
			SU.has_credit_or_debit_card,
			SU.has_internet_banking,
			SU.has_mobile_banking,

			FHM.residence_type_id,

			H.id house_id,
			H.house_number,
			H.address_house_name,
			H.address_street_name,
			H.address_pincode,
			H.num_floors,
			H.num_rooms,
			H.largest_accessible_vehicle,
			H.connection_type_to_septic_tank,
			H.toilet_count,
			H.is_electrified,
			H.house_area_range_id,

			WP.status as is_ward_sabha_participant,
			WP.reason as not_participation_reason,
			WP.is_satisfied as is_participant_satisfied ,
			WP.have_suggestion as have_ward_sabha_suggestion,

			HTX.amount as house_tax,

			FHM.family_id,

			F.ration_card_no,
			F.ration_card_type_id,
			');
		$this->db->join('surveyee_user_family_map SUFM', 'SU.id = SUFM.surveyee_user_id');
		$this->db->join('families F', 'SUFM.family_id = F.id');
		$this->db->join('family_house_map FHM', 'F.id = FHM.family_id');
		$this->db->join('houses H', 'FHM.house_id = H.id');
		$this->db->join('surveys S', 'S.house_id = H.id');
		$this->db->join('ward_sabha_participation WP', 'WP.surveyee_user_id = SU.id', 'left');
		$this->db->join('house_tax HTX', 'HTX.house_id= H.id', 'left');
		$this->db->where('S.id', $iSurveyId);
		$this->db->where('SUFM.is_head', 1);

		$this->mcontents['oUserPersonalData'] = $this->db->get('surveyee_users SU')->row();

		//p($this->mcontents['oUserPersonalData']);


		// users Investment types
		$this->db->select('SUIM.investment_type_id as id');
		$this->db->where('SUIM.surveyee_user_id', $this->mcontents['oUserPersonalData']->surveyee_user_id);
		$aRows = $this->db->get('surveyee_user_investment_type_map SUIM')->result();
		$this->mcontents['oUserPersonalData']->aInvestmentTypes = [];
		foreach($aRows as $oItem){
			array_push($this->mcontents['oUserPersonalData']->aInvestmentTypes, $oItem->id);
		}


		// users Loan purposes
		$this->db->select('FLPM.loan_purpose_id as id');
		$this->db->where('FLPM.family_id', $this->mcontents['oUserPersonalData']->family_id);
		$aRows = $this->db->get('family_loan_purpose_map FLPM')->result();
		$this->mcontents['oUserPersonalData']->aLoanPurposes = [];
		foreach($aRows as $oItem){
			array_push($this->mcontents['oUserPersonalData']->aLoanPurposes, $oItem->id);
		}


		// users Loan sources
		$this->db->select('FLSM.loan_source_id as id');
		$this->db->where('FLSM.family_id', $this->mcontents['oUserPersonalData']->family_id);
		$aRows = $this->db->get('family_loan_sources_map FLSM')->result();
		$this->mcontents['oUserPersonalData']->aLoanSources = [];
		foreach($aRows as $oItem){
			array_push($this->mcontents['oUserPersonalData']->aLoanSources, $oItem->id);
		}


		$this->mcontents['oHouseData']->largest_accessible_vehicle	= $this->mcontents['oUserPersonalData']->largest_accessible_vehicle;


		$this->mcontents['oHouseData']->ration_card_no		= $this->mcontents['oUserPersonalData']->ration_card_no;
		$this->mcontents['oHouseData']->ration_card_type_id	= $this->mcontents['oUserPersonalData']->ration_card_type_id;



		switch($this->mcontents['oUserPersonalData']->residence_type_id) {
			case 1:
				//rented stay
				$this->mcontents['oHouseData']->sResidenceType = $this->mcontents['aResidenceTypes'][1];
				break;

			case 2:
				//permanent stay
				$this->mcontents['oHouseData']->sResidenceType = $this->mcontents['aResidenceTypes'][2];
				break;

			case null:
				// see if is_owner
				if( $this->mcontents['oUserPersonalData']->surveyee_user_id == $this->mcontents['oHouseData']->owner_id ) {
					$this->mcontents['oHouseData']->sResidenceType = $this->mcontents['aHouseOwnershipTypes'][1];
				}
				break;
		}


		//House tax
		$this->mcontents['oHouseData']->tax_amount = $this->mcontents['oUserPersonalData']->house_tax;


		// Ward Residence history
		$this->db->select('FR.from, FR.to');
		$this->db->where('FR.family_id', $this->mcontents['oUserPersonalData']->family_id);
		$aFamilyResidence = $this->db->get('family_residence_history_map FR')->row();
		$this->mcontents['oUserPersonalData']->sFamilyResidenceHistory	= '';
		if(isset($aFamilyResidence->from)){
			$this->mcontents['oUserPersonalData']->sFamilyResidenceHistory =
				date('Y', strtotime($aFamilyResidence->to)) - date('Y', strtotime($aFamilyResidence->from)) . ' വർഷം ' . '('.
				date('Y', strtotime($aFamilyResidence->from)).' - '.
				date('Y', strtotime($aFamilyResidence->to)).')';
		}



		// House Road Type
		$this->db->select('HRM.road_type_id as id');
		$this->db->where('HRM.house_id', $this->mcontents['oUserPersonalData']->house_id);
		$aHomeRoadMap = $this->db->get('house_road_map HRM')->row();

		$this->mcontents['oHouseData']->sHomeRoadMap = '';
		if(isset($this->mcontents['oHouseData']->sHomeRoadMap)){
			$this->mcontents['oHouseData']->sHomeRoadMap = $aHomeRoadMap->id;
		}



		// House Public Utility Proximity
		$this->db->select('HPU.public_utility_id as id, HPU.proximity');
		$this->db->where('HPU.house_id', $this->mcontents['oUserPersonalData']->house_id);
		$aHomeUtilityProximity = $this->db->get('house_public_utility_proximity HPU')->result();
		//$this->mcontents['oHouseData']->aHomeUtilityProximity = [];
		$this->mcontents['oHouseData']->aHomeUtilityServices = [];
		foreach($aHomeUtilityProximity as $oUtility){
			array_push($this->mcontents['oHouseData']->aHomeUtilityServices, $oUtility->id);
		}



		// House Water Sources
		$this->db->select('HWS.house_water_source_id as id');
		$this->db->where('HWS.house_id', $this->mcontents['oUserPersonalData']->house_id);
		$aHomeWaterSources = $this->db->get('house_water_source_map HWS')->result();
		$this->mcontents['oHouseData']->aHomeWaterSources = [];
		foreach($aHomeWaterSources as $oItem){
			array_push($this->mcontents['oHouseData']->aHomeWaterSources, $oItem->id);
		}




		// get details of family
		$this->db->select('FAM.*');
		$this->db->where('id', $this->mcontents['oUserPersonalData']->family_id);
		$this->mcontents['oFamily'] = $this->db->get('families FAM')->row();


		// Biodegrabale Waste Management
		$this->db->select('H_BDWM_SM.solution_id as id');
		$this->db->where('H_BDWM_SM.house_id', $this->mcontents['oUserPersonalData']->house_id);
		$aSolutions = $this->db->get('house_biodegradable_waste_management_solution_map H_BDWM_SM')->result();
		$this->mcontents['oHouseData']->aHomeBioDegradableWasteManagementSolutions = [];
		foreach($aSolutions as $oItem){
			array_push($this->mcontents['oHouseData']->aHomeBioDegradableWasteManagementSolutions, $oItem->id);
		}


		// Non Biodegrabale Waste Management
		$this->db->select('H_NBDWM_SM.solution_id as id');
		$this->db->where('H_NBDWM_SM.house_id', $this->mcontents['oUserPersonalData']->house_id);
		$aSolutions = $this->db->get('house_nonbiodegradable_waste_management_solution_map H_NBDWM_SM')->result();

		$this->mcontents['oHouseData']->aHomeNonBioDegradableWasteManagementSolutions = [];
		foreach($aSolutions as $oItem){
			array_push($this->mcontents['oHouseData']->aHomeNonBioDegradableWasteManagementSolutions, $oItem->id);
		}



		// Family Domestic Fuel Types
		$this->db->select('FDF.domestic_fuel_type_id as id');
		$this->db->where('FDF.family_id', $this->mcontents['oUserPersonalData']->family_id);
		$aFamilyDomesticFuelTypes = $this->db->get('family_domestic_fuel_type_map FDF')->result();

		$this->mcontents['oFamily']->aFamilyDomesticFuelTypes = [];
		foreach($aFamilyDomesticFuelTypes as $oItem){
			array_push($this->mcontents['oFamily']->aFamilyDomesticFuelTypes, $oItem->id);
		}



		// Family Domestic Fuel Types
		$this->db->select('FDF.domestic_fuel_type_id as id');
		$this->db->where('FDF.family_id', $this->mcontents['oUserPersonalData']->family_id);
		$aFamilyDomesticFuelTypes = $this->db->get('family_domestic_fuel_type_map FDF')->result();
		$this->mcontents['oFamily']->aFamilyDomesticFuelTypes = [];
		foreach($aFamilyDomesticFuelTypes as $oItem){
			array_push($this->mcontents['oFamily']->aFamilyDomesticFuelTypes, $oItem->id);
		}



		// Family Pets
		$this->db->select('FP.pet_id as id, FP.has_license');
		$this->db->where('FP.family_id', $this->mcontents['oUserPersonalData']->family_id);
		$aFamilyPets = $this->db->get('family_pet_map FP')->result();
		$this->mcontents['oFamily']->aPets = [];
		foreach($aFamilyPets as $oItem){
			$this->mcontents['oFamily']->aPets[$oItem->id] = array('has_license' => $oItem->has_license);
		}

		$this->mcontents['oFamily']->iHasPet = (count($this->mcontents['oFamily']->aPets) > 0) ? 1 : 0;
		$this->mcontents['oFamily']->iHasDog	= (isset($this->mcontents['oFamily']->aPets[1])) ? 1 : 0 ;
		$this->mcontents['oFamily']->iHasDogLicense	=
		($this->mcontents['oFamily']->iHasDog == 1 && 1 == $this->mcontents['oFamily']->aPets[1]) ? 1 : 0;




		// Home applicances
		$this->db->select('FLM.livestock_id as id');
		$this->db->where('FLM.family_id', $this->mcontents['oUserPersonalData']->family_id);
		$aRows = $this->db->get('family_livestock_map FLM')->result();
		$this->mcontents['oFamily']->aLiveStocks = [];
		foreach($aRows AS $oRow) {
			array_push($this->mcontents['oFamily']->aLiveStocks, $oRow->id);
		}


		// Home applicances
		$this->db->select('FA.house_appliance_id as id');
		$this->db->where('FA.family_id', $this->mcontents['oUserPersonalData']->family_id);
		//$this->db->join('house_appliance HA', 'HA.id = FA.house_appliance_id');
		$aFamilyAppliances = $this->db->get('family_appliance_map FA')->result();

		$this->mcontents['oHouseData']->aHomeAppliances = [];
		foreach($aFamilyAppliances AS $iItemId) {
			array_push($this->mcontents['oHouseData']->aHomeAppliances, $iItemId->id);
		}

		// Family vehicles
		$this->db->select('FV.vehicle_type_id as id');
		$this->db->where('FV.family_id', $this->mcontents['oUserPersonalData']->family_id);
		$aFamilyVehicleType = $this->db->get('family_vehicle_type_map FV')->result();

		$this->mcontents['oHouseData']->aFamilyVehicleType = [];
		foreach($aFamilyVehicleType AS $iItemId) {
			array_push($this->mcontents['oHouseData']->aFamilyVehicleType, $iItemId->id);
		}

		// Family agriculture location
		$this->db->select('FA.agriculture_location_id as id');
		$this->db->where('FA.family_id', $this->mcontents['oUserPersonalData']->family_id);
		//$this->db->join('house_appliance HA', 'HA.id = FA.house_appliance_id');
		$aFamilyAgricultureLocations = $this->db->get('family_agriculture_location_map FA')->result();

		$this->mcontents['oHouseData']->aFamilyAgricultureLocations = [];
		foreach($aFamilyAgricultureLocations AS $iItemId) {
			array_push($this->mcontents['oHouseData']->aFamilyAgricultureLocations, $iItemId->id);
		}

/*
		// Family agriculture location
		$this->db->select('FA.agricultural_produce_id as id');
		$this->db->where('FA.family_id', $this->mcontents['oUserPersonalData']->family_id);
		//$this->db->join('house_appliance HA', 'HA.id = FA.house_appliance_id');
		$aFamilyAgricultureProduce = $this->db->get('family_agricultural_produce_map FA')->result();

		$this->mcontents['oHouseData']->aFamilyAgricultureProduce = [];
		foreach($aFamilyAgricultureProduce AS $iItemId) {
			array_push($this->mcontents['oHouseData']->aFamilyAgricultureProduce, $iItemId->id);
		}
*/


		// surveyee_user_bank_account_type_map
		$this->db->select('FA.bank_account_type_id as id');
		$this->db->where('FA.surveyee_user_id', $this->mcontents['oUserPersonalData']->surveyee_user_id);
		//$this->db->join('house_appliance HA', 'HA.id = FA.house_appliance_id');
		$aBankAccountTypes = $this->db->get('surveyee_user_bank_account_type_map FA')->result();

		$this->mcontents['oUserPersonalData']->aBankAccountTypes = [];
		foreach($aBankAccountTypes AS $iItemId) {
			array_push($this->mcontents['oUserPersonalData']->aBankAccountTypes, $iItemId->id);
		}

		//p($this->mcontents['oUserPersonalData']);

		// house types
		$this->db->select('HT.title');
		$this->db->where('HHTM.house_id', $this->mcontents['oUserPersonalData']->house_id);
		$this->db->join('house_house_type_map HHTM', 'HT.id = HHTM.house_type_id');
		$aHouseTypes = $this->db->get('ans_option_house_types HT')->result();

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
		$this->mcontents['oLandData']->sLandOwnershipType = '';
		if($this->mcontents['oLandData']->leased_land_id) {
			$this->mcontents['oLandData']->sLandOwnershipType = $this->mcontents['aLandOwnershipTypes'][2];
		} elseif($this->mcontents['oLandData']->is_legacy) {
			$this->mcontents['oLandData']->sLandOwnershipType = $this->mcontents['aLandOwnershipTypes'][3];
		} elseif($this->mcontents['oUserPersonalData']->surveyee_user_id == $this->mcontents['oLandData']->owner_user_id) {
			$this->mcontents['oLandData']->sLandOwnershipType = $this->mcontents['aLandOwnershipTypes'][1];
		}

		// get the fruit trees on the land
		$this->db->where('LFTM.land_id', $this->mcontents['oLandData']->id);
		$aFruitTrees = $this->db->get('land_fruit_tree_map LFTM')->result();
		$this->mcontents['oLandData']->aFruitTrees = [];
		if($aFruitTrees) {
			foreach($aFruitTrees AS $oRow) {
				$this->mcontents['oLandData']->aFruitTrees[] = $oRow->fruit_tree_id;
			}
		}


		// get the cash crops on the land
		$this->db->where('LCCM.land_id', $this->mcontents['oLandData']->id);
		$aCashCrops = $this->db->get('land_cash_crop_map LCCM')->result();
		$this->mcontents['oLandData']->aCashCrops = [];
		if($aCashCrops) {
			foreach($aCashCrops AS $oRow) {
				$this->mcontents['oLandData']->aCashCrops[] = $oRow->cash_crop_id;
			}
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
