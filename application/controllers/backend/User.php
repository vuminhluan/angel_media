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
		$this->load->model('user_group_model', 'UserGroup');
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
			// 'css_file' => 'backend/includes/css_file/datatable_css.php',
			// 'js_file' => 'backend/includes/js_file/datatable_js.php',
			'view' => 'backend/pages/user/user_list.php'
		];
		$this->load->view('backend/layout', $view_data);
	}


	public function user_list_datatable_json() {
		

		$users = $this->User->get_all_users();
		$user_data = array();
		foreach ($users['data']  as $user) {

			$status = $user['is_active'] ? '<span class="badge-text badge-text-small info"><i class="la la-check"></i></span>' : '<span class="badge-text badge-text-small danger"><i class="la la-ban"></i></span>';

			$user_data[]= array(
				// base_url("admin/user/".$user['user_id']."/view")
				'<a href="#/" class="view-detail">'.$user['user_id'].'</a>',
				$user['email'],
				$user['created_at'],
				// $user['is_active'],
				$status,
				'<button class="btn btn-info btn-square">'.$user['group_name'].'</button>',
				'<div class="action-buttons td-actions text-right">
					<a href="'.base_url("admin/users/".$user['user_id']."/edit").'" class="edit-action"><i class="la la-edit edit"></i></a>
					<a href="'.base_url("admin/users/".$user['user_id']."/delete").'" class="delete-action"><i class="la la-close delete"></i></a>
				</div>'
			);
		}
		$users['data']=$user_data;
		echo json_encode($users);						   
	}


	/**
	 * Render trang sửa user
	 */
	public function render_edit_user_page($user_id) {
		$user = (array) $this->User->first_or_fail($user_id);
		$groups = $this->UserGroup->get_user_groups();
		$view_data = [
			'title' => 'Cập nhật thông tin thành viên',
			// 'css_file' => 'backend/includes/css_file/datatable_css.php',
			// 'js_file' => 'backend/includes/js_file/datatable_js.php',
			'view' => 'backend/pages/user/user_edit.php',
			'user' => $user,
			'groups' => $groups
		];
		$this->load->view('backend/layout', $view_data);
	}

	/**
	 * Cập nhật người dùng
	 */
	public function update_user() {
		if (!$_POST) {
			show_404();
		}

		$form_data = [
			'id' => $this->input->post('user_id'),
			'email' => $this->input->post('email'),
			'is_active' => $this->input->post('status'),
			'role' => $this->input->post('select_user_groups')
		];

		if ($this->input->post('lastname')) {
			$form_data['lastname'] = $this->input->post('lastname');
		}
		if ($this->input->post('firstname')) {
			$form_data['firstname'] = $this->input->post('firstname');
		}
		if ($this->input->post('mobile_no')) {
			$form_data['mobile_no'] = $this->input->post('mobile_no');
		}
		if ($this->input->post('address')) {
			$form_data['address'] = $this->input->post('address');
		}

		
		// Sử dụng Library Validation
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->render_edit_user_page($form_data['id']);
			return;
		}

		if (!$this->User->update($form_data, ['id' => $form_data['id']])) {
			$this->flash('Có lỗi xảy ra. Không thể cập nhật thành viên bây giờ');
		} else {
			$this->flash('Cập nhật tài khoản thành công');
		}
		redirect('admin/users');
		return;
	}

	/**
	 * Render trang tạo tài khoản mới
	 */
	public function render_create_user_page() {
		$groups = $this->UserGroup->get_user_groups();
		$view_data = [
			'title' => 'Thêm thành viên mới',
			// 'css_file' => 'backend/includes/css_file/datatable_css.php',
			// 'js_file' => 'backend/includes/js_file/datatable_js.php',
			'view' => 'backend/pages/user/user_create.php',
			'groups' => $groups
		];
		$this->load->view('backend/layout', $view_data);
	}

	/**
	 * Tạo tài khoản mới
	 */
	public function create_user() {
		if (!$_POST) {
			show_404();
		}

		$form_data = [
			'email' => $this->input->post('email'),
			'is_active' => $this->input->post('status'),
			'role' => $this->input->post('select_user_groups'),
			'password' => $this->input->post('password'),
			'password_confirmation' => $this->input->post('password_confirmation'),
		];

		if ($this->input->post('lastname')) {
			$form_data['lastname'] = $this->input->post('lastname');
		}
		if ($this->input->post('firstname')) {
			$form_data['firstname'] = $this->input->post('firstname');
		}
		if ($this->input->post('mobile_no')) {
			$form_data['mobile_no'] = $this->input->post('mobile_no');
		}
		if ($this->input->post('address')) {
			$form_data['address'] = $this->input->post('address');
		}

		
		// Sử dụng Library Validation
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->render_create_user_page();
			return;
		}
		// $this->prt($form_data); return;

		$data_to_insert = $form_data;
		unset($data_to_insert['password_confirmation']);
		$data_to_insert['password'] = $this->make_bcrypt($data_to_insert['password']);
		$data_to_insert['token'] = md5(rand(0,10000));
		$data_to_insert['created_at'] = date('Y-m-d H:i:s');
		$data_to_insert['updated_at'] = date('Y-m-d H:i:s');

		if (!$this->User->insert($data_to_insert)) {
			$this->flash('Có lỗi xảy ra. Không thể thêm thành viên mới bây giờ');
		} else {
			$this->flash('Thêm thành viên mới thành công');
		}
		redirect('admin/users');
		return;
	}


	// ================= KẾT THÚC QUẢN LÝ THÀNH VIÊN ================= //


	// ================= QUẢN LÝ NHÓM THÀNH VIÊN ================= //
	public function render_user_group_list_page() {
		$view_data = [
			'title' => 'Danh sách các nhóm thành viên',
			// 'css_file' => 'backend/includes/css_file/datatable_css.php',
			// 'js_file' => 'backend/includes/js_file/datatable_js.php',
			'view' => 'backend/pages/user/user_group_list.php'
		];
		$this->load->view('backend/layout', $view_data);
	}

	public function user_group_list_datatable_json() {
		$groups = $this->UserGroup->get_all_user_groups();
		$group_data = array();
		$count = 1;
		// href="'.base_url("admin/user-groups/".$group['id']."/delete").'"
		foreach ($groups['data']  as $group) {
			$action_buttons = $group['is_deletable'] ?
			'
				<a href="'.base_url("admin/user-groups/".$group['id']."/edit").'" class="edit-action"><i class="la la-edit edit"></i></a>
				<a data-group-name="'.$group["group_name"].'" data-href="'.base_url("admin/user-groups/".$group['id']."/delete").'" href="#/" class="delete-action"><i class="la la-close delete"></i></a>
			' : '';
			$group_data[]= array(
				// base_url("admin/user/".$user['user_id']."/view")
				'<a href="#/" class="view-detail">'.$count++.'</a>',
				$group['group_name'],
				'<div class="action-buttons td-actions text-right text-right">'.$action_buttons	.'</div>'
			);
		}
		$groups['data']=$group_data;
		echo json_encode($groups);						   
	}

	/**
	 * Trang tạo nhóm thành viên
	 */
	public function render_create_user_group_page() {
		$view_data = [
			'title' => 'Thêm mới nhóm thành viên',
			// 'css_file' => 'backend/includes/css_file/datatable_css.php',
			// 'js_file' => 'backend/includes/js_file/datatable_js.php',
			'view' => 'backend/pages/user/user_group_create.php'
		];
		$this->load->view('backend/layout', $view_data);
	}

	/**
	 * Tạo nhóm thành viên
	 */
	public function create_user_group() {
		$form_data ['group_name_create'] = $this->input->post('group_name_create');

		// Library Validation (custom)
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->render_create_user_group_page();
			return;
		}

		$form_data['group_name'] = $this->input->post('group_name_create');
		unset($form_data['group_name_create']);
		if (!$this->UserGroup->insert($form_data)) {
			$this->flash('Có lỗi xảy ra, không thể tạo nhóm mới');
		} else {
			$this->flash('Tạo nhóm mới thành công');
		}
		redirect('admin/user-groups');
		return;
	}

	/**
	 * Render trang chỉnh sửa nhóm thành viên
	 */
	public function render_edit_user_group_page($group_id) {
		$group = (array) $this->UserGroup->first_or_fail($group_id);
		$view_data = [
			'title' => 'Cập nhật nhóm thành viên',
			// 'css_file' => 'backend/includes/css_file/datatable_css.php',
			// 'js_file' => 'backend/includes/js_file/datatable_js.php',
			'view' => 'backend/pages/user/user_group_edit.php',
			'group' => $group,
		];
		$this->load->view('backend/layout', $view_data);
	}

	/**
	 * Cập nhật nhóm thành viên
	 */
	public function update_user_group() {
		// echo "a"; return;

		$form_data = [
			'id' => $this->input->post('id'),
			'group_name_edit' => $this->input->post('group_name_edit'),
		];


		// Library Validation (custom)
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->render_edit_user_group_page($form_data['id']);
			return;
		}

		// Kiểm tra tên nhóm mới có tồn tại không
		$it = (array) $this->UserGroup->find($form_data['id']);
		// $this->prt($it); return;
		$group = (array) $this->UserGroup->get_group_by_name($form_data['group_name_edit']);
		// $this->prt($group); return;
		if ($group && $it['group_name'] != $group['group_name']) {
			$this->flash('Tên nhóm đã tồn tại. Xin vui lòng chọn tên khác');
			$this->render_edit_user_group_page($form_data['id']);
			return;
		}

		$it['group_name'] = $form_data['group_name_edit'];
		if (!$this->UserGroup->update($it, ['id' => $it['id']])) {
			$this->flash('Có lỗi xảy ra. Không thể cập nhật nhóm bây giờ.');
		} else {
			$this->flash('Cập nhật nhóm thành công');
		}

		redirect(base_url('admin/user-groups'));
		return;
	}

	/**
	 * Xóa nhóm thành viên
	 * @workflow: Tìm nhóm, Tìm thành viên trong nhóm -> Chuyển hết sang nhóm Thành viên -> Xóa nhóm
	 * @upgrade: Cho cài đặt nhóm sẽ chuyển sau khi xóa (mặc định là nhóm Thành viên) - Chưa làm
	 * @upgrade: Cho phép chọn: Xóa hết thành viên trong nhóm sau khi xóa nhóm - Chưa làm
	 * @param: group_id
	 *
	 */
	public function delete_user_group($group_id) {
		// Kiểm tra xem group có tồn tại hay không
		$group = $this->UserGroup->first_or_fail($group_id);

		// Lấy tất cả thành viên
		if ($users = $this->User->get_users_by_group($group_id)) {
			// Chuyển tất cả thành viên đó sang group "Thành viên"
			// $this->prt($users); return;

			if (!$this->User->change_users_group($users)) {
				$this->flash('Có lỗi xảy ra, không thể xóa nhóm bây giờ');
			} else {
				$this->flash('Xóa nhóm thành công, các thành viên trong nhóm đã được chuyển qua nhóm Thành viên');
			}
			// return;
		}
		// return;

		redirect(base_url('admin/user-groups'));
		return;
	}


	// ================= KẾT THÚC QUẢN LÝ NHÓM THÀNH VIÊN ================= //



}