<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tenants_controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); 
		$this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->model('Admin_model');			
		$this->load->model('Tenants_model');
		$this->load->helper(array('form', 'url'));
	}

function index()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {

	$data['tenantList']=$this->Admin_model->getAllTenants();
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');
	$this->load->view('Tenants_panel/tenantlist',$data);
	$this->load->view('Admin_panel/footer.php');
}
}

function addtenants()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');
	$this->load->view('Tenants_panel/addtenant');
	$this->load->view('Admin_panel/footer.php');
}
}


function inserttenantinfo()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		// $file=$this->input->post('file_name');
		// $config['upload_path'] = './img/tenantid/';
		// $config['allowed_types'] = '*';
		// $this->load->library('upload', $config);
		// $this->upload->do_upload('file_name');
		// $up_file_name = $this->upload->data();
		// $fname= $up_file_name['file_name'];

	$data['tenant_firstname']=$this->input->post('firstname');
	//$data['tenant_lastname']=$this->input->post('lastname');
	//$data['tenant_iqama']=$this->input->post('iqama');
	$data['mobile_number']=$this->input->post('mobile');
	//$data['id_copy']=$fname;
	//$data['email']=$this->input->post('tenantemail');
	//$data['status'] = $this->input->post('status');
	$data['created_by'] =  $this->session->userdata('first_name');
	$data['updated_by'] =  $this->session->userdata('first_name');
	$result=$this->Tenants_model->inserttenantDetails($data);


	if ($result['RESULT'] == 'OK'){
			   $this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(TENANTS_PANEL_URL));
		
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(TENANTS_PANEL_URL));
				
			}

}

}


	function tenantdelete() {
		if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$tenantId = $this->uri->segment(3);
			$result=$this->Tenants_model->deletetenantInformation($tenantId);
			if ($result['RESULT'] == 'OK'){
				$this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(TENANTS_PANEL_URL));
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(TENANTS_PANEL_URL));
			}
			
	}
}

function edittenant() {
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$id = $this->uri->segment(3);			
			$data['tenantData'] = $this->Tenants_model->getTenantData($id);
		//	$data['ownerList']=$this->Admin_model->getAllOwners();
			$this->load->view('Admin_panel/header');
		$this->load->view('Admin_panel/leftmenu');
		$this->load->view('Tenants_panel/edittenant', $data);
		$this->load->view('Admin_panel/footer');
}
}

function edittenantinfo() {
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		$oid=$this->input->post('oid');

		//echo $this->input->post('file_name'); die();
		// $config['upload_path'] = './img/tenantid/';
		// $config['allowed_types'] = '*';
		// $this->load->library('upload', $config);
		// $this->upload->do_upload('file_name');
		// $up_file_name = $this->upload->data();
		// $fname= $up_file_name['file_name'];


		$data['tenant_firstname']=$this->input->post('firstname');
		//$data['tenant_lastname']=$this->input->post('lastname');
		//$data['tenant_iqama']=$this->input->post('iqama');
		$data['mobile_number']=$this->input->post('mobile');
		// if($fname==""){
		// 	$data['id_copy']=$this->input->post('filename');
		// }
		// else
		// {
		// $data['id_copy']=$fname;
		// }
		//$data['email']=$this->input->post('tenantemail');
		//$data['status'] = $this->input->post('status');
		//$data['created_by'] = 'Admin';
		$data['updated_by'] =  $this->session->userdata('first_name');
			
			$result=$this->Tenants_model->updateTenantInformation($data, $oid);
			if ($result['RESULT'] == 'OK'){
				$this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(TENANTS_PANEL_URL));
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(TENANTS_PANEL_URL));
			}
		}
		
}

function tenantview()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$id = $this->uri->segment(3);
						
			$data['tenantData'] = $this->Tenants_model->getTenantData($id);
		//	$data['ownerList']=$this->Admin_model->getAllOwners();
			$this->load->view('Admin_panel/header');
		$this->load->view('Admin_panel/leftmenu');
		$this->load->view('Tenants_panel/viewtenant', $data);
		$this->load->view('Admin_panel/footer');
			
}

}





} 
?>