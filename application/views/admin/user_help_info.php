<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h4><strong> User Help Information </strong></h4>
    </section>

<div class="container">
<div class="row">

<?php
	$query = $this->db->query('SELECT * FROM user_help ORDER BY id desc');
	
	if ($query->num_rows() > 0)
	{
	?>
		<div class="form-bottom" style="padding: 0px;">
		<table class="user_info" cellspacing="0" width="94%" border="1">
		<thead>
		<tr >
		<th>S/N</th>
		<th>Name</th>
		<th>Email</th>
		<th>Subject</th>
		<th></th>
		</thead>
		</tr>
		<?php
		$i=1;
		foreach ($query->result() as $row)
		{
			$read_mess = '';
			if($row->read1==0)
			{
				$read_mess = 'read_msg';
			}
		?>
				<tr class="<?php echo $read_mess; ?>">
				<td><?php echo $i; ?></td>
				<td><?php echo $row->name;?></td>
				<td><?php echo $row->email;?></td>
				<td><?php echo $row->subject;?></td>
				<td><span id="<?php echo $row->id;?>" onclick="show_help(this.id)"><a href="help_message?help_id=<?php echo base64_encode($row->id);?>"><img src="<?php echo base_url(); ?>assets/images/profile.png" /></a></span></td>
				</tr>
			<?php
			$i++;
		}
			
	}
	?>
	</table>
</div>

</div>
</div>
</div>
