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

// Survey ID 1 : a:27:{s:18:"surveyee_users_new";a:2:{i:0;a:20:{s:4:"name";s:9:"Usha Devi";s:6:"gender";s:1:"1";s:11:"election_id";s:7:"ele-343";s:9:"aadhar_id";s:0:"";s:11:"reservation";s:1:"0";s:13:"mobile_number";s:0:"";s:8:"email_id";s:0:"";s:15:"whatsapp_number";s:0:"";s:16:"is_head_of_house";s:1:"1";s:29:"relationship_to_head_of_house";s:1:"0";s:19:"employment_category";s:1:"1";s:25:"educational_qualification";s:1:"1";s:13:"date_of_birth";s:0:"";s:14:"marital_status";s:1:"0";s:12:"has_passport";s:1:"0";s:19:"has_driving_license";s:1:"0";s:16:"has_bank_account";s:1:"0";s:11:"blood_group";s:1:"0";s:15:"pension_type_id";s:1:"0";s:17:"insurance_type_id";s:1:"0";}i:1;a:20:{s:4:"name";s:6:"Rakesh";s:6:"gender";s:1:"1";s:11:"election_id";s:0:"";s:9:"aadhar_id";s:0:"";s:11:"reservation";s:1:"0";s:13:"mobile_number";s:0:"";s:8:"email_id";s:0:"";s:15:"whatsapp_number";s:0:"";s:16:"is_head_of_house";s:1:"0";s:29:"relationship_to_head_of_house";s:1:"2";s:19:"employment_category";s:1:"1";s:25:"educational_qualification";s:1:"1";s:13:"date_of_birth";s:0:"";s:14:"marital_status";s:1:"0";s:12:"has_passport";s:1:"0";s:19:"has_driving_license";s:1:"0";s:16:"has_bank_account";s:1:"0";s:11:"blood_group";s:1:"0";s:15:"pension_type_id";s:1:"0";s:17:"insurance_type_id";s:1:"0";}}s:11:"address_new";a:4:{s:16:"address_house_no";s:9:"4234asdas";s:18:"address_house_name";s:9:"nagakripa";s:19:"address_street_name";s:16:"kareelakulangara";s:15:"address_pincode";s:6:"762626";}s:4:"TEMP";a:5:{s:12:"is_own_house";s:1:"1";s:14:"RESIDENCE_TYPE";s:1:"2";s:14:"LAND_OWNERSHIP";s:1:"1";s:14:"IS_LEGACY_LAND";s:1:"1";s:16:"YEARS_OF_STAYING";s:1:"6";}s:6:"houses";a:8:{s:19:"house_area_range_id";s:1:"4";s:10:"num_floors";s:1:"2";s:9:"num_rooms";s:1:"6";s:26:"largest_accessible_vehicle";s:1:"6";s:30:"nearest_auto_stand_access_time";s:1:"2";s:30:"connection_type_to_septic_tank";s:1:"1";s:12:"toilet_count";s:1:"5";s:14:"is_electrified";s:1:"1";}s:5:"lands";a:1:{s:10:"area_range";s:1:"4";}s:20:"house_house_type_map";a:1:{s:13:"house_type_id";a:1:{i:0;s:1:"7";}}s:20:"house_floor_type_map";a:1:{s:13:"floor_type_id";a:1:{i:0;s:1:"7";}}s:9:"house_tax";a:1:{s:6:"amount";s:4:"2000";}s:14:"surveyee_users";a:13:{s:21:"belief_in_religion_id";s:1:"1";s:15:"landline_number";N;s:21:"is_member_ayalkoottam";s:1:"0";s:28:"is_office_bearer_ayalkoottam";s:1:"0";s:25:"is_member_political_party";s:1:"0";s:38:"is_memeber_socio_cultural_organization";s:1:"0";s:39:"is_office_bearer_religious_organization";s:1:"0";s:17:"is_member_library";s:1:"0";s:18:"is_birth_same_ward";s:1:"0";s:17:"ifnot_birth_place";s:9:"singapore";s:24:"has_credit_or_debit_card";s:1:"1";s:20:"has_internet_banking";s:1:"1";s:18:"has_mobile_banking";s:1:"0";}s:8:"families";a:3:{s:14:"ration_card_no";s:10:"rat-us-232";s:19:"ration_card_type_id";s:1:"1";s:15:"has_agriculture";s:1:"1";}s:24:"ward_sabha_participation";a:4:{s:6:"status";s:1:"0";s:6:"reason";s:1:"3";s:12:"is_satisfied";s:1:"0";s:15:"have_suggestion";s:1:"0";}s:23:"family_vehicle_type_map";a:1:{s:15:"vehicle_type_id";a:1:{i:0;s:1:"4";}}s:20:"family_appliance_map";a:1:{s:18:"house_appliance_id";a:1:{i:0;s:1:"8";}}s:14:"house_road_map";a:1:{s:12:"road_type_id";s:1:"4";}s:30:"house_public_utility_proximity";a:1:{s:17:"public_utility_id";a:1:{i:0;s:1:"1";}}s:22:"house_water_source_map";a:1:{s:21:"house_water_source_id";a:2:{i:0;s:1:"2";i:1;s:1:"3";}}s:49:"house_biodegradable_waste_management_solution_map";a:1:{s:25:"biodegradable_solution_id";a:1:{i:0;s:1:"1";}}s:52:"house_nonbiodegradable_waste_management_solution_map";a:1:{s:28:"nonbiodegradable_solution_id";a:1:{i:0;s:1:"3";}}s:29:"family_domestic_fuel_type_map";a:1:{s:21:"domestic_fuel_type_id";a:1:{i:0;s:1:"3";}}s:14:"family_pet_map";a:2:{s:6:"pet_id";N;s:11:"has_license";N;}s:20:"family_livestock_map";a:1:{s:12:"livestock_id";a:1:{i:0;s:1:"3";}}s:31:"family_agriculture_location_map";a:1:{s:23:"agriculture_location_id";a:1:{i:0;s:1:"2";}}s:19:"land_fruit_tree_map";a:1:{s:13:"fruit_tree_id";a:1:{i:0;s:1:"1";}}s:18:"land_cash_crop_map";a:1:{s:12:"cash_crop_id";a:1:{i:0;s:1:"1";}}s:35:"surveyee_user_bank_account_type_map";a:1:{s:20:"bank_account_type_id";a:2:{i:0;s:1:"1";i:1;s:1:"3";}}s:33:"surveyee_user_investment_type_map";a:1:{s:18:"investment_type_id";a:1:{i:0;s:1:"1";}}s:23:"family_loan_purpose_map";a:1:{s:15:"loan_purpose_id";a:1:{i:0;s:1:"4";}}}
// SURVEY ID 2 : INDU : a:27:{s:18:"surveyee_users_new";a:2:{i:0;a:20:{s:4:"name";s:4:"Indu";s:6:"gender";s:1:"1";s:11:"election_id";s:11:"ele-ind-838";s:9:"aadhar_id";s:12:"adh-ind-3333";s:11:"reservation";s:1:"0";s:13:"mobile_number";s:10:"8773636332";s:8:"email_id";s:14:"indu@gmail.com";s:15:"whatsapp_number";s:10:"8837383782";s:16:"is_head_of_house";s:1:"1";s:29:"relationship_to_head_of_house";s:1:"0";s:19:"employment_category";s:1:"4";s:25:"educational_qualification";s:1:"7";s:13:"date_of_birth";s:10:"1976-06-11";s:14:"marital_status";s:1:"2";s:12:"has_passport";s:1:"1";s:19:"has_driving_license";s:1:"1";s:16:"has_bank_account";s:1:"1";s:11:"blood_group";s:1:"5";s:15:"pension_type_id";s:1:"0";s:17:"insurance_type_id";s:1:"0";}i:1;a:20:{s:4:"name";s:5:"Honey";s:6:"gender";s:1:"2";s:11:"election_id";s:9:"ele-sd-34";s:9:"aadhar_id";s:9:"adh-34k34";s:11:"reservation";s:1:"0";s:13:"mobile_number";s:10:"9838383838";s:8:"email_id";s:15:"honey@gmail.com";s:15:"whatsapp_number";s:10:"8828282828";s:16:"is_head_of_house";s:1:"0";s:29:"relationship_to_head_of_house";s:2:"10";s:19:"employment_category";s:1:"6";s:25:"educational_qualification";s:1:"7";s:13:"date_of_birth";s:10:"1966-08-09";s:14:"marital_status";s:1:"2";s:12:"has_passport";s:1:"1";s:19:"has_driving_license";s:1:"1";s:16:"has_bank_account";s:1:"1";s:11:"blood_group";s:1:"7";s:15:"pension_type_id";s:1:"0";s:17:"insurance_type_id";s:1:"0";}}s:11:"address_new";a:4:{s:16:"address_house_no";s:5:"kp-34";s:18:"address_house_name";s:12:"kalappurayil";s:19:"address_street_name";s:16:"kareelakulangara";s:15:"address_pincode";s:7:"9393939";}s:4:"TEMP";a:5:{s:12:"is_own_house";s:1:"1";s:14:"RESIDENCE_TYPE";s:1:"2";s:14:"LAND_OWNERSHIP";s:1:"1";s:14:"IS_LEGACY_LAND";s:1:"1";s:16:"YEARS_OF_STAYING";s:1:"7";}s:6:"houses";a:8:{s:19:"house_area_range_id";s:1:"2";s:10:"num_floors";s:1:"1";s:9:"num_rooms";s:1:"3";s:26:"largest_accessible_vehicle";s:1:"6";s:30:"nearest_auto_stand_access_time";s:1:"2";s:30:"connection_type_to_septic_tank";s:1:"1";s:12:"toilet_count";s:1:"1";s:14:"is_electrified";s:1:"1";}s:5:"lands";a:1:{s:10:"area_range";s:1:"4";}s:20:"house_house_type_map";a:1:{s:13:"house_type_id";a:1:{i:0;s:1:"5";}}s:20:"house_floor_type_map";a:1:{s:13:"floor_type_id";a:1:{i:0;s:1:"2";}}s:9:"house_tax";a:1:{s:6:"amount";s:3:"600";}s:14:"surveyee_users";a:13:{s:21:"belief_in_religion_id";s:1:"1";s:15:"landline_number";s:6:"776655";s:21:"is_member_ayalkoottam";s:1:"0";s:28:"is_office_bearer_ayalkoottam";s:1:"0";s:25:"is_member_political_party";s:1:"0";s:38:"is_memeber_socio_cultural_organization";s:1:"0";s:39:"is_office_bearer_religious_organization";s:1:"0";s:17:"is_member_library";s:1:"0";s:18:"is_birth_same_ward";s:1:"1";s:17:"ifnot_birth_place";N;s:24:"has_credit_or_debit_card";s:1:"1";s:20:"has_internet_banking";s:1:"1";s:18:"has_mobile_banking";s:1:"0";}s:8:"families";a:3:{s:14:"ration_card_no";s:10:"rat-aji-23";s:19:"ration_card_type_id";s:1:"1";s:15:"has_agriculture";s:1:"1";}s:24:"ward_sabha_participation";a:4:{s:6:"status";s:1:"1";s:6:"reason";s:1:"3";s:12:"is_satisfied";s:1:"0";s:15:"have_suggestion";s:1:"1";}s:23:"family_vehicle_type_map";a:1:{s:15:"vehicle_type_id";a:1:{i:0;s:1:"5";}}s:20:"family_appliance_map";a:1:{s:18:"house_appliance_id";a:3:{i:0;s:1:"8";i:1;s:1:"9";i:2;s:2:"10";}}s:14:"house_road_map";a:1:{s:12:"road_type_id";s:1:"4";}s:30:"house_public_utility_proximity";a:1:{s:17:"public_utility_id";a:1:{i:0;s:1:"1";}}s:22:"house_water_source_map";a:1:{s:21:"house_water_source_id";a:2:{i:0;s:1:"2";i:1;s:1:"3";}}s:49:"house_biodegradable_waste_management_solution_map";a:1:{s:25:"biodegradable_solution_id";a:1:{i:0;s:1:"1";}}s:52:"house_nonbiodegradable_waste_management_solution_map";a:1:{s:28:"nonbiodegradable_solution_id";a:1:{i:0;s:1:"3";}}s:29:"family_domestic_fuel_type_map";a:1:{s:21:"domestic_fuel_type_id";a:1:{i:0;s:1:"3";}}s:14:"family_pet_map";a:2:{s:6:"pet_id";N;s:11:"has_license";N;}s:20:"family_livestock_map";a:1:{s:12:"livestock_id";N;}s:31:"family_agriculture_location_map";a:1:{s:23:"agriculture_location_id";a:1:{i:0;s:1:"2";}}s:19:"land_fruit_tree_map";a:1:{s:13:"fruit_tree_id";a:1:{i:0;s:1:"1";}}s:18:"land_cash_crop_map";a:1:{s:12:"cash_crop_id";a:1:{i:0;s:1:"1";}}s:35:"surveyee_user_bank_account_type_map";a:1:{s:20:"bank_account_type_id";a:1:{i:0;s:1:"1";}}s:33:"surveyee_user_investment_type_map";a:1:{s:18:"investment_type_id";a:1:{i:0;s:1:"1";}}s:23:"family_loan_purpose_map";a:1:{s:15:"loan_purpose_id";a:2:{i:0;s:1:"2";i:1;s:1:"4";}}}
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
