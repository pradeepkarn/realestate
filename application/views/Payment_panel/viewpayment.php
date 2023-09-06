<?php //print_r($paymentData); die(); ?>
<div class="container" style="margin-top: 50px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row" id="gradient">
                
               <h1> عرض تفاصيل المالك  </h1>
            </div>
            <div class="row">
                <div class="tabs_div">
                    <ul>
                        <li>شخصي  </li>
                        <li>  مستندات  </li>
                    </ul>
                    <div>
                        <table class="table">
                            <tbody>
                                 <tr>
                                    <td class="success"> اسم العقار : </td>
                                    <td><?php if(isset($paymentData[0]->building_name)) { echo $paymentData[0]->building_name; } ?></td>
                                </tr>

                                 <tr>
                                    <td class="success">  رقم الوحدة : </td>
                                    <td>

                                         <?php if(substr($paymentData[0]->unit_id,0,1)=="R") {
                                          $id=str_replace("R", " سكني  ", $paymentData[0]->unit_id);
                                        } 

                                       elseif(substr($paymentData[0]->unit_id,0,1)=="C") {
                                          $id=str_replace("C", " تجاري   ", $paymentData[0]->unit_id);
                                        } 
                                        else
                                        {
                                          $id=$paymentData[0]->unit_id;
                                        }
                                        ?>

                                        <?php if(isset($paymentData[0]->unit_id)) { echo $id; } ?></td>
                                </tr>


                                <tr>
                                    <td class="success"> نوع \ رقم الدفعة : </td>
                                    <td><?php if(isset($paymentData[0]->installment_number)) { echo $paymentData[0]->installment_number; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> مبلغ و قدره : </td>
                                    <td><?php if(isset($paymentData[0]->payment_amount)) { echo $paymentData[0]->payment_amount; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> دفعت بتاريخ : </td>
                                    <td><?php if(isset($paymentData[0]->payment_date)) { echo $paymentData[0]->payment_date; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> من تاريخ : </td>
                                    <td><?php if(isset($paymentData[0]->payment_startdate)) { 
                                        $s=date_create($paymentData[0]->payment_startdate);
                                        echo date_format($s,'Y-m-d'); } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> الى تاريخ : </td>
                                    <td><?php if(isset($paymentData[0]->payment_enddate)) { 
                                        $e=date_create($paymentData[0]->payment_enddate);
                                        echo date_format($e,'Y-m-d'); } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> طريقة السداد : </td>
                                    <td><?php if(isset($paymentData[0]->payment_type)) { echo $paymentData[0]->payment_type; } ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="success"> رفع نسخة من الهوية : </td>
                                    <td><?php if(isset($paymentData[0]->document_copy)) { ?> <a href="<?php echo base_url();?>img/payment_document_copy/<?php echo $paymentData[0]->document_copy; } ?>" target="_blank"><?php echo $paymentData[0]->document_copy;  ?></a> </td>
                                </tr>
                               <tr>
                                    <td class="success"> الوصف  : </td>
                                    <td><?php if(isset($paymentData[0]->description)) { echo $paymentData[0]->description; } ?></td>
                                </tr>
                                
                                <tr>
                                    <td class="success">  تم إنشاءه بواسطة  : </td>
                                    <td><?php if(isset($paymentData[0]->created_by)) { echo $paymentData[0]->created_by; } ?></td>
                                </tr>
                               
                                <tr>
                                    <td class="success"> تم إنشاءه بتاريخ  : </td>
                                    <td><?php if(isset($paymentData[0]->created_on)) { $c=date_create($paymentData[0]->created_on); echo date_format($c,'Y-m-d'); } ?></td>
                                </tr>
                               
                                <tr>
                                    <td class="success">  تم تحديثه بواسطة : </td>
                                    <td><?php if(isset($paymentData[0]->updated_by)) { echo $paymentData[0]->updated_by; } ?></td>
                                </tr>
                               
                                <tr>
                                    <td class="success">   تم تحديثه بتاريخ : </td>
                                    <td><?php if(isset($paymentData[0]->updated_on)) {  $u=date_create($paymentData[0]->updated_on);echo date_format($u,'Y-m-d'); } ?></td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                   
                </div>
            </div>
            <div align="center">
                <button type="button" class="btn btn-primary" style="margin-top:10px;" onclick="history.back();"> الخلف  </button>
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