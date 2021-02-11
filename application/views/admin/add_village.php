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
<h4>Add village</h4>
<div class="form-bottom login">
<form action="" method="post" name='process'> 
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">village name</label>
<input type="text" class="form-control" name="village_name" placeholder="Village name" required/>
<input type="hidden" name="state" value="45">
</div>
</div>

<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only"></label>
<select name="dist_id" required>
<option value="">Select district</option>
<?php
		$this -> db -> select('*');
		$this -> db -> from('district_name');
		$query = $this -> db -> get();
		if ($query->num_rows() > 0)  
		{
		foreach ($query->result() as $row)
		
		{
			$district_id = $row->district_id;
			$district_name = $row->district_name;

?>
<option value="<?php echo $district_id;?>"><?php echo $district_name;?></option>
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


<!-- edit village------->



<?php
	$query = $this->db->query('SELECT * FROM village_name');
	
	if ($query->num_rows() > 0)
	{
		?>
		<table class="gotraname" cellspacing="0" width="100%" border="1">
		<tr>
		<th>S NO.</th>
		<th>Village/City</th>
		<th>District</th>
		
		<th></th>
		<th></th>
		
		</tr>
		<?php
		$i=1;
		foreach ($query->result() as $row)
		
		{
			$district_ids = $row->dist_id;
	
	  	?>
			<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $row->name;?></td>
			
			<?php
			$query = $this->db->query("SELECT * FROM district_name where district_id='$district_ids'");
			foreach ($query->result() as $rows)
			{
				
			
			?>
			<td><?php echo $rows->district_name;?></td>
			<?php
			}
			
			?>
			<td><span  class="inline" href="#inline_content<?php echo $row->village_id;?>" onclick="edit_village(this.id)">Edit</span></td>
			<td><span id="<?php echo $row->village_id;?>" onclick="delete_villagess(this.id)">Delete</span></td>
			 </tr>
			 
			 <div style='display:none'>
			 
			<div id='inline_content<?php echo $row->village_id;?>' style='padding:10px; background:#fff;'>
			<form action="" method="post" name='process'> 

			<h4 class="village_editpopup">Edit village</h4>

			<div class="col-sm-6 text">
			<div class="form-group">

			<label for="form-first-name" class="sr-only">village</label>
			<input type="text" class="form-control" id="edit_gotra_nm" name="village_name" placeholder="country name" value="<?php echo $row->name;?>" required/>
			<input type="hidden" name="edit_vill_id" value="<?php echo $row->village_id;?>" id="gotra_id">
			</div>
			</div>
			<div class="col-sm-6 text">
			<div class="form-group">
			<label for="form-first-name" class="sr-only">village</label>
			<select name="dist_id" required>
			<option value="">Select district</option>
			<?php
					$this -> db -> select('*');
					$this -> db -> from('district_name');
					$query = $this -> db -> get();
					if ($query->num_rows() > 0)  
					{
					foreach ($query->result() as $row)
					
					{
						$district_id = $row->district_id;
						$district_name = $row->district_name;
						$select ='';
						if($district_ids==$district_id)
						{
							$select='selected';
						}

			?>
			<option value="<?php echo $district_id;?>" <?php echo $select;?>><?php echo $district_name;?></option>
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
