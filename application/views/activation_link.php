<?php
$userid=$_GET['user_id'];
$key=$_GET['key'];

		$this -> db -> select('id,user_activation_key,display_name');
	    $this -> db -> from('users');
	    $this -> db -> where('id', $userid);
	   //$this -> db -> limit(1);
		$query = $this -> db -> get();
		 ?>
		 <div class="container">
		 <div class="row">
			<div class="col-sm-8 text">
			<?php
		 if($query -> num_rows() == 1)
		{ 
	
		   $qry = $query->row();
		   $user_name = $qry->display_name;
		   $user_key = $qry->user_activation_key;
		   
		   if($user_key==$key)
		   {
		 ?>
			
		   <div class=feature-image><img src="<?php echo base_url(); ?>assets/images/Chrysanthemum.jpg" /></div>
		   <div class="profile_img"><img src="<?php echo base_url(); ?>assets/images/user.png" /></div>
		   <div class="profile_name"><h3><?php echo $user_name;?> </h3></div>
		   <div class="profile_about"><p>Your Account Has been activated successfully and wiat for your account active by admin.</p></div>
		   
		   
		  
		   <?php
		   $this->db->query("UPDATE users SET user_activation_key=''  WHERE id = $userid");
		   }
		   else
		   {   
			?>
			
				<div class="active_error">
				<h3>Activation Key is Expired </h3>
				</div>
			
				
			<?php
		   }
		
	   }
	   else
	   {
		   ?>
		   
		   <div class="active_error">
			<h3><strong>ERROR: </strong> Invalid Key or user ID</h3>
			</div>
			<?php
	   }
	
?>
</div>
		<div class="col-sm-4 form-box" id="logins">
			<?php
			$data['error']='';
				$this->load->view('login',$data);
			?>
		</div>
	</div>
</div>
