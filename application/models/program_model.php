<?php
class Program_model extends CI_Model{

	function __construct(){
		parent::__construct();

		$this->load->config('program_config');
		$this->load->config('campaign_config');
		$this->load->config('policy_advocacy_config');

		$this->aProgramStatus       = $this->config->item('program_status');
		$this->aCampaignStatus      = $this->config->item('campaign_status');
		$this->aPolicyAdvocacytatus = $this->config->item('policy_advocacy_status');
	}


	/**
	 *
	 * Get a single program
	 *
	 */
	function getProgramBy($sField='id', $sValue) {

        $sField = 'P.'.$sField;

		$this->db->select('
						P.*,
						TP.uid topic_uid,
						TP.title topic_title,
						CONCAT_WS(" ", U.first_name, U.middle_name, U.last_name) program_director_name
						', false);
		$this->db->where($sField, $sValue);
        $this->db->join('topics TP', 'TP.uid = P.topic_uid', 'LEFT');
        $this->db->join('users U', 'U.account_no = P.program_director', 'LEFT');

		$query = $this->db->get('programs P');

		//p($this->db->last_query());
		return $query->row();
	}


	/**
	 * get a list of programs
	 *
	 * @param unknown_type $iLimit
	 * @param unknown_type $iOffset
	 * @param unknown_type $aWhere
	 * @return unknown
	 */
	function getPrograms( $iLimit=0, $iOffset=0, $aWhere=array(), $aOrderBy=array() ) {

		$this->db->select('
						  P.uid,
						  P.program_director,
						  P.title,
						  P.excerpt,
						  P.description,
						  P.seo_name,
                          P.priority,
						  P.created_on,
						  P.updated_on,
						  P.status,
						  P.display_image,
                          TP.title topic_title
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

        $this->db->join('topics TP', 'TP.uid = P.topic_uid', 'LEFT');

		//p($this->db->last_query());
		return $this->db->get('programs P')->result();
	}



	/**
	 * Same as getPrograms, but this will get more details related to a program.(involves a more complex query)
	 * used in the admin section to fetch all details related to programs
	 *
	 * @param unknown_type $iLimit
	 * @param unknown_type $iOffset
	 * @param unknown_type $aWhere
	 * @return unknown
	 */
	function getPrograms_Detailed( $iLimit=0, $iOffset=0, $aWhere=array(), $aOrderBy=array() ) {

		$this->db->select('
						  P.uid,
						  P.program_director,
						  P.title,
						  P.excerpt,
						  P.description,
						  P.seo_name,
						  P.priority,
						  P.created_on,
						  P.updated_on,
						  P.status,
                          TP.title topic_title,
                          (SELECT COUNT(campaign_uid) FROM program_campaign_map WHERE program_uid = P.uid) AS num_campaigns,
						  CONCAT_WS(" ", U.first_name, U.middle_name,  U.last_name) program_director_name
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

        $this->db->join('topics TP', 'TP.uid = P.topic_uid', 'LEFT');
        $this->db->join('users U', 'U.account_no = P.program_director', 'LEFT');



        $query = $this->db->get('programs P');

		//p($this->db->last_query());

		return $query->result();
	}



    /**
     * Get a list of active paigns other than the given program
     */
    function getOtherPrograms ( $iProgramId ) {

		$this->db->select('seo_name, title, priority');
		$this->db->where('uid <> ', $iProgramId);
		$this->db->where('status', $this->aProgramStatus['active']);
		$query = $this->db->get('programs C');


		$aData =  $query->result();

		return $aData;
    }


    /**
     *
     * Get a list of campaigns related to a particular program
     *
     */
    function getRelatedCampaigns( $iProgramId ) {

		$this->db->join('program_campaign_map PCM', 'PCM.campaign_uid = C.uid');
		$this->db->where('PCM.program_uid', $iProgramId);
        $this->db->where('status', $this->aCampaignStatus['active']);
		$this->db->order_by('C.priority', 'ASC');
		$query = $this->db->get('campaigns C');

		$aData =  $query->result();

        return $aData;
    }


    /**
     *
     * Get a list of projects related to a particular program
     *
     */
    function getRelatedProjects( $iProgramId ) {

		$this->db->join('program_project_map PPM', 'PPM.project_uid = P.uid');
		$this->db->where('PPM.program_uid', $iProgramId);
        $this->db->where('status', $this->aCampaignStatus['active']);
		$this->db->order_by('P.priority', 'ASC');
		$query = $this->db->get('projects P');

		$aData =  $query->result();

        return $aData;
    }


    /**
     *
     * Get a list of projects related to a particular program
     *
     */
    function getRelatedPolicyAdvocacy( $iProgramId ) {

		$this->db->join('program_policy_advocacy_map PPAM', 'PPAM.policy_advocacy_uid = PA.uid');
		$this->db->where('PPAM.program_uid', $iProgramId);
        $this->db->where('status', $this->aCampaignStatus['active']);
        $this->db->order_by('PA.priority', 'ASC');
		$query = $this->db->get('policy_advocacys PA');

		$aData =  $query->result();

        return $aData;
    }


	/**
	 *
	 * get the programs under a program-director
	 *
	 */
	function getProgramByProgramDirector( $oUser, $aWhere = array() ) {

		$aDefaultWhere = array(
							'program_director' => $oUser->account_no,
							'status' => $this->aProgramStatus['active'],
						);
		$aWhere = array_merge($aDefaultWhere, $aWhere);


		$this->db->where($aWhere);
		$aData =  $this->db->get('programs')->result();

        return $aData;
	}



	/**
	 *
	 * Get objectives for a program , for a given year
	 */
	function getObjectivesOfProgram($iProgramUid=0, $iYear=0, $aWhere=array()) {

		$aData = array();


		if( $iProgramUid ) {

			$this->db->join('objective_program_map OPM', 'OPM.objective_id = OBJ.id');
			$this->db->where('OPM.program_uid', $iProgramUid);
			if( $iYear ) {
			$this->db->where('YEAR(target_date)', $iYear);
			}


			if( $aWhere ) {
				$this->db->where($aWhere);
			}

			$aData = $this->db->get('objectives OBJ')->result();

      //p( $this->db->last_query() );
		}

		return $aData;
	}



    /**
     *
     * get single program objective by field value
     */
    function getProgramObjectiveBy($sField='id', $value=0) {

        $sField = 'PO.' . $sField;
        $this->db->where($sField, $value);
        return $this->db->get('program_objectives PO')->row();
    }











    /**
     *
     * from the current date, identify the financial year
     *
     */
    function getCurrentFinancialYear_old(){

        $iCurrentYear = date('Y');
        if( date('m') < 4 ) {

            $iCurrentYear--;
        }

        return $iCurrentYear;
    }



		function getCurrentFinancialYear() {

				$sStartingMonth = 'april'; //financial month starts on - objective is related to this

				$iFinancialYear = $iCurrentYear = date('Y');

				$sCurrentYearStartingDate = $sStartingMonth . ' 1 ' . $iCurrentYear;

				$oCurrentFinStartingDate 		= date_create($sCurrentYearStartingDate);
				$oCurrentFinYearEndingDate 	= date_add(date_create($sCurrentYearStartingDate), new DateInterval('P364D'));

				$oToday = date_create();

				if( $oCurrentFinStartingDate->format('Y') == $oCurrentFinYearEndingDate->format('Y') ) {
						$iFinancialYear = $oCurrentFinStartingDate->format('Y');
				} else {
						if( $oToday < $oCurrentFinStartingDate ) {
								$iFinancialYear = $iCurrentYear - 1;
						} elseif( $oToday >= $oCurrentFinStartingDate ) {
								$iCurrentYear;
						}
				}

				return $iCurrentYear;
		}


		/**
		 *
		 * This function is used to format data from ()
		 */
		function formatObjectiveData($aObjectivesData, $sFormat = 'program-objective-map', $bReturnObject = FALSE) {

				$formatted_data = array();

				$aOther = array(); // objectives which does not have a coupling.
				//$aOther = array('other'=>array()); // objectives which does not have a coupling.
				$aTempArray = array();

				//p($aObjectivesData);

				switch($sFormat) {

						case 'program-objective-map':

								foreach( $aObjectivesData AS $oObjectives ) {

										if( ! empty( $oObjectives->program_uid ) ) {

												if(! isset($aTempArray[$oObjectives->program_uid])) {
													$aTempArray[$oObjectives->program_uid] = array();
													$aTempArray[$oObjectives->program_uid]['program_title'] = $oObjectives->program_title;
													$aTempArray[$oObjectives->program_uid]['aObjectives'][$oObjectives->id] = $oObjectives->title;
												} else {
														$aTempArray[$oObjectives->program_uid]['aObjectives'][$oObjectives->id] = $oObjectives->title;

												}

										} else {

												$aOther[0]['program_title'] = 'Other';
												$aOther[0]['aObjectives'][$oObjectives->id] = $oObjectives->title;

/*
												$aOther['other']['program_title'] = 'Other';
												$aOther['other']['aObjectives'][$oObjectives->id] = $oObjectives->title;
*/
										}

								}
								break;
				}
				$aTempArray = $aTempArray + $aOther;

				if( $bReturnObject ) {
						$formatted_data = (object)$aTempArray;
				} else {
						$formatted_data = $aTempArray;
				}

				return $formatted_data;

		}
}
