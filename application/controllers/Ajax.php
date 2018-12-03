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

	public function get_menu_children_by_parent_id($parent_id, $exception_id)
	{
		$this->load->model('menu_model', 'Menu');
		$menu_children = $this->Menu->get_children($parent_id, ['id !=' => $exception_id]);
		$this->load->view('backend/components/menu_order', ['menu_children' => $menu_children]);
	}

	/**
	 * Tạo phiên bản khi thêm sản phẩm (màu sắc, kích thước)
	 */
	public function create_products_version() {
		$this->load->library('cart');
		$this->cart->destroy();

		$product_name = $this->input->get('product_name');
		// echo $product_name; return;
		$color_str_list = $this->input->get('color_str_list');
		$size_str_list = $this->input->get('size_str_list');
		$colors_array = explode(',', $color_str_list);
		$sizes_array = explode(',', $size_str_list);
		$versions = [];
		$i = 1;

		foreach ($sizes_array as $index => $size) {
			foreach ($colors_array as $index => $color) {
				$versions[] = [
					'id' => 'version'.$i++,
					'qty' => '1',
					'price' => 0,
					'name' => $product_name,
					'options' => array('Size' => $size, 'Color' => $color)
				];
			}
		}
		// $this->prt($versions);

		// CART

		$this->cart->insert($versions);
		$this->load->view('backend/components/product-versions-table');
	}

	// Xóa 1 phiên bản khi thêm sản phẩm
	public function remove_product_version()
	{
		$rowid = $this->input->get('rowid');
		$this->load->library('cart');
		$this->cart->remove($rowid);
		if ($this->cart->total_items() > 0) {
			$this->load->view('backend/components/product-versions-table');
		} else {
			echo " ";
		}
	}



}
