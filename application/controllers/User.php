<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {


	public function __construct() {

		parent::__construct();

		/*
		$this->mcontents = array();
		$this->merror['error'] = '';
		$this->mcontents['load_css'] = array();
		$this->mcontents['load_js'] = array();
		*/

		$this->load->model('user_model');

		$this->aUserStatus 		= $this->config->item('user_status');
		$this->aUserTypes 		= $this->config->item('user_types');
		$this->aErrorTypes 		= $this->config->item('error_types');

		$this->aGenders = c('genders');
		$this->mcontents['aGendersFlipped'] = array_flip($this->aGenders);
		$this->mcontents['sCurrentMainMenu'] = 'user';


    $this->mcontents['sCurrentMainMenu']    = 'users';

		$this->mcontents['aUserMobileVerificationStatus'] = $this->config->item('user_mobile_verification_status');
		$this->mcontents['aUserMobileVerificationStatusTitle'] = $this->config->item('user_mobile_verification_status_title');

	}

	public function index() {

		if( $this->authentication->is_user_logged_in (true, 'user/login') ){
			$this->home();
		}
	}





	/**
	 *
	 * will show a users mobile number
	 */
	function manage_mobile_number() {

		$this->authentication->is_user_logged_in(TRUE, 'user/login');

		$iAccountNo = s('ACCOUNT_NO');
		$aWhere = array(
						'status' => $this->aUserStatus['active'],
					);
		if( ! $this->mcontents['oUser'] = $this->user_model->getUserBy('account_no', $iAccountNo, 'basic', $aWhere) ) {

			sf('error_message', 'You cannot access this section right now');
			redirect('home');
		}





		if( isset($_POST) && ! empty($_POST) ) {

			if( safeText('verification_request') == '1' ) {

				if($this->mcontents['oUser']->mobile_verification_status == $this->mcontents['aUserMobileVerificationStatus']['no_sms_verification_done']) {

					// initiate steps to verify mobile number
					$this->user_model->initiateMobileNumVerification($iAccountNo);
					redirect('user/verify_mobile_number');

				} else {

					$this->merror['error'][] = 'There is some issue issue with mobile number verification. Please contact website admin';
					log_message('error',
									"controller => manage_mobile_number".
									"/n Account NO: " . $iAccountNo .
									"/nIssue : Undesired Else condition encountered"
									);
				}

			}
		}

		loadTemplate('user/manage_mobile_number');
	}



	/**
	 *
	 * will accept mobile number and store in system for current logged in user
	 */
	function change_mobile_number() {

		$this->authentication->is_user_logged_in(TRUE, 'user/login');

		loadTemplate('user/add_mobile_number');
	}



	/**
	 *
	 * will accept mobile number and store in system for current logged in user
	 */
	function add_mobile_number() {

		$this->authentication->is_user_logged_in(TRUE, 'user/login');

		$aUserMobileVerificationStatus = $this->config->item('user_mobile_verification_status');

		$iAccountNo = s('ACCOUNT_NO');

		$aWhere = array(
						'status' => $this->aUserStatus['active'],
					);
		if( ! $oUser = $this->user_model->getUserBy('account_no', $iAccountNo, 'basic', $aWhere) ) {

			sf('error_message', 'You cannot access this section right now');
			redirect('home');
		}


		if( $oUser->mobile_number ) {

			switch($oUser->mobile_verification_status) {

				case $aUserMobileVerificationStatus['sms_sent']:
				case $aUserMobileVerificationStatus['no_sms_verification_done']:

					sf('error_message', 'click to resend the mobile number verification code');
					redirect('profile/edit');
					break;

				case $aUserMobileVerificationStatus['sms_verified']:

					sf('error_message', 'you can update your mobile number.');
					redirect('profile/edit');
					break;
			}
		}


		if ( isset($_POST) && ! empty($_POST) ) {

			$this->form_validation->set_rules('mobile_number',
											  'Mobile number',
											  'trim|required|min_length[10]|max_length[10]|is_natural',
											  array(
												  'min_length' => 'Mobiler number should be a 10 digit number',
												  'max_length' => 'Mobiler number should be a 10 digit number',
												  'is_natural' => 'Mobiler number should have only numbers',
												  )
											  );

			if ($this->form_validation->run() == TRUE) {

				$sMobileNumber = safeText('mobile_number');

				// see if this mobile number is with us already
				if( ! $bisMobileNumExists = $this->user_model->isMobileNumExists($sMobileNumber) ) {

					if( $oUser->mobile_number ) {

						// move the mobile number to users history

					}

					// update the user with the mobile number and mark the mobile number as not verified
					$this->db->set('mobile_number', $sMobileNumber);
					$this->db->set('mobile_verification_status', $aUserMobileVerificationStatus['no_sms_verification_done']);
					$this->db->where('account_no', $iAccountNo);
					$this->db->update('users');

					// initiate steps to verify mobile number
					$this->user_model->initiateMobileNumVerification($iAccountNo);


					redirect('verify_mobile_number?account_no='.$iAccountNo);

				} else {
					$this->merror['error'][] = 'The mobile number is already used.';
				}
			}
		}
		loadTemplate('user/add_mobile_number');
	}



	/**
	 *
	 * This page will accept the token and do the mobile number verification
	 */
	function verify_mobile_number() {

		//$iAccountNo = safeText('account_no', FALSE, 'get');

		$this->authentication->is_user_logged_in(TRUE, 'user/login');

		$this->mcontents['iAccountNo'] = s('ACCOUNT_NO');


		$aWhere = array(
						'status' => $this->aUserStatus['active'],
					);
		if( ! $oUser = $this->user_model->getUserBy('account_no', $this->mcontents['iAccountNo'], 'basic', $aWhere) ) {
			/*
			p($this->mcontents['iAccountNo']);
			p($oUser);
			exit;
			*/
			sf('error_message', 'You cannot access this section right now');
			redirect('home');
		}


		/* Temporary set up to skip mobile number verification step */
			$bSkipMobileNumberVerification = FALSE;

			if($bSkipMobileNumberVerification) {
				$this->user_model->skipMobileNumberVerification($oUser->account_no);
			}
		/* Temporary set up to skip mobile number verification step - End */



		$bIsAccountAwaitingMobileNumVerification = $this->user_model->isAccountAwaitingMobileNumVerification( $oUser->account_no );
		//$bIsAccountAwaitingMobileNumVerification = TRUE; // to be removed if not useful


		if( ! $oUser ) {

			sf('error_message', 'The link you are trying to access does not exist.');
			redirect('home');
		}
		if( ! $bIsAccountAwaitingMobileNumVerification ) {

			//sf('error_message', 'The link you are trying to access does not exist.');
			redirect('user/manage_mobile_number');
		}



		if( isset($_POST) && !empty($_POST) ) {

			$this->form_validation->set_rules('verification_code', 'Verification code', 'trim|required');

			if ($this->form_validation->run() == TRUE) {

				$sToken = safeText('verification_code');

				$aTokenResult = $this->common_model->isValidToken_new($sToken, 'mobile_number_verification', $oUser->account_no);

				$aTokenStatus = c('token_status');

				if( $aTokenResult['status'] != $aTokenStatus['valid'] ) {

					//find the reason why this token is not valid
					if( $aTokenResult['status'] == $aTokenStatus['invalid'] ) {

						$iAttempts = 0;
						$iMaxAttempts = 3;

						if($iAttempts >= $iMaxAttempts) {

							$this->user_model->unsetMobileNumVerificationCode($aTokenResult['oToken']);

						} else {

							$this->merror['error'][] = 'the code entered is invalid code.';

						}


					} elseif($aTokenResult['status'] == $aTokenStatus['expired']) {

						$this->user_model->unsetMobileNumVerificationCode($aTokenResult['oToken']);

						sf('error_message', 'The token you entered has expired.');
						redirect('user/verify_mobile_number');
					}


				} else {

					$this->user_model->unsetMobileNumVerificationCode($aTokenResult['oToken']);


					$aUserMobileVerificationStatus = $this->config->item('user_mobile_verification_status');

					// set the mobile number as verified
					$this->db->set('mobile_verification_status', $aUserMobileVerificationStatus['sms_verified']);
					$this->db->where('account_no', $oUser->account_no);
					$this->db->update('users');

					sf('success_message', 'Your mobile number has been verified');

					// do the initial setup routines check to see if the user passes it.
					$this->user_model->initialSetupRoutines($oUser->account_no);

					redirect('profile/edit');
				}
			}
		}

		loadTemplate('user/verify_mobile_number');
	}






	function login () {

		$this->mcontents['page_heading'] = $this->mcontents['page_title'] = 'Login';


		if(!$this->authentication->is_user_logged_in()) {

		    if (!empty($_POST)) {


				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password','Password', 'trim|required');
				if ($this->form_validation->run() == TRUE) {
					$post_data['username'] 	= safeText('username');
					$post_data['password']	= $this->authentication->encryptPassword(safeText ('password'));
					$login_details			= $this->authentication->process_login ($post_data);

					/*
					p($login_details);
					echo "<br/>";
					var_dump($login_details);
					exit;
					*/

					if('' == $login_details['error']) {


						// see if the initial set up has been complete or not.
						$bDoubleCheck = FALSE; // this double check is done only during login time
						$this->user_model->initialSetupRoutines(s('ACCOUNT_NO'), $bDoubleCheck);



						if( @$login_details['message'] ) {

							sf('success_message', $login_details['message']);
						}


						if($this->authentication->is_admin_logged_in()){

								redirect('user/listing');

						}else{
							
								redirect('survey');
								
						}

						// See if the user needs to be redirected to a previous page he was seeying
						// redirect the users to the link which they were trying to access

						if( $post_login_redirect = s('post_login_redirect') ) {

							us('post_login_redirect');
							redirect($post_login_redirect);

						} else {

							if($this->authentication->is_admin_logged_in()){

								redirect('admin');

							} else {

								redirect('home');
							}

						}

					}else{
					 	$this->merror['error']	=	$login_details['error'];
					}
				}
		    }

		} else {

			redirect('home');
		}


		$this->mcontents['load_js'][] 	= 'jquery/jquery.validate.min.js';
        $this->mcontents['load_js'][] = 'validation/login.js';

		loadTemplate('user/login');
	}




	/**
	 * The signup form is displayed
	 *
	 */
	function create() {

		$this->authentication->is_admin_logged_in (true);

		isAdminSection();


		$this->mcontents['page_heading'] 	= 'Create New Enumerator';
		$this->mcontents['page_title'] 		= 'Create New Enumerator';

		$error	= FALSE;
		if (!empty($_POST) && isset($_POST)) {

			$this->_validate_create_user();

			if (TRUE == $this->form_validation->run()) {

				//write_log('SIGNUP 4');
				$post_data['first_name']	= safeText('first_name');
				$post_data['last_name']		= safeText('last_name');

				//$post_data['landline_number_country_code']		= safeText('landline_number_country_code');
				/*$post_data['username'] = $aConfig = array(
																		'table' => 'users',
																		'field' => 'account_no',
																	);*/
				$aConfig = array(
								'table' => 'users',
								'field' => 'account_no',
							);																	
				$post_data['mobile_number'] = safeText('mobile_number');
				$post_data['username'] 		= safeText('mobile_number');
				$post_data['account_no']	= $this->common_model->generateUniqueNumber($aConfig);
				$post_data['username'] 		= $post_data['username'];
	    		$post_data['password']		= $this->authentication->encryptPassword( 'LSG_123' );
    			$post_data['status']		= $this->aUserStatus['active'];
				$post_data['email_id']		= $post_data['account_no'] . '@temporary.com';
	    		$post_data['gender']		= safeText('gender');
				$post_data['type']			= $this->aUserTypes['enumerator'];
				$post_data['joined_on']		= date('Y-m-d H:i:s');
				$post_data['mobile_verification_status']		= $this->mcontents['aUserMobileVerificationStatus']['no_sms_verification_done'];
				$post_data['initial_setup_complete']	= 1; 



				if(!$error) {

					//start transaction
					$this->db->trans_start();

					$this->db->set ($post_data);
			       	$this->db->insert ('users');

					if( $iUserId = $this->db->insert_id() ) {

						$oUser = $this->user_model->getUserBy('id', $iUserId);


						$this->load->model('account_model');

						//Assign default profile image for user
						$this->account_model->createProfilePicture($oUser);
						
						/*
						// create address and contact number
						$bByPassAddressValidation = TRUE;
						$this->load->model('address_model');
						$iAddressUid = $this->address_model->create_address_and_contact_numbers($bByPassAddressValidation);

						// create mapping between user and address
						$aData = array(
											'one' => $oUser->account_no,
											'many' => array($iAddressUid),
											'extra_field_value_pairs' => array('is_main' => 1)
										);
						one_to_many_mapping('create', 'user_address', $aData);
						*/

						//End transaction
						$this->db->trans_complete();

						sf('success_message', 'Successfully created new Enumerator.');

						redirect('user/listing');

					} else {
						$this->merror['error']         = "There was some issue with Enumerator creation. Please try back later.";
					}
				}
			}
		}


		$this->mcontents['load_js'][] 	= "jquery/jquery.validate.min.js";
		$this->mcontents['load_js'][] 	= "validation/register.js";



		$this->mcontents['aGenders'] 	= $this->aGenders;//array_flip($this->aGenders);
		
		loadAdminTemplate('user/create', $this->mcontents);
	}

function register() {

		if($this->authentication->is_user_logged_in ()){
			redirect('home');
		}


		$this->mcontents['page_heading'] 	= 'Register';
		$this->mcontents['page_title'] 		= 'Register';

		$error	= FALSE;
		if (!empty($_POST) && isset($_POST)) {

			$this->_validate_registration();

			if (TRUE == $this->form_validation->run()) {

				//write_log('SIGNUP 4');
				$post_data['first_name']	= safeText('first_name');
				$post_data['last_name']		= safeText('last_name');

				//$post_data['landline_number_country_code']		= safeText('landline_number_country_code');
				$post_data['username'] = $aConfig = array(
																		'table' => 'users',
																		'field' => 'account_no',
																	);
				$post_data['account_no'] = $this->common_model->generateUniqueNumber($aConfig);
				$post_data['username'] 	= $post_data['account_no'];
    		$post_data['password']		= $this->authentication->encryptPassword( $post_data['username'] );
    		$post_data['status']		= $this->aUserStatus['active'];
				$post_data['email_id']		= $post_data['account_no'] . '@temporary.com';
	    	$post_data['gender']		= safeText('gender');
				$post_data['type']		= $this->aUserTypes['user'];
				$post_data['joined_on']		= date('Y-m-d H:i:s');
				$post_data['mobile_verification_status']		= $this->mcontents['aUserMobileVerificationStatus']['no_sms_verification_done'];



				if(!$error) {

					//start transaction
					$this->db->trans_start();

					$this->db->set ($post_data);
			       	$this->db->insert ('users');

					if( $iUserId = $this->db->insert_id() ) {

						$oUser = $this->user_model->getUserBy('id', $iUserId);


						$this->load->model('account_model');

						//Assign default profile image for user
						$this->account_model->createProfilePicture($oUser);

						// create address and contact number
						$bByPassAddressValidation = TRUE;
						$this->load->model('address_model');
						$iAddressUid = $this->address_model->create_address_and_contact_numbers($bByPassAddressValidation);

						// create mapping between user and address
						$aData = array(
											'one' => $oUser->account_no,
											'many' => array($iAddressUid),
											'extra_field_value_pairs' => array('is_main' => 1)
										);
						one_to_many_mapping('create', 'user_address', $aData);

						//End transaction
						$this->db->trans_complete();

						sf('success_message', 'Your application has been received. We will get in touch with you shortly.');

						redirect('user/register');

					} else {
						$this->merror['error']         = "There was some issue with registration. Please try back later.";
					}
				}
			}
		}


		$this->mcontents['load_js'][] 	= "jquery/jquery.validate.min.js";
		$this->mcontents['load_js'][] 	= "validation/register.js";



		$this->mcontents['aGenders'] 	= array_flip($this->aGenders);

		loadTemplate('user/register', $this->mcontents);
	}



	/**
	 *
	 * Activate the a user account when they click on the confirmation link in the email
	 *
	 */
	function account_activation($account_act_code='') {

		if( $this->authentication->is_user_logged_in() ) {

			redirect('home');
		}

		$this->mcontents['title']			= 'Account Activation';
		$this->mcontents['page_heading']	= 'Account Activation';

		if( !$account_act_code ) {

			redirect('home');
		}

		$this->load->model('common_model');
		$aResult = $this->common_model->isValidToken($account_act_code, 'account_activation');
		$aTokenStatus = c('token_status');

		if( $aResult['status'] != $aTokenStatus['valid'] ) {

			//find the reason why this token is not valid
			if( $aResult['status'] == $aTokenStatus['invalid'] ) {

				sf('error_message', 'Invalid Link. Please contact out support team');
			} elseif($aResult['status'] == $aTokenStatus['expired']) {

				sf('error_message', 'This link has expired. Click <a class="highlight1" href="'.c('base_url').'user/resend_account_activation/'.$account_act_code.'">here</a> to get another confirmation email');
			}

			redirect('home');

		} else {

			//activate the account
			if(true === $this->account_model->activateAccount($aResult['oToken']->user_id)){

				//delete the token
				$this->common_model->deleteToken($aResult['oToken']->id);


				if(!$this->authentication->makeLogin($aResult['oToken']->user_id)){

					sf('error_message', 'You could not be logged in. Please contact out admin');
				} else {

					// Send welcome message
					$this->load->model('maintenance_model');
					$this->maintenance_model->getSingleSetting('db_welcome_msg');
					$aWelcomeEmail['receiver_name'] = s('FULL_NAME');
					$aWelcomeEmail['welcome_text'] 	= $this->maintenance_model->getSingleSetting('db_signup_welcome_msg');

					$aSettings = array(
						'to' 				=> array(s('EMAIL') => s('FULL_NAME')), // email_id => name pairs
						'from_email' 		=> c('accounts_email_id'),
						'from_name'			=> c('accounts_email_from'),
						'reply_to' 			=> array(c('accounts_email_id') => c('accounts_email_from')), // email_id => name pairs
						'email_contents' 	=> $aWelcomeEmail, // placeholder keywords to be replaced with this data
						'template_name' 	=> 'welcome', //name of template to be used
						//'preview'			=> true
					);

					$this->load->helper('custom_mail');
					sendMail_PHPMailer($aSettings);

					sf('success_message', 'Account has been activated. Welcome to '.$this->mcontents['c_website_title']);
				}

			} else {
				sf('error_message', 'Could not activate!!');
			}


			redirect('home');
		}
	}


	function resend_link($sToken){

		//see if the token is an expired one
		$aResult = $this->common_model->isValidToken($sToken, 'account_activation');
		$aTokenStatus = c('token_status');

		if($aResult['status'] == $aTokenStatus['expired']){

		}

		redirect('home');
			//get the user and the purpose of the token
				//send the email

	}


	/**
	 *
	 * resend account activation url to email and redirect to home page
	 *
	 * WHy not write a common function to resend validation urls for different purposes??
	 *
	 */
	function resend_account_activation($sToken) {

		//see if the token is an expired one
		$aResult = $this->common_model->isValidToken($sToken, 'account_activation');
		$aTokenStatus = c('token_status');

		if($aResult['status'] == $aTokenStatus['expired']){

			$oToken = $aResult['oToken'];
			$oUser = $this->user_model->getUserBy('id', $oToken->user_id);
			//confirmation email to user
			$account_activation_code = $this->common_model->generateToken('account_activation', $oUser->id);
			$arr_email['name']				= $oUser->first_name . ' ' . $oUser->last_name;
			$arr_email['activation_url']	= site_url('user/account_activation/'.$account_activation_code);
			$arr_email['help_url']			= site_url('help');


			$this->load->helper('custom_mail');
			if(sendMail($oUser->email_id, $arr_email, 'registration_activation_link')){
				$this->session->set_flashdata ('success_message', 'Please Check your email now.');
			}else{
				$this->session->set_flashdata ('info_message', 'Confirmation mail is not sent');
			}
		}

		redirect('home');
	}


	function _validate_create_user() {
		$this->form_validation->set_rules ('mobile_number','Mobile Number', 'trim|required');		
		$this->form_validation->set_rules ('first_name','First Name', 'trim|required');
		$this->form_validation->set_rules ('last_name','Last Name', 'trim');
		$this->form_validation->set_rules ('gender','Gender', 'trim|required');
		$this->form_validation->set_rules ('user_roles','User Roles', 'trim');

	}



		function _validate_registration(){

			$this->form_validation->set_rules ('first_name','First Name', 'trim|required');
			$this->form_validation->set_rules ('last_name','Last Name', 'trim');
			$this->form_validation->set_rules ('address_mobile1_','Mobile Number', 'trim');
			$this->form_validation->set_rules ('mobile_code','Mobile Code', 'trim');
			$this->form_validation->set_rules ('address_landline1_','Landline Number', 'trim');
			$this->form_validation->set_rules ('gender','Gender', 'trim|required');
		}


	function _validate_signup(){

		$this->form_validation->set_rules ('first_name','First Name', 'trim|required');
		$this->form_validation->set_rules ('middle_name','Middle Name', 'trim');
		$this->form_validation->set_rules ('last_name','Last Name', 'trim|required');
	    $this->form_validation->set_rules ('email_id','Email', 'trim|required|valid_email');
	    $this->form_validation->set_rules ('username','Username', c('username_validation_rules'));
		$this->form_validation->set_rules ('password','Password', c('password_validation_rules'));
		$this->form_validation->set_rules ('password_again','Repeat Password', c('password_again_validation_rules'));
		$this->form_validation->set_rules ('dob','Date of Birth', 'trim');
		$this->form_validation->set_rules ('gender','Gender', 'trim|required');
	}


	/**
	 * Home page of user
	 *
	 */
	function home(){

		redirect('home');
	}


	/**
	 * Check availability of username and password
	 *
	 * accessed via ajax
	 *
	 * @param unknown_type $sType
	 */
	function checkavailability($sType='', $sValue='') {


		$aJasonData = array(
						'status'=>0,
						'output'=>'',
						'type' => $sType
						);
		$sOutput = true;


		if( ($sType == 'username' || $sType == 'email_id') ) {

			//if (!empty($_POST) && isset($_POST)) {
				$sLabel = '';
				//$sValue = '';
				if($sType == 'username'){

					$sLabel = 'Username';
					$sValue = safeText('username', false, 'get');
				} else {
					$sLabel = 'Email Id';
					$sValue = urldecode( safeText('email_id', false, 'get') );
				}

				// CHECK FOR VALID USERNAME HERE!!!??


				$this->db->where($sType, $sValue);
				$query = $this->db->get('users');
				if($query->row()){

					$sOutput = 'This '.$sLabel.' has been taken';

				} else {

					$sOutput = true;
				}
			//}
			//$sOutput = $this->db->last_query();
		}

		$this->load->view('output', array('output'=>json_encode($sOutput)));

	}


	/**
	 * browser will redirect here after every fb login
	 *
	 * @todo need to give an option to redirect to where the user came from.
	 *
	 */
	function handle_fb_login() {
		$this->load->library('facebook');

		if(!$this->facebook->is_authenticated()){
			redirect('user/login');
		}

		$oFbUserData = (object) $this->facebook->request('get', '/me?fields=id,email,first_name,middle_name,last_name,gender,birthday,age_range');

		if(!isset($oFbUserData->email) || (isset($oFbUserData->email) && '' != $oFbUserData->email)){
			sf('error_message', "You hav'nt allowed email permission on facebook.");
		}


//		$user_profile = $this->facebook->api('/me');

		//p('AFTER');

		//$oFbUserData = (object)$user_profile;

		if($oSystemUserData = $this->user_model->getUserBy('facebook_id', $oFbUserData->id)){

			if($oSystemUserData->status == $this->aUserStatus['closed']){

				//reactivate the account
				$this->account_model->activateAccount($oSystemUserData->id);
				sf('success_message', 'Good To have you back!!');

			} elseif($oSystemUserData->status == $this->aUserStatus['blocked']){

					sf('error_message', "Your account is blocked. \nPlease use the Contact Us page to contact the Administrator");
					redirect('home');

			}

			//proceed with login
			if($this->authentication->makeLogin($oSystemUserData->facebook_id, 'facebook_id')){
				redirect('home');
			} else {
				sf('error_message', 'There was some problem. Could not log you in.');
				redirect('home');
			}

		} else {
				//consider this as a first time login
				//proceed with registration, mail sending, and login
				if(!$oSystemUserData = $this->user_model->getUserBy('email_id', $oFbUserData->email)) {

					$this->load->helper('custom_upload');
			       	$sUrl = getFbImage((object)array('facebook_id' => $oFbUserData->id), array('type'=>'large'), false);
			       	$aImageData = urlUpload('image', 'profile_pic', $sUrl);

					//registration
					$aUserData['facebook_id'] 	= $oFbUserData->id;
					$aUserData['email_id'] 		= $oFbUserData->email;
					$aUserData['account_no'] 	= $this->authentication->generateAccountNumber();
					$aUserData['type'] 			= $this->aUserTypes['user'];
					$aUserData['status'] 		= $this->aUserStatus['active'];
					$aUserData['joined_on'] 	= date('Y-m-d');
					$aUserData['first_name'] 	= isset($oFbUserData->first_name) ? $oFbUserData->first_name : '';
					$aUserData['middle_name'] 	= isset($oFbUserData->middle_name) ? $oFbUserData->middle_name : '';
					$aUserData['last_name'] 	= isset($oFbUserData->last_name) ? $oFbUserData->last_name : '';
					$aUserData['gender'] 		= $this->aGenders[$oFbUserData->gender];
					$aUserData['profile_image'] = $aImageData['file_name'];

					if(isset($oFbUserData->birthday) && '' != $oFbUserData->birthday){
						$aBirthday 	= explode('/', $oFbUserData->birthday); // mm/dd/yyyy
						$aUserData['birthday'] 		= $aBirthday[2].'-'.$aBirthday[0].'-'.$aBirthday[1];
					}
					$this->db->set ($aUserData);
			       	$this->db->insert ('users');

			       	$iUserId = $this->db->insert_id();


			       	//Login
			       	$this->authentication->makeLogin($oFbUserData->id, 'facebook_id');

			       	$this->account_model->activateAccount($iUserId);

//			       	update the profile pictures page
//			       	$aUploadType = c('profile_pic_upload_type');
//			       	$aProfilePicData = array(
//			       		'user_id' => $iUserId,
//			       		'current_pic' => $aUploadType['facebook'],
//			       		'facebook' => $aImageData['file_name'],
//			       	);


					/*$this->load->model('maintenance_model');
					$this->maintenance_model->getSingleSetting('db_welcome_msg');
			       	$aWelcomeEmail['receiver_name'] = $aUserData['first_name'];
			       	$aWelcomeEmail['welcome_text'] 	= $this->maintenance_model->getSingleSetting('db_signup_welcome_msg');
					*/
					$aSettings = array(
						'to' 				=> array($oFbUserData->email=>$aUserData['first_name']), // email_id => name pairs
						'from_email' 		=> c('accounts_email_id'),
						'from_name'			=> c('accounts_email_from'),
						'reply_to' 			=> array(c('accounts_email_id') => c('accounts_email_from')), // email_id => name pairs
						'email_contents' 	=> $aWelcomeEmail, // placeholder keywords to be replaced with this data
						'template_name' 	=> 'welcome', //name of template to be used
						//'preview'			=> true
					);

					//p(sendMail_PHPMailer($aSettings));exit;
					$this->load->helper('custom_mail');
					sendMail_PHPMailer($aSettings);

					$this->session->set_flashdata ('success_message', 'Welcome to '.$this->mcontents['c_website_title']);

			       	redirect('home');

				} else {
					echo '3';exit;
					sf('error_message', 'We already have an account associated with the email id '.$oFbUserData->email);
					redirect('home');
				}
				//$aFBUserData['facebook_id'] =
		}

	}

	/**
	 *
	 *
	 * Before listing users, this page is displayed. for easy access to users of different roles
	 */
	function listing_home () {

		$this->authentication->is_admin_logged_in (true);
		isAdminSection();

		$this->mcontents['page_title'] =  $this->mcontents['page_heading']	= 'Users by Roles';

		$this->_requireUserRolesDropdown();

		loadAdminTemplate('user/listing_home', $this->mcontents);
	}


	/**
	 * manage user from admin section
	 *
	 */
	function listing($iStatus=0, $iGender=0, $iUserRole=0, $iOffset=0) {


		$this->authentication->is_admin_logged_in (true);

		isAdminSection();
		$this->mcontents['uri_string'] = $this->uri->uri_string();
		$this->mcontents['load_js']['data']['uri_string'] = $this->mcontents['uri_string'];

		ss('BACKBUTTON_URI', $this->mcontents['uri_string']);
		ss('redirect_to', $this->mcontents['uri_string']); // used only related to the profile section

		$this->mcontents['page_title'] 		= 'Enumerators';
		$this->mcontents['page_heading']	= 'Enumerators';

		$this->load->helper('date');

		$aWhere = array();

		if($iStatus) {
			$aWhere['U.status'] = $iStatus;
		}
		if($iGender) {
			$aWhere['U.gender'] = $iGender;
		}

		if($iUserRole ) {
			$aWhere['URM.role'] = $iUserRole;
		}

		//exclude the admin
		$aWhere['U.type <>'] = $this->aUserTypes['admin'];


		$this->mcontents['iTotal'] = count($this->user_model->getUsers(0, 0, $aWhere));

		$this->mcontents['iPerPage'] = c('users_per_page');
		$this->mcontents['aData'] = $this->user_model->getUsers($this->mcontents['iPerPage'], $iOffset, $aWhere);

		/* Pagination */
		$this->load->library('pagination');
		$this->aPaginationConfiguration = array();
		$this->aPaginationConfiguration['base_url'] 	= c('base_url').'user/listing/'.$iStatus.'/'.$iGender.'/'.$iUserRole;
		$this->aPaginationConfiguration['total_rows'] 	= $this->mcontents['iTotal'];
		$this->aPaginationConfiguration['per_page'] 	= $this->mcontents['iPerPage'];
		$this->aPaginationConfiguration['uri_segment'] 	= 6;
		$this->pagination->customizePagination();
		$this->mcontents['iOffset'] = $iOffset;
		//$this->mcontents['load_css'][] = 'pagination.css';
		$this->pagination->initialize($this->aPaginationConfiguration);
		$this->mcontents['sPagination'] = $this->pagination->create_links();
		/* Pagination - End*/


		//$this->mcontents['load_css'][] 	= 'grid.css';
		//$this->mcontents['load_css'][] 	= 'admin/user_list.css';
		//$this->mcontents['load_js'][] 	= 'grid.js';
		$this->mcontents['load_js'][] 	= 'admin/user_listing.js';
		$this->mcontents['load_js'][] 	= 'jquery/jquery.blockui.js';
		$this->mcontents['load_js'][] 	= 'jquery/jquery.blockui.js';

		$this->mcontents['aMonths'] 			= numbersTill(0, 1, 12);
		$this->mcontents['aYears'] 				= numbersTill(0, 2011, 2015);
		$this->mcontents['iStatus'] 			= $iStatus;
		$this->mcontents['iUserRole'] 			= $iUserRole;
		$this->mcontents['iGender'] 			= $iGender;
		$this->mcontents['aUserStatus'] 		= array(0=>"All") + array_flip($this->aUserStatus);
		$this->mcontents['aGenders'] 			= array(0=>"Both") + array_flip($this->aGenders);

		//p( $this->mcontents['aAllRoles'] );


		$this->_requireUserRolesDropdown();

		loadAdminTemplate('user/listing', $this->mcontents);

	}



	/**
	 *
	 * make user roles array,  to use in a drop down
	 */
	function _requireUserRolesDropdown() {

		//p($this->mcontents['aAllRoles']);

		$this->mcontents['aAllUserRoles'][0] = 'All';
		foreach( $this->mcontents['aAllRoles'] AS $sName => $aItem ) {

			$this->mcontents['aAllUserRoles'][ $aItem['id'] ] = $aItem['title'];
		}
	}




	/**
	 * set user details
	 * via AJAX
	 *
	 */
	function set($iAccountNo=0, $item='', $value='', $id='') {

		initializeJsonArray();
		if(isAdminLoggedIn()){

			if($oUser = $this->user_model->getUserBy('account_no', $iAccountNo)){

				switch ($item) {

					case 'status':
						if(in_array($value, $this->aUserStatus)){
							$this->db->where('account_no', $iAccountNo);
							$this->db->set('status', $value);
							$this->db->update('users');
						}
						break;
					case 'mem':
						break;

				}
				$this->aJsonOutput['output']['id'] = $id;

			}
		} else {
			$this->aJsonOutput['output']['error_type'] = $this->aErrorTypes['not_logged_in'];
			$this->aJsonOutput['output']['error'] = '0';
		}
		outputJson();
	}


	function subscribe($sType="newsletter") {

		initializeJsonArray();
		$this->form_validation->set_rules('email', 'Email', 'trim|required');

		if($this->form_validation->run() !== false){

			$this->db->where('email', safeText($this->input->post('email')));
			if(!$this->db->get('newsletters')->row()){
				$this->db->set('email', safeText($this->input->post('email')));
				$this->db->insert('newsletters');
			}
			$this->aJsonOutput['output']['success'] = formatMessage('you have been added to our subscription list. Please check your email', 'success');
		} else {
			$this->aJsonOutput['output']['error'] = formatMessage('Please enter a valid email id');
		}

		outputJson();

	}





	/**
	 * Close the account of a user.
	 *
	 * accessed via AJAX. ONLY by the admin user
	 */
	function take_action($sPurpose='', $iUserId=0, $sClass='') {

		$sCurrentUrl = urldecode( safeText('current_url', false, 'get') );
		$sCurrentUrl = $sCurrentUrl ? $sCurrentUrl : 'user/listing';

		if( !in_array( $sPurpose, array('close_account', 'logout') ) ) {
			redirect($sCurrentUrl);
		}

		initializeJsonArray();


		if( isAdminLoggedIn() ){

			if((s('USERID') != $iUserId)) {

				$oUser = $this->user_model->getUserBy('id', $iUserId);

				switch($sPurpose) {
					case 'close_account':

						$this->account_model->closeAccount($oUser->id);

						$this->aJsonOutput['output']['success'] = 'The account has been closed';
						break;
					case 'logout':

						$this->authentication->logout_from_db($oUser->id);

						$this->aJsonOutput['output']['success'] = 'The user has been logged out';
						break;
				}

			} else {
				sf('Cannot close admin account!');
				redirect($sCurrentUrl);
			}

		} else {

			setPostLoginRedirect($sCurrentUrl);
			$this->aJsonOutput['output']['error_type'] = $this->aErrorTypes['not_logged_in'];
			$this->aJsonOutput['output']['error'] = 'Not logged In';

		}
		$this->aJsonOutput['output']['c'] = $sClass;
		outputJson();
	}

	/**
	 *
	 * edit user details like email, status roles etc
	 *
	 */
	function edit($iAccountNo=0) {


		$this->authentication->is_admin_logged_in(true);

		if( !$this->mcontents['oUser'] = $this->user_model->getUserBy('account_no', $iAccountNo) ) {

			sf('error_message', 'Invalid user');
			redirect('user/listing');

		}

		isAdminSection();

		$this->mcontents['page_heading'] = $this->mcontents['page_title'] = 'Edit User';
		$this->mcontents['aExistingRoles'] = getUserRoles( $this->mcontents['oUser']->account_no );

		if ( isset($_POST) && !empty($_POST)) {


			$this->form_validation->set_rules('status', 'Status', 'trim|required');
			//$this->form_validation->set_rules('user_roles','User Roles', '');
			if ($this->form_validation->run() == TRUE) {

				$aData = array(
							'email_id' => safeText('email_id'),
							'status' => safeText('status'),
							'gender' => safeText('gender'),
						);

				$this->db->where('account_no', $iAccountNo);
				$this->db->update('users', $aData);

				//update roles.
				$aRoles 			= array_trim( safeText('user_roles') );

				$aDeletedRoles 	= array_diff($this->mcontents['aExistingRoles'], $aRoles);
				$aNewRoles 		= array_diff($aRoles, $this->mcontents['aExistingRoles']);


				//echo 'EXISTING : ';p( $this->mcontents['aExistingRoles']);
				//echo 'DELETED : ';p( $aDeletedRoles );
				//echo 'NEW : ';p( $aNewRoles );

				//p($aNewRoles);
				$this->_createRoles($aNewRoles, $this->mcontents['oUser']->account_no);
				$this->_deleteRoles($aDeletedRoles, $this->mcontents['oUser']->account_no);

				sf('success_message', 'The user data has been updated');
				redirect('user/edit/'.$iAccountNo);

			}
		}

		//p($this->mcontents['aExistingRoles']);

		$this->mcontents['aUserRolesTitles'] 	= $this->config->item('user_roles_title');
		$this->mcontents['iTotalNumRoles'] 		= count( $this->mcontents['aUserRolesTitles'] );
		$this->mcontents['aUserStatusFlipped'] 	= array_flip( $this->config->item('user_status') );
		$this->mcontents['iAccountNo'] 			= $iAccountNo;

		loadAdminTemplate('user/edit');
	}


	function _createRoles( $aRoles=array(), $iAccountNo ) {

		if( $aRoles ) {

		}
		foreach( $aRoles AS $iRole ) {

			$this->db->set('role', $iRole);
			$this->db->set('account_no', $iAccountNo);
			$this->db->insert('user_role_map');

		}
	}

	function _deleteRoles( $aRoles=array(), $iAccountNo ) {

		if( $aRoles ) {

		}
		foreach( $aRoles AS $iRole ) {

			$this->db->where('role', $iRole);
			$this->db->where('account_no', $iAccountNo);
			$this->db->delete('user_role_map');

		}
	}



}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
