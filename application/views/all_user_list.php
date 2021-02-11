<?php
	$user_address = base64_decode($_GET['useraddress']);
			
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
    </section>
 
<!-- Main content -->
<div class="container"> 
<div class="row">

<div class="col-sm-11 text">

<div class="form-bottom">

          <!-- Box Comment -->
		    
          <div id="album-view" class="box box-widget">
		 
            <div class="box-footer box-comments">
			<div class="user_posts">
			<h4>User List <?php echo $user_address ;?> </h4>
	<?php  
		
	$all_post_ids='';	
	$query = $this->db->query("SELECT * FROM user_info where current_country='$user_address' OR current_state='$user_address' OR current_dist='$user_address' OR current_vill_name='$user_address' OR perma_country='$user_address' OR	perma_state='$user_address' OR perma_dist='$user_address' OR perma_vill_name='$user_address' ORDER BY id ASC LIMIT 12");
		if ($query->num_rows() > 0)  
		{
			foreach ($query->result() as $row)
			{
				$user_id = $row->user_id;
				$user_ids = $row->id;
				$all_post_ids .=$user_ids.",";
				
				if($user_ids==2)
				{
					continue;
				}
				$this->load->model('comman_function');
				$results = $this->comman_function->user_profile_info($user_id);
				
				
				if(!empty($row->user_img))
				{
				
				$images = '<img class="album-images " alt="User Image"  src="'.base_url().'assets/ajax/upload/'.$row->user_img.'">';
				}
				else
				{
				
				$images = '<img class="album-images " alt="User Image"  src="'.base_url().'assets/images/user.png">';
				}
					
				if($this->session->userdata('logged_in'))
				{
					$class= 'col-sm-4 text albums item-isotope';
					
				}
				else
				{
					$class='col-sm-4 text album item-isotope';
					
				}
				
				?>
				<div id="<?php echo $user_ids; ?>"  align="left" class="message_box" >
				<input type="hidden" class="search_user_id" value="<?php echo $user_address; ?>">
				<div class="<?php echo $class; ?>">
				<div id="fb" class="box box-success ">  
				<div class="box box-widget">
				<div class="box-header with-border">
				<div class="user-block" id="user-bloc-k">
                <?php echo $images; ?>
                <span class="username"><a href="userprofile?userid=<?php echo base64_encode($user_id); ?>"><?php echo $row->first_name;?> <?php echo $row->last_name; ?></a></span>
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button data-widget="collapse" class="btn btn-box-tool plus" type="button"><i class="fa fa-minus"></i>
                </button>
                
              </div> 
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
			
           
			<div class="box-body user_listimg" style="display: block;">
			<?php echo $images; ?>
			<hr>
			
			  <div class="clear"></div>
		
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
	   var user_add = $(".search_user_id").val();
		var post_data = ID+'/'+user_add;
		jQuery('#last_msg_loader').html('<img src="<?php echo base_url(); ?>assets/images/ripple2.gif">');
		$.ajax({
		  url: "<?php echo base_url(); ?>alluserlist/user_list",
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
