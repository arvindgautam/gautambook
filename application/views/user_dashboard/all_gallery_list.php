 <!-- Content Wrapper. Contains page content -->
 


<?php

 if($this->session->userdata('logged_in'))
 {
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
   
    </section>

<!-- Main content -->

<div class="container"> 
<div class="row">


<div class="col-sm-12 text">
<?php
 }
 else
 {
 ?>
 <div class="container1" style="min-height:470px;">
<div class="row">
<?php
$this->load->view('sidebar');
?>
<div class="col-sm-9 text" id="text-tops">
<?php
 }
?>
<div class="form-bottom gallerylist">
<div class="box-footer box-comments">
<!-- user gallery list -->
<h4>Albums</h4>

<?php
		

	$this->db->select('*');
    $this->db->from('photo_album');
    $query=$this->db->get();
if ($query->num_rows() > 0)
{
	
	foreach ($query->result() as $row)
	{
		$photo_album_id = base64_encode($row->id);
		$title = $row->album_title;
		$description = $row->description;
		 $this->load->model('comman_function');
		
			if(!empty($row->album_img)) 
			{
				$images = '<img class="album-images " alt="User Image" src="'.base_url().'assets/albums/albumthumbs/'.$row->album_img.'-300x300_thumb.jpg">';
				
				$full_img = base_url().'assets/albums/albumthumbs/'.$row->album_img.'-600x600_thumb.jpg';
				
			}
			else
			{
				
				$images = '<img class="album-images " alt="User Image"  src="'.base_url().'assets/images/Picture-icon.jpg">';
				
			}
		$this->db->select('*');
		$this->db->from('user_post');
		$this -> db -> where('album_id', $row->id);
		$query = $this->db->get();
		$rows = $query ->num_rows();
		?>
		
		
		<div class="col-sm-4 text">
		<div class="user_posts">
		<div id="fb" class="box box-success gallerycontent">
			<div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <?php echo $images;?>
                <span class="usernames"><a href="viewalbum?album_id=<?php echo $photo_album_id;?>"><?php echo $title; ?></a></span>
                
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button data-widget="collapse" class="btn btn-box-tool plus" type="button"><i class="fa fa-minus"></i>
                </button>
                
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
			
            <div class="box-body" style="display: block;">
			<a href="viewalbum?album_id=<?php echo $photo_album_id;?>"><?php echo $images;?></a>
			
			  <div class="clear"></div>
			  
			   <p class="post_contented"><?php echo $description; ?></p>
			  
			  
			  <div class="clear"></div>
			  
			<div class="pull-left text-muted">
			<?php
			if($this->session->userdata('logged_in'))
			{
			
			?>
			
			<a href="addphoto?album_id=<?php echo $photo_album_id; ?>"><img src="<?php echo base_url(); ?>assets/images/plus-sign.png" style="width: 32px; height: 32px;"/>
			<?php
			}
			?>
			</a>  <a href="viewalbum?album_id=<?php echo $photo_album_id;?>"> <img src="<?php echo base_url(); ?>assets/images/profile.png" style="width: 32px; height: 32px;"/></a></div>

			<div id="user_liked" class="pull-right text-muted num_post">
			<a href="viewalbum?album_id=<?php echo $photo_album_id;?>">Total Post (<?php echo $rows;?>)</a>
		   </div>			
            </div>
			
            <!-- /.box-body -->
            
           
		  
            <!-- /.box-footer -->
          </div>
		</div>
		</div>
	</div>
	
<?php

	}

}
?>
<div class="clear">
</div>	
</div>  



</div>
</div>
</div>
