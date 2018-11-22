<!-- Begin Form -->
<h3>Tạo cho mình một tài khoản mới</h3>
<?php echo form_open(base_url('admin/register'), ['class' => 'register-form']); ?>
	<div class="group material-input">
		<input type="email" name="email" required value="<?= set_value('email_register') ?>">
		<span class="highlight"></span>
		<span class="bar"></span>
		<label>Email</label>
	</div>
	<div class="group material-input">
		<input type="password" name="password" required>
		<span class="highlight"></span>
		<span class="bar"></span>
		<label>Mật khẩu</label>
	</div>
	<div class="group material-input">
		<input type="password" name="password_confirmation" required>
		<span class="highlight"></span>
		<span class="bar"></span>
		<label>Xác nhận mật khẩu</label>
	</div>
	<div class="sign-btn text-center">
		<button type="submit" href="db-default.html" class="btn btn-lg btn-gradient-01">
			Tạo tài khoản
		</button>
	</div>
<?php echo form_close(); ?>
<!-- <div class="row">
	<div class="col text-left">
		<div class="styled-checkbox"> -->
			<!-- <input type="checkbox" name="checkbox" id="agree"> -->
			<!-- <label for="agree">I đồng ý <a href="#">Terms and Conditions</a></label> -->
<!-- 		</div>
	</div>
</div> -->
<div class="register">
	Bạn đã có tài khoản ?
	<br>
	<a href="<?= base_url('admin/login')?>">Đăng nhập ngay</a>
</div> 
<!-- End Form -->  