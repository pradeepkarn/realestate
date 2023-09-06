<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard"> اللوحة الرئيسية  </a>
            </li>
            <li class="breadcrumb-item active"> إضافة مصاريف   / المصروفات  </li>
          </ol>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #428bca;">
                <div class="panel-heading"> إضافة مصاريف  </div>
                <div class="panel-body">
	<?php
	$fcl=array('class'=>'cf','id'=>'form','name'=>'form');
	echo form_open_multipart('Expenses_controller/insertexpenseinfo',$fcl);
?>
 <div class="col-md-12 mx-auto">
	<section id="container">
		<h2> إضافة مصاريف  </h2>
		<div id="wrapping" class="clearfix">
			
		<!--	<form name="addunitsform" class="needs-validation" novalidate action="<?php echo base_url(); ?>Expenses_controller/insertexpensesinfo" method="post">-->



          <div class="form-group">
                <label><font color=red>*</font> نوع المصاريف  </label>
                <select class="form-control select2" style="width: 100%;" id="exptype" name="exptype" tabindex="1" required>
                   <option selected value=""> نوع المصاريف  </option>
                  <option  value="Maintenance"> صيانة  </option>
                   <option  value="Salaries"> رواتب  </option>
                    <option  value="Administrative Expenses"> مصاريف ادارية  </option>
                     <option  value="Contract Attestation"> توثيق العقد </option>
                  <option  value="Others"> أخرى  </option>

                 </select>
                <div class="invalid-feedback"> وع المصاريف   </div>
              </div>



               <div class="form-group" style="display: none;" id="buildingdiv">
                <label><font color=red>*</font> اسم العقار  </label>
                <select class="form-control select2" style="width: 100%;" id="buildingid" name="buildingid" tabindex="2" >
                	 <option selected value=""> اسم العقار  </option>
                   <?php
                    if(count($buildingList)>0){
                                    for ($i=0; $i <count($buildingList) ; $i++) { ?>
                            <option value="<?php echo $buildingList[$i]->id;?>"><?php echo $buildingList[$i]->building_name; ?></option>
                            <?php  } } ?>  
                 </select>
                <div class="invalid-feedback"> اسم العقار  </div>
              </div>

  <div class="form-group" style="display: none;" id="unitdiv">
                <label><font color=red>*</font> رقم الوحدة </label>
                <select class="form-control select2" style="width: 100%;" id="unitid" name="unitid" tabindex="2" >
                   <option value=""> رقم الوحدة  </option>  
                 </select>
               </div>

      <input type="hidden" name="contractid" id="contractid"  autocomplete="off" tabindex="3" class="form-control" readonly>


        <div class="form-group">
           <label><font color=red>*</font> رقم الفاتورة  </label>
              <input type="text" name="invoiceno" id="invoiceno" placeholder=" رقم الفاتورة " autocomplete="off" tabindex="3" class="form-control" required>
        </div>

          <div class="form-group">
             <label><font color=red>*</font> التاريخ  </label>
              <input type="date" name="date" id="date" value="<?php echo date('Y-m-d');?>" placeholder=" التاريخ " autocomplete="off" tabindex="4" class="form-control" required>
        </div>

         <div class="form-group">
           <label><font color=red>*</font> المجموع الكلي  </label>
              <input type="text" name="totalamount" id="totalamount" placeholder=" المجموع الكلي  " autocomplete="off" tabindex="5" class="form-control" required>
        </div>

  <div class="form-group" id="paymenttypediv">
           <label><font color=red>*</font>طريقة السداد</label>
              <select class="form-control select2" style="width: 100%;" id="paymenttype" name="paymenttype" tabindex="5" required>
                   <option selected value="">طريقة السداد</option>
                   <option selected value="Transfer">تحويل</option>
                    <option selected value="Card">بطاقة</option>
                     <option selected value="Cheque">شيك</option>
                      <option selected value="Cash">نقدا</option>
                 </select>
        </div>



          <div class="form-group" style="display: none;" id="bankdiv">
           
           <label><font color=red>*</font> اسم البنك  </label>
             <select class="form-control select2" style="width: 100%;" id="bankid" name="bankid" tabindex="6" >
                   <option selected value="">  اسم البنك  </option>
                   <?php
                    if(count($bankList)>0){
                                    for ($i=0; $i <count($bankList) ; $i++) { ?>
                            <option value="<?php echo $bankList[$i]->id;?>"><?php echo $bankList[$i]->bank_name;?></option>
                            <?php  } } ?>  
                 </select>

        </div>
        <div class="form-group">
           <label><font color=red>*</font> الوصف   </label>
              <textarea name="desc" id="desc" placeholder=" الوصف  " autocomplete="off" tabindex="5" class="form-control" required></textarea>
        </div>

        <div class="form-group">
             <label> نسخة من الفاتورة  </label>
            <input type="file" class="form-control-file" id="file_name" name="file_name" tabindex="6" >
        </div>
       
      
		</div>

      <input type="submit" name="submitbtn" id="submitbtn" tabindex="7" class="btn btn-primary"  value=" إضافة مصاريف ">		
			<input type="reset" name="reset" id="resetbtn" tabindex="8" class="btn btn-primary" value="مسح ">
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
       
        //alert("hi");
        if(building_id !='')
        {

          $.ajax({
           //url:"http://localhost/realestate/Contracts_controller/getunits",
            url:"<?php echo base_url();?>Expenses_controller/getunits",
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

     $(document).ready(function(){

      $('#unitid').change(function(){

        var unit_id=$('#unitid').val();
        var building_id=$('#buildingid').val();
       
        //alert("hi");
        if(unit_id !='')
        {

          $.ajax({
           //url:"http://localhost/realestate/Contracts_controller/getunits",
            url:"<?php echo base_url();?>Expenses_controller/getcontract",
            method: "POST",
            data: {building_id:building_id,unit_id:unit_id},
            success:function(data)
            {
              $('#contractid').val(data);
            }
          })
        }
      });
    });



 $(document).ready(function () {
        $('#exptype').change(function () {
       var  exptype= $('#exptype').val();
            if (($('#exptype').val() == 'Salaries')  || ($('#exptype').val() == 'Administrative Expenses'))
             {
                 $('#buildingdiv').hide();
                  $('#unitdiv').hide();
                   document.getElementById("buildingid").required = false;
                   document.getElementById("unitid").required = false;
              }
               if ($('#exptype').val() == 'Others' || $('#exptype').val() == 'Maintenance'|| $('#exptype').val() == 'Contract Attestation')
             {
                $('#buildingdiv').show();
                  $('#unitdiv').show();
                  document.getElementById("buildingid").required = true;
                   document.getElementById("unitid").required = true;
                 /* element.setAttribute("required", "");         //Correct
                  edName.required = true;       
                  $('#buildingid').required="true";
                  $('#unitid').required="true";*/

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