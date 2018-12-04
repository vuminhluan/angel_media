<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_detail_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table = "product_detail";
  }

  public function insert_product_versions($data)
  {
    $this->db->insert_batch($this->table, $data);
  }

  public function get_versions_by_product($product_id)
  {
    return $this->db->get_where($this->table, ['product_id' => $product_id])->result_array();
  }

  public function get_product_version_by_id($product_id, $version_id)
  {
    return (array) $this->db->get_where($this->table, [
      'id'         => $version_id,
      'product_id' => $product_id
    ])->row();
  }

  public function delete_version($product_id, $version_id)
  {
    if (!$this->get_product_version_by_id($product_id, $version_id)) {
      return FALSE;
    }

    return $this->delete($version_id);
  }

  public function update_version($data, $version_id)
  {
    return $this->update($data, [$this->primaryKey => $version_id]);
  }


  public function detele_all_version_of_product($product_id)
  {
    return $this->delete(['product_id' => $product_id]);
  }

}
