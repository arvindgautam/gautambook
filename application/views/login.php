<div class="form-bottom login">
<form action="<?php echo base_url();?>login" method="post" name='process'>
<?php if(! is_null($error)) echo $error;?>
<div class="form-group">
<label for="form-last-name" class="sr-only">User Name</label>
<input type="text" class="form-control" name="username" placeholder="Username" required/>
<input type="hidden" name="login_text" value="login">
</div>
<div class="form-group">
<label for="form-last-name" class="sr-only">Password</label>
<input type="password" class="form-control" name="password" placeholder="Password" required/>
</div>
<div class="clear"></div>
<div class="text-center">
<button class="btn log" type="submit" name="submit">Login</button>
</div>
</form>
<div class="col-sm-12" style="text-align: center;">
<a href="signup" class="msg_signup">Signup</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="forgot_password" class="msg_signup">Forgot Password</a>
</div> 
<div class="clear"></div>
</div>