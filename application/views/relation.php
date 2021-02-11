<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
    </section>


<div class="container">
<div class="row">
<div class="col-sm-8 text">
<div class="form-bottom">
<div id="add_relation">
<form action="<?php echo base_url();?>relations" method="post" >
<div class="col-sm-12 text">
<h3>Relation Info</h3>
</div>
<div class="col-sm-8 text">
<div class="form-group">
<label for="form-first-name" class="sr-only">Relation</label>
<input type="text" class="form-control" name="relation" placeholder="Relation" required/>
<input type="hidden" name="run_codes" value="add_relation">
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
<!-- edit relation------->
<div id="edit_relation" style="display:none">
<form action="<?php echo base_url();?>relations" method="post" >
<div class="col-sm-12 text">
<h3>Edit Relation Info</h3>
</div>
<div class="col-sm-8 text">
<div class="form-group">
<label for="form-first-name" class="sr-only">Relation</label>
<input type="text" class="form-control" id="edit_relation_nm" name="relation_name" placeholder="Relation" required/>
<input type="hidden" name="run_codes" value="" id="relation_id">
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
	$query = $this->db->query('SELECT * FROM relationship');
	
	if ($query->num_rows() > 0)
	{
		?>
		<table class="gotraname" cellspacing="0" width="100%" border="1">
		<tr>
		<th>S.NO</th>
		<th>Relation Name</th>
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
			<td><?php echo $row->relation;?></td>
			<td><span id="<?php echo $row->id;?>,<?php echo $row->relation;?>" onclick="edit_relation(this.id)">Edit</span></td>
			<td><span id="<?php echo $row->id;?>" onclick="delete_relation(this.id)">Delete</span></td>
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

</div>
</div>
-->
</div>
</div>
</div>