<link href="<?= base_url() ?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />

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
                  <span>Data Customer</span>
              </li>
          </ul>
          <div class="page-toolbar">
              <div><?= tgl_indo(date('Y-m-d')) ?>
                  <i class="icon-calendar"></i>&nbsp;
                  <span class="thin uppercase hidden-xs"></span>&nbsp;
              </div>
          </div>
      </div>



      <div class="row" style="margin-top: 10px;">
          <div class="col-md-12">
              <!-- BEGIN EXAMPLE TABLE PORTLET-->
              <div class="portlet light bordered">
                  <div class="portlet-title">
                      <div class="caption font-dark col-md-6">
                          <i class="icon-docs font-dark"></i>
                          <span class="caption-subject bold uppercase"> Data Customer</span>
                      </div>


                  </div>
                  <div class="portlet-body table-responsive">

                      <table class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th style="text-align: center" width="5%"> No </th>
                              <th> Nama </th>
                              <th> No. HP </th>
                              <!-- <th> Email </th> -->
                              <th> No.Pol </th>
                              <th> Tahun </th>
                              <th> Merek </th>
                              <th> Model </th>
                              <th> Transmisi </th>
                              <th> Status </th>
                              <th style="text-align: center"> - </th>
                            </tr>
                          </thead>

                          <tbody>
                            <?php
                              $no=1;
                              foreach ($data_mapping as $key => $penugasan) {
                            ?>
                            <tr class="odd gradeX">
                              <td style="text-align: center"><?=$no ?>.</td>
                              <td><?=$penugasan->nama_member ?></td>
                              <td><?=$penugasan->no_hp_member ?></td>
                              <!-- <td><?=$penugasan->email_member ?></td> -->
                              <td><?=$penugasan->nopol_kendaraan ?></td>
                              <td><?=$penugasan->tahun_mobil ?></td>
                              <td><?=$penugasan->merek_mobil ?></td>
                              <td><?=$penugasan->model_mobil ?></td>
                              <td><?=$penugasan->transmisi_mobil ?></td>
                              <td>
                                <?php
                                  $status=$penugasan->status_lelang;
                                  if ($status == 1) {
                                    echo "Lelang";
                                  }elseif ($status == 2) {
                                    echo "Selesai";
                                  }else {
                                    echo "-";
                                  }
                                ?>
                              </td>
                              <td style="text-align: center">
                                <a href="<?= base_url() . 'data-member/detail/' . $penugasan->id_member ?>"> Detail</a>
                              </td>
                            </tr>
                            <?php $no++;} ?>
                          </tbody>

                      </table>
                  </div>
              </div>
              <!-- END EXAMPLE TABLE PORTLET-->
          </div>
      </div>

    </div>
</div>



<script src="<?= base_url() ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
