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
        if($type="CHWR") {
            $results = $this->dataHandler->search($type,$district,$facility,$searchTerm);
        }
        else if($type="CHWR"){


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
    
}