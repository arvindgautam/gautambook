<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
    </section>

<div class="container">
<div class="row">
<div class="col-sm-11 text">
<div class="form-bottom">

<div class="ads_member">
<a href="Addfamilymember">
	<i class="fa fa-users"></i><span class="logo-mini"><b><img src="<?php echo base_url(); ?>assets/images/plus-sign.png" alt="Formget logo" style="height: 22px; margin-top: -7px;"></b></span> </a> 
	<a href="Getyourfamily"><h2>Get Your family Tree</h2></a>
	</div>
		 
<div class="box-footer box-comments">
<h4>Fimily Member</h4>
<?php
		$session_data = $this->session->userdata('logged_in');
		$id = $session_data['userid'];
		$query = $this->db->query("SELECT * FROM user_info where account_creater_id=$id");
	
		
		
		
		foreach ($query->result() as $row)
		{
			
			$ids = $row->user_id;
			$this->load->model('comman_function');
			$results = $this->comman_function->user_profile_info($ids);
			$email_id = $results->user_email;
			$relation_id = $row->relation;
			$user_img = $results->user_img;
			$family_user_id = $results->user_id;
			
			if(!empty($user_img))
			{
				
				$images = '<img class="album-images " alt="User Image"  src="'.base_url().'assets/ajax/upload/'.$user_img.'">';
			}
			else
			{
				
				$images = '<img class="album-images " alt="User Image"  src="'.base_url().'assets/images/user.png">';
			}	
		
			$result = $this->comman_function->get_relation($relation_id);
			
			$get_dob = $row->dob;
			$user_dob = explode('/',$get_dob);
			?>
		
			<!-- This contains the hidden content for inline calls -->
			
<!-- user gallery list -->
			
			<div class="col-sm-4 text" id="userd_family">
			<div class="user_posts">
			<div id="fb" class="box box-success">
			<div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
			  <?php echo $images ;?>
                <span class="usernames"><a href="userprofile?userid=<?php echo base64_encode($family_user_id);?>"><?php echo $results->display_name;?></a></span>
                
              </div>  
              <!-- /.user-block -->
              <div class="box-tools">
                <button data-widget="collapse" class="btn btn-box-tool plus" type="button"><i class="fa fa-minus"></i>
                </button>
                
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
			
            <div class="box-body" style="display: block;">
			<?php echo $images ;?>
			<hr>
			
			  <div class="clear"></div>
			  
			   <div class="metrimoni-show">
			<p class="post_contented metrimonial-details">Name:</p><p class="post_contented metrimonial-detailss"><?php echo $results->display_name;?></p>
			   <p class="post_contented metrimonial-details">Gender:</p><p class="post_contented metrimonial-detailss"><?php echo $row->gender;?></p>
			    <p class="post_contented metrimonial-details">Relation:</p><p class="post_contented metrimonial-detailss"><?php echo $result; ?></b></p>
			   <p class="post_contented metrimonial-details">Username:</p><p class="post_contented metrimonial-detailss"><?php echo $results->username;?></p></p>
			   <p class="post_contented metrimonial-details">father name:</p><p class="post_contented metrimonial-detailss"><?php echo $results->father_name;?></p></p>
			   </div>
			  
			  
			  <div class="clear"></div>
			  
			 
			  
			  <span id="<?php echo $row->user_id;?>" onclick="delete_family_mamber(this.id)"><img src="<?php echo base_url(); ?>assets/images/deleteimage.png" /></span>
			  
			
			<div class="pull-right text-muted"> <span class="inline" href="#inline_content<?php echo $row->user_id;?>" id="<?php echo $row->user_id;?>" onclick="edit_member_details(this.id)"><img  src="<?php echo base_url(); ?>assets/images/Edit-icon.png" /></span></div>
						
            </div>
			
            <!-- /.box-body -->
            
           
		  
            <!-- /.box-footer -->
          </div>
		</div>
		</div>
	</div>

		<div style='display:none'>
			<div id='inline_content<?php echo $row->user_id;?>' style='padding:10px; background:#fff;'>
			
			<form action="" method="post" onsubmit="return signup_submit()"enctype='multipart/form-data'>
			<div class="col-sm-12 text"> 
			<h4>Edit Family Member Details</h4>
			</div>
			<div class="col-sm-6 text">

			<div class="form-group">
			<label for="form-first-name" class="sr-only">First name</label>
			<input type="text" id="f-names" class="form-control" name="fname" placeholder="First name" value="<?php echo $row->first_name;?>" required/>
			<input type="hidden" name="run_code" value="<?php echo $row->user_id;?>">
			</div>
			</div>
			<div class="col-sm-6 text">
			<div class="form-group">
			<label for="form-last-name" class="sr-only">Last name</label>
			<input type="text" id="l-names" class="form-control" name="lname" placeholder="Last name" value="<?php echo $row->last_name;?>" required/>
			</div>
			</div>
			<div class="col-sm-6 text">
			<div class="form-group">
			<label for="form-last-name" class="sr-only">Phone No.</label>
			<input type="number" id="phones" class="form-control" name="phone_num" placeholder="Contact No."  value="<?php echo $row->contact_no;?>" required/>
			</div>
			</div>
			<div class="col-sm-6 text">
			<div class="form-group">
		
			<label for="form-last-name" class="sr-only">Email</label>
			<input type="text" id="emails" class="form-control" name="emails" placeholder="Email" value="<?php echo $email_id; ?>" required/>
			</div>
			</div>
			<div class="clear"></div>
			<div class="col-sm-4 text">
			<div class="form-group">
			<label for="form-last-name" class="sr-only">Relation </label>
			<select name="relation" required/>
			<option value="">Select Relation </option>
			<?php
			
				$relation_id = $row->relation;
				$result = $this->comman_function->get_relation($relation_id);
				
				$query = $this->db->query('SELECT * FROM relationship order by relation asc');
				foreach ($query->result() as $rows)
				{
					$select = '';
					if($rows->relation==$result)
					{
						$select = 'selected';
					}
				  echo '<option value="'.$rows->id.'" '.$select.'>'.$rows->relation.'</option>';
				}
				
			?>
			</select>


			</select>
			</div>
			</div>
			<div class="col-sm-4 text">
			<div class="form-group">
			<label for="form-last-name" class="sr-only">Genders </label>
			<select name="Genders" required/> 
			<option value="">Select Gender </option>
			<?php 
				$gender = $row->gender;
				$select = '';
				$selected = '';
				if($gender=='male')
				{
					$select = 'selected';
				}
				elseif($gender=='female')
				{
					$selected = 'selected';
				}
			
			?>
			<option value="male" <?php echo $select; ?> >Male</option>
			<option value="female" <?php echo $selected; ?> >Female</option>

			</select>
			</div>
			</div>
			<div class="col-sm-4 text">
			<div class="form-group">
			<label for="form-last-name" class="sr-only">Gotra</label>
			<select name="gotra" required/>
			<option value="">Select Gotra</option>
			<?php
				$gotra = $row->gotra;
				$query = $this->db->query('SELECT * FROM user_gotra');
				foreach ($query->result() as $row)
				{
					$select = '';
					if($row->id==$gotra)
					{
						$select = 'selected';
					}
					
								
				  echo '<option value="'.$row->id.'" '.$select.'>'.$row->gotra_name.'</option>';
				}
			?>
			</select>
			</div>
			</div>
			<div class="clear"></div>
			<div class="col-sm-12 text">
			<h4>Date of Birth</h4>
			</div>
			<div class="col-sm-4 text">
			<div class="form-group">
			<label for="form-last-name" class="sr-only">day</label>
			<select name="day" required>
			<option value="">Select Day</option>
			<?php
			
			$i=1; 
			for($i=1; $i<=31;$i++)
			{
				$select = '';
				if($user_dob[0]==$i)
				{
					$select = 'selected';
				}
			?>
			<option  <?php echo $select;?> value="<?php echo $i; ?>"><?php echo $i ?></option>
			<?php
			
			}
			?>

			</select>
			</div>
			</div>
			<div class="col-sm-4 text">
			<div class="form-group">
			<label for="form-last-name" class="sr-only">Month</label>
			<select name="month" required>
			<option value="">Select Month</option>
			<?php
				
				$month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
				foreach($month as $months)
				{
				$select = '';
				if($user_dob[1]==$months)
				{
					$select = 'selected';
				}
					
				?>
					<option value="<?php echo $months; ?>" <?php echo $select; ?>><?php echo $months; ?></option>
				<?php
				}

			?>
			</select>
			</div>
			</div>
			<div class="col-sm-4 text">
			<div class="form-group">
			<label for="form-last-name" class="sr-only">Year</label>
			<select name="year" required>
			<option value="">Select Year</option>
			<?php

			$cu_y =  date("Y");

			while($cu_y>=1800)
			{
				$select = '';
				if($user_dob[2]==$cu_y)
				{
					$select = 'selected';
				}
				
			?>
			<option value="<?php echo $cu_y; ?>" <?php echo $select;?> ><?php echo $cu_y; ?></option>
			<?php
			$cu_y--;
			}
			?>

			</select>
			</div>
			</div>
		<div class="col-sm-12 text">
		<div class="form-group1"> 
		<input type="file" name="userfile[]"  multiple="multiple">
		</div>
		</div>
			<div class="col-sm-6 text">

			</div>
			<div class="clear"></div>
			<br>
			<div class="text-center">
			<button class="btn" type="submit" id="signup_sub" name="submitted">Submit</button>
			</div>
			</form>
			</div>
		</div>	
		
		<?php
		
		}
		
	?>
	<div class="clear"></div> 
</div>
</div>
</div>
</div>		