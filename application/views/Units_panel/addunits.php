<div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">اللوحة الرئيسية</a>
            </li>
            <li class="breadcrumb-item active"> إضافة وحدة سكنية / الوحدات السكنية</li>
          </ol>

	<?php
	//$fcl=array('class'=>'cf','id'=>'form','name'=>'form');
	//echo form_open_multipart('Units_controller/insertbuildinginfo',$fcl);
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #428bca;">
                <div class="panel-heading"> إضافة وحدة سكنية  </div>
                <div class="panel-body">
 <div class="col-md-12 mx-auto">
	<section id="container">
		<h2> إضافة وحدة سكنية  </h2>
		<div id="wrapping" class="clearfix">
			
			<form name="addunitsform" class="needs-validation" novalidate action="<?php echo base_url(); ?>Units_controller/insertunitinfo" method="post">

              <div class="form-group">
                <label><font color=red>*</font> اسم العقار  </label>
                <select class="form-control select2" style="width: 100%;" id="buildingid" name="buildingid" tabindex="1" required>
                	 <option selected value=""> اسم العقار  </option>
                   <?php
                    if(count($buildingList)>0){
                                    for ($i=0; $i <count($buildingList) ; $i++) { ?>
                            <option value="<?php echo $buildingList[$i]->id; ?>"><?php echo $buildingList[$i]->building_name; ?></option>
                            <?php  } } ?>  
                 </select>
                <div class="invalid-feedback"> اسم العقار  </div>
              </div>
               <div class="form-group" style="display: none;padding: 20px;" id="infodiv">
                <input type="text" name="total" id="total" style="background: transparent;border:none;outline: none;padding: 0px 0px 0px 0px;" readonly /> المجموع  <br><br>
               <input type="text" name="entered" id="entered" style="background: transparent;border:none;outline: none;padding: 0px 0px 0px 0px;" readonly /> مدخل  <br><br>
                 <input type="text" name="residential"  id="residential" style="background: transparent;border:none;outline: none;padding: 0px 0px 0px 0px;" readonly /> عدد الوحدات السكنية <br><br>
                  <input type="hidden" name="residentialentered"  id="residentialentered" style="background: transparent;border:none;outline: none;padding: 0px 0px 0px 0px;" readonly /> 
                  <input type="text" name="commercial" id="commercial" style="background: transparent;border:none;outline: none;padding: 0px 0px 0px 0px;" readonly /> عدد الوحدات التجارية  <br><br>
                   <input type="hidden" name="commercialentered" id="commercialentered" style="background: transparent;border:none;outline: none;padding: 0px 0px 0px 0px;" readonly /> 
              </div>
              <div id="division" name="division">
               <div class="form-group" id="up" name="up">
                <label><font color=red>*</font> غرض التأجير  </label><br>
                  <div id="resi" name="resi">
                <label class="radio-inline"><input type="radio" name="unitpurpose" id="unitpurpose1" value="0" checked> سكني   </label></div>
              <div id="comm" name="comm">
               <label class="radio-inline"><input type="radio" name="unitpurpose" id="unitpurpose2" value="1">تجاري   </label>
             </div>
                </div>

                 <div class="form-group">               
                <div id="residentunits" name="residentunits"  >
                   <label><font color=red>*</font> رقم الوحدة </label> 
                  <select  id="residentunitid" name="residentunitid" class="form-control"  >
                    <option value="" selected="" >-- رقم الوحدة --</option> 
                               
                </select>              
                </div>
                <div id="commercialunits" name="commercialunits" style="display: none;">
                   <label><font color=red>*</font> رقم الوحدة </label> 
                  <select  id="commercialunitid" name="commercialunitid" class="form-control" >
                    <option value="" selected="">-- رقم الوحدة --</option> 
                                       
                </select>              
                </div>

                </div>
                        


              <div class="form-group">
                <label><font color=red>*</font> نوع الوحدة  </label>
                <select class="form-control select2" style="width: 100%;" id="unittype" name="unittype" tabindex="2" required>
                   <option selected value=""> نوع الوحدة  </option>
                  <option  value=" فيلا  "> فيلا  </option>
                  <option  value=" دور أرضي  "> دور أرضي  </option>
                  <option  value=" دور علوي  "> دور علوي  </option>
                  <option  value=" شقة  "> شقة  </option>
                  <option  value=" محل  "> محل  </option>
                  <option  value=" معرض  "> معرض  </option>
                  <option  value=" ورشة  "> ورشة  </option>
                  <option  value=" بيت  "> بيت  </option>
                  <option  value=" كشك  "> كشك  </option>
                  <option  value=" استراحة  "> استراحة  </option>
                 </select>
                <div class="invalid-feedback"> نوع الوحدة  </div>
              </div>
       
   
              
        <div class="form-group">
           <label><font color=red>*</font> رقم الدور  </label>
              <input type="number" name="floorno" id="floorno" placeholder=" رقم الدور  " autocomplete="off" tabindex="3" class="form-control" required>
        </div>

        <div class="form-group">
           <label><font color=red>*</font> رقم حساب الكهرباء  </label>
              <input type="number" name="accno" id="accno" oninput="this.value=this.value.replace(/[^0-9]/g,'');" placeholder=" رقم حساب الكهرباء  " autocomplete="off" tabindex="4" class="form-control" required>
        </div>

		<div class="form-group">

      <input type="submit" name="submitbtn" id="submitbtn" tabindex="5" class="btn btn-primary"  value=" إضافة وحدة سكنية  ">		
			<input type="reset" name="reset" id="resetbtn" tabindex="8" class="btn btn-primary" value="مسح">
    </div>
  </div>
		</section>
  </div>
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

        var bid=$('#buildingid').val()
       //alert(bid);

        
        if($('#buildingid').val() !='')
        {

          $.ajax({
           //url:"http://localhost/realestate/Contracts_controller/getunits",
           
            url:"<?php echo base_url();?>Units_controller/getbuildinginfo",
            method: "POST",
            data: {bid:bid},
            success:function(data)
            {
              $('#infodiv').show();
            
              var fields = data.split('//');

               $('#total').val(fields[0]);
                $('#entered').val(fields[1]);
                 $('#residential').val(fields[2]);
                  $('#residentialentered').val(fields[3]);
                  $('#commercial').val(fields[4]);
                   $('#commercialentered').val(fields[5]);
                              
                    $('#residentunitid').html(fields[6]);

                    $('#commercialunitid').html(fields[7]);
                   
                   
                    //-------------- when residential 0--------
                   if((fields[2]=="0")&& (fields[4]>"0"))
                   {
                    radiobtn = document.getElementById("unitpurpose2");
                    radiobtn.checked = true;
                    
                    $('#resi').hide();
                     $('#residentunits').hide();                     
                     $('#residentunitid').hide();
                     $('#comm').show();
               $('#commercialunits').show();
               $('#commercialunitid').show();
                   }
                   
             if((fields[4]=="0")&& (fields[2]>"0"))
             {
             radiobtn = document.getElementById("unitpurpose1");
             radiobtn.checked = true;
             $('#resi').show();
                     $('#residentunits').show();                     
                     $('#residentunitid').show();
               $('#comm').hide();
               $('#commercialunits').hide();
               $('#commercialunitid').hide();
             }


              if((fields[2]>"0") && (fields[4]>"0"))
             {
              radiobtn = document.getElementById("unitpurpose1");
                    radiobtn.checked = true;
                    document.getElementById('up').style.visibility = 'visible';
                $('#comm').show();
                 $('#commercialunits').hide();                 
                 $('#commercialunitid').hide();
             }

             if((fields[2]=="0") && (fields[4]=="0"))
             {
              alert(" لقد قمت بالفعل بإضافة الوحدات ");
              document.getElementById('up').style.visibility = 'hidden';
              window.location.href = "<?php echo site_url('Units_controller/addunits'); ?>";
              //window.location.href = "<?php //redirect(base_url(UNITS_PANEL_URL)); ?>";
              
              }
              else
              {
              document.getElementById('up').style.visibility = 'visible';
              document.getElementById('submitbtn').style.visibility = 'visible';
              }
           }
          })
        }
      });
    });


  </script>

<script>
    $(document).ready(function(){

    document.addEventListener('input',(e)=>{

if(e.target.getAttribute('name')=="unitpurpose")
{
if(e.target.value==0)
{
  $('#residentunits').show();
$('#commercialunits').hide();
$('#commercialunitid').hide();
}
else
{
  $('#residentunits').hide();
  $('#commercialunits').show();
  $('#commercialunitid').show();
}
}
})
    });
  </script>