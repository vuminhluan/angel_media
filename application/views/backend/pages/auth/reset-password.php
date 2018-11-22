<!-- Begin Form -->
<h3>Đặt lại mật khẩu</h3>
<?php echo form_open(base_url('admin/reset-password-by-code'), ['class' => 'reset-password-form', 'method' => 'POST']); ?>
	<div class="group material-input">
		<input name="code" type="text" value="<?= set_value('password_reset_code') ?>" required>
		<span class="highlight"></span>
		<span class="bar"></span>
		<label>Code</label>
	</div>
	<div class="group material-input">
		<input name="password" type="password" required>
		<span class="highlight"></span>
		<span class="bar"></span>
		<label>Mật khẩu mới</label>
	</div>
	<div class="group material-input">
		<input name="password_confirmation" type="password" required>
		<span class="highlight"></span>
		<span class="bar"></span>
		<label>Nhập lại mật khẩu mới</label>
	</div>

	<div class="sign-btn text-center">
		<button type="submit" class="btn btn-lg btn-gradient-03">
			Đặt lại mật khẩu
		</button>
	</div>
<?php echo form_close(); ?>
<!-- End Form -->