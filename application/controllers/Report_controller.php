<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); 
		$this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->model('Ad_model');
		$this->load->model('Admin_model');	
		$this->load->library('upload');	
		$this->load->helper(array('form', 'url'));		
		 
	}

	function index()
	{

	 	if(!$this->session->userdata('isAdminLogin') ) {
	        	redirect(base_url(ADMIN_PANEL_URL));	
	        }
        else
        {
			 
			$this->load->view('Admin_panel/header.php');
			$this->load->view('Admin_panel/leftmenu.php');
			$this->load->view('Report_panel/report');
			$this->load->view('Admin_panel/footer.php');
		}
	}

 

} ?>