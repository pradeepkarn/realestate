<?php //print_r($insurancepayement); die();//echo "<Br><br><br>"; //print_r($maintenance);die(); ?>
<html>
<head>
     <title> Admin - Dashboard  </title>
     
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
             <a href="<?php echo(base_url()); ?>Admin_controller/dashboard" class="btn btn-primary">اللوحة الرئيسية </a> &nbsp;&nbsp;&nbsp;
             <button onClick="window.print()" class="btn btn-primary"> طباعة </button>

     
     <div class="container">
        
    <?php
 $fcl=array('class'=>'cf','id'=>'form');
  echo form_open_multipart('Statement_controller/revenuestatementinfo',$fcl);
?>
        <div >

             <label> الى تاريخ  : </label>
             <input type="date" id="enddate" name="enddate" style="width: 20%;margin-top: 20px;"
              value="<?php if(isset($end)){ echo $end; } ?>"> 
              
           <label> من تاريخ : </label>
             <input type="date" id="startdate" name="startdate" style="width: 20%;margin-top: 20px;margin-left: 20px;" 
             value="<?php if(isset($start)){ echo $start; } ?>">           
       
                    
        </div>
        
                 
      <input type="submit" name="submitbtn" id="submitbtn" tabindex="2" class="btn btn-primary"  value="كشف حساب العقار " style="margin-top: 20px;">
      <input type="reset" name="reset" id="resetbtn" tabindex="3" class="btn btn-primary" value="مسح " style="margin-top: 20px;">
   

</div>
<div class="container d-flex justify-content-center mt-50 mb-50">
    <div class="row" style="margin-top: 50px;">
        <div class="col-md-12">
            <div class="card">
                <div class="h1" style="background-color: #b3d7ff; text-align: center;">
                    <h6 class="card-title">كشف حساب الدخل
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
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="table-responsive">
                    <table class="table table-lg" dir="rtl" >
                        <thead>
                            <tr style="background-color: #b3d7ff;">
                                <th>تسلسل</th>                                
                                <th>اسم العقار</th>
                                
                                <th style="width:7%">رقم الوحدة</th>
                                <th style="width:10%">رقم السند</th>
                                <th style="width:10%">التاريخ</th>
                                <th>الوصف</th>
                                <th>مدين</th>
                                <th>دائن</th>
                                <th>الرصيد (SAR)</th>
                            </tr>
                             <tr><td></td><td colspan="7"> الرصيد الافتتاحي  </td><td align="right" style="margin-left: 20px;"><?php echo number_format($previousbalance[0]->previousbalance,2); ?> </td></tr>  
                        </thead>
                         <tbody>
            
                           
    <?php 

     $startdat=date_create($start);
  $enddat=date_create($end);

$total=($previousbalance[0]->previousbalance); $j=0;

     while(date_format($startdat,'Y-m-d')<=date_format($enddat,'Y-m-d'))
{
  
   
   
    if(count($data)>0){
          for ($i=0; $i <count($data) ; $i++) { 
             $ss=date_create($data[$i]->amt_received_date);

        if(date_format($ss,'Y-m-d')==date_format($startdat,'Y-m-d')){ ?>
    <tr>
        <td><?php $j=$j+1; echo $j; ?></td>    
        <td><?php echo($data[$i]->building_name); ?></td>

        <?php if(substr($data[$i]->unit_id,0,1)=="R") {
                                          $id=str_replace("R", " سكني  ", $data[$i]->unit_id);
                                        } 

                                        if(substr($data[$i]->unit_id,0,1)=="C") {
                                          $id=str_replace("C", " تجاري   ", $data[$i]->unit_id);
                                        } 
     ?>


         <td><?php echo($id); ?></td>
        <td><?php echo($data[$i]->receiptid); ?></td>   
        <td><?php $date=date_create($data[$i]->amt_received_date); echo date_format($date,'d-m-Y'); ?></td>
        <td><?php echo($data[$i]->description); ?></td>
        <td></td>
        <td><?php if($data[$i]->installment_number=="") { $amt= ($data[$i]->amt_received); 

            echo $amt; }else {
            $amt=(($data[$i]->amt_received)*(($data[$i]->brokerage_percentage)/100)); echo number_format($amt,2);} ?></td>        
        <td><?php //$bal=$data[$i]->current_balance; echo($data[$i]->current_balance);

        $total=$total+$amt;echo number_format($total,2); ?></td>
    </tr>
<?php } } }

if(count($insurancepayement)>0){
          for ($i=0; $i <count($insurancepayement) ; $i++) { 
         $ss=date_create($insurancepayement[$i]->payment_date);
        if(date_format($ss,'Y-m-d')==date_format($startdat,'Y-m-d')){

        echo"<tr><td>";$j=$j+1; echo $j; echo "</td>";?>
        <td><?php echo($insurancepayement[$i]->building_name); ?></td>
        <?php echo"<td></td><td> Payments : ";echo $insurancepayement[$i]->ID; 
         echo "<td>".substr($insurancepayement[$i]->payment_date,0,10)."</td>";
         echo "<td>".$insurancepayement[$i]->description."</td>";    
         echo"<td></td>";     
          echo "<td>".$insurancepayement[$i]->payment_amount."</td>";
          
          $total=($total+$insurancepayement[$i]->payment_amount);
          echo "<td>".number_format($total,2)."</td>";
        echo"</tr>";
    }

       
} }

if(count($fixedbrokerage)>0){

          for ($i=0; $i <count($fixedbrokerage) ; $i++) { 
          $sdat=date_create($fixedbrokerage[$i]->contract_startdate);     

        if(date_format($sdat,'Y-m-d')==date_format($startdat,'Y-m-d')){

        echo"<tr><td>";$j=$j+1; echo $j; echo "</td>";?>
        <td><?php echo($fixedbrokerage[$i]->building_name); ?></td>

        <?php if(substr($fixedbrokerage[$i]->unit_id,0,1)=="R") {
                                          $id=str_replace("R", " سكني  ", $fixedbrokerage[$i]->unit_id);
                                        } 

                                        if(substr($fixedbrokerage[$i]->unit_id,0,1)=="C") {
                                          $id=str_replace("C", " تجاري   ", $fixedbrokerage[$i]->unit_id);
                                        } 
     ?>
<td><?php echo $id; ?></td>
        <?php  echo"<td> عقد رقم : ";echo $fixedbrokerage[$i]->contract_number; 
         echo "</td><td>".(date_format($sdat,'d-m-Y'))."</td>";
        // echo "<td>".$fixedbrokerage[$i]->description."</td>";    
         echo "<td>  رسوم إدارة الأملاك (مبلغ ثابت)  </td>";    
         echo"<td></td>";     
          echo "<td>".$fixedbrokerage[$i]->fixed_brokerage_amount."</td>";
          
          $total=($total+$fixedbrokerage[$i]->fixed_brokerage_amount);
          echo "<td>".number_format($total,2)."</td>";
        echo"</tr>";
    }

       
} }


 if(count($expenses)>0){
          for ($i=0; $i <count($expenses) ; $i++) { 
         $ss=date_create($expenses[$i]->date);
        if(date_format($ss,'Y-m-d')==date_format($startdat,'Y-m-d')){

        echo"<tr><td>";$j=$j+1; echo $j; echo "</td><td></td><td></td><td> Expenses : ";echo $expenses[$i]->invoice_number; 
         echo "<td>".substr($expenses[$i]->date,0,10)."</td>";
         echo "<td>".$expenses[$i]->description."</td>";         
          echo "<td>".$expenses[$i]->total_amount."</td>";
          echo"<td></td>";
          $total=($total-$expenses[$i]->total_amount);
          echo "<td>".number_format($total,2)."</td>";
        echo"</tr>";
    }

       
} }



 date_add($startdat,date_interval_create_from_date_string("1 days"));
}
?>                      

  </tbody>
                    </table>
                </div>
                 <div class="card-body">
                    <div class="d-md-flex flex-md-wrap" style="margin-right: 650px;">
                        <div class="pt-2 mb-3 wmin-md-400 ml-auto">
                           
                            <div class="table-responsive">
                                <table class="table" dir="rtl" style="width:75%;margin-left: -8px;">
                                    <tbody>
                                      
                                       <tr>
                                            <th class="text-left">مجموع الإيرادات : <span class="font-weight-normal"></span></th>
                                            <td class="text-left"><?php 
                                            echo "SAR.". number_format($total,2);?></td>
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
                <div class="card-footer" style="width: 1100px;text-align: center; background-color: #b3d7ff;">  </div>
            </div>
        </div>
    </div>
</div>

