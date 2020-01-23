<link href="<?=base_url()?>_assets/galery/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="<?=base_url()?>_assets/galery/bootstrap.min.js"></script>
<script src="<?=base_url()?>_assets/galery/jquery-1.11.1.min.js"></script>

<style media="screen">
@media (max-width: 700px) {
  .tb-image-popup{
    height: 100%;
  }
}

@media (min-width: 701px) {
  .tb-image-popup{
    height: 450px;
  }
}

</style>

<div class="container">
  <div class="product-view">
    <div class="product-essential">

      <aside class="sidebar shop-sidebar" style="padding-top:30px">
				<div class="panel-group">
          <div class="panel panel-default">

            <?php if($this->session->flashdata('result')!=''){ ?>

                <div class="alert alert-<?=$this->session->flashdata('mode_alert')?>" role="alert" id="Div-Alert">
                  <button class="close" onclick="hide('Div-Alert')">×</button>
                  <?php echo $this->session->flashdata('result'); ?>
                </div>

            <?php } ?>

            <div class="panel-heading">
              <h4 class="panel-title">
                <a class="accordion-toggle collapsed" data-toggle="collapse" href="#panel-cart-discount">

                        <div class="toolbar mb-none">
            							<div class="sorter">
            								<div class="sort-by">
                              <label id="date_time1" style="font-weight: 700; color:#777;"></label>
            								</div>

            								<div class="limiter">
                              <label style="font-weight: 700">FILTER</label>
            								</div>
            							</div>
            						</div>

                </a>
              </h4>
            </div>

      <div class="panel-body col-md-12" style="padding-top:5px">
        <div class="product-img-box col-sm-5">
          <div class="product-img-box-wrapper">
            <a href="#" class="product-img-zoom" style="cursor: zoom-in!important" title="Zoom">
            <div class="product-img-wrapper">
              <img id="product-zoom" src="<?=base_url()?>assets/files/member/<?=$mobil_favorit->file_komponen?>" data-zoom-image="<?=base_url()?>assets/files/member/<?=$mobil_favorit->file_komponen?>" alt="<?=$aplikasi->nama_unit?>">
            </div>

            <!-- <a href="#" class="product-img-zoom" title="Zoom">
              <span class="glyphicon glyphicon-search"></span> -->
            </a>
          </div>

          <div class="owl-carousel manual" id="productGalleryThumbs">

            <div class="product-img-wrapper">
              <a style="cursor: not-allowed!important" href="#" data-image="<?=base_url()?>assets/files/member/<?=$mobil_favorit->file_komponen?>" data-zoom-image="<?=base_url()?>assets/files/member/<?=$mobil_favorit->file_komponen?>" class="product-gallery-item">
                <img src="<?=base_url()?>assets/files/member/<?=$mobil_favorit->file_komponen?>" alt="<?=$aplikasi->nama_unit?>" style="height: 68px">
              </a>
            </div>

            <?php
              foreach ($dokumen_mobil as $key => $dokumen) {
            ?>
            <div class="product-img-wrapper">
              <a style="cursor: not-allowed!important" href="#" data-image="<?=base_url()?>assets/files/member/<?=$dokumen->file_komponen?>" data-zoom-image="<?=base_url()?>assets/files/member/<?=$dokumen->file_komponen?>" class="product-gallery-item">
                <img src="<?=base_url()?>assets/files/member/<?=$dokumen->file_komponen?>" alt="<?=$aplikasi->nama_unit?>" style="height: 68px">
              </a>
            </div>
            <?php
              }
            ?>

          </div>
        </div>

        <form action="<?=base_url()?>pelelangan/bidding" method="post">
          <div class="product-details-box col-sm-7">
            <h1 class="product-name">
              <?="$mobil_favorit->tahun_mobil $mobil_favorit->merek_mobil $mobil_favorit->model_mobil $mobil_favorit->transmisi_mobil"?>
            </h1>

            <div class="product-detail-info">
              <div class="product-price-box">
                <span class="product-price">Rp. <?=number_format($mobil_favorit->harga_kendaraan,0,',','.') ?></span>
              </div>
            </div>

            <?php
              $jam_awal=$mobil_favorit->jam_awal;
              $jam_akhir=$mobil_favorit->jam_akhir;
              $jam_sekarang=date("H:i:s");

              // if ($jam_sekarang > $jam_akhir) {
              //   $xxxx="Berakhir";
              // }elseif ($jam_sekarang >= $jam_awal) {
              //   $xxxx="Dimulai";
              // }else {
              //   $xxxx="Belum Dimulai";
              // }

              if ($jam_sekarang > $jam_akhir) {
                $xxxx="Berakhir";
                $display="block";
              }elseif ($jam_sekarang >= $jam_awal) {
                $xxxx="Bidding Dimulai";
                $display="none";

            ?>

            <div id="b1dd1ng">
              <?php
                $this->load->view("templates/responsive/showroom/bidding");
              ?>
            </div>

            <?php
              }else {
                $xxxx="Belum Dimulai";
                $display="block";
              }
            ?>

        </div>
        </form>

      </div>

      </div>
    </div>
  </aside>



      <div class="row" style="display: <?=$display ?>">
        <aside class="sidebar shop-sidebar">
          <div class="col-md-12 panel-group" style="padding-top:30px">

            <div class="tabs product-tabs">
              <ul class="nav nav-tabs">
                <li class="col-12 active">
                  <a href="#product-detail" data-toggle="tab">DETAIL KENDARAAN</a>
                </li>
                <li class="col-12">
                  <a href="#product-inpeksi" data-toggle="tab">HASIL INPEKSI</a>
                </li>
                <li class="col-12">
                  <a href="#product-kerusakan" data-toggle="tab">FOTO KERUSAKAN</a>
                </li>
              </ul>

              <div class="panel-body tab-content">
                <div id="product-detail" class="tab-pane active">
                  <table class="product-table">
                    <tbody>
                      <tr>
                        <td class="table-label">No Pol</td>
                        <td><?=$mobil_favorit->nopol_kendaraan ?></td>
                      </tr>
                      <tr>
                        <td class="table-label">Jenis</td>
                        <td><?=$mobil_favorit->jenis_kendaraan ?></td>
                      </tr>
                      <tr>
                        <td class="table-label">Jumlah Bangku</td>
                        <td><?=$mobil_favorit->jumlah_bangku ?></td>
                      </tr>
                      <tr>
                        <td class="table-label">Spidometer</td>
                        <td><?=$mobil_favorit->spidometer_kendaraan ?></td>
                      </tr>
                      <tr>
                        <td class="table-label">Bahan Bakar</td>
                        <td><?=$mobil_favorit->bbm_kendaraan ?></td>
                      </tr>
                      <tr>
                        <td class="table-label">Kepemilikan Kendaraan</td>
                        <td>Ke- <?=$mobil_favorit->jumlah_kepemilikan_kendaraan ?></td>
                      </tr>
                      <tr>
                        <td class="table-label">Pajak</td>
                        <td>
                          <?php
                            $pajak=$mobil_favorit->status_pajak_kendaraan;

                            if ($pajak == "1") {
                              echo "Hidup";
                            }elseif ($pajak == "2") {
                              echo "Mati";
                            }else {
                              echo "-";
                            }
                          ?>
                        </td>
                      </tr>
                      <tr>
                        <td class="table-label">Pajak ditanggung</td>
                        <td>
                          <?php
                            $status_pajak=$mobil_favorit->pajak_ditanggung_kendaraan;

                            if ($status_pajak == "1") {
                              echo "YA";
                            }elseif ($status_pajak == "2") {
                              echo "TIDAK";
                            }else {
                              echo "-";
                            }
                          ?>
                        </td>
                      </tr>
                      <tr>
                        <td class="table-label">Asuransi</td>
                        <td>
                          <?php
                            $asuransi=$mobil_favorit->asuransi_kendaraan;

                            if ($asuransi == "1") {
                              echo "YA";
                            }elseif ($asuransi == "2") {
                              echo "TIDAK";
                            }else {
                              echo "-";
                            }
                          ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <div id="product-inpeksi" class="tab-pane">
                  <div class="product-desc-area">
											<p><?=$mobil_favorit->catatan_kendaraan ?></p>
										</div>
                </div>

                <div id="product-kerusakan" class="tab-pane">

                <!-- <div id="product-kerusakan" class="tab-pane"> -->

                    <?php $no_id=0; foreach ($foto_kerusakan as $key => $kerusakan) { ?>
                    <div class="product-desc-area col-md-3" style="padding-top: 10px">
                      <div class="product">

                        <div class="product-image-area thumb">
                            <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="<?=$kerusakan->nama_komponen?>" data-caption="<?=$kerusakan->keterangan_komponen?>" data-image="<?=base_url()?>assets/files/member/<?=$kerusakan->file_komponen?>" data-target="#image-gallery">
                                <img src="<?=base_url()?>assets/files/member/<?=$kerusakan->file_komponen?>" alt="<?=$aplikasi->nama_unit?>" style="height: 150px">
                            </a>

                            <p class="note" style="padding: 0px 0px 0px 10px"><?=$kerusakan->keterangan_komponen ?></p>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                  <h4 class="modal-title" id="image-gallery-title">
                                    <?=$kerusakan->nama_komponen?>
                                  </h4>
                              </div>
                              <div class="modal-body">
                                  <img id="image-gallery-image" class="img-responsive tb-image-popup" src="<?=base_url()?>assets/files/member/<?=$kerusakan->file_komponen?>" style="width: 100%;">
                              </div>

                              <div class="modal-footer">

                                  <div class="col-md-2">
                                      <button type="button" class="btn btn-primary" id="show-previous-image">Previous</button>
                                  </div>

                                  <div class="col-md-8 text-justify" id="image-gallery-caption" style="text-align: center">
                                      <?=$kerusakan->keterangan_komponen?>
                                  </div>

                                  <div class="col-md-2">
                                      <button type="button" id="show-next-image" class="btn btn-default">Next</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                    <?php $no_id++;} ?>

                  </div>

                </div>

          </div>
        </aside>
      </div>

    </div>



  </div>
</div>

<script type="text/javascript">

function hide(target) {
  document.getElementById(target).style.display = 'none';
}

$(document).ready(function(){

  loadGallery(true, 'a.thumbnail');

  //This function disables buttons when needed
  function disableButtons(counter_max, counter_current){
      $('#show-previous-image, #show-next-image').show();
      if(counter_max == counter_current){
          $('#show-next-image').hide();
      } else if (counter_current == 1){
          $('#show-previous-image').hide();
      }
  }

  /**
   *
   * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
   * @param setClickAttr  Sets the attribute for the click handler.
   */

  function loadGallery(setIDs, setClickAttr){
      var current_image,
          selector,
          counter = 0;

      $('#show-next-image, #show-previous-image').click(function(){
          if($(this).attr('id') == 'show-previous-image'){
              current_image--;
          } else {
              current_image++;
          }

          selector = $('[data-image-id="' + current_image + '"]');
          updateGallery(selector);
      });

      function updateGallery(selector) {
          var $sel = selector;
          current_image = $sel.data('image-id');
          $('#image-gallery-caption').text($sel.data('caption'));
          $('#image-gallery-title').text($sel.data('title'));
          $('#image-gallery-image').attr('src', $sel.data('image'));
          disableButtons(counter, $sel.data('image-id'));
      }

      if(setIDs == true){
          $('[data-image-id]').each(function(){
              counter++;
              $(this).attr('data-image-id',counter);
          });
      }
      $(setClickAttr).on('click',function(){
          updateGallery($(this));
      });
  }
});

$(document).ready(function(){
setInterval(function(){
$("#screen").load('banners.php')
}, 2000);
});
</script>
