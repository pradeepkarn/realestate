<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard"> اللوحة الرئيسية
 </a>
            </li>
            <li class="breadcrumb-item active"> Edit Ad / Ad</li>
          </ol>

	 
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #428bca;">
                <div class="panel-heading"> Edit Advertisement </div>
                <div class="panel-body">


 <div class="col-md-12 mx-auto">
	<section id="container">
		<h2> Edit Advertisement</h2>
		<div id="wrapping" class="clearfix">
			
      <?php
  $fcl=array('class'=>'cf','id'=>'form');
  echo form_open_multipart('Ad_controller/editadinfo',$fcl);
?>
		 <input type="hidden" name="oid" id="oid" value="<?php if(isset($adData[0]->adid)) { echo $adData[0]->adid; } ?>">


         <div class="form-group">
          <label><font color=red>*</font>  غرض </label>
		     <select class="form-control" id="purpose" name="purpose" required>
                                <option value="">-تحديد-</option> 
                                <option value="1" <?php if(isset($adData[0]->purpose)) { if($adData[0]->purpose=='1'){?> selected <?php } } ?> >  تأجير </option>
                                <option value="2" <?php if(isset($adData[0]->purpose)) { if($adData[0]->purpose=='2'){?> selected <?php } } ?> > بيع </option>
                               
                           </select>
        </div>
        
        <div class="form-group">
          <label><font color=red>*</font> عنوان الإعلان </label>
		      <input type="text" name="subject" id="subject" value="<?php if(isset($adData[0]->subject)) { echo $adData[0]->subject; } ?>" placeholder="Enter Subject " autocomplete="off" tabindex="1" class="form-control" required>
        </div>

          <div class="form-group">
          <label>  الحي </label>
              <input type="text" name="district" id="district" value="<?php if(isset($adData[0]->district)) { echo $adData[0]->district; } ?>" placeholder="Enter district " autocomplete="off" tabindex="2" class="form-control" >
        </div>
        
         <div class="form-group">
          <label> المدينة </label>
              <input type="text" name="city" id="city" value="<?php if(isset($adData[0]->city)) { echo $adData[0]->city; } ?>" placeholder="Enter City " autocomplete="off" tabindex="2" class="form-control" >
        </div>
        
         <div class="form-group">
          <label> الموقع</label>
              <input type="text" name="location" id="location" value="<?php if(isset($adData[0]->location)) { echo $adData[0]->location; } ?>" placeholder="Enter Location " autocomplete="off" tabindex="3" class="form-control" >
        </div>

         <div class="form-group">
          <label> نوع العقار </label>
              <input type="text" name="propertyType" id="propertyType" value="<?php if(isset($adData[0]->propertyType)) { echo $adData[0]->propertyType; } ?>" placeholder="Enter Property Type " autocomplete="off" tabindex="4" class="form-control" >
        </div>
        

          <div class="form-group">
             <label> صور العقار </label>
            

             <?php if(isset($adData[0]->file_name)) { 
              $img = explode(",", $adData[0]->file_name);
                                       
                                        for($i=0;$i<count($img);$i++)
                                        { ?>
                                            <img src="<?php echo base_url();?>img/propertyImage/<?php echo $img[$i];?>" width="100" height="100">

                                              
                                       <?php } } ?> 
             <input type="file" class="form-control" id="file_name" name="file_name[]" multiple>
          </div>

         <div class="form-group">
          <label>  عمر العقار </label>
              <input type="text" value="<?php if(isset($adData[0]->propertyAge)) { echo $adData[0]->propertyAge; } ?>" name="propertyAge" id="propertyAge" placeholder="Enter Property Age " autocomplete="off" tabindex="5" class="form-control" >
        </div>
        <div class="form-group">
          <label> مساحة العقار  </label>
              <input type="text" name="propertyAreaSize" id="propertyAreaSize" value="<?php if(isset($adData[0]->propertyAreaSize)) { echo $adData[0]->propertyAreaSize; } ?>" placeholder="Enter Property Area Size " autocomplete="off" tabindex="5" class="form-control" >
        </div>
        <div class="form-group">
          <label>  عدد الأدوار </label>
              <input type="text" name="floorNo" id="floorNo" value="<?php if(isset($adData[0]->floorNo)) { echo $adData[0]->floorNo; } ?>" placeholder="Enter Floor Number" autocomplete="off" tabindex="6" class="form-control" >
        </div>
        <div class="form-group">
          <label> عدد الغرف </label>
              <input type="text" name="roomNo" id="roomNo" value="<?php if(isset($adData[0]->roomNo)) { echo $adData[0]->roomNo; } ?>" placeholder="Enter Room Number" autocomplete="off" tabindex="6" class="form-control" >
        </div>
        <div class="form-group">
          <label> عدد دورات المياه </label>
              <input type="text" name="bathroomNo" id="bathroomNo" value="<?php if(isset($adData[0]->bathroomNo)) { echo $adData[0]->bathroomNo; } ?>" placeholder="Enter Bathroom Number" autocomplete="off" tabindex="6" class="form-control" >
        </div>

        <div class="form-group">
          <label> مؤثث: نعم/لا  </label>
              <input type="text" name="furnitureAvailability" id="furnitureAvailability" value="<?php if(isset($adData[0]->furnitureAvailability)) { echo $adData[0]->furnitureAvailability; } ?>" placeholder="Enter Furniture Availability" autocomplete="off" tabindex="6" class="form-control" >
        </div>
        
        

        <div class="form-group">
          <label> طريقة الدفعات  </label>
              <input type="text" name="paymentMethod" id="paymentMethod" value="<?php if(isset($adData[0]->paymentMethod)) { echo $adData[0]->paymentMethod; } ?>" placeholder="Enter Payment Method" autocomplete="off" tabindex="6" class="form-control" >
        </div>

         <div class="form-group">
          <label> القيمة  </label>
              <input type="text" name="amount" id="amount" value="<?php if(isset($adData[0]->amount)) { echo $adData[0]->amount; } ?>" placeholder="Enter Amount" autocomplete="off" tabindex="6" class="form-control" >
        </div>
        
         <div class="form-group">
          <label>  التفاصيل  </label>
              <input type="text" name="details" id="details" value="<?php if(isset($adData[0]->details)) { echo $adData[0]->details; } ?>" placeholder="Enter Details" autocomplete="off" tabindex="6" class="form-control" >
        </div>
        
        <!-- <div class="form-group">-->
        <!--  <label> إظهار في الموقع  </label>-->
        <!--     <input type="checkbox" id="showWebsite" <?php if($adData[0]->showWebsite==1) { echo 'checked';} ?> name="showWebsite" value="1">-->
        <!--</div>       -->
        
          
<input type="submit" name="submitbtn" id="submitbtn" tabindex="9" class="btn btn-primary"  value=" Edit Ad">
		
			<input type="reset" name="reset" id="resetbtn" tabindex="10" class="btn btn-primary" value="مسح ">
			
			
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
