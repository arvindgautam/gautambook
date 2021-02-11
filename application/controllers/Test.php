<?php

class Test extends CI_Controller {


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
			$updated = $this->input->post('run_code');
			if($updated!='')
			{
				
				$user_msg = $this->comman_function->edit_family_member();    
				$user_data['user_msg'] = $user_msg;
				$this->load->view('test_editor',$user_data);
			}
			else
			{	
				
				$data['msg'] = '';
				$this->load->view('test_editor',$data);	
			} 
			
			
			$this->load->view('footer');
		}
		else
		{
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}
		
	
	}
	public function delete_family_member()
	
	{
		if (isset($_POST['member_id'])) 
		{
			$this->load->model('comman_function');
			// Validate the user can login
			$results = $this->comman_function->delete_family_members($_POST['member_id']);
			// Now we verify the result
			if($results){
			
					// If user did validate, 
					// Send them to members area
				$msg = '<div class="success"><p>Your family delete successfully</p></div>';
				
			   return($msg);
			}        
			else
			{
			  // If user did not validate, then show them login page again
				 $msg = '<div class="error"><p>Sorry! Your gotra not deletes.</p></div>';
				return $msg;  
			}
		}
	}
}