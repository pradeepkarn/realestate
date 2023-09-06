<?php //print_r($buildingData); echo"<br><br>"; print_r($ownerList); die(); ?>
<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">اللوحة الرئيسية</a>
            </li>
            <li class="breadcrumb-item active"> تعديل العقار / المباني</li>
          </ol>

	<?php
	//$fcl=array('class'=>'cf','id'=>'form','name'=>'form');
	//echo form_open_multipart('Buildings_controller/insertbuildinginfo',$fcl);
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #428bca;">
                <div class="panel-heading"> عديل العقار  </div>
                <div class="panel-body">
 <div class="col-md-12 mx-auto">
	<section id="container">
		<h2>تعديل العقار </h2>
		<div id="wrapping" class="clearfix">
			
			<form name="editbuilingform" class="needs-validation" novalidate action="<?php echo base_url(); ?>Buildings_controller/updateBuildingInfo" method="post">

              <div class="form-group">

                <input type="hidden" name="bid" id="bid" value="<?php if(isset($buildingData[0]->id)) { echo $buildingData[0]->bid; } ?>" >
               <label> <font color="red">*</font>نوع العقار</label>
               <select class="form-control select2" style="width: 100%;" name="buildingtype" tabindex="1" required>
                	 <option selected value="">نوع العقار</option>
                   <option value="شقق" <?php if ($buildingData['0']->building_type == "شقق") echo '  selected ';?>>شقق  </option>
                        <option value="أدوار" <?php if ($buildingData['0']->building_type == "أدوار") echo ' selected ';?>>أدوار </option>
                         <option value="فيلا" <?php if ($buildingData['0']->building_type == "فيلا") echo ' selected ';?>>فيلا </option>
                         <option value="استراحة" <?php if ($buildingData['0']->building_type == "استراحة") echo ' selected ';?>>استراحة </option>
                         <option value="غرف" <?php if ($buildingData['0']->building_type == "غرف") echo ' selected ';?>>غرف  </option>
                         <option value="محطة" <?php if ($buildingData['0']->building_type == "محطة") echo ' selected ';?>>محطة  </option>
                         <option value="بيت" <?php if ($buildingData['0']->building_type == "بيت") echo ' selected ';?>>بيت  </option>
                         <option value="محلات" <?php if ($buildingData['0']->building_type == "محلات") echo ' selected ';?>>محلات  </option>
                         <option value="ورشة" <?php if ($buildingData['0']->building_type == "ورشة") echo ' selected ';?>>ورشة  </option>
                         <option value="أخرى" <?php if ($buildingData['0']->building_type == "أخرى") echo ' selected ';?>>أخرى  </option>
                </select>
                   
                <div class="invalid-feedback">نوع العقار</div>
              </div>
             
           <div class="form-group">
                <label> <font color="red">*</font>اختر المالك</label>
                <select style="width: 100%;" name="ownerid" tabindex="2" class="custom-select browser-default" required>
                  <option selected value="">اختر المالك</option>
                  <?php 
            // echo($classList[0]); die();
             if(count($ownerList)>0){
                                    for ($i=0; $i <count($ownerList) ; $i++) { ?>
                            <option <?php if ($buildingData['0']->owner_id == $ownerList[$i]->id) echo ' selected ';?> value="<?php echo $ownerList[$i]->id;?>"><?php echo $ownerList[$i]->owner_firstname;?></option>
                            <?php  } } ?>
                               
                </select>
                <div class="invalid-feedback">اختر المالك</div>
              </div>
              <div class="form-group">
                 <label> <font color="red">*</font>اسم العقار </label>
              <input type="text" name="buildingname" id="buildingname" value="<?php if(isset($buildingData[0]->building_name)) { echo $buildingData[0]->building_name; } ?>" autocomplete="off" tabindex="3" class="form-control" required>
        </div>



         <div class="form-row">
           <div class="col">
           <label> <font color="red">*</font> No. of Housing Units </label>
          <input type="number" name="noofhouse" id="noofhouse" autocomplete="off" tabindex="4" class="form-control" value="<?php if(isset($buildingData[0]->no_of_housing_units)) { echo $buildingData[0]->no_of_housing_units; } ?>" >
        </div>
         <div class="col">
           <label> <font color="red">*</font> No. of Commercial Units </label>
          <input type="number" name="noofcommercial" id="noofcommercial" value="<?php if(isset($buildingData[0]->no_of_commercial_units)) { echo $buildingData[0]->no_of_commercial_units; } ?>" autocomplete="off" tabindex="5" class="form-control" required>
        </div>
        </div>


              
        <div class="form-group">
           <label> <font color="red">*</font>عنوان العقار </label>
              <input type="text" name="address" id="address" value="<?php if(isset($buildingData[0]->address)) { echo $buildingData[0]->address; } ?>"  autocomplete="off" tabindex="6" class="form-control" required>
        </div>

         <div class="form-group">
           <label> <font color="red">*</font>موقع العقار على خرائط قوقل</label>
              <input type="text" name="buildinglocation" id="buildinglocation" value="<?php if(isset($buildingData[0]->building_location)) { echo $buildingData[0]->building_location; } ?>"  autocomplete="off" tabindex="7" class="form-control" required>
        </div>

		</div>

<input type="submit" name="submitbtn" id="submitbtn" tabindex="9" class="btn btn-primary"  value="تحديث">
		
			<input type="reset" name="reset" id="resetbtn" tabindex="10" class="btn btn-primary" value="مسح">
			
			
	</section>
</form>
</div>
</section>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">	
</script> 
<script>
(function() {
'use strict';
window.addEventListener('load', function() {
// Fetch all the forms we want to apply custom Bootstrap validation styles to
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function(form) {
form.addEventListener('submit', function(event) {
if (form.checkValidity() === false) {
event.preventDefault();
event.stopPropagation();
}
form.classList.add('was-validated');
}, false);
});
}, false);
})();
</script>