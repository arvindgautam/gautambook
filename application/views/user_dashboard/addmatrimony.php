<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
    </section>
<div class="container"> 
<div class="row">
<div class="col-sm-8 text">
<div class="form-bottom">

<?php if(! is_null($msg)) echo $msg;?>
<form action="" method="post" id="metri-form" enctype='multipart/form-data'> 
<div id="messg">
</div>
<div class="col-sm-12 text"> 
<h4>Personal Information</h4>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Gender</label>
<select name="metri_for"  id="matri-gender"required>
<option value="">Profile Create For</option>
<option value="Self">Self</option>
<option value="Son">Son</option>
<option value="Daughter">Daughter</option>
<option value="Brother">Brother</option>
<option value="Sister">Sister</option>
<option value="Friend">Friend</option>
<option value="Relative">Relative</option>     
</select>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-first-name" class="sr-only">Name</label>
<input type="text" id="name" class="form-control" name="name" placeholder="Name" required/>
<input type="hidden" name="run_code" value="45">
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Father name</label>
<input type="text" id="father-name" class="form-control" name="father_name" placeholder="Father's name" required/>
</div>
</div>

<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Gender</label>
<select name="gender"  id="matri-gender"required>
<option value="">Select Gender</option>
<option value="male">Male</option>
<option value="female">Female</option>      
</select>
</div>
</div>  
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Phone No.</label>
<input type="number" id="phone_no" class="form-control" name="phone_no" placeholder="Contact No." required/>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Email id</label>
<input type="text" id="email-id" class="form-control" name="email_id" placeholder="Email id" required/>
</div>
</div>
<div class="clear"></div>
<div class="col-sm-12 text">
<div class="form-group">
<label for="form-first-name" class="sr-only"> Present Address</label>
<input type="text" id="present-address" class="form-control" name=" current_address" placeholder=" Present Address" required/>
<input type="hidden" name="run_code" value="45">
</div>
</div>
<div class="col-sm-12 text">
<div class="form-group">
<label for="form-first-name" class="sr-only"> Permenant Address</label>
<input type="text" id="permenant-address" class="form-control" name="permenant_address" placeholder="Permenant Address" required/>
<input type="hidden" name="run_code" value="45">
</div>
</div>

<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Gender</label>
<select name="state" class="per_state" id="matri-gender"required>
<option value="">Select State</option>
<?php
		$query = $this->db->query('SELECT * FROM states where country_name=91');
		foreach ($query->result() as $rows)
		{

?>

		<option value="<?php echo $rows->state_id; ?>"><?php echo $rows->name; ?></option> 
<?php
		}
?>     
</select>
</div>
</div> 
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-first-name" class="sr-only">City</label>
<select name="city" class="per_city" id="matri-gender"required>
<option value="">Select City</option>
</select>
</div>
</div>
<div class="clear"></div>   

<div class="col-sm-2 text dateofbirth">
<b>Date of Birth :<b>
</div>
<div class="col-sm-3 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">day</label>

<select name="day" id="metri_dob_day"required>
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
<select name="month" id="metri_dob_month" required>
<option value="">Select Month</option>
<?php
	
	$month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	foreach($month as $months)
	{
		
	?>
		<option value="<?php echo $months; ?>"><?php echo $months; ?></option>
	<?php
	}

?>
</select>
</div>
</div>
<div class="col-sm-3 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Year</label>
<select name="year" id="metri_dob_year" required>
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


<div class="clear"></div>





<div class="col-sm-6 text">
<div class="form-group">
<label for="form-first-name" class="sr-only">Qualification</label>
<select name="qualification" id="metri_prof"required>
<option value="">Select Qualification</option>
<?php
$qualification = array('B.A','B.COM','B.S.C','BE/B.TECH','M.TECH','MCA','MBA','OTHER');
	foreach($qualification as $qualifications)
	{
?>
<option value="<?php echo $qualifications;?>"><?php echo $qualifications;?></option>
<?php
	}
	?>
</select>
<input type="hidden" name="run_code" value="45">
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Profession</label>
<select name="Profession" id="metri_prof"required/>
<option value="">Select Profession</option>
<option value="Self Employed">Self Employed</option>
<option value="Govt.Service">Govt.Service</option>
<option value="Private Sector">Private Sector</option>
<option value="Other">Other</option>
</select>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Annual Income</label>
<select name="annual_income" id="metri_prof"required/>
<option value="">Annual Income</option>
<?php
	
	$income = array('No Income', 'Under Rs.50,000', 'Rs.50,001 - 1,00,000', 'Rs.1,00,001 - 2,00,000', 'Rs.2,00,001 - 3,00,000', 'Rs.3,00,001 - 4,00,000', 'Rs.4,00,001 - 5,00,000', 'Rs.5,00,001 - 7,50,000', 'Rs.7,50,001 - 10,00,000', 'Rs.10,00,001 - 15,00,000', 'Rs.15,00,001 - 20,00,000', 'Rs.20,00,001 - 25,00,000','Rs.25,00,001 and above');
	foreach($income as $incomes)
	{
		
	?>
<option value="<?php echo $incomes; ?>"><?php echo $incomes; ?></option>
<?php
	}
	?>
</select>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="challenged" class="sr-only">Challenged</label>
<select name="challenged" id="metri_prof"required/>
<option value="">Physically Challenged</option>
<?php
	
	$Challenged = array('None', 'Physically Handicapped from birth', 'Physically Handicapped due to accident', 'Mentally Challenged from birth', 'Mentally Challenged due to accident');
	foreach($Challenged as $Challengeds)
	{
		
	?>
<option value="<?php echo $Challengeds; ?>"><?php echo $Challengeds; ?></option>
<?php
	}
	?>


</select>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="challenged" class="sr-only">Fathers Occupation</label>
<select name="father_occupation" id="father-occupation"required/>
<option value="">Fathers Occupation</option>
<?php
	
	$Fathers_Occupation = array('Business/Entrepreneur', 'Service - Private', 'Service - Govt./PSU', 'Army/Armed Forces', 'Civil Services', 'Retired', 'Not Employed', 'Expired','Other');
	foreach($Fathers_Occupation as $Fathers_Occupations)
	{
		
	?>
<option value="<?php echo $Fathers_Occupations; ?>"><?php echo $Fathers_Occupations; ?></option>
<?php
	}
	?>


</select>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="challenged" class="sr-only">Mother Occupation</label>
<select name="mother_occupation" id="mother-occupation"required/>
<option value="">Mother Occupation</option>
<?php
	
	$Mother_Occupation = array('Housewife','Business/Entrepreneur', 'Service - Private', 'Service - Govt./PSU', 'Army/Armed Forces', 'Civil Services', 'Retired', 'Not Employed', 'Expired','Other');
	foreach($Mother_Occupation as $Mother_Occupations)
	{
		
	?>
<option value="<?php echo $Mother_Occupations; ?>"><?php echo $Mother_Occupations; ?></option>
<?php
	}
	?>

</select>
</div>
</div>
<div class="clear"></div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Gotra1</label>  
<select name="mother_gotra" id="metri_mother_gotra"required/>
<option value="">Select Mother's Gotra (गौतृ)</option>
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
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Gotra</label>
<select name="father_gotra" id="metri_father_gotra" required/>
<option value="">Select Father's Gotra (गौतृ)</option>
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

<div class="col-sm-6 text">
<div class="form-group form_group-top">
<label for="form-first-name" class="sr-only">Mars</label>
 <b>मांगलिक &nbsp;<b>
<label class="radio-inline">
      <input type="radio" name="radio" checked="checked" value ="Dont know">Dont know
    </label>
 <label class="radio-inline">
      <input type="radio" name="radio" checked="checked" value ="Yes">Yes
    </label>
    <label class="radio-inline">
      <input type="radio" name="radio" value ="No">No
    </label>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group form_group-top">

<label>
<b>Height</b> &nbsp;&nbsp;: Feet  
<input type="text" name="feet" value="" style="width : 30px; height:21px; text-align: center;" required="required">
</label>
<label>
Inch  
<input type="text" name="inch" value="" style="width : 30px; height:21px; text-align: center;" required="required">
</label>
</div>
</div>

<div class="col-sm-6 text">
<div class="form-group form_group-top">
<label for="form-first-name" class="sr-only">Mars</label>
<b>Diet  :</b>
<label class="radio-inline">
      <input type="radio" name="diet" checked="checked" value ="vegetarian ">Vegetarian 
    </label>
 <label class="radio-inline">
      <input type="radio" name="diet" checked="checked" value ="non_vegetarian">Non Vegetarian 
    </label>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group form_group-top">
<label for="form-first-name" class="sr-only">Mars</label>
<b>Body Type  :</b>
<label class="radio-inline">
      <input type="radio" name="Body_Type" checked="checked" value ="Slim ">Slim 
    </label>
 <label class="radio-inline">
      <input type="radio" name="Body_Type" checked="checked" value ="Average">Average
    </label>
	<label class="radio-inline">
      <input type="radio" name="Body_Type" checked="checked" value ="Heavy ">Heavy 
    </label>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group form_group-top">
<label for="form-first-name" class="sr-only"> Complexion</label>
<b> Complexion  :</b>
<label class="radio-inline">
      <input type="radio" name="Complexion" checked="checked" value ="Very Fair ">Very Fair 
    </label>
 <label class="radio-inline">
      <input type="radio" name="Complexion" checked="checked" value ="Fair ">Fair 
    </label>
	<label class="radio-inline">
      <input type="radio" name="Complexion" checked="checked" value ="Wheatish  ">Wheatish  
    </label>
	<label class="radio-inline">
      <input type="radio" name="Complexion" checked="checked" value ="Wheatish Brown">Wheatish Brown   
    </label>
	<label class="radio-inline">
      <input type="radio" name="Complexion" checked="checked" value ="Dark">Dark  
    </label>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group"> 
<label for="form-last-name" class="sr-only">Blood Group</label>
<select name="blood_group"  id="blood_group"required>
<option value="">Blood Group</option>
<?php
	
	$Blood_Group = array('Dont Know', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-');
	foreach($Blood_Group as $Blood_Groups)
	{
		
	?>
		<option value="<?php echo $Blood_Groups; ?>"><?php echo $Blood_Groups; ?></option>
	<?php
	}

?>

</select>
</div>
</div>
<div class="clear"></div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Nakshatra</label>
<select name="nakshatra"  id="nakshatra"required>
<option value="">Nakshatra</option>
<?php
	
	$nakshatra = array('Dont Know', 'Anuradha/ Anusham/ Anizham', 'Ardra/ Thiruvathira', 'Ashlesha/ Ayilyam', 'Ashwini/ Ashwathi', 'Bharani', 'Chitra/ Chitha', 'Dhanista/ Avittam', 'Hastha/ Atham', 'Jyesta/ Kettai', 'Jyesta/ Kettai', 'Krithika/ Karthika','Makha/ Magam','Moolam/ Moola','Mrigasira/ Makayiram','Poorvashada/ Pooradam','Poorvapalguni/ Puram/ Pubbhe','Punarvasu/ Punarpusam','Pushya/ Poosam/ Pooyam','Rohini','Revathi','Shatataraka/ Sadayam/ Sadabist','Shravan/ Thiruvonam','Swati/ Chothi','Uttrabadrapada/ Uthratadhi','Uttarapalguni/ Uthram','Uttarashada/ Uthradam','Vishaka/ Vishakam');
	foreach($nakshatra as $nakshatras)
	{
		
	?>
		<option value="<?php echo $nakshatras; ?>"><?php echo $nakshatras; ?></option>
	<?php
	}

?>
   
</select>
</div>
</div>  
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Rashi/ Moon sign </label>
<select name="rashi"  id="Rashi"required>
<option value="">Rashi/ Moon sign</option>
<?php
	
	$rashi = array('Dont Know', 'Mesh', 'Vrishabh', 'Mithun', 'Kark', 'Simha', 'Kanya', 'Tula', 'Vrishchick', 'Dhanu', 'Makar','Kumbh','Meen');
	foreach($rashi as $rashis)
	{
		
	?>
		<option value="<?php echo $rashis; ?>"><?php echo $rashis; ?></option>
	<?php
	}

?>
</select>
</div>
</div>
<div class="col-sm-12 text">
<div class="form-group">
<label for="form-first-name" class="sr-only">About Boy/Girl Details </label>
<textarea id="About-Boy " class="form-control textarea" name="about_boy" placeholder="About Boy/Girl Details " required></textarea>

</div>
</div>
<div class="clear"></div>
<div class="col-sm-12 text">
<div class="form-group">
<label for="form-first-name" class="sr-only">Mother Tounge</label>
<textarea  id="about-boy-family" class="form-control textarea" name="about_boy_family" placeholder="About Boy/Girl family Details" required></textarea> 

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
<button class="btn btn-primary" type="submit" id="signup_sub" name="submitted">Submit</button>
</div>
<?php echo form_close(); ?>
</form>
</div>

</div>
</div>
</div>
</div>
<script type="text/javascript">
	$(".per_state").change(function()
	{
		var id=$(this).val();
		var dataString = 'id='+ id;
		
		$.ajax
		({
			type: "POST",
			url: "<?php echo base_url(); ?>addmatrimony/get_city",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$(".per_city").html(html);
			} 
		});
	});
</script>
