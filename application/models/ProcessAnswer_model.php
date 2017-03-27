<?php
class Processanswer_model extends CI_Model{

	function __construct(){
		parent::__construct();

		$this->iEnumeratorAccountNo = s('ACCOUNT_NO');

	}




	function processAnswerForQuestion_1() {

		$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));

		if($oRow = $this->db->get('temporary_survey')->row()) {

			$aData = unserialize($oRow->general_data);

			$aData['name'] = safeText('single_value_text');

			$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData, 'general_data');

		}

		$iAnswerProcessingStatus = 1;
		$sError = '';
		return array($iAnswerProcessingStatus, $sError);
	}




		function processAnswerForQuestion_2() {

			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));

			if($oRow = $this->db->get('temporary_survey')->row()) {

				$aData = unserialize($oRow->general_data);

				$aData['address'] = safeText('single_value_textarea');

				$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData, 'general_data');

			}

			$iAnswerProcessingStatus = 1;
			$sError = '';
			return array($iAnswerProcessingStatus, $sError);
		}



		function processAnswerForQuestion_3() {

			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));

			if($oRow = $this->db->get('temporary_survey')->row()) {

				$aData = unserialize($oRow->house_land_data);

				$aData['house_number'] = safeText('single_value_text');

				$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData, 'house_land_data' );

			}

			$iAnswerProcessingStatus = 1;
			$sError = '';
			return array($iAnswerProcessingStatus, $sError);
		}

		function processAnswerForQuestion_4() {

			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));

			if($oRow = $this->db->get('temporary_survey')->row()) {

				$aData = unserialize($oRow->general_data);

				$aData['aadhaar_number'] = safeText('single_value_text');

				$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData, 'general_data' );

			}

			$iAnswerProcessingStatus = 1;
			$sError = '';
			return array($iAnswerProcessingStatus, $sError);
		}

		function processAnswerForQuestion_5() {

			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));

			if($oRow = $this->db->get('temporary_survey')->row()) {

				$aData = unserialize($oRow->general_data);

				$aData['election_id'] = safeText('single_value_text');

				$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData, 'general_data' );

			}

			$iAnswerProcessingStatus = 1;
			$sError = '';
			return array($iAnswerProcessingStatus, $sError);
		}


		function processAnswerForQuestion_6() {

			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));

			if($oRow = $this->db->get('temporary_survey')->row()) {

				$aData = unserialize($oRow->house_land_data);

				$aData['house_ownership_type'] = safeText('single_value_radio');

				$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData, 'house_land_data' );

			}

			$iAnswerProcessingStatus = 1;
			$sError = '';
			return array($iAnswerProcessingStatus, $sError);
		}


		function processAnswerForQuestion_7() {

			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));

			if($oRow = $this->db->get('temporary_survey')->row()) {

				$aData = unserialize($oRow->house_land_data);

				$aData['land_ownership_type'] = safeText('single_value_radio');

				$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData, 'house_land_data' );

			}

			$iAnswerProcessingStatus = 1;
			$sError = '';
			return array($iAnswerProcessingStatus, $sError);
		}


		function processAnswerForQuestion_8() {

			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));

			if($oRow = $this->db->get('temporary_survey')->row()) {

				$aData = unserialize($oRow->house_land_data);

				$aData['house_area_range'] = safeText('single_value_radio');

				$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData, 'house_land_data' );

			}

			$iAnswerProcessingStatus = 1;
			$sError = '';
			return array($iAnswerProcessingStatus, $sError);
		}

		function processAnswerForQuestion_9() {

			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));

			if($oRow = $this->db->get('temporary_survey')->row()) {

				$aData = unserialize($oRow->house_land_data);

				$aData['land_area_range'] = safeText('single_value_radio');

				$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData, 'house_land_data' );

			}

			$iAnswerProcessingStatus = 1;
			$sError = '';
			return array($iAnswerProcessingStatus, $sError);
		}

		function processAnswerForQuestion_10() {

			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));

			if($oRow = $this->db->get('temporary_survey')->row()) {

				$aData = unserialize($oRow->house_land_data);

				$aData['house_type'] = safeText('multi_value_checkbox');

				$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData, 'house_land_data' );

			}

			$iAnswerProcessingStatus = 1;
			$sError = '';
			return array($iAnswerProcessingStatus, $sError);
		}
		
		function processAnswerForQuestion_11() {

			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));

			if($oRow = $this->db->get('temporary_survey')->row()) {

				$aData = unserialize($oRow->house_land_data);

				$aData['house_floors'] = safeText('single_value_radio');

				$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData, 'house_land_data' );

			}

			$iAnswerProcessingStatus = 1;
			$sError = '';
			return array($iAnswerProcessingStatus, $sError);
		}
		function processAnswerForQuestion_12() {

			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));

			if($oRow = $this->db->get('temporary_survey')->row()) {

				$aData = unserialize($oRow->house_land_data);

				$aData['house_basement'] = safeText('multi_value_checkbox');

				$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData, 'house_land_data' );

			}

			$iAnswerProcessingStatus = 1;
			$sError = '';
			return array($iAnswerProcessingStatus, $sError);
		}
		function processAnswerForQuestion_13() {

			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));

			if($oRow = $this->db->get('temporary_survey')->row()) {

				$aData = unserialize($oRow->house_land_data);

				$aData['house_basement'] = safeText('multi_value_checkbox');

				$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData, 'house_land_data' );

			}

			$iAnswerProcessingStatus = 1;
			$sError = '';
			return array($iAnswerProcessingStatus, $sError);
		}
		
		
		function processAnswerForQuestion($iQuestionNo){
			$this->load->config('question_config');
			$questions_master_data 	= $this->config->item('questions_master_data');
			$answer_types_details	= $this->config->item('answer_types_details');
			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));

			if($oRow = $this->db->get('temporary_survey')->row()) {
				
				$aData = unserialize($oRow->raw_data);
				$aData[$questions_master_data[$iQuestionNo]['table_name']][$questions_master_data[$iQuestionNo]['field_name']] = safeText($answer_types_details[$questions_master_data[$iQuestionNo]['answer_type']]['field_name']);

				$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData, 'raw_data' );

			}

			$iAnswerProcessingStatus = 1;
			$sError = '';
			return array($iAnswerProcessingStatus, $sError);
		}
		
		function updateTemporaryTable($iEnumeratorAccountNo, $aData, $sGroupName ) {
	
			$sSectionFieldName = $sGroupName;
	
			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));
			$this->db->set($sSectionFieldName, serialize($aData));
			$this->db->update('temporary_survey');
		}


}
