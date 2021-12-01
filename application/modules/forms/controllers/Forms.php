<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \utils\HttpUtil;

class Forms extends MX_Controller {

	
	public  function __construct(){
		parent:: __construct();
		$this->module="forms";
		$this->load->model("Forms_mdl",'forms_mdl');

	}

	public function index()
	{
		$data=array('module'=>$this->module,'title'=>"Forms",
		            'uptitle'=>"Forms and Fields",'view'=>"forms");
	echo Modules::run('templates/main',$data);
	}
	public function forms(){
		$data=array('module'=>$this->module,'title'=>"Forms",
		            'uptitle'=>"Forms",'view'=>"data");
		
		$http = new HttpUtil();
	   
		$body = array();
	
		$endpoint='data/forms';
		$headr = array();
		$headr[] = 'Content-length:'.strlen(json_encode($body));
		$headr[] = 'Content-type: application/json';
	
		
		return $http->getRequest($endpoint);
		}
		public function fields(){
			$data=array('module'=>$this->module,'title'=>"Forms",
						'uptitle'=>"Forms",'view'=>"forms");
			
			$http = new HttpUtil();
		   
			$body = array();
		
			$endpoint='data/fields';
			$headr = array();
			$headr[] = 'Content-length:'.strlen(json_encode($body));
			$headr[] = 'Content-type: application/json';
		
			
			return $response = $http->getRequest($endpoint);
		}
	

}
