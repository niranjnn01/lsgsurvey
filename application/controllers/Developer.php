<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Developer extends CI_Controller {


	function __construct() {

		parent::__construct();


		$this->load->model('common_model');
	}


	public function temporary_data_to_delete() {

		$this->db->where('id', 6);
		$aRow = $this->db->get('temporary_survey')->row();

		$aData = unserialize($aRow->raw_data);

		$aData['surveyee_users']['is_member_political_party'] = 0;
		$aData['surveyee_users']['is_memeber_socio_cultural_organization'] = 0;
		$aData['surveyee_users']['is_member_library'] = 0;

		$aData['TEMP']['HAS_DOMESTIC_ANIMALS'] = 0;
		$aData['ward_sabha_participation']['status'] = 0;
		$aData['ward_sabha_participation']['is_satisfied'] = 0;

		$aData['family_pet_map']['has_license'] = 0;

/*
		p($aData);
		exit;
*/

		$this->db->where('id', 6);
		$this->db->set('raw_data', serialize($aData));
		$aRow = $this->db->update('temporary_survey');

//		p($aData);
	}




	function clear_uploads() {

		$this->load->helper('upload_queue');
		clearUploadQueue();
	}

	function upload() {

		log_message('error', p($_POST, true));
	}

	function incoming_file() {

		log_message('error', p($_POST, true));
	}


	function address_test() {

		$this->load->helper('address');
		$this->load->config('address_config');


		$this->mcontents['page_heading'] = $this->mcontents['page_title'] 		= '';

		$this->load->model('address_model');
		$this->mcontents['oAddressItemForEdit'] = $this->address_model->get_address_and_contact_numbers(28614764);

		if( isset($_POST) && ! empty($_POST) ) {

			//p($_POST);



			$this->address_model->update_address_and_contact_numbers($this->mcontents['oAddressItemForEdit']);

		}

		$this->mcontents['sAddressCreateForm'] = getAddressCreateForm();

		//$this->mcontents['oAddressDetails'] = $this->address_model->getAddressDetails(28614764);





		//p($this->mcontents['oAddressItemForEdit']);

		$this->mcontents['sAddressUpdateForm'] = getAddressUpdateForm(28614764);

		loadTemplate('developer/address_test');
	}


	function google_maps(){


		$this->load->view('developer/google_maps');
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

    function phpinfo() {
        phpinfo();
    }
}

/* End of file developer.php */
/* Location: ./application/controllers/developer.php */
