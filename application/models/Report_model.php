<?php
class Report_model extends CI_Model{

	function __construct(){

		parent::__construct();
	}


	function num_peopleWithDegree() {

		$this->db->where('AO_EQ.name', 'degree');
		$this->db->join('ans_option_educational_qualification AO_EQ', 'AO_EQ.id = SU.educational_qualification');
		$query = $this->db->get('surveyee_users SU');

		return $query->num_rows();
	}


	function num_housesWithoutToilets() {

		$this->db->where('AO_NT.name', 'nil');
		$this->db->join('ans_option_num_toilets AO_NT', 'AO_NT.id = H.toilet_count');
		$query = $this->db->get('houses H');

		return $query->num_rows();
	}


	function num_BPLFamilies() {

		$this->db->where('AO_RCT.name', 'priority-bpl');
		$this->db->join('ans_option_ration_card_types AO_RCT', 'AO_RCT.id = F.ration_card_type_id');
		$query = $this->db->get('families F');

		return $query->num_rows();
	}


	function num_APLFamilies() {

		$this->db->where('AO_RCT.name', 'non-priority-apl');
		$this->db->join('ans_option_ration_card_types AO_RCT', 'AO_RCT.id = F.ration_card_type_id');
		$query = $this->db->get('families F');

		return $query->num_rows();
	}

}
