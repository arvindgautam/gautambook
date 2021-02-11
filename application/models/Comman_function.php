<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Comman_function extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
    // get user role
    public function get_user_role(){
 
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['userid'];
       $this -> db -> select('user_role');
	   $this -> db -> from('users');
	   $this -> db -> where('id', $id);
	   $this -> db -> limit(1);
	 
	   $query = $this -> db -> get();
	 
		$query -> num_rows();
	   
		$qry = $query->row();
		$user_type = $qry->user_role;
		return $user_type;
	  
	  
    }
	
	// get gotra
	public function get_gotra()
	{
	
		$query = $this->db->query('SELECT * FROM user_gotra');
		$gotra_data;
		
		foreach ($query->result() as $row)
		{
		
		$gotra_data[] = array(
						'gotra_id' => $row->id,
						'gotra_names' => $row->gotra_name
						);
		}
		
		return $gotra_data;
		
	}
	// update user profile
	public function update_profile()
	{
	
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['userid'];
		$this->db->select('*');
		$this->db->from('users as us');
		$this->db->join('user_info as uf', 'us.id = uf.user_id');
		$this -> db -> where('us.id', $id);
		$query = $this->db->get();
	 
		$query -> num_rows();
	   
		$qry = $query->row();
		
		$f_name = $this->input->post('fname');
        $l_name = $this->input->post('lname');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone_num');
		$father_nm = $this->input->post('father_name');
		$gender = $this->input->post('genders');
		$gotra = $this->input->post('gotra');
		$phone_num_show = $this->input->post('phone_num_show');
		$email_id_show = $this->input->post('email_id_show');
		
		$perma_vill_nm = $this->input->post('vill_nm');
		$perma_vill_country = $this->input->post('per_country');
		$perma_vill_distt = $this->input->post('per_city');
		$perma_states = $this->input->post('per_state');
		$current_vill_nm = $this->input->post('cur_vill_nm');
		$current_vill_country = $this->input->post('curr_country');
		$current_vill_dist = $this->input->post('curr_city');
		$current_states = $this->input->post('curr_state');
		$reference_link = $this->input->post('reference');
		$material_status = $this->input->post('Material_Status');
		$eduction = $this->input->post('eduction');
		$profession = $this->input->post('profession');
		$Facebook_link = $this->input->post('Facebook_link');
		$Twitter_link = $this->input->post('Twitter_link');
		$your_self = $this->input->post('text_editor');
		$dob_day = $this->input->post('day');
		$dob_month = $this->input->post('month');
		$dob_year = $this->input->post('year');
		$dob = $dob_day.'/'.$dob_month.'/'.$dob_year;
		$display_nm = $f_name.' '.$l_name;
		$user_img = $this->input->post('image_name');
		$cover_image = $this->input->post('cover_image');
		$permanent_state_id = (int)$perma_states;
		$current_state_id = (int)$current_states;
		$perma_state = $this->Get_State_By_ID($permanent_state_id);
		$current_state = $this->Get_State_By_ID($current_state_id); 
		if(!empty($user_img))
		{
			$user_img_link = $user_img;
		}
		else
		{
			$user_img_link = $qry->user_img;
		}
		if(!empty($cover_image))
		{
			$user_cover_image = $cover_image;
		}
		else
		{
			$user_cover_image = $qry->cover_img;
		}
		 
		$this->db->query("UPDATE users SET user_email = '$email', display_name='$display_nm',show_email_id='$email_id_show'  WHERE id = $id"); 
		$this->db->query("UPDATE user_info SET first_name = '$f_name', last_name='$l_name',father_name = '$father_nm', contact_no='$phone', gender = '$gender', gotra='$gotra', ref_link = '$reference_link', dob='$dob', current_vill_name = '$current_vill_nm', current_country='India', current_dist='$current_vill_dist', current_state='$current_state',perma_vill_name = '$perma_vill_nm', perma_country='India',perma_dist = '$perma_vill_distt', perma_state='$perma_state',profession = '$profession',education='$eduction', material_status = '$material_status',facebook_link='$Facebook_link', twitter_link = '$Twitter_link',about_us='$your_self', user_img='$user_img_link',cover_img='$user_cover_image',show_phone_no='$phone_num_show' WHERE user_id = $id");
		
		$msg = '<div class="success"><p>Update successfully Saved!</p></div>';
		return $msg;
	}
	
	// create post by user
	public function create_post()
	{
		
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['userid'];
		$data_infos = $this->user_profile_info($id);
		$display_names = $data_infos->display_name;
		$user_id = $data_infos->user_id;
		$userid = base64_encode($user_id);
		$this->load->library('upload');
		$post_title = $this->input->post('post_title');
		$album_id = $this->input->post('add_photos');
		$post_text = mysql_real_escape_string($this->input->post('text_editor'));
		$post_file = $this->input->post('userfile');
		$file_named = '';
		$post_image='';
		
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
					$upload_path_attch = '/home/isprasof/public_html/gautambook/assets/uploads/'.$newname;
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
						$config['new_image'] ='/home/isprasof/public_html/gautambook/assets/uploads/thumbs/'.$new_file_name.'-90x90.jpg';
						$config['source_image'] = '/home/isprasof/public_html/gautambook/assets/uploads/'.$file;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = FALSE;
						$config['width']     = 90;
						$config['height']   = 90; 
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$config['image_library'] = 'gd2';
						$config['new_image'] ='/home/isprasof/public_html/gautambook/assets/uploads/thumbs/'.$new_file_name.'-150x150.jpg';
						$config['source_image'] = '/home/isprasof/public_html/gautambook/assets/uploads/'.$file;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = FALSE;
						$config['width']     = 150;
						$config['height']   = 150; 
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$config['image_library'] = 'gd2';
						$config['new_image'] ='/home/isprasof/public_html/gautambook/assets/uploads/thumbs/'.$new_file_name.'-480x400.jpg';
						$config['source_image'] = '/home/isprasof/public_html/gautambook/assets/uploads/'.$file;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = FALSE;
						$config['width']     = 480;
						$config['height']   = 400; 
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$config['image_library'] = 'gd2';
						$config['new_image'] ='/home/isprasof/public_html/gautambook/assets/uploads/thumbs/'.$new_file_name.'-300x300.jpg';
						$config['source_image'] = '/home/isprasof/public_html/gautambook/assets/uploads/'.$file;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = FALSE;
						$config['width']     = 300;
						$config['height']   = 300; 
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$config['image_library'] = 'gd2';
						$config['new_image'] ='/home/isprasof/public_html/gautambook/assets/uploads/thumbs/'.$new_file_name.'-600x600.jpg';
						$config['source_image'] = '/home/isprasof/public_html/gautambook/assets/uploads/'.$file;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = TRUE;
						$config['width']     = 700;
						$config['height']   = 400; 
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();

						$upload_file_nm .= $new_file_name.',';
					}
					$post_image= '<hr style="color: rgb(207, 93, 66); border-style: dashed;"><img style=" border: 3px solid;" src="http://gautambook.com/assets/uploads/thumbs/'.$new_file_name.'-90x90_thumb.jpg">';
					unlink('/home/isprasof/public_html/gautambook/assets/uploads/'.$file);
					$file_named = rtrim($upload_file_nm,',');
				}
			}				
		}
		
		$this->db->query("insert into user_post (user_id,post_title,post_conetnt,post_img_gallery,post_date,last_update,album_id) values('$id','$post_title','$post_text','$file_named',NOW(),NOW(),'$album_id')"); 
		
			$user_email_bcc20 = '';
			$this->db->distinct();
			$this -> db -> select('user_email');
			$this -> db -> from('users');
			$this->db->where('user_status',1);
			$query = $this -> db -> get();
			/*foreach ($query->result() as $row)
			{
			   $user_email_bcc20 .= $row->user_email.','; 
			   
			}*/
			
		$user_email_bcc20=array('up.gautam@rediffmail.com','dushyantgautam@gmail.com','sgautam1565@gmail.com','neeraj.gautam0529@gmail.com','peeyushgautam@yahoo.com','rkgautam.civillan@gmail.com','anji.g91.ag@gmail.com','gautam25980@yahoo.com','rlgpng@gmail.com','ramram0003@gmail.com','gautam.arv@gmail.com');
				
				$message20 = '<html><body style="background-color: rgb(123, 176, 240); margin: 0px auto; padding: 10px 0px 50px; text-align: center; width: 660px; border-width: 8px 25px; border-style: solid; border-color: rgb(249, 237, 190);""><div><img src="'.base_url().'assets/images/guru.png" height= "150px" width="150px"></div><div  style="color: rgb(255, 255, 255); text-align: left; padding-left: 20px;">';
				$message20 .= 'Hello Dear,<br><p style="font-size: 15px; color: rgb(255, 255, 255);">New article posted on GautamBook.com and Post by: <a href="http://gautambook.com/userprofile?userid='.$userid.'">'.$display_names.', </a><br><span style="font-weight: 600; color: royalblue;"></p>
				<p><strong><a href="http://gautambook.com/userprofile?userid='.$userid.'">'.$this->input->post('post_title').'</a></strong></p>
				<p style="font-size: 15px; color: rgb(255, 255, 255);">'.$this->input->post('text_editor').'</p><br>'.$post_image; 
				$message20 .= '<hr style="color: rgb(207, 93, 66); border-style: dashed;"><div style="color: #fff;font-size: 15px;font-weight: 600;
				"><a href="http://www.gautambook.com">GautamBook.com</a></div>';
				$message20 .= '<p style="font-size: 15px; color: rgb(255, 255, 255);">Thanks & Regards<br>Gautam Community.</p>'; 	  	  		
				$message20 .= '<p style="font-size: 15px; color: rgb(255, 255, 255);">NOTE: Please Dont reply on this email, this is just created by the system.</p></div></body></html>';
				$subject20 = 'New article';  
				$adm_mail = $this->admin_email(); 
				
				$this->sendMail($adm_mail,$message20,$subject20,$user_email_bcc20);         
		
		return true; 
	} 
	private function set_upload_options()
	{ 
  // upload an image options
         $config = array();
         $config['upload_path'] = '/home/isprasof/public_html/gautambook/assets/uploads/'; //give the path to upload the image in folder
         $config['allowed_types'] = 'gif|jpg|png';
          $config['max_size'] = '0';
         $config['overwrite'] = FALSE;
		return $config;
	}
	public function user_post_like($post_id){
		
		$session_data = $this->session->userdata('logged_in');
		$ids = $session_data['userid'];
			$this -> db -> select('*');
			$this -> db -> from('user_post_like');
			$this -> db -> where('user_id', $ids);
			$this -> db -> where('post_id', $post_id);
			$query = $this -> db -> get();
			if ($query -> num_rows() == 1)
			{
			$this->db->where('user_id', $ids);
			$this->db->where('post_id', $post_id);
			$this->db->delete('user_post_like'); 
			$msg = '<button class="btn-default btn-xs" id="'.$post_id.'" onclick="posts_like(this.id)" type="button"><i class="fa fa-thumbs-o-up"></i>Like</button>';
			$this->db->query("update user_post set last_update=NOW() where id=$post_id");
			}
			else
			{
			$this->db->query("insert into user_post_like (user_id,post_id,date) values('$ids','$post_id',NOW())");
			$msg = '<button class="btn-default btn-xs active" id="'.$post_id.'" onclick="posts_unlike(this.id)" type="button"><i class="fa fa-thumbs-o-down"></i>Like</button>';
			$this->db->query("update user_post set last_update=NOW() where id=$post_id");
			}
		return $msg;
	}
	
	public function user_post_comment($postid)
	{
			
		$session_data = $this->session->userdata('logged_in');
		$ids = $session_data['userid'];
		$post_data = $postid;
		$get_post_data = explode(",",$post_data);
		$comment=str_replace(",","\,",$get_post_data[0]);
		//$comment = mysql_real_escape_string($comment);
		$posts_id = $get_post_data[1];
	
			$this->db->query("insert into user_post_comment (user_id,post_id,post_comment,date) values('$ids','$posts_id','$comment',NOW())");
			
				$this -> db -> select('*');
				$this -> db -> from('user_info');
				$this -> db -> where('user_id', $ids);
				$query = $this -> db -> get();
				$qry = $query->row();
				$user_name = $qry->first_name.' '.$qry->last_name;
				$user_thumb = $qry->user_img;
				$timezone = new DateTimeZone("Asia/Kolkata" );
				$date = new DateTime();
				$date->setTimezone($timezone );
				
				if(!empty($user_thumb)) 
				{
					$users_photo = base_url().'assets/ajax/upload/'.$user_thumb;
				}
				else
				{
					$users_photo = base_url().'assets/images/user.png'; 
				}
				$your_comment = '   <div class="box-comment">
								<img alt="User Image" src="'.$users_photo.'" class="img-circle img-sm" style="margin-top: 5px;">

							<div class="comment-text">
							<span class="username">
								'.$user_name.'
							<span class="text-muted pull-right">'.$date->format( 'M j, Y H:i A').'</span>
						  </span>
					  '.$get_post_data[0].'
					</div>
				  </div>';
		$this->db->query("update user_post set last_update=NOW() where id=$posts_id");	
		
				
		return $your_comment;
	}
	
	public function active_users($user_id)
	{
		$action_data = explode(',',$user_id);	
		//print_r($action_data);
		$user_action = $action_data[0];
		$userid = $action_data[1];
		$user_data = $this->user_profile_info($userid);
		$users_email = $user_data->user_email;
		$user_activation_key = $user_data->user_activation_key;
		$first_name = $user_data->first_name;
		$user_name = $user_data->username;
		$pass = rand(1,100000).time();
		$pasword = md5($pass);
		
		
		if($user_action==0) 
		{
			$bcc = '';
			$this->db->query("UPDATE users SET user_status = 0  WHERE id = $userid");	
			$message3 = '<html><body style="background-color: rgb(123, 176, 240); margin: 0px auto; padding: 10px 0px 50px; text-align: center; width: 660px; border-width: 8px 25px; border-style: solid; border-color: rgb(249, 237, 190);""><div><img src="'.base_url().'assets/images/guru.png" height= "150px" width="150px"></div><div  style="color: rgb(255, 255, 255); text-align: left; padding-left: 20px;">';
			$message3 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);"> Hello '.$first_name.'</p>';
			$message3 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);"> Your account has been deactivated  Please contact to admin</p>';
			$message3 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">Thanks & Regards<br>Gautam Community</p>';
			$message3 .= '<div style=" color: #fff;font-size: 17px;font-weight: 600;text-align: left;padding-left:0px;
			"><a href="http://community.isprasoft.com/" target="_blank" style="color:white; position: relative;top:20px; text-decoration: none; " ><a href="http://www.gautambook.com">GautamBook.com</a></div>';
			$message3 .= '<p style="font-size: 17px; margin-left: -80px; color: rgb(255, 255, 255);">NOTE: Please Dont reply on this email, this is just created by the system.</p></div></body></html>';
			$subject3='Account deactivation';
			$email_id3 = $users_email ;  
			
			$this->sendMail($email_id3,$message3,$subject3,$bcc);
			$msg = 'this account now deactivate';
			return $msg;	
		}
		elseif($user_action==1)
		{ 
			$bcc = '';
			$this->db->query("UPDATE users SET user_status = 1 ,user_activation_key ='' WHERE id = $userid");
			$message4 = '<html><body style="background-color: rgb(123, 176, 240); margin: 0px auto; padding: 10px 0px 50px; text-align: center; width: 660px; border-width: 8px 25px; border-style: solid; border-color: rgb(249, 237, 190);""><div><img src="'.base_url().'assets/images/guru.png" height= "150px" width="150px"></div><div  style="color: rgb(255, 255, 255); text-align: left; padding-left: 20px;">';
			$message4 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);"> Hello '.$first_name.'</p>';
			$message4 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">We thank you for join your community on gautambook.com</p>';
			$message4 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">we have fully activated your account on the website , so you can use this now. we requested you to share all the things happening in your area in gautam family so we all aware with that.</p>';
			$message4 .= '<p style="font-weight: 600; font-size: 15px; color: rgb(255, 255, 255);">Note: Please share your ideas or Feedback if you have any for this website to make better.</p>';
			$message4 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">Thanks & Regards<br>Gautam Community</p>';			
			$message4 .= '<div style=" color: #fff;font-size: 15px;font-weight: 600;
			text-align: left; padding-left:0px;"><a href="http://community.isprasoft.com/" target="_blank" style="color:white; position: relative;top:20px; text-decoration: none; " ><a href="http://www.gautambook.com">GautamBook.com</a></div>';
			$message4 .= '<p style="font-size: 17px; margin-left: -80px; color: rgb(255, 255, 255);">NOTE: Please Dont reply on this email, this is just created by the system.</p></div></body></html>';

			$subject4='Account activation';
			$email_id4 = $users_email;
			
			$this->sendMail($email_id4,$message4,$subject4,$bcc);	
			$msg = 'this account now activate';
				return $msg;			
		}
		elseif($user_action==2) 
		{
			$bcc = '';
			$this->db->query("UPDATE users SET user_status = 2  WHERE id = $userid");
			
		
				$message5 = '<html><body style="background-color: rgb(123, 176, 240); margin: 0px auto; padding: 10px 0px 50px; text-align: center; width: 660px; border-width: 8px 25px; border-style: solid; border-color: rgb(249, 237, 190);"><div><img src="'.base_url().'assets/images/guru.png" height= "150px" width="150px"></div><div  style="color: rgb(255, 255, 255); text-align: left; padding-left: 20px;">';
				$message5 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">Hello '.$first_name.'</p>';  
				$message5 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">We thank you for join your community on gautambook.com</p>';
				$message5 .= '<p style=" font-size: 17px; color: rgb(255, 255, 255);">we are verifying you based on the provided details, we will follow the following steps for verification.</p>';
				$message5 .= '<p style=" font-size: 17px; color: rgb(255, 255, 255);">Our registration process:</p>';
				$message5 .= '<ol style="  text-align: left;  color:#fff;  font-size: 17px; color: rgb(255, 255, 255);">
									<li>Email Verification (it Will be at your end).</li>
									<li>We will do manual verification (Based on the addess and GOTRA).</li>
									<li>After verification your account will be active.</li>
									<li>Now Enjoy with your Family.</li></ol>';
				$message5 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">Our team will contact to you soon via call on you provided contact no.</p>';
				$message5 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">Thanks & Regards<br>Gautam Community</p>';		
				$message5 .= '<div style="color: #fff;font-size:15px;font-weight: 600;
				text-align: left; padding-left:0px;"><a href="http://community.isprasoft.com/" target="_blank" style="color:white; position: relative;top:5pxpx; text-decoration: none; " > <a href="http://www.gautambook.com">GautamBook.com</a></div>'; 
				$message5 .= '<p style="font-size: 17px; margin-left:-80px; color: rgb(255, 255, 255);">NOTE: Please Dont reply on this email, this is just created by the system.</p></div></body></html>';

				$subject5='Account under reviews';
				$email_id5 = $users_email;
				
				$this->sendMail($email_id5,$message5,$subject5,$bcc);
				$msg = 'this account has been under review';
				
				
				return $msg;	
		}
			
		elseif($user_action==3)
		{
			$bcc = '';
		
				$message10 = '<html><body style="background-color: rgb(123, 176, 240); margin: 0px auto; padding: 10px 0px 50px; text-align: center; width: 660px; border-width: 8px 25px; border-style: solid; border-color: rgb(249, 237, 190);"><div><img src="'.base_url().'assets/images/guru.png" height= "150px" width="150px"></div><div  style="color: rgb(255, 255, 255); text-align: left; padding-left: 20px;">';
				$message10 .= '<p style="font-size:17px;color:rgb(255,255,255);text-align: left;padding-left: 20px;"><br>Hello '.$first_name.' To active your account please confirm your email id . our team member will call you shortly to make complete verification and active your account.</p>';
				
				$message10 .= '<p style="font-size:17px;color:rgb(255,255,255);text-align: left;padding-left: 20px;">Login Url:http://gautambook.com/login</p>
							<p style="font-size:17px;color:rgb(255,255,255);text-align: left;padding-left: 20px;">Please click on the  link to verify you email id or Copy the following link and paste in your browser. <br>http://gautambook.com/activeaccount?user_id='.$userid.'&key='.$user_activation_key.'</p>'; 
				$message10 .= '<p style="font-size:17px;color:rgb(255,255,255);text-align: left;padding-left: 20px;">Thanks & Regards<br>Gautam Community</p>';		
				$message10 .= '<div style="color:#fff;font-size: 17px;font-weight:600;text-align:left;padding-left: 20px;"><a href="http://www.gautambook.com">GautamBook.com</a></div>'; 
				$message10 .= '<p style="font-size:17px;color:rgb(255,255,255);text-align: left;padding-left: 20px;">NOTE: Please Dont reply on this email, this is just created by the system.</p></div></body></html>';				
				$subject10 = 'Email verification'; 
				$email_id10 = $users_email;
				
				$this->sendMail($email_id10,$message10,$subject10,$bcc);
				$msg = 'Email veryfication ';
				
				
				return $msg;	
		}
		elseif($user_action==4)
		{
			$bcc = '';   
			
				
				$this->db->query("UPDATE users SET password = '$pasword'  WHERE id = $userid");
				$message18 = '<html><body style="background-color: rgb(123, 176, 240); margin: 0px auto; padding: 10px 0px 50px; text-align: center; width: 660px; border-width: 8px 25px; border-style: solid; border-color: rgb(249, 237, 190);"><div><img src="'.base_url().'assets/images/guru.png" height= "150px" width="150px"></div><div  style="color: rgb(255, 255, 255); text-align: left; padding-left: 20px;">';
				$message18 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">Hello '.$first_name.' Your account details below.<br> username: '.$user_name.'<br>password: '.$pass.'<br>please login your account.</p>';  
				
				$message18 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">Thanks & Regards<br>Gautam Community</p>';		
				$message18 .= '<div style="color: #fff;font-size:15px;font-weight: 600;
				text-align: left; padding-left:0px;"><a href="http://community.isprasoft.com/" target="_blank" style="color:white; position: relative;top:5pxpx; text-decoration: none; " > <a href="http://www.gautambook.com">GautamBook.com</a></div>'; 
				$message18 .= '<p style="font-size: 17px; margin-left:-80px; color: rgb(255, 255, 255);">NOTE: Please Dont reply on this email, this is just created by the system.</p></div></body></html>';

				$subject18='Reset password';
				$email_id18 = $users_email;
				
				$this->sendMail($email_id18,$message18,$subject18,$bcc);
				$msg = 'check  login your details';
				
				
				return $msg;	
		}
		
	
		
	}
	
	function user_profile_info($id)
	{
		$this->db->select('*');
		$this->db->from('users as us');
		$this->db->join('user_info as uf', 'us.id = uf.user_id');
		$this -> db -> where('us.id', $id);
		$query = $this->db->get();
		$query -> num_rows();
		$qry = $query->row();
		return $qry;
	
	}
	
	
	public function approved_users($ids)
	
	{
			$bcc = '';
			$user_data = $this->user_profile_info($ids);
			$user_email = $user_data->user_email;
			$this->db->query("UPDATE users SET user_status = 1 WHERE id = $ids");
			$message = '<html><body style="background-color: rgb(123, 176, 240); margin: 0px auto; padding: 10px 0px 50px; text-align: center; width: 660px; border-width: 8px 25px; border-style: solid; border-color: rgb(249, 237, 190);""><div><img src="'.base_url().'assets/images/guru.png" height= "150px" width="150px"></div><div  style="color: rgb(255, 255, 255); text-align: left; padding-left: 20px;">';
			$message .= '<p style="font-size: 17px; color: rgb(255, 255, 255);"> Your account has been approved by admin please login your account <strong><a href="http://www.gautambook.com/login">click here</a></strong> to verify your email address.</p>';
			$message .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">Thanks & Regards<br>Gautam Community</p>';
			$message .= '<div style=" color: #fff;font-size: 15px;font-weight: 600;
			text-align: left; padding-left:0px;"><a href="http://community.isprasoft.com/" target="_blank" style="color:white; position: relative;top:5px; text-decoration: none; " ><a href="http://www.gautambook.com">GautamBook.com</a></div>';
			$message .= '<p style="font-size: 17px; margin-left: -80px; color: rgb(255, 255, 255);">NOTE: Please Dont reply on this email, this is just created by the system.</p></div></body></html>';
			$subject = 'Account Approval';
			$email_id = $user_email;
			
			$this->sendMail($email_id,$message,$subject,$bcc); 	
			$msgg = 'Approved successfully. '; 
			return $msgg; 
	}
	public function compose_mail()
	{
		$session_data = $this->session->userdata('logged_in');
		$ids = $session_data['userid'];
		$data = $this->user_profile_info($ids);
		$from_email = $data->user_email;
		$to = $this->input->post('to');
        $subject = $this->input->post('subject');
		$text_area = $this->input->post('compose-textarea');
		

			if(isset($_FILES['attachment']['name']))
			{
    
			$temp  =  explode('.',$_FILES['attachment']['name']);
			$file_ext = strtolower(end($temp));
			$attachement = $_FILES['attachment']['name'];
			$attachement_tmp = $_FILES['attachment']['tmp_name'];
			
			$attachement_rename = md5($attachement.time()).'.'.$file_ext;
			
			
			$upload_path_attch = '/home/isprasof/public_html/gautambook/assets/uploads/private_attachement/'.$attachement_rename;
			
			
			move_uploaded_file($attachement_tmp,$upload_path_attch); 

			}
			
			if(empty($_FILES['attachment']['name']))
			{
    
			$temp  =  explode('.',$_FILES['attachment']['name']);
			$file_ext = strtolower(end($temp));
			$attachement = $_FILES['attachment']['name'];
			$attachement_tmp = $_FILES['attachment']['tmp_name'];
			
			$attachement_rename = '';
			
			
			$upload_path_attch = '/home/isprasof/public_html/gautambook/assets/private_attachement/'.$attachement_rename;
			
			
			move_uploaded_file($attachement_tmp,$upload_path_attch); 

			}
		
		$this->db->query("insert into user_message(to_user,from_user,message,attachement,type,read1,subject,date,sender_del_status,reciever_del_status) values('$to','$from_email','$text_area','$attachement_rename','private','0','$subject',now(),'0','0')");
		
		$msg = '<div class="success"><p>'.$to.' Sent Successfully</p></div>';  
		return $msg;
		
		
	}
	
	
	////////////////////  upload file by the admin ///////////////////////
	
	public function upload_file()
	{
		$msg='';
		
        $subject = $this->input->post('subject');
		
			if(!empty($_FILES['attachment']['name']))
			{
    
			$temp  =  explode('.',$_FILES['attachment']['name']);
			
			$file_ext = strtolower(end($temp));
			
			
				
			$attachement = $_FILES['attachment']['name'];
			$attachement_tmp = $_FILES['attachment']['tmp_name'];
			
			$attachement_rename = md5($attachement.time()).'.'.$file_ext;
			
			$upload_path_attch = '/home/isprasof/public_html/gautambook/assets/uploads/uploadfile/'.$attachement_rename;
			
			
			move_uploaded_file($attachement_tmp,$upload_path_attch);
			
			if($file_ext=='pdf' or $file_ext=='docx' or $file_ext=='doc' or $file_ext=='png' or $file_ext=='jpg'or $file_ext=='jpeg'or $file_ext=='pptx'or $file_ext=='xlsx'or $file_ext=='one'or $file_ext=='xls'or $file_ext=='ppt')
			{
			$this->db->query("insert into upload_files(attachement,subject) values('$attachement_rename','$subject')");
			$msg = '<div class="success"><p> Upload file Successfully</p></div>';  
			}
		
			else
			{
				$msg = '<div class="error"><p> This file extension is not support database.</p></div>';  
			}
			}
			else
			{
				$msg = '<div class="error"><p> Please select file.</p></div>'; 
			}
		return $msg;
		
		
	}
	
	function email_basis_user_info($email)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this -> db -> where('user_email', $email);
		$query = $this->db->get();
		$query -> num_rows();
		$qry = $query->row();
		return $qry;
	
	}

	function sendMail($email,$message,$subject,$bcc)
	{
				
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'localhost';
				$config['mailpath'] = '/usr/sbin/sendmail';
				 $config['charset'] = 'utf-8';
				$config['mailtype']='html';
				$config['wordwrap'] = TRUE;
				$config['bcc_batch_mode'] = TRUE;
				$config['bcc_batch_size'] = 200;
				
				$config['crlf'] = "\r\n";
				$config['newline'] = "\r\n";
				
				
				$this->load->library('email', $config);
				$from='arvind@isprasoft.com';
				//$this->email->set_newline("\r\n");
				$this->email->from($from, 'GautamBook.com'); 
				$this->email->to($email);
				if(!empty($bcc))
				{ 
				$this->email->bcc($bcc);
				}
				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->send();
				
			return true;
	}
	
	public function Get_State_By_ID($state_id)
	{

		$query=$this -> db -> query("select name from states where state_id=$state_id");
		foreach ($query->result() as $row)
		return $row->name;

		
	}
	
	
	 public function get_autocomplete($search_data) {
		$data = '';
		$query = $this->db->query("SELECT first_name,user_id,last_name,current_vill_name, current_dist, current_state, perma_vill_name,perma_dist,perma_state,user_img FROM user_info where (first_name like '".$search_data."%') or (contact_no like '".$search_data."%') or (current_vill_name like '".$search_data."%') or (current_dist like '".$search_data."%') or (current_state like '".$search_data."%') or (perma_vill_name like '".$search_data."%') or (perma_state like '".$search_data."%') or (perma_dist like '".$search_data."%')");
		
		
         foreach ($query->result() as $rows) 
		 {
			$user_ids = $rows->user_id;
			$this -> db -> select('id,user_status,user_role');
			$this -> db -> from('users');
			$this -> db -> where('id', $user_ids);
			$this -> db -> where('user_status', 1);
			$qury = $this -> db -> get();
			if ($qury -> num_rows() >0)
			{
				
				$qry = $qury->row(); 
				$user_roles  = $qry->user_role;  
				if($user_roles!=0)
				{  
					 
					$usr_img = $rows->user_img;
					if(!empty($usr_img))
					{
						$users_photo = base_url().'assets/ajax/upload/'.$usr_img;
					}
					else
					{
						$users_photo = base_url().'assets/images/user.png'; 
					}
					if(!empty($rows->perma_dist))
					{
						$add_dist = $rows->perma_dist;
					}
					else
					{
						$add_dist = '';
					}
					if(!empty($rows->perma_state))
					{
						$add_state = $rows->perma_state;
					}
					else
					{
						$add_state = '';
					}
					$data .= '<a href="userprofile?userid='.base64_encode($user_ids).'"><div class="users-sec"><img src="'.$users_photo.'"><div id="content-user"><div class="authors-name search-author">'.$rows->first_name.' '.$rows->last_name.'</div><div class="users-email search-author">'.$add_dist.','.$add_state.'</div></div></div></a><div class="clear"></div>';
					
					
					}
			 }
			
		}
		return $data;
		
	}
	public function add_family_member()
		{
			$bcc = ''; 
			$session_data = $this->session->userdata('logged_in');
			$id = $session_data['userid'];
			$creater_data = $this->user_profile_info($id);
			$perma_vill_nm = $creater_data->perma_vill_name;
			$perma_vill_country = $creater_data->perma_country;
			$perma_vill_distt = $creater_data->perma_dist;
			$perma_states = $creater_data->perma_state;
			$current_vill_nm = $creater_data->current_vill_name;
			$current_vill_country = $creater_data->current_country;
			$current_vill_dist = $creater_data->current_dist;
			$current_states = $creater_data->current_state;
			$lower_name = $this->input->post('fname');
			$father_name = $this->input->post('father_name');
			$f_name = strtolower($lower_name);
			$lower_name1 = $this->input->post('lname');
			$l_name = strtolower($lower_name1);
			$genders = $this->input->post('Genders');
			$phone_no = $this->input->post('phone_num'); 
			$relation = $this->input->post('relation');
			$gotra = $this->input->post('gotra');
			$day = $this->input->post('day');
			$month = $this->input->post('month');
			$year = $this->input->post('year');
			$pass = rand(1,100000).time();
			$dob = $day.'/'.$month.'/'.$year;
			$user_name = $f_name.'.'.$l_name.rand(1,10000);
			$display_nm = $f_name.' '.$l_name;
			$file_name = $this->input->post('userfile');
			$file_named = '';
			//$user_data = $this->user_profile_info($id);
			$user_email = $creater_data->user_email;
			$display = $creater_data->	display_name;
			$new_img_name='';
			$level=0;
			//create add family tree
			if($father_name!='other')
			{
				$f_data = explode(",",$father_name);
				$father_name = $f_data[0];
				
				//$father_info = $this->user_profile_info($f_id);
				//$father_name = $father_info->father_name;
				$father_level = $f_data[1];
				$parrent_id = $f_data[2];
				//$create_f_name =  $creater_data->father_name;
				
					
					$users_level = $father_level -1; 
					$parrent_level = $father_level;       
					
				
			} 
			
			else 
			{
			$this->load->helper('string');
			$parrent_id = random_string ('numeric',5);
			$user_levels = 0;
			$row = $this->db->query("SELECT MAX(parrent_level) AS `parrent_levels` FROM `user_info` where account_creater_id='$id' or user_id='$id'")->row(); 

			$user_level = $row->parrent_levels;
			//$father_info = $this->user_profile_info($f_id);			
					
			$father_name = $this->input->post('create_father_name');
			
			$parrent_level = $user_level +1;
			$users_level = $parrent_level -1;
			}
			$data=array(
			'username'=>$user_name, 
			'password'=>md5($pass),
			'user_email'=>$user_email,
			'user_registered'=>date('Y-m-d H:i:s'),
			'user_status'=>1,
			'user_role'=>2,
			'display_name'=>$display_nm
			); 
			$this->db->insert('users',$data);
			$user_id = $this->db->insert_id();
			$relation_name = $this->get_relation($relation);
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
					$upload_path_attch = '/home/isprasof/public_html/gautambook/assets/ajax/upload/'.$newname;
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
						$config['new_image'] ='/home/isprasof/public_html/gautambook/assets/ajax/upload/'.$new_file_name.'-300x300.jpg';
						$config['source_image'] = '/home/isprasof/public_html/gautambook/assets/ajax/upload/'.$file;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = FALSE;
						$config['width']     = 300;
						$config['height']   = 300; 
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
				
					$new_img_name  = $new_file_name.'-300x300_thumb.jpg';
						
					}
					unlink('/home/isprasof/public_html/gautambook/assets/ajax/upload/'.$file);
					
				}
			}				
		}
			
			$this->db->query("insert into user_info (user_id,first_name,last_name,father_name,contact_no,gender,gotra,dob,current_vill_name,current_country,current_dist,current_state,perma_vill_name,perma_country,perma_dist,perma_state,relation,account_creater_id,user_img,user_level,parrent_level,parrent_id) values('$user_id','$f_name','$l_name','$father_name','$phone_no','$genders','$gotra','$dob','$current_vill_nm','India','$current_vill_dist','$current_states','$perma_vill_nm','India','$perma_vill_distt','$perma_states','$relation','$id','$new_img_name','$users_level','$parrent_level','$parrent_id')");
	 
			$message7 = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head><body style="background-color: rgb(123, 176, 240); margin: 0px auto; padding: 10px 0px 50px; text-align: center; width: 660px; border-width: 8px 25px; border-style: solid; border-color: rgb(249, 237, 190);""><div><img src="'.base_url().'assets/images/guru.png" height= "150px" width="150px"></div><div  style="color: rgb(255, 255, 255); text-align: left; padding-left: 20px;">'; 
			$message7 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);"> hello '.$display.'</p>';
			$message7 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);"> User login detail </p>';
			$message7 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">User Name:'.$user_name.'<br>Password:'.$pass.'<br>Relation: '.$relation_name.'<br>Thanks & Regards<br>Gautam Community</p>';
			$message7 .= '<div style=" color: #fff;font-size: 15px;font-weight: 600;
			text-align: left; padding-left:0px;"><a href="http://community.isprasoft.com/" target="_blank" style="color:white; position: relative;top:5px; text-decoration: none; " ><a href="http://www.gautambook.com">GautamBook.com</a></div>';
			$message7 .= '<p style="font-size: 17px; margin-left: -80px; color: rgb(255, 255, 255);">NOTE: Please Dont reply on this email, this is just created by the system.</p></div></body></html>';
			$subject7 = 'Add family ';
			$email_id7 = $user_email;
			
			$this->sendMail($email_id7,$message7,$subject7,$bcc); 
			
			return true;
		}
		
	
	public function reset_change_pass()
	{
		$passwrd = md5($this->input->post('passwords'));
		$pass = $this->input->post('passwords');
		$change_pass_id = base64_decode($this->input->post('change_pass'));
		
		$result = $this->db->query("update users set password='$passwrd' where id=$change_pass_id");
		$user_email_bcc = '';
		if($result)
		{
			$user_data = $this->user_profile_info($change_pass_id);
			$names = $user_data->display_name;
			$msgs = '<div class="success"><p>Password Reset Successfully</p></div>';
			$this->db->query("update resetpassword set pass_reset_link='' where user_id=$change_pass_id");
			$message11 = '<html><body style="background-color: rgb(123, 176, 240); margin: 0px auto; padding: 10px 0px 50px; text-align: center; width: 660px; border-width: 8px 25px; border-style: solid; border-color: rgb(249, 237, 190);""><div><img src="'.base_url().'assets/images/guru.png" height= "150px" width="150px"></div><div  style="color: rgb(255, 255, 255); text-align: left; padding-left: 20px;">';
			$message11 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">Dear '.$names.'</p>';
			$message11 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">Congratulation you have successfully reset password.<br> change password : '.$pass.'</p>';
			$message11 .= '</div><div style=" color: #fff;font-size: 17px;font-weight:600;padding-left:20px;
			text-align:left;"><a href="http://www.gautambook.com" target="_blank" style="color:white; position: relative;top:20px; text-decoration: none; ">GautamBook.com</a></div>';
			$message11 .= '<p style="font-size:17px;color:rgb(255,255,255); text-align:left; padding-left:20px;">NOTE: Please Dont reply on this email, this is just created by the system.</p></body></html>';
			$subject11='Change Password'; 
			$email_id11 = $user_data->user_email; 
			$this->sendMail($email_id11,$message11,$subject11,$user_email_bcc);
			
			return $msgs;
		}
		else
		{
			$msgs = '<div class="error"><p>Error!</p></div>';
			return $msgs;
		}
	}
	public function delete_users($user_id)
	{
		$tables = 'users';
		$this->db->where('id', $user_id);
		$this->db->delete($tables);
		
		$tables = 'user_info';
		$this->db->where('user_id', $user_id);
		$this->db->delete($tables);  
		 
		$tables = 'user_post';
		$this->db->where('user_id', $user_id);
		$this->db->delete($tables);
		
		$tables = 'user_post_comment';
		$this->db->where('user_id', $user_id);
		$this->db->delete($tables);
		
		$tables = 'user_post_like';
		$this->db->where('user_id', $user_id);
		$this->db->delete($tables);
		return true;
		 
	}
	public function delete_relation($relation_id)
	{
		$tables = 'relationship';
		$this->db->where('id', $relation_id);
		$this->db->delete($tables);
	}
	public function delete_family_members($member_id)  
	{
		$tables = 'users';
		$this->db->where('id', $member_id);
		$this->db->delete($tables);
		
		$tables = 'user_info';
		$this->db->where('user_id', $member_id);
		$this->db->delete($tables);  
		 
		$tables = 'user_post';
		$this->db->where('user_id', $member_id);
		$this->db->delete($tables);
		 
		$tables = 'user_post_comment';
		$this->db->where('user_id', $member_id);
		$this->db->delete($tables);
		
		$tables = 'user_post_like';
		$this->db->where('user_id', $member_id);
		$this->db->delete($tables);
		
		return true; 
		
	}
	public function delete_matrimonial($id)
	{
		$tables = 'matrimonial';
		$this->db->where('id', $id);
		$this->db->delete($tables);
	}
	public function delete_achievement($id)
	{
		$tables = 'user_achievement';
		$this->db->where('id', $id);
		$this->db->delete($tables);
	}
	public function get_relation($id)
		{
			$this->db->select('*');
			$this->db->from('relationship');
			$this->db->where('id',$id);
			$query = $this -> db -> get();
			$query -> num_rows();
			$qry = $query->row();
			$user_relation = $qry->relation;
			return $user_relation;
		}
		
		public function admin_email()
		{
			$this->db->select('user_email');
			$this->db->from('users');
			$this->db->where('user_role',0);
			$query = $this -> db -> get();
			$query -> num_rows();
			$qry = $query->row();
			$user_email = $qry->user_email;
			return $user_email;
			
		}
		
		public function edit_family_member()  
		{
			$f_name = $this->input->post('fname');
			$l_name = $this->input->post('lname');
			$ids = $this->input->post('run_code');
			$display_nm = $f_name.' '.$l_name;
			$phone_no = $this->input->post('phone_num');
			$email = $this->input->post('emails');
			$relation = $this->input->post('relation');
			$gender = $this->input->post('Genders');
			$gotra = $this->input->post('gotra');
			$dob_day = $this->input->post('day'); 
			$dob_month = $this->input->post('month');
			$dob_year = $this->input->post('year');
			$dob = $dob_day.'/'.$dob_month.'/'.$dob_year;
			$file_name = $this->input->post('userfile');
			$new_img_name='';
			
			
			
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
					$upload_path_attch = '/home/isprasof/public_html/gautambook/assets/ajax/upload/'.$newname;
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
						$config['new_image'] ='/home/isprasof/public_html/gautambook/assets/ajax/upload/'.$new_file_name.'-300x300.jpg';
						$config['source_image'] = '/home/isprasof/public_html/gautambook/assets/ajax/upload/'.$file;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = FALSE;
						$config['width']     = 300;
						$config['height']   = 300; 
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
				
					$new_img_name  = $new_file_name.'-300x300_thumb.jpg';
						
					}
					unlink('/home/isprasof/public_html/gautambook/assets/ajax/upload/'.$file);
					
				}
			}				
		}
			
			
			
			
			$this->db->query("UPDATE users SET user_email = '$email',display_name = '$display_nm'  WHERE id = $ids");
			$this->db->query("UPDATE user_info SET first_name = '$f_name', last_name='$l_name', contact_no='$phone_no', gender = '$gender', gotra='$gotra', dob='$dob', relation='$relation',user_img='$new_img_name'  WHERE user_id = $ids");
			$msg = '<div class="success"><p>Update successfully Saved!</p></div>';
			return $msg;
		}
		
		public function edit_matrimonialss()  
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
			
			
			$father_gotr = $this->input->post('father_gotra');
			$mother_gotr = $this->input->post('mother_gotra');
			$mars = $this->input->post('radio');
			$ids = $this->input->post('run_code');
			$metrimonial_id = $this->input->post('metrimonial_id');
			
			$this -> db -> select('*');
			$this -> db -> from('matrimonial');
			$this -> db -> where('id', $ids);
			$query = $this -> db -> get();
			foreach ($query->result() as $row)
			{
				
				$album_img = $row ->use_img;
			}
			
			
			
			$post_file = $this->input->post('userfile');
			$file_named = $album_img;
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
					$upload_path_attch ='/home/isprasof/public_html/gautambook/assets/matrimonial-image/'.$newname;
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
						$config['new_image'] ='/home/isprasof/public_html/gautambook/assets/matrimonial-image/matrimonial-thumbs/'.$new_file_name.'-150x150.jpg';
						$config['source_image'] = '/home/isprasof/public_html/gautambook/assets/matrimonial-image/'.$file;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = FALSE;
						$config['width']     = 150;
						$config['height']   = 150; 
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$config['image_library'] = 'gd2';
						$config['new_image'] ='/home/isprasof/public_html/gautambook/assets/matrimonial-image/matrimonial-thumbs/'.$new_file_name.'-300x300.jpg';
						$config['source_image'] = '/home/isprasof/public_html/gautambook/assets/matrimonial-image/'.$file;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = FALSE;
						$config['width']     = 300;
						$config['height']   = 300; 
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$config['image_library'] = 'gd2';
						$config['new_image'] ='/home/isprasof/public_html/gautambook/assets/matrimonial-image/matrimonial-thumbs/'.$new_file_name.'-600x600.jpg';
						$config['source_image'] = '/home/isprasof/public_html/gautambook/assets/matrimonial-image/'.$file;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = FALSE;
						$config['width']     = 600;
						$config['height']   = 600; 
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();

						$upload_file_nm .= $new_file_name.',';
					}
					unlink('/home/isprasof/public_html/gautambook/assets/matrimonial-image/'.$file);
					$file_named = rtrim($upload_file_nm,',');
					
				}
			}
		}
		$this->db->query("UPDATE matrimonial SET user_name = '$user_name', gender='$gender', father_name='$father_name', current_address = '$current_address', contact_no='$contact_no', d_o_b='$date_of_birth', profession='$profession', father_gotra='$father_gotr', mother_gotra='$mother_gotr', mars='$mars',use_img='$file_named',qualification = '$qualification',profile_create_for = '$metri_for',email_id = '$email_id',permanent_address = '$permenant_address',city = '$city',state = '$state',annual_income = '$annual_income',challenged = '$challenged',fathers_occupation = '$father_occupation',mothers_occupation = '$mother_occupation',nakshatra = '$nakshatra',rashi = '$rashi',about_boy = '$about_boy',about_boy_family = '$about_boy_family',feet = '$feet',inch = '$inch',diet = '$diet',Body_Type = '$Body_Type',Complexion = '$Complexion',blood_group = '$blood_group' WHERE id=$metrimonial_id");
		
		return true;
		}
		public function edit_achievement()   
		{ 
			
			$session_data = $this->session->userdata('logged_in');
			$id = $session_data['userid'];
			$title = $this->input->post('title');
			$day = $this->input->post('day');
			$month = $this->input->post('month');
			$year = $this->input->post('year');
			$date_of_birth = $year.'/'.$month.'/'.$day;  
			$ids = $this->input->post('run_codess');
			$this -> db -> select('*');
			$this -> db -> from('user_achievement');
			$this -> db -> where('id', $ids);
			$query = $this -> db -> get();
			foreach ($query->result() as $row)
			{
				
				$album_img = $row ->achiv_img;
			}
			
			
			
			$post_file = $this->input->post('userfile');
			$file_named = $album_img;
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
					$upload_path_attch ='/home/isprasof/public_html/gautambook/assets/achievement-image/'.$newname;
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
						$config['new_image'] ='/home/isprasof/public_html/gautambook/assets/achievement-image/achievement-thumb/'.$new_file_name.'-150x150.jpg';
						$config['source_image'] = '/home/isprasof/public_html/gautambook/assets/achievement-image/'.$file;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = FALSE;
						$config['width']     = 150;
						$config['height']   = 150; 
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$config['image_library'] = 'gd2';
						$config['new_image'] ='/home/isprasof/public_html/gautambook/assets/achievement-image/achievement-thumb/'.$new_file_name.'-300x300.jpg';
						$config['source_image'] = '/home/isprasof/public_html/gautambook/assets/achievement-image/'.$file;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = FALSE;
						$config['width']     = 300;
						$config['height']   = 300; 
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$config['image_library'] = 'gd2';
						$config['new_image'] ='/home/isprasof/public_html/gautambook/assets/achievement-image/achievement-thumb/'.$new_file_name.'-600x600.jpg';
						$config['source_image'] = '/home/isprasof/public_html/gautambook/assets/achievement-image/'.$file;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = FALSE;
						$config['width']     = 600;
						$config['height']   = 600; 
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();

						$upload_file_nm .= $new_file_name.',';
					}
					unlink('/home/isprasof/public_html/gautambook/assets/achievement-image/'.$file);
					$file_named = rtrim($upload_file_nm,',');
					
				}
			}
		}
		$this->db->query("UPDATE user_achievement SET achiv_title = '$title', achive_date='$date_of_birth', achiv_img='$file_named' WHERE id = $ids");
			return true;
		}
		
		public function mails_delete($mail_id)
		{
			$m_id = explode(',',$mail_id);
			foreach($m_id as $ids)
			{
				$this->db->select('attachement');
				$this->db->from('user_message');
				$this->db->where('id',$ids);
				$query = $this -> db -> get();
				$query -> num_rows();
				$qry = $query->row();
				$email_att = $qry->attachement;
				if(!empty($email_att))
				{
					unlink('/home/isprasof/public_html/gautambook/assets/uploads/private_attachement/'.$email_att);
				}
				$this->db->query("delete from user_message where id=$ids");
				$msg = 'mail delete successfully';
				return $msg;
			}
		
		}
		
	public function mail_searching($search_key)
	{
		$datas = '';
		$attch_icon = '';
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['userid'];
		$data_infos = $this->user_profile_info($id);
		$current_user_email = $data_infos->user_email;
		$query = $this->db->query("SELECT * FROM user_message where(from_user like '".$search_key."%') or (subject like '".$search_key."%')");
		
		foreach ($query->result() as $row) 
		{
			$email_id = $row->from_user;
			$mail_subject = $row->subject;
			$attch = $row->attachement;
			$mail_id = base64_encode($row->id);
			$user_info = $this->comman_function->email_basis_user_info($email_id);
			$sender_name = $user_info->display_name;
			$get_reg_date = strtotime($row->date);
			$reg_date = date(" jS M Y", $get_reg_date);
			
			$read = $row->read1;
			if($read==0) 
			{
				$msgg = 'active';
			}
			else
			{
				$msgg = '';
			}
			 if(!empty($attch))
			{
			 
				$attch_icon = '<i class="fa fa-paperclip"></i>';
			
			}
			
			if($current_user_email!=$email_id)	
			{
				$datas .= '<tr class="'.$msgg.'">
				<td><input id="'.$row->id.'" type="checkbox" name="checkbox" value="" onclick="callback_set_stud_ids()"/></td>
				<td class="mailbox-name"><a href="readmessage?id='.$mail_id.'">'.$sender_name.'</a></td>
				<td class="mailbox-subject"><b>'.$mail_subject.'</b></td>
				<td class="mailbox-attachment">
				'.$attch_icon.'
				</td>
				<td class="mailbox-date">'.$reg_date.'</td>
				</tr>';
			}	
	 
		}
		return $datas;
	}
	public function create_album() 
	{
		$album_title = $this->input->post('album_title');
		$post_text = mysql_real_escape_string($this->input->post('text_editor'));
		$post_file = $this->input->post('userfile');
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
					$upload_path_attch = '/home/isprasof/public_html/gautambook/assets/albums/'.$newname;
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
						$config['new_image'] ='/home/isprasof/public_html/gautambook/assets/albums/albumthumbs/'.$new_file_name.'-90x90.jpg';
						$config['source_image'] = '/home/isprasof/public_html/gautambook/assets/albums/'.$file;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = FALSE;
						$config['width']     = 90;
						$config['height']   = 90; 
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$config['image_library'] = 'gd2';
						$config['new_image'] ='/home/isprasof/public_html/gautambook/assets/albums/albumthumbs/'.$new_file_name.'-300x300.jpg';
						$config['source_image'] = '/home/isprasof/public_html/gautambook/assets/albums/'.$file;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = FALSE;
						$config['width']     = 300;
						$config['height']   = 300; 
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();

						$upload_file_nm .= $new_file_name.',';
					}
					unlink('/home/isprasof/public_html/gautambook/assets/albums/'.$file);
					$file_named = rtrim($upload_file_nm,',');
				}
			}				
		}
		
		$this->db->query("insert into photo_album (album_title,description,album_img) values('$album_title','$post_text','$file_named')"); 
		
	}
	
	public function next_post_show($ids)
	{
		$user_post = '';
		$all_post_ids='';
		$session_data = $this->session->userdata('logged_in');
		$current_user_id = $session_data['userid'];
		
		$result = $this->user_profile_info($current_user_id);

		$user_photo = $result->user_img;
		

		if(!empty($user_photo))
		{
			$profile_photo = base_url().'assets/ajax/upload/'.$user_photo;
		}
		else
		{
			$profile_photo = base_url().'assets/images/user.png'; 
		}
		
		$ids=trim($ids, ",") ;
		
		$query = $this->db->query("SELECT * FROM user_post WHERE id NOT in ($ids) ORDER BY id DESC LIMIT 10");

		foreach ($query->result() as $row)
		{
			$post_id = $row->id;
			$all_post_ids .=$post_id.",";
			$user_id = $row->user_id;
			$results = $this->user_profile_info($user_id);
			$user_thumb = $results->user_img;
			$user_name = $results->first_name.' '.$results->last_name;
			$post_title = $row->post_title;
			$post_content = $row->post_conetnt;
			$post_img = $row->post_img_gallery;
			$post_date = strtotime($row->post_date);
			$posts_date = date("F Y", $post_date);
			if(!empty($user_thumb))
			{
				$users_photo = base_url().'assets/ajax/upload/'.$user_thumb;
			}
			else
			{
				$users_photo = base_url().'assets/images/user.png'; 
			}
				$this -> db -> select('*');
				$this -> db -> from('user_post_like');
				$this -> db -> where('user_id', $current_user_id);
				$this -> db -> where('post_id', $post_id);
				$query = $this -> db -> get();
				if ($query -> num_rows() == 1)
				{
					
					$active = '<button class="btn-default btn-xs active" id="'.$post_id.'" onclick="posts_unlike(this.id)" type="button"><i class="fa fa-thumbs-o-down"></i>Like</button>';
					
				}
				else
				{
					
					$active = '<button class="btn-default btn-xs" id="'.$post_id.'" onclick="posts_like(this.id)" type="button"><i class="fa fa-thumbs-o-up"></i>Like</button>';
					
				}
				$this -> db -> select('*');
				$this -> db -> from('user_post_like');
				$this -> db -> where('post_id', $post_id);
				$qury = $this -> db -> get();
				
				$likes_count = $qury -> num_rows();
				if($likes_count==0)
				{
					$like_count = $likes_count;
					$you_like = '';
				}
				else
				{
						$like_count = $likes_count-1;
						$qry = $qury->row();
						$like_ids = $qry->user_id;
						if($like_ids==$current_user_id)
						{
							$you_like = 'You and ';
							
						}
						else
						{
							$you_like = '';
						}
					
					
				}
		
			$user_post .= '<div id="'.$post_id.'"  align="left" class="message_box" >
			<div id="fb" class="box box-success">
				<div class="box box-widget">
				<div class="box-header with-border">
				  <div class="user-block">
					<img alt="User Image" src="'.$users_photo.'" class="img-circle">
					<span class="username"><a href="userprofile?userid='.base64_encode($user_id).'">'.$user_name.'</a></span>
					<span class="description">Posted: '.$posts_date.'</span>';
				if($user_id==$current_user_id)
				{ 
				
			$user_post .= '	<div class="dropdown" id="users_action">
				<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
				<span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
				  <li role="presentation" class="topopup" id="'.$post_id.'" onclick="edit_post_popup_open(this.id)" style="padding-bottom: 0px;"><a role="menuitem" tabindex="-1"><i class="fa fa-pencil fa-fw"></i>EDIT</a></li>
				  <li role="presentation" id="'.$post_id.'" onclick="delete_Post(this.id)"><a role="menuitem" tabindex="-1" href="" ><i class="fa fa-trash-o fa-fw"></i>DELETE</a></li>
				</ul>
				
			  </div>';
			 
			  }
					
					
				$user_post .= '</div>
				  <!-- /.user-block -->
				  <div class="box-tools">
					<button data-widget="collapse" class="btn btn-box-tool plus" type="button"><i class="fa fa-minus"></i>
					</button>
					
				  </div>
				  <!-- /.box-tools -->
				</div>
				<!-- /.box-header -->
				
				<div class="box-body" style="display: block;">
				<p class="pst_content title">'.$post_title.'</p>';
				
				if(!empty($post_img))
				{
					$thumb = explode(",",$post_img);
					$no_post = count($thumb);
				//print_r($thumb);
					
				 if($no_post==1)
				 {
					foreach($thumb as $post_image)
					{
					
			$user_post .= '<img alt="Photo" src="'.base_url().'assets/uploads/thumbs/'.$post_image.'-600x600_thumb.jpg" class="img-responsive padss">';
				  
					}
				 }
				 elseif($no_post==2)
				 {
					
				$user_post .= '<ul class="posting">';
					
					foreach($thumb as $post_image)
					{
					
					$user_post .= '<li class="post2"><img alt="Photo" src="'.base_url().'assets/uploads/thumbs/'.$post_image.'-300x300_thumb.jpg" class="img-responsive pad"></li>';
				  
					}
					
				 $user_post .= '</ul>';
				  
				 }
				 elseif($no_post==3)
				 {
					
					$user_post .= '<ul class="posting">';
				
					foreach($thumb as $post_image)
					{
					
					$user_post .= '<li class="post3"><img alt="Photo" src="'.base_url().'assets/uploads/thumbs/'.$post_image.'-300x300_thumb.jpg" class="img-responsive pad"></li>';
				
					}
				 
				 $user_post .= '</ul>';
				  
				 }
				 elseif($no_post>=4)
				 {
					
					$user_post .= '<ul class="posting">';
					
					foreach($thumb as $post_image)
					{
					
					$user_post .= '<li class="post4"><img alt="Photo" src="'.base_url().'assets/uploads/thumbs/'.$post_image.'-150x150_thumb.jpg" class="img-responsive pad"></li>';
				  
					}
				 
				 $user_post .= '</ul>';
				 }
				}
				 
				 $user_post .= '<hr><div class="clear"></div>';
				 if(!empty($post_content))
				{	
					$contented = nl2br($post_content);
				
					$post_cont = $this->ttruncat($contented,300);
				
				
				 $user_post .= '<p class="post_contented'.$post_id.'" style="display:none;">'.$contented.'</p>
				  <p class="post_cont"><span class="pst_content'.$post_id.'">'.$post_cont.'</span>';
				$string_count = strlen($post_content);
				if($string_count>=20)
				{
				 $user_post .= '<span id="'.$post_id.'" style="color:#3C8DBC; cursor: pointer;" class="count_read'.$post_id.'" onclick="read_more(this.id)">More read....</span></p>';
				 }
				 else 
				 {
					$user_post .= '<p></p>';
				 }
				 }
				 $user_post .= '<div class="clear"></div>
				  <span id="user_liked'.$post_id.'">
				  '.$active.'
				 </span>';
				 
					$this -> db -> select('*');
					$this->db->order_by("date","ASC"); 
					$this -> db -> from('user_post_comment');
					$this -> db -> where('post_id', $post_id);
					$query = $this -> db -> get();
					$comment_count = $query -> num_rows();
				 
				 $user_post .= '<div class="pull-right text-muted"><img class = "archived" src="'.base_url().'assets/like/like.jpg">('.$likes_count.')</span>|<img class = "archived" src="'.base_url().'assets/like/comment.jpg">('.$comment_count.')</div>  
				</div>
				<div class="box-footer box-comments">
				<div class="box-like">
				  <span id="like_this'.$post_id.'">'.$you_like.'</span><span class="tooltips">'.$like_count.' other';
					if ($qury->num_rows() > 0)
					{
					$user_post .= '<span class="tooltiptexts tooltip-tops">';

					foreach ($qury->result() as $rows)
					{
						$like_user_id = $rows->user_id;
						if($like_user_id!=$current_user_id)
						{
							$this->load->model('comman_function');
							$results = $this->comman_function->user_profile_info($like_user_id);
							$likers_name = $results->display_name;
						
							$user_post .='<p>'.$likers_name.'</p>';
						}
					}
					
					$user_post .='</span>';
				
						
					}
					
					$user_post .= '</span> like this.
				</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer box-comments" style="display: block;">';
				
					foreach ($query->result() as $row)
					{
						$comment_user_id = $row->user_id;
						$user_comment = $row->post_comment;
						$comment_date = strtotime($row->date);
						$comt_date = date('M j, Y H:i A',$comment_date);
						$result = $this->user_profile_info($comment_user_id);
						$users_names = $result->first_name.' '.$result->last_name;
						$users_thumb = $result->user_img;
						if(!empty($users_thumb))
						{
							$users_photos = base_url().'assets/ajax/upload/'.$users_thumb;
						}
						else
						{
							$users_photos = base_url().'assets/images/user.png'; 
						}
			
				 $user_post .=  '<div class="box-comment">
					<!-- User image -->
					<img alt="User Image" src="'.$users_photos.'" class="img-circle img-sm" style="margin-top: 5px;">

					<div class="comment-text">
						  <span class="username">
							<a href="userprofile?userid='.base64_encode($comment_user_id).'">'.$users_names.'</a>
							<span class="text-muted pull-right">'.$comt_date.'</span>
						  </span><!-- /.username -->
					  '.$user_comment.'
					</div>
					<!-- /.comment-text -->
				  </div>';
				 
				  }
				  
				  $user_post .=  '<div class="demo'.$post_id.'"></div>
					 <div class="box-comment">
					
					<!-- User image -->
					<img alt="User Image" src="'.$profile_photo.'" class="img-circle img-sm" style="margin-top: 5px;">

					<div class="comment-text">
					<form action="" method="post" id="comment_submit'.$post_id.'">
					<input type="hidden" id="comnt_post_id" name="cmnt_post_id" value="'.$post_id.'">
					<input type="text" id="'.$post_id.'" onclick="cmt_post_id(this.id)" placeholder="Write a Comment..." name="comment" class="post_comments'.$post_id.'" required/>
					</form>
					</div>
					<!-- /.comment-text -->
				  </div>
				  <!-- /.box-comment -->
				</div>
			   
				<!-- /.box-footer -->
			  </div>
		</div>
		</div>';
		
			
		}
		$all_post_ids .=$ids;  
		$user_post .='<div class="all_post_ids all_posts_remove"  id="'.$all_post_ids.'"></div>';
		return $user_post;
	}
	

	public function ttruncat($text,$numb) {
		if (strlen($text) > $numb) { 
		  $text = substr($text, 0, $numb); 
		  $text = substr($text,0,strrpos($text," ")); 
		  $etc = "&nbsp;&nbsp;";  
		  $text = $text.$etc; 
		  }
		return $text; 
	}
		public function delete_albums($album_id)  
		{
			$tables = 'photo_album';
			$this->db->where('id', $album_id);
			$this->db->delete($tables);
			
			$tables = 'user_post';
			$this->db->where('album_id', $album_id);
			$this->db->delete($tables);
			return true;
		}
		
		public function edit_album()  
		{
			
			$title = $this->input->post('album_title');
			$post_text = addslashes($this->input->post('text_editors'));
			
			$ids = $this->input->post('add_album');
			$this -> db -> select('*');
			$this -> db -> from('photo_album');
			$this -> db -> where('id', $ids);
			$query = $this -> db -> get();
			foreach ($query->result() as $row)
			{
				
				$album_img = $row ->album_img;
			}
			
			
			
			$post_file = $this->input->post('userfile');
			$file_named = $album_img;
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
					$upload_path_attch = '/home/isprasof/public_html/gautambook/assets/albums/'.$newname;
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
						$config['new_image'] ='/home/isprasof/public_html/gautambook/assets/albums/albumthumbs/'.$new_file_name.'-90x90.jpg';
						$config['source_image'] = '/home/isprasof/public_html/gautambook/assets/albums/'.$file;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = FALSE;
						$config['width']     = 90;
						$config['height']   = 90; 
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$config['image_library'] = 'gd2';
						$config['new_image'] ='/home/isprasof/public_html/gautambook/assets/albums/albumthumbs/'.$new_file_name.'-300x300.jpg';
						$config['source_image'] = '/home/isprasof/public_html/gautambook/assets/albums/'.$file;
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = FALSE;
						$config['width']     = 300;
						$config['height']   = 300; 
						$this->image_lib->clear();
						$this->image_lib->initialize($config);
						$this->image_lib->resize();

						$upload_file_nm .= $new_file_name.',';
					}
					unlink('/home/isprasof/public_html/gautambook/assets/albums/'.$file);
					$file_named = rtrim($upload_file_nm,',');
					
				}
			}
		}
			
		$this->db->query("UPDATE photo_album SET album_title = '$title', description = '$post_text', album_img = '$file_named'  WHERE id = $ids");
			return true;
		}
		
	function user_post_show($data_ids)
	{
		$user_post = '';
		$all_post_ids='';
		$profile_photo = '';
		$current_user_id = '';
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$current_user_id = $session_data['userid'];
			
			$result = $this->user_profile_info($current_user_id);

			$user_photo = $result->user_img;
			

			if(!empty($user_photo))
			{
				$profile_photo = base_url().'assets/ajax/upload/'.$user_photo;
			}
			else
			{
				$profile_photo = base_url().'assets/images/user.png'; 
			}
		}
		$post_data = (explode("/",$data_ids));
		$search_user_id = $post_data[1];
		$ids = $post_data[0];
		$ids=trim($ids, ",") ;
		
		$query = $this->db->query("SELECT * FROM user_post WHERE id NOT in ($ids) and user_id=$search_user_id ORDER BY id DESC LIMIT 10");

		
		foreach ($query->result() as $row)
		{
			$post_id = $row->id;
			$all_post_ids .=$post_id.",";
			$user_id = $row->user_id;
			$results = $this->user_profile_info($user_id);
			$user_thumb = $results->user_img;
			$user_name = $results->first_name.' '.$results->last_name;
			$post_title = $row->post_title;
			$post_content = $row->post_conetnt;
			$post_img = $row->post_img_gallery;
			$post_date = strtotime($row->post_date);
			$posts_date = date("F Y", $post_date);
			if(!empty($user_thumb))
			{
				$users_photo = base_url().'assets/ajax/upload/'.$user_thumb;
			}
			else
			{
				$users_photo = base_url().'assets/images/user.png'; 
			}
				$this -> db -> select('*');
				$this -> db -> from('user_post_like');
				$this -> db -> where('user_id', $current_user_id);
				$this -> db -> where('post_id', $post_id);
				$query = $this -> db -> get();
				if ($query -> num_rows() == 1)
				{
					
					$active = '<button class="btn-default btn-xs active" id="'.$post_id.'" onclick="posts_unlike(this.id)" type="button"><i class="fa fa-thumbs-o-down"></i>Like</button>';
					
				}
				else
				{
					
					$active = '<button class="btn-default btn-xs" id="'.$post_id.'" onclick="posts_like(this.id)" type="button"><i class="fa fa-thumbs-o-up"></i>Like</button>';
					
				}
				$this -> db -> select('*');
				$this -> db -> from('user_post_like');
				$this -> db -> where('post_id', $post_id);
				$qury = $this -> db -> get();
				
				$likes_count = $qury -> num_rows();
				if($likes_count==0)
				{
					$like_count = $likes_count;
					$you_like = '';
				}
				else
				{
						$like_count = $likes_count-1;
						$qry = $qury->row();
						$like_ids = $qry->user_id;
						if($like_ids==$current_user_id)
						{
							$you_like = 'You and';
							
						}
						else
						{
							$you_like = '';
						}
					
					
				}
		
			$user_post .= '<div id="'.$post_id.'"  align="left" class="message_box" >
			<div id="fb" class="box box-success">
				<div class="box box-widget">
				<div class="box-header with-border">
				  <div class="user-block" id="user-bloc-k">
					<img alt="User Image" src="'.$users_photo.'" class="img-circle">
					<span class="username"><a href="userprofile?userid='.base64_encode($user_id).'">'.$user_name.'</a></span>
					<span class="description">Posted: '.$posts_date.'</span>';
					
				if($user_id==$current_user_id)
				{ 
				
				$user_post .= '<div class="dropdown userprofile" id="users_action">
				<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
				<span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
				  <li role="presentation" class="topopup" id="'.$post_id.'" onclick="edit_post_popup_open(this.id)" style="padding-bottom: 0px;"><a role="menuitem" tabindex="-1"><i class="fa fa-pencil fa-fw"></i>EDIT</a></li>
				  <li role="presentation" id="'.$post_id.'" onclick="delete_Post(this.id)"><a role="menuitem" tabindex="-1" href="" ><i class="fa fa-trash-o fa-fw"></i>DELETE</a></li>
				</ul>
				
			  </div>';
		
			  }
			
				$user_post .= '</div>
				  <!-- /.user-block -->
				  <div class="box-tools">
					<button data-widget="collapse" class="btn btn-box-tool plus" type="button"><i class="fa fa-minus"></i>
					</button>
					
				  </div>
				  <!-- /.box-tools -->
				</div>
				<!-- /.box-header -->
				
				<div class="box-body" style="display: block;">
				<p class="pst_content title">'.$post_title.'</p>';
				
				if(!empty($post_img))
				{
					$thumb = explode(",",$post_img);
					$no_post = count($thumb);
				//print_r($thumb);
					
				 if($no_post==1)
				 {
					foreach($thumb as $post_image)
					{
					
			$user_post .= '<img alt="Photo" src="'.base_url().'assets/uploads/thumbs/'.$post_image.'-600x600_thumb.jpg" class="img-responsive padss">';
				  
					}
				 }
				 elseif($no_post==2)
				 {
					
				$user_post .= '<ul class="posting">';
					
					foreach($thumb as $post_image)
					{
					
					$user_post .= '<li class="post2"><img alt="Photo" src="'.base_url().'assets/uploads/thumbs/'.$post_image.'-300x300_thumb.jpg" class="img-responsive pad"></li>';
				  
					}
					
				 $user_post .= '</ul>';
				  
				 }
				 elseif($no_post==3)
				 {
					
					$user_post .= '<ul class="posting">';
				
					foreach($thumb as $post_image)
					{
					
					$user_post .= '<li class="post3"><img alt="Photo" src="'.base_url().'assets/uploads/thumbs/'.$post_image.'-300x300_thumb.jpg" class="img-responsive pad"></li>';
				
					}
				 
				 $user_post .= '</ul>';
				  
				 }
				 elseif($no_post>=4)
				 {
					
					$user_post .= '<ul class="posting">';
					
					foreach($thumb as $post_image)
					{
					
					$user_post .= '<li class="post4"><img alt="Photo" src="'.base_url().'assets/uploads/thumbs/'.$post_image.'-150x150_thumb.jpg" class="img-responsive pad"></li>';
				  
					}
				 
				 $user_post .= '</ul>';
				 }
				}
				 
				 $user_post .= '<div class="clear"></div>';
				 
				
			  if(!empty($post_content))
			  {	
				$contented = nl2br($post_content);
				
				$post_cont = $this->comman_function->ttruncat($contented,300);
			
			 $user_post .= '  <p class="post_contented'.$post_id.'" style="display:none;">'.$contented.'</p>
			   <hr>
			  <p class="post_cont"><span class="pst_content'.$post_id.'">'.$post_cont.'</span>';
			  
				$string_count = strlen($post_content);
				if($string_count>=300)
				{
			 
			$user_post .= '  <span id="'.$post_id.'" style="color:#3C8DBC; cursor: pointer;" class="count_read'. $post_id.'" onclick="read_more(this.id)">More read....</span></p>';
			  
				}
			  }
			  else
			  {
				$user_post .= '<p></p>';
			  }
			 
			 $user_post .= ' <div class="clear"></div>
				  <div class="clear"></div>';
				if($this->session->userdata('logged_in'))
				{
				   $user_post .='<span id="user_liked'.$post_id.'">
				  '.$active.'
				 </span>';
				 }
					$this -> db -> select('*');
					$this->db->order_by("date","ASC"); 
					$this -> db -> from('user_post_comment');
					$this -> db -> where('post_id', $post_id);
					$query = $this -> db -> get();
					$comment_count = $query -> num_rows();
				 
				 $user_post .= '<div class="pull-right text-muted"> <img class = "archived" src="'.base_url().'assets/like/like.jpg">('.$likes_count.')</span>|<img class = "archived" src="'.base_url().'assets/like/comment.jpg">('.$comment_count.')</div>  
				</div>
				<div class="box-footer box-comments">
				<div class="box-like">
				  <span id="like_this'.$post_id.'">'.$you_like.'</span><span class="tooltips">'.$like_count.' other';
					if ($qury->num_rows() > 0)
					{
					$user_post .= '<span class="tooltiptexts tooltip-tops">';

					foreach ($qury->result() as $rows)
					{
						$like_user_id = $rows->user_id;
						if($like_user_id!=$current_user_id)
						{
							$this->load->model('comman_function');
							$results = $this->comman_function->user_profile_info($like_user_id);
							$likers_name = $results->display_name;
							$user_post .='<p>'.$likers_name.'</p>';
						}
					}
					
					$user_post .='</span>';
				
						
					}
					
					$user_post .= '</span> like this.
				</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer box-comments" style="display: block;">';
				
					foreach ($query->result() as $row)
					{
						$comment_user_id = $row->user_id;
						$user_comment = $row->post_comment;
						$comment_date = strtotime($row->date);
						$comt_date = date('M j, Y H:i A',$comment_date);
						$result = $this->user_profile_info($comment_user_id);
						$users_names = $result->first_name.' '.$result->last_name;
						$users_thumb = $result->user_img;
						if(!empty($users_thumb))
						{
							$users_photos = base_url().'assets/ajax/upload/'.$users_thumb;
						}
						else
						{
							$users_photos = base_url().'assets/images/user.png'; 
						}
			
				 $user_post .=  '<div class="box-comment">
					<!-- User image -->
					<img alt="User Image" src="'.$users_photos.'" class="img-circle img-sm" style="margin-top: 5px;">

					<div class="comment-text">
						  <span class="username">
							<a href="userprofile?userid='.base64_encode($comment_user_id).'">'.$users_names.'</a>
							<span class="text-muted pull-right">'.$comt_date.'</span>
						  </span><!-- /.username -->
					  '.$user_comment.'
					</div>
					<!-- /.comment-text -->
				  </div>';
				 
				  }
				  
				  $user_post .=  '<div class="demo'.$post_id.'"></div>';
				   if($this->session->userdata('logged_in'))
					{
					 $user_post .=' <div class="box-comment">
					
					<!-- User image -->
					<img alt="User Image" src="'.$profile_photo.'" class="img-circle img-sm" style="margin-top: 5px;">

					<div class="comment-text">
					<form action="" method="post" id="comment_submit'.$post_id.'">
					<input type="hidden" id="comnt_post_id" name="cmnt_post_id" value="'.$post_id.'">
					<input type="text" id="'.$post_id.'" onclick="cmt_post_id(this.id)" placeholder="Write a Comment..." name="comment" class="post_comments'.$post_id.'" required/>
					</form>
					</div>
					<!-- /.comment-text -->
				  </div>';
				  }
				  
			$user_post .= '<!-- /.box-comment -->
				</div>
			   
				<!-- /.box-footer -->
			  </div>
		</div>
		</div>';
		
		}
		$all_post_ids .=$ids;  
		$user_post .='<div class="all_post_ids all_posts_remove"  id="'.$all_post_ids.'"></div>';
		return $user_post;
	}
	
	
// load album post

	public function album_post_show($posted_ids)
	{
		
		$album_post = '';
		$all_post_ids='';
		$posts_data = (explode("/",$posted_ids));
		$album_id = $posts_data[1];
		$ids = $posts_data[0];
		$ids=trim($ids, ",") ;
		
		$query = $this->db->query("SELECT * FROM user_post WHERE id NOT in ($ids) and album_id=$album_id ORDER BY id DESC LIMIT 12");
		if ($query->num_rows() > 0)  
		{
			$all_post_ids='';
			foreach ($query->result() as $row)
			{
				$post_id = $row->id;
				$all_post_ids .=$post_id.",";
				$user_id = $row->user_id;
				$results = $this->user_profile_info($user_id);
				$user_thumb = $results->user_img;
				$user_name = $results->first_name.' '.$results->last_name;
				$post_title = $row->post_title;
				$post_content = $row->post_conetnt;
				$post_img = $row->post_img_gallery;
				$post_date = strtotime($row->post_date);
				$posts_date = date("F Y", $post_date);
				if(!empty($user_thumb))
				{
					$users_photo = base_url().'assets/ajax/upload/'.$user_thumb;
				}
				else
				{
					$users_photo = base_url().'assets/images/user.png'; 
				}
					$this -> db -> select('*');
					$this -> db -> from('user_post_like');
					$this -> db -> where('user_id', $user_id);
					$this -> db -> where('post_id', $post_id);
					$query = $this -> db -> get();
					if ($query -> num_rows() == 1)
					{
						
						$active = '<button class="btn-default btn-xs active" id="'.$post_id.'" onclick="posts_unlike(this.id)" type="button"><i class="fa fa-thumbs-o-down"></i>Like</button>';
						
					}
					else
					{
						
						$active = '<button class="btn-default btn-xs" id="'.$post_id.'" onclick="posts_like(this.id)" type="button"><i class="fa fa-thumbs-o-up"></i>Like</button>';
						
					}
					$this -> db -> select('*');
					$this -> db -> from('user_post_like');
					$this -> db -> where('post_id', $post_id);
					$qury = $this -> db -> get();
					
					$likes_count = $qury -> num_rows();
					if($likes_count==0)
					{
						$like_count = $likes_count;
						$you_like = '';
					}
					else
					{
							$like_count = $likes_count-1;
							$qry = $qury->row();
							$like_ids = $qry->user_id;
							if($like_ids==$user_id)
							{
								$you_like = 'You and ';
								
							}
							else
							{
								$you_like = '';
							}
						
						
					}
				$this -> db -> select('*');
				$this -> db -> from('user_post_comment');
				$this -> db -> where('post_id', $post_id);
				$query = $this -> db -> get();
				$count_comment = $query->num_rows();
				if($this->session->userdata('logged_in'))
				{
					$class= 'col-sm-4 text albums';
					
				}
				else
				{
					$class='col-sm-4 text album';
					
				}
				
		$album_post .= '<div id="'.$post_id.'"  align="left" class="message_box" >
				<div class="'.$class.'">
				<div id="fb" class="box box-success ">  
				<div class="box box-widget">
				<div class="box-header with-border">
				<div class="user-block" id="user-bloc-k">
                <img alt="User Image" src="'.$users_photo.'" class="img-circle">
                <span class="username"><a href="userprofile?userid='.base64_encode($user_id).'">'.$user_name.'</a></span>
                <span class="description">Posted Date - '.$posts_date.'</span>
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button data-widget="collapse" class="btn btn-box-tool plus" type="button"><i class="fa fa-minus"></i>
                </button>
                
              </div> 
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
			
            <div class="box-body" style="display: block;">
			<div class="album-post-title">
			<p class="pst_content title">'.$post_title.'</p>
			</div>';
			
			
			if(!empty($post_img))
			{
				$thumb = explode(",",$post_img);
				$no_post = count($thumb);
			//print_r($thumb);
		
			
			
			
				foreach($thumb as $post_image)
				{
				
				$album_post .= '<div class="topopup" id="'.$post_id.'" onclick="popup_open(this.id);"><img  alt="Photo" src="'.base_url().'assets/uploads/thumbs/'.$post_image.'-300x300_thumb.jpg" class="img-responsive padss popupimage"></div>';
			 
				}
				
			}
			  
			  
			  
				if($this->session->userdata('logged_in'))
				{
				
			
				$album_post .= '<span id="user_liked'.$post_id.'" class="like-btn'.$post_id.'">
				'.$active.'
				</span>';
				
				}
				
              
             $album_post .= '<div class="pull-right text-muted"><span title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title=""><img class="archived" src="'.base_url().'assets/like/like.jpg">('.$likes_count.')</span>|<img class="archived" src="'.base_url().'assets/like/comment.jpg">('.$count_comment.')</div>
			
            </div>
			<div class="box-footer box-comments">
			<div class="box-like">
			  
			</div>
			
			</div>
            <!-- /.box-body -->
           
           
            <!-- /.box-footer -->
          </div>
          </div>
          </div>
		  </div>';
		 
			}
		} 
		$all_post_ids .=$ids;  
		$album_post .='<div class="all_post_ids all_posts_remove"  id="'.$all_post_ids.'"></div>';
		
		return $album_post;
		
	} 
	
	//edit user post
	
	public function user_edits_post($edit_data)
	{
		$session_data = $this->session->userdata('logged_in');
		$edit_user_id = $session_data['userid'];
		$edit_posts_data = (explode("%/%",$edit_data));
		$edit_post_id = $edit_posts_data[0];
		$edit_post_title = $edit_posts_data[1];
		$edit_post_content = $edit_posts_data[2];
		//return $edit_post_id.','.$edit_post_title.','.$edit_post_content;
		$this->db->query("UPDATE user_post SET post_title='$edit_post_title', post_conetnt='$edit_post_content', last_update=NOW() WHERE id = $edit_post_id and user_id=$edit_user_id");
		return true;
	}
	public function delete_posts($post_id)  
	{
		$tables = 'user_post';
		$this->db->where('id', $post_id);
		$this->db->delete($tables);
		
		$tables = 'user_post_like';
		$this->db->where('post_id', $post_id);
		$this->db->delete($tables); 
		
		$tables = 'user_post_comment';
		$this->db->where('post_id', $post_id);
		$this->db->delete($tables); 
		return true;
	}
	////////////// show metrimonial scroll //////////////// 
	public function matrimonial_show($posted_ids)
	{
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['userid'];
		$metrimonial_list = '';
		$all_post_ids='';
		$ids = $posted_ids;
		$ids=trim($ids, ",") ;
	
		if($session_data)
		{
		$query = $this->db->query("SELECT * FROM matrimonial WHERE user_id=$id id NOT in ($ids) ORDER BY id DESC LIMIT 6");
		}
		else
		{
		$query = $this->db->query("SELECT * FROM matrimonial WHERE id NOT in ($ids) ORDER BY id DESC LIMIT 6");
		}	
		if ($query->num_rows() > 0)  
		{
		foreach ($query->result() as $row)
		{
			$metry_id = $row->id;
			$all_post_ids .=$metry_id.",";
		 
		
		$mother_gotra = $row->mother_gotra;
		$user_name = $row->user_name;
		$get_dob = $row->d_o_b;
		$user_dob = explode('/',$get_dob);
		$img = $row->use_img;
	
		//print_r($user_dob);
		
		$metrimonial_list .='<div id="'.$metry_id.'"  align="left" class="message_box" >
			<div class="col-sm-4 text metrimonialheight">
			<div class="user_posts">
			<div id="fb" class="box box-success gallerycontent">
			<div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">';
			
			if(!empty($img))
			{
			
			$metrimonial_list .='<img class="album-images " src="'.base_url().'assets/matrimonial-image/matrimonial-thumbs/'.$img.'-150x150_thumb.jpg">';
			
			}
			else
			{
			
			$metrimonial_list .=' <img class="album-images " alt="User Image"  src="'.base_url().'assets/images/user.png">';
		
			}
		
              $metrimonial_list .='<span class="usernames"><a href="Metrimonialdetails?userid='. base64_encode($metry_id).'">'.$user_name.'</a></span>
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button data-widget="collapse" class="btn btn-box-tool plus" type="button"><i class="fa fa-minus"></i>
                </button>
                
              </div>
			   <!-- /.box-header -->
			
          <div class="box-body" style="display: block;">';
			
			if(!empty($img))
			{
		
			$metrimonial_list .='<img class="album-images " src="'.base_url().'assets/matrimonial-image/matrimonial-thumbs/'.$img.'-300x300_thumb.jpg">';
			
			}
			else
			{
		
			$metrimonial_list .='<img class="album-images " alt="User Image"  src="'. base_url().'assets/images/user.png">';
			
			}
			
		$metrimonial_list .='	<hr>
			<div class="clear"></div>
			<div class="metrimoni-show">
			
			<p class="post_contented metrimonial-details">DOB :</p><p class="post_contented metrimonial-detailss">'.$row->d_o_b.'</p>
			<p class="post_contented metrimonial-details">Phone :</p><p class="post_contented metrimonial-detailss">'. $row->contact_no.'</p>
			<p class="post_contented metrimonial-details">Gotra(M) :</p><p class="post_contented metrimonial-detailss">'.$row->mother_gotra.'</p>
			<p class="post_contented metrimonial-details">Gotra(F) :</p><p class="post_contented metrimonial-detailss">'.$row->father_gotra.'</p>
			</div>
			
			</div>
			   <div class="clear"></div> 
			   <span id="'.$metry_id.'" onclick="delete_matrimonial(this.id)"><img src="'.base_url().'assets/images/deleteimage.png" /></span>
			  
			  <div class="pull-right text-muted">
				<a href="editmetrimonial?userid='.base64_encode($row->id).'"><div class="pull-right text-muted"> <img  src="'.base_url().'assets/images/Edit-icon.png" /></div></a></</div>
			  
              </div>
              </div>
              </div>
              </div>
              </div>
              <!-- /.box-tools -->
            </div>';
		
			}
	
		}
		$all_post_ids .=$ids;  
		$metrimonial_list .='<div class="all_post_ids all_posts_remove"  id="'.$all_post_ids.'"></div>';
		
		return $metrimonial_list;
	} 
	
		////////////// show metrimonial scroll //////////////// 
	public function matrimonial_show_alllist($posted_ids)
	{
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['userid'];
		$metrimonial_list = '';
		$all_post_ids='';
		$ids = $posted_ids;
		$ids=trim($ids, ",") ;
	
		$query = $this->db->query("SELECT * FROM matrimonial WHERE id NOT in ($ids) ORDER BY id DESC LIMIT 6");
			
		if ($query->num_rows() > 0)  
		{
		foreach ($query->result() as $row)
		{
			$metry_id = $row->id;
			$all_post_ids .=$metry_id.",";
		 
		
		$mother_gotra = $row->mother_gotra;
		$user_name = $row->user_name;
		$get_dob = $row->d_o_b;
		$user_dob = explode('/',$get_dob);
		$img = $row->use_img;
		$mother_gotra_id = $row->mother_gotra;
		$father_gotra_id = $row->father_gotra;
	
		//print_r($user_dob);
		
		$metrimonial_list .='<div id="'.$metry_id.'"  align="left" class="message_box" >
			<div class="col-sm-4 text metrimonialheight">
			<div class="user_posts">
			<div id="fb" class="box box-success gallerycontent">
			<div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">';
			
			if(!empty($img))
			{
			
			$metrimonial_list .='<img class="album-images " src="'.base_url().'assets/matrimonial-image/matrimonial-thumbs/'.$img.'-150x150_thumb.jpg">';
			
			}
			else
			{
			
			$metrimonial_list .=' <img class="album-images " alt="User Image"  src="'.base_url().'assets/images/user.png">';
		
			}
		
              $metrimonial_list .='<span class="usernames"><a href="Metrimonialdetails?userid='. base64_encode($metry_id).'">'.$user_name.'</a></span>
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button data-widget="collapse" class="btn btn-box-tool plus" type="button"><i class="fa fa-minus"></i>
                </button>
                
              </div>
			   <!-- /.box-header -->
			
          <div class="box-body metrimonial-body" style="display: block;">';
			
			if(!empty($img))
			{
		
			$metrimonial_list .='<img class="album-images " src="'.base_url().'assets/matrimonial-image/matrimonial-thumbs/'.$img.'-300x300_thumb.jpg">';
			
			}
			else
			{
		
			$metrimonial_list .='<img class="album-images " alt="User Image"  src="'. base_url().'assets/images/user.png">';
			
			}
			
		$metrimonial_list .='	<hr>
			<div class="clear"></div>
			<div class="metrimoni-show">
			
			<p class="post_contented metrimonial-details">DOB :</p><p class="post_contented metrimonial-detailss">'.$row->d_o_b.'</p>
			<p class="post_contented metrimonial-details">Phone :</p><p class="post_contented metrimonial-detailss">'. $row->contact_no.'</p>';
			$query = $this->db->query("SELECT * FROM user_gotra where id='$mother_gotra_id'");
				foreach ($query->result() as $rows)
				{
			$metrimonial_list .='<p class="post_contented metrimonial-details">Gotra(M) :</p><p class="post_contented metrimonial-detailss">'.$rows->gotra_name.'</p>';
				}
				$query = $this->db->query("SELECT * FROM user_gotra where id='$father_gotra_id'");
				foreach ($query->result() as $rows)
				{
			
		$metrimonial_list .='<p class="post_contented metrimonial-details">Gotra(F) :</p><p class="post_contented metrimonial-detailss">'.$rows->gotra_name.'</p>';
				}
		
			
		$metrimonial_list .='</div>
			
			</div>
			  <div class="clear"></div>
			  
              </div>
              </div>
              </div>
              </div>
              </div>
              <!-- /.box-tools -->
            </div>';
		
			}
	
		}
		$all_post_ids .=$ids;  
		$metrimonial_list .='<div class="all_post_ids all_posts_remove"  id="'.$all_post_ids.'"></div>';
		
		return $metrimonial_list;
	}
	
		////////////// show user list scroll //////////////// 
	public function all_user_listss($posted_ids)
	
	{
		
		$album_post = '';
		$all_post_ids='';
		$posts_data = (explode("/",$posted_ids));
		$user_address = $posts_data[1];
		$ids = $posts_data[0];
		$ids=trim($ids, ",") ;
		
		$query = $this->db->query("SELECT * FROM user_info WHERE (id NOT in ($ids)) AND (current_country='$user_address' OR current_state='$user_address' OR current_dist='$user_address' OR current_vill_name='$user_address' OR perma_country='$user_address' OR	perma_state='$user_address' OR perma_dist='$user_address' OR perma_vill_name='$user_address') ORDER BY id ASC LIMIT 12");
		if ($query->num_rows() > 0)  
		{
			$all_post_ids='';
			foreach ($query->result() as $row)
			{
				$user_id = $row->user_id;
				$user_ids = $row->id;
				$all_post_ids .=$user_ids.",";
				
				$results = $this->user_profile_info($user_id);
				
				
				if(!empty($row->user_img))
				{
				
				$images = '<img class="album-images " alt="User Image"  src="'.base_url().'assets/ajax/upload/'.$row->user_img.'">';
				}
				else
				{
				
				$images = '<img class="album-images " alt="User Image"  src="'.base_url().'assets/images/user.png">';
				}
					
				if($this->session->userdata('logged_in'))
				{
					$class= 'col-sm-4 text albums item-isotope';
					
				}
				else
				{
					$class='col-sm-4 text album item-isotope';
					
				}
				
				$album_post .= '<div id="'.$user_ids.'"  align="left" class="message_box" >
				<div class="'.$class.'">
				<div id="fb" class="box box-success ">  
				<div class="box box-widget">
				<div class="box-header with-border">
				<div class="user-block" id="user-bloc-k">
               '.$images.'
                <span class="username"><a href="userprofile?userid='.base64_encode($user_id).'">'.$row->first_name.' '.$row->last_name.' </a></span>
                
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button data-widget="collapse" class="btn btn-box-tool plus" type="button"><i class="fa fa-minus"></i>
                </button>
                
              </div> 
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
			
            <div class="box-body user_listimg" style="display: block;">
			'.$images.'
			<hr>
			
			  <div class="clear"></div>
		
            </div>
			<div class="box-footer box-comments">
			<div class="box-like">
			  
			</div>
			
			</div>
            <!-- /.box-body -->
           
           
            <!-- /.box-footer -->
          </div>
          </div>
          </div>
		  </div>';
		 
			}
		} 
		$all_post_ids .=$ids;  
		$album_post .='<div class="all_post_ids all_posts_remove"  id="'.$all_post_ids.'"></div>';
		
		return $album_post;
		
	} 
		
	
	
	public function edit_user_posts($pst_id)
	{
		
		$this -> db -> select('*');
		$this -> db -> from('user_post');
		$this -> db -> where('id', $pst_id);
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		$query -> num_rows();
		$qry = $query->row();
		$post_title = $qry->post_title;
		$post_content = $qry->post_conetnt;
		$user_posts = $post_title.'&'.$post_content;
		return $user_posts;
	
	
	}
	
	  public function album_login_validate($login_data){
        // grab user input
		
		$login = explode(',',$login_data);
		$user_name = $login[0];
        $pass = $login[1];
	
              // Prep the query
			   $this -> db -> select('id, username, user_role, password, display_name,user_activation_key,user_status');
			   $this -> db -> from('users');
			   $this -> db -> where('username', $user_name);
			   $this -> db -> where('password', MD5($pass));
			   $this -> db -> limit(1);
		
	   $query = $this -> db -> get(); 
	 
	   if($query -> num_rows() == 1)
	   {
	   
			$row = $query->row();
			$key = $row->user_activation_key;
			if(empty($key))
			{
				$status = $row->user_status;
				if($status==1)
				{
					
					$user_role = $row->user_role;
					
					$data = array(
							'userid' => $row->id,
							'username' => $row->username,
							'name' => $row->display_name,
							'validated' => true
							);
					$this->session->set_userdata('logged_in',$data);
					if($user_role==1 || $user_role==2)
					{
						return 'success';
						
					}
					
				}
				else
				{
					return 'not_active';
				}
			}
			else
			{
			
				return 'not_empty';
			}
	   }
	   else
	   {
        // If the previous process did not validate
        // then return false.
		$user_role = 'not_match';
        return $user_role;
		}
				

		
			
    }
	
	/////////////////add_state///////////////
	
	public function add_state() 
	{
		$state_name = $this->input->post('state_name');
		$country_id = $this->input->post('country_id');
		
		$this->db->query("insert into state(state_name,country_id) values('$state_name','$country_id')"); 
		
	}
	//////////////add_country////////////////
	public function add_country() 
	{
		
		$country_name = $this->input->post('country_id');
		
		$this->db->query("insert into country(country_name) values('$country_name')"); 
		
	}
	
	//////////////add_news////////////////
	public function add_news() 
	{
		
		$latest_news = $this->input->post('latest_news');
		$description = $this->input->post('description');
		$dates = date("F j, Y, g:i a");  
		
		$this->db->query("insert into latest_news(news_title,news_description,news_date) values('$latest_news','$description',NOW())"); 
		
	}
	///////////////village_name////////////////
	
	public function village_name() 
	{
		
		$dist_id = $this->input->post('dist_id');
		$village_name = $this->input->post('village_name');
		
		$this->db->query("insert into village_name(name,dist_id) values('$village_name','$dist_id')"); 
		
	}
	/////////////add district/////////////
	
	public function add_district() 
	{
		
		$state_id = $this->input->post('state_id');
		$district_name = $this->input->post('district_name');
		
		$this->db->query("insert into district_name(district_name,state_id) values('$district_name','$state_id')"); 
		
	}
	
	
	// login user load album post

	public function login_user_album_post_show($posted_ids)
	{
		$session_data = $this->session->userdata('logged_in');
		$current_user_id = $session_data['userid'];
		
		$album_post = '';
		$all_post_ids='';
		$posts_data = (explode("/",$posted_ids));
		$album_id = $posts_data[1];
		$ids = $posts_data[0];
		$ids=trim($ids, ",") ;
		
		$query = $this->db->query("SELECT * FROM user_post WHERE id NOT in ($ids) and album_id=$album_id and user_id=$current_user_id ORDER BY id DESC LIMIT 9");
		if ($query->num_rows() > 0)  
		{
			$all_post_ids='';
			foreach ($query->result() as $row)
			{
				$post_id = $row->id;
				$all_post_ids .=$post_id.",";
				$user_id = $row->user_id;
				$results = $this->user_profile_info($user_id);
				$user_thumb = $results->user_img;
				$user_name = $results->first_name.' '.$results->last_name;
				$post_title = $row->post_title;
				$post_content = $row->post_conetnt;
				$post_img = $row->post_img_gallery;
				$post_date = strtotime($row->post_date);
				$posts_date = date("F Y", $post_date);
				if(!empty($user_thumb))
				{
					$users_photo = base_url().'assets/ajax/upload/'.$user_thumb;
				}
				else
				{
					$users_photo = base_url().'assets/images/user.png'; 
				}
					$this -> db -> select('*');
					$this -> db -> from('user_post_like');
					$this -> db -> where('user_id', $user_id);
					$this -> db -> where('post_id', $post_id);
					$query = $this -> db -> get();
					if ($query -> num_rows() == 1)
					{
						
						$active = '<button class="btn-default btn-xs active" id="'.$post_id.'" onclick="posts_unlike(this.id)" type="button"><i class="fa fa-thumbs-o-down"></i>Like</button>';
						
					}
					else
					{
						
						$active = '<button class="btn-default btn-xs" id="'.$post_id.'" onclick="posts_like(this.id)" type="button"><i class="fa fa-thumbs-o-up"></i>Like</button>';
						
					}
					$this -> db -> select('*');
					$this -> db -> from('user_post_like');
					$this -> db -> where('post_id', $post_id);
					$qury = $this -> db -> get();
					
					$likes_count = $qury -> num_rows();
					if($likes_count==0)
					{
						$like_count = $likes_count;
						$you_like = '';
					}
					else
					{
							$like_count = $likes_count-1;
							$qry = $qury->row();
							$like_ids = $qry->user_id;
							if($like_ids==$user_id)
							{
								$you_like = 'You and ';
								
							}
							else
							{
								$you_like = '';
							}
						
						
					}
				$this -> db -> select('*');
				$this -> db -> from('user_post_comment');
				$this -> db -> where('post_id', $post_id);
				$query = $this -> db -> get();
				$count_comment = $query->num_rows();
				if($this->session->userdata('logged_in'))
				{
					$class= 'col-sm-4 text albums';
					
				}
				else
				{
					$class='col-sm-4 text album';
					
				}
				
		$album_post .= '<div id="'.$post_id.'"  align="left" class="message_box" >
				<div class="'.$class.'">
				<div id="fb" class="box box-success ">  
				<div class="box box-widget">
				<div class="box-header with-border">
				<div class="user-block" id="user-bloc-k">
                <img alt="User Image" src="'.$users_photo.'" class="img-circle">
                <span class="username"><a href="userprofile?userid='.base64_encode($user_id).'">'.$user_name.'</a></span>
                <span class="description">Posted Date - '.$posts_date.'</span>
              </div>';
			  
				if($user_id==$current_user_id)
				{ 
				
				$album_post .= '<div class="dropdown" id="users_action">
				<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
				<span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
				  <li role="presentation" class="topopup" id="'.$post_id.'" onclick="edit_post_popup_open(this.id)" style="padding-bottom: 0px;"><a role="menuitem" tabindex="-1"><i class="fa fa-pencil fa-fw"></i>EDIT</a></li>
				  <li role="presentation" id="'.$post_id.'" onclick="delete_Post(this.id)"><a role="menuitem" tabindex="-1" href="" ><i class="fa fa-trash-o fa-fw"></i>DELETE</a></li>
				</ul>
				
			  </div>';
			 
			  }
			
             $album_post .= ' <!-- /.user-block -->
              <div class="box-tools">
                <button data-widget="collapse" class="btn btn-box-tool plus" type="button"><i class="fa fa-minus"></i>
                </button>
                
              </div> 
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
			
            <div class="box-body" style="display: block;">
			<p class="pst_content title">'.$post_title.'</p>';
			
			
			if(!empty($post_img))
			{
				$thumb = explode(",",$post_img);
				$no_post = count($thumb);
			//print_r($thumb);
		
			
			
			
				foreach($thumb as $post_image)
				{
				
				$album_post .= '<div class="topopup" id="'.$post_id.'" onclick="popup_open(this.id);"><img  alt="Photo" src="'.base_url().'assets/uploads/thumbs/'.$post_image.'-300x300_thumb.jpg" class="img-responsive padss popupimage"></div>';
			 
				}
				
			}
			  
			  
			  
				if($this->session->userdata('logged_in'))
				{
				
			
				$album_post .= '<span id="user_liked'.$post_id.'">'.$active.'</span>';
				
				}
				
              
             $album_post .= '<div class="pull-right text-muted"><span title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title=""><img class="archived" src="'.base_url().'assets/like/like.jpg">('.$likes_count.')</span>|<img class="archived" src="'.base_url().'assets/like/comment.jpg">('.$count_comment.')</div>
			
            </div>
			<div class="box-footer box-comments">
			<div class="box-like">
			  
			</div>
			
			</div>
            <!-- /.box-body -->
           
           
            <!-- /.box-footer -->
          </div>
          </div>
          </div>
		  </div>';
		
			}
		} 
		$all_post_ids .=$ids;  
		$album_post .='<div class="all_post_ids all_posts_remove"  id="'.$all_post_ids.'"></div>';
		
		return $album_post;
		
	}
	
	// edit country 
	public function edit_country()
	{
		$country_nm = $this->input->post('country_name');
		$country_id = $this->input->post('edit_country'); 
		
		$this->db->query("update country set country_name='$country_nm' where country_id='$country_id'");
		return true;
	}
	
	// edit news 
	public function edit_news()
	{
		
		$latest_news = $this->input->post('latest_news');
		$news_id = $this->input->post('news_id');
		$description = $this->input->post('description');
		$dates = date("F j, Y, g:i a");  
		
		$this->db->query("update latest_news set news_title='$latest_news',news_description='$description',news_date =NOW() where id='$news_id'"); 
		return true;
	}
	// edit state 
	public function edit_state()
	{
		$state_name = $this->input->post('state_name');
		$state_id = $this->input->post('edit_id'); 
		$country_id = $this->input->post('country_id'); 
		
		$this->db->query("update state set state_name='$state_name', country_id='$country_id' where id='$state_id'");
		return true;
	}
	
	// edit district 
	public function edit_district()
	{
		$district_name = $this->input->post('district_name');
		$district_id = $this->input->post('edit_district_id'); 
		$state_id = $this->input->post('state_id'); 
		
		$this->db->query("update district_name set district_name='$district_name', state_id='$state_id' where district_id='$district_id'");
		return true;
	}
	
		// edit village 
	public function edit_village()
	{
		$village_name = $this->input->post('village_name');
		$edit_vill_id = $this->input->post('edit_vill_id'); 
		$dist_id = $this->input->post('dist_id'); 
		
		$this->db->query("update village_name set name='$village_name', dist_id='$dist_id' where village_id='$edit_vill_id'");
		
		
		return true;
	}
	
	// delete_countries
	public function delete_countries($country_id)
	{
		$tables = 'country';
		$this->db->where('country_id', $country_id);
		$this->db->delete($tables);
		
		$tables = 'state';
		$this->db->where('country_id', $country_id);
		$this->db->delete($tables);
		return true;
	}
	///// delete_upload file////////
	
	public function delete_upload_files($upload_id)
	{
		$this -> db -> select('*');
		$this -> db -> from('upload_files');
		$this -> db -> where('id', $upload_id);
		$query = $this -> db -> get();
		$query -> num_rows();
		$qry = $query->row();
		$attachement = $qry->attachement;
		unlink("assets/uploads/uploadfile/".$attachement);
	
		
		$tables = 'upload_files';
		$this->db->where('id', $upload_id);
		$this->db->delete($tables);
		return true;
	}

	// delete_news
	public function delete_latest_news($new_id)
	{
		$tables = 'latest_news'; 
		$this->db->where('id', $new_id);
		$this->db->delete($tables);
		return true;
	}
	
	/////////////////delete_states/////////////////
	
	public function delete_states($state_id)
	{
		$tables = 'state';
		$this->db->where('id', $state_id);
		$this->db->delete($tables);
		
		$tables = 'district_name';
		$this->db->where('state_id', $state_id);
		$this->db->delete($tables);
		return true;
	}
	
	/////////////////delete_district/////////////////
	
	public function delete_district($district_id)
	{
		$tables = 'district_name';
		$this->db->where('district_id', $district_id);
		$this->db->delete($tables);
		
		$tables = 'village_name';
		$this->db->where('dist_id', $district_id);
		$this->db->delete($tables);
		return true;
	}
	
	/////////////////delete_village/////////////////
	
	public function delete_village($village_id)
	{
		$tables = 'village_name';
		$this->db->where('village_id', $village_id);
		$this->db->delete($tables);
		
		
		return true;
	}
	
	public function edit_metrimonials($metrimonial_id)
	{
		$query = $this->db->query("SELECT * FROM matrimonial where id='$metrimonial_id'");
		foreach ($query->result() as $row)
		{
		$metrimonial_update = '';
		$id = $row->id; 
		$mother_gotra = $row->mother_gotra;
		$get_dob = $row->d_o_b;
		$user_dob = explode('/',$get_dob);
		$img = $row->use_img;
		$mother_gotra_id = $row->mother_gotra;
		
		$metrimonial_update .= '<form action="" method="post" enctype="multipart/form-data">
						
			
			<div id="messg">
			</div>
			<div class="col-sm-12 text"> 
			<h4>Personal Information</h4>
			</div>
			<div class="col-sm-6 text">
			<div class="form-group">
			<label for="form-first-name" class="sr-only">Name</label>
			<input type="text" id="name" class="form-control" name="name" value ="'.$row->user_name.'" placeholder="Name" required/>
			
			<input type="hidden" name="run_codess" value="'.$row->id.'"> 
			</div>
			</div>
			<div class="col-sm-6 text">
			<div class="form-group">
			<label for="form-last-name" class="sr-only">Father name</label>
			<input type="text" id="father-name" class="form-control" name="father_name" value = " '.$row->father_name.'" placeholder="Fathers name" required/>
			</div>
			</div>
			<div class="clear"></div>
			<div class="col-sm-6 text">
			<div class="form-group">
			<label for="form-last-name" class="sr-only">Gender</label>
			<select name="gender" required>
			
			<option value="">Select Gender</option>';
			
			$gender = $row->gender; 
				$select = '';
				$selected = '';
				if($gender=='male')
				{
					$select = 'selected';
					
				}
				elseif($gender=='female')
				{
					echo $selected = 'selected';
				}
			$metrimonial_update .=' <option value="male"'.$select.' >Male</option>
			<option value="female"'.$selected.' >Female</option>
			</select>
			</div>
			</div>
			<div class="col-sm-6 text">
			<div class="form-group">
			<label for="form-last-name" class="sr-only">Phone No.</label>
			<input type="number" id="phone_no" class="form-control" name="phone_no" value ="'.$row->contact_no.'" placeholder="Contact No." required/>
			</div>
			</div>
			<div class="clear"></div>
			<div class="col-sm-12 text">
			<div class="form-group">
			<label for="form-first-name" class="sr-only">Current_Address</label>
			<input type="text" id="current_address" class="form-control" name="current_address" value ="'.$row->current_address.'" placeholder="Current Address" required/>
			<input type="hidden" name="run_code" value="'.$row->current_address.'">
			</div>
			</div> 
			<div class="clear"></div>
			<div class="col-sm-12 text"> 
			<h4>Date of Birth</h4>
			</div>
			<div class="col-sm-4 text">
			<div class="form-group">
			<label for="form-last-name" class="sr-only">day</label>
			<select name="day" required>
			<option value="">Select Day</option>';
			
			
			$i=1; 
			for($i=1; $i<=31;$i++)
			{
				$select = '';
				if($user_dob[2]==$i)
				{
					$select = 'selected';
				}
			
			$metrimonial_update .= '<option '.$select.' value="'.$i.'">'.$i.'</option>';
			
			
			}
			

$metrimonial_update .='</select>
						</div>
						</div>
						<div class="col-sm-4 text">
						<div class="form-group">
						<label for="form-last-name" class="sr-only">Month</label>
						<select name="month" required>
						<option value="">Select Month</option>';
					
						
						$month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
						foreach($month as $months)
						{
							$select = '';
							if($user_dob[1]== $months) 
							{
								$select = 'selected';
							}
						
					$metrimonial_update .='	<option value="'.$months.'" '.$select.'>'.$months.'</option>';
						
						}

					
$metrimonial_update	.='</select>
						</div>
						</div>
						<div class="col-sm-4 text">
						<div class="form-group">
						<label for="form-last-name" class="sr-only">Year</label>
						<select name="year" required>
						<option value="">Select Year</option> '; 
						

						$cu_y =  date("Y");

						while($cu_y>=1800)
						{
							$select = '';
							if($user_dob[0]==$cu_y)
							{
								$select = 'selected';
							}
						
						$metrimonial_update .='<option value="'.$cu_y.'" '.$select.'>'.$cu_y.'</option>';
						
						$cu_y--;
						}
					

					$metrimonial_update .='	</select>
						</div>
						</div>
						<div class="clear"></div>
						<div class="col-sm-6 text">
						<div class="form-group">
						<label for="form-last-name" class="sr-only">Gotra</label>
						<select name="mother_gotra" required>
						<option value="">Select Mothers Gotra </option>'; 
						
				$mother_gotra = $row->mother_gotra;
				$query = $this->db->query('SELECT * FROM user_gotra');
				foreach ($query->result() as $rows)
				{
					$select = '';
					if($rows->id==$mother_gotra)
					{
						$select = 'selected';
					}
					
								
				$metrimonial_update .=' <option value="'.$rows->id.'" '.$select.'>'.$rows->gotra_name.'</option>';
				}
			
$metrimonial_update .='<option value=""></option>
						</select>
						
						</div>
						</div>
						<div class="col-sm-6 text">
						<div class="form-group">
						<label for="form-last-name" class="sr-only">Gotra</label>
						<select name="father_gotra" required>
						<option value="">Select Fathers Gotra</option>';
						
							
							$query = $this->db->query('SELECT * FROM user_gotra');
							foreach ($query->result() as $rows)
							{
								$select = '';
								if($rows->id==$row->father_gotra)
								{
									$select = 'selected'; 
								}
								
											
							$metrimonial_update .= '<option value="'.$rows->id.'" '.$select.'>'.$rows->gotra_name.'</option>';
							}
							
						
	$metrimonial_update .='</select>
						</div>
						</div>
						<div class="clear"></div>
					
						<div class="col-sm-6 text">
						<div class="form-group">
						<label for="form-last-name" class="sr-only">Profession</label>
						<select name="Profession" required>';
						
						$Profession = $row->profession;
						$select = '';
						$selt = '';
						$seltet = '';
						if($Profession=='Self Employed')
						{
						  $select = 'selected';
						}
						elseif($Profession == 'Govt.Service')
						{
						$selt = 'selected'; 
						}
						elseif($Profession == 'Private Sector')
						{
						$seltet = 'selected'; 
						}
						
				
				
	$metrimonial_update .='<option value="">Select Profession</option>
			<option value="Self Employed" '.$select.'>Self Employed</option>
			<option value="Govt.Service" '.$selt.' >Govt.Service</option>
			<option value="Private Sector" '.$seltet.' >Private Sector</option>
			</select>
			</div>
			</div>
			<div class="col-sm-6 text">
			<div class="form-group form_group-top">
			<label for="form-first-name" class="sr-only">Mars</label>
			Are you mars (मांगलिक) : ';
			
					$mars = $row->mars;
					$select = '';
					$selected = '';
					
					if($mars=='Yes')
					{
					  $select = 'checked';
					}
					elseif($mars == 'No')
					{
					$selected = 'checked'; 
					}
			
	$metrimonial_update .='<label class="radio-inline">
				  <input type="radio" name="radio" value ="Yes"'.$select.'>Yes
				</label>
				<label class="radio-inline">
				<input type="radio" name="radio" value ="No"'.$selected.'>No    
				</label>
				</div>
				</div>
				<div class="col-sm-12 text">
				<div class="form-group1"> 
				<input type="file" name="userfile[]"  multiple="multiple">
				</div>
				</div>
				<div class="col-sm-6 text">
				</div>
				<div class="clear"></div>
				<br>
				<div class="text-center">
				<button class="btn btn-primary" type="submit" id="signup_sub" name="submitted">Submit</button>
				</div>
				</form>';
		
		
		}
		
		
		return $metrimonial_update;
	}
	
	
		////////////// show metrimonial scroll //////////////// 
	public function admin_matrimonial_show_alllist($posted_ids)
	{
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['userid'];
		$metrimonial_list = '';
		$all_post_ids='';
		$ids = $posted_ids;
		$ids=trim($ids, ",") ;
	
		$query = $this->db->query("SELECT * FROM matrimonial WHERE id NOT in ($ids) ORDER BY id DESC LIMIT 3");
			
		if ($query->num_rows() > 0)  
		{
		foreach ($query->result() as $row)
		{
			$metry_id = $row->id;
			$all_post_ids .=$metry_id.",";
		 
		
		$mother_gotra = $row->mother_gotra;
		$user_name = $row->user_name;
		$get_dob = $row->d_o_b;
		$user_dob = explode('/',$get_dob);
		$img = $row->use_img;
		$mother_gotra_id = $row->mother_gotra;
		$father_gotra_id = $row->father_gotra;
	
		//print_r($user_dob);
		
		$metrimonial_list .='<div id="'.$metry_id.'"  align="left" class="message_box" >
			<div class="col-sm-4 text metrimonialheight">
			<div class="user_posts">
			<div id="fb" class="box box-success gallerycontent">
			<div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">';
			
			if(!empty($img))
			{
			
			$metrimonial_list .='<img class="album-images " src="'.base_url().'assets/matrimonial-image/matrimonial-thumbs/'.$img.'-150x150_thumb.jpg">';
			
			}
			else
			{
			
			$metrimonial_list .=' <img class="album-images " alt="User Image"  src="'.base_url().'assets/images/user.png">';
		
			}
		
              $metrimonial_list .='<span class="usernames"><a href="Metrimonialdetails?userid='. base64_encode($metry_id).'">'.$user_name.'</a></span>
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button data-widget="collapse" class="btn btn-box-tool plus" type="button"><i class="fa fa-minus"></i>
                </button>
                
              </div>
			   <!-- /.box-header -->
			
          <div class="box-body metrimonial-body" style="display: block;">';
			
			if(!empty($img))
			{
		
			$metrimonial_list .='<img class="album-images " src="'.base_url().'assets/matrimonial-image/matrimonial-thumbs/'.$img.'-300x300_thumb.jpg">';
			
			}
			else
			{
		
			$metrimonial_list .='<img class="album-images " alt="User Image"  src="'. base_url().'assets/images/user.png">';
			
			}
			
		$metrimonial_list .='	<hr>
			<div class="clear"></div>
			<div class="metrimoni-show">
			
			<p class="post_contented metrimonial-details">DOB :</p><p class="post_contented metrimonial-detailss">'.$row->d_o_b.'</p>
			<p class="post_contented metrimonial-details">Phone :</p><p class="post_contented metrimonial-detailss">'. $row->contact_no.'</p>';
			
			$query = $this->db->query("SELECT * FROM user_gotra where id='$mother_gotra_id'");
				foreach ($query->result() as $rows)
				{
			$metrimonial_list .='<p class="post_contented metrimonial-details">Gotra(M) :</p><p class="post_contented metrimonial-detailss">'.$rows->gotra_name.'</p>';
				}
				$query = $this->db->query("SELECT * FROM user_gotra where id='$father_gotra_id'");
				foreach ($query->result() as $rows)
				{
			
		$metrimonial_list .='<p class="post_contented metrimonial-details">Gotra(F) :</p><p class="post_contented metrimonial-detailss">'.$rows->gotra_name.'</p>';
				}
		$metrimonial_list .='</div>
			
			</div>
			  <div class="clear"></div>
			   <span id="'.$metry_id.'" onclick="delete_matrimonial(this.id)"><img src="'.base_url().'assets/images/deleteimage.png" /></span>
			  
			  <div class="pull-right text-muted">
				<a href="editmetrimonial?userid='.base64_encode($row->id).'"><div class="pull-right text-muted"> <img  src="'.base_url().'assets/images/Edit-icon.png" /></div></a></</div>
              </div>
              </div>
              </div>
              </div>
              </div>
              <!-- /.box-tools -->
            </div>
            </div>';
		
			}
	
		}
		$all_post_ids .=$ids;  
		$metrimonial_list .='<div class="all_post_ids all_posts_remove"  id="'.$all_post_ids.'"></div>';
		
		return $metrimonial_list;
	}
	
		
		
public function get_family($number) { 

			$session_data = $this->session->userdata('logged_in');
			$id = $session_data['userid'];
			$user_levels = 0;
			$row = $this->db->query("SELECT MAX(user_level) AS `user_levels` FROM `user_info` where account_creater_id='$id'")->row(); 

			$max_level = $row->user_levels;
			$arr    = array();
			$this->db->select('*');
			$this->db->from('user_info');
			$this->db->where('account_creater_id',$id);
			$query = $this -> db-> get();
			foreach ($query->result() as $rowss)
		
			{ 
				//echo $rowss->user_level;
				$arr[] = $rowss->user_level;
				
			}
		$min_level  = min($arr);
				
		
		$get_family_tree='';
		$this->db->select('*');
		$this->db->from('user_info');
		$this->db->where('user_level',$number);
		$this->db->where('account_creater_id',$id);
		$query = $this -> db-> get();
		$family = $query->result();	
		return $family;
		
		if ($number >= $min_level)   
		{ 
			return get_family($number-1);
		}           
		
	}
}


?>
