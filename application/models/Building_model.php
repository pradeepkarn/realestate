<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Building_model extends CI_Model{

	var $tableName="tbl_building";

function __construct() {
		parent::__construct();
		$this->load->database(); 

	}


function insertbuildingDetails($data) {
	
		$json = array();
		$this->db->select("id");
		$this->db->from($this->tableName);
		$this->db->where('building_name',$data['building_name']);
		$this->db->where('address',$data['address']);
		$this->db->where('building_type',$data['building_type']);
		$this->db->where('status !=', 'Deleted');
		$result=$this->db->get()->result();	
		if (count($result) == '0') {			
			$data['created_on'] = date("Y-m-d H:i:s");
			$data['created_by'] = $this->session->userdata('first_name');
			$data['updated_on'] = date("Y-m-d H:i:s");
			$data['updated_by'] = $this->session->userdata('first_name');
			$this->db->insert($this->tableName, $data);
			$json = array("RESULT"=>'OK', "ERROR"=>'تمت اضافة بيانات جديدة بنجاح ');
		} else {
			$json = array("RESULT"=>'Error', "ERROR"=>' البيانات موجودة مسبقا ');
		}
		return $json;
	}


function getAllBuildingsinfo()
	{
		$this->db->select("tbl_building.id as bid,tbl_building.*,tbl_owner.owner_firstname,tbl_building.id as buildingid");
		$this->db->from("tbl_building");
		//$this->db->join('tbl_area','tbl_area.id=tbl_building.area_id');
		$this->db->join('tbl_owner','tbl_owner.id=tbl_building.owner_id');
		$this->db->where('tbl_building.status','Active');
		$this->db->order_by("tbl_building.id", "desc");
		$data=$this->db->get()->result();
		return $data;
	}

function deletebuildingInformation($id) {
	
		$json = array();		
		$this->db->select("building_name");
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
			$json = array("RESULT"=>'Error', "ERROR"=>' عذرا, البيانات غير موجودة ');
		}		
		return $json;
		
	}

function getBuildingData($id) {
		$data="";
		//
		$this->db->select("tbl_building.id as bid,tbl_building.*,tbl_owner.*");
		$this->db->from($this->tableName);
		$this->db->where('tbl_building.id',$id);
		$this->db->where('tbl_building.status','Active');
		$this->db->join('tbl_owner','tbl_building.owner_id=tbl_owner.id','left');
		$data=$this->db->get()->result();	
		//print_r($data); die();
		return $data;
	}



function updateBuildingInformation($data, $id) {
	//print_r($data); echo $id; die();
		$json = array();	
			
			$this->db->where('id', $id);
			$this->db->update($this->tableName, $data);			
			$json = array("RESULT"=>'OK', "ERROR"=>' تم التحديث بنجاح ');
		 
		return $json;
		
	}
	



}
?>