<?php
class Viewalbum extends CI_Controller {
  function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }
	public function index()
	{
		
			
		
		 if($this->session->userdata('logged_in'))
		{
			
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['name'];
			$id = $session_data['userid'];
			$this->load->view('header', $data);
			$this->load->model('comman_function');
        // Fetch the result from the database
			$data['result'] = $this->comman_function->user_profile_info($id);
			$this->load->view('user_dashboard/left_sidebar',$data);
			$this->load->view('user_dashboard/view_album');
			
		
		}
		else
		{
			$data1['title'] = "View Album";
			$this->load->view('header1',$data1);
			$this->load->model('comman_function');
			$this->load->view('user_dashboard/view_album');
		}
			$this->load->view('footer');
	}
	public function more_album_load()
	{
		 if (isset($_POST['posted_ids'])) 
		   {
			$this->load->model('comman_function');
			$result = $this->comman_function->album_post_show($_POST['posted_ids']);
			if($result!='')
			{
			 echo $result;
			 
			}
		   }
	
	
	}
	public function view_album_popup()
	{
		if (isset($_POST['albums_id'])) 
		   {
			$this->load->model('enable_popup_model');
			$result = $this->enable_popup_model->popup_data_load($_POST['albums_id']);
			if($result!='')
			{
			 echo $result;
			 
			}
		   } 
	
	}
}