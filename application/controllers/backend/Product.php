<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Product extends Admin_Controller
{

	function __construct() {
		parent::__construct();
		$this->load->model('Product_category_model', 'ProductCategory');
		$this->load->model('Product_model', 'Product');
		$this->load->model('Product_detail_model', 'ProductDetail');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
	}

	public function index() {
		// echo $this->News->test();
		// echo "<pre>";
		$this->prt($this->Product->test());
		return;
		echo "a";return;
	}




	// ================= PRODUCT CATEGORY - DANH MỤC SẢN PHẨM ================= //

	/**
	 * Render trang tạo danh mục tin tức
	 */
	public function render_create_product_category_page() {
		$view_data = [
			'title'        => 'Thêm danh mục sản phẩm',
			'view'         => 'backend/pages/products/product_category_create',
			'alias_prefix' => $this->Product->alias_prefix,
			'tab'          => 'product,product_cate_new',
			'alias_prefix' => $this->ProductCategory->alias_prefix
		];
		$this->load->view('backend/layout', $view_data);
	}

	/**
	 * Tạo danh mục sản phẩm
	 */
	public function create_product_category() {
		$form_data = [
			'product_category_name' => $this->input->post('name'),
			'product_category_alias' => make_alias($this->input->post('name')),
			'title' => $this->input->post('title'),
			'keyword' => $this->input->post('keyword'),
			'description' => $this->input->post('description')
		];

		// Sử dụng Library Validation
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->render_create_product_category_page();
			return;
		}


		$data_to_create = $form_data;
		$data_to_create['name'] = $form_data['product_category_name'];
		$data_to_create['alias'] = $form_data['product_category_alias'];
		unset($data_to_create['product_category_name']);
		unset($data_to_create['product_category_alias']);

		// $this->prt($data_to_create); return;


		if (!$this->ProductCategory->create_product_category($data_to_create)) {
			$this->flash('Có lỗi xảy ra, không thể tạo danh mục sản phẩm mới');
			$this->render_create_product_category_page();
		} else {
			$this->flash('Tạo danh mục sản phẩm mới thành công');
			redirect(base_url('admin/product/categories'));
		}
		return;
	}

	/**
	 * Render trang danh sách danh mục sản phẩm
	 */
	public function render_product_category_list_page() {
		$view_data = [
			'title'       => 'Danh mục tin tức',
			'view'        => 'backend/pages/products/product_category_list',
			'check_table' => $this->ProductCategory->check_table(),
			'tab'         => 'product,product_cate_list'
		];
		$this->load->view('backend/layout', $view_data);
	}

	/**
	 * Product Categories Datatable JSON
	 */
	public function product_categories_datatable_json() {

		$categories = $this->ProductCategory->get_categories_for_datatable();
		$category_data = array();
		$alias_prefix = $this->ProductCategory->alias_prefix;
		foreach ($categories['data'] as $category) {
			$category_data[] = array(
				$category['id'],
				$category['name'],
				$alias_prefix.$category['alias'],
				'<div class="action-buttons td-actions text-right">
					<a href="'.base_url("admin/product/category/".$category['id']."/edit").'" class="edit-action"><i class="la la-edit edit"></i></a>
					<a data-category-name="'.$category['name'].'" data-href="'.base_url("admin/product/category/".$category['id']."/delete").'" href="#/" class="delete-action"><i class="la la-close delete"></i></a>
				</div>'
			);
		}
		$categories['data']=$category_data;
		echo json_encode($categories);
	}


	/**
	 * Xóa danh mục sản phẩm
	 */
	public function delete_product_category($category_id) {
		$category = $this->ProductCategory->first_or_fail($category_id);

		$category->status = 0;
		if (!$this->ProductCategory->delete($category->id)) {
			$this->flash('Có lỗi xảy ra, không thể xóa danh mục');
		} else {
			$this->flash('Xóa danh mục thành công');
		}
		redirect(base_url('admin/product/categories'));
	}


	/**
	 * Render trang chỉnh sửa danh mục sản phẩm
	 */
	public function render_edit_product_category_page($category_id) {
		$category = (array) $this->ProductCategory->first_or_fail($category_id);
		$view_data = [
			'title' => 'Chỉnh sửa danh mục tin tức',
			'view' => 'backend/pages/products/product_category_edit',
			'category' => $category,
			'tab' => 'news,'
		];
		$this->load->view('backend/layout', $view_data);
	}

	/**
	 * Cập nhật danh mục sản phẩm
	 */
	public function update_product_category() {
		$form_data = [
			'product_category_name' => $this->input->post('name'),
			'product_category_alias' => make_alias($this->input->post('name')),
			'title' => $this->input->post('title'),
			'keyword' => $this->input->post('keyword'),
			'description' => $this->input->post('description')
		];

		// Sử dụng Library Validation
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->render_edit_product_category_page($this->input->post('id'));
			return;
		}

		$data_to_update = $form_data;
		unset($data_to_update['product_category_name']);
		unset($data_to_update['product_category_alias']);
		$data_to_update['name'] = $this->input->post('name');
		$data_to_update['alias'] = make_alias($this->input->post('name'));

		if (!$this->ProductCategory->update_category($data_to_update, $this->input->post('id'))) {
			$this->flash('Có lỗi xảy ra. Không thể cập nhật danh mục sản phẩm');
			$this->render_edit_product_category_page($this->input->post('id'));
		} else {
			$this->flash('Cập nhật danh mục sản phẩm thành công');
			redirect(base_url('admin/product/categories'));
		}
	}

	// ================= END PRODUCT CATEGORY - DANH MỤC TIN TỨC ================= //


	// ================= QUẢN LÝ SẢN PHẨM ================= //

	/**
	 * Render trang danh sách tin tức
	 */
	public function render_product_list_page() {
		$view_data = [
			'title' => 'Danh sách sản phẩm',
			// 'css_file' => 'backend/includes/css_file/datatable_css.php',
			// 'js_file' => 'backend/includes/js_file/datatable_js.php',
			'view' => 'backend/pages/products/product_list',
			'tab' => 'product,product_list'
		];
		// $news = $this->News->
		$this->load->view('backend/layout', $view_data);
	}

	/**
	 *
	 */
	public function product_datatable_json() {

		$products = $this->Product->get_products_for_datatable();
		$product_data = array();
		$alias_prefix = $this->Product->alias_prefix;
		foreach ($products['data'] as $product) {
			$total_version = $product['total_version'];
			$version = $total_version > 0 ? "<a href='".base_url('admin/product/'.$product['product_id'].'/versions/0')."'>Có ".$total_version." phiên bản </a>" : 'Có 0 phiên bản';
			$product_data[] = array(
				// $product['product_id'],
				$product['cate_name'],
				$product['product_name'],
				$alias_prefix.$product['product_alias'].'-'.$product['product_id'],
				'<img width="100px" class="product-image" src="'.$product['product_image'].'" />',

				// "<a href='".base_url('admin/product/'.$product['product_id'].'/versions/0')."'>Có ".$total_version." phiên bản </a>",
				$version,

				'<div class="action-buttons td-actions text-right">
					<a href="'.base_url("admin/product/".$product['product_id']."/edit").'" class="edit-action"><i class="la la-edit edit"></i></a>
					<a data-product-name="'.$product['product_name'].'" data-href="'.base_url("admin/product/".$product['product_id']."/delete").'" href="#/" class="delete-action"><i class="la la-close delete"></i></a>
				</div>'
			);
		}
		$products['data'] = $product_data;
		echo json_encode($products);
	}

	/**
	 * Render trang thêm tin tức mới
	 */
	public function render_create_product_page() {
		// Xóa session cart dùng để tạo versions cho sản phẩm (màu sắc, kích thước,...)
		$this->load->library('cart');
		$this->cart->destroy();

		$categories = $this->ProductCategory->all();
		$view_data = [
			'title'        => 'Thêm sản phẩm mới',
			'categories'   => $categories,
			'view'         => 'backend/pages/products/product_create',
			'tab'          => 'product,product_create',
			'alias_prefix' => $this->Product->alias_prefix,
		];
		$this->load->view('backend/layout', $view_data);
	}

	/**
	 * Thêm tin tức mới
	 */
	public function create_product() {
		$form_data = [
			'product_name'      => $this->input->post('name'),
			'product_alias'     => make_alias($this->input->post('name')),
			'product_caption'   => $this->input->post('caption'),
			'product_thumbnail' => $this->input->post('thumbnail'),
			'product_content'   => $this->input->post('content', FALSE),
			'title'             => $this->input->post('title'),
			'price'             => $this->input->post('price'),
			'original_price'    => $this->input->post('original_price'),
			'keyword'           => $this->input->post('keyword'),
			'description'       => $this->input->post('description'),
		];
		// echo "aasdasd"; return;

		// Sử dụng Library Validation
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->render_create_product_page();
			return;
		}

		// echo "OK"; return;

		$data_to_insert = [
			'category_id'    => $this->input->post('select_product_category'),
			// 'creater'     => $this->session->userdata('id'),
			'name'           => $this->input->post('name'),
			'alias'          => make_alias($this->input->post('name')),
			'image'          => $this->input->post('thumbnail'),
			'content'        => $this->input->post('content', FALSE),
			'caption'        => $this->input->post('caption'),
			'created_at'     => date('Y-m-d H:i:s'),
			'status'         => $this->input->post('status'),
			'price'          => $this->input->post('price'),
			'original_price' => $this->input->post('original_price') ? $this->input->post('original_price') : 0,
			'title'          => $this->input->post('title') ? $this->input->post('title') : $this->input->post('name'),
			'keyword'        => $this->input->post('keyword'),
			'description'    => $this->input->post('description'),
		];

		// $this->load->library('cart');
		// $cart = $this->cart->contents();
		// $this->prt($cart);
		// return;

		if (!$last_insert_id = $this->Product->create_product($data_to_insert)) {
			$this->flash('Thêm sản phẩm thất bại');
			$this->render_create_product_page();
			return;
		} else {
			// echo $last_insert_id;

			$this->load->library('cart');
			// Nếu có tạo các phiên bản cho sản phẩm
			if ($this->cart->total_items() > 0) {
				$versions = [];
				foreach ($this->cart->contents() as $items) {
					$versions[] = [
						'product_id' => $last_insert_id,
						// 'options' => json_encode($items['options'], JSON_UNESCAPED_UNICODE),
						'size'           => $items['options']['Size'] ? $items['options']['Size']   : NULL,
						'color'          => $items['options']['Color'] ? $items['options']['Color'] : NULL,
						'original_price' => $this->input->post('original_price') ? $this->input->post('original_price') : 0,
						'price'          => $this->input->post('price') ? $this->input->post('price') : 0,
					];
				}
				// $this->prt($versions);
				// return;
				$this->ProductDetail->insert_product_versions($versions);
			}

			$this->flash('Thêm sản phẩm thành công');
			redirect(base_url('admin/products'));
			return;
		}
	}

	/**
	 * Xóa sản phẩm
	 * @param  int $product_id - Mã sản phẩm
	 */
	public function delete_product($product_id)
	{
		// echo "Xóa sản phẩm à ??"; return;
		// 1. Tìm và xóa những phiên bản của nó
		// 2. Xóa sản phẩm

		// Xóa phiên bản
		$flag = TRUE;
		if (!$this->ProductDetail->detele_all_version_of_product($product_id)) {
			$flag = FALSE;
		}

		// Xóa sản phẩm
		if ($flag) {
			if (!$this->Product->delete_product($product_id)) {
				$flag = FALSE;
			}
		}

		if ($flag) {
			$this->flash('Xóa sản phẩm thành công');
		} else {
			$this->flash('Có lỗi xảy ra, không thể xóa sản phẩm bây giờ');
		}
		redirect(base_url('admin/products'));
		return;
	}

	public function render_edit_product_page($product_id)
	{
		// Xóa session cart dùng để tạo versions cho sản phẩm (màu sắc, kích thước,...)
		// $this->load->library('cart');
		// $this->cart->destroy();

		$categories = $this->ProductCategory->all();
		$product = (array) $this->Product->first_or_fail($product_id);
		$versions = $this->ProductDetail->get_versions_by_product($product_id);

		$view_data = [
			'title' => 'Thêm sản phẩm mới',
			'categories' => $categories,
			'product' => $product,
			'versions' => $versions,
			'view' => 'backend/pages/products/product_edit',
			'tab' => 'product,'
		];
		$this->load->view('backend/layout', $view_data);
	}

	/**
	 * Cập nhật sản phẩm
	 */
	public function update_product()
	{
		// echo "update product"; return;
		$product_id = $this->input->post('product_id');
		$product = (array) $this->Product->first_or_fail($product_id);

		$form_data = [
			'product_alias'     => make_alias($this->input->post('name')),
			'product_caption'   => $this->input->post('caption'),
			'product_thumbnail' => $this->input->post('thumbnail'),
			'product_content'   => $this->input->post('content', FALSE),
			'title'             => $this->input->post('title'),
			'price'             => $this->input->post('price'),
			'original_price'    => $this->input->post('original_price'),
			'keyword'           => $this->input->post('keyword'),
			'description'       => $this->input->post('description'),
		];

		if ($product['name'] != $this->input->post('name')) {
			$form_data['product_name'] = $this->input->post('name');
		}


		// Sử dụng Library Validation
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->render_edit_product_page($product_id);
			return;
		}

		// echo "wait"; return;
		// $this->prt($form_data);
		// return;

		$data_to_update = [
			'category_id'    => $this->input->post('select_product_category'),
			// 'creater'     => $this->session->userdata('id'),
			'name'           => $this->input->post('name'),
			'alias'          => make_alias($this->input->post('name')),
			'image'          => $this->input->post('thumbnail'),
			'content'        => $this->input->post('content', FALSE),
			'caption'        => $this->input->post('caption'),
			'created_at'     => date('Y-m-d H:i:s'),
			'status'         => $this->input->post('status'),
			'price'          => $this->input->post('price'),
			'original_price' => $this->input->post('original_price') ? $this->input->post('original_price') : 0,
			'title'          => $this->input->post('title') ? $this->input->post('title') : $this->input->post('name'),
			'keyword'        => $this->input->post('keyword'),
			'description'    => $this->input->post('description'),
		];

		// $this->Product->update_product($data_to_update, $product_id);
		// $this->flash('update thành công');
		// $this->render_edit_product_page($product_id);
		// return;

		// $this->prt($data_to_insert);
		// return;

		if (!$this->Product->update_product($data_to_update, $product_id)) {
			$this->flash('Thêm sản phẩm thất bại');
			$this->render_edit_product_page($product_id);
			return;
		} else {
			// echo $last_insert_id;

			$this->load->library('cart');
			// Nếu có tạo các phiên bản cho sản phẩm
			if ($this->cart->total_items() > 0) {
				$versions = [];
				foreach ($this->cart->contents() as $items) {
					$versions[] = [
						'product_id' => $product_id,
						'size'           => $items['options']['Size'] ? $items['options']['Size']   : NULL,
						'color'          => $items['options']['Color'] ? $items['options']['Color'] : NULL,
						'original_price' => $this->input->post('original_price') ? $this->input->post('original_price') : 0,
						'price'          => $this->input->post('price') ? $this->input->post('price') : 0,
					];
				}
				// $this->prt($versions);
				// return;
				$this->ProductDetail->insert_product_versions($versions);
			}

			$this->flash('Thêm sản phẩm thành công');
			redirect(base_url('admin/products'));
			return;
		}
	}





	/**
	 * Redner trang Xem và chỉnh sửa phiên bản sản phẩm
	 * @param  int  $product_id  - mã sản phẩm
	 * @param  integer $version_index - Vị trí hiện tại của phiên bản trong danh sách phiên bản của 1 sản phẩm
	 * @return VIEW
	 */
	public function render_edit_version_page($product_id, $version_index = 0)
	{
		// echo $version_id; return;
		// echo "edit versions"; return;
		$product = (array) $this->Product->first_or_fail($product_id);
		$versions = $this->ProductDetail->get_versions_by_product($product['id']);
		if (!$versions) {
			echo "Sản phẩm này không có phiên bản nào !"; return;
		}
		if ($version_index >= count($versions)) {
			$version_index = 0;
		}
		$view_data = [
			'title'    => 'Chỉnh sửa phiên bản',
			'product'  => $product,
			'versions' => $versions,
			'index'    => $version_index,
			'view'     => 'backend/pages/products/product_versions',
			'tab'      => 'product,'
		];
		$this->load->view('backend/layout', $view_data);
	}

	public function update_version()
	{
		$product_id = $this->input->post('product_id');
		$version_id = $this->input->post('version_id');
		$index      = $this->input->post('version_index');
		$form_data = [
			'original_price' => $this->input->post('original_price') ? $this->input->post('original_price') : 0,
			'price'          => $this->input->post('price'),
			'size'           => $this->input->post('size'),
			'color'          => $this->input->post('color')
		];

		// Sử dụng Library Validation
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->render_edit_version_page($product_id, $index);
			return;
		}

		if (!$this->ProductDetail->update_version($form_data, $version_id)) {
			$this->flash('Có lỗi xảy ra, cập nhật phiên bản thất bại');
		} else {
			$this->flash('Cập nhật phiên bản thành công');
		}
		$this->render_edit_version_page($product_id, $index);
		return;
	}

	/**
	 * Xóa 1 phiên bản
	 * @param  int $product_id
	 * @param  int $version_id
	 */
	public function delete_version($product_id, $version_id)
	{
		if (!$this->ProductDetail->delete_version($product_id, $version_id)) {
			$this->flash('Có lỗi xảy ra, không thể xóa phiên bản đã chọn');
		} else {
			$this->flash('Đã xóa phiên bản được chọn');
		}
		redirect(base_url('admin/product/'.$product_id.'/versions/0'));
	}

	/**
	 * Xóa tất cả phiên bản của một sản phẩm
	 * @param  int $product_id  - Mã sản phẩm
	 */
	public function delete_all_versions_by_product($product_id)
	{
		// code...
	}

	/**
	 * Thêm một phiên bản (POST)
	 */
	public function create_version()
	{
		$product_id = $this->input->post('product_id');
		$form_data = [
			'product_id'     => $product_id,
			'size'           => $this->input->post('size'),
			'color'          => $this->input->post('color'),
			'original_price' => $this->input->post('original_price') ? $this->input->post('original_price') : 0,
			'price'          => $this->input->post('price'),
		];
		// $this->prt($form_data);return;


		// echo $product_id;return;
		// Sử dụng Library Validation
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->flash(validation_errors());
			redirect('admin/product/'.$product_id.'/versions/0');
		}

		if (!$this->ProductDetail->create_version($form_data)) {
			$this->flash('Có lỗi xảy ra, không thể thêm phiên bản mới ngay lúc này');
		} else {
			$this->flash('Thêm phiên bản mới thành công');
		}
		redirect('admin/product/'.$product_id.'/versions/0');

	}



	// ================= END NEWS - TIN TỨC ================= //





}
