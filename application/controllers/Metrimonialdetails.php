<?php

class Metrimonialdetails extends CI_Controller {


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
			$user_role = $data['result']->user_role;
			if($user_role==1 || $user_role==2)
			{
				$data['result'] = $this->comman_function->user_profile_info($id);
				$this->load->view('user_dashboard/left_sidebar',$data);	
			}
			elseif($user_role==0)
			{
				$this->load->view('admin/left_sidebar',$data);	
			}
			
			
				$this->load->view('user_dashboard/details_matrimonial');	
			
			
			
			
		}
		else
		{
			$data1['title'] = "View Matrimonial";
			$this->load->view('header1',$data1);
			
			$this->load->model('comman_function');
			$this->load->view('user_dashboard/details_matrimonial');
		}
			
			$this->load->view('footer');
		
	
	}
	
	
	
	
}