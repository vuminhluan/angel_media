<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slideshow_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table = "slideshow";
  }

  public function get_all_slides()
  {
    return $this->db->get($this->table)->result_array();
  }

  public function get_slides_for_datatable()
  {
    $this->db->select('*');
    $this->db->from($this->table);
    $SQL =  $this->db->get_compiled_select();
    return $this->datatable->LoadJson($SQL);
  }

  public function check_table()
  {
    return $this->db->count_all_results($this->table) > 0;
  }

  public function update_slideshow($data, $id)
  {
    return $this->update($data, [$this->primaryKey => $id]);
  }


}
