<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Receipt_model extends CI_Model{

	var $tableName="tbl_receipt";

function __construct() {
		parent::__construct();
		$this->load->database(); 

	}

function getReceiptData($id) {
$this->db->select("*,tbl_receipt.id as receiptid");
$this->db->from($this->tableName);
$this->db->where('tbl_receipt.id',$id);
$this->db->where('tbl_receipt.status','Active');
$this->db->join('tbl_contract','tbl_contract.id=tbl_receipt.contract_id');
$this->db->join('tbl_building','tbl_contract.building_id=tbl_building.id');
$this->db->join('tbl_units','tbl_contract.unit_id=tbl_units.id');
$this->db->join('tbl_tenants','tbl_contract.tenant_id=tbl_tenants.id');
$this->db->join('tbl_owner','tbl_owner.id=tbl_building.owner_id');
$data=$this->db->get()->result();
return $data;
}

function getinstallmentData($id) {

$this->db->select("sum(b.amt_received)as totalinstallmentpaidamt,max(b.id)as maxid");
$this->db->from('tbl_receipt as a');
$this->db->join('tbl_receipt as b','a.installment_number=b.installment_number');
//$this->db->join('tbl_contract','a.contract_id=tbl_contract.id');
$this->db->where('a.contract_id=b.contract_id');
$this->db->where('a.id',$id);
$data=$this->db->get()->result();
return $data;
}


	function fetch_owner($building_id)
{
	

$this->db->where('tbl_building.id',$building_id);
$this->db->where('tbl_building.status','Active');
$this->db->join('tbl_owner','tbl_owner.id=tbl_building.owner_id');
$query=$this->db->get('tbl_building');
//$output='<option value="">Owner</option>';
foreach($query->result() as $row)
{
	//$output .= '<option value="'.$row->owner_id.'">'.$row->owner_id.'</option>';
	$output = $row->owner_firstname;
	$output .= "//";
	$output .= $row->owner_id;

}	
return $output;

}



function fetch_tenants($building_id)
{
	

$this->db->where('tbl_contract.building_id',$building_id);
$this->db->where('tbl_contract.status','Active');
$this->db->join('tbl_tenants','tbl_tenants.id=tbl_contract.tenant_id');
$query=$this->db->get('tbl_contract');
$output='<option value="">Select Tenant</option>';
foreach($query->result() as $row)
{
	$output .= '<option value="'.$row->unit_id.'">'.$row->tenant_firstname.'</option>';
	

}	
return $output;

}



function fetch_suspendtenants($building_id)
{
	

$this->db->where('tbl_contract.building_id',$building_id);
$this->db->where('tbl_contract.status','Inactive');
$this->db->where('tbl_contract.contract_status','Suspended');
$this->db->join('tbl_tenants','tbl_tenants.id=tbl_contract.tenant_id');
$query=$this->db->get('tbl_contract');
$output='<option value="">Select Tenant</option>';
foreach($query->result() as $row)
{
	$output .= '<option value="'.$row->unit_id.'">'.$row->tenant_firstname.'</option>';
	

}	
return $output;

}



function fetch_unitcontarct($unit_id,$building_id)
{

$this->db->where('tbl_contract.unit_id',$unit_id);
$this->db->where('tbl_contract.building_id',$building_id);
$this->db->where('tbl_contract.status','Active');
//$this->db->join('tbl_units','tbl_contract.unit_id=tbl_units.id');
$query=$this->db->get('tbl_contract');
foreach($query->result() as $row)
{
	/*$this->db->select("tbl_receipt.installment_number as installment,installment_status,amt_received");	
	$this->db->where('tbl_receipt.contract_id',$row->id);
	$this->db->where('tbl_receipt.status','Active');
	$this->db->order_by('tbl_receipt.created_on',"desc");
	$this->db->limit(1);
	//$query1=$this->db->get('tbl_receipt');

$row = $this->db->get('tbl_receipt')->row_array();
echo $row['installment']; // 42
echo $row['installment_status']; 
echo $row['amt_received']; 
die(); */

$this->db->select("tbl_receipt.installment_number as installmentnumber,max(installment_status)as installmentstatus,sum(amt_received) as amount");	
	$this->db->where('tbl_receipt.contract_id',$row->id);
	$this->db->where('tbl_receipt.status','Active');
	$this->db->group_by('tbl_receipt.installment_number');
	$query1=$this->db->get('tbl_receipt');
if ($query1->num_rows() > 0)
{
	foreach($query1->result() as $row1)

{
	if($row1->installmentnumber!="")
	{
	if($row1->installmentstatus=="0")
	{
	$installmentnumber=$row1->installmentnumber;
	$installmentstatus=$row1->installmentstatus;
	$amtreceived=$row1->amount;
	$j=$installmentnumber;
	$amount=($row->total/$row->no_of_installments)-$amtreceived;
	
	}
	if($row1->installmentstatus=="1")
	{
		$installmentnumber=$row1->installmentnumber;
		$j=$installmentnumber+1;
		$amount=($row->total/$row->no_of_installments);
	}
}
else if($row1->installmentnumber==""){
	$amount=($row->total/$row->no_of_installments);
	$j=1;
}
}

}
else
{
	$amount=($row->total/$row->no_of_installments);
	$j=1;
}


	
	$this->db->select("*");	
	$this->db->from($this->tableName);
	$this->db->where('tbl_receipt.contract_id',$row->id);
	$this->db->join('tbl_contract','tbl_contract.id=tbl_receipt.contract_id');
	$this->db->where('tbl_receipt.status','Active');
	$this->db->where('tbl_contract.insurance_fees>','0');
	$this->db->where('tbl_receipt.insurance_paid_status','0');
	$query2=$this->db->get()->result();


	//$query2=$this->db->get('tbl_receipt');

	$this->db->select("*");
	$this->db->from($this->tableName);
	$this->db->where('tbl_receipt.contract_id',$row->id);
	$this->db->join('tbl_contract','tbl_contract.id=tbl_receipt.contract_id');
	$this->db->where('tbl_receipt.status','Active');
	$this->db->where('tbl_contract.brokerage_fees>','0');
	$this->db->where('tbl_receipt.brokerage_paid_status','0');

	$query3=$this->db->get()->result();

	
	
	$this->db->where('tbl_units.id',$row->unit_id);
	$this->db->where('tbl_units.status','Active');
	$query4=$this->db->get('tbl_units');
	
	foreach($query4->result() as $row4)

{
	$unittype=$row4->unit_type;
	$id=$row4->id;
	  if(substr($id,0,1)=="R") {
                                          $id=str_replace("R", " سكني  ", $row4->id);
                                        } 

                                        if(substr($id,0,1)=="C") {
                                          $id=str_replace("C", " تجاري   ", $row4->id);
                                        } 
                                       
}
	//$output .= '<option value="'.$row->owner_id.'">'.$row->owner_id.'</option>';
	$output = $row->id;
	$output .= "//";
	$output =$unittype." - ".$id;
	$output .= "//";
	$output .= $row->contract_number;
	$output .= "//";
	$output .= $row->total;
	$output .= "//";
	$output .= $row->balance_amount;
	$output .= "//";
	$output .= $row->amount_received;
	$output .= "//";
	$output .= $row->id;
	$output .= "//";
	$output .= $row->insurance_fees;
	$output .= "//";
	$output .= $row->brokerage_fees;
	$output .= "//";
	//$output .= $row->contract_startdate;
	//$output .= "//";
	//$output .= $row->contract_enddate;
	
	
	
	$output.='<option value="">نوع \ رقم الدفعة  </option>';
	if(count($query2)==1) {
		$output .= '<option value="Insurance">قيمة التأمين  </option>';
	}

	if(count($query3)==1) {
		$output .= '<option value="Brokerage"> أجور السعي  </option>';
	}

	
       
	
for($i=$j;$i<=$row->no_of_installments;$i++)
	{
		$min=($row->contract_startdate);
		$max=($row->contract_enddate);
   		$parts=$row->no_of_installments;
   		//$dates =$this->splitDates1($min, $max,$parts);
   		//$dates =$this->splitDates1($min, $max,$parts);
   		$dates =$this->split($min, $max,$parts);
    	foreach ($dates as $value) {
    		$dd[]=$value;
        }
        //print_r($dd); die();
      //  sort($dd);
		$amt=($row->total/$row->no_of_installments);
 
        $output .= '<option value="'.$i.'">Installment '.$i.' (SAR '.number_format($amt,2).' ) From  '.$dd[$i-1].'</option>';
       
    
}
	
$output .= "//";
   $output.=$amount;
  $output .= "//"; 
$min=($row->contract_startdate);
$max=($row->contract_enddate);
   $parts=$row->no_of_installments;
   $dates =$this->split($min, $max,$parts);
   //$dates =$this->splitDates($min, $max,$parts);
    $i = 0;
    foreach ($dates as $value) {
        $i++;
        $output.= "data: $value";
        
    }

  
}	

return $output;

}

Function split($min,$max,$parts)
{
    
    if($parts==2)
    {
       $newDate = date('Y-m-d', strtotime($min. ' + 6 months'));
       $lastDate = date('Y-m-d', strtotime($newDate. ' -1 days'));
       
       $one = new DateTime($min);
       $dt = new DateTime($newDate);
        $lt=new DateTime($lastDate);
        $two=new DateTime($max);
        
        
        $field_map = array(
            'Start'  =>$one->format('Y-m-d').'  To  '. $lt->format('Y-m-d'),
            'end' =>$dt->format('Y-m-d').'  To  '.$two->format('Y-m-d')
        );
  
    }
    else
    {
       $field_map = array(
            'Start'  => $min,
            'end' => $max
        );
  
    }
 
    return($field_map);  
}

function splitDates($min, $max, $parts, $out = "Y-m-d") {
        $dataCollection[] = date($out, strtotime($min));
        $diff = (strtotime($max) - strtotime($min)) / $parts;
        $convert = strtotime($min) + $diff  ;
        
        for ($i = 1; $i < $parts; $i++) {
           
            $dataCollection[] = date($out, $convert);
            $convert += $diff ;
        }
       $dataCollection[] = date($out, strtotime($max));
      // print_r($dataCollection); die();
      return $dataCollection;
    }

function splitDates1($min, $max, $parts, $out = "Y-m-d") {
   // echo $min; echo "<br>"; echo $max; echo "<br>"; echo $parts; echo "<br>";
        $dataCollection[] = date($out, strtotime($min));
        $diff = (strtotime($max) - strtotime($min)) / $parts;
        $convert = strtotime($min) + $diff  ;
        $mindate=date($out,strtotime($min));
         
        for ($i = 1; $i < $parts; $i++) {
           
            $d[$i]=$mindate;
            $d[$i].=" to ";
        	$d[$i].=date($out,$convert);
      		$mindate=date($out,$convert);
            $convert += $diff ;
            
        }
      // echo $mindate; die();
       $d[$i] = $mindate;
       $d[$i].=" to ";
       $d[$i] .= date($out, strtotime($max));
      
      return $d;
    }

  


function fetch_suspendunitcontarct($unit_id,$building_id)
{

$this->db->where('tbl_contract.unit_id',$unit_id);
$this->db->where('tbl_contract.building_id',$building_id);
$this->db->where('tbl_contract.status','Inactive');
$this->db->where('tbl_contract.contract_status','Suspended');
$query=$this->db->get('tbl_contract');

foreach($query->result() as $row)
{
	$this->db->select("max(tbl_receipt.installment_number) as installment");	
	$this->db->where('tbl_receipt.contract_id',$row->id);
	$this->db->where('tbl_receipt.status','Active');
	$query1=$this->db->get('tbl_receipt');

	foreach($query1->result() as $row1)

{
	$installment=$row1->installment;
	
}
	$this->db->select("*");	
	$this->db->from($this->tableName);
	$this->db->where('tbl_receipt.contract_id',$row->id);
	$this->db->where('tbl_receipt.status','Active');
	$this->db->where('tbl_receipt.insurance_paid_status','1');
	$query2=$this->db->get()->result();
	//$query2=$this->db->get('tbl_receipt');

	$this->db->select("*");
	$this->db->from($this->tableName);

	$this->db->where('tbl_receipt.contract_id',$row->id);
	$this->db->where('tbl_receipt.status','Active');
	$this->db->where('tbl_receipt.brokerage_paid_status','1');
	$query3=$this->db->get()->result();

	
	//$output .= '<option value="'.$row->owner_id.'">'.$row->owner_id.'</option>';
	$output = $row->unit_id;
	$output .= "//";
	$output .= $row->contract_number;
	$output .= "//";
	$output .= $row->total;
	$output .= "//";
	$output .= $row->balance_amount;
	$output .= "//";
	$output .= $row->amount_received;
	$output .= "//";
	$output .= $row->id;
	$output .= "//";
	$output .= $row->insurance_fees;
	$output .= "//";
	$output .= $row->brokerage_fees;
	$output .= "//";


$output.='<option value="">نوع \ رقم الدفعة  </option>';
	if(count($query2)==0) {
		$output .= '<option value="Insurance">قيمة التأمين  </option>';
	}

	if(count($query3)==0) {
		$output .= '<option value="Brokerage"> أجور السعي  </option>';
	}
	
	//echo $row->installment; die();
	if($installment ==" ")
	{
	$j=1;
	}
	else
	{
		$j=$installment+1;
	}
	//$j=1;
	for($i=$j;$i<=$row->no_of_installments;$i++)
	{
		$amt=($row->total/$row->no_of_installments);
	$output .= '<option value="'.$i.'">SAR( '.$amt.' ) From'.$i.'</option>';
}
}	

return $output;

}




function insertreceiptDetails($data,$data1) {
	
	//print_r($data); print_r($data1);die();
		$json = array();
			$data['created_on'] = date("Y-m-d H:i:s");
			$data['updated_on'] = date("Y-m-d H:i:s");
			$this->db->insert($this->tableName, $data);
			 $last_id = $this->db->insert_id();
   			$this->db->where('tbl_contract.id',$data['contract_id']);
			$this->db->where('tbl_contract.status','Active');
			$this->db->update('tbl_contract', $data1);
			$json = array("RESULT"=>'OK', "ERROR"=>' تمت اضافة بيانات جديدة بنجاح  ',"ID"=>$last_id);
		return $json;
	}

	function insertsuspendreceiptDetails($data,$data1) {
	
	//print_r($data); print_r($data1);die();
		$json = array();
			$data['created_on'] = date("Y-m-d H:i:s");
			$data['updated_on'] = date("Y-m-d H:i:s");
			$this->db->insert($this->tableName, $data);
			 $last_id = $this->db->insert_id();
   			$this->db->where('tbl_contract.id',$data['contract_id']);
			$this->db->where('tbl_contract.status','Inactive');
			$this->db->where('tbl_contract.contract_status','Suspended');
			$this->db->update('tbl_contract', $data1);
			$json = array("RESULT"=>'OK', "ERROR"=>'تمت اضافة بيانات جديدة بنجاح ',"ID"=>$last_id);
		return $json;
	}


function insertreceiptDetailsonly($data) {
	
		$json = array();
			$data['created_on'] = date("Y-m-d H:i:s");
			$data['updated_on'] = date("Y-m-d H:i:s");
			$this->db->insert($this->tableName, $data);
			 $last_id = $this->db->insert_id();
   			
			$json = array("RESULT"=>'OK', "ERROR"=>' تمت اضافة بيانات جديدة بنجاح ',"ID"=>$last_id);
		return $json;
	}



function getReceiptInfo($id)
{
	$this->db->select("tbl_receipt.id as receiptid,tbl_receipt.*,tbl_building.building_name,tbl_tenants.tenant_firstname,tbl_tenants.tenant_lastname,tbl_contract.*,tbl_contract.id as cid,tbl_units.*,tbl_owner.*");
		$this->db->from("tbl_receipt");
		$this->db->join('tbl_contract','tbl_contract.id=tbl_receipt.contract_id');
		$this->db->join('tbl_building','tbl_building.id=tbl_contract.building_id');
		$this->db->join('tbl_tenants','tbl_tenants.id=tbl_contract.tenant_id');
		$this->db->join('tbl_units','tbl_units.id=tbl_contract.unit_id');
		$this->db->join('tbl_owner','tbl_owner.id=tbl_building.owner_id');
	//	$this->db->where('tbl_contract.status','Active');
		$this->db->where('tbl_receipt.status','Active');
		$this->db->where('tbl_receipt.id',$id);
		$data=$this->db->get()->result();
	//	print_r($data); die();		
		return $data;
	
}


function getSuspendedReceiptInfo($id)
{
	$this->db->select("tbl_receipt.id as receiptid,tbl_receipt.*,tbl_building.building_name,tbl_tenants.tenant_firstname,tbl_tenants.tenant_lastname,tbl_contract.*,tbl_units.*,tbl_owner.*");
		$this->db->from("tbl_receipt");
		$this->db->join('tbl_contract','tbl_contract.id=tbl_receipt.contract_id');
		$this->db->join('tbl_building','tbl_building.id=tbl_contract.building_id');
		$this->db->join('tbl_tenants','tbl_tenants.id=tbl_contract.tenant_id');
		$this->db->join('tbl_units','tbl_units.id=tbl_contract.unit_id');
		$this->db->join('tbl_owner','tbl_owner.id=tbl_building.owner_id');
		$this->db->where('tbl_contract.status','Inactive');
		
		$this->db->where('tbl_receipt.status','Active');
		$this->db->where('tbl_receipt.id',$id);
		$data=$this->db->get()->result();
		//print_r($data); die();		
		return $data;
	
}

function getContract($cid,$uid)
{
		$this->db->select("tbl_contract.id as contractid,tbl_contract.*,tbl_building.*,tbl_tenants.*,tbl_owner.*");
		$this->db->from("tbl_contract");
		$this->db->where('tbl_contract.id',$cid);
		$this->db->where('tbl_contract.unit_id',$uid);
		$this->db->where('tbl_contract.contract_status','Suspended');
		$this->db->join('tbl_tenants','tbl_tenants.id=tbl_contract.tenant_id');
		$this->db->join('tbl_building','tbl_building.id=tbl_contract.building_id');
		$this->db->join('tbl_owner','tbl_owner.id=tbl_building.owner_id');

		$data=$this->db->get()->result();
		//print_r($data); die();		
		return $data;

}

function getInsurance($cid)
{
		$this->db->select("*");
		$this->db->from("tbl_contract");
		$this->db->where('tbl_contract.id',$cid);
		$this->db->where('tbl_contract.contract_status','Suspended');
		$this->db->join('tbl_receipt','tbl_contract.id=tbl_receipt.contract_id');
		$this->db->where('tbl_receipt.insurance_paid_status','1');		
		$this->db->where('tbl_receipt.status','Active');	
		$data=$this->db->get()->result();
		//print_r($data); die();		
		return $data;

}


function getBrokerage($cid)
{
		$this->db->select("*");
		$this->db->from("tbl_contract");
		$this->db->where('tbl_contract.id',$cid);
		$this->db->where('tbl_contract.contract_status','Suspended');
		$this->db->join('tbl_receipt','tbl_contract.id=tbl_receipt.contract_id');
		$this->db->where('tbl_receipt.brokerage_paid_status','1');		
		$this->db->where('tbl_receipt.status','Active');	
		$data=$this->db->get()->result();
		//print_r($data); die();		
		return $data;

}

function updateReceipt($data2,$data1,$data,$data3,$maxid)
{
 
 
			$this->db->where('tbl_contract.id',$data['contractid']);
			$this->db->where('tbl_contract.status','Active');
			$this->db->update('tbl_contract', $data1);

			$this->db->where('tbl_receipt.id',$data['receiptid']);
			$this->db->update('tbl_receipt', $data2);

			$this->db->where('tbl_receipt.id',$maxid);
			$this->db->update('tbl_receipt', $data3);
			

}


}
?>