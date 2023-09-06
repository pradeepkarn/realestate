<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); 
		$this->load->helper('url'); 			
		$this->load->model('Admin_model');
		 $this->load->library('session');
		 $this->load->helper(array('form', 'url'));
	}
	public function index(){
		$this->load->view('login');
	}


	function dashboard()
	{
		if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
			    $this->load->view('Admin_panel/header');
				  $this->load->view('Admin_panel/leftmenu');
				  $this->load->view('Admin_panel/dashboard');
				  $this->load->view('Admin_panel/footer');
        }
	

	}
	
	function checkLogin()
	{
		$userName = $this->input->post('userName');
		$pwd = $this->input->post('pwd');
		
		$result=$this->Admin_model->checkAdminLoginInformation($userName, $pwd);

		if(count($result)>0){
					
					 $buildings=$this->Admin_model->getcountBuildings();

					   $units=$this->Admin_model->getcountUnits();
					  $owners=$this->Admin_model->getcountOwners();
					   $tenants=$this->Admin_model->getcounttenants();
					   $contracts=$this->Admin_model->getcountContracts();
					    $receipts=$this->Admin_model->getcountReceipts();
					     $payments=$this->Admin_model->getcountPayments();
					      $bank=$this->Admin_model->getcountBank();
					      $expenses=$this->Admin_model->getcountExpenses();
					       // $statement=$this->Admin_model->getcountExpenses();
					    $sessionArray = array(
					   'isAdminLogin'   => true,
					   'user_name' =>$result[0]->user_name,
					   'first_name'   => $result[0]->first_name,
					   'user_sign'=>$result[0]->user_sign,
					    'user_role'=>$result[0]->user_role,
					   'buildings'=>$buildings[0]->buildings,
					   'units'=>$units[0]->units,
					   'owners'=>$owners[0]->owners,
					   'tenants'=>$tenants[0]->tenants,
					   'contracts'=>$contracts[0]->contracts,
					   'receipts'=>$receipts[0]->receipts,
					   'payments'=>$payments[0]->payments,
					   'bank'=>$bank[0]->banks,
					   'expenses'=>$expenses[0]->expenses

					  );
					    //print_r($sessionArray);die();
					  $this->session->set_userdata($sessionArray);  
			 	  $this->load->view('Admin_panel/header');
				  $this->load->view('Admin_panel/leftmenu');
				 //$this->load->view('Admin_panel/dashboard',$sessionArray);
				 redirect(base_url(ADMIN_PANEL_URL)."dashboard");
				  $this->load->view('Admin_panel/footer');
		}
		else
		{
			$data['content']=" 	اعتماد خاطيء ";
			$this->load->view('login',$data);
		}
	}

	function logout()
	{
		$sessionArray = array('isAdminLogin'   => false);
		$this->session->unset_userdata($sessionArray);
        $this->session->sess_destroy();
        $data['content']=" تم تسجيل الخروج بنجاح ";
        $this->load->view('login',$data);
        redirect(base_url(ADMIN_PANEL_URL));
		//redirect(base_url(ADMIN_PANEL_URL),$msg);
	}


function profile()
	{
		if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
        		$data['userData']=$this->Admin_model->getuserinfo();

			    $this->load->view('Admin_panel/header');
				  $this->load->view('Admin_panel/leftmenu');
				  $this->load->view('Admin_panel/profile',$data);
				  $this->load->view('Admin_panel/footer');
        }
    }

function editprofileinfo()
{
    $data['user_name']=$this->input->post('username');
    if($this->input->post('pwd')!="")
    {
	 $data['password']=$this->input->post('pwd');
	}
	else
	{
	 $data['password']=$this->input->post('oldpwd');	
	}

    $data['first_name']=$this->input->post('firstname');
    $data['email']=$this->input->post('email');
    $data['user_role']=$this->input->post('role');
    $data['status'] = 'Active';
    $data['created_by'] = 'Admin';
    //$data['updated_by'] = 'Admin';
    $result=$this->Admin_model->updateuserProfile($data);


    if ($result['RESULT'] == 'OK'){
               $this->Admin_model->successMessage($result['ERROR']);
               redirect(base_url(ADMIN_PANEL_URL.'dashboard'));
        
            } else {
               $this->Admin_model->errorMessage($result['ERROR']);
               redirect(base_url(ADMIN_PANEL_URL.'dashboard'));
                
            }

}

}
?>