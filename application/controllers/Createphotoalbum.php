<?php

class Createphotoalbum extends CI_Controller {


	public function index()
	{
		 if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['name'];
			$this->load->model('comman_function');
			$this->load->view('header', $data);	
			$this->load->view('admin/left_sidebar',$data);
				$updated = $this->input->post('add_album');
				if(!empty($updated))
				{
					$post_msg = $this->comman_function->create_album();
					$post_data['post_msg'] = $post_msg;
					$this->load->view('admin/create_album',$post_data);
				}
				else
				{
					$post_data['post_msg'] = '';
					$this->load->view('admin/create_album',$post_data);
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