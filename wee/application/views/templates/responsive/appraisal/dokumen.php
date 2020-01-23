


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
                    <span>Dokumen</span>
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
                <div class="portlet light">

                    <div class="row portlet-title">
                        <div class="caption font-dark col-md-6">
                            <i class="icon-camera font-dark"></i>
                            <span class="caption-subject bold uppercase"> Dokumen Kendaraan</span>
                        </div>
                        <div class="col-md-6">
                            <a href="<?= base_url() . 'data-member/tambah-dokumen/' . $id_member ?>" style="float: right;" id="sample_editable_1_new" class="btn sbold green"> Add New
                                <i class="icon-plus"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-12" style="padding:5px">

                      <?php foreach ($jenis_komponen as $key => $value) { ?>

                      <div class="row">
                          <div class="mt-element-ribbon bg-grey-steel">
                              <div class="ribbon ribbon-round ribbon-color-primary ribbon-shadow uppercase"><?=$value->nama_jenis ?></div>
                              <div class="ribbon-content table-responsive">
                                <!-- <p style="color: red;font-weight: bold;">Foto mobil tampak depan</p> -->

                                <div class="clearfix" style="margin-bottom: 10px;"></div>

                                <table class="table table-bordered table-hover" style="background-color: #fff;">
                                  <thead>
                                    <tr class="warning">
                                        <th>Foto</th>
                                        <th width="30%">Nama</th>
                                        <th>Kondisi</th>
                                        <th width="50%">Keterangan</th>
                                        <th width="15%" style="text-align: center;">-</th>
                                      </tr>
                                    </thead>

                                    <tbody>
                                      <?php
                                        $no=1;
                                        foreach ($file_komponen as $key => $file) {
                                          if ($file->id_jenis == $value->id) {
                                      ?>
                                      <tr>
                                        <td>

                                          <img data-toggle="modal" data-target="#myModal<?=$no?>" id="myImg" src="<?= base_url() . 'assets/files/member/' . $file->file_komponen ?>" alt="<?=$file->nama_komponen ?>" style="width: 100px; height: auto;cursor: pointer">

                                          <div id="myModal<?=$no?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                              <div class="modal-content">
                                                  <div class="modal-body">
                                                      <img src="<?= base_url() . 'assets/files/member/' . $file->file_komponen ?>" class="img-responsive">
                                                  </div>
                                              </div>
                                            </div>
                                          </div>

                                        </td>
                                        <td><?=$file->nama_komponen ?></td>
                                        <td style="text-align: center">
                                          <?php
                                            $kondisi=$file->kondisi_komponen;

                                            if ($kondisi == "0") {
                                              echo '<i class="fa fa-check" style="color: green"></i>';
                                            }else {
                                              echo '<i class="fa fa-close" style="color: red"></i>';
                                            }
                                          ?>
                                        </td>
                                        <td><?=$file->keterangan_komponen ?></td>
                                        <td align="center">
                                          <a title="Hapus" href="<?= base_url() . 'bukti_pendukung/hapus/' . $jportofolio['id'] ?>">
                                            <button type="submit" class="btn btn-sm red" style="border-radius: 5px!important">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                          </a>
                                          <!-- | -->
                                          <a title="Edit" href="<?= base_url() . 'bukti_pendukung/edit/' . $jportofolio['id'] ?>">
                                            <button type="submit" class="btn btn-sm yellow" style="border-radius: 5px!important">
                                                <i class="icon-pencil"></i>
                                            </button>
                                          </a>
                                        </td>
                                      </tr>
                                    <?php }$no++;} ?>
                                    </tbody>
                                  </table>

                              </div>
                          </div>
                      </div>

                    <?php } ?>

                </div>
            </div>
        </div>

  </div>
</div>
