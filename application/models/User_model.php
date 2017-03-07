<?php
class User_model extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->aUserStatus = c('user_status');
		$this->aProfilePicUploadType = c('profile_pic_upload_type');

	}



	/**
	*
	* handles the case where the initial set up is not complete
	*/
	function initialSetupRoutines($iAccountNo, $bDoubleCheck = FALSE) {

		//p('here');exit;
		if($oUser = $this->getUserBy('account_no', $iAccountNo)) {
			/*
			var_dump($bDoubleCheck);
			echo "<br/>";
			var_dump($oUser->initial_setup_complete);
			exit;
			*/

			if($oUser->initial_setup_complete != 1 || $bDoubleCheck) {

				$bElectionIdEmpty 	= FALSE;
				$bMobileNumEmpty 	= FALSE;
				$bMobileNumVerified = FALSE;

				if( is_null($oUser->election_id) || ! $oUser->election_id ) {
					$bElectionIdEmpty = TRUE;
				}
				if( is_null($oUser->mobile_number) || ! $oUser->mobile_number ) {
					$bMobileNumEmpty 	= TRUE;
				}
				if( $oUser->mobile_verification_status != 1 ) {
					$bMobileNumVerified 	= TRUE;
				}

				/*
				var_dump($bElectionIdEmpty);
				echo "<br/>";
				var_dump($bMobileNumEmpty);
				echo "<br/>";
				var_dump($bMobileNumVerified);
				exit;
				*/

				if($bMobileNumEmpty) {

					sf('error_message', 'Enter your mobile number and verify it.');
					redirect('user/add_mobile_number');
				}

				if(!$bMobileNumVerified) {

					sf('error_message', 'Verify your mobile number.');
					redirect('user/verify_mobile_number');
				}

				if($bElectionIdEmpty) {

					sf('error_message', 'Enter your election id.');
					redirect('profile/edit');
				}

			}
		}
	}


	/**
	 * Enter description here...
	 *
	 * @param string $username
	 * @return boolean
	 */
	function isUsernameExists($username){
		$this->db->select('id');
		$this->db->where('username', $username);
		$result	=	$this->db->get ('users');
		$result	=	$result->row();
       	if($result){
       		return $result->id;
       	}
       	return FALSE;
	}

	/**
	 * Used during registration to check if a given email id exists
	 *
	 * @param string $email_id
	 * @param integer $user_id
	 * @return boolean
	 */
	function isEmailExists_old_13Oct2016($email_id, $user_id ='') {

		if( ! $email_id ) {
			return false;
		}

		$this->db->select('id');
		$this->db->where('email_id', $email_id);

		if('' != $user_id && 0 < $user_id) {

			$this->db->where('id <> ', $user_id, FALSE);
		}

		$result	= $this->db->get ('users')->row();


       	if( $result ) {

       		return $result->id;
       	}

       	return FALSE;
	}


	/**
	 * Used to check if a given email id exists
	 *
	 * @param string $sEmailId
	 * @param integer $iAccountNo
	 * @return boolean
	 */
	function isEmailExists($sEmailId='') {

		$bEmailIdExists = FALSE;


		$this->db->select('id, account_no');
		$this->db->where('email_id', $sEmailId);
		if( $this->db->get ('users')->row() ) {

       		$bEmailIdExists = TRUE;
       	}

       	return $bEmailIdExists;
	}



	/**
	 * Used to check if a given mobile number exists
	 *
	 * @param string $sMobileNum
	 * @param integer $iAccountNo
	 * @return boolean
	 */
	function isMobileNumExists($sMobileNum='') {

		$bMobileNumExists = FALSE;


		$this->db->select('id, account_no');
		$this->db->where('mobile_number', $sMobileNum);
		if( $this->db->get ('users')->row() ) {

       		$bMobileNumExists = TRUE;
       	}

       	return $bMobileNumExists;
	}



	/**
	 * get details of a single user by
	 * 	1. id
	 * 	2. account_no
	 * 	3. facebook_id
	 * 	4. email_id
	 *
	 */
	function getUserBy($sFieldName, $sValue, $sInformationType = 'basic', $aWhere=array()){

		//p($aWhere);

		if( $sInformationType == 'basic' ){

			/* Standard User Informations from a single table */
			$this->db->select('
				U.*,
				CONCAT_WS(" ", U.first_name, U.middle_name, U.last_name ) full_name,
				((date_format(now(),\'%Y\') - date_format(U.birthday,\'%Y\')) - (date_format(now(),\'00-%m-%d\') < date_format(U.birthday,\'00-%m-%d\'))) AS age,
			', false);

		} elseif( $sInformationType == 'full' ){

			/* Additional Information by joining multiple tables */
			$this->db->select('
							  U.*,
							  CONCAT_WS(" ", U.first_name, U.middle_name, U.last_name ) full_name,
							  PP.current_pic', false);
			$this->db->join('profile_pictures PP', 'PP.user_id = U.id', 'left');

		} elseif( $sInformationType == 'supporter_profile' ){

			//$this->load->config('support_config');
			/* Additional Information by joining multiple tables */
			$this->db->select('
							  U.*,
							  CONCAT_WS(" ", U.first_name, U.middle_name, U.last_name ) full_name,
							  SUC.amount committed_amount,
							  SUC.excempt_from_commitment,
							  PP.current_pic');
			$this->db->join('profile_pictures PP', 'PP.user_id = U.id', 'left');
			$this->db->join('support_user_commitment SUC', 'SUC.account_no = U.account_no', 'left');

		}

		$this->db->where('U.'.$sFieldName, $sValue);

		if($aWhere){
			$this->db->where($aWhere);
		}

		$oUser = $this->db->get('users U')->row();

		return $oUser;

	}

	/**
	 * Stuff the needs to be done before logout
	 *
	 */
	function logout_routines($iUserId=0){

	}

	/**
	 * Stuff the needs to be done after login
	 *
	 */
	function login_routines($iUserId=0){

	}

	/**
	 * get a list of users
	 *
	 * @param unknown_type $iLimit
	 * @param unknown_type $iOffset
	 * @param unknown_type $aWhere
	 * @return unknown
	 */
	function getUsers( $iLimit=0, $iOffset=0, $aWhere=array(), $aWhereIn=array(), $aWhereNotIn=array(), $aOrderBy = array()) {

		$sSelect = '
					U.*,
					CONCAT_WS(" ", U.first_name, , U.middle_name, U.last_name ) full_name,
					PP.current_pic';

					/*
		if( isset( $aWhere['URM.role'] ) ) {
			$sSelect .= ',UR.title role_title';
		}
		*/

		$this->db->select($sSelect, false);
		$this->db->join('profile_pictures PP', 'PP.user_id = U.id');

		if($iLimit || $iOffset) {
			$this->db->limit($iLimit, $iOffset);
		}

		if($aWhere) {
			$this->db->where($aWhere, false);
		}

		if($aWhereIn) {

			foreach( $aWhereIn AS $sKey => $aValues ) {

				$this->db->where_in($sKey, $aValues);
			}

		}

		if($aWhereNotIn) {

			foreach( $aWhereNotIn AS $sKey => $aValues ) {

				$this->db->where_not_in($sKey, $aValues);
			}

		}

		if( isset( $aWhere['URM.role'] ) ) {
			$this->db->join('user_role_map URM', 'URM.account_no = U.account_no');
		}

		if( $aOrderBy ) {

			foreach( $aOrderBy AS $key=>$value ) {

				$this->db->order_by($key, $value);

			}
		}

		$aResult = $this->db->get('users U')->result();




		return $aResult;
	}



	/**
	 *
	 * A user can have multiple addresses linked. only one will be main address.
	 * @param  [type] $iAccountNo [description]
	 * @return [type]             [description]
	 */
	function getMainAddressValue($iAccountNo) {
		$value = FALSE;

		$this->db->where('account_no', $iAccountNo);
		$this->db->where('is_main', 1);
		if($oRow = $this->db->get('user_address_map')->row()) {

			$value = $oRow->address_uid;
		}

		return $value;
	}

	/**
     *
	 * get a list of users, to be used in the support section.
	 *
	 * The data will have an extra field, indicating if the user is a supporter or not
	 */
	function getUsers_Support( $iLimit=0, $iOffset=0, $aWhere=array() ) {


        $this->load->config('support_config');

		$this->db->select('
			U.*,
			CONCAT_WS(" ", U.first_name, , U.middle_name, U.last_name ) full_name,
			PP.current_pic,
            IF(SUC.amount > '.c('supporter_commitent_min_limit').', 1, 0) is_supporter',
            false);
		$this->db->join('profile_pictures PP', 'PP.user_id = U.id');
		$this->db->join('support_user_commitments SUC', 'SUC.account_no = U.account_no', 'LEFT');

		if($iLimit || $iOffset) {
			$this->db->limit($iLimit, $iOffset);
		}

		if($aWhere) {
			$this->db->where($aWhere, false);
		}
		return $this->db->get('users U')->result();
	}



	/**
	 *
	 * get the roles of a user
	 *
	 */
	function getUserRoles( $oUser ) {

		$this->db->select('URM.*, UR.title');

		$this->db->where('account_no', $oUser->account_no);
		$this->db->join('user_roles UR', 'URM.role = UR.id');
		$this->db->order_by('UR.weight', 'ASC');

		return $this->db->get('user_role_map URM')->result();
	}



    /**
     *
     * Create a dummy record in the "support_user_commitments" table
     */
    function createSupportProfile($iAccountNo){


        $this->load->model('common_model');
        $aData['uid'] = $this->common_model->generateUniqueNumber(
                                                array('table' => 'support_user_commitments',
                                                      'field' => 'uid'));
        $aData['account_no']        = $iAccountNo;
        $aData['amount']            = 0;
        $aData['payment_interval']  = 0;
        $aData['status']            = 1;
        $aData['created_on'] = $aData['updated_on'] = date('Y-m-d H:i:s');

        $this->db->insert('support_user_commitments', $aData);

        return $aData;
    }


	function getUsersByRole($sRole, $iLimit=0, $iOffset=0, $aWhere=array(), $aWhereIn=array(), $aWhereNotIn=array() ) {


		//$aUserRoles = $this->config->item('user_roles');


		$this->db->select('
						  U.id,
						  U.username,
						  U.account_no,
						  U.facebook_url,
						  U.twitter_url,
						  U.blog_url,
						  CONCAT_WS(" ", U.first_name, U.middle_name, U.last_name ) full_name,
						  U.profile_image,
						  PP.current_pic,
						  UR.name role_name,
						  UR.title role_title
						  ', false);


		if($aWhereNotIn) {

			foreach( $aWhereNotIn AS $sKey => $aValues ) {

				$this->db->where_not_in($sKey, $aValues);
			}

		}

		/*
		p($this->mcontents['aAllRoles']);
		p($sRole);
		exit;
		*/

		//$this->db->order_by('UR.weight', 'ASC');
		$this->db->join('profile_pictures PP', 'PP.user_id = U.id', 'left');
		$this->db->join('user_role_map URM', 'URM.account_no = U.account_no');
		$this->db->join('user_roles UR', 'UR.id = URM.role');
		$this->db->where('URM.role', $this->mcontents['aAllRoles'][$sRole]['id']);
		$aData = $this->db->get('users U')->result();

		return $aData;
	}



	/**
	*
	* steps to initiate a mobile number verification process
	*/
	function initiateMobileNumVerification($iAccountNo) {

		//we need SMS functionality
		$this->load->config('sms');
		$this->load->model('sms_model');

		$aUserMobileVerificationStatus 	= $this->config->item('user_mobile_verification_status');
		$aSmsPurpose 					= $this->config->item('sms_purpose');
		$aSmsSentStatus 				= $this->config->item('sms_sent_status');
		$iTokenTimeToLive 				= $this->config->item('mobile_num_verification_token_time_to_live');

		$oUser = $this->user_model->getUserBy('account_no', $iAccountNo);
		$sMobileNumber = $oUser->mobile_number;

		/*
		p($sMobileNumber);
		exit;
		*/

		// generate a token and save it
		$oToken = $this->common_model->generateToken_new('mobile_number_verification',
														 $iAccountNo,
														 6,
														 $iTokenTimeToLive,
														 '123456789',
														 TRUE,
														 TRUE,
														 'nozero');

		//p($oToken);exit;

		// the text of the SMS
		$sText = "mobile number verification for your ". $this->config->item('website_title_abbrv') ." account is : " . $oToken->token;

		// send the token via SMS
		$aSMSSentDetails = $this->sms_model->sendSMS($sMobileNumber, $sText);

		// Log the SMS sent
		$this->sms_model->logTokenSMS($iAccountNo, $oToken, $aSMSSentDetails);

		// Update in users table, the status of mobile number verification
		if($aSMSSentDetails['api_sent_status'] == $aSmsSentStatus['sent']) {

			$this->db->set('mobile_verification_status', $aUserMobileVerificationStatus['sms_sent']);
			$this->db->where('account_no', $iAccountNo);
			$this->db->update('users');
		}

	}



	/**
	 *
	 * verify if a user account is awaiting a token for mobile number verification
	 */
	function isAccountAwaitingMobileNumVerification($iAccountNo) {


		$bReturn = FALSE;

		$user_mobile_verification_status = $this->config->item('user_mobile_verification_status');

		$this->db->where('TN.purpose', 'mobile_number_verification');
		$this->db->join('tokens_new TN', 'U.account_no = TN.unique_identification');
		$oUser = $this->db->get('users U')->row();


		if( $oUser && ($oUser->mobile_verification_status == $user_mobile_verification_status['sms_sent']) ) {
			$bReturn = TRUE;
		}

		return $bReturn;
	}



	/**
	 *
	 * unset the mobile number verfication code that was used for validating a mobile number
	 */
	function unsetMobileNumVerificationCode($oToken) {

		//delete the token
		$this->common_model->deleteToken_new($oToken->id);

		//delete the history of SMS sent to the number for the purpose of token
			// this will be automatically taken care of, because of the foreign key-on delete-cascade condition set
			// for the "token_sms_sent_counter" table

			/*
			$this->db->where('account_no', $oToken->unique_identification);
			$this->db->where('token_id', $oToken->id);
			$this->db->delete('token_sms_sent_counter');
			*/
	}



	/**
	 *
	 * used for debugging purposes .
	 * not to be used in production environment
	 */
	function skipMobileNumberVerification($iAccountNo) {

		// find the associated token
		$this->db->where('U.account_no', $iAccountNo);
		$this->db->where('TN.purpose', 'mobile_number_verification');
		$this->db->join('users U', 'TN.unique_identification = U.account_no');
		$oToken = $this->db->get('tokens_new TN')->row();


		// set the mobile number as verified
		$aUserMobileVerificationStatus = $this->config->item('user_mobile_verification_status');

		$this->db->set('mobile_verification_status', $aUserMobileVerificationStatus['sms_verified']);
		$this->db->where('account_no', $iAccountNo);
		$this->db->update('users');


		//unset the movile number verification code
		$this->unsetMobileNumVerificationCode($oToken);

		// do the initial setup routines check to see if the user passes it.
		$this->user_model->initialSetupRoutines($iAccountNo);
	}
}
