<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table = "products";
  }

  public $alias_prefix = "san-pham/";

  public function create_product($data)
  {
    $this->db->insert($this->table, $data);
		return $this->db->insert_id();
  }

  // public function get_all_slides()
  // {
  //   return $this->db->get($this->table)->result_array();
  // }

  public function get_products_for_datatable()
  {
    $wh = ['1' => 1];
    $this->db->select([
      'P.id as product_id', 'P.name as product_name', 'P.alias as product_alias',
      'P.image as product_image', 'p.original_price as orgiginal_price', 'P.price as price',
      'P.status as status',
      'PC.id as cate_id', 'PC.parent_id as cate_parent_id', 'PC.name as cate_name',
      'PC.alias as cate_alias',
      'COUNT(PD.id) as total_version'
    ]);
    $this->db->from('products as P');
    $this->db->join('product_categories as PC', 'P.category_id = PC.id', 'left');
    $this->db->join('product_detail as PD', 'PD.product_id = P.id', 'left');
    $this->db->where($wh);
    $this->db->group_by([
      'product_id', 'product_name', 'product_alias',
      'product_image', 'orgiginal_price', 'price',
      'status',
      'cate_id', 'cate_parent_id', 'cate_name',
      'cate_alias'
    ]);
    $SQL =  $this->db->get_compiled_select();
    return $this->datatable->LoadJson($SQL, $wh);
  }

  public function test()
  {
    $wh = ['1' => 1];
    $this->db->select([
      'P.id as product_id', 'P.name as product_name', 'P.alias as product_alias',
      'P.image as product_image', 'p.original_price as orgiginal_price', 'P.price as price',
      'P.status as status',
      'PC.id as cate_id', 'PC.parent_id as cate_parent_id', 'PC.name as cate_name',
      'PC.alias as cate_alias',
      'COUNT(PD.id) as total_version'
    ]);
    $this->db->from('products as P');
    $this->db->join('product_categories as PC', 'P.category_id = PC.id', 'left');
    $this->db->join('product_detail as PD', 'PD.product_id = P.id', 'left');
    $this->db->where($wh);
    $this->db->group_by([
      'product_id', 'product_name', 'product_alias',
      'product_image', 'orgiginal_price', 'price',
      'status',
      'cate_id', 'cate_parent_id', 'cate_name',
      'cate_alias'
    ]);
    return $this->db->get()->result_array();
  }


  public function delete_product($product_id)
  {
    return $this->delete($product_id);
  }


  public function update_product($data, $product_id)
  {
    return $this->update($data, [$this->primaryKey => $product_id]);
  }




}
