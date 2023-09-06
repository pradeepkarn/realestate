
<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">اللوحة الرئيسية</a>
            </li>
            <li class="breadcrumb-item active">  Insurance Statement </li>
          </ol>
          <center>
          <?php if(!empty($this->uri->segment(3))) { echo "Please clear the insurance amount"; } ?></center>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #428bca;">
                <div class="panel-heading"> Insurance Statement </div>
                <div class="panel-body">
  
 <div class="col-md-12 mx-auto">
  <section id="container">
    <h2>Insurance Statement </h2>
    <div id="wrapping" class="clearfix">
   
</div>
    
    
    <div id="wrapping" class="clearfix">
      

      <?php
 //$fcl=array('class'=>'cf','id'=>'form');
//  echo form_open_multipart('Statement_controller/insurancestatementcalc',$fcl);
?>
     <form name="addreceiptform" class="needs-validation" onsubmit="return checkPrice()" action="<?php echo base_url(); ?>Statement_controller/insurancestatementcalc" method="post" enctype="multipart/form-data">

   <div class="form-group">
   <label for="buildingid"><font color=red>*</font>اسم العقار </label>
       <select class="form-control select2" style="width: 100%;" id="buildingid" name="buildingid" tabindex="1" required>
                   <option selected value=""> اسم العقار </option>
                   <?php
                    if(count($buildingList)>0){
                                    for ($i=0; $i <count($buildingList) ; $i++) { ?>
                            <option value="<?php echo $buildingList[$i]->id;?>"><?php echo $buildingList[$i]->building_name;?></option>
                            <?php  } } ?>  
                 </select>
        </div>
   
 <div class="form-group">
      <label for="tenantid"><font color=red>*</font> اسم المستأجر </label>
                <select class="form-control select2" style="width: 100%;" id="tenantid" name="tenantid" tabindex="2" required>
                   <option selected value=""> اسم المستأجر </option>
                  </select>
                <div class="invalid-feedback">اسم المستأجر </div>
              </div>


              <div class="form-group">
      <label for="contractnumber"><font color=red>*</font> Contract Number </label>
               <input type="text" id="contractnumber" name="contractnumber" value="" class="form-control select2" style="width: 100%;" tabindex="3">
               <input type="hidden" id="contractid" name="contractid" value="" class="form-control select2" style="width: 100%;" tabindex="3">
              </div> 

              <div class="form-group">
      <label for="amountid"><font color=red>*</font> Insurance Amount </label>
               <input type="text" id="amountid" name="amountid" value="" class="form-control select2" style="width: 100%;" tabindex="4">
                
              </div>



              <div class="form-group">
      <label for="amountdeduct"><font color=red>*</font> Amount to be deduct </label>
               <input type="text" id="amountdeduct" name="amountdeduct" value="" class="form-control select2" style="width: 100%;" tabindex="5">
                <div class="invalid-feedback">Amount to be deduct</div>
              </div>

              <div class="form-group">
           <label for="rentamount"><font color=red>*</font> طريقة السداد  </label> 
 <select class="form-control select2" style="width: 100%;" id="paymenttype" name="paymenttype" tabindex="4" required>
        <option selected value=""> طريقة السداد  </option>
         <option value="Cash"> نقدا </option>
          <option value="Cheque"> شيك  </option>
           <option value="Transfer"> تحويل  </option>
            <option value="Card"> بطاقة  </option>

      </select>
</div>


   <div class="form-group" style="display: none;" id="bankdiv">
           <label for="bank"><font color=red>*</font> بنك  </label> 
 <select class="form-control select2" style="width: 100%;" id="bankid" name="bankid" tabindex="5">
                   <option selected value=""> بنك  </option>
                   <?php
                    if(count( $bankList)>0){
                                    for ($i=0; $i <count($bankList) ; $i++) { ?>
                            <option value="<?php echo $bankList[$i]->id;?>"><?php echo $bankList[$i]->bank_name;?></option>
                            <?php  } } ?>  
                 </select>
</div>

          <div class="form-group">
           <label> الوصف  (Optional)</label>
             <textarea class="form-control" id="desc" name="desc" tabindex="8" rows="3" tabindex="10"></textarea>
        </div>

       
      <input type="submit" name="submitbtn" id="submitbtn" tabindex="3" class="btn btn-primary"  value=" View Insurance Statement">
      <input type="reset" name="reset" id="resetbtn" tabindex="4" class="btn btn-primary" value="مسح ">
   
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


  <script>
    $(document).ready(function(){

      $('#buildingid').change(function(){

        var building_id=$('#buildingid').val();      
       
        if(building_id !='')
        {

          $.ajax({
           //url:"http://localhost/realestate/Contracts_controller/getunits",
            url:"<?php echo base_url();?>Statement_controller/gettenants",
            method: "POST",
            data: {building_id:building_id},
            success:function(data)
            {
              //$('#owner').html(data);
             // var field = data.split('//');
              $('#tenantid').html(data);
              //$('#ownerid').val(field[1]);
            }
          })
        }
      });
    });

    $(document).ready(function(){

      $('#tenantid').change(function(){

        var building_id=$('#buildingid').val();   
          var tenant_id=$('#tenantid').val(); 
       
        if(tenant_id !='')
        {

          $.ajax({
           //url:"http://localhost/realestate/Contracts_controller/getunits",
            url:"<?php echo base_url();?>Statement_controller/getinsuranceamount",
            method: "POST",
            data: {building_id:building_id,tenant_id:tenant_id},
            success:function(data)
            {
               var field = data.split('//');
               $('#contractnumber').val(field[0]);
              $('#amountid').val(field[1]);
              $('#contractid').val(field[2]);
            }
          })
        }
      });
    });
    $(document).ready(function () {
        $('#paymenttype').change(function () {
       var  paymenttype= $('#paymenttype').val();
            if ($('#paymenttype').val() == 'Cash')
             {
                 $('#bankdiv').hide();
              }
               if ($('#paymenttype').val() == 'Card' || $('#paymenttype').val() == 'Cheque' || $('#paymenttype').val() == 'Transfer' )
             {
                 $('#bankdiv').show();


              }
        });
    });
  </script>
<script>
function checkPrice(){
    var lastprice = parseFloat(document.getElementById('amountid').value);
    var harga = parseFloat(document.getElementById('amountdeduct').value);
    
    if (isNaN(lastprice) || isNaN(harga)) {
        alert("Entered values are not numeric.");
        return false;
    }
    
    if (harga > lastprice) {
        alert("Please enter the amount less than insurance amount");
        return false;
    }
    
    return true;
}
</script>