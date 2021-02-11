<?php

class Addfamilymember extends CI_Controller {


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
			$load_form = $this->input->post('run_code');
			if($load_form=='')
			{
				$data['msg'] = '';
				$this->load->view('user_dashboard/add_family',$data);
				
			}
			else
			{	
				$msg=$this->family();
				$data['msg'] = $msg;
				$this->load->view('user_dashboard/add_family',$data);
				
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
	public function family()
	{
		 $this->load->model('comman_function');
		 $result = $this->comman_function->add_family_member();
		  if($result){
		
				// If user did validate, 
				// Send them to members area
				
			$msg = '<div class="success"><p>Congratulation, You have registered new user , Please check your email.</p></div>';
				
				
				
           return($msg);
        }        
		else
		{
          // If user did not validate, then show them login page again
             $msg = '<div class="error"><p>Oppss! You have register already.</p></div>';
            return $msg;  
		}
	}
	

}  
?>