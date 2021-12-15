<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_mdl extends CI_Model {

	
	public function __Construct(){

		parent::__Construct();
		$this->department=$this->session->userdata['department_id'];

	}
    public function getData(){
        $data['total_records']=$this->db->query("select count(id) as total_records from records_json")->row()->total_records;
        $today=date('Y-m-d');
        $data['daily_updates']=$this->db->query("SELECT count(id) as daily_updates from records_json where DATE_FORMAT(sync_date, '%Y-%m-%d')='$today'")->row()->daily_updates;
        $data['total_enrollers']=$this->db->query("SELECT count(user_id) as users from user where user_id!=1")->row()->users;
        $data['active_enrollers']= $this->db->query("SELECT count(distinct(user_id)) as active_enrollers from records_json where DATE_FORMAT(sync_date, '%Y-%m-%d')='$today' and user_id!=1")->row()->active_enrollers.' out of ';
        $data['chwdata']= $this->db->query("SELECT JSON_EXTRACT(data,'$.hw_type') as community_workers from records_json WHERE JSON_EXTRACT(data,'$.hw_type')='chw'")->num_rows();
        $data['mhwdata']= $this->db->query("SELECT JSON_EXTRACT(data,'$.hw_type') as ministry_workers from records_json WHERE JSON_EXTRACT(data,'$.hw_type')='mhw'")->num_rows();
      
    return $data;
    //

    }

}
