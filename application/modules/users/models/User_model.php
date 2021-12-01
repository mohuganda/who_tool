<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
 
	public function create($data = array())
	{
		return $this->db->insert('user', $data);
	}

	public function read()
	{
		return $this->db->select("
				user.*, 
				CONCAT_WS(' ', firstname, lastname) AS fullname 
			")
			->from('user')
			->order_by('id', 'desc')
			->get()
			->result();
	}

	public function single($id = null)
	{
		return $this->db->select('*')
			->from('user')
			->where('id', $id)
			->get()
			->row();
	}

	public function update($data = array())
	{
		return $this->db->where('id', $data["id"])
			->update("user", $data);
	}

	public function delete($id = null)
	{
		return $this->db->where('id', $id)
			->where_not_in('is_admin',1)
			->delete("user");
	}

	public function dropdown()
	{
		$data = $this->db->select("id, CONCAT_WS(' ', firstname, lastname) AS fullname")
			->from("user")
			->where('status', 1)
			->where_not_in('is_admin', 1)
			->get()
			->result();
		$list[''] = display('select_option');
		if (!empty($data)) {
			foreach($data as $value)
				$list[$value->id] = $value->fullname;
			return $list;
		} else {
			return false; 
		}
	}
	public function checkUser($data = array())
	{
		return $this->db->select("
				user.id, 
				CONCAT_WS(' ', user.firstname, user.lastname) AS fullname,
				user.email, 
				user.image, 
				user.last_login,
				user.last_logout, 
				user.ip_address, 
				user.status, 
				user.is_admin, 
				IF (user.is_admin=1, 'Admin', 'User') as user_level
			")
			->from('user')
			->where('email', $data['email'])
			->where('password', md5($data['password']))
			->get();
	}

	public function last_login($id = null)
	{
		return $this->db->set('last_login', date('Y-m-d H:i:s'))
			->set('ip_address', $this->input->ip_address())
			->where('id',$this->session->userdata('id'))
			->update('user');
	}

	public function last_logout($id = null)
	{
		return $this->db->set('last_logout', date('Y-m-d H:i:s'))
			->where('id', $this->session->userdata('id'))
			->update('user');
	}


}
 




