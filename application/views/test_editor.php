 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
    </section>

			<div class="container">

<div class="row">
<div class="col-sm-8 text">
<div class="form-bottom">
<!-- user create post -->
<div class="creator_post">
<form method="post" action="<?php echo base_url();?>dashboard" enctype='multipart/form-data'>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">Post Title</label>
<input type="text" class="form-control posttitle" name="post_title" placeholder="Post title" value="" />
<input type="hidden" name="add_post" value="add">
</div>
</div>
<div class="col-sm-12 text">
<div class="form-group1"> 
<div class="text_box">
<textarea cols="50" id="area1" name="text_editor"></textarea></div>
</div>
</div>
<div class="col-sm-12 text">
<div class="form-group1"> 
<input type="file" name="userfile[]"  multiple="multiple">
</div>
</div>
<div class="clear"></div>
<div class="text-center">
<button class="btn update" type="submitted"  name="update">POST</button>
</div>
</form>
</div>

<script type="text/javascript">
bkLib.onDomLoaded(function() {
	new nicEditor().panelInstance('area1');
	
});
</script>