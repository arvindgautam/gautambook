<?php

class Addmatrimony extends CI_Controller {
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
				$this->load->view('user_dashboard/addmatrimony',$data);
				
			}
			else
			{	
				$msg = $this->upload();
				$data['msg'] = $msg;
				$this->load->view('user_dashboard/addmatrimony',$data);
				
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
			$session_data = $this->session->userdata('logged_in');
			$id = $session_data['userid'];
			$user_name = $this->input->post('name');
			$gender = $this->input->post('gender');
			$father_name = $this->input->post('father_name');
			$current_address = $this->input->post('current_address');
			$contact_no = $this->input->post('phone_no');
			$day = $this->input->post('day');
			$month = $this->input->post('month');
			$year = $this->input->post('year');
			$date_of_birth = $year.'/'.$month.'/'.$day;  
			$profession = $this->input->post('Profession');
			$father_gotra = $this->input->post('father_gotra');
			$mother_gotra = $this->input->post('mother_gotra');
			$qualification = $this->input->post('qualification');
			$metri_for = $this->input->post('metri_for');
			$email_id = $this->input->post('email_id');
			$permenant_address = $this->input->post('permenant_address');
			$city = $this->input->post('city');
			$state = $this->input->post('state');
			$annual_income = $this->input->post('annual_income');
			$challenged = $this->input->post('challenged');
			$father_occupation = $this->input->post('father_occupation');
			$mother_occupation = $this->input->post('mother_occupation');
			$mother_tounge = $this->input->post('mother_tounge');
			$nakshatra = $this->input->post('nakshatra');
			$rashi = $this->input->post('rashi');
			$about_boy = mysql_real_escape_string($this->input->post('about_boy'));
			$about_boy_family = mysql_real_escape_string($this->input->post('about_boy_family'));
			$feet = $this->input->post('feet');
			$inch = $this->input->post('inch');
			$diet = $this->input->post('diet');
			$Body_Type = $this->input->post('Body_Type');
			$Complexion = $this->input->post('Complexion');
			$blood_group = $this->input->post('blood_group');
			
			 
			$mars = $this->input->post('radio');
			$file_name = $this->input->post('userfile');
			$file_named = '';
		
			if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") 
			{
				$files = $_FILES;
				
			if(isset($files['userfile']['name'][0]) and !empty($files['userfile']['name'][0]))
			{
				 $cpt = count($_FILES['userfile']['name']);
				for($i=0; $i<$cpt; $i++) 
				{
					
					$_FILES['userfile']['name']= $files['userfile']['name'][$i];
					$_FILES['userfile']['type']= $files['userfile']['type'][$i];
					$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
					$_FILES['userfile']['error']= $files['userfile']['error'][$i];
					$_FILES['userfile']['size']= $files['userfile']['size'][$i];
					//$this->upload->initialize($this->set_upload_options());
					//$this->upload->do_upload();
					
					$fileName = $_FILES['userfile']['name'];
					$attachement_tmp = $_FILES['userfile']['tmp_name'];
					
					$temp  =  explode('.',$_FILES['userfile']['name']);
					$file_ext = strtolower(end($temp));
					$newname = md5(rand(1,100000).time()).'.'.$file_ext;
					$upload_path_attch = '/home/gautafth/public_html/assets/matrimonial-image/'.$newname;
					move_uploaded_file($attachement_tmp,$upload_path_attch); 
					
					//echo $fileName;
					
					$images[] = $newname;
					
				}
				$fileName = implode(',',$images);
				if($fileName!='')
				{
					$filename1 = explode(',',$fileName);
					$upload_file_nm = '';
					foreach($filename1 as $file)
					{
						$new_file_name=rand(0,10000);
						$new_file_name=md5($new_file_name.time());
						$this->load->library('image_lib');
						
						$config['image_library'] = 'gd2';
						$config['new_image'] ='/home/gautafth/public_html/assets/matrimonial-image/matrimonial-thumbs/'.$new_file_name.'-150x150.jpg';
						$config['source_image'] = '/home/gautafth/public_html/assets/matrimonial-image/'.$file;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = FALSE;
						$config['width']     = 150;
						$config['height']   = 150; 
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$config['image_library'] = 'gd2';
						$config['new_image'] ='/home/gautafth/public_html/assets/matrimonial-image/matrimonial-thumbs/'.$new_file_name.'-300x300.jpg';
						$config['source_image'] = '/home/gautafth/public_html/assets/matrimonial-image/'.$file;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = FALSE;
						$config['width']     = 300;
						$config['height']   = 300; 
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$config['image_library'] = 'gd2';
						$config['new_image'] ='/home/gautafth/public_html/assets/matrimonial-image/matrimonial-thumbs/'.$new_file_name.'-600x600.jpg';
						$config['source_image'] = '/home/gautafth/public_html/assets/matrimonial-image/'.$file;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = TRUE;
						$config['width']     = 700;
						$config['height']   = 400; 
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();

						$upload_file_nm .= $new_file_name.',';
					}
					unlink('/home/gautafth/public_html/assets/matrimonial-image/'.$file);
					$file_named = rtrim($upload_file_nm,',');
				}
			}				
		}
		
			$this->db->query("insert into matrimonial (user_id,user_name,gender,father_name,current_address,contact_no,d_o_b,profession,father_gotra,mother_gotra,mars,use_img,qualification,profile_create_for,email_id,permanent_address,city,state,annual_income,challenged,fathers_occupation,mothers_occupation,nakshatra,rashi,about_boy,about_boy_family,feet,inch,diet,Body_Type,Complexion,blood_group) values('$id','$user_name','$gender','$father_name','$current_address','$contact_no','$date_of_birth','$profession','$father_gotra','$mother_gotra','$mars','$file_named','$qualification','$metri_for','$email_id','$permenant_address','$city','$state','$annual_income','$challenged','$father_occupation','$mother_occupation','$nakshatra','$rashi','$about_boy','$about_boy_family','$feet','$inch','$diet','$Body_Type','$Complexion','$blood_group')");
            $data = '<div class="alert alert-success text-center">Your Matrimonial has been successfully Create!</div>';
			return $data; 
		
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