<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {


	function __construct() {

		parent::__construct();

	}

  function index() {


		$this->mcontents['load_js'][] = 'validation/test.js';

    loadTemplate('test/index');
  }

	function delete_survey ($iSurveyId) {

		if($iSurveyId) {

				$this->load->model('survey_model');
				$this->survey_model->deleteSurvey($iSurveyId);
		} else {
			p('no id');
		}

// EMPTY SURVEY : a:28:{s:18:"surveyee_users_new";a:1:{i:0;a:20:{s:4:"name";s:4:"usha";s:6:"gender";s:1:"1";s:11:"election_id";N;s:9:"aadhar_id";N;s:11:"reservation";s:1:"0";s:13:"mobile_number";N;s:8:"email_id";N;s:15:"whatsapp_number";N;s:16:"is_head_of_house";s:1:"1";s:29:"relationship_to_head_of_house";s:1:"0";s:19:"employment_category";s:1:"1";s:25:"educational_qualification";s:1:"1";s:13:"date_of_birth";N;s:14:"marital_status";N;s:12:"has_passport";s:1:"0";s:19:"has_driving_license";s:1:"0";s:16:"has_bank_account";s:1:"0";s:11:"blood_group";N;s:15:"pension_type_id";N;s:17:"insurance_type_id";N;}}s:11:"address_new";a:4:{s:16:"address_house_no";s:0:"";s:18:"address_house_name";s:0:"";s:19:"address_street_name";s:0:"";s:15:"address_pincode";s:0:"";}s:4:"TEMP";a:5:{s:12:"is_own_house";N;s:14:"RESIDENCE_TYPE";N;s:14:"LAND_OWNERSHIP";N;s:14:"IS_LEGACY_LAND";N;s:16:"YEARS_OF_STAYING";N;}s:6:"houses";a:8:{s:19:"house_area_range_id";N;s:10:"num_floors";N;s:9:"num_rooms";N;s:26:"largest_accessible_vehicle";N;s:30:"nearest_auto_stand_access_time";N;s:30:"connection_type_to_septic_tank";N;s:12:"toilet_count";N;s:14:"is_electrified";N;}s:5:"lands";a:1:{s:10:"area_range";N;}s:20:"house_house_type_map";a:1:{s:13:"house_type_id";N;}s:20:"house_floor_type_map";a:1:{s:13:"floor_type_id";N;}s:9:"house_tax";a:1:{s:6:"amount";N;}s:14:"surveyee_users";a:13:{s:21:"belief_in_religion_id";N;s:15:"landline_number";N;s:21:"is_member_ayalkoottam";N;s:28:"is_office_bearer_ayalkoottam";N;s:25:"is_member_political_party";N;s:38:"is_memeber_socio_cultural_organization";N;s:39:"is_office_bearer_religious_organization";N;s:17:"is_member_library";N;s:18:"is_birth_same_ward";N;s:17:"ifnot_birth_place";N;s:24:"has_credit_or_debit_card";N;s:20:"has_internet_banking";N;s:18:"has_mobile_banking";N;}s:8:"families";a:3:{s:14:"ration_card_no";N;s:19:"ration_card_type_id";N;s:15:"has_agriculture";N;}s:24:"ward_sabha_participation";a:4:{s:6:"status";N;s:6:"reason";N;s:12:"is_satisfied";N;s:15:"have_suggestion";N;}s:23:"family_vehicle_type_map";a:1:{s:15:"vehicle_type_id";N;}s:20:"family_appliance_map";a:1:{s:18:"house_appliance_id";N;}s:14:"house_road_map";a:1:{s:12:"road_type_id";N;}s:30:"house_public_utility_proximity";a:1:{s:17:"public_utility_id";N;}s:22:"house_water_source_map";a:1:{s:21:"house_water_source_id";N;}s:49:"house_biodegradable_waste_management_solution_map";a:1:{s:25:"biodegradable_solution_id";N;}s:52:"house_nonbiodegradable_waste_management_solution_map";a:1:{s:28:"nonbiodegradable_solution_id";N;}s:29:"family_domestic_fuel_type_map";a:1:{s:21:"domestic_fuel_type_id";N;}s:14:"family_pet_map";a:2:{s:6:"pet_id";N;s:11:"has_license";N;}s:20:"family_livestock_map";a:1:{s:12:"livestock_id";N;}s:31:"family_agriculture_location_map";a:1:{s:23:"agriculture_location_id";N;}s:19:"land_fruit_tree_map";a:1:{s:13:"fruit_tree_id";N;}s:18:"land_cash_crop_map";a:1:{s:12:"cash_crop_id";N;}s:35:"surveyee_user_bank_account_type_map";a:1:{s:20:"bank_account_type_id";N;}s:33:"surveyee_user_investment_type_map";a:1:{s:18:"investment_type_id";N;}s:23:"family_loan_purpose_map";a:1:{s:15:"loan_purpose_id";N;}s:23:"family_loan_sources_map";a:1:{s:14:"loan_source_id";N;}}
	}


	function assign_uname() {

		$this->db->select('uid,field_name');
		foreach($this->db->get('questions')->result() AS $oRow) {

			$this->db->where('uid', $oRow->uid);
			$this->db->set('uname', strtolower($oRow->field_name));
			$this->db->update('questions');
		}
	}


	function test_delete_worked () {

		$aTruncatableTables = array(

			'family_agriculture_location_map',
			'family_appliance_map',
			'family_domestic_fuel_type_map',
			'family_house_map',
			'family_livestock_map',
			'family_loan_purpose_map',
			'family_loan_sources_map',
			'family_pet_map',
			'family_residence_history_map',
			'family_vehicle_type_map',

			//'temporary_survey',

			'house_biodegradable_waste_management_solution_map',
			'house_floor_type_map',
			'house_house_type_map',
			'house_nonbiodegradable_waste_management_solution_map',
			'house_public_utility_proximity',
			'house_road_map',
			'house_tax',
			'house_water_source_map',


			'land_cash_crop_map',
			'land_fruit_tree_map',
			'land_house_map',
			'leased_lands',


			'surveyee_user_bank_account_type_map',
			'surveyee_user_family_map',
			'surveyee_user_insurance_type_map',
			'surveyee_user_investment_type_map',
			'surveyee_user_pension_type_map',
			'surveyee_user_reservation_map',
			'surveys',

			'ward_sabha_participation'
		);


		foreach($aTruncatableTables AS $sTableName) {
			echo $this->db->count_all_results($sTableName), '<br/>';
		}

	}

}
