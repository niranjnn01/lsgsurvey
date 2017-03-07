<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Resource Settings
|--------------------------------------------------------------------------
|
|
*/
$CI = & get_instance();


// High level grouping of files.
// example: into images, videos etc
// we are grouping this way, so that we can separate files by this group, and put them into folders

                            
/**
 *
 * The resource types
 *
 * "type" field in the DB use values from this array.
 *
 * "type" is used to place contents like images, docs, zip etc to a different folders after upload.
 *
 *
 * IMPORTANT : "resource_type" field in db DOES NOT take value from this array. It takes from "resource_types" table
 */

$config['resource_type']	= array(
                            'image'             => 1,   // png, gif, jpg etc
                                                        // CAUTION : the key "image" is now used to find table .
                            'document'          => 2,   // word, excel, ppt, pdf etc
                            'video'             => 3,   // video
                                                        // CAUTION : the key "video" is now used to find table .
                            'zip'               => 4,
                            'audio'             => 5,
                            'other'             => 6,
                            'youtube_video'     => 7,
                            'web_link'          => 8,
                            'other_video_link'  => 9, // links with custom video players. example mathrubhumi video page
                        );

$config['resource_type_title']	= array(
                            1 => 'image',
                            2 => 'document',
                            3 => 'video',
                            4 => 'Zip',
                            5 => 'Audio',
                            6 => 'Other',
                            7 => 'Youtube Video',
                            8 => 'Web Link',
                        );

$config['resource_status']	= array(
                            'active'     => 1,
                            'blocked'    => 2,
                            'archived'   => 3,
                        );

$config['resource_status_title']	= array(
                            1 => 'Active',
                            2 => 'Blocked',
                            3 => 'Archived',
                        );

$config['resources_per_page']	= 10;

$config['resource_url']		    = $CI->config->config['base_url'] . 'uploads/resource/'; //should contain a slash at the end
$config['resource_path']		= $CI->config->config['base_path'] . 'uploads/resource/'; //should contain a slash at the end
$config['resource_raw_path']	= $config['resource_path'] . 'raw/'; //should contain a slash at the end

$config['resource_type_path']	= array(
                            1 => $config['resource_path'] . 'image/',
                            2 => $config['resource_path'] . 'document/',
                            3 => $config['resource_path'] . 'video/',
                            4 => $config['resource_path'] . 'zip/',
                            5 => $config['resource_path'] . 'audio/',
                            6 => $config['resource_path'] . 'other/',
);

$config['resource_type_url']	= array(
                            1 => $config['resource_url'] . 'image/',
                            2 => $config['resource_url'] . 'document/',
                            3 => $config['resource_url'] . 'video/',
                            4 => $config['resource_url'] . 'zip/',
                            5 => $config['resource_url'] . 'audio/',
                            6 => $config['resource_url'] . 'other/',
                            7 => '', // youtube video
                            8 => '', // youtube video
);

//logical grouping of resources
$config['resource_allowed_type_groups_mapping'] = array(
								'jpg' 	=> 'image',
								'jpeg' 	=> 'image',
								'png' 	=> 'image',
								'pdf' 	=> 'document',
								'xls' 	=> 'document',
								'ppt' 	=> 'document',
								'doc' 	=> 'document',
								'docx' 	=> 'document',
								'xlsx' 	=> 'document',
								'word' 	=> 'document',
								'zip' 	=> 'zip',
								'tar' 	=> 'zip',
								'tgz' 	=> 'zip',
								'rar' 	=> 'zip',
								'wav' 	=> 'audio',
								'mp3' 	=> 'audio',
								'mp4' 	=> 'audio',
								'swf' 	=> 'video',
								'mpeg' 	=> 'video',
								'mpg' 	=> 'video',
								'mpe' 	=> 'video',
								'qt' 	=> 'video',
								'mov' 	=> 'video',
								'avi' 	=> 'video',
								'movie' => 'video',
								'flv' => 'video',
								);
$sAllowedTypes = implode('|', array_keys($config['resource_allowed_type_groups_mapping']));

/*
|--------------------------------------------------------------------------
| Upload Settings
|--------------------------------------------------------------------------
|
*/
$config['resource_upload_settings'] = array(

	'upload_path'		    => $config['resource_raw_path'],
    
	'allowed_types'		    =>  $sAllowedTypes,
	'types_description'	    => '', //will appear in the drop-down box for "file types" field in the "select files" window
	'file_name'			    => '',
	'overwrite'			    => false,
	'max_size'			    => 102400,
	'max_width'			    => 6000, //in pixels
	'max_height'		    => 6000, //in pixels
	'max_filename'		    => 0,
	'encrypt_name'		    => false,
	'remove_spaces'		    => true,
	'extension'			    => '',
	'create_thumbnails'     => false,
    'append_real_name'	    => false,
    'uploadify_settings'    => array(
                                     'uploadify_uploadLimit' => 1
                                ),
	'regenerate_js_files' 	=> FALSE,
	
);





//duplicates should not occur
$config['image_gallery_categories'] = array(
                                        'none'      => 0,
                                        'nature'    => 1,
                                        'wildlife'  => 2,
                                    );

$config['image_gallery_categories_title'] = array(
                                        0 => 'None',
                                        1 => 'Nature',
                                        2 => 'Wildlife',
                                    );

$config['video_gallery_categories'] = array(
                                        'none'      => 0,
                                        'nature'    => 1,
                                        'wildlife'  => 2,
                                    );
$config['video_gallery_categories_title'] = array(
                                        0 => 'None',
                                        1 => 'Nature',
                                        2 => 'Wildlife',
                                    );

                                    
                                    
                                    
                                    
                                    
                                    
$config['resource_image_thumbnail_dimensions'] = array (
      
            'stiny' 			=> array('width' => 25, 'height' => 25),
            'tiny' 			    => array('width' => 50, 'height' => 50),
            'small' 			=> array('width' => 100, 'height' => 100),
            'normal' 			=> array('width' => 200, 'height' => 200),
            'large' 			=> array('width' => 600, 'height' => 600),
            'vlarge' 			=> array('width' => 960, 'height' => 960),
            'display_image' 	=> array('width' => 261, 'height' => 194),
        );

		
		
// groups within resource-mappings for various entities
$config['resource_mapping_groups'] = array (
									'meeting' => array(
										'groups' => array(
											'agenda' 			=> 1,
											'attendance_sheets' => 2,
											'photos' 			=> 3,
											'meeting_minutes' 			=> 4,
											'other_files' 			=> 5,
										),
										'details' => array(
											1 => array(
												'title' => 'Agenda',
											),
											2 => array(
												'title' => 'Attendance Sheet(s)',
											),
											3 => array(
												'title' => 'Photos',
											),
											4 => array(
												'title' => 'Meeting Minutes',
											),
											5 => array(
												'title' => 'Other Files',
											),
										),
										
									)
								);

								
$config['resource_upload_scenarios'] = array (
										'user_created_meeting' => 1, // user is uploading to a meeting entity they created
									);
$config['resource_upload_scenario_details'] = array(
										1 => array(
												'maximum_upload_limit_per_meeting' => 10 // maximum files a user can upload to a meeting entity
											),
									);