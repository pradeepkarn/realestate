<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">اللوحة الرئيسية</a>
            </li>
            <li class="breadcrumb-item active"> تعديل المستأجر / المستأجرين</li>
          </ol>

  <?php
  //$fcl=array('class'=>'cf','id'=>'form','name'=>'form');
  //echo form_open_multipart('Buildings_controller/insertbuildinginfo',$fcl);
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #428bca;">
                <div class="panel-heading"> عديل المستأجر  </div>
                <div class="panel-body">
 <div class="col-md-12 mx-auto">
  <section id="container">
    <h2>تعديل المستأجر </h2>
    <div id="wrapping" class="clearfix">
      
      <?php
  $fcl=array('class'=>'cf','id'=>'form');
  echo form_open_multipart('Tenants_controller/edittenantinfo',$fcl);
?>
      <!--<form name="addtenantform" class="needs-validation" novalidate action="<?php echo base_url(); ?>tenants_controller/inserttenantinfo" method="post" enctype="multipart/form-data">-->
        <input type="hidden" name="oid" id="oid" value="<?php if(isset($tenantData[0]->id)) { echo $tenantData[0]->id; } ?>">
        <div class="form-group">
           <label><font color=red>*</font>اسم المستأجر الاول</label>
          <input type="text" name="firstname" id="firstname" value="<?php if(isset($tenantData[0]->tenant_firstname)) { echo $tenantData[0]->tenant_firstname; } ?>" autocomplete="off" tabindex="1" class="form-control" required>
        </div>
        
       <!--  <div class="form-group">
          <label><font color=red>*</font>اسم المستأجر الأخير</label>
              <input type="text" name="lastname" id="lastname"  value="<?php if(isset($tenantData[0]->tenant_lastname)) { echo $tenantData[0]->tenant_lastname; } ?>"autocomplete="off" tabindex="2" class="form-control" required>
        </div>
        <div class="form-group">
           <label><font color=red>*</font>رقم هوية المستأجر</label>
              <input type="text" name="iqama" id="iqama" value="<?php if(isset($tenantData[0]->tenant_iqama)) { echo $tenantData[0]->tenant_iqama; } ?>" autocomplete="off" tabindex="3" class="form-control" oninput="this.value=this.value.replace(/[^0-9]/g,'');" maxlength="10" minlength="10" required>
              <div class="invalid-feedback">Please Enter 10 digits</div>
        </div>
         <div class="form-group">

           <div class="form-group">
    <label><font color=red>*</font>رفع نسخة من الهوية</label>

    <input type="file" class="form-control-file" id="file_name"  name="file_name">
    <label><?php if(isset($tenantData[0]->id_copy)) { echo "<font color=blue>"; echo $tenantData[0]->id_copy; echo "</font>"; } ?> </label>
    <input type="hidden" id="filename" name="filename" value=<?php if(isset($tenantData[0]->id_copy)) { echo $tenantData[0]->id_copy; } ?> >
  </div> -->
       
      
   
</div>
        <div class="form-group">
           <label><font color=red>*</font>رقم الجوال</label>
              <input type="text" name="mobile" id="mobile" value="<?php if(isset($tenantData[0]->mobile_number)) { echo $tenantData[0]->mobile_number; } ?>" autocomplete="off" tabindex="5" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control" maxlength="10" minlength="10" required>
              <div class="invalid-feedback">Please Enter 10 digits</div>
        </div>

  <!-- <div class="form-group">
     <label><font color=red>*</font>البريد الإلكتروني للمستأجر</label>
                   <input type="email" id="tenantemail" name="tenantemail" class="form-control mb-4" value="<?php if(isset($tenantData[0]->email)) { echo $tenantData[0]->email; } ?>" tabindex="7">

              </div>
     
        
    </div> -->

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
