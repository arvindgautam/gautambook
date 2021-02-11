<?php

class Cwr extends CI_Controller {


	public function index()
	{
		$email="gautam.arv@gmail.com";
		$bcc= array('webrockstar2014@gmail.com');

$subject="Test Email";
$message="भोपाल। पीएम मोदी के चाय बेचने से पीएम बनने तक के संघर्षों की कहानी सब को पता है। पीएम मोदी के अलावा भाजपा में कई ऐसे नेता हैं जिनका बचपन संघर्षों के दौर से गुजरा है। आज हम भाजपा के एक ऐसे सांसद के बारे में आपको बताते हैं जिन्होंने बचपन से लेकर अपनी कॉलेज की पढ़ाई बड़े संघर्ष के साथ की।";
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
				$from='registration@gautambook.com';
				//$this->email->set_newline("\r\n");
				$this->email->from($from, 'GautamBook.com'); 
				//$this->email->to($email);
				
				
 				$this->email->bcc($bcc);
				
				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->send();
				$this->load->view('cwr');
	
	}
	
	
	
}
?>