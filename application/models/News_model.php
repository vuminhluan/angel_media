
<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class News_model extends MY_Model
{

	function __construct() {
		parent::__construct();
		$this->table = "news";
		// mặc định trong MY_Model primaryKey = "id"
		// $this->primaryKey = "id";
	}

	public $alias_prefix = "tin-tuc/";
	
	/**
	 * Tạo danh mục tin tức mới
	 */
	public function create_news_category($form_data) {
		if (!$form_data) {
			return FALSE;
		}
		return $this->insert($form_data) > 0;
	}

	/**
	 * Lấy danh sách danh mục tin tức datatable
	 */
	public function get_all_news() {
		// $this->db->select(['N.id as news_id', 'N.category_id as category_id', 'NC.name as category_name', 'NC.alias as category_alias', 'N.author as author_id', 'user.firstname as author_firstname', 'user.lastname as author_lastname', 'user.avatar as author_avatar', 'N.name as news_name', 'N.alias as news_alias', 'N.view as news_view', 'N.status as news_status', 'N.created_at as news_created_at']);
		// $this->db->from('news as N');
		// $this->db->join('news_categories as NC', 'N.category_id = NC.id');
		// $this->db->join('users as U', 'N.author = U.id');

		$this->db->select([
			'N.id as news_id', 'N.name as news_name', 'N.view as news_view',
			'N.status as news_status', 'N.created_at as news_created_at', 'N.alias as news_alias',
			'N.category_id as category_id',
			'NC.name as category_name', 'NC.alias as category_alias', 'N.author as author_id',
			'U.firstname as author_firstname', 'U.lastname as author_lastname', 'U.avatar as author_avatar']);
		$this->db->from('news as N');
		$this->db->join('news_categories as NC', 'N.category_id = NC.id');
		$this->db->join('users as U', 'N.author = U.id');

		$SQL = $this->db->get_compiled_select();
		return $this->datatable->LoadJson($SQL);
	}

	/**
	 * Lấy danh mục thông qua Alias
	 */
	public function get_category_by_alias($alias = '') {
		if (!$alias) {
			return FALSE;
		}
		return $this->get_where($this->table, ['alias' => $alias])->row();
	}

	/**
	 * Cập nhật tin tức
	 * @param: mảng chứa dữ liệu cập nhật và id tin tức muốn cập nhật
	 *
	 */
	public function update_news($data, $id) {
		return $this->update($data, [$this->primaryKey => $id]);
	}


	/**
	 * Xóa tin tức
	 */
	public function delete_news($news_id) {
		return $this->delete($news_id);
	}

}
