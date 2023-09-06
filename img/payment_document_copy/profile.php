<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active"> Edit Profile</li>
          </ol>

  <?php
  //$fcl=array('class'=>'cf','id'=>'form','name'=>'form');
  //echo form_open_multipart('Buildings_controller/insertbuildinginfo',$fcl);
?>
 <div class="col-md-8 mx-auto">
  <section id="container">
    <h2>Edit Profile</h2>
    <div id="wrapping" class="clearfix">
      
      <?php
  //$fcl=array('class'=>'cf','id'=>'form');
  //echo form_open_multipart('Admin_controller/editprofileinfo',$fcl);
?>
<form action="<?php echo base_url(); ?>Admin_controller/editprofileinfo" method="post"
      oninput='cpwd.setCustomValidity(pwd.value != cpwd.value ? "Passwords do not match." : "")'>
  <p>
      <!--<form name="addownerform" class="needs-validation" novalidate action="<?php echo base_url(); ?>Owners_controller/insertownerinfo" method="post" enctype="multipart/form-data">-->
        <input type="hidden" name="oid" id="oid" value="<?php //if(isset($userData[0]->id)) { echo $userData[0]->id; } ?>">
         <div class="form-group">
          <label>Update User Name</label>
          <input type="text" name="username" id="username" value="<?php if(isset($userData[0]->user_name)) { echo $userData[0]->user_name; } ?>" placeholder="Enter User Name" autocomplete="off" tabindex="1" class="form-control" required>
        </div>
        
        <div class="form-group">
           <label>Update First Name</label>
              <input type="text" name="firstname" id="firstname" value="<?php if(isset($userData[0]->first_name)) { echo $userData[0]->first_name; } ?>"
               placeholder="Enter First Name" autocomplete="off" tabindex="2" class="form-control" required>
        </div>


<input type="hidden" name="oldpwd" id="oldpwd" 
               autocomplete="off" tabindex="3" class="form-control" value="<?php if(isset($userData[0]->password)) { echo $userData[0]->password; } ?>" >
       
         <div class="form-group">
           <label>Update Password</label>
              <input type="password" name="pwd" id="pwd" 
               placeholder="Enter New Password" autocomplete="off" tabindex="3" class="form-control" value="" >
        </div>

         <div class="form-group">
           <label>Enter Confirm Password</label>
              <input type="password" name="cpwd" id="cpwd" 
               placeholder="Enter Confirm Password" autocomplete="off" tabindex="4" class="form-control">
        </div>
     

      <div class="form-group">
           <label>Update Email</label>
              <input type="email" name="email" id="email" placeholder="Enter Email" value="<?php if(isset($userData[0]->email)) { echo $userData[0]->email; } ?>" autocomplete="off" tabindex="5" class="form-control" required>
        </div>
        <div class="form-group">
           <label>Update Role</label>
             <select id="role" name="role" tabindex="6" required class="form-control">
               <option value="">Select Role</option>
                 <option value="Admin" <?php if ($userData['0']->user_role == "Admin") echo ' selected ';?>>Admin</option>
                 <option value="User" <?php if ($userData['0']->user_role == "User") echo ' selected ';?>>User</option>
             
             </select>
             
        </div>

<input type="submit" name="submitbtn" id="submitbtn" tabindex="7" class="btn btn-primary"  value="Edit Profile">
    
      <input type="reset" name="reset" id="resetbtn" tabindex="8" class="btn btn-primary" value="Reset">
      
      
  </section>
</form>
</div>
</section>
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
