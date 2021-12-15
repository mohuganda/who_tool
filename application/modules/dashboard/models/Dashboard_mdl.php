<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_mdl extends CI_Model {

	
	public function __Construct(){

		parent::__Construct();
		$this->department=$this->session->userdata['department_id'];

	}
    public function getData(){
        $data['total_records']=$this->get('records_json')->num_rows();
        
    return $data;
    //

    }

}
