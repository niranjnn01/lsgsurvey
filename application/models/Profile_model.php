<?php
class Profile_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	

	/**
	 *
	 * Get all information required to show a user profile
	 *
	 * @param integer $iAccountNo
	 * 
	 */
	function getUserProfile_1($by = 'account_no', $sValue) {
		
		$sField = 'U.account_no';
		if($by == 'username'){
			$sField = 'U.username';
		}
		
		$this->db->select("
			U.*,
			CONCAT_WS(' ', U.first_name, U.middle_name, U.last_name ) full_name,
			PP.current_pic
			", false);
		$this->db->join('profile_pictures PP', 'PP.user_id = U.id', 'left');
		$this->db->where($sField, $sValue);
		
		$oUser = $this->db->get('users U')->row();
		
		
		return $oUser;
	}
	
	
	/**
	 *
	 * Get all information required to show a user profile
	 *
	 * @param integer $iAccountNo
	 *
	 *
	 *  USE FUNCTION getUserProfile_1 INSTEAD. THIS FUNCTION WILL BE PHASED OUT SOON
	 * 
	 */
	function getUserProfile($iAccountNo) {
		
		
		/**
		 * USE FUNCTION getUserProfile_1 INSTEAD. THIS FUNCTION WILL BE PHASED OUT SOON
		 */
		
		$this->db->select("
			U.*,
			CONCAT_WS(' ', U.first_name, U.middle_name, U.last_name ) full_name,
			PP.current_pic
			", false);
		$this->db->join('profile_pictures PP', 'PP.user_id = U.id', 'left');
		$this->db->where('U.account_no', $iAccountNo);
		
		$oUser = $this->db->get('users U')->row();
		
		
		/**
		 * USE FUNCTION getUserProfile_1 INSTEAD. THIS FUNCTION WILL BE PHASED OUT SOON
		 */
		
		return $oUser;
	}
	
	/**
	 * When a user changes their election id from profile section, this function is called to make note of the change in a table
	 */
	function updateElectionIdHistory($iAccountNo, $sNewElectionId){
		
		$aData = array(
						'account_no' => $iAccountNo,
						'election_id' => $sNewElectionId,
						'created_on' => date('Y-m-d H:i:s'),
				);
		$this->db->insert('user_election_id_change_history', $aData);
		
	}
	
	
	/**
	 *
	 * When a user changes their ward from profile section, this function is called to make note of the change in a table
	 */
	/*
	function updateUserWardMapping($iAccountNo, $iWardId){
		
		$aData = array(
						'account_no' => $iAccountNo,
						'election_id' => $sNewElectionId,
						'from_date' => date('Y-m-d H:i:s'),
				);
		$this->db->insert('user_ward_mapping');
	}
	*/
	
	/**
	*
	* Get the wards of a user.
	* A user can have more than one ward associated with him/her
	*/
   function getUserWards($iAccountNo, $sFormat = 'ward_ids') {
	
	   $aData = array();
	   
	   $this->db->where('user_account_no', $iAccountNo);
	   $aResultSet = $this->db->get('user_ward_mapping')->result();
	   
	   switch($sFormat) {
		   case 'ward_ids':
			   foreach($aResultSet AS $oItem) {
				   $aData[] = $oItem->ward_id;
			   }
			   break;
	   }
	   
	   return $aData;
   }
   
   
   
   
	
	
	/**
	 *
	 * check if election id of a user is a new one or not
	 */
	function isNewElectionId($iAccountNo, $sElectionId) {
		
		$iIsNew = TRUE;
		
		$CI = & get_instance();
		
		$CI->db->where('account_no', $iAccountNo);
		$oRow = $CI->db->get('users')->row();
		
		//var_dump($sElectionId);
		if( $oRow ) {
			
			if( $oRow->election_id == $sElectionId) {
				
				$iIsNew = FALSE;
			}	
		}
		
		//var_dump($iIsNew);
		
		return $iIsNew;
	}
	
}