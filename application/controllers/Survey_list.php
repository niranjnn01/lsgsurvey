<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survey_list extends CI_Controller {


	public function __construct(){

		parent::__construct();

		$this->load->model('Retrival_model');

	}


	public function index() {

	}



	/**
	 *
	 * List the completed surveys
	 * @return [type] [description]
	 */
	public function completed() {


		$this->authentication->is_admin_logged_in(true);

		isAdminSection();

		ss('BACKBUTTON_URI', $this->uri->uri_string());

		$this->mcontents['page_heading'] = $this->mcontents['page_title'] = 'Survey - Completed';


		$aWhere = array(
			'SS.name' => 'completed'
		);

		$sStatusName = safeText('status_name', false, 'get');


		$aOrderBy = array('S.created_on' => 'DESC');



		$this->mcontents['iOffset'] = 0;
		$this->mcontents['iPerPage'] = 10;
		$this->mcontents['iLimit'] = 10;

		$this->mcontents['iTotal'] = count( $this->Retrival_model->getTotalSurveys($aWhere) );
		$this->mcontents['aData'] = $this->Retrival_model->getSurveys(
																																		$this->mcontents['iLimit'],
																																		$this->mcontents['iOffset'],
																																		$aWhere,
																																		$aOrderBy);

//p($this->mcontents['aData']);

		/* Pagination */
		$sUriSegment = 'survey_list/completed';
		$sUriString = preprocess_query_string_for_pagination($sUriSegment);

		$this->load->library('pagination');
		$this->aPaginationConfiguration = array();
		$this->aPaginationConfiguration['base_url'] 	= c('base_url') . $sUriSegment . '?' . $sUriString;
		$this->aPaginationConfiguration['total_rows'] 	= $this->mcontents['iTotal'];
		$this->aPaginationConfiguration['per_page'] 	= $this->mcontents['iPerPage'];
		$this->aPaginationConfiguration['page_query_string'] = TRUE;
		$this->pagination->customizePagination();
		//$this->mcontents['load_css'][] = 'pagination.css';
		$this->pagination->initialize($this->aPaginationConfiguration);
		$this->mcontents['sPagination'] = $this->pagination->create_links();
		/* Pagination - End*/


		$this->mcontents['sCurrentMainMenuChild'] = 'surveys-completed';
		$this->mcontents['sCurrentMainMenu'] = 'survey';

		loadAdminTemplate('survey_list/completed');
	}



	/**
	 *
	 * List the completed surveys
	 * @return [type] [description]
	 */
	public function in_progress() {

		$this->authentication->is_admin_logged_in(true);

		isAdminSection();

		ss('BACKBUTTON_URI', $this->uri->uri_string());

		$this->mcontents['page_heading'] = $this->mcontents['page_title'] = 'Survey - In progress';


		$aWhere = array(
			'TSS.name' => 'in-progress'
		);

		$sStatusName = safeText('status_name', false, 'get');



		$aOrderBy = array('TS.created_on' => 'DESC');



		$this->mcontents['iOffset'] = 0;
		$this->mcontents['iPerPage'] = 10;
		$this->mcontents['iLimit'] = 10;

		$this->mcontents['iTotal'] = count( $this->Retrival_model->getTotalTemporarySurveys($aWhere) );
		$this->mcontents['aData'] = $this->Retrival_model->getTemporarySurveys(
																																		$this->mcontents['iLimit'],
																																		$this->mcontents['iOffset'],
																																		$aWhere,
																																		$aOrderBy);

//p($this->mcontents['aData']);

		/* Pagination */
		$sUriSegment = 'survey_list/in_progress';
		$sUriString = preprocess_query_string_for_pagination($sUriSegment);

		$this->load->library('pagination');
		$this->aPaginationConfiguration = array();
		$this->aPaginationConfiguration['base_url'] 	= c('base_url') . $sUriSegment . '?' . $sUriString;
		$this->aPaginationConfiguration['total_rows'] 	= $this->mcontents['iTotal'];
		$this->aPaginationConfiguration['per_page'] 	= $this->mcontents['iPerPage'];
		$this->aPaginationConfiguration['page_query_string'] = TRUE;
		$this->pagination->customizePagination();
		//$this->mcontents['load_css'][] = 'pagination.css';
		$this->pagination->initialize($this->aPaginationConfiguration);
		$this->mcontents['sPagination'] = $this->pagination->create_links();
		/* Pagination - End*/


		$this->mcontents['sCurrentMainMenuChild'] = 'surveys-in-progress';
		$this->mcontents['sCurrentMainMenu'] = 'survey';

		loadAdminTemplate('survey_list/in_progress');
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin/admin.php */
