<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard"> اللوحة الرئيسية </a>
            </li>
            <li class="breadcrumb-item active"> تعديل المستخدم /  المستخدم </li>
          </ol>

	<?php
	//$fcl=array('class'=>'cf','id'=>'form','name'=>'form');
	//echo form_open_multipart('Buildings_controller/insertbuildinginfo',$fcl);
?>
 <div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #428bca;">
                <div class="panel-heading">  تعديل المستخدم  </div>
                <div class="panel-body">
 <div class="col-md-12 mx-auto">
	<section id="container">
		<h2> تعديل المستخدم  </h2>
		<div id="wrapping" class="clearfix">
			
      <?php
  $fcl=array('class'=>'cf','id'=>'form');
  echo form_open_multipart('User_controller/edituserinfo',$fcl);
?>
			<!--<form name="addownerform" class="needs-validation" novalidate action="<?php echo base_url(); ?>Owners_controller/insertownerinfo" method="post" enctype="multipart/form-data">-->
        <input type="hidden" name="oid" id="oid" value="<?php if(isset($userData[0]->id)) { echo $userData[0]->id; } ?>">
         <div class="form-group">
          <label><font color=red>*</font> تحديث اسم المستخدم  </label>
          <input type="text" name="username" id="username" value="<?php if(isset($userData[0]->user_name)) { echo $userData[0]->user_name; } ?>" placeholder="Enter User Name" autocomplete="off" tabindex="1" class="form-control" required>
        </div>
        
        <div class="form-group">
           <label><font color=red>*</font> تحديث الاسم الاول  </label>
              <input type="text" name="firstname" id="firstname" value="<?php if(isset($userData[0]->first_name)) { echo $userData[0]->first_name; } ?>"
               placeholder="Enter First Name" autocomplete="off" tabindex="2" class="form-control" required>
        </div>
     

      <div class="form-group">
           <label><font color=red>*</font> تحديث الايميل  </label>
              <input type="email" name="email" id="email" placeholder="Enter Email" value="<?php if(isset($userData[0]->email)) { echo $userData[0]->email; } ?>" autocomplete="off" tabindex="3" class="form-control" required>
        </div>
        <div class="form-group">
           <label><font color=red>*</font> ادخل الوظيفة  </label>
             <select id="role" name="role" tabindex="4" required class="form-control">
               <option value=""> ادخل الوظيفة  </option>
                 <option value="Admin" <?php if ($userData['0']->user_role == "Admin") echo ' selected ';?>> المستخدم الرئيسي  </option>
                 <option value="User" <?php if ($userData['0']->user_role == "User") echo ' selected ';?>> المستخدم  </option>
             
             </select>
             
        </div>

<input type="submit" name="submitbtn" id="submitbtn" tabindex="5" class="btn btn-primary"  value=" تعديل المستخدم  ">
		
			<input type="reset" name="reset" id="resetbtn" tabindex="6" class="btn btn-primary" value=" مسح ">
			
			
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
