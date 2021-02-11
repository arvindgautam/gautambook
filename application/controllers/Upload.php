<?php
class Upload extends CI_Controller {

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
				
			
					$data['result'] = $this->comman_function->user_profile_info($id);
					$this->load->view('admin/left_sidebar',$data);	
			
				
			$compose = $this->input->post('compose');
			if(!empty($compose))
			{
				$user_mail_msg = $this->comman_function->upload_file();
				$user_data['user_mail_msg'] = $user_mail_msg;
				$this->load->view('admin/upload_form',$user_data);
			}
			else
			{
				$user_data['user_mail_msg'] = '';
				$this->load->view('admin/upload_form',$user_data);
			}
			
			
			$this->load->view('footer');
			 
			
			
			
		}
		else
		{
			  redirect('login', 'refresh');
	
		}
	}
	
	public function delete_upload()
	
	{
		if (isset($_POST['upload_id'])) 
		{
			$this->load->model('comman_function');
			// Validate the user can login
			$results = $this->comman_function->delete_upload_files($_POST['upload_id']);
			// Now we verify the result
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
?>