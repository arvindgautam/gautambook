

<?php

class Adddistrict extends CI_Controller {
  
	public function index()
	{
		 if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['name'];
			$this->load->model('comman_function');
			$this->load->view('header', $data);	
			$this->load->view('admin/left_sidebar',$data);
				$updated = $this->input->post('state');
				if(!empty($updated))
				{
					$post_msg = $this->comman_function->add_district();
					$post_data['post_msg'] = $post_msg;
					$this->load->view('admin/add_district',$post_data);
				}
				else
				{
					$post_msgs = $this->comman_function->edit_district();
					$post_data['post_msg'] = '';
					$this->load->view('admin/add_district',$post_data);
				}
				$updateds = $this->input->post('edit_district_id');
				if(!empty($updateds))
				{
					$post_msgs = $this->comman_function->edit_district();
					
				}

				
			
			$this->load->view('footer');
		}
		else
		{
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}
	}
	
	public function delete_districts()
	
	{
		if (isset($_POST['district_id'])) 
		{
			$this->load->model('comman_function');
			// Validate the user can login
			$results = $this->comman_function->delete_district($_POST['district_id']);			// Now we verify the result
			if($results){
			
					// If user did validate, 
					// Send them to members area
				$msg = '<div class="success"><p>Your album delete successfully</p></div>';
				
			   return($msg);
			}        
			else
			{
			  // If user did not validate, then show them login page again
				 $msg = '<div class="error"><p>Sorry! Your album not deletes.</p></div>';
				return $msg;  
			}
		}
	}
}