<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Search extends CI_Controller {

	public function __construct(){

		parent::__construct();

	}


	/**
	 * display the settings page
	 *
	 */
	public function index() {

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
