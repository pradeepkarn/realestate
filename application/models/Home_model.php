<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home_model extends CI_Model{
    var $tableName="tbl_ad";

function __construct() {
        parent::__construct();
        $this->load->database(); 

    }
function getAds($limit,$start,$data)
{        
          
        $this->db->select("tbl_ad.*,tbl_adimages.*,tbl_ad.id as adid");
        $this->db->from('tbl_ad');
        $this->db->join('tbl_adimages','tbl_ad.id=tbl_adimages.adId','left');
        $this->db->where('tbl_ad.status', 'Active');         
        $this->db->where('tbl_ad.showWebsite', '1'); 
         if(($data))
           {
            if ( ! empty($data['purpose'])) 
            {
              $this->db->where('purpose =',$data['purpose']);
            } 
            if ( ! empty($data['propertyType'])) 
            {
              $this->db->where('propertyType =',$data['propertyType']);
            }
            if ( ! empty($data['district'])) 
            {
              $this->db->where('district =',$data['district']);
            } 
            if ( ! empty($data['startPrice'])) 
            {
              $this->db->where('amount >=',$data['startPrice']);
            } 
            if ( ! empty($data['endPrice'])) 
            {
              $this->db->where('amount <=',$data['endPrice']);
            } 

           
           } 
           else
           {
            $this->db->limit($limit, $start);
           }
        $this->db->group_by('tbl_ad.id');
 
     //print_r($this->db->get()->result()); die(); 
        return $this->db->get()->result(); 
                    
}

function countAds($data="")
{        
        $this->db->select("count(*)as countads");
        $this->db->from('tbl_ad');
         
        $this->db->where('tbl_ad.status', 'Active'); 
       
        $this->db->where('tbl_ad.showWebsite', '1');
        if(($data))
           {
            if ( ! empty($data['purpose'])) 
            {
              $this->db->where('purpose =',$data['purpose']);
            } 
            if ( ! empty($data['propertyType'])) 
            {
              $this->db->where('propertyType =',$data['propertyType']);
            }
            if ( ! empty($data['district'])) 
            {
              $this->db->where('district =',$data['district']);
            } 
            if ( ! empty($data['startPrice'])) 
            {
              $this->db->where('amount >=',$data['startPrice']);
            } 
            if ( ! empty($data['endPrice'])) 
            {
              $this->db->where('amount <=',$data['endPrice']);
            } 


           } 


        return $this->db->get()->result(); 
                    
}




public function sendmail($info)
{
    $this->load->library('email');
        $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                   );
        $this->email->initialize($config);
   
      $this->email->set_newline("\r\n");
      $this->email->from($info['email']); // change it to yours
      $this->email->to('info@alyanabea.com');// change it to yours
      $this->email->subject('Enquiry regarding an advertisement');
      $message = '<html><body>';
      $message .= '<h1>Enquiry!</h1>';
      $message .= '</body></html>';
      $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
      $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($info['name']) . "</td></tr>";
      $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($info['email']) . "</td></tr>";
       $message .= "<tr style='background: #eee;'><td><strong>Phone:</strong> </td><td>" . strip_tags($info['mobile']) . "</td></tr>";
      $message .= "<tr><td><strong>Message:</strong> </td><td>" . strip_tags($info['msg']) . "</td></tr>"; 
      $message .= "</table>";
      $message .= "</body></html>";
      $this->email->message($message);
      if($this->email->send())
     {
      
        return true;
     }
     else
    {
    
        return false;
    }
}
 


public function getAdDetails($id)
    {
        $this->db->select("GROUP_CONCAT(tbl_adimages.fileName) as images,tbl_ad.*,tbl_adimages.*,tbl_ad.id as adid,");
        $this->db->from('tbl_ad');
        $this->db->join('tbl_adimages','tbl_ad.id=tbl_adimages.adId','left');
        $this->db->where('tbl_ad.status', 'Active'); 
        $this->db->where('tbl_adimages.status', 'Active');
        $this->db->where('tbl_ad.showWebsite', '1'); 
        $this->db->where('tbl_ad.id', $id);   
        return $this->db->get()->row_array();
    }

    function update_counter($slug) {
 
    $this->db->where('id', $slug);
    $this->db->select('visits');
    $count = $this->db->get('tbl_ad')->row();
    $this->db->where('id', $slug);
    if(isset($count))
     {
    $this->db->set('visits', ($count->visits + 1));
    $this->db->update('tbl_ad');
}
}

public function getPropertyType()
    {
        $this->db->select("DISTINCT(propertyType)as ptype");
        $this->db->from('tbl_ad');        
        $this->db->where('tbl_ad.status', 'Active');         
        return $this->db->get()->result();
    }

    public function getCity()
    {
        $this->db->select("DISTINCT(city)as city");
        $this->db->from('tbl_ad');        
        $this->db->where('tbl_ad.status', 'Active');         
        return $this->db->get()->result();
    }
public function getDistrict()
    {
        $this->db->select("DISTINCT(district)as district");
        $this->db->from('tbl_ad');        
        $this->db->where('tbl_ad.status', 'Active');         
        return $this->db->get()->result();
    }



	
}

?>