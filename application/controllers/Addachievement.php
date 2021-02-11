<?php

class Addachievement extends CI_Controller {
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
			 
			// Validate the user can login
			$data['result'] = $this->comman_function->user_profile_info($id);
			$this->load->view('user_dashboard/left_sidebar',$data);
			$load_form = $this->input->post('run_code');
			if($load_form=='')
			{
				$data['msg'] = '';
				$this->load->view('user_dashboard/add_achievement',$data);
				
			}
			else
			{	
				$msg = $this->upload();
				$data['msg'] = $msg;
				$this->load->view('user_dashboard/add_achievement',$data);
				
			}			
			
			
			$this->load->view('user_dashboard/right_sidebar');
			$this->load->view('footer');
		}
		else
		{
		  //If no session, redirect to login page
		  redirect('login', 'refresh');
		}
		
	
	}
	 function upload()
    {
        //set preferences
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['userid'];
		$title = $this->input->post('title');
		$day = $this->input->post('day');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$dates = $year.'/'.$month.'/'.$day;
		
		$config['upload_path'] = '/home/gautafth/public_html/assets/achievement-image/';
		$config['allowed_types'] = 'png|jpg|gif';
		$config['max_size'] = '300';
		$config['max_width'] = '2524'; /* max width of the image file */
		$config['max_height'] = '2068'; /* max height of the image file */
    

        //load upload class library
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('filename'))
        { 
            // case - failure
            $upload_errors = $this->upload->display_errors();
			$upload_error = '<div class="error"><p>Please upload valide Size!</p></div>';
           return $upload_error;
        }
        else
        {
            // case - success
			
            $upload_data = $this->upload->data();
			$image = $upload_data['file_name'];
			$new_file_name=rand(0,10000);
			$new_file_name=md5($new_file_name.time()); 
			$this->load->library('image_lib');

			$config['image_library'] = 'gd2';
			$config['new_image'] ='/home/gautafth/public_html/assets/achievement-image/achievement-thumb/'.$new_file_name.'-90x90.jpg';
			$config['source_image'] = '/home/gautafth/public_html/assets/achievement-image/'.$image;
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = FALSE;
			$config['width']     = 90;
			$config['height']   = 90; 
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$config['image_library'] = 'gd2';
			$config['new_image'] ='/home/gautafth/public_html/assets/achievement-image/achievement-thumb/'.$new_file_name.'-600x600.jpg';
			$config['source_image'] = '/home/gautafth/public_html/assets/achievement-image/'.$image;
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width']     = 600;
			$config['height']   = 400; 
			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			unlink('/home/gautafth/public_html/assets/achievement-image/'.$image);
			$this->db->query("insert into user_achievement(achiv_title,user_id,achive_date,achiv_img)values('$title','$id','$dates','$new_file_name')");
            $data = '<div class="alert alert-success text-center">Your Achievement was successfully Create!</div>';
			return $data;
            
        }
    }
	
	

}
?>