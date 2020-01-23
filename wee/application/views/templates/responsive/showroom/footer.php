<style media="screen">
  #footer{
    background: #fff!important;
    border-top: 4px solid #fff!important;
  }
</style>

      <footer id="footer">
        <!-- <div class="footer-copyright">
          <div class="container">
            <div class="row">
              <div class="col-md-8">
                <p>© Copyright 2019. Develoved by &nbsp; <a href="https://www.instagram.com/tera_byt3_/" target="_blank">تبغس اوم</a></p>
              </div>
              <div class="col-md-4"></div>
            </div>
          </div>
        </div> -->
      </footer>


</div>

<!-- Vendor -->
<script src="<?=base_url()?>_assets/vendor/jquery/jquery.min.js"></script>
<script src="<?=base_url()?>_assets/vendor/jquery.appear/jquery.appear.min.js"></script>
<script src="<?=base_url()?>_assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?=base_url()?>_assets/vendor/jquery-cookie/jquery-cookie.min.js"></script>
<script src="<?=base_url()?>_assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>_assets/vendor/common/common.min.js"></script>
<script src="<?=base_url()?>_assets/vendor/jquery.validation/jquery.validation.min.js"></script>
<script src="<?=base_url()?>_assets/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
<script src="<?=base_url()?>_assets/vendor/jquery.gmap/jquery.gmap.min.js"></script>
<script src="<?=base_url()?>_assets/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
<script src="<?=base_url()?>_assets/vendor/isotope/jquery.isotope.min.js"></script>
<script src="<?=base_url()?>_assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?=base_url()?>_assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="<?=base_url()?>_assets/vendor/vide/vide.min.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="<?=base_url()?>_assets/js/theme.js"></script>


<script src="<?=base_url()?>_assets/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="<?=base_url()?>_assets/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

<!-- Current Page Vendor and Views -->
<script src="<?=base_url()?>_assets/js/views/view.contact.js"></script>



<!-- Demo -->
<script src="<?=base_url()?>_assets/js/demos/demo-shop-4.js"></script>

<!-- Theme Custom -->
<script src="<?=base_url()?>_assets/js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="<?=base_url()?>_assets/js/theme.init.js"></script>






<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-12345678-1', 'auto');
ga('send', 'pageview');
</script>
-->

<script>
	window.setTimeout("waktu()", 1000);

	function waktu() {
		var waktu = new Date();
		setTimeout("waktu()", 1000);
		document.getElementById("jam").innerHTML = waktu.getHours();
		document.getElementById("menit").innerHTML = waktu.getMinutes();
		document.getElementById("detik").innerHTML = waktu.getSeconds();
	}

  function date_time(id)
	{
	    date = new Date;
	    year = date.getFullYear();
	    month = date.getMonth();
	    months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	    d = date.getDate();
	    day = date.getDay();
	    days = new Array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
	    h = date.getHours();
	    if(h<10)
	    {
	            h = "0"+h;
	    }
	    m = date.getMinutes();
	    if(m<10)
	    {
	            m = "0"+m;
	    }
	    s = date.getSeconds();
	    if(s<10)
	    {
	            s = "0"+s;
	    }
	    result = ''+days[day]+', '+d+' '+months[month]+' '+year+', '+h+':'+m+':'+s;
	    document.getElementById(id).innerHTML = result;
	    setTimeout('date_time("'+id+'");','1000');
	    return true;
	}

  window.onload = date_time('date_time');
  window.onload = date_time('date_time1');
</script>


</body>
</html>
