<?php

class Relations extends CI_Controller {


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
				
				$relations['result'] = '';
				
				$this->load->view('relation',$relations);
			}
			elseif($load_forms=='add_relation')
			{
				$result = $this->relation_process();
				$user_data['result'] = $result;
				$this->load->view('relation',$user_data); 
			}
			else{
				
				$result = $this->edit_relation_process();
				$user_data['result'] = $result;
				$this->load->view('relation',$user_data);
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
	public function relation_process()
	{
		 $this->load->model('Relation_model');
        // Validate the user can login
        $result = $this->Relation_model->valide_relation();
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
	
	public function edit_relation_process()
	
	{
		$this->load->model('Relation_model');
        // Validate the user can login
        $results = $this->Relation_model->edit_relation();
        // Now we verify the result
        if($results){
		
				// If user did validate, 
				// Send them to members area
			$msg = '<div class="success"><p>Your Relation update successfully</p></div>';
           return($msg);
        }        
		else
		{
          // If user did not validate, then show them login page again
             $msg = '<div class="error"><p>Sorry! Your Relation not updated.</p></div>';
            return $msg;  
		}
	}
	public function delete_relation()
	{
		  if (isset($_POST['relation_id'])) 
			{
				$this->load->model('comman_function');
				$result = $this->comman_function->delete_relation($_POST['relation_id']);
				if($result!='')
				{
					echo $result;
					
				}
			}
	  
	}

}
?>