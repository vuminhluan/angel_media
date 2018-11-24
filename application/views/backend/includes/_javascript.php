
<script>
	var baseUrl = "<?= base_url() ?>";
</script>
<script src="<?= base_url('public/backend/assets/vendors/js/base/jquery.min.js') ?>"></script>
<script src="<?= base_url('public/backend/assets/vendors/js/base/core.min.js') ?>"></script>


<script src="<?= base_url('public/backend/assets/vendors/js/nicescroll/nicescroll.min.js') ?>"></script>
<script src="<?= base_url('public/backend/assets/vendors/js/chart/chart.min.js') ?>"></script>
<script src="<?= base_url('public/backend/assets/vendors/js/progress/circle-progress.min.js') ?>"></script>
<script src="<?= base_url('public/backend/assets/vendors/js/calendar/moment.min.js') ?>"></script>
<script src="<?= base_url('public/backend/assets/vendors/js/calendar/fullcalendar.min.js') ?>"></script>
<script src="<?= base_url('public/backend/assets/vendors/js/owl-carousel/owl.carousel.min.js') ?>"></script>
<script src="<?= base_url('public/backend/assets/vendors/js/noty/noty.min.js') ?>"></script>
<script src="<?= base_url('public/backend/assets/vendors/js/app/app.js') ?>"></script>


<script src="<?= base_url('public/backend/assets/js/dashboard/db-default.js') ?>"></script>
<script src="<?= base_url('tinymce/tinymce.min.js') ?>"></script>
<script src="<?= base_url('public/backend/assets/plugins/fancybox/dist/jquery.fancybox.js') ?>"></script>

<!-- Datatable JS -->
<script src="<?= base_url('public/backend/assets/vendors/js/datatables/datatables.min.js') ?>"></script>
<script src="<?= base_url('public/backend/assets/vendors/js/datatables/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('public/backend/assets/vendors/js/datatables/dataTables.buttons.min.js') ?>"></script>

<?php
	!empty($js_file) ? $this->load->view($js_file) : ''
?>

<script src="<?= base_url('public/backend/assets/js/backend/backend.js') ?>"></script>