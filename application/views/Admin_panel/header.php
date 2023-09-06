<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" CONTENT="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> لوحة التحكم </title>
    <link rel="shortcut icon" href="<?php echo base_url();?>img/logo.png" type="image/x-icon">

	<!-- Bootstrap core CSS-->
	<!-- Load Bootstrap RTL theme from RawGit -->
	<link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
	<link href="<?php echo base_url();?>css/bootstrap-rtl.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/bootstrap_rtl.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- Custom fonts for this template-->
	<link href="<?php echo base_url();?>css/all.min.css" rel="stylesheet" type="text/css">

	 

	<!-- Custom styles for this template-->
	<link href="<?php echo base_url();?>css/sb-admin.css" rel="stylesheet">
	<!-- <link href="<?php echo base_url();?>css/newstyle.css" rel="stylesheet">-->
	<!-- <link href="<?php echo base_url();?>css/sb-admin-2.css" rel="stylesheet">-->
	<link href="<?php echo base_url();?>css/bootstrap.minn.css" rel="stylesheet">
	  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

     <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

 
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 
	<script src="<?php echo base_url();?>js/sb-admin.js"></script>
	<script src="<?php echo base_url();?>js/sb-admin.min.js"></script>
	<!-- <script src="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"></script> -->
	 
 

	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>





	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- jQuery -->

 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>



<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js
"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>


	 
	<!---<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>-->

	<?php
	// Send a raw HTTP header
	//header ('Content-Type: text/html; charset=UTF-8');
	// Declare encoding META tag, it causes browser to load the UTF-8 charset before displaying the page.
	//echo '<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />';
	// Right to Left issue
	//echo '<body dir="rtl">';
	?>
	


</head>

<body dir="rtl" id="page-top">
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <button class="btn btn-link btn-sm text-white" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>
    <a class="navbar-brand mr-1" href="<?php echo base_url(); ?>Admin_controller/dashboard">لوحة التحكم</a>

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
			<?php if($this->session->userdata('first_name')) { echo $this->session->userdata('first_name'); } ?>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="<?php echo base_url();?>Admin_controller/profile"><i class="fa fa-fw fa-user"></i> الحساب </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo base_url();?>Admin_controller/logout"><i class="fa fa-fw fa-unlock"></i> تسجيل الخروج </a>
          </div>
        </li>
    </ul>
  </nav>
   
