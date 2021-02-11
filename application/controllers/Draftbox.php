<?php
class Draftbox extends CI_Controller {

     public function index()
    {

         if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['name'];
			$this->load->view('header', $data);
			 $this->load->model('comman_function');
				// Validate the user can login
				$user_role = $this->comman_function->get_user_role();
				
				if($user_role==1)
				{
					$this->load->view('user_dashboard/left_sidebar',$data);	
				}
				elseif($user_role==0)
				{
					$this->load->view('admin/left_sidebar',$data);	
				}
			$this->load->view('draftbox_mail');
			$this->load->view('user_dashboard/right_sidebar');
			$this->load->view('footer');
		}
		else
		{
			  redirect('login', 'refresh');
		}
    }
}
?>