<div class="header-top">
  <div class="container">
      <?php
        $foto = ($this->auth->get_user_data()->foto_profil != "") ? $this->auth->get_user_data()->foto_profil : 'icon-user-white.png';
      ?>

      <div class="header-dropdown cur-dropdown" style="float: right;">
        <a href="<?= base_url() . 'users/logout' ?>" title="Keluar">
          <i class="fa fa-sign-out"></i>
        </a>
      </div>

      <div class="header-dropdown cur-dropdown" style="float: right;">
        <a href="#">
          <img src="<?= base_url() ?>assets/img/<?= $foto ?>" alt="<?=$aplikasi->nama_unit?>"><?= $this->auth->get_user_data()->nama_user ?> <i class="fa fa-caret-down"></i>
        </a>

        <ul class="header-dropdownmenu">
          <li>
              <a href="<?= base_url() . 'users/logout' ?>">
                  <i class="fa fa-sign-out"></i> Keluar </a>
          </li>
        </ul>
      </div>


      <p class="welcome-msg">
        <i class="icon-calendar"></i>&nbsp;
        <span id="date_time"></span>
        <!-- <font id="jam"></font> :
        <font id="menit"></font> :
        <font id="detik"></font> -->
        <span class="thin uppercase hidden-xs"></span>&nbsp;
      </p>
  </div>


</div>

<div class="header-container container">
  <div class="header-row">
    <div class="header-column">
      <div class="header-logo">
        <a href="<?=base_url()?>">
          <img alt="<?=$aplikasi->nama_unit?>" width="116" height="74" src="<?=base_url().'uploads/logo.png'?>">
        </a>
      </div>
    </div>
    <div class="header-column">
      <div class="row">
        <a href="#" class="mmenu-toggle-btn" title="Toggle menu">
          <i class="fa fa-bars"></i>
        </a>
      </div>
    </div>
  </div>
</div>

<div class="header-container header-nav header-nav-center">
  <div class="container">

    <div class="header-nav-main">
      <nav>
        <ul class="nav nav-pills" id="mainNav">
            <li>
              <a href="<?=base_url()?>">
                <i class="fa fa-user"></i> PROFIL
              </a>
            </li>

          <li class="<?= $this->uri->segment(1) == 'home' || $this->uri->segment(1) == 'mobil_tersedia' ? 'active' : '' ?>">
            <a href="<?=base_url()?>mobil_tersedia">
                <i class="fa fa-car"></i> MOBIL TERSEDIA
            </a>
          </li>
          <li class="<?= $this->uri->segment(1) == 'favorit' ? 'active' : '' ?>">
            <a href="<?=base_url()?>favorit">
              <i class="fa fa-bookmark"></i> FAVORIT
            </a>
          </li>

           <?php
            if ($bidding_favorit > 0) {
              $d_menu="block";
            }else {
              $d_menu="none";
            }
           ?>

          <li class="<?= $this->uri->segment(1) == 'pelelangan' ? 'active' : '' ?>">
            <a style="display: <?=$d_menu ?>" href="<?=base_url()?>pelelangan/view">
              <span>
                <img style="width: 13px" src="<?php echo base_url().'_assets/img/bidding_white.png' ?>" alt="<?=$aplikasi->nama_unit?>"> BIDDING
              </span>
            </a>
          </li>

          <li>
            <a href="<?=base_url()?>">
              <i class="fa fa-question-circle-o"></i> BANTUAN
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</div>
