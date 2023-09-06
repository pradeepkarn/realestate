
    <div id="wrapper">
  
      <!-- Sidebar 
      <ul class="sidebar navbar-nav">-->
        <ul class="sidebar navbar-nav ml-auto" style="direction: rtl;">
       
          <div style="margin-top: 10px;">
           <font color="#fff"><center> Welcome <?php  if($this->session->userdata('first_name'))  {  echo $this->session->userdata('first_name'); } ?></center> </font></div>
        <li class="nav-item active" >
          <a class="nav-link" href="<?php echo(base_url()); ?>Admin_controller/dashboard">
            <i class="fas fa-fw fa-tachometer-alt" style="width: 50px;text-align: right;"></i>
            <span> اللوحة الرئيسية  </span>
          </a>
        </li>
       


        <li class="nav-item dropdown" >
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

            <i class="fas fa-fw fa-building" style="width: 50px;text-align: right;"></i>
            <span> المباني  </span>

          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="position: absolute; will-change: transform; right: 70px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);">
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Buildings_controller/addbuildings"> إضافة عقار جديد  </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Buildings_controller"> قائمة العقارات  </a>                 
          </div>
        </li>



<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-list" style="width: 80px;text-align: right;"></i>
            <span> الوحدات السكنية  </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="position: absolute; will-change: transform; right: 70px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);">
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Units_controller/addunits">إضافة وحدة سكنية</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Units_controller">قائمة الوحدات السكنية</a>
                 
          </div>
        </li>



 <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-child" style="width: 50px;text-align: right;"></i>
            <span> الملاك  </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="position: absolute; will-change: transform; right: 70px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);">
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Owners_controller/addowners">إضافة مالك</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Owners_controller">قائمة الملاك</a>
                 
          </div>
        </li>



 <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-male" style="width: 50px;text-align: right;"></i>
            <span> المستأجرين  </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="position: absolute; will-change: transform; right: 70px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);">
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Tenants_controller/addtenants">إضافة مستأجر</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Tenants_controller">قائمة المستأجرين</a>
                 
          </div>
        </li>

<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-file" style="width: 50px;text-align: right;"></i>
            <span> العقود  </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="position: absolute; will-change: transform; right: 70px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);">
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Contracts_controller/addcontract">إضافة عقد</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Contracts_controller">قائمة العقود</a>
               <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo(base_url()); ?>Contracts_controller/suspendedcontractlist"> قائمة العقود المعلقة   </a>  
                 <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo(base_url()); ?>Contracts_controller/endcontractlist"> قائمة العقود المنتهية  </a>   
          </div>
        </li>

 <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-tag" style="width: 80px;text-align: right;"></i>
            <span> سندات القبض  </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="position: absolute; will-change: transform; right: 70px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);">
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Receipt_controller/addreceipt">إضافة سند قبض</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Receipt_controller">قائمة سندات القبض</a>
             
          </div>
        </li>


<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-credit-card" style="width: 80px;text-align: right;"></i>
            <span> سندات الصرف  </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="position: absolute; will-change: transform; right: 70px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);">
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Payment_controller/addpayment"> إضافة سند صرف  </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Payment_controller"> قائمة سندات الصرف  </a>
                 
          </div>
        </li>


       <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
            <i class="fas fa-fw fa-university" style="width: 80px;text-align: right;"></i>
            <span> الحسابات البنكية  </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown"style="position: absolute; will-change: transform; right: 70px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);" style="position: absolute; will-change: transform; right: 0px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);">
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Bank_controller/addbank">  إضافة حساب بنكي  </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Bank_controller"> قائمة البنوك  </a>
                 
          </div>
        </li> 
        

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder" style="width: 80px;text-align: right;"></i>
            <span> المصروفات  </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="position: absolute; will-change: transform; right: 70px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);">
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Expenses_controller/addexpense"> إضافة مصاريف  </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Expenses_controller"> قائمة المصاريف   </a>
                 
          </div>
        </li>

          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder" style="width: 80px;text-align: right;"></i>
            <span> كشوف الحسابات  </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="position: absolute; will-change: transform; right: 70px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);">
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Statement_controller/tenantstatement">كشف حساب المستأجر </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Statement_controller/buildingstatement">كشف حساب العقار </a>
              <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Statement_controller/revenuestatement">كشف حساب الدخل</a>
                  <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Statement_controller/cashstatement"> كشف حساب الصندوق  </a> 
              <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Statement_controller/bankstatement"> الحسابات البنكية </a> 
          </div>
        </li>

      </ul>

