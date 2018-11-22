
<script src="<?= base_url('public/backend/assets/vendors/js/base/jquery.min.js') ?>"></script>
<script src="<?= base_url('public/backend/assets/vendors/js/base/core.min.js') ?>"></script>


<script src="<?= base_url('public/backend/assets/vendors/js/nicescroll/nicescroll.min.js') ?>"></script>
<script src="<?= base_url('public/backend/assets/vendors/js/noty/noty.min.js') ?>"></script>
<script src="<?= base_url('public/backend/assets/vendors/js/app/app.min.js') ?>"></script>
<script src="<?= base_url('public/backend/assets/js/backend/backend.js') ?>"></script>

<?php !empty($js_file) ? $this->load->view($js_file) : ''?>

