<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {


	function __construct() {

		parent::__construct();

	}

  function index() {

    
		$this->mcontents['load_js'][] = 'validation/test.js';

    loadTemplate('test/index');
  }
}