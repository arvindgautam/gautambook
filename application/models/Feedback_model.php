<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	public function insert_data()
	{
		$this->load->model('Comman_function');	
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$about = $this->input->post('comment');
		$read = 0;
		$data=array(
		'name' => $name,
		'email' => $email,
		'suggestions' => $about,
		'read1' => $read
		);
        $this->db->insert('feedback',$data);  
		
		
		
		//mailing process
		
				$bcc = '';
				$message2 = '<html><body style="background-color: rgb(123, 176, 240); margin: 0px auto; padding: 10px 0px 50px; text-align: center; width: 660px; border-width: 8px 25px; border-style: solid; border-color: rgb(249, 237, 190);"><div  style="text-align: center;"><img src="'.base_url().'assets/images/guru.png" height= "150px" width="150px"></div><div style=" color:#fff ">';
				
				$message2 .= '<p style="font-size:17px;color:rgb(255,255,255);text-align: left;padding-left: 20px;">Dear Admin,<br>
							you have a mail from '.$name.' regarding feedback..<br>
							User basic details as below.<br>
							Name: '.$name.'<br>
							Email: '.$email.'<br>
							Feedback.: '.$about.'</p>';
				$message2 .= '<p style="font-size:17px;color:rgb(255,255,255);text-align: left;padding-left: 20px;">Thanks & Regards<br>Gautam Community </p>';	
				$message2 .= '<div style="color:#fff;font-size: 17px;font-weight:600;text-align:left;padding-left: 20px;"><a href="http://www.gautambook.com">GautamBook.com</a></div>'; 
				$message2 .= '<p style="font-size:17px;color:rgb(255,255,255);text-align: left;padding-left: 20px;">NOTE: Please Dont reply on this email, this is just created by the system.</p></div></body></html>';	 					
				$subject2 = 'Feedback';
				
				$admin_email = 'gautam.arv@gmail.com';     
							
				$this->Comman_function->sendMail($admin_email,$message2,$subject2,$bcc);
				$message="<div class='success'><p>Message Send</p></div>";
		        return $message;
	}
}
	?>