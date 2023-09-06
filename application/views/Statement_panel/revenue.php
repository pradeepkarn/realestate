
<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">اللوحة الرئيسية</a>
            </li>
            <li class="breadcrumb-item active"> كشف حساب الدخل  </li>
          </ol>

  <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #428bca;">
                <div class="panel-heading"> كشف حساب الدخل  </div>
                <div class="panel-body">
 <div class="col-md-12 mx-auto">
  <section id="container">
    <h2> كشف حساب الدخل </h2>
    <div id="wrapping" class="clearfix">
   
</div>
    
    
    <div id="wrapping" class="clearfix">
      

      <?php
 $fcl=array('class'=>'cf','id'=>'form');
  echo form_open_multipart('Statement_controller/revenuestatementinfo',$fcl);
?>
   <!--   <form name="addreceiptform" class="needs-validation" novalidate action="<?php echo base_url(); ?>Receipt_controller" method="post" enctype="multipart/form-data">-->

   <div class="container">
        
    
        <div >
           <label> من تاريخ : </label>
             <input type="date" id="startdate" name="startdate" class="form-control" style="width: 35%;margin-top: 20px;margin-left: 20px;margin-bottom: 20px;" 
             value="<?php if(isset($start)){ echo $start; } ?>">           
       
           <label> الى تاريخ : </label>
             <input type="date" id="enddate" name="enddate" class="form-control" style="width: 35%;margin-top: 20px;margin-bottom: 20px;"
              value="<?php if(isset($end)){ echo $end; } ?>">           
        </div>
        
                 
      <input type="submit" name="submitbtn" id="submitbtn" tabindex="2" class="btn btn-primary"  value=" كشف حساب الدخل  " style="margin-top: 20px;">
      <input type="reset" name="reset" id="resetbtn" tabindex="3" class="btn btn-primary" value="مسح " style="margin-top: 20px;">
   
  </div>
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




  