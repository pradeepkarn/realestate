<?php //print_r($ownerList); die(); ?>
<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">  اللوحة الرئيسية  </a>
            </li>
            <li class="breadcrumb-item active"> إضافة سند صرف   / سندات الصرف  </li>
          </ol>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #428bca;">
                <div class="panel-heading"> إضافة سند صرف  </div>
                <div class="panel-body">
  
 <div class="col-md-12 mx-auto">
  <section id="container">
    <h2> سندات الصرف  </h2>
    <div id="wrapping" class="clearfix">
      
      <?php
 $fcl=array('class'=>'cf','id'=>'form');
  echo form_open_multipart('Payment_controller/insertpaymentinfo',$fcl);
?>
 
   <div class="form-group">
   <label for="buildingid"><font color=red>*</font> مالك العقار  </label>
       <select class="form-control select2" style="width: 100%;" id="ownerid" name="ownerid" tabindex="1" required>
                   <option selected value=""> مالك العقار </option>
                   <?php
                    if(count($ownerList)>0){
                                    for ($i=0; $i <count($ownerList) ; $i++) { ?>
                            <option value="<?php echo $ownerList[$i]->id;?>"><?php echo $ownerList[$i]->owner_firstname.' '.$ownerList[$i]->owner_lastname;?></option>
                            <?php  } } ?>  
                 </select>
        </div>

    <div class="form-group">
      <label for="inputEmail4"> اسم العقار  </label>
      <select class="form-control select2" style="width: 100%;" id="buildingid" name="buildingid" tabindex="2" required>
        <option selected value=""> اسم العقار </option>
      </select>
    </div>


     <div class="form-group">
      <label for="inputEmail4"> رقم الوحدة  </label>
      <select class="form-control select2" style="width: 100%;" id="unitid" name="unitid" tabindex="3" required>
        <option selected value=""> رقم الوحدة </option>
      </select>
    </div>

    <input type="hidden" name="contractno" id="contractno"  tabindex="6" class="form-control"  readonly>
     <input type="hidden" name="installmentno" id="installmentno"  tabindex="6" class="form-control"  readonly>
      <input type="hidden" name="installmentstatus" id="installmentstatus"  tabindex="6" class="form-control"  readonly>
 
     <div class="form-group">
          <label for="paymentamount"><font color=red>*</font> مبلغ و قدره  </label>
           <div class="input-group flex-nowrap">
  <!--<div class="input-group-prepend">
    <span class="input-group-text" id="addon-wrapping">00.</span>
  </div>-->
              <input type="text" name="paymentamount" id="paymentamount"  tabindex="6" class="form-control"  readonly>
             
        </div>
      
      <div class="form-row">
             <div class="form-group col-md-6">
              <label for="installmentstartdate"><font color=red>*</font> عن الفترة من تاريخ  </label>
       <input type="text" class="form-control"  id="startdate" name="startdate"  tabindex="7" readonly>
    </div>
 
 <div class="form-group col-md-6">
       <label for="installmentenddate"><font color=red>*</font> إلى تاريخ  </label>
      <input type="text" class="form-control"  id="enddate" name="enddate"  tabindex="8" readonly>
    </div>
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
           <label><font color=red>*</font> نسخة من مستند السداد  </label>
              <input type="file" name="file_name" id="file_name" placeholder="Enter Document Copy" autocomplete="off" tabindex="9" class="form-control qty1" required>
        </div>


        <div class="form-group">
           <label> الوصف  (Optional)</label>
             <textarea class="form-control" id="desc" name="desc" tabindex="8" rows="3" tabindex="10"></textarea>
        </div>

       

       <input type="submit" name="submitbtn" id="submitbtn" tabindex="11" class="btn btn-primary"  value=" إضافة سند صرف  ">
    
      <input type="reset" name="reset" id="resetbtn" tabindex="12" class="btn btn-primary" value=" مسح ">
      
      
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

      $('#ownerid').change(function(){

        var owner_id=$('#ownerid').val();      
       
        if(owner_id !='')
        {

          $.ajax({
            url:"<?php echo base_url();?>Payment_controller/getbuilding",
            method: "POST",
            data: {owner_id:owner_id},
            success:function(data)
            {
              $('#buildingid').html(data);
             
            }
          })
        }

         });
    });
  </script>

   
  <script>
    $(document).ready(function(){

      $('#buildingid').change(function(){

        var building_id=$('#buildingid').val();      
       
        if(building_id !='')
        {

          $.ajax({
            url:"<?php echo base_url();?>Payment_controller/getunits",
            method: "POST",
            data: {building_id:building_id},
            success:function(data)
            {
              $('#unitid').html(data);
             
            }
          })
        }

         });
    });

/*$(document).ready(function(){

      $('#unitid').change(function(){

        var unit_id=$('#unitid').val();      
       var building_id=$('#buildingid').val();
        if(unit_id !='')
        {

          $.ajax({
          
          url:"<?php echo base_url();?>Payment_controller/getpaymentdetails",
            method: "POST",
            data: {unit_id:unit_id,building_id:building_id},
            success:function(data)
            {
             
              $('#installmentno').html(data);
             
            }
          })
        }

         });
    });*/



$(document).ready(function(){

      $('#unitid').change(function(){
       var unit_id=$('#unitid').val();      
       var building_id=$('#buildingid').val();
        if(unit_id !='')
        {

          $.ajax({
            url:"<?php echo base_url();?>Payment_controller/getpaymentdetails",
            method: "POST",
            data: {unit_id:unit_id,building_id:building_id},
            success:function(data)
            {
              var field=data.split("//");
             //s = Float(field[0]).toFixed(2);
              //alert(s);
              //alert(field[0]);
              $('#paymentamount').val(field[0]);
               $('#contractno').val(field[1]);
               $('#startdate').val(field[2]); 
                $('#enddate').val(field[3]);
             $('#installmentno').val(field[4]);
              $('#installmentstatus').val(field[5]);
            }
          })
        }

         });
    });

$(document).ready(function(){

      $('#installmentno').change(function(){

        var unit_id=$('#unitid').val();      
       var building_id=$('#buildingid').val();
       var installmentno=$('#installmentno').val();
       if(installmentno !='')
        {

          $.ajax({
            url:"<?php echo base_url();?>Payment_controller/getinstallmentinfo",
            method: "POST",
            data: {unit_id:unit_id,building_id:building_id,installmentno:installmentno},
            success:function(data)
            {
              var fields = data.split('//');
              //alert(fields[0]);
              $('#paymentamount').val(fields[0]);
             $('#startdate').val(fields[1]);
             $('#enddate').val(fields[2]);
           
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