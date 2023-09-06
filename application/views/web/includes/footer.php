
<div class="footer pt-5">
    <div class="container">
		<div class="row">
			<div class="col-lg-2 col-md-3 col-sm-3 col-4 align-self-center">
				<img src="<?php echo base_url();?>img/logo.png" alt="" class="p-3">
			</div>
			<div class="col-sm-5 col-8 text-right">
				<p>تواصل معنا</p>
				<p>
					حي الشفاء، شارع بن طولون - حي القيروان، طريق الأمير محمد بن سعد بن عبدالعزيز
					الرياض، المملكة العربية السعودية
				</p>
				<p>
					هاتف 0114220325 <br />
					جوال 0500598800 <br />
					info@alyanabea.com
				</p>
			</div>
			<div class="col-sm-1 text-right"></div>
			<div class="col-sm-3 text-right">
				<p> &nbsp;</p>
				<a href="<?php echo base_url();?>advertisements">العروض العقارية</a><br />
				<a href="<?php echo base_url();?>aboutus">من نحن</a><br />
				<a href="<?php echo base_url();?>contactus">اتصل بنا</a>
			</div>
		</div>
	</div>
</div>


	<!-- Footer Bottom -->
	<div class="footer-bottom">
		<div class="container-fluid">
			<!-- Copyright -->
			<div class="copyright">
				<div class="row">
					<div class="col-12">
						<div class="copyright-text text-center">
							<hr>
							<p class="mb-2">جميع الحقوق محفوظة &copy; <?php echo date('Y');?></p>
						</div>
					</div>
				</div>
			</div>
			<!-- /Copyright -->
		</div>
	</div>
	<!-- /Footer Bottom -->
</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url();?>assets/js/jquery-3.6.0.min.js"></script>
<!-- Bootstrap Core JS -->
<script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<!-- Swiper JS -->
<script src="<?php echo base_url();?>assets/plugins/swiper/js/swiper.min.js"></script>
<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".mySwiper", {
	loop: false,
	spaceBetween: 10,
	slidesPerView: 4,
	freeMode: true,
	watchSlidesProgress: true,
  });
  var swiper2 = new Swiper(".mySwiper2", {
	loop: false,
	spaceBetween: 10,
	navigation: {
	  nextEl: ".swiper-button-next",
	  prevEl: ".swiper-button-prev",
	},
	thumbs: {
	  swiper: swiper,
	},
  });
</script>
<!-- Custom JS -->
<script src="<?php echo base_url();?>assets/js/script.js"></script>
<!-- Toastr JS -->
<script src="<?php echo base_url();?>assets/js/toastr.js"></script>
<?php if($this->session->flashdata('error_message')) {  ?>
	 <script>
	   toastr.error('<?php echo $this->session->flashdata('error_message');?>');
	</script>
    <?php $this->session->unset_userdata('error_message');
    } if($this->session->flashdata('success_message')) {  ?>
	<script>
	   toastr.success('<?php echo $this->session->flashdata('success_message');?>');
	</script>
 <?php $this->session->unset_userdata('success_message'); } ?>
</body>
</html>