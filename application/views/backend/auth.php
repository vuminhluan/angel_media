<!DOCTYPE html>
<html lang="en">
<head>
  <!-- HEAD -->
  <?php $this->load->view('backend/includes/auth/_head') ?>
</head>
<body class="bg-white">
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
  <div class="container-fluid no-padding h-100">
    <div class="row flex-row h-100 bg-white">
      <!-- Begin Left Content -->
      <div class="col-xl-8 col-lg-6 col-md-5 no-padding">
        <div class="elisyam-bg background-01">
          <div class="elisyam-overlay overlay-01"></div>
          <div class="authentication-col-content mx-auto">
            <h1 class="gradient-text-01">
              Welcome To Elisyam!
            </h1>
            <span class="description">
              Etiam consequat urna at magna bibendum, in tempor arcu fermentum vitae mi massa egestas. 
            </span>
          </div>
        </div>
      </div>
      <!-- End Left Content -->
      <!-- Begin Right Content -->
      <div class="col-xl-4 col-lg-6 col-md-7 my-auto no-padding">        
        <!-- Begin Form -->
        <div class="authentication-form mx-auto">
          <div class="logo-centered">
            <a href="db-default.html">
              <img src="<?= base_url('public/backend/assets/img/logo-angel.png') ?>" alt="logo">
            </a>
          </div>
            
          <!-- MAIN FORM" -->
          <?php $this->load->view($view) ?>
          <!-- END MAIN FORM" -->

        </div>
        
        <!-- End Form -->

    </div>
    <!-- End Right Content -->
  </div>
  <!-- End Row -->
</div>
<!-- End Container -->    

<!-- JAVASCRIPT -->
<?php $this->load->view('backend/includes/auth/_javascript') ?>
</body>
</html>