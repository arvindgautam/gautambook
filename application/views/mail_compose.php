<div class="content-wrapper">
<section class="content-header">
    
    </section>
<div class="container">
<div class="row">
            <div class="col-md-8 text">
			 
              <div class="box box-primary">
			  
            <?php if(! is_null($user_mail_msg)) echo $user_mail_msg;?>
			<h4>Compose New Message</h4> 
				<form name="compose" action="" method="post" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="form-group">
				  
                    <input class="form-control" placeholder="To:" name="to" type="email" value="" required/>
					<input type="hidden" name="compose_mails" value="compose">
                  </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Subject:" name="subject" value="" />
                  </div>
                  <div class="form-group">
	
                    <textarea id="compose-textarea" class="form-control" style="height: 300px" name="compose-textarea" >
                      
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
              </div><!-- /. box -->
            </div><!-- /.col -->
			<div class="col-md-4 text">
			
			</div>
          </div><!-- /.row -->

<script type="text/javascript">
bkLib.onDomLoaded(function() {
	new nicEditor().panelInstance('compose-textarea');
	
});
</script>	  