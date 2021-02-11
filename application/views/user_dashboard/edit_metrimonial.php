<?php
$metri_id =base64_decode( $_GET['userid']);
?>

<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
    </section>
<div class="container"> 
<div class="row">
<div class="col-sm-8 text">
<div class="form-bottom">


<form action="" method="post" id="metri-form" enctype='multipart/form-data'> 
<div id="messg">
</div>
<div class="col-sm-12 text"> 
<h4>Personal Information</h4>
</div>
<?php 
$query = $this->db->query("SELECT * FROM matrimonial WHERE id =$metri_id");
if ($query->num_rows() > 0)  
	{
	foreach ($query->result() as $row)
	{
		$profile_create_for = $row->profile_create_for;
		$mother_gotra_id = $row->mother_gotra;
		$father_gotra_id = $row->father_gotra;
?>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Profile Create For</label>
<select name="metri_for"  id="matri-gender"required>
<option value="">Profile Create For</option>
<?php
	$get_dob = $row->d_o_b;
	$user_dob = explode('/',$get_dob);			
	$profile_for = array('Self', 'Son', 'Daughter', 'Brother', 'Sister', 'Friend', 'Relative');
	foreach($profile_for as $profile_fors)
	{
		$select = '';
		if($profile_create_for == $profile_fors) 
		{
			$select = 'selected';
		}
	?>
		<option value="<?php echo $profile_fors; ?>" <?php echo $select; ?>><?php echo $profile_fors; ?></option>
	<?php
	}

?>   
</select>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-first-name" class="sr-only">Name</label>
<input type="text" id="name" class="form-control" name="name" placeholder="Name" value="<?php echo $row->user_name;?>" required/>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Father name</label>
<input type="text" id="father-name" class="form-control" name="father_name" placeholder="Father's name" value="<?php echo $row->father_name;?>" required/>
</div>
</div>

<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Gender</label>
<select name="gender"  id="matri-gender"required>
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
<input type="number" id="phone_no" class="form-control" name="phone_no" placeholder="Contact No." value="<?php echo $row->contact_no;?>" required/>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Email id</label>
<input type="text" id="email-id" class="form-control" name="email_id" placeholder="Email id"  value="<?php echo $row->email_id;?>" required/>
</div>
</div>
<div class="clear"></div>
<div class="col-sm-12 text">
<div class="form-group">
<label for="form-first-name" class="sr-only"> Present Address</label>
<input type="text" id="present-address" class="form-control" name=" current_address" placeholder=" Present Address" value="<?php echo $row->permanent_address;?>" required/>
<input type="hidden" name="metrimonial_id" value="<?php echo $metri_id;?>">
</div>
</div> 
<div class="col-sm-12 text">
<div class="form-group">
<label for="form-first-name" class="sr-only"> Permenant Address</label>
<input type="text" id="permenant-address" class="form-control" name="permenant_address" placeholder="Permenant Address"  value="<?php echo $row->current_address;?>" required/>

</div>
</div>

<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Gender</label>
<select name="state" class="per_state" id="matri-gender"required>
<option value="">Select State</option>
<?php
		$state = $row->state;
		$query = $this->db->query('SELECT * FROM states where country_name=91');
		foreach ($query->result() as $rows)
		{
			$state_id = $rows->state_id;
			$select='';
			if($state == $rows->state_id)
			{
				$select='selected';
			}
		
?>

		<option value="<?php echo $rows->state_id; ?>" <?php echo $select; ?>><?php echo $rows->name; ?></option> 
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


	
<?php
	$city = $row->city;

if(!empty($city))
{
	$this -> db -> select('*');
	$this -> db -> from('cities');
	$this -> db -> where('state_nm',$state);
	$query = $this->db->get();
	
	foreach ($query->result() as $rows)
	{	$selects = '';
		if($city==$rows->id)
		{
			$selects = 'selected';
		}
		echo  '<option '.$selects.' value="'.$rows->id.'">'.$rows->name.'</option>';

	}
}
?>
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
<select name="month" id="metri_dob_month" required>
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
<div class="col-sm-3 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Year</label>
<select name="year" id="metri_dob_year" required>
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
<label for="form-first-name" class="sr-only">Qualification</label>
<select name="qualification" id="metri_prof"required>
<option value="">Select Qualification</option>
<?php
	$qualificationss = $row->qualification;
	$qualification = array('B.A','B.COM','B.S.C','BE/B.TECH','M.TECH','MCA','MBA','OTHER');
	foreach($qualification as $qualifications)
	{
		$select = '';
		if($qualificationss == $qualifications)
		{
			$select ='selected';
			
		}
?>
<option value="<?php echo $qualifications;?>" <?php echo $select;?> ><?php echo $qualifications;?></option>
<?php
	}
	?>
</select>
<input type="hidden" name="run_code" value="<?php echo $row->id; ?>">
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Profession</label>

<select name="Profession" id="metri_prof"required/>
<option value="">Select Profession</option>
<?php
	$Professionss = $row->profession;
	$profession = array('Self Employed','Govt.Service','Private Sector','Other');
	foreach($profession as $professions)
	{
		$select = '';
		if($Professionss == $professions)
		{
			$select ='selected';
			
		}
?>
<option value="<?php echo $professions;?>" <?php echo $select;?> ><?php echo $professions;?></option>
<?php
	}
	?>

</select>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Annual Income</label>
<select name="annual_income" id="metri_prof"required/>
<option value="">Annual Income</option>
<?php
	$annual_income = $row->annual_income;
	$income = array('No Income', 'Under Rs.50,000', 'Rs.50,001 - 1,00,000', 'Rs.1,00,001 - 2,00,000', 'Rs.2,00,001 - 3,00,000', 'Rs.3,00,001 - 4,00,000', 'Rs.4,00,001 - 5,00,000', 'Rs.5,00,001 - 7,50,000', 'Rs.7,50,001 - 10,00,000', 'Rs.10,00,001 - 15,00,000', 'Rs.15,00,001 - 20,00,000', 'Rs.20,00,001 - 25,00,000','Rs.25,00,001 and above');
	foreach($income as $incomes)
	{
		$select = '';
		if($annual_income == $incomes)
		{
			$select ='selected';
			
		}
	?>
<option value="<?php echo $incomes; ?>" <?php echo $select; ?>><?php echo $incomes; ?></option>
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
	$challengedss = $row->challenged;
	$Challenged = array('None', 'Physically Handicapped from birth', 'Physically Handicapped due to accident', 'Mentally Challenged from birth', 'Mentally Challenged due to accident');
	foreach($Challenged as $Challengeds)
	{
		$select = '';
		if($challengedss == $Challengeds)
		{
			$select ='selected';
			
		}
	?>
<option value="<?php echo $Challengeds; ?>" <?php echo $select ; ?>><?php echo $Challengeds; ?></option>
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
	$fathers_occupationss = $row->fathers_occupation;
	$Fathers_Occupation = array('Business/Entrepreneur', 'Service - Private', 'Service - Govt./PSU', 'Army/Armed Forces', 'Civil Services', 'Retired', 'Not Employed', 'Expired','Other');
	foreach($Fathers_Occupation as $Fathers_Occupations)
	{
		$select = '';
		if($fathers_occupationss == $Fathers_Occupations)
		{
			$select ='selected';
			
		}
	?>
<option value="<?php echo $Fathers_Occupations; ?>" <?php echo $select; ?>><?php echo $Fathers_Occupations; ?></option>
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
	$Mothers_Occupation = $row->mothers_occupation;
	$Mother_Occupation = array('Housewife','Business/Entrepreneur', 'Service - Private', 'Service - Govt./PSU', 'Army/Armed Forces', 'Civil Services', 'Retired', 'Not Employed', 'Expired','Other');
	foreach($Mother_Occupation as $Mother_Occupations)
	{
		$select = '';
		if($Mothers_Occupation == $Mother_Occupations)
		{
			$select ='selected';
			
		}
		
	?>
<option value="<?php echo $Mother_Occupations; ?>" <?php echo $select ; ?>><?php echo $Mother_Occupations; ?></option>
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
<option value="">Select Mother's Gotra </option>
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
</select>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Gotra</label>
<select name="father_gotra" id="metri_father_gotra" required/>
<option value="">Select Father's Gotra (????)</option>
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

<div class="col-sm-6 text">
<div class="form-group form_group-top">
<label for="form-first-name" class="sr-only">Mars</label>
 <b> मांगलिक  <b>
 <?php 
					$mars = $row->mars;
					$select = '';
					$selected = '';
					$selectedt = '';
					
					if($mars=='Yes')
					{
					  $select = 'checked';
					}
					elseif($mars == 'No')
					{
					$selected = 'checked'; 
					}
					elseif($mars == 'Dont know')
					{
					$selectedt = 'checked'; 
					}
					
			?>
<label class="radio-inline">
      <input type="radio" name="radio"  value ="Dont know" <?php echo $selectedt; ?>>Dont know
    </label>
 <label class="radio-inline">
  <input type="radio" name="radio" value ="Yes"<?php echo $select; ?>>Yes
</label>
<label class="radio-inline">
  <input type="radio" name="radio" value ="No"<?php echo $selected; ?>>No    
</label>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group form_group-top">

<label>
<b>Height</b> &nbsp;&nbsp;: Feet  
<input type="text" name="feet" value="<?php echo $row->feet; ?>" style="width : 30px; height:21px; text-align: center;" required="required">
</label>
<label>
Inch  
<input type="text" name="inch" value="<?php echo $row->inch; ?>" style="width : 30px; height:21px; text-align: center;" required="required">
</label>
</div>
</div>

<div class="col-sm-6 text">
<div class="form-group form_group-top">
<label for="form-first-name" class="sr-only">Mars</label>
<b>Diet  :<?php echo $row->diet;?></b>
<?php
			$diets = $row->diet;
	
			$selects = '';
			$selected = '';
			
			if($diets=='vegetarian')
			{
			  $selects = 'checked';
			
			}
			elseif($diets=='non vegetarian')
			{
			$selected = 'checked'; 
			}
			
			?>
<label class="radio-inline">
      <input type="radio" name="diet"  value ="vegetarian" <?php echo $selects; ?>>Vegetarian 
    </label>
 <label class="radio-inline">
      <input type="radio" name="diet"  value ="non vegetarian" <?php echo $selected; ?>>Non Vegetarian 
    </label>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group form_group-top">
<label for="form-first-name" class="sr-only">Mars</label>
<b>Body Type  :</b>
<?php 
					$Body_Type = $row->Body_Type;
					$select = '';
					$selected = '';
					$selectedt = '';
					if($Body_Type=='Slim')
					{
					  $select = 'checked';
					}
					elseif($Body_Type == 'Average')
					{
					$selected = 'checked'; 
					}
					elseif($Body_Type == 'Heavy')
					{
					$selectedt = 'checked'; 
					}
					
			?>
<label class="radio-inline">
      <input type="radio" name="Body_Type"  value ="Slim" <?php echo $select ; ?>>Slim 
    </label>
 <label class="radio-inline">
      <input type="radio" name="Body_Type"  value ="Average" <?php echo $selected ; ?>>Average
    </label>
	<label class="radio-inline">
      <input type="radio" name="Body_Type"  value ="Heavy " <?php echo $selectedt ; ?>>Heavy 
    </label>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group form_group-top">
<label for="form-first-name" class="sr-only"> Complexion</label>
<b> Complexion  :</b>
<?php 
					$Complexion = $row->Complexion;
					$select = '';
					$selected = '';
					$selectedt = '';
					$selectedtt = '';
					$selectedttt = '';
					if($Complexion=='Very Fair')
					{
					  $select = 'checked';
					}
					elseif($Complexion == 'Fair ')
					{
					$selected = 'checked'; 
					}
					elseif($Complexion == 'Wheatish')
					{
					$selectedt = 'checked'; 
					}
					elseif($Complexion == 'Wheatish Brown')
					{
					$selectedtt = 'checked'; 
					}
					elseif($Complexion == 'Dark')
					{
					$selectedttt = 'checked'; 
					}
					
			?>
<label class="radio-inline">
     <input type="radio" name="Complexion"  value ="Very Fair " <?php echo $select ; ?>>Very Fair
    </label>
 <label class="radio-inline">
      <input type="radio" name="Complexion"  value ="Fair" <?php echo $selected ; ?>>Fair 
    </label>
	<label class="radio-inline">
      <input type="radio" name="Complexion"  value ="Wheatish" <?php echo $selectedt ; ?>>Wheatish  
    </label>
	<label class="radio-inline">
      <input type="radio" name="Complexion"  value ="Wheatish Brown" <?php echo $selectedtt ; ?>>Wheatish Brown   
    </label>
	<label class="radio-inline">
      <input type="radio" name="Complexion"  value ="Dark" <?php echo $selectedttt;?> >Dark  
    </label>
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group"> 
<label for="form-last-name" class="sr-only">Blood Group</label>
<select name="blood_group"  id="blood_group"required>
<option value="">Blood Group</option>
<?php
	$Blood_Groupss = $row->blood_group;
	$Blood_Group = array('Dont Know', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-');
	foreach($Blood_Group as $Blood_Groups)
	{
		$select = '';
		if($Blood_Groupss == $Blood_Groups)
		{
			$select = 'selected';
		}
		
	?>
		<option value="<?php echo $Blood_Groups; ?>" <?php echo $select; ?>><?php echo $Blood_Groups; ?></option>
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
	$nakshatrass = $row->nakshatra;
	
	$nakshatra = array('Dont Know', 'Anuradha/ Anusham/ Anizham', 'Ardra/ Thiruvathira', 'Ashlesha/ Ayilyam', 'Ashwini/ Ashwathi', 'Bharani', 'Chitra/ Chitha', 'Dhanista/ Avittam', 'Hastha/ Atham', 'Jyesta/ Kettai', 'Jyesta/ Kettai', 'Krithika/ Karthika','Makha/ Magam','Moolam/ Moola','Mrigasira/ Makayiram','Poorvashada/ Pooradam','Poorvapalguni/ Puram/ Pubbhe','Punarvasu/ Punarpusam','Pushya/ Poosam/ Pooyam','Rohini','Revathi','Shatataraka/ Sadayam/ Sadabist','Shravan/ Thiruvonam','Swati/ Chothi','Uttrabadrapada/ Uthratadhi','Uttarapalguni/ Uthram','Uttarashada/ Uthradam','Vishaka/ Vishakam');
	foreach($nakshatra as $nakshatras)
	{
		$select = '';
		if($nakshatrass == $nakshatras)
		{
			$select = 'selected';
		}
		
	?>
		<option value="<?php echo $nakshatras; ?>" <?php echo $select; ?>><?php echo $nakshatras; ?></option>
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
	$rashiss = $row->rashi; 
	$rashi = array('Dont Know', 'Mesh', 'Vrishabh', 'Mithun', 'Kark', 'Simha', 'Kanya', 'Tula', 'Vrishchick', 'Dhanu', 'Makar','Kumbh','Meen');
	foreach($rashi as $rashis)
	{
		$select = '';
		if($rashiss == $rashis)
		{
			$select = 'selected';
		}
		
	?>
		<option value="<?php echo $rashis; ?>" <?php echo $select; ?>><?php echo $rashis; ?></option>
	<?php
	}

?>
</select>
</div>
</div>
<div class="col-sm-12 text">
<div class="form-group">
<label for="form-first-name" class="sr-only">About Boy/Girl Details </label>
<textarea id="About-Boy " class="form-control textarea" name="about_boy" placeholder="About Boy/Girl Details " required><?php echo $row->about_boy; ?></textarea>

</div>
</div>
<div class="clear"></div>
<div class="col-sm-12 text">
<div class="form-group">
<label for="form-first-name" class="sr-only">Mother Tounge</label>
<textarea  id="about-boy-family" class="form-control textarea" name="about_boy_family" placeholder="About Boy/Girl family Details" required><?php echo $row->about_boy_family; ?></textarea> 

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

           <div class="col-sm-12 text">
		<div class="form-group1"> 
		<input type="file" name="userfile[]">
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
<?php

		}
	}

?>
</form>
</div>

</div>
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