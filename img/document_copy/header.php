<!DOCTYPE html>
<html lang="en" dir="rtl">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
    

       <title> Admin - Dashboard  </title>
    <link rel="shortcut icon" href="<?php echo base_url();?>img/logo.jpeg" type="image/x-icon">

     <!-- Bootstrap core CSS-->
    
   <!-- Load Bootstrap RTL theme from RawGit -->

<link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
 <link href="<?php echo base_url();?>css/bootstrap-rtl.css" rel="stylesheet">
 <link href="<?php echo base_url();?>css/bootstrap_rtl.css" rel="stylesheet">

    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url();?>css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="<?php echo base_url();?>vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url();?>css/sb-admin.css" rel="stylesheet">
    <!-- <link href="<?php echo base_url();?>css/newstyle.css" rel="stylesheet">-->
   <!-- <link href="<?php echo base_url();?>css/sb-admin-2.css" rel="stylesheet">-->


 <script src="<?php echo base_url();?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="<?php echo base_url();?>vendor/bootstrap/js/bootstrap.min.js"></script> -->
    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url();?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <!--<script src="<?php echo base_url();?>vendor/chart.js/Chart.min.js"></script>-->
    <script src="<?php echo base_url();?>vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url();?>js/sb-admin.min.js"></script>
    <!--<script src="<?php echo base_url();?>js/user_list.js"></script>-->

    <!-- Demo scripts for this page-->
    <script src="<?php echo base_url();?>js/demo/datatables-demo.js"></script>
   <!-- <script src="<?php echo base_url();?>js/demo/chart-area-demo.js"></script>-->


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<!---<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>-->

<?php
  // Send a raw HTTP header
  header ('Content-Type: text/html; charset=UTF-8');
  
  // Declare encoding META tag, it causes browser to load the UTF-8 charset before displaying the page.
  echo '<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />';
  
  // Right to Left issue
  echo '<body dir="rtl">';
?>
<link href="<?php echo base_url();?>css/bootstrap.minn.css" rel="stylesheet">
<script src="<?php echo base_url();?>vendor/datatables/jqueryn.min.js"></script>
</head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
     
      <a class="navbar-brand mr-1" href="<?php echo base_url(); ?>Admin_controller/dashboard">Admin Panel</a>
    
       
      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
     <!-- <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>-->

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
      
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          
           <?php  if($this->session->userdata('user_role'))  {  if ($this->session->userdata('user_role')=='Admin') { ?>
           <a class="dropdown-item" href="<?php echo base_url();?>User_controller"> 
            <i class="fa fa-user fa-fw"></i>User</a>
            <div class="dropdown-divider"></div>
          <?php } } ?>
             <a class="dropdown-item" href="<?php echo base_url();?>Admin_controller/profile">Settings</a>
             <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo base_url();?>Admin_controller/logout">Logout</a>
          </div>
        </li>
      </ul>
 

    </nav>
   
