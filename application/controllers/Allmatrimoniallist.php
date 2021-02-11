<?php

class Allmatrimoniallist extends CI_Controller {


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
			$updated = $this->input->post('run_codess');
			if($updated!='')
			{
				
				$user_msg = $this->comman_function->edit_matrimonial();    
				$user_data['user_msg'] = $user_msg;
				$this->load->view('user_dashboard/show_all_metrimonial',$user_data);
			}
			else
			{	
				
				$data['msg'] = '';
				$this->load->view('user_dashboard/show_all_metrimonial',$data);	
			} 
			
			
			
		}
		else
		{
			$error=$this->process();
			$data['error'] = $error;
			$this->load->view('sidebar',$data);
		}
			$this->load->view('footer');
		
	
	}
	
	
	public function more_matrimonial()
	{
		 if (isset($_POST['posted_ids'])) 
		   {
			$this->load->model('comman_function');
			$result = $this->comman_function->matrimonial_show_alllist($_POST['posted_ids']);
			if($result!='')
			{
			 echo $result;
			 
			}
		   }
	
	
	}
	
	public function process(){
        // Load the model
        $this->load->model('login_model');
        // Validate the user can login
        $result = $this->login_model->validate();
        // Now we verify the result
		if($result=='not_match')
		{
		
          // If user did not validate, then show them login page again
             $error = '<div class="error"><p>Invalid login detail,Please check and try again.</p></div>';
            redirect('login');
			return $error;  
			
		}
		else if($result=='not_empty')
		{
			$error = '<div class="error"><p>Your account is not active, Please activate account.</p></div>';
            return $error; 
		}
		else if($result=='not_active')
		{
			$error = '<div class="error"><p>Your account under review for your verification, Please contact to site administrator.</p></div>';
            return $error; 
		}
        else if($result=='normal'){
		
				// If user did validate, 
				// Send them to members area
				
					redirect('allmatrimoniallist');
				
			
        }
		else if($result=='admin')
		{
			
			redirect('admin');
				
		}
	
	}
}