<?php

class Admin extends CI_Controller {
 
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/blog
     *  - or -  
     *      http://example.com/index.php/blog/index
     *  - or -  
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/blog/{method_name}
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
		if($this->session->userdata('logged_in'))
		{
		   $this->load->model('comman_function');
        // Validate the user can login
			$user_role = $this->comman_function->get_user_role();
			
			if($user_role==0)
			{
				$session_data = $this->session->userdata('logged_in');
				$data['username'] = $session_data['name'];
				$this->load->view('header', $data);
				$this->load->view('admin/left_sidebar',$data);
				$this->load->view('admin/dashboard');
				$this->load->view('admin/right_sidebar');
			}
			else
			{
				redirect('dashboard', 'refresh');
			}
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