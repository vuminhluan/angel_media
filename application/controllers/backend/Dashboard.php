<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Dashboard extends Admin_Controller
{
	
	function __construct() {
		parent::__construct();
	}

	public function index() {
		// echo $_SERVER['SCRIPT_FILENAME']; return;
		$view_data = [
			'title' => 'Bảng điều khiển',
			'view' => 'backend/pages/index',
			'tab' => 'dashboard,'
		];
		$this->load->view('backend/layout', $view_data);
	}




}