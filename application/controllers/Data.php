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
        //echo json_encode("Jambo");
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
     $this->response($response,REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function facilities_get(){
        $results = $this->dataHandler->facilities();

    $this->response($results,REST_Controller::HTTP_OK);

    }
    public function districts_get(){
        $results = $this->dataHandler->districts();
    $this->response($results,REST_Controller::HTTP_OK);
        
    }
    //get forms
    public function forms_get(){
        $results = $this->dataHandler->forms();
    $this->response($results);
    }
    //get form fields
    public function fields_post($form_id){
        $results = $this->dataHandler->fields($form_id);
        $this->response($results,REST_Controller::HTTP_OK);
    }

    public function create_post(){
        $post = file_get_contents('php://input');
        $data = json_decode($post);
       // $response = $this->dataHandler->create($data);
    $this->response($data,REST_Controller::HTTP_OK); 
    }
    
}