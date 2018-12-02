<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*
*/
class Slideshow extends Admin_Controller
{

	function __construct() {
		parent::__construct();
		$this->load->model('Slideshow_model', 'Slideshow');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
	}

	/**
	* Render trang danh sách slideshow
	* @return ---
	*/
	public function render_slideshow_list_page()
	{
		// echo "slideshow"; return;
		$view_data = [
			'title'     => 'Danh sách Slideshow',
			'view'      => 'backend/pages/slideshow/slideshow_list',
			'check_table' => $this->Slideshow->check_table(),
			'tab'       => 'slide,slide_list',
		];

		$this->load->view('backend/layout', $view_data);
	}

	/**
	* Lấy dữ liệu cho datatable
	*
	*/
	public function slideshow_datatable_json() {
		$slideshow = $this->Slideshow->get_slides_for_datatable();
		$landing_data = array();
		$alias_prefix = "";
		foreach ($slideshow['data'] as $slides) {
			// $status = $slides['landing_status'] ? "<span class='badge badge-success'>Hiện</span>" : "<span class='badge badge-dark'>Ẩn</span>";
			$slides_data[] = array(
				$slides['id'],
				$slides['name'],
				$slides['image'],
				// $alias_prefix.$slides['landing_alias'],
				// date('d/m/Y H:i', strtotime($slides['landing_created_at'])),
				// $status,
				'<div class="action-buttons td-actions text-right">
				<a href="'.base_url("admin/slideshow/".$slides['id']."/edit").'" class="edit-action"><i class="la la-edit edit"></i></a>
				<a data-slide-name="'.$slides['name'].'" data-href="'.base_url("admin/slideshow/".$slides['id']."/delete").'" href="#/" class="delete-action"><i class="la la-close delete"></i></a>
				</div>'
			);
		}
		$slideshow['data'] = $slides_data;
		echo json_encode($slideshow);
	}

	/**
	* Render trang tạo slideshow
	* @return [type] [description]
	*/
	public function render_create_slideshow_page()
	{
		$view_data = [
			'title'     => 'Thêm mới Slideshow',
			'view'      => 'backend/pages/slideshow/slideshow_create',
			'tab'       => 'slideshow,slideshow_new',
		];

		$this->load->view('backend/layout', $view_data);
	}

	/**
	* Tạo slideshow
	* @return [type] [description]
	*/
	public function create_slideshow()
	{
		$form_data = [
			'slide_name' => $this->input->post('name'),
			'slide_image' => $this->input->post('image'),
		];

		// Sử dụng Library Validation - autoload - tự tạo
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->render_create_slideshow_page();
			return;
		}

		$data_to_insert = [
			'name' => $this->input->post('name'),
			'image' => $this->input->post('image'),
		];

		if (!$this->Slideshow->insert($data_to_insert)) {
			$this->flash('Có lỗi xảy ra, không thể thêm slide bây giờ');
			redirect(base_url('admin/slideshow/create'));
		} else {
			$this->flash('Thêm slide thành công');
			redirect(base_url('admin/slideshow'));
		}

	}
	/**
	* Render trang chỉnh sửa - cập nhật slideshow
	* @return [type] [description]
	*/
	public function render_edit_slideshow_page($slide_id)
	{
		$slide = (array) $this->Slideshow->first_or_fail($slide_id);
		// $this->prt($slide); return;
		$view_data = [
			'title' => 'Danh sách Slideshow',
			'view'  => 'backend/pages/slideshow/slideshow_edit',
			'slide' => $slide,
			'tab'   => 'slideshow,'
		];

		$this->load->view('backend/layout', $view_data);
	}

	/**
	* Cập nhật slideshow
	* @return [type] [description]
	*/
	public function update_slideshow()
	{
		$form_data = [
			'slide_name' => $this->input->post('name'),
			'slide_image' => $this->input->post('image'),
		];

		// Sử dụng Library Validation - autoload - tự tạo
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->render_edit_slideshow_page($this->input->post('id'));
			return;
		}

		$data_to_update = [
			'name' => $this->input->post('name'),
			'image' => $this->input->post('image'),
		];

		if (!$this->Slideshow->update_slideshow($data_to_update, $this->input->post('id') )) {
			$this->flash('Có lỗi xảy ra, không thể cập nhật slide bây giờ');
		} else {
			$this->flash('Cập nhật slide thành công');
		}
		redirect(base_url('admin/slideshow'));
	}


	public function delete_slideshow($id)
	{
		$slide = (array)$this->Slideshow->first_or_fail($id);
		$this->Slideshow->delete($slide);
		$this->flash('Xóa slide thành công');
		redirect(base_url('admin/slideshow'));
	}




}
