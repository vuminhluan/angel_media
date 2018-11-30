<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table = "menu";
  }

  /**
   * Lấy ra danh sách menu
   */
  public function get_menu_list($condition = [])
  {
    return $this->db->where($condition)
                    ->order_by('orders', 'ASC')
                    ->get($this->table)->result_array();
  }

  /**
   * Lấy ra danh sách menu (trang danh sách)
   */
  public function get_menu_and_parent()
  {
    $this->db->select([
      'menu.id as menu_id', 'menu.name as menu_name', 'menu.link as menu_link',
      'menu.orders as menu_order', 'menu.status as menu_status', 'menu.target as menu_target',
      'parent.id as parent_id', 'parent.name as parent_name', 'parent.link as parent_link'
    ]);
    $this->db->from('menu as menu');
    $this->db->join('menu as parent', 'menu.parent_id = parent.id');
    return $this->db->get()->result_array();
  }

  /**
   * Thêm menu mới vào danh sách menu
   * @param  array  $data [dữ liệu để thêm mới]
   * @return bool        [description]
   */
  public function create_menu($data = array())
  {
    if (!$data) {
      return FALSE;
    }
    return $this->insert($data);
  }

  /**
   * [Lấy danh sách menu con khi có id của menu cha bất kì]
   * @param  int $parent_id id menu cha
   * @return array danh sách menu con
   */
  public function get_children($parent_id)
  {
		return $this->db->where(['parent_id'=> $parent_id])->order_by('orders')->get($this->table)->result_array();
	}

	public function get_children_after_creating($parent_id, $order)
  {
    return $this->db->where(['parent_id'=> $parent_id, 'orders >=' => $order])
    ->order_by('orders')
    ->get($this->table)->result_array();
	}

	public function update_orders_after_creating($update_array)
  {
		$this->db->update_batch($this->table, $update_array, 'id');
	}

}

/* End of file Menu_model.php */
/* Location: ./application/models/admin/Menu_model.php */
