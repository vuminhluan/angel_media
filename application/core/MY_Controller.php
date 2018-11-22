<?php

/**
 * 
 */
class MY_Controller extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function prt($data) {
		echo "<pre>";
		print_r($data);
	}

	/**
	 * So sánh chuỗi truyền vào và hash của một chuỗi nào đó
	 */
	public function check_hash($string_to_compare, $existed_hash) {
		return password_verify($string_to_compare, $existed_hash);
	}

	/**
	 * hash password
	 */
	public function make_bcrypt($string) {
		return password_hash($string, PASSWORD_BCRYPT);
	}

	/**
	 * Clean xss
	 */
	public function clean($data) {
		return $this->security->xss_clean($data);
	}

	/**
	 * Đăng xuất người dùng hiện tại (Trang Admin)
	 * Nếu làm thêm phần khách hàng thì check role rồi chuyển trang sau khi đăng xuất
	 */
	public function log_user_out() {
		$this->load->model('User_model', 'User');
		$id = $this->session->userdata('id');
		if ($this->User->update_last_login($id)) {
			$this->session->sess_destroy();
			redirect(base_url('admin/login'), 'refresh');
		} else {
			$this->session->set_flashdata('msg', 'Không thể đăng xuất. Lỗi không xác định.');
			redirect(base_url('admin/dashboard'));
		}
	}

	/**
	 * Đổi ngôn ngữ sang Việt Nam (chủ yếu khi dùng form_validation)
	 */
	public function vietnam() {
		$this->config->set_item('language', 'vietnam');
	}

	/**
	 * Hàm tạo flashdata, mặc định sẽ trả về $msg
	 */
	public function flash($flashdata_content = '', $flashdata_name = 'msg') {
		$this->session->set_flashdata($flashdata_name, $flashdata_content);
	}

}

/**
 * Admin controller - > nếu là admin thì mới được truy cập các phương thức của các lớp extends Class này
 */
class Admin_Controller extends MY_Controller
{
	
	function __construct() {
		parent::__construct();
		if (!$this->session->has_userdata('is_admin')) {
			redirect(base_url('admin/login'));
		}
	}
}

/**
 * Public controller - > Dành cho trang ngoài
 */
class Public_Controller extends MY_Controller
{
	
	function __construct() {
		parent::__construct();
	}
}