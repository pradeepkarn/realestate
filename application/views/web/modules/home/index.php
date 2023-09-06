<!-- Home Banner -->
<section class="section section-search" style="background-image: url(<?php echo base_url();?>assets/img/banner.jpg);">
	<div class="container-fluid">
		<div class="banner-wrapper">
			<div class="banner-header text-center">
				<h1>مكتب ألوان الينابيع للعقارات</h1>
			</div>
		</div>
	</div>
</section>
<!-- /Home Banner -->

<div class="mt-5">
	<div class="container">
		<div class="row">
			<div class="col-4 col-md-3 col-sm-4">
				<div style="height: 350px; border-radius: 17px; overflow: hidden; position: relative;">
					<img src="https://www.gobussma.com/Content/images/about1.jpg" alt style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
				</div>
			</div>
			<div class="col-4 col-md-3 col-sm-4">
				<div style="height: 350px; border-radius: 17px; overflow: hidden; position: relative;">
					<img src="https://www.gobussma.com/Content/images/about2.jpg" alt style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
				</div>
			</div>
			<div class="col-4 col-md-3 col-sm-4">
				<div style="height: 350px; border-radius: 17px; overflow: hidden; position: relative;">
					<img src="https://www.gobussma.com/Content/images/about3.jpg" alt style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
				</div>
			</div>
			<div class="col-md-3 col-sm-12 pt-5">
				<div class="text-right">
					<h2>عن ألوان الينابيع</h2>
					<p>
						<span style="color: rgb(74 81 84); font-size: 14px; text-align: right;">
							مؤسسة ألوان الينابيع هي مؤسسة متخصصة في إدارة الأملاك وتأجير العقارات التجارية والإدارية والسكنية يتكون فريق العمل من نخبة متميزة من المتخصصين في تأجير وتسويق العقارات وتحصيل الإيجارات ومتابعة المستأجريــن وصيانة المرافق العقارية. لدى مؤسسة ألوان الينابيع لإدارة الأملاك خبرة ومعرفة تراكمية متخصصة في مجال إدارة الأملاك حيث تأسست عام 1993م.
						</span>
					</p>
					<a href="<?php echo base_url();?>aboutus" class="read-m">المزيد عن ألوان الينابيع</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="mt-5 pt-5 pb-5" style="background: url('https://esrarrealestate.com/images/why-us.jpg')no-repeat center center / cover">
	<div class="container">
		<div class="section-header text-center mt-4 mb-3">
			<p class="sub-title mb-1">خدماتنا</p>
			<div class="sub-title-line mb-2"></div>
		</div>
		<div class="serve">
			<div class="row">
				<div class="col-3 text-center">
					<i class="fa fa-suitcase" style="font-size: 44px; color: #4e4a41;"></i>
					<h5 class="mt-4">إدارة الأملاك</h5>
				</div>
				<div class="col-3 text-center">
					<i class="fa fa-map-marked-alt" style="font-size: 44px; color: #4e4a41;"></i>
					<h5 class="mt-4">بيع وشراء</h5>
				</div>
				<div class="col-3 text-center">
					<i class="fa fa-bullhorn" style="font-size: 44px; color: #4e4a41;"></i>
					<h5 class="mt-4">تسويق العقارات</h5>
				</div>
				<div class="col-3 text-center">
					<i class="fa fa-poll" style="font-size: 44px; color: #4e4a41;"></i>
					<h5 class="mt-4">صيانة</h5>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Trending Ads -->
<div class="trending-ads pb-0">
	<div class="container-fluid">
		<div class="section-header text-center">
			<p class="sub-title">أحدث العروض العقارية</p>
			<div class="sub-title-line mb-2"></div>
		</div>
		<!-- Tab Content -->
		<div class="row text-right">
			<?php foreach($adList as $ad){?>
			<div class="col-12 col-lg-4 col-md-6 col-sm-6 mb-4">
				<div class="p-3" style="border: 1px solid #ececec;">
					<div class="row">
						<div class="col-12">
							<a href="<?php echo base_url();?>viewad/<?php echo  ($ad->adid);?>">
								<div style="height: 200px; background: url(<?php echo base_url();?>img/propertyImage/<?php echo $ad->fileName;?>); background-size: cover; background-position: center center;"></div>
							</a>
						</div>
						<div class="col-12">
							<a href="<?php echo base_url();?>viewad/<?php echo  ($ad->adid);?>">
							  	<h4 class="m-2 mt-3"><?php if($ad->purpose=='1'){ echo "تأجير";} else {echo "بيع    "; }?></h4>  
								<h4 class="m-2 mt-3"><?php echo $ad->subject."  ".$ad->amount;?></h4>
								<div class="m-2">
									<span><?php echo $ad->district."   ".$ad->location;?></span> <i class="feather-map-pin"></i>
									<div class="pt-2" style="font-size: 12px;"><?php echo $ad->propertyType;?></div>
								</div>
							</a>
						</div>
						<div class="col-12">
							<div class="row text-center pr-3 pl-3" style="font-size: 12px;">
								<div class="col-3 pt-2 pb-2" style="display: flex; height: 75px; background: #f0f0f0; border: .5px solid #e8e8e8; border-bottom: 3px solid #e4e4e4;">
									<div style="margin: auto;">
										العمر<br />
										<?php echo $ad->propertyAge;?>
									</div>
								</div>
								<div class="col-3 pt-2 pb-2" style="display: flex; background: #f0f0f0; border: .5px solid #e8e8e8; border-bottom: 3px solid #e4e4e4;">
									<div style="margin: auto;">
										المساحة<br />
										<?php echo $ad->propertyAreaSize;?>
									</div>
								</div>
								<div class="col-3 pt-2 pb-2" style="display: flex; background: #f0f0f0; border: .5px solid #e8e8e8; border-bottom: 3px solid #e4e4e4;">
									<div style="margin: auto;">
										الأدوار<br />
										<?php echo $ad->floorNo;?>
									</div>
								</div>
								<div class="col-3 pt-2 pb-2" style="display: flex; background: #f0f0f0; border: .5px solid #e8e8e8; border-bottom: 3px solid #e4e4e4;">
									<div style="margin: auto;">
										الغرف<br />
										<?php echo $ad->roomNo;?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		<!-- /Trending Ads -->
	</div>
</div>
<section class="m-4 pb-4 pt-4" style=" background: #f9f9f9; box-shadow: 0px 0px 15px -5px #ccc; ">
	<div class="container">
		<div class="section-header mt-4 mb-5 text-center">
			<p class="sub-title">ما يميزنا عن غيرنا</p>
			<div class="sub-title-line mb-2"></div>
		</div>
		<div class="row">
			<div class="col-4">
				<div class="pb-4 text-center">
					<i class="fa fa-award" style="font-size: 24px;"></i>
					<h3 class="mb-0"><p dir="rtl">20+</p></h3>
					<p>سنة خبرة</p>
				</div>
			</div>
			<div class="col-4">
				<div class="pb-4 text-center">
					<i class="fa fa-project-diagram" style="font-size: 24px;"></i>
					<h3 class="mb-0"><p dir="rtl">100+</p></h3>
					<p>عقار</p>
				</div>
			</div>
			<div class="col-4">
				<div class="pb-4 text-center">
					<i class="fa fa-handshake" style="font-size: 24px;"></i>
					<h3 class="mb-0"><p dir="rtl">500+</p></h3>
					<p>عميل</p>
				</div>
			</div>
		</div>
	</div>
</section>

	
<div style="width: 100%"><iframe width="100%" height="300" style="display: block;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=300&amp;hl=en&amp;q=%D8%B4%D8%A7%D8%B1%D8%B9%20%D8%A7%D8%A8%D9%86%20%D8%B7%D9%88%D9%84%D9%88%D9%86%D8%8C%20%D8%A7%D9%84%D8%B4%D9%81%D8%A7%D8%8C%20%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6%2014721+(%D8%A3%D9%84%D9%88%D8%A7%D9%86%20%D8%A7%D9%84%D9%8A%D9%86%D8%A7%D8%A8%D9%8A%D8%B9%20%D9%84%D9%84%D8%B9%D9%82%D8%A7%D8%B1%D8%A7%D8%AA)&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>

	