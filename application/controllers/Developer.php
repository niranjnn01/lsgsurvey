<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Developer extends CI_Controller {


	function __construct() {

		parent::__construct();


		$this->load->model('common_model');
	}

	function complete_survey() {



				$bProceed = TRUE;

				$sErrorMessage = '';
				$aJsonData = array('error' => '');

				// if all ok, then proceed to save Survey Data.
				if($bProceed) {


					$iTemporarySurveyNumber = 1;

					$this->load->model('survey_model_new');

					$aJsonData['survey_id'] = $this->survey_model_new->createSurvey($iTemporarySurveyNumber);

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

}

/* End of file developer.php */
/* Location: ./application/controllers/developer.php */
