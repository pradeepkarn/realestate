<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard"> اللوحة الرئيسية
 </a>
            </li>
            <li class="breadcrumb-item active"> إضافة إعلان </li>
          </ol>

	 
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #428bca;">
                <div class="panel-heading"> إضافة إعلان </div>
                <div class="panel-body">


 <div class="col-md-12 mx-auto">
	<section id="container">
		<h2> إضافة إعلان </h2>
		<div id="wrapping" class="clearfix">
			
      <?php
  $fcl=array('class'=>'cf','id'=>'form');
  echo form_open_multipart('Ad_controller/insertadinfo',$fcl);
?>
		  <div class="form-group">
          <label><font color=red>*</font>  غرض </label>
		     <select class="form-control" id="purpose" name="purpose" required>
                                <option value="">-تحديد-</option> 
                                <option value="1"> تأجير </option>
                                <option value="2"> بيع </option>
                               
                           </select>
        </div>

        <div class="form-group">
          <label><font color=red>*</font> عنوان الإعلان </label>
		      <input type="text" name="subject" id="subject" placeholder=" عنوان الإعلان " autocomplete="off" tabindex="1" class="form-control" required>
        </div>
        
         <div class="form-group">
          <label> الحي </label>
              <input type="text" name="district" id="district" placeholder=" الحي " autocomplete="off" tabindex="2" class="form-control" required >
        </div>

         <div class="form-group">
          <label> المدينة </label>
              <input type="text" required name="city" id="city" placeholder=" المدينة " autocomplete="off" tabindex="2" class="form-control" >
        </div>
        
         <div class="form-group">
          <label>  الموقع</label>
              <input type="text" name="location" id="location" placeholder=" الموقع " autocomplete="off" tabindex="3" class="form-control" >
        </div>

         <div class="form-group">
          <label> نوع العقار </label>
             
             <select class="form-control select2" style="width: 100%;" id="propertyType" name="propertyType" tabindex="1" required>
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
               
        </div>
        

          <div class="form-group">
             <label> صور العقار </label>
             <input type="file" class="form-control" id="file_name" name="file_name[]" multiple>
          </div>

         <div class="form-group">
          <label> عمر العقار  </label>
              <input type="text" name="propertyAge" id="propertyAge" placeholder=" عمر العقار " autocomplete="off" tabindex="5" class="form-control" >
        </div>
        <div class="form-group">
          <label> مساحة العقار  </label>
              <input type="text" name="propertyAreaSize" id="propertyAreaSize" placeholder=" مساحة العقار " autocomplete="off" tabindex="5" class="form-control" >
        </div>
        <div class="form-group">
          <label> عدد الأدوار </label>
              <input type="text" name="floorNo" id="floorNo" placeholder=" عدد الأدوار " autocomplete="off" tabindex="6" class="form-control" >
        </div>
        <div class="form-group">
          <label> عدد الغرف </label>
              <input type="text" name="roomNo" id="roomNo" placeholder=" عدد الغرف " autocomplete="off" tabindex="6" class="form-control" >
        </div>
        <div class="form-group">
          <label> عدد دورات المياه </label>
              <input type="text" name="bathroomNo" id="bathroomNo" placeholder=" عدد دورات المياه " autocomplete="off" tabindex="6" class="form-control" >
        </div>

        <div class="form-group">
          <label> مؤثث: نعم/لا </label>
              <input type="text" name="furnitureAvailability" id="furnitureAvailability" placeholder=" مؤثث: نعم/لا " autocomplete="off" tabindex="6" class="form-control" >
        </div>

        <div class="form-group">
          <label> طريقة الدفعات  </label>
              <input type="text" name="paymentMethod" id="paymentMethod" placeholder=" طريقة الدفعات " autocomplete="off" tabindex="6" class="form-control" >
        </div>
        
        <div class="form-group">
          <label> القيمة  </label>
              <input type="text" name="amount" id="amount" placeholder=" القيمة " autocomplete="off" tabindex="6" class="form-control" >
        </div>

        <div class="form-group">
          <label> التفاصيل  </label>
              <input type="text" name="details" id="details" placeholder=" التفاصيل " autocomplete="off" tabindex="6" class="form-control" >
        </div>
        
        
        <!-- <div class="form-group">-->
        <!--  <label> إظهار في الموقع </label>-->
        <!--     <input type="checkbox" id="showWebsite" name="showWebsite" value="1">-->
        <!--</div>       -->
        
          
            <input type="submit" name="submitbtn" id="submitbtn" tabindex="9" class="btn btn-primary"  value=" إضافة الإعلان  ">
		
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
