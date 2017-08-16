<?php
class Survey_model extends CI_Model{

	function __construct(){
		parent::__construct();

		$this->load->config('survey_config');
	}

	/**
	 *
	 * Create temporary survey for the currently logged in enumerator
	 * @return [type] [description]
	 */
	function createTemporarySurvey(){

		$iId = 0;
		$iEnumeratorAccountNo = s('ACCOUNT_NO');
		$sSessionId = session_id();

		$this->db->trans_start();

		/*
		temporariy on hold. to generate sample data to populate for demo

		//delete any previous data by this enumerator
		$this->db->where('enumerator_account_no', $iEnumeratorAccountNo);
		$this->db->delete('temporary_survey');
		*/

		$this->db->set('session_id', $sSessionId);
		$this->db->set('enumerator_account_no', $iEnumeratorAccountNo);
		$this->db->set('general_data', serialize(array()));
		$this->db->set('house_land_data', serialize(array()));
		$this->db->set('ward_id', 1);
		$this->db->insert('temporary_survey');
		$iId = $this->db->insert_id();

		$this->db->trans_complete();

		return $iId;
	}


function setTemporarySurveyAsCurrent($iTemporarySurveyId, $iEnumeratorAccountNo){
	$this->db->set('is_current', 1);
	$this->db->where('enumerator_account_no', $iEnumeratorAccountNo);
	$this->db->where('id', $iTemporarySurveyId);
	$this->db->update('temporary_survey');
}

		public function getCurrentSurvey($iEnumeratorAccountNo) {

			$iEnumeratorAccountNo = s('ACCOUNT_NO');

			$this->db->where('enumerator_account_no', $iEnumeratorAccountNo);
			$this->db->where('is_current', 1);
			return $this->db->get('temporary_survey')->row();
		}



		function isValidTemporarySurveyNumber($iTemporarySurveyNumber) {

			$bIsValid = FALSE;

			$this->db->where('id', $iTemporarySurveyNumber);
			$this->db->where('session_id', session_id());
			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));
			if($this->db->get('temporary_survey')->row()) {

				$bIsValid = TRUE;

			}

			return $bIsValid;
		}



		function validateTemporarySurveyData ($oTemporarySurveyItem) {
			$bResult = TRUE;

			// there should be a head of house
			if(FALSE) {
				$bResult = TRUE;
			}
			return $bResult;
		}



		function createSurvey($iTemporarySurveyNumber) {

			// Initialize Items that we will be returning.
			$iSurveyeId = 0;
			$aErrors = [];


			$bProceed = TRUE;

			// get the temporary survey item
			$this->db->where('id', $iTemporarySurveyNumber);
			if( ! $oSurveyData = $this->db->get('temporary_survey')->row() ) {
				$bProceed = FALSE;
				$aErrors[] = 'No survey data found.';
			}


			// Make sure that the data collected is good to go
			if(! $this->validateTemporarySurveyData($oSurveyData)) {
				$bProceed = FALSE;
				$aErrors[] = 'There was some problem with validating the input data';
			}


			if($bProceed) {

				$aRawData	= unserialize($oSurveyData->raw_data);
				$iWardId 	= $oSurveyData->ward_id;

				// CREATION OF SURVEY SHOULD HAPPEN IN A SINGLE TRANSACTION

				// START TRANSACTION
				$this->db->trans_start();

				$iHeadOfFamily_iSurveyeeUserId = 0;

				$aFamilyDetails = array();
				$aPensionDetails_all_users = array();
				$aInsuranceDetails_all_users = array();
				$aDiseaseDetails_all_users = array();
				$aReservationDetails_all_users = array();

				// create the user entity
				foreach($aRawData['surveyee_users_new'] AS $aSurveyeeUsers) {

					// store separately the family related information from the user information and remove it.

					$aFamilyMemberDetails = array();

					$aFamilyMemberDetails['relationship_to_head_of_house'] = null;
					$aFamilyMemberDetails['is_head'] = null;
					if($aSurveyeeUsers['is_head_of_house'] !== 1) {
						$aFamilyMemberDetails['relationship_to_head_of_house'] = $aSurveyeeUsers['relationship_to_head_of_house'];
					} else {
						$aFamilyMemberDetails['is_head'] = 1;

					}

					//super temporary
					unset($aSurveyeeUsers['reservation']);
					$aSurveyeeUsers['date_of_birth'] = '1953-09-13';

					unset($aSurveyeeUsers['is_head_of_house']);
					unset($aSurveyeeUsers['relationship_to_head_of_house']);

					// pension type mapping
					if( isset($aSurveyeeUsers['pension_type_id']) && !empty($aSurveyeeUsers['pension_type_id'])) {
						$aData = ! is_array( $aSurveyeeUsers['pension_type_id'] ) ? (array)$aSurveyeeUsers['pension_type_id'] : $aSurveyeeUsers['pension_type_id'];
						//p($aData);exit;
						foreach($aData AS $iPensionTypeId) {
							$aPensionDetails[] = $iPensionTypeId;
						}
						unset($aSurveyeeUsers['pension_type_id']);
					}

					// insurance type mapping
					if( isset($aSurveyeeUsers['insurance_type_id']) && !empty($aSurveyeeUsers['insurance_type_id'])) {
						$aData = ! is_array( $aSurveyeeUsers['insurance_type_id'] ) ? (array)$aSurveyeeUsers['insurance_type_id'] : $aSurveyeeUsers['insurance_type_id'];
						foreach($aData AS $iInsuranceTypeId) {
							$aInsuranceDetails[] = $iInsuranceTypeId;
						}
						unset($aSurveyeeUsers['insurance_type_id']);
					}


					// reservation mapping
					if( isset($aSurveyeeUsers['reservation']) && !empty($aSurveyeeUsers['reservation'])) {
						$aData = ! is_array( $aSurveyeeUsers['reservation'] ) ? (array)$aSurveyeeUsers['reservation'] : $aSurveyeeUsers['reservation'];
						foreach($aData AS $iReservationId) {
							$aReservationDetails[] = $iReservationId;
						}
						unset($aSurveyeeUsers['reservation']);
					}

					// To Do
					// $aDiseaseDetails

					// temporary fix
					//$aSurveyeeUsers['reservation'] = is_null($aSurveyeeUsers['reservation']) ? 0 : $aSurveyeeUsers['reservation'];


					$aSurveyeeUsers = array_merge($aSurveyeeUsers, $aRawData['surveyee_users']);



					// create each of the family members as surveyee_users
					$this->db->set($aSurveyeeUsers);
					$this->db->insert('surveyee_users');
					$iSurveyeeUserId = $this->db->insert_id();

					$aFamilyMemberDetails['surveyee_user_id'] = $iSurveyeeUserId;

					// make a list of family members
					$aFamilyDetails[] = $aFamilyMemberDetails;

					$aInsuranceDetails_all_users[$iSurveyeeUserId] 		= $aInsuranceDetails;
					$aPensionDetails_all_users[$iSurveyeeUserId] 			= $aPensionDetails;
					$aReservationDetails_all_users[$iSurveyeeUserId] 	= $aPensionDetails;
				}


				// create the family entity
				$this->db->set($aRawData['families']);
				$this->db->insert('families');
				$iFamilyId = $this->db->insert_id();

				// Build the user-to-family relationship.
				foreach ($aFamilyDetails as $aFamilyMemberDetails) {

						$this->db->set('surveyee_user_id', $aFamilyMemberDetails['surveyee_user_id']);
						$this->db->set('relation_type_to_head', $aFamilyMemberDetails['relationship_to_head_of_house']);
						$this->db->set('is_head', $aFamilyMemberDetails['is_head']);
						$this->db->set('family_id', $iFamilyId);
						$this->db->insert('surveyee_user_family_map');

						if($aFamilyMemberDetails['is_head']) {
							$iHeadOfFamily_iSurveyeeUserId =  $aFamilyMemberDetails['surveyee_user_id'];
						}
				}


//p($aInsuranceDetails_all_users);exit;

				// build family members insurance details
				foreach($aInsuranceDetails_all_users AS $iUserId => $aInsuranceTypeIds)  {
					foreach($aInsuranceTypeIds AS $iInsuranceTypeId) {
						$this->db->set('surveyee_user_id', $iUserId);
						$this->db->set('insurance_type_id', $iInsuranceTypeId);
						$this->db->insert('surveyee_user_insurance_type_map');
					}
				}



				// build family members pension details
				foreach($aPensionDetails_all_users AS $iUserId => $aPensionTypeIds)  {
					foreach($aPensionTypeIds AS $iPensionTypeId) {
						$this->db->set('surveyee_user_id', $iUserId);
						$this->db->set('pension_type_id', $iPensionTypeId);
						$this->db->insert('surveyee_user_pension_type_map');
					}
				}


				// build family members reservation details
				foreach($aReservationDetails_all_users AS $iUserId => $aReservationTypeIds)  {
					foreach($aReservationTypeIds AS $iReservationId) {
						$this->db->set('surveyee_user_id', $iUserId);
						$this->db->set('reservation_id', $iReservationId);
						$this->db->insert('surveyee_user_reservation_map');
					}
				}


				// set the head of family.
				if(! $iHeadOfFamily_iSurveyeeUserId) {
					// head of family is required
					$aErrors[] = 'No Head of Family';
				}



				// Create house entity

				// get the house address details and add to house
				$aRawData['houses']['house_number'] = $aRawData['address_new']['house_no'];
				$aRawData['houses']['address_house_name'] = $aRawData['address_new']['house_name'];
				$aRawData['houses']['address_street_name'] = $aRawData['address_new']['street_name'];
				$aRawData['houses']['address_pincode'] = $aRawData['address_new']['pincode'];

				//proximity of auto stand from a house
				//$aRawData['houses']['nearest_auto_stand_access_time'] = $aRawData['houses']['nearest_auto_stand_access_time'];

				$aRawData['houses']['ward_id']	= $iWardId;
				$this->db->set($aRawData['houses']);
				$this->db->insert('houses');
				$iHouseId = $this->db->insert_id();



				// create mapping between house and floor type
				if( isset($aRawData['house_floor_type_map']['floor_type_id'])
						&&
						! empty($aRawData['house_floor_type_map']['floor_type_id'])
					) {
					foreach($aRawData['house_floor_type_map']['floor_type_id'] AS $iFloorTypeId) {
						$this->db->set('house_id', $iHouseId);
						$this->db->set('floor_type_id', $iFloorTypeId);
						$this->db->insert('house_floor_type_map');
					}
				}



				// create mapping between house and house type
				if(isset($aRawData['house_house_type_map'])
					&& count($aRawData['house_house_type_map']) > 0) {

					foreach ($aRawData['house_house_type_map']['house_type_id'] AS $iHouseType) {
						$this->db->set('house_id', $iHouseId);
						$this->db->set('house_type_id', $iHouseType);
						$this->db->insert('house_house_type_map');
					}
				}



				// map family to a house
				$this->db->set('house_id', $iHouseId);
				$this->db->set('family_id', $iFamilyId);
				$this->db->insert('family_house_map');

				if(isset($aRawData['TEMP']['YEARS_OF_STAYING']) && $aRawData['TEMP']['YEARS_OF_STAYING'] > 0){
					$iYear	= $aRawData['TEMP']['YEARS_OF_STAYING'];
					$aResidenceHistory	= array(
						'ward_id' 	=> $iWardId,
						'family_id'	=> $iFamilyId,
						'from'		=> date('Y-m-d', strtotime("- $iYear year", time())),
						'to'		=> date('Y-m-d')
					);
					$this->db->set($aResidenceHistory);
					$this->db->insert('family_residence_history_map');

				}



				// house ownership
				if(isset($aRawData['TEMP']['is_own_house']) && $aRawData['TEMP']['is_own_house'] == 1 ) {

					//own house
					$this->db->where('id', $iHouseId);
					$this->db->set('owner_id', $iHeadOfFamily_iSurveyeeUserId);
					$this->db->update('houses');
				}



				// residence type
				if(isset($aRawData['TEMP']['RESIDENCE_TYPE'])){

					switch($aRawData['TEMP']['RESIDENCE_TYPE']) {


						case 1:
							// rented residence
							$this->markRentedResidence($iHouseId, $iFamilyId);
							break;

						case 2:
							// permanent residence
							$this->markPermanentResidence($iHouseId, $iFamilyId);
							break;

					}
				}



				// create the land entity
				if(isset($aRawData['lands']['area_range']) && $aRawData['lands']['area_range'] > 0){
					$this->db->set($aRawData['lands']);

				}
				$this->db->insert('lands');
				$iLandId = $this->db->insert_id();



				// legacy land
				if( isset($aRawData['TEMP']['IS_LEGACY_LAND']) && $aRawData['TEMP']['IS_LEGACY_LAND'] == 1 ) {

					$this->markAsLegacyLand($iLandId);
				}



				// land ownership
				switch($aRawData['TEMP']['LAND_OWNERSHIP']) {

					case 1:
						//own
						$this->db->where('id', $iLandId);
						$this->db->set('owner_user_id', $iHeadOfFamily_iSurveyeeUserId);
						$this->db->update('lands');
						break;
					case 2:
						// leased
						$this->markAsLeasedLand($iLandId);
						break;
					case 3:
						// legacy
						// now handled as a separate question
						break;
				}



				// create mapping between land and house
				$this->db->set('land_id', $iLandId);
				$this->db->set('house_id', $iHouseId);
				$this->db->insert('land_house_map');



				// insert house tax
				if(isset($aRawData['house_tax']['amount']) && $aRawData['house_tax']['amount'] > 0){
					$this->db->set($aRawData['house_tax']);
					$this->db->set('house_id', $iHouseId);
					$this->db->insert('house_tax');
				}



				// insert ward sabha participation
				// temporary fix
				$bApplyTemporaryFixes = TRUE;

				if($bApplyTemporaryFixes) {
					$aRawData['ward_sabha_participation']['is_satisfied'] = ! empty($aRawData['ward_sabha_participation']['is_satisfied']) ? $aRawData['ward_sabha_participation']['is_satisfied'] : null;
					$aRawData['ward_sabha_participation']['have_suggestion'] = ! empty($aRawData['ward_sabha_participation']['have_suggestion']) ? $aRawData['ward_sabha_participation']['have_suggestion'] : null;
				}

				if(isset($aRawData['ward_sabha_participation']) && count($aRawData['ward_sabha_participation']) > 0){
					$this->db->set($aRawData['ward_sabha_participation']);
					$this->db->set('surveyee_user_id', $iHeadOfFamily_iSurveyeeUserId);
					$this->db->insert('ward_sabha_participation');
				}



				// insert family vehicle map
				if(isset($aRawData['family_vehicle_type_map']['vehicle_type_id'])
					&& ! empty ($aRawData['family_vehicle_type_map']['vehicle_type_id']) ){
					foreach ($aRawData['family_vehicle_type_map']['vehicle_type_id'] AS $iVehicleType) {
						$this->db->set('family_id', $iFamilyId);
						$this->db->set('vehicle_type_id', $iVehicleType);
						$this->db->insert('family_vehicle_type_map');
					}
				}



				// insert family appliance map
				if(isset($aRawData['family_appliance_map']['house_appliance_id'])
					&& !empty($aRawData['family_appliance_map']['house_appliance_id'])
					&& count($aRawData['family_appliance_map']['house_appliance_id']) > 0){
					foreach ($aRawData['family_appliance_map']['house_appliance_id'] AS $iApplianceType) {
						$this->db->set('family_id', $iFamilyId);
						$this->db->set('house_appliance_id', $iApplianceType);
						$this->db->insert('family_appliance_map');
					}
				}


				// insert house road map
				if(isset($aRawData['house_road_map']['road_type_id']) && $aRawData['house_road_map']['road_type_id'] > 0){
					$this->db->set($aRawData['house_road_map']);
					$this->db->set('house_id', $iHouseId);
					$this->db->insert('house_road_map');
				}


				// insert public utitlity
				if(isset($aRawData['house_public_utility_proximity']['public_utility_id'])
					&& count($aRawData['house_public_utility_proximity']['public_utility_id']) > 0){

					foreach($aRawData['house_public_utility_proximity']['public_utility_id'] as $iUtilityId){
						$this->db->set('public_utility_id', $iUtilityId);
						$this->db->set('house_id', $iHouseId);
						$this->db->insert('house_public_utility_proximity');
					}
				}


				// insert water sources
				if(isset($aRawData['house_water_source_map']['house_water_source_id'])
					&& count($aRawData['house_water_source_map']['house_water_source_id']) > 0){

					foreach($aRawData['house_water_source_map']['house_water_source_id'] as $iWaterSourceId){
						$this->db->set('house_water_source_id', $iWaterSourceId);
						$this->db->set('house_id', $iHouseId);
						$this->db->insert('house_water_source_map');
					}
				}

				// insert biodegradable waste management information
				if(isset($aRawData['house_biodegradable_waste_management_solution_map']['biodegradable_solution_id'])
					&& count($aRawData['house_biodegradable_waste_management_solution_map']['biodegradable_solution_id']) > 0){

					foreach($aRawData['house_biodegradable_waste_management_solution_map']['biodegradable_solution_id'] as $iSolutionId){
						$this->db->set('solution_id', $iSolutionId);
						$this->db->set('house_id', $iHouseId);
						$this->db->insert('house_biodegradable_waste_management_solution_map');
					}
				}


				// insert non-biodegradable waste management information
				if(isset($aRawData['house_nonbiodegradable_waste_management_solution_map']['nonbiodegradable_solution_id'])
					&& count($aRawData['house_nonbiodegradable_waste_management_solution_map']['nonbiodegradable_solution_id']) > 0){

					foreach($aRawData['house_nonbiodegradable_waste_management_solution_map']['nonbiodegradable_solution_id'] as $iSolutionId){
						$this->db->set('solution_id', $iSolutionId);
						$this->db->set('house_id', $iHouseId);
						$this->db->insert('house_nonbiodegradable_waste_management_solution_map');
					}
				}


				// insert domestic fuel types
				if(isset($aRawData['family_domestic_fuel_type_map']['domestic_fuel_type_id'])
					&& count($aRawData['family_domestic_fuel_type_map']['domestic_fuel_type_id']) > 0){

					foreach($aRawData['family_domestic_fuel_type_map']['domestic_fuel_type_id'] as $iFuelTypeId){
						$this->db->set('domestic_fuel_type_id', $iFuelTypeId);
						$this->db->set('family_id', $iFamilyId);
						$this->db->insert('family_domestic_fuel_type_map');
					}
				}



				// insert pet animals
				if(!empty($aRawData['family_pet_map']['pet_id'])) {
					foreach($aRawData['family_pet_map']['pet_id'] as $iPetId){
						if(1 == $iPetId && isset($aRawData['family_pet_map']['has_license']) && 1 == $aRawData['family_pet_map']['has_license']){
							$this->db->set('has_license', 1);
						}
						$this->db->set('pet_id', $iPetId);
						$this->db->set('family_id', $iFamilyId);
						$this->db->insert('family_pet_map');

					}
				}



				// livestocks of a family
				if(isset($aRawData['family_livestock_map']['livestock_id'])
					&& ! empty($aRawData['family_livestock_map']['livestock_id'])
					&& count($aRawData['family_livestock_map']['livestock_id']) > 0){

					foreach($aRawData['family_livestock_map']['livestock_id'] as $iLivestockId){
						$this->db->set('family_id', $iFamilyId);
						$this->db->set('livestock_id', $iLivestockId);
						$this->db->insert('family_livestock_map');
					}
				}



				// fruit trees on the land
				if(isset($aRawData['land_fruit_tree_map']['fruit_tree_id'])
					&& ! empty($aRawData['land_fruit_tree_map']['fruit_tree_id'])
					&& count($aRawData['land_fruit_tree_map']['fruit_tree_id']) > 0){

					foreach($aRawData['land_fruit_tree_map']['fruit_tree_id'] as $iFruitTreeId){
						$this->db->set('land_id', $iLandId);
						$this->db->set('fruit_tree_id', $iFruitTreeId);
						$this->db->insert('land_fruit_tree_map');
					}
				}



				// cash crops on the land
				if(isset($aRawData['land_cash_crop_map']['cash_crop_id'])
					&& ! empty($aRawData['land_cash_crop_map']['cash_crop_id'])
					&& count($aRawData['land_cash_crop_map']['cash_crop_id']) > 0){

					foreach($aRawData['land_cash_crop_map']['cash_crop_id'] as $iCashCropId){
						$this->db->set('land_id', $iLandId);
						$this->db->set('cash_crop_id', $iCashCropId);
						$this->db->insert('land_cash_crop_map');
					}
				}



				// insert user investment type
				if(isset($aRawData['surveyee_user_investment_type_map']['investment_type_id'])
					&& count($aRawData['surveyee_user_investment_type_map']['investment_type_id']) > 0){

					foreach($aRawData['surveyee_user_investment_type_map']['investment_type_id'] as $iInvestmentTypeId){
						$this->db->set('investment_type_id', $iInvestmentTypeId);
						$this->db->set('surveyee_user_id', $iHeadOfFamily_iSurveyeeUserId);
						$this->db->insert('surveyee_user_investment_type_map');
					}
				}


				// insert users loan purposes
				if(isset($aRawData['family_loan_purpose_map']['loan_purpose_id'])
					&& count($aRawData['family_loan_purpose_map']['loan_purpose_id']) > 0){

					foreach($aRawData['family_loan_purpose_map']['loan_purpose_id'] as $iLoanPurposeId){
						$this->db->set('loan_purpose_id', $iLoanPurposeId);
						$this->db->set('family_id', $iFamilyId);
						$this->db->insert('family_loan_purpose_map');
					}
				}


				// insert user loan sources
				if(isset($aRawData['family_loan_sources_map']['loan_source_id'])
					&& count($aRawData['family_loan_sources_map']['loan_source_id']) > 0){

					foreach($aRawData['family_loan_sources_map']['loan_source_id'] as $iLoanSourceId){
						$this->db->set('loan_source_id', $iLoanSourceId);
						$this->db->set('family_id', $iFamilyId);
						$this->db->insert('family_loan_sources_map');
					}
				}

				// insert user  bank type
				if(isset($aRawData['surveyee_user_bank_account_type_map']['bank_account_type_id'])
					&& count($aRawData['surveyee_user_bank_account_type_map']['bank_account_type_id']) > 0){

					foreach($aRawData['surveyee_user_bank_account_type_map']['bank_account_type_id'] as $iBankAccountTypeId){
						$this->db->set('bank_account_type_id', $iBankAccountTypeId);
						$this->db->set('surveyee_user_id', $iHeadOfFamily_iSurveyeeUserId);
						$this->db->insert('surveyee_user_bank_account_type_map');
					}
				}





				// insert agriculture location
				if(
					isset($aRawData['family_agriculture_location_map']['agriculture_location_id'])
					&& ! empty($aRawData['family_agriculture_location_map']['agriculture_location_id'])
					&& count($aRawData['family_agriculture_location_map']['agriculture_location_id']) > 0){

					foreach($aRawData['family_agriculture_location_map']['agriculture_location_id'] as $iLocationId){
						$this->db->set('agriculture_location_id', $iLocationId);
						$this->db->set('family_id', $iFamilyId);
						$this->db->insert('family_agriculture_location_map');
					}
				}


				// create survey
				$this->db->set('enumerator_account_no', $oSurveyData->enumerator_account_no);
				$this->db->set('house_id', $iHouseId);
				$this->db->insert('surveys');
				$iSurveyeId = $this->db->insert_id();


				// mark the survey item in the temporary_survey as NOT current
				$this->unmarkAsCurrentSurvey($iTemporarySurveyNumber);

				// mark that the survey item in the temporary_survey has been processed.
				$this->db->set('pushed_to_main', 1);
				$this->db->set('survey_id', $iSurveyeId);
				$this->db->where('id', $iTemporarySurveyNumber);
				$this->db->update('temporary_survey');

			//p('all is well');exit;

				if(empty($aError)) {
					$this->db->trans_complete();
				}



			}

			return array($iSurveyeId, $aErrors);
		}


		function unMarkAsCurrentSurvey($iTemporarySurveyId) {

			$this->db->set('is_current', 0);
			$this->db->where('id', $iTemporarySurveyId);
			$this->db->update('temporary_survey');
		}



		/**
		 *
		 * Mark that a family is staying in a house for rent
		 *
		 */
		function markRentedResidence($iHouseId, $ifamilyId) {

			$this->db->where('house_id', $iHouseId);
			$this->db->where('family_id', $ifamilyId);
			$this->db->set('residence_type_id', 1); // 1 = rent
			$this->db->update('family_house_map');
		}

		/**
		 *
		 * Mark that a family is staying in a house permanently
		 *
		 */
		function markPermanentResidence($iHouseId, $ifamilyId) {

			$this->db->where('house_id', $iHouseId);
			$this->db->where('family_id', $ifamilyId);
			$this->db->set('residence_type_id', 2); // 2 = permanent
			$this->db->update('family_house_map');
		}


		function markAsLeasedLand($iLandId, $iLesseeUserId=null, $iOwnerUserId=null) {

			$this->db->set('land_id', $iLandId);
			$this->db->insert('leased_lands');
		}

		function markAsLegacyLand($iLandId) {

			$this->db->where('id', $iLandId);
			$this->db->set('is_legacy', 1);
			$this->db->update('lands');
		}

		/**
		 *
		 * Fetch the temporary survey that an enumerator was working on currently
		 *
		 * @return [type] [description]
		 */
		 function getCurrentTemporarySurvey($iEnumeratorAccountNo=0) {

 			$return = false;

 			if($iEnumeratorAccountNo) {
 				$this->db->where('enumerator_account_no', $iEnumeratorAccountNo);
 				$this->db->where('is_current', 1);
 				$return = $this->db->get('temporary_survey')->row();
 			}

 			return $return;
 		}


		/**
		 *
		 * Determine which question needs to be asked for a given survey
		 *
		 * @param  [type] $iTemporarySurveyNumber [description]
		 * @return [type]                         [description]
		 */
		function getNextQuestionNumber($iTemporarySurveyNumber) {

			$question_no = false;
			$sError = '';

			$this->load->config('question_master_data_config');

			$this->load->config('question_in_order_config'); // this is an autogenerated config file.
			$aQuestionInOrder = $this->config->item('questions_in_order');
			$iTotalCount = count($aQuestionInOrder);

			$this->db->where('id', $iTemporarySurveyNumber);
			if($oRow = $this->db->get('temporary_survey')->row()) {
				if($oRow->last_processed_question < $iTotalCount) {
					$question_no = $oRow->last_processed_question + 1;
				}
			} else {
				$sError = 'survey not found';
			}

			$iQuestionUid = isset($aQuestionInOrder[$question_no]) ? $aQuestionInOrder[$question_no] : null;


			return array( $question_no, $iQuestionUid, $sError );
		}

		// determine if the given question is last question or not
		function isLastQuestion($iQuestionNo) {

			$this->load->config('question_config');

			$this->load->model('question_model');
			$aQuestionsMasterData = $this->question_model->getQuestionMasterData();

			return ( ($iQuestionNo == count($aQuestionsMasterData)) ? TRUE : FALSE );
		}
}
