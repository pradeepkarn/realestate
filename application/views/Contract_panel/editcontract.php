<?php //print_r($contractList); die(); ?>
<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">اللوحة الرئيسية</a>
            </li>
            <li class="breadcrumb-item active"> إنهاء / العقود</li>
          </ol>

	<?php
	//$fcl=array('class'=>'cf','id'=>'form','name'=>'form');
	//echo form_open_multipart('Buildings_controller/insertbuildinginfo',$fcl);
?>
<div class="container">
    <div class="row">
        <div class="col-md-7 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #428bca;">
                <div class="panel-heading"> عديل \ تجديد العقد  </div>
                <div class="panel-body">
 <div class="col-md-12 mx-auto">
	<section id="container">
		<h2> تعديل \ تجديد العقد </h2>
		<div id="wrapping" class="clearfix">
			
      <?php
 // $fcl=array('class'=>'cf','id'=>'form');
 // echo form_open_multipart('Contracts_controller/insertcontractinfo',$fcl);
?>
<?php if(isset($action)) { if($action=='1') { ?>
			<form name="editcontractform" class="needs-validation" novalidate action="<?php echo base_url(); ?>contracts_controller/editcontractinfo" method="post" enctype="multipart/form-data">
       
      <?php  }
      elseif($action=='2') { ?>
          <form name="editcontractform" class="needs-validation" novalidate action="<?php echo base_url(); ?>contracts_controller/renewcontractinfo" method="post" enctype="multipart/form-data"> 
     <?php  } } ?>
       
       <input type="hidden" name="cid" id="cid" value="<?php if(isset($contractList[0]->id)) { echo $contractList[0]->id; } ?>">

       <input type="hidden" name="bid" id="bid" value="<?php if(isset($contractList[0]->building_id)) { echo $contractList[0]->building_id; } ?>">

       <input type="hidden" name="uid" id="uid" value="<?php if(isset($contractList[0]->unit_id)) { echo $contractList[0]->unit_id; } ?>">

        <div class="form-group">
                <label><font color=red>*</font>اسم العقار</label>
                <select class="form-control select2" disabled style="width: 100%;" id="buildingid" name="buildingid" tabindex="1" required>
                   <option selected value="">اسم العقار</option>
                   <?php
                    if(count($buildingList)>0){
                                    for ($i=0; $i <count($buildingList) ; $i++) { ?>
                            <option 
                              <?php if ($contractList['0']->building_id == $buildingList[$i]->id) echo ' selected ';?>

                            value="<?php echo $buildingList[$i]->id;?>"><?php echo $buildingList[$i]->building_name;?></option>
                            <?php  } } ?>  
                 </select>
                <div class="invalid-feedback">اسم العقار</div>
              </div>




          <!--  <div class="form-group">
                <label><font color=red>*</font>Update Unit Number</label>
                <select class="form-control select2"  style="width: 100%;" id="unitid" name="unitid" tabindex="2" required>
                   <option value="">Choose Unit Number</option>  
                 </select>
               </div> -->
 <?php if(substr($contractList[0]->unit_id,0,1)=="R") {
                                          $id=str_replace("R", " سكني  ", $contractList[0]->unit_id);
                                        } 

                                        if(substr($contractList[0]->unit_id,0,1)=="C") {
                                          $id=str_replace("C", " تجاري   ", $contractList[0]->unit_id);
                                        } 
                                        ?>
<div class="form-group">
                <label><font color=red>*</font> رقم الوحدة</label>
<input type="text" id="unitid" name="unitid" value="<?php if(isset($contractList[0]->unit_id)) { 
  echo  $id; } ?>" tabindex="2" class="form-control" disabled>



        <div class="form-group">
                <label><font color=red>*</font>اسم المستأجر</label>
                <select class="form-control select2"  style="width: 100%;" id="tenantid" name="tenantid" tabindex="3" required>
                   <option selected value="">اسم المستأجر</option>
                   <?php
                    if(count($tenantList)>0){
                                    for ($i=0; $i <count($tenantList) ; $i++) { ?>
                            <option
                              <?php if ($contractList['0']->tenant_id == $tenantList[$i]->id) echo ' selected ';?>
                             value="<?php echo $tenantList[$i]->id;?>"><?php echo $tenantList[$i]->tenant_firstname;?></option>
                            <?php  } } ?>  
                 </select>
                <div class="invalid-feedback">اسم المستأجر</div>
              </div>
      

         
        <div class="form-group">
           <label><font color=red>*</font>رقم العقد</label>
              <input type="text" name="contractnumber" id="contractnumber" value="<?php if(isset($contractList[0]->contract_number)) { echo $contractList[0]->contract_number; } ?>" autocomplete="off" tabindex="4" class="form-control"  required>
              <div class="invalid-feedback">رقم العقد</div>
        </div>
        

<?php if(isset($action)) { if($action=='2') { ?>


            <label><font color=red>*</font> عدد السنوات أو الشهور </label>
        <div class="form-row mb-4" style="">          
        <div class="col">
          <input type="text" id="no" name="no" class="form-control" tabindex="5" placeholder=" عدد السنوات أو الشهور " required>  
        </div>
        <div class="col" >
                  <select id="contractperiod" name="contractperiod" tabindex="6" class="custom-select browser-default" required style="width:100%;">
              <option value="Years" selected> سنين </option>
              <option value="Months"> شهور </option>
          </select>    
            
        </div>
        
    </div>       

      <?php  } } ?>
          
  <div class="form-group">
           <label><font color=red>*</font>تاريخ بداية العقد </label>
       <?php if(isset($contractList[0]->contract_startdate)) { 
        //echo $contractList[0]->contract_startdate; echo "<br>";
        $sdate= substr($contractList[0]->contract_startdate,0,10); 

        } ?>
         <?php if(isset($contractList[0]->contract_enddate)) { 
       // echo $contractList[0]->contract_startdate; echo "<br>";
        $edate= substr($contractList[0]->contract_enddate,0,10); 
        } ?>
  <input  <?php if(isset($action)) { if($action=='2') { ?> value="<?php echo $edate;?>" <?php } else { ?>
     value="<?php echo $sdate;?>" <?php }} ?>
     type="date" dateformat="d-m-Y" id="startdate" <?php if(isset($action)) { if($action=='2') { if(isset($contractList[0]->contract_enddate)) {  $edate= substr($contractList[0]->contract_enddate,0,10); ?> min="<?php  echo $edate; ?>" <?php } } }?>  name="startdate" class="form-control" tabindex="6"> 
 </div>

 <div class="form-group">
   <?php if(isset($contractList[0]->contract_enddate)) { 
       // echo $contractList[0]->contract_startdate; echo "<br>";
        $edate= substr($contractList[0]->contract_enddate,0,10); 
        } ?>
           <label><font color=red>*</font>تاريخ نهاية العقد</label>
        
  <input value="<?php  echo $edate; ?>" min="<?php echo $edate; ?>" type="date" id="enddate"  name="enddate" class="form-control" tabindex="7"> 
 </div>


 <div class="form-group">
           <label><font color=red>*</font>عدد الدفعات</label>
              <input type="text" name="noofinstallments" id="noofinstallments" value="<?php if(isset($contractList[0]->no_of_installments)) { echo $contractList[0]->no_of_installments; } ?>" autocomplete="off" tabindex="8" class="form-control" required>
        </div>


        <div class="form-group">
           <label><font color=red>*</font>قيمة الإيجار</label>
              <input type="text" name="rentamount" id="rentamount" value="<?php if(isset($contractList[0]->rent_amount)) { echo $contractList[0]->rent_amount; } ?>" autocomplete="off" tabindex="9" class="form-control qty1" required>
        </div>

        <div class="form-group">
           <label><font color=red>*</font>رسوم الماء</label>
              <input type="text" name="waterfees" id="waterfees" value="<?php if(isset($contractList[0]->water_fees)) { echo $contractList[0]->water_fees; } ?>" autocomplete="off" tabindex="10" class="form-control qty1" required>
        </div>


        <div class="form-group">
           <label><font color=red>*</font>رسوم الكهرباء</label>
              <input type="text" name="electricityfees" id="electricityfees" value="<?php if(isset($contractList[0]->electricity_fees)) { echo $contractList[0]->electricity_fees; } ?>" autocomplete="off" tabindex="11" class="form-control qty1" required>
        </div>

        <div class="form-group">
           <label><font color=red>*</font>رسوم أخرى</label>
              <input type="text" name="otherfees" id="otherfees" value="<?php if(isset($contractList[0]->other_fees)) { echo $contractList[0]->other_fees; } ?>"autocomplete="off" tabindex="12" class="form-control qty1" required>
        </div>

 
        <div class="form-group">
           <label>المجموع</label>
              <input type="text" name="total" id="total" value="<?php if(isset($contractList[0]->total)) { echo $contractList[0]->total; } ?>" disabled autocomplete="off" tabindex="13" class="form-control total">
        </div>

       
<div class="form-group">
           <label><font color=red>*</font>قيمة التأمين</label>
              <input type="text" name="insurancefees" id="insurancefees" placeholder="Enter Insurance Fees"value="<?php if(isset($contractList[0]->insurance_fees)) { echo $contractList[0]->insurance_fees; } ?>" autocomplete="off" tabindex="14" class="form-control" required>
        </div>

        <div class="form-group">
           <label><font color=red>*</font>قيمة السعي</label>
              <input type="text" name="brokeragefees" id="brokeragefees" value="<?php if(isset($contractList[0]->brokerage_fees)) { echo $contractList[0]->brokerage_fees; } ?>" autocomplete="off" tabindex="15" class="form-control" required>
        </div>

        <div class="form-group">
           <label>  نسبة إدارة الأملاك </label>
           <div class="input-group flex-nowrap">
  <div class="input-group-prepend">
    <span class="input-group-text" id="addon-wrapping">%</span>
  </div>
              <input type="text" name="borkeragepercent" id="borkeragepercent" value="<?php if(isset($contractList[0]->brokerage_percentage)) { echo $contractList[0]->brokerage_percentage; } ?>" autocomplete="off" tabindex="16" class="form-control" required>
        </div>
      </div>
<div class="form-group"  id="fixedamountdiv">
           <label>  أجور السعي  </label>
              <input type="number" name="fixedamount" id="fixedamount" placeholder=" أدخل المبلغ الثابت " 
              value="<?php if(isset($contractList[0]->fixed_brokerage_amount)) { echo $contractList[0]->fixed_brokerage_amount; } ?>"
              autocomplete="off" tabindex="17" class="form-control" >
        </div>


      </div> 	  
<input type="submit" name="submitbtn" id="submitbtn" tabindex="18" class="btn btn-primary"  value="تحديث / تجديد">
		
			<input type="reset" name="reset" id="resetbtn" tabindex="19" class="btn btn-primary" value="مسح">
			
			
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
  </script>