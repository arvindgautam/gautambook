<?php
class Readmessage extends CI_Controller {

     public function index()
    {

         if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['name'];
			$id = $session_data['userid'];
			$this->load->view('header', $data);
			 $this->load->model('comman_function');
				// Validate the user can login
				$user_role = $this->comman_function->get_user_role();
				
				if($user_role==1)
				{
					$data['result'] = $this->comman_function->user_profile_info($id);
					$this->load->view('user_dashboard/left_sidebar',$data);	
				}
				elseif($user_role==0)
				{
					$this->load->view('admin/left_sidebar',$data);	
				}
				$compose = $this->input->post('compose_mails');
				if($compose=='compose')
				{
					$user_mail_msg = $this->comman_function->compose_mail();
					$user_data['user_mail_msg'] = $user_mail_msg;
					$this->load->view('message',$user_data);
				}
				else
				{
					$user_data['user_mail_msg'] = '';
					$this->load->view('message',$user_data);
				}
			
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