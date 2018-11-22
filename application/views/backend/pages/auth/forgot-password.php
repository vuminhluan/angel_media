<h3>Quên mật khẩu</h3>
<?php echo form_open(base_url('admin/forgot-password'), ['class' => 'forgot-password-form']); ?>
	<div class="group material-input">
		<input type="email" name="email" required>
		<span class="highlight"></span>
		<span class="bar"></span>
		<label>Email</label>
	</div>
	<div class="button text-center">
		<button type="submit" href="dashboard.html" class="btn btn-lg btn-gradient-01">
			Nhận email trợ giúp
		</button>
	</div>
<?php echo form_close(); ?>
<br>
<div class="back text-center">
	<a href="<?= base_url('admin/login')?>">Đăng nhập</a>
</div>