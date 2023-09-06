<?php //print_r($adData); die(); ?>
<div class="container" style="margin-top: 50px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row" id="gradient">
                
               <h1> View Advertisement</h1>
            </div>
            <div class="row">
                <div class="tabs_div">
                    <ul>
                        <li> معلومات  </li>
                        <li>  معلومات العقد </li>
                    </ul>
                    <div>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="success"> عنوان الإعلان </td>
                                    <td><?php if(isset($adData[0]->subject)) { echo $adData[0]->subject; } ?></td>
                                </tr>
                                 <tr>
                                    <td class="success">  غرض    </td>
                                    <td><?php if(isset($adData[0]->purpose)) {  if($adData[0]->purpose=='1'){ echo "تأجير";} else {echo "بيع ";}  } ?></td>
                                </tr>
                                
                                <tr>
                                    <td class="success"> القيمة </td>
                                    <td><?php if(isset($adData[0]->amount)) { echo $adData[0]->amount; } ?></td>
                                </tr> 
                                <tr>
                                    <td class="success"> المدينة </td>
                                    <td><?php if(isset($adData[0]->city)) { echo $adData[0]->city; } ?></td>
                                </tr>
                                 <tr>
                                    <td class="success"> المدينة </td>
                                    <td><?php if(isset($adData[0]->district)) { echo $adData[0]->district; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> الموقع </td>
                                    <td><?php if(isset($adData[0]->location)) { echo $adData[0]->location; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success">  نوع العقار </td>
                                    <td><?php if(isset($adData[0]->propertyType)) { echo $adData[0]->propertyType; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> عمر العقار  </td>
                                    <td><?php if(isset($adData[0]->propertyAge)) { echo $adData[0]->propertyAge; } ?></td>
                                </tr>
                               <tr>
                                    <td class="success"> مساحة العقار </td>
                                    <td><?php if(isset($adData[0]->propertyAreaSize)) { echo $adData[0]->propertyAreaSize; } ?></td>
                                </tr>
                              
                               
                            </tbody>
                        </table>
                    </div>
                   

                     <div>
                        <table class="table">
                            <tbody>
                              
                                 <tr>
                                    <td class="success">  عدد الأدوار </td>
                                    <td><?php if(isset($adData[0]->floorNo)) { echo $adData[0]->floorNo; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success"> عدد الغرف </td>
                                    <td><?php if(isset($adData[0]->roomNo)) { echo $adData[0]->roomNo; } ?></td>
                                </tr>
                                <tr>
                                    <td class="success">  عدد دورات المياه </td>
                                    <td><?php if(isset($adData[0]->bathroomNo)) { echo $adData[0]->bathroomNo; } ?></td>
                                </tr>
                                 <tr>
                                    <td class="success">  مؤثث: نعم/لا </td>
                                    <td><?php if(isset($adData[0]->furnitureAvailability)) { echo $adData[0]->furnitureAvailability; } ?></td>
                                </tr>
                                 <tr>
                                    <td class="success"> طريقة الدفعات </td>
                                    <td><?php if(isset($adData[0]->paymentMethod)) { echo $adData[0]->paymentMethod; } ?></td>
                                </tr>
                                
                                  <tr>
                                    <td class="success"> التفاصيل </td>
                                    <td><?php if(isset($adData[0]->details)) { echo $adData[0]->details; } ?></td>
                                </tr>
                                
                                <tr>
                                    <td class="success"> إظهار في الموقع </td>
                                    <td><?php if(isset($adData[0]->showWebsite)) { if($adData[0]->showWebsite=='1') {echo "Yes";} else {echo"No";} } ?></td>
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