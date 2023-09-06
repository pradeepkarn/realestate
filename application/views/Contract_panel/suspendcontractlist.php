<?php //echo($list); die();?>
<div id="content-wrapper">
  <div class="container-fluid">

	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">اللوحة الرئيسية</a>
		</li>
		<li class="breadcrumb-item active">العقود</li>
	</ol>

	<div class="col s12" style="margin-top: 50px;">
	  <div class="card">
		<div class="card-content" style="padding-top: 5px;">
		  <a href="<?php echo(base_url()); ?>Contracts_controller/addcontract" class="btn btn-success" style="float: left;">+ إضافة عقد جديد</a>
		  <h4 class="card-title"> قائمة العقود </h4>
		  <?php  if($this->session->flashdata('message')) { echo $this->session->flashdata('message'); }?>
		  <div>
			<div class="card-body">
			  <div class="table-responsive">
				<table class="table table-striped" id="dataTable1" width="100%" cellspacing="0">
                  <thead>
					<tr>
					  <th style="text-align: center;"></th>
					  <th style="text-align: center;">رقم العقد</th>   
					  <th style="text-align: center;">العقار</th> 
					  <th style="text-align: center;">الوحدة</th>      
					  <th style="text-align: center;">المستأجر</th>
					  <!--<th style="text-align: center;">البداية</th>-->
					  <th style="text-align: center;">الإنتهاء</th>
					  <?php if($list==1) { ?>
					  <th style="text-align: right;">إجراءات</th>
					  <?php } ?>
					</tr> 
				  </thead>
				  <tbody>
					  <?php
						if(count($contractList)>0){
						for ($i=0; $i <count($contractList) ; $i++) { ?>
						   <tr>
							<td style="text-align: center;"><?php echo $i+1; ?></td>
							<td style="text-align: center;"><?php echo $contractList[$i]->contract_number;?></td>
							<td style="text-align: center;"><?php echo $contractList[$i]->building_name;?></td>
							<?php if(substr($contractList[$i]->unit_id,0,1)=="R") {
							  $id=str_replace("R", " سكني  ", $contractList[$i]->unit_id);
							} 
							elseif(substr($contractList[$i]->unit_id,0,1)=="C") {
							  $id=str_replace("C", " تجاري   ", $contractList[$i]->unit_id);
							} 
							else
							{
							  $id=$contractList[$i]->unit_id;
							}
							?>
							<td style="text-align: center;"><?php echo $id;?></td>
							<td style="text-align: center;"><?php echo $contractList[$i]->tenant_firstname;?></td>
							<!--<td style="text-align: center;"><?php echo substr($contractList[$i]->contract_startdate,0,10);?></td>-->
							<td style="text-align: center;"><?php echo substr($contractList[$i]->contract_enddate,0,10);?></td>
								  <td style="text-align: center;">
							<td style="text-align: center;">
							  <div class="row">
								<div class="col-2">
								  <a href="<?php echo base_url(CONTRACT_PANEL_URL.'contractview').'/'.$contractList[$i]->cid;?>" title="عرض" style="color: #607d8b;"><i class="fa fa-eye"></i></a>
								</div>
								<?php if($list==1) { //echo "suspend"; ?>
								<div class="col-2">
								  <a href="<?php echo base_url(RECEIPT_PANEL_URL.'suspendreceipt')."/".$contractList[$i]->cid."/".$contractList[$i]->unit_id; ?>" title="دفع وإنهاء" ><i class="fa fa-money"></i></a></td>
								</div>
								<?php }  ?>
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
			"emptyTable": "لا يوجد عقود"
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
			"aoColumns": [null,null,null,null,null,null,{ "bSortable": false }],
			"lengthMenu": [ [ 25, 50,75, 100, -1], [25, 50,75, 100, "All"] ],
			"autoWidth": true,
			"language": {
				"info":           "_START_ إلى _END_ من مجموع _TOTAL_ عقد",
				"infoEmpty":      "0 عقود",
				"infoFiltered":   "(نتائج البحث من اجمالي _MAX_ عقد)",
				"emptyTable":	  "لا يوجد عقود",
				"infoPostFix":    "",
				"thousands":      ",",
				"lengthMenu":     "عرض _MENU_ عقد",
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