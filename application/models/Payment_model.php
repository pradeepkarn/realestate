<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment_model extends CI_Model{

	var $tableName="tbl_payments";

function __construct() {
		parent::__construct();
		$this->load->database(); 

	}


		function fetch_building($owner_id)
{
	
//echo $owner_id; die();
$this->db->where('tbl_building.owner_id',$owner_id);
$this->db->where('tbl_building.status','Active');
//$this->db->join('tbl_owner','tbl_owner.id=tbl_building.owner_id');
$query=$this->db->get('tbl_building');
$output='<option value="">Select Building Name</option>';
foreach($query->result() as $row)
{
	$output .= '<option value="'.$row->id.'">'.$row->building_name.'</option>';
	
}	
return $output;

}


	function fetch_units($building_id)
{
	
//echo $owner_id; die();
$this->db->where('tbl_units.building_id',$building_id);
$this->db->where('tbl_units.status','Active');
//$this->db->join('tbl_owner','tbl_owner.id=tbl_building.owner_id');
$query=$this->db->get('tbl_units');
$output='<option value="">Select Units Name</option>';
foreach($query->result() as $row)
{

	if(substr($row->id,0,1)=="R")
	{
		$id=str_replace("R"," سكني  ",$row->id);
	}
if(substr($row->id,0,1)=="C")
	{
		$id=str_replace("C"," تجاري   ",$row->id);
	}
	$output .= '<option value="'.$row->id.'">'.$id." ".$row->unit_type.'</option>';
	//$output .= '<option value="'.$row->id.'">'.$row->unit_type." - ".$row->id.'</option>';
	
}	
return $output;

}


function fetch_paymentdetails($uid,$bid)
{

/*$this->db->select("tbl_contract.id as contractnumber,iFNull(tbl_payments.installment_number,Null)as 
	installmentnumber,tbl_receipt.installment_number,tbl_receipt.amt_received,tbl_contract.brokerage_percentage,(tbl_receipt.amt_received*tbl_contract.brokerage_percentage/100)as brokerageamount,(tbl_receipt.amt_received-(tbl_receipt.amt_received*tbl_contract.brokerage_percentage/100))as amount,tbl_receipt.installment_startdate,tbl_receipt.installment_enddate");

$this->db->where("tbl_contract.building_id='$buildingid' and unit_id='$unitid' and tbl_receipt.insurance_paid_status='0' and tbl_receipt.brokerage_paid_status='0'");

$this->db->join('tbl_payments','tbl_payments.contract_id=tbl_contract.id','left');
$this->db->join('tbl_receipt','tbl_receipt.contract_id=tbl_contract.id');
$query=$this->db->get('tbl_contract');
$output='<option value="">Installments</option>';
foreach($query->result() as $row)
{
	if(is_null($row->installmentnumber))
	{
		$output .= '<option value="'.$row->installment_number.'//'.$row->contractnumber.'">'.$row->installment_number." ( ".$row->contractnumber." ) ".'</option>';
}
}
return $output;*/


$start=date('Y-m-d');

$this->db->select("format((SELECT  iFNull(sum(tbl_receipt.amt_received),0) FROM `tbl_contract` JOIN `tbl_receipt` ON `tbl_contract`.`id`=`tbl_receipt`.`contract_id` JOIN `tbl_building` ON `tbl_building`.`id`=`tbl_contract`.`building_id` WHERE `tbl_contract`.`status` = 'Active' AND `tbl_receipt`.`insurance_paid_status` = '0' AND `tbl_receipt`.`brokerage_paid_status` = '0' AND `tbl_contract`.`building_id` = '$bid' and `tbl_contract`.`unit_id`='$uid' AND `tbl_receipt`.`amt_received_date` <= '$start')-(SELECT iFNull(sum(tbl_receipt.amt_received*tbl_contract.brokerage_percentage/100), 0) FROM `tbl_contract` JOIN `tbl_receipt` ON `tbl_contract`.`id`=`tbl_receipt`.`contract_id` JOIN `tbl_building` ON `tbl_building`.`id`=`tbl_contract`.`building_id` WHERE `tbl_contract`.`status` = 'Active' AND `tbl_receipt`.`insurance_paid_status` = '0' AND `tbl_receipt`.`brokerage_paid_status` = '0' AND `tbl_contract`.`building_id` = '$bid' and `tbl_contract`.`unit_id`='$uid' AND `tbl_receipt`.`amt_received_date` <= '$start')-(SELECT iFNull(sum(tbl_payments.payment_amount),0) FROM `tbl_contract` JOIN `tbl_payments` ON `tbl_contract`.`id`=`tbl_payments`.`contract_id` WHERE `tbl_contract`.`status` = 'Active' AND `tbl_contract`.`building_id` = '$bid' and `tbl_contract`.`unit_id`='$uid' AND `tbl_payments`.`payment_date` <='$start')-	(SELECT iFNull(sum(total_amount),0) FROM `tbl_expenses` join `tbl_contract` on `tbl_contract`.`id`=`tbl_expenses`.`contract_id` where tbl_expenses.building_id='$bid' and tbl_expenses.unit_id='$uid' and tbl_expenses.date<='$start' ),2)
 AS `previousbalance`");
$data=$this->db->get()->result();
		foreach($data as $row)
{
	$output = $row->previousbalance;
	//$output.=$row->id;
}
/*$this->db->select("`tbl_receipt`.`contract_id`, `tbl_receipt`.`installment_number`, `tbl_receipt`.`installment_startdate`, `tbl_receipt`.`installment_enddate` FROM `tbl_contract` join `tbl_receipt` on tbl_contract.id=tbl_receipt.contract_id where tbl_contract.status='Active' and tbl_contract.building_id='1$bid' and tbl_contract.unit_id='$uid' and tbl_receipt.installment_number not IN (SELECT tbl_payments.installment_number
	FROM `tbl_contract` join tbl_payments on tbl_contract.id=tbl_payments.contract_id join tbl_receipt on tbl_contract.id=tbl_receipt.contract_id where tbl_contract.status='Active'   AND tbl_contract.building_id='$bid' and tbl_contract.unit_id='$uid' and tbl_receipt.installment_status='0'and tbl_payments.installment_number=tbl_receipt.installment_number)");*/


	// Partial installment -- correct 24-Aug- changed
	//$this->db->select("`tbl_receipt`.`contract_id`, `tbl_receipt`.`installment_number`, `tbl_receipt`.`installment_startdate`, `tbl_receipt`.`installment_enddate` FROM `tbl_contract` join `tbl_receipt` on tbl_contract.id=tbl_receipt.contract_id where tbl_contract.status='Active' and tbl_contract.building_id='$bid' and tbl_contract.unit_id='$uid' and tbl_receipt.installment_status='0' and tbl_receipt.installment_number not IN (select tbl_payments.installment_number from tbl_payments join tbl_receipt on tbl_receipt.contract_id=tbl_payments.contract_id join tbl_contract on tbl_payments.contract_id=tbl_contract.id where tbl_contract.building_id='$bid' and tbl_contract.unit_id='$uid' and tbl_payments.installment_number=tbl_receipt.installment_number and tbl_receipt.installment_statu='0')");

	/// Aug 24th updated
//$this->db->select("`tbl_receipt`.`contract_id`, `tbl_receipt`.`installment_number`, `tbl_receipt`.`installment_status`,`tbl_receipt`.`installment_startdate`, `tbl_receipt`.`installment_enddate` FROM `tbl_contract` join `tbl_receipt` on tbl_contract.id=tbl_receipt.contract_id where tbl_contract.status='Active' and tbl_contract.building_id='$bid' and tbl_contract.unit_id='$uid' and tbl_receipt.installment_number not IN (SELECT tbl_receipt.id FROM tbl_receipt left join tbl_payments on tbl_receipt.contract_id=tbl_payments.contract_id where tbl_receipt.installment_number=tbl_payments.installment_number and tbl_receipt.installment_status=tbl_payments.installment_status)");

$this->db->select("`tbl_receipt`.* FROM tbl_receipt,tbl_contract where tbl_receipt.contract_id=tbl_contract.id and tbl_contract.building_id='$bid' and tbl_contract.unit_id='$uid' and tbl_contract.status='Active' and tbl_receipt.id not in (SELECT tbl_receipt.id FROM tbl_receipt left join tbl_payments on tbl_receipt.contract_id=tbl_payments.contract_id where tbl_receipt.installment_number=tbl_payments.installment_number and tbl_receipt.installment_status=tbl_payments.installment_status)");


	// New installment -- correct
	/*$this->db->select("`tbl_receipt`.`contract_id`, `tbl_receipt`.`installment_number`, `tbl_receipt`.`installment_startdate`, `tbl_receipt`.`installment_enddate`,tbl_receipt.installment_status FROM `tbl_contract` join `tbl_receipt` on tbl_contract.id=tbl_receipt.contract_id where tbl_contract.status='Active' and tbl_contract.building_id='$bid' and tbl_contract.unit_id='$uid' and tbl_receipt.installment_number not IN (select tbl_payments.installment_number from tbl_payments join tbl_receipt on tbl_receipt.contract_id=tbl_payments.contract_id join tbl_contract on tbl_payments.contract_id=tbl_contract.id where tbl_contract.building_id='$bid' and tbl_contract.unit_id='$uid' and tbl_payments.installment_number=tbl_receipt.installment_number and tbl_receipt.installment_status='1')");*/


$data=$this->db->get()->result();

foreach($data as $row)
{
	$sdate=date_create($row->installment_startdate);
	$edate=date_create($row->installment_enddate);
	$output .= "//";
	$output .= $row->contract_id;
	$output .= "//";
	$output .= date_format($sdate,'Y-m-d');
	$output .= "//";
	$output .= date_format($edate,'Y-m-d');
	$output .= "//";
	$output .= $row->installment_number;
	$output .= "//";
	$output .= $row->installment_status;
	
}	

return $output;
}


function fetch_installmentdetails($unitid,$buildingid,$installmentnumber,$contractnumber)
{
	$this->db->select("tbl_contract.id as contractnumber,iFNull(tbl_payments.installment_number,Null)as 
	installmentnumber,tbl_receipt.installment_number,tbl_receipt.amt_received,tbl_contract.brokerage_percentage,(tbl_receipt.amt_received*tbl_contract.brokerage_percentage/100)as brokerageamount,(tbl_receipt.amt_received-(tbl_receipt.amt_received*tbl_contract.brokerage_percentage/100))as amount,tbl_receipt.installment_startdate,tbl_receipt.installment_enddate");

$this->db->where("tbl_contract.building_id='$buildingid' and unit_id='$unitid' and tbl_receipt.insurance_paid_status='0' and tbl_receipt.brokerage_paid_status='0' and tbl_receipt.installment_number='$installmentnumber' and tbl_receipt.contract_id='$contractnumber'");

$this->db->join('tbl_payments','tbl_payments.contract_id=tbl_contract.id','left');
$this->db->join('tbl_receipt','tbl_receipt.contract_id=tbl_contract.id');

$query=$this->db->get('tbl_contract');
//$output='<option value="">Installments</option>';
foreach($query->result() as $row)
{
	if($row->installmentnumber=="")
	{
		$sdate=date_create($row->installment_startdate);
		$edate=date_create($row->installment_enddate);
		$output = $row->amount;
		$output .= "//";
		$output .= date_format($sdate,'Y-m-d');
		$output .= "//";
		$output .= date_format($edate,'Y-m-d');
		
}
}

return $output;
}

function insertpaymentDetails($data) {
	
		$json = array();
			$data['created_on'] = date("Y-m-d H:i:s");
			$data['updated_on'] = date("Y-m-d H:i:s");
			//$data['payment_amount']="3049.00";
		//	$data['payment_amount']=intval($data['pay_amount']);
		//print_r($data); //die();//echo $data->payment_amount;die();
			$this->db->insert('tbl_payments', $data);
			 $last_id = $this->db->insert_id();
   			$json = array("RESULT"=>'OK', "ERROR"=>' تمت اضافة بيانات جديدة بنجاح ',"ID"=>$last_id);
		return $json;
	}



function getPaymentInfo($id)
{
	$this->db->select("*,tbl_payments.id as paymentid");
		$this->db->from("tbl_payments");
		$this->db->join('tbl_contract','tbl_contract.id=tbl_payments.contract_id');
		$this->db->join('tbl_building','tbl_building.id=tbl_contract.building_id');
		$this->db->join('tbl_units','tbl_units.id=tbl_contract.unit_id');
		$this->db->join('tbl_owner','tbl_owner.id=tbl_building.owner_id');
		$this->db->join('tbl_bank','tbl_payments.bank_id=tbl_bank.id','left');
		$this->db->where('tbl_payments.status','Active');
		$this->db->where('tbl_payments.id',$id);
		$data=$this->db->get()->result();		
		return $data;
	
}


function getAllPaymentInfo()
{
	$this->db->select("*,tbl_payments.id as paymentid");
		$this->db->from("tbl_payments");
		$this->db->join('tbl_contract','tbl_contract.id=tbl_payments.contract_id');
		$this->db->join('tbl_building','tbl_building.id=tbl_contract.building_id');
		//$this->db->join('tbl_units','tbl_units.id=tbl_contract.unit_id');
		$this->db->join('tbl_owner','tbl_owner.id=tbl_building.owner_id');
		$this->db->join('tbl_bank','tbl_payments.bank_id=tbl_bank.id','left');
		$this->db->where('tbl_payments.status','Active');
		//$this->db->where('tbl_payments.id',$id);*//

		
		$data=$this->db->get()->result();	
		return $data;
	
}


function getcontractid($data)
{
	$this->db->select("*");
		$this->db->from("tbl_contract");
		$this->db->where('tbl_contract.status','Active');
		$this->db->where('tbl_contract.building_id',$data['building_id']);
		$this->db->where('tbl_contract.unit_id',$data['unit_id']);
		$data=$this->db->get()->result();	
		return $data;
}

} ?>