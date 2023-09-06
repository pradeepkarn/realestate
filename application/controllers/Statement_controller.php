<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statement_controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); 
		$this->load->helper('url'); 			
		$this->load->model('Admin_model');
		$this->load->model('Statement_model');
    $this->load->model('Payment_model');
		 $this->load->library('session');
		 $this->load->helper(array('form', 'url'));
	}


	function tenantstatement()
	{
		if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
        	$data['buildingList']=$this->Admin_model->getAllBuildings();

			    $this->load->view('Admin_panel/header');
				  $this->load->view('Admin_panel/leftmenu');
				  $this->load->view('Statement_panel/tenant',$data);
				  $this->load->view('Admin_panel/footer');
        }
	}

	function buildingstatement()
	{
		if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
        	$data['buildingList']=$this->Admin_model->getAllBuildings();

			    $this->load->view('Admin_panel/header');
				  $this->load->view('Admin_panel/leftmenu');
				  $this->load->view('Statement_panel/building',$data);
				  $this->load->view('Admin_panel/footer');
        }
	}

	function revenuestatement()
	{
		if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
        	//$data['data']=$this->Statement_model->revenuereceiptinfo();

			    $this->load->view('Admin_panel/header');
				  $this->load->view('Admin_panel/leftmenu');
				  $this->load->view('Statement_panel/revenue');
				  $this->load->view('Admin_panel/footer');
        }
	}


    function revenuestatementinfo()
    {
        if(!$this->session->userdata('isAdminLogin') ) {
            redirect(base_url(ADMIN_PANEL_URL));    
        }
        else
        {
            $start=$this->input->post('startdate');
            $end=$this->input->post('enddate');
           
          if($start=="")
          {
            $d = new DateTime('first day of this month');
            $start= $d->format('Y-m-d');
          }
          if($end=="")
          {
            $end=date('Y-m-d');
          }
                    $data['previousbalance']=$this->Statement_model->previousrevenuebalanceinfo($start,$end);
                    $data['data']=$this->Statement_model->revenuebrokerageinfo($start,$end);
                    $data['expenses']=$this->Statement_model->revenueexpenseinfo($start,$end);
                     $data['insurancepayement']=$this->Statement_model->insurnacepayemntinfo($start,$end);
                      $data['fixedbrokerage']=$this->Statement_model->fixedbrokerageinfo($start,$end);
                    $data['start']=$start;
                    $data['end']=$end;
                   // print_r($data); die();
                  $this->load->view('Statement_panel/revenuestatement',$data);
                  //$this->load->view('Admin_panel/footer');
        }
    }




function gettenants()
{

	if($this->input->post('building_id'))
	{
		echo $this->Statement_model->fetch_tenants($this->input->post('building_id'));
	}
}

function getinsuranceamount()
{

  if($this->input->post('tenant_id'))
  {
    $data['building_id']=$this->input->post('building_id');
          $data['tenant_id']=$this->input->post('tenant_id');
   echo $this->Statement_model->fetch_contractinfo($data);

  }
}


function tenantstatementinfo()
{

	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
        	$data['building_id']=$this->input->post('buildingid');
        	$data['tenant_id']=$this->input->post('tenantid');

        	$result['data']=$this->Statement_model->tenantstatement($data);
        	//$result['maintenance']=$this->Statement_model->getmaintenance($data);
        	//print_r($result);die();
        	   $this->load->view('Statement_panel/tenantstatement',$result);
			   //redirect(base_url(STATEMENT_PANEL_URL).'statement');
				
			}
        }

        function insurancestatementcalc()
{

  if(!$this->session->userdata('isAdminLogin') ) {
          redirect(base_url(ADMIN_PANEL_URL));  
        }
        else
        {
          $data['building_id']=$this->input->post('buildingid');
          $data['tenant_id']=$this->input->post('tenantid');
         $data['contract_number']=$this->input->post('contractnumber');
          $data['insurance_fees']=$this->input->post('amountid');
         // $data['amount_deduct']=$this->input->post('amountdeduct');



  $data['contract_id']=$this->input->post('contractid');
  //$data['payment_amount']=$this->input->post('paymentamount');
  
  $a=str_replace(",","", $this->input->post('amountdeduct'));
  $data['payment_amount']=($a);
  $data['payment_date']=date('Y-m-d');
 
  $data['payment_type']=$this->input->post('paymenttype');
  if($this->input->post('paymenttype')!="Cash")
        {
          $data['bank_id']=$this->input->post('bankid');
        }

        
  $data['description']=$this->input->post('desc');
  $data['status'] = 'Active';
  $data['created_by'] =  $this->session->userdata('first_name');
  $data['updated_by'] =  $this->session->userdata('first_name');
  //print_r($data);die();
  $result=$this->Statement_model->insertinsurancepaymentDetails($data);
  if ($result['RESULT'] == 'OK'){
    $id=$result['ID'];
         $this->Admin_model->successMessage($result['ERROR']);
         redirect(base_url(STATEMENT_PANEL_URL."insurancepayements/".$id));
    
      } else {
         $this->Admin_model->errorMessage($result['ERROR']);
         redirect(base_url(STATEMENT_PANEL_URL."insurancepayements/".$id));
        
      }

      }
        }

function insurancepayements()
{
  if(!$this->session->userdata('isAdminLogin') ) {
          redirect(base_url(ADMIN_PANEL_URL));  
        }
        else
        {
  $id = $this->uri->segment(3);
  $data['paymentList']=$this->Statement_model->getInsurancePaymentInfo($id);
  //print_r($data);die();
  //$this->load->view('Admin_panel/header.php');
  //$this->load->view('Admin_panel/leftmenu.php');
  $this->load->view('Statement_panel/insurancepayment',$data);
  //$this->load->view('Admin_panel/footer.php');
} }

function buildingstatementinfo()
{

	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {

             $start=$this->input->post('startdate');
            $end=$this->input->post('enddate');
          if($start=="")
          {
            $d = new DateTime('first day of this month');
            $start= $d->format('Y-m-d');
          }
          if($end=="")
          {
            $end=date('Y-m-d');
          }
          $data['building_id']=$this->input->post('buildingid');
         // echo $this->input->post('unitid'); die();
          if(($this->input->post('unitid')!=""))
          {
             
            $data['unit_id']=$this->input->post('unitid');          
            $result['unit']=$this->input->post('unitid');
          }
          
          $result['buildingList']=$this->Admin_model->getAllBuildings();         
          $result['unitList']=$this->Statement_model->getunits($this->input->post('buildingid'));
            $result['previousbalance']=$this->Statement_model->previousbuildingbalanceinfo($data,$start);        	
        	$result['receipt']=$this->Statement_model->buildingreceiptinfo($data,$start,$end);
            $result['brokerage']=$this->Statement_model->buildingbrokerageinfo($data,$start,$end);
        	$result['payment']=$this->Statement_model->buildingpaymentinfo($data,$start,$end);
        	$result['fixedamount']=$this->Statement_model->buildingfixedbrokerageinfo($data,$start,$end);
            $result['expenses']=$this->Statement_model->buildingmaintenanceinfo($data,$start,$end);
            $result['start']=$start;
            $result['end']=$end;
             $result['building']=$this->Statement_model->buildinginfo($data);
        	//print_r($result);die();
        	   $this->load->view('Statement_panel/buildingstatement',$result);
			   //redirect(base_url(STATEMENT_PANEL_URL).'statement');
				

			}
        }

function getunits()
{
    if($this->input->post('building_id'))
  {
    echo $this->Statement_model->getunitsbyid($this->input->post('building_id'));
  }
}
function cashstatement()
    {
        if(!$this->session->userdata('isAdminLogin') ) {
            redirect(base_url(ADMIN_PANEL_URL));    
        }
        else
        {
            //$data['bankList']=$this->Admin_model->getAllBank();

                $this->load->view('Admin_panel/header');
                  $this->load->view('Admin_panel/leftmenu');
                  $this->load->view('Statement_panel/cash');
                  $this->load->view('Admin_panel/footer');
        }
    }


function cashstatementinfo()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
            $start=$this->input->post('startdate');
            $end=$this->input->post('enddate');
           
          if($start=="")
          {
            $d = new DateTime('first day of this month');
            $start= $d->format('Y-m-d');
          }
          if($end=="")
          {
            $end=date('Y-m-d');
          }
         // echo $start; echo $end; die();
            $data['previousbalance']=$this->Statement_model->previouscashbalanceinfo($start,$end);
        	$data['receipt']=$this->Statement_model->cashreceiptinfo($start,$end);
        	$data['expenses']=$this->Statement_model->cashexpensesinfo($start,$end);
        	$data['payment']=$this->Statement_model->cashpaymentinfo($start,$end);
        	//$data['start']=date_create($start,'Y-m-d');
            //$data['end']=date_create($end,'Y-m-d');
           // $start=date_create("2020-7-1");
           // $start=date_format($start,"Y-m-d");
            $data['start']=$start;

            $data['end']=$end;
            // echo $start;
           // echo $end; die();
           // print_r($data); die();
        	   $this->load->view('Statement_panel/cashstatement',$data);
			   //redirect(base_url(STATEMENT_PANEL_URL).'statement');
				
			}
}

function bankstatement()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {

        	$data['bankList']=$this->Admin_model->getAllBank();

			    $this->load->view('Admin_panel/header');
				  $this->load->view('Admin_panel/leftmenu');
				  $this->load->view('Statement_panel/bank',$data);
				  $this->load->view('Admin_panel/footer');
        }
    }


function bankstatementinfo()
{

	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
             $start=$this->input->post('startdate');
            $end=$this->input->post('enddate');
           
          if($start=="")
          {
            $d = new DateTime('first day of this month');
            $start= $d->format('Y-m-d');
          }
          if($end=="")
          {
            $end=date('Y-m-d');
          }
        	$bankid=$this->input->post('bankid');
            $result['bankList']=$this->Admin_model->getAllBank();
            $result['bank']=$this->Statement_model->getbank($bankid);
           $result['previousbalance']=$this->Statement_model->previousbankbalanceinfo($bankid,$start,$end);
        	$result['receipt']=$this->Statement_model->bankreceiptinfo($bankid,$start,$end);
        	$result['payment']=$this->Statement_model->bankpaymentinfo($bankid,$start,$end);
        	$result['expenses']=$this->Statement_model->bankexpensesinfo($bankid,$start,$end);
            $result['start']=$start;
             $result['end']=$end;
        	//print_r($result);die();
        	   $this->load->view('Statement_panel/bankstatement',$result);
			   //redirect(base_url(STATEMENT_PANEL_URL).'statement');
				
			}
        }

function insurancestatement()
{
  if(!$this->session->userdata('isAdminLogin') ) {
          redirect(base_url(ADMIN_PANEL_URL));  
        }
        else
        {

         $data['buildingList']=$this->Admin_model->getAllBuildings();
         $data['bankList']=$this->Admin_model->getAllBank();
          $this->load->view('Admin_panel/header');
          $this->load->view('Admin_panel/leftmenu');
          $this->load->view('Statement_panel/insurance',$data);
          $this->load->view('Admin_panel/footer');
        }
    }

function insurancestatementinfo()
{

  if(!$this->session->userdata('isAdminLogin') ) {
          redirect(base_url(ADMIN_PANEL_URL));  
        }
        else
        {
             $start=$this->input->post('startdate');
            $end=$this->input->post('enddate');
           
          if($start=="")
          {
            $d = new DateTime('first day of this month');
            $start= $d->format('Y-m-d');
          }
          if($end=="")
          {
            $end=date('Y-m-d');
          }
          $bankid=$this->input->post('bankid');
            $result['bankList']=$this->Admin_model->getAllBank();
            $result['bank']=$this->Statement_model->getbank($bankid);
           $result['previousbalance']=$this->Statement_model->previousbankbalanceinfo($bankid,$start,$end);
          $result['receipt']=$this->Statement_model->bankreceiptinfo($bankid,$start,$end);
          $result['payment']=$this->Statement_model->bankpaymentinfo($bankid,$start,$end);
          $result['expenses']=$this->Statement_model->bankexpensesinfo($bankid,$start,$end);
            $result['start']=$start;
             $result['end']=$end;
          //print_r($result);die();
             $this->load->view('Statement_panel/bankstatement',$result);
         //redirect(base_url(STATEMENT_PANEL_URL).'statement');
        
      }
        }
 



}
?>