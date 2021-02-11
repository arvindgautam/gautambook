<div class="content-wrapper">
<section class="content-header">
     <h3 class="box-title">Sent mails</h3>
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
		$sender_email = $qry->to_user;
		$mail_subject = $qry->subject;
		$mail_date = strtotime($qry->date);
		$send_date = date(" jS M Y", $mail_date);
		$message = $qry->message;
		$attach = $qry->attachement;
		
	}
	

?>
<div class="row">
            <div class="col-md-8">
              <div class="box box-primary">
			  <form name="red" action="" method="post"> 
                <div class="box-header with-border">
                  <h3 class="box-title">Sent Mail</h3>
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
					<button class="btn btn-default btn-sm" type="submit" name="msg_replay"><i class="fa fa-reply"></i></button>
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
				  <button class="btn btn-default btn-sm" type="submit" name="msg_replay"><i class="fa fa-reply"></i> Reply</button>
                    
                  </div>
      <button type="submit" name="submitted" class="btn btn-default btn-sm" value="del"><i class="fa fa-trash-o"></i> Delete</button>
                </div><!-- /.box-footer -->
				</form>
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->