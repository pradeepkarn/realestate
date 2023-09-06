<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tenants_model extends CI_Model{

	var $tableName="tbl_tenants";

function __construct() {
		parent::__construct();
		$this->load->database(); 

	}


function inserttenantDetails($data) {
	
		$json = array();
		$this->db->select("id");
		$this->db->from($this->tableName);
		$this->db->where('tenant_iqama',$data['tenant_iqama']);
		$this->db->where('status !=', 'Deleted');
		$result=$this->db->get()->result();	
		if (count($result) == '0') {			
			$data['created_on'] = date("Y-m-d H:i:s");
			//$data['createdby'] = $this->session->userdata('adminUserName');
			//$data['updatedon'] = date("Y-m-d H:i:s");
			//$data['updatedby'] = $this->session->userdata('adminUserName');
			$this->db->insert($this->tableName, $data);
			$json = array("RESULT"=>'OK', "ERROR"=>'You have successfully created new Tenant information');
		} else {
			$json = array("RESULT"=>'Error', "ERROR"=>'Tenant Information already existed');
		}
		return $json;
	}



function deletetenantInformation($id) {
	
		$json = array();		
		$this->db->select("tenant_firstname");
		$this->db->from($this->tableName);
		$this->db->where('id', $id);
		$this->db->where('status !=', 'Deleted');
		$result=$this->db->get()->result();	
		if (count($result) > 0) {
			$data['status']='Deleted';
			$this->db->where('id', $id);
			$this->db->update($this->tableName, $data);	
			//$this->db->where('id', $id);
			//$this->db->update('tbl_building', array('status' => 'Deleted'));		

			$json = array("RESULT"=>'OK', "ERROR"=>'You have successfully deleted Tenant information');
		} else {
			$json = array("RESULT"=>'Error', "ERROR"=>'Tenant information not available');
		}		
		return $json;
		
	}

function getTenantData($id) {
		$this->db->select("*");
		$this->db->from($this->tableName);
		$this->db->where('id',$id);
		$data=$this->db->get()->result();	
		return $data;
	}



function updateTenantInformation($data, $id) {
	
		$json = array();
		$this->db->select("id");
		$this->db->from($this->tableName);
		//$this->db->where('building_name',$data['building_name']);
		$this->db->where('status !=', 'Deleted');
		$this->db->where('id =', $id);
		$result=$this->db->get()->result();	
		if (count($result) > '0') {
			
			$data['updated_on'] = date("Y-m-d H:i:s");
			$data['updated_by'] = 'Admin';
			$this->db->where('id', $id);
			$this->db->update($this->tableName, $data);
			
			$json = array("RESULT"=>'OK', "ERROR"=>'You have successfully updated Tenant information');
		} else {
			$json = array("RESULT"=>'Error', "ERROR"=>'No Tenant name available');
		}
		return $json;
		
	}


}
?>