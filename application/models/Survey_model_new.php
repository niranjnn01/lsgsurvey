<?php
class Survey_model_new extends CI_Model{

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


		function createSurvey($iTemporarySurveyNumber) {

			$sErrorMessage = '';

			$this->db->where('id', $iTemporarySurveyNumber);
			$oSurveyData = $this->db->get('temporary_survey')->row();

			//p($oSurveyData);

			if($oSurveyData) {

				$aRawData	= unserialize($oSurveyData->raw_data);
				$iWardId 	= $oSurveyData->ward_id;

//p($aRawData['surveyee_users']);exit;
/*
$aRawData['surveyee_users']['has_credit_or_debit_card'] = 1;
$aRawData['surveyee_users']['has_internet_banking'] = 1;
$aRawData['surveyee_users']['has_mobile_banking'] = 0;

//p($aRawData['surveyee_users']);
$this->db->set('raw_data', serialize($aRawData));
$this->db->where('id', 1);
$this->db->update('temporary_survey');
exit;
*/
				//p('test');
				/*
								echo '<pre>';
								print_r($aRawData);
								echo '<pre>';
								exit;
*/

				$this->db->trans_start();

				$iHeadOfFamily_iSurveyeeUserId = 0;

				$aFamilyDetails = array();

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

					unset($aSurveyeeUsers['is_head_of_house']);
					unset($aSurveyeeUsers['relationship_to_head_of_house']);

					// temporary fix
					$aSurveyeeUsers['reservation'] = is_null($aSurveyeeUsers['reservation']) ? 0 : $aSurveyeeUsers['reservation'];


					$aSurveyeeUsers = array_merge($aSurveyeeUsers, $aRawData['surveyee_users']);



					// create each of the family members as surveyee_users
					$this->db->set($aSurveyeeUsers);
					$this->db->insert('surveyee_users');
					$iSurveyeeUserId = $this->db->insert_id();

					$aFamilyMemberDetails['surveyee_user_id'] = $iSurveyeeUserId;

					// make a list of family members
					$aFamilyDetails[] = $aFamilyMemberDetails;

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
				}



					//$aFloorTypes = $aRawData['houses']['floor_type_id'];
					//unset($aRawData['houses']['floor_type_id']);

				// Create house entity
					// get the house address details and add to house
					$aRawData['houses']['house_number'] = $aRawData['address_new']['house_no'];
					$aRawData['houses']['address_house_name'] = $aRawData['address_new']['house_name'];
					$aRawData['houses']['address_street_name'] = $aRawData['address_new']['street_name'];
					$aRawData['houses']['address_pincode'] = $aRawData['address_new']['pincode'];

					//proximity of auto stand from a house
					$aRawData['houses']['nearest_auto_stand_access_time'] = $aRawData['TEMP']['time_to_get_to_autostand'];

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
				if(isset($aRawData['TEMP']['HOUSE_OWNERSHIP'])){
					switch($aRawData['TEMP']['HOUSE_OWNERSHIP']) {

						case 1:

							//own house
							$this->db->where('id', $iHouseId);
							$this->db->set('owner_id', $iSurveyeeUserId);
							$this->db->update('houses');
							break;

						case 2:

							// rented house
							$this->markRentedResidence($iHouseId, $iFamilyId);
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
						$this->db->set('owner_user_id', $iSurveyeeUserId);
						$this->db->update('lands');
						break;
					case 2:
						// leased
						$this->markAsLeasedLand($iLandId);
						break;
					case 3:
						// legacy

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

				//p($aRawData['ward_sabha_participation']);

				// insert ward sabha participation

				$bApplyTemporaryFixes = TRUE;

				// temporary fix
				if($bApplyTemporaryFixes) {
					$aRawData['ward_sabha_participation']['is_satisfied'] = ! empty($aRawData['ward_sabha_participation']['is_satisfied']) ? $aRawData['ward_sabha_participation']['is_satisfied'] : null;
					$aRawData['ward_sabha_participation']['have_suggestion'] = ! empty($aRawData['ward_sabha_participation']['have_suggestion']) ? $aRawData['ward_sabha_participation']['have_suggestion'] : null;
				}

				if(isset($aRawData['ward_sabha_participation']) && count($aRawData['ward_sabha_participation']) > 0){
					$this->db->set($aRawData['ward_sabha_participation']);
					$this->db->set('surveyee_user_id', $iSurveyeeUserId);
					$this->db->insert('ward_sabha_participation');
				}

//p(count($aRawData['family_vehicle_type_map']['vehicle_type_id']));
//var_dump( empty ($aRawData['family_vehicle_type_map']['vehicle_type_id']) );exit;
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
				if(isset($aRawData['house_biodegradable_waste_management_solution_map']['solution_id'])
					&& count($aRawData['house_biodegradable_waste_management_solution_map']['solution_id']) > 0){

					foreach($aRawData['house_biodegradable_waste_management_solution_map']['solution_id'] as $iSolutionId){
						$this->db->set('solution_id', $iSolutionId);
						$this->db->set('house_id', $iHouseId);
						$this->db->insert('house_biodegradable_waste_management_solution_map');
					}
				}


				// insert non-biodegradable waste management information
				if(isset($aRawData['house_nonbiodegradable_waste_management_solution_map']['solution_id'])
					&& count($aRawData['house_nonbiodegradable_waste_management_solution_map']['solution_id']) > 0){

					foreach($aRawData['house_nonbiodegradable_waste_management_solution_map']['solution_id'] as $iSolutionId){
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


/*
				// insert pet animals
				if(	isset($aRawData['TEMP']['HAS_DOMESTIC_ANIMALS'])
						&& 1 == $aRawData['TEMP']['HAS_DOMESTIC_ANIMALS']
						&& isset($aRawData['family_pet_map']['pet_id'])
						&& count($aRawData['family_pet_map']['pet_id']) > 0) {
					foreach($aRawData['family_pet_map']['pet_id'] as $iPetId){
						if(1 == $iPetId && isset($aRawData['family_pet_map']['has_license']) && 1 == $aRawData['family_pet_map']['has_license']){
							$this->db->set('has_license', 1);
						}
						$this->db->set('pet_id', $iPetId);
						$this->db->set('family_id', $iFamilyId);
						$this->db->insert('family_pet_map');
					}
				}
*/

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

				// fruit trees on the land
				if(isset($aRawData['land_fruit_tree_map']['fruit_tree_id'])
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

/*
				// insert agricultural produce
				if(isset($aRawData['family_agricultural_produce_map']['agricultural_produce_id'])
					&& count($aRawData['family_agricultural_produce_map']['agricultural_produce_id']) > 0){

					foreach($aRawData['family_agricultural_produce_map']['agricultural_produce_id'] as $iAgricultureTypeId){
						$this->db->set('agricultural_produce_id', $iAgricultureTypeId);
						$this->db->set('family_id', $iFamilyId);
						$this->db->insert('family_agricultural_produce_map');
					}
				}
*/

				// insert user payement type
				if(isset($aRawData['surveyee_user_payment_type_map']['payment_type_id'])
					&& count($aRawData['surveyee_user_payment_type_map']['payment_type_id']) > 0){

					foreach($aRawData['surveyee_user_payment_type_map']['payment_type_id'] as $iPaymentTypeId){
						$this->db->set('payment_type_id', $iPaymentTypeId);
						$this->db->set('surveyee_user_id', $iSurveyeeUserId);
						$this->db->insert('surveyee_user_payment_type_map');
					}
				}

				// insert user payement type
				if(isset($aRawData['surveyee_user_investment_type_map']['investment_type_id'])
					&& count($aRawData['surveyee_user_investment_type_map']['investment_type_id']) > 0){

					foreach($aRawData['surveyee_user_investment_type_map']['investment_type_id'] as $iInvestmentTypeId){
						$this->db->set('investment_type_id', $iInvestmentTypeId);
						$this->db->set('surveyee_user_id', $iSurveyeeUserId);
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
						$this->db->set('surveyee_user_id', $iSurveyeeUserId);
						$this->db->insert('surveyee_user_bank_account_type_map');
					}
				}

				// insert user debit bank type
				if(isset($aRawData['family_agriculture_location_map']['agriculture_location_id'])
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
				$this->db->where('id', $iTemporarySurveyNumber);
				$this->db->update('temporary_survey');

			//p('all is well');exit;

				$this->db->trans_complete();

				//return $iSurveyeId;
				return array($iSurveyeId, $sErrorMessage);
			}
		}


		function unMarkAsCurrentSurvey($iTemporarySurveyId) {

			$this->db->set('is_current', 0);
			$this->db->where('id', $iTemporarySurveyId);
			$this->db->update('temporary_survey');
		}

/*
		function create__Survey($iTemporarySurveyNumber) {

			$this->db->where('id', $iTemporarySurveyNumber);
			if($oSurveyData = $this->db->get('temporary_survey')->row()) {
				echo '<pre>';
				print_r(unserialize($oSurveyData->raw_data));
				exit;
				$iWardId = $oSurveyData->ward_id;

				$this->db->trans_start();

				$aGeneralData = unserialize($oSurveyData->general_data);
				$aHouseLandData = unserialize($oSurveyData->house_land_data);


				$aNormalizedGeneralArray = $this->config->item('normalized_general_array');
				$aNormalizedHouseLandArray = $this->config->item('normalized_house_land_array');

				//normalize data before use
				$aGeneralData = array_merge($aNormalizedGeneralArray, $aGeneralData);
				$aHouseLandData = array_merge($aNormalizedHouseLandArray, $aHouseLandData);



				// create the user entity
				$this->db->set('name',$aGeneralData['name']);
				$this->db->set('aadhar_id',$aGeneralData['aadhaar_number']);
				$this->db->set('election_id',$aGeneralData['election_id']);
				$this->db->insert('surveyee_users');
				$iSurveyeeUserId = $this->db->insert_id();

				// create the family entity
				$this->db->set('name', '');
				$this->db->insert('families');
				$iFamilyId = $this->db->insert_id();

				// build the user-to-family relationship.
				$this->db->set('surveyee_user_id', $iSurveyeeUserId);
				$this->db->set('family_id', $iFamilyId);
				$this->db->set('is_head', 1);
				$this->db->insert('surveyee_user_family_map');


				// Create house entity
				$this->db->set('ward_id', $iWardId);
				$aData = array();
				if($aGeneralData['address']) {
					$aData['address'] = $aGeneralData['address'];
				}

				if($aHouseLandData['house_number']) {
					$aData['house_number'] = $aHouseLandData['house_number'];
				}

				if($aHouseLandData['house_area_range']) {
					$aData['house_area_range_id'] = $aHouseLandData['house_area_range'];
				}
				$this->db->insert('houses', $aData);
				$iHouseId = $this->db->insert_id();

				// create mapping between house and house type
				if($aHouseLandData['house_type']) {

					foreach ($aHouseLandData['house_type'] AS $iHouseType) {
						$this->db->set('house_id', $iHouseId);
						$this->db->set('house_type_id', $iHouseType);
						$this->db->insert('house_house_type_map');
					}
				}

				// map family to a house
				$this->db->set('house_id', $iHouseId);
				$this->db->set('family_id', $iFamilyId);
				$this->db->insert('family_house_map');


				// house ownership
				switch($aHouseLandData['house_ownership_type']) {

					case 1:

						//own house
						$this->db->where('id', $iHouseId);
						$this->db->set('owner_id', $iSurveyeeUserId);
						$this->db->update('houses');
						break;

					case 2:

						// rented house
						$this->markRentedResidence($iHouseId, $iFamilyId);
						break;
				}


				// create the land entity
				$this->db->set('area_range',$aHouseLandData['land_area_range']);
				$this->db->insert('lands');
				$iLandId = $this->db->insert_id();

				switch($aHouseLandData['land_ownership_type']) {

					case 1:
						//own
						$this->db->where('id', $iLandId);
						$this->db->set('owner_user_id', $iSurveyeeUserId);
						$this->db->update('lands');
						break;
					case 2:
						// leased
						$this->markAsLeasedLand($iLandId);
						break;
					case 3:
						// legacy
						$this->markAsLegacyLand($iLandId);
						break;
				}

				// create mapping between land and house
				$this->db->set('land_id', $iLandId);
				$this->db->set('house_id', $iHouseId);
				$this->db->insert('land_house_map');

				// create survey
				$this->db->set('enumerator_account_no', $oSurveyData->enumerator_account_no);
				$this->db->set('house_id', $iHouseId);
				$this->db->insert('surveys');


				$this->db->trans_complete();
			}


		}
*/
		/**
		 *
		 * Mark a house as rented house
		 *
		 * @param  [type] $iHouseId  [description]
		 * @param  [type] $ifamilyId [description]
		 * @return [type]            [description]
		 */
		function markRentedResidence($iHouseId, $ifamilyId) {

			$this->db->where('house_id', $iHouseId);
			$this->db->where('family_id', $ifamilyId);
			$this->db->set('residence_type_id', 1); // 1 = rent
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
		function getCurrentTemporarySurvey($iAccountNo=0) {

			$oReturn = new Object();

			if($iEnumeratorAccountNo) {
				$this->db->where('enumerator_account_no', $iEnumeratorAccountNo);
				$this->db->where('is_current', 1);
				$oReturn = $this->db->get('temporary_survey')->row();
			}

			return $oReturn;
		}

		// determine if the given question is last question or not
		function isLastQuestion($iQuestionNo) {

			$this->load->config('question_config');

			$this->load->model('question_model');
			$aQuestionsMasterData = $this->question_model->getQuestionMasterData();

			return ( ($iQuestionNo == count($aQuestionsMasterData)) ? TRUE : FALSE );
		}
}
