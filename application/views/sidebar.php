<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="col-sm-3 text album-sidebar well" id="text-top">
<h4><i class="fa fa-user"></i> User menu</h4>
<ul>

<li><a   class="message_box topopup"  onclick="popalbum()" ><h3> <i class="fa fa-picture-o"></i>  Albums</h3></a></li>

<li><a class="message_box topopup"  onclick="metrimonial_popup()"> <h3> <i class="fa fa-heart"></i> Matrimonial</h3></a></li>
<li><a  class="message_box topopup"  onclick="Address_link()"><h3> <i class=" fa fa-globe"></i> Address</h3></a></li>
<li><a href="http://gautambook.com/help"><h3><i class="fa fa-info-circle"></i>  Help</h3></a>
<li><a href="http://gautambook.com/feedback"><h3> <i class="fa fa-comment"></i> Feedback</h3></a></li>

</ul>
  
</div>
<div class="demos albumpopup" id="toPopup" style="display:none;">
<div class="closed"></div>
<div id="popup_content">
<div class="form-bottom login">
<form action="<?php echo base_url();?>allgallerylist" method="post" name='process'>

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

</div>
</div>

<!---------------------metrimonial login popup------------------->

<div class="demos metrimonialpopup" id="toPopup" style="display:none;">
<div class="closed"></div>
<div id="popup_content">
<div class="form-bottom login">
<form action="<?php echo base_url();?>allmatrimoniallist" method="post" name='process'>

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

</div>
</div>

<!--------------------- address link login popup------------------->

<div class="demos Address" id="toPopup" style="display:none;">
<div class="closed"></div>
<div id="popup_content">
<div class="form-bottom login">
<form action="<?php echo base_url();?>manageaddress" method="post" name='process'>
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

</div>
</div>

<div id="backgroundPopup" style="display:none;"></div>
