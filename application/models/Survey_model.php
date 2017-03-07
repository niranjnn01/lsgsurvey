<?php
class Survey_model extends CI_Model{

	function __construct(){
		parent::__construct();

	}

	/**
	 *
	 * Create temporary survey for the currently logged in enumerator
	 * @return [type] [description]
	 */
	function createTemporarySurvey(){

		$iId = 0;
		$iEnumeratorAccountNo = s('ACCOUNT_NO');
		$sSessionId = session_id();

		$this->db->trans_start();
		$this->db->where('enumerator_account_no', $iEnumeratorAccountNo);
		$this->db->delete('temporary_survey');


		$this->db->set('session_id', $sSessionId);
		$this->db->set('enumerator_account_no', $iEnumeratorAccountNo);
		$this->db->set('data', serialize(array()));
		$this->db->insert('temporary_survey');
		$iId = $this->db->insert_id();

		$this->db->trans_complete();

		return $iId;
	}


		public function getCurrentSurvey() {

			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));
			return $this->db->get('temporary_survey')->row();
		}

		function isValidTemporarySurveyNumber($iTemporarySurveyNumber) {

			$bIsValid = FALSE;

			$this->db->where('id', $iTemporarySurveyNumber);
			$this->db->where('session_id', session_id());
			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));
			if($this->db->get('temporary_survey')->row()) {

				$bIsValid = TRUE;

			}

			return $bIsValid;
		}

}
