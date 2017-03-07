<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$CI = & get_instance();

$config['upload_scenarios'] = array(
  'resource' => array(
    'entity_name' => 'resource', // used for accessing the configurations
                                // related to this entity. this is the "section name" in file upload functions
    'multi_upload' => FALSE,

  ),
);


$config['upload_queue_url']		    = $CI->config->config['base_url'] . 'uploads/upload_queue/'; //should contain a slash at the end
$config['upload_queue_path']		= $CI->config->config['base_path'] . 'uploads/upload_queue/'; //should contain a slash at the end
//$config['upload_queue_raw_path']	= $config['resource_path'] . 'raw/'; //should contain a slash at the end


//logical grouping of resources
$config['upload_queue_allowed_types'] = array(
								'jpg' ,
								'jpeg',
								'png' ,
								'pdf' ,
								'xls' ,
								'ppt' ,
								'doc' ,
								'docx',
								'xlsx',
								'word',
								'zip' ,
								'tar' ,
								'tgz' ,
								'rar' ,
								'wav' ,
								'mp3' ,
								'mp4' ,
								'swf' ,
								'mpeg',
								'mpg',
								'mpe',
								'qt' ,
								'mov',
								'avi',
								'movie',
								'flv' ,
								);
$sAllowedTypes = implode('|', $config['upload_queue_allowed_types']);

/*
|--------------------------------------------------------------------------
| Upload Settings
|--------------------------------------------------------------------------
|
*/
$config['upload_queue_upload_settings'] = array(

	'upload_path'		    => $config['upload_queue_path'],

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
	'regenerate_js_files' 	=> FALSE,

);
