<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    
    </section>
<div class="container"> 
<div class="row">
<div class="col-sm-8 text">
<div class="form-bottom">
<?php echo form_open_multipart('addachievement');?>
<?php if(! is_null($msg)) echo $msg;?>
<div id="messg">
</div>
<div class="col-sm-12 text"> 
<h4>Achievement Information</h4>
</div>
<div class="col-sm-12 text">

<div class="form-group">
<label for="form-first-name" class="sr-only">Title</label>
<input type="text" id="title" class="form-control" name="title" placeholder="Title" required/>
<input type="hidden" name="run_code" value="45">
</div>
</div>
<div class="clear"></div>
<div class="col-sm-12 text">
<h4>Date of Achievement</h4>
</div>
<div class="col-sm-4 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">day</label>
<select name="day" required>
<option value="">Select Day</option>
<?php
$i=1;
for($i=1; $i<=31;$i++)
{
?>
<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php
}
?>

</select>
</div>
</div>
<div class="col-sm-4 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Month</label>
<select name="month" required>
<option value="">Select Month</option>
<?php
	
	$month = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	foreach($month as $months)
	{
		/*$select = '';
		if($months=='February')
		{
			$select = 'selected';
		}*/
	?>
		<option value="<?php echo $months; ?>" <?php //echo $select; ?>><?php echo $months; ?></option>
	<?php
	}

?>
</select>
</div>
</div>
<div class="col-sm-4 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Year</label>
<select name="year" required>
<option value="">Select Year</option>  
<?php

$cu_y =  date("Y");

while($cu_y>=1800)
{
?>
<option value="<?php echo $cu_y; ?>"><?php echo $cu_y; ?></option>
<?php
$cu_y--;
}
?>

</select>
</div>
</div>
<div class="col-sm-12 text">
 <legend>Image Upload</legend>
        

        <fieldset>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="filename" class="control-label">Select Image to Upload</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <input type="file" name="filename" size="20" />
                    </div>
                </div>
            </div>

        
        </fieldset>
        
        
        </div>

<div class="col-sm-6 text">
</div>
<div class="clear"></div>
<br>
<div class="text-center">
<button class="btn btn-primary" type="submit" id="signup_sub" name="submitted">Submit</button>
</div>
<?php echo form_close(); ?>
</div>

</div>
</div>
</div>
</div>