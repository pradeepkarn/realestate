<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); 
		$this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->model('Home_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('pagination');
		$this->data['theme'] = 'web';
		$this->data['module'] = 'home';
		$this->data['page'] = '';
		$this->data['base_url'] = base_url();
		$this->load->library('session');
	}


	public function index() {
	
		$this->data['page'] = 'index';	
		$data['adList']=$this->Home_model->getAds(0,0,0);	 
		$this->load->vars($this->data);
		$this->load->view($this->data['theme'] . '/template',$data);
	}

	public function aboutus()
	{
 		$this->data['page'] = 'aboutus';
 		$this->load->vars($this->data);
		$this->load->view($this->data['theme'] . '/template');
			
	}

	public function contactus()
	{
 		$this->data['page'] = 'contactus';
		$this->load->vars($this->data);
		$this->load->view($this->data['theme'] . '/template');
			
	}
	public function contactussubmit()
	{
		
		$data['name'] = $this->input->post('name');
 		$data['email'] = $this->input->post('email');
 		$data['mobile'] = $this->input->post('mobile');
		$data['msg']= $this->input->post('message');
		 $result=$this->Home_model->sendmail($data);
		 if($result==1)
		 {
		 		//$this->session->set_flashdata('msg','<div style="background-color:green;" class="alert alert-success">Mail sent!</div>');
		 		//echo "<script type='text/javascript'>toastr.success('Have Fun')</script>";
		 	echo '<script>alert("Mail Sent Successfully! We will contact you soon.");</script>';
    				$this->data['page'] = 'index';
 		$this->load->vars($this->data);
		$this->load->view($this->data['theme'] . '/template');
		 }
		 else
		 {
		 	echo '<script>alert("Something went wrong. Please try again");</script>';
    				$this->data['page'] = 'index';
 		$this->load->vars($this->data);
		$this->load->view($this->data['theme'] . '/template');
		 }
		}
		
	
	public function staff()
	{
 		$this->data['page'] = 'staff';
		$this->load->vars($this->data);
		$this->load->view($this->data['theme'] . '/template');
			
	}

	public function advertisement()
	{

		$config = array();
	 
	$config['base_url'] = site_url('advertisements');
	if($_POST)
	{
		$total_row = $this->Home_model->countAds($_POST);
	}
	else
	{
		$total_row = $this->Home_model->countAds();
	}

	$config["total_rows"] = $total_row[0]->countads;
	$config["per_page"] = 6;
	$config['use_page_numbers'] = TRUE;
	$config['num_links'] = $total_row;
	 $config['full_tag_open'] = "<ul class='pagination'>";
    $config['full_tag_close'] = '</ul>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['first_link'] = 'الأولى';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    
    $config['last_link'] = 'الأخيرة';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';



    $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i> الصفحة السابقة ';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';


    $config['next_link'] = ' الصفحة التالية <i class="fa fa-long-arrow-right"></i>';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
	$config["uri_segment"] = 2;
   $this->pagination->initialize($config);
    
if($this->uri->segment(2)){
$page = ($this->uri->segment(2)) ;
$pageLimit = (($page-1)*$config['per_page']); 
}
else{
$page = 0;
$pageLimit = ($page*$config['per_page']); 
}
  
$data["adList"] = $this->Home_model->getAds($config["per_page"], $pageLimit,$_POST);
$str_links = $this->pagination->create_links(); 
$data["links"] = explode('&nbsp;',$str_links );
$data["propertyType"] =  $this->Home_model->getPropertyType();
$data["city"] =  $this->Home_model->getCity();
$data["district"] =  $this->Home_model->getDistrict();
  if ( isset($_POST['purpose'])) 
 { 
	 $data['searchpurpose']= $_POST['purpose'];
 }
 else
 {
 	$data['searchpurpose']="";
 }


  if ( ! empty($_POST['propertyType'])) 
 { 
	 $data['searchpropertyType']= $_POST['propertyType'];
 } 
 else
 {
 	$data['searchpropertyType']= "";
 }

 if ( ! empty($_POST['district'])) 
 { 
	 $data['searchdistrict']= $_POST['district'];
 }
 else
 {
 	$data['searchdistrict']="";
 }

 if ( ! empty($_POST['startPrice'])) 
 { 
	 $data['searchstartPrice']= $_POST['startPrice'];
 }
 else
 {
 	$data['searchstartPrice']="";
 }
if ( ! empty($_POST['endPrice'])) 
 { 
	 $data['searchendPrice']= $_POST['endPrice'];
 }
 else
 {
 	$data['searchendPrice']= "";
 }

 
if($_POST)
{
	$data['search']=1;
}
else
{
	$data['search']=0;	
}
$this->data['page'] = 'advertisement'; 
//print_r($data); die();

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, "https://alyanabea.com/webart/api/v1/realstate-offer-list");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Ignore SSL certificate verification (use with caution)

// Execute cURL session and get the response
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
}

// Close cURL session
curl_close($ch);

// Output the response
if ($response) {
	$res = json_decode($response);
	if ($res->success==1) {
		$data['addListFromApi'] = $res->data;
	}else{
		$data['addListFromApi'] = [];
	}
    
} else {
    $data['addListFromApi'] = [];
}


$this->load->vars($this->data);
$this->load->view($this->data['theme'] . '/template',$data);
}	
	 

	 
public function viewad()
	{
		 
		$ad_id =$this->uri->segment(2);
		$data['adDetails'] = $this->Home_model->getAdDetails($ad_id);
 		$this->data['page'] = 'showad';
		$this->load->vars($this->data);
		$this->load->view($this->data['theme'] . '/template',$data);
		$this->add_count($ad_id);
			
	} 

	function add_count($slug)
{
 // load cookie helper
    $this->load->helper('cookie');
// this line will return the cookie which has slug name
  $check_visitor = $this->input->cookie(($slug), FALSE);
// this line will return the visitor ip address
    // $ip = $this->input->ip_address();

    // if ($check_visitor == false) {
    //     $cookie = array(
    //         "name"   => urldecode($slug),
    //         "value"  => "$ip",
    //         "expire" =>  time() + 7200,
    //         "secure" => false
    //     );
         
    //     $this->input->set_cookie($cookie);
        $this->Home_model->update_counter($slug);
    //}
}



}
