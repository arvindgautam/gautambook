<?php
			$album_id=base64_decode($_GET['album_id']);
			$album_ids=($_GET['album_id']);
			$this -> db -> select('*');
			$this -> db -> from('photo_album');
			$this -> db -> where('id', $album_id);
			$query = $this -> db -> get();
			foreach ($query->result() as $row)
			{
				
				$album_title = $row ->album_title;
				$description = $row ->description;
			}


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

<div class="col-sm-11 text">

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

<div class="form-bottom">
<?php
if($this->session->userdata('logged_in'))
 {
?>

<h5><a href="addphoto?album_id=<?php echo $album_ids; ?>"><img src="<?php echo base_url(); ?>assets/images/plus-sign.png" style="width: 32px; height: 32px;"/></a> Add post in this album</h5>
<div class="album name"><h3><?php echo $album_title;?></h3></div> 
<?php
 }
 ?>
          <!-- Box Comment -->
		    
          <div id="album-view" class="box box-widget">
		 
            <div class="box-footer box-comments">
			<div class="user_posts">
	<?php  
		
	$all_post_ids='';	
	$query = $this->db->query("SELECT * FROM user_post where album_id=$album_id ORDER BY last_update DESC LIMIT 12");
		if ($query->num_rows() > 0)  
		{
			foreach ($query->result() as $row)
			{
				$post_id = $row->id;
				$all_post_ids .=$post_id.",";
				$user_id = $row->user_id;
				$this->load->model('comman_function');
				$results = $this->comman_function->user_profile_info($user_id);
				$user_thumb = $results->user_img;
				$user_name = $results->first_name.' '.$results->last_name;
				$post_title = $row->post_title;
				$post_content = $row->post_conetnt;
				$post_img = $row->post_img_gallery;
				$post_date = strtotime($row->post_date);
				$posts_date = date("F Y", $post_date);
				if(!empty($user_thumb))
				{
					$users_photo = base_url().'assets/ajax/upload/'.$user_thumb;
				}
				else
				{
					$users_photo = base_url().'assets/images/user.png'; 
				}
				
					$session_data = $this->session->userdata('logged_in');
					$current_user_id = $session_data['userid'];
					$this -> db -> select('*');
					$this -> db -> from('user_post_like');
					$this -> db -> where('user_id', $current_user_id);
					$this -> db -> where('post_id', $post_id);
					$query = $this -> db -> get();
					if ($query -> num_rows() == 1)
					{
						
						$active = '<button class="btn-default btn-xs active" id="'.$post_id.'" onclick="posts_unlike(this.id)" type="button"><i class="fa fa-thumbs-o-down"></i>Like</button>';
						
					}
					else
					{
						
						$active = '<button class="btn-default btn-xs" id="'.$post_id.'" onclick="posts_like(this.id)" type="button"><i class="fa fa-thumbs-o-up"></i>Like</button>';
						
					}
					$this -> db -> select('*');
					$this -> db -> from('user_post_like');
					$this -> db -> where('post_id', $post_id);
					$qury = $this -> db -> get();
					
					$likes_count = $qury -> num_rows();
					if($likes_count==0)
					{
						$like_count = $likes_count;
						$you_like = '';
					}
					else
					{
							$like_count = $likes_count-1;
							$qry = $qury->row();
							$like_ids = $qry->user_id;
							if($like_ids==$user_id)
							{
								$you_like = 'You and ';
								
							}
							else
							{
								$you_like = '';
							}
						
						
					}
				$this -> db -> select('*');
				$this -> db -> from('user_post_comment');
				$this -> db -> where('post_id', $post_id);
				$query = $this -> db -> get();
				$count_comment = $query->num_rows();
				if($this->session->userdata('logged_in'))
				{
					$class= 'col-sm-4 text albums item-isotope';
					
				}
				else
				{
					$class='col-sm-4 text album item-isotope';
					
				}
				?>
				<div id="<?php echo $post_id; ?>"  align="left" class="message_box" >
				<input type="hidden" class="search_user_id" value="<?php echo $album_id; ?>">
				<div class="<?php echo $class; ?>">
				<div id="fb" class="box box-success ">  
				<div class="box box-widget">
				<div class="box-header with-border">
				<div class="user-block" id="user-bloc-k">
                <img alt="User Image" src="<?php echo $users_photo; ?>" class="img-circle">
                <span class="username"><a href="userprofile?userid=<?php echo base64_encode($user_id); ?>"><?php echo $user_name; ?></a></span>
                <span class="description">Posted Date - <?php echo $posts_date; ?></span>
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
			<div class="album-post-title">
			<p class="pst_content title"><?php echo $post_title; ?></p>
			</div>
			<?php
			
			if(!empty($post_img))
			{
				$thumb = explode(",",$post_img);
				$no_post = count($thumb);
			//print_r($thumb);
		
			
			
			
				foreach($thumb as $post_image)
				{
				?>
				<div class="topopup" id="<?php echo $post_id?>" onclick="popup_open(this.id);"><img  alt="Photo" src="<?php echo base_url(); ?>assets/uploads/thumbs/<?php echo $post_image.'-300x300_thumb.jpg'; ?>" class="img-responsive padss popupimage"></div>
			  <?php
				}
				
			}
			  ?>
			  
			   <?php 
				if($this->session->userdata('logged_in'))
				{
				?> 
			
			  <span id="user_liked<?php echo $post_id; ?>" class="like-btn<?php echo $post_id;?>">
			  <?php echo $active; ?>
			 </span>
				<?php
				}
				?>
              
              <div class="pull-right text-muted"><span title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title=""><img class="archived" src="<?php echo base_url(); ?>assets/like/like.jpg">(<?php echo $likes_count; ?>)</span>|<img class="archived" src="<?php echo base_url(); ?>assets/like/comment.jpg">
			  (<?php echo $count_comment;?>)</div>
			
            </div>
			<div class="box-footer box-comments">
			<div class="box-like">
			 
			
			</div>
            <!-- /.box-body -->
           
           
            <!-- /.box-footer -->
          </div>
          </div>
          </div>
		  </div>
		 
		  <!---------album popup----------->
	
			
		  <!----/ . end of album popup----->
		

		
		<?php
	}
}
?>

<div class="all_post_ids all_posts_remove"  id="<?php echo $all_post_ids;?>"></div>
<div id="last_msg_loader"></div>


		</div>
	</div>
	</div>
	
          
          </div>
          <!-- /.box -->
        </div>
        </div>
        </div>
<div class="demos" id="toPopup" style="display:none;">
<div class="closed"></div>
<div id="popup_content">


</div>
</div>
<div id="backgroundPopup" style="display:none;"></div>
		
<script>
// Ajax scroll 
jQuery(document).ready(function(){
		
	function last_msg_funtion()  
	{ 
	   
	   var ID=$(".all_post_ids:last").attr("id");
	   $(".all_posts_remove").removeClass("all_post_ids");
	   var user_id = $(".search_user_id").val();
		var post_data = ID+'/'+user_id;
		jQuery('#last_msg_loader').html('<img src="<?php echo base_url(); ?>assets/images/ripple2.gif">');
		$.ajax({
		  url: "<?php echo base_url(); ?>viewalbum/more_album_load",
		  async: false,
		  type: "POST",
		  data: "posted_ids="+post_data,
		  dataType: "html",
		  success: function(data) {
		 jQuery(".message_box:last").append(data);
		 $('#last_msg_loader').empty();
		 
      }
    });
	};  
	
	jQuery(window).scroll(function(){
		if  ( window.screen.availHeight >jQuery(document).height() - jQuery(window).scrollTop()){
		
		   last_msg_funtion();
		}
	}); 
	
});




</script>
