<div id="content-wrapper">
  <div class="container-fluid">
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
		  <a href="<?php echo(base_url()); ?>Admin_controller/dashboard">اللوحة الرئيسية</a>
		</li>
		<li class="breadcrumb-item active">لعروض العقارية</li>
	</ol>
	
	<div class="col s12" style="margin-top: 30px;">
	  <div class="card">
		<div class="card-content" style="padding-top: 5px;">
		  <a href="<?php echo(base_url()); ?>Ad_controller/addad" class="btn btn-success" style="float: left;">+ إضافة عرض جديد</a>
		  <h4 class="card-title"> قائمة العروض العقارية </h4>
		  <?php  if($this->session->flashdata('message')) { echo $this->session->flashdata('message'); }?>
		  <div>
			<div class="card-body">
			  <div class="table-responsive">
				<table class="table table-striped" id="dataTable1" width="100%" cellspacing="0">
                  <thead>
					<tr>
					  <th style="text-align: center;"></th>
					  <th style="text-align: center;">العنوان</th>
					  <th style="text-align: center;">الغرض</th>
					  <th style="text-align: center;">الحي</th>
					  <th style="text-align: center;">الموقع</th>
					  <th style="text-align: center;">القيمة</th>
					  <th style="text-align: right;">إجراءات</th>
					</tr> 
				  </thead>
				  <tbody>
					  <?php
						if(count($adList)>0){
						for ($i=0; $i <count($adList) ; $i++) { ?>
						   <tr>
							 <td style="text-align: center;"><?php echo $i+1;?></td>
							<td style="text-align: center;"><?php echo $adList[$i]->subject;?></td>
							   <td style="text-align: center;"><?php if($adList[$i]->purpose=='1'){ echo "تأجير";} else {echo "بيع ";} ?></td>
								  <td style="text-align: center;"><?php echo $adList[$i]->district;?></td>
							<td style="text-align: center;"><?php echo $adList[$i]->location;?></td>
							 <td style="text-align: center;"><?php echo $adList[$i]->amount;?></td>
						  <td style="text-align: center;">
							  <div class="row">
								<div class="col-2">
							            <a href="<?php echo base_url(AD_PANEL_URL.'adview').'/'.$adList[$i]->id;?>" title="View" style="color: #607d8b;"><i class="fa fa-eye"></i></a>
								</div>
								<!--<div class="col-2">-->
							 <!--           <a href="<?php echo base_url(AD_PANEL_URL.'editad').'/'.$adList[$i]->id;?>" style="color: #607d8b;"> <i class="fa fa-edit"></i></a>-->
								<!--</div>-->
								<!--<div class="col-2">-->
							 <!--          <a onClick="return confirm('هل انت متاكد من حذف البيانات ؟ ')" href="<?php echo base_url(AD_PANEL_URL.'addelete').'/'.$adList[$i]->id;?>" title="Delete" style="color: #607d8b;"><i class="fa fa-remove"></i> </a>-->
							 <!--    </div>	-->
							   
							 <a onClick="return confirm('هل ترغب بإعادة تفعيل الإعلان  ؟ ')" href="<?php echo base_url(AD_PANEL_URL.'activatead').'/'.$adList[$i]->id;?>" title="Archive" style="color: #607d8b;">   إعادة تفعيل </a>
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
			"aoColumns": [null,null,null,null,null,null,{ "bSortable": false }],
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