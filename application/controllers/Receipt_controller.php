<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receipt_controller extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database(); 
		$this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->model('Admin_model');			
		$this->load->model('Receipt_model');
		$this->load->helper(array('form', 'url'));
	}


function index()
{
if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	$data['receiptList']=$this->Admin_model->getAllReceipts();
	//$data['tenantList']=$this->Admin_model->getAllTenants();	
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');
	$this->load->view('Receipt_panel/receiptlist',$data);
	$this->load->view('Admin_panel/footer.php');
}
}

function addreceipt()
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
	$this->load->view('Receipt_panel/addreceipt',$data);
	$this->load->view('Admin_panel/footer.php');
}
}

function suspendreceipt()
{
if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
        	$contractid = $this->uri->segment(3);
        	$unitid = $this->uri->segment(4);
        	
	$data['contractList']=$this->Receipt_model->getContract($contractid,$unitid);
	$data['bankList']=$this->Admin_model->getAllBank();
	//$data['insuranceList']=$this->Receipt_model->getInsurance($contractid);
	//$data['brokerageList']=$this->Receipt_model->getBrokerage($contractid); 
	//$data['buildingList']=$this->Admin_model->getAllBuildings();
		
	$this->load->view('Admin_panel/header.php');
	$this->load->view('Admin_panel/leftmenu.php');
	$this->load->view('Receipt_panel/suspendreceipt1',$data);
	$this->load->view('Admin_panel/footer.php');
}
}

function getowner()
{

	if($this->input->post('building_id'))
	{
		echo $this->Receipt_model->fetch_owner($this->input->post('building_id'));
	}
}

function gettenants()
{

	if($this->input->post('building_id'))
	{
		echo $this->Receipt_model->fetch_tenants($this->input->post('building_id'));
	}
}


function getsuspendtenants()
{

	if($this->input->post('building_id'))
	{
		echo $this->Receipt_model->fetch_suspendtenants($this->input->post('building_id'));
	}
}





function getunitandcontract()
{

	if($this->input->post('unit_id') && ($this->input->post('building_id')))
	{
		echo $this->Receipt_model->fetch_unitcontarct($this->input->post('unit_id'),$this->input->post('building_id'));
	}
}


function getsuspendunitandcontract()
{

	if($this->input->post('unit_id') && ($this->input->post('building_id')))
	{
		echo $this->Receipt_model->fetch_suspendunitcontarct($this->input->post('unit_id'),$this->input->post('building_id'));
	}
}



function insertsuspendreceiptinfo()
{

	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
        	//echo "hi"; die();
        	$file=$this->input->post('file_name');
		$config['upload_path'] = './img/document_copy/';
		$config['allowed_types'] = '*';
		$this->load->library('upload', $config);
		$this->upload->do_upload('file_name');
		$up_file_name = $this->upload->data();
		$fname= $up_file_name['file_name'];

	//$data['building_id']=$this->input->post('buildingid');
	//$data['unit_id']=$this->input->post('unitid');
	$data['contract_id']=$this->input->post('contractid');
	//$data['owner_id']=$this->input->post('ownerid');
	//$data['tenant_id']=$this->input->post('tenantid');
	$data['amt_received']=$this->input->post('amountreceived');
	$data['installment_number']=$this->input->post('installmentno');
	$data['installment_startdate']=$this->input->post('installmentstartdate');
	$data['installment_enddate']=$this->input->post('installmentenddate');
	$data['payment_type']=$this->input->post('paymenttype');
	if($this->input->post('paymenttype')!="Cash")
				{
					$data['bank_id']=$this->input->post('bankid');
				}
				
	$data['payment_doc_date']=$this->input->post('paymentdocdate');
	$data['payment_doc_number']=$this->input->post('paymentdocno');
	$data['document_copy']=$fname;
	$data['description']=$this->input->post('desc');
	$data['current_balance']=$this->input->post('balamt');
	$data['amt_received_date']=date('Y-m-d');
	$data['created_by'] =  $this->session->userdata('first_name');
	$data['updated_by'] =  $this->session->userdata('first_name');
	
	$data1['amount_received']=$this->input->post('dbamountreceived')+$this->input->post('amountreceived');
	$data1['balance_amount']=$this->input->post('balanceamount')-$this->input->post('amountreceived');
	$data1['updated_by']= $this->session->userdata('first_name');
	$data1['updated_on']=date("Y-m-d H:i:s");
	if($this->input->post('balamt')=="0")
	{
		$data1['contract_status']="New";
		
	} 

	//print_r($data); echo "<Br>"; print_r($data1);die();
	$result=$this->Receipt_model->insertsuspendreceiptDetails($data,$data1);
	//print_r($result); die();
	if ($result['RESULT'] == 'OK'){
		$id=$result['ID'];
			   $this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(RECEIPT_PANEL_URL."suspendedreceipts/".$id));
			 // redirect(base_url(RECEIPT_PANEL_URL));


			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(RECEIPT_PANEL_URL."suspendedreceipts/".$id));
			 //  redirect(base_url(RECEIPT_PANEL_URL));

				
			}
}
}



function insertreceiptinfo()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {

        	if($this->input->post('installmentno')=='Insurance' || $this->input->post('installmentno')=="Brokerage")
			{

				$data['contract_id']=$this->input->post('contractid');			
				$data['amt_received_date']=date('Y-m-d');
				$data['payment_type']=$this->input->post('paymenttype');
				$data['payment_doc_date']=date('Y-m-d');
				if($this->input->post('paymenttype')!="Cash")
				{
					$data['bank_id']=$this->input->post('bankid');
				}
				if($this->input->post('installmentno')=='Insurance')
				{
				$data['amt_received']=$this->input->post('insuranceamount');
				$data['insurance_paid_status']='1';
				$data['description'] = 'قيمة التأمين ';

				}
				if($this->input->post('installmentno')=='Brokerage')
				{
						$data['amt_received']=$this->input->post('brokerageamount');
				$data['brokerage_paid_status']='1';
				$data['description'] = 'قيمة السعي  ';
				}

				$data['created_by'] =  $this->session->userdata('first_name');
				$data['updated_by'] =  $this->session->userdata('first_name');
				$data['created_on'] = date('Y-m-d');
				$data['updated_on'] = date('Y-m-d');
				
				$result=$this->Receipt_model->insertreceiptDetailsonly($data);
				
				if ($result['RESULT'] == 'OK'){
					$id=$result['ID'];
			  			 $this->Admin_model->successMessage($result['ERROR']);
			 				  
			 				 redirect(base_url(RECEIPT_PANEL_URL."otherreceipts/".$id));
			  					//redirect(base_url(RECEIPT_PANEL_URL).'otherreceipts');
			  			//$this->load->view('Receipt_panel/otherreceipts/',$id);
	

					} else {
			  				 $this->Admin_model->errorMessage($result['ERROR']);
			 					  redirect(base_url(RECEIPT_PANEL_URL."otherreceipts/".$id));
			   					//redirect(base_url(RECEIPT_PANEL_URL).'otherreceipts');

				
			}

			}
		else
		{

		$file=$this->input->post('file_name');
		$config['upload_path'] = './img/document_copy/';
		$config['allowed_types'] = '*';
		$this->load->library('upload', $config);
		$this->upload->do_upload('file_name');
		$up_file_name = $this->upload->data();
		$fname= $up_file_name['file_name'];

	//$data['building_id']=$this->input->post('buildingid');
	//$data['unit_id']=$this->input->post('unitid');
	$data['contract_id']=$this->input->post('contractid');
	//$data['owner_id']=$this->input->post('ownerid');
	//$data['tenant_id']=$this->input->post('tenantid');
	$data['amt_received']=$this->input->post('amountreceived');

	$data['installment_number']=$this->input->post('installmentno');
	if($this->input->post('balamt')=="0")
	{
		$data['installment_status']="1";
	}
	$data['installment_startdate']=$this->input->post('installmentstartdate');
	$data['installment_enddate']=$this->input->post('installmentenddate');
	$data['payment_type']=$this->input->post('paymenttype');
	if($this->input->post('paymenttype')!="Cash")
				{
					$data['bank_id']=$this->input->post('bankid');
				}
	$data['payment_doc_date']=$this->input->post('paymentdocdate');
	$data['payment_doc_number']=$this->input->post('paymentdocno');
	$data['document_copy']=$fname;
	if($this->input->post('balamt')>"0")
	{
		$data['description']=" نوع \ رقم الدفعة   ".$this->input->post('installmentno')." سداد جزئي   ".$this->input->post('desc');
	}


	elseif($this->input->post('balamt')=="0")
	{
	$data['description']=" نوع \ رقم الدفعة  ".$this->input->post('installmentno')." سداد كامل  ".$this->input->post('desc');
}
	$data['current_balance']=$this->input->post('balamt');
	$data['amt_received_date']=date('Y-m-d');
	$data['created_by'] =  $this->session->userdata('first_name');
	$data['updated_by'] =  $this->session->userdata('first_name');
	
	$data1['amount_received']=$this->input->post('dbamountreceived')+$this->input->post('amountreceived');
	$data1['balance_amount']=$this->input->post('dbbalanceamount')-$this->input->post('amountreceived');
	$data['current_balance']=$data1['balance_amount'];
	$data1['updated_by']= $this->session->userdata('first_name');
	$data1['updated_on']=date("Y-m-d H:i:s");
	//print_r($data); echo "<Br>"; print_r($data1);die();
	$result=$this->Receipt_model->insertreceiptDetails($data,$data1);
	if ($result['RESULT'] == 'OK'){
		$id=$result['ID'];
			   $this->Admin_model->successMessage($result['ERROR']);
			   redirect(base_url(RECEIPT_PANEL_URL."receipts/".$id));
			 // redirect(base_url(RECEIPT_PANEL_URL));


			} else {
			   $this->Admin_model->errorMessage($result['ERROR']);
			   redirect(base_url(RECEIPT_PANEL_URL."receipts/".$id));
			 //  redirect(base_url(RECEIPT_PANEL_URL));

				
			}
}
}
}


function receipts()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	$id = $this->uri->segment(3);
	$data['receiptList']=$this->Receipt_model->getReceiptInfo($id);
	$this->load->view('Receipt_panel/receipts',$data);
	} }


	function otherreceipts()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	$id = $this->uri->segment(3);
	$data['receiptList']=$this->Receipt_model->getReceiptInfo($id);
	$this->load->view('Receipt_panel/otherreceipts',$data);
	} }

	function suspendedreceipts()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
	$id = $this->uri->segment(3);
	$data['receiptList']=$this->Receipt_model->getSuspendedReceiptInfo($id);
	$this->load->view('Receipt_panel/receipts',$data);
	} }



function receiptview()
{
	if(!$this->session->userdata('isAdminLogin') ) {
        	redirect(base_url(ADMIN_PANEL_URL));	
        }
        else
        {
		
			$id = $this->uri->segment(3);
						
			$data['receiptData'] = $this->Receipt_model->getReceiptInfo($id);
		//	$data['ownerList']=$this->Admin_model->getAllOwners();
			$this->load->view('Admin_panel/header');
		$this->load->view('Admin_panel/leftmenu');
		$this->load->view('Receipt_panel/viewreceipt', $data);
		$this->load->view('Admin_panel/footer');
			
}

}

function editreceipt() {

if(!$this->session->userdata('isAdminLogin') ) {
        redirect(base_url(ADMIN_PANEL_URL));
        }
        else
        {
$id = $this->uri->segment(3);
$data['receiptData'] = $this->Receipt_model->getReceiptData($id);
$data['bankList']=$this->Admin_model->getAllBank();
$data['installment']=$this->Receipt_model->getinstallmentData($id);

//print_r($data); die();
$this->load->view('Admin_panel/header');
$this->load->view('Admin_panel/leftmenu');
$this->load->view('Receipt_panel/editreceipt', $data);
$this->load->view('Admin_panel/footer');

}

}

function updateReceiptInfo() {
if(!$this->session->userdata('isAdminLogin') ) {
        redirect(base_url(ADMIN_PANEL_URL));
        }
        else
        {
$data['receiptid']=$this->input->post('receiptid');
$data['contractid']=$this->input->post('contractid');
$data['currentbal']=$this->input->post('currentbal');
$data['amountreceived']=$this->input->post('amountreceived');
$data['balanceamount']=$this->input->post('balanceamount');
$data['totalinstallmentpaidamt']=$this->input->post('totalinstallmentpaidamt');
$data['installmentamt']=$this->input->post('installmentamt');
$maxid=$this->input->post('maxid');


$amountreceivedold=$this->input->post('amountreceivedold');
$amountreceivednew=$this->input->post('amountreceivednew');
//echo ($data['totalinstallmentpaidamt']-$amountreceivedold+$amountreceivednew);
//echo "<br>"; echo $data['installmentamt']; die();
if(($data['totalinstallmentpaidamt']-$amountreceivedold+$amountreceivednew)==$data['installmentamt'])
{
	$data3['installment_status']='1';
}
else
{
	$data3['installment_status']='0';

}

$data1['amount_received']=($data['amountreceived']-$amountreceivedold)+$amountreceivednew;
$data1['balance_amount']=($data['balanceamount']+$amountreceivedold)-$amountreceivednew;

$data2['amt_received']=$this->input->post('amountreceivednew');
$data2['current_balance']=$data1['balance_amount'];

$result = $this->Receipt_model->updateReceipt($data2,$data1,$data,$data3,$maxid);

if ($result['RESULT'] == 'OK'){
$this->Admin_model->successMessage($result['ERROR']);
  redirect(base_url(RECEIPT_PANEL_URL));
} else {
  $this->Admin_model->errorMessage($result['ERROR']);
  redirect(base_url(RECEIPT_PANEL_URL));
}
}
}



 }?>