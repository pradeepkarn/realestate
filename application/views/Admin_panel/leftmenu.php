
    <div id="wrapper">
  
      <!-- Sidebar 
      <ul class="sidebar navbar-nav">-->
      <ul class="sidebar navbar-nav ml-auto">
        <!--
		  <div style="margin-top: 10px;">
           <font color="#fff"><center> مرحبا  <?php  if($this->session->userdata('first_name'))  {  echo $this->session->userdata('first_name'); } ?></center> </font></div>
		 -->
		     <?php if($this->session->userdata('user_role')=='Admin') { ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo(base_url()); ?>dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span> اللوحة الرئيسية </span>
          </a>
        </li>
        <?php } ?>
         <?php if(($this->session->userdata('user_role')=='Admin')||($this->session->userdata('user_role')=='Ad')) { ?>
         <li class="nav-item">
          <a class="nav-link" href="<?php echo(base_url()); ?>advertisement">
            <i class="fas fa-fw fa-circle"></i>
            <span> العروض العقارية</span>
          </a>
        </li>
       
        
          <li class="nav-item">
          <a class="nav-link" href="<?php echo(base_url()); ?>archivedadvertisement">
            <i class="fas fa-fw fa-eye"></i>
            <span> العروض العقارية المؤرشفة  </span>
          </a>
        </li>
         <?php } ?>
          <?php if($this->session->userdata('user_role')=='Admin') { ?>
        <li class="nav-item">
          <div class="dropdown-divider"></div>
        </li>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-file" ></i>
            <span> العقود  </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="position: absolute; will-change: transform; right: 70px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);">
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Contracts_controller">قائمة العقود</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>suspendedcontractlist"> قائمة العقود المعلقة   </a>  
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>endcontractlist"> قائمة العقود المنتهية  </a>   
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo(base_url()); ?>receipt">
            <i class="fas fa-fw fa-building"></i>
            <span> سندات القبض </span>
          </a>
        </li>
		<!--
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-tag" ></i>
            <span> سندات القبض  </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="position: absolute; will-change: transform; right: 70px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);">
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Receipt_controller/addreceipt">إضافة سند قبض</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Receipt_controller">قائمة سندات القبض</a>
          </div>
        </li>
		-->
        <li class="nav-item">
          <a class="nav-link" href="<?php echo(base_url()); ?>payment">
            <i class="fas fa-fw fa-credit-card"></i>
            <span> سندات الصرف </span>
          </a>
        </li>
		<!--
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-credit-card" ></i>
            <span> سندات الصرف  </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="position: absolute; will-change: transform; right: 70px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);">
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Payment_controller/addpayment"> إضافة سند صرف  </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Payment_controller"> قائمة سندات الصرف  </a>
          </div>
        </li>
		-->
        <li class="nav-item">
          <a class="nav-link" href="<?php echo(base_url()); ?>expenses">
            <i class="fas fa-fw fa-cog"></i>
            <span> المصروفات </span>
          </a>
        </li>
		<!--
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-cog" ></i>
            <span> المصروفات  </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="position: absolute; will-change: transform; right: 70px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);">
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Expenses_controller/addexpense"> إضافة مصاريف  </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Expenses_controller"> قائمة المصاريف   </a>
          </div>
        </li>
		-->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-book" ></i>
            <span> كشوف الحسابات  </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="position: absolute; will-change: transform; right: 70px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);">
            <a class="dropdown-item" href="<?php echo(base_url()); ?>tenantstatement">كشف حساب المستأجر </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>buildingstatement">كشف حساب العقار </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>revenuestatement">كشف حساب الدخل</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>cashstatement"> كشف حساب الصندوق  </a> 
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>bankstatement"> الحسابات البنكية </a> 
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>insurancestatement"> كشف حساب التأمين </a> 
          </div>
        </li>
		
        <li class="nav-item">
          <div class="dropdown-divider"></div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo(base_url()); ?>owners">
            <i class="fas fa-fw fa-child"></i>
            <span> الملاك </span>
          </a>
        </li>
		<!--
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-child" ></i>
            <span> الملاك  </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="position: absolute; will-change: transform; right: 70px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);">
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Owners_controller/addowners">إضافة مالك</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Owners_controller">قائمة الملاك</a>
          </div>
        </li>
		-->
        <li class="nav-item">
          <a class="nav-link" href="<?php echo(base_url()); ?>buildings">
            <i class="fas fa-fw fa-building"></i>
            <span> العقارات </span>
          </a>
        </li>
		<!--
        <li class="nav-item dropdown" >
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-building" ></i>
            <span> المباني  </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="position: absolute; will-change: transform; right: 70px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);">
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Buildings_controller/addbuildings"> إضافة عقار جديد  </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Buildings_controller"> قائمة العقارات  </a>                 
          </div>
        </li>
		-->
        <li class="nav-item">
          <a class="nav-link" href="<?php echo(base_url()); ?>units">
            <i class="fas fa-fw fa-list"></i>
            <span> الوحدات </span>
          </a>
        </li>
		<!--
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-list" ></i>
            <span> الوحدات السكنية  </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="position: absolute; will-change: transform; right: 70px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);">
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Units_controller/addunits">إضافة وحدة سكنية</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Units_controller">قائمة الوحدات السكنية</a>
          </div>
        </li>
		-->
        <li class="nav-item">
          <a class="nav-link" href="<?php echo(base_url()); ?>tenants">
            <i class="fas fa-fw fa-male"></i>
            <span> المستأجرين </span>
          </a>
        </li>
		<!--
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-male" ></i>
            <span> المستأجرين  </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown" style="position: absolute; will-change: transform; right: 70px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);">
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Tenants_controller/addtenants">إضافة مستأجر</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Tenants_controller">قائمة المستأجرين</a>
                 
          </div>
        </li>
		-->
        <li class="nav-item">
          <div class="dropdown-divider"></div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo(base_url()); ?>report">
            <i class="fas fa-fw fa-file"></i>
            <span>  التقارير  </span>
          </a>
        </li>
        
         
        <li class="nav-item">
          <a class="nav-link" href="<?php echo(base_url()); ?>bank">
            <i class="fas fa-fw fa-university"></i>
            <span> الحسابات البنكية </span>
          </a>
        </li>
		<!--
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
            <i class="fas fa-fw fa-university" ></i>
            <span> الحسابات البنكية  </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown"style="position: absolute; will-change: transform; right: 70px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);" style="position: absolute; will-change: transform; right: 0px; top: 0px; left: 0px; transform: translate3d(-6px, 56px, 0px);">
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Bank_controller/addbank">  إضافة حساب بنكي  </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo(base_url()); ?>Bank_controller"> قائمة البنوك  </a>
          </div>
        </li> 
		-->
		<?php if($this->session->userdata('user_role'))  {  if ($this->session->userdata('user_role')=='Admin') { ?>
        <li class="nav-item">
		  <a class="nav-link" href="<?php echo base_url();?>user">
			<i class="fa fa-fw fa-users" ></i> 
            <span> المستخدمين </span>
		  </a>
        </li>
		<?php } } } ?>
      </ul>
