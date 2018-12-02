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
		$this->load->library('datatable'); // loaded my custom serverside datatable library
	}

	public function index()
	{
		$landings = $this->Landing->get_all_landings();
		$this->prt($landings); return;
	}

	/**
	* Render trang danh sách các trang nội đung
	* @return ---
	*/
	public function render_landing_list_page()
	{
		// echo "landing"; return;
		$view_data = [
			'title'     => 'Danh sách Trang nội dung',
			'view'      => 'backend/pages/landing/landing_list',
			'tab'       => 'landing,landing_list',
		];

		$this->load->view('backend/layout', $view_data);
	}

	/**
	 * Lấy dữ liệu cho datatable
	 *
	 */
	public function landing_datatable_json() {

		$landings = $this->Landing->get_all_landings();
		$landing_data = array();
		$alias_prefix = "";
		foreach ($landings['data'] as $landing) {
			$status = $landing['landing_status'] ? "<span class='badge badge-success'>Hiện</span>" : "<span class='badge badge-dark'>Ẩn</span>";
			$landing_data[] = array(
				$landing['landing_id'],
				$landing['landing_name'],
				$alias_prefix.$landing['landing_alias'],
				date('d/m/Y H:i', strtotime($landing['landing_created_at'])),
				$status,
				'<div class="action-buttons td-actions text-right">
					<a href="'.base_url("admin/landing/".$landing['landing_id']."/edit").'" class="edit-action"><i class="la la-edit edit"></i></a>
					<a data-landing-name="'.$landing['landing_name'].'" data-href="'.base_url("admin/landing/".$landing['landing_id']."/delete").'" href="#/" class="delete-action"><i class="la la-close delete"></i></a>
				</div>'
			);
		}
		$landings['data'] = $landing_data;
		echo json_encode($landings);
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
			'author' => $this->session->userdata('id'),
			'name' => $this->input->post('name'),
			'alias' => make_alias($this->input->post('name')),
			'caption' => $this->input->post('caption'),
			'thumbnail' => $this->input->post('thumbnail'),
			'content' => $this->input->post('content', FALSE),
			'status' => $this->input->post('status'),
			'created_at' => date('Y-m-d H:i:s'),
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
	public function render_edit_landing_page($landing_id)
	{
		$landing = (array) $this->Landing->first_or_fail($landing_id);
		$view_data = [
			'title'   => 'Cập nhật Trang nội dung',
			'view'    => 'backend/pages/landing/landing_edit',
			'landing' => $landing,
			'tab'     => 'landing,',
		];

		$this->load->view('backend/layout', $view_data);
	}

	/**
	* Cập nhật slideshow
	* @return [type] [description]
	*/
	public function update_landing()
	{
		// echo "cập nhật slideshow"; return;
		$landing_id = $this->input->post('id');
		$data_to_update = [
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

		if (!$this->Landing->update_landing($data_to_update, $landing_id)) {
			$this->flash('Có lỗi xảy ra, không thể cập nhật lúc này');
		} else {
			$this->flash('Cập nhật trang nội dung thành công');
		}
		redirect(base_url('admin/landing'));
	}

	public function delete_landing($id)
	{
		if (!$id || !$this->Landing->delete($id)) {
			$this->flash('Có lỗi xảy ra, không thể xóa Trang nội dung đã chọn');
		} else {
			$this->flash('Đã xóa trang nội dung mà bạn chọn');
		}
		redirect(base_url('admin/landing'));
		return;
	}






}
