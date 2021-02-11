<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Change_password extends CI_Controller {


	public function index() 
	{
		 if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['name'];
			$this->load->view('header', $data);
		
		}
		else
		{
			 $data1['title'] = "Reset Password";
			$this->load->view('header1', $data1);
		}
				
			$passwords = $this->input->post('change_pass');	
			if($passwords!='')
			{	
				
				$change_passwrd = $this->reset_passwrd();
				$data['msg'] = $change_passwrd;
				$this->load->view('resetpass',$data);
			}
			else
			{
				$data['msg'] = '';
				$this->load->view('resetpass',$data);
			}
			
			
			$this->load->view('footer');
	
		
	}
	public function reset_passwrd()
	{
		$this->load->model('comman_function');
		$messages = $this->comman_function->reset_change_pass();
		if($messages!='')
		{
			return $messages;
		}
	
	}
	
}
?>
