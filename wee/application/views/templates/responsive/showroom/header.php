<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?=$aplikasi->nama_unit?> - Showroom</title>

		<meta name="keywords" content="Docars, DOCARS, Jual Beli, Jual Beli Mobil" />
		<meta name="description" content="Jual beli mobil dengan penawaran harga tertinggi">
		<meta name="author" content="https://www.instagram.com/tera_byt3_/">

    <!-- Favicon -->
		<link rel="shortcut icon" href="<?=base_url()?>favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="<?=base_url().'uploads/logo.png'?>">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?=base_url()?>_assets/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?=base_url()?>_assets/vendor/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?=base_url()?>_assets/vendor/animate/animate.min.css">
		<link rel="stylesheet" href="<?=base_url()?>_assets/vendor/simple-line-icons/css/simple-line-icons.min.css">
		<link rel="stylesheet" href="<?=base_url()?>_assets/vendor/owl.carousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="<?=base_url()?>_assets/vendor/owl.carousel/assets/owl.theme.default.min.css">
		<link rel="stylesheet" href="<?=base_url()?>_assets/vendor/magnific-popup/magnific-popup.min.css">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?=base_url()?>_assets/css/theme.css">
		<link rel="stylesheet" href="<?=base_url()?>_assets/css/theme-elements.css">
		<link rel="stylesheet" href="<?=base_url()?>_assets/css/theme-blog.css">
		<link rel="stylesheet" href="<?=base_url()?>_assets/css/theme-shop.css">

		<!-- Current Page CSS -->
		<link rel="stylesheet" href="<?=base_url()?>_assets/vendor/rs-plugin/css/settings.css">
		<link rel="stylesheet" href="<?=base_url()?>_assets/vendor/rs-plugin/css/layers.css">
		<link rel="stylesheet" href="<?=base_url()?>_assets/vendor/rs-plugin/css/navigation.css">

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?=base_url()?>_assets/css/skins/skin-shop-4.css">

		<!-- Demo CSS -->
		<link rel="stylesheet" href="<?=base_url()?>_assets/css/demos/demo-shop-4.css">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?=base_url()?>_assets/css/custom.css">

		<!-- Head Libs -->
		<script src="<?=base_url()?>_assets/vendor/modernizr/modernizr.min.js"></script>
		<?php date_default_timezone_set('Asia/Jakarta'); ?>

	</head>
	<body>

		<div class="body">
			<header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyStartAt': 147, 'stickySetTop': '-147px', 'stickyChangeLogo': false}">
				<div class="header-body">
          <?php $this->load->view("templates/responsive/showroom/menu"); ?>
				</div>
			</header>

			<?php $this->load->view("templates/responsive/showroom/menu_responsive.php"); ?>
