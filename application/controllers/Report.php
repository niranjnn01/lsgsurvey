<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {


	function __construct() {

		parent::__construct();


		$this->load->model('report_model');
	}

	function index() {

			$this->mcontents['num_people_with_degree'] = $this->report_model->num_peopleWithDegree();
			$this->mcontents['num_houses_without_toilets'] = $this->report_model->num_housesWithoutToilets();
			$this->mcontents['num_APL_families'] = $this->report_model->num_APLFamilies();
			$this->mcontents['num_BPL_families'] = $this->report_model->num_BPLFamilies();


			$this->mcontents['page_heading'] = 'Reports';
			loadAdminTemplate('report/index');
	}




}

/* End of file developer.php */
/* Location: ./application/controllers/developer.php */
