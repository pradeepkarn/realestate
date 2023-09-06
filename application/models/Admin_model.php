<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_model extends CI_Model{


	function checkAdminLoginInformation($userName, $pwd) {

		$this->db->select("id,user_name,password,first_name,user_sign,user_role");
		$this->db->from("tbl_users");
		$this->db->where('user_name',$userName);
		$this->db->where('password',$pwd);	
		$this->db->where('status','Active');		
		$data=$this->db->get()->result();	

		return $data;
	}


	function getuserinfo()
	{
		 if($this->session->userdata('user_name'))  {  

			$username=$this->session->userdata('user_name'); } 
		
		$this->db->select("*");
		$this->db->from("tbl_users");
		$this->db->where('user_name',$username);
		$this->db->where('status','Active');
		$data=$this->db->get()->result();
		
		return $data;
	}


	function getAllAreas()
	{
		$this->db->select("*");
		$this->db->from("tbl_area");
		$this->db->where('status','Active');
		$data=$this->db->get()->result();
		return $data;
	}

	function getcountBuildings()
	{
		$this->db->select("count(id) as buildings");
		$this->db->from("tbl_building");
		$this->db->where('status','Active');
		$data=$this->db->get()->result();
		return $data;
	}

function getAllBuildings()
	{
		$this->db->select("*");
		$this->db->from("tbl_building");
		$this->db->where('status','Active');
		$data=$this->db->get()->result();
		return $data;
	}


function getAllBuildingswithUnits()
{
	//$this->db->select("tbl_building.id,tbl_building.building_name, tbl_building.no_of_housing_units,tbl_building.no_of_commercial_units, COUNT(tbl_units.id) AS Total");
	//$this->db->select(*);
		$this->db->from("tbl_building");
		//$this->db->join('tbl_units','tbl_units.building_id=tbl_building.id','left');
		$this->db->where('tbl_building.status','Active');
		//$this->db->group_by('tbl_building.id');
		//$this->db->group_by('tbl_building.building_name');
		$data=$this->db->get()->result();
		return $data;
}

	function getcountUnits()
	{
		$this->db->select("count(id) as units");
		$this->db->from("tbl_units");
		$this->db->where('status','Active');
		$data=$this->db->get()->result();		
		return $data;
	}

	function getAllUnits()
	{
		$this->db->select("*");
		$this->db->from("tbl_units");
		$this->db->where('status','Active');
		$data=$this->db->get()->result();		
		return $data;
	}

	function getcountOwners()
	{
		$this->db->select("count(id) as owners");
		$this->db->from("tbl_owner");
		$this->db->where('status','Active');
		$this->db->order_by('id','Desc');
		$data=$this->db->get()->result();		
		return $data;
	}

	function getAllOwners()
	{
		$this->db->select("*");
		$this->db->from("tbl_owner");
		$this->db->where('status','Active');
		$data=$this->db->get()->result();	
		//print_r($data);die();
		return $data;
	}


	function getcountTenants()
	{
		$this->db->select("count(id) as tenants");
		$this->db->from("tbl_tenants");
		$this->db->where('status','Active');
		$data=$this->db->get()->result();		
		return $data;
	}

	function getAllTenants()
	{
		$this->db->select("*");
		$this->db->from("tbl_tenants");
		$this->db->where('status','Active');
		$this->db->order_by('tenant_firstname','asc');
		$data=$this->db->get()->result();		
		return $data;
	}

	function getcountContracts()
	{
		$this->db->select("count(id) as contracts");
		$this->db->from("tbl_contract");
		$this->db->where('status','Active');
		$data=$this->db->get()->result();		
		return $data;
	}


function getAllContracts()
	{
		$this->db->select("*,tbl_contract.id as cid,tbl_tenants.tenant_firstname");
		$this->db->from("tbl_contract");
		$this->db->join('tbl_building','tbl_building.id=tbl_contract.building_id');
		$this->db->join('tbl_tenants','tbl_tenants.id=tbl_contract.tenant_id');
		//$this->db->join('tbl_units','tbl_units.id=tbl_contract.unit_id');
		$this->db->where('tbl_contract.status','Active');
		
		$data=$this->db->get()->result();		
		return $data;
	}


	function getcountReceipts()
	{
		$this->db->select("count(id) as receipts");
		$this->db->from("tbl_receipt");
		$this->db->where('status','Active');
		$data=$this->db->get()->result();		
		return $data;
	}

	function getAllReceipts()
	{
		$this->db->select("tbl_receipt.id as receiptid,tbl_receipt.*,tbl_building.building_name,tbl_tenants.tenant_firstname,tbl_contract.*");
		$this->db->from("tbl_receipt");

		$this->db->join('tbl_contract','tbl_contract.id=tbl_receipt.contract_id','left');
		$this->db->join('tbl_building','tbl_building.id=tbl_contract.building_id','left');
		$this->db->join('tbl_tenants','tbl_tenants.id=tbl_contract.tenant_id','left');
		//$this->db->join('tbl_units','tbl_units.id=tbl_contract.unit_id','left');
		//$this->db->where('tbl_contract.status','Active');
		$this->db->where('tbl_receipt.status','Active');
		$data=$this->db->get()->result();		
		return $data;
	}


function getAllReceipts1()
	{
		$this->db->select("tbl_receipt.id as receiptid,tbl_receipt.*,tbl_building.building_name,tbl_tenants.tenant_firstname,tbl_contract.*,tbl_units.unit_type");
		$this->db->from("tbl_receipt");

		$this->db->join('tbl_contract','tbl_contract.id=tbl_receipt.contract_id','left');
		$this->db->join('tbl_building','tbl_building.id=tbl_contract.building_id','left');
		$this->db->join('tbl_tenants','tbl_tenants.id=tbl_contract.tenant_id','left');
		$this->db->join('tbl_units','tbl_units.id=tbl_contract.unit_id','left');
		$this->db->where('tbl_contract.status','Active');
		$this->db->where('tbl_receipt.status','Active');
		$data=$this->db->get()->result();		
		return $data;
	}



function getcountPayments()
	{
		$this->db->select("count(id) as payments");
		$this->db->from("tbl_payments");
		$this->db->where('status','Active');
		$data=$this->db->get()->result();		
		return $data;
	}


function getAllPayments()
	{
		$this->db->select("*");
		$this->db->from("tbl_payments");
		$this->db->where('status','Active');
		$data=$this->db->get()->result();		
		return $data;
	}


function getcountBank()
	{
		$this->db->select("count(id) as banks");
		$this->db->from("tbl_bank");
		$this->db->where('status','Active');
		$data=$this->db->get()->result();		
		return $data;
	}

function getAllBank()
	{
		$this->db->select("*");
		$this->db->from("tbl_bank");
		$this->db->where('status','Active');
		$data=$this->db->get()->result();		
		return $data;
	}

	function getAllUsers()
	{
		$this->db->select("*");
		$this->db->from("tbl_users");
		$this->db->where('status','Active');
		$data=$this->db->get()->result();		
		return $data;
	
	}

	function getAllExpenses()
	{
		$this->db->select("tbl_expenses.*,tbl_building.building_name");
		$this->db->from("tbl_expenses");
		$this->db->join('tbl_building','tbl_building.id=tbl_expenses.building_id','left');
		$this->db->where('tbl_expenses.status','Active');
		$data=$this->db->get()->result();		
		return $data;
	}

	function getcountExpenses()
	{
		$this->db->select("count(id) as expenses");
		$this->db->from("tbl_expenses");
		$this->db->where('status','Active');
		$data=$this->db->get()->result();		
		return $data;
	}
/*function getAllPayments()
	{
		$this->db->select("tbl_receipt.id as receiptid,tbl_receipt.*,tbl_building.building_name,tbl_tenants.tenant_firstname,tbl_contract.*,tbl_units.*");
		$this->db->from("tbl_receipt");

		$this->db->join('tbl_contract','tbl_contract.id=tbl_receipt.contract_id');
		$this->db->join('tbl_building','tbl_building.id=tbl_contract.building_id');
		$this->db->join('tbl_tenants','tbl_tenants.id=tbl_contract.tenant_id');
		$this->db->join('tbl_units','tbl_units.id=tbl_contract.unit_id');
		$this->db->where('tbl_contract.status','Active');
		$this->db->where('tbl_receipt.status','Active');
		$data=$this->db->get()->result();		
		return $data;
	}*/





function successMessage($msg) {

		$message='<div class="alert alert-primary" role="alert">'.$msg.'</div>';
		
		$this->session->set_flashdata('message', $message);
	}	



	function errorMessage($msg) {
	    $message='<div class="alert alert-danger" role="alert">'.$msg.'</div>';
		  $this->session->set_flashdata('message', $message);
	}


	function updateuserProfile($data)
	{
		  $json = array();
        $this->db->select("id");
        $this->db->from('tbl_users');
        $this->db->where('status !=', 'Deleted');
        $this->db->where('user_name =', $data['user_name']);
        $result=$this->db->get()->result(); 
       
        if (count($result) > '0') {
            
            $data['updated_on'] = date("Y-m-d H:i:s");
            $data['updated_by'] = $data['first_name'];
            $this->db->where('user_name', $data['user_name']);
            $this->db->update('tbl_users', $data);
            
            $json = array("RESULT"=>'OK', "ERROR"=>' تم التحديث بنجاح ');
        } else {
            $json = array("RESULT"=>'Error', "ERROR"=>'عذرا, البيانات غير موجودة ');
        }
        return $json;
        
    
	}

}
?>