<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	 
	public function index()
	{
		 if($this->session->userdata('logged_in'))
		{
			
			  $this->load->model('comman_function');
			// Validate the user can login
			$user_role = $this->comman_function->get_user_role();
			
			if($user_role==1 || $user_role==2)
			{
				$updated = $this->input->post('add_post');
				if(!empty($updated))
				{
					$post_msg = $this->comman_function->create_post();
					$post_data['post_msg'] = $post_msg;
					$this->load->view('user_dashboard/dashboard',$post_data);
				}
				else
				{
					$post_data['post_msg'] = '';
					$this->load->view('user_dashboard/dashboard',$post_data);
				}
			}
			else{
			
				//$this->load->view('admin/dashboard');
				redirect('admin', 'refresh');
			}
			$this->load->view('footer');
		}
		else
		{
		  //If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	
	public function post_like(){
	
		if (isset($_POST['post_id'])) {
		  $this->load->model('comman_function');
		 $result = $this->comman_function->user_post_like($_POST['post_id']);
		 if($result!='')
		 {
			echo $result;
		 }
      
		}
	
	}
	public function post_comment()
	{
		if (isset($_POST['postid'])) 
		{
			$this->load->model('comman_function');
			$result = $this->comman_function->user_post_comment($_POST['postid']);
			if($result!='')
			{
				echo $result;
			}
		}
	
	
	}
	
	public function next_post()
	{
		 if (isset($_POST['posted_ids'])) 
		   {
			$this->load->model('comman_function');
			$result = $this->comman_function->next_post_show($_POST['posted_ids']);
			if($result!='')
			{
			 echo $result;
			 
			}
		   }
	
	}
	
	public function edit_user_post()
	{
		if (isset($_POST['edit_post_cont'])) 
		   {
			$this->load->model('comman_function');
			$result = $this->comman_function->user_edits_post($_POST['edit_post_cont']);
			if($result!='')
			{
			 echo $result;
			 
			}
		   }
	
	}
	
	public function get_post_datas()
	{
		if (isset($_POST['edit_post'])) 
		{
			$this->load->model('comman_function');
			$results = $this->comman_function->edit_user_posts($_POST['edit_post']);
			if($results!='')
			{
			 echo $results;
			 
			}
		
		}
	
	}
	
	public function delete_post()
	
	{
		if (isset($_POST['post_id'])) 
		{
			$this->load->model('comman_function');
			// Validate the user can login
			$results = $this->comman_function->delete_posts($_POST['post_id']);
			// Now we verify the result
			if($results){
			
					// If user did validate, 
					// Send them to members area
				$msg = '<div class="success"><p>Your POst delete successfully</p></div>';
				
			   return($msg);
			}        
			else
			{
			  // If user did not validate, then show them login page again
				 $msg = '<div class="error"><p>Sorry! Your post not deletes.</p></div>';
				return $msg;  
			}
		}
	}
	
}

