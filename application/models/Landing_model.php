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


}
