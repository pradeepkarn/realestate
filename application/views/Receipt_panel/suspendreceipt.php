
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
                <div class="panel-heading">Suspended Recipt</div>
                <div class="panel-body">
 <div class="col-md-12 mx-auto">
  <section id="container">
    <h2>سند قبض</h2>
    <div id="wrapping" class="clearfix">
   
</div>
    
    
    <div id="wrapping" class="clearfix">
      

      <?php
 $fcl=array('class'=>'cf','id'=>'form');
  echo form_open_multipart('Receipt_controller/insertreceiptinfo',$fcl);
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

    <div class="form-group">
      <label for="inputEmail4">اسم المالك</label>
      <input type="text" id="owner" name="owner" class="form-control" readonly="">
       <input type="hidden" id="ownerid" name="ownerid" class="form-control" readonly="">
    </div>


      
 <div class="form-group">
      <label for="tenantid"><font color=red>*</font>اسم المستأجر</label>
                <select class="form-control select2" style="width: 100%;" id="tenantid" name="tenantid" tabindex="2" required>
                   <option selected value="">اسم المستأجر</option>
                   <?php
                  /*  if(count($tenantList)>0){
                                    for ($i=0; $i <count($tenantList) ; $i++) { ?>
                            <option value="<?php echo $tenantList[$i]->id;?>"><?php echo $tenantList[$i]->tenant_firstname;?></option>
                            <?php  } } */ ?>  
                 </select>
                <div class="invalid-feedback">اسم المستأجر</div>
              </div>

             <!-- <div class="form-group">
          .Contract Id-->
           <input type="hidden" readonly="" id="contractid" name="contractid"  class="form-control">
    <!--    </div>-->


        <div class="form-group">
          رقم العقد
          <input type="text" id="contractnumber" name="contractnumber" readonly="" class="form-control">
        </div>

       
        <div class="form-group">
          رقم الوحدة
           <input type="text" readonly="" id="unitid" name="unitid"  class="form-control">
        </div>
  
    <div class="form-group">
           <label for="installmentno"><font color=red>*</font>نوع \ رقم الدفعة</label>
          <select id="installmentno" name="installmentno" tabindex="3" class="form-control">
   <option value="">نوع \ رقم الدفعة</option>
     
     </select>  

    </div>

   <div class="form-group" style="display: none;" id="totalamountdiv">
           <label for="rentamount"><font color=red>*</font>المجموع الكلي</label> 
<input type="text" id="rentamount" name="rentamount" readonly class="form-control" >
</div>

  <div class="form-group" style="display: none;" id="balanceamountdiv" >
           <label for="balanceamount"><font color=red>*</font>الرصيد المتبقي</label> 
<input type="text" id="balanceamount" style="color:red;" name="balanceamount" readonly class="form-control">
</div>

<div class="form-group" style="display: none;" id="insuranceamountdiv">
           <label for="insuranceamount">قيمة التأمين</label> 
<input type="text" id="insuranceamount" style="color:red;" name="insuranceamount" readonly class="form-control">
</div>

<div class="form-group" style="display: none;" id="brokerageamountdiv" >
           <label for="borkerageamount">أجور السعي</label> 
<input type="text" id="brokerageamount" style="color:red;" name="brokerageamount" readonly class="form-control">
</div>



 <!--<div class="form-group">
           <label for="dbamountreceived"><font color=red>*</font>DB Amount Received</label> -->
<input type="hidden" id="dbamountreceived"  name="dbamountreceived" readonly class="form-control">
</div>
         
        <div class="form-group" style="display: none;" id="amountreceiveddiv">
          <label for="amountreceived"><font color=red>*</font>المبلغ المدفوع</label>
           <div class="input-group flex-nowrap">
  <div class="input-group-prepend">
    <span class="input-group-text" id="addon-wrapping">00.</span>
  </div>
              <input type="text" name="amountreceived" id="amountreceived" placeholder="المبلغ المدفوع " autocomplete="off" tabindex="4" class="form-control"  >
              <div class="invalid-feedback">المبلغ المدفوع</div>
        </div>
      </div>
      
       <div class="form-group" style="display: none;" id="currentbalancediv" >
           <label>الرصيد الجديد </label>
            <div class="input-group flex-nowrap">
  <div class="input-group-prepend">
    <span class="input-group-text" id="addon-wrapping">00.</span>
  </div>
              <input type="text" style="color:blue;"  name="balamt" id="balamt" readonly="" autocomplete="off"  class="form-control" >
        </div>
</div>
      

    


          <div class="form-row" style="display: none;" id="datediv">
             <div class="form-group col-md-6">
      <label for="installmentenddate">إلى</label>
      <input type="date" class="form-control" id="installmentenddate" name="installmentenddate" placeholder="إلى" tabindex="6">
    </div>
 
 <div class="form-group col-md-6">
      <label for="installmentstartdate">عن الفترة من</label>
       <input type="date" class="form-control" id="installmentstartdate" name="installmentstartdate" placeholder="عن الفترة من" tabindex="5">
    </div>
       </div> 
 

      <div class="form-group" style="display: none;" id="paymenttypediv">
           <label><font color=red>*</font>طريقة السداد</label>
              <select class="form-control select2" style="width: 100%;" id="paymenttype" name="paymenttype" tabindex="7" required>
                   <option selected value="">طريقة السداد</option>
                   <option selected value="Transfer">تحويل</option>
                    <option selected value="Card">بطاقة</option>
                     <option selected value="Cheque">شيك</option>
                      <option selected value="Cash">نقدا</option>
                 </select>
        </div>
 <div class="form-group" style="display: none;" id="bankdiv">
           
           <label><font color=red>*</font> Select Bank </label>
             <select class="form-control select2" style="width: 100%;" id="bankid" name="bankid" tabindex="6" required>
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
             <input type="date" class="form-control" id="paymentdocdate" name="paymentdocdate" placeholder="تاريخ السداد" tabindex="8">
        </div>

        <div class="form-group" style="display: none;" id="paymentdocumentnodiv"> 
           <label>رقم السداد</label>
              <input type="text" name="paymentdocno" id="paymentdocno" placeholder="رقم السداد" autocomplete="off" tabindex="9" class="form-control">
        </div>

       <div class="form-group" style="display: none;" id="documentcopydiv">
           <label>رفع نسخة من مستند السداد</label>
              <input type="file" name="file_name" id="file_name" placeholder="رفع نسخة من مستند السداد" autocomplete="off" tabindex="10" class="form-control">
        </div>


        <div class="form-group" style="display: none;" id="descriptiondiv">
           <label>الوصف (اختياري)</label>
             <textarea class="form-control" id="desc" name="desc" tabindex="11" rows="3"></textarea>
        </div>
        
      <input type="submit" name="submitbtn" id="submitbtn" tabindex="12" class="btn btn-primary"  value="إضافة سند قبض">
      <input type="reset" name="reset" id="resetbtn" tabindex="13" class="btn btn-primary" value="مسح">
   
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
            url:"<?php echo base_url();?>Receipt_controller/getsuspendtenants",
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
  </script>

   <script>

    $(document).ready(function(){

      $('#tenantid').change(function(){

        var unit_id=$('#tenantid').val();   
        var b_id=$('#buildingid').val();   
       
        if(unit_id !='')
        {

          $.ajax({
           //url:"http://localhost/realestate/Contracts_controller/getunits",
            url:"<?php echo base_url();?>Receipt_controller/getsuspendunitandcontract",
            method: "POST",
            data: {unit_id:unit_id,building_id:b_id},
            success:function(data)
            {
              //$('#owner').html(data);
              //alert(data);
              var fields = data.split('//');
             // alert(fields[0]);
             // alert(fields[1]);
              // alert(fields[2]);
              $('#unitid').val(fields[0]);
              $('#contractnumber').val(fields[1]);
               $('#rentamount').val(fields[2]);
               $('#balanceamount').val(fields[3]);
                $('#dbamountreceived').val(fields[4]);
                 $('#contractid').val(fields[5]);
                  $('#insuranceamount').val(fields[6]);
                 $('#brokerageamount').val(fields[7]);
              $('#installmentno').html(fields[8]);

            }
          })
        }
      });
    });
  </script>

 <script>

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
  </script>

<script>
  $(document).ready(function () {
        $('#installmentno').change(function () {
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
                   $('#bankdiv').hide();
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
