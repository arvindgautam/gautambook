<?php
	$user_id = base64_decode($_GET['userid']);
	$user_idss = base64_decode($_GET['userid']);
	
	$user_ids = $_GET['userid'];
	
	$data = $this->comman_function->user_profile_info($user_id);
	$from_email = $data->user_email;
	$disp_name = $data->display_name;
	$account_creater_id = $data->account_creater_id;
	if($account_creater_id==0)
	{
		$ids = $user_id;
	}
	else
	{
		$ids = $account_creater_id; 
	}
	
	
	$profession = $data->profession;
	$user_edu = $data->education;
	$user_cur_vill = $data->current_vill_name;
	$current_country = $data->current_country;
	$current_dist = $data->current_dist;
	$current_state = $data->current_state;
	$get_reg_date = strtotime($data->user_registered);
	$reg_date = date(" jS M Y", $get_reg_date);
	
	$perma_vill_name = $data->perma_vill_name;
	$perma_country = $data->perma_country;
	$perma_dist = $data->perma_dist;
	$perma_state = $data->perma_state;
	$user_photo = $data->user_img;
	$user_cover_photo = $data->cover_img;
	$about_us = $data->about_us;
	

	if(!empty($user_photo))
	{
		$profile_photo = base_url().'assets/ajax/upload/'.$user_photo;
	}
	else
	{
		$profile_photo = base_url().'assets/images/user.png'; 
	}
	
	if(!empty($user_cover_photo))
	{
		$profile_cover_img = base_url().'assets/ajax/cover_image/'.$user_cover_photo;
	}
	else
	{
		$profile_cover_img = base_url().'assets/images/Chrysanthemum.jpg'; 
	}
	
	
?>
<div class="content-wrapper">

<div class="container">
<div class="row">
   <div id="Profile-l" class="col-md-10 text">
   <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-black" style="background: url('<?php echo $profile_cover_img; ?>') center center;">			
              <div class="user-block">
                <img alt="User Image" src="<?php echo $profile_photo; ?>" class="img-circle">
                <span class="username userprofile"><a href="#"><?php echo $disp_name;?></a></span>
                <span class="description userprofile">Join  -<?php echo $reg_date;?></span>
              </div> 
				<?php
				if($this->session->userdata('logged_in'))
				{
					$session_data = $this->session->userdata('logged_in');
					$current_user_id = $session_data['userid'];
					if($current_user_id!=$user_id)
					{
						$this -> db -> select('*');
						$this -> db -> from('freind_request');
						$this -> db -> where('friend_request_id', $current_user_id);
						$this -> db -> where('request_receive_id', $user_id);
						$query = $this -> db -> get();
						if ($query -> num_rows() == 1)
						{
							$qry = $query->row(); 
							$req_accpt = $qry->read1;
							if($req_accpt==1)
							{
							?>
								<div class="friend_req" id="unfriend_req">
								<span class="req" id="<?php echo $user_id; ?>" onclick="send_friend_req_cancel(this.id)"><i class="fa fa-user"></i><i class="fa fa-minus"></i>Unfriend<span id="imgs_load" style="display:none;"><img src="<?php echo base_url(); ?>assets/images/LOOn0JtHNzb.gif" style="margin-left: 8px; margin-right: -5px;"></span></span>  
								</div>
							<?php
							
							}
							else
							{
								?>
								<div class="friend_req">
								<span class="req"><i class="fa fa-user"></i><i class="fa fa-minus"></i>Friend Request Sent</span>  
								</div>
								<?php
							}
						}
						else
						{
							$this -> db -> select('*');
							$this -> db -> from('freind_request');
							$this -> db -> where('friend_request_id', $user_id);
							$this -> db -> where('request_receive_id', $current_user_id);
							$query = $this -> db -> get();
							if ($query -> num_rows() == 1)
							{
								$qery = $query->row(); 
								$req_accpted = $qery->read1;
								if($req_accpted==1)
								{
									?>
								<div class="friend_req" id="unfriend_req">
								<span class="req" id="<?php echo $user_id; ?>" onclick="send_friend_req_cancel(this.id)"><i class="fa fa-user"></i><i class="fa fa-minus"></i>Unfriend<span id="imgs_load" style="display:none;"><img src="<?php echo base_url(); ?>assets/images/LOOn0JtHNzb.gif" style="margin-left: 8px; margin-right: -5px;"></span></span>  
								</div>
							<?php
								}
								else
								{
							?>	
								<div class="friend_req" id="request_sent">
								<span class="req" id="<?php echo $user_id; ?>" onclick="accept_friend_req(this.id)"><i class="fa fa-user"></i><i class="fa fa-plus"></i>Accept Request<span id="imgs_load" style="display:none;"><img src="<?php echo base_url(); ?>assets/images/LOOn0JtHNzb.gif" style="margin-left: 8px; margin-right: -5px;"></span></span>  
								</div>
							<?php
							}
							}
							else
							{
					?>	
							<div class="friend_req" id="request_sent">
							<span class="req" id="<?php echo $user_id; ?>" onclick="send_friend_req(this.id)"><i class="fa fa-user"></i><i class="fa fa-plus"></i>Add Friend<span id="imgs_load" style="display:none;"><img src="<?php echo base_url(); ?>assets/images/LOOn0JtHNzb.gif"style="margin-left: 8px; margin-right: -5px;"></span></span>  
							</div>
					<?php
							}
						} 
					}
				}
				?>
            </div> 
			</div>          
            
              <div class="containe-r">
  
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Timeline</a></li>
    <li><a data-toggle="tab" href="#menu2">About</a></li>
    <li><a data-toggle="tab" href="#menu3">Photos</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <div class="row">	  
      <div class="col-md-4">
	  <div class="tab-conten-t">
	    <div class="box-footer box-comments">
        <div class="fa-hover"><i class="fa fa-suitcase"></i><p><b>Profession:</b> <?php echo $profession;?></p></div> 
		<div class="fa-hover"><i class="fa fa-mortar-board"></i> <p><b>Education:</b> <?php echo $user_edu; ?></p></div>
		<div class="fa-hover"><i class="fa fa-home"></i><p><b>Lives in:</b> <?php echo $user_cur_vill?> <?php echo $current_dist;?> <?php echo $current_state;?>(<?php echo $current_country;?>)</p></div>	
		<div class="fa-hover"><i class="fa fa-map-marker"></i><p><b>Mool Nivasi:</b> <?php echo $perma_vill_name;?> <?php echo $perma_dist;?> <?php echo $perma_state;?> (<?php echo $perma_country;?>)</p></div>		
        </div>
		
<div id="pading" class="box-header with-border">
 		<?php
		    $this->db->select('*');
			$this->db->from('user_info');
			$this->db->where('account_creater_id', $user_id);
			$this -> db -> limit(10);
			$query=$this->db->get();
			
		if ($query->num_rows() > 0)  
		{
		?>
		<h3 class="galleryh3">Family Members</h3>
		<?php
			foreach ($query->result() as $rows)
			
			{
				$user_f_nm = $rows->first_name;
				$account_creater_id = $rows->account_creater_id;
				$user_l_nm = $rows->last_name;
				$user_img = $rows->user_img;
				$display_nm = $user_f_nm.' '.$user_l_nm;
				$relation_id = $rows->relation;
				$relation = $this->comman_function->get_relation($relation_id);
				$account_id = $rows->user_id;
				if(!empty($user_img))
				{
					$users_photos = base_url().'assets/ajax/upload/'.$user_img;
				}
				else
				{
					$users_photos = base_url().'assets/images/user.png'; 
				}
				
				?>
				 <div class="user-block" id="user-bloc-k">
                <img alt="User Image" src="<?php echo $users_photos; ?>" class="img-circle">
                <span class="username"><a href="userprofile?userid=<?php echo base64_encode($account_id); ?>"><?php echo $display_nm; ?></a></span>
                <span class="description">Relation - <?php echo $relation; ?></span>
              </div>
			  
				<?php
			}
		
		}
		else
		{
			$get_info = $this->comman_function->user_profile_info($user_id);
			$family_creator_ids = $get_info->account_creater_id;
			$this->db->select('*');
			$this->db->from('user_info');
			$this->db->where('account_creater_id', $family_creator_ids);
			$this -> db -> limit(10);
			$query=$this->db->get();
			if ($query->num_rows() > 0)  
			{
			?>
			<h3 class="galleryh3">Family Members</h3>
			<?php
			foreach ($query->result() as $rows)
			
			{
				$create_ids = $rows->account_creater_id;
				if(!empty($create_ids))
				{
					$user_f_nm = $rows->first_name;
					$user_l_nm = $rows->last_name;
					$user_img = $rows->user_img;
					$display_nm = $user_f_nm.' '.$user_l_nm;
					$relation_id = $rows->relation;
					$relation = $this->comman_function->get_relation($relation_id);
					$account_id = $rows->user_id;
					if(!empty($user_img))
					{
						$users_photos = base_url().'assets/ajax/upload/'.$user_img;
					}
					else
					{
						$users_photos = base_url().'assets/images/user.png'; 
					}
					
					?>
					 <div class="user-block" id="user-bloc-k">
					<img alt="User Image" src="<?php echo $users_photos; ?>" class="img-circle">
					<span class="username"><a href="userprofile?userid=<?php echo base64_encode($account_id); ?>"><?php echo $display_nm; ?></a></span>
					<span class="description">Relation - <?php echo $relation; ?></span>
				  </div>
					<?php
						
				}
			  }
			
			}
			
		
		
			
		}
		?>	
		<div class="viewall">
				<a href="Familymember?userid=<?php echo base64_encode($ids);?>">view all</a>
				</div>
					
	
		</div>		
		<div class="image-gallery">
		<?php
		    $this->db->select('*');
			$this->db->order_by("post_date","desc");
			$this->db->from('user_post');
			$this->db->where('user_id', $user_id);
			$query=$this->db->get();
		if ($query->num_rows() > 0)  
		{
			?>
			<h3 class="galleryh3">Gallery</h3>
				
				<ul>
			
			<?php
			$i=1;
			foreach ($query->result() as $row)
			
			{
				$post_img = $row->post_img_gallery;
				if(!empty($post_img))
				{
				
				
					$thumb = explode(",",$post_img);
					
					foreach($thumb as $post_image)
					{
					if($i<=12)
					{
				?>
				<li><img class="allimage" src="<?php echo base_url(); ?>assets/uploads/thumbs/<?php echo $post_image.'-90x90_thumb.jpg';?>" ></li> 
				
				<?php
					}
					$i++;
					}
				
				}
			}
		
				?>
				</ul>
				<?php
		}
		
	?>
		</div>
		<div class="clear"></div>
		
		
		
			<div class="image-gallery">
		<?php
		    $this->db->select('*');
			$this->db->from('user_achievement');
			$this->db->where('user_id', $user_id);
			$query=$this->db->get();
		if ($query->num_rows() > 0)  
		{
			?>
			<h3 class="galleryh3"> Achievement </h3>
				
				<ul>
			
			<?php
			$i=1;
			foreach ($query->result() as $row)
			
			{
				$post_img = $row->achiv_img;
				if(!empty($post_img))
				{
				
				
					$thumb = explode(",",$post_img);
					
					foreach($thumb as $post_image)
					{
					if($i<=12)
					{
				?>
				<li><img class="allimage" src="<?php echo base_url(); ?>assets/achievement-image/achievement-thumb/<?php echo $post_image.'-90x90_thumb.jpg';?>" ></li> 
				
				<?php
					}
					$i++;
					}
				
				}
			}
		
				?>
				</ul>
				<?php
		}
		
	?>
		</div>
		<div class="clear"></div>
		<div class="about-your">
		<h3 class="galleryh3">About</h3>
		<p><?php echo $about_us;?></p>
		
		
		</div>
		
		
	  </div>
	  </div>
      <div class="col-md-8">
          <!-- Box Comment -->
          <div class="box box-widget">
          
            <div class="box-footer box-comments">
			<div class="user_posts">
	<?php
		$all_post_ids='';	
		$query = $this->db->query("SELECT * FROM user_post where user_id=$user_id ORDER BY last_update DESC LIMIT 10");	
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
					$this -> db -> select('*');
					$this -> db -> from('user_post_like');
					$this -> db -> where('user_id', $user_id);
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
				?>
				<div id="<?php echo $post_id; ?>"  align="left" class="message_box" >
					<div id="fb" class="box box-success">
					<input type="hidden" class="search_user_id" value="<?php echo $user_id; ?>">
					<div class="box box-widget">
				<div class="box-header with-border">
				<div class="user-block" id="user-bloc-k">
                <img alt="User Image" src="<?php echo $users_photo; ?>" class="img-circle">
                <span class="username"><a href="userprofile?userid=<?php echo base64_encode($user_id); ?>"><?php echo $user_name; ?></a></span>
                <span class="description">Posted Date - <?php echo $posts_date; ?></span>
				
				<?php
				$session_data = $this->session->userdata('logged_in');
				$current_user_id = $session_data['userid'];
				if($user_id==$current_user_id)
				{ 
				?>
				<div class="dropdown userprofile" id="users_action">
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
			<p class="pst_content title"><?php echo $post_title; ?></p>
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
			   <hr>
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
				echo '<p></p>';
			  }
			  ?>
			  <div class="clear"></div>
			   <?php 
				if($this->session->userdata('logged_in'))
				{
				?>
			  <span id="user_liked<?php echo $post_id; ?>">
			  <?php echo $active; ?>
			 </span>
				<?php
				}
				?>
              
              <div class="pull-right text-muted"><span title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title=""><img class="archived" src="<?php echo base_url(); ?>assets/like/like.jpg">(<?php echo $likes_count; ?>)</span>|<img class="archived" src="<?php echo base_url(); ?>assets/like/comment.jpg">(<?php echo $count_comment;?>)</div> 
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
					if($like_user_id!=$user_id)
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
			   <?php 
				 if($this->session->userdata('logged_in'))
				{
					$session_data = $this->session->userdata('logged_in');
					$current_user_id = $session_data['userid'];
					
					$result = $this->comman_function->user_profile_info($current_user_id);

					$user_photo = $result->user_img;
					

					if(!empty($user_photo))
					{
						$comment_user_pic = base_url().'assets/ajax/upload/'.$user_photo;
					}
					else
					{
						$comment_user_pic = base_url().'assets/images/user.png'; 
					}
				?>
			     <div class="box-comment">
				
                <!-- User image -->
                <img alt="User Image" src="<?php echo $comment_user_pic; ?>" class="img-circle img-sm" style="margin-top: 5px;">
				
                <div class="comment-text">
                <form action="" method="post" id="comment_submit<?php echo $post_id; ?>">
				<input type="hidden" id="comnt_post_id" name="cmnt_post_id" value="<?php echo $post_id; ?>">
				<input type="text" id="<?php echo $post_id; ?>" onclick="cmt_post_id(this.id)" placeholder="Write a Comment..." name="comment" class="post_comments<?php echo $post_id; ?>" required/>
				</form>
                </div>
				
                <!-- /.comment-text -->
              </div>
			  <?php
				}
				?>
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
          <!-- /.box -->
        </div>		
		
		</div>
    </div>
    <div id="menu2" class="tab-pane fade">
    <div class="row aboutuss">
	<div class="col-md-12 profiled">
        
<h4 class="abo">Basic User Info</h4>

<?php
		$this->db->select('*');
		$this->db->from('users as us');
		$this->db->join('user_info as uf', 'us.id = uf.user_id');
		$this -> db -> where('us.id', $user_id);
		$query = $this->db->get();
	 
		$query -> num_rows();
	   
		$qry = $query->row();
		$get_reg_date = strtotime($qry->user_registered);
		$reg_date = date(" jS F Y", $get_reg_date);
		date("jS F Y");
		$emails='';
		$phone_no='';
		$show_phone_no = $qry->show_phone_no;
		$show_email_id = $qry->show_email_id;
		
		//////get gotra name by id /////////
		
		$gotra_id = $qry->gotra;
		if (is_numeric($gotra_id))
		{
		$this->db->select('*');
		$this->db->from('user_gotra');
		$this->db->where('id',$gotra_id);
		
		$query = $this->db->get();
		$query -> num_rows();
		$qrys = $query->row();
		$gotra_names = $qrys->gotra_name;
		}
		
		else
		{
			$gotra_names = '';
		}
		

		
		
		
		if($show_email_id=='show')
		{
			$style= '';
			
		}
		elseif($show_email_id==$emails)
		{
			$style='display:none';
		}
		if($show_phone_no=='show')
		{
			$style= '';
			
		}
		elseif($show_phone_no==$phone_no)
		{
			$style='display:none';
		}
		
	?>
	<div class="col-sm-4 profiled ">
	<h4>Name:</h4>
	</div>  
	<div class="col-sm-8 profiled">
	<p><?php echo $qry->display_name; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Father Name:</h4>
	</div>
	<div class="col-sm-8 profiled">
	<p><?php echo $qry->father_name; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Gotra:</h4>
	</div>
	<div class="col-sm-8 profiled">
	<p><?php echo $gotra_names; ?></p>
	</div>
	<div class="clear"></div>
	
	
	<div class="displayPhone" style="<?php echo $style;?>">
	<div class="col-sm-4 profiled">
	<h4>Email:</h4>
	</div>
	<div class="col-sm-8 profiled">
	<p><?php echo $qry->user_email;?></p>
	</div>
	</div>
	
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>DOB:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $qry->dob; ?></p>
	</div>
	<div class="clear"></div>
	
	<div class="displayPhone" style="<?php echo $style;?>">
	
	<div class="col-sm-4 profiled">
	<h4>Phone:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $qry->contact_no; ?></p>
	</div>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Gender:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $qry->gender; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Mool Nivasi:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $qry->perma_vill_name; ?> <?php echo $qry->	perma_dist;?>&nbsp;,&nbsp;<?php echo $qry->perma_state;?> <?php echo $qry->perma_country;?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Current Address:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $qry->current_vill_name; ?> <?php echo $qry->current_dist;?>&nbsp;,&nbsp;<?php echo $qry->current_state;?> <?php echo $qry->current_country;?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Profession:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $qry->profession; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Education:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $qry->education; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Material status:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $qry->material_status; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Ref. Link:</h4>
	</div>
		
	<div class="col-sm-8 profiled"> 
	<p><?php echo $qry->ref_link; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Facebook link:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $qry->facebook_link; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Twitter link</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $qry->twitter_link; ?></p>
	</div>
	<div class="clear"></div>
	<div class="col-sm-4 profiled">
	<h4>Join Date:</h4>
	</div>
	<div class="col-sm-8 profiled"> 
	<p><?php echo $reg_date; ?></p>
	</div>
	
	<div class="clear"></div>
	
	</div> 
	 </div>
          <!-- /.box -->
        </div>		
    <div id="menu3" class="tab-pane fade">
            <div class="row">
	  
      <div class="col-md-12">
          <!-- Box Comment -->
          <div class="box box-widget">
          
            <div class="box-footer box-comments">   
		<?php
		    $this->db->select('*');
			$this->db->order_by("post_date","desc");
			$this->db->from('user_post');
			$this->db->where('user_id', $user_id);
			$this->db->limit(36);
			$query=$this->db->get();
		if ($query->num_rows() > 0)  
		{
			?>
			<h3 class="galleryh3">Gallery</h3>
			
			<?php
			foreach ($query->result() as $row)
			
			{
				$post_img = $row->post_img_gallery;
			
			if(!empty($post_img))
			{
			?>
			<ul>
			<?php
				$thumb = explode(",",$post_img);
				
			//print_r($thumb);
				
			 
				foreach($thumb as $post_image)
				{
			
			?>
				<li><a class="group1 popup_photo" href="<?php echo base_url(); ?>assets/uploads/thumbs/<?php echo $post_image.'-600x600_thumb.jpg';?>" title="<?php echo $row->post_title; ?>"><img class="allimage" src="<?php echo base_url(); ?>assets/uploads/thumbs/<?php echo $post_image.'-90x90_thumb.jpg';?>"></a></li>
				
			
				<?php
			
				}
				?>
		</ul>
		<?php
			}
		
		}
		}
	?>
		
              
              <!-- /.box-comment -->
            </div>
             <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>		
		
		</div>
    </div>
  </div>
</div>             
           
          
   </div>
   <div class="col-md-4">
   
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
		var user_id = $(".search_user_id").val();
		var post_data = ID+'/'+user_id;
		jQuery('#last_msg_loader').html('<img src="<?php echo base_url(); ?>assets/images/ripple2.gif">');
		$.ajax({
		url: "<?php echo base_url(); ?>userprofile/view_next_post",
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

