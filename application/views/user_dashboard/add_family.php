<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<section class="content-header">
    
    </section>
    
<div class="container"> 
<div class="row">
<div class="col-sm-8 text">
<div class="form-bottom">
<form action="" method="post" onsubmit="return signup_submit()" enctype='multipart/form-data'>
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
<?php

	$session_data = $this->session->userdata('logged_in');
	$id = $session_data['userid'];

	$query = $this->db->query("SELECT * FROM user_info where id=$id");
	$this->load->model('comman_function');
	$results = $this->comman_function->user_profile_info($id);
	$email_id = $results->user_email;
	$display_name = $results->display_name;
	$father_name = $results->father_name;
	
?>	
		
<label for="form-last-name" class="sr-only">Last name</label>
<input type="text" id="emails" class="form-control" name="emails" placeholder="Email" value="<?php echo $email_id; ?>" required/>
</div>
</div>
<div class="clear"></div>
<div class="col-sm-4 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Relation </label>
<select name="father_name">
<option value="">Select father </option>
<?php
	//get max parrent level
	$row = $this->db->query("SELECT MAX(parrent_level) AS `parrent_levels` FROM `user_info` where account_creater_id='$id' or user_id='$id'")->row(); 
	$user_level = $row->parrent_levels;
	//get top level parrent name
	$querys = $this->db->query("SELECT * FROM user_info where (parrent_level='$user_level' and (user_id='$id' or account_creater_id='$id'))");
	$data = $querys->row(); 
	echo '<option value="'.$data->father_name.','.$data->parrent_level.','.$data->parrent_id.'"> '.$data->father_name.'</option>';
	 $query = $this->db->query("SELECT * FROM user_info where account_creater_id='$id' or user_id='$id'");
		foreach ($query->result() as $rowss) 
    {
		$created_user_id = $rowss->user_id;
		$results = $this->comman_function->user_profile_info($created_user_id);
		 echo '<option value="'.$results->display_name.','.$results->user_level.','.$results->user_id.'"> '.$results->display_name.'</option>';
	}		
?>

<option value="other" onclick= "add_father()">Other</option>
</select>
</div>
</div>
<div class="col-sm-4 text">
<div class="form-group">
<div id="demo">
</div>
</div>
</div>
<div class="clear"></div>
<div class="col-sm-4 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Relation </label>
<select name="relation" required/>
<option value="">Select relation </option>
<?php
	$query = $this->db->query('SELECT * FROM relationship order by relation asc');
    foreach ($query->result() as $rows)
    {
	  echo '<option value="'.$rows->id.'">'.$rows->relation.'</option>';
    }
?>
</select>

</div>
</div>
<div class="col-sm-4 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Genders </label>
<select name="Genders" required/> 
<option value="">Select Gender </option>
<option value="male">Male</option>
<option value="female">Female</option>

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
    foreach ($query->result() as $row)
    {
	  echo '<option value="'.$row->id.'">'.$row->gotra_name.'</option>';
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

while($cu_y>=1800)
{
?>
<option value="<?php echo $cu_y; ?>"><?php echo $cu_y; ?></option>
<?php
$cu_y--;
}
?>

</select>
</div>
</div>
<div class="col-sm-12 text">
 <legend>Image Upload</legend>
        

        <fieldset>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="filenam" class="control-label">Select Image to Upload</label>
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
<button class="btn" type="submit" id="signup_sub" name="submitted">Submit</button>
</div>
</form>
</div>
	
<!--<div class="col-sm-4 form-box" id="logins">
<?php
	
	//$this->load->view('login');
?>
<div class="form-bottom">

</div>
</div>-->
</div>
</div>
</div>
<script>
function add_father() {
var dummy = '<input type="text" id="phones" class="form-control" name="create_father_name" placeholder="Father name" required/>';
    document.getElementById("demo").innerHTML += dummy;
}

</script>