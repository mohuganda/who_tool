<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model {
 
	

	public function getData($filters)
	{ 
		if(empty($filters)){
			$filters="";
		}
		$query=$this->db->query("SELECT * FROM `records` where primary_mobile_number!='' $filters");
	return $query->result();
	
	}
	public function getData2()
	{ 
		$query=$this->db->query("SELECT * FROM `records_json`");
	return $query->result();
	
	}
	public function kycData($filters)
	{ 
		if(empty($filters)){
			$filters="";
		}
		$query=$this->db->query("SELECT * from records where kyc_verification='yes'");
	return $query->result();
	}
	public function headers()
	{ 
	return $this->db->get('fields')->result();
	
	}

	

}
 




