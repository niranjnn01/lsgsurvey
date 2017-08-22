<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Search_template extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->model('question_model');
	}

	function generate_template() {

		$aQuestionUnames = array();
		$aQuestionUnames['aColumn_1'] = array(

			// search by head of house
			'name', 'gender', 'reservation', 'mobile_number',
			'years_of_staying', 'is_own_house',

			// ward sabha participation
			'status', 'reason', 'is_satisfied', 'have_suggestion',

			// vehicle
			'vehicle_type_id', 'nearest_auto_stand_access_time',


		);

		$aQuestionUnames['aColumn_2'] = array(

			'house_appliance_id',
			
			// search by address
			'address_house_no', 'address_house_name', 'address_street_name', 'address_pincode',

			// search by house and land details
			'residence_type', 'land_ownership', 'is_legacy_land', 'house_area_range_id', 'area_range',
		);

		$aQuestionUnames['aColumn_3'] = array(

			// search by house and land details
			'house_type_id', 'num_floors', 'floor_type_id', 'num_rooms',
			'largest_accessible_vehicle', 'road_type_id',
			'ration_card_no', 'ration_card_type_id',
			'public_utility_id'
		);
		$aQuestionUnames['aColumn_4'] = array(
			'house_water_source_id', 'connection_type_to_septic_tank',
			'toilet_count', 'biodegradable_solution_id', 'nonbiodegradable_solution_id',
			'is_electrified', 'domestic_fuel_type_id'
		);

		// pets / farming and livestock
		$aQuestionUnames['aColumn_5'] = array(
			'pet_id', 'has_license', 'livestock_id', 'has_agriculture', 'agriculture_location_id', 'fruit_tree_id',
			'cash_crop_id'
		);



		// banking / finance
		$aQuestionUnames['aColumn_6'] = array(
			'bank_account_type_id', 'has_credit_or_debit_card', 'has_internet_banking', 'has_mobile_banking',
			'investment_type_id', 'loan_purpose_id', 'loan_source_id'
		);



		$aQuestionsMasterData_raw = $this->question_model->getQuestionMasterData_raw();

		$aQuestionUid_QuestionUname_map = array();
		foreach($aQuestionsMasterData_raw AS $iQuid => $aQuestionDetails) {
			$aQuestionUid_QuestionUname_map[$iQuid] = $aQuestionDetails['uname'];
		}

		$aQuestionUname_QuestionUid_map = array_flip($aQuestionUid_QuestionUname_map);


		$sHtml = '
<?php
/**
 *
 * THIS IS A PROGRAMATICALLY GENERATED FILE. DO NOT EDIT DIRECTLY.
 *
 */
?>
		<div class="row">';


		// construct body of template
		foreach($aQuestionUnames AS $aColumn_Unames) {

			$sHtml .= '<div class="col-md-2">';

			foreach($aColumn_Unames AS $sUname) {

				$iUid = $aQuestionUname_QuestionUid_map[$sUname];
				$sHtml .= $this->question_model->constructFormRow_forSearch($aQuestionsMasterData_raw[$iUid]);
			}

			$sHtml .= '</div>';
		}

		$sHtml .= '</div>';


		// write the template to file
		$sFilename = APPPATH . 'views/search_template/generated_template_1.php';
		$file_pointer = fopen($sFilename, 'w');
		fwrite($file_pointer,$sHtml);
		fclose($file_pointer);


	}
}

/* End of file Search_template.php */
/* Location: ./application/controllers/Search_template.php */
