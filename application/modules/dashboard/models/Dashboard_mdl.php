<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_mdl extends CI_Model {

	
	public function __Construct(){

		parent::__Construct();
		$this->department=$this->session->userdata['department_id'];

	}
    public function getData(){
        $data['total_records']=$this->db->query("select count(id) as total_records from records_json")->row()->total_records;
        $today=date('2021-12-15');
        $data['daily_updates']=$this->db->query("select count(id) as total_records from records_json where DATE_FORMAT(sync_date, '%Y-%m-%d')=$today")->row()->total_records;
        
    return $data;
    //

    }

}
