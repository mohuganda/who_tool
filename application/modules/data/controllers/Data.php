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
   function render_district($facility){
	    $fac=urldecode($facility);
	   $district=$this->db->query("SELECT distinct district from ihrisdata WHERE facility like '$fac%'")->row()->district;
	   return $district;

	}
	//This updates data to the new format 
	function normalise_data(){
		ini_set('max_execution_time', 0);
	
    
        $datas=$this->data_model->getColums();
		
		foreach($datas as $dt): 
			$staff=json_decode($dt->data); 
		  // @$staff->sync_date=$dt->sync_date;
			//print_r($staff->reference);
			@$facility=str_replace("'","\'",$staff->facility);
			@$district=$staff->district;
			if(empty($district)&&(!empty($facility))){
				$db_district=$this->db->query("SELECT DISTINCT district,district_id,facility_id from ihrisdata WHERE facility like '$facility%'")->row();
			$district = $db_district->district; 
			}
			@$user_id=$staff->user_id;
			@$hw_type=$staff->hw_type;
			if(empty($hw_type)){
				$hw_type = 'chw';

			}
			@$ihris_pid=$staff->ihris_pid;

		   $this->db->query("UPDATE records_json SET facility='$facility', district='$district', hw_type='$hw_type',user_id='$user_id',ihris_pid='$ihris_pid' WHERE reference='$staff->reference'");
	   endforeach;
	
}

	public function collection($seg=FALSE)
	{ 
		if(!empty($this->input->post('district'))){
			$district = $this->input->post('district');
			$dfilter = "and district like '$district%'";
		}
		else{
			$dfilter = "";
		}
		if(!empty($this->input->post('facility'))){
			$facility = $this->input->post('facility');
			$ffilter = " and facility like '$facility%'";
		}
		else{
			$ffilter = "";
		}
		if($this->input->post('all_date')=='on'){
			
			$datefilter = "";
		}
		else{
			$sdate = $this->input->post('sync_date');
			$datefilter = " and sync_date like '$sdate%'";
		}


		$this->load->library('pagination');
		$data['uptitle']      = 'Activity Report';
		$data['title']      = 'Activity Report';
		$data['module'] 	= "data";  
		$data['view']   	= "data";  
		$config=array();
        $config['base_url']=base_url('data/collection');
        $config['total_rows']=$this->count_rows($dfilter,$ffilter,$datefilter);
        $config['per_page']=25; //records per page
        $config['uri_segment']=3; //segment in url  
        //pagination links styling
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['attributes'] = ['class' => 'page-link'];
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
		$config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['use_page_numbers'] = false;
        $this->pagination->initialize($config);
        $page=($this->uri->segment(3))? $this->uri->segment(3):0; //default starting point for limits 
        $data['links']=$this->pagination->create_links();
		$data['files'] = $this->data_model->getData2($config['per_page'],$page,$dfilter,$ffilter,$datefilter); 
	   //print_r($config['total_rows']);
		echo Modules::run('templates/main', $data); 
	}
	public function count_rows($dfilter,$ffilter,$datefilter){
		$query=$this->db->query("SELECT reference from records_json WHERE reference IS NOT NULL $dfilter $ffilter $datefilter");
    return $query->num_rows();
	}

	public function kyc()
	{ 
		$data['uptitle']      = 'KYC Verified Data';
		$data['title']      = 'KYC Verified Data ';
		$data['module'] 	= "data";  
		$data['view']   	= "kyc";   
		$data['headers']   	= $this->data_model->headers();
		$filters=$this->input->post();
		$data['staffs']   	= $this->data_model->kycData($filters);
		echo Modules::run('templates/main', $data); 
	}

	public function data2(){
		
	return $data;
	}
	public function collections(){
		$datas = $this->data_model->getData();
	    echo json_encode($datas);
	}
	public function cache_report(){
		// if(!$this->db->get('records_json_report')->result()){
		// $this->create_report();
	    // }
		ini_set('max_execution_time',0);
		$datas=$this->data_model->getColums();
		foreach($datas as $dt): 
			 $staff=json_decode($dt->data); 
			@$staff->sync_date=$dt->sync_date;
             //print_r($staff);
			$this->db->replace('linear_json_report',$staff);
		endforeach;
	}
	function create_report(){
		
		$this->load->dbforge();
		$query=$this->dbforge->drop_table('linear_json_report');
		
        $data=$this->db->query("SELECT form_field, data_type as type, db_constraint as 'constraint', db_unique as 'unique' from fields")->result();
		$fields=array();
		foreach($data as $row){
			if($row->type=='signature'){
			$type=str_replace("signature","longtext","$row->type");
           }
		   else if($row->type=='blob'){
			$type=str_replace("blob","longtext","$row->type");
           }
		   else if ($row->type=='charmap'){
			$type=str_replace("charmap","varchar","$row->type");
		   }
		   else if ($row->type=='char'){
			$type=str_replace("char","varchar","$row->type"); 
		   }
		   else{
			$type=str_replace("map","","$row->type");

		   }
		   
			$properties = array( 
				'type'=>$type,
			    'constraint'=>"$row->constraint",
			    'unique'=>"$row->unique",
				'null' => true, 
			);

			$fields[$row->form_field] = $properties;
		}
		//print_r($fields);
		$fields['sync_date'] = array(
			'type'       => 'DATETIME',
			'null' => true,
		);
		$fields['app_version'] = array(
			'type'       => 'varchar',
			'constraint'=>"10",
			'null' => true,
		);
		$fields['district'] = array(
			'type'       => 'varchar',
			'constraint'=>"30",
			'null' => true,
		);
		$this->dbforge->add_field($fields);
		// define primary key
		
		$this->dbforge->add_key('reference', TRUE);
		$this->dbforge->add_key('user_id', FALSE);
		$this->dbforge->add_key('facility', FALSE);
		$this->dbforge->add_key('position', FALSE);
		$this->dbforge->add_key('district', FALSE);
		$this->dbforge->add_key('ihris_pid', FALSE);
		$this->dbforge->add_key('national_id', FALSE);
		$this->dbforge->add_key('app_version', FALSE);
		$this->dbforge->add_key('sync_date', FALSE);


		// create table
		$this->dbforge->create_table('records_json_report',TRUE);



	     

		
		

	}
	public function fill_districts(){
		$dis=$this->db->query("SELECT distinct district from ihrisdata");
		foreach ($dis as $d):

			$up=$this->db->query("UPDATE records_json SET=(SELECT JSON_EXTRACT(data,'.$district') WHERE JSON_EXTRACT(data,'.$district')='$d->district'");
		if($up){
			echo 'Successful';
		}
		else{
			echo 'Failed';
		}
		endforeach;

	}

	

}
