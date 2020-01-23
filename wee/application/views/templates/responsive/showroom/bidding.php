<script>
  function autoRefresh() {
      window.location = window.location.href;
  }
  setInterval('autoRefresh()', 10000);
</script>

<div class="col-md-12">
  <div class="product-price-box" style="text-align: center">
    <div class="col-md-6">
      <span>
        <img style="padding-right: 5px" src="<?php echo base_url().'_assets/img/bidding.png' ?>" class="m-auto-tb" alt="<?=$aplikasi->nama_unit?>">
      </span>
      <span class="product-price">
        Rp. <?php
          $bidding_lelang=$mobil_favorit->harga_kendaraan+($mobil_favorit->bidding_kendaraan*500000);

          echo number_format($bidding_lelang,0,',','.');
        ?>
      </span>
    </div>
    <div class="col-md-6">
      <span>
        <img style="padding-right: 5px" src="<?php echo base_url().'_assets/img/bid.png' ?>" class="m-auto-tb" alt="<?=$aplikasi->nama_unit?>">
      </span>
      <span class="product-price"> <?=$mobil_favorit->bidding_kendaraan ?></span>
    </div>
  </div>
  <div class="col-md-12" style="text-align: center; padding: 30px 0px 20px 0px">
  <input type="hidden" name="id_detail_dealer" value="<?=$mobil_favorit->iddetaildealer ?>">
  <input type="hidden" name="id_detail_kendaraan" value="<?=$mobil_favorit->id_kendaraan ?>">
  <input type="hidden" name="id_dealer" value="<?=$mobil_favorit->iddealer ?>">
  <input type="hidden" name="jam_bidding" value="<?=date("Y-m-d H:i:s") ?>">
  <input type="hidden" name="bidding_kendaraan" value="<?=$mobil_favorit->bidding_kendaraan+1 ?>">
    <p class="availability">
      <span class="font-weight-semibold">Showroom:</span>
      <?="$data_dealer->nama_dealer" ?>
      <b style="color: green">
        <?php
          $bidding_dealer=$mobil_favorit->harga_kendaraan+($data_dealer->bid_ke*500000);
          echo "Rp.";
          echo number_format($bidding_dealer,0,',','.');
        ?>
      </b>
    </p>
    <p class="email-to-friend" style="color: red">
      <b>Bidding Kelipatan Rp. 500.000</b>
    </p>
  </div>

</div>

<div class="product-actions">
  <button type="submit" class="btn btn-danger btn-block" title="BIDDING">
    <div class="">
      <img src="<?php echo base_url().'_assets/img/tag_kiri.png' ?>" class="m-auto" alt="<?=$aplikasi->nama_unit?>">
      <span><b>BIDDING</b></span>
      <img src="<?php echo base_url().'_assets/img/tag_kanan.png' ?>" class="m-auto" alt="<?=$aplikasi->nama_unit?>">
    </div>
  </button>
</div>
