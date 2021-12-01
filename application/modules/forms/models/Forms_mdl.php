<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms_mdl extends CI_Model {

	
	public function __Construct(){

		parent::__Construct();
	
	}
   public function getData(){
      $this->db->get('data');
   return $data;
   }
  

}
