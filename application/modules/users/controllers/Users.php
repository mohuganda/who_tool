<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MX_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
 	
 		$this->load->model(array(
 			'user_model'  
 		));
	}

	 public function index()
	{ 
		$this->load->view('login');
	 }

	public function userlist()
	{ 
		$data['uptitle']      = 'User List';
		$data['module'] 	= "users";  
		$data['view']   	= "list";   
		$data['user'] = $this->user_model->read();
		echo Modules::run('templates/main', $data); 
	}

	public function login()
	{   
		 
		if ($this->session->userdata('isLogIn'))
		redirect('dashboard/dashboard');
		$data['title']    = "login"; 
		$this->form_validation->set_rules('email', 'Email Required', 'required|valid_email|max_length[100]|trim');
		$this->form_validation->set_rules('password', 'Password Required', 'required|max_length[32]|md5|trim');
		#-------------------------------------#
		$data['user'] = (object)$userData = array(
			'email' 	 => $this->input->post('email'),
			'password'   => $this->input->post('password'),
		);
		#-------------------------------------#
		if ( $this->form_validation->run())
		{
			$user = $this->user_model->checkUser($userData);
		if($user->num_rows() > 0) {

			if($user->row()->is_admin == 2){
				$row = $this->db->select('client_id,client_email')->where('client_email',$user->row()->email)->get('setup_client_tbl')->row();
			}
             	$sData = array(
					'isLogIn' 	  => true,
					'isAdmin' 	  => (($user->row()->is_admin == 1)?true:false),
					'user_type'   => $user->row()->is_admin,
					'id' 		  => $user->row()->id,
					'client_id'   => @$row->client_id,
					'fullname'	  => $user->row()->fullname,
					'user_level'  => $user->row()->user_level,
					'email' 	  => $user->row()->email,
					'image' 	  => $user->row()->image,
					'last_login'  => $user->row()->last_login,
					'last_logout' => $user->row()->last_logout,
					'ip_address'  => $user->row()->ip_address,
					'permission'  => json_encode(@$permission), 
					'label_permission'  => json_encode(@$permission1) 
					);	
					$this->session->set_userdata($sData);
					//update database status
					$this->user_model->last_login();
					
					$this->session->set_flashdata('message', 'Welcome Back '.' '.$user->row()->fullname);
					redirect('dashboard/');

			} else {
				$this->session->set_flashdata('exception', display('incorrect_email_or_password'));
				redirect('login');
			} 

		} else {
			echo Modules::run('user', $data);
		}
	}

	public function logout()
	{ 
		//update database status
		$this->user_model->last_logout();
		//destroy session
		$this->session->sess_destroy();
		redirect('login');
	}
 
    public function email_check($email, $id)
    { 
        $emailExists = $this->db->select('email')
            ->where('email',$email) 
            ->where_not_in('id',$id) 
            ->get('user')
            ->num_rows();

        if ($emailExists > 0) {
            $this->form_validation->set_message('email_check', 'The {field} is already registered.');
            return false;
        } else {
            return true;
        }
    } 

	public function form($id = null)
	{ 
		$data['title']    = "Add_user";
		$data['uptitle']    = "Add user";
		/*-----------------------------------*/
		$this->form_validation->set_rules('firstname', "First Name",'required|max_length[50]');
		$this->form_validation->set_rules('lastname', "Last Name Required",'required|max_length[50]');
		#------------------------#
		if (!empty($id)) {   
       		$this->form_validation->set_rules('email', "Email Required", "required|valid_email|max_length[100]");
       		/*---#callback fn not supported#---*/  
		} else {
			$this->form_validation->set_rules('email', "Email Required",'required|valid_email|max_length[100]');
		}
		#------------------------#
		if(empty($id)){
		$this->form_validation->set_rules('password', "Password Required",'required|max_length[32]|md5');
		}
		$this->form_validation->set_rules('about', "About Required",'max_length[1000]');
		$this->form_validation->set_rules('status', "Status Required",'required|max_length[1]');
		/*-----------------------------------*/
        $config['upload_path']          = './assets/img/user/';
        $config['allowed_types']        = 'gif|jpg|png'; 
         $image = $this->input->post('image');
		/*-----------------------------------*/
		$data['user'] = (object)$userLevelData = array(
			'id' 		  => $this->input->post('id'),
			'firstname'   => $this->input->post('firstname'),
			'lastname' 	  => $this->input->post('lastname'),
			'email' 	  => $this->input->post('email'),
			'password' 	  => (!empty($this->input->post('password'))?md5($this->input->post('password')):$this->input->post('oldpassword')),
			'about' 	  => $this->input->post('about',true),
			'image'   	  => (!empty($image)?$image:$this->input->post('old_image')),
			'last_login'  => null,
			'last_logout' => null,
			'ip_address'  => null,
			'status'      => $this->input->post('status'),
			'is_admin'    => 0
		);

		/*-----------------------------------*/
		if ($this->form_validation->run()) {


			if (empty($userLevelData['id'])) {
				if ($this->user_model->create($userLevelData)) {
					$this->session->set_flashdata('message', 'Save_successfully');
				} else {
					$this->session->set_flashdata('exception', 'Please_try_again');
				}
				redirect("users/form/");

			} else {
				if ($this->user_model->update($userLevelData)) {
					$this->session->set_flashdata('message', 'update_successfully');
				} else {
					$this->session->set_flashdata('exception', 'Please_try_again');
				}

				redirect("users/form/$id");
			}


		} else {
			$data['module'] = "users";  
			$data['view']   = "form"; 
			if(!empty($id))
			$data['user']   = $this->user_model->single($id);
			echo Modules::run('templates/main', $data);
		}
	}

	public function delete($id = null)
	{ 
		if ($this->user_model->delete($id)) {
			$this->session->set_flashdata('message', 'Delete_successfully');
		} else {
			$this->session->set_flashdata('exception', 'Please_try_again');
		}

		redirect("users/index");
	}


}
