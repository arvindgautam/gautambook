<?php

class Login extends CI_Controller {
 
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
		$data1['title'] = "Login";
		$this->load->view('header1',$data1);
		
		if($this->session->userdata('logged_in'))
		{
			$this->load->model('comman_function');
			$result = $this->comman_function->get_user_role();
			
			
			if($result==0)
			{
				redirect('admin');
			}
			elseif($result==1||$result==2)
			{
				redirect('dashboard');
			}
			
		}
		else
		{
			$load_form = $this->input->post('login_text');
			if($load_form=='')
			{
				$data['error'] = '';
				$this->load->view('login_form',$data);
			}
			else
			{	
				$this->load->view('header1');
				$error=$this->process(); 
				$data['error'] = $error;
				$this->load->view('login_form',$data);
				
			}
		}
			$this->load->view('footer');
			
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
				
					redirect('dashboard');
				
			
        }
		else if($result=='admin')
		{
			
			redirect('admin');
				
		}
		
    }
	public function search_profile()
	{
		$search_data = $this->input->post('search_data');
		//echo $search_data;
		$this->load->model('comman_function');
		$result = $this->comman_function->get_autocomplete($search_data);
		if($result!='')
		{
			echo $result;
		}
	
	}
	
}



?>