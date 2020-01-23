<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Foto Kendaraan</span>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Upload</span>
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

            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form enctype="multipart/form-data" action="<?= base_url() . 'simpan-dokumen' ?>" method="POST" class="form-horizontal form-bordered form-row-stripped">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Jenis Dokumen</label>
                            <div class="col-md-9">
                                <input type="hidden" name="id_detail_kendaraan" value="<?=$id_member ?>">
                                <input type="hidden" name="status_tkm" value="1">
                                <select name="id_jenis" class="form-control"  required>
                                  <option> - </option>
                                  <?php foreach ($jenis_komponen as $key => $jenis) { ?>
                                    <option value="<?=$jenis->id ?>"><?=$jenis->nama_jenis ?></option>
                                  <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"> Nama Dokumen</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-folder"></i>
                                </span>
                                <input name="nama_komponen"  required type="text" class="form-control" placeholder="Nama Dokumen"> </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">File</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-file"></i>
                                </span>
                                <input name="file_komponen" required type="file" class="form-control" placeholder="Browse File">
                                <!-- <br/> -->
                                <!-- <label style="color: red;font-weight: bold;">Maksimum Upload 20 MB</label> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Kondisi</label>
                            <div class="col-md-9">
                                <select name="kondisi_komponen" class="form-control">
                                  <option> - </option>
                                  <option value="0"> OK </option>
                                  <option value="1"> TIDAK </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Deskripsi Dokumen</label>
                            <div class="col-md-9">
                                <textarea name="keterangan_komponen" rows="4" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">
                                        <i class="fa fa-check"></i> Upload Dokumen
                                    </button>

                                    <a href="<?=base_url() . 'data-member/dokumen/' . $id_member ?>">
                                      <button type="button" class="btn yellow">
                                          <i class="fa fa-backward"></i> Kembali
                                      </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                </form>
              </div>
            </div>
                <!-- END FORM-->
          </div>

        </div>
      </div>

            <script src="<?= base_url() ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
            <script src="<?= base_url() ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
