<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends MX_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
 	
 		$this->load->model(array(
 			'data_model'  
 		));
	}


	public function index()
	{ 
		$data['uptitle']      = 'Activity Report';
		$data['title']      = 'Activity Report';
		$data['module'] 	= "data";  
		$data['view']   	= "data";   
		$data['headers']   	= $this->data_model->headers();
		$data['staffs'] = $this->data_model->getData($filters);
		echo Modules::run('templates/main', $data); 
	}

	public function kyc()
	{ 
		$data['uptitle']      = 'KYC Verified Data';
		$data['title']      = 'KYC Verified Data ';
		$data['module'] 	= "data";  
		$data['view']   	= "kyc";   
		$data['headers']   	= $this->data_model->headers();
		echo Modules::run('templates/main', $data); 
	}

	public function data2(){
		$datas = $this->data_model->getData2();
	return $datas;
	}
	public function cache_report(){
		$this->create_report();
		$datas=$this->data2();
		foreach($datas as $dt): 
			$staff=json_decode($dt->data); 
			$this->db->replace('report',$staff);
		endforeach;
	}
	function create_report(){
		
		$this->load->dbforge();
		//$query=$this->dbforge->drop_table('report');
		
        $data=$this->db->query("SELECT form_field, data_type as type, db_constraint as 'constraint', db_unique as 'unique' from fields")->result();
		$fields=array();
		foreach($data as $row){
			
			$properties = array(
				'type'=>str_replace("map","","$row->type"),
			    'constraint'=>"$row->constraint",
			    'unique'=>"$row->unique");

			$fields[$row->form_field] = $properties;
		}
		//print_r($fields);
		$this->dbforge->add_field($fields);
		// define primary key
		$this->dbforge->add_key('reference', TRUE);
		// create table
		$this->dbforge->create_table('report');

	     

		
		

	}

	

}
