<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); 
		$this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->model('Admin_model');			
		$this->load->model('Payment_model');
		$this->load->helper(array('form', 'url'));
	}


function index()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {

	$data['paymentList']=$this->Payment_model->getAllPaymentInfo();
	//$data['ownerList']=$this->Admin_model->getAllTenants();	
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');
	//$this->load->view('Payment_panel/paymentlist',$data);
	$this->load->view('Payment_panel/paymentlist',$data);
	$this->load->view('Admin_panel/footer.php');
}
}

function addpayment()
{
if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	$data['bankList']=$this->Admin_model->getAllBank();
	$data['ownerList']=$this->Admin_model->getAllOwners();	
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');
	$this->load->view('Payment_panel/addpayment',$data);
	$this->load->view('Admin_panel/footer.php');
}
}

function getbuilding()
{

	if($this->input->post('owner_id'))
	{
		echo $this->Payment_model->fetch_building($this->input->post('owner_id'));
	}
}

function getunits()
{

	if($this->input->post('building_id'))
	{
		echo $this->Payment_model->fetch_units($this->input->post('building_id'));
	}
}

function getpaymentdetails()
{
	if(($this->input->post('unit_id')) && ($this->input->post('building_id')))
	{
		echo $this->Payment_model->fetch_paymentdetails(($this->input->post('unit_id')),($this->input->post('building_id')));
	}

}

function getinstallmentinfo()
{
	$fields=explode("//",$this->input->post('installmentno'));
	if(($this->input->post('unit_id')) && ($this->input->post('building_id')) &&  $fields[0] && $fields[1] )
	{
		echo $this->Payment_model->fetch_installmentdetails(($this->input->post('unit_id')),($this->input->post('building_id')), $fields[0],$fields[1] );
	}
}

function insertpaymentinfo()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	$file=$this->input->post('file_name');
		$config['upload_path'] = './img/payment_document_copy/';
		$config['allowed_types'] = '*';
		$this->load->library('upload', $config);
		$this->upload->do_upload('file_name');
		$up_file_name = $this->upload->data();
		$fname= $up_file_name['file_name'];

	
	//$installmentno=explode("//",$this->input->post('installmentno'));
	$data['installment_number']=$this->input->post('installmentno');
	$data['installment_status']=$this->input->post('installmentstatus');
	$data['contract_id']=$this->input->post('contractno');
	//$data['payment_amount']=$this->input->post('paymentamount');
	
	$a=str_replace(",","", $this->input->post('paymentamount'));
	$data['payment_amount']=($a);
	$data['payment_date']=date('Y-m-d');
	$data['payment_startdate']=$this->input->post('startdate');
	$data['payment_enddate']=$this->input->post('enddate');
	$data['payment_type']=$this->input->post('paymenttype');
	if($this->input->post('paymenttype')!="Cash")
				{
					$data['bank_id']=$this->input->post('bankid');
				}

	$data['document_copy']=$fname;
				
	$data['description']=$this->input->post('desc');
	$data['status'] = 'Active';
	$data['created_by'] =  $this->session->userdata('first_name');
	$data['updated_by'] =  $this->session->userdata('first_name');
	//print_r($data);die();
	$result=$this->Payment_model->insertpaymentDetails($data);
	if ($result['RESULT'] == 'OK'){
		$id=$result['ID'];
			   $this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(PAYMENT_PANEL_URL."payments/".$id));
		
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(PAYMENT_PANEL_URL."payments/".$id));
				
			}

}
}


function payments()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	$id = $this->uri->segment(3);
	$data['paymentList']=$this->Payment_model->getPaymentInfo($id);
	//print_r($data);die();
	//$this->load->view('Admin_panel/header.php');
	//$this->load->view('Admin_panel/leftmenu.php');
	$this->load->view('Payment_panel/payments',$data);
	//$this->load->view('Admin_panel/footer.php');
} }

function paymentview()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$id = $this->uri->segment(3);
						
			$data['paymentData'] = $this->Payment_model->getPaymentInfo($id);
		//	$data['ownerList']=$this->Admin_model->getAllOwners();
			$this->load->view('Admin_panel/header');
		$this->load->view('Admin_panel/leftmenu');
		$this->load->view('Payment_panel/viewpayment', $data);
		$this->load->view('Admin_panel/footer');
			
}

} 
} ?>