
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
   
    </section>
<?php
$session_data = $this->session->userdata('logged_in');
$current_user_id = $session_data['userid'];
	$this->load->model('comman_function');
	$result = $this->comman_function->user_profile_info($current_user_id);

	$user_photo = $result->user_img;
	

	if(!empty($user_photo))
	{
		$profile_photo = base_url().'assets/ajax/upload/'.$user_photo;
	}
	else
	{
		$profile_photo = base_url().'assets/images/user.png'; 
	}
	

?>
<!-- Main content -->
<div class="container"> 
<div class="row">
<div class="col-sm-8 text">
<div class="form-bottom">
<!-- user create post -->
<div class="creator_post">
<form method="post" action="<?php echo base_url();?>dashboard" enctype='multipart/form-data'>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Post Title</label>
<input type="text" class="form-control posttitle" name="post_title" placeholder="Post title" value="" />
<input type="hidden" name="add_post" value="add">
</div>
</div>
<div class="col-sm-12 text">
<div class="form-group1"> 
<div class="text_box">
<textarea cols="50"  name="text_editor"></textarea></div>
</div>
</div>
<div class="col-sm-12 text">
<div class="form-group1"> 
<input type="file" name="userfile[]"  multiple="multiple">
</div>
</div>
<div class="clear"></div>
<div class="text-center">
<button class="btn update" type="submitted"  name="update">POST</button>
</div>
</form>
</div>
<!-- user get post -->
<div class="user_posts">
<?php
$query = $this->db->query("SELECT * FROM user_post ORDER BY last_update DESC LIMIT 10");
if ($query->num_rows() > 0)
{
	$all_post_ids='';
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
					if($like_ids==$current_user_id)
					{
						$you_like = 'You and ';
						
					}
					else
					{
						$you_like = '';
					}
				
				
			}
		?>
		<div id="<?php echo $post_id; ?>"  align="left" class="message_box" >
		<div id="fb" class="box box-success">
			<div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img alt="User Image" src="<?php echo $users_photo; ?>" class="img-circle">
                <span class="username"><a href="userprofile?userid=<?php echo base64_encode($user_id); ?>"><?php echo $user_name; ?></a></span>
                <span class="description">Posted: <?php echo $posts_date; ?></span>
				<?php
				if($user_id==$current_user_id)
				{ 
				?>
				<div class="dropdown" id="users_action">
				<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">
				<span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
				  <li role="presentation" class="topopup" id="<?php echo $post_id; ?>" onclick="edit_post_popup_open(this.id)" style="padding-bottom: 0px;"><a role="menuitem" tabindex="-1"><i class="fa fa-pencil fa-fw"></i>EDIT</a></li>
				  <li role="presentation" id="<?php echo $post_id;?>" onclick="delete_Post(this.id)"><a role="menuitem" tabindex="-1" href="" ><i class="fa fa-trash-o fa-fw"></i>DELETE</a></li>
				</ul>
				
			  </div>
			  <?php
			  }
			  ?>
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
			<p class="pst_content title" id="ajax_post<?php echo $post_id;?>"><?php echo $post_title; ?></p>
			<?php
			
			if(!empty($post_img))
			{
				$thumb = explode(",",$post_img);
				$no_post = count($thumb);
			//print_r($thumb);
				
			 if($no_post==1)
			 {
				foreach($thumb as $post_image)
				{
				?>
				<img alt="Photo" src="<?php echo base_url(); ?>assets/uploads/thumbs/<?php echo $post_image.'-600x600_thumb.jpg'; ?>" class="img-responsive padss">
			  <?php
				}
			 }
			 elseif($no_post==2)
			 {
				?>
				<ul class="posting">
				<?php
				foreach($thumb as $post_image)
				{
				?>
				<li class="post2"><img alt="Photo" src="<?php echo base_url(); ?>assets/uploads/thumbs/<?php echo $post_image.'-300x300_thumb.jpg'; ?>" class="img-responsive pad"></li>
			  <?php
				}
				?>
			  </ul>
			  <?php
			 }
			 elseif($no_post==3)
			 {
				?>
				<ul class="posting">
				<?php
				foreach($thumb as $post_image)
				{
				?>
				<li class="post3"><img alt="Photo" src="<?php echo base_url(); ?>assets/uploads/thumbs/<?php echo $post_image.'-300x300_thumb.jpg'; ?>" class="img-responsive pad"></li>
			  <?php
				}
			  ?>
			  </ul>
			  <?php
			 }
			 elseif($no_post>=4)
			 {
				?>
				<ul class="posting">
				<?php
				foreach($thumb as $post_image)
				{
				?>
				<li class="post4"><img alt="Photo" src="<?php echo base_url(); ?>assets/uploads/thumbs/<?php echo $post_image.'-150x150_thumb.jpg'; ?>" class="img-responsive pad"></li>
			  <?php
				}
			  ?>
			  </ul>
			  <?php
			 }
			}
			  ?>
			  
			  <div class="clear"></div>
			  <?php
			  if(!empty($post_content))
			  {	
				$contented = nl2br($post_content);
				
				$post_cont = $this->comman_function->ttruncat($contented,300);
			  ?>
			   <p class="post_contented<?php echo $post_id; ?>" style="display:none;"><?php echo $contented; ?></p>
			  
			  <p class="post_cont"><span class="pst_content<?php echo $post_id; ?>"><?php echo $post_cont; ?></span>
			  <?php
				$string_count = strlen($post_content);
				if($string_count>=300)
				{
			  ?>
			  <span id="<?php echo $post_id; ?>" style="color:#3C8DBC; cursor: pointer;" class="count_read<?php echo $post_id; ?>" onclick="read_more(this.id)">More read....</span></p>
			  <?php
				}
			  }
			  else
			  {
			  
				echo ' <p></p>';
			  }
			  ?>
			  <hr>
			  <div class="clear"></div>
			  <span id="user_liked<?php echo $post_id; ?>">
			  <?php echo $active; ?>
			 </span>
			 <?php
				$this -> db -> select('*');
				$this->db->order_by("date","ASC"); 
				$this -> db -> from('user_post_comment');
				$this -> db -> where('post_id', $post_id);
				$query = $this -> db -> get();
				$comment_count = $query -> num_rows();
			?> 
			
              <div class="pull-right text-muted"> <img class="archived" src="<?php echo base_url(); ?>assets/like/like.jpg"> (<?php echo $likes_count; ?>)</span>  | <img class="archived" src="<?php echo base_url(); ?>assets/like/comment.jpg"> (<?php echo $comment_count; ?>)</div>  
            </div>
			<div class="box-footer box-comments">
			<div class="box-like">
			  <span id="like_this<?php echo $post_id; ?>"><?php echo $you_like; ?></span><span class="tooltips"><?php echo $like_count; ?> other<?php
				if ($qury->num_rows() > 0)
				{
					
				?>
				<span class="tooltiptexts tooltip-tops">
				<?php
				foreach ($qury->result() as $rows)
				{
					$like_user_id = $rows->user_id;
					if($like_user_id!=$current_user_id)
					{
						$this->load->model('comman_function');
						$results = $this->comman_function->user_profile_info($like_user_id);
						$likers_name = $results->display_name;
						echo '<p>'.$likers_name.'</p>';
					}
				}
				?>
				</span>
				<?php
					
				}
				?>
				</span> like this.
			</div>
			</div>
            <!-- /.box-body -->
            <div class="box-footer box-comments" style="display: block;">
			<?php
				
				
				foreach ($query->result() as $row)
				{
					$comment_user_id = $row->user_id;
					$user_comment = $row->post_comment;
					$comment_date = strtotime($row->date);
					$comt_date = date('M j, Y H:i A',$comment_date);
					$this->load->model('comman_function');
					$result = $this->comman_function->user_profile_info($comment_user_id);
					$users_names = $result->first_name.' '.$result->last_name;
					$users_thumb = $result->user_img;
					if(!empty($users_thumb))
					{
						$users_photos = base_url().'assets/ajax/upload/'.$users_thumb;
					}
					else
					{
						$users_photos = base_url().'assets/images/user.png'; 
					}
			?>
              <div class="box-comment">
                <!-- User image -->
                <img alt="User Image" src="<?php echo $users_photos; ?>" class="img-circle img-sm" style="margin-top: 5px;">

                <div class="comment-text">
                      <span class="username">
                        <a href="userprofile?userid=<?php echo base64_encode($comment_user_id); ?>"><?php echo $users_names; ?></a>
                        <span class="text-muted pull-right"><?php echo $comt_date; ?></span>
                      </span><!-- /.username -->
                  <?php echo $user_comment; ?>
                </div>
                <!-- /.comment-text -->
              </div>
			  <?php
			  }
			  ?>
			   <div class="demo<?php echo $post_id; ?>"></div>
			     <div class="box-comment">
				
                <!-- User image -->
                <img alt="User Image" src="<?php echo $profile_photo; ?>" class="img-circle img-sm" style="margin-top: 5px;">

                <div class="comment-text">
                <form action="" method="post" id="comment_submit<?php echo $post_id; ?>">
				<input type="hidden" id="comnt_post_id" name="cmnt_post_id" value="<?php echo $post_id; ?>">
				<input type="text" id="<?php echo $post_id; ?>" onclick="cmt_post_id(this.id)" placeholder="Write a Comment..." name="comment" class="post_comments<?php echo $post_id; ?>" required/>
				</form>
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
            </div>
           
            <!-- /.box-footer -->
          </div>
	</div>
	</div>
		
		<?php
	}
}
?>
<div class="all_post_ids all_posts_remove"  id="<?php echo $all_post_ids;?>"></div>
<div id="last_msg_loader"></div>

</div>
</div>
</div>
<div class="col-sm-4 text">
<div class="form-bottom" id="friends_listing">
<h4>Friends List</h4>
<div class="user_friend_list">
<?php
$this -> db -> select('*');
$this -> db -> from('freind_request');
$this -> db -> where('friend_request_id', $current_user_id);
$this -> db -> where('read1', 1);
$queryy = $this -> db -> get();
?>
<ul>
<?php
foreach ($queryy->result() as $row)
{
	$friend_rev_id = $row->request_receive_id;
	$friend_info = $this->comman_function->user_profile_info($friend_rev_id);
	$user_photo = $friend_info->user_img;
	if(!empty($user_photo))
	{
		$profile_photo = base_url().'assets/ajax/upload/'.$user_photo;
	}
	else
	{
		$profile_photo = base_url().'assets/images/user.png'; 
	}
	echo '<li><a id="accepted" href="userprofile?userid='.base64_encode($friend_rev_id).'">
		  <div class="user-block">
			<img alt="User Image" src="'.$profile_photo.'" class="img-circle">
			<span class="username" id="friend_name">'.$friend_info->display_name.'</span>
		  </div></a></li>';
}

$this -> db -> select('*');
$this -> db -> from('freind_request');
$this -> db -> where('request_receive_id', $current_user_id);
$this -> db -> where('read1', 1);
$queryy = $this -> db -> get();
foreach ($queryy->result() as $row)
{
	$friends_rev_id = $row->friend_request_id;
	$user_data = $this->comman_function->user_profile_info($friends_rev_id);
	$users_photo = $user_data->user_img;
	if(!empty($users_photo))
	{
		$profile_photos = base_url().'assets/ajax/upload/'.$users_photo;
	}
	else
	{
		$profile_photos = base_url().'assets/images/user.png'; 
	}
	echo '<li><a id="accepted" href="userprofile?userid='.base64_encode($friends_rev_id).'">
		  <div class="user-block">
			<img alt="User Image" src="'.$profile_photos.'" class="img-circle">
			<span class="username" id="friend_name">'.$user_data->display_name.'</span>
		  </div></a></li>';
}

?>
</ul>
</div>
</div>
</div>
</div>
<div class="demos" id="toPopup" style="display:none;">
<div class="closed"></div>
<div id="popup_content">
<div class="text_box edit_posted">
<input type="text" id="posted_title" class="form-control posttitle" name="post_title" placeholder="Post title" value="" />
</div>
<div class="text_box edit_posted">
<textarea cols="50" rows="6" class="edit_data" name="text_editor"></textarea>
</div>
<div class="text_box edits_posted">
<button class="btn updated" onclick="edit_post()" name="update">UPDATE</button>
</div>
<input type="hidden" class="edit_posted_ids" value="">
</div>
</div>
<div id="backgroundPopup" style="display:none;"></div>


<script type="text/javascript">


// Ajax scroll 
jQuery(document).ready(function(){
		
	function last_msg_funtion()  
	{ 
	   
	   var ID=$(".all_post_ids:last").attr("id");
	   $(".all_posts_remove").removeClass("all_post_ids");
	   //	alert(ID);
		jQuery('#last_msg_loader').html('<img src="<?php echo base_url(); ?>assets/images/ripple2.gif">');
		$.ajax({
		url: "<?php echo base_url(); ?>dashboard/next_post",
		  async: false,
		  type: "POST",
		  data: "posted_ids="+ID,
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



 