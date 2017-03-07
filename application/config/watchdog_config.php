<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');




// we have the following scenarious for which we could flag a user account
$config['wd_user_flag_scenarios'] = array(
						/**
						 *
						 * a user is changing their wards multiple times unecessarily
						 * a user is adding and deleting wards many times hence generating spurious data in the system
						 * also, the user might be creating spam content for multiple wards
						 * we try to detect this scenario
						 */
						'multipe_ward_skippings' => 1, 
					);
$config['wd_user_flag_limits'] = array(
				'total_ward_changes' => 10,
			);
$config['wd_user_flag_status'] = array(
				'active' 	=> 1,
				'removed' 	=> 2,
			);
			