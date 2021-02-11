<!-- Content Wrapper. Contains page content -->
<?php
$user_id = base64_decode($_GET['userid']);
if($this->session->userdata('logged_in'))
{
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
	<div class="container">
	<div class="row">


			
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
			<div class="col-sm-9 text" id="text-topsss">
			<?php
		 }
		 $session_data = $this->session->userdata('logged_in');
		$id = $session_data['userid'];
		$all_post_ids='';
		$this->db->select('*');
		$this->db->from('matrimonial');
	
		$this->db->where('id',$user_id);
		
		$row = $query = $this -> db -> get();
		$row = $query->row();
		
		/////mother_gotra///////
		$mother_gotra_id = $row->mother_gotra;

		
		
		$get_dob = $row->d_o_b;
		$user_dob = explode('/',$get_dob);
		$img = $row->use_img;
		
		
	if(!empty($user_photo))
	{
		$profile_photo = base_url().'assets/matrimonial-image/matrimonial-thumbs/'.$img;
	}
	else
	{
		$profile_photo = base_url().'assets/images/user'; 
	}
	
	if(!empty($user_cover_photo))
	{
		$profile_cover_img = ''.base_url().'assets/matrimonial-image/matrimonial-thumbs/'.$img.'-150x150_thumb.jpg';
	}
	else
	{
		$profile_cover_img = base_url().'assets/images/Chrysanthemum.jpg'; 
	}
	
		
		$this->db->select('*');
		$this->db->from('user_gotra');
		$this->db->where('id',$mother_gotra_id);
		$query = $this->db->get();
		$query -> num_rows();
		$qrys = $query->row();
		$gotra_m = $qrys->gotra_name;
		
		
		$father_gotra_id = $row->father_gotra;
		$this->db->select('*');
		$this->db->from('user_gotra');
		$this->db->where('id',$father_gotra_id);
		$query = $this->db->get();
		$query -> num_rows();
		$qryss = $query->row();
		$gotra_f = $qryss->gotra_name;
		
		
		
		
			 
			?>

   <div id="Profile-l" class="col-md-10 text Profile-2">
   <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-headers bg-black" style="background: url('<?php echo $profile_cover_img; ?>') center center;">			
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
                <span class="username userprofile"><a href="#"><?php echo $row->user_name;;?></a></span>
              
              </div> 
			
						
							
							
					
				
            </div> 
			</div>          
            
   <div class="containe-r">
  
  <ul class="nav nav-tabs">
   
  
  </ul>

  
     
     	
	
				
    
	<div class="col-md-12 profiled">
        
<h4 class="abo"><?php echo $row->user_name;?> Details</h4>
	<div class="col-sm-4 profiled ">
	<h4>Profile Create For:</h4>
	</div>  
	<div class="col-sm-8 profiled">
	<p><?php echo $row->profile_create_for;?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled ">
	<h4>Name:</h4>
	</div>  
	<div class="col-sm-8 profiled">
	<p><?php echo $row->user_name;?></p>
	</div> 
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Father's name:</h4>
	</div>
	<div class="col-sm-8 profiled">
	<p><?php echo $row->father_name; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Gender:</h4>
	</div>
	<div class="col-sm-8 profiled">
	<p><?php echo $row->gender; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Mother's Gotra:</h4>
	</div>
	<div class="col-sm-8 profiled">
	<p><?php echo $gotra_m;?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Father's Gotra:</h4>
	</div>
	<div class="col-sm-8 profiled">
	<p><?php echo $gotra_f ; ?> </p>
	</div>
	
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>DOB:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $row->d_o_b; ?></p>
	</div>
	<div class="clear"></div>
	
	<div class="col-sm-4 profiled">
	<h4>Phone:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $row->contact_no; ?></p>
	</div>
	
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Email Id:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $row->email_id; ?></p>
	</div>
	
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Current Address:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $row->current_address; ?> </p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Mool Nivasi:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $row->permanent_address; ?> </p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>City:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<?php 
		$city_id = $row->city;
		if(!empty($city_id))
		{
		$this->db->select('*');
		$this->db->from('cities');
		$this->db->where('id',$row->city);
		$query = $this->db->get();
		$query -> num_rows();
		$qryscity = $query->row();
		$city = $qryscity->name;
		}
		else
		{
			$city = '';
		}
	
	?>
	<p><?php echo $city; ?> </p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>State:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<?php 
		$state_id =$row->state;
		if(!empty($state_id))
		{
		$this->db->select('*');
		$this->db->from('states');
		$this->db->where('state_id',$state_id);
		$query = $this->db->get();
		$query -> num_rows();
		$qrystate = $query->row();
		$state = $qrystate->name;
		}
		else
		{
			$state='';
		}
		
	?>
	<p><?php echo $state; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Profession:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $row->profession; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Qualification:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $row->qualification; ?></p>
	</div>
	<div class="clear"></div><div class="col-sm-4 profiled">
	<h4>Annual Income:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $row->annual_income; ?></p>
	</div>
	<div class="clear"></div>
	
	<div class="col-sm-4 profiled">
	<h4>Fathers Occupation:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $row->fathers_occupation; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Mothers Occupation:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $row->mothers_occupation; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Mars(मांगलिक) :</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $row->mars; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Height:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $row->feet; ?> <b>feet</b> <?php echo $row->inch; ?> <b>inch</b></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Diet :</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $row->diet; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Body Type :</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $row->Body_Type; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Complexion :</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $row->Complexion; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Blood Group :</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $row->blood_group; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Nakshatra :</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $row->nakshatra; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Rashi/ Moon sign :</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $row->rashi; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>About :</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $row->about_boy; ?></p>
	</div>
	<div class="clear"></div><div class="col-sm-4 profiled">
	<h4>About Family :</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $row->about_boy_family; ?></p> 
	</div>
	
	
		
	
	<div class="clear"></div>

	
	 </div>
          <!-- /.box -->
        </div>		
   
 
</div>             
           
         
   
  
   <div class="col-md-4">
   
   </div>
   </div>
   </div>
   </div>
   </div>
  
  
   
	
	



