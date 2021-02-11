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
		  <h4>Achievement Information</h4>
		<?php
		 $session_data = $this->session->userdata('logged_in');
		 $id = $session_data['userid'];
		 $this->db->select('*');
		 $this->db->from('user_achievement');
		 $this->db->where('user_id', $id);
		 $query=$this->db->get();
		?>
			
		<div class="form-bottom" style="padding: 0px;">
		<table class="user_info" cellspacing="0" width="94%" border="1">
		
		
		<?php
		foreach ($query->result() as $row)
		{
		$ids = $row->user_id;
		$title = $row->achiv_title;
		$results = $this->comman_function->user_profile_info($ids);
		$user_img = $results->user_img;
		$get_dob = $row->achive_date;
		$user_dob = explode('/',$get_dob);
		$img = $row->achiv_img;
		if(!empty($user_img))
			{
				
				$images = '<img class="album-images " alt="User Image"  src="'.base_url().'assets/ajax/upload/'.$user_img.'">';
			}
			else
			{
				
				$images = '<img class="album-images " alt="User Image"  src="'.base_url().'assets/images/user.png">';
			}	
		
	
			?>
		
			<div class="col-sm-4 text metrimonialheight">
			<div class="user_posts">
			<div id="fb" class="box box-success gallerycontent">
			<div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
			 <?php echo $images ;?> <span class="title_text"><p><?php echo $title ;?></p></span>
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
			<img class="album-images " src="<?php echo base_url(); ?>assets/achievement-image/achievement-thumb/<?php echo $img; ?>-600x600_thumb.jpg">
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
			<p class="post_contented metrimonial-details">Title :</p><p class="post_contented metrimonial-detailss"><?php echo $row->achiv_title;?></p>
			<p class="post_contented metrimonial-details">Date :</p><p class="post_contented metrimonial-detailss"><?php echo $row->achive_date;?></p>
			</div>

			  <div class="clear"></div>    
			  
			 
			  <?php
			if($this->session->userdata('logged_in'))
			{
			?>
			  <span id="<?php echo $row->id;?>" onclick="delete_achievement(this.id)"><img src="<?php echo base_url(); ?>assets/images/deleteimage.png" /></span>
			  
			  
				<div class="pull-right text-muted"> <span class="inline" href="#inline_content<?php echo $row->id;?>" id="<?php echo $row->user_id;?>" onclick="edit_member_details(this.id)"><img  src="<?php echo base_url(); ?>assets/images/Edit-icon.png" /></span></div>
				<?php
			}
				?>				
            </div>
			
            <!-- /.box-body -->
            
           
		  
            <!-- /.box-footer -->
          </div>
		</div>
		</div>
	</div>

					<div style='display:none'>
						<div id="inline_content<?php echo $row->id;?>" style="padding:10px; background:#fff;">
						<form action="" method="post" enctype='multipart/form-data'>
						
			
			<div id="messg">
			</div>
			<div class="col-sm-12 text"> 
			<h4>Achievement Information</h4>
			</div>
			<div class="col-sm-12 text">
			<div class="form-group">
			<label for="form-first-name" class="sr-only">Title</label>
			<input type="text" id="title" class="form-control" name="title" value ="<?php echo $row->achiv_title ; ?>" placeholder="Name" required/>
			<input type="hidden" name="run_codess" value="<?php echo $row->id; ?>"> 
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
			<div class="col-sm-12 text">
 <legend>Image Upload</legend>
        

        <fieldset>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="filename" class="control-label">Select Image to Upload</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <input type="file" name="userfile[]" size="20" />
                    </div>
                </div>
            </div>

        
        </fieldset>
        
        
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
		<?php
		}
		
	?>
	<div class="clear"></div> 
	</div>
	
		
		
		
	
</div>
</div>
</div>	
</div>
</div>
</div>
</div>