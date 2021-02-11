<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</div>
<div class="container1" style="min-height:470px;">
<div class="row">
<?php
$this->load->view('sidebar');
if($this->session->userdata('logged_in'))
{
?>
<div class="col-sm-6 text" id="text-topss">
<?php
}
else
{
?>
<div class="col-sm-6 text" id="text-tops">
<?php
}
?>
<div class="text-center helpform">
<h4>Help</h4>
<form action="" method="post">

<div class="form-group">
<label for="form-last-name" class="sr-only">Name</label>
<input type="text" class="form-control" name="name" placeholder="Name" required/>
<input type="hidden" name="help_text" value="help">
</div>
<div class="form-group">
<label for="form-last-name" class="sr-only">Email</label>
<input type="email" class="form-control" name="email" placeholder="Email" required/>
</div>
<div class="form-group">
<label for="form-last-name" class="sr-only">Subject</label>
<input type="subject" class="form-control" name="subject" placeholder="Subject" required/>
</div>
<div class="form-group">
<label for="form-last-name" class="sr-only">Comment</label>
<textarea name="comment" id="textarea" placeholder="Your Content Here" required></textarea>
</div>
<div class="clear"></div>
<div class="text-center">
<button class="btn log" type="submit" name="submit">Submit</button>
</div>
</form>
</div>
</div>
</div>
</div>
