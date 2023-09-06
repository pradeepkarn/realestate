<!DOCTYPE html>
<html lang="en">
<head>
  <title> ألوان الينابيع للعقارات</title>
 

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
 <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">-->
<!--===============================================================================================-->
 <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>fonts/iconic/css/material-design-iconic-font.min.css">-->
<!--===============================================================================================-->
 <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendor/animate/animate.css">-->
<!--===============================================================================================-->  
 <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendor/css-hamburgers/hamburgers.min.css">-->
<!--===============================================================================================-->
  <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendor/select2/select2.min.css">
<!--===============================================================================================-->  
<!--  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/util.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/main.css">
<!--===============================================================================================-->
</head>

<body>
  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <form class="login100-form validate-form" method="post" action="<?php echo base_url();?>Admin_controller/checkLogin">
          <span class="login100-form-title p-b-26">
          ألوان الينابيع للعقارات
          </span>
          
          <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c" align="rtl">
            <input class="input100" type="text" name="userName" style="direction: rtl;" >
            <label  data-placeholder="اسم المستخدم " style="display: block; text-align: right;"> اسم المستخدم   </label>
          </div>

          <div class="wrap-input100 validate-input" autocomplete="off" data-validate="Enter password">
            
            <input class="input100" type="password" name="pwd" autocomplete="off" style="direction: rtl;">
           
            <label style="display: block; text-align: right;"> كلمة المرور </label>
          </div>

          <div class="container-login100-form-btn">
            <div >
              <div></div>
              <button class="btn btn-primary">
                تسجيل الدخول
              </button>
            </div>
          </div>

          <div class="text-center p-t-115">
            <span class="txt1">
             <div>
   <?php if(isset($content)) { echo "<center><font size=3 color=red><b>$content</b></font></center>"; $content=""; } ?>
  
</div>
            </span>
         
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>