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
                <div class="panel-heading">Suspended Receipt</div>
                <div class="panel-body">
 <div class="col-md-12 mx-auto">
  <section id="container">
    <h2>سند قبض   </h2>
    <div id="wrapping" class="clearfix">
   
</div>
    
    
    <div id="wrapping" class="clearfix">
      

      <?php
 $fcl=array('class'=>'cf','id'=>'form');
  echo form_open_multipart('Receipt_controller/insertsuspendreceiptinfo',$fcl);
?>
   <!--   <form name="addreceiptform" class="needs-validation" novalidate action="<?php echo base_url(); ?>Receipt_controller" method="post" enctype="multipart/form-data">-->

   <div class="form-group">
   <label for="buildingid"><font color=red>*</font>اسم العقار</label>
       <input type="text" id="buildingid" name="buildingid" tabindex="1" value="<?php echo $contractList[0]->building_name; ?>" class="form-control" readonly="">
        </div>

    <div class="form-group">
      <label for="inputEmail4">اسم المالك</label>
      <input type="text" id="owner" name="owner" class="form-control" value="<?php echo $contractList[0]->owner_firstname; ?>" readonly="">
       <input type="hidden" id="ownerid" name="ownerid" value="<?php echo $contractList[0]->owner_id; ?>" class="form-control" readonly="">
    </div>


      
 <div class="form-group">
      <label for="tenantid"><font color=red>*</font>اسم المستأجر</label>
                <input type="text" id="tenantid" name="tenantid" class="form-control" value="<?php echo $contractList[0]->tenant_firstname; ?>" readonly="">
              </div>

             <!-- <div class="form-group">
          .Contract Id-->
           <input type="hidden" readonly="" id="contractid" name="contractid" value="<?php echo $contractList[0]->contractid; ?>"  class="form-control">
    <!--    </div>-->


        <div class="form-group">
          رقم العقد
          <input type="text" id="contractnumber" name="contractnumber"  value="<?php echo $contractList[0]->contract_number; ?>" readonly="" class="form-control">
        </div>

       
        <div class="form-group">
          رقم الوحدة
           <input type="text" readonly="" id="unitid" name="unitid"  value="<?php echo $contractList[0]->unit_id; ?>"  class="form-control">
        </div>

 <div class="form-group"  id="totalamountdiv">
           <label for="total"><font color=red>*</font>المجموع الكلي</label> 
<input type="text" id="total" name="total"  value="<?php echo $contractList[0]->total; ?>" readonly class="form-control" >
</div>


  
  <div class="form-group"  id="balanceamountdiv" >
           <label for="balanceamount"><font color=red>*</font>الرصيد المتبقي</label> 
<input type="text" id="balanceamount" style="color:red;" name="balanceamount" value="<?php echo $contractList[0]->balance_amount; ?>" readonly class="form-control">
</div>


<input type="hidden" id="dbamountreceived" style="color:red;" name="dbamountreceived" value="<?php echo $contractList[0]->amount_received; ?>" readonly class="form-control">

<!--<input type="text" id="dbamountreceived"  name="dbamountreceived" readonly class="form-control" value="<?php //echo $contractList[0]->amount_received;?>" >
</div>-->
         
        <div class="form-group"  id="amountreceiveddiv">
          <label for="amountreceived"><font color=red>*</font>المبلغ المدفوع</label>
           <div class="input-group flex-nowrap">
  <div class="input-group-prepend">
    <span class="input-group-text" id="addon-wrapping">00.</span>
  </div>
              <input type="text" name="amountreceived" id="amountreceived" placeholder="المبلغ المدفوع " autocomplete="off" tabindex="4" class="form-control"  >
              <div class="invalid-feedback">المبلغ المدفوع</div>
        </div>
      </div>

  <div class="form-group"  id="currentbalancediv" >
           <label>الرصيد الجديد </label>
            <div class="input-group flex-nowrap">
  <div class="input-group-prepend">
    <span class="input-group-text" id="addon-wrapping">00.</span>
  </div>
              <input type="text" style="color:blue;"  name="balamt" id="balamt" readonly="" autocomplete="off"  class="form-control" >
        </div>
</div>
      
  
      <div class="form-group"  id="paymenttypediv">

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
             <select class="form-control select2" style="width: 100%;" id="bankid" name="bankid" tabindex="6" >
                   <option selected value=""> Select Bank </option>
                   <?php
                    if(count($bankList)>0){
                                    for ($i=0; $i <count($bankList) ; $i++) { ?>
                            <option value="<?php echo $bankList[$i]->id;?>"><?php echo $bankList[$i]->bank_name;?></option>
                            <?php  } } ?>  
                 </select>

        </div>
        <div class="form-group"  id="paymentdocumentdiv">
           <label>تاريخ السداد</label>
             <input type="date" class="form-control" id="paymentdocdate" name="paymentdocdate" placeholder="تاريخ السداد"  value="<?php echo date("Y-m-d"); ?>" tabindex="8">
        </div>

        <div class="form-group"  id="paymentdocumentnodiv">
           <label>رقم السداد</label>
              <input type="text" name="paymentdocno" id="paymentdocno" placeholder="رقم السداد" autocomplete="off" tabindex="9" class="form-control">
        </div>

       <div class="form-group"  id="documentcopydiv">
           <label>رفع نسخة من مستند السداد</label>
              <input type="file" name="file_name" id="file_name" placeholder="رفع نسخة من مستند السداد" autocomplete="off" tabindex="10" class="form-control">
        </div>


        <div class="form-group"  id="descriptiondiv">
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> 
</script> 


  <script>

    $(document).ready(function(){

      $('#amountreceived').change(function(){
             
        var received=parseFloat($('#amountreceived').val());   
        var total=parseFloat($('#balanceamount').val()); 
       
        if(received !='')
        {
          
        a=total-received; 
          $('#balamt').val(a);

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

   