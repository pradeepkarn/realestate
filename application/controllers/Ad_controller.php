<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ad_controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); 
		$this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->model('Ad_model');
		$this->load->model('Admin_model');	
		$this->load->library('upload');	
		$this->load->helper(array('form', 'url'));		
		 
	}

	function index()
	{

	 	if(!$this->session->userdata('isAdminLogin') ) {
	        	redirect(base_url(ADMIN_PANEL_URL));	
	        }
        else
        {
			$data['adList']=$this->Ad_model->getAllAd(); 
			$this->load->view('Admin_panel/header.php');
			$this->load->view('Admin_panel/leftmenu.php');
			$this->load->view('Ad_panel/adlist',$data);
			$this->load->view('Admin_panel/footer.php');
		}
	}


function addad()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');
	$this->load->view('Ad_panel/addad');
	$this->load->view('Admin_panel/footer.php');
}
}


function insertadinfo()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {

        	$data['subject']=$this->input->post('subject');
        		$data['purpose']=$this->input->post('purpose');
        			$data['district']=$this->input->post('district');
	$data['city']=$this->input->post('city');
	$data['location']=$this->input->post('location');
	$data['propertyType']=$this->input->post('propertyType');
	$data['propertyAge']=$this->input->post('propertyAge');
	$data['propertyAreaSize']=$this->input->post('propertyAreaSize');
	$data['floorNo']=$this->input->post('floorNo');
	$data['roomNo']=$this->input->post('roomNo');
	$data['bathroomNo']=$this->input->post('bathroomNo');
	$data['furnitureAvailability']=$this->input->post('furnitureAvailability');
	$data['paymentMethod']=$this->input->post('paymentMethod');
	$data['amount']=$this->input->post('amount');
	$data['details']=$this->input->post('details');
	
	$data['showWebsite']='1';
	$data['status'] = 'Active';
	$data['createdBy'] = $this->session->userdata('first_name');
	$data['updatedBy'] = $this->session->userdata('first_name');
	//print_r($data); die();

	$imagedata['adId']=$this->Ad_model->insertadDetails($data);

if(($_FILES['file_name']['name'][0])!=''){
	
		 if(count($_FILES['file_name']['name'])>=1)
        	 {
        	 	
        	     if((count($_FILES['file_name']['name'])<=10))
        	     {
        	         $cnt=(count($_FILES['file_name']['name']));
        	     }
        	     else
        	     {
        	         $cnt=10;
        	     }
        	 	for($i=0;$i<$cnt;$i++)
        	 	{
        	 		  
           $config["upload_path"] = './img/propertyImage/';
            $config["allowed_types"] = '*';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $_FILES["file"]["name"] = $_FILES['file_name']['name'][$i];
            $_FILES["file"]["type"] = $_FILES["file_name"]["type"][$i];
            $_FILES["file"]["tmp_name"] = $_FILES["file_name"]["tmp_name"][$i];
            $_FILES["file"]["error"] = $_FILES["file_name"]["error"][$i];
            $_FILES["file"]["size"] = $_FILES["file_name"]["size"][$i];
            if($this->upload->do_upload('file'))
            {
               $upload_data = $this->upload->data();
              
                $serviceImage=$upload_data["file_name"];
                
                $imagedata['fileName']=$serviceImage;
                $result=$this->Ad_model->insertadImageDetails($imagedata);                                              
            }
        
          }
      }
   }
       
     if(isset($imagedata['adId']))
	{
			   $this->Admin_model->successMessage(' تم إضافة الإعلان بنجاح  ');
			   redirect(base_url(AD_PANEL_URL));
		
			} else {
			   $this->Admin_model->errorMessage(' حاول مرة اخرى ');
			   redirect(base_url(AD_PANEL_URL));
				
			}

}


}

	function addelete() {
		
			if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
			$adId = $this->uri->segment(3);
			$result=$this->Ad_model->deleteadInformation($adId);
			if ($result['RESULT'] == 'OK'){
				$this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(AD_PANEL_URL));
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(AD_PANEL_URL));
			}
			
	}
}

	function adarchive() {
		
			if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
			$adId = $this->uri->segment(3);
			$result=$this->Ad_model->archiveadInformation($adId);
			if ($result['RESULT'] == 'OK'){
				$this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(AD_PANEL_URL));
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(AD_PANEL_URL));
			}
			
	}
}



function editad() {
		
		if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
			$id = $this->uri->segment(3);			
			$data['adData'] = $this->Ad_model->getAdData($id);
			$this->load->view('Admin_panel/header');
		$this->load->view('Admin_panel/leftmenu');
		$this->load->view('Ad_panel/editad', $data);
		$this->load->view('Admin_panel/footer');
}
}

function editadinfo() {

	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		$adid=$this->input->post('oid');
		 
	$data['subject']=$this->input->post('subject');
	$data['city']=$this->input->post('city');
	$data['location']=$this->input->post('location');
	$data['propertyType']=$this->input->post('propertyType');
	$data['propertyAge']=$this->input->post('propertyAge');
	$data['propertyAreaSize']=$this->input->post('propertyAreaSize');
	$data['floorNo']=$this->input->post('floorNo');
	$data['roomNo']=$this->input->post('roomNo');
	$data['bathroomNo']=$this->input->post('bathroomNo');
	$data['furnitureAvailability']=$this->input->post('furnitureAvailability');
	$data['paymentMethod']=$this->input->post('paymentMethod');
	$data['amount']=$this->input->post('amount');
	$data['details']=$this->input->post('details');
	$data['showWebsite']='1';
	$data['updatedDateTime'] = date("Y-m-d H:i:s");
	$data['updatedBy'] = $this->session->userdata('first_name');
	
		//$result=$this->Ad_model->insertadDetails($data);
	$result=$this->Ad_model->updateAdInformation($data, $adid);
	 
	 if(($_FILES['file_name']['name']))
	 {
	  if(count($_FILES['file_name']['name'])>=1)
        	 {
        	 	$this->Ad_model->deleteImageDetails($adid);
        	     if((count($_FILES['file_name']['name'])<=10))
        	     {
        	         $cnt=(count($_FILES['file_name']['name']));
        	     }
        	     else
        	     {
        	         $cnt=10;
        	     }
        	 	for($i=0;$i<$cnt;$i++)
        	 	{
        	 		  
           $config["upload_path"] = './img/propertyImage/';
            $config["allowed_types"] = '*';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $_FILES["file"]["name"] = $_FILES['file_name']['name'][$i];
            $_FILES["file"]["type"] = $_FILES["file_name"]["type"][$i];
            $_FILES["file"]["tmp_name"] = $_FILES["file_name"]["tmp_name"][$i];
            $_FILES["file"]["error"] = $_FILES["file_name"]["error"][$i];
            $_FILES["file"]["size"] = $_FILES["file_name"]["size"][$i];
            if($this->upload->do_upload('file'))
            {
               $upload_data = $this->upload->data();
              
                $serviceImage=$upload_data["file_name"];
                $imagedata['adId']=$adid;
                $imagedata['fileName']=$serviceImage;
                
                $result=$this->Ad_model->insertadImageDetails($imagedata);                                              
            }
        
          }
      }

		}	if ($result['RESULT'] == 'OK'){
				$this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(AD_PANEL_URL));
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(AD_PANEL_URL));
			}
		}
}


function adview()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$id = $this->uri->segment(3);						
			$data['adData'] = $this->Ad_model->getAdData($id);
			$this->load->view('Admin_panel/header');
			$this->load->view('Admin_panel/leftmenu');
			$this->load->view('Ad_panel/viewad', $data);
			$this->load->view('Admin_panel/footer');
			
		}

}

function archivedad()
{
    	if(!$this->session->userdata('isAdminLogin') ) {
	        	redirect(base_url(ADMIN_PANEL_URL));	
	        }
        else
        {
			$data['adList']=$this->Ad_model->getArchivedAd(); 
			$this->load->view('Admin_panel/header.php');
			$this->load->view('Admin_panel/leftmenu.php');
			$this->load->view('Ad_panel/archivedadlist',$data);
			$this->load->view('Admin_panel/footer.php');
		}
}

function activatead() {
		
			if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
			$adId = $this->uri->segment(3);
			$result=$this->Ad_model->activateadInformation($adId);
			if ($result['RESULT'] == 'OK'){
				$this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(AD_PANEL_URL));
			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(AD_PANEL_URL));
			}
			
	}
}

} ?>