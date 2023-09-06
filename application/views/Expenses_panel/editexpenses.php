<div id="content-wrapper">
<?php //print_r($expenseData); die();?>
        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard"> اللوحة الرئيسية  </a>
            </li>
            <li class="breadcrumb-item active">  تعديل المصروفات / المصروفات   </li>
          </ol>

	<?php
	//$fcl=array('class'=>'cf','id'=>'form','name'=>'form');
	//echo form_open_multipart('Buildings_controller/insertbuildinginfo',$fcl);
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #428bca;">
                <div class="panel-heading"> عديل المصروفات   </div>
                <div class="panel-body">
 <div class="col-md-12 mx-auto">
	<section id="container">
		<h2>تعديل المصروفات  </h2>
		<div id="wrapping" class="clearfix">
			
      <?php
  $fcl=array('class'=>'cf','id'=>'form');
  echo form_open_multipart('Expenses_controller/editexpensesinfo',$fcl);
?>
			<!--<form name="addownerform" class="needs-validation" novalidate action="<?php echo base_url(); ?>Owners_controller/insertownerinfo" method="post" enctype="multipart/form-data">-->
        <input type="hidden" name="oid" id="oid" value="<?php if(isset($expenseData[0]->id)) { echo $expenseData[0]->id; } ?>">


          <div class="form-group">
                <label><font color=red>*</font> نوع المصاريف   </label>
                <select class="form-control select2" style="width: 100%;" id="exptype" name="exptype" tabindex="1" required>
                   <option selected value=""> نوع المصاريف   </option>

                  <option  <?php if(isset($expenseData[0]->expense_type)) { if($expenseData[0]->expense_type=='Maintenance')  {echo "selected";} } ?>  value="Maintenance"> صيانة </option>
                   <option <?php if(isset($expenseData[0]->expense_type)) { if($expenseData[0]->expense_type=='Salaries')  {echo "selected";} } ?> value="Salaries"> رواتب   </option>
                    <option <?php if(isset($expenseData[0]->expense_type)) { if($expenseData[0]->expense_type=='Adminstrative Expenses')  {echo "selected";} } ?> value="Administrative Expenses">  صاريف ادارية  </option>

                     <option <?php if(isset($expenseData[0]->expense_type)) { if($expenseData[0]->expense_type=='Contract Attestation')  {echo "selected";} } ?> value="Contract Attestation">  توثيق العقد </option>

                  <option <?php if(isset($expenseData[0]->expense_type)) { if($expenseData[0]->expense_type=='Others')  {echo "selected";} } ?> value="Others"> أخرى </option>




                 </select>
                <div class="invalid-feedback"> نوع المصاريف   </div>
              </div>



                <div class="form-group" 
                <?php if(isset($expenseData[0]->expense_type)) { if(($expenseData[0]->expense_type=='Salaries') || ($expenseData[0]->expense_type=='Adminstrative Expenses')) { ?> style="display: none;" <?php } } ?>>

                 
                <label><font color=red>*</font> اسم العقار  </label>
                <select class="form-control select2" style="width: 100%;" id="buildingname" name="buildingname" tabindex="1" disabled>
                   <option selected value=""> اسم العقار  </option>
                   <?php
                    if(count($buildingList)>0){
                                    for ($i=0; $i <count($buildingList) ; $i++) { ?>
                            <option 
                            <?php if(isset($expenseData[0]->building_id)) { if($expenseData[0]->building_id==$buildingList[$i]->id)  {echo "selected";} } ?>
                              value="<?php echo $buildingList[$i]->id;?>" ><?php echo $buildingList[$i]->building_name;?></option>
                            <?php  } } ?>  
                 </select>
                <div class="invalid-feedback"> اسم العقار  </div>
              </div>

               
              <input type="hidden" name="buildingid" id="buildingid" value="<?php if(isset($expenseData[0]->building_id)) { echo $expenseData[0]->building_id; } ?>" autocomplete="off" tabindex="3" class="form-control" >
        </div>


                <div class="form-group"  id="unitdiv"  <?php if(isset($expenseData[0]->expense_type)) { if(($expenseData[0]->expense_type=='Salaries') || ($expenseData[0]->expense_type=='Adminstrative Expenses')) { ?> style="display: none;" <?php } } ?>>
           <label><font color=red>*</font> رقم الوحدة  </label>
              <input type="text" name="unitid" id="unitid" value="<?php if(isset($expenseData[0]->unit_id)) { echo $expenseData[0]->unit_id; } ?>" autocomplete="off" tabindex="3" class="form-control" readonly>
        </div>



          <!--     <div class="form-group">
                <label><font color=red>*</font>Choose Unit Number</label>
                <select class="form-control select2" style="width: 100%;" id="unitid" name="unitid" tabindex="2" required>
                   <option value="">Choose Unit Number</option>  
                 </select>
               </div> -->

     <div class="form-group">
           <label><font color=red>*</font> رقم الفاتورة  </label>
              <input type="text" name="invoiceno" id="invoiceno" value="<?php if(isset($expenseData[0]->invoice_number)) { echo $expenseData[0]->invoice_number; } ?>" autocomplete="off" tabindex="3" class="form-control" required>
        </div>


         <div class="form-group">
             <label><font color=red>*</font> التاريخ  </label>
              <input type="date" name="date" id="date" value="<?php if(isset($expenseData[0]->date)) { $dat=date_create($expenseData[0]->date); echo date_format($dat,'Y-m-d');; } ?>" autocomplete="off" tabindex="4" class="form-control" required>
        </div>

         <div class="form-group">
           <label><font color=red>*</font> المجموع الكلي   </label>
              <input type="text" name="totalamount" id="totalamount" value="<?php if(isset($expenseData[0]->total_amount)) { echo $expenseData[0]->total_amount; } ?>" autocomplete="off" tabindex="5" class="form-control" required>
        </div>

  

<div class="form-group" id="paymenttypediv">
           <label><font color=red>*</font>طريقة السداد</label>
              <select class="form-control select2" style="width: 100%;" id="paymenttype" name="paymenttype" tabindex="5" required>
                   <option  value="">طريقة السداد</option>
                   <option  <?php if(isset($expenseData[0]->payment_type)) { if($expenseData[0]->payment_type=='Transfer')  {echo "selected";} } ?>  value="Transfer">تحويل</option>
                    <option <?php if(isset($expenseData[0]->payment_type)) { if($expenseData[0]->payment_type=='Card')  {echo "selected";} } ?> value="Card">بطاقة</option>
                     <option <?php if(isset($expenseData[0]->payment_type)) { if($expenseData[0]->payment_type=='Cheque')  {echo "selected";} } ?> value="Cheque">شيك</option>
                      <option <?php if(isset($expenseData[0]->payment_type)) { if($expenseData[0]->payment_type=='Cash')  {echo "selected";} } ?>  value="Cash">نقدا</option>
                 </select>
        </div>



 <div class="form-group" <?php if(isset($expenseData[0]->payment_type)) { if($expenseData[0]->payment_type=='Cash') { ?> style="display: none;" <?php } } ?> id="bankdiv">
           
           <label><font color=red>*</font> Select Bank </label>
             <select class="form-control select2" style="width: 100%;" id="bankid" name="bankid" tabindex="6" >
                   <option selected value=""> Select Bank </option>
                   <?php
                    if(count($bankList)>0){
                                    for ($i=0; $i <count($bankList) ; $i++) { ?>
                            <option 
                             <?php if(isset($expenseData[0]->bank_id)) { if($expenseData[0]->bank_id==$bankList[$i]->id)  {echo "selected";} } ?>
                            value="<?php echo $bankList[$i]->id;?>"><?php echo $bankList[$i]->bank_name;?></option>
                            <?php  } } ?>  
                 </select>

        </div>


        <div class="form-group">
           <label><font color=red>*</font> الوصف   </label>
              <textarea name="desc" id="desc"  autocomplete="off" tabindex="5" class="form-control" required>
                <?php if(isset($expenseData[0]->description)) { echo $expenseData[0]->description; } ?>
              </textarea>
        </div>


        <div class="form-group">
             <label>نسخة من الفاتورة  </label>

            <input type="file" class="form-control-file" id="file_name" name="file_name" tabindex="6" >
             <label><?php if(isset($expenseData[0]->invoice_document)) { echo "<font color=blue>"; echo $expenseData[0]->invoice_document; echo "</font>"; } ?> </label>
    <input type="hidden" id="filename" name="filename" value=<?php if(isset($expenseData[0]->invoice_document)) { echo $expenseData[0]->invoice_document; } ?> >
        </div>
       
   
		

<input type="submit" name="submitbtn" id="submitbtn" tabindex="9" class="btn btn-primary"  value="تعديل المصروفات">
		
			<input type="reset" name="reset" id="resetbtn" tabindex="10" class="btn btn-primary" value=" مسح ">
			
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
<script >
  // Data Picker Initialization
$('.datepicker').datepicker();
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



$(document).ready(function () {
        $('#exptype').change(function () {
       var  exptype= $('#exptype').val();
            if (($('#exptype').val() == 'Salaries')  || ($('#exptype').val() == 'Administrative Expenses'))
             {
                 $('#buildingdiv').hide();
                  $('#unitdiv').hide();
                 //  document.getElementById("buildingid").required = false;
                  // document.getElementById("unitid").required = false;
              }
               if ($('#exptype').val() == 'Others' || $('#exptype').val() == 'Maintenance')
             {
                $('#buildingdiv').show();
                  $('#unitdiv').show();
                 // document.getElementById("buildingid").required = true;
                  // document.getElementById("unitid").required = true;
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