<?php
class Inbox extends CI_Controller {

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
			$this->load->view('mail_inbox');
			$this->load->view('user_dashboard/right_sidebar');
			
			$this->load->view('footer');
		}
		else
		{
			  redirect('login', 'refresh');
		}
    }
	
	public function mail_inbox_delete()
	{
		 if (isset($_POST['mail_ids'])) 
			{
				$this->load->model('comman_function');
				$result = $this->comman_function->mails_delete($_POST['mail_ids']);
				if($result!='')
				{
					echo $result;
					
				}
			}
	
	
	}
	
	public function mails_search()
	{
		if (isset($_POST['search_mail'])) 
		{
			$this->load->model('comman_function');
			$result = $this->comman_function->mail_searching($_POST['search_mail']);
			if($result!='')
			{
				echo $result;
				
			}
		}
	}
}
?>