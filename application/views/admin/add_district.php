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
<h4>Add District</h4>
<div class="form-bottom login">
<form action="" method="post" name='process'>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">state name</label>
<input type="text" class="form-control" name="district_name" placeholder="District name" required/>
<input type="hidden" name="state" value="45">
</div>
</div>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only"></label>
<select name="state_id" required>
<option value="">Select state name</option>
<?php
		$this -> db -> select('*');
		$this -> db -> from('state');
		$query = $this -> db -> get();
		if ($query->num_rows() > 0)  
		{
		foreach ($query->result() as $row)
		
		{
			$state_id = $row->id;
			$state_name = $row->state_name;

?>
<option value="<?php echo $state_id;?>"><?php echo $state_name;?></option>
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

<!-- edit district------->



<?php
	$query = $this->db->query('SELECT * FROM district_name');
	
	if ($query->num_rows() > 0)
	{
		?>
		<table class="gotraname" cellspacing="0" width="100%" border="1">
		<tr>
		<th>S NO.</th>
		<th>District</th>
		<th>State</th>
		<th></th>
		<th></th>
		</tr>
		<?php
		$i=1;
		foreach ($query->result() as $row)
		{
			$state_ids = $row->state_id;
	
	  	?>
			<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $row->district_name;?></td>
			<?php
			$query = $this->db->query("SELECT * FROM state where id='$state_ids'");
			foreach ($query->result() as $rows)
			{
				
			
			?>
			<td><?php echo $rows->state_name;?></td>
			<?php
			}
			
			?>
			<td><span  class="inline" href="#inline_content<?php echo $row->district_id;?>" onclick="edit_district(this.id)">Edit</span></td>
			<td><span id="<?php echo $row->district_id;?>" onclick="delete_district(this.id)">Delete</span></td>
			 </tr>
			 <div style='display:none'>
			<div id='inline_content<?php echo $row->district_id;?>' style='padding:10px; background:#fff;'>
			<form action="" method="post" name='process'> 

			<h4 class="village_editpopup">Edit district</h4>

			<div class="col-sm-6 text">
			<div class="form-group">

			<label for="form-first-name" class="sr-only">country</label>
			<input type="text" class="form-control" id="edit_gotra_nm" name="district_name" placeholder="country name" value="<?php echo $row->district_name;?>" required/>
			<input type="hidden" name="edit_district_id" value="<?php echo $row->district_id;?>" id="gotra_id">
			</div>
			</div>
			<div class="col-sm-6 text">
			<div class="form-group">
			<label for="form-last-name" class="sr-only"></label>
			<select name="state_id" required>
			<option value="">Select state name</option>
			<?php
					$this -> db -> select('*');
					$this -> db -> from('state');
					$query = $this -> db -> get();
					if ($query->num_rows() > 0)  
					{
					foreach ($query->result() as $row)
					
					{
						$state_id = $row->id;
						$state_name = $row->state_name;
						$select='';
						if($state_ids==$state_id)
						{
							$select ='selected';
						}

			?>
			<option value="<?php echo $state_id;?>"<?php echo $select;?>><?php echo $state_name;?></option>
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