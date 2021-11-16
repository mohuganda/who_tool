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
           $this->db->order_by("display", "ASC");
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
    public function create() 
    {

        $insert=$this->db->insert('records', $data);
        if($insert){
        $data= "Saved";
        }
        else{

        $data= "Failed";
        }
    return $data;
    }
    public function auth($key) 
    {

        $rows=$this->db->query("SELECT * from mobile_auth where key='$key' and status=1")->num_rows();
        if($query>0){
        $data= 1;
        }
        else{

        $data= 0;
        }
    return $data;
    }
        
}