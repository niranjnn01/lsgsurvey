<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Program extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->model('program_model');
		$this->load->config('program_config');
		$this->load->model('common_model');

		$this->mcontents['aProgramStatus'] 		= $this->config->item('program_status');
		$this->mcontents['aProgramStatusTitle'] = $this->config->item('program_status_title');

		$this->mcontents['aProgramObjectiveStatus']         = $this->config->item('program_objective_status');
		$this->mcontents['aProgramObjectiveStatusTitle']    = $this->config->item('program_objective_status_title');


		$this->mcontents['aErrorTypes'] 		= $this->config->item('error_types');


		$this->load->config('resource_config');
		$this->mcontents['aResourceType'] 		= $this->config->item('resource_type');
		$this->mcontents['aResourceTypeUrl'] 	= $this->config->item('resource_type_url');
	}


	/**
	 *
	 * The programs Home page
	 *
	 */
	public function index($iType=0, $iOffset=0) {

		$iLimit = $this->config->item('programs_per_page');

		$aOrderBy = $aWhere = array();

		$this->mcontents['page_title'] = 'Programs';
		$this->mcontents['sCurrentMainMenu'] = 'program';

		$this->mcontents['iType'] 			= $iType;

		$aOrderBy = array('P.priority' => 'ASC');

		$aWhere['P.status'] = $this->mcontents['aProgramStatus']['active'];

		$this->mcontents['iTotal'] 			= count( $this->program_model->getPrograms(0, 0, $aWhere) );
		$this->mcontents['aAllPrograms'] 	= $this->program_model->getPrograms($iLimit,
																			$iOffset,
																			$aWhere,$aOrderBy);

		/* Pagination */
		$this->load->library('pagination');
		$this->aPaginationConfiguration = array();
		$this->aPaginationConfiguration['base_url'] 	= c('base_url').'program/index/' . $iType . '/';
		$this->aPaginationConfiguration['total_rows'] 	= $this->mcontents['iTotal'];
		$this->aPaginationConfiguration['per_page'] 	= $iLimit;
		$this->aPaginationConfiguration['uri_segment'] 	= 4;
		$this->pagination->customizePagination();
		$this->mcontents['iOffset'] 					= $iOffset;
		//$this->mcontents['load_css'][] 					= 'pagination.css';
		$this->pagination->initialize($this->aPaginationConfiguration);
		$this->mcontents['sPagination'] 				= $this->pagination->create_links();
		/* Pagination - End*/

		$this->load->helper('resource');


		$this->mcontents['aBreadCrumbs'][] = array(
												'uri' 	=>'program',
												'title' => 'Programs',
											);



		loadTemplate('program/home');
	}


	/**
	 *
	 * manage program from admin section
	 *
	 */
	function listing( $iStatus=0, $iOffset=0 ) {

		$this->authentication->is_admin_logged_in(true);

		isAdminSection();

		ss('BACKBUTTON_URI', $this->uri->uri_string());

		$this->mcontents['page_heading'] = $this->mcontents['page_title'] = 'Programs';

		$this->load->helper('date');

		$aWhere = array();

		if( $iStatus ) {
			$aWhere['P.status'] = $iStatus;
		}
		$aOrderBy = array('P.created_on' => 'DESC');

		$iLimit = c('programs_per_page');

		$this->mcontents['iTotal'] = count( $this->program_model->getPrograms(0, 0, $aWhere) );
		$this->mcontents['aData'] = $this->program_model->getPrograms_Detailed($iLimit, $iOffset, $aWhere, $aOrderBy);

		//p( $this->db->last_query() );
		/* Pagination */
		$this->load->library('pagination');
		$this->aPaginationConfiguration = array();
		$this->aPaginationConfiguration['base_url'] 	= c('base_url').'program/listing/'.$iStatus;
		$this->aPaginationConfiguration['total_rows'] 	= $this->mcontents['iTotal'];
		$this->aPaginationConfiguration['per_page'] 	= $iLimit;
		$this->aPaginationConfiguration['uri_segment'] 	= 4;
		$this->pagination->customizePagination();
		$this->mcontents['iOffset'] 					= $iOffset;
		//$this->mcontents['load_css'][] 					= 'pagination.css';
		$this->pagination->initialize($this->aPaginationConfiguration);
		$this->mcontents['sPagination'] 				= $this->pagination->create_links();
		/* Pagination - End*/


		//$this->mcontents['load_css'][] 	= 'grid.css';
		//$this->mcontents['load_css'][] 	= 'admin/program_list.css';
		//$this->mcontents['load_js'][] 	= 'grid.js';
		$this->mcontents['load_js'][] 	= 'admin/program_listing.js';
		$this->mcontents['load_js'][] 	= 'jquery/jquery.blockui.js';
		$this->mcontents['load_js'][] 	= 'jquery/jquery.blockui.js';

		$this->mcontents['iStatus'] 				= $iStatus;
		$this->mcontents['aProgramStatusTitle'] 	= array(0=>"All") + $this->mcontents['aProgramStatusTitle'];

		loadAdminTemplate('program/listing', $this->mcontents);

	}


	/**
	 *
	 * View an program
	 *
	 */
	function view ($sProgramName='') {

		if($sProgramName) {

			$sProgramName = safeText($sProgramName, false, 'post', true);

			if( !$this->mcontents['oProgram'] = $this->program_model->getProgramBy('seo_name', $sProgramName) ) {

				// see if we can still find the artile with the programs id
				// this is usefull in the case of programs, whoes title has been changed, as a result of which there old
				// seo link has been changed as well.

				if( $iNum = getStringAppendedNum($sProgramName) ) {

					if( ! $this->mcontents['oProgram'] = $this->program_model->getProgramBy('uid', $iNum) ) {
						sf('error_message', 'The program you are looking for cannot be found.');
						redirect('program');
					} else {

						redirect('program/view/' . $this->mcontents['oProgram']->seo_name);
					}
				} else {

					sf('error_message', 'The program you are looking for cannot be found.');
					redirect('program');
				}

			}

		} else {
			redirect('program');
		}


		if( $this->mcontents['oProgram']->status != $this->mcontents['aProgramStatus']['active'] ) {

			// see if it is the admin user
			if( ! $this->authentication->is_admin_logged_in() ) {

				sf('error_message', 'This information is temporarily unavailable');
				redirect('program');
			}

		}

		$this->mcontents['page_title'] 		= $this->mcontents['oProgram']->title;


		//get other programs
		//$this->mcontents['aOtherPrograms'] = $this->program_model->getOtherPrograms( $this->mcontents['oProgram']->uid );

		//get related campaigns
		$this->mcontents['aRelatedCampaigns'] = $this->program_model->getRelatedCampaigns( $this->mcontents['oProgram']->uid );

		//get related projects
		$this->mcontents['aRelatedProjects'] = $this->program_model->getRelatedProjects( $this->mcontents['oProgram']->uid );

		//get related projects
		$this->mcontents['aRelatedPolicyAdvocacy'] = $this->program_model->getRelatedPolicyAdvocacy( $this->mcontents['oProgram']->uid );

        //p( $this->db->last_query() );exit;

		//get the related resources
		$this->load->helper('resource');
		$this->mcontents['aResources'] = getResourceData('program', $this->mcontents['oProgram']->uid);

		$this->load->helper('video');

		$this->mcontents['sCurrentMainMenu'] = 'program';


		$this->load->helper('social');
		requireSocialButtons();

		$this->load->model('user_model');
		$this->load->helper('profile');

		$this->mcontents['sRelatedProjects'] 		= $this->load->view('project/common_related_projects', $this->mcontents, true);
		$this->mcontents['sRelatedPolicyAdvocacy'] 	= $this->load->view('policy_advocacy/common_related_policy_advocacy', $this->mcontents, true);
		$this->mcontents['sRelatedCampaigns'] 		= $this->load->view('campaign/common_related_campaigns', $this->mcontents, true);
		$this->mcontents['sRelatedResources'] 		= $this->load->view('resource/resources_tab', $this->mcontents, true);


        $this->mcontents['og_meta_data'] = array(
            'og_url' 			=> $this->mcontents['c_base_url'] . 'program/view/' . $this->mcontents['oProgram']->seo_name,
            'og_image'			=> getResourceThumbnailUrl($this->mcontents['oProgram']->display_image, 'large'),
            'og_title'			=> $this->mcontents['oProgram']->title,
            'og_description'	=> $this->mcontents['oProgram']->excerpt,
        );



		// show google groups
		$this->mcontents['bShowGoogleGroup'] = false;
		//echo ENVIRONMENT_;
		switch( ENVIRONMENT_ ) {

			case 'production':
			case 'testing':

				if( $this->mcontents['oProgram']->uid == 33536731 ) {

					$this->mcontents['bShowGoogleGroup'] = true;
				}
				break;

			case 'local':

				if( $this->mcontents['oProgram']->uid == 46043377 ) {

					$this->mcontents['bShowGoogleGroup'] = true;

				}
				break;
		}

		//p($this->mcontents['oProgram']->uid);
		//var_dump($this->mcontents['bShowGoogleGroup']);

		$this->mcontents['aBreadCrumbs'][] = array(
												'uri' 	=>'program',
												'title' => 'Programs',
											);
		$this->mcontents['aBreadCrumbs'][] = array(
												'uri' 	=>'',
												'title' => $this->mcontents['oProgram']->title,
											);

		//loadTemplate('program/tabbed_view');
		loadTemplate('program/view');

	}


	/**
	 * Its a function because its used by both edit and create functions
	 *
	 */
	function _getFormData() {

		$post_data['title']				= safeText('title');
		$post_data['excerpt']			= safeText('excerpt');
		$post_data['description']		= safeHtml('description');
		$post_data['status']			= safeText('program_status');
		$post_data['priority']			= safeText('priority');
		$post_data['program_director']	= safeText('program_director');

		return $post_data;
	}


	/**
	 * Create a new program
	 *
	 */
	function create() {

		$this->authentication->is_admin_logged_in(true);

		isAdminSection();


		$this->mcontents['page_heading'] = $this->mcontents['page_title'] 		= 'Create Program';

        $this->load->model('resource_model');

		if ( isset($_POST) && !empty($_POST)) {

			$this->_validate_create_program();

			if ($this->form_validation->run() == TRUE) {


                $bProceed = true;


                if( $iDisplayImage = safeText('display_image') ) {

                    //make sure the display image is a valid image
                    if( ! $this->resource_model->is_type($iDisplayImage, 'image') ) {
                        $bProceed = false;
                        $this->merror['error'][] = 'The selected display image is not of type "image"';
                    }
                }


                if( $bProceed ) {

                    //generate thumbnails for the display_image.
                    if( $iDisplayImage ) {
                        $this->resource_model->createResourceThumbnails( $iDisplayImage );
                    }

                    $this->load->helper('date');
                    $this->load->helper('resource');

                    $post_data = $this->_getFormData();

                    $post_data['uid'] 			= $this->common_model->generateUniqueNumber(
                                                                                            array('table' => 'programs',
                                                                                                  'field' => 'uid'));

                    $post_data['seo_name']		= $this->common_model->getSeoName($post_data['title'], $post_data['uid']);
                    $post_data['updated_on'] 	= $post_data['created_on']	= date('Y-m-d H:i:s');
                    $post_data['status']		= $this->mcontents['aProgramStatus']['active'];
                    $post_data['topic_uid']		= safeText('topic');
                    $post_data['display_image']	= $iDisplayImage;

                    if( empty($this->merror['error']) ) {

                        if($this->db->insert('programs', $post_data)) {
                        //if(true) {

                            //create the mapping with resource
                            //$aResources = safeText('resource_id');

                            $aResources = array_json_to_php( safeText('selected_resources') );

                            $this->_createMapping($aResources, $post_data['uid']);



							// Update the main header contents, since this
							// section can affect the main header contents
							$this->common_model->generateHeader_dynamicParts();



                            sf('success_message', 'Program has been created');
                            redirect('program/create');

                        } else {

                            $this->merror['error'][] = 'There was some error. Please try back again';
                        }
                    }

                }

			}
		}


		$this->mcontents['load_js'][] 	= "jquery/jquery.validate.min.js";
		$this->mcontents['load_js'][] 	= "validation/program/create.js";

		$this->mcontents['aProgramStatus']  = array(0=>'Select') + array_flip($this->mcontents['aProgramStatus']);
		$this->mcontents['aPriority']       = numbersTill(1, 10);
		//Get topics
		$aConfig = array(
			'table' 		=> 'topics',
			'id_field' 		=> 'uid',
			'title_field' 	=> 'title'
		);
		$this->mcontents['aTopics'] = $this->common_model->getDropDownArray($aConfig);

		//wysiwyg editor
		//requireTextEditor(array('per_page' => array('specific_generic.js')));
		requireTextEditor(array('profile' => 'content_editor'));


		$this->mcontents['load_js'][] = 'jquery/jquery.limit-1.2.source.js';
		//$this->mcontents['load_js'][] = 'admin/add_resource.js';




		// inlcude resources using Datatable - Start
        requireDataTable_new();
		$this->mcontents['load_js'][] = 'resource/resource_datatable_common.js';
        $this->mcontents['load_js']['data']['selected_resources_js_array_content'] = '';
        $this->mcontents['sResourceTable'] = $this->load->view('resource/resource_table_all', true);
		requirePopup('fancybox2');
        // inlcude resources using Datatable - End


		ss('BACKBUTTON_URI', 'program/listing');

		loadAdminTemplate('program/create');

	}


	/**
	 *
	 * Edit a program
	 *
	 */
	function edit($iProgramId=0) {

		$this->authentication->is_admin_logged_in(true);

		isAdminSection();

		if( ! $this->mcontents['oProgram'] = $this->program_model->getProgramBy('uid', $iProgramId) ) {
			//p( $this->db->last_query() );
			//exit;
			sf('error_message', 'The program does not exist!');
			redirect('program/listing');
		}

		//p( $this->mcontents['oProgram']	);

		$this->mcontents['page_heading'] = $this->mcontents['page_title'] = 'Edit Program';

		if ( isset($_POST) && !empty($_POST)) {

            //p($_POST);
            //exit;

			$this->_validate_create_program();

			if ($this->form_validation->run() == TRUE) {


                $bProceed = true;
				$this->load->model('resource_model');

                if( $iDisplayImage = safeText('display_image') ) {

                    //make sure the display image is a valid image
                    if( ! $this->resource_model->is_type($iDisplayImage, 'image') ) {
                        $bProceed = false;
                        $this->merror['error'][] = 'The selected display image is not of type "image"';
                    }
                }

                if( $bProceed ) {

                    //generate thumbnails for the display_image.
                    if( $iDisplayImage ) {
                        $this->resource_model->createResourceThumbnails( $iDisplayImage );
                    }

                    $post_data 					= $this->_getFormData();
                    $post_data['updated_on'] 	= date('Y-m-d H:i:s');
                    $post_data['seo_name']		= $this->common_model->getSeoName($post_data['title'], $this->mcontents['oProgram']->uid);
                    $post_data['status']		= safeText('status');
                    $post_data['topic_uid']		= safeText('topic');
                    $post_data['display_image']	= $iDisplayImage;


                    $this->db->where('uid', $iProgramId);
                    if( $this->db->update('programs', $post_data) ) {


                            //update the mapping with resources
                            //$aResources = array_trim( safeText('resource_id') );

                            //$sResources = str_replace( array('[',']', '&quot;'), array(), safeText('selected_resources') );
                            //$aResources = explode(',', $sResources);
                            $aResources = array_json_to_php( safeText('selected_resources') );


                            $this->load->helper('resource');
                            $this->load->helper('array');


                            $aExistingResources = getResourceIds_in_array('program', $this->mcontents['oProgram']->uid, 'array');
                            $aDeletedResources 	= array_diff($aExistingResources, $aResources);
                            $aNewResources 		= array_diff($aResources, $aExistingResources);
                            //var_dump($aResources);
							//echo '<br/>---';
                            //var_dump($aExistingResources);

                            $this->_createMapping($aNewResources, $this->mcontents['oProgram']->uid);
                            $this->_deleteMapping($aDeletedResources, $this->mcontents['oProgram']->uid);



							// Update the main header contents, since this
							// section can affect the main header contents
							$this->common_model->generateHeader_dynamicParts();



                        sf('success_message', 'Program has been updated');
                        redirect('program/edit/'.$iProgramId);

                    } else {

                        $this->merror['error'][] = 'There was some error. Please try back again';
                    }
                }

			}
		}

		//get the corresponding resources
		$this->load->helper('resource');
		$this->mcontents['oProgram']->aResources = getResourceData('program', $this->mcontents['oProgram']->uid);

        $this->mcontents['selected_resources_stringified'] = '';
        $this->mcontents['load_js']['data']['selected_resources_js_array_content'] = $this->mcontents['selected_resources_js_array_content'] = '';
        if( $this->mcontents['oProgram']->aResources ){

            $aTemp = array();
            foreach( $this->mcontents['oProgram']->aResources AS $oItem ) {
                $aTemp[] = $oItem->resource_id;
            }

            $this->mcontents['selected_resources_stringified'] = '[&quot;' . implode('&quot;,&quot;', $aTemp) . '&quot;]';
            $this->mcontents['selected_resources_js_array_content'] = '"' . implode('","', $aTemp) . '"';
            $this->mcontents['load_js']['data']['selected_resources_js_array_content'] = $this->mcontents['selected_resources_js_array_content'];

        }

		$this->mcontents['iProgramId'] 	= $iProgramId;
		$this->mcontents['aProgramStatusFlipped'] 	= array_flip( $this->mcontents['aProgramStatus'] );

		$this->mcontents['load_js'][] 	= "jquery/jquery.validate.min.js";
		$this->mcontents['load_js'][] 	= "validation/program/create.js";
		//$this->mcontents['load_css'][] 	= 'form.css';
		//$this->mcontents['load_css'][] 	= 'forms/program/create.css';

		$this->mcontents['aProgramStatusTitle'] = array(0=>'Select') + $this->mcontents['aProgramStatusTitle'];
		$this->mcontents['aPriority']           = numbersTill(1, 10);

		//Get topics
		$aConfig = array(
			'table' 		=> 'topics',
			'id_field' 		=> 'uid',
			'title_field' 	=> 'title'
		);
		$this->mcontents['aTopics'] = $this->common_model->getDropDownArray($aConfig);

		//wysiwyg editor
		//requireTextEditor(array('per_page' => array('specific_generic.js')));
		requireTextEditor(array('profile' => 'content_editor'));


        requirePopup('fancybox2');


		/*
        requireDataTable();
		$this->mcontents['load_js'][] = 'resource/resource_datatable_common.js';
        $this->mcontents['sResourceTable'] = $this->load->view('resource/resource_table_all', true);
        */

        requireDataTable_new();
		$this->mcontents['load_js'][] = 'resource/resource_datatable_common.js';
        $this->mcontents['sResourceTable'] = $this->load->view('resource/resource_table_all', true);





		$this->mcontents['load_js'][] = 'jquery/jquery.limit-1.2.source.js';
		//$this->mcontents['load_js'][] = 'admin/add_resource.js';

        $this->load->helper('video');


		ss('BACKBUTTON_URI', 'program/listing');

        //p($this->mcontents['aResourceType']);

		loadAdminTemplate('program/edit');
	}


	/**
	 *
	 * Create mapping
	 *
	 */
	function _createMapping($aResources, $iProgramId) {

        //p($aResources);
		$aResources = array_unique($aResources);

        //p($aResources);
        //var_dump($aResources);


		foreach( $aResources AS $iResourceId ) {

			//var_dump($iResourceId);
			$iResourceId += 0;
			//p($iResourceId);
			//exit;
			if( $iResourceId ) {
				//echo 'here';
				//exit;
				$this->db->set('program_id', $iProgramId);
				$this->db->set('resource_id', $iResourceId);
				$this->db->insert('program_resource_map');
			} else {
				//echo 'here 2' . $iResourceId;

			}
		}
		//exit;
	}


	/**
	 *
	 * Delete mapping
	 *
	 */
	function _deleteMapping($aResources, $iProgramId) {

		foreach( $aResources AS $iResourceId ) {

			$this->db->where('program_id', $iProgramId);
			$this->db->where('resource_id', $iResourceId);
			$this->db->delete('program_resource_map');
		}
	}


	function _validate_create_program() {

		$this->form_validation->set_rules ('title','Title', 'trim|required');
		$this->form_validation->set_rules ('excerpt','Excerpt', 'trim|required|max_length['.$this->config->item('excerpt_character_length').']');
		$this->form_validation->set_rules ('description','Description', 'trim|required');
		$this->form_validation->set_rules ('topic','Topic', 'trim|required');
		$this->form_validation->set_rules ('priority','Priority', 'trim|required');
		$this->form_validation->set_rules ('program_director','Program Director', 'trim|required');
	}





	/**
	 *
	 * Permanently delete an program from the system
	 * accessed via AJAX
	 *
	 */
	function delete_program($iProgramId, $sClass='') {

		initializeJsonArray();

		if( isAdminLoggedIn() ) {

			$this->db->where('uid', $iProgramId);
			if( $oProgram = $this->db->get('programs')->row() ) {

				$this->db->where('uid', $iProgramId);
				$this->db->delete('programs');

				//free the resource mappings
				$this->db->where('program_id', $iProgramId);
				$this->db->delete('program_resource_map');

				//delete the mapping with campaigns
				$this->db->where('program_uid', $iProgramId);
				$this->db->delete('program_campaign_map');

				//delete the mapping with policy advocacies
				$this->db->where('program_uid', $iProgramId);
				$this->db->delete('program_policy_advocacy_map');


				$this->aJsonOutput['output']['success'] = 'The program has been deleted';

			} else {
				$this->aJsonOutput['output']['error_type'] = $this->aErrorTypes['other'];
				$this->aJsonOutput['output']['error'] = 'Program does not exist';
			}


		} else {
			$this->aJsonOutput['output']['error_type'] = $this->aErrorTypes['not_logged_in'];
			$this->aJsonOutput['output']['error'] = 'Not logged In';

		}

		$this->aJsonOutput['output']['c'] = $sClass;
		outputJson();
	}














}

/* End of file program.php */
/* Location: ./application/controllers/program.php */
