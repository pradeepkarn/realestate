<?php //print_r($paymentList); die();?>
<div id="content-wrapper">
  <div class="container-fluid">
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">اللوحة الرئيسية</a>
		</li>
		<li class="breadcrumb-item active">سندات الصرف</li>
	</ol>

	<div class="col s12" style="margin-top: 30px;">
	  <div class="card">
		<div class="card-content" style="padding-top: 5px;">
		  <a href="<?php echo(base_url()); ?>Payment_controller/addpayment" class="btn btn-success" style="float: left;">+ إضافة سند جديد</a>
		  <h4 class="card-title"> قائمة سندات الصرف </h4>
		  <?php  if($this->session->flashdata('message')) { echo $this->session->flashdata('message'); }?>
		  <div>
			<div class="card-body">
			  <div class="table-responsive">
				<table class="table table-striped" id="dataTable1" width="100%" cellspacing="0">
                  <thead>
					<tr>
					  <th style="text-align: center;"></th>
					  <th style="text-align: center;">رقم السداد</th>   
					  <th style="text-align: center;">العقار</th> 
					  <th style="text-align: center;">الوحدة</th>  
					  <th style="text-align: center;">المالك</th>
					  <th style="text-align: center;">القيمة</th>
					  <th style="text-align: center;">تاريخ الدفع</th>
					  <th style="text-align: right;">إجراءات</th>
					</tr> 
				  </thead>
				  <tbody>
					  <?php
						if(count($paymentList)>0){
						for ($i=0; $i <count($paymentList) ; $i++) { ?>
						   <tr>
							<td style="text-align: center;"><?php echo $i+1; ?></td>
							 <td style="text-align: center;"><?php echo $paymentList[$i]->id;?></td>
							<td style="text-align: center;"><?php echo $paymentList[$i]->building_name;?></td>
							  <?php if(substr($paymentList[$i]->unit_id,0,1)=="R") {
							  $id=str_replace("R", " سكني  ", $paymentList[$i]->unit_id);
							} 
							elseif(substr($paymentList[$i]->unit_id,0,1)=="C") {
							  $id=str_replace("C", " تجاري   ", $paymentList[$i]->unit_id);
							} 
							else
							{
							   $id=$paymentList[$i]->unit_id;
							}
							?>
							<td style="text-align: center;"><?php echo $id;?></td>
							<td style="text-align: center;"><?php echo $paymentList[$i]->owner_firstname;?></td>
							 <td style="text-align: center;"><?php echo $paymentList[$i]->payment_amount;?></td>
							 <td style="text-align: center;"><?php echo substr($paymentList[$i]->payment_date,0,10);?></td>
						  <td style="text-align: center;">
							  <div class="row">
								<div class="col-2">
							<a href="<?php echo base_url(PAYMENT_PANEL_URL.'paymentview').'/'.$paymentList[$i]->paymentid;?>" title="View" style="color: #607d8b;"><i class="fa fa-eye"></i></a>
								</div>
								<div class="col-2">
							<a target="_blank" href="<?php echo base_url(PAYMENT_PANEL_URL.'payments').'/'.$paymentList[$i]->paymentid?>" style="color: #607d8b;"><i class="fa fa-print"></i></a>
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