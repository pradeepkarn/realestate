<?php //print_r($bankData); die(); ?>
<div class="container" style="margin-top: 50px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row" id="gradient">
                
               <h1> المعلومات البنكية  </h1>
            </div>
            <div class="row">
                <div class="tabs_div">
                    <ul>
                        <li> معلومات  </li>
                        
                    </ul>
                    <div>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="success">اسم البنك  : </td>
                                    <td><?php if(isset($bankData[0]->bank_name)) { echo $bankData[0]->bank_name; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> اسم المستفيد : </td>
                                    <td><?php if(isset($bankData[0]->beneficiary_name)) { echo $bankData[0]->beneficiary_name; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> رقم الحساب  : </td>
                                    <td><?php if(isset($bankData[0]->account_number)) { echo $bankData[0]->account_number; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success">  تم إنشاءه بواسطة  : </td>
                                    <td><?php if(isset($bankData[0]->created_by)) { echo $bankData[0]->created_by; } ?></td>
                                </tr>
                               
                                <tr>
                                    <td class="success"> تم إنشاءه بتاريخ  : </td>
                                    <td><?php if(isset($bankData[0]->created_on)) { $c=date_create($bankData[0]->created_on); echo date_format($c,'Y-m-d'); } ?></td>
                                </tr>
                               
                                <tr>
                                    <td class="success">  تم تحديثه بواسطة : </td>
                                    <td><?php if(isset($bankData[0]->updated_by)) { echo $bankData[0]->updated_by; } ?></td>
                                </tr>
                               
                                <tr>
                                    <td class="success">   تم تحديثه بتاريخ : </td>
                                    <td><?php if(isset($bankData[0]->updated_on)) {  $u=date_create($bankData[0]->updated_on);echo date_format($u,'Y-m-d'); } ?></td>
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