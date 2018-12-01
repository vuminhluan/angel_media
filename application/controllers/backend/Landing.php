<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*
*/
class Landing extends Admin_Controller
{

	function __construct() {
		parent::__construct();
		$this->load->model('Landing_model', 'Landing');
	}

	/**
	* Render trang danh sách các trang nội đung
	* @return ---
	*/
	public function render_landing_list_page()
	{
		echo "landing"; return;
		$view_data = [
			'title'     => 'Danh sách Slideshow',
			'view'      => 'backend/pages/slide/slide_list',
			'tab'       => 'landing,landing_list',
		];

		$this->load->view('backend/layout', $view_data);
	}

	/**
	* Render trang tạo slideshow
	* @return [type] [description]
	*/
	public function render_create_landing_page()
	{
		$view_data = [
			'title'     => 'Thêm mới một Trang nội dung',
			'view'      => 'backend/pages/landing/landing_create',
			'tab'       => 'landing,landing_create',
		];

		$this->load->view('backend/layout', $view_data);
	}

	/**
	* Tạo slideshow
	* @return [type] [description]
	*/
	public function create_landing()
	{
		// $post = $this->input->post();
		// $this->prt($post); return;


		$form_data = [
			'landing_name' => $this->input->post('name'),
			'landing_content' => $this->input->post('content'),
			'landing_caption' => $this->input->post('caption')
		];

		// Sử dụng Library Validation
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->render_create_landing_page();
			return;
		}


		$data_to_create = [
			'name' => $this->input->post('name'),
			'alias' => make_alias($this->input->post('name')),
			'caption' => $this->input->post('caption'),
			'thumbnail' => $this->input->post('thumbnail'),
			'content' => $this->input->post('content', FALSE),
			'status' => $this->input->post('status'),
			'title' => $this->input->post('title') ? $this->input->post('title') :  $this->input->post('name'),
			'keyword' => $this->input->post('status'),
			'description' => $this->input->post('status'),
		];


		// $this->prt($data_to_create); return;


		if (!$this->Landing->create_landing($data_to_create)) {
			$this->flash('Có lỗi xảy ra, không thể tạo Trang nội dung mới bây giờ');
			$this->render_create_landing_page();
		} else {
			$this->flash('Tạo Trang nội dung mới thành công');
			redirect(base_url('admin/landing'));
		}
		return;
	}

	/**
	* Render trang chỉnh sửa - cập nhật slideshow
	* @return [type] [description]
	*/
	public function render_edit_landing_page()
	{
		$view_data = [
			'title'     => 'Danh sách Slideshow',
			'view'      => 'backend/pages/slide/slide_list',
			'tab'       => 'slide,slide_list',
		];

		$this->load->view('backend/layout', $view_data);
	}

	/**
	* Cập nhật slideshow
	* @return [type] [description]
	*/
	public function update_landing()
	{
		echo "cập nhật slideshow"; return;
	}




}
