<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?= !empty($title) ? $title : 'Chưa có tiêu đề' ?></title>
<meta name="description" content="Elisyam is a Web App and Admin Dashboard Template built with Bootstrap 4">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Google Fonts -->
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
<script>
  WebFont.load({
	google: {"families":["Montserrat:400,500,600,700","Noto+Sans:400,700"]},
	active: function() {
		sessionStorage.fonts = true;
	}
});
</script>
<!-- Favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('public/backend/assets/img/favicon-angel.png') ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('public/backend/assets/img/favicon-angel.png') ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('public/backend/assets/img/favicon-angel.png') ?>">
<!-- Stylesheet -->
<link rel="stylesheet" href="<?= base_url('public/backend/assets/vendors/css/base/bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('public/backend/assets/vendors/css/base/elisyam-1.5.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('public/backend/assets/css/animate/animate.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('public/backend/assets/css/backend/backend.css') ?>">
		<!-- Tweaks for older IEs--><!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->