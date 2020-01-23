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
                    <span>Laporan</span>
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

        <div class="portlet-body form">
            <!-- BEGIN FORM-->

            <?php if ($detail_kendaraan >= '0') { ?>

            <form enctype="multipart/form-data" action="<?= base_url() . 'simpan-laporan' ?>" method="POST" class="form-horizontal form-bordered form-row-stripped">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">No.Pol</label>
                        <div class="col-md-9">
                            <input type="hidden" name="id_member" value="<?=$id_member ?>">
                            <input value="<?=$detail_kendaraan->nopol_kendaraan ?>" type="text" class="form-control" name="nopol_kendaraan" placeholder="No.Pol Kendaraan">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"> Jenis Kendaraan</label>
                        <div class="col-md-9">
                            <input value="<?=$detail_kendaraan->jenis_kendaraan ?>" type="text" class="form-control" name="jenis_kendaraan" placeholder="Jenis Kendaraan">
                          </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Jumlah Tempat Duduk</label>
                        <div class="col-md-9">
                            <input value="<?=$detail_kendaraan->jumlah_bangku ?>" type="number" name="jumlah_bangku" placeholder="Jumlah Tempat Duduk" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Odometer</label>
                        <div class="col-md-9">
                            <input value="<?=$detail_kendaraan->spidometer_kendaraan ?>" type="number" name="spidometer_kendaraan" placeholder="Odometer" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Bahan Bakar</label>
                        <div class="col-md-9">
                            <input value="<?=$detail_kendaraan->bbm_kendaraan ?>" type="text" name="bbm_kendaraan" placeholder="Bahan Bakar" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Jumlah Kepemilikan</label>
                        <div class="col-md-9">
                            <input value="<?=$detail_kendaraan->jumlah_kepemilikan_kendaraan ?>" type="number" name="jumlah_kepemilikan_kendaraan" placeholder="Jumlah Kepemilikan" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Pajak Hidup</label>
                        <div class="col-md-9">
                            <select name="status_pajak_kendaraan" class="form-control">
                              <option <?= $detail_kendaraan->status_pajak_kendaraan == '0' ? 'selected' : ''; ?> value="0"> - </option>
                              <option <?= $detail_kendaraan->status_pajak_kendaraan == '1' ? 'selected' : ''; ?> value="1">YA</option>
                              <option <?= $detail_kendaraan->status_pajak_kendaraan == '2' ? 'selected' : ''; ?> value="2">TIDAK</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3"> Pajak Di Tanggung Penjual</label>
                        <div class="col-md-9">
                            <select name="pajak_ditanggung_kendaraan" class="form-control">
                              <option <?= $detail_kendaraan->pajak_ditanggung_kendaraan == '0' ? 'selected' : ''; ?> value="0"> - </option>
                              <option <?= $detail_kendaraan->pajak_ditanggung_kendaraan == '1' ? 'selected' : ''; ?> value="1">YA</option>
                              <option <?= $detail_kendaraan->pajak_ditanggung_kendaraan == '2' ? 'selected' : ''; ?> value="2">TIDAK</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Asuransi</label>
                        <div class="col-md-9">

                            <select name="asuransi_kendaraan" class="form-control">
                              <option <?= $detail_kendaraan->asuransi_kendaraan == '0' ? 'selected' : ''; ?> value="0"> - </option>
                              <option <?= $detail_kendaraan->asuransi_kendaraan == '1' ? 'selected' : ''; ?> value="1">YA</option>
                              <option <?= $detail_kendaraan->asuransi_kendaraan == '2' ? 'selected' : ''; ?> value="2">TIDAK</option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Pengajuan Harga</label>
                        <div class="col-md-9">

                          <?php
                            function rupiah($angka){
                            	$hasil_rupiah = number_format($angka,0,',','.');
                            	return $hasil_rupiah;
                            }

                            $harga_awal=rupiah($detail_kendaraan->harga_awal);
                          ?>

                            <input id="rupiah" type="text" name="harga_awal" value="<?=$harga_awal ?>" placeholder="Harga Awal" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Catatan</label>
                        <div class="col-md-9">
                            <textarea name="catatan_kendaraan" rows="4" class="form-control"> <?=$detail_kendaraan->catatan_kendaraan ?></textarea>
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">
                                    <i class="fa fa-check"></i> Simpan Laporan
                                </button>

                                <a href="<?=base_url() . 'data-member/detail/' . $id_member ?>">
                                  <button type="button" class="btn yellow">
                                      <i class="fa fa-backward"></i> Kembali
                                  </button>
                                </a>
                            </div>
                        </div>
                    </div>
            </form>

            <?php } ?>
          </div>
        </div>
            <!-- END FORM-->
      </div>

    </div>
  </div>

  <script type="text/javascript">
  var rupiah = document.getElementById('rupiah');
  rupiah.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    rupiah.value = formatRupiah(this.value, 'Rp. ');
  });

  /* Fungsi formatRupiah */
  function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
  }
  </script>




            <!-- tubagus aom -->
