<?php 

CLass Data_Model extends CI_Model
{
    public function districts($personId) 
    {
    return  $this->db->get('districts')->result();
    }

    public function facilities($personId) 
    {
    return  $this->db->get('facilities')->result();
    }
    public function forms() 
    {
    return  $this->db->get('forms')->result();
    }

    public function fields($form_id) 
    {
           $this->db->where("form_id",$form_id);
           $this->db->order_by("display", "ASC");
     $data=$this->db->get('fields')->result();
     return $data;
    }
    // search term is surname o firstname
    public function hwsearch($district,$searchTerm) 
    {
        $query=$this->db->query("SELECT CONCAT(
            COALESCE(surname,'','')
            ,' ',
            COALESCE(firstname,'','')
            ,' ',
            COALESCE(othername,'','')
        ) AS fullname, job_id, job,facility_id,facility, telephone from 
        ihrisdata where district_id='$district_id' and (surname like '$searchTerm%' OR firstname'$searchTerm%')");
        $result=$query->result();
    
    return $data;
    }
    public function chwsearch($facility,$searchTerm) 
    {
        $query=$this->db->query("SELECT CONCAT(
            COALESCE(surname,'','')
            ,' ',
            COALESCE(firstname,'','')
            ,' ',
            COALESCE(othername,'','')
        ) AS fullname, job_id, job,facility_id,facility, telephone from 
        ihrisdata2 where facility_id='$facility_id' and (surname='$searchTerm' OR firstname='$searchTerm')");
        $result=$query->result();
    }
    public function create() 
    {
        $insert=$this->db->insert('records', $data);
        if($insert){
        echo "Saved";
        }
        else{

        echo "Failed";
        }
    return $data;
    }
        
}