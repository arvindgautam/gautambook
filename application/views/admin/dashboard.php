 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Recent User</h1>
      
    </section>

    
    <div class="contents">
	<div class="row">
	<div class="col-md-12">
      <?php
			$this -> db -> select('*');
			$this->db->order_by("user_registered","desc");
			$this -> db -> from('users');
			$query = $this -> db -> get();
			if ($query->num_rows() > 0)
	{
	?>
		<div class="form-bottom" style="padding: 0px;">
		<table class="user_info" cellspacing="0" width="94%" border="1">
		<thead>
		<tr >
		<th>S/N</th>
		<th>Name</th>
		<th>Username</th>
		<th>Join date</th>
		<th>@ Status</th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		</thead>
		</tr>
		<?php
			//$qry = $query->row();
			$i=1;
			foreach ($query->result() as $row)
			{
			   $user_key = $row->user_activation_key;
			   if((!empty($user_key) and($row->user_status == 1)) or (empty($user_key) and($row->user_status != 1)) or (!empty($user_key) and($row->user_status != 1))) 
				{
						 if($row->user_status !=1)
						{
						
						$msg = '<img src="'.base_url().'assets/images/deactive user.png" />';
						}
						else
						{
						$msg = '<img src="'.base_url().'assets/images/active user.png" />';
						}
						
					
						if(!empty($row->user_activation_key))
						{
						$email_verify = '<img src="'.base_url().'assets/images/nonverify_email.gif" style="width: 28px;"/>';
						}
						else
						{
						$email_verify = '<img src="'.base_url().'assets/images/email_verify.gif" style="width: 28px;"/>';
						}
						$get_reg_date = strtotime($row->user_registered);
						$reg_date = date(" jS F Y", $get_reg_date);
						date("jS F Y");
					
						if(!empty($row->user_activation_key) && $row->user_status==0)
						{
						$check_user = '<option selected value="newuser">New User</option><option value="2,'.$row->id.'">Under Review</option><option value="1,'.$row->id.'">Active</option><option value="0,'.$row->id.'">Deactive</option><option value="3,'.$row->id.'">Email verify</option><option value="4,'.$row->id.'">Send details</option>';
					
						}
						else if(empty($row->user_activation_key) && $row->user_status==1)
						{
							$check_user = '<option selected value="1,'.$row->id.'">Activate</option><option value="2,'.$row->id.'">Under Review</option><option value="0,'.$row->id.'">Deactive</option>';
						}
						else if($row->user_status==2)
						{
						$check_user = '<option selected value="2,'.$row->id.'">Under Review</option>
						<option value="1,'.$row->id.'">Activate</option><option value="0,'.$row->id.'">Deactive</option>';
						}
						else if(empty($row->user_activation_key) && $row->user_status==0)
						{
						$check_user = '<option value="1,'.$row->id.'">Activate</option><option value="2,'.$row->id.'">Under Review</option><option selected value="0,'.$row->id.'">Deactive</option>';
						}
						else if(!empty($row->user_activation_key) && $row->user_status==1)
						{
						$check_user = '<option value="1,'.$row->id.'">Activate</option><option value="2,'.$row->id.'">Under Review</option><option selected value="0,'.$row->id.'">Deactive</option>';
						}
					
					
				?>
					<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $row->display_name;?></td>
					<td><?php echo $row->username;?></td>
					
					<td><?php echo $reg_date;?></td>
					<td><?php echo $email_verify; ?></td>
					<td ><span><?php echo $msg ;?></span></td>
					<td><span id="<?php echo $row->id;?>" onclick="deletes_user(this.id)"><img src="<?php echo base_url(); ?>assets/images/deleteimage.png" /></span></td>
					<td><span id="<?php echo $row->id;?>" onclick="delete_user(this.id)"><a href="viewprofile?user_id=<?php echo base64_encode($row->id);?>"><img src="<?php echo base_url(); ?>assets/images/profile.png" /></a></span></td>
					<td><select name="users_status" onchange="active_user(this)"><?php echo $check_user; ?></select></td>
					 </tr>
						 
			<?php
			 $i++;
			  } 
			 
			}

		}
	?>
	</table>
</div>
		</div>
		
	
    </div>
   
  </div>
</div>