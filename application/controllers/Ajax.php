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

	public function get_menu_children_by_parent_id($parent_id)
	{
		$this->load->model('menu_model', 'Menu');
		$menu_children = $this->Menu->get_children($parent_id);
		$this->load->view('backend/components/menu_order', ['menu_children' => $menu_children]);
	}



}
