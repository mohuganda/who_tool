<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_mdl extends CI_Model {

	
	public function __Construct(){

		parent::__Construct();
		$this->department=$this->session->userdata['department_id'];

         // Set orderable column fields
         $this->column_order = array(null, 'id','district','chw','mhw','total');
         // Set searchable column fields
         $this->column_search = array('first_name','last_name','email','gender','country','created','status');
         // Set default order
         $this->order = array('first_name' => 'asc');
     

	}
    public function getData(){
        $data['total_records']=$this->db->query("select count(id) as total_records from records_json")->row()->total_records;
        $today=date('Y-m-d');
        $data['daily_updates']=$this->db->query("SELECT count(id) as daily_updates from records_json where DATE_FORMAT(sync_date, '%Y-%m-%d')='$today'")->row()->daily_updates;
        $data['total_enrollers']=$this->db->query("SELECT count(user_id) as users from user where user_id!=1")->row()->users;
        $data['phase2_data']= $this->db->query("SELECT count(distinct(user_id)) as phase2_data from records_json where DATE_FORMAT(sync_date, '%Y-%m-%d')>'2022-03-31' and user_id!=1")->row()->phase2_data;
 
       // $data['active_enrollers']= $this->db->query("SELECT count(distinct(user_id)) as active_enrollers from records_json where DATE_FORMAT(sync_date, '%Y-%m-%d')='$today' and user_id!=1")->row()->active_enrollers.' out of ';
        $data['chwdata']= $this->db->query("SELECT reference as community_workers from records_json WHERE hw_type='chw'")->num_rows();
        $data['mhwdata']= $this->db->query("SELECT reference as ministry_workers from records_json WHERE hw_type='mhw'")->num_rows();
        $data['covered_districts']= $this->db->query("SELECT distinct district from records_json WHERE district!=''")->num_rows();
        $data['covered_facilities']= $this->db->query("SELECT distinct facility from records_json WHERE facility!=''")->num_rows();
        $data['updated_records']= $this->db->query("SELECT distinct ihris_pid from records_json ")->num_rows()-1;
     
     
       // $data['mhwdata']= $this->db->query("SELECT reference as ministry_workers from records_json WHERE JSON_EXTRACT(data,'$.hw_type')='mhw'")->num_rows();
      
    return $data;
    }

    //
    public function district_count(){

       $counts=array();
        $district=$this->db->query("SELECT distinct district from ihrisdata order by district ASC")->result();
        $id=1;
        foreach($district as $dist):
            $data['mhw']=$this->count_ministry($dist->district);
            $data['chw']=$this->count_community($dist->district);
            $data['district']=$dist->district;
            $data['total']=$data['chw']+ $data['mhw'];
            $data['id']=$id++;
            array_push($counts,$data);
           
        
            
        endforeach;
    
    return $counts;  

    }
    public function count_ministry($district){
    return  $this->db->query("SELECT reference from records_json WHERE district='$district' AND hw_type='mhw'")->num_rows();

    }
    public function count_community($district){
    return  $this->db->query("SELECT reference from records_json WHERE district='$district' AND hw_type='chw'")->num_rows();
    }

    public function enrollers_count(){

        $counts=array();
         $user=$this->db->query("SELECT distinct user_id,name,contact,username,district from user WHERE user_id!=1 order by username ASC")->result();
         $id=1;
         $date=$this->input->post('udate');
         foreach($user as $u):
             $data['total']=$this->user_records($date=FALSE, $u->user_id);
             $data['name']=$u->name;
             $data['code']=$u->username;
             $data['contact']=$u->contact;
             $data['district']=$u->district;
             $data['id']=$id++;
             array_push($counts,$data);
            
         endforeach;
     
     return $counts;  
 
     }

     
    public function phase2_enrollers_count(){

        $counts=array();
         $user=$this->db->query("SELECT distinct user_id,name,contact,username,district from user WHERE user_id!=1 order by username ASC")->result();
         $id=1;
         $date=$this->input->post('udate');
         foreach($user as $u):
             $data['total']=$this->phase2_user_records($date=FALSE, $u->user_id);
             $data['name']=$u->name;
             $data['code']=$u->username;
             $data['contact']=$u->contact;
             $data['district']=$u->district;
             $data['id']=$id++;
             array_push($counts,$data);
            
         endforeach;
     
     return $counts;  
 
     }
     public function user_records($date=FALSE,$user_id){
         if(!empty($date)){
             $dfilter="AND sync_date like '$date%'";
         }
         else{
             $dfilter="";
         }
    return $this->db->query("SELECT reference from records_json WHERE user_id=$user_id $dfilter")->num_rows();

     }
     public function phase2_user_records($date=FALSE,$user_id){
        if(!empty($date)){
            $dfilter="AND sync_date like '$date%'";
        }
        else{
            $dfilter="";
        }
   return $this->db->query("SELECT reference from records_json WHERE user_id=$user_id and sync_date like '2022-04-%'")->num_rows();

    }
    

}
