<?php
class Processanswer_model
 extends CI_Model{

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


		$iAnswerProcessingStatus = 1;
		$sError = '';

		$this->load->config('question_config');

		$this->load->model('question_model');

		$questions_master_data = $this->question_model->getQuestionMasterData();

		//$questions_master_data 	= $this->config->item('questions_master_data');
		$answer_types_details	= $this->config->item('answer_types_details');


		$this->db->where('id', $iCurrentTemporarySurveyId);
		$oTemporarySurvey = $oRow = $this->db->get('temporary_survey')->row();

		if($oTemporarySurvey) {

			$aData = unserialize($oTemporarySurvey->raw_data);

			log_message('error', print_r($_POST, true));
			//exit;

			//log_message('error', 'surveyee_users_new : ' . print_r($aData['surveyee_users_new'], true));

			$aNewDataSet = [];

			foreach($_POST AS $iKey => $aItem) {

				$aInput = array();

        // field name of form has been modified. there is a row number attached to field names.
        // it(++$iKey) is added in the next "for loop" for convinience.

        $aTableFieldName_to_FormFieldName_map = array(
          'name'                      => 'name',
          'gender'                    => 'gender',
          'aadhar_id'                 => 'aadhaar_no',
          'election_id'               => 'election_id',
          'mobile_number'             => 'mobile_no',
          'email_id'                  => 'email',
          'whatsapp_number'           => 'whatsapp_no',
          'employment_category'       => 'employment_category',
          'educational_qualification' => 'educational_qualification',
          //'reservation'               => 'reservation',

          'date_of_birth'             => 'date_of_birth',
          'marital_status'            => 'marital_status',
          'has_passport'              => 'has_passport',
          'has_driving_license'       => 'has_driving_license',

          'has_bank_account'          => 'has_bank_account',
          'blood_group'               => 'blood_group',
          'pension_type_id'           => 'pension_type_id',
          'insurance_type_id'         => 'insurance_type_id'
        );

				// populate user data
				$iRowNumber = ++$iKey;
				foreach($aTableFieldName_to_FormFieldName_map AS $sTableFieldName => $sFormFieldName) {
          $aInput[$sTableFieldName] = safeText($aItem[$sFormFieldName . $iRowNumber], false, '', TRUE);
        }


				// reservation
				/*
				if(safeText($aItem['reservation'], false, '', TRUE) == $this->aReservationCategories['scst']) {
					$aInput['is_scst'] = 1;
				} elseif(safeText($aItem['reservation'], false, '', TRUE) == $this->aReservationCategories['obc']) {
					$aInput['is_obc'] = 1;
				}
        */

				// head of family
				$aInput['is_head_of_house'] = safeText($aItem['is_head_of_family' . $iRowNumber], false, '', TRUE) == 1 ? 1 : 0;

				//relationship with head of family
				if( ! $aInput['is_head_of_house'] ) {
					$aInput['relationship_to_head_of_house'] = safeText($aItem['relationship_to_head_of_house' . $iRowNumber], false, '', TRUE);
				}




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
      // to do


      //save data to temporary table
			$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData, 'raw_data' );

		}

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

      $sError = '';

			if($oTemporarySurvey) {

				$bIsSkippedQuestion = FALSE;

        // get the individual question
        $aQuestion = $this->question_model->getQuestionDetailsByOrder($iQuestionNo);
//p($aQuestion);
/*
				$this->load->model('question_model');
				$aQuestionData = $this->question_model->normalizeQuestion($aQuestion);
*/
				$aData = unserialize($oTemporarySurvey->raw_data);




        //identify whether a question was skipped or not. and determine value accordingly.
        //TO DO :
        // this is important , because certain answer options are integers, and
        // a non selection of values (i.e., pressing the "next" button) can result
        // in empty string being sent to server as selection.
        /*
        if($bIsSkippedQuestion == TRUE) {
          $value = $aQuestion['default_value'];
        } else {
          $value = safeText($answer_types_details[$aQuestion['answer_type']]['field_name']);
        }
        */
        // TEMPORARY FIX. if value is empty string, then assume the question to be skipped.
        // - select will anyways have a default value LIke for example, "0".
        // - text/ text area etc will given empty string.
        // - for checkbox / radio, the input element will not be present in
        // $_POST array. here,  the safeText() default value will be NULL.
        if(
          safeText($answer_types_details[$aQuestion['answer_type']]['field_name']) == '' ||
          is_null(safeText($answer_types_details[$aQuestion['answer_type']]['field_name']))
        ) {
          $bIsSkippedQuestion == TRUE;
        }


        // get the value
        $value = $aQuestion['default_value'];
        if($bIsSkippedQuestion !== TRUE) {
          $value = safeText($answer_types_details[$aQuestion['answer_type']]['field_name']);
        }


        // check whether the data is valid
        list($bIsValid, $sError) = $this->ci_validation_is_valid($aQuestion, $value);

        if( $bIsValid ) {

  				$aData[$aQuestion['table_name']][$aQuestion['field_name']] = $value;

  				$this->updateTemporaryTable($this->iEnumeratorAccountNo, $aData, 'raw_data' );
        }



			} else {
        $sError = 'T Survey not found.';
      }

			$iAnswerProcessingStatus = 1;

			return array($iAnswerProcessingStatus, $sError);
		}



    /**
     *
     * check whether value is valid or not. using Codeigniter validation class
     */
    function ci_validation_is_valid($aQuestion, $value) {

      $bIsValid = FALSE;
      $sErrorMessage = '';

      if($aQuestion['ci_validation']) {

        $this->load->library('form_validation');

        //set the custom data
        $data = array(
          $aQuestion['field_name'] => $value,
        );
        $this->form_validation->set_data($data);

/*
        log_message('error', var_export($value, TRUE) );
        log_message('error', var_export($aQuestion['field_name'], TRUE) );
        log_message('error', var_export($aQuestion['ci_validation'], TRUE) );
*/

        //set the rules
        $this->form_validation->set_rules($aQuestion['field_name'], $aQuestion['title'], $aQuestion['ci_validation']);


        $bIsValid = $this->form_validation->run();

        // get the error message if any
        $sErrorMessage = $this->form_validation->error_string();

        // CI DOCS : If you want to validate more than one array during a single execution,
        // then you should call the reset_validation() method before
        // setting up rules and validating the new array.
        $this->form_validation->reset_validation();

      } else {

        $bIsValid = TRUE;
      }

      return array($bIsValid, $sErrorMessage );
    }



		function updateTemporaryTable($iEnumeratorAccountNo, $aData, $sGroupName ) {

			$sSectionFieldName = $sGroupName;

			$this->db->where('enumerator_account_no', s('ACCOUNT_NO'));
			$this->db->set($sSectionFieldName, serialize($aData));
			$this->db->update('temporary_survey');
		}


}
