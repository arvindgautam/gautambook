<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
    </section>
<?php
$session_data = $this->session->userdata('logged_in');
$id = $session_data['userid'];
$this->db->select('*');
$this->db->from('users as us');
$this->db->join('user_info as uf', 'us.id = uf.user_id');
$this -> db -> where('us.id', $id);
$query = $this->db->get();

if ($query->num_rows() > 0)
{

	$qry = $query->row();

	$f_name = $qry->first_name;
	$l_name = $qry->last_name;
	$phone = $qry->contact_no;
	$father_nm = $qry->father_name;
	$email = $qry->user_email;
	$dob = $qry->dob;
	//print_r($dob);
	$user_dob = explode('/',$dob);
	$gender = $qry->gender;
	$gotra = $qry->gotra;
	$perma_vill_name = $qry->perma_vill_name;
	$perma_country = $qry->perma_country;
	$perma_dist = $qry->perma_dist;
	$perma_state = $qry->perma_state;
	$current_vill_name = $qry->current_vill_name;
	$current_country = $qry->current_country;
	$current_dist = $qry->current_dist;
	$current_state = $qry->current_state;
	$ref_link = $qry->ref_link;
	$about_us = $qry->about_us;
	$education  = $qry->education;
	$profession = $qry->profession;
	$facebook_link = $qry->facebook_link;
	$twitter_link = $qry->twitter_link;
	$material_status = $qry->material_status;
	$user_photo = $qry->user_img;
	$profile_cover = $qry->cover_img;
	
}
?>

<div class="container"> 
<div class="row">
<div class="col-sm-8 text">
<?php if(! is_null($user_msg)) echo $user_msg;?>
<div class="form-bottom">
<div class="col-sm-6 text">
<h3>Upload Profile image</h3>
<div class="main">
<form id="uploadimage" action="" method="post" enctype="multipart/form-data">
<?php 
if(!empty($user_photo))
{
	$users_photo = base_url().'assets/ajax/upload/'.$user_photo;
}
else
{
	$users_photo = base_url().'assets/images/user.png'; 
}
?>
<img id="user_photo" src="<?php echo $users_photo; ?>" style="width: 90px; height: 90px;"/>
<div id="cover_image_preview" style="display:none;"><img id="cover_previewing" style="width: 90px; height: 90px;"/></div>
<div id="selectImage">
<label>Select Your Image</label><br/>
<input type="file" name="file" id="file" required />
<div class="button-center" style="padding-top: 20px;">
<button type="submit" class="btn" class="submit">Upload</button>
</div>
</div>
</form>
</div>
<div id='loading' style="display:none;"><img src="<?php echo base_url(); ?>assets/images/loader.gif" /></div>
</div>
<!-- user profile cover image -->
<div class="col-sm-6 text">
<h3>Upload Profile Cover image</h3>
<div class="main">
<form id="uploadcoverimage" action="" method="post" enctype="multipart/form-data">
<?php 
if(!empty($profile_cover))
{
	$users_photo = base_url().'assets/ajax/cover_image/'.$profile_cover;
}
else
{
	$users_photo = base_url().'assets/images/user.png'; 
}
?>
<img id="user_cover_image" src="<?php echo $users_photo; ?>" style="width: 90px; height: 90px;"/>
<div id="cover_image_preview" style="display:none;"><img id="cover_image_preview" style="width: 90px; height: 90px;"/></div>
<div id="selectImage">
<label>Select Your Image</label><br/>
<input type="file" name="file" id="file" required />
<div class="button-center" style="padding-top: 20px;">
<button type="submit" class="btn" class="submit">Upload</button>
</div>
</div>
</form>
</div>
<div id='loading' style="display:none;"><img src="<?php echo base_url(); ?>assets/images/loader.gif" /></div>
</div>
<form action="<?php echo base_url();?>profile" method="post" >
<div class="col-sm-12 text">
<div id="message"></div>
<div id="messages"></div>
<h3>Personal Info</h3>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-first-name" class="sr-only">First name</label>
<input type="text" class="form-control" name="fname" placeholder="First Name" value="<?php echo $f_name; ?>" required/>
<input type="hidden" name="run_code" value="45">
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Last name</label>
<input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?php echo $l_name; ?>" required/>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Father name</label>
<input type="text" class="form-control" name="father_name" placeholder="Father Name" value="<?php echo $father_nm; ?>" required/>
</div>
</div>
<div class="clear"></div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Phone No.</label>
<input type="text" class="form-control" name="phone_num" placeholder="Contact No." value="<?php echo $phone; ?>" required/>

</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-email" class="sr-only">Email</label>
<input type="email" class="form-control" name="email" placeholder="Your Email" value="<?php echo $email; ?>" required/>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<input type="checkbox" class="" name="phone_num_show" value="show" >
<label for="form-last-name" class="">Show phone no. on public profile </label> 

</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<input type="checkbox" class="" name="email_id_show"  value="show" >
<label for="form-last-name" class="">Show email id on public profile</label>

</div>
</div>
<div class="clear"></div>
<div class="col-sm-12 text">

</div>
<div class="col-sm-4 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Gender</label>
<select name="genders" required/>
<option value="">Select Gender</option>
<?php
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
<option value="male" <?php echo $select; ?>>Male</option>
<option value="female" <?php echo $selected; ?>>Female</option>
</select>
</div>
</div>
<div class="col-sm-4 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Material Status</label>
<select name="Material_Status" required/>
<option value="">Material Status</option>
<?php
$select = '';
$selected = '';
if($material_status=='Single')
{
	$select = 'selected';
}
elseif($material_status=='Married')
{
	$selected = 'selected';
}
?>
<option value="Single" <?php echo $select; ?>>Single</option>
<option value="Married" <?php echo $selected; ?>>Married</option>
</select>
</div>
</div>
<div class="col-sm-4 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Gotra</label>
<select name="gotra" required/>
<option value="">Select Gotra</option>
<?php
	$query = $this->db->query('SELECT * FROM user_gotra');
	
if ($query->num_rows() > 0)
{
    foreach ($query->result() as $rows)
  {
		$select = '';
		if($gotra==$rows->gotra_name)
		{
			$select = 'selected';
			 
		}
		?>
	  <option value="<?php echo $rows->id; ?>" <?php echo $select;?>><?php echo $rows->gotra_name ?></option>';
	  <?php
  }
 }
?>
</select>
</div>
</div>

<div class="clear"></div>
<div class="col-sm-6 text">
<h3>Permanent Address</h3>
<div class="form-group">
<label for="form-last-name" class="sr-only">Village name</label>
<input type="text" class="form-control" name="vill_nm" placeholder="City/Village Name" value="<?php echo $perma_vill_name; ?>" required/>
</div>
<div class="form-group">
<label for="form-last-name" class="sr-only">Country</label>
<select name="per_country" class="per_country" id="countryId" required/>
<option value="">Select Country</option>
<?php 
if(!empty($perma_country)) 
{
	$select = 'selected';
	
}
else
{
	$select = '';
}
?>
<option <?php echo $select; ?> value="91">India</option>
</select>
</div>
<!--<input type="text" class="form-control" name="vill_country" placeholder="Country" value="<?php echo $perma_country; ?>" required/>-->
<div class="form-group">
<label for="form-last-name" class="sr-only">State</label>
<select name="per_state" class="per_state" id="stateId" required/>
<option value="">Select State</option>
<?php
if(!empty($perma_state))
{
	$this -> db -> select('*');
	$this -> db -> from('states');
	$this -> db -> where('country_name',91);
	$query = $this->db->get();
	
	foreach ($query->result() as $row)
	{	$selects = '';
		if($perma_state==$row->name)
		{
			$state_ids = $row->state_id;
			$selects = 'selected';
		}
		echo  '<option '.$selects.' value="'.$row->state_id.'">'.$row->name.'</option>';

	}
	
}
?>
</select>
</div>
<div class="form-group">
<label for="form-last-name" class="sr-only">District </label>
<select name="per_city" class="per_city" id="cityId" required/>
<option value="">Select City</option>
<?php
if(!empty($perma_dist))
{
	$this -> db -> select('*');
	$this -> db -> from('cities');
	$this -> db -> where('state_nm',$state_ids);
	$query = $this->db->get();
	
	foreach ($query->result() as $rows)
	{	$selects = '';
		if($perma_dist==$rows->name)
		{
			$selects = 'selected';
		}
		echo  '<option '.$selects.' value="'.$rows->name.'">'.$rows->name.'</option>';

	}
}
?>
</select>
</div>
</div> 
<div class="col-sm-6 text">
<h3>Current Address</h3>
<div id="profile_same_add">
<div class="form-group">
<label for="form-last-name" class="sr-only">Village name</label>
<input type="text" id="current_vill" class="form-control" name="cur_vill_nm" placeholder="City/Village Name" value="<?php echo $current_vill_name; ?>" />
</div>
<div class="form-group">
<label for="form-last-name" class="sr-only">Country</label>
<select name="curr_country" class="curr_country" id="countryId" >
<option value="">Select Country</option>
<?php 
if(!empty($current_country))
{
	$select = 'selected';
	
}
else
{
	$select = '';
}
?>
<option <?php echo $select; ?> value="91">India</option>
</select>
</div>
<!--<input type="text" class="form-control" name="vill_country" placeholder="Country" value="<?php echo $perma_country; ?>" required/>-->
<div class="form-group">
<label for="form-last-name" class="sr-only">State</label>
<select name="curr_state" class="curr_state" id="stateId">
<option value="">Select State</option>
<?php
if(!empty($current_state))
{
	$this -> db -> select('*');
	$this -> db -> from('states');
	$this -> db -> where('country_name',91);
	$query = $this->db->get();
	
	foreach ($query->result() as $row)
	{
		
		$selects = '';
		if($current_state==$row->name)
		{
			$currnet_state_id = $row->state_id;
			$selects = 'selected';
		}
		echo  '<option '.$selects.' value="'.$row->state_id.'">'.$row->name.'</option>';

	}
}
?>
</select>
</div>
<div class="form-group">
<label for="form-last-name" class="sr-only">District </label>

<select name="curr_city" class="curr_city" id="cityId">
<option value="">Select City</option>
<?php
if(!empty($current_dist))
{
	$this -> db -> select('*');
	$this -> db -> from('cities');
	$this -> db -> where('state_nm',$currnet_state_id);
	$query = $this->db->get();
 
	
	foreach ($query->result() as $rows)
	{	$selects = '';
		if($current_dist==$rows->name)
		{
			$selects = 'selected';
		}
		echo  '<option '.$selects.' value="'.$rows->name.'">'.$rows->name.'</option>';

	}
}
?>
</select>
</div>
</div>
</div>
<div class="clear"></div>
<div class="col-sm-12 text">
<h3>Reference</h3>
<div class="reference">
<p>Please put a reference profile link (If you have any) to active you account with in couple of hours.</p>
<div class="form-group">
<label for="form-email" class="sr-only">Reference</label>
<input type="text" class="form-control" name="reference" placeholder="Reference Profile Link" value="<?php echo $ref_link; ?>" />
</div>
</div>
</div>
<div class="col-sm-12 text">
<h3>Date of Birth</h3>
</div>
<div class="col-sm-4 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">day</label>
<select name="day" required/>
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
<option value="<?php echo $i; ?>" <?php echo $select; ?>><?php echo $i; ?></option>
<?php
}
?>

</select>
</div>
</div>
<div class="col-sm-4 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Month</label>
<select name="month" required/>
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
<select name="year" required/>
<option value="">Select Year</option>
<?php
$cu_y =  date("Y");
$act_y = 1800;
for($year=$cu_y;$year>=$act_y;$year--)
{
	$selects = '';
	if($user_dob[2]==$year)
	{
		$selects = 'selected';
	}
?>
<option value="<?php echo $year; ?>" <?php echo $selects; ?>><?php echo $year; ?></option>
<?php
}
?>

</select>
</div>
</div>
<div class="col-sm-12 text">
<h3>Extra information</h3>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Eduction</label>
<input type="text" class="form-control" name="eduction" placeholder="Eduction" value="<?php echo $education; ?>" />
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">profession</label>
<input type="text" class="form-control" name="profession" placeholder="profession" value="<?php echo $profession; ?>" />
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Facebook Account link</label>
<input type="text" class="form-control" name="Facebook_link" placeholder="Facebook Account link" value="<?php echo $facebook_link; ?>" />
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Twitter Account link</label>
<input type="text" class="form-control" name="Twitter_link" placeholder="Twitter Account link" value="<?php echo $twitter_link; ?>" />
</div>
</div>
<div class="col-sm-12 text">
<h3>About Your Self</h3>
<div class="form-group">
<textarea cols="50" id="area1" name="text_editor"><?php echo $about_us; ?></textarea>
</div>
</div>
<div class="clear"></div>
<div class="text-center">
<button class="btn" type="submit"  name="update">Update!</button>
</div>
</form>
</div>
</div>
<div class="col-sm-4 form-box" id="logins">
<?php
	
	//$this->load->view('login');
?>

</div>
</div>
</div>
</div>
<script src="<?php echo base_url(); ?>assets/js/nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
	new nicEditor().panelInstance('area1');
	
});
 

$(document).ready(function()
{
	$(".per_country").change(function()
	{
		var id=$(this).val();
		var dataString = 'id='+ id;
		alert();
		
		$.ajax
		({
			type: "POST",
			url: "<?php echo base_url(); ?>signup/get_states",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$('.per_state').html(html);
			} 
		});
	});
	
	$(".per_state").change(function()
	{
		var id=$(this).val();
		var dataString = 'id='+ id;
		
		$.ajax
		({
			type: "POST",
			url: "<?php echo base_url(); ?>signup/get_city",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$(".per_city").html(html);
			} 
		});
	});
	
	
	
	$(".curr_country").change(function()
	{
		var id=$(this).val();
		var dataString = 'id='+ id;
			
		
		
		$.ajax
		({
			type: "POST",
			url: "<?php echo base_url(); ?>signup/get_states",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$('.curr_state').html(html);
			} 
		});
	});
	
	$(".curr_state").change(function()
	{
		var id=$(this).val();
		var dataString = 'id='+ id;
		
		$.ajax
		({
			type: "POST",
			url: "<?php echo base_url(); ?>signup/get_city",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$(".curr_city").html(html);
			} 
		});
	});
	
});


</script>
