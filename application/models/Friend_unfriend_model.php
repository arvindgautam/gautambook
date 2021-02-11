<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: prem gujel
 * Description: add friend model class
 */
class Friend_unfriend_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	public function add_friend_request($id)
	{
		$bcc = '';
		$session_data = $this->session->userdata('logged_in');
		$current_user_id = $session_data['userid'];
		 $this->load->model('comman_function');
			 
			// Validate the user can login
			$data = $this->comman_function->user_profile_info($current_user_id);
			$display_name = $data->display_name;
			$userid = base64_encode($current_user_id);
			
			
			$requeist_data = $this->comman_function->user_profile_info($id);
			$users_email = $requeist_data->user_email;
		
		$this->db->query("insert into freind_request (friend_request_id,request_receive_id,read1) values('$current_user_id','$id','0')");
		
		$data = '<span class="req"><i class="fa fa-user"></i><i class="fa fa-minus"></i>Friend Request Sent</span>';
		
		
		
			
			$message3 = '<html><body style="background-color: rgb(123, 176, 240); margin: 0px auto; padding: 10px 0px 50px; text-align: center; width: 660px; border-width: 8px 25px; border-style: solid; border-color: rgb(249, 237, 190);""><div><img src="'.base_url().'assets/images/guru.png" height= "150px" width="150px"></div><div  style="color: rgb(255, 255, 255); text-align: left; padding-left: 20px;">';
			$message3 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">
			<a href="http://gautambook.com/userprofile?userid='.$userid.'">'.$display_name.' </a> send you friend request please review the profile and accept.</p>';
			$message3 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">Thanks & Regards<br>Gautam Community</p>';
			$message3 .= '<div style=" color: #fff;font-size: 17px;font-weight: 600;text-align: left;padding-left:0px;
			"><a href="http://community.isprasoft.com/" target="_blank" style="color:white; position: relative;top:20px; text-decoration: none; " ><a href="http://www.gautambook.com">GautamBook.com</a></div>';
			$message3 .= '<p style="font-size: 17px; margin-left: -80px; color: rgb(255, 255, 255);">NOTE: Please Dont reply on this email, this is just created by the system.</p></div></body></html>';
			$subject3='Friends request';
			$datas = $this->comman_function->user_profile_info($id);
			$email_id3 = $users_email;  
			$this->comman_function->sendMail($email_id3,$message3,$subject3,$bcc);
		
		return $data;
	}
	
		public function accept_friend_request($id)
	{
		$bcc = '';
		$session_data = $this->session->userdata('logged_in');
		$current_user_id = $session_data['userid'];
		 $this->load->model('comman_function');
			 
			// Validate the user can login
			$data = $this->comman_function->user_profile_info($current_user_id);
			$display_name = $data->display_name;
			$userid = base64_encode($current_user_id);
			
			$requeist_data = $this->comman_function->user_profile_info($id);
			$users_email = $requeist_data->user_email;
		
		$this->db->query("update freind_request set read1=1 where request_receive_id=$current_user_id and friend_request_id=$id");
		
		$data = '<span class="req" id="'.$id.'" onclick="send_friend_req_cancel(this.id)"><i class="fa fa-user"></i><i class="fa fa-minus"></i>Unfriend<span id="imgs_load" style="display:none;"><img src="'.base_url().'assets/images/LOOn0JtHNzb.gif"></span></span>';
		
		
		
			
			$message4 = '<html><body style="background-color: rgb(123, 176, 240); margin: 0px auto; padding: 10px 0px 50px; text-align: center; width: 660px; border-width: 8px 25px; border-style: solid; border-color: rgb(249, 237, 190);""><div><img src="'.base_url().'assets/images/guru.png" height= "150px" width="150px"></div><div  style="color: rgb(255, 255, 255); text-align: left; padding-left: 20px;">';
			$message4 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">
			<a href="http://gautambook.com/userprofile?userid='.$userid.'"> '.$display_name.'</a>  accept your friend requist </p>';
			$message4 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">Thanks & Regards<br>Gautam Community</p>';
			$message4 .= '<div style=" color: #fff;font-size: 17px;font-weight: 600;text-align: left;padding-left:0px;
			"><a href="http://community.isprasoft.com/" target="_blank" style="color:white; position: relative;top:20px; text-decoration: none; " ><a href="http://www.gautambook.com">GautamBook.com</a></div>';
			$message4 .= '<p style="font-size: 17px; margin-left: -80px; color: rgb(255, 255, 255);">NOTE: Please Dont reply on this email, this is just created by the system.</p></div></body></html>';
			$subject4='Accept friend request';
			  $email_id4 = $users_email;
			$this->comman_function->sendMail($email_id4,$message4,$subject4,$bcc);
			
		return $data;
	} 
	
	public function unfriend_request($id)
	{
		$bcc = '';
		$session_data = $this->session->userdata('logged_in');
		$current_user_id = $session_data['userid'];
		 $this->load->model('comman_function');
			 
			// Validate the user can login
			$data = $this->comman_function->user_profile_info($current_user_id);
			$display_name = $data->display_name;
			$userid = base64_encode($current_user_id);  
			
			$requeist_data = $this->comman_function->user_profile_info($id);
			$users_email = $requeist_data->user_email;
			  
		$this->db->query("delete from freind_request where (friend_request_id=$id and request_receive_id=$current_user_id) or (friend_request_id=$current_user_id and request_receive_id=$id)");
		
		$data = '<span class="req" id="'.$id.'" onclick="send_friend_req(this.id)"><i class="fa fa-user"></i><i class="fa fa-plus"></i>Add Friend<span id="imgs_load" style="display:none;"><img src="'.base_url().'assets/images/LOOn0JtHNzb.gif"></span></span> ';
		
		
			
			$message5 = '<html><body style="background-color: rgb(123, 176, 240); margin: 0px auto; padding: 10px 0px 50px; text-align: center; width: 660px; border-width: 8px 25px; border-style: solid; border-color: rgb(249, 237, 190);""><div><img src="'.base_url().'assets/images/guru.png" height= "150px" width="150px"></div><div  style="color: rgb(255, 255, 255); text-align: left; padding-left: 20px;">';
			$message5 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">
			<a href="http://gautambook.com/userprofile?userid='.$userid.'">'.$display_name.'</a> cacel your friend requeist.</p>';
			
			$message5 .= '<p style="font-size: 17px; color: rgb(255, 255, 255);">Thanks & Regards<br>Gautam Community</p>';
			$message5 .= '<div style=" color: #fff;font-size: 17px;font-weight: 600;text-align: left;padding-left:0px;
			"><a href="http://community.isprasoft.com/" target="_blank" style="color:white; position: relative;top:20px; text-decoration: none; " ><a href="http://www.gautambook.com">GautamBook.com</a></div>';
			$message5 .= '<p style="font-size: 17px; margin-left: -80px; color: rgb(255, 255, 255);">NOTE: Please Dont reply on this email, this is just created by the system.</p></div></body></html>';
			$subject5='cancel friend request ';
			$email_id5 = $users_email;  
			$this->comman_function->sendMail($email_id5,$message5,$subject5,$bcc);
		
		
		return $data;
	
	}
	
	
}