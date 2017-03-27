<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Program Settings
|--------------------------------------------------------------------------
|
|
*/
$CI = & get_instance();

$config['program_status']	= array(
                            'active'     => 1,
                            'blocked'    => 2,
                            'inactive'   => 3,
                        );
$config['program_status_title']	= array(
                            1 => 'Active',
                            2 => 'Blocked',
                            3 => 'Inactive'
                        );

                        /*
$config['program_objective_status']	= array(
                            'active'     => 1,
                            'blocked'    => 2,
                            'inactive'   => 3,
                        );
$config['program_objective_status_title']	= array(
                            1 => 'Active',
                            2 => 'Blocked',
                            3 => 'Inactive'
                        );
*/
                        
$config['programs_per_page']	= 10;