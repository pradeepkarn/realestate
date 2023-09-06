<!doctype html>
<html>
    <head>
      <meta charset="utf-8">
      <title> الفاتورة </title>
      <!--  <link rel="stylesheet" href="style.css">-->
      <!--  <link rel="license" href="https://www.opensource.org/licenses/mit-license/">-->
      <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
	  <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
      <script src="script.js"></script>
      <style>
        /* reset */
		*
		{
			border: 0;
			box-sizing: content-box;
			color: inherit;
			font-family: 'Cairo';
			font-size: inherit;
			font-style: inherit;
			font-weight: inherit;
			line-height: inherit;
			list-style: none;
			margin: 0;
			padding: 0;
			text-decoration: none;
			vertical-align: top;
		}

		/* content editable */

		/* heading */
		h1 { font: bold 100% 'Cairo', sans-serif; /*letter-spacing: 0.5em;*/ text-align: center; text-transform: uppercase; }

		/* table */
		table { font-size: 75%; table-layout: fixed; width: 100%; }
		table { border-collapse: separate; border-spacing: 2px; }
		th, td { border-width: 1px; padding: 0.9em; position: relative; text-align: right; font-weight: bold;}
		th, td { /* border-radius: 0.25em; border-style: solid; */ }
		th { background: #EEE; border-color: #BBB; }
		td { border-color: #DDD; }

		/* page */
		html { font: 17px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
		html { background: #999; cursor: default; }

		body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
		body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

		/* header */

		header { margin: 0 0 0em; }
		header:after { clear: both; content: ""; display: table; }

		header h1 { background: #f6f7f8; border-radius: 0.25em; color: #000; margin: 0 0 1em; padding: 0.5em 0; }
		header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
		header address p { margin: 0 0 0.25em; }
		header span, header img { display: block; float: right; }
		header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
		header img { max-height: 100%; max-width: 100%; }
		header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

		/* article */

		article, article address, table.meta, table.inventory { margin: 0 0 1em; padding-right: 40px; margin-bottom: 0px; }
		article:after { clear: both; content: ""; display: table; }
		article h1 { clip: rect(0 0 0 0); position: absolute; }

		article address { float: left; font-size: 125%; font-weight: bold; }

		/* table meta & balance */

		table.meta, table.balance { float: right; width: 36%; padding-right: 40px;}
		table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

		/* table meta */

		table.meta th { width: 40%; }
		table.meta td { width: 60%; }

		/* table items */

		table.inventory { clear: both; width: 100%; }
		table.inventory th { /*font-weight: bold;*/ text-align: center; }

		table.inventory td:nth-child(1) { width: 20%; font-weight: bold; }
		table.inventory td:nth-child(2) { /*width: 38%;*/ }
		table.inventory td:nth-child(3) { text-align: right; width: 12%; }
		table.inventory td:nth-child(4) { text-align: right; width: 12%; }
		table.inventory td:nth-child(5) { text-align: right; width: 12%; }
		
		table.inventory1 tr:nth-child(even) {background: #f8f8f8}
		
		/* table balance */

		table.balance th, table.balance td { width: 50%; }
		table.balance td { text-align: right; }

		/* aside */

		aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
		aside h1 { border-color: #999; border-bottom-style: solid; }

		/* javascript */
		.tab { 
			   display:inline-block; 
			   margin-left: 450px; 
		}
		.add, .cut
		{
			border-width: 1px;
			display: block;
			font-size: .8rem;
			padding: 0.25em 0.5em;  
			float: left;
			text-align: center;
			width: 0.6em;
		}

		.add, .cut
		{
			background: #9AF;
			box-shadow: 0 1px 2px rgba(0,0,0,0.2);
			background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
			background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
			border-radius: 0.5em;
			border-color: #0076A3;

			color: #FFF;
			cursor: pointer;
			font-weight: bold;
			text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
		}

		.add { margin: -2.5em 0 0; }

		.add:hover { background: #00ADEE; }

		.cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
		.cut { -webkit-transition: opacity 100ms ease-in; }

		tr:hover .cut { opacity: 1; }

		@media print {
			* { -webkit-print-color-adjust: exact; }
			html { background: none; padding: 0; }
			body { box-shadow: none; margin: 0; }
			span:empty { display: none; }
			.add, .cut { display: none; }
		}

		@page { margin: 0; }


		@media print {
		  .hidden-print {
			display: none !important;

		  }
		}
     </style>
    </head>
    <body>
      <div class="hidden-print" style="text-align: center;padding: 5px;margin-top: -35px;">
        <a href="<?php echo(base_url()); ?>Admin_controller/dashboard" class="btn btn-primary">اللوحة الرئيسية</a> &nbsp;&nbsp;&nbsp;
        <button onClick="window.print()" class="btn btn-primary"> طباعة  </button>
      </div>

      
	  <div class="container">
        <header>
            <h1>سند قبض</h1>
        </header>
        <article>
		  <table style="border: 0px;margin-top: 10px;margin-bottom: 15px; padding-right: 40px;" >
			<tr>
			  <td style="border-right:0px; text-align: left;border:0px;"><img src="<?php echo base_url();?>img/logo.png" style="height:150px"></td>
			  <td  style="text-align: right;border-left:0px;padding:5px;border:0px;">
				<br><br>مكتب ألوان الينابيع للعقارات
				<br><br>الرياض 11325 ص.ب 370001
				<br><br>هاتف: 0114220325
				<br><br>جوال: 0500598800</td>       
			</tr>
		  </table>
        <!--</address>-->
            <table class="meta" dir="rtl">
                <tr>
                    <th><label>رقم السند</label></th>
                    <td><label><?php echo $receiptList[0]->receiptid;?></label></td>
                </tr>
                <tr>
                    <th><label>التاريخ</label></th>
                    <td><label><?php echo Date('d-m-Y'); ?></label></td>
                </tr>
            </table>
            <table class="inventory inventory1" dir="rtl" style="border: 1px #f8f8f8 solid;">
                   <tr>
    
            <td >نوع \ رقم الدفعة :</b></td>
        <td><?php echo $receiptList[0]->installment_number;?></td>
       </tr>

    
    <tr>
            <td >رقم العقد : </td>
            <td><?php echo $receiptList[0]->contract_number;?></td>
        </tr>
    
    <tr>
                <td >اسم المستأجر : </td>
                <td><?php echo $receiptList[0]->tenant_firstname;?>
                    
                    <?php echo "  ".$receiptList[0]->tenant_lastname;?>
                </td>
     </tr>

    <tr>
        <td >اسم المالك : </td>
        <td><?php echo $receiptList[0]->owner_firstname;?>
              <?php echo "  ".$receiptList[0]->owner_lastname;?>
                </td>

           </tr>

   <tr>
        <td >اسم العقار : </td>
        <td><?php echo $receiptList[0]->building_name;?></td>       
   </tr>

   <tr>
   
        
    <td>مبلغ الدفعة : </td>
    <td><?php echo $receiptList[0]->amt_received;?></td>
   </tr>

    <tr>
        <td>تفاصيل الدفعة : </td>
        <td><?php if($receiptList[0]->payment_type=="Cash")
        {
            echo "نقدا ";
        }
        else if($receiptList[0]->payment_type=="Card")
        {
            echo "بطاقة ";
        }
         else if($receiptList[0]->payment_type=="Cheque")
        {
            echo " شيك ";
        }

         else if($receiptList[0]->payment_type=="Transfer")
        {
            echo " تحويل  ";
        }


        ?></td>    
   </tr>
   

 <tr>
            <td>التفاصيل :</td>
        <td><?php echo $receiptList[0]->description;
            echo " من : ".substr($receiptList[0]->installment_startdate,0,10);
            echo " الى : ".substr($receiptList[0]->installment_enddate,0,10);
            ?></td>
   
   </tr>

 <tr>
        <td>  و المبلغ المتبقي من الإيجار هو : </td>
        <td><?php echo $receiptList[0]->current_balance;?></td>
    
   </tr>
            </table>
        </article>
        <table class="inventory" style="padding-right: 80px; margin-top: 10px; border:0px;border-color: #fff;">
                <tr><td style="border:0px;text-align: center;">
            <p style="margin-left: 0px;text-align: center;"> توقيع المحاسب  </p></td>
                <td style="border:0px;"> توقيع مالك العقار   </td></tr>
                <tr><td style="border:0px;">     
            <?php if($this->session->userdata('user_sign'))  { ?>         
            <img src="<?php echo base_url();?>img/<?php    echo $this->session->userdata('user_sign'); ?> " height="80" width="160" style="margin-right: 780px;"> </td>
        <?php } ?> 
    </tr>
    </table>
        
</div>
</body>
</html>
