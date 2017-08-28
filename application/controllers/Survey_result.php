<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Survey_result extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->config('survey_config');
		$this->load->model('survey_model');

		$this->load->model('question_model');

		$this->aErrorTypes = c('error_types');


	}


/**
 *
 * get details of a survey
 *
 * @param  [type] $iSurveyId [description]
 * @return [type]            [description]oUserPersonalData
 */
	function view($iSurveyId){

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

/*
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

		$this->mcontents['aHouseOwnershipTypes'] = array(
			1 => 'സ്വന്തം',
			2 => 'വാടകയ്ക്ക്',
		);

		$this->mcontents['aLandOwnershipTypes'] = array(
			1 => 'സ്വന്തം',
			2 => 'പാട്ടം',
			3 => 'പാരമ്പര്യമായി  കിട്ടിയത്',
		);
*/
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


		/**
		 *
		 *
		 *  get personal details of the head of house
		 */
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
			SU.educational_qualification,
			SU.employment_category,

			DATE_FORMAT(SU.date_of_birth, "%D %M - %Y") AS date_of_birth,
			SU.marital_status,
			SU.has_passport,
			SU.has_driving_license,
			SU.has_bank_account,
			SU.blood_group,


			FHM.residence_type_id RESIDENCE_TYPE,

			H.id house_id,
			H.address_house_no,
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
			'

			.'WP.status as status,' // temporary fix
			.'WP.reason as reason,' // temporary fix
			.'WP.is_satisfied as is_satisfied,' // temporary fix
			.'WP.have_suggestion as have_suggestion,' // temporary fix

			.'HTX.amount as house_tax,

			FHM.family_id,

			SUFM.is_head is_head_of_house,
			SUFM.relation_type_to_head relationship_to_head_of_house,

			F.ration_card_no,
			F.ration_card_type_id
			');
		$this->db->join('surveyee_user_family_map SUFM', 'SU.id = SUFM.surveyee_user_id');
		$this->db->join('families F', 'SUFM.family_id = F.id');
		$this->db->join('family_house_map FHM', 'F.id = FHM.family_id');
		$this->db->join('houses H', 'FHM.house_id = H.id');
		$this->db->join('surveys S', 'S.surveyee_user_id__head_of_family = SU.id');
		$this->db->join('ward_sabha_participation WP', 'WP.surveyee_user_id = SU.id', 'left');
		$this->db->join('house_tax HTX', 'HTX.house_id= H.id', 'left');
		$this->db->where('S.id', $this->mcontents['oSurveyData']->id);
		$this->db->where('SUFM.is_head', 1);

		$this->mcontents['oUserPersonalData'] = $this->db->get('surveyee_users SU')->row();



		/**
		 *
		 *
		 *  get house Details
		 */
		$this->db->select('
											H.id house_id,
											H.address_house_name,
											H.address_house_no,
											H.address_street_name, H.address_pincode,
											H.owner_id, H.house_area_range_id, H.num_floors, H.num_rooms, H.largest_accessible_vehicle,
											H.toilet_count, H.is_electrified, H.connection_type_to_septic_tank, H.nearest_auto_stand_access_time');
		$this->db->where('H.id', $this->mcontents['oUserPersonalData']->house_id);
		//$this->db->join('surveys S', 'H.id = S.house_id');
		$this->mcontents['oHouseData'] = $this->db->get('houses H')->row();



		/**
		 *
		 *  house tax
		 */
		$this->mcontents['oHouseData']->amount = null;
		$this->db->where('HT.house_id', $this->mcontents['oHouseData']->house_id);
		if($oRow = $this->db->get('house_tax HT')->row()) {
			$this->mcontents['oHouseData']->amount = $oRow->amount;
		}



		/**
		 *
		 *
		 *  get house types
		 */
		$this->mcontents['oHouseData']->house_type_id = [];

		$this->db->select('HHTM.house_type_id as id');
		$this->db->where('HHTM.house_id', $this->mcontents['oHouseData']->house_id);
		$aHouseHouseTypesMap = $this->db->get('house_house_type_map HHTM')->result();
		foreach($aHouseHouseTypesMap as $oItem){
			array_push($this->mcontents['oHouseData']->house_type_id, $oItem->id);
		}



		/**
		 *
		 *
		 *  get house floor types
		 */
		$this->mcontents['oHouseData']->floor_type_id = [];

		$this->db->select('HFTM.floor_type_id as id');
 		$this->db->where('HFTM.house_id', $this->mcontents['oHouseData']->house_id);
 		$aHomeFloorTypesMap = $this->db->get('house_floor_type_map HFTM')->result();

		foreach($aHomeFloorTypesMap as $oFloorType){
			array_push($this->mcontents['oHouseData']->floor_type_id, $oFloorType->id);
		}




		// users Investment types
		$this->db->select('SUIM.investment_type_id as id');
		$this->db->where('SUIM.surveyee_user_id', $this->mcontents['oUserPersonalData']->surveyee_user_id);
		$aRows = $this->db->get('surveyee_user_investment_type_map SUIM')->result();
		$this->mcontents['oUserPersonalData']->investment_type_id = [];
		foreach($aRows as $oItem){
			array_push($this->mcontents['oUserPersonalData']->investment_type_id, $oItem->id);
		}



		// users Loan purposes
		$this->db->select('FLPM.loan_purpose_id as id');
		$this->db->where('FLPM.family_id', $this->mcontents['oUserPersonalData']->family_id);
		$aRows = $this->db->get('family_loan_purpose_map FLPM')->result();
		$this->mcontents['oUserPersonalData']->loan_purpose_id = [];
		foreach($aRows as $oItem){
			array_push($this->mcontents['oUserPersonalData']->loan_purpose_id, $oItem->id);
		}



		// users Loan sources
		$this->db->select('FLSM.loan_source_id as id');
		$this->db->where('FLSM.family_id', $this->mcontents['oUserPersonalData']->family_id);
		$aRows = $this->db->get('family_loan_sources_map FLSM')->result();
		$this->mcontents['oUserPersonalData']->loan_source_id = [];
		foreach($aRows as $oItem){
			array_push($this->mcontents['oUserPersonalData']->loan_source_id, $oItem->id);
		}



		//is own house
		if( $this->mcontents['oUserPersonalData']->surveyee_user_id == $this->mcontents['oHouseData']->owner_id ) {
			$this->mcontents['oHouseData']->is_own_house = 1;
		} else {
			$this->mcontents['oHouseData']->is_own_house = 0;
		}


		$this->mcontents['oHouseData']->largest_accessible_vehicle	= $this->mcontents['oUserPersonalData']->largest_accessible_vehicle;


		$this->mcontents['oHouseData']->ration_card_no		= $this->mcontents['oUserPersonalData']->ration_card_no;
		$this->mcontents['oHouseData']->ration_card_type_id	= $this->mcontents['oUserPersonalData']->ration_card_type_id;



		//House tax
		$this->mcontents['oHouseData']->tax_amount = $this->mcontents['oUserPersonalData']->house_tax;


		// Ward Residence history
		$this->db->select('FR.from, FR.to');
		$this->db->where('FR.family_id', $this->mcontents['oUserPersonalData']->family_id);
		$aFamilyResidence = $this->db->get('family_residence_history_map FR')->row();
		$this->mcontents['oUserPersonalData']->YEARS_OF_STAYING	= '';
		if(isset($aFamilyResidence->from)){
			$this->mcontents['oUserPersonalData']->YEARS_OF_STAYING =
				date('Y', strtotime($aFamilyResidence->to)) - date('Y', strtotime($aFamilyResidence->from)) . ' വർഷം ' . '('.
				date('Y', strtotime($aFamilyResidence->from)).' - '.
				date('Y', strtotime($aFamilyResidence->to)).')';
		}



		// House Road Type
		$this->db->select('HRM.road_type_id');
		$this->db->where('HRM.house_id', $this->mcontents['oUserPersonalData']->house_id);
		$oHomeRoadMap = $this->db->get('house_road_map HRM')->row();

		$this->mcontents['oHouseData']->road_type_id = NULL;
		if($oHomeRoadMap) {
			$this->mcontents['oHouseData']->road_type_id = $oHomeRoadMap->road_type_id;
		}




		// House Public Utility Proximity
		$this->db->select('HPU.public_utility_id as id, HPU.proximity');
		$this->db->where('HPU.house_id', $this->mcontents['oUserPersonalData']->house_id);
		$aHomeUtilityProximity = $this->db->get('house_public_utility_proximity HPU')->result();

		$this->mcontents['oHouseData']->public_utility_id = [];
		foreach($aHomeUtilityProximity as $oUtility){
			array_push($this->mcontents['oHouseData']->public_utility_id, $oUtility->id);
		}



		// House Water Sources
		$this->db->select('HWS.house_water_source_id as id');
		$this->db->where('HWS.house_id', $this->mcontents['oUserPersonalData']->house_id);
		$aHomeWaterSources = $this->db->get('house_water_source_map HWS')->result();
		$this->mcontents['oHouseData']->house_water_source_id = [];
		foreach($aHomeWaterSources as $oItem){
			array_push($this->mcontents['oHouseData']->house_water_source_id, $oItem->id);
		}




		// get details of family
		$this->db->select('FAM.ration_card_no, FAM.ration_card_type_id, FAM.has_agriculture');
		$this->db->where('id', $this->mcontents['oUserPersonalData']->family_id);
		$this->mcontents['oFamily'] = $this->db->get('families FAM')->row();


		// Biodegrabale Waste Management
		$this->db->select('H_BDWM_SM.solution_id as id');
		$this->db->where('H_BDWM_SM.house_id', $this->mcontents['oUserPersonalData']->house_id);
		$aSolutions = $this->db->get('house_biodegradable_waste_management_solution_map H_BDWM_SM')->result();
		$this->mcontents['oHouseData']->biodegradable_solution_id = [];
		foreach($aSolutions as $oItem){
			array_push($this->mcontents['oHouseData']->biodegradable_solution_id, $oItem->id);
		}


		// Non Biodegrabale Waste Management
		$this->db->select('H_NBDWM_SM.solution_id as id');
		$this->db->where('H_NBDWM_SM.house_id', $this->mcontents['oUserPersonalData']->house_id);
		$aSolutions = $this->db->get('house_nonbiodegradable_waste_management_solution_map H_NBDWM_SM')->result();

		$this->mcontents['oHouseData']->nonbiodegradable_solution_id = [];
		foreach($aSolutions as $oItem){
			array_push($this->mcontents['oHouseData']->nonbiodegradable_solution_id, $oItem->id);
		}



		// Family Domestic Fuel Types
		$this->db->select('FDF.domestic_fuel_type_id as id');
		$this->db->where('FDF.family_id', $this->mcontents['oUserPersonalData']->family_id);
		$aFamilyDomesticFuelTypes = $this->db->get('family_domestic_fuel_type_map FDF')->result();

		$this->mcontents['oFamily']->domestic_fuel_type_id = [];
		foreach($aFamilyDomesticFuelTypes as $oItem){
			array_push($this->mcontents['oFamily']->domestic_fuel_type_id, $oItem->id);
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
		//$this->mcontents['oFamily']->aPets = [];
		$this->mcontents['oFamily']->pet_id = [];
		foreach($aFamilyPets as $oItem){
			//$this->mcontents['oFamily']->aPets[$oItem->id] = array('has_license' => $oItem->has_license);
			array_push($this->mcontents['oFamily']->pet_id, $oItem->id);
		}


		$this->mcontents['oFamily']->iHasPet = (count($this->mcontents['oFamily']->pet_id) > 0) ? 1 : 0;
		$this->mcontents['oFamily']->iHasDog	= (isset($this->mcontents['oFamily']->pet_id[1])) ? 1 : 0 ;
		$this->mcontents['oFamily']->has_license	=
		($this->mcontents['oFamily']->iHasDog == 1 && 1 == $this->mcontents['oFamily']->pet_id[1]) ? 1 : 0;



		// Home applicances
		$this->db->select('FLM.livestock_id as id');
		$this->db->where('FLM.family_id', $this->mcontents['oUserPersonalData']->family_id);
		$aRows = $this->db->get('family_livestock_map FLM')->result();
		$this->mcontents['oFamily']->livestock_id = [];
		foreach($aRows AS $oRow) {
			array_push($this->mcontents['oFamily']->livestock_id, $oRow->id);
		}



		// Home applicances
		$this->db->select('FA.house_appliance_id as id');
		$this->db->where('FA.family_id', $this->mcontents['oUserPersonalData']->family_id);
		$aFamilyAppliances = $this->db->get('family_appliance_map FA')->result();
		$this->mcontents['oHouseData']->house_appliance_id = [];
		foreach($aFamilyAppliances AS $iItemId) {
			array_push($this->mcontents['oHouseData']->house_appliance_id, $iItemId->id);
		}



		// Family vehicles
		$this->db->select('FV.vehicle_type_id as id');
		$this->db->where('FV.family_id', $this->mcontents['oUserPersonalData']->family_id);
		$aFamilyVehicleType = $this->db->get('family_vehicle_type_map FV')->result();

		$this->mcontents['oHouseData']->vehicle_type_id = [];
		foreach($aFamilyVehicleType AS $iItemId) {
			array_push($this->mcontents['oHouseData']->vehicle_type_id, $iItemId->id);
		}



		// Family agriculture location
		$this->db->select('FA.agriculture_location_id as id');
		$this->db->where('FA.family_id', $this->mcontents['oUserPersonalData']->family_id);
		//$this->db->join('house_appliance HA', 'HA.id = FA.house_appliance_id');
		$aFamilyAgricultureLocations = $this->db->get('family_agriculture_location_map FA')->result();

		$this->mcontents['oHouseData']->agriculture_location_id = [];
		foreach($aFamilyAgricultureLocations AS $iItemId) {
			array_push($this->mcontents['oHouseData']->agriculture_location_id, $iItemId->id);
		}



		// surveyee_user_bank_account_type_map
		$this->db->select('FA.bank_account_type_id as id');
		$this->db->where('FA.surveyee_user_id', $this->mcontents['oUserPersonalData']->surveyee_user_id);
		//$this->db->join('house_appliance HA', 'HA.id = FA.house_appliance_id');
		$aBankAccountTypes = $this->db->get('surveyee_user_bank_account_type_map FA')->result();

		$this->mcontents['oUserPersonalData']->bank_account_type_id = [];
		foreach($aBankAccountTypes AS $iItemId) {
			array_push($this->mcontents['oUserPersonalData']->bank_account_type_id, $iItemId->id);
		}



		$this->db->select('
			L.id,
			L.area_range,
			L.owner_user_id,
			L.unique_identification,
			L.is_legacy IS_LEGACY_LAND,
			LL.lessee_user_id,
			LL.id leased_land_id
			');
		$this->db->where('H.id', $this->mcontents['oUserPersonalData']->house_id);
		$this->db->join('land_house_map LHM', 'L.id = LHM.land_id');
		$this->db->join('houses H', 'LHM.house_id = H.id');
		$this->db->join('leased_lands LL', 'L.id = LL.land_id', 'LEFT');
		$this->mcontents['oLandData'] = $this->db->get('lands L')->row();



		// land ownership
		if( $this->mcontents['oLandData']->owner_user_id == $this->mcontents['oUserPersonalData']->surveyee_user_id ) {
			$this->mcontents['oLandData']->LAND_OWNERSHIP = 1; // own
		} elseif($this->mcontents['oLandData']->leased_land_id) {
			$this->mcontents['oHouseData']->LAND_OWNERSHIP = 2; // leased
		}



		// land ownership
		if( $this->mcontents['oLandData']->owner_user_id == $this->mcontents['oUserPersonalData']->surveyee_user_id ) {
			$this->mcontents['oLandData']->LAND_OWNERSHIP = 1; // own
		} elseif($this->mcontents['oLandData']->leased_land_id) {
			$this->mcontents['oHouseData']->LAND_OWNERSHIP = 2; // leased
		}


		// get the fruit trees on the land
		$this->db->where('LFTM.land_id', $this->mcontents['oLandData']->id);
		$aFruitTrees = $this->db->get('land_fruit_tree_map LFTM')->result();
		$this->mcontents['oLandData']->fruit_tree_id = [];
		if($aFruitTrees) {
			foreach($aFruitTrees AS $oRow) {
				$this->mcontents['oLandData']->fruit_tree_id[] = $oRow->fruit_tree_id;
			}
		}



		// get the users pension details
		$this->db->where('SUPTM.surveyee_user_id', $this->mcontents['oUserPersonalData']->surveyee_user_id);
		$aPensionTypeIds = $this->db->get('surveyee_user_pension_type_map SUPTM')->result();
		$this->mcontents['oUserPersonalData']->pension_type_id = [];
		if($aPensionTypeIds) {
			foreach($aPensionTypeIds AS $oRow) {
				$this->mcontents['oUserPersonalData']->pension_type_id[]
				= $oRow->pension_type_id;
			}
		}



		// get the users insurance details
		$this->db->where('SUITM.surveyee_user_id', $this->mcontents['oUserPersonalData']->surveyee_user_id);
		$aInsuranceTypeIds = $this->db->get('surveyee_user_insurance_type_map SUITM')->result();
		$this->mcontents['oUserPersonalData']->insurance_type_id = [];
		if($aInsuranceTypeIds) {
			foreach($aInsuranceTypeIds AS $oRow) {
				$this->mcontents['oUserPersonalData']->insurance_type_id[] = $oRow->insurance_type_id;
			}
		}



		// get the users reservation details
		$this->db->where('SU_RSV_M.surveyee_user_id', $this->mcontents['oUserPersonalData']->surveyee_user_id);
		$aReservationTypeIds = $this->db->get('surveyee_user_reservation_map SU_RSV_M')->result();
		$this->mcontents['oUserPersonalData']->reservation = [];
		if($aReservationTypeIds) {
			foreach($aReservationTypeIds AS $oRow) {
				$this->mcontents['oUserPersonalData']->reservation[] = $oRow->reservation_id;
			}
		}



		// get the cash crops on the land
		$this->db->where('LCCM.land_id', $this->mcontents['oLandData']->id);
		$aCashCrops = $this->db->get('land_cash_crop_map LCCM')->result();
		$this->mcontents['oLandData']->cash_crop_id = [];
		if($aCashCrops) {
			foreach($aCashCrops AS $oRow) {
				$this->mcontents['oLandData']->cash_crop_id[] = $oRow->cash_crop_id;
			}
		}


		$aPopulatedArray = array();


		$aCompleteData = array(
			(array)$this->mcontents['oUserPersonalData'],
			(array)$this->mcontents['oLandData'],
			(array)$this->mcontents['oHouseData'],
			(array)$this->mcontents['oFamily']
		);


		$aQuestionsMasterData_raw = $this->question_model->getQuestionMasterData_raw();


		$this->load->config('field_name_quid_map_config');
		$aFieldName_Quid_map = $this->config->item('field_name_quid_map');


		$aAllFieldNames = array_column($aQuestionsMasterData_raw, 'field_name');

		$aAnswerTypes = $this->config->item('answer_types');

		//populate the answer which were multi options
		foreach($aCompleteData AS $key => & $aData) {

			foreach($aData AS $sFieldName => & $value) {

				// only the field names should be present as the keys of $aCompleteData array.
				if( ! in_array($sFieldName, $aAllFieldNames) ) {

					unset($aData[$sFieldName]);
					continue;
				}


				$iQuid = $aFieldName_Quid_map[$sFieldName];


				switch($aQuestionsMasterData_raw[$iQuid]['answer_type']) {

					case $aAnswerTypes['single_value_radio']:
					case $aAnswerTypes['single_value_select']:
						//get the text correspondng to $value

						//convert the answer options to a more easily accessible format
						$aKeyValueFormat = $this->question_model->convertAnswerOptionsToKeyValueFormat($aQuestionsMasterData_raw[$iQuid]['answer_options']);

						$val = '';

						if( ! is_null($aQuestionsMasterData_raw[$iQuid]['true_false_variant']) ) {
							if( ! is_null($value) ){
								if( ! isset($aKeyValueFormat[$value]) ) {
p($iQuid);
								}
								$val = $aKeyValueFormat[$value];
							}
						} else {
							if( ! empty($value)) {
								$val = isset($aKeyValueFormat[$value]) ? $aKeyValueFormat[$value] : $value;
							}
						}

						$value = $val;

						break;
					case $aAnswerTypes['multi_value_checkbox']:

						$aKeyValueFormat = $this->question_model->convertAnswerOptionsToKeyValueFormat($aQuestionsMasterData_raw[$iQuid]['answer_options']);
						$aTemp = array();

						$sTemp = '<ul>';
						foreach($value AS $iValue) {
							$sTemp .= '<li>' . $aKeyValueFormat[$iValue] . '</li>';
						}
						$sTemp .= '</ul>';

						$value = $sTemp;
						break;
				}

			}

		}


		// make into a single array
		$aPopulatedArray = array();
		foreach($aCompleteData AS $aArray) {

			foreach($aArray AS $sKey => $sValue) {

				$aPopulatedArray['{'.$sKey.'}'] = $sValue;
			}
		}



		$aPopulatedArray['{enumerator_name}'] = $this->mcontents['oSurveyData']->enumerator_name;
		$aPopulatedArray['{survey_date}'] = date('j M, Y', strtotime($this->mcontents['oSurveyData']->created_on));



		$this->load->model('display_model');
		$this->mcontents['sPopulatedTemplate'] = $this->display_model->populateTemplate($aPopulatedArray);


		if( safeText('p', false, 'get') == 'iframe' ) {
			$this->load->view('iframe_header', $this->mcontents);
			$this->load->view('survey_result/view');
			$this->load->view('iframe_footer');
		} else {
			loadTemplate('survey_result/view');
		}

	}

}

/* End of file account.php */
/* Location: ./application/controllers/account.php */
