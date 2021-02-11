<?php

class Gotra extends CI_Controller {


	public function index()
	{
		 if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['name'];
			$this->load->view('header', $data);	
			$this->load->view('admin/left_sidebar',$data);	
			$load_forms = $this->input->post('run_codes');
			if($load_forms=='')
			{
				
				$gotras['result'] = '';
				
				$this->load->view('Gotra_form',$gotras);
			}
			elseif($load_forms=='add_gotra')
			{
				$result = $this->gotra_process();
				$user_data['result'] = $result;
				$this->load->view('Gotra_form',$user_data); 
			}
			else{
				
				$result = $this->edit_gotra_process();
				$user_data['result'] = $result;
				$this->load->view('Gotra_form',$user_data);
			}
		
			$this->load->view('admin/right_sidebar');
			$this->load->view('footer');
		}
		else
		{
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}
		
	
	}
	public function gotra_process()
	{
		 $this->load->model('gotra_form_model');
        // Validate the user can login
        $result = $this->gotra_form_model->valide_gotra();
        // Now we verify the result
        if($result){
		
				// If user did validate, 
				// Send them to members area
			$msg = '<div class="success"><p>Your Gotra successfully saved</p></div>';
           return($msg);
        }        
		else
		{
          // If user did not validate, then show them login page again
             $msg = '<div class="error"><p>Sorry! Your gotra already exist.</p></div>';
            return $msg;  
		}
	
	}
	
	public function edit_gotra_process()
	
	{
		$this->load->model('gotra_form_model');
        // Validate the user can login
        $results = $this->gotra_form_model->edit_gotras();
        // Now we verify the result
        if($results){
		
				// If user did validate, 
				// Send them to members area
			$msg = '<div class="success"><p>Your Gotra update successfully</p></div>';
           return($msg);
        }        
		else
		{
          // If user did not validate, then show them login page again
             $msg = '<div class="error"><p>Sorry! Your gotra not updated.</p></div>';
            return $msg;  
		}
	}
	public function delete_gotra_process()
	
	{
		if (isset($_POST['id'])) 
		{
			$this->load->model('gotra_form_model');
			// Validate the user can login
			$results = $this->gotra_form_model->delete_gotras($_POST['id']);
			// Now we verify the result
			if($results){
			
					// If user did validate, 
					// Send them to members area
				$msg = '<div class="success"><p>Your Gotra delete successfully</p></div>';
			   return($msg);
			}        
			else
			{
			  // If user did not validate, then show them login page again
				 $msg = '<div class="error"><p>Sorry! Your gotra not deletes.</p></div>';
				return $msg;  
			}
		}
	}

}
?>