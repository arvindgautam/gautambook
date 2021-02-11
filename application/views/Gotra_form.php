<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
    </section>


<div class="container">
<div class="row">
<div class="col-sm-8 text">
<div class="form-bottom">
<div id="add_gotra">
<form action="<?php echo base_url();?>gotra" method="post" >
<div class="col-sm-12 text">
<h3>Gotra Info</h3>
</div>
<div class="col-sm-8 text">
<div class="form-group">
<label for="form-first-name" class="sr-only">Gotra</label>
<input type="text" class="form-control" name="gotra" placeholder="Gotra" required/>
<input type="hidden" name="run_codes" value="add_gotra">
</div>
</div>
<div class="clear"></div>
<div class="col-sm-8 text">
<div class="text-center">
<button class="btn" type="submit"  name="update">Submit!</button>
</div>
</div>
</form>
</div>
<!-- edit gotra------->
<div id="edit_gotra" style="display:none">
<form action="<?php echo base_url();?>gotra" method="post" >
<div class="col-sm-12 text">
<h3>Edit Gotra Info</h3>
</div>
<div class="col-sm-8 text">
<div class="form-group">
<label for="form-first-name" class="sr-only">Gotra</label>
<input type="text" class="form-control" id="edit_gotra_nm"name="edit_gotra" placeholder="Gotra" required/>
<input type="hidden" name="run_codes" value="" id="gotra_id">
</div>
</div>
<div class="clear"></div>
<div class="col-sm-8 text">
<div class="text-center">
<button class="btn" type="submit"  name="update">Update!</button>
</div>
</div>
</form>
</div>
</div>
<div class="gotra-list">
<div class="form-bottom">

<?php
	$query = $this->db->query('SELECT * FROM user_gotra');
	
	if ($query->num_rows() > 0)
	{
		?>
		<table class="gotraname" cellspacing="0" width="100%" border="1">
		<tr>
		<th>S NO.</th>
		<th>Gotra Name</th>
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
			<td><?php echo $row->gotra_name;?></td>
			<td><span id="<?php echo $row->id;?>,<?php echo $row->gotra_name;?>" onclick="edit_gotra(this.id)">Edit</span></td>
			<td><span id="<?php echo $row->id;?>" onclick="delete_gotra(this.id)">Delete</span></td>
			 </tr>
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
<!--<div class="col-sm-4 form-box" id="logins">
<?php
	
	//$this->load->view('login');  
?>
<div class="form-bottom">
-->

</div>
</div>

</div>
</div>
</div>