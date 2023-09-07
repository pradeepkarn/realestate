 
	<!-- Breadcrumb -->
	<div class="breadcrumb-bar pt-4 pb-4">
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-md-12 col-12 text-center">
					<h2 class="breadcrumb-title m-0"><?php echo $adDetails->purpose;?></h2>
					<nav aria-label="breadcrumb" class="page-breadcrumb">
						<ol class="breadcrumb mt-2">
							<li class="breadcrumb-item"><a href="<?php echo base_url();?>">الرئيسية</a></li>
							<li class="breadcrumb-item"><a href="<?php echo base_url();?>advertisements">العروض العقارية</a></li>
							<li class="breadcrumb-item active" aria-current="page"><?php echo $adDetails->purpose;?></li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!-- /Breadcrumb -->

    <style>
      .swiper {
        width: 100%;
        height: 300px;
        margin-left: auto;
        margin-right: auto;
      }
      .swiper-slide {
        background-size: cover;
        background-position: center;
      }
      .mySwiper2 {
        height: 80%;
        width: 100%;
      }
      .mySwiper {
        height: 20%;
        box-sizing: border-box;
        padding: 10px 0;
      }
      .mySwiper .swiper-slide {
        width: 25%;
        height: 100%;
        opacity: 0.4;
      }
      .mySwiper .swiper-slide-thumb-active {
        opacity: 1;
      }
      .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
	  .swiper-button-next, .swiper-container-rtl .swiper-button-prev {
	    margin-left: 20px;
	    margin-right: 20px;
	  }
    </style>
    <?php  
    
   if(!is_null($adDetails->id))
   {
    
    ?>
	<!-- Ads Details -->
	<div class="page-wrapper">
		<div class="container">					
			<div class="row">
				<div class="col-12 col-lg-12">
					<div class="card">
						<div class="card-body" style="text-align:right;">
							<div class="row">
								<div class="col-md-6">
									<?php $img=$adDetails->images; ?>
									<div style="overflow: hidden; --swiper-navigation-color: #fff; --swiper-pagination-color: #fff; background: #f7f7f7;" class="swiper mySwiper2">
									  <div class="swiper-wrapper">
										<?php for($i=0;$i<count($img);$i++) { ?>
										<div class="swiper-slide">
											<img src="<?php echo $img[$i]; ?>" alt="" />
										</div>
										<?php } ?>
									  </div>
									  <div class="swiper-button-next"></div>
									  <div class="swiper-button-prev"></div>
									</div>
									<div thumbsSlider="" class="swiper mySwiper">
									  <div class="swiper-wrapper">
										<?php for($i=0;$i<count($img);$i++) { ?>
										<div class="swiper-slide">
											<img src="<?php echo $img[$i]; ?>" alt="" />
										</div>
										<?php } ?>
									  </div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="ads-details justify-content-between align-items-right">
										<div class="mr-0 w-100">
										    <h1 style="margin: 0;"><?php echo $adDetails->purpose;?></h1>
											<div class="card-body" style="text-align:right;">
												<p class="mb-0"><b> الموقع  :  </b><a href="<?php echo $adDetails->site;?>" target="_blank"><?php echo $adDetails->site; ?></a></p>
												<p class="mb-0"><b> الحي  :  </b> <?php echo $adDetails->district;?></p>
												<p class="mb-0"><b> المدينة  :  </b><?php echo $adDetails->city; ?></p>
											</div>
										</div>
		  								<div class="freelancer-apply">
				  							<!--
											<a href="" target="_blank">
												<img src="<?php echo base_url();?>assets/img/whatsapp.png" height="45" width="45">
											</a>
											-->
											<?php $currentURL = current_url();?>
		  									<a href="https://api.whatsapp.com/send?phone=+966500598800&text=هذه المحادثة بخصوص الإعلان في هذا الرابط <?php echo $currentURL;?>" data-action="share/whatsapp/share" target="_blank" class="btn submit-btn"> احجز الآن </a>
		  								</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header" style="text-align:right;">
							<h4> تفاصيل </h4>
						</div>
						<div class="card-body" style="text-align:right;">
							<p><b><h2><?php echo $adDetails->purpose; ?></h2></b></p>
							<!-- <p class="mb-0"><b> رقم المعلن  :  </b> <?php // echo "3152686"; ?></b></p> -->
							<p class="mb-0"><b>نوع العقار  :  </b> <?php echo $adDetails->property_type; ?></b></p>
							<p class="mb-0"><b> مساحة العقار  :  </b><?php echo $adDetails->property_area; ?></b></p>
							<p class="mb-0"><b>  عمر العقار  :  </b> <?php echo $adDetails->property_age; ?></b></p>
							<p class="mb-0"><b> رقم الترخيص. :  </b><?php echo $adDetails->licence_no; ?></b></p>
							<p class="mb-0"><b> عدد الغرف :  </b><?php echo $adDetails->no_of_rooms;; ?></b></p>
							<p class="mb-0"><b> عدد دورات المياه  :  </b><?php echo $adDetails->no_of_bathrooms; ?></b></p>
							<p class="mb-0"><b> مؤثث  :  </b><?php echo $adDetails->furnished; ?></b></p>
							<p class="mb-0"><b>   طريقة الدفع  :  </b><?php echo $adDetails->payment_method; ?></b></p> 
							<p class="mb-0"><b>  القيمة (ر.س) :  </b><?php echo $adDetails->the_value; ?></b></p>
							<p class="mb-0"><b>التفاصيل  :</b> <?php echo $adDetails->details; ?></p>
							<!-- <p class="mb-0"><b> عدد المشاهدات  :</b> <?php //echo $adDetails['visits']; ?></p> -->
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12">
					<div class="freelancer-apply" style="text-align:right;">
						<a href="<?php echo base_url();?>contactus" class="btn submit-btn"> اتصل بنا </a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Ads Details -->

<?php } 
else { ?>

	<div class="container">
	<div class="row">
	    <div class="col-md-12"> 
						<?php echo "<center><b> لم يتم العثور على إعلان مطابق، يرجى إعادة البحث.  </b></center>";?>
					  	</div></div></div>
<?php }?>