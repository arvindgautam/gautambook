<?php

class Familymember extends CI_Controller {


		public function index()
	{
	
		 if($this->session->userdata('logged_in'))
		{
			
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['name'];
			$id = $session_data['userid'];
			$this->load->view('header', $data);	
			 $this->load->model('comman_function');
			 
			// Validate the user can login
			$data['result'] = $this->comman_function->user_profile_info($id);
			$this->load->view('user_dashboard/left_sidebar',$data);
			$this->load->view('user_dashboard/family_member.php');
			
		
		}
		else
		{
			$data1['title'] = "family member";
			$this->load->view('header1',$data1);
			
			$this->load->model('comman_function');
			$this->load->view('user_dashboard/family_member.php');
		}
			$this->load->view('footer');
	}
}
?>