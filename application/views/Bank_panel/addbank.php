<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active"> Add Bank / Bank</li>
          </ol>

	<?php
	//$fcl=array('class'=>'cf','id'=>'form','name'=>'form');
	//echo form_open_multipart('Buildings_controller/insertbuildinginfo',$fcl);
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #428bca;">
                <div class="panel-heading"> إضافة حساب بنكي  </div>
                <div class="panel-body">


 <div class="col-md-12 mx-auto">
	<section id="container">
		<h2> إضافة حساب بنكي  </h2>
		<div id="wrapping" class="clearfix">
			
      <?php
  $fcl=array('class'=>'cf','id'=>'form');
  echo form_open_multipart('Bank_controller/insertbankinfo',$fcl);
?>
			<!--<form name="addownerform" class="needs-validation" novalidate action="<?php echo base_url(); ?>Owners_controller/insertownerinfo" method="post" enctype="multipart/form-data">-->

        <div class="form-group">
          <label><font color=red>*</font> اسم البنك  </label>
		      <input type="text" name="bankname" id="bankname" placeholder="اسم البنك  " autocomplete="off" tabindex="1" class="form-control" required>
        </div>
        
        <div class="form-group">
           <label><font color=red>*</font> اسم المستفيد  </label>
              <input type="text" name="bname" id="bname" placeholder="اسم المستفيد " autocomplete="off" tabindex="2" class="form-control" required>
        </div>
        <div class="form-group">
           <label><font color=red>*</font> رقم الحساب  </label>
              <input type="text" name="accno" id="accno" placeholder="رقم الحساب  " autocomplete="off" tabindex="3" class="form-control" required>
             
        </div>
        
          
<input type="submit" name="submitbtn" id="submitbtn" tabindex="9" class="btn btn-primary"  value=" إضافة حساب بنكي  ">
		
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
