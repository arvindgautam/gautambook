 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
   
    </section>

<!-- Main content -->
<div class="container"> 
<div class="row">
<div class="col-sm-12 text">
<div class="form-bottom">
<!-- user gallery list -->
<h4>Add state</h4>
<div class="form-bottom login">
<form action="" method="post" name='process'>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">state name</label>
<input type="text" class="form-control" name="state_name" placeholder="State name" required/>
<input type="hidden" name="state" value="45">
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only"></label>
<select name="country_id" required>
<option value="">Select country name</option>
<?php
		$this -> db -> select('*');
		$this -> db -> from('country');
		$query = $this -> db -> get();
		if ($query->num_rows() > 0)  
		{
		foreach ($query->result() as $row)
		
		{
			$country_id = $row->country_id;
			$country_name = $row->country_name;

?>
<option value="<?php echo $country_id;?>"><?php echo $country_name;?></option>
<?php

		}
	}
?>
</select>
</div>
</div>
<div class="clear"></div>
<div class="text-center">
<button class="btn log" type="submit" name="submit">Submit</button>
</div>
</form>
</div>
<!-- edit state------->



<?php
	$query = $this->db->query('SELECT * FROM state');
	
	if ($query->num_rows() > 0)
	{
		?>
		<table class="gotraname" cellspacing="0" width="100%" border="1">
		<tr>
		<th>S NO.</th>
		<th>State</th>
		<th>Country</th>
		<th></th>
		<th></th>
		</tr>
		<?php
		$i=1;
		foreach ($query->result() as $row)
		{
			$country_ids = $row->country_id;
			
	
	  	?>
			<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $row->state_name; ?></td>
			<?php
			$query = $this->db->query("SELECT * FROM country where country_id='$country_ids'");
	
			if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $rows)
				{
			
			?>
			<td><?php echo $rows->country_name; ?></td>
			<?php
			}
			}
			
			
			?>
			<td><span  class="inline" href="#inline_content<?php echo $row->id;?>" onclick="edit_state(this.id)">Edit</span></td>
			<td><span id="<?php echo $row->id;?>" onclick="delete_states(this.id)">Delete</span></td>
			 </tr>
			 <div style='display:none'>
			<div id='inline_content<?php echo $row->id;?>' style='padding:10px; background:#fff;'>
			<form action="" method="post" name='process'> 

			<h4 class="village_editpopup">Edit Country</h4>

			<div class="col-sm-6 text">
			<div class="form-group">

			<label for="form-first-name" class="sr-only">country</label>
			<input type="text" class="form-control" id="edit_gotra_nm" name="state_name" placeholder="country name" value="<?php echo $row->state_name;?>" required/>
			<input type="hidden" name="edit_id" value="<?php echo $row->id;?>" id="gotra_id">
			</div>
			</div>
			
			<div class="col-sm-6 text">
			<div class="form-group">
			<label for="form-last-name" class="sr-only"></label>
			<select name="country_id" required>
			<option value="">Select country name</option>
			<?php
					$this -> db -> select('*');
					$this -> db -> from('country');
					$query = $this -> db -> get();
					if ($query->num_rows() > 0)  
					{
					foreach ($query->result() as $row)
					
					{
						
						$country_id = $row->country_id;
						$country_name = $row->country_name;
						
						$select ='';
						if($country_ids==$country_id)
						{
							$select = 'selected'; 
						}

			?>
			<option value="<?php echo $country_id;?>" <?php echo $select;?>> <?php echo $country_name;?></option>
			<?php

					}
				}
			?>
			</select>
			</div>
			</div>

			<div class="clear"></div>
			<div class="text-center">
			<button class="btn" type="submit"  name="update">Update!</button>
			</div>
			</form>
			</div>

			</div>
		<?php
		
		$i++;
		}
	?>
	</table>
	<?php
	}
	else {
		 echo 'data is not present';
	}
	
?>


</div>
</div>
</div>