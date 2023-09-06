<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database(); 
		$this->load->helper('url'); 			
		$this->load->model('User_model');
		$this->load->model('Admin_model');
		$this->load->helper(array('form', 'url'));
		 $this->load->library('session');
	}
	public function index(){
                $data = array(
            'formTitle' => 'User Management',
            'title' => 'User Management',
            'userList' => $this->Admin_model->getAllusers(),
        );

        $this->load->view('Admin_panel/header.php');
		$this->load->view('Admin_panel/leftmenu.php');
		$this->load->view('User_panel/user_list', $data);
		$this->load->view('Admin_panel/footer.php');
        }   


   function adduser()
{
    if(!$this->session->userdata('isAdminLogin') ) {
            redirect(base_url(ADMIN_PANEL_URL));    
        }
        else
        {
    $this->load->view('Admin_panel/header.php');
    $this->load->view('Admin_panel/leftmenu.php');
    $this->load->view('User_panel/adduser');
    $this->load->view('Admin_panel/footer.php');
}
}

function insertuserinfo()
{
    if(!$this->session->userdata('isAdminLogin') ) {
            redirect(base_url(ADMIN_PANEL_URL));    
        }
        else
        {
             $data['user_name']=$this->input->post('username');
              $data['password']=$this->input->post('pwd');
    $data['first_name']=$this->input->post('firstname');
    $data['email']=$this->input->post('email');
    $data['user_role']=$this->input->post('role');
    $data['status'] = 'Active';
    $data['created_by'] = $this->session->userdata('first_name');
   $data['updated_by'] = $this->session->userdata('first_name');
    $result=$this->User_model->insertuserDetails($data);


    if ($result['RESULT'] == 'OK'){
               $this->Admin_model->successMessage($result['ERROR']);
               redirect(base_url(USER_PANEL_URL));
        
            } else {
               $this->Admin_model->errorMessage($result['ERROR']);
               redirect(base_url(USER_PANEL_URL));
                
            }
}
}

  function userdelete() {
        
            if(!$this->session->userdata('isAdminLogin') ) {
            redirect(base_url(ADMIN_PANEL_URL));    
        }
        else
        {
            $userId = $this->uri->segment(3);
            $result=$this->User_model->deleteuserInformation($userId);
            if ($result['RESULT'] == 'OK'){
                $this->Admin_model->successMessage($result['ERROR']);
               redirect(base_url(USER_PANEL_URL));
            } else {
               $this->Admin_model->errorMessage($result['ERROR']);
               redirect(base_url(USER_PANEL_URL));
            }
            
    }
}
function edituser() {
        
        if(!$this->session->userdata('isAdminLogin') ) {
            redirect(base_url(ADMIN_PANEL_URL));    
        }
        else
        {
            $id = $this->uri->segment(3);           
            $data['userData'] = $this->User_model->getUserData($id);
        //  $data['ownerList']=$this->Admin_model->getAllOwners();
            $this->load->view('Admin_panel/header');
        $this->load->view('Admin_panel/leftmenu');
        $this->load->view('User_panel/edituser', $data);
        $this->load->view('Admin_panel/footer');
}
}

function edituserinfo() {

    if(!$this->session->userdata('isAdminLogin') ) {
            redirect(base_url(ADMIN_PANEL_URL));    
        }
        else
        {
           
        $userid=$this->input->post('oid');
        $data['user_name']=$this->input->post('username');
              
        $data['first_name']=$this->input->post('firstname');
        $data['email']=$this->input->post('email');
        $data['user_role']=$this->input->post('role');
        $data['status'] = 'Active';
       // $data['created_by'] = $this->session->userdata('first_name'); 
        $data['updated_by'] = $this->session->userdata('first_name');
            $result=$this->User_model->updateUserInformation($data,$userid);
            if ($result['RESULT'] == 'OK'){
                $this->Admin_model->successMessage($result['ERROR']);
               redirect(base_url(USER_PANEL_URL));
            } else {
               $this->Admin_model->errorMessage($result['ERROR']);
               redirect(base_url(USER_PANEL_URL));
            }
        }
}

    
} ?>