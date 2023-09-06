<div id="content-wrapper">
  <div class="container-fluid">
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">اللوحة الرئيسية</a>
		</li>
		<li class="breadcrumb-item active">المستخدمين</li>
	</ol>

	<div class="col s12" style="margin-top: 30px;">
	  <div class="card">
		<div class="card-content" style="padding-top: 5px;">
		  <a href="<?php echo(base_url()); ?>User_controller/adduser" class="btn btn-success" style="float: left;">+ إضافة مستخدم جديد</a>
		  <h4 class="card-title"> قائمة المستخدمين </h4>
		  <?php  if($this->session->flashdata('message')) { echo $this->session->flashdata('message'); }?>
		  <div>
			<div class="card-body">
			  <div class="table-responsive">
				<table class="table table-striped" id="dataTable1" width="100%" cellspacing="0">
                  <thead>
					<tr>
					  <th style="text-align: center;"></th>
					  <th style="text-align: center;">المستخدم</th>
					  <th style="text-align: center;">البريد</th>
					  <th style="text-align: center;">الوظيفة</th>
					  <th style="text-align: right;">إجراءات</th>
					</tr> 
				  </thead>
				  <tbody>
					  <?php
						if(count($userList)>0){
						for ($i=0; $i <count($userList) ; $i++) { ?>
						   <tr>
							 <td style="text-align: center;"><?php echo $i+1;?></td>
							<td style="text-align: center;"><?php echo $userList[$i]->first_name;?></td>
							<td style="text-align: center;"><?php echo $userList[$i]->email;?></td>
							 <td style="text-align: center;"><?php echo $userList[$i]->user_role;?></td>
						  <td style="text-align: center;">
							  <div class="row">
								<div class="col-2">
							<a href="<?php echo base_url(USER_PANEL_URL.'edituser').'/'.$userList[$i]->id;?>" style="color: #607d8b;"><i class="fa fa-edit"></i></a>
								</div>
								<div class="col-2">
							<a onClick="return confirm(' هل انت متاكد من حذف البيانات ؟ ')" href="<?php echo base_url(USER_PANEL_URL.'userdelete').'/'.$userList[$i]->id;?>" title="Delete" style="color: #607d8b;"><i class="fa fa-remove"></i></a>
								</div>
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
			"aoColumns": [null,null,null,null,{ "bSortable": false }],
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