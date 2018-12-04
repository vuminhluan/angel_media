
<?php

/**
 *
 */
class Validation
{

	private $CI;

	function __construct() {
		$this->CI = &get_instance();
		$this->CI->load->library('form_validation');
		// $this->CI->load->config('myconfig');

		// Đổi sang ngôn ngữ Vietnam để hiển thị lỗi validation
		$this->CI->config->set_item('language', 'vietnam');
	}

	protected $rules = array(
		'password_reset_code' => [
			'field' => 'password_reset_code',
			'label' => 'Mã đặt lại mật khẩu',
			'rules' => 'trim|required|min_length[6]|max_length[6]|alpha_numeric'
		],

		'firstname' => [
			'field' => 'firstname',
			'label' => 'Tên',
			'rules' => 'trim|required|min_length[2]'
		],
		'lastname' => [
			'field' => 'lastname',
			'label' => 'Họ và tên lót',
			'rules' => 'trim|required|min_length[2]'
		],

		'mobile_no' => [
			'field' => 'mobile_no',
			'label' => 'Số điện thoại',
			'rules' => 'trim|required|min_length[10]|max_length[11]|numeric'
		],

		'address' => [
			'field' => 'address',
			'label' => 'Địa chỉ',
			'rules' => 'trim|required|min_length[10]|max_length[255]'
		],

		'current_password' => [
			'field' => 'current_password',
			'label' => 'Mật khẩu hiện tại',
			'rules' => 'trim|required|min_length[6]|max_length[32]'
		],
		'password' => [
			'field' => 'password',
			'label' => 'Mật khẩu',
			'rules' => 'trim|required|min_length[6]|max_length[32]'
		],
		'password_confirmation' => [
			'field' => 'password_confirmation',
			'label' => 'Mật khẩu xác nhận',
			'rules' => 'trim|required|matches[password]'
		],

		'email' => [
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email|is_unique[users.email]'
		],
		'email_edit' => [
			'field' => 'email_edit',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email'
		],
		'email_login' => [
			'field' => 'email_login',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email'
		],
		'email_register' => [
			'field' => 'email_register',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email|is_unique[users.email]'
		],

		'group_name_create' => [
			'field' => 'group_name_create',
			'label' => 'Tên nhóm thành viên',
			'rules' => 'trim|required|min_length[3]|is_unique[user_groups.group_name]'
		],
		'group_name_edit' => [
			'field' => 'group_name_edit',
			'label' => 'Tên nhóm thành viên',
			'rules' => 'trim|required|min_length[3]'
		],

		'news_category_name' => [
			'field' => 'news_category_name',
			'label' => 'Tên danh mục',
			'rules' => 'trim|required|min_length[3]'
		],
		'news_category_alias_create' => [
			'field' => 'news_category_alias_create',
			'label' => 'Đường dẫn',
			'rules' => 'trim|min_length[3]|is_unique[news_categories.alias]'
		],

		'news_name' => [
			'field' => 'news_name',
			'label' => 'Tiêu đề tin tức',
			'rules' => 'trim|required|min_length[10]|is_unique[news.name]'
		],
		'news_alias' => [
			'field' => 'news_alias',
			'label' => 'Đường dẫn',
			'rules' => 'trim|required|min_length[10]'
		],
		'news_thumbnail' => [
			'field' => 'news_thumbnail',
			'label' => 'Hình đại diện',
			'rules' => 'trim|required'
		],
		'news_content' => [
			'field' => 'news_content',
			'label' => 'Nội dung tin tức',
			'rules' => 'trim|required'
		],

		'menu_name' => [
			'field' => 'menu_name',
			'label' => 'Menu',
			'rules' => 'trim|required|min_length[3]|is_unique[menu.name]'
		],

		'landing_name' => [
			'field' => 'landing_name',
			'label' => 'Tên trang nội dung',
			'rules' => 'trim|required|min_length[5]|is_unique[menu.name]'
		],
		'landing_content' => [
			'field' => 'landing_content',
			'label' => 'Nội dung',
			'rules' => 'trim|required'
		],
		'landing_caption' => [
			'field' => 'landing_caption',
			'label' => 'Mô tả',
			'rules' => 'trim'
		],

		'slide_name' => [
			'field' => 'slide_name',
			'label' => 'Tên slide',
			'rules' => 'trim|required|min_length[5]'
		],
		'slide_image' => [
			'field' => 'slide_image',
			'label' => 'Hình slide',
			'rules' => 'trim|required'
		],

		// PRODUCT CATEGORY
		'product_category_name' => [
			'field' => 'product_category_name',
			'label' => 'Tên danh mục',
			'rules' => 'trim|required|min_length[3]'
		],
		'product_category_alias' => [
			'field' => 'product_category_alias',
			'label' => 'Đường dẫn',
			'rules' => 'trim|min_length[3]'
		],
		// END PRODUCT CATEGORY

		// PRODUCT
		'product_name' => [
			'field' => 'product_name',
			'label' => 'Tên sản phẩm',
			'rules' => 'trim|required|min_length[10]|is_unique[products.name]'
		],
		'product_name_edit' => [
			'field' => 'product_name',
			'label' => 'Tên sản phẩm',
			'rules' => 'trim|required|min_length[10]'
		],
		'product_alias' => [
			'field' => 'product_alias',
			'label' => 'Alias',
			'rules' => 'trim'
		],
		'product_caption' => [
			'field' => 'product_caption',
			'label' => 'Mô tả sản phẩm',
			'rules' => 'trim'
		],
		'product_thumbnail' => [
			'field' => 'product_thumbnail',
			'label' => 'Ảnh đại diện',
			'rules' => 'trim|required'
		],
		'product_content' => [
			'field' => 'product_content',
			'label' => 'Nội dung',
			'rules' => 'trim'
		],
		'original_price' => [
			'field' => 'original_price',
			'label' => 'Giá ban đầu',
			'rules' => 'trim|numeric'
		],
		'price' => [
			'field' => 'price',
			'label' => 'Giá bán hiện tại',
			'rules' => 'trim|required|numeric'
		],
		'color' => [
			'field' => 'color',
			'label' => 'Màu sắc',
			'rules' => 'trim|required'
		],
		'size' => [
			'field' => 'size',
			'label' => 'Kích thước',
			'rules' => 'trim|required'
		],
		// PRODUCT


		// SEO
		'title' => [
			'field' => 'title',
			'label' => 'Tiêu đề SEO',
			'rules' => 'trim'
		],
		'keyword' => [
			'field' => 'keyword',
			'label' => 'Từ khóa',
			'rules' => 'trim'
		],
		'description' => [
			'field' => 'description',
			'label' => 'Mô tả',
			'rules' => 'trim'
		],
		// END SEO


	);

	/**
	 * Lấy bộ cài đặt cho form validate
	 * @param: Truyền vào form data
	 * @return: Trả về mảng cài đặt
	 * @link: https://www.codeigniter.com/userguide3/libraries/form_validation.html#setting-rules-using-an-array
	 */
	public function get_validation_config($form_data = []) {
		if (empty($form_data)) {
			return FALSE;
		}

		$config = [];
		foreach ($form_data as $form_data_key => $value) {
			foreach ($this->rules as $key => $rule) {
				if ($form_data_key == $key) {
					$config[] = $rule;
				}
			}
		}
		return $config;
	}

	public function validate_form($form_data) {
		if (!$form_data) {
			return FALSE;

		}
		// Vì dữ liệu khi validate là mảng tự tạo, không phải input->post() => set_data()
		$this->CI->form_validation->set_data($form_data);
		// Lấy ra bộ cài đặt khi validate (tùy vào form_data). Sau đó set_rules
		$validation_config = $this->get_validation_config($form_data);
		$this->CI->form_validation->set_rules($validation_config);

		// Trả về kết quả validate: Bool TRUE of FALSE
		return $this->CI->form_validation->run();
	}
}
