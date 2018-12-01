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

	/**
	* Render trang danh sách slideshow
	* @return ---
	*/
	public function render_slideshow_page()
	{
		$view_data = [
			'title'     => 'Danh sách Slideshow',
			'view'      => 'backend/pages/slide/slide_list',
			'tab'       => 'slide,slide_list',
		];

		$this->load->view('backend/layout', $view_data);
	}

	/**
	* Render trang tạo slideshow
	* @return [type] [description]
	*/
	public function render_create_slideshow_page()
	{
		$view_data = [
			'title'     => 'Thêm mới Slideshow',
			'view'      => 'backend/pages/slide/slide_list',
			'tab'       => 'slide,slide_new',
		];

		$this->load->view('backend/layout', $view_data);
	}

	/**
	* Tạo slideshow
	* @return [type] [description]
	*/
	public function create_slideshow()
	{
		echo "create slideshow"; return;
		$this->load->model('Slideshow_model', 'SlideShow');
	}

	/**
	* Render trang chỉnh sửa - cập nhật slideshow
	* @return [type] [description]
	*/
	public function render_edit_slideshow_page()
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
	public function update_slideshow()
	{
		echo "cập nhật slideshow"; return;
	}




}
