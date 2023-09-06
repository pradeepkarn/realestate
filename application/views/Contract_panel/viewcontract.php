<?php //print_r($contractData); //die();?>

<div class="container" style="margin-top: 50px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row" id="gradient">
                
               <h1> معلومات العقد  </h1>
            </div>
            <div class="row">
                <div class="tabs_div">
                    <ul>
                        <li>شخصي  </li>
                        <li>  معلومات العقد </li>
                        <li>  معلومات العقد </li>
                    </ul>
                    <div>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="success"> اسم العقار : </td>
                                    <td><?php if(isset($contractData[0]->building_name)) { echo $contractData[0]->building_name; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> رقم الوحدة : </td>
                                    <td><?php if(isset($contractData[0]->unit_id)) { 

                                          if(substr($contractData[0]->unit_id,0,1)=="R") {
                                          $id=str_replace("R", " سكني  ", $contractData[0]->unit_id);
                                        } 

                                        elseif(substr($contractData[0]->unit_id,0,1)=="C") {
                                          $id=str_replace("C", " تجاري   ", $contractData[0]->unit_id);
                                        } 
                                        else
                                        {
                                            $id=$contractData[0]->unit_id;
                                        }
                                        echo $id; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> اسم المستأجر : </td>
                                    <td><?php if(isset($contractData[0]->tenant_firstname)) { echo $contractData[0]->tenant_firstname; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> رقم العقد : </td>
                                    <td><?php if(isset($contractData[0]->contract_number)) { echo $contractData[0]->contract_number; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> مدة العقد : </td>
                                    <td><?php if(isset($contractData[0]->contract_period)) { echo $contractData[0]->contract_period; } ?></td>
                                </tr>
                                 <tr>
                                    <td class="success"> من تاريخ : </td>
                                    <td><?php if(isset($contractData[0]->contract_startdate)) { $s=date_create($contractData[0]->contract_startdate);
                                    echo date_format($s,'Y-m-d'); } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> الى تاريخ : </td>
                                    <td><?php if(isset($contractData[0]->contract_enddate)) { 
                                        $end= date_create($contractData[0]->contract_enddate);
                                        echo date_format($end,'Y-m-d'); } ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <table class="table">
                            <tbody>
                              
                                 <tr>
                                    <td class="success"> عدد الدفعات  : </td>
                                    <td><?php if(isset($contractData[0]->no_of_installments)) { echo $contractData[0]->no_of_installments; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> قيمة الإيجار : </td>
                                    <td><?php if(isset($contractData[0]->rent_amount)) { echo $contractData[0]->rent_amount; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success">  رسوم الماء : </td>
                                    <td><?php if(isset($contractData[0]->water_fees)) { echo $contractData[0]->water_fees; } ?></td>
                                </tr>
                                 <tr>
                                    <td class="success"> رسوم الكهرباء : </td>
                                    <td><?php if(isset($contractData[0]->electricity_fees)) { echo $contractData[0]->electricity_fees; } ?></td>
                                </tr>
                                 <tr>
                                    <td class="success"> رسوم أخرى : </td>
                                    <td><?php if(isset($contractData[0]->other_fees)) { echo $contractData[0]->other_fees; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> المجموع : </td>
                                    <td><?php if(isset($contractData[0]->total)) { echo $contractData[0]->total; } ?></td>
                                </tr>
                                </tbody>
                        </table>
                    </div>

                     <div>
                        <table class="table">
                            <tbody>
                               
                                 <tr>
                                    <td class="success"> المبلغ المدفوع : </td>
                                    <td><?php if(isset($contractData[0]->amount_received)) { echo $contractData[0]->amount_received; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> الرصيد المتبقي : </td>
                                    <td><?php if(isset($contractData[0]->balance_amount)) { echo $contractData[0]->balance_amount; } ?></td>
                                </tr>
                                 <tr>
                                    <td class="success"> قيمة التأمين : </td>
                                    <td><?php if(isset($contractData[0]->insurance_fees)) { echo $contractData[0]->insurance_fees; } ?></td>
                                </tr>
                                 <tr>
                                    <td class="success"> قيمة السعي : </td>
                                    <td><?php if(isset($contractData[0]->brokerage_fees)) { echo $contractData[0]->brokerage_fees; } ?></td>
                                </tr>
                                 <tr>
                                    <td class="success"> نسبة إدارة الأملاك  : </td>
                                    <td><?php if(isset($contractData[0]->brokerage_percentage)) { echo $contractData[0]->brokerage_percentage; } ?></td>
                                </tr>
                                 <tr>
                                    <td class="success"> معلومات العقد : </td>
                                    <td><?php if(isset($contractData[0]->contract_status)) { echo $contractData[0]->contract_status; } ?></td>
                                </tr>


                                <tr>
                                    <td class="success">  تم إنشاءه بواسطة  : </td>
                                    <td><?php if(isset($contractData[0]->created_by)) { echo $contractData[0]->created_by; } ?></td>
                                </tr>
                               
                                <tr>
                                    <td class="success"> تم إنشاءه بتاريخ  : </td>
                                    <td><?php if(isset($contractData[0]->created_on)) { $c=date_create($contractData[0]->created_on); echo date_format($c,'Y-m-d'); } ?></td>
                                </tr>
                               
                                <tr>
                                    <td class="success">  تم تحديثه بواسطة : </td>
                                    <td><?php if(isset($contractData[0]->updated_by)) { echo $contractData[0]->updated_by; } ?></td>
                                </tr>
                               
                                <tr>
                                    <td class="success">   تم تحديثه بتاريخ : </td>
                                    <td><?php if(isset($contractData[0]->updated_on)) {  $u=date_create($contractData[0]->updated_on);echo date_format($u,'Y-m-d'); } ?></td>
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