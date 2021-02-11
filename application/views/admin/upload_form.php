<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
   
    </section>

<!-- Main content -->
<div class="container"> 
<div class="row">
<div class="col-sm-12 text">
<div class="form-bottom">
            
		
			<h4>Upload Files</h4> 
			<div class="form-bottom login">
				<form name="compose" action="" method="post" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="form-group">
				  
                    
					<input type="hidden" name="compose" value="compose">
                  </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Subject:" name="subject" value="" />
                  </div>
                 
                  <div class="form-group">
                    <div class="btn btn-default btn-file1">
                     
                      <input type="file" name="attachment" requeired/>
                    </div>
                    <p class="help-block">Max. 32MB</p>
                  </div>
                </div><!-- /.box-body -->
				
				
                <div class="box-footer" style="display: inline-block;">
                  <div class="pull-right">
                 
                    <button type="submit" class="btn btn-primary" name="comment-post"> Upload</button></div>
               
                </div><!-- /.box-footer -->
				</form>
				</div>
				<?php if(! is_null($user_mail_msg)) echo $user_mail_msg;?>
				
				<?php
	$query = $this->db->query('SELECT * FROM upload_files');
	
	if ($query->num_rows() > 0)
	{
		?>
		
		<div class="upload-file">
		<table class="gotraname" cellspacing="0" width="100%" border="1">
		<tr>
		<th>S NO.</th>
		<th>Subject</th>
		<th>Attechment</th>
		<th></th>
		</tr>
		<?php
		$i=1;
		foreach ($query->result() as $row)
		{
	
	  	?>
			<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $row->subject;?></td>
			<td><?php echo $row->attachement;?></td>
			<td><span id="<?php echo $row->id;?>" onclick="delete_uploads(this.id)">Delete</span></td>
			 </tr>
			
		<?php
		
		$i++;
		}
	?>
	</table>
	</div>
	<?php
	}
	else {
		 echo 'data is not present';
	}
	
?>
              </div><!-- /. box -->
            </div><!-- /.col -->
            
			
          </div><!-- /.row -->
          </div><!-- /.row -->

	  