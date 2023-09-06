<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard"> اللوحة الرئيسية </a>
            </li>
            <li class="breadcrumb-item active"> اضافة مستخدم جديد   /  المستخدم   </li>
          </ol>

    <?php
    //$fcl=array('class'=>'cf','id'=>'form','name'=>'form');
    //echo form_open_multipart('Buildings_controller/insertbuildinginfo',$fcl);
?><div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #428bca;">
                <div class="panel-heading"> اضافة مستخدم جديد  </div>
                <div class="panel-body">
 <div class="col-md-12 mx-auto">

    <section id="container">
        <h2> اضافة مستخدم جديد  </h2>
        <div id="wrapping" class="clearfix">
            
      <?php
  $fcl=array('class'=>'cf','id'=>'form');
  echo form_open_multipart('User_controller/insertuserinfo',$fcl);
?>
            <!--<form name="addownerform" class="needs-validation" novalidate action="<?php echo base_url(); ?>Owners_controller/insertownerinfo" method="post" enctype="multipart/form-data">-->

        <div class="form-group">
          <label><font color=red>*</font> ادخل اسم المستخدم  </label>
              <input type="text" name="username" id="username" placeholder=" ادخل اسم المستخدم  " autocomplete="off" tabindex="1" class="form-control" required>
        </div>
        <div class="form-group">
          <label><font color=red>*</font> ادخل اسم المستخدم الاول  </label>
              <input type="text" name="firstname" id="fristname" placeholder=" ادخل اسم المستخدم الاول  " autocomplete="off" tabindex="2" class="form-control" required>
        </div>
        <div class="form-group">
          <label><font color=red>*</font> ادخل كلمة المرور  </label>
              <input type="Password" name="pwd" id="pwd" placeholder=" ادخل كلمة المرور  " autocomplete="off" tabindex="3" class="form-control" required>
        </div>
        
        <div class="form-group">
           <label><font color=red>*</font> ادخل الايميل  </label>
              <input type="email" name="email" id="email" placeholder=" ادخل الايميل  " autocomplete="off" tabindex="4" class="form-control" required>
        </div>
        <div class="form-group">
           <label><font color=red>*</font> ادخل الوظيفة  </label>
             <select id="role" name="role" tabindex="5" required class="form-control">
               <option value=""> ادخل الوظيفة  </option>
               <option value="Admin"> المستخدم الرئيسي  </option>
               <option value="User"> المستخدم  </option>
             </select>
             
        </div>
        
          
<input type="submit" name="submitbtn" id="submitbtn" tabindex="6" class="btn btn-primary"  value=" اضافة مستخدم جديد  ">
        
            <input type="reset" name="reset" id="resetbtn" tabindex="7" class="btn btn-primary" value=" مسح  ">
            
            
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