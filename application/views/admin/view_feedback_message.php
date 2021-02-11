<?php
echo $help_id=base64_decode($_GET['help_id']);
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h4><strong>  </strong></h4>
    </section>

<div class="container">
<div class="row">
<div class="col-sm-8 profiled">
<h3>Feedback Message</h3>
<?php
$query = $this->db->query("select * from feedback where id=$help_id");
foreach ($query->result() as $row)
{

?>
<div class="clear"></div>
<div class="col-sm-6 profile_named">
	<h4>Name</h4>
</div>
<div class="col-sm-6 profile_named">
	<?php echo $row->name; ?>
</div>
<div class="clear"></div>
<div class="col-sm-6 profile_named">
	<h4>Email</h4>
</div>
<div class="col-sm-6 profile_named">
	<?php echo $row->email; ?>
</div>
<div class="clear"></div>
<div class="col-sm-6 profile_named">
	<h4>Subject</h4>
</div>
<div class="col-sm-6 profile_named">
	<?php echo $row->suggestions; ?>
</div>
<div class="clear"></div>
<?php
}
$this->db->query("UPDATE feedback SET read1=1 where id=".$help_id);
?>
</div>
</div>
</div>
</div>
