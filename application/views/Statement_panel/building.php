
<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">اللوحة الرئيسية</a>
            </li>
            <li class="breadcrumb-item active"> المباني / كشوف الحسابات</li>
          </ol>

  <div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #428bca;">
                <div class="panel-heading"> كشف حساب العقار  </div>
                <div class="panel-body">
 <div class="col-md-12 mx-auto">
  <section id="container">
    <h2>كشف حساب العقار</h2>
    <div id="wrapping" class="clearfix">
   
</div>
    
    
    <div id="wrapping" class="clearfix">
      

      <?php
 $fcl=array('class'=>'cf','id'=>'form');
  echo form_open_multipart('Statement_controller/buildingstatementinfo',$fcl);
?>
   <!--   <form name="addreceiptform" class="needs-validation" novalidate action="<?php echo base_url(); ?>Receipt_controller" method="post" enctype="multipart/form-data">-->

   <div class="form-group">
   <label for="buildingid"><font color=red>*</font>اسم العقار</label>
       <select class="form-control select2" style="width: 100%;" id="buildingid" name="buildingid" tabindex="1" required>
                   <option selected value="">اسم العقار</option>
                   <?php
                    if(count($buildingList)>0){
                                    for ($i=0; $i <count($buildingList) ; $i++) { ?>
                            <option value="<?php echo $buildingList[$i]->id;?>"><?php echo $buildingList[$i]->building_name;?></option>
                            <?php  } } ?>  
                 </select>
        </div>
   
  <div >
           <label>  من تاريخ : </label>
             <input type="date" id="startdate" class="form-control" name="startdate" style="width: 60%;margin-top: 20px;margin-left: 20px;margin-bottom: 20px;" 
             value="<?php if(isset($start)){ echo $start; } ?>">           
       
           <label> الى تاريخ : </label>
             <input type="date" id="enddate" name="enddate" class="form-control" style="width: 60%;margin-top: 20px;margin-left: 20px;margin-bottom: 20px;" 
              value="<?php if(isset($end)){ echo $end; } ?>">           
        </div>
        </div>
      </section>
          
      <input type="submit" name="submitbtn" id="submitbtn" tabindex="2" class="btn btn-primary"  value="كشف حساب العقار ">
      <input type="reset" name="reset" id="resetbtn" tabindex="3" class="btn btn-primary" value="مسح ">
   
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




  