<!DOCTYPE html>
<html>
	<head>

		<title>
			<?php
				// $aplikasi->nama_unit;
			?>
			Weeding - Tera_Byte_
		</title>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

		<meta name="keywords" content="Nikah, nikah, Weeding, wedding, Website Wedding, website wedding , undangan , buat undangan online , buat undangan , undangan online"/>
		<meta name="description" content="Weeding - Tera Byte">
		<meta name="author" content="tera-byte.name">

		<!-- Favicon -->
		<link rel="shortcut icon" href="<?=base_url()?>_assets/img/tb-touch-icon.png" type="image/x-icon" />
		<link rel="apple-touch-icon" href="<?=base_url().'_assets/img/tb-touch-icon.png'?>">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CGreat+Vibes" rel="stylesheet" type="text/css">

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
		<link rel="stylesheet" href="<?=base_url()?>_assets/css/skins/skin-wedding.css">

		<!-- Demo CSS -->
		<link rel="stylesheet" href="<?=base_url()?>_assets/css/demos/demo-wedding.css">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="<?=base_url()?>_assets/css/custom.css">

		<script src="<?=base_url()?>assets/js/jquery.min.js"></script>
		<script type="text/javascript">
		var base_url = "<?php echo base_url() ?>";
		</script>
		<script src="<?php echo base_url() ?>assets/js/public/login.js" type="text/javascript"></script>
    	<script type="text/javascript">
		function login_click(){
		    $('#btn-login').click();
		}
		</script>

		<?php
			// foreach($adsense_top as $key=>$ads){
			// 	$script_ads=$ads->script_adsense;
			// 	$s_ads=substr($script_ads,1,5);
			//
			// 	if ($s_ads == "scrip" OR $s_ads == "style") {
			// 		$tagopen='';
			// 		$script=$ads->script_adsense;
			// 		$tagclose='';
			// 	}else {
			// 		$tagopen='<script type="text/javascript">';
			// 		$script='tubagus.aom.swk@gmail.com';
			// 		$tagclose='</script>';
			// 	}
			// 	echo "$tagopen $script $tagclose";
			// }
		?>

		<style media="screen" type="text/css">
		 #backgroundaudio {
		  display: block;
		  position: fixed;
		  bottom: 0px;
		  left: 5px;
		  -webkit-transition: all 1s ease-in-out;
		  -moz-transition: all 1s ease-in-out;
		  -ms-transition: all 1s ease-in-out;
		  -o-transition: all 1s ease-in-out;
		  transition: all 1s ease-in-out;
		  z-index:1000;
		 }
		 #backgroundaudio:hover {
		  bottom: 0;
		  -webkit-transition: all 1s ease-in-out;
		  -moz-transition: all 1s ease-in-out;
		  -ms-transition: all 1s ease-in-out;
		  -o-transition: all 1s ease-in-out;
		  transition: all 1s ease-in-out;
		 }
		 #backgroundaudio audio {
			border-radius: 5px;
		  background: #ffffff;
		  padding: 2px;
		  display: table-cell;
		  vertical-align: middle;
		  height: 30px;
		  z-index: 9998;
		 }
		 #backgroundaudio i {
		  font-size: 30px;
		  display: block;
		  background: #ffffff;
		  padding: 5px;
		  width: 50px;
		  float: none;
		  margin-bottom: -1px;
		  z-index: 9999;
		 }
		</style>


		<!-- <script type="text/javascript" src="<?=base_url()?>_assets/js/custom.js"
		data-config="{'skin':'https://static.tumblr.com/su8juwr/OBMmp2h7u/cora____o.css','volume':50,'autoplay':true,'shuffle':true,'repeat':1,'placement':'bottom','showplaylist':false,'playlist':[{'title':'Marry Your Daughter','url':'http://wtb.indonesia-kompeten.com/assets/files/audio/marry_your_daughter.mp3'}]}" ></script> -->
	</head>
	
	<div id="backgroundaudio">
	 <audio id="audioId" controls>
		<source src="<?=base_url()?>assets/files/audio/marry_your_daughter.mp3" type="audio/mp3"></source>
	 </audio>

	 <!-- <audio src="<?=base_url()?>assets/files/audio/marry_your_daughter.mp3" controls autoplay="true" loop="true" preload></audio> -->
	</div>

	<body data-target="#header" data-spy="scroll" data-offset="100">

		<div class="body">
		<header id="header" class="header-narrow" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 84, 'stickySetTop': '-70px'}">
      <?php $this->load->view("templates/bootstraps/menu"); ?>
    </header>

		<style media="screen">
			.modal-tb {
				display: none;
				position: fixed;
				z-index: 1050;
				padding-top: 25px;
				left: 0;
				top: 0;
				width: 100%;
				height: 100%;
				overflow: auto;
				background-color: rgb(0,0,0);
				background-color: rgba(0,0,0,0.8);
			}

			.modal-content-tb {
				width: 90%;
 			  padding: 20px;
 			  background: #FFF;
 			  max-width: 600px;
 			  margin: auto;
 			  position: relative;
 			  border-radius: 5px;
 			  box-shadow: 0 0 6px rgba(0, 0, 0, 0.2);

				-webkit-animation: modal-content-tb 0.7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
	        animation: modal-content-tb 0.7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
			}

			.modal-head-tb {
    			border-bottom: 1px solid #e5e5e5;
			}
			.head-title-tb{
				font-size: 2em;
		    font-weight: 400;
		    line-height: 30px;
			}

			.modal-main-tb {padding: 5px 16px;}

			.modal-foot-tb {
				padding: 15px 15px 5px 0;
		    text-align: right;
		    border-top: 1px solid #e5e5e5;
			}

			@-webkit-keyframes modal-content-tb {
			  0% {
			    -webkit-transform: translateY(-600px) rotateX(-30deg) scale(0);
			            transform: translateY(-600px) rotateX(-30deg) scale(0);
			    -webkit-transform-origin: 50% 100%;
			            transform-origin: 50% 100%;
			    opacity: 0;
			  }
			  100% {
			    -webkit-transform: translateY(0) rotateX(0) scale(1);
			            transform: translateY(0) rotateX(0) scale(1);
			    -webkit-transform-origin: 50% 1400px;
			            transform-origin: 50% 1400px;
			    opacity: 1;
			  }
			}
			@keyframes modal-content-tb {
			  0% {
			    -webkit-transform: translateY(-600px) rotateX(-30deg) scale(0);
			            transform: translateY(-600px) rotateX(-30deg) scale(0);
			    -webkit-transform-origin: 50% 100%;
			            transform-origin: 50% 100%;
			    opacity: 0;
			  }
			  100% {
			    -webkit-transform: translateY(0) rotateX(0) scale(1);
			            transform: translateY(0) rotateX(0) scale(1);
			    -webkit-transform-origin: 50% 1400px;
			            transform-origin: 50% 1400px;
			    opacity: 1;
			  }
			}

			.close-tb {
				color: #aaaaaa;
				float: right;
				font-size: 28px;
				font-weight: bold;
			}

			.close-tb:hover, .close-tb:focus {
				color: #000;
				text-decoration: none;
				cursor: pointer;
			}
		</style>

		<!-- Deklarasi Modal -->
		<div id="TeraByteModal" class="modal-tb">
		  <!-- Konten Modal -->
		  <div class="modal-content-tb">

			<div class="modal-head-tb">
				<span class="close-tb">&times;</span>
				<h6 class="head-title-tb">Login</h6>
			</div>
			<div class="modal-main-tb">
				<div class="form-group">
					<div class="row">
						<div class="col-xs-3">
							<label class="control-label labeled-form" for="inputUsername">Username</label>
						</div>
						<div class="col-xs-9 tooltip-wide">
							<div class="input-group merged">
							   <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user fa-xs"></i></span>
							   <input type="text" class="form-control login-control" aria-describedby="basic-addon1" name="inputUsername" id="inputUsername" onKeyup="checkinput()">
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-xs-3">
							<label class="control-label labeled-form" for="inputPassword">Password</label>
						</div>
						<div class="col-xs-9 tooltip-wide">
							<div class="input-group merged">
							  <span class="input-group-addon" id="basic-addon2"><i class="fa fa-key fa-xs"></i></span>
							  <input type="password" class="form-control login-control" aria-describedby="basic-addon2" name="inputPassword" id="inputPassword" onkeypress="if(event.keyCode==13) login_click();" onKeyup="checkinput()">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-foot-tb">
				<button type="button" class="btn btn-warning" id="btntbclose">Close</button>
				<button type="button" class="btn btn-primary" id="btn-login">Login</button>
			</div>

		  </div>
		</div>

		<script type="text/javascript">

		function checkinput(){
			var bt = document.getElementById('btn-login');
        if (inputUsername.value != '' && inputPassword.value != '') {
            bt.disabled = false;
        }
        else {
            bt.disabled = true;
        }
		}

			// Panggil Elemen Modal-nya
			var modalTB = document.getElementById('TeraByteModal');

			// Panggil Elemen Button-nya
			var btnTB = document.getElementById("TeraByteButton");

			// Panggil Elemen Close-nya, untuk mensimulasikan efek tutup
			var spanTB = document.getElementsByClassName("close-tb")[0];
			var btnTBclose = document.getElementById("btntbclose");

			// Saat Pengguna Menekan Button, Lakukan Pemanggilan Modal
			btnTB.onclick = function() {
				modalTB.style.display = "block";
			}

			// Saat Pengguna Menekan Tombol X (close), simulasikan efek tutup
			spanTB.onclick = function() {
				modalTB.style.display = "none";
			}
			btnTBclose.onclick = function() {
				modalTB.style.display = "none";
			}

			// Saat Pengguna menekan sesuatu, diluar dari modal, simulasikan efek tutup
			window.onclick = function(event) {
				if (event.target == modalTB) {
					modalTB.style.display = "none";
				}
			}
		</script>
