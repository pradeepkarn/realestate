<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Units_controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); 
		$this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->model('Admin_model');			
		$this->load->model('Units_model');
	}

function index()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {

	$data['unitList']=$this->Units_model->getAllUnitsinfo();
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');
	$this->load->view('Units_panel/unitslist',$data);
	$this->load->view('Admin_panel/footer.php');
}

}
function addunits()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	//$data['buildingList']=$this->Admin_model->getAllBuildings();
	$data['buildingList']=$this->Admin_model->getAllBuildingswithUnits();
	//print_r($data);die();
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');
	$this->load->view('Units_panel/addunits',$data);
	$this->load->view('Admin_panel/footer.php');
}
}


function insertunitinfo()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {

        	$data['unit_purpose'] = $this->input->post('unitpurpose');
        	$data1['totalunits']=$this->input->post('total');
        	$data1['totalentered']=$this->input->post('entered');
        	$data1['residentialentered']=$this->input->post('residential');
        	$data1['commercialentered']=$this->input->post('commercial');
        	
        	 
        if($this->input->post('unitpurpose')=='0')
        {
        	$data['id']=$this->input->post('residentunitid');
        }
        else if($this->input->post('unitpurpose')=='1')
        {
        	$data['id']=$this->input->post('commercialunitid');
        }

        	 //--------------------- old unit calculation ------------
        /*	if(($this->input->post('unitpurpose')=='0')) 
        	{
        		$data['id']="R".($this->input->post('residentialentered')+1);

        	}

        	elseif (($this->input->post('unitpurpose')=='1'))
        	{
        		$data['id']="C".($this->input->post('commercialentered')+1);
        	}*/
        	//---------------------- end old unit calculation ------------
	$data['building_id']=$this->input->post('buildingid');
	$data['unit_type']=$this->input->post('unittype');
	$data['floor_no']=$this->input->post('floorno');	
	$data['electricity_acc_no']=$this->input->post('accno');
	
	$data['created_by'] =  $this->session->userdata('first_name');
	$data['updated_by']= $this->session->userdata('first_name');
//print_r($data); echo "<br>"; print_r($data1); die();
	$result=$this->Units_model->insertunitsDetails($data,$data1);


	if ($result['RESULT'] == 'OK'){
			   $this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(UNITS_PANEL_URL));
		
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(UNITS_PANEL_URL));
				
			}

}

}


	function unitdelete() {
		if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$unitId = $this->uri->segment(4);
			$buildingId= $this->uri->segment(3);
		//	echo $unitId; echo"<br>";echo $buildingId; die();
			$result=$this->Units_model->deleteunitInformation($unitId,$buildingId);
			if ($result['RESULT'] == 'OK'){
				$this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(UNITS_PANEL_URL));
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(UNITS_PANEL_URL));
			}
			
	}
}


function editunit() {
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$id = $this->uri->segment(4);
			$bid= $this->uri->segment(3);
			//$purposeid=$this->uri->segment(5);
			$data['buildingList']=$this->Admin_model->getAllBuildings();	
			$data['unitData'] = $this->Units_model->getunitData($id,$bid);
		//	$data['ownerList']=$this->Admin_model->getAllOwners();
			$this->load->view('Admin_panel/header');
		$this->load->view('Admin_panel/leftmenu');
		$this->load->view('Units_panel/editunit', $data);
		$this->load->view('Admin_panel/footer');
}
}

function editunitinfo() {
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		$uid=$this->input->post('uid');

	$data['building_id']=$this->input->post('buildingid');
	$data['unit_purpose']=$this->input->post('unitpurpose');
	$data['unit_type']=$this->input->post('unittype');
	$data['floor_no']=$this->input->post('floorno');	
	$data['electricity_acc_no']=$this->input->post('accno');
	$data['updated_on'] = date("Y-m-d H:i:s");
	$data['updated_by'] =  $this->session->userdata('first_name');
	  
			$result=$this->Units_model->updateUnitInformation($data, $uid);
			if ($result['RESULT'] == 'OK'){
				$this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(UNITS_PANEL_URL));
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(UNITS_PANEL_URL));
			}
		}

}


function getbuildinginfo()
{
	if($this->input->post('bid'))
	{
		echo $this->Units_model->fetchbuildinginfo($this->input->post('bid'));
	}
}


function unitsview()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$bid = $this->uri->segment(3);
			$uid= $this->uri->segment(4);			
			$data['unitData'] = $this->Units_model->getUnitData($uid,$bid);
		//	$data['ownerList']=$this->Admin_model->getAllOwners();
			$this->load->view('Admin_panel/header');
		$this->load->view('Admin_panel/leftmenu');
		$this->load->view('Units_panel/viewunit', $data);
		$this->load->view('Admin_panel/footer');
			
}

}

} 
?>