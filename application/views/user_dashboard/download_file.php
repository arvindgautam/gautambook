<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
    </section>

			<div class="container">
			<div class="row">
			<div class="col-sm-11 text">
			<div class="form-bottom">
			<div id="album-view" class="box box-widget">
		 
            <div class="box-footer box-comments">
			<div class="user_posts">
		<h4>Upload Files</h4>
		
			
<?php
	
	$this -> db -> select('*');
	$this -> db -> from('upload_files');
	$query = $this -> db -> get();

	if ($query -> num_rows()>0)
	{
		foreach ($query->result() as $row)
		{
		$attach = $row->attachement;
		$mail_subject = $row->subject;
		if(!empty($attach))
		{
		?>
		<div class="col-sm-4 text metrimonialheight">
		<div id="fb" class="box box-success ">
			<div class="user_posts">
			
			<div class="box-body" style="display: block;">
			<div class="album-post-title">
			<p class="pst_content title"><?php echo $mail_subject; ?></p>
			</div>
				
	<?php
	
			
			
			if(!empty($attach))
			{
				$attach_array = explode(".",$attach);
				$ext = $attach_array['1'];
				if($ext == 'pdf')
				{
					$html_attach = '<span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>';
				}
				elseif(($ext == 'doc') || ($ext == 'docx'))
				{
					$html_attach = '<span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>';
				}
				elseif(in_array($ext,array("png","jpg","jpeg")))
				{
					$html_attach = '<span class="mailbox-attachment-icon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
';
				}
				elseif($ext == 'zip')
				{
					$html_attach = '<span class="mailbox-attachment-icon"><i class="fa fa-file-zip-o"></i></span>';
				}
				elseif($ext == 'xls')
				{
					$html_attach = '<span class="mailbox-attachment-icon"><i class="fa fa-file-excel-o"></i></span>';
				}
				else
				{
					$html_attach = '<span class="mailbox-attachment-icon"><i class="fa fa-spinner fa-spin"></i></span>';
				}
				?>
							
							  <?php echo $html_attach;?>
							  <div class="mailbox-attachment-info">
								<a target="_blank" href="<?php echo site_url(); ?>assets/uploads/uploadfile/<?php echo $attach;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> <?php echo substr($attach,'15');?></a>
								<span class="mailbox-attachment-size">
								 
								  <a target="_blank" href="<?php echo site_url(); ?>assets/uploads/uploadfile/<?php echo $attach;?>" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
								</span>
							  </div>
							  </div>
							  </div>
							
							
						
				<?php
			}
	?>

 
</div><!-- /.box-footer -->
</div>
<?php
		}
		}
	
	}
?>
</div>
</div>
</div>
</div>
</div>
</div>