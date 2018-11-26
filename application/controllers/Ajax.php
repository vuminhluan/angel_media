<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Ajax extends MY_Controller
{
	
	function __construct() {
		parent::__construct();
	}

	/**
	 * Tạo alias
	 */
	public function create_alias() {
		$unicode = $this->input->get('unicode');
		echo make_alias($unicode);
	}




}