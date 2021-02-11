<?php

class Signup extends CI_Controller {
 
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/blog
     *  - or -  
     *      http://example.com/index.php/blog/index
     *  - or -  
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/blog/{method_name}
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
	
	public function index()
    {
		$data1['title'] = 'Signup';
		$this->load->view('header1',$data1);
		
	
		$load_form = $this->input->post('run_code');
		if($load_form=='')
		{
			$data['msg'] = '';
			$this->load->view('signup_form',$data);
			
		}
		else
		{	
			$msg=$this->sign_process();
			$data['msg'] = $msg;
			$this->load->view('signup_form',$data);
			
		}
		
		$this->load->view('footer');
    }
	public function sign_process()
	{
		 $this->load->model('signup_model');
        // Validate the user can login
        $result = $this->signup_model->valide_reg();
        // Now we verify the result
        if($result){
		
				// If user did validate, 
				// Send them to members area
				
			$msg = '<div class="success"><p>Congratulation, You have registered on website successfully, Please check your email for email verification.</p></div>';
				
				
				
           return($msg);
        }        
		else
		{
          // If user did not validate, then show them login page again
             $msg = '<div class="error"><p>Oppss! You have register already with same email id please contact to administrator or use different email id.</p></div>';
            return $msg;  
		}
	
	}

		public function get_states(){
	
			if ($_POST['id']) {
				
				$id=$_POST['id'];
				$this -> db -> select('*');
				$this -> db -> from('states');
				$this -> db -> where('country_name',$id);
				$query = $this->db->get();
			
				echo '<option selected="selected">Selects State :</option>';
				foreach ($query->result() as $row)
				{
			
				echo  '<option value="'.$row->state_id.'">'.$row->name.'</option>';
			
				}
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
		
			echo  '<option value="'.$row->name.'">'.$row->name.'</option>';
		
			}
			
		}
		
	}
	
	
	
}



?>