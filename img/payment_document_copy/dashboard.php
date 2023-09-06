        <div id="content-wrapper">
        <div class="container-fluid">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="<?php echo(base_url()); ?>Admin_controller/dashboard"> اللوحة الرئيسية  </a>
            </li>
            <li class="breadcrumb-item active">عام</li>
          </ol>
          
          <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-building"></i>
                  </div>

                  <div class="mr-5"> المباني   <?php  if($this->session->userdata('buildings'))  {  echo $this->session->userdata('buildings'); } ?></div>
                
                </div>
                <a class="card-footer text-white clearfix small z-1" href="<?php echo base_url(); ?>Buildings_controller">
                    <span class="float-right">عرض التفاصيل</span>
                  <span class="float-left">
                     <i class="fas fa-angle-left"></i>
                   
                    
                  </span>
                </a>
              </div>
            </div>
           
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                  </div>
                  <div class="mr-5">                 
                   الوحدات السكنية   <?php  if($this->session->userdata('units'))  {  echo $this->session->userdata('units'); } ?> </div>
                </div>
                 
                <a class="card-footer text-white clearfix small z-1"  href="<?php echo base_url(); ?>Units_controller">
                  <span class="float-right">عرض التفاصيل</span>
                  <span class="float-left">
                    <i class="fas fa-angle-left"></i>
                  </span>
                </a>
              </div>
            </div>



            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-child"></i>
                  </div>
                  <div class="mr-5">  الملاك    <?php  if($this->session->userdata('owners'))  {  echo $this->session->userdata('owners'); } ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1"  href="<?php echo base_url(); ?>Owners_controller">
                  <span class="float-right">عرض التفاصيل</span>
                  <span class="float-left">
                    <i class="fas fa-angle-left"></i>
                  </span>
                </a>
              </div>
            </div>
           

            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-male"></i>
                  </div>
                  <div class="mr-5"> المستأجرين   <?php  if($this->session->userdata('tenants'))  {  echo $this->session->userdata('tenants'); } ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1"  href="<?php echo base_url(); ?>Tenants_controller">
                  <span class="float-right">عرض التفاصيل</span>
                  <span class="float-left">
                    <i class="fas fa-angle-left"></i>
                  </span>
                </a>
              </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-file"></i>
                  </div>
                  <div class="mr-5"> العقود   <?php  if($this->session->userdata('contracts'))  {  echo $this->session->userdata('contracts'); } ?>
                  </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" 
                href="<?php echo base_url(); ?>Contracts_controller"
                >
                  <span class="float-right">عرض التفاصيل</span>
                  <span class="float-left">
                    <i class="fas fa-angle-left"></i>
                  </span>
                </a>
              </div>
            </div>
         

            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-tag"></i>
                  </div>
                  <div class="mr-5"> سندات القبض   <?php  if($this->session->userdata('receipts'))  {  echo $this->session->userdata('receipts'); } ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1"  href="<?php echo base_url(); ?>Receipt_controller">
                  <span class="float-right">عرض التفاصيل</span>
                  <span class="float-left">
                    <i class="fas fa-angle-left"></i>
                  </span>
                </a>
              </div>
            </div>


 <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-credit-card"></i>
                  </div>
                  <div class="mr-5"> سندات الصرف    <?php  if($this->session->userdata('payments'))  {  echo $this->session->userdata('payments'); } ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1"  href="<?php echo base_url(); ?>Payment_controller">
                  <span class="float-right">عرض التفاصيل</span>
                  <span class="float-left">
                    <i class="fas fa-angle-left"></i>
                  </span>
                </a>
              </div>
            </div>



 <!-- <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-university"></i>
                  </div>
                  <div class="mr-5"> الحسابات البنكية   <?php  if($this->session->userdata('bank'))  {  echo $this->session->userdata('bank'); } ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1"  href="<?php echo base_url(); ?>Bank_controller">
                  <span class="float-right">عرض التفاصيل</span>
                  <span class="float-left">
                    <i class="fas fa-angle-left"></i>
                  </span>
                </a>
              </div>
            </div> -->

            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-folder"></i>
                  </div>
                  <div class="mr-5"> المصروفات   <?php  if($this->session->userdata('expenses'))  {  echo $this->session->userdata('expenses'); } ?></div>
                </div>
                <a class="card-footer text-white clearfix small z-1"  href="<?php echo base_url(); ?>Expenses_controller">
                  <span class="float-right">عرض التفاصيل    </span>
                  <span class="float-left">
                    <i class="fas fa-angle-left"></i>
                  </span>
                </a>
              </div>
            </div>

          </div>
          </div> 

             
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
      
      </div>
      <!-- /.content-wrapper -->

   
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
   