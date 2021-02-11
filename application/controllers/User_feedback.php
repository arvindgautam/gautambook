<?php
class User_feedback extends CI_Controller {


	public function index() 
	{
		 if($this->session->userdata('logged_in'))
			{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['name'];
			$this->load->view('header', $data);	
			$this->load->view('admin/left_sidebar',$data);	
			$this->load->view('admin/user_feedback_info');
			$this->load->view('admin/right_sidebar');
			$this->load->view('footer');
	}
		else
		{
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}
	}
	
}
?>
