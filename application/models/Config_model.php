<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Config_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->table = "config";
  }

  public function get_contact_info()
  {
    $this->db->select([
      'id', 'website_name', 'hotline',
      'email', 'address', 'map',
      'facebook', 'zalo', 'skype', 'youtube'
    ]);
    return $this->db->get($this->table)->row_array();
  }

  public function get_logos()
  {
    $this->db->select([
      'id',
      'logo', 'logo_footer', 'favicon'
    ]);
    return $this->db->get($this->table)->row_array();
  }

  public function get_seo()
  {
    $this->db->select([
      'id',
      'seo_title', 'seo_keyword', 'seo_description'
    ]);
    return $this->db->get($this->table)->row_array();
  }

  public function create_config($data)
  {
    return $this->insert($data);
  }

  public function update_config($data, $id)
  {
    return $this->update($data, ['id' => $id]);
  }


}
