<style media="screen">

.active a{
  color: #fff!important;

}

@media (max-width: 991px) {
  .image-tb{
    width:100%;
    height: 100% !important;
  }
}

@media (min-width: 992px) {
  .image-tb{
    width:100%;
    height: 170px !important;
  }
}
</style>


<div class="banners-wrapper">

<div class="container">
  <div class="row">
    <div class="col-md-12">

      <?php if($this->session->flashdata('result')!=''){ ?>

          <div class="alert alert-<?=$this->session->flashdata('mode_alert')?>" role="alert" id="Div-Alert">
            <button class="close" onclick="hide('Div-Alert')">×</button>
            <?php echo $this->session->flashdata('result'); ?>
          </div>

      <?php } ?>

      <aside class="sidebar shop-sidebar">
				<div class="panel-group">

          <div class="panel panel-default">
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
            <div id="panel-cart-discount" class="accordion-body collapse in">
              <div class="panel-body">

                <ul class="products-grid columns4">

                  <?php foreach ($mobil_favorit as $key => $mobil) { ?>

                  <form action="<?=base_url()?>Favorit/delete_favorit" method="post">
                  <div class="modal small fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                   <h3 id="myModalLabel">Konfirmasi Hapus</h3>
                              </div>
                              <div class="modal-body">
                                  <p class="error-text">Apakah anda yakin ingin menghapus daftar favorit ?</p>
                                  <input type="hidden" id="id_detail" name="id_detail" value="<?=$mobil->id?>">
                              </div>
                              <div class="modal-footer">
                                 <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
                                 <button type="submit" id="modalDelete" class="btn btn-danger">
                                   Hapus
                                 </button>
                              </div>
                          </div>
                      </div>
                  </div>
                  </form>


                  <li>
    								<div class="product">

                      <?php
                      $status_lelang=$mobil->status_lelang;
                        if ($status_lelang == "2") {
                          $status="Berakhir";
                          $ta="";
                          $href="";
                          $title_a="Lelang Berakhir";
                        }else {
                          $status="";
                          $ta="</a>";
                          $href="#myModal";
                          $title_a="Hapus dari daftar favorit";
                      ?>

                      <a href="<?=base_url()?>favorit/detail/<?=$mobil->id ?>" style="cursor: pointer" title="detail">

                      <?php } ?>

                        <figure class="product-image-area">
      										<div class="product-image">
                            <div class="product-image">
                              <span class="notif-bidding">
                                <?=$status ?>
                              </span>
                              <img class="image-tb" src="<?=base_url()?>assets/files/member/<?=$mobil->file_komponen?>" alt="<?=$aplikasi->nama_unit?>">
                            </div>
      										</div>
                            <div class="product-label">
                              <span class="favorit">
                                <a href="<?=$href ?>" class="addtowishlist" title="<?=$title_a ?>" role="button" data-toggle="modal">
                                  <i class="fa fa-heart" style="color: rgb(190, 8, 8);"></i>
                                </a>
                                <input type="hidden" id="id_detail" name="id_detail" value="<?=$id_detail?>">
                              </span>
                            </div>
      									</figure>
                      <?=$ta ?>

                      <a href="favorit/detail/<?=$mobil->id ?>" style="cursor: pointer; text-decoration: none" title="detail">
    									<div class="product-details-area">
    										<h2 class="product-name">
                          <div>
                            <?="$mobil->tahun_mobil $mobil->merek_mobil $mobil->model_mobil $mobil->transmisi_mobil"?>
                          </div>
                        </h2>

                        <div class="product-price-box">
                          <span class="product-price">
                            Rp. <?=number_format($mobil->harga_kendaraan,0,',','.') ?>
                          </span>
                        </div>

    									</div>
                    </a>
    								</div>
    							</li>


                  <?php } ?>

                </ul>

              </div>
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
</script>
