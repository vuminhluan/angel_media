
<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class User_group_model extends MY_Model
{
	
	function __construct() {
		parent::__construct();
		$this->table = "user_groups";
		// mặc định trong MY_Model primaryKey = "id"
		// $this->primaryKey = "id";
	}

	
	/**
	 * Lấy danh sách nhóm thành viên
	 */
	public function get_user_groups() {
		return $this->all();
	}

	/**
	 * Datatable:
	 * get all user groups for server-side datatable processing (ajax based)
	 */
	public function get_all_user_groups() {
		$this->db->select(['id', 'group_name', 'status', 'is_deletable']);
		$this->db->from('user_groups');

		$SQL = $this->db->get_compiled_select();
		return $this->datatable->LoadJson($SQL);
	}

	/**
	 * Lấy nhóm theo thên
	 *
	 * @param tên nhóm
	 *
	 */
	public function get_group_by_name($group_name = '') {
		if (empty($group_name)) {
			return FALSE;
		}
		return $this->db->get_where($this->table, ['group_name' => $group_name])->row();
	}
	

}