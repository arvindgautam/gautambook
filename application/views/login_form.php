<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container1" style="min-height:470px;">
<div class="row">
<?php
$this->load->view('sidebar');
?>
<div class="col-sm-5 text" id="text-top">

</div>
<div class="col-sm-4 form-box" id="logins">
<?php
	$this->load->view('login');
?>
<div class="text">
<div class="text-center">
<!--<img src="<?php echo base_url(); ?>assets/images/images.png" />-->
<br>
<h4>Recent News</h4>
<?php
			$this -> db -> select('*');
			$this -> db -> from('latest_news');
			$this->db->order_by('news_date', 'DESC');
			$this->db->limit(5);
			//$this->db->order by('date',Desc);
			$query = $this -> db -> get();
		
		?>
		
		<p id="notice" style=" margin-top: 1px;"><marquee onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 3, 0);"  direction="up"  style="border:none" behavior="alternate" scrollamount="3">
		<?php
		foreach ($query->result() as $row)
			{
				$news_description=$row->news_description;
		?>
		<p  style="text-align: center;"><b><u><?php echo $row->news_title;?></u></b><p>
		<p><?php echo $news_description;?><p><hr>
		<?php
			}
		?>
		</marquee></p>
	
	
</div>
</div>
</div>



<div class="clear"></div>

<div class="col-sm-4 sliderscrol">

  
		<?php
			$this -> db -> select('*');
			$this -> db -> from('user_post');
			$this -> db -> where('album_id',17);
			$this->db->order_by('id', 'RANDOM');
			$this->db->limit(40);
			//$this->db->order by('date',Desc);
			$query = $this -> db -> get();
			
		
		?>
		<h3 id="home-h3">पुण्य स्मृतियाँ</h3>
           <marquee onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 6, 0);" behavior="alternate">
		<?php
			foreach ($query->result() as $row)
			{
				$post_img = $row->post_img_gallery;
				if(!empty($post_img))
				{
				$thumb = explode(",",$post_img);
				$no_post = count($thumb);
				foreach($thumb as $post_image)
				{
			?>
               <img data-u="image" src="<?php echo base_url(); ?>assets/uploads/thumbs/<?php echo $post_image.'-90x90_thumb.jpg';?>" />
				 
			<?php
				}
			}
		}
			?>
           </marquee>
          <br>  
        <!-- Bullet Navigator -->
        
        <!-- Arrow Navigator -->
     
   

  
		<?php
			$this -> db -> select('*');
			$this -> db -> from('user_post');
			$this -> db -> where('album_id',18);
			$this->db->order_by('id', 'RANDOM');
			
			$this->db->limit(40);
			//$this->db->order by('date',Desc);
			$query = $this -> db -> get();
			
		
		?>
				<h3 id="home-h3">अनुभवी बुजुर्ग</h3>
           <marquee onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 6, 0);" behavior="alternate">
		<?php
			foreach ($query->result() as $row)
			{
				$post_img = $row->post_img_gallery;
				if(!empty($post_img))
				{
				$thumb = explode(",",$post_img);
				$no_post = count($thumb);
				foreach($thumb as $post_image)
				{
			?>
               <img data-u="image" src="<?php echo base_url(); ?>assets/uploads/thumbs/<?php echo $post_image.'-90x90_thumb.jpg';?>" />
				 
			<?php
				}
			}
		}
			?>
           </marquee>
         <br>   
        <!-- Bullet Navigator -->
        
        <!-- Arrow Navigator -->
     
    

  
		<?php
			$this -> db -> select('*');
			$this -> db -> from('matrimonial');
			$this->db->order_by('id', 'RANDOM');
			$query = $this -> db -> get();
			
		
		?>
			<h3 id="home-h3">वैवाहिक</h3>
           <marquee onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 6, 0);" behavior="alternate">
		<?php
			foreach ($query->result() as $row)
			{
				$img = $row->use_img;
				if(!empty($img))
				{
			?>
              
			   <img data-u="image"class="metrimonialimg" src="<?php echo base_url(); ?>assets/matrimonial-image/matrimonial-thumbs/<?php echo $img; ?>-150x150_thumb.jpg" />
				 
			<?php
				}
				else
				{
				?>
				
				<img data-u="image"class="metrimonialimg" src="<?php echo base_url()?>assets/images/user.png" />
				<?php
				}
				
			}
			?>
           </marquee>
            
        <!-- Bullet Navigator -->
        
        <!-- Arrow Navigator -->
     
    </div>
	
    
    </div>
	

</div>

