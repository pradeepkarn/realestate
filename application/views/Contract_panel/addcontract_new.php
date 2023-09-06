
<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">اللوحة الرئيسية</a>
            </li>
            <li class="breadcrumb-item active"> إضافة عقد / العقود</li>
          </ol>

	<?php
	//$fcl=array('class'=>'cf','id'=>'form','name'=>'form');
	//echo form_open_multipart('Buildings_controller/insertbuildinginfo',$fcl);
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #428bca;">
                <div class="panel-heading"> إضافة عقد  </div>
                <div class="panel-body">
 <div class="col-md-12 mx-auto">
	<section id="container">
		<h2>إضافة عقد </h2>
		<div id="wrapping" class="clearfix">
			
      <?php
 // $fcl=array('class'=>'cf','id'=>'form');
 // echo form_open_multipart('Contracts_controller/insertcontractinfo',$fcl);
?>
			<form name="addcontractform" class="needs-validation" novalidate action="<?php echo base_url(); ?>contracts_controller/insertcontractinfo" method="post" enctype="multipart/form-data">

        <div class="form-group">
                <label><font color=red>*</font>اسم العقار</label>
                
                <select class="form-control select2" style="width: 100%;" id="buildingid" name="buildingid" tabindex="1" required>
                   <option selected value="">اسم العقار</option>
                   <?php
                    if(count($buildingList)>0){
                                    for ($i=0; $i <count($buildingList) ; $i++) { ?>
                            <option value="<?php echo $buildingList[$i]->id;?>"><?php echo $buildingList[$i]->building_name;?></option>
                            <?php  } } ?>  
                 </select>
                <div class="invalid-feedback">اسم العقار</div>
              </div>
<input type="hidden" id="buildingiod" name="buildingiod" value= <?php if(isset($buildingiod)) { echo $buildingiod[0]; } ?>>

 
            <div class="form-group">
                <label><font color=red>*</font>رقم الوحدة</label>
                <select class="form-control select2" style="width: 100%;" id="unitid" name="unitid" tabindex="2" required>
                   <option value="">رقم الوحدة</option>  
                 </select>
               </div>



        <div class="form-group">
                <label><font color=red>*</font>اسم المستأجر الاول</label>
                <select class="form-control select2" style="width: 100%;" id="tenantid" name="tenantid" tabindex="3" required>
                   <option selected value="">اسم المستأجر الاول</option>
                   <?php
                    if(count($tenantList)>0){
                                    for ($i=0; $i <count($tenantList) ; $i++) { ?>
                            <option value="<?php echo $tenantList[$i]->id;?>"><?php echo $tenantList[$i]->tenant_firstname;?></option>
                            <?php  } } ?>  
                 </select>
                <div class="invalid-feedback">اسم المستأجر الاول</div>
              </div>
      

         
        <div class="form-group">
           <label><font color=red>*</font>رقم العقد</label>
              <input type="text" name="contractnumber" id="contractnumber" placeholder="رقم العقد" autocomplete="off" tabindex="4" class="form-control"  required>
              <div class="invalid-feedback">رقم العقد</div>
        </div>
        


         <label><font color=red>*</font> عدد السنوات أو الشهور </label>
        <div class="form-row mb-4" style="">          
        <div class="col">
             <select id="no" name="no" class="form-control" required>
            <?php for($k=1;$k<=10;$k++) { ?>
            <option value=<?php echo $k; ?>><?php echo $k; ?></option>
        <?php } ?>
        </select>
          <!--<input type="text" id="no" name="no" class="form-control" tabindex="5" placeholder=" عدد السنوات أو الشهور " required>  -->
        </div>
        <div class="col" > 
                  <select id="contractperiod" name="contractperiod" tabindex="6" class="custom-select browser-default" required style="width:100%;">
              <option value="Years" selected>  سنة/سنوات </option>
              <!--<option value="Months">  شهر/أشهر </option>-->
          </select>    
            
        </div>
        
    </div>

           
             
           
        
        </div>
          
  <div class="form-group">
           <label><font color=red>*</font>تاريخ بداية العقد</label>
        
  <input placeholder="تاريخ بداية العقد" type="date" id="startdate"  name="startdate" class="form-control" tabindex="7"> 
 </div>

 <div class="form-group">
           <label><font color=red>*</font>تاريخ نهاية العقد</label>
        
  <input placeholder="تاريخ نهاية العقد" type="date" id="enddate" readonly name="enddate" class="form-control" tabindex="8"> 
 </div>


 <div class="form-group">
           <label><font color=red>*</font>عدد الدفعات</label>
            <select id="noofinstallments" name="noofinstallments" class="form-control" required>
            <?php for($k=1;$k<=2;$k++) { ?>
            <option value=<?php echo $k; ?>><?php echo $k; ?></option>
        <?php } ?>
        </select>
              <!--<input type="number" name="noofinstallments" id="noofinstallments" placeholder="عدد الدفعات" autocomplete="off" tabindex="9" class="form-control" required>-->
        </div>


        <div class="form-group">
           <label><font color=red>*</font>قيمة الإيجار</label>
              <input type="number" name="rentamount" id="rentamount" placeholder="قيمة الإيجار" autocomplete="off" tabindex="10" class="form-control qty1" required>
        </div>

        <div class="form-group">
           <label><font color=red>*</font>رسوم الماء</label>
              <input type="number" name="waterfees" id="waterfees" placeholder="رسوم الماء" autocomplete="off" tabindex="11" class="form-control qty1" required>
        </div>


        <div class="form-group">
           <label><font color=red>*</font>رسوم الكهرباء</label>
              <input type="number" name="electricityfees" id="electricityfees" placeholder="رسوم الكهرباء" autocomplete="off" tabindex="12" class="form-control qty1" required>
        </div>

        <div class="form-group">
           <label><font color=red>*</font>رسوم أخرى</label>
              <input type="number" name="otherfees" id="otherfees" placeholder="رسوم أخرى" autocomplete="off" tabindex="13" class="form-control qty1" required>
        </div>



          
        <div class="form-group">
           <label>المجموع</label>
              <input type="number" name="total" id="total" placeholder="المجموع" disabled autocomplete="off" tabindex="14" class="form-control total">
        </div>

         <div class="form-group">
           <label><font color=red>*</font>قيمة التأمين</label>
              <input type="number" name="insurancefees" id="insurancefees" placeholder="قيمة التأمين" autocomplete="off" tabindex="15" class="form-control" required>
        </div>

        <div class="form-group">
           <label><font color=red>*</font>قيمة السعي</label>
              <input type="number" name="brokeragefees" id="brokeragefees" placeholder="قيمة السعي" autocomplete="off" tabindex="16" class="form-control" required>
        </div>

        <div class="form-group" id="brokeragetypediv">
           <label><font color=red>*</font> رسوم المكتب </label>
              <select class="form-control select2" style="width: 100%;" id="brokeragetype" name="brokeragetype" tabindex="17" required>
                   <option  value=""> تحديد </option>
                   <option  value="1">  نسبة مئوية  </option>
                    <option  value="2"> مبلغ ثابت  </option>
                      
                 </select>
        </div>
       
        <div class="form-group" style="display: none;" id="percentdiv">
           <label>  نسبة إدارة الأملاك </label>
           <div class="input-group flex-nowrap">
          <div class="input-group-prepend">
          <span class="input-group-text" id="addon-wrapping">%</span>
          </div>
  
              <input type="number" name="borkeragepercent" id="borkeragepercent" placeholder="نسبة إدارة الأملاك" autocomplete="off" tabindex="18" class="form-control"  min="0" value="0" step="0.01" title="Currency" pattern="^\d+(?:\.\d{1,2})?$" onblur="
this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'
">
        </div>
    </div>
<div class="form-group" style="display: none;" id="fixedamountdiv">
           <label>  أجور السعي  </label>
              <input type="number" name="fixedamount" id="fixedamount" placeholder=" أدخل المبلغ الثابت " autocomplete="off" tabindex="18" class="form-control" >
        </div>





       <input type="submit" name="submitbtn" id="submitbtn" tabindex="19" class="btn btn-primary"  value="إضافة عقد">
		
			<input type="reset" name="reset" id="resetbtn" tabindex="20" class="btn btn-primary" value="مسح">
			
			
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
       
        //alert("hi");
        if(building_id !='')
        {

          $.ajax({
           //url:"http://localhost/realestate/Contracts_controller/getunits",
            url:"<?php echo base_url();?>Contracts_controller/getunits",
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
  </script>



   <script>
    $(document).ready(function(){

      $('#startdate').change(function(){

        var no=$('#no').val()+' '+ $('#contractperiod').val();
        var sdate=$('#startdate').val();
        
        if($('#no').val() !='')
        {

          $.ajax({
           //url:"http://localhost/realestate/Contracts_controller/getunits",
           
            url:"<?php echo base_url();?>Contracts_controller/getenddate",
            method: "POST",
            data: {no:no,sdate:sdate},
            success:function(data)
            {
              $('#enddate').val(data);
            }
          })
        }
      });
    });

    $(document).ready(function () {
        $('#brokeragetype').change(function () {
       var  brokeragetype= $('#brokeragetype').val();
            if ($('#brokeragetype').val() == '1')
             {
                 $('#fixedamountdiv').hide();
                 $('#percentdiv').show();

              }

               if ($('#brokeragetype').val() == '2')
             {
                 $('#fixedamountdiv').show();
                 $('#percentdiv').hide();

              }
               
        });
    });

  </script>