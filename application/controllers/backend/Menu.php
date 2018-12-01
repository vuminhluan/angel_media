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
    // Lấy ra những menu "anh em" đứng từ vị trí sẽ thêm menu mới trờ về sau (bên dưới nó) (có số order lớn hơn hoặc bằng cái sẽ thêm)
    // Cập nhật lại order cho những menu đó order = order + 1
    $menu_children = $this->Menu->get_preceded_siblings_with_included($parent_id, $menu_order);
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
      // Cập nhật lại vị trí sau khi thêm
      if ($update_array) {
        $this->Menu->update_orders($update_array);
      }
      $this->flash('Thêm menu mới thành công');
      redirect(base_url('admin/menu'));
    }
    return;
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

  /**
   * Xóa 1 menu
   * @param  int $menu_id [mã menu cần xóa]
   * @return string Tin nhắn
   */
  public function delete_menu($menu_id)
  {
    // Các bước thực hiện
    // 1. Kiểm tra có menu con hay không, nếu có menu con thì không cho xóa (tính an toàn)
    // 2. Lấy ra menu "anh em" (cùng 1 cha) có vị trí ở bên dưới (số order lớn hơn) menu muốn xóa
    // 3. Update vị trí của các menu đó (order = order - 1)
    // 4. Xóa menu muốn xóa
    // 5. Trả về thông báo

    // Bước 1:
    $menu_to_delete = (array) $this->Menu->first_or_fail($menu_id);
    if ($this->Menu->get_children($menu_to_delete['id'])) {
      $this->flash("Không thể xóa menu này, vì đây là một menu đa cấp. Hãy đảm bảo menu muốn xóa không có menu con");
      redirect(base_url('admin/menu'));
      return;
    }
    // echo "Menu này có thể xóa vì nó trống";
    // return;

    // Bước 2:
    $preceded_siblings = $this->Menu->get_preceded_siblings_with_no_included(
      $menu_to_delete['parent_id'], $menu_to_delete['orders']
    );

    $update_array = [];
    foreach ($preceded_siblings as $siblings) {
      $update_array[] = [
        'id' => $siblings['id'],
        'orders' => $siblings['orders'] - 1,
      ];
    }
    // $this->prt($update_array); return;

    // Bước 3:
    if ($update_array) {
      $this->Menu->update_orders($update_array);
    }

    // Bước 4 + Bước 5:
    if (!$this->Menu->delete_menu($menu_id)) {
      $this->flash('Có lỗi xảy ra, không thể xóa menu này');
    } else {
      $this->flash('Xóa menu thành công');
    }
    redirect(base_url('admin/menu'));
    return;
  }

  /**
   * Render trang chỉnh sửa menu
   * @param  int $menu_id Mã menu muốn sửa chữa - cập nhật
   * @return view
   */
  public function render_edit_menu_page($menu_id) {
		$menu = (array) $this->Menu->first_or_fail($menu_id);
    $menu_list = $this->Menu->get_menu_list();
		$view_data = [
			'title' => 'Chỉnh sửa Menu',
			'view' => 'backend/pages/menu/menu_edit',
			'menu' => $menu,
			'tab' => 'menu,'
		];
    $view_data['recursive_menu'] = get_recursive_menu($menu_list);
		$this->load->view('backend/layout', $view_data);
	}

  /**
   * Cập nhật menu
   * @param $_POST
   * @return
   */
  public function update_menu()
  {
    $menu_id = $this->input->post('id');
    $menu = (array) $this->Menu->first_or_fail($menu_id);
    $form_data = [];
    if ($menu['name'] != $this->input->post('name')) {
      $form_data['menu_name'] = $this->input->post('name');
    }

    // Sử dụng Library Validation
		if ($form_data && $this->validation->validate_form($form_data) == FALSE) {
			$this->render_edit_menu_page($menu_id);
			return;
		}
    // Kiểm tra bị trí của siblings và cập nhật lại
    // Trường hợp 1: Vẫn nằm trong parent cũ
    // Trường hợp 2: Parent mới
    $new_parent_id = $this->input->post('select_menu_parent');
    $new_order = $this->input->post('select_orders');

    // Trường hợp 2: Parent mới -> Thêm 1 hành động là "xóa" menu này đi ở trong parent cũ -> Cập nhật lại vị trí của những đứa đứng sau nó order += 1
    if ($new_parent_id != $menu['parent_id']) {
      // "Xóa" ở parent cũ
      $old_preceded_siblings = $this->Menu->get_preceded_siblings_with_no_included($menu['parent_id'], $menu['orders']);
      $update_array = $this->update_preceded_siblings_orders($old_preceded_siblings, "minus");
      // $this->prt($update_array);

      // echo "<br><br><br> ================================================================ <br><br><br>";

      // Thêm vào parent mới  - Cập nhật order = order + 1 ở parent mới
      $new_preceded_siblings = $this->Menu->get_preceded_siblings_with_included($new_parent_id, $new_order);
      $update_array = $this->update_preceded_siblings_orders($new_preceded_siblings, "plus");
      // $this->prt($update_array);
      // return;
    } else {
      // Vẫn nằm trong parent cũ

      if ($new_order < $menu['orders']) {
        // Nếu vị trí mới nhỏ hơn vị trí hiện tại => Lấy ra những thằng sau nó (order < order hiện tại) sau đó cập nhật order = order + 1
        $followed_siblings = $this->Menu->get_between_followed_siblings($new_parent_id, $new_order, $menu['orders']);
        $update_array = $this->update_preceded_siblings_orders($followed_siblings, "plus");
        // echo "followed"; return;
        // $this->prt($update_array);
        // return;
        // echo "<br><br><br> ================================================================ <br><br><br>";

      } elseif ($new_order > $menu['orders']) {
        // Nếu vị trí mới lớn hơn vị trí hiện tại => Lấy ra những thằng dưới nó (order > order hiện tại) sau đó cập nhật order = order  - 1
        $followed_siblings = $this->Menu->get_between_preceded_siblings($new_parent_id, $new_order, $menu['orders']);
        $update_array = $this->update_preceded_siblings_orders($followed_siblings, "minus");
        // echo "preceded"; return;
        // $this->prt($update_array);
        // return;
        $new_order -= 1;
      }
      // return;

    }
    // echo "<br><br><br> === wait === <br><br><br>"; return;

    // Cập nhật
    // echo $new_order; return;
    $data_to_update = [
      'name' => $this->input->post('name'),
      'parent_id' => $this->input->post('select_menu_parent'),
      'link' => $this->input->post('link'),
      'orders' => $new_order,
      'status' => $this->input->post('status'),
      'target' => $this->input->post('target'),
    ];

    if (!$this->Menu->update_menu($data_to_update, $menu_id)) {
      $this->flash('Có lỗi xảy ra, không thể cập nhật menu này ngay bây giờ');
      // $this->render_edit_menu_page($menu_id);
      redirect(base_url('admin/menu/'.$menu_id.'/edit'));
    } else {
      $this->flash('Cập nhật menu thành công');
      redirect(base_url('admin/menu'));
    }
    return;
  }


  // Utilities
  public function update_preceded_siblings_orders($preceded_siblings, $sign = "minus")
  {
    $update_array = [];
    foreach ($preceded_siblings as $siblings) {
      $update_array[] = [
        'id' => $siblings['id'],
        'orders' => $sign == "plus" || $sign == "plus"  ? $siblings['orders'] + 1 : $siblings['orders'] - 1,
      ];
    }
    // return $update_array;
    if ($update_array) {
      $this->Menu->update_orders($update_array);
    }
  }



}
