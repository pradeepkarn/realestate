<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bank_model extends CI_Model{

	var $tableName="tbl_bank";

function __construct() {
		parent::__construct();
		$this->load->database(); 

	}


function insertbankDetails($data) {
	
		$json = array();
		$this->db->select("id");
		$this->db->from($this->tableName);
		$this->db->where('bank_name',$data['bank_name']);
		$this->db->where('beneficiary_name',$data['beneficiary_name']);
		$this->db->where('status !=', 'Deleted');
		$result=$this->db->get()->result();	
		if (count($result) == '0') {			
			$data['created_on'] = date("Y-m-d H:i:s");
			$data['updated_on'] = date("Y-m-d H:i:s");
			$this->db->insert($this->tableName, $data);
			$json = array("RESULT"=>'OK', "ERROR"=>' تمت اضافة بيانات جديدة بنجاح  ');
		} else {
			$json = array("RESULT"=>'Error', "ERROR"=>'البيانات موجودة مسبقا ');
		}
		return $json;
	}



function deletebankInformation($id) {
	
		$json = array();		
		$this->db->select("bank_name");
		
		$this->db->from($this->tableName);
		$this->db->where('id', $id);
		$this->db->where('status !=', 'Deleted');
		$result=$this->db->get()->result();	
		if (count($result) > 0) {
			$data['status']='Deleted';
			$data['updated_on'] = date("Y-m-d H:i:s");
			$data['updated_by'] = $this->session->userdata('first_name');
			$this->db->where('id', $id);
			$this->db->update($this->tableName, $data);	
			//$this->db->where('id', $id);
			//$this->db->update('tbl_building', array('status' => 'Deleted'));		

			$json = array("RESULT"=>'OK', "ERROR"=>'تم حذف البيانات بنجاح ');
		} else {
			$json = array("RESULT"=>'Error', "ERROR"=>'عذرا, البيانات غير موجودة ');
		}		
		return $json;
		
	}

function getBankData($id) {
		$this->db->select("*");
		$this->db->from($this->tableName);
		$this->db->where('id',$id);
		$this->db->where('status','Active');
		$data=$this->db->get()->result();	
		return $data;
	}



function updateBankInformation($data, $id) {
	
		$json = array();
		$this->db->select("id");
		$this->db->from($this->tableName);
		//$this->db->where('building_name',$data['building_name']);
		$this->db->where('status !=', 'Deleted');
		$this->db->where('id =', $id);
		$result=$this->db->get()->result();	
		if (count($result) > '0') {
			
			$data['updated_on'] = date("Y-m-d H:i:s");
			$data['updated_by'] = $this->session->userdata('first_name');
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