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
        $this->headers();
        $post = file_get_contents('php://input');
        $type = json_decode($post)->worker_type;
        $district_id = json_decode($post)->district_id;
        $facility=json_decode($post)->facility_id;
        $searchTerm=json_decode($post)->searchTerm;

        if($type="CHW") {
            //name
            $results = $this->dataHandler->chwsearch($facility,$searchTerm);
        $this->response($results,REST_Controller::HTTP_OK);
        }
        else if($type="MHW"){
            $results = $this->dataHandler->hwsearch($district,$searchTerm);
        $this->response($results,REST_Controller::HTTP_OK);
        }
        else{
     $this->response($response,REST_Controller::HTTP_NOT_FOUND);
        }
    }
    public function facilities_get(){
        $this->headers();
        $results = $this->dataHandler->facilities();

    $this->response($results,REST_Controller::HTTP_OK);

    }
    public function jobs_get(){
        $this->headers();
        $results = $this->dataHandler->jobs();

    $this->response($results,REST_Controller::HTTP_OK);

    }
    public function districts_get(){
        $this->headers();
        $results = $this->dataHandler->districts();
    $this->response($results,REST_Controller::HTTP_OK);
        
    }
    //get forms
    public function forms_get(){
        $this->headers();
        $results = $this->dataHandler->forms();
    $this->response($results);
    }
    //get form fields
    public function fields_get($form_id){
        $this->headers();
        $results = $this->dataHandler->fields($form_id);
        $this->response($results,REST_Controller::HTTP_OK);
    }

    public function create_post(){
        $this->headers();
        $post = file_get_contents('php://input');
        $data = json_decode($post);
       // $response = $this->dataHandler->create($data);
    $this->response($data,REST_Controller::HTTP_OK); 
    }
    public function headers(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    
    }
    
}