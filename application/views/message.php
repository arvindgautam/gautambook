<div class="content-wrapper">
<section class="content-header">
     <h3 class="box-title">Inbox</h3>
      <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
<div class="container">
<?php
	$mess_id = base64_decode($_GET['id']);
	$this -> db -> select('*');
	$this -> db -> from('user_message');
	$this -> db -> where('id', $mess_id);
	$query = $this -> db -> get();

	if ($query -> num_rows()>0)
	{
		$qry = $query->row();
		$sender_email = $qry->from_user;
		$mail_subject = $qry->subject;
		$mail_date = strtotime($qry->date);
		$send_date = date(" jS M Y", $mail_date);
		$message = $qry->message;
		$attach = $qry->attachement;
		$read = $qry->read1;
		if($read==0)
		{
			$this->db->query("UPDATE user_message SET read1 = 1  WHERE id = $mess_id");
		}
	}
	else
	{
		
		redirect('inbox');
	}

?>
<div class="row">
            <div class="col-md-8">
              <div class="box box-primary" id="read_msgs">
			  <?php if(! is_null($user_mail_msg)) echo $user_mail_msg;?>
                <div class="box-header with-border">
                  <h3 class="box-title">Read Mail</h3>
                  <div class="box-tools pull-right">
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-read-info">
                    <h3><?php echo $mail_subject; ?></h3>
                    <h5><?php echo $sender_email; ?><span class="mailbox-read-time pull-right">
					<?php echo $send_date; ?>
					</span></h5>
                  </div><!-- /.mailbox-read-info -->
                  <div class="mailbox-controls with-border text-center">
                    <div class="btn-group">
                     <button type="submit" name="submitted" class="btn btn-default btn-sm" value="del"><i class="fa fa-trash-o"></i></button>
					<a href="inbox"><button class="btn btn-default btn-sm" type="submit" name="msg_replay"><i class="fa fa-arrow-left"></i></button></a>
                     <!-- <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Forward"><i class="fa fa-share"></i></button>--> 
                    </div><!-- /.btn-group -->
                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Print"><i class="fa fa-print"></i></button>
                  </div><!-- /.mailbox-controls -->
                  <div class="mailbox-read-message">
                   <?php echo $message; ?>
                  </div><!-- /.mailbox-read-message -->
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <ul class="mailbox-attachments clearfix">
                    
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
									$html_attach = '<span class="mailbox-attachment-icon has-img"><img alt="Attachment" src="'.site_url().'/assets/uploads/private_attachement/'.$attach.'"></span>';
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
											<li>
											  <?php echo $html_attach;?>
											  <div class="mailbox-attachment-info">
												<a target="_blank" href="<?php echo site_url(); ?>assets/uploads/private_attachement/<?php echo $attach;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> <?php echo substr($attach,'15');?></a>
												<span class="mailbox-attachment-size">
												 
												  <a target="_blank" href="<?php echo site_url(); ?>assets/uploads/private_attachement/<?php echo $attach;?>" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
												</span>
											  </div>
											</li>
										
								<?php
							}
					?>

                  </ul>
                </div><!-- /.box-footer -->
                <div class="box-footer">
                  <div class="pull-right">
				<button onclick="message_replay()" class="btn btn-default btn-sm" type="submit" name="msg_replay"><i class="fa fa-reply"></i>Reply</button>
                    
                  </div>
      <button class="btn btn-default btn-sm" value="del"><i class="fa fa-trash-o"></i> Delete</button>
                </div><!-- /.box-footer -->
			
              </div><!-- /. box -->
			  
			  <!-- Messae Replay start-->
			  <div class="box box-primary" id="replay" style="display:none;">
			  <form name="compose" action="" method="post" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="form-group">
                    <input class="form-control" placeholder="To:" name="to" type="email" value="<?php echo $sender_email; ?>" required/>
					<input type="hidden" name="compose_mails" value="compose">
                  </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Subject:" name="subject" value="Re-<?php echo $mail_subject; ?>" />
                  </div>
                  <div class="form-group">
	
                    <textarea id="re_compose-textarea" class="form-control" style="height: 300px" name="compose-textarea" >
                     <?php echo $message; ?> 
                    </textarea>
                  </div>
                  <div class="form-group">
                    <div class="btn btn-default btn-file1">
                     
                      <input type="file" name="attachment"/>
                    </div>
                    <p class="help-block">Max. 32MB</p>
                  </div>
                </div><!-- /.box-body -->
				
				
                <div class="box-footer" style="display: inline-block;">
                  <div class="pull-right">
                 
                    <button type="submit" class="btn btn-primary" name="comment-post"><i class="fa fa-envelope-o"></i> Send</button>
                  </div>
               
                </div><!-- /.box-footer -->
				</form>
			  
			  </div>
			  <!-- Messae Replay ends-->
            </div><!-- /.col --> 
          </div><!-- /.row -->
<script type="text/javascript">
bkLib.onDomLoaded(function() {
	new nicEditor().panelInstance('re_compose-textarea'); 
	
});
</script>