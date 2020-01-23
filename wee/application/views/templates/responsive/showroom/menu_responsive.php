<div id="mobile-menu-overlay"></div>

<div class="mobile-nav" style="background: #056798">
  <div class="mobile-nav-wrapper">

    <div class="header-container container" style="border-bottom: 1px solid whitesmoke;">
      <div class="header-row">
        <div class="header-column">
          <div class="header-logo" style=" padding-bottom: 10px">
            <a href="<?=base_url()?>">
              <img alt="<?=$aplikasi->nama_unit?>" width="86" height="50" src="<?=base_url().'uploads/logo.png'?>">
            </a>
          </div>
        </div>
      </div>
    </div>

    <ul class="mobile-side-menu">
      <li>
        <a href="<?=base_url()?>">
          <i class="fa fa-user" style="margin-right: 10px"></i> PROFIL
        </a>
      </li>

      <li>
        <a href="<?=base_url()?>mobil_tersedia">
            <i class="fa fa-car" style="margin-right: 10px"></i> MOBIL TERSEDIA
        </a>
      </li>

      <li>
        <a href="<?=base_url()?>favorit">
          <i class="fa fa-bookmark" style="margin-right: 10px"></i> FAVORIT
        </a>
      </li>

      <?php
       if ($bidding_favorit > 0) {
         $d_menu="block";
       }else {
         $d_menu="none";
       }
      ?>

      <li>
        <a style="display: <?=$d_menu ?>" href="<?=base_url()?>pelelangan/view">
          <span>
            <img style="width: 14px;margin-right: 10px" src="<?php echo base_url().'_assets/img/bidding_white.png' ?>" alt="<?=$aplikasi->nama_unit?>"> BIDDING
          </span>
        </a>
      </li>

      <li>
        <a href="<?=base_url()?>">
          <i class="fa fa-question-circle-o" style="margin-right: 10px"></i> BANTUAN
        </a>
      </li>

      <li>
        <a href="<?= base_url() . 'users/logout' ?>" title="Keluar">
          <i class="fa fa-sign-out" style="margin-right: 10px"></i> KELUAR
        </a>
      </li>

    </ul>
  </div>
</div>
