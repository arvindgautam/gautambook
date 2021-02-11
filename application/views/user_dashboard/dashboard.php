<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="container">

	<div id="body">
		
		
		<?php
			$pdata = $this->session->userdata('logged_in'); //Retrive ur session

			//echo 'Welcome '.$pdata['userid'];
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['name'];
			//$this->load->view('header', $data);
			$id = $session_data['userid'];
			$this->load->view('header', $data);
			 $this->load->model('comman_function');
        // Fetch the result from the database
			$data['result'] = $this->comman_function->user_profile_info($id);
			$this->load->view('user_dashboard/left_sidebar',$data);
			$this->load->view('user_dashboard/content');
			
		?>
		
		
	</div>

</div>
