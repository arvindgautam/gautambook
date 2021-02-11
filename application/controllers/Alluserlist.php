

<?php

class Alluserlist extends CI_Controller {
  
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
			$this->load->view('all_user_list');
			
		
		}
		else
		{
			//If no session, redirect to login page
		  redirect('login', 'refresh');
			
		}
			$this->load->view('footer');
			
	}
	
	public function user_list()
	{
		 if (isset($_POST['posted_ids'])) 
		   {
			$this->load->model('comman_function');
			$result = $this->comman_function->all_user_listss($_POST['posted_ids']);
			if($result!='')
			{
			 echo $result;
			 
			}
		   }
	
	
	}
}
		
