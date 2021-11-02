<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

Class Data extends REST_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Data_Model', 'dataHandler');
    }
    public function hwsearch($type,$district,$facility,$searchTerm) 
    {
        if($type="CHW") {
            $results = $this->dataHandler->chwsearch($district,$facility,$searchTerm);
        $this->response($results);
        }
        else if($type="HW"){
            $results = $this->dataHandler->hwsearch($district,$facility,$searchTerm);
        $this->response($results);
        }
        else{
     $this->response($response, 400);
        }
    }
    public function faciities(){
        $results = $this->dataHandler->facilities();

    $this->response($results);

    }
    public function districts(){
        $results = $this->dataHandler->districts();
    $this->response($results);
        
    }
    public function create(){
        $data=json_decode($this->input->post());
        $results = $this->dataHandler->create($data);
    $this->response($results);
        
    }
    
}