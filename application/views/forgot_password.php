<div class="container">
<div class="row">
<div class="col-sm-6 text" id="pleasesign">
<div class="form-top">
<div class="form-top-left">
	<h3>Forgot Password</h3>
</div>
<div class="form-top-right">
	
</div>
</div>
<div class="form-bottom">
<div class="msgs" style="padding-bottom:10px;">
<?php if(! is_null($message)) echo $message;?>
</div>
<form action="" method="post" name='process'>
<div class="form-group">
<label for="form-last-name" class="sr-only">User Name</label>
<input type="text" class="form-control" name="username" placeholder="User Name" required/>
<input type="hidden" name="reset_pass" value="reset">
</div>
<div class="clear"></div>
<div class="text-center">
<button class="btn" type="submit" name="submit">Reset password!</button>
</div>
</form>
</div>
</div>
<div class="col-sm-4 form-box" id="logins">
<?php
	$data['error']='';
	$this->load->view('login',$data);
?>
</div>
</div>
</div>
