<?php //print_r($unitData); die(); ?>
<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">اللوحة الرئيسية</a>
            </li>
            <li class="breadcrumb-item active"> تعديل الوحدة  / الوحدات السكنية</li>
          </ol>

	<?php
	//$fcl=array('class'=>'cf','id'=>'form','name'=>'form');
	//echo form_open_multipart('Units_controller/insertbuildinginfo',$fcl);
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #428bca;">
                <div class="panel-heading"><h4> تحديث معلومات الوحدة  </h4></div>
                <div class="panel-body">
 <div class="col-md-12 mx-auto">
	<section id="container">
		<h2>تعديل الوحدة </h2>
		<div id="wrapping" class="clearfix">
			
			<form name="addunitsform" class="needs-validation" novalidate action="<?php echo base_url(); ?>Units_controller/editunitinfo" method="post">
            <input type="hidden" id="uid" name="uid" value="<?php if(isset($unitData[0]->uid)) { echo $unitData[0]->uid; } ?>">
              <div class="form-group">
                <label><font color=red>*</font>اسم العقار</label>
                <select class="form-control select2" style="width: 100%;" id="buildingid" name="buildingid" tabindex="1" required>
                	 <option selected value="">اسم العقار</option>
                   <?php
                    if(count($buildingList)>0){
                                    for ($i=0; $i <count($buildingList) ; $i++) { ?>
                            <option 
                            <?php if(isset($unitData[0]->building_id)) { if($unitData[0]->building_id==$buildingList[$i]->id)  {echo "selected";} } ?>
                              value="<?php echo $buildingList[$i]->id;?>" ><?php echo $buildingList[$i]->building_name;?></option>
                            <?php  } } ?>  
                 </select>
                <div class="invalid-feedback">اسم العقار</div>
              </div>


              <div class="form-group">
                <label><font color=red>*</font>  غرض التأجير  </label><br>
                <label class="radio-inline"><input type="radio" name="unitpurpose" id="unitpurpose" value="0" <?php if(isset($unitData[0]->unit_purpose)) { if($unitData[0]->unit_purpose=="0")  {echo "checked";} } ?> >  سكني  </label>
              
               <label class="radio-inline"><input type="radio" name="unitpurpose" id="unitpurpose" value="1" <?php if(isset($unitData[0]->unit_purpose)) { if($unitData[0]->unit_purpose=="1")  {echo "checked";} } ?>> تجاري  </label>
                </div>

              <div class="form-group">
                <label><font color=red>*</font> نوع الوحدة  </label>
                <select class="form-control select2" style="width: 100%;" id="unittype" name="unittype" tabindex="2" required>
                   <option selected value=""> نوع الوحدة  </option>
                  <option <?php if(isset($unitData[0]->unit_type)) {
                   if($unitData[0]->unit_type=='فيلا '){echo"selected";}}?>  value="فيلا  "> فيلا  </option>

                  <option <?php if(isset($unitData[0]->unit_type)) { 
                    if($unitData[0]->unit_type=='دور أرضي '){echo"selected";}}?>  value="دور أرضي  "> دور أرضي  </option>

                  <option <?php if(isset($unitData[0]->unit_type)) {
                   if($unitData[0]->unit_type=='دور علوي  '){echo"selected";}}?> value="دور علوي  "> دور علوي  </option>

                  <option <?php if(isset($unitData[0]->unit_type)) { 
                    if($unitData[0]->unit_type=='شقة '){echo"selected";}}?> value=" شقة  "> شقة  </option>

                  <option <?php if(isset($unitData[0]->unit_type)) { 
                    if($unitData[0]->unit_type=='محل '){echo"selected";}}?> value="محل  "> محل  </option>

                  <option <?php if(isset($unitData[0]->unit_type)) { 
                    if($unitData[0]->unit_type==' معرض  '){echo"selected";}}?> value=" معرض  "> معرض  </option>

                  <option <?php if(isset($unitData[0]->unit_type)) { 
                    if($unitData[0]->unit_type=='ورشة '){echo"selected";}}?> value=" ورشة  "> ورشة  </option>

                  <option <?php if(isset($unitData[0]->unit_type)) { 
                    if($unitData[0]->unit_type==' بيت  '){echo"selected";}}?> value=" بيت  "> بيت  </option>

                  <option <?php if(isset($unitData[0]->unit_type)) { 
                    if($unitData[0]->unit_type==' كشك  '){echo"selected";}}?> value=" كشك  "> كشك  </option>

                  <option <?php if(isset($unitData[0]->unit_type)) { 
                    if($unitData[0]->unit_type==' استراحة '){echo"selected";}}?> value=" استراحة  "> استراحة  </option>
                 </select>
                <div class="invalid-feedback"> نوع الوحدة  </div>
              </div>
       
   
              
        <div class="form-group">
           <label><font color=red>*</font>رقم الدور</label>
              <input type="number" name="floorno" id="floorno" value="<?php if(isset($unitData[0]->floor_no)) { echo $unitData[0]->floor_no; } ?>" autocomplete="off" tabindex="3" class="form-control" required>
        </div>

        <div class="form-group">
          <label><font color=red>*</font>رقم حساب الكهرباء</label>
              <input type="number" name="accno" id="accno" value="<?php if(isset($unitData[0]->electricity_acc_no)) { echo $unitData[0]->electricity_acc_no; } ?>" autocomplete="off" tabindex="5" class="form-control" required>
        </div>

               
		</div>

      <input type="submit" name="submitbtn" id="submitbtn" tabindex="7" class="btn btn-primary"  value="تحديث">		
			<input type="reset" name="reset" id="resetbtn" tabindex="8" class="btn btn-primary" value="مسح">
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