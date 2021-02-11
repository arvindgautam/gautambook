<?php
$ids = '';
$act_key = '';
$ids = base64_decode($_GET['user_id']);
$act_key = $_GET['key'];
$reset_user_id = base64_encode($ids);
?>
<div class="container">
<div class="row">
<div class="col-sm-6 text" id="pleasesign">
<?php
if((!empty($ids)) && (!empty($act_key)))
{
$this -> db -> select('*');
$this -> db -> from('resetpassword');
$this -> db -> where('user_id', $ids);
$this -> db -> where('pass_reset_link', $act_key);
$query = $this -> db -> get();
if ($query -> num_rows() == 1)
{
?>
<div class="form-top">
<div class="form-top-left">
	<h3>Reset Password</h3>
</div>
<div class="form-top-right">
	
</div>
</div>
<div class="form-bottom">
<div class="msgs" style="padding-bottom:10px;">
</div>
<form action="" method="post" name='process'>
<div class="form-group">
<label for="form-last-name" class="sr-only">Password</label>
<input type="password" class="form-control" name="passwords" placeholder="Password" required/>
<input type="hidden" name="change_pass" value="<?php echo $reset_user_id; ?>">
</div>
<div class="form-group">
<label for="form-last-name" class="sr-only">Confirm Password</label>
<input type="password" class="form-control" name="username" placeholder="Confirm Password" required/>
<input type="hidden" name="conf_reset_pass" value="reset">
</div>
<div class="clear"></div>
<div class="text-center">
<button class="btn" type="submit" name="submit">Submit</button>
</div>
</form>
</div>
<?php
}
else
{
	?>
		<div class="form-top">
		<div class="form-top-left">
		<h3>Sorry! Your reset link has been expired</h3>
		</div>
		<div class="form-top-right">
		</div>
		</div>
	
	<?php
}
}
else
{
	redirect('forgot_password', 'refresh');
}
?>
</div>

</div>
</div>

