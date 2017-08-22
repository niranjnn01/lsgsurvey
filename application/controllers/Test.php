<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {


	function __construct() {

		parent::__construct();

	}

  function index() {


		$this->mcontents['load_js'][] = 'validation/test.js';

    loadTemplate('test/index');
  }


	function assign_uname() {

		$this->db->select('uid,field_name');
		foreach($this->db->get('questions')->result() AS $oRow) {

			$this->db->where('uid', $oRow->uid);
			$this->db->set('uname', strtolower($oRow->field_name));
			$this->db->update('questions');
		}
	}

	function identify_uname () {

		foreach($this->db->get('questions')->result() AS $oRow) {
			echo '\'', $oRow->uname, '\', ';
		}

	}

}
