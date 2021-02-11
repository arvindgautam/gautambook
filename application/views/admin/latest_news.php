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
<h4 class="country-edit">Add News</h4>
<div class="form-bottom login">  
<div id="add_gotra">
<form action="" method="post" name='process'> 
<div class="form-group">
<label for="form-last-name" class="sr-only"></label>
<input type="text" class="form-control" name="latest_news" placeholder="News Title">
<input type="hidden" name="news" value="45">
</div>
<div class="form-group">
<label for="form-last-name" class="sr-only"></label>
<textarea  type="text" class="form-control new-area" id="edit_gotra_nm" name="description" placeholder="News Description"  required/></textarea>
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
	$query = $this->db->query('SELECT * FROM latest_news');
	
	if ($query->num_rows() > 0)
	{
		?>
		<table class="gotraname" cellspacing="0" width="100%" border="1">
		<tr>
		<th>S NO.</th>
		<th>News Title</th>
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
			<td><?php echo $row->news_title;?></td>
			<td><span  class="inline" href="#inline_content<?php echo $row->id;?>" onclick="edit_country(this.id)">Edit</span></td>
			<td><span id="<?php echo $row->id;?>" onclick="delete_new(this.id)">Delete</span></td>
			 </tr>
			 <div style='display:none'>
			<div id='inline_content<?php echo $row->id;?>' style='padding:10px; background:#fff;'>
			<form action="" method="post" name='process'> 

			<h4 >Edit Country</h4>


			<div class="form-group">

			<label for="form-first-name" class="sr-only">Latest</label>
			<input type="text" class="form-control" id="edit_gotra_nm" name="latest_news" placeholder="country name" value="<?php echo $row->news_title;?>">
			
			<input type="hidden" name="news_id" value="<?php echo $row->id;?>" id="gotra_id">
			</div>
			<div class="form-group">
			<label for="form-first-name" class="sr-only">Latest</label>
			<textarea  type="text" class="form-control new-area" id="edit_gotra_nm" name="description" placeholder="country name"  required/><?php echo $row->news_description;?></textarea>
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

