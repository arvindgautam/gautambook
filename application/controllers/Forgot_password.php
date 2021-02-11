<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class forgot_password extends CI_Controller {

	
	 
	public function index()
	{
		$data1['title'] = "Forgot Password";
		$this->load->view('header1',$data1);
		$pass = $this->input->post('reset_pass');
		if(!empty($pass))
		{
			$message = $this->change_pass();
			$data['message'] = $message;
			$this->load->view('forgot_password',$data);
		}
		else
		{
			$data['message'] = '';
			$this->load->view('forgot_password',$data);
		}
		$this->load->view('footer');
	
	}
	
	public function change_pass()
	{
		$this->load->model('Resetpassword_model');
		$result = $this->Resetpassword_model->reset_pass();
		if($result)
		{
			
			return $result;
		}
		
		
	
	}
}