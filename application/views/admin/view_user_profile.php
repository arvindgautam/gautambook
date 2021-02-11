<?php
$user_id=base64_decode($_GET['user_id']);
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
      
    </section>

<div class="container">
<div class="row">
<div class="col-sm-8 profiled">
<h3 class="profileinfo">Basic User Info</h3>

<?php
		$this->db->select('*');
		$this->db->from('users as us');
		$this->db->join('user_info as uf', 'us.id = uf.user_id');
		$this -> db -> where('us.id', $user_id);
		$query = $this->db->get();
	 
		$query -> num_rows();
	   
		$qry = $query->row();
		$get_reg_date = strtotime($qry->user_registered);
		$reg_date = date(" jS F Y", $get_reg_date);
		date("jS F Y");
		
		if($qry->user_status==0)
		{
			$msg ='<button  class="btn" id="'.$user_id.'" onclick="approved_user(this.id)" >Approve</button>';
		}
		else
		{
			$msg = '<button  class="btn">Approved</button>';
		}
		
		$user_photo = $qry->user_img;
		if(!empty($user_photo))
		{
		$users_photo = base_url().'assets/ajax/upload/'.$user_photo;
		}
		else
		{
		$users_photo = base_url().'assets/images/user.png'; 
		}
	
	?>
	<div class="col-sm-6 profile_named">
	<h4>Profile picture</h4>
	</div>
	<div class="col-sm-6 profile_named">
	<img id="user_photo" src="<?php echo $users_photo; ?>" style="width: 90px; height: 90px;"/>
	</div>
	<div class="clear"></div>
	<div class="col-sm-6 profile_named">
	<h4>Name:</h4>
	</div>
	<div class="col-sm-6 profile_named">
	<h4><?php echo $qry->display_name; ?></h4>
	</div>
	<div class="clear"></div>
	<div class="col-sm-6 profile_named">
	<h4>Father Name:</h4>
	</div>
	<div class="col-sm-6 profile_named">
	<h4><?php echo $qry->father_name; ?></h4>
	</div>
	<div class="clear"></div>
	<div class="col-sm-6 profile_named">
	<h4>Gotra:</h4>
	</div>
	<div class="col-sm-6 profile_named">
	<h4><?php echo $qry->gotra; ?></h4>
	</div>
	<div class="clear"></div>
	<div class="col-sm-6 profiledd">
	<h4>Email:</h4>
	</div>
	<div class="col-sm-6 profiledd">
	<h4><?php echo $qry->user_email;?></h4>
	</div>
	<div class="clear"></div>
	<div class="col-sm-6 profiledd">
	<h4>DOB:</h4>
	</div>
	<div class="col-sm-6 profiledd"> 
	<h4><?php echo $qry->dob; ?></h4>
	</div>
	<div class="clear"></div>
	<div class="col-sm-6 profiledd">
	<h4>Phone:</h4>
	</div>
	<div class="col-sm-6 profiledd"> 
	<h4><?php echo $qry->contact_no; ?></h4>
	</div>
	<div class="clear"></div>
	<div class="col-sm-6 profiledd">
	<h4>Gender:</h4>
	</div>
	<div class="col-sm-6 profiledd"> 
	<h4><?php echo $qry->gender; ?></h4>
	</div>
	<div class="clear"></div>
	<div class="col-sm-6 profiledd">
	<h4>Permament Address:</h4>
	</div>
	<div class="col-sm-6 profiledd"> 
	<h4><?php echo $qry->perma_vill_name; ?><br><?php echo $qry->	perma_dist;?>&nbsp;,&nbsp;<?php echo $qry->perma_state;?><br><?php echo $qry->perma_country;?></h4>
	</div>
	<div class="clear"></div>
	<div class="col-sm-6 profiledd">
	<h4>Current Address:</h4>
	</div>
	<div class="col-sm-6 profiledd"> 
	<h4><?php echo $qry->current_vill_name; ?><br><?php echo $qry->current_dist;?>&nbsp;,&nbsp;<?php echo $qry->current_state;?><br><?php echo $qry->current_country;?></h4>
	</div>
	<div class="clear"></div>
	<div class="col-sm-6 profiledd">
	<h4>Profession:</h4>
	</div>
	<div class="col-sm-6 profiledd"> 
	<h4><?php echo $qry->profession; ?></h4>
	</div>
	<div class="clear"></div>
	<div class="col-sm-6 profiledd">
	<h4>Education:</h4>
	</div>
	<div class="col-sm-6 profiledd"> 
	<h4><?php echo $qry->education; ?></h4>
	</div>
	<div class="clear"></div>
	<div class="col-sm-6 profiledd">
	<h4>Material status:</h4>
	</div>
	<div class="col-sm-6 profiledd"> 
	<h4><?php echo $qry->material_status; ?></h4>
	</div>
	<div class="clear"></div>
	<div class="col-sm-6 profiledd">
	<h4>Ref. Link:</h4>
	</div>
		
	<div class="col-sm-6 profiledd"> 
	<h4><?php echo $qry->ref_link; ?></h4>
	</div>
	<div class="clear"></div>
	<div class="col-sm-6 profiledd">
	<h4>Facebook link:</h4>
	</div>
	<div class="col-sm-6 profiledd"> 
	<h4><?php echo $qry->facebook_link; ?></h4>
	</div>
	<div class="clear"></div>
	<div class="col-sm-6 profiledd">
	<h4>Twitter link</h4>
	</div>
	<div class="col-sm-6 profiledd"> 
	<h4><?php echo $qry->twitter_link; ?></h4>
	</div>
	<div class="clear"></div>
	<div class="col-sm-6 profiledd">
	<h4>Join Date:<h4>
	</div>
	<div class="col-sm-6 profiledd"> 
	<h4><?php echo $reg_date; ?></h4>
	</div>
	<div class="clear"></div>
	<div class="col-sm-6 profiledd">
	<h4>About us<h4>
	</div> 
	<div class="col-sm-6 profiledd"> 
	<h4><?php echo $qry->about_us; ?></h4>
	</div>
	<div class="clear"></div>
	<div class="profile-buttun">
	<?php echo $msg;?>
	</div>
	
		</div> 
	    </div>
	</div>
</div>