<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class User extends Admin_Controller
{
	
	function __construct() {
		parent::__construct();
		$this->load->model('user_model', 'User');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
	}

	public function index() {
		// echo ellipsize('Loremipsumdolorsitamet.', 7, .5); return;
		echo $this->User->get_all_users();
	}

	// ================= PROFILE ================= //

	/**
	 * Render trang profile của người đăng nhập hiện tại
	 */
	public function render_profile_page() {
		$view_data = [
			'title' => 'Hồ sơ cá nhân',
			'view' => 'backend/pages/user/profile',
			'user' => $this->User->find($this->session->userdata('id'))
		];
		$this->load->view('backend/layout', $view_data);
		return;
	}

	/**
	 * Cập nhật thông tin cá nhân
	 */
	public function update_personal_information() {
		if (!$_POST) {
			show_404();
		}

		$form_data = [
			'id' => $this->input->post('user_id'),
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'email' => $this->input->post('email'),
			'mobile_no' => $this->input->post('phone')
		];

		// Sử dụng Library Validation
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->render_profile_page();
			return;
		}

		
		if (!$this->User->update_personal_information($form_data)) {
			$this->flash('Có lỗi xảy ra. Không thể cập nhật thông tin');
		} else {
			$this->flash('Cập nhật thông tin thành công.');
		}

		redirect(base_url('admin/profile'));
		return;
	}

	/**
	 * Cập nhật lại mật khẩu
	 */
	public function update_password() {
		if (!$_POST) {
			show_404();
		}

		$form_data = [
			'current_password' => $this->input->post('current_password'),
			'password' => $this->input->post('password'),
			'password_confirmation' => $this->input->post('password_confirmation')
		];

		// Sử dụng Library Validation
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->render_profile_page();
			return;
		}

		$user = $this->User->find($this->session->userdata('id'));
		if (!$this->check_hash($form_data['current_password'], $user->password)) {
			$this->flash('Mật khẩu hiện tại không đúng');
		} else {
			$user->password = $this->make_bcrypt($form_data['password']);
			if (!$this->User->update_password($user)) {
				$this->flash('Đã xảy ra lỗi không mong muốn. Không thể cập nhật mật khẩu');
			} else {
				$this->flash('Cập nhật mật khẩu mới thành công');
			}
		}
		redirect(base_url('admin/profile'));
		return;

	}

	/**
	 * Cập nhật avatar thông qua file manager tinymce
	 */
	public function update_avatar() {
		if (!$this->input->post('avatar')) {
			$this->flash('Có lỗi xảy ra, cập nhật ảnh đại diện thất bại');
		} else {
			$form_data['avatar'] = $this->input->post('avatar');
		
			if ($this->User->update_avatar_by_filemanager($form_data, ['id' => $this->session->userdata('id')])) {
				$this->flash('Cập nhật ảnh đại diện thành công');
				$this->session->set_userdata('avatar', $form_data['avatar']);
			} else {
				$this->flash('Có lỗi xảy ra, cập nhật ảnh đại diện thất bại');
			}
		}
		redirect(base_url('admin/profile'));
		return;
	}



	// ================= END PROFILE ================= //



	// ================= QUẢN LÝ THÀNH VIÊN ================= //
	public function render_user_list_page() {
		$view_data = [
			'title' => 'Danh sách thành viên',
			'css_file' => 'backend/includes/css_file/datatable_css.php',
			'js_file' => 'backend/includes/js_file/datatable_js.php',
			'view' => 'backend/pages/user/user_list.php'
		];
		$this->load->view('backend/layout', $view_data);
	}


	public function datatable_json() {
		

		$users = $this->User->get_all_users();
		$user_data = array();
		foreach ($users['data']  as $user) {

			$status = $user['is_active'] ? '<span class="badge-text badge-text-small info"><i class="la la-check"></i></span>' : '<span class="badge-text badge-text-small danger"><i class="la la-ban"></i></span>';

			$user_data[]= array(
				'<a href="'.base_url("admin/user/".$user['user_id']."/view").'" class="view-detail">'.$user['user_id'].'</a>',
				$user['email'],
				$user['created_at'],
				// $user['is_active'],
				$status,
				'<button class="btn btn-info btn-square">'.$user['group_name'].'</button>',
				'<div class="action-buttons td-actions">
					<a href="'.base_url("admin/user/".$user['user_id']."/edit").'" class="edit-action"><i class="la la-edit edit"></i></a>
					<a href="'.base_url("admin/user/".$user['user_id']."/delete").'" class="delete-action"><i class="la la-close delete"></i></a>
				</div>'
			);
		}
		$users['data']=$user_data;
		echo json_encode($users);						   
	}


	// ================= KẾT THÚC QUẢN LÝ THÀNH VIÊN ================= //






}