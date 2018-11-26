<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('backend/includes/_head.php') ?>
</head>
<body id="page-top">

	<!-- MESSAGE FROM SERVER -->
	<div class="msg-from-server msg-top text-center text-hide">
    <?php if (validation_errors() !== ''): ?>
      <?= validation_errors() ?>
    <?php endif; ?>
    <?php if ($this->session->flashdata('msg')): ?>
      <?= $this->session->flashdata('msg') ?>
    <?php endif; ?>
  </div>
	
	<!-- LOADER -->
	<?php $this->load->view('backend/includes/_loader.php') ?>
	
	<div class="page">
		<!-- HEADER -->
		<?php $this->load->view('backend/includes/_header.php') ?>

		<!-- Begin Page Content -->
	<div class="page-content d-flex align-items-stretch">
		<!-- SIDEBAR -->
		<?php $this->load->view('backend/includes/_sidebar.php') ?>
		<div class="content-inner">
		<div class="container-fluid">
			<!-- BREADCRUMB -->
			<?php $this->load->view('backend/includes/_breadcrumb') ?>

			<!-- MAIN VIEW -->
			<input type="hidden" id="menu_tab" value="<?= !empty($tab) ? $tab : '' ?>">
			<?php $this->load->view($view) ?>
		</div>
		<!-- End container -->

		<!-- FOOTER -->
		<?php $this->load->view('backend/includes/_footer') ?>

		<!-- OFF CANVAS SIDEBAR (CHAT SIDEBAR) -->
		<?php $this->load->view('backend/includes/_off-canvas-sidebar') ?>
	  </div>
	</div>
	</div>


	<!-- JAVASCRIPT -->
	<?php $this->load->view('backend/includes/_javascript') ?>
	
</body>
</html>