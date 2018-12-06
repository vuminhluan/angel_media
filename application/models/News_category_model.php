
<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class News_category_model extends MY_Model
{

	function __construct() {
		parent::__construct();
		$this->table = "news_categories";
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
	public function get_all_news_categories() {
		$wh = ['status' => 1];
		$this->db->select(['id', 'name', 'alias', 'status']);
		$this->db->from('news_categories');
		$this->db->where($wh);

		$SQL = $this->db->get_compiled_select();
		return $this->datatable->LoadJson($SQL, $wh);
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

}
