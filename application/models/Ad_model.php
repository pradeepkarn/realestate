<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ad_model extends CI_Model{

	var $tableName="tbl_ad";

	function __construct() {
		parent::__construct();
		$this->load->database(); 

	}
	function getAllAd() {
		$this->db->select("*");
		$this->db->from($this->tableName);
		$this->db->where('status','Active');
		$this->db->order_by('id','Desc');
		$data=$this->db->get()->result();	
		return $data;
	}
	
		function getArchivedAd() {
		$this->db->select("*");
		$this->db->from($this->tableName);
		$this->db->where('status','Inactive');
		$this->db->order_by('id','Desc');
		$data=$this->db->get()->result();	
		return $data;
	}

	function insertadDetails($data) {
	
		$json = array();		 			
		$data['updatedDateTime'] = date("Y-m-d H:i:s");
		$this->db->insert($this->tableName, $data);		
		return $this->db->insert_id();
	}

	function insertadImageDetails($data) {
	
		$json = array();		 			
		$this->db->insert('tbl_adimages', $data);
		$json = array("RESULT"=>'OK', "ERROR"=>' Image Added Successfully');		
		return $json;
	}


	function deleteadInformation($id) {
	
		$json = array();		
		
			$data['status']='Deleted';
			$data['updatedDateTime'] = date("Y-m-d H:i:s");
			$data['updatedBy'] = $this->session->userdata('first_name');
			$this->db->where('id', $id);
			$this->db->update($this->tableName, $data);	
			$json = array("RESULT"=>'OK', "ERROR"=>'تم حذف البيانات بنجاح ');
			
		return $json;
		
	}
	
		function archiveadInformation($id) {
	
		$json = array();		
		
			$data['status']='Inactive';
			$data['updatedDateTime'] = date("Y-m-d H:i:s");
			$data['updatedBy'] = $this->session->userdata('first_name');
			$this->db->where('id', $id);
			$this->db->update($this->tableName, $data);	
			$json = array("RESULT"=>'OK', "ERROR"=>' تمت أرشفة الإعلان بنجاح   ');
			return $json;
		
	}

	function deleteImageDetails($id) {
	
		$json = array();		
			 $this -> db -> where('adId', $id);
    		$this -> db -> delete('tbl_adimages');
			$json = array("RESULT"=>'OK', "ERROR"=>'تم حذف البيانات بنجاح ');			
		return $json;		
	}

function getAdData($id) {
		$this->db->select("GROUP_CONCAT(tbl_adimages.fileName) as file_name,tbl_ad.id as adid,tbl_ad.*,tbl_adimages.*");
		$this->db->from('tbl_ad');
		$this->db->join('tbl_adimages','tbl_adimages.adId=tbl_ad.id','left');
		$this->db->where('tbl_ad.id',$id);
		$this->db->where('tbl_ad.status','Active');
		$data=$this->db->get()->result();	
		return $data;
	}

	function updateAdInformation($data, $id) {
	 
		$json = array();
		$this->db->where('id', $id);
		$this->db->update($this->tableName, $data);
		$json = array("RESULT"=>'OK', "ERROR"=>'تم التحديث بنجاح ');
		return $json;
		
	}

	function activateadInformation($id) {
	
		$json = array();		
		
			$data['status']='Active';
			$data['updatedDateTime'] = date("Y-m-d H:i:s");
			$data['updatedBy'] = $this->session->userdata('first_name');
			$this->db->where('id', $id);
			$this->db->update($this->tableName, $data);	
			$json = array("RESULT"=>'OK', "ERROR"=>'  تم تفعيل الإعلان بنجاح   ');
			return $json;
		
	}

}
?>