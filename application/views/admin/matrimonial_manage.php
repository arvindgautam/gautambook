<!-- Content Wrapper. Contains page content -->
<?php
if($this->session->userdata('logged_in'))
{
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
    </section>

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
			<div class="ads_member">
			<a href="addmatrimony">
            <i class="fa fa-users"></i><span class="logo-mini"><b><img src="<?php echo base_url(); ?>assets/images/plus-sign.png" alt="Formget logo" style="height: 22px; margin-top: -7px;"></b></span> 
          </a>
		  </div>
		  <?php
			}
		  ?>
		  <h4>Matrimonials</h4>
		<?php
		$all_post_ids = '';
		$query = $this->db->query("SELECT * FROM matrimonial ORDER BY id DESC LIMIT 6");
			?>
		
		<?php
		if ($query->num_rows() > 0)  
		{
		
		foreach ($query->result() as $row)
		{
		$id = $row->id; 
		$all_post_ids .= $id.",";
		$mother_gotra = $row->mother_gotra;
		$get_dob = $row->d_o_b;
		$user_dob = explode('/',$get_dob);
		$img = $row->use_img;
		$mother_gotra_id = $row->mother_gotra;
	
		//print_r($user_dob);
			?>
			<div id="<?php echo $id; ?>"  align="left" class="message_box" >
			<div class="col-sm-4 text metrimonialheight">
			<div class="user_posts">
			<div id="fb" class="box box-success gallerycontent">
			<div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
			  <img class="album-images " alt="User Image"  src="<?php echo base_url()?>assets/images/user.png">
                <span class="usernames"><a href="Metrimonialdetails?userid=<?php echo base64_encode($id); ?>"><?php echo $row->user_name;?></a></span>
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button data-widget="collapse" class="btn btn-box-tool plus" type="button"><i class="fa fa-minus"></i>
                </button>
                
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
			
            <div class="box-body metrimonial-body" style="display: block;">
			<?php
			if(!empty($img))
			{
			?>
			<img class="album-images " src="<?php echo base_url(); ?>assets/matrimonial-image/matrimonial-thumbs/<?php echo $img; ?>-300x300_thumb.jpg">
			<?php
			}
			else
			{
			?>
			<img class="album-images " alt="User Image"  src="<?php echo base_url()?>assets/images/user.png">
			<?php
			}
			?>
			<hr>
			<div class="clear"></div>
			<div class="metrimoni-show">
			
			
			<p class="post_contented metrimonial-details">DOB :</p><p class="post_contented metrimonial-detailss"><?php echo $row->d_o_b;?></p>
			<p class="post_contented metrimonial-details">Phone :</p><p class="post_contented metrimonial-detailss"><?php echo $row->contact_no;?></p>
			<?php
			$query = $this->db->query("SELECT * FROM user_gotra where id='$mother_gotra_id'");
				foreach ($query->result() as $rows)
				{
				?>	
			<p class="post_contented metrimonial-details">Gotra(M) :</p><p class="post_contented metrimonial-detailss"><?php echo $rows->gotra_name;?></p>
			<?php
				}
				$father_gotra_id = $row->father_gotra;
				$query = $this->db->query("SELECT * FROM user_gotra where id='$father_gotra_id'");
				foreach ($query->result() as $rows)
				{
			?>
			
			<p class="post_contented metrimonial-details">Gotra(F) :</p><p class="post_contented metrimonial-detailss"><?php echo $rows->gotra_name;?></p>
			<?php
				}
			?>
			
			</div>
			</div>
			<div class="clear"></div>
			<?php
			if($this->session->userdata('logged_in'))
			{
			?>
			<div class="metri_imglink">
		  <span id="<?php echo $row->id;?>" onclick="delete_matrimonial(this.id)"><img src="<?php echo base_url(); ?>assets/images/deleteimage.png" /></span>
		  
		  <div class="pull-right text-muted">
			<a href="editmetrimonial?userid=<?php echo base64_encode($row->id); ?>"><div class="pull-right text-muted"> <img  src="<?php echo base_url(); ?>assets/images/Edit-icon.png" /></div></a></div></div>
			<?php
			}
			?>
			
			
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

</div>
<div class="clear"></div> 
<div class="all_post_ids all_posts_remove"  id="<?php echo $all_post_ids;?>"></div>
<div id="last_msg_loader"></div>
</div>

</div>
</div>	
</div>
</div>
</div>

<div class="demos allmetrimonialpopup" id="toPopup" style="display:none;">
<div class="closed"></div>
<div id="popup_content">


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
		var post_data = ID;
		if(post_data=='')
		{
			$('#last_msg_loader').empty();
		}
	
		jQuery('#last_msg_loader').html('<img src="<?php echo base_url(); ?>assets/images/ripple2.gif">');
		
		$.ajax({
		  url: "<?php echo base_url(); ?>adminmatrimonial/admin_more_matrimonial",
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