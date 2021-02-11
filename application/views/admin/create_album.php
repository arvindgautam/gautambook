 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
   
    </section>

<!-- Main content -->
<div class="container"> 
<div class="row">
<div class="col-sm-8 text">
<div class="form-bottom">
<!-- user create post -->
<div class="creator_post">
<form method="post" action="" enctype='multipart/form-data'>
<div class="col-sm-6 text">
<div class="form-group">
<label for="form-last-name" class="sr-only">album Title</label>
<input type="text" class="form-control posttitle" name="album_title" placeholder="album Title" value="" required/>
<input type="hidden" name="add_album" value="add">
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
<button class="btn update album"  type="submitted"  name="update">Create Album</button>
</div>
</form>
</div>
</div>
</div>
<div class="col-sm-4 text">

</div>
</div>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
	new nicEditor().panelInstance('area1');
	
});
</script>