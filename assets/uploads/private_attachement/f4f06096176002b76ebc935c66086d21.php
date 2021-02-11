<?php
$user_id = base64_decode($_GET['userid']);
	$data = $this->comman_function->user_profile_info($user_id);
	$from_email = $data->user_email;
	$disp_name = $data->display_name;
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
	

	if(!empty($user_photo))
	{
		$profile_photo = base_url().'assets/ajax/upload/'.$user_photo;
	}
	else
	{
		$profile_photo = base_url().'assets/images/user.png'; 
	}
	
	
?>
<div class="content-wrapper">
<section class="content-header">
     <h3 class="box-title">Profile</h3>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
<div class="container">
<div class="row">
   <div id="Profile-l" class="col-md-8 text">
   <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-black" style="background: url('http://gautambook.com/assets/images/Chrysanthemum.jpg') center center;">			
              <div class="user-block">
                <img alt="User Image" src="<?php echo $profile_photo; ?>" class="img-circle">
                <span class="username userprofile"><a href="#"><?php echo $disp_name;?></a></span>
                <span class="description userprofile">Shared publicly -<?php echo $reg_date;?></span>
              </div>              
            </div> </div>          
            
              <div class="containe-r">
  
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">timeline</a></li>
    <li><a data-toggle="tab" href="#menu1">About</a></li>
    <li><a data-toggle="tab" href="#menu2">Friends</a></li>
    <li><a data-toggle="tab" href="#menu3">Photos</a></li>
  </ul>
 
  
 
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
     
	  
      <div class="col-md-4">
	    <div class="box-footer box-comments">
        <div class="fa-hover"><a href="../icon/suitcase"><i class="fa fa-suitcase"></i>&nbsp;&nbsp;&nbsp;Worked at <?php echo $profession;?></a></div> 
		<div class="fa-hover"><a href="../icon/graduation-cap"><i class="fa fa-mortar-board"></i> &nbsp;&nbsp;Studied at <?php echo $user_edu; ?></a></div>
		<div class="fa-hover"><a href="../icon/home"><i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;Lives in <?php echo $user_cur_vill?> <?php echo $current_dist;?> <?php echo $current_state;?> (<?php echo $current_country;?>)</a></div>	
		<div class="fa-hover"><a href="../icon/map-marker"><i class="fa fa-map-marker"></i> &nbsp;&nbsp;&nbsp;From <?php echo $perma_vill_name;?> <?php echo $perma_dist;?> <?php echo $perma_state;?> (<?php echo $perma_country;?>)</a></div>		
        </div>
	  </div>
      <div class="col-md-8">
          <!-- Box Comment -->
          <div class="box box-widget">
          
            <div class="box-footer box-comments">
			
<div class="user_posts">
	<?php
			$this->db->select('*');
			$this->db->order_by("post_date","desc");
			$this->db->from('user_post');
			$this->db->where('user_id', $user_id);
			$this->db->limit(20);
			$query=$this->db->get();
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$post_id = $row->id;
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
				?>
					<div id="fb" class="box box-success">
					<div class="box box-widget">
				<div class="box-header with-border">
				<div class="user-block">
                <img alt="User Image" src="<?php echo $users_photo; ?>" class="img-circle">
                <span class="username"><a href="userprofile?userid=<?php echo base64_encode($user_id); ?>"><?php echo $user_name; ?></a></span>
                <span class="description">Shared publicly - <?php echo $posts_date; ?></span>
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button data-widget="collapse" class="btn btn-box-tool" type="button"><i class="fa fa-minus"></i>
                </button>
                
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
			
            <div class="box-body" style="display: block;">
			<p class="pst_content"><?php echo $post_title; ?></p>
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
				<img alt="Photo" src="<?php echo base_url(); ?>assets/uploads/thumbs/<?php echo $post_image.'-480x400_thumb.jpg'; ?>" class="img-responsive pad">
			  <?php
				}
			 }
			 elseif($no_post==2)
			 {
				foreach($thumb as $post_image)
				{
				?>
				<img alt="Photo" src="<?php echo base_url(); ?>assets/uploads/thumbs/<?php echo $post_image.'-300x300_thumb.jpg'; ?>" class="img-responsive pad">
			  <?php
				}
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
			  <p class="pst_content"><?php echo $post_content; ?></p>
			  <span id="user_liked<?php echo $post_id; ?>">
			  <?php echo $active; ?>
			 </span>
			
              
              <div class="pull-right text-muted"><span title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title="ram<br/>mohan</br>ddd<br>ddd,ddd"><?php echo $likes_count; ?> likes</span>- 3 comments</div> 
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
				
				$this -> db -> select('*');
				$this -> db -> from('user_post_comment');
				$this -> db -> where('post_id', $post_id);
				$query = $this -> db -> get();
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
		
		<?php
		}
	}
?>
		</div>
		</div>
		</div>
            <!-- /.box-footer -->
            <div class="box-footer">
              <form method="post" action="#">
                <img alt="Alt Text" src="http://gautambook.com/assets/ajax/upload/1579827494prem1234.jpg" class="img-responsive img-circle img-sm">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" placeholder="Press enter to post comment" class="form-control input-sm">
                </div>
              </form>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>		
		
		
    </div>
    <div id="menu1" class="tab-pane fade">
            <div class="row">
	  
      <div class="col-md-4">
	  <div class="box-footer box-comments">
              <div class="box-comment">
                <!-- User image -->
                <img alt="User Image" src="http://gautambook.com/assets/ajax/upload/1579827494prem1234.jpg" class="img-circle img-sm">

                <div class="comment-text">
                      <span class="username">
                        Maria Gonzales
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                  It is a long established fact that a reader will be distracted
                  by the readable content of a page when looking at its layout.
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
              <div class="box-comment">
                <!-- User image -->
                <img alt="User Image" src="http://gautambook.com/assets/ajax/upload/1579827494prem1234.jpg" class="img-circle img-sm">

                <div class="comment-text">
                      <span class="username">
                        Luna Stark
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                  It is a long established fact that a reader will be distracted
                  by the readable content of a page when looking at its layout.
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
            </div>
	  </div>
      <div class="col-md-8">
          <!-- Box Comment -->
          <div class="box box-widget">
          
            <div class="box-footer box-comments">
              <div class="box-comment">
                <!-- User image -->
                <img alt="User Image" src="http://gautambook.com/assets/ajax/upload/1579827494prem1234.jpg" class="img-circle img-sm">

                <div class="comment-text">
                      <span class="username">
                        Maria Gonzales
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                  
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
              <div class="box-comment">
                <!-- User image -->
                <img alt="User Image" src="http://gautambook.com/assets/ajax/upload/1579827494prem1234.jpg" class="img-circle img-sm">

                <div class="comment-text">
                      <span class="username">
                        Luna Stark
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                  It is a long established fact that a reader will be distracted
                  by the readable content of a page when looking at its layout.
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
            </div>
            <!-- /.box-footer -->
            <div class="box-footer">
              <form method="post" action="#">
                <img alt="Alt Text" src="http://gautambook.com/assets/ajax/upload/1579827494prem1234.jpg" class="img-responsive img-circle img-sm">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" placeholder="Press enter to post comment" class="form-control input-sm">
                </div>
              </form>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>		
		
		</div>
    </div>
    <div id="menu2" class="tab-pane fade">
            <div class="row">
	  
      <div class="col-md-4">
	  <div class="box-footer box-comments">
              <div class="box-comment">
                <!-- User image -->
                <img alt="User Image" src="http://gautambook.com/assets/ajax/upload/1579827494prem1234.jpg" class="img-circle img-sm">

                <div class="comment-text">
                      <span class="username">
                        Maria Gonzales
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                  It is a long established fact that a reader will be distracted
                  by the readable content of a page when looking at its layout.
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
              <div class="box-comment">
                <!-- User image -->
                <img alt="User Image" src="http://gautambook.com/assets/ajax/upload/1579827494prem1234.jpg" class="img-circle img-sm">

                <div class="comment-text">
                      <span class="username">
                        Luna Stark
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                  It is a long established fact that a reader will be distracted
                  by the readable content of a page when looking at its layout.
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
            </div>
	  </div>
      <div class="col-md-8">
          <!-- Box Comment -->
          <div class="box box-widget">
          
            <div class="box-footer box-comments">
              <div class="box-comment">
                <!-- User image -->
                <img alt="User Image" src="http://gautambook.com/assets/ajax/upload/1579827494prem1234.jpg" class="img-circle img-sm">

                <div class="comment-text">
                      <span class="username">
                        Maria Gonzales
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                  
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
              <div class="box-comment">
                <!-- User image -->
                <img alt="User Image" src="http://gautambook.com/assets/ajax/upload/1579827494prem1234.jpg" class="img-circle img-sm">

                <div class="comment-text">
                      <span class="username">
                        Luna Stark
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                  It is a long established fact that a reader will be distracted
                  by the readable content of a page when looking at its layout.
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
            </div>
            <!-- /.box-footer -->
            <div class="box-footer">
              <form method="post" action="#">
                <img alt="Alt Text" src="http://gautambook.com/assets/ajax/upload/1579827494prem1234.jpg" class="img-responsive img-circle img-sm">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" placeholder="Press enter to post comment" class="form-control input-sm">
                </div>
              </form>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>		
		
		</div>
    </div>
    <div id="menu3" class="tab-pane fade">
            <div class="row">
	  
      <div class="col-md-4">
	  <div class="box-footer box-comments">
              <div class="box-comment">
                <!-- User image -->
                <img alt="User Image" src="http://gautambook.com/assets/ajax/upload/1579827494prem1234.jpg" class="img-circle img-sm">

                <div class="comment-text">
                      <span class="username">
                        Maria Gonzales
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                  It is a long established fact that a reader will be distracted
                  by the readable content of a page when looking at its layout.
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
              <div class="box-comment">
                <!-- User image -->
                <img alt="User Image" src="http://gautambook.com/assets/ajax/upload/1579827494prem1234.jpg" class="img-circle img-sm">

                <div class="comment-text">
                      <span class="username">
                        Luna Stark
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                  It is a long established fact that a reader will be distracted
                  by the readable content of a page when looking at its layout.
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
            </div>
	  </div>
      <div class="col-md-8">
          <!-- Box Comment -->
          <div class="box box-widget">
          
            <div class="box-footer box-comments">
              <div class="box-comment">
                <!-- User image -->
                <img alt="User Image" src="http://gautambook.com/assets/ajax/upload/1579827494prem1234.jpg" class="img-circle img-sm">

                <div class="comment-text">
                      <span class="username">
                        Maria Gonzales
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                  
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
              <div class="box-comment">
                <!-- User image -->
                <img alt="User Image" src="http://gautambook.com/assets/ajax/upload/1579827494prem1234.jpg" class="img-circle img-sm">

                <div class="comment-text">
                      <span class="username">
                        Luna Stark
                        <span class="text-muted pull-right">8:03 PM Today</span>
                      </span><!-- /.username -->
                  It is a long established fact that a reader will be distracted
                  by the readable content of a page when looking at its layout.
                </div>
                <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
            </div>
            <!-- /.box-footer -->
            <div class="box-footer">
              <form method="post" action="#">
                <img alt="Alt Text" src="http://gautambook.com/assets/ajax/upload/1579827494prem1234.jpg" class="img-responsive img-circle img-sm">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                  <input type="text" placeholder="Press enter to post comment" class="form-control input-sm">
                </div>
              </form>
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