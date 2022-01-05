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

    public function new_create_post(){
        $post = file_get_contents('php://input');
        $data = json_decode($post);
        $data_reference = json_decode($post)->reference;
        $district = json_decode($post)->district;
        $hwtype = json_decode($post)->hw_type;
        $user_id = json_decode($post)->user_id;
        if(isset(json_decode($post)->record_date)){
            @$recorddate=json_decode($post)->record_date;
        }
        else{
            @$recorddate=date('Y-m-d'); 
        }
        if(isset(json_decode($post)->location)){
            @$location=json_decode($post)->location;
        }
        else{
            @$location=json_decode($post)->district; 
        }
        if(isset(json_decode($post)->ihris_pid)){
            @$ihris_pid=json_decode($post)->ihris_pid;
        }
        else{
            @$ihris_pid=""; 
        }
        //national id
        if(isset(json_decode($post)->national_id)){
            @$nin=json_decode($post)->national_id;
        }
        else{
            @$nin=""; 
        }
        //card number
        if(isset(json_decode($post)->national_id_card_number)){
            @$nin_cardno=json_decode($post)->national_id_card_number;
        }
        else{
            @$nin_cardno=""; 
        }
        if(isset(json_decode($post)->id_expiry)){
            @$id_expiry=json_decode($post)->id_expiry;
        }
        else{
            @$id_expiry=""; 
        }
        if(isset(json_decode($post)->birth_date)){
            @$birth_date=json_decode($post)->birth_date;
        }
        else{
            @$birth_date=""; 
        }
        //id expiry
        
        
        $app_version = json_decode($post)->app_version;
        if(($user_id==200) ||
         ($user_id==2115)){
           $response = array('Received but not Saved');
        }
        else{
        $insert2=array('app_version'=>$app_version,'user_id'=>$user_id,'reference'=>$data_reference,'data'=>$post,'district'=>$district,'hw_type'=>$hwtype);
        $insert=array(
                    'surname'=>@json_decode($post)->surname,
                    'ihris_pid'=>$ihris_pid,
                    'hw_type'=>@json_decode($post)->hw_type,
                    'firstname'=>@json_decode($post)->firstname,
                    'othername'=>@json_decode($post)->othername,
                    'birth_date'=>$birth_date,
                    'birth_place'=>@json_decode($post)->birth_place,
                    'gender'=>@json_decode($post)->gender,
                    'job'=>@json_decode($post)->job,
                    'facility'=>@json_decode($post)->facility,
                    'id_type'=>@json_decode($post)->id_type,
                    'national_id'=>$nin,
                    'id_expiry'=>$id_expiry,
                    'id_photo'=>@json_decode($post)->id_photo,
                    'person_photo'=>@json_decode($post)->person_photo,
                    'primary_mobile_operator'=>@json_decode($post)->primary_mobile_operator,
                    'primary_mobile_number'=>@json_decode($post)->primary_mobile_number,
                    'is_mm_registered'=>@json_decode($post)->is_mm_registered,
                    'is_registered_by_hw'=>@json_decode($post)->is_registered_by_hw,
                    'email'=>@json_decode($post)->email,
                    'registered_mm_name'=>@json_decode($post)->registered_mm_name,
                    'diff_names_consent'=>@json_decode($post)->diff_names_consent,
                    'verification_process'=>@json_decode($post)->verification_process,
                    'kyc_verification'=>@json_decode($post)->kyc_verification,
                    'other_contact'=>@json_decode($post)->other_contact,
                    'consent'=>@json_decode($post)->consent,
                    'registered_before'=>@json_decode($post)->registered_before,
                    'no_mobile_money_point'=>@json_decode($post)->no_mobile_money_point,
                    'national_id_card_number'=>$nin_cardno,
                    'reference'=>@json_decode($post)->reference,
                    'user_id'=>@json_decode($post)->firstname,
                    'location'=>$location,
                    'record_date'=>$recorddate,
                    'ID_Number'=>@json_decode($post)->ID_Number,
                    'consent_image'=>@json_decode($post)->consent_image,
                    'employment_terms'=>@json_decode($post)->employment_terms,
                    'sync_date'=>date('Y-m-d H:i:s'),
                    'app_version'=>@json_decode($post)->app_version,
                    'district'=>@json_decode($post)->district);
        $response = $this->dataHandler->create($insert,$insert2);
        }
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