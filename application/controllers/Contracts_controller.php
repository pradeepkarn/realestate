<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contracts_controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); 
		$this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->model('Admin_model');			
		$this->load->model('Contract_model');
		$this->load->helper(array('form', 'url'));
	}



	function index()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {

	$data['contractList']=$this->Admin_model->getAllContracts();	
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');
	$this->load->view('Contract_panel/contractlist',$data);
	$this->load->view('Admin_panel/footer.php');
}
}


	function suspendedcontractlist()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {

	$data['contractList']=$this->Contract_model->getSuspendedContracts();
	$data['list']='1';	

	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');
	$this->load->view('Contract_panel/suspendcontractlist',$data);
	$this->load->view('Admin_panel/footer.php');
}
}


	function endcontractlist()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {

	$data['contractList']=$this->Contract_model->getEndContracts();	
	$data['list']='2';
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');
	$this->load->view('Contract_panel/suspendcontractlist',$data);
	$this->load->view('Admin_panel/footer.php');
}
}



function addcontract()
{
   
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
            
	$data['buildingList']=$this->Admin_model->getAllBuildings();
	$data['tenantList']=$this->Admin_model->getAllTenants();	
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');	
	$this->load->view('Contract_panel/addcontract_new',$data);
	$this->load->view('Admin_panel/footer.php');

}
}

/*function addcontractinfo()
{
	$id=$this->input->post('buildingid');
	$data['buildingid']=$id;
	$data['unitList']=$this->Contract_model->getfreeunits($id);
	$data['tenantList']=$this->Admin_model->getAllTenants();
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');	
	//$this->load->view('Contract_panel/showbuildingdrop',$data);
	$this->load->view('Contract_panel/addcontract',$data);
	$this->load->view('Admin_panel/footer.php');

}*/

function getunits()
{
	if($this->input->post('building_id'))
	{
		echo $this->Contract_model->fetch_units($this->input->post('building_id'));
	}
}

 function insertcontractinfo()
 {
 	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	$data['building_id']=$this->input->post('buildingid');
	$data['unit_id']=$this->input->post('unitid');
	$data['tenant_id']=$this->input->post('tenantid');
	$data['contract_number']=$this->input->post('contractnumber');
	$data['contract_period']=$this->input->post('contractperiod');
	$data['contract_startdate']=$this->input->post('startdate');
	$data['contract_enddate']=$this->input->post('enddate');
	$data['no_of_installments']=$this->input->post('noofinstallments');
	$data['rent_amount']=$this->input->post('rentamount');
	$data['water_fees']=$this->input->post('waterfees');
	$data['electricity_fees']=$this->input->post('electricityfees');
	$data['other_fees']=$this->input->post('otherfees');
	$data['insurance_fees']=$this->input->post('insurancefees');
	$data['brokerage_fees']=$this->input->post('brokeragefees');
	$total=(($this->input->post('rentamount')+$this->input->post('waterfees')+$this->input->post('electricityfees')+$this->input->post('otherfees')));
	$data['total']=$total;
	
	$data['brokerage_percentage']=$this->input->post('borkeragepercent');
	  $data['fixed_brokerage_amount']=$this->input->post('fixedamount');
	$data['balance_amount']=$total;
	$data['contract_status'] = "New";
	$data['status']='Active';
	$data['created_by'] =  $this->session->userdata('first_name');
	$data['updated_by'] =  $this->session->userdata('first_name');
	//print_r($data); die();
	$result=$this->Contract_model->insertcontractDetails($data);
	if ($result['RESULT'] == 'OK'){
			   
		 $this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(CONTRACT_PANEL_URL));
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(CONTRACT_PANEL_URL));
				
			}
 }
}


function contractdelete() {
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$contractId = $this->uri->segment(3);
			$unitid=$this->uri->segment(4);

			//------------ to find buildingid------------
			$this->db->select("building_id");
		$this->db->from('tbl_contract');
		$this->db->where('id', $contractId);
		$this->db->where('status =', 'Active');
		$result=$this->db->get()->result();		 
		$buildingid= $result['0']->building_id;
		 //---------------------------------------------------
			$result=$this->Contract_model->deletecontractInformation($contractId,$buildingid,$unitid);
			if ($result['RESULT'] == 'OK'){
				$this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(CONTRACT_PANEL_URL));
			} else if($result['RESULT'] == 'Error1')
			{
				 $this->Admin_model->errorMessage($result['ERROR']);
				 
			  redirect(base_url(STATEMENT_PANEL_URL."insurancestatement/".$unitid));
			}

			else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(CONTRACT_PANEL_URL));
			}
			
	}
}



function contractsuspend() {
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$contractId = $this->uri->segment(3);
			$unitid=$this->uri->segment(4);
			//------------ to find buildingid------------
			$this->db->select("building_id");
		$this->db->from('tbl_contract');
		$this->db->where('id', $contractId);
		$this->db->where('status =', 'Active');
		$result=$this->db->get()->result();		 
		$buildingid= $result['0']->building_id;
		 //---------------------------------------------------
			$result=$this->Contract_model->suspendcontractInformation($contractId,$buildingid,$unitid);
			if ($result['RESULT'] == 'OK'){
				$this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(CONTRACT_PANEL_URL));
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(CONTRACT_PANEL_URL));
			}
			
	}
}




function editcontract()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	$id = $this->uri->segment(3);
	$value=$this->input->get('id');
	$data['buildingList']=$this->Admin_model->getAllBuildings();
	
	$data['tenantList']=$this->Admin_model->getAllTenants();	
	$data['contractList']=$this->Contract_model->getAllContractDetails($id);
	$data['action']=$value;

	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');	
	//$this->load->view('Contract_panel/showbuildingdrop',$data);
	$this->load->view('Contract_panel/editcontract',$data);
	$this->load->view('Admin_panel/footer.php');

}
}


function editcontractinfo()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	$cid=$this->input->post('cid');
	
	$data['tenant_id']=$this->input->post('tenantid');
	$data['contract_number']=$this->input->post('contractnumber');
	$data['contract_period']=$this->input->post('contractperiod');
	$data['contract_startdate']=$this->input->post('startdate');
	$data['contract_enddate']=$this->input->post('enddate');
	$data['no_of_installments']=$this->input->post('noofinstallments');
	$data['rent_amount']=$this->input->post('rentamount');
	$data['water_fees']=$this->input->post('waterfees');
	$data['electricity_fees']=$this->input->post('electricityfees');
	$data['other_fees']=$this->input->post('otherfees');
	$total=(($this->input->post('rentamount')+$this->input->post('waterfees')+$this->input->post('electricityfees')+$this->input->post('otherfees')));
	$data['total']=$total;
	$data['balance_amount']=$total;
	$data['insurance_fees']=$this->input->post('insurancefees');
	$data['brokerage_fees']=$this->input->post('brokeragefees');
	$data['brokerage_percentage']=$this->input->post('borkeragepercent');
	 $data['fixed_brokerage_amount']=$this->input->post('fixedamount');
	$data['updated_by'] =  $this->session->userdata('first_name');
	//print_r($data); echo"<br>"; echo $cid; die();
	$result=$this->Contract_model->editcontractDetails($data,$cid);
	if ($result['RESULT'] == 'OK'){
			   $this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(CONTRACT_PANEL_URL));
		
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(CONTRACT_PANEL_URL));
				
			}
}

}

function renewcontractinfo()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	$cid=$this->input->post('cid');
	$data1['status'] = 'Inactive';
	$data1['updated_by']='Admin';
	$results=$this->Contract_model->editcontractDetails($data1,$cid);
	$data['building_id']=$this->input->post('bid');
	$data['unit_id']=$this->input->post('uid');
	$data['tenant_id']=$this->input->post('tenantid');
	$data['contract_number']=$this->input->post('contractnumber');
	$data['contract_period']=$this->input->post('contractperiod');
	$data['contract_startdate']=$this->input->post('startdate');
	$data['contract_enddate']=$this->input->post('enddate');
	$data['no_of_installments']=$this->input->post('noofinstallments');
	$data['rent_amount']=$this->input->post('rentamount');
	$data['water_fees']=$this->input->post('waterfees');
	$data['electricity_fees']=$this->input->post('electricityfees');
	$data['other_fees']=$this->input->post('otherfees');
	$total=(($this->input->post('rentamount')+$this->input->post('waterfees')+$this->input->post('electricityfees')+$this->input->post('otherfees')));
	$data['total']=$total;
	$data['balance_amount']=$total;
	$data['insurance_fees']=$this->input->post('insurancefees');
	$data['brokerage_fees']=$this->input->post('brokeragefees');
	$data['brokerage_percentage']=$this->input->post('borkeragepercent');
	$data['created_by'] = $this->session->userdata('first_name');
	$data['updated_by'] =  $this->session->userdata('first_name');
	$data['contract_status'] = "Renewed";
	$data['status']='Active';
	$result=$this->Contract_model->insertcontractDetails($data);
	


	if ($result['RESULT'] == 'OK'){
			   $this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(CONTRACT_PANEL_URL));
		
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(CONTRACT_PANEL_URL));
				
			}
}

}

function getenddate()
{
	
if($this->input->post('sdate'))
	{
		echo $this->Contract_model->fetch_enddate($this->input->post('sdate'),$this->input->post('no'));
	}

}


function contractview()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$id = $this->uri->segment(3);
						
			$data['contractData'] = $this->Contract_model->getContractDetails($id);
		//	$data['ownerList']=$this->Admin_model->getAllOwners();
			$this->load->view('Admin_panel/header');
		$this->load->view('Admin_panel/leftmenu');
		$this->load->view('Contract_panel/viewcontract', $data);
		$this->load->view('Admin_panel/footer');
			
}

}

}
?>