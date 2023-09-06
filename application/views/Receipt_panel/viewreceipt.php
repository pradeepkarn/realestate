<?php //print_r($receiptData); die(); ?>

<div class="container" style="margin-top: 50px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row" id="gradient">
                
               <h1> معلومات السند  </h1>
            </div>
            <div class="row">
                <div class="tabs_div">
                    <ul>
                        <li> سندات القبض  </li>
                        <li> الدفعات  </li>
                        <li>مستندات  </li>
                    </ul>
                    <div>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="success"> مستندات  : </td>
                                    <td><?php if(isset($receiptData[0]->id)) { echo $receiptData[0]->id; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> رقم العقد : </td>
                                    <td><?php if(isset($receiptData[0]->cid)) { echo $receiptData[0]->cid; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> المبلغ المدفوع : </td>المبلغ المدفوع 
                                    <td><?php if(isset($receiptData[0]->amt_received)) { echo $receiptData[0]->amt_received; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> التاريخ : </td>
                                    <td><?php if(isset($receiptData[0]->amt_received_date)) { 
                                    	$dat=date_create($receiptData[0]->amt_received_date);
                                    	echo date_format($dat,'Y-m-d') ; } ?></td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <table class="table">
                            <tbody>
                            	 <tr>
                                    <td class="success"> نوع \ رقم الدفعة : </td>
                                    <td><?php if(isset($receiptData[0]->installment_number)) { 
                                        echo ($receiptData[0]->installment_number);
                                        } ?></td>
                                </tr>
                                <tr>
                                    <td class="success">Installment Status </td>
                                    <td><?php if(isset($receiptData[0]->installment_status)) { echo $receiptData[0]->installment_status; } ?></td>
                                </tr>

                                 <tr>
                                    <td class="success"> عن الفترة من : </td> 
                                    <td><?php if(isset($receiptData[0]->installment_startdate)) { 
                                    	$sdat=date_create($receiptData[0]->installment_startdate);
                                    	echo date_format($sdat,'Y-m-d') ;  } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> إلى : </td>
                                    <td><?php if(isset($receiptData[0]->installment_enddate)) { 
                                    	$edat=date_create($receiptData[0]->installment_enddate);
                                    	echo date_format($edat,'Y-m-d') ;
                                    	 } ?></td>
                                </tr>
                                                               
                            </tbody>
                        </table>
                    </div>
                   


 					<div>
                        <table class="table">
                            <tbody>
                            	 <tr>
                                    <td class="success"> طريقة السداد : </td>
                                    <td><?php if(isset($receiptData[0]->payment_type)) { 
                                        echo ($receiptData[0]->payment_type);
                                        } ?></td>
                                </tr>
                                <?php if($receiptData[0]->payment_type!="Cash") { ?>
                                 <tr>
                                    <td class="success"> اسم البنك  : </td>
                                    <td><?php if(isset($receiptData[0]->bank_id)) { 
                                        echo ($receiptData[0]->bank_id);
                                        } ?></td>
                                </tr>
                            <?php  } ?>
                            	 <tr>
                                    <td class="success"> رقم السداد : </td>
                                    <td><?php if(isset($receiptData[0]->payment_doc_number)) { 
                                        echo ($receiptData[0]->payment_doc_number);
                                        } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> تاريخ السداد : </td>
                                    <td><?php if(isset($receiptData[0]->payment_doc_date)) { echo $receiptData[0]->payment_doc_date; } ?></td>
                                </tr>

                                 <tr>
                                    <td class="success">ID Copy: </td>
                                    <td> <a target="_blank" href="<?php if(isset($receiptData[0]->document_copy)) { ?> <?php echo base_url();?>img/document_copy/<?php echo $receiptData[0]->document_copy; } ?>" ><?php echo $receiptData[0]->document_copy;  ?></a> </td>
                                </tr>

                                 <tr>
                                    <td class="success"> الوصف  :</td>
                                    <td><?php if(isset($receiptData[0]->description)) { echo $receiptData[0]->description; } ?></td>
                                </tr>
                               


                                
                                <tr>
                                    <td class="success">  تم إنشاءه بواسطة  : </td>
                                    <td><?php if(isset($receiptData[0]->created_by)) { echo $receiptData[0]->created_by; } ?></td>
                                </tr>
                               
                                <tr>
                                    <td class="success"> تم إنشاءه بتاريخ  : </td>
                                    <td><?php if(isset($receiptData[0]->created_on)) { $c=date_create($receiptData[0]->created_on); echo date_format($c,'Y-m-d'); } ?></td>
                                </tr>
                               
                                <tr>
                                    <td class="success">  تم تحديثه بواسطة : </td>
                                    <td><?php if(isset($receiptData[0]->updated_by)) { echo $receiptData[0]->updated_by; } ?></td>
                                </tr>
                               
                                <tr>
                                    <td class="success">   تم تحديثه بتاريخ : </td>
                                    <td><?php if(isset($receiptData[0]->updated_on)) {  $u=date_create($receiptData[0]->updated_on);echo date_format($u,'Y-m-d'); } ?></td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>








                </div>
            </div>
            <div align="center">
                <button type="button" class="btn btn-primary" style="margin-top:10px;" onclick="history.back();">Back</button>
            </div>
        </div>
    </div>
</div>

<!-- you need to include the shieldui css and js assets in order for the charts to work -->
<link rel="stylesheet" type="text/css" href="https://www.shieldui.com/shared/components/latest/css/light-glow/all.min.css" />
<link rel="stylesheet" type="text/css" href="//www.shieldui.com/shared/components/latest/css/light-glow/all.min.css">
<script type="text/javascript" src="https://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>


<script type="text/javascript">
    jQuery(function ($) {
        $(".tabs_div").shieldTabs();
    });
</script>

<style>
    .pb-product-details-ul {
        list-style-type: none;
        padding-left: 0;
        color: black;
    }

        .pb-product-details-ul > li {
            padding-bottom: 5px;
            font-size: 15px;
        }

    #gradient {
        /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#feffff+0,ddf1f9+31,a0d8ef+62 */
        background: #feffff; /* Old browsers */
        background: -moz-linear-gradient(left, #feffff 0%, #ddf1f9 31%, #a0d8ef 62%); /* FF3.6-15 */
        background: -webkit-linear-gradient(left, #feffff 0%,#ddf1f9 31%,#a0d8ef 62%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(to right, #feffff 0%,#ddf1f9 31%,#a0d8ef 62%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#feffff', endColorstr='#a0d8ef',GradientType=1 ); /* IE6-9 */
        border: 1px solid #f2f2f2;
        padding: 20px;
    }

    #hits {
        border-right: 1px solid white;
        border-left: 1px solid white;
        vertical-align: middle;
        padding-top: 15px;
        font-size: 17px;
        color: white;
    }

    #fan {
        vertical-align: middle;
        padding-top: 15px;
        font-size: 17px;
        color: white;
    }

    .pb-product-details-fa > span {
        padding-top: 20px;
    }
</style>