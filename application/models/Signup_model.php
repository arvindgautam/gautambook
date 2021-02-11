<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Signup_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function valide_reg(){
        // grab user input
		$bcc = '';
		$this->load->model('Comman_function');
		$f_name = $this->input->post('fname');
        $l_name = $this->input->post('lname');
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
		$phone = $this->input->post('phone_num');
		$father_nm = $this->input->post('father_name');
		$gender = $this->input->post('genders');
		$gotra = $this->input->post('gotra');
		$perma_vill_nm = $this->input->post('per_address');
		$perma_vill_country = $this->input->post('per_country');
		$perma_vill_distt = $this->input->post('per_city');
		$perma_vill_state = $this->input->post('per_state');
		$current_vill_nm = $this->input->post('curr_address');
		$current_vill_country = $this->input->post('curr_country');
		$current_vill_dist = $this->input->post('curr_city');
		$current_vill_state = $this->input->post('curr_state');
		$reference_link = $this->input->post('reference');
		$dob_day = $this->input->post('day');
		$dob_month = $this->input->post('month');
		$dob_year = $this->input->post('year');
		$dob = $dob_day.'/'.$dob_month.'/'.$dob_year;
		$permanent_state_id = (int)$perma_vill_state;
		$current_state_id = (int)$current_vill_state;
		$perma_vill_state = $this->Comman_function->Get_State_By_ID($permanent_state_id);
		$current_vill_state = $this->Comman_function->Get_State_By_ID($current_state_id);
		$user_level =0;
		$parrent_level =1;
		if((!empty($current_vill_nm)) && (!empty($current_vill_country)) && (!empty($current_vill_dist)) &&(!empty($current_vill_state)))
		{
			$currnet_vill = $current_vill_nm;
			$current_country = $current_vill_country;
			$current_distt = $current_vill_dist;
			$current_state = $current_vill_state;
		}
		else
		{
			$currnet_vill = $perma_vill_nm;
			$current_country = $perma_vill_country;
			$current_distt = $perma_vill_distt;
			$current_state = $perma_vill_state;  
		}
		$display_nm = $f_name.' '.$l_name;
        // Prep the query
       $this -> db -> select('username');
	   $this -> db -> from('users');
	   $this -> db -> where('username', $email);
	   //$this -> db -> limit(1);
	 
	   $query = $this -> db -> get();
	 //echo $query -> num_rows();
	   if($query -> num_rows() == 0)
	   {
		   
			$data=array(
			'username'=>$email,
			'password'=>md5($pass),
			'user_email'=>$email,
			'user_registered'=>date('Y-m-d H:i:s'),
			'user_status'=>0,
			'user_role'=>1,
			'display_name'=>$display_nm
			); 
			$this->db->insert('users',$data);
			$user_id = $this->db->insert_id();
			$this->db->query("insert into user_info (user_id,first_name,last_name,father_name,contact_no,gender,gotra,ref_link,dob,current_vill_name,current_country,current_dist,current_state,perma_vill_name,perma_country,perma_dist, perma_state,user_level,parrent_level,profession,education) values('$user_id','$f_name','$l_name','$father_nm','$phone','$gender','$gotra','$reference_link','$dob','$currnet_vill','India','$current_distt','$current_state','$perma_vill_nm','India','$perma_vill_distt','$perma_vill_state','$user_level','$parrent_level','','')");
			$code = sha1( $user_id . time() ); 
			
			$this->db->query("UPDATE users SET user_activation_key = '$code'  WHERE id = $user_id");
				
				$message = '<html><body style="background-color: rgb(123, 176, 240); margin: 0px auto; padding: 10px 0px 50px; text-align: center; width: 660px; border-width: 8px 25px; border-style: solid; border-color: rgb(249, 237, 190);"><div  style="text-align: center;"><img src="'.base_url().'assets/images/guru.png" height= "150px" width="150px"></div><div style=" color:#fff ">';
				$message .= '<p style="font-size:17px;color:rgb(255,255,255);text-align: left;padding-left: 20px;">We thank you for join your community on GautamBook.com<br>To active your account please confirm your email id . our team member will call you shortly to make complete verification and active your account.</p>';
				$message .= '<p style="font-size:17px;color:rgb(255,255,255);text-align: left;padding-left: 20px;">Name: '.$display_nm.'<br>Username: '.$email.'<br>Password:'.$pass.'</p>';
				$message .= '<p style="font-size:17px;color:rgb(255,255,255);text-align: left;padding-left: 20px;">Login Url:http://gautambook.com/login</p>
							<p style="font-size:17px;color:rgb(255,255,255);text-align: left;padding-left: 20px;">Please click on the  link to verify you email id OR Copy the following link and past in your browser. <br>http://gautambook.com/activeaccount?user_id='.$user_id.'&key='.$code.'</p>';
				$message .= '<p style="font-size:17px;color:rgb(255,255,255);text-align: left;padding-left: 20px;">Thanks & Regards<br>Gautam Community</p>';		
				$message .= '<div style="color:#fff;font-size: 17px;font-weight:600;text-align:left;padding-left: 20px;"><a href="http://www.gautambook.com">GautamBook.com</a></div>'; 
				$message .= '<p style="font-size:17px;color:rgb(255,255,255);text-align: left;padding-left: 20px;">NOTE: Please Dont reply on this email, this is just created by the system.</p></div></body></html>';				
				$subject = 'Acount confirmation';
				$email_id = $email;
				
				$this->Comman_function->sendMail($email_id,$message,$subject,$bcc);
				
				$message1 = '<html><body style="background-color: rgb(123, 176, 240); margin: 0px auto; padding: 10px 0px 50px; text-align: center; width: 660px; border-width: 8px 25px; border-style: solid; border-color: rgb(249, 237, 190);"><div  style="text-align: center;"><img src="'.base_url().'assets/images/guru.png" height= "150px" width="150px"></div><div style=" color:#fff ">';
				
				$message1 .= '<p style="font-size:17px;color:rgb(255,255,255);text-align: left;padding-left: 20px;">Dear Admin,<br>
							New user registration on your community website.<br>
							User basic details as below.<br>
							Name: '.$display_nm.'<br>
							Email: '.$email.'<br>
							Contact No.: '.$phone.'</p>';
				$message1 .= '<p style="font-size:17px;color:rgb(255,255,255);text-align: left;padding-left: 20px;">Thanks & Regards<br>Gautam Community </p>';	
				$message1 .= '<div style="color:#fff;font-size: 17px;font-weight:600;text-align:left;padding-left: 20px;"><a href="http://www.gautambook.com">GautamBook.com</a></div>'; 
				$message1 .= '<p style="font-size:17px;color:rgb(255,255,255);text-align: left;padding-left: 20px;">NOTE: Please Dont reply on this email, this is just created by the system.</p></div></body></html>';	 					
				$subject1 = 'New Registration';
				
				$admin_email = 'gautam.arv@gmail.com';
							
				$this->Comman_function->sendMail($admin_email,$message1,$subject1,$bcc);
		
				return true; 
				
	   }
	   else
	   {
        // If the previous process did not validate
        // then return false.
		
        return false; 
		}
    }
}
?>