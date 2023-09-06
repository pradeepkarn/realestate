        <div id="content-wrapper">
        <div class="container-fluid">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item active">
              اللوحة الرئيسية
            </li>
          </ol>
           <?php if($this->session->userdata('user_role')=='Admin') { ?>
          <!-- Icon Cards-->
          <div class="row">
			<div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white o-hidden h-100" style="background: #607d8b;">
                <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url(); ?>advertisement">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-file"></i>
                  </div>
                  <div class="mr-5" style="float: left; font-size: 40px;"> <?php  if($this->session->userdata('advertisements'))  {  echo $this->session->userdata('advertisements'); } else { echo "0"; }?></div>
                  <div class="mr-5" style="font-size: 20px;"> العروض العقارية </div>
                </div>
                </a>
              </div>
            </div>
			<div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white o-hidden h-100" style="background: #607d8b;">
                <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url(); ?>Contracts_controller">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-file"></i>
                  </div>
                  <div class="mr-5" style="float: left; font-size: 40px;"> <?php  if($this->session->userdata('contracts'))  {  echo $this->session->userdata('contracts'); }  else { echo "0"; } ?></div>
                  <div class="mr-5" style="font-size: 20px;"> العقود </div>
                </div>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white o-hidden h-100" style="background: #607d8b;">
                <a class="card-footer text-white clearfix small z-1"  href="<?php echo base_url(); ?>receipt">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-tag"></i>
                  </div>
                  <div class="mr-5" style="float: left; font-size: 40px;"> <?php  if($this->session->userdata('receipts'))  {  echo $this->session->userdata('receipts'); } else { echo "0"; }?></div>
                  <div class="mr-5" style="font-size: 20px;"> سندات القبض  </div>
                </div>
                </a>
              </div>
            </div>
			<div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white o-hidden h-100" style="background: #607d8b;">
                <a class="card-footer text-white clearfix small z-1"  href="<?php echo base_url(); ?>payment">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-credit-card"></i>
                  </div>
                  <div class="mr-5" style="float: left; font-size: 40px;"> <?php  if($this->session->userdata('payments'))  {  echo $this->session->userdata('payments'); } else { echo "0"; } ?></div>
                  <div class="mr-5" style="font-size: 20px;"> سندات الصرف </div>
                </div>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white o-hidden h-100" style="background: #607d8b;">
                <a class="card-footer text-white clearfix small z-1"  href="<?php echo base_url(); ?>expenses">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-cog"></i>
                  </div>
                  <div class="mr-5" style="float: left; font-size: 40px;"> <?php  if($this->session->userdata('expenses'))  {  echo $this->session->userdata('expenses'); } else { echo "0"; } ?></div>
                  <div class="mr-5" style="font-size: 20px;"> المصروفات </div>
                </div>
                </a>
              </div>
            </div>

			<div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white o-hidden h-100" style="background: #607d8b;">
                <a class="card-footer text-white clearfix small z-1"  href="<?php echo base_url(); ?>owners">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-child"></i>
                  </div>
                  <div class="mr-5" style="float: left; font-size: 40px;"><?php  if($this->session->userdata('owners'))  {  echo $this->session->userdata('owners'); } else { echo "0"; } ?></div>
                  <div class="mr-5" style="font-size: 20px;">الملاك</div>
                </div>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white o-hidden h-100" style="background: #607d8b;">
                <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url(); ?>buildings">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-building"></i>
                  </div>
                  <div class="mr-5" style="float: left; font-size: 40px;"> <?php  if($this->session->userdata('buildings'))  {  echo $this->session->userdata('buildings'); }else { echo "0"; } ?></div>
                  <div class="mr-5" style="font-size: 20px;"> المباني </div>
                </div>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white o-hidden h-100" style="background: #607d8b;">
                <a class="card-footer text-white clearfix small z-1"  href="<?php echo base_url(); ?>units">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                  </div>
                  <div class="mr-5" style="float: left; font-size: 40px;"> <?php  if($this->session->userdata('units'))  {  echo $this->session->userdata('units'); } else { echo "0"; }?> </div>
                  <div class="mr-5" style="font-size: 20px;"> الوحدات السكنية </div>
                </div>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white o-hidden h-100" style="background: #607d8b;">
                <a class="card-footer text-white clearfix small z-1"  href="<?php echo base_url(); ?>tenants">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-male"></i>
                  </div>
                  <div class="mr-5" style="float: left; font-size: 40px;"> <?php  if($this->session->userdata('tenants'))  {  echo $this->session->userdata('tenants'); } else { echo "0"; } ?></div>
                  <div class="mr-5" style="font-size: 20px;"> المستأجرين </div>
                </div>
                </a>
              </div>
            </div>

			<div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white o-hidden h-100" style="background: #607d8b;">
                <a class="card-footer text-white clearfix small z-1"  href="<?php echo base_url(); ?>bank">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-university"></i>
                  </div>
                  <div class="mr-5" style="float: left; font-size: 40px;"> <?php  if($this->session->userdata('bank'))  {  echo $this->session->userdata('bank'); } else { echo "0"; } ?></div>
                  <div class="mr-5" style="font-size: 20px;"> الحسابات البنكية </div>
                </div>
                </a>
              </div>
            </div> 
			
           </div>
           
           <?php } ?>
          </div> 

        <!-- /.container-fluid -->
        <!-- Sticky Footer -->
      </div>
      <!-- /.content-wrapper -->
    <!-- /#wrapper -->
    <!-- Scroll to Top Button-->
   