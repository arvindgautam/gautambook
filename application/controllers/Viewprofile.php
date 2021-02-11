<?php
class Viewprofile extends CI_Controller {


	public function index() 
	{
		 if($this->session->userdata('logged_in'))
			{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['name'];
			$this->load->view('header', $data);	
			$this->load->view('admin/left_sidebar',$data);	
			$this->load->view('admin/view_user_profile');
			$this->load->view('admin/right_sidebar');
			$this->load->view('footer');
	}
		else
		{
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}
	}
	
	public function approved_user()
	{
	  if (isset($_POST['ids'])) 
		{
			$this->load->model('comman_function');
			$result = $this->comman_function->approved_users($_POST['ids']);
			if($result!='')
			{
				echo $result;
			}
		} 
	  
	}
}