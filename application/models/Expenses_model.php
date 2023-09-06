<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Expenses_model extends CI_Model{

	var $tableName="tbl_expenses";

function __construct() {
		parent::__construct();
		$this->load->database(); 

	}
function insertexpenseDetails($data) {


	
		$json = array();
		$this->db->select("*");
		
		$this->db->from($this->tableName);
		$this->db->where('building_id', $data['building_id']);
		$this->db->where('invoice_number', $data['invoice_number']);
		$this->db->where('date', $data['date']);
		$this->db->where('status !=', 'Deleted');
		$result=$this->db->get()->result();	
		if (count($result) == 0) {
					
			$data['created_on'] = date("Y-m-d H:i:s");
			$data['updated_on'] = date("Y-m-d H:i:s");
			$this->db->insert($this->tableName, $data);
			$json = array("RESULT"=>'OK', "ERROR"=>'تمت اضافة بيانات جديدة بنجاح ');
		}
		else
		{
			$json = array("RESULT"=>'Error', "ERROR"=>' البيانات موجودة مسبقا ');
		}
		return $json;
	}

function deleteexpenseInformation($id) {
	
		$json = array();		
		
			$data['status']='Deleted';
			$data['updated_on'] = date("Y-m-d H:i:s");
			$data['updated_by'] =  $this->session->userdata('first_name');
			$this->db->where('id', $id);
			$this->db->update($this->tableName, $data);	
			//$this->db->where('id', $id);
			//$this->db->update('tbl_building', array('status' => 'Deleted'));		

			$json = array("RESULT"=>'OK', "ERROR"=>'تم حذف البيانات بنجاح ');
			
		return $json;
		
	}


function getexpenseinfo($id)
	{
		$this->db->select("tbl_expenses.*,tbl_building.building_name,tbl_bank.bank_name");
		$this->db->from("tbl_expenses");
		$this->db->join('tbl_building','tbl_building.id=tbl_expenses.building_id','left');
		$this->db->join('tbl_bank','tbl_bank.id=tbl_expenses.bank_id','left');
		$this->db->where('tbl_expenses.status','Active');
		$this->db->where('tbl_expenses.id',$id);

		$data=$this->db->get()->result();		
		return $data;
	}

function fetch_units($building_id)
{

$this->db->where('building_id',$building_id);
$this->db->where('occupy_status',1);
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

	$output .= '<option value="'.$row->id.'">'.$id.'</option>';
}	
return $output;
}

function fetch_contract($building_id,$unit_id)
{

$this->db->where('building_id',$building_id);
$this->db->where('unit_id',$unit_id);
$this->db->where('status','Active');
//$this->db->order_by('id','Asc');
$query=$this->db->get('tbl_contract');
foreach($query->result() as $row)
{
	$output = $row->id;
}	
return $output;
}


function updateExpInformation($data,$id)
{
		$json = array();
		$this->db->select("id");
		$this->db->from($this->tableName);
		$this->db->where('status !=', 'Deleted');
		$this->db->where('id =', $id);
		$result=$this->db->get()->result();	
		if (count($result) > '0') {
			
			$data['updated_on'] = date("Y-m-d H:i:s");
			$data['updated_by'] =  $this->session->userdata('first_name');
			//print_r($data);die();
			$this->db->where('id', $id);
			$this->db->update($this->tableName, $data);
			
			$json = array("RESULT"=>'OK', "ERROR"=>'تم التحديث بنجاح ');
		} else {
			$json = array("RESULT"=>'Error', "ERROR"=>'عذرا, البيانات غير موجودة ');
		}
		return $json;
		
}



} ?>