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
		$this->load->library('datatable'); // loaded my custom serverside datatable library
	}

	public function index() {
		// echo $this->News->test();
		// echo "<pre>";
		// $this->prt($this->News->test());
		// return;
		echo "a";return;
	}




	// ================= PRODUCT CATEGORY - DANH MỤC SẢN PHẨM ================= //

	/**
	 * Render trang tạo danh mục tin tức
	 */
	public function render_create_product_category_page() {
		$view_data = [
			'title' => 'Thêm danh mục sản phẩm',
			'view' => 'backend/pages/products/product_category_create',
			'tab' => 'product,product_cate_new'
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
		$alias_prefix = "san-pham/danh-muc/";
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
	public function render_news_list_page() {
		$view_data = [
			'title' => 'Danh sách tin tức',
			// 'css_file' => 'backend/includes/css_file/datatable_css.php',
			// 'js_file' => 'backend/includes/js_file/datatable_js.php',
			'view' => 'backend/pages/news/news_list',
			'tab' => 'news,news_list'
		];
		// $news = $this->News->
		$this->load->view('backend/layout', $view_data);
	}

	/**
	 *
	 */
	public function news_datatable_json() {

		$news = $this->News->get_all_news();
		$news_data = array();
		$alias_prefix = "tin-tuc/";
		foreach ($news['data'] as $news_piece) {
			$news_data[] = array(
				$news_piece['news_id'],
				$news_piece['news_name'],
				$alias_prefix.$news_piece['news_alias'],
				$news_piece['category_name'],
				$news_piece['news_created_at'],
				'<div class="action-buttons td-actions text-right">
					<a href="'.base_url("admin/news/".$news_piece['news_id']."/edit").'" class="edit-action"><i class="la la-edit edit"></i></a>
					<a data-news_piece-name="'.$news_piece['news_name'].'" data-href="'.base_url("admin/news/".$news_piece['news_id']."/delete").'" href="#/" class="delete-action"><i class="la la-close delete"></i></a>
				</div>'
			);
		}
		$news['data'] = $news_data;
		echo json_encode($news);
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
			'title' => 'Thêm sản phẩm mới',
			'categories' => $categories,
			'view' => 'backend/pages/products/product_create',
			'tab' => 'product,product_create'
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
			'keyword'           => $this->input->post('keyword'),
			'description'       => $this->input->post('description'),
		];
		// echo "aasdasd"; return;

		// Sử dụng Library Validation
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->render_create_product_page();
			return;
		}

		echo "OK"; return;

		// $data_to_insert = [
		// 	'category_id' => $this->input->post('select_news_category'),
		// 	'author' => $this->session->userdata('id'),
		// 	'name' => $this->input->post('name'),
		// 	'alias' => make_alias($this->input->post('name')),
		// 	'thumbnail' => $this->input->post('thumbnail'),
		// 	'content' => $this->input->post('content', FALSE),
		// 	'caption' => $this->input->post('caption'),
		// 	'created_at' => date('Y-m-d H:i:s'),
		// 	'status' => $this->input->post('status'),
		// 	'title' => $this->input->post('title') ? $this->input->post('title') : $this->input->post('name'),
		// 	'keyword' => $this->input->post('keyword'),
		// 	'description' => $this->input->post('description'),
		// ];
		//
		// if (!$this->News->insert($data_to_insert)) {
		// 	$this->flash('Thêm tin tức thành công');
		// 	$this->render_create_news_page();
		// 	return;
		// } else {
		// 	$this->flash('Thêm tin tức thành công');
		// 	redirect(base_url('admin/news'));
		// 	return;
		// }
	}

	/**
	* Render trang chỉnh sửa tin tức
	*
	*/
	public function render_edit_news_page($news_id) {
		$news = (array) $this->News->first_or_fail($news_id);
		$categories = $this->NewsCategory->all();
		$view_data = [
			'title' => 'Chỉnh sửa tin tức',
			'view' => 'backend/pages/news/news_edit',
			'categories' => $categories,
			'news' => $news,
			'tab' => 'news,'
		];
		$this->load->view('backend/layout', $view_data);
	}

	/*
	*
	* Cập nhật tin tức
	*
	*/

	public function update_news() {
		$news_id = $this->input->post('id') ? $this->input->post('id') : -1;
		$form_data = [
			// 'news_name' => $this->input->post('name'),
			'news_alias' => make_alias($this->input->post('name')),
			'news_thumbnail' => $this->input->post('thumbnail'),
			'news_content' => $this->input->post('content', FALSE),
		];

		$present_news = (array) $this->News->first_or_fail($news_id);
		if ($present_news['name'] != $this->input->post('name')) {
			$form_data['news_name'] = $this->input->post('name');
		}
		// $this->prt($form_data); return;

		// Sử dụng Library Validation
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->render_edit_news_page($news_id);
			return;
		}

		$data_to_update = [
			'category_id' => $this->input->post('select_news_category'),
			'author' => $this->session->userdata('id'),
			'name' => $this->input->post('name'),
			'alias' => make_alias($this->input->post('name')),
			'thumbnail' => $this->input->post('thumbnail'),
			'content' => $this->input->post('content', FALSE),
			'caption' => $this->input->post('caption'),
			'status' => $this->input->post('status'),
			'title' => $this->input->post('title') ? $this->input->post('title') : $this->input->post('name'),
			'keyword' => $this->input->post('keyword'),
			'description' => $this->input->post('description'),
		];
		// $this->prt($data_to_update); return;

		if (!$this->News->update_news($data_to_update, $news_id)) {
			$this->flash('Có lỗi xảy ra, không thể cập nhật tin tức ngay bây giờ');
			redirect(base_url('admin/news/'.$news_id.'/edit'));
			return;
		} else {
			$this->flash('Cập nhật tin tức thành công');
			redirect(base_url('admin/news'));
			return;
		}
	}

	/*
	*
	* Xóa tin tức tin tức
	*
	*/
	public function delete_news($news_id) {
		$news = $this->News->first_or_fail($news_id);
		if (!$this->News->delete_news($news_id)) {
			$this->flash('Có lỗi xảy ra, không thể xóa tin tức này');
		} else {
			$this->flash('Xóa tin tức thành công');
		}
		redirect(base_url('admin/news'));
	}



	// ================= END NEWS - TIN TỨC ================= //





}
