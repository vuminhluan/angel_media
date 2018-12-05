<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Config extends Admin_Controller
{

	function __construct() {
		parent::__construct();
		$this->load->model('config_model', 'WebsiteConfig');
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


	public function get_contact_info()
	{
		$contact = $this->WebsiteConfig->get_contact_info();
		// $this->prt($contact);return;
		$view_data = [
      'title'   => 'Thông tin liên hệ',
      'view'    => 'backend/pages/config/config_contact',
			'contact' => $contact,
      'tab'     => 'config,config_contact',
    ];

		$this->load->view('backend/layout', $view_data);
	}

	public function update_contact_info()
	{
		$id = $this->input->post('id');

		$form_data = [
			'website_name' => $this->input->post('website_name'),
			'hotline'      => $this->input->post('hotline'),
			'email'        => $this->input->post('email'),
			'address'      => $this->input->post('address'),
			'facebook'     => $this->input->post('facebook'),
			'zalo'         => $this->input->post('zalo'),
			'skype'        => $this->input->post('skype'),
			'youtube'      => $this->input->post('youtube'),
			'map'          => $this->input->post('map', FALSE)
		];
		// $this->prt($form_data);return;

		if (!$id) {
			// Tạo mới
			$this->WebsiteConfig->create_config($form_data);
		} else {
			$this->WebsiteConfig->update_config($form_data, $id);
		}
		$this->flash('Cập nhật thành công');
		redirect('admin/config/contact');
	}

	public function get_logo()
	{
		$view_data = [
      'title' => 'Logo website',
      'view'  => 'backend/pages/config/config_logo',
			'logos' => $this->WebsiteConfig->get_logos(),
      'tab'   => 'config,config_logo',
    ];

		$this->load->view('backend/layout', $view_data);
	}

	public function update_logos()
	{
		$id = $this->input->post('id');

		$form_data = [
			'logo' => $this->input->post('logo'),
			'logo_footer'      => $this->input->post('logo_footer'),
			'favicon'        => $this->input->post('favicon')
		];

		if (!$id) {
			// Tạo mới
			$this->WebsiteConfig->create_config($form_data);
		} else {
			$this->WebsiteConfig->update_config($form_data, $id);
		}
		$this->flash('Cập nhật thành công');
		redirect('admin/config/logo');
	}

	public function get_seo()
	{
		$view_data = [
      'title' => 'Website SEO',
      'view'  => 'backend/pages/config/config_seo',
			'seo' => $this->WebsiteConfig->get_seo(),
      'tab'   => 'config,config_seo',
    ];

		$this->load->view('backend/layout', $view_data);
	}

	public function update_seo()
	{
		$id = $this->input->post('id');

		$form_data = [
			'seo_title' => $this->input->post('seo_title'),
			'seo_keyword'      => $this->input->post('seo_keyword'),
			'seo_description'        => $this->input->post('seo_description')
		];

		if (!$id) {
			// Tạo mới
			$this->WebsiteConfig->create_config($form_data);
		} else {
			$this->WebsiteConfig->update_config($form_data, $id);
		}
		$this->flash('Cập nhật thành công');
		redirect('admin/config/seo');
	}




}
