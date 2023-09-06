<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); 
		$this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->model('Admin_model');			
		$this->load->model('Bank_model');
		$this->load->helper(array('form', 'url'));
	}

function index()
{
 //$this->ajax_checking();
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	$data['bankList']=$this->Admin_model->getAllBank();
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');
	$this->load->view('Bank_panel/banklist',$data);
	$this->load->view('Admin_panel/footer.php');
}
}


function addbank()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');
	$this->load->view('Bank_panel/addbank');
	$this->load->view('Admin_panel/footer.php');
}
}


function insertbankinfo()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	$data['bank_name']=$this->input->post('bankname');
	$data['beneficiary_name']=$this->input->post('bname');
	$data['account_number']=$this->input->post('accno');
	$data['status'] = 'Active';
	$data['created_by'] = $this->session->userdata('first_name');
	$data['updated_by'] = $this->session->userdata('first_name');
	$result=$this->Bank_model->insertbankDetails($data);
	if ($result['RESULT'] == 'OK'){
			   $this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(BANK_PANEL_URL));
		
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(BANK_PANEL_URL));
				
			}

}


}

	function bankdelete() {
		
			if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
			$bankId = $this->uri->segment(3);
			$result=$this->Bank_model->deletebankInformation($bankId);
			if ($result['RESULT'] == 'OK'){
				$this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(BANK_PANEL_URL));
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(BANK_PANEL_URL));
			}
			
	}
}
function editbank() {
		
		if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
			$id = $this->uri->segment(3);			
			$data['bankData'] = $this->Bank_model->getBankData($id);
		//	$data['ownerList']=$this->Admin_model->getAllOwners();
			$this->load->view('Admin_panel/header');
		$this->load->view('Admin_panel/leftmenu');
		$this->load->view('Bank_panel/editbank', $data);
		$this->load->view('Admin_panel/footer');
}
}

function editbankinfo() {

	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		$bankid=$this->input->post('oid');
		$data['bank_name']=$this->input->post('bankname');
		$data['beneficiary_name']=$this->input->post('bname');
		$data['account_number']=$this->input->post('accno');
		//$data['created_by'] = $this->session->userdata('first_name');
		$data['updated_by'] = $this->session->userdata('first_name');
			
			$result=$this->Bank_model->updateBankInformation($data, $bankid);
			if ($result['RESULT'] == 'OK'){
				$this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(BANK_PANEL_URL));
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(BANK_PANEL_URL));
			}
		}
}


function bankview()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$id = $this->uri->segment(3);
						
			$data['bankData'] = $this->Bank_model->getBankData($id);
		//	$data['ownerList']=$this->Admin_model->getAllOwners();
			$this->load->view('Admin_panel/header');
		$this->load->view('Admin_panel/leftmenu');
		$this->load->view('Bank_panel/viewbank', $data);
		$this->load->view('Admin_panel/footer');
			
}

}


} 
?>