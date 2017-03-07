<?php
class ProcessAnswer_model extends CI_Model{

	function __construct(){
		parent::__construct();

		$this->iEnumeratorAccountNo = s('ACCOUNT_NO');

	}


	function processAnswerForQuestion_1() {

		$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));

		if($oRow = $this->db->get('temporary_survey')->row()) {

			$aData = unserialize($oRow->data);

			$aData['name'] = safeText('single_value_text');

			$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData );


		}

		$iAnswerProcessingStatus = 1;
		$sError = '';
		return array($iAnswerProcessingStatus, $sError);
	}



	function processAnswerForQuestion_2() {

		$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));

		if($oRow = $this->db->get('temporary_survey')->row()) {

			$aData = unserialize($oRow->data);

			$aData['aadhaar_number'] = safeText('single_value_text');

			$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData );


		}

		$iAnswerProcessingStatus = 1;
		$sError = '';
		return array($iAnswerProcessingStatus, $sError);
	}

		function processAnswerForQuestion_3() {

			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));

			if($oRow = $this->db->get('temporary_survey')->row()) {

				$aData = unserialize($oRow->data);

				$aData['election_id'] = safeText('single_value_text');

				$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData );


			}

			$iAnswerProcessingStatus = 1;
			$sError = '';
			return array($iAnswerProcessingStatus, $sError);
		}


	function updateTemporaryTable($iEnumeratorAccountNo, $aData ) {


		$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));
		$this->db->set('data', serialize($aData));
		$this->db->update('temporary_survey');
	}


}
