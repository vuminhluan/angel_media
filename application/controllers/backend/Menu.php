<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class Menu extends Admin_Controller
{

  public function __construct()
  {
		parent::__construct();
		$this->load->model('menu_model', 'Menu');
  }

	/**
	 * Render trang danh sách menu
	 */
  public function render_menu_list_page()
  {
    $view_data = [
      'title' => 'Danh sách menu',
      'view' => 'backend/pages/menu/menu_list',
      'tab' => 'menu,menu_list',
    ];
    $this->load->view('backend/layout', $view_data);
	}
	
	/**
	 * Render trang danh sách menu
	 */
  public function render_create_menu_page()
  {
    $view_data = [
      'title' => 'Thêm menu mới',
      'view' => 'backend/pages/menu/menu_list',
      'tab' => 'menu,menu_list',
    ];
    $this->load->view('backend/layout', $view_data);
  }

  public function them_menu_moi()
  {
    $data['menu_list'] = $this->menu_model->menu_list();
    $data['view'] = 'admin/menu/menu_add';
    $data['title'] = 'Thêm menu mới';
    if (!$_POST) {
      $this->load->view('layout', $data);
      return;
    }
    $this->menu_model->menu_add();
    redirect('admin/menu/danh_sach_menu');
  }

  public function menu_detail($menuID)
  {
    $data = array(
      'menu_detail' => $this->menu_model->menu_detail($menuID),
      'menu_list' => $this->menu_model->menu_list(),
    );
    $this->load->view('admin/menu/menu_list', $data);
  }

  public function menu_update($menuID)
  {
    $data['menu_item'] = $this->menu_model->menu_detail($menuID);
    $data['menu_list'] = $this->menu_model->menu_list();
    $data['view'] = 'admin/menu/menu_update';
    $data['title'] = 'Cập nhật menu';
    if (!$_POST) {
      $this->load->view('layout', $data);
      return;
    }
    $this->menu_model->menu_update($menuID);
    redirect('admin/menu/danh_sach_menu');
  }

  public function delete($menuID)
  {
    $this->menu_model->menu_delete($menuID);
    redirect('admin/menu/danh_sach_menu');
  }

}
