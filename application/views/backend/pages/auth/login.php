<!-- Begin Form -->
<h3>Đăng nhập vào trang quản trị</h3>
<?php echo form_open(base_url('admin/login'), ['class' => 'login-form']); ?>
	<div class="group material-input">
		<input name="email" type="email" required value="<?= set_value('email') ?>">
		<span class="highlight"></span>
		<span class="bar"></span>
		<label>Email</label>
	</div>
	<div class="group material-input">
		<input name="password" type="password" required>
		<span class="highlight"></span>
		<span class="bar"></span>
		<label>Mật khẩu</label>
	</div>
	<div class="row">
		<div class="col text-left">
			<div class="styled-checkbox">
				<input type="checkbox" name="remember_me" id="remeber" checked>
				<label for="remeber">Ghi nhớ đăng nhập</label>
			</div>
		</div>
		<div class="col text-right">
			<a href="<?= base_url('admin/forgot-password') ?>">Quên mật khẩu ?</a>
		</div>
	</div>

	<div class="group material-input sign-btn text-center">
		<button type="submit" href="db-default.html" class="btn btn-lg btn-gradient-01"> Đăng nhập </button>
	</div>
<?php echo form_close(); ?>

<div class="register">
	Bạn chưa có tài khoản ? 
	<br>
	<a href="<?= base_url('admin/register')?>">Tạo một tài khoản mới</a>
</div>
<!-- End Form