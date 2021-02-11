<?php

class Help extends CI_Controller {
 
   
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
			$data1['title'] = "help";
			$this->load->view('header1',$data1);
		}
			$helps = $this->input->post('help_text');
			if(!empty($helps))
			{
				$test=$this->user_help();
				$data['msg'] = $test;
				$this->load->view('helpview',$data);
			}
			else{
				$data['msg'] = '';
				$this->load->view('helpview',$data);
			}
			
			$this->load->view('footer');
    }
	
	public function user_help()
	{
		$this->load->model('Help_model');
		$insert = $this->Help_model->insert_data();
		if($insert!='')
		{
			return $insert;
		}
	
	}
	
}



?>