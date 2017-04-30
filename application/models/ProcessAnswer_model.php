<?php
class ProcessAnswer_model extends CI_Model{

	function __construct(){
		parent::__construct();

		$this->iEnumeratorAccountNo = s('ACCOUNT_NO');
		$this->load->config('survey_config');

		$this->aReservationCategories = $this->config->item('reservation_categories');
		$this->aReservationCategoriesTitle = $this->config->item('reservation_categories_title');

	}

	/**
	 *
	 *  This is separate function, because there are multiple questions within
	 *  the main question, and multiple answers can be given.
	 *  Hence we have a dedicated funciton to handle this.
	 *
	 * @param  [type] $iQuestionNo [description]
	 * @return [type]              [description]
	 */
	function process_Answers_FamilyQuestion($iCurrentTemporarySurveyId) {

		$this->load->config('question_config');

		$this->load->model('question_model');

		$questions_master_data = $this->question_model->getQuestionMasterData();

		//$questions_master_data 	= $this->config->item('questions_master_data');
		$answer_types_details	= $this->config->item('answer_types_details');


		$this->db->where('id', $iCurrentTemporarySurveyId);
		$oTemporarySurvey = $oRow = $this->db->get('temporary_survey')->row();

		if($oTemporarySurvey) {

			$aData = unserialize($oTemporarySurvey->raw_data);

			//log_message('error', print_r($_POST, true));
			//exit;

			//log_message('error', 'surveyee_users_new : ' . print_r($aData['surveyee_users_new'], true));

			$aNewDataSet = [];

			foreach($_POST AS $aItem) {


				$aInput = array();
				// populate user data
				$aInput['name'] 						= safeText($aItem['name'], false, '', TRUE);
				$aInput['gender'] 					= safeText($aItem['gender'], false, '', TRUE);
				$aInput['aadhar_id'] 			= safeText($aItem['aadhaar_no'], false, '', TRUE);
				$aInput['election_id'] 		= safeText($aItem['election_id'], false, '', TRUE);
				$aInput['mobile_number'] 	= safeText($aItem['mobile_no'], false, '', TRUE);
				$aInput['email_id'] 				= safeText($aItem['email'], false, '', TRUE);
				$aInput['whatsapp_number'] = safeText($aItem['whatsapp_no'], false, '', TRUE);
				$aInput['employment_category'] = safeText($aItem['employment_category'], false, '', TRUE);
				$aInput['educational_qualification'] = safeText($aItem['educational_qualification'], false, '', TRUE);

				// reservation
				if(safeText($aItem['reservation'], false, '', TRUE) == $this->aReservationCategories['scst']) {
					$aInput['is_scst'] = 1;
				} elseif(safeText($aItem['reservation'], false, '', TRUE) == $this->aReservationCategories['obc']) {
					$aInput['is_obc'] = 1;
				}

				// head of family
				$aInput['is_head_of_house'] = safeText($aItem['is_head_of_house'], false, '', TRUE) == 1 ? 1 : 0;

				//relationship with head of family
				if( ! $aInput['is_head_of_house'] ) {
					$aInput['relationship_to_head_of_house'] = safeText($aItem['relationship_to_head_of_house'], false, '', TRUE);
				}


							//to do
				/*
							$aInput['date_of_birth'] = safeText('date_of_birth');
							$aInput['marital_status'] = safeText('marital_status');
							$aInput['has_passport'] = safeText('has_passport');
							$aInput['has_bank_account'] = safeText('has_bank_account');
							$aInput['has_driving_license'] = safeText('has_driving_license');
							$aInput['blood_group'] = safeText('blood_group');
							$aInput['has_pension'] = safeText('has_pension');
							$aInput['has_insurance'] = safeText('has_insurance');
				*/

				$aNormalizedInput = array(
					'name' => '',
					'gender' => NULL,
					'aadhar_id' => '',
					'election_id' => '',
					'mobile_number' => '',
					'email_id' => '',
					'whatsapp_number' => '',
					'employment_category' => NULL,
					'educational_qualification' => NULL,
					'is_head_of_house' => NULL,
					'relationship_to_head_of_house' => NULL,
					'reservation' => NULL,
				);

				$aInput = array_merge($aNormalizedInput, $aInput);

				$aNewDataSet[] = $aInput;
			}


			//log_message('error', 'aNewDataSet : ' . print_r($aNewDataSet, true));

			// overwirite any existing data and store the new set of informations.
			$aData['surveyee_users_new'] = $aNewDataSet;

			// verify, that there is a head of family, and that there is only one head of family


			$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData, 'raw_data' );

		}

		$iAnswerProcessingStatus = 1;
		$sError = '';
		return array($iAnswerProcessingStatus, $sError);
	}


function process_Answers_Address_Question () {


			//$this->load->config('question_config');

			//$questions_master_data 	= $this->config->item('questions_master_data');
			//$answer_types_details	= $this->config->item('answer_types_details');

			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));
			$oTemporarySurvey = $oRow = $this->db->get('temporary_survey')->row();

			if($oTemporarySurvey) {

				$aData = unserialize($oTemporarySurvey->raw_data);

				$aInput = array();

				$aInput['house_no'] 		= safeText('address_house_no');
				$aInput['house_name'] 	= safeText('address_house_name');
				$aInput['street_name'] 	= safeText('address_street_name');
				$aInput['pincode'] 			= safeText('address_pincode');

				$aNormalizedInput = array(
					'house_no' 		=> '',
				  'house_name' 	=> '',
				  'street_name' => '',
				  'pincode' 		=> '',
				);

				$aInput = array_merge($aNormalizedInput, $aInput);


				$aData['address_new'] = $aInput;

				$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData, 'raw_data' );

			}

			$iAnswerProcessingStatus = 1;
			$sError = '';
			return array($iAnswerProcessingStatus, $sError);

}


		function processAnswerForQuestion($iQuestionNo){

			$this->load->config('question_config');

			$this->load->model('question_model');


			$questions_master_data 	= $this->question_model->getQuestionMasterData();
			$answer_types_details	= $this->config->item('answer_types_details');

			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));
			$oTemporarySurvey = $oRow = $this->db->get('temporary_survey')->row();



			if($oTemporarySurvey) {

				$bIsSkippedQuestion = FALSE;

				$this->load->model('question_model');
				$aQuestionData = $this->question_model->normalizeQuestion($questions_master_data[$iQuestionNo]);

				$aData = unserialize($oTemporarySurvey->raw_data);

				if($bIsSkippedQuestion == TRUE) {
					$value = $aQuestionData['default_value'];
				} else {
					$value = safeText($answer_types_details[$questions_master_data[$iQuestionNo]['answer_type']]['field_name']);
				}

				$aData[$questions_master_data[$iQuestionNo]['table_name']][$questions_master_data[$iQuestionNo]['field_name']] = $value;

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
