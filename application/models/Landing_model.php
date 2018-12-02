<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landing_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table = "landing";
  }


  public function create_landing($data)
  {
    if (!$data) {
      return FALSE;
    }

    return $this->insert($data);
  }

  /**
  * Lấy danh sách danh mục tin tức datatable
  */
  public function get_all_landings()
  {
    $this->db->select('*');
    $this->db->select([
      'L.id as landing_id', 'L.name as landing_name', 'L.alias as landing_alias',
      'L.thumbnail as landing_thumbnail', 'L.caption as landing_caption', 'L.status as landing_status',
      'L.created_at as landing_created_at', 'L.author as author_id',
      'U.firstname as author_firstname', 'U.lastname as author_lastname', 'U.avatar as author_avatar',
      'U.id as author_id',
    ]);
    $this->db->from('landing as L');
    $this->db->join('users as U', 'L.author = U.id');

    // return $this->db->get()->result_array();
    $SQL = $this->db->get_compiled_select();
    return $this->datatable->LoadJson($SQL);
  }

  public function update_landing($data, $id)
  {
    return $this->update($data, [$this->primaryKey => $id]);
  }


}
