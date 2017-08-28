<?php
class Retrival_model extends CI_Model{

	function __construct(){
		parent::__construct();


	}




	function getTotalSurveys($aWhere) {

		$this->db->where($aWhere);
		$this->db->join('survey_statuses SS', 'SS.id = S.status', 'LEFT');
		$query = $this->db->get('surveys S');

		return $query->num_rows();
	}


		function getTotalTemporarySurveys($aWhere) {

			$this->db->where($aWhere);
			$this->db->join('temporary_survey_statuses TSS', 'TSS.id = TS.status', 'LEFT');
			$query = $this->db->get('temporary_survey TS');

			return $query->num_rows();
		}


	/**
	 * get a list of Surveys
	 *
	 */
	function getSurveys( $iLimit=0, $iOffset=0, $aWhere=array(), $aOrderBy=array() ) {

		$this->db->select('
						  S.*,
							CONCAT_WS(" ", U.first_name, U.last_name) full_name
						  ', false);

		if($iLimit || $iOffset){
			$this->db->limit($iLimit, $iOffset);
		}

		if($aWhere){
			$this->db->where($aWhere, false);
		}

		if($aOrderBy){
			foreach($aOrderBy AS $key=>$value){
				$this->db->order_by($key, $value);
			}
		}

    $this->db->join('survey_statuses SS', 'SS.id = S.status', 'LEFT');
		$this->db->join('users U', 'S.enumerator_account_no = U.account_no', 'LEFT');

		return $this->db->get('surveys S')->result();
	}



	/**
	 * get a list of Temporary Surveys
	 *
	 */
	function getTemporarySurveys( $iLimit=0, $iOffset=0, $aWhere=array(), $aOrderBy=array() ) {

		$this->db->select('
							TS.id temporary_survey_id,
							TS.created_on,
							CONCAT_WS(" ", U.first_name, U.last_name) full_name
							', false);

		if($iLimit || $iOffset){
			$this->db->limit($iLimit, $iOffset);
		}

		if($aWhere){
			$this->db->where($aWhere, false);
		}

		if($aOrderBy){
			foreach($aOrderBy AS $key=>$value){
				$this->db->order_by($key, $value);
			}
		}

		$this->db->join('temporary_survey_statuses TSS', 'TSS.id = TS.status', 'LEFT');
		$this->db->join('users U', 'TS.enumerator_account_no = U.account_no', 'LEFT');

		return $this->db->get('temporary_survey TS')->result();
	}

}
