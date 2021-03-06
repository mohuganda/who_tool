<?php 

CLass Data_Model extends CI_Model
{
    public function districts() 
    {
    return  $this->db->get('districts')->result();
    }
    public function jobs() 
    {
    return  $this->db->get('jobs')->result();
    }

    public function facilities() 
    {
    return  $this->db->get('facilities')->result();
    }
    public function forms() 
    {
    return  $this->db->get('forms')->result();
    }

    public function fields($form_id) 
    {
           if(!empty($form_id)){
           $this->db->where("form_id",$form_id);
           }
           $this->db->order_by("position", "ASC");
     $data=$this->db->get('fields')->result();
     return $data;
    }
    // search term is surname o firstname
    public function hwsearch($district,$searchTerm) 
    {
        $query=$this->db->query("SELECT ihris_pid,surname,firstname,othername,job_id, job,facility_id,facility, telephone from 
        ihrisdata where district='$district_id' and (surname like '$searchTerm%' OR firstname'$searchTerm%')");
        $result=$query->result();
    
    return $data;
    }
    public function chwsearch($facility,$searchTerm) 
    {
        $query=$this->db->query("SELECT ihris_pid,surname,firstname,othername,, job_id, job,facility_id,facility, telephone from 
        ihrisdata2 where facility='$facility_id' and (surname='$searchTerm' OR firstname='$searchTerm')");
        $result=$query->result();
    }
    public function create($data,$post) 
    {
        $insert=$this->db->replace('records_json_report', $data);
        $insert2=$this->db->replace('records_json', $post);
        if($insert){
        $message= array("message"=>"Saved","status"=>'1');
        }
        else{

        $message= array("message"=>"Failed","status"=>'0');
        }
    return $message;
    }
    public function auth($key) 
    {

        $row=$this->db->query("SELECT * from user where username='$key' and status='1'");
        
        if($row->num_rows()>0){
        $data=array("person"=>$row->row()->user_id,"name"=>$row->row()->name,"status"=>1);
        }
        else{

        $data= array("status"=>0);
        }
    return $data;
    }
        
}