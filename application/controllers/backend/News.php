<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class News extends Admin_Controller
{
	
	function __construct() {
		parent::__construct();
		$this->load->model('News_category_model', 'NewsCategory');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
	}

	public function index() {
		// echo ellipsize('Loremipsumdolorsitamet.', 7, .5); return;
		echo $this->User->get_all_users();
	}




	// ================= NEWS CATEGORY - DANH MỤC TIN TỨC ================= //

	/**
	 * Render trang tạo danh mục tin tức
	 */
	public function render_create_news_category_page() {
		$view_data = [
			'title' => 'Tạo danh mục tin tức mới',
			// 'css_file' => 'backend/includes/css_file/datatable_css.php',
			// 'js_file' => 'backend/includes/js_file/datatable_js.php',
			'view' => 'backend/pages/news/news_category_create',
			'tab' => 'news,category_create'
		];
		$this->load->view('backend/layout', $view_data);
	}

	/**
	 * Tạo danh mục tin tức
	 */
	public function create_news_category() {
		$form_data = [
			'news_category_name' => $this->input->post('name'),
			'news_category_alias_create' => make_alias($this->input->post('name')),
			'title' => $this->input->post('title'),
			'keyword' => $this->input->post('keyword'),
			'description' => $this->input->post('description')
		];

		// Sử dụng Library Validation
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->render_create_news_category_page();
			return;
		}

		$data_to_create = $form_data;
		unset($data_to_create['news_category_name']);
		unset($data_to_create['news_category_alias_create']);
		$data_to_create['name'] = $form_data['news_category_name'];
		$data_to_create['alias'] = $form_data['news_category_alias_create'];

		// $this->prt($data_to_create); return;


		if (!$this->NewsCategory->create_news_category($data_to_create)) {
			$this->flash('Có lỗi xảy ra, không thể tạo danh mục tin tức mới');
			$this->render_create_news_category_page();
		} else {
			$this->flash('Tạo danh mục tin tức mới thành công');
			redirect(base_url('admin/news/categories'));
		}
		return;
	}

	/**
	 * Render trang danh sách danh mục tin tức
	 */
	public function render_news_category_list_page() {
		$view_data = [
			'title' => 'Danh mục tin tức',
			'view' => 'backend/pages/news/news_category_list',
			'tab' => 'news,category_list'
		];
		$this->load->view('backend/layout', $view_data);
	}

	/**
	 * News Categories Datatable JSON
	 */
	public function news_categories_datatable_json() {
		
		$categories = $this->NewsCategory->get_all_news_categories();
		$category_data = array();
		foreach ($categories['data'] as $category) {
			$category_data[] = array(
				$category['id'],
				$category['name'],
				'/tin-tuc/danh-muc/'.$category['alias'],
				'<div class="action-buttons td-actions text-right">
					<a href="'.base_url("admin/news/category/".$category['id']."/edit").'" class="edit-action"><i class="la la-edit edit"></i></a>
					<a data-category-name="'.$category['name'].'" data-href="'.base_url("admin/news/category/".$category['id']."/delete").'" href="#/" class="delete-action"><i class="la la-close delete"></i></a>
				</div>'
			);
		}
		$categories['data']=$category_data;
		echo json_encode($categories);						   
	}


	/**
	 * Xóa danh mục tin tức
	 */
	public function delete_news_category($category_id) {
		$category = $this->NewsCategory->first_or_fail($category_id);

		$category->status = 0;
		if (!$this->NewsCategory->update($category)) {
			$this->flash('Có lỗi xảy ra, không thể xóa danh mục');
		} else {
			$this->flash('Xóa danh mục tin tức thành công');
		}
		redirect(base_url('admin/news/categories'));
	}


	/**
	 * Render trang chỉnh sửa danh mục tin tức
	 */
	public function render_edit_news_category_page($category_id) {
		$category = (array) $this->NewsCategory->first_or_fail($category_id);
		$view_data = [
			'title' => 'Chỉnh sửa danh mục tin tức',
			'view' => 'backend/pages/news/news_category_edit',
			'category' => $category,
			'tab' => 'news,'
		];
		$this->load->view('backend/layout', $view_data);
	}

	/**
	 * Cập nhật danh mục tin tức
	 */
	public function update_news_category() {
		$form_data = [
			'news_category_name' => $this->input->post('name'),
			// 'news_category_alias' => make_alias($this->input->post('name')),
			'title' => $this->input->post('title'),
			'keyword' => $this->input->post('keyword'),
			'description' => $this->input->post('description')
		];

		$new_alias = make_alias($this->input->post('name'));

		// Lấy ra thằng hiện tại
		$category = $this->NewsCategory->first_or_fail($this->input->post('id'));
		// So sanh xem alias hiện tại và alias mới có giống nhau không.
		// Nếu giống nghĩa là không có sự thay đổi alias => không cần validate alias
		// Nếu khác nhau => thay đổi => validate
		if ($category->alias != $new_alias) {
			$form_data['news_category_alias_create'] = make_alias($this->input->post('name'));
		}

		// Sử dụng Library Validation
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->render_edit_news_category_page($this->input->post('id'));
			return;
		}

		// echo "Sua thanh cong"; return;

		$data_to_update = $form_data;
		unset($data_to_update['news_category_name']);
		unset($data_to_update['news_category_alias_create']);
		$data_to_update['name'] = $this->input->post('name');
		$data_to_update['alias'] = $new_alias;

		if (!$this->NewsCategory->update($data_to_update, ['id' => $this->input->post('id')])) {
			$this->flash('Có lỗi xảy ra. Không thể cập nhật danh mục tin tức');
			$this->render_edit_news_category_page($this->input->post('id'));
			return;
		} else {
			$this->flash('Cập nhật danh mục tin tức thành công');
			redirect(base_url('admin/news/categories'));
		}
	}

	// ================= END NEWS CATEGORY - DANH MỤC TIN TỨC ================= //

	// ================= NEWS - TIN TỨC ================= //

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
		$this->load->view('backend/layout', $view_data);
	}

	/**
	 * Render trang thêm tin tức mới
	 */
	public function render_create_news_page() {
		$categories = $this->NewsCategory->all();
		$view_data = [
			'title' => 'Thêm mới tin tức',
			'categories' => $categories,
			// 'css_file' => 'backend/includes/css_file/datatable_css.php',
			// 'js_file' => 'backend/includes/js_file/datatable_js.php',
			'view' => 'backend/pages/news/news_create',
			'tab' => 'news,news_create'
		];
		$this->load->view('backend/layout', $view_data);
	}

	/**
	 * Thêm tin tức mới
	 */
	public function create_news() {
		echo "create new news";
	}

	// ================= END NEWS - TIN TỨC ================= //





}