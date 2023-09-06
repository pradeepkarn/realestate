<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses_controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); 
		$this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->model('Admin_model');			
		$this->load->model('Expenses_model');
	}

	function index()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {

	$data['expenseList']=$this->Admin_model->getAllExpenses();
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');
	$this->load->view('Expenses_panel/expenseslist',$data);
	$this->load->view('Admin_panel/footer.php');
}
}

function addexpense()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	$data['buildingList']=$this->Admin_model->getAllBuildings();
	$data['bankList']=$this->Admin_model->getAllBank();
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');
	$this->load->view('Expenses_panel/addexpenses',$data);
	$this->load->view('Admin_panel/footer.php');
}
}

function getunits()
{
	if($this->input->post('building_id'))
	{
		echo $this->Expenses_model->fetch_units($this->input->post('building_id'));
	}
}

function getcontract()
{

	if($this->input->post('unit_id'))
	{
		echo $this->Expenses_model->fetch_contract($this->input->post('building_id'),$this->input->post('unit_id'));
	}
}


function insertexpenseinfo()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
        	if(!empty($this->input->post('file_name')))
        	{
        $file=$this->input->post('file_name');
		$config['upload_path'] = './img/invoice/';
		$config['allowed_types'] = '*';
		$this->load->library('upload', $config);
		$this->upload->do_upload('file_name');
		$up_file_name = $this->upload->data();
		$fname= $up_file_name['file_name'];
	}
	else
	{
		$fname="";
	}
        	$data['expense_type']=$this->input->post('exptype');
        	if(($this->input->post('exptype')!="Salaires")||($this->input->post('exptype')!="Administrative Expenses"))
				{
					$data['building_id']=$this->input->post('buildingid');
					$data['unit_id']=$this->input->post('unitid');
					$data['contract_id']=$this->input->post('contractid');
				}

				if(($this->input->post('exptype')=="Salaires")||($this->input->post('exptype')=="Administrative Expenses"))
				{
					$data['building_id']="";
					$data['unit_id']="";
					$data['contract_id']="";
				}
	
	$data['invoice_number']=$this->input->post('invoiceno');
	$data['date']=$this->input->post('date');

	$data['total_amount']=$this->input->post('totalamount');
	$data['invoice_document']=$fname;
	$data['payment_type']=$this->input->post('paymenttype');
	if($this->input->post('paymenttype')!="Cash")
				{
					$data['bank_id']=$this->input->post('bankid');
				}
	$data['description']=$this->input->post('desc');

	//$data['status'] = 'Active';
	$data['created_by'] =  $this->session->userdata('first_name');
	$data['updated_by']= $this->session->userdata('first_name');

	$result=$this->Expenses_model->insertexpenseDetails($data);


	if ($result['RESULT'] == 'OK'){
			   $this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(EXPENSES_PANEL_URL));
		
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(EXPENSES_PANEL_URL));
				
			}

}

}


	function expensesdelete() {
		if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$expenseId = $this->uri->segment(3);
			$result=$this->Expenses_model->deleteexpenseInformation($expenseId);
			if ($result['RESULT'] == 'OK'){
				$this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(EXPENSES_PANEL_URL));
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(EXPENSES_PANEL_URL));
			}
			
	}
}


function editexpense() {
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$id = $this->uri->segment(3);		
			$data['expenseData']=$this->Expenses_model->getexpenseinfo($id);	
			$data['buildingList']=$this->Admin_model->getAllBuildings();
			$data['bankList']=$this->Admin_model->getAllBank();
			$this->load->view('Admin_panel/header');
		$this->load->view('Admin_panel/leftmenu');
		$this->load->view('Expenses_panel/editexpenses', $data);
		$this->load->view('Admin_panel/footer');
}
}

function editexpensesinfo() {
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {


        		
		$config['upload_path'] = './img/invoice/';
		$config['allowed_types'] = '*';
		$this->load->library('upload', $config);
		$this->upload->do_upload('file_name');
		$up_file_name = $this->upload->data();
		$fname= $up_file_name['file_name'];

		$eid=$this->input->post('oid');
	$data['expense_type']=$this->input->post('exptype');
	if(($this->input->post('exptype')!="Salaires")||($this->input->post('exptype')!="Administrative Expenses"))
				{
					$data['building_id']=$this->input->post('buildingid');
					$data['unit_id']=$this->input->post('unitid');
				}

				if(($this->input->post('exptype')=="Salaires")||($this->input->post('exptype')=="Administrative Expenses"))
				{
					$data['building_id']="";
					$data['unit_id']="";
				}
	
	//$data['building_id']=$this->input->post('buildingid');
	//$data['unit_id']=$this->input->post('unitid');
	$data['invoice_number']=$this->input->post('invoiceno');
	$data['date']=$this->input->post('date');
	$data['total_amount']=$this->input->post('totalamount');
	if($fname==""){
			$data['invoice_document']=$this->input->post('filename');
		}
		else
		{
		$data['invoice_document']=$fname;
		}
	$data['payment_type']=$this->input->post('paymenttype');
	if($this->input->post('paymenttype')!="Cash")
				{
					$data['bank_id']=$this->input->post('bankid');
				}
				if($this->input->post('paymenttype')=="Cash")
				{
					$data['bank_id']="";
				}
	$data['description']=$this->input->post('desc');

	//$data['status'] = 'Active';
	//$data['created_by'] = 'admin';
	$data['updated_by']= $this->session->userdata('first_name');
	$result=$this->Expenses_model->updateExpInformation($data, $eid);
			if ($result['RESULT'] == 'OK'){
				$this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(EXPENSES_PANEL_URL));
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(EXPENSES_PANEL_URL));
			}
		}

}

function expenseview()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$id = $this->uri->segment(3);
						
			$data['expenseData'] = $this->Expenses_model->getexpenseinfo($id);
		//	$data['ownerList']=$this->Admin_model->getAllOwners();
			$this->load->view('Admin_panel/header');
		$this->load->view('Admin_panel/leftmenu');
		$this->load->view('Expenses_panel/viewexpense', $data);
		$this->load->view('Admin_panel/footer');
			
}

}

} ?>