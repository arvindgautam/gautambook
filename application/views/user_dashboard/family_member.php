<?php
$user_id = base64_decode($_GET['userid']);

if($this->session->userdata('logged_in'))
 {
?>
<!-- Content Wrapper. Contains page content -->
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
<a href="Addfamilymember">
	<i class="fa fa-users"></i><span class="logo-mini"><b><img src="<?php echo base_url(); ?>assets/images/plus-sign.png" alt="Formget logo" style="height: 22px; margin-top: -7px;"></b></span> </a> </div>
	<?php
}
?>	
<div class="box-footer box-comments">
<h4>Fimily Member</h4>
<?php
		$this->load->model('comman_function');
		$resultss = $this->comman_function->user_profile_info($user_id); 
		//$ids = $resultss->display_name;
		//echo $ids;
		$query = $this->db->query("SELECT * FROM user_info where account_creater_id=$user_id");
		
		
		
		
		
		foreach ($query->result() as $row)
		{
			
			$ids = $row->user_id;
			$results = $this->comman_function->user_profile_info($ids);
			$email_id = $results->user_email;
			$relation_id = $row->relation;
			$user_img = $results->user_img;
			$family_user_id = $results->user_id;
			
			if(!empty($user_img))
			{
				
				$images = '<img class="album-images " alt="User Image"  src="'.base_url().'assets/ajax/upload/'.$user_img.'">';
			}
			else
			{
				
				$images = '<img class="album-images " alt="User Image"  src="'.base_url().'assets/images/user.png">';
			}	
		
			$result = $this->comman_function->get_relation($relation_id);
			
			$get_dob = $row->dob;
			$user_dob = explode('/',$get_dob);
			?>
		
			<!-- This contains the hidden content for inline calls -->
			
<!-- user gallery list -->
			
			<div class="col-sm-4 text" id="userd_family">
			<div class="user_posts">
			<div id="fb" class="box box-success">
			<div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <?php echo $images;?>
                <span class="usernames"><a href="userprofile?userid=<?php echo base64_encode($family_user_id);?>"><?php echo $results->display_name;?></a></span>
                
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
			<?php echo $images;?>
			<hr>
			
			  <div class="clear"></div>
			  
			    <div class="metrimoni-show">
			<p class="post_contented metrimonial-details">Name:</p><p class="post_contented metrimonial-detailss"><?php echo $results->display_name;?></p>
			   <p class="post_contented metrimonial-details">Gender:</p><p class="post_contented metrimonial-detailss"><?php echo $row->gender;?></p>
			    <p class="post_contented metrimonial-details">Relation:</p><p class="post_contented metrimonial-detailss"><?php echo $result; ?></b></p>
			   <p class="post_contented metrimonial-details">Username:</p><p class="post_contented metrimonial-detailss"><?php echo $results->username;?></p></p>
			   </div>
			   
			  
			  
			  <div class="clear"></div>
			</div>
			
            <!-- /.box-body -->
            
           
		  
            <!-- /.box-footer -->
          </div>
		</div>
		</div>
	</div>

		
		
		<?php
		
		}
		
		
	?>
	<div class="clear"></div> 
</div>
</div>
</div>
</div>		