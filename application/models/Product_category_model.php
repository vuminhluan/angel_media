<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_category_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table = "product_categories";
  }

  public function create_product_category($data)
  {
    return $this->insert($data);
  }

  // public function get_all_slides()
  // {
  //   return $this->db->get($this->table)->result_array();
  // }

  public function get_categories_for_datatable()
  {
    $this->db->select('*');
    $this->db->from($this->table);
    $SQL =  $this->db->get_compiled_select();
    return $this->datatable->LoadJson($SQL);
  }



  public function update_category($data, $id)
  {
    return $this->update($data, [$this->primaryKey => $id]);
  }


}
