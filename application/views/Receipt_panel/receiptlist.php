<div id="content-wrapper">
  <div class="container-fluid">
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">اللوحة الرئيسية</a>
		</li>
		<li class="breadcrumb-item active">سندات القبض</li>
	</ol>
	
	<div class="col s12" style="margin-top: 30px;">
	  <div class="card">
		<div class="card-content" style="padding-top: 5px;">
		  <a href="<?php echo(base_url()); ?>Receipt_controller/addreceipt" class="btn btn-success" style="float: left;">+ إضافة سند جديد</a>
		  <h4 class="card-title"> قائمة سندات القبض </h4>
		  <?php  if($this->session->flashdata('message')) { echo $this->session->flashdata('message'); }?>
		  <div>
			<div class="card-body">
			  <div class="table-responsive">
				<table class="table table-striped" id="dataTable1" width="100%" cellspacing="0">
                  <thead>
					<tr>
					  <th style="text-align: center;"></th>
					  <th style="text-align: center;">رقم السند</th>   
					  <th style="text-align: center;">العقار</th> 
					  <th style="text-align: center;">الوحدة</th>  
					  <th style="text-align: center;">المستأجر</th>
					  <th style="text-align: center;">نوع \ رقم الدفعة</th>
					  <th style="text-align: center;">الرصيد المتبقي</th>
					  <th style="text-align: right;">إجراءات</th>
					</tr> 
				  </thead>
				  <tbody>
					  <?php
						if(count($receiptList)>0){
						for ($i=0; $i <count($receiptList) ; $i++) { ?>
						   <tr>
							<td style="text-align: center;"><?php echo $i+1; ?></td>
							 <td style="text-align: center;"><?php echo $receiptList[$i]->receiptid;?></td>
							<td style="text-align: center;"><?php echo $receiptList[$i]->building_name;?></td>
							<td style="text-align: center;">
							   <?php if(substr($receiptList[$i]->unit_id,0,1)=="R") {
							  $id=str_replace("R", " سكني  ", $receiptList[$i]->unit_id);
							} 
						   elseif(substr($receiptList[$i]->unit_id,0,1)=="C") {
							  $id=str_replace("C", " تجاري   ", $receiptList[$i]->unit_id);
							} 
							else
							{
							  $id=$receiptList[$i]->unit_id;
							}
							?>
							  <?php  echo $id;?></td>
							<td style="text-align: center;"><?php echo $receiptList[$i]->tenant_firstname;?></td>
							 <td style="text-align: center;"><?php echo $receiptList[$i]->installment_number;?></td>
							 <td style="text-align: center;"><?php echo $receiptList[$i]->current_balance;?></td>
							 <td>
							  <div class="row">
								<div class="col-2">
								<a href="<?php echo base_url(RECEIPT_PANEL_URL.'receiptview').'/'.$receiptList[$i]->receiptid;?>" title="View" style="color: #607d8b;"><i class="fa fa-eye"></i></a>
								</div>
								<?php if(isset($receiptList[$i]->installment_number)) { ?>
								<div class="col-2">
								<a href="<?php echo base_url(RECEIPT_PANEL_URL.'editreceipt').'/'.$receiptList[$i]->receiptid ?>" style="color: #607d8b;"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
								</div>
								<?php } ?>
								<div class="col-2">
								<a target="_blank"
								<?php if(($receiptList[$i]->insurance_paid_status==1) || ($receiptList[$i]->brokerage_paid_status==1)) { ?>
								 href="<?php echo base_url(RECEIPT_PANEL_URL.'otherreceipts').'/'.$receiptList[$i]->receiptid?>" style="color: #607d8b;"><i class="fa fa-print"></i>
								<?php  } else { ?>
								href="<?php echo base_url(RECEIPT_PANEL_URL.'receipts').'/'.$receiptList[$i]->receiptid?>" style="color: #607d8b;"><i class="fa fa-print"></i>
								<?php } ?>
								 </a>
								</div>
								<!--  <a onClick="return confirm('Are you sure? you want to Delete this Receipt ')" href="<?php echo base_url(RECEIPT_PANEL_URL.'contractdelete').'/'.$receiptList[$i]->receiptid.'/'.$receiptList[$i]->receiptid;?>" title="Delete" ><i class="material-icons">End</i></a>-->
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