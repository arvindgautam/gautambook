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
<h4 class="country-edit">Add country</h4>
<div class="form-bottom login"> 
<div id="add_gotra">
<form action="" method="post" name='process'> 
<div class="form-group">
<label for="form-last-name" class="sr-only"></label>
<input type="text" class="form-control" name="country_id" placeholder="country name" required/>
<input type="hidden" name="state" value="45">
</div>
<div class="clear"></div>
<div class="text-center">
<button class="btn log" type="submit" name="submit">Submit</button>
</div>
</form>
</div>
</div>

<!-- edit country------->



<?php
	$query = $this->db->query('SELECT * FROM country');
	
	if ($query->num_rows() > 0)
	{
		?>
		<table class="gotraname" cellspacing="0" width="100%" border="1">
		<tr>
		<th>S NO.</th>
		<th>country Name</th>
		<th></th>
		<th></th>
		</tr>
		<?php
		$i=1;
		foreach ($query->result() as $row)
		{
	
	  	?>
			<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $row->country_name;?></td>
			<td><span  class="inline" href="#inline_content<?php echo $row->country_id;?>" onclick="edit_country(this.id)">Edit</span></td>
			<td><span id="<?php echo $row->country_id;?>" onclick="delete_country(this.id)">Delete</span></td>
			 </tr>
			 <div style='display:none'>
			<div id='inline_content<?php echo $row->country_id;?>' style='padding:10px; background:#fff;'>
			<form action="" method="post" name='process'> 

			<h4 >Edit Country</h4>


			<div class="form-group">

			<label for="form-first-name" class="sr-only">country</label>
			<input type="text" class="form-control" id="edit_gotra_nm" name="country_name" placeholder="country name" value="<?php echo $row->country_name;?>" required/>
			<input type="hidden" name="edit_country" value="<?php echo $row->country_id;?>" id="gotra_id">
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
</div>

