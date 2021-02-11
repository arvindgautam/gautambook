
<?php

class Allalbums extends CI_Controller {
  function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }
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
			$this->load->view('admin/left_sidebar',$data);
			$updated = $this->input->post('add_album');
			if($updated!='')
			{
				
				$user_msg = $this->comman_function->edit_album();    
				$user_data['user_msg'] = $user_msg;
				$this->load->view('admin/all_albums',$user_data);
			}
			else  
			{	
				
				$data['msg'] = '';
				$this->load->view('admin/all_albums',$data);	
			}
			
			
			$this->load->view('footer');
		}
		else
		{
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}
		
	
	}
	
	public function delete_album()
	
	{
		if (isset($_POST['album_id'])) 
		{
			$this->load->model('comman_function');
			// Validate the user can login
			$results = $this->comman_function->delete_albums($_POST['album_id']);
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
	
	public function more_album_load()
	{
		 if (isset($_POST['posted_ids'])) 
		   {
			$this->load->model('comman_function');
			$result = $this->comman_function->album_post_show($_POST['posted_ids']);
			if($result!='')
			{
			 echo $result;
			 
			}
		   }
	
	
	}
}