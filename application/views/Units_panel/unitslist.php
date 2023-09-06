<div id="content-wrapper">
  <div class="container-fluid">
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">اللوحة الرئيسية</a>
		</li>
		<li class="breadcrumb-item active">الوحدات السكنية</li>
	</ol>
	
	<div class="col s12" style="margin-top: 30px;">
	  <div class="card">
		<div class="card-content" style="padding-top: 5px;">
		  <a href="<?php echo(base_url()); ?>Units_controller/addunits" class="btn btn-success" style="float: left;">+ إضافة وحدة جديدة</a>
		  <h4 class="card-title"> قائمة الوحدات السكنية </h4>
		  <?php  if($this->session->flashdata('message')) { echo $this->session->flashdata('message'); }?>
		  <div>
			<div class="card-body">
			  <div class="table-responsive">
				<table class="table table-striped" id="dataTable1" width="100%" cellspacing="0">
                  <thead>
					<tr>
					  <th style="text-align: center;"></th>
					  <th style="text-align: center;">الوحدة</th>
					  <th style="text-align: center;">العقار</th>
					  <th style="text-align: center;">غرض التأجير</th>
					  <th style="text-align: center;">نوع الوحدة</th>                                    
					  <th style="text-align: center;">المالك</th>                                  
					  <th style="text-align: center;">رقم الدور</th>
					  <th style="text-align: center;">حساب الكهرباء</th>
					  <th style="text-align: right;">إجراءات</th>
					</tr> 
				  </thead>
				  <tbody>
					  <?php
						if(count($unitList)>0){
						for ($i=0; $i <count($unitList) ; $i++) { ?>
						   <tr>
							<td> <?php echo $i+1; ?></td>
							<?php if(substr($unitList[$i]->unitid,0,1)=="R") {
							  $unitList[$i]->unitid=str_replace("R", " سكني  ", $unitList[$i]->unitid);
							} 

							if(substr($unitList[$i]->unitid,0,1)=="C") {
							  $unitList[$i]->unitid=str_replace("C", " تجاري   ", $unitList[$i]->unitid);
							} 
							?>
							<td style="text-align: center;"><?php echo $unitList[$i]->unitid;?></td>
							 <td style="text-align: center;"><?php echo $unitList[$i]->building_name;?></td>
							 <td style="text-align: center;"><?php if($unitList[$i]->unit_purpose=='0') { echo " سكني  ";} else { echo "تجاري ";};?></td>
							  <td style="text-align: center;"><?php echo $unitList[$i]->unit_type;?></td>
							 <td style="text-align: center;"><?php echo $unitList[$i]->owner_firstname;?></td>
							 <td style="text-align: center;"><?php echo $unitList[$i]->floor_no;?></td>                                        
							 <td style="text-align: center;"><?php echo $unitList[$i]->electricity_acc_no;?></td>
							<td>
							  <div class="row">
								<div class="col-2">
								<a href="<?php echo base_url(UNITS_PANEL_URL.'unitsview').'/'.$unitList[$i]->building_id.'/'.$unitList[$i]->uid;?>" style="color: #607d8b;"><i class="fa fa-eye"></i></a>
								</div>
								<div class="col-2">
								<a href="<?php echo base_url(UNITS_PANEL_URL.'editunit').'/'.$unitList[$i]->building_id.'/'.$unitList[$i]->uid;?>" style="color: #607d8b;"><i class="fa fa-edit"></i></a>
								</div>
								<!--   <a onClick="return confirm('Are you sure? you want to delete this unit information')" href="<?php echo base_url(UNITS_PANEL_URL.'unitdelete').'/'.$unitList[$i]->building_id.'/'.$unitList[$i]->unitid;?>" title="Delete" ><i class="material-icons">حذف</i></a>-->
							  </div>
							</td>
						</tr>
						<?php }
					  } ?>
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </div>
  <!-- START RIGHT SIDEBAR NAV -->
  <?php //include APPPATH.ADMIN_PATH."topnavcontent.php";?>
  <!-- END RIGHT SIDEBAR NAV -->
  <!-- END: Page Main-->
</div>

<script type="text/javascript">
	$(function () {
	  $('#page-length-option').DataTable({
		"responsive": true,
		"order": [[ 0, "asc" ]],
		"autoWidth": true,
		"aoColumns": [null,null,null,null,null,{ "bSortable": false }],
		"lengthMenu": [ [ 25, 50,75, 100, -1], [25, 50,75, 100, "All"] ],
        "language": {
			"emptyTable": "لا يوجد سجلات"
        }
	  });
	});

 
		$('#dataTable1').DataTable( {
			dom: 'Bfrtip',
			buttons: [
			  'copy', 'csv', 'excel', 'pdf', 'print'
			],
			"responsive": true,
			"order": [[ 0, "asc" ]],
			"aoColumns": [null,null,null,null,null,null,null,null,{ "bSortable": false }],
			"lengthMenu": [ [ 25, 50,75, 100, -1], [25, 50,75, 100, "All"] ],
			"autoWidth": true,
			"language": {
				"info":           "_START_ إلى _END_ من مجموع _TOTAL_ سجل",
				"infoEmpty":      "0 سجلات",
				"infoFiltered":   "(نتائج البحث من اجمالي _MAX_ سجل)",
				"emptyTable":	  "لا يوجد سجلات",
				"infoPostFix":    "",
				"thousands":      ",",
				"lengthMenu":     "عرض _MENU_ سجل",
				"loadingRecords": "يجري التحميل...",
				"processing":     "يجري المعالجة...",
				"search":         "بحث:",
				"zeroRecords":    "لا يوجد نتائج",
				"paginate": {
					"first":      "الأول",
					"last":       "الأخير",
					"next":       "التالي",
					"previous":   "السابق"
				}
			}
		});
 
</script>