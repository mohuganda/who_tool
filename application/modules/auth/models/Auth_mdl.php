<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_mdl extends CI_Model {

	public function __construct()
        {
                parent::__construct();

                $this->table="user";
                $this->password=Modules::run('svariables/getSettings')->default_password;
        }

	
public function loginChecker($postdata){
	$username=$postdata['username'];
	$password=md5($postdata['password']);

	if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
	 //login using username
	
	 $this->db->where("username",$username);
	 $this->db->where("password",$password);
	 $this->db->where("status",1);
	 $this->db->join('user_groups','user_groups.group_id=user.role');
 
	 $qry=$this->db->get($this->table);
 
	 $rows=$qry->num_rows();
 
	 if($rows!==0){
 
	 $person=$qry->row();
 
 
	 return $person;
 
	}
 
	else{
 
	return "failed";
		
 
	}


	}
	else{


		//login using email
	
		$this->db->where("email",$username);
		$this->db->where("password",$password);
		$this->db->where("status",1);
		$this->db->join('user_groups','user_groups.group_id=user.role');
	
		$qry=$this->db->get($this->table);
	
		$rows=$qry->num_rows();
	
		if($rows!==0){
	
		$person=$qry->row();
	
	
		return $person;
	
	   }
	
	   else{
	
		
	    return "failed";
	   }
	
	   


	  }



}


public function unlock($pass){

	$uid=$this->session->userdata['user_id'];
	$username=$this->session->userdata['username'];

	$this->db->where("user_id",$uid);
	$this->db->where("username",$username);
	$this->db->where("password",md5($pass));

	$qry=$this->db->get($this->table);

	$rows=$qry->num_rows();

	if($rows==1){

		return "ok";
	}


}

public function getUser($id){

	$this->db->where("user_id",$id);
	$qry=$this->db->get($this->table);

	return $qry->row();

}

public function getAll($start,$limit,$key=FALSE){
	if(!empty($key)){
	$this->db->like("username","$key","after");
	$this->db->or_like("name","$key","after");
	$this->db->or_like("user_id","$key","after");

	}
	$this->db->limit($start,$limit);
	$this->db->join('user_groups','user_groups.group_id=user.role','left');
	$qry=$this->db->get($this->table);

	return $qry->result();

}

public function count_Users($key=FALSE){
	if(!empty($key)){
	$this->db->where("username like '$key%'");
	}


	$qry=$this->db->get($this->table);
	return $qry->num_rows();

}


public function addUser($postdata){
	
	

	$postdata['status']=1;
	$qry=$this->db->insert($this->table,$postdata);
	$rows=$this->db->affected_rows();

	if($rows>0){

		return "User has been Added";
	}

	else{

		return "Operation failed";
	}

}

// update user's details

public function updateUser($postdata){



	$savedata=array(
		"name"=>$postdata['name'],
		'email'=>$postdata['email'],
		"role"=>$postdata['role']



	);

    $uid=$postdata['user_id'];

	$this->db->where('user_id',$uid);

	$this->db->update($this->table,$savedata);
	$rows=$this->db->affected_rows();

	if($rows>0){

		return "User details updated";
	}

	else{

		return "No changes made";
	}

}


// change password
public function changePass($postdata){

	$oldpass=md5($postdata['oldpass']);
	$newpass=md5($postdata['newpass']);
	$user=$this->session->get_userdata();
	$uid=$user['user_id'];

	$this->db->select('password');
	$this->db->where('user_id',$uid);
	$qry=$this->db->get($this->table);

	$user=$qry->row();

	if($user->password==$oldpass){
	// change the password

	$data=array("password"=>$newpass,"isChanged"=>1);
	$this->db->where('user_id',$uid);
	$this->db->update($this->table,$data);
	$rows=$this->db->affected_rows();

	if($rows==1){

		return "ok";


	} else{



		return "Operation failed for an unknown reason, try again";
	}



	}

	else{


		return "The old password you provided is wrong";
	}



}


public function updateProfile($postdata){

	$uid=$postdata['user_id'];

	$this->db->where('user_id',$uid);
	$done=$this->db->update($this->table,$postdata);
	$rows=$this->db->affected_rows();

	if($rows==1){

		return "ok";


	} else{



		return "Nothing done, changes deemed to be Null";
	}

}


//reset user's password.................

public function resetPass($postdata){

	$uid=$postdata['user_id'];
	$password=md5($postdata['password']);

	$data=array("password"=>$password,"isChanged"=>0);

	$this->db->where('user_id',$uid);
	$done=$this->db->update($this->table,$data);
	$rows=$this->db->affected_rows();

	if($rows==1){

		return "User's password has been reset";


	} else{
		return "Failed, Try Again";
	}
}

//block

public function blockUser($postdata){

	$uid=$postdata['user_id'];

	$data=array("status"=>0);

	$this->db->where('user_id',$uid);
	$done=$this->db->update($this->table,$data);
	$rows=$this->db->affected_rows();

	if($rows==1){

		return "User has been blocked";


	} else{



		return "Failed, Try Again";
	}

}


//unblock user

	public function unblockUser($postdata){

		$uid=$postdata['user_id'];

		$data=array("status"=>1);

		$this->db->where('user_id',$uid);
		$done=$this->db->update($this->table,$data);
		$rows=$this->db->affected_rows();

		if($rows==1){

			return "User has been Unblocked";


		} else{



			return "Failed, Try Again";
		}

	}

	public function getUserGroups(){
		$qry= $this->db->get("user_groups");
		$groups=$qry->result();
		return $groups;
	}

	public function getDepartments(){
		$this->db->select('department,department_id');
		$this->db->distinct('department');
		//$qry=$this->db->get('ihrisdata');
		$qry=$this->db->get('ihrisdata');

		return $qry->result();
	}


	public function getDistricts(){
		$this->db->select('district,district_id');
		$this->db->distinct('district');
		$this->db->order_by("district","ASC");
		$qry=$this->db->get('ihrisdata');

		return $qry->result();
	}
	

	public function getFacilities(){
		$this->db->select('facility_id,facility');
		$this->db->distinct('facility_id');
		$qry=$this->db->get('ihrisdata');

		return $qry->result();
	}

    public function getPermissions(){
		$query= $this->db->get("permissions");
		$perms=$query->result();
		return $perms;
	}

	public function groupPermissions($group){
		$query=$this->db->query("SELECT permissions.id, name, definition,group_id,group_permissions.permission_id from permissions,group_permissions where permissions.id=group_permissions.permission_id and group_id='$group'");
		$perms=$query->result_array();
		return $perms;
	}

	public function getGroupPerms($groupId=FALSE){

    $this->db->where('group_id',$groupId);
    $this->db->join('permissions','permissions.id=group_permissions.permission_id');
    $qry=$this->db->get('group_permissions');

    return $qry->result();

   }

   public function getUserPerms($groupId){

    $this->db->where('group_id',$groupId);
    $qry=$this->db->get('group_permissions');
	$permissions=$qry->result();

	$perms=array();
	foreach ($permissions as $perm) {

		array_push($perms, $perm->permission_id);
	}

	return $perms;

   }

   public function savePermissions($data){
   		$data['definition']=ucwords($data['definition']);
   		$data['name']=strtolower(str_replace(" ", "",$data['name']));
   		$save=$this->db->insert('permissions',$data);
   		return $save;
   	
   }
   	 public function assignPermissions($groupId,$data){
   	 	
   	 	if(count($data)>0){
   	 	$this->db->where('group_id',$groupId);
   	 	$this->db->delete('group_permissions');

   		$save=$this->db->insert_batch('group_permissions',$data);
   		return $save;
   	    }

   	    return false;
   }													












}
