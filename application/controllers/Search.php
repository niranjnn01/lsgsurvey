<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Search extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->mcontents['bTesting'] = FALSE;

	}


	/**
	 * display the settings page
	 *
	 */
	public function index() {


		$this->authentication->is_user_logged_in(TRUE, 'user/login');

		$this->load->model('question_model');

		$this->mcontents['menu_active']	= 'survey_search';
		$this->mcontents['load_js'][] = 'survey/search.js';

		loadTemplate('search/index');
	}




		public function do_search() {



					// defining our response
					$aJsonData = array(
						'message' => '',
						'error' => '',
						'result' => array(),
					);

					$aGroupBy = $aOrderBy = $aJoin = $aOrWhere = $aAndWhere = $aWhere = $aLike = array();
					$sSelect = '';


					$this->db->select("S.id survey_id, SU.name user_name, H.ward_id", false);


					$aJoin['houses H'] = array(
													'type' => '',
													'condition' => 'S.house_id = H.id',
												);

					$aJoin['land_house_map LHM'] = array(
									'type' => '',
									'condition' => 'H.id = LHM.house_id',
								);

					$aJoin['family_house_map FHM'] = array(
								'type' => '',
								'condition' => 'H.id = FHM.house_id',
							);


					$aJoin['families F'] = array(
													'type' => '',
													'condition' => 'FHM.family_id = F.id',
												);
					$aJoin['surveyee_user_family_map SUFM'] = array(
				 				 'type' => '',
				 				 'condition' => 'F.id = SUFM.family_id',
				 			 );

					// family head - we are looking at details of head of family only
					$aWhere['SUFM.is_head'] = 1;


							 // HOUSE OWNERSHIP
							 $iHouseOwnerShipType = safeText('house_ownership', FALSE, 'get');
						if($iHouseOwnerShipType == 1) { // is owner

							$aJoin['surveyee_users SU_2'] = array(
											'type' => 'RIGHT',
											'condition' => 'H.owner_id = SU_2.id',
										);

						} elseif($iHouseOwnerShipType == 2) { // for rent

							$aWhere['FHM.residence_type_id'] = 1; // 1 = for rent

						}



						$LAND_OWNERSHIP_IS_OWNER = FALSE;

						$land_ownership_type = safeText('land_ownership', FALSE, 'get');

						if($land_ownership_type == 1) { // is owner
							$LAND_OWNERSHIP_IS_OWNER = TRUE;
						}

						// LAND OWNERSHIP
						switch($land_ownership_type) {

							case '2': // leased Land
								$this->db->join('leased_lands LL', 'L.id = LL.land_id', 'LEFT');
								$this->db->join('surveyee_users SU_3', 'LL.owner_user_id = SU_3.id');
								break;

								//legacy is a separate question now
							//case '3': // is legacy
								//$this->db->where('L.is_legacy', 1);
								break;
						}

						$iIsLegacyLand = safeText('is_legacy_land', FALSE, 'get');
						if(!empty($iIsLegacyLand)) {
								if( $iIsLegacyLand == 1 ) {
									$this->db->where('L.is_legacy', 1);
								} elseif( $iIsLegacyLand == 2 ) {
									$this->db->where('(L.is_legacy IS NULL OR L.is_legacy = 0)', NULL, FALSE);

								}

						}

						if( ! $LAND_OWNERSHIP_IS_OWNER ) {

							$aJoin['lands L'] = array(
						 				 'type' => '',
						 				 'condition' => 'LHM.land_id = L.id',
						 			 );
									 //echo 'here';
								/*
						 	if($land_ownership_type == 3) { // is legacy
								$aWhere['L.is_legacy'] = 1;
							}
							*/
						}

						$aJoin['surveyee_users SU'] = array(
										'type' => '',
										'condition' => 'SUFM.surveyee_user_id = SU.id',
									);

						if( $LAND_OWNERSHIP_IS_OWNER ) { // is owner

							$aJoin['lands L2'] = array(
										 'type' => '',
										 'condition' => 'L2.owner_user_id = SU.id',
									 );
						}

						// HOUSE ATTRIBUTES
						$aHouseAttributes_fieldNames = array(
							'house_area_range_id',
							'largest_accessible_vehicle',
							'nearest_auto_stand_access_time',
							'connection_type_to_septic_tank',
							'toilet_count',
							'is_electrified'
						);

						foreach($aHouseAttributes_fieldNames AS $sFieldName) {

							$iValue = safeText($sFieldName, FALSE, 'get');
							if($iValue) {
								$aWhere['H.' . $sFieldName] = $iValue;
							}
						}



						// HOUSE PROXIMITY TO PUBLIC UTILITIES
						$aHouse_DomesticFuelTypes = safeText('domestic_fuel_type_id', FALSE, 'get');
						if($aHouse_DomesticFuelTypes) {

								$aJoin['family_domestic_fuel_type_map FDFTM'] = array(
										 'type' => '',
										 'condition' => 'F.id = FDFTM.family_id',
								);

								$sQuery = '';

								foreach($aHouse_DomesticFuelTypes AS $iDomesticFuelId) {
									$sQuery .= ' FDFTM.solution_id = '. $iDomesticFuelId . ' OR ';
								}

								$sQuery = rtrim($sQuery, 'OR ');
								$this->db->where('('.$sQuery.')', NULL, FALSE);

								$aGroupBy[] = 'FDFTM.family_id';
						}


						// LIVESTOCKS OF FAMILY
						$aFamily_Livestocks = safeText('livestock_id', FALSE, 'get');
						if($aFamily_Livestocks) {

								$aJoin['house_livestock_map HLM'] = array(
										 'type' => '',
										 'condition' => 'F.id = HLM.family_id',
								);

								$sQuery = '';

								foreach($aFamily_Livestocks AS $iLivestockId) {
									$sQuery .= ' HLM.livestock_id = '. $iLivestockId . ' OR ';
								}

								$sQuery = rtrim($sQuery, 'OR ');
								$this->db->where('('.$sQuery.')', NULL, FALSE);

								$aGroupBy[] = 'HLM.family_id';
						}



						// HOUSE PROXIMITY TO PUBLIC UTILITIES
						$aHouse_BiodegradableSolutions = safeText('biodegradable_solution_id', FALSE, 'get');
						if($aHouse_BiodegradableSolutions) {

								$aJoin['house_biodegradable_waste_management_solution_map HBWMSM'] = array(
										 'type' => '',
										 'condition' => 'H.id = HBWMSM.house_id',
								);

								$sQuery = '';

								foreach($aHouse_BiodegradableSolutions AS $iSolutionId) {
									$sQuery .= ' HBWMSM.solution_id = '. $iSolutionId . ' OR ';
								}

								$sQuery = rtrim($sQuery, 'OR ');
								$this->db->where('('.$sQuery.')', NULL, FALSE);

								$aGroupBy[] = 'HBWMSM.house_id';
						}


						// HOUSE PROXIMITY TO PUBLIC UTILITIES
						$aHouse_NonBiodegradableSolutions = safeText('nonbiodegradable_solution_id', FALSE, 'get');
						if($aHouse_NonBiodegradableSolutions) {

								$aJoin['house_nonbiodegradable_waste_management_solution_map HNBWMSM'] = array(
										 'type' => '',
										 'condition' => 'H.id = HNBWMSM.house_id',
								);

								$sQuery = '';

								foreach($aHouse_NonBiodegradableSolutions AS $iSolutionId) {
									$sQuery .= ' HNBWMSM.solution_id = '. $iSolutionId . ' OR ';
								}

								$sQuery = rtrim($sQuery, 'OR ');
								$this->db->where('('.$sQuery.')', NULL, FALSE);

								$aGroupBy[] = 'HNBWMSM.house_id';
						}


						// HOUSE PROXIMITY TO PUBLIC UTILITIES
						$aHouse_PublicUtilities = safeText('public_utility_id', FALSE, 'get');
						if($aHouse_PublicUtilities) {

								$aJoin['house_public_utility_proximity HPUP'] = array(
										 'type' => '',
										 'condition' => 'H.id = HPUP.house_id',
								);

								$sQuery = '';

								foreach($aHouse_PublicUtilities AS $iPublicUtilityId) {
								 	$sQuery .= ' HPUP.public_utility_id = '. $iPublicUtilityId . ' OR ';
								}

								$sQuery = rtrim($sQuery, 'OR ');
								$this->db->where('('.$sQuery.')', NULL, FALSE);

								$aGroupBy[] = 'HPUP.house_id';
						}




						// HOUSE ROAD MAP
						$aHouse_RoadTypes = safeText('road_type_id', FALSE, 'get');
						if($aHouse_RoadTypes) {

								$aJoin['house_road_map HRM'] = array(
										 'type' => '',
										 'condition' => 'H.id = HRM.house_id',
								);
								$sQuery = '';
								foreach($aHouse_RoadTypes AS $iRoadTypeId) {

								 $sQuery .= ' HRM.road_type_id = '. $iRoadTypeId . ' OR ';

								}
								$sQuery = rtrim($sQuery, 'OR ');
								$this->db->where('('.$sQuery.')', NULL, FALSE);

								$aGroupBy[] = 'HRM.road_type_id';
						}





						// LAND AREA RANGE
						$land_area_range = safeText('area_range', FALSE, 'get');
						if($land_area_range) {

							if( $LAND_OWNERSHIP_IS_OWNER ) { // is owner
								$aWhere['L2.area_range'] = $land_area_range;
							} else {
								$aWhere['L.area_range'] = $land_area_range;
							}
						}

						// HOUSE TYPE
						$house_types = safeText('house_type_id', FALSE, 'get');
						if($house_types) {

							$aJoin['house_house_type_map HHTM'] = array(
										 'type' => '',
										 'condition' => 'H.id = HHTM.house_id',
									 );
									 $sQuery = '';
									 foreach($house_types AS $iHouseTypeId) {

										 $sQuery .= ' HHTM.house_type_id = '. $iHouseTypeId . ' OR ';

									 }
									 $sQuery = rtrim($sQuery, 'OR ');
									 $this->db->where('('.$sQuery.')', NULL, FALSE);

									 $aGroupBy[] = 'HHTM.house_id';
						}





						// RESERVATION
						$iReservationCategory = safeText('reservation_category', FALSE, 'get');
						If(! empty($iReservationCategory)) {
							$iReservationCategory = (integer)$iReservationCategory;
							$aReservationCategories = array(0, 1, 2);

							$position = in_array($iReservationCategory, $aReservationCategories, TRUE);
							if( $position !== FALSE ) {
								$aWhere['reservation'] = $iReservationCategory;
							}
						}



						// Mobile Number
						$iMobileNumber = safeText('mobile_number', FALSE, 'get');
						if(! empty($iMobileNumber)) {
							$aLike['SU.mobile_number'] = $iMobileNumber;
						}



						// num floors
						$iHouse_NumFloors = safeText('num_floors', FALSE, 'get');
						//p($iHouse_NumFloors);
						if($iHouse_NumFloors) {
							$aWhere['H.num_floors'] = $iHouse_NumFloors;
						}


						// house floor types
						$aHouse_FloorTypes = safeText('floor_type_id', FALSE, 'get');

						if($aHouse_FloorTypes) {

							$aJoin['house_floor_type_map HFTM'] = array(
										 'type' => '',
										 'condition' => 'H.id = HFTM.house_id',
							 );

							 $sQuery = '';
							 foreach($aHouse_FloorTypes AS $iFloorTypeId) {

								 $sQuery .= ' HFTM.floor_type_id = '. $iFloorTypeId . ' OR ';

							 }
							 $sQuery = rtrim($sQuery, 'OR ');
							 $this->db->where('('.$sQuery.')', NULL, FALSE);

							$aGroupBy[] = 'HFTM.house_id';
						}



						// Family attributes
						$aFamilyAttributes_FieldNames = array(
							'ration_card_type_id',
							'has_agriculture'
						);

						foreach($aFamilyAttributes_FieldNames AS $sFieldName) {

							$iValue = safeText($sFieldName, FALSE, 'get');
							if($iValue) {
								$aWhere['F.' . $sFieldName] = $iValue;
							}
						}



						// Agriculture locations of a family
						$aFamily_AgricultureLocations = safeText('agriculture_location_id', FALSE, 'get');

						if($aFamily_AgricultureLocations) {

							$aJoin['family_agriculture_location_map FALM'] = array(
							 'type' => '',
							 'condition' => 'F.id = FALM.family_id',
							);

							$sQuery = '';

							foreach($aFamily_AgricultureLocations AS $iAgricultureLocationId) {
								$sQuery .= ' FALM.agriculture_location_id = '. $iAgricultureLocationId . ' OR ';
							}

							$sQuery = rtrim($sQuery, 'OR ');
							$this->db->where('('.$sQuery.')', NULL, FALSE);

							$aGroupBy[] = 'FALM.family_id';
						}



						// Fruit trees on the land
						$aLand_FruitTrees = safeText('fruit_tree_id', FALSE, 'get');

						if($aLand_FruitTrees) {

							$aJoin['land_fruit_tree_map LFTM'] = array(
							 'type' => '',
							 'condition' => 'L.id = LFTM.land_id',
							);

							$sQuery = '';

							foreach($aLand_FruitTrees AS $iFruitTreeId) {
								$sQuery .= ' LFTM.agriculture_location_id = '. $iFruitTreeId . ' OR ';
							}

							$sQuery = rtrim($sQuery, 'OR ');
							$this->db->where('('.$sQuery.')', NULL, FALSE);

							$aGroupBy[] = 'LFTM.land_id';
						}



						// Cash Crops on the land
						$aLand_CashCrops = safeText('cash_crop_id', FALSE, 'get');

						if($aLand_CashCrops) {

							$aJoin['land_cash_crop_map LCCM'] = array(
							 'type' => '',
							 'condition' => 'L.id = LCCM.land_id',
							);

							$sQuery = '';

							foreach($aLand_CashCrops AS $iCashCropId) {
								$sQuery .= ' LCCM.cash_crop_id = '. $iCashCropId . ' OR ';
							}

							$sQuery = rtrim($sQuery, 'OR ');
							$this->db->where('('.$sQuery.')', NULL, FALSE);

							$aGroupBy[] = 'LCCM.land_id';
						}



						// Surveyee users attributes
						$aSurveyeeUserAttributes_FieldNames = array(
							'is_member_library',
							'is_office_bearer_religious_organization',
							'is_memeber_socio_cultural_organization',
							'is_member_political_party',
							'is_office_bearer_ayalkoottam',
							'is_member_ayalkoottam',
							'belief_in_religion_id',
							'is_birth_same_ward',
							'has_credit_or_debit_card',
							'has_internet_banking',
							'has_mobile_banking'
						);

						foreach($aSurveyeeUserAttributes_FieldNames AS $sFieldName) {

							if(safeText($sFieldName, FALSE, 'get')) {
								$aWhere['SU.' . $sFieldName] = safeText($sFieldName, FALSE, 'get');
							}
						}


						// vehicles in the family
						$aFamily_VehicleTypes = safeText('vehicle_type_id', FALSE, 'get');

						if($aFamily_VehicleTypes) {

							$aJoin['family_vehicle_type_map FVTM'] = array(
							 'type' => '',
							 'condition' => 'F.id = FVTM.family_id',
							);

							$sQuery = '';

							foreach($aFamily_VehicleTypes AS $iVehicleTypeId) {
							 	$sQuery .= ' FVTM.vehicle_type_id = '. $iVehicleTypeId . ' OR ';
							}

							$sQuery = rtrim($sQuery, 'OR ');
							$this->db->where('('.$sQuery.')', NULL, FALSE);

							$aGroupBy[] = 'FVTM.family_id';
						}



						// Loan purposes of the head of family
						$aSurveyeeUser_LoanPurposes = safeText('loan_purpose_id', FALSE, 'get');

						if($aSurveyeeUser_LoanPurposes) {

							$aJoin['family_loan_purpose_map FLPM'] = array(
							 'type' => '',
							 'condition' => 'F.id = FLPM.family_id',
							);

							$sQuery = '';

							foreach($aSurveyeeUser_LoanPurposes AS $iLoanPurpose) {
								$sQuery .= ' FLPM.loan_purpose_id = '. $iLoanPurpose . ' OR ';
							}

							$sQuery = rtrim($sQuery, 'OR ');
							$this->db->where('('.$sQuery.')', NULL, FALSE);

							$aGroupBy[] = 'FLPM.family_id';
						}




						// Investment types of the head of family
						$aSurveyeeUser_InvestmentTypes = safeText('investment_type_id', FALSE, 'get');

						if($aSurveyeeUser_InvestmentTypes) {

							$aJoin['surveyee_user_investment_type_map SUITM'] = array(
							 'type' => '',
							 'condition' => 'SU.id = SUITM.surveyee_user_id',
							);

							$sQuery = '';

							foreach($aSurveyeeUser_InvestmentTypes AS $iInvestmentTypeId) {
								$sQuery .= ' SUITM.investment_type_id = '. $iInvestmentTypeId . ' OR ';
							}

							$sQuery = rtrim($sQuery, 'OR ');
							$this->db->where('('.$sQuery.')', NULL, FALSE);

							$aGroupBy[] = 'SUITM.surveyee_user_id';
						}



						// bank account types of a user
						$aUser_BankAccountTypes = safeText('bank_account_type_id', FALSE, 'get');

						if($aUser_BankAccountTypes) {

							$aJoin['surveyee_user_bank_account_type_map SUBATM'] = array(
							 'type' => '',
							 'condition' => 'SU.id = SUBATM.surveyee_user_id',
							);

							$sQuery = '';

							foreach($aUser_BankAccountTypes AS $iBankAccountTypeId) {
								$sQuery .= ' SUBATM.bank_account_type_id = '. $iBankAccountTypeId . ' OR ';
							}

							$sQuery = rtrim($sQuery, 'OR ');
							$this->db->where('('.$sQuery.')', NULL, FALSE);

							$aGroupBy[] = 'SUBATM.surveyee_user_id';
						}






						// House appliances in the family
						$aFamily_HouseAppliances = safeText('house_appliance_id', FALSE, 'get');

						if($aFamily_HouseAppliances) {

								$aJoin['family_appliance_map FAM'] = array(
								 'type' => '',
								 'condition' => 'F.id = FAM.family_id',
								);

								$sQuery = '';

								foreach($aFamily_HouseAppliances AS $iApplianceId) {
									$sQuery .= ' FAM.house_appliance_id = '. $iApplianceId . ' OR ';
								}

								$sQuery = rtrim($sQuery, 'OR ');
								$this->db->where('('.$sQuery.')', NULL, FALSE);

								$aGroupBy[] = 'FAM.family_id';
						}






				//p($aWhere);
				if($aWhere){
					$this->db->where($aWhere);
				}

				if($aLike){
					$this->db->like($aLike);
				}

				if($aGroupBy){
					$this->db->group_by($aGroupBy);
				}


				if($aAndWhere){

					foreach($aAndWhere AS $aItem){

						$this->db->where($aItem, false);
					}

				}

				if( $aOrWhere ) {

					foreach($aOrWhere AS $aItem){
						$this->db->or_where($aItem, false);
					}

				}

				if( $aJoin ) {

					foreach($aJoin AS $sTable => $aItem){

										$sType = $aItem['type'] ? $aItem['type']: '';
						$this->db->join($sTable, $aItem['condition'], $sType);
					}

				}

				if( $aOrderBy ) {

					foreach( $aOrderBy AS $key=>$value ) {

						$this->db->order_by($key, $value);

					}
				}

				$aSearchResult = $this->db->get('surveys S')->result();






		if($aSearchResult) {
			foreach($aSearchResult AS $oRow) {
				$aJsonData['result'][] = array(
					'user_name' => $oRow->user_name,
					'ward_id' 	=> $oRow->ward_id,
					'survey_id' 	=> $oRow->survey_id
				);
			}
		}


		$bTesting = $this->mcontents['bTesting'];
		if($bTesting) {
			$aJsonData['query'] = 	$this->db->last_query();
		} else {
			$aJsonData['query'] = '';
		}
		$aJsonData['testing'] = $bTesting;


		$aJsonData['message'] = count($aJsonData['result']) . ' results found';



		$sJsonData = json_encode($aJsonData);

		$this->output->set_header('Content-type: application/json');
		$this->load->view('output', array('output' => $sJsonData));


		}





	public function do_search_old() {


		// defining our response
		$aJsonData = array(
			'message' => '',
			'error' => '',
			'result' => array(),
		);



		// Start building query


		$this->db->select("S.id survey_id, SU.name user_name, H.ward_id", false);

		$this->db->join('houses H', 'S.house_id = H.id');
		$this->db->join('land_house_map LHM', 'H.id = LHM.house_id');
		$this->db->join('family_house_map FHM', 'H.id = FHM.house_id');
		$this->db->join('lands L', 'LHM.land_id = L.id');

		$this->db->join('families F', 'FHM.family_id = F.id');
		$this->db->join('surveyee_user_family_map SUFM', 'F.id = SUFM.family_id');
		$this->db->join('surveyee_users SU', 'SUFM.surveyee_user_id = SU.id');


		if(safeText('house_ownership_type', FALSE, 'get') == 1) { // is owner
			//$this->db->where('H.owner_id', 'SU.id');
			$this->db->join('surveyee_users SU_2', 'H.owner_id = SU_2.id');
		} elseif(safeText('house_ownership_type', FALSE, 'get') == 2) { // for rent
			$this->db->where('FHM.residence_type_id', 1); // 1 = for rent
		}


		switch(safeText('land_ownership_type', FALSE, 'get')) {

			case '1': // is owner
				//$this->db->where('L.owner_user_id', 'SU.id');

				//$this->db->join('lands L2', 'L2.owner_user_id = SU_2.id');
				//$this->db->join('surveyee_users SU_3', 'L.owner_user_id = SU_3.id');
				break;

			case '2': // leased Land

				//$this->db->join('leased_lands LL', 'L.id = LL.land_id', 'LEFT');
				//$this->db->where('LL.lessee_user_id', 'SU.id');

				$this->db->join('leased_lands LL', 'L.id = LL.land_id', 'LEFT');
				$this->db->join('surveyee_users SU_3', 'LL.owner_user_id = SU_3.id');
				break;

			case '3': // is legacy
				$this->db->where('L.is_legacy', 1);
				break;
		}

		if(safeText('house_area_range', FALSE, 'get')) {
			$this->db->where('H.house_area_range_id', safeText('house_area_range', FALSE, 'get'));
		}

		if(safeText('land_area_range', FALSE, 'get')) {
			$this->db->where('L.area_range', safeText('land_area_range', FALSE, 'get'));
		}

		if(safeText('house_type', FALSE, 'get')) {
			$this->db->where('HHTM.house_type_id', safeText('house_type', FALSE, 'get'));
			$this->db->join('house_house_type_map HHTM', 'H.id = HHTM.house_id', 'LEFT');
		}


		$aSearchResult = $this->db->get('surveys S')->result();


		log_message('ERROR', $this->db->last_query());


		if($aSearchResult) {
			foreach($aSearchResult AS $oRow) {
				$aJsonData['result'][] = array(
					'user_name' => $oRow->user_name,
					'ward_id' 	=> $oRow->ward_id,
					'survey_id' 	=> $oRow->survey_id
				);
			}
		}


		$aJsonData['message'] = count($aJsonData['result']) . ' results found';



		$sJsonData = json_encode($aJsonData);

		$this->output->set_header('Content-type: application/json');
		$this->load->view('output', array('output' => $sJsonData));

	}

}

/* End of file account.php */
/* Location: ./application/controllers/account.php */
