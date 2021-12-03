<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

Class Data extends REST_Controller 
{
    public function __construct()

    {
        
        //header('Access-Control-Allow-Origin: *');
        // header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->load->model('Data_Model', 'dataHandler');
       
    }
    public function index_get(){
        //echo json_encode("Jambo");
    }
    public function hwsearch_post() 

    {
        $post = json_decode(file_get_contents('php://input'));

        $type = $post->worker_type;
        $district_id = $post->district_id;
        $facility=$post->facility_id;
        $searchTerm=$post->searchTerm;

        if($type="CHW" && $facility="") {
            //name
            $results = $this->dataHandler->chwsearch($facility,$searchTerm);
        $this->response($results,REST_Controller::HTTP_OK);
        }
        else if  ($type="MHW" && $district=""){
            $results = $this->dataHandler->hwsearch($district,$searchTerm);
        $this->response($results,REST_Controller::HTTP_OK);
        }
      
    }
    public function facilities_get(){
        //header('Access-Control-Allow-Origin: *');
        $results = $this->dataHandler->facilities();

    $this->response($results,REST_Controller::HTTP_OK);

    }
    public function jobs_get(){
        $results = $this->dataHandler->jobs();

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
    public function fields_get($form_id=FALSE){
        $results = $this->dataHandler->fields($form_id);
        $this->response($results,REST_Controller::HTTP_OK);
    }

    public function create_post(){
        $post = file_get_contents('php://input');
        $data = json_decode($post);
        $data_reference = json_decode($post)->reference;
        $insert=array('reference'=>$data_reference,'data'=>$post);
        $response = $this->dataHandler->create($insert,$data);
    $this->response($response,REST_Controller::HTTP_OK); 
    }
    
    public function headers(){
      // $header = header("Access-Control-Allow-Origin: *");
    return $header;
    }
    public function auth_get($authkey){
        $status = $this->dataHandler->auth($authkey);
        $this->response($status,REST_Controller::HTTP_OK); 
    }
    
}