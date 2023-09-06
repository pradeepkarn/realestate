<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard"> اللوحة الرئيسية  </a>
            </li>
            <li class="breadcrumb-item active">  إضافة عقار جديد   /  المباني  </li>
          </ol>

	<?php
	//$fcl=array('class'=>'cf','id'=>'form','name'=>'form');
	//echo form_open_multipart('Buildings_controller/insertbuildinginfo',$fcl);
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #428bca;">
                <div class="panel-heading"> إضافة عقار جديد </div>
                <div class="panel-body">
 <div class="col-md-12 mx-auto">
	<section id="container">
		<h2 align="right"> إضافة عقار جديد  </h2>
		<div id="wrapping" class="clearfix">
			
			<form name="addbuilingform" class="needs-validation" novalidate action="<?php echo base_url(); ?>Buildings_controller/insertbuildinginfo" method="post">

              <div class="form-group">
               
               <label> <font color="red">*</font> نوع العقار  </label>
            
             
               <select class="form-control select2" style="width: 100%;" id="buildingtype" name="buildingtype" tabindex="1" required>
                	 <option selected value=""> نوع العقار   </option>
                     <option value="شقق">شقق  </option>
                  <option value="أدوار">أدوار </option>
                  <option value="فيلا">فيلا </option>
                  <option value="استراحة">استراحة </option>
                  <option value="غرف">غرف  </option>
                  <option value="محطة">محطة </option>
                  <option value="بيت">بيت  </option>
                  <option value="محلات">محلات  </option>
                  <option value="ورشة">ورشة  </option>
                  <option value="أخرى">أخرى  </option>
                 </select>
                  <div class="invalid-feedback"> نوع العقار  </div>
                    </div>
               
             
             
           <div class="form-group">
                <label> <font color="red">*</font> اختر المالك  </label>
                <select style="width: 100%;" name="ownerid" tabindex="2" class="custom-select browser-default" required>
                  <option selected value=""> اختر المالك  </option>
                  <?php 
            // echo($classList[0]); die();
             if(count($ownerList)>0){
                                    for ($i=0; $i <count($ownerList) ; $i++) { ?>
                            <option value="<?php echo $ownerList[$i]->id;?>"><?php echo $ownerList[$i]->owner_firstname. "  ".$ownerList[$i]->owner_lastname;?></option>
                            <?php  } } ?>
                               
                </select>
                <div class="invalid-feedback">Please choose owner</div>
              </div>


            
              <div class="form-group">
                 <label> <font color="red">*</font> اسم العقار   </label>

              <input type="text" name="buildingname" id="buildingname" placeholder=" اسم العقار  " autocomplete="off" tabindex="3" class="form-control" required >
        </div>


        <div class="form-row">
           <div class="col">
           <label> <font color="red">*</font> عدد الوحدات السكنية  </label>
		      <input type="number" name="noofhouse" id="noofhouse" placeholder=" عدد الوحدات  " autocomplete="off" tabindex="4" class="form-control" required>
        </div>
         <div class="col">
           <label> <font color="red">*</font> عدد الوحدات التجارية  </label>
          <input type="number" name="noofcommercial" id="noofcommercial" placeholder=" عدد الوحدات  " autocomplete="off" tabindex="5" class="form-control" required>
        </div>
        </div>

        
      
        <div class="form-group">
           <label> <font color="red">*</font> عنوان العقار   </label>
              <input type="text" name="address" id="address" placeholder=" عنوان العقار  " autocomplete="off" tabindex="6" class="form-control" required>
        </div>

         <div class="form-group">
           <label> <font color="red">*</font> موقع العقار على خرائط قوقل   </label>
              <input type="text" name="buildinglocation" id="buildinglocation" placeholder=" موقع العقار على خرائط قوقل  " autocomplete="off" tabindex="7" class="form-control" required>
        </div>
		
		</div>

<input type="submit" name="submitbtn" id="submitbtn" tabindex="9" class="btn btn-primary"  value="إضافة عقار">
		
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