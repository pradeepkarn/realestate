<?php //print_r($receiptData);// die(); ?>
<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">اللوحة الرئيسية</a>
            </li>
            <li class="breadcrumb-item active"> إضافة سند قبض / سند قبض</li>
          </ol>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #428bca;">
                <div class="panel-heading"> ند قبض    </div>
                <div class="panel-body">
  
 <div class="col-md-12 mx-auto">
  <section id="container">
    <h2>سند قبض   </h2>
    <div id="wrapping" class="clearfix">
   
</div>
    
    
    <div id="wrapping" class="clearfix">
      

      <?php
 $fcl=array('class'=>'cf','id'=>'form');
  echo form_open_multipart('Receipt_controller/updatereceiptinfo',$fcl);
?>
   <!--   <form name="addreceiptform" class="needs-validation" novalidate action="<?php echo base_url(); ?>Receipt_controller" method="post" enctype="multipart/form-data">-->

 <input type="hidden" id="receiptid" name="receiptid" class="form-control" value="<?php echo $receiptData[0]->receiptid; ?>" readonly="">
 <input type="hidden" id="contractid" name="contractid" class="form-control" value="<?php echo $receiptData[0]->contract_id; ?>" readonly="">
 <input type="hidden" id="currentbal" name="currentbal" class="form-control" value="<?php echo $receiptData[0]->current_balance; ?>" readonly="">
<input type="hidden" id="amountreceived" name="amountreceived" class="form-control" value="<?php echo $receiptData[0]->amount_received; ?>" readonly="">
<input type="hidden" id="balanceamount" name="balanceamount" class="form-control" value="<?php echo $receiptData[0]->balance_amount; ?>" readonly="">

<input type="hidden" id="totalinstallmentpaidamt" name="totalinstallmentpaidamt" class="form-control" value="<?php echo $installment[0]->totalinstallmentpaidamt; ?>" readonly="">

<input type="hidden" id="installmentamt" name="installmentamt" class="form-control" value="<?php echo ($receiptData[0]->rent_amount)/($receiptData[0]->no_of_installments); ?>" readonly="">

<input type="hidden" id="maxid" name="maxid" class="form-control" value="<?php echo $installment[0]->maxid; ?>" readonly="">

   <div class="form-group">
   <label for="buildingid"><font color=red>*</font>اسم العقار</label>
         <input type="text" id="buildingid" name="buildingid" class="form-control" value="<?php echo $receiptData[0]->building_name; ?>" readonly="">
        </div>

    <div class="form-group">
      <label for="inputEmail4">اسم المالك</label>
      <input type="text" id="owner" name="owner" class="form-control" value="<?php echo $receiptData[0]->owner_firstname. ' '.$receiptData[0]->owner_lastname; ?>" readonly="">
       
    </div>


      
 <div class="form-group">
      <label for="tenantid"><font color=red>*</font>اسم المستأجر</label>
               <input type="text" id="tenant" name="tenant" class="form-control" value="<?php echo $receiptData[0]->tenant_firstname. ' '.$receiptData[0]->tenant_lastname; ?>" readonly="">
                <div class="invalid-feedback">اسم المستأجر</div>
              </div>

             <!-- <div class="form-group">
          .Contract Id-->
           <input type="hidden" readonly="" id="contractid" name="contractid"  value="<?php echo $receiptData[0]->contract_id; ?>" class="form-control">
    <!--    </div>-->


        <div class="form-group">
          رقم العقد
          <input type="text" id="contractnumber" name="contractnumber"  value="<?php echo $receiptData[0]->contract_number; ?>" readonly="" class="form-control">
        </div>

       
        <div class="form-group">
          رقم الوحدة
           <input type="text" readonly="" id="unitid" name="unitid"  value="<?php echo $receiptData[0]->unit_id; ?>" class="form-control" readonly="">
        </div>
  
    <div class="form-group">
           <label for="installmentno"><font color=red>*</font>نوع \ رقم الدفعة</label>
          <input type="text" readonly="" id="installmentno" name="installmentno"  value="<?php echo $receiptData[0]->installment_number; ?>" class="form-control" readonly="">
     
     </select>  

    </div>

 <!--<div class="form-group">
           <label for="dbamountreceived"><font color=red>*</font>DB Amount Received</label> -->
<input type="hidden" id="dbamountreceived"  name="dbamountreceived" readonly class="form-control">
<input type="hidden" id="dbbalanceamount"  name="dbbalanceamount" readonly class="form-control">
</div>
         
        <div class="form-group" >
          <label for="amountreceived"><font color=red>*</font>المبلغ المدفوع</label>
           <div class="input-group flex-nowrap">
  <div class="input-group-prepend">
    <span class="input-group-text" id="addon-wrapping">00.</span>
  </div>
              <input type="text" name="amountreceivedold" id="amountreceivedold" placeholder="المبلغ المدفوع " autocomplete="off" tabindex="4" class="form-control" value="<?php echo $receiptData[0]->amt_received; ?>" readonly="" >
              <div class="invalid-feedback">المبلغ المدفوع</div>
        </div>
      </div>
      
      <div class="form-group" >
          <label for="amountreceived"><font color=red>*</font>المبلغ المدفوع</label>
           <div class="input-group flex-nowrap">
  <div class="input-group-prepend">
    <span class="input-group-text" id="addon-wrapping">00.</span>
  </div>
              <input type="text" name="amountreceivednew" id="amountreceivednew" placeholder="المبلغ المدفوع " autocomplete="off" tabindex="4" class="form-control" >
              <div class="invalid-feedback">المبلغ المدفوع</div>
        </div>
      </div>
      
      
 

   <!--   <div class="form-group"   id="paymenttypediv">
           <label><font color=red>*</font>طريقة السداد</label>
              <select class="form-control select2" style="width: 100%;" id="paymenttype" name="paymenttype" tabindex="5" required>
                   <option  value="">طريقة السداد</option>
                   <option  value="Transfer">تحويل</option>
                    <option  value="Card">بطاقة</option>
                     <option  value="Cheque">شيك</option>
                      <option selected value="Cash">نقدا</option>
                 </select>
        </div>

         <div class="form-group" style="display: none;" id="bankdiv">
           
           <label><font color=red>*</font> Select Bank </label>
             <select class="form-control select2" style="width: 100%;" id="bankid" name="bankid" tabindex="6" >
                   <option selected value=""> Select Bank </option>
                   <?php
                    if(count($bankList)>0){
                                    for ($i=0; $i <count($bankList) ; $i++) { ?>
                            <option value="<?php echo $bankList[$i]->id;?>"><?php echo $bankList[$i]->bank_name;?></option>
                            <?php  } } ?>  
                 </select>

        </div>

        <div class="form-group" style="display: none;" id="paymentdocumentdiv">
           <label>تاريخ السداد</label>
             <input type="date" tabindex="7" class="form-control" id="paymentdocdate" name="paymentdocdate" placeholder="تاريخ السداد" >
        </div>

        <div class="form-group" style="display: none;" id="paymentdocumentnodiv"> 
           <label>رقم السداد</label>
              <input type="text" name="paymentdocno" id="paymentdocno" placeholder="رقم السداد" autocomplete="off" tabindex="8" class="form-control">
        </div>

       <div class="form-group" style="display: none;" id="documentcopydiv">
           <label>رفع نسخة من مستند السداد</label>
              <input type="file" name="file_name" id="file_name" placeholder="رفع نسخة من مستند السداد" autocomplete="off" tabindex="9" class="form-control">
        </div>


        <div class="form-group" style="display: none;" id="descriptiondiv">
           <label>الوصف (اختياري)</label>
             <textarea class="form-control" id="desc" name="desc" tabindex="10" rows="3"></textarea>
        </div>-->
        
      <input type="submit" name="submitbtn" id="submitbtn" tabindex="11" class="btn btn-primary"  value="إضافة سند قبض">
      <input type="reset" name="reset" id="resetbtn" tabindex="12" class="btn btn-primary" value="مسح">
   
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
$(document).on("change", ".qty1", function() {
    var sum = 0;
    $(".qty1").each(function(){
        sum += +$(this).val();
    });
    $(".total").val(sum);
});
</script>


  <script>
    var dat;
    var value;
    $(document).ready(function(){

      $('#buildingid').change(function(){

        var building_id=$('#buildingid').val();      
       
        if(building_id !='')
        {

          $.ajax({
           //url:"http://localhost/realestate/Contracts_controller/getunits",
            url:"<?php echo base_url();?>Receipt_controller/getowner",
            method: "POST",
            data: {building_id:building_id},
            success:function(data)
            {
              //$('#owner').html(data);
              var field = data.split('//');
              $('#owner').val(field[0]);
              $('#ownerid').val(field[1]);
            }
          })
        }

         if(building_id !='')
        {

          $.ajax({
           //url:"http://localhost/realestate/Contracts_controller/getunits",
            url:"<?php echo base_url();?>Receipt_controller/gettenants",
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

        var unit_id=$('#tenantid').val();   
        var b_id=$('#buildingid').val();   
       
        if(unit_id !='')
        {

          $.ajax({
           //url:"http://localhost/realestate/Contracts_controller/getunits",
            url:"<?php echo base_url();?>Receipt_controller/getunitandcontract",
            method: "POST",
            data: {unit_id:unit_id,building_id:b_id},
            success:function(data)
            {
              
              var fields = data.split('//');
              $('#unitid').val(fields[0]);
              $('#contractnumber').val(fields[1]);
               $('#rentamount').val(fields[2]);
               $('#dbbalanceamount').val(fields[3]);
                $('#dbamountreceived').val(fields[4]);
                 $('#contractid').val(fields[5]);
                  $('#insuranceamount').val(fields[6]);
                 $('#brokerageamount').val(fields[7]);
              $('#installmentno').html(fields[8]);
               $('#balanceamount').val(fields[9]);
              dat=data.split('data:');
             // $('#installmentstartdate').val(dat[1]);
             // $('#installmentenddate').val(dat[2]);
             
            }
          })
        }
      });
    });
  

    $(document).ready(function(){

      $('#amountreceived').change(function(){
        var s=($('#installmentno').val());
        
        var received=parseFloat($('#amountreceived').val());   
        var total=parseFloat($('#balanceamount').val()); 
        //alert (received);
        //alert (total);  
       //alert(s);
        if(received !='')
        {
          if((s=='Insurance') || (s=='Brokerage'))
          {
            
            a=total;
            $('#balamt').val(a);
          }
          else
          {
           
          a=total-received; 
          $('#balamt').val(a);

          }
            }
         });
       });
 
  $(document).ready(function () {
        $('#installmentno').change(function () {
          value= $('#installmentno').val();
            if ($('#installmentno').val() == 'Insurance') {
                
                $('#totalamountdiv').hide();
                $('#balanceamountdiv').hide();
                $('#insuranceamountdiv').show();
                $('#brokerageamountdiv').hide();
                 $('#amountreceiveddiv').hide();
                  $('#currentbalancediv').hide();
                   $('#datediv').hide();
                    $('#paymenttypediv').show();
                    $('#bankdiv').hide();
                     $('#paymentdocumentdiv').hide();
                      $('#paymentdocumentnodiv').hide();
                       $('#documentcopydiv').hide();
                        $('#descriptiondiv').hide();
            }
            else if ($('#installmentno').val() == 'Brokerage')  {
                 $('#totalamountdiv').hide();
                $('#balanceamountdiv').hide();
                $('#insuranceamountdiv').hide();
                $('#brokerageamountdiv').show();
                 $('#amountreceiveddiv').hide();
                  $('#currentbalancediv').hide();
                   $('#datediv').hide();
                   $('#paymenttypediv').show();
                   $('#bankdiv').hide();
                     $('#paymentdocumentdiv').hide();
                      $('#paymentdocumentnodiv').hide();
                       $('#documentcopydiv').hide();
                        $('#descriptiondiv').hide();
            }
            else
            {
               $('#totalamountdiv').show();
                $('#balanceamountdiv').show();
                $('#insuranceamountdiv').hide();
                $('#brokerageamountdiv').hide();
                 $('#amountreceiveddiv').show();
                  $('#currentbalancediv').show();
                   $('#datediv').show();
                  var value2=eval($('#installmentno').val()) + 1;
                  $('#installmentstartdate').val(dat[value]);
                  $('#installmentenddate').val(dat[value2]);
                   
                    $('#paymenttypediv').show();
                     $('#paymentdocumentdiv').show();
                      $('#paymentdocumentnodiv').show();
                       $('#documentcopydiv').show();
                        $('#descriptiondiv').show();
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
