<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table = "news";
  }

  /**
   * Lấy ra danh sách menu
   */

  public function get_parent_info($chID)
  {
    settype($chID, "int");
    $this->db->where('menu_id', $chID);
    $query = $this->db->get('angel_menu');
    return $result = $query->row_array();
  }

  public function menu_list()
  {

    $this->db->where('menu_parent_id', 0);
    $this->db->order_by('menu_order', 'asc');
    $query = $this->db->get('angel_menu');
    $query = $query->result_array();

    foreach ($query as &$key) {

      $params = $key['menu_id'];
      $this->db->where('menu_parent_id', $params);
      $this->db->order_by('menu_order', 'asc');
      $sql2 = $this->db->get('angel_menu');
      $query2 = $sql2->result_array();

      if (!empty($query2)) {
        $key['menulv2'] = $query2;
        foreach ($key['menulv2'] as &$row) {
          $get_parent_info = $this->get_parent_info($row['menu_parent_id']);
          $row['chName'] = $get_parent_info['menu_name']; // Lấy tên danh mục cha

          $params2 = $row['menu_id'];

          $this->db->where('menu_parent_id', $params2);
          $this->db->order_by('menu_order', 'asc');
          $sql3 = $this->db->get('angel_menu');
          $query3 = $sql3->result_array();

          if (!empty($query3)) {
            $row['menulv3'] = $query3;
            foreach ($row['menulv3'] as &$ti) {
              $get_parent_info = $this->get_parent_info($ti['menu_parent_id']);
              $ti['chName'] = $get_parent_info['menu_name']; // Lấy tên danh mục cha
            }
          }
        }
      }
    }
    return $query;
  }

  public function menu_add()
  {

    $chID = $this->input->post('menu_parent_id');
    $Name = $this->input->post('menu_name');
    $Url = $this->input->post('menu_link');
    // $Icon = $this->input->post('menu_icon');
    $Icon = '';
    $Thutu = $this->input->post('menu_order');
    $Status = $this->input->post('menu_status');
    $Target = $this->input->post('menu_target');

    $data = [
      'menu_name' => $this->input->post('menu_name'),
      'menu_link' => $this->input->post('menu_link'),
      'menu_icon' => '',
      'menu_order' => $this->input->post('menu_order'),
      'menu_status' => $this->input->post('menu_status'),
      'menu_target' => $this->input->post('menu_target'),
      'menu_parent_id' => $this->input->post('menu_parent_id'),
    ];

    $this->db->insert('angel_menu', $data);
  }

  public function menu_detail($menuID)
  {
    settype($menuID, 'int');
    $sql = "SELECT * FROM angel_menu WHERE menu_id = $menuID";
    $query = $this->db->query($sql);
    return $query->row_array();
  }

  public function menu_update($menuID)
  {
    $data = [
      'menu_name' => $this->input->post('menu_name'),
      'menu_link' => $this->input->post('menu_link'),
      'menu_icon' => '',
      'menu_order' => $this->input->post('menu_order'),
      'menu_status' => $this->input->post('menu_status'),
      'menu_target' => $this->input->post('menu_target'),
      'menu_parent_id' => $this->input->post('menu_parent_id'),
    ];
    $this->db->where('menu_id', $menuID)->update('angel_menu', $data);
  }

  public function menu_delete($menuID)
  {
    settype($menuID, 'int');
    $sql = "DELETE FROM angel_menu WHERE menu_parent_id = $menuID OR menu_id = $menuID";
    $this->db->query($sql);
  }

}

/* End of file Menu_model.php */
/* Location: ./application/models/admin/Menu_model.php */
