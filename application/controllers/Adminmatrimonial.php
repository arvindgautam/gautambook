<?php
class Adminmatrimonial extends CI_Controller {


	public function index() 
	{
		 if($this->session->userdata('logged_in'))
			{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['name'];
			$this->load->view('header', $data);	
			 $this->load->model('comman_function');
			$this->load->view('admin/left_sidebar',$data);
            $updated = $this->input->post('run_codess');
			if($updated!='')
			{
				
				$user_msg = $this->comman_function->edit_matrimonial();    
				$user_data['user_msg'] = $user_msg;
				$this->load->view('admin/matrimonial_manage',$user_data);
			}
			else
			{	
				
				$data['msg'] = '';
				$this->load->view('admin/matrimonial_manage',$data);	
			} 
						
			$this->load->view('footer');
	}
		else
		{
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}
	}
	public function delete_matrimonial()
	
	{
		if (isset($_POST['id'])) 
		{
			$this->load->model('comman_function');
			// Validate the user can login
			$results = $this->comman_function->delete_matrimonial($_POST['id']);
			// Now we verify the result
			if($results){
			
					// If user did validate, 
					// Send them to members area
				$msg = '<div class="success"><p>Your Matrimonial delete successfully</p></div>';
				
			   return($msg);
			}        
			else
			{
			  // If user did not validate, then show them login page again
				 $msg = '<div class="error"><p>Sorry! Your Matrimonial not delete.</p></div>';
				return $msg;  
			}
		}
	}
	
	public function get_metrimonial_datas()
	{
		if (isset($_POST['metrimonial_id'])) 
		{
			$this->load->model('comman_function');
			$results = $this->comman_function->edit_metrimonials($_POST['metrimonial_id']);
			if($results!='')
			{
			 echo $results;
			 
			}
		
		}
	
	}
	
	public function admin_more_matrimonial()
	{
		 if (isset($_POST['posted_ids'])) 
		   {
			$this->load->model('comman_function');
			$result = $this->comman_function->admin_matrimonial_show_alllist($_POST['posted_ids']);
			if($result!='')
			{
			 echo $result;
			 
			}
		   }
	
	
	}
	
}
?>
