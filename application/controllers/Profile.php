<?php

class Profile extends CI_Controller {


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
			$user_role = $this->comman_function->get_user_role();
			
			if($user_role==1 || $user_role==2)
			{
				$data['result'] = $this->comman_function->user_profile_info($id);
				$this->load->view('user_dashboard/left_sidebar',$data);	
			}
			elseif($user_role==0)
			{
				$this->load->view('admin/left_sidebar',$data);	
			}
			
			$updated = $this->input->post('run_code');
			if($updated!='')
			{
				$this->load->model('comman_function');
				$user_msg = $this->comman_function->update_profile();
				$user_data['user_msg'] = $user_msg;
				$this->load->view('user_profile',$user_data);
			}
			else
			{
				$user_data['user_msg'] = '';
				$this->load->view('user_profile',$user_data);
			}
			$this->load->view('user_dashboard/right_sidebar');
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