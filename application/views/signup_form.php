<div class="container">
<div class="row">
<div class="col-sm-8 text" id="pleasesign">
<div class="form-top">
<div class="form-top-left">
<h3>Please fill the following information to join with us.</h3>
</div>
<div class="form-top-right">
	
</div>
</div>
<div class="form-bottom">
<form action="<?php echo base_url();?>signup" method="post" onsubmit="return signup_submit()">
<?php if(! is_null($msg)) echo $msg;?>
<div id="messg">
</div>
<div class="col-sm-12 text"> 
<h4>Personal Information</h4>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-first-name" class="sr-only">First name</label>
<input type="text" id="f-names" class="form-control" name="fname" placeholder="First name" required/>
<input type="hidden" name="run_code" value="45">
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Last name</label>
<input type="text" id="l-names" class="form-control" name="lname" placeholder="Last name" required/>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Phone No.</label>
<input type="number" id="phones" class="form-control" name="phone_num" placeholder="Contact No." required/>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Father name</label>
<input type="text" id="fat-names" class="form-control" name="father_name" placeholder="Father name" required/>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Gender</label>
<select name="genders" required/>
<option value="">Select Gender</option>
<option value="male">Male</option>
<option value="female">Female</option>
</select>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Gotra</label>
<select name="gotra" required/>
<option value="">Select Gotra (गौतृ)</option>
<?php
	$query = $this->db->query('SELECT * FROM user_gotra');
    foreach ($query->result() as $row)
    {
	  echo '<option value="'.$row->id.'">'.$row->gotra_name.'</option>';
    }
?>
</select>
</div>
</div>
<div class="clear"></div>

<div class="col-sm-6 text">
<h4 id="design_sec">Current Address</h4>
<div class="form-group">
<label for="form-last-name" class="sr-only">Village name</label>
<input type="text" class="form-control" name="per_address" placeholder="Address" required/>
</div>
<div class="form-group">
<label for="form-last-name" class="sr-only">Country</label>
<select name="per_country" class="per_country" id="countryId" required/>
<option value="">Select Country</option>
<option value="91">India</option>

<?php
	/*$query = $this->db->query('SELECT * FROM countries');
    foreach ($query->result() as $row)
    {
	  echo '<option value="'.$row->country_id.'">'.$row->name.'</option>';
    }*/
?>
</select> 
</div>
<div class="form-group">
<label for="form-last-name" class="sr-only">State</label>
<select name="per_state" class="per_state" id="stateId" required/>
<option value="">Select State</option>
</select>
</div>
<div class="form-group">
<label for="form-last-name" class="sr-only">District </label>
<select name="per_city" class="per_city" id="cityId" required/>
<option value="">Select City</option>
</select>
</div>
</div> 
<div class="col-sm-6 text">
<h4>Birth Address (Mool Nivasi)</h4>
<div id="same_add" style="">
<div class="form-group">
<label for="form-last-name" class="sr-only">Village name</label>
<input type="text" id="current_vill" class="form-control" name="curr_address" placeholder="Address" />
</div>
<div class="form-group">
<label for="form-last-name" class="sr-only">Country</label>
<select name="curr_country" class="curr_country" id="countryId" >
<option value="">Select Country</option>
<option value="91">India</option>

<?php
	/*$query = $this->db->query('SELECT * FROM countries');
    foreach ($query->result() as $row)
    {
	  echo '<option value="'.$row->country_id.'">'.$row->name.'</option>';
    }*/
?>
</select>
</div>
<div class="form-group">
<label for="form-last-name" class="sr-only">State</label>
<select name="curr_state" class="curr_state" id="stateId">
<option value="">Select State</option>
</select>
</div>
<div class="form-group">
<label for="form-last-name" class="sr-only">District </label>
<select name="curr_city" class="curr_city" id="cityId">
<option value="">Select City</option>
</select>
</div>



</div>
</div>
<div class="clear"></div>
<div class="col-sm-12 text" style="display:none">
<h4>Reference</h4>
<div class="reference">
<p>Please put a reference profile link (If you know any on this website) to active you account with in couple of hours.</p>
<div class="form-group">
<label for="form-email" class="sr-only">Reference</label>
<input type="text" class="form-control" name="reference" placeholder="Reference Profile Link" />
</div>
</div>
</div>
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
?>
<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
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
		/*$select = '';
		if($months=='February')
		{
			$select = 'selected';
		}*/
	?>
		<option value="<?php echo $months; ?>" <?php //echo $select; ?>><?php echo $months; ?></option>
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
$act_y = $cu_y;
while($act_y>=1800)
{
?>
<option value="<?php echo $act_y; ?>"><?php echo $act_y; ?></option>
<?php
$act_y--;
}
?>

</select>
</div>
</div>
<div class="col-sm-12 text">
<h4>Account Info</h4>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-email" class="sr-only">Email</label>
<input type="email" class="form-control" name="email" placeholder="Your Email" required/>
</div>
</div>
<div class="clear"></div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-email" class="sr-only">Password</label>
<input type="password" class="form-control" id="user_pass" name="password" placeholder="Your Password" required/>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-email" class="sr-only">Confirm Password</label>
<input type="password" class="form-control" id="user_con_pass" name="con_pass" placeholder="Your Rep-password" required/>
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
<div class="col-sm-4 form-box" id="logins">
<?php
	
	//$this->load->view('login');
?>
<div class="form-bottom">
<ul class="list-group">
<h3><img src="<?php echo base_url(); ?>assets/images/list-add-user.png" alt="Formget logo">&nbsp;Our registration process</h3>
<li><span class="badge">1</span> Please Fill all the required details in this form.</li>
<li><span class="badge">2</span> Please Fill all the entries correct no any Fake Information.</li>
<li><span class="badge">3</span> Submit your filled information.</li>
<li><span class="badge">4</span> Your Account is created on this website.</li>
<li><span class="badge">5</span> You will get an email on the registered email id for email verification. </li>
<li><span class="badge">6</span> Your Account will be under review based on  your provide details (if you know any person who is Active on this website already then you can add that profile link as verification , so you can active your account in couple of hours) for our manual verification.</li>
<li><span class="badge">7</span> After verification your account will be active.</li>
<li><span class="badge">8</span> Now Enjoy with your Family.</li>
</div>
</div>
</div>
</div> <!--container-->
<script>
$(document).ready(function()
{
	$(".per_country").change(function()
	{
		var id= jQuery('#countryId').val();
		var dataString = 'id='+ id;
		//alert(id);
		
		
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
