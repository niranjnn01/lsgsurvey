<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$config['survey_status'] = array(
  'in_progress' 						=> 1, // new temporary survey item created in temporary table
  'processed_last_question' => 2, // processed the last question of survey form. and saved all data to temporary table
  'survey_completed' 				=> 3, // created all data in the database. survey entity created.
);

$config['normalized_general_array'] = array(
  'name' => null,
  'address' => null,
  'aadhaar_number' => null,
  'election_id' => null,
);

$config['normalized_house_land_array'] = array(
  'house_number' => null,
  'house_ownership_type' => null,
  'land_ownership_type' => null,
  'house_area_range' => null,
  'land_area_range' => null,
  'house_type' => null,
);


$config['reservation_categories'] = array(
  'scst' => 1,
  'obc' => 2,
);
$config['reservation_categories_title'] = array(
  1 => 'പട്ടികജാതി/വർഗം',
  2 => 'പിന്നോക്ക സമുദായം',
);
