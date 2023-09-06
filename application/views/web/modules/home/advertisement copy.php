<?php //if($purpose) { print_r($purpose); } ?>
	<!-- Breadcrumb -->
	<div class="breadcrumb-bar pt-4 pb-4">
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-md-12 col-12 text-center">
					<h2 class="breadcrumb-title m-0">العروض العقاري</h2>
					<nav aria-label="breadcrumb" class="page-breadcrumb">
						<ol class="breadcrumb mt-2">
							<li class="breadcrumb-item"><a href="<?php echo base_url();?>">الرئيسية</a></li>
							<li class="breadcrumb-item active" aria-current="page">العروض العقارية</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!-- /Breadcrumb -->

	<!---Search ----->
	<div class="filter-col" style="margin:20px 20px 20px 20px;">
		<div class="card">
			<div class="card-body">
				<fieldset class="text-right">
				<form method="post" action="<?php echo base_url();?>advertisements">
					<div class="row">
						<div class="col-10 col-md-6 col-lg-3">
							<div class="form-group">
								<label>الغرض   </label>
								<div class="text-icon-box">
									<select   name="purpose" class="form-control">
										<option value=""> إختيار </option>
										<option 
										<?php if($searchpurpose) {
											if(($searchpurpose)==1)
											{ ?>
												selected
											<?php }
										} ?>
										value="1"> تأجير </option>
										<option 
										<?php if(($searchpurpose)) {
											if(($searchpurpose)==2)
											{ ?>
												selected
											<?php }
										} ?>
										value="2"> بيع </option>
									 </select>
								</div>
							</div>
						</div>
						<div class="col-10 col-md-6 col-lg-3">
							<div class="form-group">
								<label> نوع الوحدة </label>
								<div class="text-icon-box">
									<select   name="propertyType" class="form-control" >
										<option value=""> إختيار  </option>
										 <?php foreach($propertyType as $propType){?>

										 	<option value="<?php 
										 	echo $propType->ptype; ?>"
										 	<?php if(($searchpropertyType)) {
											if(($searchpropertyType)==$propType->ptype)
											{ ?>
												selected
											<?php }
										} ?>

										 	>
										 	<?php echo $propType->ptype; ?>
										 </option>
										 <?php } ?>
									 </select>
									 
								</div>
							</div>
						</div>
						<!-- <div class="col-12 col-md-6 col-lg-3">
							<div class="form-group">
								<label>City</label>
								<div class="text-icon-box">
									<select   name="city" class="form-control">
									<?php foreach($city as $city){?>

										 	<option value="<?php 
										 	echo $city->city; ?>">
										 	<?php echo $city->city; ?>
										 </option>
										 <?php } ?>
									 </select>
									 
													 
								</div>
							</div>
						</div> -->
						<div class="col-10 col-md-6 col-lg-3">
							<div class="form-group">
								<label> الحي  </label>
								<div class="text-icon-box">
									<select   name="district" class="form-control">
										<option value=""> إختيار </option>
									<?php foreach($district as $district){?>

										 	<option 

										 	<?php if($searchdistrict) {
											if(($searchdistrict)==$district->district)
											{ ?>
												selected
											<?php }
										} ?>

										 	value="<?php 
										 	echo $district->district; ?>">
										 	<?php echo $district->district; ?>
										 </option>
										 <?php } ?>
									 </select>					 
								</div>
							</div>
						</div>

						<div class="col-10 col-md-6 col-lg-3">
							<div class="form-group">
								<label> القيمة من  </label>
								<div class="text-icon-box">
									 <input type="text" placeholder="من " id="startPrice"  name="startPrice"  class="form-control"
									 <?php if(($searchstartPrice)) {
											 ?>
												value="<?php echo $searchstartPrice;?>"
											<?php  
										} ?>
									 > إلى
									  <input type="text" id="endPrice" name="endPrice" placeholder=" إلى " class="form-control"
									   <?php if(($searchendPrice)) {
											 ?>
												value="<?php echo $searchendPrice;?>"
											<?php  
										} ?>
									  > 
									  					 
								</div>
							</div>
						</div>
						 
						<div class="search-btn-col">
						<!-- <button class="btn submit-btn">Search</button> -->
						<input type="submit" value=" بحث " class="btn submit-btn">
						</div> 

					  
					</div>
				</form>
			</fieldset>
			</div>
		</div>
	</div>




	<!--- End Search ---->

	<!-- Ads Main -->
	<div class="page-wrapper">
		<div class="container-fluid">
			<!-- Trending Ads -->
			<div class="ads-main-trending">
				<div class="row text-right">
					<?php 
					if($adList) {
						foreach($adList as $ad){?>
					<div class="col-12 col-lg-4 col-md-6 col-sm-6 mb-4">
						<div class="p-3" style="border: 1px solid #ececec;">
							<div class="row">
								<div class="col-12">
									<a href="<?php echo base_url();?>viewad/<?php echo $ad->adid;?>">
										<div style="height: 200px; background: url(<?php echo base_url();?>img/propertyImage/<?php echo $ad->fileName;?>); background-size: cover; background-position: center center;"></div>
									</a>
								</div>
								<div class="col-12">
									<a href="<?php echo base_url();?>viewad/<?php echo $ad->adid;?>">
										<h4 class="m-2 mt-3"><?php echo $ad->subject;?></h4>
										<div class="m-2">
											<span><?php echo $ad->location;?></span> <i class="feather-map-pin"></i>
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
					<?php } } else { ?>
						 
			 			<div class="container">
	<div class="row">
	    <div class="col-md-12"> 
						<?php echo "<center><b> لم يتم العثور على إعلان مطابق، يرجى إعادة البحث.  </b></center>";?>
					  	</div></div></div>
					<?php }?>
				</div>
			</div>
			<!-- /Trending Ads -->
			 <div class="row">
				<div class="col-md-12 text-center" >
					
				 
<!-- Show pagination links -->
<?php 
if($search==0)
{
if($links)
{
foreach ($links as $link) {
echo "  ". $link." ";
} } } ?>
 

				</div>
			</div>

		</div>
	</div>
	<!-- /Ads Main -->
