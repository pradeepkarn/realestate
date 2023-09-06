<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Statement_model extends CI_Model{

	//var $tableName="tbl_bank";

function __construct() {
		parent::__construct();
		$this->load->database(); 

	}

	function tenantstatement($data)
	{
		//print_r($data);die();
		$this->db->select("*,tbl_receipt.id as receiptid");
		$this->db->from('tbl_contract');
		$this->db->where('tbl_contract.building_id',$data['building_id']);
		$this->db->where('tbl_contract.tenant_id',$data['tenant_id']);
		$this->db->where('tbl_contract.status','Active');

		$this->db->join('tbl_receipt','tbl_contract.id=tbl_receipt.contract_id');
		$this->db->join('tbl_tenants','tbl_tenants.id=tbl_contract.tenant_id');
		$this->db->where('tbl_receipt.insurance_paid_status','0');
		$this->db->where('tbl_receipt.brokerage_paid_status','0');
		
		$data=$this->db->get()->result();	
		//print_r($data);die();
		return $data;
	}

	function buildingstatement($data)
	{
		//print_r($data);die();

	/*	
		$this->db->select("*,tbl_receipt.id as receiptid");
		$this->db->from('tbl_contract');
		$this->db->where('tbl_contract.building_id',$data['building_id']);
		$this->db->where('tbl_contract.status','Active');
		$this->db->join('tbl_building','tbl_building.id=tbl_contract.building_id');
		$this->db->join('tbl_units','tbl_units.id=tbl_contract.unit_id');

		$this->db->join('tbl_receipt','tbl_contract.id=tbl_receipt.contract_id');
		$this->db->join('tbl_payment','tbl_payment.contract_id=tbl_contract.id');
		$this->db->where('tbl_receipt.insurance_paid_status','0');
		$this->db->where('tbl_receipt.brokerage_paid_status','0');
		
		$data=$this->db->get()->result();	
		//print_r($data);die();
		return $data;*/
	}

  function revenuebrokerageinfo($start,$end)
  {

	$this->db->select("tbl_contract.id,tbl_contract.building_id,tbl_contract.unit_id,tbl_receipt.id as receiptid,tbl_receipt.installment_number,tbl_receipt.amt_received,tbl_contract.brokerage_fees,tbl_contract.brokerage_percentage,tbl_contract.*,tbl_receipt.*,tbl_building.building_name");
		$this->db->from('tbl_contract');
		$this->db->where('tbl_contract.status','Active');
		$this->db->where('tbl_contract.brokerage_percentage!=','0');
		$this->db->join('tbl_receipt','tbl_contract.id=tbl_receipt.contract_id');
		$this->db->join('tbl_building','tbl_building.id=tbl_contract.building_id');
		$this->db->where('tbl_receipt.insurance_paid_status','0');
		$this->db->where('tbl_receipt.amt_received_date>=',$start);
		$this->db->where('tbl_receipt.amt_received_date<=',$end);
		/*$this->db->join('tbl_expenses','tbl_building.id=tbl_expenses.building_id','left');
		$this->db->where('tbl_expenses.expense_type','Maintenance');
		$this->db->or_where('tbl_expenses.expense_type','Others');*/
		
		$data=$this->db->get()->result();	
		//print_r($data);die();
		return $data;


  }

   function revenueexpenseinfo($start,$end)
  {

	$this->db->select("*");
		$this->db->from('tbl_expenses');
		$this->db->where('date>=',$start);
		$this->db->where('date<=',$end);
		$where = "(expense_type='Salaries' OR expense_type='Administrative Expenses')";
		$this->db->where($where);		
		$this->db->where('status','Active');
		$data=$this->db->get()->result();	
		//print_r($data);die();
		return $data;
  }

   function insurnacepayemntinfo($start,$end)
  {

	$this->db->select("*");
		$this->db->from('tbl_insurancepayment');
		$this->db->where('tbl_insurancepayment.payment_date>=',$start);
		$this->db->where('tbl_insurancepayment.payment_date<=',$end);
		$this->db->join('tbl_building','tbl_building.id=tbl_insurancepayment.building_id');		
		$this->db->where('tbl_insurancepayment.status','Active');
		$data=$this->db->get()->result();	
		//print_r($data);die();
		return $data;
  }

function fixedbrokerageinfo($start,$end)
  {

	$this->db->select("*,tbl_contract.id as ID");
		$this->db->from('tbl_contract');
		$this->db->where('tbl_contract.contract_startdate>=',$start);
		$this->db->where('tbl_contract.contract_startdate<=',$end);
		$this->db->where('tbl_contract.brokerage_percentage',0);
		$this->db->where('tbl_contract.fixed_brokerage_amount!=',0);
		$this->db->join('tbl_building','tbl_building.id=tbl_contract.building_id');
		$this->db->where('tbl_contract.status','Active');
		$data=$this->db->get()->result();	
		//print_r($data);die();
		return $data;
  }

  function previousrevenuebalanceinfo($start,$end)
{
		$this->db->select("(SELECT  iFNull(sum(iF(tbl_receipt.installment_number is NULL,tbl_receipt.amt_received,tbl_receipt.amt_received*(tbl_contract.brokerage_percentage/100))),0) as t FROM `tbl_contract` JOIN `tbl_receipt` ON `tbl_contract`.`id`=`tbl_receipt`.`contract_id` JOIN `tbl_building` ON `tbl_building`.`id`=`tbl_contract`.`building_id` WHERE `tbl_contract`.`status` = 'Active' AND `tbl_receipt`.`insurance_paid_status` = '0' AND `tbl_receipt`.`amt_received_date` < '$start') - (SELECT iFNull(SUM(`total_amount`), 0) FROM `tbl_expenses` where (expense_type='Administrative Expenses' or expense_type='Salaries') and date < '$start') AS `previousbalance`");
			
		$data=$this->db->get()->result();
		return $data;
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
	$output .= '<option value="'.$row->tenant_id.'">'.$row->tenant_firstname.'</option>';
	

}	
return $output;

}


function fetch_contractinfo($data)
{
$this->db->where('tbl_contract.building_id',$data['building_id']);
$this->db->where('tbl_contract.tenant_id',$data['tenant_id']);
$this->db->where('tbl_contract.status','Active');
$query=$this->db->get('tbl_contract');
foreach($query->result() as $row)
{
	$output = $row->contract_number;
	$output .= "//";
	$output .= $row->insurance_fees;
	$output .= "//";
	$output .= $row->id;
	
}	
return $output;
}

function buildingreceiptinfo($data,$start,$end)
{
		$this->db->select("tbl_contract.building_id, tbl_contract.unit_id, tbl_receipt.amt_received,tbl_receipt.installment_number,tbl_contract.*,tbl_receipt.*");
		$this->db->from('tbl_contract');
		$this->db->where('tbl_contract.status','Active');
		$this->db->join('tbl_receipt','tbl_contract.id=tbl_receipt.contract_id','left');
		//$this->db->join('tbl_building','tbl_building.id=tbl_contract.building_id');
		$this->db->where('tbl_receipt.insurance_paid_status','0');
		$this->db->where('tbl_receipt.brokerage_paid_status','0');
		$this->db->where('tbl_contract.building_id',$data['building_id']);
		if(isset($data['unit_id']))
		{
			$this->db->where('tbl_contract.unit_id',$data['unit_id']);
			
		}
		$this->db->where('tbl_receipt.amt_received_date>=',$start);
		$this->db->where('tbl_receipt.amt_received_date<=',$end);
		$data=$this->db->get()->result();	
		//print_r($data);die();
		return $data;
}

function buildingbrokerageinfo($data,$start,$end)
{
		$this->db->select("(tbl_receipt.amt_received*(tbl_contract.brokerage_percentage/100))as amount, Concat(tbl_receipt.description,' Brokerage % (',tbl_contract.brokerage_percentage,' )') as description,tbl_receipt.amt_received_date,tbl_receipt.id as id");
		$this->db->from('tbl_contract');
		$this->db->where('tbl_contract.status','Active');
		$this->db->join('tbl_receipt','tbl_contract.id=tbl_receipt.contract_id','left');
		//$this->db->join('tbl_building','tbl_building.id=tbl_contract.building_id');
	//	$this->db->where('tbl_contract.brokerage_percentage!=','0');
		$this->db->where('tbl_receipt.insurance_paid_status','0');
		$this->db->where('tbl_receipt.brokerage_paid_status','0');
		$this->db->where('tbl_contract.building_id',$data['building_id']);
		if(isset($data['unit_id']))
		{
			$this->db->where('tbl_contract.unit_id',$data['unit_id']);
			
		}
		$this->db->where('tbl_receipt.amt_received_date>=',$start);
		$this->db->where('tbl_receipt.amt_received_date<=',$end);
		$data=$this->db->get()->result();	
		//print_r($data);die();
		return $data;
}

function buildingfixedbrokerageinfo($data,$start,$end)
  {

	$this->db->select("*,tbl_contract.id as ID");
		$this->db->from('tbl_contract');
		$this->db->where('tbl_contract.contract_startdate>=',$start);
		$this->db->where('tbl_contract.contract_startdate<=',$end);
		$this->db->where('tbl_contract.building_id',$data['building_id']);
		if(isset($data['unit_id']))
		{
			$this->db->where('tbl_contract.unit_id',$data['unit_id']);
			
		}
		$this->db->where('tbl_contract.brokerage_percentage',0);
		$this->db->where('tbl_contract.fixed_brokerage_amount!=',0);
		$this->db->join('tbl_building','tbl_building.id=tbl_contract.building_id');
		$this->db->where('tbl_contract.status','Active');
		$data=$this->db->get()->result();	
		//print_r($data);die();
		return $data;
  }

function buildingpaymentinfo($data,$start,$end)
{

	
$this->db->select("tbl_contract.building_id, tbl_contract.unit_id, tbl_payments.payment_amount,tbl_contract.*,tbl_payments.*,tbl_building.building_name");
		$this->db->from('tbl_contract');
		$this->db->where('tbl_contract.status','Active');
		$this->db->join('tbl_payments','tbl_contract.id=tbl_payments.contract_id');
		$this->db->join('tbl_building','tbl_building.id=tbl_contract.building_id');		
		$this->db->where('tbl_contract.building_id',$data['building_id']);
		if(isset($data['unit_id']))
		{
			$this->db->where('tbl_contract.unit_id',$data['unit_id']);
			
		}
		$this->db->where('tbl_payments.payment_date>=',$start);
		$this->db->where('tbl_payments.payment_date<=',$end);
		$data=$this->db->get()->result();	
		//print_r($data);die();
		return $data;
}

function buildingmaintenanceinfo($data,$start,$end)
	{
		
		$this->db->select("*");
		$this->db->from('tbl_expenses');		
		$this->db->where('tbl_expenses.building_id',$data['building_id']);
		if(isset($data['unit_id']))
		{
			$this->db->where('tbl_expenses.unit_id',$data['unit_id']);
		}
		$this->db->where('tbl_expenses.date>=',$start);
		$this->db->where('tbl_expenses.date<=',$end);
		$where = "(expense_type='Maintenance' OR expense_type='Others')";
		$this->db->where($where);
		
		$data=$this->db->get()->result();	
		return $data;
		//print_r($data);die();*/
		
}

function previousbuildingbalanceinfo($data,$start)
{
	$bid=$data['building_id'];
	if(isset($data['unit_id']))
		{
			$uid=$data['unit_id'];
			$this->db->select("(SELECT  iFNull(sum(tbl_receipt.amt_received),0) FROM `tbl_contract` JOIN `tbl_receipt` ON `tbl_contract`.`id`=`tbl_receipt`.`contract_id` JOIN `tbl_building` ON `tbl_building`.`id`=`tbl_contract`.`building_id` WHERE `tbl_contract`.`status` = 'Active' AND `tbl_receipt`.`insurance_paid_status` = '0' AND `tbl_receipt`.`brokerage_paid_status` = '0' AND `tbl_contract`.`building_id` = '$bid' and `tbl_contract`.`unit_id`='$uid' AND `tbl_receipt`.`amt_received_date` < '$start')-(SELECT iFNull(sum(tbl_receipt.amt_received*tbl_contract.brokerage_percentage/100), 0) FROM `tbl_contract` JOIN `tbl_receipt` ON `tbl_contract`.`id`=`tbl_receipt`.`contract_id` JOIN `tbl_building` ON `tbl_building`.`id`=`tbl_contract`.`building_id` WHERE `tbl_contract`.`status` = 'Active' AND `tbl_receipt`.`insurance_paid_status` = '0' AND `tbl_receipt`.`brokerage_paid_status` = '0' AND `tbl_contract`.`building_id` = '$bid' and `tbl_contract`.`unit_id`='$uid' AND `tbl_receipt`.`amt_received_date` < '$start')-	(SELECT iFNull(sum(tbl_payments.payment_amount),0) FROM `tbl_contract` JOIN `tbl_payments` ON `tbl_contract`.`id`=`tbl_payments`.`contract_id` JOIN `tbl_building` ON `tbl_building`.`id`=`tbl_contract`.`building_id` WHERE `tbl_contract`.`status` = 'Active' AND `tbl_contract`.`building_id` = '$bid' and `tbl_contract`.`unit_id`='$uid' AND `tbl_payments`.`payment_date` < '$start')-(SELECT iFNull(sum(total_amount),0) FROM `tbl_expenses` where building_id='$bid' and unit_id='$uid' and date<'$start')
 AS `previousbalance`");
		}
		else
		{
	$this->db->select("(SELECT  iFNull(sum(tbl_receipt.amt_received),0) FROM `tbl_contract` JOIN `tbl_receipt` ON `tbl_contract`.`id`=`tbl_receipt`.`contract_id` JOIN `tbl_building` ON `tbl_building`.`id`=`tbl_contract`.`building_id` WHERE `tbl_contract`.`status` = 'Active' AND `tbl_receipt`.`insurance_paid_status` = '0' AND `tbl_receipt`.`brokerage_paid_status` = '0' AND `tbl_contract`.`building_id` = '$bid' AND `tbl_receipt`.`amt_received_date` < '$start')-(SELECT iFNull(sum(tbl_receipt.amt_received*tbl_contract.brokerage_percentage/100), 0) FROM `tbl_contract` JOIN `tbl_receipt` ON `tbl_contract`.`id`=`tbl_receipt`.`contract_id` JOIN `tbl_building` ON `tbl_building`.`id`=`tbl_contract`.`building_id` WHERE `tbl_contract`.`status` = 'Active' AND `tbl_receipt`.`insurance_paid_status` = '0' AND `tbl_receipt`.`brokerage_paid_status` = '0' AND `tbl_contract`.`building_id` = '$bid' AND `tbl_receipt`.`amt_received_date` < '$start')-	(SELECT iFNull(sum(tbl_payments.payment_amount),0) FROM `tbl_contract` JOIN `tbl_payments` ON `tbl_contract`.`id`=`tbl_payments`.`contract_id` JOIN `tbl_building` ON `tbl_building`.`id`=`tbl_contract`.`building_id` WHERE `tbl_contract`.`status` = 'Active' AND `tbl_contract`.`building_id` = '$bid' AND `tbl_payments`.`payment_date` < '$start')-(SELECT iFNull(sum(total_amount),0) FROM `tbl_expenses` where building_id='$bid' and date<'$start')
 AS `previousbalance`");
			}


		$data=$this->db->get()->result();
		return $data;

}

function buildinginfo($data)
{

	
		$this->db->select("*");
		$this->db->from('tbl_building');	
		$this->db->where('id', $data['building_id']);		
		$this->db->where('status', 'Active');
		$data=$this->db->get()->result();	
		//print_r($data);die();
		return $data;
}

function getunits($data)
{
		$this->db->select("*");
		$this->db->from('tbl_units');	
		$this->db->where('building_id', $data);		
		$this->db->where('status', 'Active');
		$data=$this->db->get()->result();	
		//print_r($data);die();
		return $data;
}

function getunitsbyid($data)
{
		
			
		$this->db->where('building_id', $data);		
		$this->db->where('status', 'Active');
		$query=$this->db->get('tbl_units');
$output='<option value="">Select Units</option>';
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
}	
return $output;
}



function cashreceiptinfo($start,$end)
{

	
$this->db->select("*");
		$this->db->from('tbl_receipt');	
		$this->db->where('amt_received_date >=', $start);
		$this->db->where('amt_received_date <=', $end);	
		$this->db->where('payment_type', 'Cash');
		$data=$this->db->get()->result();	
		//print_r($data);die();
		return $data;
}

function cashexpensesinfo($start,$end)
{

		$this->db->select("*");
		$this->db->from('tbl_expenses');
		$this->db->where('date >=', $start);
		$this->db->where('date <=', $end);	
		$this->db->where('payment_type', 'Cash');	
		$data=$this->db->get()->result();	
		//print_r($data);die();
		return $data;
}


function cashpaymentinfo($start,$end)
{

	
$this->db->select("*");
		$this->db->from('tbl_payments');
		$this->db->where('payment_date >=', $start);
		$this->db->where('payment_date <=', $end);
		$this->db->where('payment_type', 'Cash');		
		$data=$this->db->get()->result();	
		//print_r($data);die();
		return $data;
}


function previouscashbalanceinfo($start,$end)
{
		$this->db->select("(SELECT iFNull(SUM(`amt_received`),0) FROM `tbl_receipt` where payment_type='Cash' and amt_received_date < '$start' )-((SELECT iFNull(SUM(`payment_amount`),0) FROM `tbl_payments` where payment_type='Cash' and payment_date < '$start' ) + (SELECT iFNull(SUM(`total_amount`),0) FROM `tbl_expenses` where payment_type='Cash' and date < '$start')) AS `previousbalance`");
			
		$data=$this->db->get()->result();
		return $data;
}


function bankreceiptinfo($bank,$start,$end)
{

	
		$this->db->select("*");
		$this->db->from('tbl_receipt');	
		$this->db->where('bank_id', $bank);
		$this->db->where('payment_type!=', 'Cash');
		$this->db->where('amt_received_date >=', $start);
		$this->db->where('amt_received_date <=', $end);	
		$data=$this->db->get()->result();	
		//print_r($data);die();
		return $data;
}

function bankexpensesinfo($bank,$start,$end)
{

		$this->db->select("*");
		$this->db->from('tbl_expenses');
		$this->db->where('bank_id', $bank);
		$this->db->where('payment_type!=', 'Cash');
		$this->db->where('date >=', $start);
		$this->db->where('date <=', $end);	
		$data=$this->db->get()->result();		
		
		//print_r($data);die();
		return $data;
}


function bankpaymentinfo($bank,$start,$end)
{

	$this->db->select("*");
		$this->db->from('tbl_payments');
		$this->db->where('bank_id', $bank);
		$this->db->where('payment_type!=', 'Cash');
		$this->db->where('payment_date >=', $start);
		$this->db->where('payment_date <=', $end);
		$data=$this->db->get()->result();	
		//print_r($data);die();
		return $data;
}

function getbank($bank)
{

$this->db->select("*");
		$this->db->from('tbl_bank');
		$this->db->where('id', $bank);
		$data=$this->db->get()->result();	
		//print_r($data);die();
		return $data;
}

function previousbankbalanceinfo($bankid,$start,$end)
{
		$this->db->select("(SELECT iFNull(SUM(`amt_received`),0) FROM `tbl_receipt` where payment_type!='Cash' and bank_id='$bankid' and amt_received_date < '$start' )-(((SELECT iFNull(SUM(`payment_amount`),0) FROM `tbl_payments` where payment_type!='Cash' and bank_id='$bankid' and payment_date < '$start' ) + (SELECT iFNull(SUM(`total_amount`),0) FROM `tbl_expenses` where payment_type!='Cash' and bank_id='$bankid' and date < '$start'))) AS `previousbalance`");
			
		$data=$this->db->get()->result();
		//print_r($data);die();
		return $data;
}

function insertinsurancepaymentDetails($data) {
  
    $json = array();
      $data['created_on'] = date("Y-m-d H:i:s");
      $data['updated_on'] = date("Y-m-d H:i:s");
      //$data['payment_amount']="3049.00";
    //  $data['payment_amount']=intval($data['pay_amount']);
    //print_r($data); //die();//echo $data->payment_amount;die();
      $this->db->insert('tbl_insurancepayment', $data);
       $last_id = $this->db->insert_id();
        $json = array("RESULT"=>'OK', "ERROR"=>' تمت اضافة بيانات جديدة بنجاح ',"ID"=>$last_id);
    return $json;
  }

  function getInsurancePaymentInfo($id)
{
	$this->db->select("*,tbl_insurancepayment.id as paymentid");
		$this->db->from("tbl_insurancepayment");
		$this->db->join('tbl_contract','tbl_contract.id=tbl_insurancepayment.contract_id');
		$this->db->join('tbl_building','tbl_building.id=tbl_contract.building_id');
		
		$this->db->join('tbl_tenants','tbl_tenants.id=tbl_insurancepayment.tenant_id');
		$this->db->join('tbl_bank','tbl_insurancepayment.bank_id=tbl_bank.id','left');
		$this->db->where('tbl_insurancepayment.status','Active');
		$this->db->where('tbl_insurancepayment.id',$id);
		$data=$this->db->get()->result();		
		return $data;
	
}

}
?>