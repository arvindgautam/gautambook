<!-- Content Wrapper. Contains page content -->
<?php
if($this->session->userdata('logged_in'))
{
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
    </section>

			<div class="container">
			<div class="row">
			<div class="col-sm-11 text">
			<?php
			}
			else  
			{
			?>
			<div class="container1" style="min-height:470px;">
			<div class="row">
			<?php
			$this->load->view('sidebar');
			?>
			<div class="col-sm-9 text" id="text-tops">
			<?php
			 }
			?>
			<div class="form-bottom">
			<?php
			if($this->session->userdata('logged_in'))
			{
			?>
			<div class="ads_member">
			<a href="addmatrimony">
            <i class="fa fa-users"></i><span class="logo-mini"><b><img src="<?php echo base_url(); ?>assets/images/plus-sign.png" alt="Formget logo" style="height: 22px; margin-top: -7px;"></b></span> 
          </a>
		  </div>
		  <?php
			}
		  ?>
		  <h4>Matrimonials</h4>
		<?php
			$session_data = $this->session->userdata('logged_in');
			$id = $session_data['userid'];
			$all_post_ids='';
			if($session_data)
			{
			$query = $this->db->query("SELECT * FROM matrimonial WHERE user_id =$id LIMIT 6");
			}
			else
			{
				$query = $this->db->query("SELECT * FROM matrimonial LIMIT 6");
			}
			
		
			?>
			
		<div class="form-bottom" style="padding: 0px;">
		<table class="user_info" cellspacing="0" width="94%" border="1">
		
		
		<?php
		if ($query->num_rows() > 0)  
		{
		foreach ($query->result() as $row)
		{
			$metry_id = $row->id;
			
			$all_post_ids .=$metry_id.",";
			
	
			
		
		$mother_gotra = $row->mother_gotra;
		$get_dob = $row->d_o_b;
		$user_dob = explode('/',$get_dob);
		$img = $row->use_img;
		
		$mother_gotra_id = $row->mother_gotra;
		$father_gotra_id = $row->father_gotra;
	
		//print_r($user_dob);
			?>
			<div id="<?php echo $metry_id; ?>"  align="left" class="message_box" >
			<div class="col-sm-4 text metrimonialheight">
			<div class="user_posts">
			<div id="fb" class="box box-success gallerycontent">
			<div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
			 <?php
			if(!empty($img))
			{
			?>
			<img class="album-images " src="<?php echo base_url(); ?>assets/matrimonial-image/matrimonial-thumbs/<?php echo $img; ?>-150x150_thumb.jpg">
			<?php
			}
			else
			{
			?>
			<img class="album-images " alt="User Image"  src="<?php echo base_url()?>assets/images/user.png">
			<?php
			}
			?>
                <span class="usernames"><a href="Metrimonialdetails?userid=<?php echo base64_encode($metry_id); ?>"><?php echo $row->user_name;?></a></span>
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
			<?php
			if(!empty($img))
			{
			?>
			<img class="album-images " src="<?php echo base_url(); ?>assets/matrimonial-image/matrimonial-thumbs/<?php echo $img; ?>-300x300_thumb.jpg">
			<?php
			}
			else
			{
			?>
			<img class="album-images " alt="User Image"  src="<?php echo base_url()?>assets/images/user.png">
			<?php
			}
			?>
			<hr>
			<div class="clear"></div>
			<div class="metrimoni-show">
			<p class="post_contented metrimonial-details">DOB :</p><p class="post_contented metrimonial-detailss"><?php echo $row->d_o_b;?></p>
			<p class="post_contented metrimonial-details">Phone :</p><p class="post_contented metrimonial-detailss"><?php echo $row->contact_no;?></p>
			<?php
			$query = $this->db->query("SELECT * FROM user_gotra where id='$mother_gotra_id'");
				foreach ($query->result() as $rows)
				{
				?>	
			<p class="post_contented metrimonial-details">Gotra(M) :</p><p class="post_contented metrimonial-detailss"><?php echo $rows->gotra_name;?></p>
			<?php
				}
			
				$query = $this->db->query("SELECT * FROM user_gotra where id='$father_gotra_id'");
				foreach ($query->result() as $rows)
				{
				?>	
				
			<p class="post_contented metrimonial-details">Gotra(F) :</p><p class="post_contented metrimonial-detailss"><?php echo $rows->gotra_name; ?></p>
			<?php
				}
				?>
			</div>
			  <div class="clear"></div>
			  
			 
			  <?php
			if($this->session->userdata('logged_in'))
			{
			?>
			  <span id="<?php echo $row->id;?>" onclick="delete_matrimonial(this.id)"><img src="<?php echo base_url(); ?>assets/images/deleteimage.png" /></span>
			  
			  
				<a href="editmetrimonial?userid=<?php echo base64_encode($metry_id); ?>"><div class="pull-right text-muted"> <img  src="<?php echo base_url(); ?>assets/images/Edit-icon.png" /></div></a>
				<?php
			}
				?>	
			</div> 
						
            </div>
			
            <!-- /.box-body --> 
            
           
		  
            <!-- /.box-footer -->
          </div>
		</div>
		</div>
	

					<div style='display:none'>
						<div id="inline_content<?php echo $row->id;?>" style="padding:10px; background:#fff;">
						<form action="" method="post" enctype='multipart/form-data'>
						
			
			<div id="messg">
			</div>
			<div class="col-sm-12 text"> 
			<h4>Personal Information</h4>
			</div>
			<div class="col-sm-6 text">
			<div class="form-group">
			<label for="form-first-name" class="sr-only">Name</label>
			<input type="text" id="name" class="form-control" name="name" value ="<?php echo $row->user_name ; ?>" placeholder="Name" required/>
			<input type="hidden" name="run_codess" value="<?php echo $row->id; ?>"> 
			</div>
			</div>
			<div class="col-sm-6 text">
			<div class="form-group">
			<label for="form-last-name" class="sr-only">Father name</label>
			<input type="text" id="father-name" class="form-control" name="father_name" value = "<?php echo $row->father_name; ?>" placeholder="Father's name" required/>
			</div>
			</div>
			<div class="clear"></div>
			
			<div class="col-sm-6 text">
			<div class="form-group">
			<label for="form-last-name" class="sr-only">Gender</label>
			<select name="gender" required/>
			
			<option value="">Select Gender</option>
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
			<option value="male" <?php echo $select;?> >Male</option>
			<option value="female" <?php echo $selected;?> >Female</option>
			</select>
			</div>
			</div>
			<div class="col-sm-6 text">
			<div class="form-group">
			<label for="form-last-name" class="sr-only">Phone No.</label>
			<input type="number" id="phone_no" class="form-control" name="phone_no" value ="<?php echo $row->contact_no; ?>" placeholder="Contact No." required/>
			</div>
			</div>
			<div class="clear"></div>
			<div class="col-sm-12 text">
			<div class="form-group">
			<label for="form-first-name" class="sr-only">Current_Address</label>
			<input type="text" id="current_address" class="form-control" name="current_address" value ="<?php echo $row->current_address; ?>" placeholder="Current Address" required/>
			<input type="hidden" name="run_code" value="<?php echo $row->current_address; ?>">
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
				if($user_dob[2]==$i)
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
					if($user_dob[1]== $months) 
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
				if($user_dob[0]==$cu_y)
				{
					$select = 'selected';
				}
			?>
			<option value="<?php echo $cu_y; ?>" <?php echo $select;?>><?php echo $cu_y; ?></option>
			<?php
			$cu_y--;
			}
			?>

			</select>
			</div>
			</div>
			<div class="clear"></div>
			<div class="col-sm-6 text">
			<div class="form-group">
			<label for="form-last-name" class="sr-only">Gotra</label>
			<select name="mother_gotra" required/>
			<option value="">Select Mother's Gotra ()</option> 
			<?php
				$mother_gotra = $row->mother_gotra;
				$query = $this->db->query('SELECT * FROM user_gotra');
				foreach ($query->result() as $rows)
				{
					$select = '';
					if($rows->id==$mother_gotra)
					{
						$select = 'selected';
					}
					
								
				  echo '<option value="'.$rows->id.'" '.$select.'>'.$rows->gotra_name.'</option>';
				}
				
			?>
			
			<option value=""></option>
			</select>
			
			</div>
			</div>
			<div class="col-sm-6 text">
			<div class="form-group">
			<label for="form-last-name" class="sr-only">Gotra</label>
			<select name="father_gotra" required/>
			<option value="">Select Father's Gotra ()</option>
			<?php
				
				$query = $this->db->query('SELECT * FROM user_gotra');
				foreach ($query->result() as $rows)
				{
					$select = '';
					if($rows->id==$row->father_gotra)
					{
						$select = 'selected';
					}
					
								
				  echo '<option value="'.$rows->id.'" '.$select.'>'.$rows->gotra_name.'</option>';
				}
				
			?>
			</select>
			</div>
			</div>
			<div class="clear"></div>
			
			<div class="col-sm-6 text">
			<div class="form-group">
			<label for="form-last-name" class="sr-only">Profession</label>
			<select name="Profession" required/>
			<?php 
					$Profession = $row->profession;
					$select = '';
					$selt = '';
					$seltet = '';
					if($Profession=='Self Employed')
					{
					  $select = 'selected';
					}
					elseif($Profession == 'Govt.Service')
					{
					$selt = 'selected'; 
					}
					elseif($Profession == 'Private Sector')
					{
					$seltet = 'selected'; 
					}
					
			
			?>
			<option value="">Select Profession</option>
			<option value="Self Employed" <?php echo $select;?>>Self Employed</option>
			<option value="Govt.Service" <?php echo $selt;?> >Govt.Service</option>
			<option value="Private Sector" <?php echo $seltet;?> >Private Sector</option>
			</select>
			</div>
			</div>
			<div class="col-sm-6 text">
			<div class="form-group">
			<label for="form-first-name" class="sr-only">Qualification</label>
			<input type="text" id="name" class="form-control" name="qualification" placeholder="qualification" value ="<?php echo $row->qualification; ?>" required/>
			<input type="hidden" name="run_code" value="45">
			</div>
			</div>
			<div class="col-sm-6 text">
			<div class="form-group form_group-top">
			<label for="form-first-name" class="sr-only">Mars</label>
			Are you mars (मांगलिक) :
			<?php 
					$mars = $row->mars;
					$select = '';
					$selected = '';
					
					if($mars=='Yes')
					{
					  $select = 'checked';
					}
					elseif($mars == 'No')
					{
					$selected = 'checked'; 
					}
			?>
			 <label class="radio-inline">
				  <input type="radio" name="radio" value ="Yes"<?php echo $select; ?>>Yes
				</label>
				<label class="radio-inline">
				  <input type="radio" name="radio" value ="No"<?php echo $selected; ?>>No    
				</label>
			</div>
			</div>
			<div class="col-sm-12 text">
		<div class="form-group1"> 
		<input type="file" name="userfile[]">
		</div>
		</div>
			<div class="col-sm-6 text">
			</div>
			<div class="clear"></div>
			<br>
			<div class="text-center">
			<button class="btn btn-primary" type="submit" id="signup_sub" name="submitted">Submit</button>
			</div>
			</form>
			</div>
			</div>
				</div>
		<?php
		}
	}
		
	?>
	<div class="clear"></div> 
	<div class="all_post_ids all_posts_remove"  id="<?php echo $all_post_ids;?>"></div>
	<div id="last_msg_loader"></div>

	</div>
	
		
		
		
	
</div>
</div>
</div>	
</div>
</div>

<script>
// Ajax scroll 
jQuery(document).ready(function(){
		
	function last_msg_funtion()  
	{ 
	   
	   var ID=$(".all_post_ids:last").attr("id");
	   $(".all_posts_remove").removeClass("all_post_ids");
		var post_data = ID;
		jQuery('#last_msg_loader').html('<img src="<?php echo base_url(); ?>assets/images/ripple2.gif">');
		$.ajax({
		  url: "<?php echo base_url(); ?>matrimoniallist/more_matrimonial",
		  async: false,
		  type: "POST",
		  data: "posted_ids="+post_data,
		  dataType: "html",
		  success: function(data) {
		 jQuery(".message_box:last").append(data);
		 $('#last_msg_loader').empty();
		 
      }
    });
	};  
	
	jQuery(window).scroll(function(){
		if  ( window.screen.availHeight >jQuery(document).height() - jQuery(window).scrollTop()){
		
		   last_msg_funtion();
		}
	}); 
	
});




</script>