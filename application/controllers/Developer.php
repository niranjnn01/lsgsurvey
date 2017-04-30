<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Developer extends CI_Controller {


	function __construct() {

		parent::__construct();


		$this->load->model('common_model');
	}

	function index() {
		p(s('ACCOUNT_NO'));
		$this->load->model('survey_model');
		$oTemporarySurvey = $this->survey_model->getCurrentTemporarySurvey(s('ACCOUNT_NO'));
		p($this->db->last_query());
		p($oTemporarySurvey);
	}


	function complete_survey() {



				$bProceed = TRUE;

				$sErrorMessage = '';
				$aJsonData = array('error' => '');

				// if all ok, then proceed to save Survey Data.
				if($bProceed) {


					$iTemporarySurveyNumber = 1;

					$this->load->model('survey_model');

					$aJsonData['survey_id'] = $this->survey_model->createSurvey($iTemporarySurveyNumber);

					if($sErrorMessage) {
						$aJsonData['error'] = $sErrorMessage;
					} else {
						$aJsonData['success'] = '1';
					}

				}




	}

	function preview_data($iTemporarySurveyId) {

		$this->db->where('id', $iTemporarySurveyId);
		$this->mcontents['oRow'] = $this->db->get('temporary_survey')->row();

		loadTemplate('survey/preview_data');
		//p( unserialize($oRow->general_data) );
	}

	function sync_demo_data() {
		$this->db->where('pushed_to_main', 0);
		$this->db->where('id', 17);
		foreach($this->db->get('temporary_survey')->result() AS $oItem) {
			$this->survey_model->createSurvey($oItem->id);
		}
	}


function question_master_data() {


	p($this->question_model->getQuestionMasterData());
}



	function show_log() {

		$sFilePath = APPPATH . '/logs/';

		$sFileName = 'log-' . date('Y-m-d') . '.php';
		$sText = file_get_contents($sFilePath . $sFileName);
		$sText = str_replace("\n","<br/>",$sText);
		echo $sText;
	}


	function purge_log(  ) {

		$sFileName = 'log-' . date('Y-m-d') . '.php';
		purge_log($sFileName);
		redirect('developer/show_log');
	}

	function truncate_all_data_________use_only_when_neeeded() {

		$aTables = array(

			'families',
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

			'houses',
			'house_biodegradable_waste_management_solution_map',
			'house_floor_type_map',
			'house_house_type_map',
			'house_nonbiodegradable_waste_management_solution_map',
			'house_public_utility_proximity',
			'house_road_map',
			'house_tax',
			'house_water_source_map',

			'lands',
			'land_cash_crop_map',
			'land_fruit_tree_map',
			'land_house_map',

			'surveyee_users',
			'surveyee_user_bank_account_type_map',
			'surveyee_user_family_map',
			'surveyee_user_investment_type_map',
			'surveyee_user_payment_type_map',

			'surveys',

			'temporary_survey',

			'ward_sabha_participation'
		);

		foreach($aTables AS $sTableName) {
			$this->db->truncate($sTableName);
		}

	}

}

/* End of file developer.php */
/* Location: ./application/controllers/developer.php */
