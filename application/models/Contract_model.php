<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Contract_model extends CI_Model{

	var $tableName="tbl_contract";

function __construct() {
		parent::__construct();
		$this->load->database(); 

	}

	function getunitinfo($building_id)
	{
		$this->db->where('building_id',$building_id);
		$this->db->order_by('id','ASC');
		$query=$this->db->get('tbl_units');
		$output='<option value=""> رقم الوحدة </option>';
		foreach($query->result() as $row) 
		{
			$output .= '<option value="'.$row->id.'">'.$row->id.'</option>';
		}
		return $output;
	}


function getfreeunits($id)
	{
		//echo $id; die();
		$this->db->select("tbl_units.id");
		$this->db->from('tbl_units');
		//$this->db->join('tbl_contract','tbl_units.id=tbl_contract.unit_id');
		$this->db->where('tbl_units.building_id=',$id);
		$this->db->where('tbl_units.occupy_status', 0);
		$this->db->where('tbl_units.status =', 'Active');
		$data=$this->db->get()->result();		
		return $data;

	}
function insertcontractDetails($data) {
	
		$json = array();
		$this->db->select("id");
		$this->db->from($this->tableName);
		$this->db->where('building_id',$data['building_id']);
		$this->db->where('unit_id',$data['unit_id']);
		$this->db->where('status =', 'Active');
		$result=$this->db->get()->result();	
		if (count($result) == '0') {	
			$data['created_on'] = date("Y-m-d H:i:s");
			$data['updated_on'] = date("Y-m-d H:i:s");
			//$data['createdby'] = $this->session->userdata('adminUserName');
			//$data['updatedon'] = date("Y-m-d H:i:s");
			//$data['updatedby'] = $this->session->userdata('adminUserName');
			$this->db->insert($this->tableName, $data);
			
			$data1['occupy_status']=1;

			$this->db->where('tbl_units.id',$data['unit_id']);
			$this->db->where('tbl_units.building_id',$data['building_id']);
			$this->db->update('tbl_units', $data1);


			$json = array("RESULT"=>'OK', "ERROR"=>'تم إنشاء\تجديد العقد بنجاح ');
		} else {
			$json = array("RESULT"=>'Error', "ERROR"=>' البيانات موجودة مسبقا ');
		}
		return $json;
	}

function fetch_units($building_id)
{

$this->db->where('building_id',$building_id);
$this->db->where('occupy_status',0);
//$this->db->order_by('id','Asc');
$query=$this->db->get('tbl_units');
$output='<option value="">Select units</option>';

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



function fetch_enddate($sdate,$days)
{

$sdate=date_create($sdate);
date_add($sdate,date_interval_create_from_date_string($days));
date_sub($sdate,date_interval_create_from_date_string("1 day"));
return date_format($sdate,'Y-m-d');

}

function deletecontractInformation($id,$buildingid,$unitid) {
	
	//echo $id; die();
		$json = array();		
		$this->db->select("id");
		$this->db->from($this->tableName);
		$this->db->where('id', $id);
		$this->db->where('status =', 'Active');
		$result=$this->db->get()->result();	
		if (count($result) > 0) {


			$this->db->select("sum(amt_received) as received,tbl_contract.total");
		$this->db->from('tbl_receipt');
		$this->db->where('tbl_receipt.insurance_paid_status', '0');
		$this->db->where('tbl_receipt.brokerage_paid_status', '0');
		$this->db->where('tbl_receipt.contract_id', $id);
		$this->db->where('tbl_receipt.status =', 'Active');
		$this->db->join('tbl_contract', 'tbl_contract.id=tbl_receipt.contract_id');
		$result1=$this->db->get()->result();
		if(count($result1) >0) {
			
			
					$total=$result1['0']->total;
					$amtreceived=$result1['0']->received;
					if($amtreceived >= $total)
					{

			$this->db->select("id,amt_received");
		$this->db->from('tbl_receipt');
		$this->db->where('insurance_paid_status', '1');
		$this->db->where('contract_id', $id);
		$this->db->where('status =', 'Active');
		$result2=$this->db->get()->result();
			if (count($result2) > 0) {
				$insurance="1";
				$amt_received=$result2['0']->amt_received;
				$json = array("RESULT"=>'Error1', "ERROR"=>'You Can not end the contract until Clear the insurance amount  ' .$amt_received.' ');
				
         		}
				else
				{
					
			$data['status']='Inactive';
			$this->db->where('id', $id);
			$this->db->update($this->tableName, $data);	
			$data1['occupy_status']=0;

			$this->db->where('tbl_units.id',$unitid);
			$this->db->where('tbl_units.building_id',$buildingid);
			$this->db->update('tbl_units', $data1);	

			$json = array("RESULT"=>'OK', "ERROR"=>'تم انهاء العقد بنجاح ');
		}
		
	}
	else
	{
		$json = array("RESULT"=>'Error', "ERROR"=>' المبلغ الاجمالي لم يتم دفعه بعد ');
	}


	 }

		}
		 else {
			$json = array("RESULT"=>'Error', "ERROR"=>'عذرا, البيانات غير موجودة ');
		}		
		return $json;
		
	} 



function suspendcontractInformation($id,$buildingid,$unitid) {
	
	//echo $id; die();
		$json = array();		
		

			$data['status']='Inactive';
			$data['contract_status']='Suspended';
			$this->db->where('id', $id);
			$this->db->update($this->tableName, $data);	
			$data1['occupy_status']=0;
			$this->db->where('tbl_units.id',$unitid);
			$this->db->where('tbl_units.building_id',$buildingid);
			$this->db->update('tbl_units', $data1);	

			$json = array("RESULT"=>'OK', "ERROR"=>'تم تعليق العقد بنجاح ');
			
		return $json;
		
	} 



function getSuspendedContracts()
{
	$this->db->select("tbl_contract.id as cid,tbl_contract.*,tbl_building.*,tbl_units.*,tbl_tenants.*");
		$this->db->from($this->tableName);
		$this->db->join('tbl_building','tbl_building.id=tbl_contract.building_id');
		$this->db->join('tbl_units','tbl_units.id=tbl_contract.unit_id');
		$this->db->join('tbl_tenants','tbl_tenants.id=tbl_contract.tenant_id');
		$this->db->where('tbl_contract.contract_status','Suspended');
		$data=$this->db->get()->result();	
		return $data;
}



function getEndContracts()
{
	$this->db->select("tbl_contract.id as cid,tbl_contract.*,tbl_building.*,tbl_units.*,tbl_tenants.*");
		$this->db->from($this->tableName);
		$this->db->join('tbl_building','tbl_building.id=tbl_contract.building_id');
		$this->db->join('tbl_units','tbl_units.id=tbl_contract.unit_id');
		$this->db->join('tbl_tenants','tbl_tenants.id=tbl_contract.tenant_id');
		$this->db->where('tbl_contract.status','Inactive');
		$this->db->where('tbl_contract.contract_status !=','Suspended');
		$data=$this->db->get()->result();	
		return $data;
}




	function getAllContractDetails($id)
	{
		$this->db->select("tbl_contract.id as id ,tbl_contract.*");
		$this->db->from($this->tableName);
		$this->db->join('tbl_units','tbl_units.id=tbl_contract.unit_id');
		$this->db->where('tbl_contract.id',$id);
		$this->db->where('tbl_contract.status','Active');
		$data=$this->db->get()->result();	
		return $data;
	} 

	function getContractDetails($id)
	{
		$this->db->select("tbl_contract.id as id ,tbl_contract.*,tbl_building.*,tbl_tenants.*");
		$this->db->from($this->tableName);
		$this->db->join('tbl_units','tbl_units.id=tbl_contract.unit_id');
		$this->db->join('tbl_building','tbl_building.id=tbl_contract.building_id');
		$this->db->join('tbl_tenants','tbl_tenants.id=tbl_contract.tenant_id');
		$this->db->where('tbl_contract.id',$id);
		//$this->db->where('tbl_contract.status','Active');
		$data=$this->db->get()->result();	
		return $data;
	} 


	function editcontractDetails($data, $id) {
	//print_r($data); echo"<br>";echo $id; die();
		$json = array();
			
			$data['updated_on'] = date("Y-m-d H:i:s");
			$data['updated_by'] =  $this->session->userdata('first_name');
			//print_r($data);die();
			$this->db->where('id', $id);
			$this->db->update($this->tableName, $data);
			
			$json = array("RESULT"=>'OK', "ERROR"=>'تم التحديث بنجاح ');
		
		return $json;
		
	}


}?>