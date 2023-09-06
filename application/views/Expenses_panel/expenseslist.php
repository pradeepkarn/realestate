<div id="content-wrapper">
  <div class="container-fluid">
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">اللوحة الرئيسية</a>
		</li>
		<li class="breadcrumb-item active">المصروفات</li>
	</ol>

	<div class="col s12" style="margin-top: 30px;">
	  <div class="card">
		<div class="card-content" style="padding-top: 5px;">
		  <a href="<?php echo(base_url()); ?>Expenses_controller/addexpense" class="btn btn-success" style="float: left;">+ إضافة مصاريف جديد</a>
		  <h4 class="card-title"> قائمة المصروفات </h4>
		  <?php  if($this->session->flashdata('message')) { echo $this->session->flashdata('message'); }?>
		  <div>
			<div class="card-body">
			  <div class="table-responsive">
				<table class="table table-striped" id="dataTable1" width="100%" cellspacing="0">
                  <thead>
					<tr>
					  <th style="text-align: center;"></th>
					  <th style="text-align: center;">اسم العقار</th>
					  <th style="text-align: center;">نوع المصاريف</th>
					  <th style="text-align: center;">رقم الفاتورة</th>
					  <th style="text-align: center;">التاريخ</th>
					  <th style="text-align: center;">المجموع</th>
					  <th style="text-align: center;">وصف</th>
					  <th style="text-align: right;">إجراءات</th>
					</tr> 
				  </thead>
				  <tbody>
					  <?php
						if(count($expenseList)>0){
						for ($i=0; $i <count($expenseList) ; $i++) { ?>
						   <tr>
							 <td style="text-align: center;"><?php echo $i+1;?></td>
							  <td style="text-align: center;"><?php echo $expenseList[$i]->building_name;?></td>
							<td style="text-align: center;"><?php echo $expenseList[$i]->expense_type;?></td>
							<td style="text-align: center;"><?php echo $expenseList[$i]->invoice_number;?></td>
							 <td style="text-align: center;"><?php $dat=date_create($expenseList[$i]->date); echo date_format($dat,'d-m-Y');?></td>
							  <td style="text-align: center;"><?php echo $expenseList[$i]->total_amount;?></td>
								<td style="text-align: center;"><?php echo substr($expenseList[$i]->description,0,15);?></td>                                 
						  <td style="text-align: center;">
							  <div class="row">
								<div class="col-2">
							<a href="<?php echo base_url(EXPENSES_PANEL_URL.'expenseview').'/'.$expenseList[$i]->id;?>" title="View" style="color: #607d8b;"> <i class="fa fa-eye"></i></a>
								</div>
								<div class="col-2">
							<a href="<?php echo base_url(EXPENSES_PANEL_URL.'editexpense').'/'.$expenseList[$i]->id;?>"style="color: #607d8b;"> <i class="fa fa-edit"></i></a>
								</div>
								<div class="col-2">
							<a onClick="return confirm(' هل انت متاكد من حذف البيانات ؟ ')" href="<?php echo base_url(EXPENSES_PANEL_URL.'expensesdelete').'/'.$expenseList[$i]->id;?>" title="Delete" style="color: #607d8b;"><i class="fa fa-remove"></i></a>
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
			"aoColumns": [null,null,null,null,null,null,null,{ "bSortable": false }],
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