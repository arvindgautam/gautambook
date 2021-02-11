

<?php

class Addphoto extends CI_Controller {
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
			$this->load->view('user_dashboard/left_sidebar',$data);
			
			$updated = $this->input->post('add_photos');
				if(!empty($updated))
				{
					$post_msg = $this->comman_function->create_post();
					$post_data['post_msg'] = $post_msg;
					$this->load->view('user_dashboard/add_photo',$post_data);
				}
				else
				{
					$post_data['post_msg'] = '';
					$this->load->view('user_dashboard/add_photo',$post_data);
				}			
			
			$this->load->view('footer');
		}
		else
		{
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}
		
	
	}
	
	public function login_user_more_album_load()
	{
		 if (isset($_POST['posted_ids'])) 
		   {
			$this->load->model('comman_function');
			$result = $this->comman_function->login_user_album_post_show($_POST['posted_ids']);
			if($result!='')
			{
			 echo $result;
			 
			}
		   }
	
	
	}
}