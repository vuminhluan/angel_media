
<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class User_model extends MY_Model
{
	
	function __construct() {
		parent::__construct();
		$this->table = "users";
		// mặc định trong MY_Model primaryKey = "id"
		// $this->primaryKey = "id";
	}

	
	/**
	 * Checks email
	 *
	 * @param string $email
	 *
	 * @return bool
	 * @author Mathew
	 */
	public function email_check($email = '') {
		return $this->field_check('email', $email);
	}

	/**
	 * 
	 */
	public function get_user_by_email($email = '') {
		if ($email == "") {
			return FALSE;
		}
		return $this->db->where(['email' => $email])->get($this->table)->row();
	}

	/**
	 * Tìm user dựa vào code đặt lại mật khẩu
	 */
	public function get_user_by_password_reset_code($code = "") {
		if ($code == "") {
			return FALSE;
		}
		return $this->db->where(['password_reset_code' => $code])->get($this->table)->row();
	}

	/**
	 * 
	 */
	public function get_user_by_token($token = '') {
		if (empty($token)) {
			return FALSE;
		}
		return $this->db->where(['token' => $token])->get($this->table)->row();
	}


	/**
	 * Tạo mã giúp đặt lại mật khẩu
	 */
	public function create_reset_password_code($user) {
		// data_helper.php
		if (!$code = generate_code()) {
			return FALSE;
		}
		$user->password_reset_code = $code;
		return $this->update($user);
	}


	/**
	 * Cập nhật last_login khi đăng xuất
	 * @param: email
	 */
	public function update_last_login($id = '') {
		if (empty($id)) {
			return FALSE;
		}
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		return $this->update(['last_login' => date('Y-m-d H:i:s')], ['id' => $id]);
	}

	/**
	 * Cập nhật thông tin cá nhân
	 */
	public function update_personal_information($form_data) {
		return $this->update($form_data, ['id' => $form_data['id']]);
	}

	/**
	 * Update password
	 */
	public function update_password($user) {
		return $this->update($user);
	}

	/**
	 * Cập nhật avatar = filemanager tinymce
	 */
	public function update_avatar_by_filemanager($form_data) {
		return $this->User->update($form_data, ['id' => $this->session->userdata('id')]);
	}



	// Datatable:
	// get all users for server-side datatable processing (ajax based)
	public function get_all_users() {
		$wh = ['is_admin' => 0];
		$this->db->select(['U.id as user_id', 'firstname', 'lastname', 'email', 'created_at', 'mobile_no', 'role', 'is_active', 'is_verify', 'is_admin', 'last_login', 'G.id as group_id', 'group_name']);
		$this->db->from('users as U');
		$this->db->join('user_groups as G', 'U.role = G.id');
		$this->db->where($wh);

		$SQL = $this->db->get_compiled_select();
		return $this->datatable->LoadJson($SQL, $wh);
	}

	/**
	 * Lấy tất cả thành viên trong 1 nhóm
	 * @param: $group_id
	 * @return: $array
	 */
	public function get_users_by_group($group_id) {
		return $this->db->get_where($this->table, ['role' => $group_id])->result_array();
	}


	/**
	 * Đổi nhóm cho nhiều thanh viên
	 * @param: Danh sách thành viên (mảng)
	 */
	public function change_users_group($user_list) {
		if (!$user_list) {
			return FALSE;
		}
		// Lấy danh sách id từ danh sách thành viên
		$user_id_list = $this->get_columns($user_list, 'id');
		// echo "<pre>"; print_r($user_id_list); return;
		// Cập nhật nhóm cho mỗi thành viên
		$this->db->where_in('id', $user_id_list);
		$this->db->update($this->table, ['role' => 1]);

		return $this->db->affected_rows() > 0;
	}



}