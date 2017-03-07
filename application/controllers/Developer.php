<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Developer extends CI_Controller {


	function __construct() {

		parent::__construct();


		$this->load->model('common_model');
	}


	public function test_uploader() {


		if( isset($_POST) && ! empty($_POST) ) {

				p($_POST);exit;
		}


		$this->load->library('lib_upload');


		$sScenario = 'resource';
		$iNumUploads = 1;

		// get the iframe URL
		$this->mcontents['sFileUpload_IframeURL'] = $this->mcontents['c_base_url'] . 'uploader' . '?'.
																							'scenario=' . $sScenario .
																							'&num_uploads=' . $iNumUploads
																							;

		loadTemplate('developer/test_uploader');

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
