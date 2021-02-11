<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */

class Enable_popup_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
	
	public function popup_data_load($albums_id)
	{
				$album_post = '';
				
				$session_data = $this->session->userdata('logged_in');
				$current_user_id = $session_data['userid'];
				$this->load->model('comman_function');
				
			
				$query = $this->db->query("SELECT * FROM user_post where id=$albums_id ");
				if ($query->num_rows() > 0)  
				{
					foreach ($query->result() as $row)
				{
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
				$this -> db -> where('post_id', $albums_id);
				$query = $this -> db -> get();
				if ($query -> num_rows() == 1)
				{
					
					$active = '<button class="btn-default btn-xs active" id="'.$albums_id.'" onclick="posts_unlike(this.id)" type="button"><i class="fa fa-thumbs-o-down"></i>Like</button>';
					
				}
				else
				{
					
					$active = '<button class="btn-default btn-xs" id="'.$albums_id.'" onclick="posts_like(this.id)" type="button"><i class="fa fa-thumbs-o-up"></i>Like</button>';
				
				}
			// like conunt	
			$this -> db -> select('*');
			$this -> db -> from('user_post_like');
			$this -> db -> where('post_id', $albums_id);
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
				
				
			} //end like count
				
				
				/* user name and photo */
				$album_post .= '
				<div class="col-sm-6 text" id="popup_album">
				<div class="box-body" style="display: block;">
				<p class="pst_content title" id="ajax_post'.$albums_id.'">'.$post_title.'</p>';
				if(!empty($post_img))
				{
				$thumb = explode(",",$post_img);
				$no_post = count($thumb);
			//print_r($thumb);
				
			 
				foreach($thumb as $post_image)
				{
				
				$album_post .= '<img alt="Photo" src="'.base_url().'assets/uploads/thumbs/'.$post_image.'-600x600_thumb.jpg'.'" class="img-responsive padss"> 
				
				</div>
				</div>
				
				<div class="col-sm-6 text" id="popup_album" style="padding-left:8px;">
				<div class="box-header with-border">
              <div class="user-block"><img alt="User Image" src="'.$users_photo.'" class="img-circle">
                <span class="username"><a href="userprofile?userid='.base64_encode($user_id).'">'.$user_name.'</a></span>
                <span class="description">Posted: '.$posts_date.'</span> 
				</div>
              <!-- /.box-tools -->
            </div>
			
			
				 
				  <p class="post_contented' .$albums_id.'" id="post-contented">'.$post_content.'</p>
				 
			    <div class="clear"></div>';
				if($session_data)
				{
				$album_post .='<span id="user_liked'.$albums_id.'" class="like-btn'.$albums_id.'">
				'.$active.'
				</span>
				';
				}
				$this -> db -> select('*');
				$this->db->order_by("date","ASC"); 
				$this -> db -> from('user_post_comment');
				$this -> db -> where('post_id', $albums_id);
				$query = $this -> db -> get();
				$comment_count = $query -> num_rows();
			
			
             $album_post .='<div class="pull-right text-muted"> <img class="archived" src="'.base_url().'assets/like/like.jpg"> ('.$likes_count.')</span>  | <img class="archived" src="'.base_url().'assets/like/comment.jpg"> ('.$comment_count.')</div> 
			 
			 
			 <div class="box-footer box-comments">
			<div class="box-like">
			  <span id="like_this'.$albums_id.'">'.$you_like.'</span><span class="tooltips">'.$like_count.' other';
				if ($qury->num_rows() > 0)
				{
					
				
				$album_post .='<span class="tooltiptexts tooltip-tops">';
				
				foreach ($qury->result() as $rows)
				{
					$like_user_id = $rows->user_id;
					if($like_user_id!=$current_user_id)
					{
						$this->load->model('comman_function');
						$results = $this->comman_function->user_profile_info($like_user_id);
						$likers_name = $results->display_name;
						$album_post .='<p>'.$likers_name.'</p>';
					}
				}
				
				$album_post .='</span>';
				
					
				}
				
				
				
				$album_post .= '</span> like this.
			</div>
			</div>
			
			 <div class="box-footer box-comments" style="display: block;">
			<div class="comments-section">';
				
				
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
			
             $album_post .= '<div class="box-comment">
                <!-- User image -->
                <img alt="User Image" src="'.$users_photos.'" class="img-circle img-sm" style="margin-top: 5px;">

                <div class="comment-text">
                      <span class="username">
                        <a href="userprofile?userid='.base64_encode($comment_user_id).'">'.$users_names.'</a>
                        <span class="text-muted pull-right">'.$comt_date.'</span>
                      </span><!-- /.username -->
                 '.$user_comment.'
                </div>
                <!-- /.comment-text -->
              </div>';
			  
			  }
		
			 $album_post  .='<div class="demo'.$albums_id.'"></div></div>
			    ';
				if($session_data)
				{
				$resultts = $this->comman_function->user_profile_info($current_user_id);

				$user_photo = $resultts->user_img;
				

				if(!empty($user_photo))
				{
					$profile_photo = base_url().'assets/ajax/upload/'.$user_photo;
				}
				else
				{
					$profile_photo = base_url().'assets/images/user.png'; 
				}
                $album_post  .='<div class="box-comment">
				
                <!-- User image -->
				<img alt="User Image" src="'.$profile_photo.'" class="img-circle img-sm" style="margin-top: 5px;">

                <div class="comment-text">
                <form action="" method="post" id="comment_submit'.$albums_id.'">
				<input type="hidden" id="comnt_post_id" name="cmnt_post_id" value="'.$albums_id.'">
				<input type="text" id="'.$albums_id.'" onclick="cmt_post_id(this.id)" placeholder="Write a Comment..." name="comment" class="post_comments'.$albums_id.'" required/>
				</form>
                </div>
                </div>';
				}
				
              $album_post  .='  <!-- /.comment-text -->
              </div>
              <!-- /.box-comment -->
            </div>
           
            <!-- /.box-footer -->
			 
			 
			 
			 </div>';  
			  
				}
			}
				
					
				
			}	

		}
		return $album_post;
		
	}
	
}