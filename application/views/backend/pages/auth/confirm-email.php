<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->view('backend/includes/auth/_head') ?>
	</head>
	<body class="bg-fixed-02">

		<!-- Begin Preloader -->
		<?php $this->load->view('backend/includes/_loader') ?>
		<!-- End Preloader -->
		<!-- MESSAGE FROM SERVER -->
	  <div class="msg-from-server msg-top text-center text-hide">
	    <?php if (validation_errors() !== ''): ?>
	      <?= validation_errors() ?>
	    <?php endif; ?>
	    <?php if ($this->session->flashdata('msg')): ?>
	      <?= $this->session->flashdata('msg') ?>
	    <?php endif; ?>
	  </div>
	  <!-- MESSAGE FROM SERVER -->

		<!-- Begin Container -->
		<div class="container-fluid h-100 overflow-y">
			<div class="row flex-row h-100">
				<div class="col-12 my-auto">
					<div class="mail-confirm mx-auto">
						<div class="animated-icon">
							<div class="gradient"></div>
							<div class="icon"><i class="la la-at"></i></div>
						</div>
						<h3>Hãy xác nhận email của bạn!</h3>
						<p> Chúng tui đã gửi tin nhắn xác nhận tới <a href="#/"><?= $this->session->flashdata('email') ?></a> </p>
						<p> Kiểm tra hòm thư đến và bấm vào liên kết để xác nhận email của bạn </p>
						<?php echo form_open(base_url('admin/resend-confirmation-email'), ['class' => 'confirmation-email-form']); ?>
						<input type="hidden" name="email" value="<?= $this->session->flashdata('email') ?>">
						<div class="button text-center">
							<button type="submit" class="btn btn-lg btn-gradient-01">
								Gửi lại
							</button>
						</div>
						<div class="button text-center">
							<a type="submit" href="<?= base_url('admin/login') ?>" class="">
								Đăng nhập
							</a>
						</div>
						<?php echo form_close(); ?>
					</div>        
				</div>
				<!-- End Col -->
			</div>
			<!-- End Row -->
		</div>  
		<!-- End Container -->  
		<?php $this->load->view('backend/includes/auth/_javascript') ?>
	</body>
</html>