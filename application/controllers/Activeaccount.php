<?php

class Activeaccount extends CI_Controller {


	public function index(){
		$data1['title'] = "Active Account";
		$this->load->view('header1',$data1);
		$this->load->view('activation_link');
		
		$this->load->view('footer');
	}
}
?>