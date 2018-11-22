<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Auth extends MY_Controller
{
	
	function __construct() {
		parent::__construct();
		$this->load->model('user_model', 'User');
		// $this->load->helper('email_helper');
		$this->load->library('mailer');
	}

	public function index() {
		// date_default_timezone_set('Asia/Ho_Chi_Minh');
		// echo date('Y:m:d H:i:s');
	}

	public function render_login_page() {
		$view_data = [
			'title' => 'Đăng nhập',
			'js_file' => 'backend/includes/js_file/auth_js',
			'view' => 'backend/pages/auth/login',
		];

		// Nếu truy cập bằng phương thức GET
		if (!$_POST) {
			$this->load->view('backend/auth', $view_data);
			return;
		}

		// Nếu đăng nhập:
		$form_data = [
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password')
		];

		$this->login($form_data, $view_data);
	}

	public function login($form_data, $view_data) {
		// Validate

		// Sử dụng Library Validation
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->load->view('backend/auth', $view_data);
			return;
		}

		// Kiểm tra email và mật khẩu có tồn tại hay không
		$msg = "Đăng nhập thành công.";
		$flag = FALSE;
		if (! $user = $this->get_user_by_email_and_password($form_data)) {
			$msg = "Email hoặc mật khẩu không tồn tại.";
		} else {
			$flag = TRUE;
			// $this->prt($user); return;
			// Đúng email và password:
			/*Kiểm tra đã kích hoạt hay chưa, kiểm tra đã bị khóa hay không*/
			if (!$user->is_active) {
				$flag = FALSE;
				$msg = 'Tài khoản này đã bị khóa, không thể sử dụng lại. Hãy liên lạc với chúng tôi để biết thêm chi tiết';
			} else {
				if (!$user->is_verify) {
					// Tài khoản chưa kích hoạt -> Chuyển hướng tới trang gửi email xác nhận
					$msg = 'Email chưa được xác nhận. Hãy xác nhận hoặc bấm nút "Gửi lại" nếu chưa nhận được email.';
					$this->session->set_flashdata('email', $form_data['email']);
					$this->session->set_flashdata('msg', $msg);
					redirect(base_url('admin/confirm-email'));
				}
			}
		}

		$this->session->set_flashdata('msg', $msg);

		if (!$flag) {
			redirect(base_url('admin/login'));
			return;
		}

		// Đăng nhập thành công -> Lưu session
		$this->set_auth_session($user);
		redirect(base_url('admin/dashboard'), 'refresh');
	}

	/**
	 * Tạo session sau khi đăng nhập thành công
	 */
	public function set_auth_session($user) {
		if (!$user) {
			return FALSE;
		}
		$this->session->set_userdata([
			'id' => $user->id,
			'username' => $user->username,
			'avatar' => $user->avatar,
			'email' => $user->email,
			'firstname' => $user->firstname,
			'lastname' => $user->lastname,
			'phone' => $user->mobile_no,
			'address' => $user->address,
			'role' => $user->role,
			'is_admin' => $user->is_admin ?  TRUE : FALSE
		]);
	}

	public function get_user_by_email_and_password($form_data) {
		if (count($form_data) < 2) {
			return FALSE;
		}
		$user = $this->User->get_user_by_email($form_data['email']);
		if (!$user) {
			return FALSE;
		}
		if (!$this->check_hash($form_data['password'], $user->password)) {
			return FALSE;
		}
		return $user;
	}


	public function render_register_page() {
		$view_data = [
			'title' => 'Đăng ký',
			'view' => 'backend/pages/auth/register',
		];
		if (! $_POST) {
			$this->load->view('backend/auth', $view_data);
			return;
		}

		// Nếu submit form đăng kí:
		$this->register($this->input->post(), $view_data);
		return;
	}

	/**
	 * Đăng kí
	 * @param: Dữ liệu gửi lên từ form phía client,
	 * @param: view_data để load trang khi sai validation
	 * @return:
	 */
	public function register($post, $view_data) {
		// Tạo mảng form_data từ dữ liệu gửi lên bằng phương thức post
		$form_data = [
			'email_register' => $post['email'],
			'password' => $post['password'],
			'password_confirmation' => $post['password_confirmation']
		];

		
		if ($this->validation->validate_form($form_data) == FALSE) {
			$this->load->view('backend/auth', $view_data);
			return;
		}

		// Thêm vào cơ sở dữ liệu
		$data_to_insert = [
			'email' => $form_data['email_register'],
			'password' => password_hash($form_data['password'], PASSWORD_BCRYPT),
			'created_at' => date('Y-m-d h:i:s'),
			'updated_at' => date('Y-m-d h:i:s'),
			'token' => md5(rand(0,10000))
		];
		$insert_result = $this->User->insert($data_to_insert);

		// $this->session->set_flashdata('msg', 'Bạn đã tạo tài khoản thành công. Chúng tôi đã gửi email tới hòm thư để giúp bạn kích hoạt tài khoản.');
		// // Chuyển hướng tới trang gửi email xác nhận

		//Nếu tạo tài khoản mới thành công
		// Gửi mail
		if (!$insert_result) {
			$url = base_url('admin/register');
			echo 'Đã xảy ra lỗi không mong muốn. <a href="'+$url+'">Đăng ký lại</a>'; return;
		}

		$_POST = array();
		$sending_result = $this->send_confirmation_email($form_data['email_register']);
		// return;
		$msg = "";
		if ($sending_result) {
			$msg = 'Bạn đã tạo tài khoản thành công. Chúng tôi đã gửi email tới hòm thư để giúp bạn kích hoạt tài khoản.';
		} else {
			$msg = 'Có lỗi phát sinh, chúng tôi chưa thể gửi tin nhắn tới bạn. Xin lỗi vì sự bất tiện này';
		}
		// echo $msg;return;

		$this->session->set_flashdata('email', $form_data['email_register']);
		$this->session->set_flashdata('msg', $msg);
		redirect(base_url('admin/confirm-email'));
	}


	/**
	 * Render trang quên mật khẩu nếu truy cập phương thức GET
	 * Gọi tới hàm gửi email quên mật khẩu nếu truy cập bằng phương thức POST
	 */
	public function render_forgot_password_page() {
		if (!$_POST) {
			$view_data = [
				'title' => 'Quên mật khẩu',
				'js_file' => 'backend/includes/js_file/auth_js',
				'view' => 'backend/pages/auth/forgot-password',
			];
			$this->load->view('backend/auth', $view_data);
			return;
		}

		// Nếu có $_POST => Gọi tới hàm forgot_password -> tạo code và gửi mail
		$email = $this->input->post('email');
		$this->forgot_password($email);
	}

	/**
	 * Hàm được gọi đến khi người dùng muốn lấy lại mật khẩu
	 */
	public function forgot_password($email = '') {
		$error = TRUE;
		$msg = "";
		if (empty($email)) {
			$msg = "Đã xảy ra lỗi, chúng tôi không thể gửi email cho bạn";
		} elseif (!$user = $this->User->get_user_by_email($email)) {
			$msg = "Email này chưa được đăng kí.";
		} elseif (!$user->is_active) {
			$msg = "Tài khoản này đã bị khóa. Hãy liên lạc với chúng tôi để biết thêm thông tin chi tiết";
		} else {
			// Đủ điều kiện để gửi mail
			// 1. Tạo code
			$user->password_reset_code = generate_code();
			if (!$password_reset_code = $this->User->update($user)) {
				$msg = "Đã xảy ra lỗi, chúng tôi không thể gửi email cho bạn bây giờ";
			} else {
				// 2. Gửi email
				
				if(!$sending_result = $this->send_password_reset_email($user)) {
					$msg = "Đã xảy ra lỗi, chúng tôi không thể gửi email cho bạn bây giờ";
				} else {
					$error = FALSE;
				}
			}
		}
		// Xét xem đã gửi được email hay chưa
		// Xét nễu không có lỗi => đã gửi thành công.
		if (!$error) {
			// Tạo flashdata, mặc định trả về là 'msg';
			$this->flash('Chúng tôi đã gửi mã giúp bạn đặt lại mật khẩu. Hãy kiểm tra hòm thư đến của bạn');
			redirect(base_url('admin/reset-password'));
			return;
		}

		//Nếu xảy ra lỗi => trả lại trang quên mật khẩu
		$this->flash($msg);
		redirect(base_url('admin/forgot-password'));
		return;
	}

	/**
	 * Gửi mail giúp đặt lại mật khẩu mới
	 */
	public function send_password_reset_email($user) {
		$name = $user->firstname.' '.$user->lastname;
		$password_reset_link = base_url('admin/reset-password');
		$body = $this->mailer->Tpl_ResetPassword($name, $user->password_reset_code, $password_reset_link);
		$this->load->helper('email_helper');
		$to = $user->email;
		$subject = 'Angel Media Đặt lại mật khẩu';
		$message =  $body ;
		$email = sendEmail($to, $subject, $message, $file = '' , $cc = '');
		
		return $email;

	}

	/**
	 * Render trang giúp đặt lại mật khẩu
	 */
	public function render_reset_password_page() {
		$view_data = [
			'title' => 'Đặt lại mật khẩu',
			'view' => 'backend/pages/auth/reset-password',
		];
		$this->load->view('backend/auth', $view_data);
	}

	/**
	 * Đặt lại mật khẩu mới
	 */
	public function reset_password_by_code() {
		// echo "a"; return;
		$form_data = [
			'password_reset_code' => $this->input->post('code'),
			'password' => $this->input->post('password'),
			'password_confirmation' => $this->input->post('password_confirmation')
		];
		// $this->prt($form_data);return;
		$this->form_validation->set_data($form_data);
		// Lấy ra bộ cài đặt khi validate (tùy vào form_data). Sau đó set_rules
		$validation_config = $this->User->get_validation_config($form_data);
		$this->form_validation->set_rules($validation_config);
		$this->vietnam();
		if ($this->form_validation->run() == FALSE) {
			$this->render_reset_password_page();
			return;
		}

		$user = $this->User->get_user_by_password_reset_code($form_data['password_reset_code']);
		$flag = FALSE;
		if (!$user) {
			$this->flash('Mã không hợp lệ.');
		} elseif (!$user->password_reset_code) {
			$this->flash('Mã không hợp lệ. Hoặc đã hết hạn sử dụng.');
		} elseif (!$user->is_active) {
			$this->flash('Tài khoản này đã bị khóa trước đó.');
		} else {
			$flag = TRUE;
		}

		if (!$flag) {
			redirect(base_url('admin/reset-password'));
		} else {
			$user->password = password_hash($form_data['password'], PASSWORD_BCRYPT);
			$user->password_reset_code = '';
			$this->User->update($user);
			$this->flash('Bạn đã đặt lại mật khẩu thành công. Sẵn sàng để đăng nhập');
			redirect(base_url('admin/login'));
		}

		return;
	}



	/**
	 * Trang xác nhận tài khoản sau khi đăng ký
	 */
	public function render_confirm_email_page() {
		if (!$this->session->flashdata('email')) {
			redirect(base_url('admin/dashboard'));
			return;
		}
		$view_data = [
			'title' => 'Xác nhận email',
			'email' => $this->session->flashdata('msg')
		];
		$this->load->view('backend/pages/auth/confirm-email', $view_data);
	}


	/**
	 * Đăng xuất người dùng
	 */
	public function logout() {
		$this->log_user_out();
	}

	/**
	 * Gửi email xác nhận
	 * @return: bool
	 *
	 */
	public function send_confirmation_email($email = '') {
		if ($_POST && !empty($_POST['email'])) {
			$email = $this->input->post('email');
		}

		if (empty($email)) {
			echo "Đã xảy ra lỗi không mong muốn. Chúng tôi xin lỗi vì sự bất tiện này"; return;
		}

		if (!$user = $this->User->get_user_by_email($email) ) {
			echo "Đã xảy ra lỗi không mong muốn. Chúng tôi xin lỗi vì sự bất tiện này"; return;
		}

		if ($user->is_verify) {
			echo "Đã xảy ra lỗi không mong muốn. Chúng tôi xin lỗi vì sự bất tiện này"; return;
		}

		// $this->prt($user);return;

		// Gửi email cho người dùng.
		//sendEmail
		$name = $user->firstname.' '.$user->lastname;
		$email_verification_link = base_url('admin/confirm-verification/'.$user->token);
		$body = $this->mailer->Tpl_Registration($name, $email_verification_link);
		$this->load->helper('email_helper');
		$to = $user->email;
		$subject = 'Angel Media Xác nhận email - Kích hoạt tài khoản';
		$message =  $body ;
		$email = sendEmail($to, $subject, $message, $file = '' , $cc = '');
		
		return $email;
	}

	/**
	 * Gửi lại email giúp kích hoạt tài khoản
	 */
	public function resend_confirmation_email() {
		$email = $this->input->post('email');
		$msg = "";
		if (!$email) {
			$msg = "Đã xảy ra lỗi không mong muốn. Chúng tôi không thể gửi email cho bạn bây giờ.";
		} else {
			$_POST = array();
			if ($sending_result = $this->send_confirmation_email($email)) {
				$msg = "Đã gửi lại email giúp xác nhận và kích hoạt tài khoản";
			}
		}
		$this->flash($email, 'email');
		$this->flash($msg);
		redirect(base_url('admin/confirm-email'));
		return;
	}

	/**
	 * Xác nhận email
	 * @param: token
	 * @return: 
	 */
	public function confirm_verification($token) {
		
		if (!$token) {
			show_404();
		}

		if (!$user = $this->User->get_user_by_token($token)) {
			show_404();
		}

		if ($user->is_verify) {
			show_404();
		}

		$user->is_verify = 1;
		$user->token = '';
		$user->is_admin = 1;
		if ($this->User->update($user)) {
			$this->session->set_flashdata('msg', 'Kích hoạt tài khoản thành công. Sẵn sàng để đăng nhập.');
			redirect(base_url('admin/login'));
		} else {
			$this->session->set_flashdata('msg', 'Đã có lỗi xảy ra, hãy liên lạc với chúng tôi để được giải quyết. Xin lỗi vì sự bất tiện này');
			redirect(base_url('admin/login'));
		}
		return;
	}


	




}