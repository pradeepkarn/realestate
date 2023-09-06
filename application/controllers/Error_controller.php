<?php
class Error_controller extends CI_Controller
{
	public function __construct()
	
	{
		parent::__construct();
	}

	   public function index()
   {
       $this->output->set_status_header('404');
       $this->load->view('Admin_panel/header');
       $this->load->view('Admin_panel/leftmenu');
		$this->load->view('Admin_panel/error404');
		$this->load->view('Admin_panel/footer');
       //$this->load->view('frontpanel/error404'); 


   }
}

