<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Different scenarios for one to many mappings in the websuite
|--------------------------------------------------------------------------
|
|
*/


$config['one_to_many_scenarios'] = array (

    'user_ward' => array (

            'mapping_table_name' => 'user_ward_mapping',

            'one' => array(
                'field_name' => 'user_account_no',
            ),

            'many' => array(
                'field_name' => 'ward_id',
            ),
    ),

    'meeting_resource' => array (

            'mapping_table_name' => 'meeting_resource_map',

            'one' => array(
                'field_name' => 'meeting_id',
            ),

            'many' => array(
                'field_name' => 'resource_uid',
            ),
    ),


    'user_address' => array (

            'mapping_table_name' => 'user_address_map',

            'one' => array(
                'field_name' => 'account_no',
            ),

            'many' => array(
                'field_name' => 'address_uid',
            ),
    ),



);
