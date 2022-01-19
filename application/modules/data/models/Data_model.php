<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_Model {
 
	

	public function getData2($limits,$starts,$dfilter,$ffilter,$print)
	{ 
		if(!empty($limits&&$starts&&$print=1)){
			$limit ="LIMIT $starts,$limits";
		}
		else{
			$limit ="";
		}
		$query=$this->db->query("SELECT * FROM `records_json` WHERE reference IS NOT NULL $dfilter $ffilter ORDER BY sync_date DESC $limit");
	return $query->result();
	
	}
	public function getColums()
	{ 
		$query=$this->db->query("SELECT sync_date,data FROM `records_json`");
	return $query->result();
	
	}
	public function getColumsup()
	{ 
		$query=$this->db->query("SELECT * FROM `records_json` WHERE hw_type is NULL");
	return $query->result();
	
	}
	public function getData()
	{ 
	
		$query=$this->db->query("SELECT  sync_date, data FROM `records_json` ORDER BY STR_TO_DATE(sync_date,'%d-%m-%Y') DESC");
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
 




