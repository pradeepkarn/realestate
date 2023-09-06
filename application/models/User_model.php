<?php

    /******************************************
    *      Codeigniter 3 Simple Login         *
    *   Developer  :  rudiliucs1@gmail.com    *
    *        Copyright © 2017 Rudi Liu        *
    *******************************************/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User_model extends CI_Model {

    var $tableName="tbl_users";

    function __construct() {
        parent::__construct();
    }
function insertuserDetails($data) {
    
        $json = array();
        $this->db->select("*");
        $this->db->from($this->tableName);
        $this->db->where('user_name',$data['user_name']);
        //$this->db->where('beneficiary_name',$data['beneficiary_name']);
        $this->db->where('status !=', 'Deleted');
        $result=$this->db->get()->result(); 
        if (count($result) == '0') {            
            $data['created_on'] = date("Y-m-d H:i:s");
            //$data['updated_on'] = date("Y-m-d H:i:s");
            $this->db->insert($this->tableName, $data);
            $json = array("RESULT"=>'OK', "ERROR"=>'تمت اضافة بيانات جديدة بنجاح ');
        } else {
            $json = array("RESULT"=>'Error', "ERROR"=>' البيانات موجودة مسبقا ');
        }
        return $json;
    }


function deleteuserInformation($id) {
    
        $json = array();        
        $this->db->select("user_name");
        
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

            $json = array("RESULT"=>'OK', "ERROR"=>'تم حذف البيانات بنجاح  ');
        } else {
            $json = array("RESULT"=>'Error', "ERROR"=>'عذرا, البيانات غير موجودة ');
        }       
        return $json;
        
    }



    function getUserData($id) {
        $this->db->select("*");
        $this->db->from($this->tableName);
        $this->db->where('id',$id);
         $this->db->where('status','Active');
        $data=$this->db->get()->result();   
        return $data;
    }



function updateUserInformation($data,$id) {
    
        $json = array();
        $this->db->select("id");
        $this->db->from($this->tableName);
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

