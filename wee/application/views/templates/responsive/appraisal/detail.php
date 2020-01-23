<style media="screen">
  .box {
  /* background: linear-gradient(#526494, #604484); */
  margin: 15px auto 0;
  border-radius: 5px;
  background-color: #3598dc;
  border-radius: 5px!important;
  /* width: 300px; */
  }

  .box__header {
  padding: 5px 25px;
  position: relative;
  }

  .box__header-title {
  color: rgb(94, 174, 230);
  font-size: 23px;
  }

  .box__body {
  padding: 0 25px;
  }

  /* STATS */

  .stats {
  color: #fff;
  position: relative;
  padding-bottom: 25px;
  }

  .stats__amount {
  font-size: 42px;
  font-weight: bold;
  line-height: 1.2;
  }

  .stats__caption {
  font-size: 18px;
  }

  .stats__change {
  position: absolute;
  bottom: 96px;
  right: 0;
  text-align: right;
  /* color: rgb(74, 162, 223); */
  color: rgb(205, 224, 236);
  }

  .stats__value {
  font-size: 18px;
  }

  .stats__period {
  font-size: 23px;
  }

  .stats__value--positive {
  color: #AEDC6F;
  }

  .stats__value--negative {
  color: #FB5055;
  }

  .stats--main .stats__amount {
  font-size: 27px;
  }
</style>

<div class="page-content-wrapper">
    <div class="page-content">

      <div class="page-bar">
          <ul class="page-breadcrumb">
              <li>
                  <a href="<?=base_url() ?>">Home</a>
                  <i class="fa fa-circle"></i>
              </li>
              <li>
                  <span>Penugasan</span>
                  <i class="fa fa-circle"></i>
              </li>
              <li>
                  <a href="<?=base_url() ?>mapping_appraisal/view">Data Customer</a>
                  <i class="fa fa-circle"></i>
              </li>
              <li>
                  <span>Detail</span>
              </li>
          </ul>
          <div class="page-toolbar">
              <div><?= tgl_indo(date('Y-m-d')) ?>
                  <i class="icon-calendar"></i>&nbsp;
                  <span class="thin uppercase hidden-xs"></span>&nbsp;
              </div>
          </div>
      </div>

      <?php if($this->session->flashdata("pesan")<>''){?>
        <div class="alert alert-<?php echo $this->session->flashdata("class");?> alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: #fff">&times;</button>
          <h5><i class="icon fa fa-check"></i> Pemberitahuan</h5>
          <h6><?php echo $this->session->flashdata("pesan");?></h6>
        </div>
      <?php }?>

      <div class="row" style="margin-top: 10px;">
        <div class="col-md-12">
          <div class="portlet light">

            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                  <a style="text-decoration: none" href="<?=base_url() ?>data-member/laporan/<?=$member->id_detail_kendaraan ?>">
                    <div class="box">
                      <div class="box__header">
                        <h3 class="box__header-title">
                          <i class="fa fa-pie-chart" title="Status Data"></i>
                        </h3>
                      </div>
                      <div class="box__body">
                        <div class="stats stats--main">
                          <div class="stats__amount">Laporan Inspeksi</div>
                          <div class="stats__caption" style="color: whitesmoke">
                            <i class="fa fa-user-md"></i> <?=$member->nama_member ?>
                          </div>
                          <div class="stats__change">
                            <div class="stats__period">
                              <?php
                                if (!empty($laporan)) {
                                  echo '<i class="fa fa-check-square" title="Laporan Tersedia"></i>';
                                }else {
                              ?>

                              <img src="<?=base_url() ?>assets/img/close_box_red.ico" title="Laporan Kosong" alt="docars" style="width: 20px; height: auto">

                              <?php } ?>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </a>

              </div>

              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <a style="text-decoration: none" href="<?=base_url() ?>data-member/dokumen/<?=$member->id_detail_kendaraan ?>">
                    <div class="box">
                      <div class="box__header">
                        <h3 class="box__header-title">
                          <i class="fa fa-camera"></i>
                        </h3>
                      </div>
                      <div class="box__body">
                        <div class="stats stats--main">
                          <div class="stats__amount">Upload Foto</div>
                          <div class="stats__caption">
                            <i class="fa fa-user-md"></i> <?=$member->nama_member ?>
                          </div>
                          <div class="stats__change">
                            <div class="stats__period">
                              <?php
                                if (!empty($file)) {
                                  echo '<i class="fa fa-check-square" title="Dokumen Tersedia"></i>';
                                }else {
                              ?>

                              <img src="<?=base_url() ?>assets/img/close_box_red.ico" title="Dokumen Kosong" alt="docars" style="width: 20px; height: auto">

                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>

              </div>



            </div>

          </div>
        </div>
      </div>







    </div>
  </div>




          <!-- tubagus aom -->
          <script>  </script>

          <script src="<?= base_url() ?>assets/global/scripts/datatable.js" type="text/javascript"></script>
          <script src="<?= base_url() ?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
          <script src="<?= base_url() ?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
          <!-- END PAGE LEVEL PLUGINS -->
          <!-- BEGIN THEME GLOBAL SCRIPTS -->
          <script src="<?= base_url() ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
          <!-- END THEME GLOBAL SCRIPTS -->
          <!-- BEGIN PAGE LEVEL SCRIPTS -->
          <script src="<?= base_url() ?>assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
