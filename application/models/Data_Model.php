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

    public function hwsearch($personId) 
    {
    return $data;
    }
    public function chwsearch($personId) 
    {
    return $data;
    }
        
}