<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Owners_controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); 
		$this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->model('Admin_model');			
		$this->load->model('Owner_model');
		$this->load->helper(array('form', 'url'));
	}

function index()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {

	$data['ownerList']=$this->Admin_model->getAllOwners();
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');
	$this->load->view('Owners_panel/ownerslist',$data);
	$this->load->view('Admin_panel/footer.php');
}
}

function addowners()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');
	$this->load->view('Owners_panel/addowner');
	$this->load->view('Admin_panel/footer.php');
}
}


function insertownerinfo()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
// 		$file=$this->input->post('file_name');
// 		$config['upload_path'] = './img/ownerid/';
// 		$config['allowed_types'] = '*';
// 		$this->load->library('upload', $config);
// 		$this->upload->do_upload('file_name');
// 		$up_file_name = $this->upload->data();
// 		$fname= $up_file_name['file_name'];

	$data['owner_firstname']=$this->input->post('firstname');
//	$data['owner_lastname']=$this->input->post('lastname');
//	$data['owner_iqama']=$this->input->post('iqama');
	$data['mobile_number']=$this->input->post('mobile');
//	$data['id_copy']=$fname;	
//	$data['email']=$this->input->post('owneremail');
	//$data['status'] = $this->input->post('status');
	$data['created_by'] =  $this->session->userdata('first_name');
	$data['updated_by'] =  $this->session->userdata('first_name');
	//print_r($data); die();
	$data['created_on'] = date("Y-m-d H:i:s");
	$result=$this->Owner_model->insertownerDetails($data);


	if ($result['RESULT'] == 'OK'){
			   $this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(OWNER_PANEL_URL));
		
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(OWNER_PANEL_URL));
				
			}

}

}


	function ownerdelete() {
		if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$ownerId = $this->uri->segment(3);
			$result=$this->Owner_model->deleteownerInformation($ownerId);
			if ($result['RESULT'] == 'OK'){
				$this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(OWNER_PANEL_URL));
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(OWNER_PANEL_URL));
			}
			
	}

}
function editowner() {
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$id = $this->uri->segment(3);			
			$data['ownerData'] = $this->Owner_model->getOwnerData($id);
		//	$data['ownerList']=$this->Admin_model->getAllOwners();
			$this->load->view('Admin_panel/header');
		$this->load->view('Admin_panel/leftmenu');
		$this->load->view('Owners_panel/editowner', $data);
		$this->load->view('Admin_panel/footer');
}
}

function editownerinfo() {
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		$oid=$this->input->post('oid');

		//echo $this->input->post('file_name'); die();
// 		$config['upload_path'] = './img/ownerid/';
// 		$config['allowed_types'] = '*';
// 		$this->load->library('upload', $config);
// 		$this->upload->do_upload('file_name');
// 		$up_file_name = $this->upload->data();
// 		$fname= $up_file_name['file_name'];


		$data['owner_firstname']=$this->input->post('firstname');
	//	$data['owner_lastname']=$this->input->post('lastname');
	//	$data['owner_iqama']=$this->input->post('iqama');
		$data['mobile_number']=$this->input->post('mobile');
// 		if($fname==""){
// 			$data['id_copy']=$this->input->post('filename');
// 		}
// 		else
// 		{
// 		$data['id_copy']=$fname;
// 		}		
	//	$data['email']=$this->input->post('owneremail');
		//$data['status'] = $this->input->post('status');
		//$data['created_by'] = 'Admin';
		$data['updated_by'] =  $this->session->userdata('first_name');
			
			$result=$this->Owner_model->updateOwnerInformation($data, $oid);
			if ($result['RESULT'] == 'OK'){
				$this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(OWNER_PANEL_URL));
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(OWNER_PANEL_URL));
			}
		}
		
}


function ownerview()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$id = $this->uri->segment(3);
						
			$data['ownerData'] = $this->Owner_model->getOwnerData($id);
		//	$data['ownerList']=$this->Admin_model->getAllOwners();
			$this->load->view('Admin_panel/header');
		$this->load->view('Admin_panel/leftmenu');
		$this->load->view('Owners_panel/viewowner', $data);
		$this->load->view('Admin_panel/footer');
			
}

}



} 
?>