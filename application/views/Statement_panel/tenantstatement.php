<?php //print_r($data); echo "<Br><br><br>"; 
//print_r($maintenance);die(); ?>
<html>
<head>
    <title>Admin - Dashboard</title>
     <link rel="shortcut icon" href="<?php echo base_url();?>img/logo.png" type="image/x-icon">
     <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
    margin: 0;
    font-family: Roboto, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    font-size: .8125rem;
    font-weight: 400;
    line-height: 1.5385;
    color: #333;
    text-align: left;
    background-color: #eee
}

.mt-50 {
    margin-top: 50px
}

.mb-50 {
    margin-bottom: 50px
}

.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
    border-radius: .1875rem
}

.card-img-actions {
    position: relative
}

.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
    text-align: center
}

.card-title {
    margin-top: 10px;
    font-size: 17px
}

.invoice-color {
    color: red !important
}

.card-header {
    padding: .9375rem 1.25rem;
    margin-bottom: 0;
    background-color: rgba(0, 0, 0, .02);
    border-bottom: 1px solid rgba(0, 0, 0, .125)
}

a {
    text-decoration: none !important
}

.btn-light {
    color: #333;
    background-color: #fafafa;
    border-color: #ddd
}

.header-elements-inline {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap
}

@media (min-width: 768px) {
    .wmin-md-400 {
        min-width: 400px !important
    }
}

.btn-primary {
    color: #fff;
    background-color: #2196f3
}

.btn-labeled>b {
    position: absolute;
    top: -1px;
    background-color: blue;
    display: block;
    line-height: 1;
    padding: .62503rem
}

@media print {
  .hidden-print {
    display: none !important;

  }
}

    </style>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">

</head>
<body>

     <div class="hidden-print" style="text-align: center;padding: 10px;">
             <a href="<?php echo(base_url()); ?>Admin_controller/dashboard" class="btn btn-primary">اللوحة الرئيسية</a> &nbsp;&nbsp;&nbsp;
             <button onClick="window.print()" class="btn btn-primary"> طباعة </button>

     </div>

<div class="container d-flex justify-content-center mt-50 mb-50">
    <div class="row" style="margin-top: 80px;">
        <div class="col-md-12">
            <div class="card">
                <div class="h1" style="background-color: #f5f5f5; text-align: center;">
                    <h6 class="card-title">كشف حساب المستأجر
                  <!--  <div class="header-elements"> <button type="button" class="btn btn-light btn-sm"><i class="fa fa-file mr-2"></i> Save</button> <button type="button" class="btn btn-light btn-sm ml-3"><i class="fa fa-print mr-2"></i> Print</button> </div>-->
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-4 pull-left">
                                
                                <ul class="list list-unstyled mb-0 text-left">
                                    <li>ألوان الينابيع للعقارات</li>
                                    <li>مكتب ألوان الينابيع للعقارات  </li>
                                    <li>الرياض 11325 ص.ب 370001</li>
                                    <li>ت: 0114220325</li>
                                    <li>ج: 0500598800</li>
                                </ul></li>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-4 ">
                                <div class="text-sm-right">
                                   
                                    <ul class="list list-unstyled mb-0">
                                        <li>التاريخ: <span class="font-weight-semibold"><?php echo date('d-m-Y');?></span></li>
                                        <li><Br></li>
                                        <li><br></li>
                                       <li>تاريخ بداية العقد: <?php if(count($data)>0) { $sdate=date_create(($data[0]->contract_startdate)); $edate=date_create(($data[0]->contract_enddate)); echo date_format($sdate,'d-m-Y');  ?><span class="font-weight-semibold"></span></li>
                                       <li>    تاريخ نهاية العقد: <?php echo date_format($edate,'d-m-Y'); } ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-md-flex flex-md-wrap">
                        <div class="mb-4 mb-md-2 text-left"> <span class="text-muted">مفوترة بإسم</span>
                            <ul class="list list-unstyled mb-0">
                                <li>
                                    <h5 class="my-2"><?php if(count($data)>0) {echo($data[0]->tenant_firstname); ?></h5>
                                </li>
                                <li><span class="font-weight-semibold"><?php echo($data[0]->tenant_firstname); ?></span></li>
                                <li><?php echo($data[0]->mobile_number); ?></li>
                                <li><?php echo($data[0]->email); } ?></li>
                               </ul>
                        </div>
                        
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-lg" dir="rtl">
                        <thead>
                            <tr style="background-color: #f5f5f5;">
                                <th>تسلسل</th>
                                <th>رقم السند</th>
                                <th>التاريخ</th>
                                <th>طريقة السداد </th>
                                <th>الوصف</th>
                                <th>مدين</th>
                                <th>دائن</th>
                                <th> الرصيد (SAR)</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr>
                            <td colspan="4"></td>
        <td colspan="3">مجموع قيمة الإيجارات</td>
        <td ><?php if(count($data)>0) { echo($data[0]->total); $total=$data[0]->total; }?> </td>
    
    </tr>
    <?php if(count($data)>0){
          for ($i=0; $i <count($data) ; $i++) { ?>
    <tr>
        <td><?php echo $i+1; ?></td>    
        <td><?php echo($data[$i]->receiptid); ?></td>   
        <td><?php $date=date_create($data[$i]->amt_received_date); echo date_format($date,'d-m-Y'); ?></td>
        <td><?php echo($data[$i]->payment_type); ?></td>
        <td><?php echo($data[$i]->description); ?></td>
        <td><?php echo($data[$i]->amt_received); ?></td>
        <td></td>
        <td><?php //$bal=$data[$i]->current_balance; echo($data[$i]->current_balance);

        $total=$total-$data[$i]->amt_received;echo number_format($total,2); ?></td>
    </tr>
<?php } } ?>
        
        <?php /* if(count($maintenance)>0){
          for ($j=0; $j <count($maintenance) ; $j++) { ?>
    <tr>
        <td><?php  $i=$i+1; echo $i; ?></td>  
        <td><?php echo($maintenance[$j]->invoice_number); ?></td>  
        <td><?php $date=date_create($maintenance[$j]->date); echo date_format($date,'d-m-Y'); ?></td>
        <td>-</td>
        <td><?php echo($maintenance[$j]->description); ?></td>
        <td><?php echo($maintenance[$j]->total_amount); ?></td>       
        <td></td>
        <td><?php  $total=$total-$maintenance[$j]->total_amount;echo number_format($total,2); ?></td>
    </tr>
<?php } } */ ?>
        
        

                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <div class="d-md-flex flex-md-wrap" style="margin-right: 550px;">
                        <div class="pt-2 mb-3 wmin-md-400 ml-auto">
                           
                            <div class="table-responsive">
                                <table class="table" dir="rtl" style="width:75%;">
                                    <tbody>
                                      
                                       <tr>
                                            <th class="text-right">الرصيد المتبقي : <span class="font-weight-normal"></span></th>
                                            <td class="text-center"><?php if(count($data)>0) {
                                            echo "SAR.  ".  number_format($total,2); } ?></td>
                                        </tr>
                                       <!-- <tr>
                                            <th class="text-left">Total:</th>
                                            <td class="text-right text-primary">
                                                <h5 class="font-weight-semibold"><?php echo ($data[0]->total); ?></h5>
                                            </td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="width: 1000px;text-align: center;"> !!!شكرا لك لرعاية الممتلكات الخاصة بك 
</div>
            </div>
        </div>
    </div>
</div>

