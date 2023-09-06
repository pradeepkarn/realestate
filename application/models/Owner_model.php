<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Owner_model extends CI_Model{

	var $tableName="tbl_owner";

function __construct() {
		parent::__construct();
		$this->load->database(); 

	}


function insertownerDetails($data) {
	
		$json = array();
		//print_r($data); //die();
		$this->db->select("id");
		$this->db->from($this->tableName);
	//	$this->db->where('owner_iqama',$data['owner_iqama']);
	$this->db->where('owner_firstname',$data['owner_firstname']);
		$this->db->where('status !=', 'Deleted');
		$result=$this->db->get()->result();	
		if (count($result) == '0') {			
			
			//$data['createdby'] = $this->session->userdata('adminUserName');
			//$data['updatedon'] = date("Y-m-d H:i:s");
			//$data['updatedby'] = $this->session->userdata('adminUserName');
			$this->db->insert($this->tableName, $data); //die();
			$json = array("RESULT"=>'OK', "ERROR"=>'تمت اضافة بيانات جديدة بنجاح  ');
		} else {
			$json = array("RESULT"=>'Error', "ERROR"=>'  البيانات موجودة مسبقا ');
		
	}
	return $json;
}

function deleteownerInformation($id) {
	
		$json = array();		
		$this->db->select("owner_firstname");
		$this->db->from($this->tableName);
		$this->db->where('id', $id);
		$this->db->where('status !=', 'Deleted');
		$result=$this->db->get()->result();	
		if (count($result) > 0) {
			$data['status']='Deleted';
			$data['updated_on'] = date("Y-m-d H:i:s");
			$data['updated_by'] =  $this->session->userdata('first_name');
			$this->db->where('id', $id);
			$this->db->update($this->tableName, $data);	
			//$this->db->where('id', $id);
			//$this->db->update('tbl_building', array('status' => 'Deleted'));		

			$json = array("RESULT"=>'OK', "ERROR"=>'تم حذف البيانات بنجاح ');
		} else {
			$json = array("RESULT"=>'Error', "ERROR"=>' عذرا, البيانات غير موجودة ');
		}		
		return $json;
		
	}

function getOwnerData($id) {
		$this->db->select("*");
		$this->db->from($this->tableName);
		$this->db->where('id',$id);
			$this->db->where('status','Active');
		$data=$this->db->get()->result();	
		return $data;
	}



function updateOwnerInformation($data, $id) {
	
		$json = array();
		$this->db->select("id");
		$this->db->from($this->tableName);
		//$this->db->where('building_name',$data['building_name']);
		$this->db->where('status !=', 'Deleted');
		$this->db->where('id =', $id);
		$result=$this->db->get()->result();	
		if (count($result) > '0') {
			
			$data['updated_on'] = date("Y-m-d H:i:s");
			$data['updated_by'] =  $this->session->userdata('first_name');
			$this->db->where('id', $id);
			$this->db->update($this->tableName, $data);
			
			$json = array("RESULT"=>'OK', "ERROR"=>'تم التحديث بنجاح ');
		} else {
			$json = array("RESULT"=>'Error', "ERROR"=>' عذرا, البيانات غير موجودة ');
		}
		return $json;
		
	}



}
?>