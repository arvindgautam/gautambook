<?php

class Editmetrimonial extends CI_Controller {

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
			
			if($user_role==1 || $user_role==2)
			{
				$data['result'] = $this->comman_function->user_profile_info($id);
				$this->load->view('user_dashboard/left_sidebar',$data);	
			}
			elseif($user_role==0)
			{
				$this->load->view('admin/left_sidebar',$data);	
			}
			
			
			
			$updated = $this->input->post('run_code');
			if($updated!='')
			{
				$this->load->model('comman_function');
				$user_msg = $this->comman_function->edit_matrimonialss();
				$user_data['user_msg'] = $user_msg;
				$this->load->view('user_dashboard/edit_metrimonial',$user_data);
				if($user_role==1 || $user_role==2)
				{
				redirect('matrimoniallist', 'refresh');
				}
				elseif($user_role==0)
				{
				redirect('adminmatrimonial', 'refresh');
				}
				
				}
				else
				{
				$user_data['user_msg'] = '';
				$this->load->view('user_dashboard/edit_metrimonial',$user_data);
			}
			$this->load->view('footer');
		}
		else
		{
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}
		
	
	}
	public function get_city()
	{
		if ($_POST['id']) 
		{
		
			$id=$_POST['id']; 

			$query=$this -> db ->query("SELECT * FROM cities WHERE state_nm = $id");  
			
			echo '<option  value="">Selects City:</option>';
			foreach ($query->result() as $row)
			{
		
			echo  '<option value="'.$row->id.'">'.$row->name.'</option>';
		
			}
			
		}
		
	}
}
?>