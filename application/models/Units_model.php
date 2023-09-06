<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Units_model extends CI_Model{

	var $tableName="tbl_units";

function __construct() {
		parent::__construct();
		$this->load->database(); 

	}


function insertunitsDetails($data,$data1) {
	
		if(($data['unit_purpose'])=='0')
		{
			if($data1['residentialentered']>'0')
			{
				$i=1;
			}
			else
			{
				$i=0;
			}
		}

		if(($data['unit_purpose'])=='1')
		{
			if($data1['commercialentered']>'0')
			{
				$i=1;
			}
			else
			{
				$i=0;
			}
		}

		if($i=='0')
		{
			$json = array("RESULT"=>'OK', "ERROR"=>'عذرا, لايمكنك اضافة وحدة جديدة. تمت اضافة الوحدات لهذا العقار مسبقا ');			
			return $json;

		}
		elseif($i=='1')
		{
		$json = array();
			$data['created_on'] = date("Y-m-d H:i:s");

			///------------------check for duplicate------

		$this->db->select("*");
		$this->db->from("tbl_units");
		$this->db->where('tbl_units.id',$data['id']);
		$this->db->where('tbl_units.unit_purpose',$data['unit_purpose']);
		$this->db->where('tbl_units.building_id',$data['building_id']);	
		$data2=$this->db->get()->result();
		
		if(sizeof($data2)>0)
		{
			$this->db->select("max(id)as mid,unit_purpose");
		$this->db->from("tbl_units");
		$this->db->where('tbl_units.unit_purpose',$data['unit_purpose']);
		$this->db->where('tbl_units.building_id',$data['building_id']);
		$data3=	$this->db->get()->result();
		
		if($data['unit_purpose']==0)
		{
			$unit=str_replace('R','',$data3[0]->mid);
			$unit=$unit+1;
			$unit="R".$unit;
			
			$data['id']=$unit;
		}
		else if($data['unit_purpose']==1)
		{
			$unit=str_replace('C','',$data3[0]->mid);
			$unit=$unit+1;
			$unit="C".$unit;

			$data['id']=$unit;
		}

		}
		///------------------------------ end ----------------
			$this->db->insert($this->tableName, $data);
		$json = array("RESULT"=>'OK', "ERROR"=>'تمت اضافة بيانات جديدة بنجاح ');
			return $json;
		}
		}
	


function getAllUnitsinfo()
	{
		$this->db->select("tbl_units.id as uid,tbl_units.*,tbl_owner.owner_firstname,tbl_building.building_name,tbl_building.id as building_id,tbl_units.id as unitid");
		$this->db->from("tbl_units");
		$this->db->join('tbl_building','tbl_building.id=tbl_units.building_id');
		//$this->db->join('tbl_area','tbl_area.id=tbl_building.area_id');
		$this->db->join('tbl_owner','tbl_owner.id=tbl_building.owner_id');

		$this->db->where('tbl_units.status','Active');
		$this->db->order_by('created_on','Desc');
		$data=$this->db->get()->result();
		return $data;
	}



function deleteunitInformation($id,$bid) {
	//echo $id; echo"<br>"; echo $bid; die();
		$json = array();		
		$this->db->select("id");
		$this->db->from($this->tableName);
		$this->db->where('id', $id);
		$this->db->where('building_id', $bid);
		$this->db->where('status !=', 'Deleted');
		$result=$this->db->get()->result();	
		if (count($result) > 0) {
			$data['status']='Deleted';
			$data['updated_on'] = date("Y-m-d H:i:s");
			$data['updated_by'] =  $this->session->userdata('first_name');
			$this->db->where('id', $id);
			$this->db->where('building_id', $bid);
			$this->db->update($this->tableName, $data);	
			//$this->db->where('id', $id);
			//$this->db->update('tbl_building', array('status' => 'Deleted'));		

			$json = array("RESULT"=>'OK', "ERROR"=>'تم حذف البيانات بنجاح ');
		} else {
			$json = array("RESULT"=>'Error', "ERROR"=>'عذرا, البيانات غير موجودة ');
		}		
		return $json;
		
	}


function getUnitData($id,$bid) {
		$this->db->select("tbl_units.id as uid,tbl_units.*,tbl_building.*");
		$this->db->from($this->tableName);
		$this->db->where('tbl_units.id',$id);
		$this->db->where('tbl_units.building_id',$bid);
		$this->db->join('tbl_building','tbl_building.id=tbl_units.building_id');
		$this->db->where('tbl_units.status','Active');
		$data=$this->db->get()->result();	
		return $data;
	}

function getUnitDatabuilding($id)
{
	$this->db->select("*");
		$this->db->from($this->tableName);
		$this->db->where('building_id',$id);
		$data=$this->db->get()->result();	
		return $data;
}

function updateUnitInformation($data, $id) {
	
		$json = array();	
			
			$this->db->where('id', $id);
			$this->db->where('building_id', $data['building_id']);
			$this->db->update($this->tableName, $data);
			
			$json = array("RESULT"=>'OK', "ERROR"=>'تم التحديث بنجاح ');
		 
		return $json;
		
	}

function fetchbuildinginfo($bid)
{

	/*$this->db->select("(IfNull(tbl_building.no_of_housing_units,0)+IfNull(tbl_building.no_of_commercial_units,0))as total,count(tbl_units.id)as entered");
		//$this->db->from('tbl_building');
		$this->db->where('tbl_building.id',$bid);		
		$this->db->join('tbl_units','tbl_units.building_id=tbl_building.id','left');
		$this->db->where('tbl_building.status','Active');	
		$this->db->where('tbl_units.statu','Active');*/

		$this->db->select("(IfNull(tbl_building.no_of_housing_units,0)+IfNull(tbl_building.no_of_commercial_units,0))as total");
		$this->db->where('tbl_building.id',$bid);	
		$this->db->where('tbl_building.status','Active');
		$query=$this->db->get('tbl_building');


$this->db->select("(count(tbl_units.id))as entered");
		$this->db->where('tbl_units.building_id',$bid);	
		$this->db->where('tbl_units.status','Active');
		$query3=$this->db->get('tbl_units');
//print_r($query); die();
/*$this->db->select("((tbl_units.id))");
		$this->db->where('tbl_units.building_id',$bid);	
		$this->db->where('tbl_units.status','Active');
		$query4=$this->db->get('tbl_units');*/


$this->db->select("if(tbl_units.unit_purpose='0',tbl_building.no_of_housing_units-count(tbl_units.id),tbl_building.no_of_housing_units)as house,count(tbl_units.id)as houseentered from tbl_building left join tbl_units on tbl_units.building_id=tbl_building.id and tbl_units.unit_purpose='0' where tbl_building.id='$bid'");
	//$this->db->where('tbl_building.id',$bid);		
		//$this->db->join('tbl_units','tbl_units.building_id=tbl_building.id');
	//	$this->db->where('tbl_building.status','Active');	
	//	$this->db->where('tbl_units.status','Active');
$query1=$this->db->get();


//----------------To find the vacant resident units for the building------------ 
$this->db->select("no_of_housing_units FROM `tbl_building` where id='$bid'");
$fetchresiunitsqry=$this->db->get();
foreach($fetchresiunitsqry->result() as $row)
{
	$resunits=$row->no_of_housing_units;
}
if($resunits>0)
{
for($i=1;$i<=$resunits;$i++)
{
	 $ids[] = 'R'.$i;
}
 //print_r($ids); echo"<br>";
$rids = join("', '", $ids);

$this->db->select(" tbl_units.id as resiid from tbl_building left join tbl_units on tbl_units.building_id=tbl_building.id and tbl_units.unit_purpose='0' where tbl_building.id='$bid' and tbl_units.id   IN ('$rids')");
 $resquery=$this->db->get();
  foreach($resquery->result() as $row)
{
	$resiids[]=$row->resiid;
}
if(!empty($resiids)) 
{
$result=array_diff($ids,$resiids);
}
else
{
	$result=$ids;
}
}
//----------------------------------------------------------------------

//----------------To find the vacant commercial units for the building------------ 
$this->db->select("no_of_commercial_units FROM `tbl_building` where id='$bid'");
$fetchcommunitsqry=$this->db->get();
foreach($fetchcommunitsqry->result() as $row)
{
	$commerunits=$row->no_of_commercial_units;
}
 
if($commerunits>0)
{
for($i=1;$i<=$commerunits;$i++)
{
	 $cids[] = 'C'.$i;
}


$coids = join("', '", $cids);

$this->db->select(" tbl_units.id as commid from tbl_building left join tbl_units on tbl_units.building_id=tbl_building.id and tbl_units.unit_purpose='1' where tbl_building.id='$bid' and tbl_units.id   IN ('$coids')");
 $commquery=$this->db->get();
  foreach($commquery->result() as $row)
{
	$commids[]=$row->commid;
}
if(!empty($commids)) 
{
$commresult=array_diff($cids,$commids);
}
else
{
	$commresult=$cids;
}
}
else
{
	$commresult="";
}
//----------------------------------------------------------------------


$this->db->select("if(tbl_units.unit_purpose='1',tbl_building.no_of_commercial_units-count(tbl_units.id),tbl_building.no_of_commercial_units)as commercial,count(tbl_units.id)as commercialentered from tbl_building left join tbl_units on tbl_units.building_id=tbl_building.id and tbl_units.unit_purpose='1'where tbl_building.id='$bid'");
	/*$this->db->where('tbl_building.id',$bid);		
		$this->db->join('tbl_units','tbl_units.building_id=tbl_building.id');
		$this->db->where('tbl_building.status','Active');	
		$this->db->where('tbl_units.status','Active');*/
$query2=$this->db->get();

$this->db->select(" tbl_units.id as commid from tbl_building left join tbl_units on tbl_units.building_id=tbl_building.id and tbl_units.unit_purpose='1' where tbl_building.id='$bid'");

$commquery=$this->db->get();
foreach($query->result() as $row)
{
	$output = $row->total;
		
}	

foreach($query3->result() as $row3)
{
	$output .= "//";
	$output .= $row3->entered;
	
}	


foreach($query1->result() as $row1)
{
	$output .= "//";
	$output .= $row1->house;
	$output .= "//";
	$output .= $row1->houseentered;
}	

foreach($query2->result() as $row2)
{
	$output .= "//";
	$output .= $row2->commercial;
	$output .= "//";
	$output .= $row2->commercialentered;
	
}	
if($resunits>0)
{
$output.="//";
 foreach ($result as $i => $value) {
 		
 		$rid=str_replace("R"," سكني  ",$result[$i]);
         $output .= '<option value="'.$result[$i].'">'.$rid.'</option>';
     
}
}
else
{
	$output.="//";
	$output.="";
}
if($commerunits>0)
{
$output.="//";	
	 foreach ($commresult as $i => $value) {
	 	$cid=str_replace("C"," تجاري   ",$commresult[$i]);    
      $output .= '<option value="'.$commresult[$i].'">'.$cid.'</option>';
    // $output .= $commresult[$i];
} }
else
{
	$output.="//";
	$output.="";
}
 //echo $output;die();
return $output;

}

}
?>