<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resetpassword_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	public function reset_pass()
	{
			$user_email_bcc = '';
			$name = $this->input->post('username');
			$this -> db -> select('*');
			$this -> db -> from('users');
			$this -> db -> where('username', $name);
			$query = $this -> db -> get();
			if ($query -> num_rows() == 1)
			{
				$qry = $query->row();
				$user_id = base64_encode($qry->id);
				$ids = $qry->id;
				$email_id = $qry->user_email;
				if(!empty($email_id))
				{
					$code = sha1( $user_id . time() );
					$name = $qry->display_name;
					$link = 'http://gautambook.com/change_password?user_id='.$user_id.'&key='.$code.'';
					
					$message = '<html><body style="background-color: rgb(123, 176, 240); margin: 0px auto; padding: 10px 0px 50px; text-align: center; width: 660px; border-width: 8px 25px; border-style: solid; border-color: rgb(249, 237, 190);""><div><img src="'.base_url().'assets/images/guru.png" height= "150px" width="150px"></div><div  style="color: rgb(255, 255, 255); text-align: left; padding-left: 20px;">';
					$message .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">Dear '.$name.'</p>';
					$message .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">Please click on following link to reset your password.</p>';
					$message .= '<p style="font-size: 17px; color: rgb(255, 255, 255);"><a href="'.$link.'" target="_blank" style="background: rgb(249, 237, 190) none repeat scroll 0% 0%; padding: 8px 12px; border-radius: 5px; text-decoration: none;">Reset</a></p>';
					$message .= '</div><div style=" color: #fff;font-size: 17px;font-weight:600;padding-left:20px;
					text-align:left;"><a href="http://www.gautambook.com" target="_blank" style="color:white; position: relative;top:20px; text-decoration: none; ">GautamBook.com</a></div>';
					$message .= '<p style="font-size:17px;color:rgb(255,255,255); text-align:left; padding-left:20px;">NOTE: Please Dont reply on this email, this is just created by the system.</p></body></html>';
					$subject='Reset Password';
				
					$this->load->model('comman_function');
					$this->comman_function->sendMail($email_id,$message,$subject,$user_email_bcc);
					$this -> db -> select('*');
					$this -> db -> from('resetpassword');
					$this -> db -> where('user_id', $ids);
					$query = $this -> db -> get();
					if ($query -> num_rows() == 1)
					{
						$this->db->query("update resetpassword set pass_reset_link='$code' where user_id=$ids");
					}
					else
					{
						$this->db->query("insert into resetpassword (user_id,pass_reset_link) values('$ids','$code')");
					}
					$msg = '<div class="success"><p>Your reset password request generated please check your email</p></div>';
					return $msg;
				}
				else
				{
					$msg = '<div class="success"><p>Please fill email id first.</p></div>';
					return $msg;
				}
				
				
			}
			else
			{
				$msg = '<div class="error"><p>You are not authorised person.</p></div>';
				return $msg;
			}
		
	}
}
	?>