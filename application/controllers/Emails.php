<?php
class Emails extends CI_Controller {

     public function index()
	 {

				$subject = 'Acount confirmation';
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'localhost';
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['charset'] = 'iso-8859-1';
				$config['mailtype']='html';
				$config['wordwrap'] = TRUE;
				$config['crlf'] = "\r\n";
				$config['newline'] = "\r\n";
				
				$this->load->library('email', $config);
				$from='registration@gautambook.com';
				//$this->email->set_newline("\r\n");
				$this->email->from($from, 'GautamBook.com'); 
				$this->email->to('mahic524@gmail.com');
				$this->email->subject('Acount confirmation');
				$this->email->message('mail testing');
				if($this->email->send())
 
				 {
				  echo 'Email sent.';
				 }
				 else
				{
				 show_error($this->email->print_debugger());
				}				
	 }
	
}
?>