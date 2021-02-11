<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
    </section>
	<div class="container"> 
<div class="row">
<div class="col-sm-8 text">
<?php if(! is_null($user_msg)) echo $user_msg;?>
<div class="form-bottom">
<div class="col-sm-6 text">
<div class="main">
  <h3>Your file was successfully uploaded!</h3>  
		
      <ul> 
         <?phpforeach ($upload_data as $item => $value):?> 
         <li><?php echo $item;?>: <?php echo $value;?></li> 
         <?phpendforeach; ?>
      </ul>  
		
      <p><?php echo anchor('upload', 'Upload Another File!'); ?></p>  
</div>
</div>
</div>
</div>
</div>