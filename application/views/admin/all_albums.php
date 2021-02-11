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
<h4>Albums</h4>

<?php
		

	$this->db->select('*');
    $this->db->from('photo_album');
    $query=$this->db->get();
if ($query->num_rows() > 0)
{
	?>
	<div class="form-bottom" style="padding: 0px;">
		<table class="user_info" cellspacing="0" width="94%" border="1">
		<thead>
		<tr >
		<th>S/N</th>
		<th>Picture </th>
		<th>Name</th>
		<th>Description</th>
		<th>Total posts</th>
		
		<th></th>
		<th></th>
		</thead>
		</tr>
	
	
	<?php 
	$i=1;
	foreach ($query->result() as $row)
	{
		$photo_album_id = base64_encode($row->id);
		$title = $row->album_title;
 
		$description = nl2br($row->description);
		$description1 = $row->description;
		 $this->load->model('comman_function');
		$short_des = $this->comman_function->ttruncat($description,40);
		$images = '';
			$full_img = '';
			if(!empty($row->album_img))
			{
				$images = '<img class="archived" src="'.base_url().'assets/albums/albumthumbs/'.$row->album_img.'-90x90_thumb.jpg">';
				
				$full_img = base_url().'assets/albums/albumthumbs/'.$row->album_img.'-600x600_thumb.jpg';
				
			}
		$this->db->select('*');
		$this->db->from('user_post');
		$this -> db -> where('album_id', $row->id);
		$query = $this->db->get();
		$count_post = $query ->num_rows();
		?>
		<tr>
		<td><?php echo $i;?></td>
		<td><?php echo $images; ?></td>
		<td><?php echo $title; ?></td>
		<td><?php echo $description;?></td> 
		
		<td><?php echo $count_post;?></td>
		
		<td><span id="<?php echo $row->id;?>" onclick="delete_album(this.id)"><img src="<?php echo base_url(); ?>assets/images/deleteimage.png" /></span></td>
		<td>  <span  class="inline" href="#inline_content<?php echo $row->id;?>" onclick="edit_member_details(this.id)"><img   src="<?php echo base_url(); ?>assets/images/Edit-icon.png" /></span></td> 
		</tr>
		<div style='display:none'>
		<div id='inline_content<?php echo $row->id;?>' style='padding:10px; background:#fff;'>
		<form method="post" action="" enctype='multipart/form-data'>
		<div class="col-sm-6 text">
		<div class="form-group">
		<label for="form-last-name" class="sr-only">album Title</label>
		<input type="text" class="form-control posttitle" name="album_title" placeholder="album Title" value="<?php echo $title; ?>" required/>
		<input type="hidden" name="add_album" value="<?php echo $row->id;?>">
		
		</div>
		</div>
		<div class="col-sm-12 text">
		<div class="form-group1"> 
		<div class="text_box">
		<textarea cols="50" id="area1" name="text_editors" ><?php echo $description1;?></textarea></div>
		</div>
		</div>
		<div class="col-sm-12 text">
		<div class="form-group1"> 
		<input type="file" name="userfile[]"  multiple="multiple">
		</div>
		</div>
		<div class="clear"></div>
		<div class="text-center">
		<button class="btn update"  type="submitted"  name="update">Update Album</button>
		</div>
		</form>
		</div> 
		</div>
		    
		
		
	



<?php
$i++;

	}
	?>
	</table>
	</div>
	<?php
}

?>	

<div class="clear">
</div>
</div>
</div>
</div>
<div class="col-sm-4 text">

</div>
</div>
		
