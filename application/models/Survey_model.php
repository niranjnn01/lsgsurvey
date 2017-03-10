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


		public function getCurrentSurvey() {

			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));
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

			$this->db->where('id', $iTemporarySurveyNumber);
			if($oSurveyData = $this->db->get('temporary_survey')->row()) {

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

}
