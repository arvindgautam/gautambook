<?php
class Thank extends CI_Controller {

     public function index()
    {
		$data['title'] = "Thanks";
       $this->load->view('header1',$data);
		$this->load->view('thanks');
		$this->load->view('footer');
    }
}
?>