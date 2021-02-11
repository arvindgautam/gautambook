<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userprofile extends CI_Controller {

	 
	public function index()
	{
		 if($this->session->userdata('logged_in'))
		{
			
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['name'];
			$id = $session_data['userid'];
			$this->load->view('header', $data);
			 $this->load->model('comman_function');
        // Fetch the result from the database
			$data['result'] = $this->comman_function->user_profile_info($id);
			$this->load->view('user_dashboard/left_sidebar',$data);
			$this->load->view('user_dashboard/other_user_profile');
			$this->load->view('user_dashboard/right_sidebar');
		
		}
		else
		{
			$data1['title'] = "View Profile";
			$this->load->view('header1',$data1);
			$this->load->model('comman_function');
			$this->load->view('user_dashboard/other_user_profile');
		}
			
		
		$this->load->view('footer');
		
		
		
		
	}
	
	public function add_friends()
	{
		 if (isset($_POST['users_id'])) 
		{
			$this->load->model('friend_unfriend_model');
			$result = $this->friend_unfriend_model->add_friend_request($_POST['users_id']);
			if($result!='')
			{
				echo $result;
			}
		} 
	
	}
	public function friend_request_accept()
	{
		 if (isset($_POST['users_id'])) 
		{
			$this->load->model('friend_unfriend_model');
			$result = $this->friend_unfriend_model->accept_friend_request($_POST['users_id']);
			if($result!='')
			{
				echo $result;
			}
		} 
	
	}
	
	public function user_unfriend()
	{
		 if (isset($_POST['users_id'])) 
		{
			$this->load->model('friend_unfriend_model');
			$result = $this->friend_unfriend_model->unfriend_request($_POST['users_id']);
			if($result!='')
			{
				echo $result;
			}
		} 
	
	}
	
		public function view_next_post()
	{ 
		 if (isset($_POST['posted_ids'])) 
		   {
			$this->load->model('comman_function');
			$result = $this->comman_function->user_post_show($_POST['posted_ids']);
			if($result!='')
			{
			 echo $result;
			 
			}
		   }
	
	}
}