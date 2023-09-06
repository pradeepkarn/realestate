<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">اللوحة الرئيسية</a>
            </li>
            <li class="breadcrumb-item active"> إضافة مستأجر / المستأجرين</li>
          </ol>

	<?php
	//$fcl=array('class'=>'cf','id'=>'form','name'=>'form');
	//echo form_open_multipart('Buildings_controller/insertbuildinginfo',$fcl);
?><div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #428bca;">
                <div class="panel-heading"> إضافة مستأجر  </div>
                <div class="panel-body">
 <div class="col-md-12 mx-auto">
	<section id="container">
		<h2>إضافة مستأجر </h2>
		<div id="wrapping" class="clearfix">
			
      <?php
  $fcl=array('class'=>'cf','id'=>'form');
  echo form_open_multipart('Tenants_controller/inserttenantinfo',$fcl);
?>
			<!--<form name="addownerform" class="needs-validation" novalidate action="<?php echo base_url(); ?>Owners_controller/insertownerinfo" method="post" enctype="multipart/form-data">-->

        <div class="form-group">
          <label><font color=red>*</font>اسم المستأجر الاول</label>
		      <input type="text" name="firstname" id="firstname" placeholder="اسم المستأجر الاول" autocomplete="off" tabindex="1" class="form-control" required>
        </div>
        
       <!--  <div class="form-group">
           <label><font color=red>*</font>اسم المستأجر الأخير</label>
              <input type="text" name="lastname" id="lastname" placeholder="اسم المستأجر الأخير" autocomplete="off" tabindex="2" class="form-control" required>
        </div>
        <div class="form-group">
           <label><font color=red>*</font>رقم هوية المستأجر</label>
              <input type="text" name="iqama" id="iqama" placeholder="رقم هوية المستأجر" autocomplete="off" tabindex="3" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" maxlength="10" minlength="10" required>
              <div class="invalid-feedback">Please Enter 10 digits</div>
        </div>
        
           <div class="form-group">
             <label><font color=red>*</font>رفع نسخة من الهوية</label>
        <input type="file" class="form-control-file" id="file_name" name="file_name">
  </div> -->
       
      
   
</div>
        <div class="form-group">
           <label><font color=red>*</font>رقم الجوال</label>
              <input type="text" name="mobile" id="mobile" placeholder="رقم الجوال" autocomplete="off" tabindex="5" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" maxlength="10" minlength="10" required>
              <div class="invalid-feedback">Please Enter 10 digits</div>
        </div>

 <!--  <div class="form-group">
     <label><font color=red>*</font>البريد الإلكتروني للمستأجر</label>
                   <input type="email" id="tenantemail" name="tenantemail" class="form-control mb-4" placeholder="البريد الإلكتروني للمستأجر" tabindex="7">

              </div>
		 -->

<input type="submit" name="submitbtn" id="submitbtn" tabindex="9" class="btn btn-primary"  value="إضافة مستأجر">
		
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
<script >
  // Data Picker Initialization
$('.datepicker').datepicker();
</script>