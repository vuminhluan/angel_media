<?php
class Mailer 
{
	function __construct()
	{
		$this->CI =& get_instance();
	}
	//=============================================================
	function Tpl_Registration($username, $email_verification_link)
	{
	$login_link = base_url('auth/login');  

		$tpl = '<h3>Xin chào ' .strtoupper($username).'</h3>
			<p>Chào mừng tới Angel Media!</p>
			<p>Click vào liên kết bên dưới để xác nhận email của bạn :</p>  
			<p>'.$email_verification_link.'</p>

			<br>
			<br>

			<p>Cảm ơn đã sử dụng dịch vụ của chúng tôi, <br> 
			   Angel Media <br> 
			</p>
	';
		return $tpl;		
	}

	//=============================================================
	function Tpl_ResetPassword($username, $code, $reset_link)
	{
		$tpl = '<h3>Xin chào ' .strtoupper($username).'</h3>
			<p>Chúng tôi nhận được thông báo bạn đã quên mật khẩu của mình. Vì vậy chúng tôi gửi code này giúp bạn đặt lại mật khẩu mới. Nếu có điều gì nghi ngờ, hãy bỏ qua email này.</p> 
			<p>Để có thể đặt lại mật khẩu, bạn hãy click vào liên kết bên dưới và nhập code:</p> 
			<p style="font-size: 25px; text-align: center">Code: '.$code.' </p>
			<br>
			<p>'.$reset_link.'</p>

			<br>
			<br>

			<p>Cảm ơn đã sử dụng dịch vụ của chúng tôi, <br> Angel Media</p>
	';
		return $tpl;		
	}

	

}
?>