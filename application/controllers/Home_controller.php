<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_controller extends CI_Controller
{
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
		$this->load->helper('api_helper');
	}


	public function index()
	{

		$this->data['page'] = 'index';
		$data['adList'] = $this->Home_model->getAds(0, 0, 0);
		$this->load->vars($this->data);
		$this->load->view($this->data['theme'] . '/template', $data);
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
		$data['msg'] = $this->input->post('message');
		$result = $this->Home_model->sendmail($data);
		if ($result == 1) {
			//$this->session->set_flashdata('msg','<div style="background-color:green;" class="alert alert-success">Mail sent!</div>');
			//echo "<script type='text/javascript'>toastr.success('Have Fun')</script>";
			echo '<script>alert("Mail Sent Successfully! We will contact you soon.");</script>';
			$this->data['page'] = 'index';
			$this->load->vars($this->data);
			$this->load->view($this->data['theme'] . '/template');
		} else {
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

	# api............................................................
	public function advertisement()
	{

		$config = array();

		$config['base_url'] = site_url('advertisements');
		if ($_POST) {
			$total_row = $this->Home_model->countAds($_POST);
		} else {
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

		if ($this->uri->segment(2)) {
			$page = ($this->uri->segment(2));
			$pageLimit = (($page - 1) * $config['per_page']);
		} else {
			$page = 0;
			$pageLimit = ($page * $config['per_page']);
		}

		$data["adList"] = $this->Home_model->getAds($config["per_page"], $pageLimit, $_POST);
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;', $str_links);
		$data["propertyType"] =  $this->Home_model->getPropertyType();
		$data["city"] =  $this->Home_model->getCity();
		$data["district"] =  $this->Home_model->getDistrict();
		if (isset($_POST['purpose'])) {
			$data['searchpurpose'] = $_POST['purpose'];
		} else {
			$data['searchpurpose'] = "";
		}


		if (!empty($_POST['propertyType'])) {
			$data['searchpropertyType'] = $_POST['propertyType'];
		} else {
			$data['searchpropertyType'] = "";
		}

		if (!empty($_POST['district'])) {
			$data['searchdistrict'] = $_POST['district'];
		} else {
			$data['searchdistrict'] = "";
		}

		if (!empty($_POST['startPrice'])) {
			$data['searchstartPrice'] = $_POST['startPrice'];
		} else {
			$data['searchstartPrice'] = "";
		}
		if (!empty($_POST['endPrice'])) {
			$data['searchendPrice'] = $_POST['endPrice'];
		} else {
			$data['searchendPrice'] = "";
		}


		if ($_POST) {
			$data['search'] = 1;
		} else {
			$data['search'] = 0;
		}

		$objSearch = new stdClass;
		$objSearch->link = APIDOMAIN . "/api/v1/realstate-offer-search-params";
		$data['search_params']  = get_api_data($objSearch);
		$this->data['page'] = 'advertisement';
		$apilink = APIDOMAIN . "/api/v1/realstate-offer-list";
		
		$obj = new stdClass;
		$obj->link = $apilink;
		
		if (isset($_POST['search_prop'])) {
			$obj->link = APIDOMAIN . "/api/v1/realstate-offer-search";
			$search['purpose'] = isset($_POST['purpose']) ? $_POST['purpose'] : null;
			$search['property_type'] = isset($_POST['propertyType']) ? $_POST['propertyType'] : null;
			$search['district'] = isset($_POST['district']) ? $_POST['district'] : null;
			$search['start_price'] = isset($_POST['startPrice']) ? $_POST['startPrice'] : null;
			$search['end_price'] = isset($_POST['endPrice']) ? $_POST['endPrice'] : null;
			$search['search_prop'] = isset($_POST['search_prop']) ? $_POST['search_prop'] : 1;
			$obj->search = $search;
			$data['addListFromApi'] = filter_api_data($obj);
			// print_r($data['addListFromApi']);
		}else{
			$data['addListFromApi'] = get_api_data($obj);
		}
		$this->load->vars($this->data);
		$this->load->view($this->data['theme'] . '/template', $data);
	}



	public function viewad()
	{
		$ad_id = $this->uri->segment(2);
		$apilink = APIDOMAIN . "/api/v1/realstate-offer-details/$ad_id";
		$obj = new stdClass;
		$obj->link = $apilink;
		// $data['adDetails'] = $this->Home_model->getAdDetails($ad_id);
		$data['adDetails'] = get_api_data($obj);
		$this->data['page'] = 'showad';
		$this->load->vars($this->data);
		$this->load->view($this->data['theme'] . '/template', $data);
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
