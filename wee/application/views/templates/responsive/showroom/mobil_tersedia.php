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

.trash{padding:2px; border:1px solid red; margin-left:10px; background-color:red; color:#fff}
td{padding:5px}
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

                  <?php
                    $detail_dealer = kode_tbl().'detail_dealer';
                    foreach ($mobil_tersedia as $key => $mobil) {

                      $this->db->select('*');
                			$this->db->where('id_kendaraan', $mobil->id);
                      $this->db->where('id_dealer', $user_id);
                			$favorit = $this->db->get("$detail_dealer")->row();

                      if ($favorit->status_detail == '1') {
                        $color="rgb(190, 8, 8)";
                        $title="Hapus dari daftar favorit";
                        $id_detail="$favorit->id";
                      }else {
                        $color="#fff";
                        $title="Tambahkan ke daftar favorit";
                        $id_detail="$mobil->id";
                      }
                  ?>

                  <form action="<?=base_url()?>Mobil_tersedia/delete_favorit" method="post">
                  <div class="modal small fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                   <h3 id="myModalLabel">Konfirmasi Hapus</h3>
                              </div>
                              <div class="modal-body">
                                  <p class="error-text">Apakah anda yakin ingin menghapus daftar favorit ?</p>
                                  <input type="hidden" id="id_detail" name="id_detail" value="<?=$id_detail?>">
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
    									<figure class="product-image-area">

                        <?php
                        $status_lelang=$mobil->status_lelang;
                          if ($status_lelang == "2") {
                            $status="Berakhir";
                            $href="";
                            $action="";
                            $title_a="Lelang Berakhir";
                            $cursor="not-allowed";
                          }else {
                            $status="";
                            $href="#myModal";
                            $action=base_url().'Mobil_tersedia/add_favorit';
                            $title_a="Hapus dari daftar favorit";
                            $cursor="pointer";
                          }
                        ?>

    										<div class="product-image">
                          <span class="notif-bidding">
                            <?=$status ?>
                          </span>
                          <img class="image-tb" src="<?=base_url()?>assets/files/member/<?=$mobil->file_komponen?>" alt="<?=$aplikasi->nama_unit?>">
    										</div>

                        <form action="<?=$action?>" method="post">
                          <div class="product-label">
                            <span class="favorit">
                              <input type="hidden" id="id_detail" name="id_detail" value="<?=$id_detail?>">
                              <?php
                                if ($favorit->status_detail == '1') {
                              ?>

                              <a href="<?=$href ?>" title="<?=$title ?>" class="addtowishlist" role="button" data-toggle="modal" style="cursor: <?=$cursor ?>!important">
                                <i class="fa fa-heart" style="color: <?=$color ?>;"></i>
                              </a>

                              <?php }else{ ?>

                              <button type="submit" class="addtowishlist" title="<?=$title ?>" style="cursor: <?=$cursor ?>!important">
                                <i class="fa fa-heart" style="color: <?=$color ?>;"></i>
                              </button>

                              <?php } ?>

                            </span>
                          </div>
                        </form>

    									</figure>

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
    								</div>
    							</li>

                  <?php } ?>

                </ul>


                <!-- <div class="toolbar-bottom">
    							<div class="toolbar">
    								<div class="sorter">
    									<ul class="pagination">
                        <li><a href="#"><i class="fa fa-caret-left"></i></a></li>
    										<li class="active"><a href="#">1</a></li>
    										<li><a href="#">2</a></li>
    										<li><a href="#"><i class="fa fa-caret-right"></i></a></li>
    									</ul>
    								</div>
    							</div>
    						</div> -->

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

  // $('.trash').click(function(){
  //   var id=$(this).data('id');
  //   $('#modalDelete').attr('href','delete-cover.php?id='+id);
  // })
</script>
