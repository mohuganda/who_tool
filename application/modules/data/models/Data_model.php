<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model {
 
	

	public function getData2($limit,$start)
	{ 
		$query=$this->db->query("SELECT * FROM `records_json` LIMIT $start,$limit");
	return $query->result();
	
	}
	public function getData()
	{ 
	
		$query=$this->db->query("SELECT  sync_date, `data` FROM `records_json` order by sync_date DESC");
	return $query->result();
	
	}
	public function kycData($filters)
	{ 
		if(empty($filters)){
			$filters="";
		}
		$query=$this->db->query("SELECT r.*,u.name as enroller,u.email as enroller_email FROM `report` r LEFT JOIN user u on u.user_id=r.user_id WHERE kyc_verification='yes'");
	return $query->result();
	}
	public function headers()
	{ 
	return $this->db->get('fields')->result();
	
	}

	

}
 




