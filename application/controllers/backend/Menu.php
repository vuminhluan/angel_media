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
      'title'     => 'Danh sách menu',
      'view'      => 'backend/pages/menu/menu_list',
      'menu_list' => $this->Menu->get_menu_list(),
      'tab'       => 'menu,menu_list',
    ];
    // $this->prt($view_data['menu_list']); return;
    $view_data['recursive_menu'] = get_recursive_menu($view_data['menu_list']);
    // $this->prt($view_data['menu_list']); return;
    // $this->prt($view_data['recursive_menu']); return;
    $this->load->view('backend/layout', $view_data);
  }

  /**
  * Render trang danh sách menu
  */
  public function render_create_menu_page()
  {
    // $menu_list = $this->Menu->get_menu_list();
    // $this->prt($menu_list); return;
    $view_data = [
      'menu_list' => $this->Menu->get_menu_list(),
      'title'     => 'Thêm menu mới',
      'view'      => 'backend/pages/menu/menu_create',
      'tab'       => 'menu,menu_create',
    ];
    $view_data['recursive_menu'] = get_recursive_menu($view_data['menu_list']);
    // $this->prt($view_data['recursive_menu']); return;

    $this->load->view('backend/layout', $view_data);
  }

  /*
  *
  * Lấy danh sách vị trí sau khi chọn menu cha
  */
  // public function get_menu_order_by_parent($menu_partent_id) {
	// 	$menu_children = $this->Menu->get_menu_children($menu_partent_id);
	// 	$this->load->view('include/admin/component/menu_order', ['menu_children' => $menu_children]);
	// }

  /**
   * Thêm menu mới
   */
  public function create_menu()
  {
    $form_data = [
      'menu_name' => $this->input->post('name')
      // 'parent_id' => $this->input->post('select_parent'),
      // 'link'      => $this->input->post('link'),
      // 'orders'    => $this->input->post('select_order'),
      // 'status'    => $this->input->post('status'),
      // 'target'    => $this->input->post('target')
    ];

    // Sử dụng Library Validation
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->render_create_menu_page();
			return;
		}

    $parent_id = $this->input->post('select_menu_parent');
    $menu_order = $this->input->post('select_orders');
    $menu_children = $this->Menu->get_children_after_creating($parent_id, $menu_order);
		$update_array = [];
		foreach ($menu_children as $children) {
			$update_array[] = [
				'id' => $children['id'],
				'orders' => $children['orders']+1,
			];
		}
    // $this->prt($update_array);return;

    $data_to_insert = [
      'name'      => $this->input->post('name'),
      'parent_id' => $this->input->post('select_menu_parent'),
      'link'      => $this->input->post('link'),
      'orders'    => $this->input->post('select_orders'),
      'status'    => $this->input->post('status'),
      'target'    => $this->input->post('target')
    ];

    //Thêm menu mới
    if (!$this->Menu->create_menu($data_to_insert)) {
      $this->flash('Có lỗi xảy ra, không thể tạo menu bây giờ');
      redirect(base_url('admin/menu/new'));
    } else {
      $this->Menu->update_orders_after_creating($update_array);
      $this->flash('Thêm menu mới thành công');
      redirect(base_url('admin/menu'));
    }
    return;
  }


  // public function them_menu_moi()
  // {
  //   $data['menu_list'] = $this->menu_model->menu_list();
  //   $data['view'] = 'admin/menu/menu_add';
  //   $data['title'] = 'Thêm menu mới';
  //   if (!$_POST) {
  //     $this->load->view('layout', $data);
  //     return;
  //   }
  //   $this->menu_model->menu_add();
  //   redirect('admin/menu/danh_sach_menu');
  // }
  //
  // public function menu_detail($menuID)
  // {
  //   $data = array(
  //     'menu_detail' => $this->menu_model->menu_detail($menuID),
  //     'menu_list' => $this->menu_model->menu_list(),
  //   );
  //   $this->load->view('admin/menu/menu_list', $data);
  // }

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
