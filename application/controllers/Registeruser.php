<?php
class Registeruser extends CI_Controller {


	public function index() 
	{
		 if($this->session->userdata('logged_in'))
			{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['name'];
			$this->load->view('header', $data);	
			$this->load->view('admin/left_sidebar',$data);	
			$this->load->view('admin/register_user_info');
			$this->load->view('admin/right_sidebar');
			$this->load->view('footer');
	}
		else
		{
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}
	}
	public function active_user()
	{
	  if (isset($_POST['user_id'])) 
		{
			$this->load->model('comman_function');
			$result = $this->comman_function->active_users($_POST['user_id']);
			if($result!='')
			{
				echo $result;
				
			}
		}
	  
	}
	public function deletes_user()
	{
	  if (isset($_POST['user_id'])) 
		{
			$this->load->model('comman_function');
			$result = $this->comman_function->delete_users($_POST['user_id']);
			if($result!='')
			{
				echo $result;
				
			}
		}
	  
	}
}
