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
    public function index_get(){
        echo json_encode("Jambo");
    }
    public function hwsearch_post() 

    {
        $type=$this->input->post('hwtype');
        $district=$this->input->post('district_id');
        $facility=$this->input->post('facility_id');
        $searchTerm=$this->input->post('searchterm');
        if($type="CHW") {
            $results = $this->dataHandler->chwsearch($facility,$searchTerm);
        $this->response($results);
        }
        else if($type="HW"){
            $results = $this->dataHandler->hwsearch($district,$searchTerm);
        $this->response($results);
        }
        else{
     $this->response($response, 400);
        }
    }
    public function faciities_get(){
        $results = $this->dataHandler->facilities();

    $this->response($results);

    }
    public function districts_get(){
        $results = $this->dataHandler->districts();
    $this->response($results);
        
    }
    public function forms(){
        $results = $this->dataHandler->forms();
    $this->response($results);
    public function fields($fields){
        $results = $this->dataHandler->fields($fields);
    $this->response($results);
    }
    public function create_post(){
        $data=json_decode($this->input->post());
        $results = $this->dataHandler->create($data);
    $this->response($results); 
    }
    
}