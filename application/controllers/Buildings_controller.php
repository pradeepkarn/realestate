<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buildings_controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); 
		$this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->model('Admin_model');			
		$this->load->model('Building_model');
	}

function index()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {

	$data['buildingList']=$this->Building_model->getAllbuildingsinfo();
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');
	$this->load->view('Building_panel/buildinglist',$data);
	$this->load->view('Admin_panel/footer.php');
}
}

function addbuildings()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	$data['ownerList']=$this->Admin_model->getAllOwners();
	//$data['areaList']=$this->Admin_model->getAllAreas();
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');
	$this->load->view('Building_panel/addbuilding',$data);
	$this->load->view('Admin_panel/footer.php');
}
}

function insertbuildinginfo()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	$data['building_type']=$this->input->post('buildingtype');
	$data['owner_id']=$this->input->post('ownerid');
	$data['building_name']=$this->input->post('buildingname');

	$data['no_of_housing_units']=$this->input->post('noofhouse');
	$data['no_of_commercial_units']=$this->input->post('noofcommercial');

	$data['building_location']=$this->input->post('buildinglocation');
	$data['address']=$this->input->post('address');
	//$data['agreement_percentage']=$this->input->post('agreementpercent');
	//$data['status'] = $this->input->post('status');
	$data['created_by'] = $this->session->userdata('first_name');
	//print_r($data);die();
	$result=$this->Building_model->insertbuildingDetails($data);


	if ($result['RESULT'] == 'OK'){
			   $this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(BUILDING_PANEL_URL));
		
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(BUILDING_PANEL_URL));
				
			}

}

}


	function buildingdelete() {
		if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$buildingId = $this->uri->segment(3);
			$result=$this->Building_model->deletebuildingInformation($buildingId);
			if ($result['RESULT'] == 'OK'){
				$this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(BUILDING_PANEL_URL));
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(BUILDING_PANEL_URL));
			}
			
	}
}


function editbuilding() {
		
		if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
			$id = $this->uri->segment(3);			
			$data['buildingData'] = $this->Building_model->getBuildingData($id);
			$data['ownerList']=$this->Admin_model->getAllOwners();
			$this->load->view('Admin_panel/header');
		$this->load->view('Admin_panel/leftmenu');
		$this->load->view('Building_panel/editbuilding', $data);
		$this->load->view('Admin_panel/footer');
			
	}		
			
	}
	
	function updateBuildingInfo() {
		if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		$bid=$this->input->post('bid');
		
		$data['building_type']=$this->input->post('buildingtype');
	$data['owner_id']=$this->input->post('ownerid');
	$data['building_name']=$this->input->post('buildingname');
	$data['no_of_housing_units']=$this->input->post('noofhouse');
	$data['no_of_commercial_units']=$this->input->post('noofcommercial');
	$data['building_location']=$this->input->post('buildinglocation');
	$data['address']=$this->input->post('address');
	$data['updated_on'] = date("Y-m-d H:i:s");
			$data['updated_by'] = $this->session->userdata('first_name');
	//$data['agreement_percentage']=$this->input->post('agreementpercent');
	//$data['status'] = $this->input->post('status');
			
			$result=$this->Building_model->updateBuildingInformation($data, $bid);
			if ($result['RESULT'] == 'OK'){
				$this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(BUILDING_PANEL_URL));
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(BUILDING_PANEL_URL));
			}
		}
}


function buildingview()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$id = $this->uri->segment(3);
						
			$data['buildingData'] = $this->Building_model->getBuildingData($id);
		//	$data['ownerList']=$this->Admin_model->getAllOwners();
			$this->load->view('Admin_panel/header');
		$this->load->view('Admin_panel/leftmenu');
		$this->load->view('Building_panel/viewbuilding', $data);
		$this->load->view('Admin_panel/footer');
			
}

}

} 
?>