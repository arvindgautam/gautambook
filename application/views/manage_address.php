<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"> 
     
    </section>

			<div class="container">
			<div class="row">
			<div class="col-sm-11 text">

<div class="text-center helpform">
<h4>Address Link</h4>
<ul class="country">
<?php
		$this->db->select('*');
		$this->db->from('country');
		$query = $this -> db-> get();
		if ($query->num_rows() > 0)  
		{
		foreach ($query->result() as $row)
		
		{ 
			$country_id = $row->country_id;
			$country_name = $row->country_name;
		?>
			<a href="alluserlist?useraddress='<?php echo base64_encode($country_name);?>'"><li class="country_list" ><h1><i class="fa fa-arrow-right" aria-hidden="true"></i> <?php echo $country_name; ?> :</h1></li></a>
			<ul class="state">
			<?php
			$this->db->select('*');
			$this->db->from('state');
			$this->db->where('country_id',$country_id);
			
			$query = $this -> db-> get();
			if ($query->num_rows() > 0)  
			{
			foreach ($query->result() as $row)
			
			{ 
				$state_id = $row->id;
				$state_name= $row->state_name;
			
			?>
			
			<a href="alluserlist?useraddress='<?php echo base64_encode($state_name);?>'"><li class="state_list"><h2><i class="fa fa-arrow-right" aria-hidden="true"></i> <?php echo $state_name;?></h2></li></a>
			<ul class="district">
			<?php 
			$this->db->select('*');
			$this->db->from('district_name');
			$this->db->where('state_id',$state_id);
			
			$query = $this -> db-> get();
			if ($query->num_rows() > 0)  
			{
			foreach ($query->result() as $row)
			
			{ 
				$district_id = $row->district_id;
				$district_name= $row->district_name;
			
			?>
			
			<a href="alluserlist?useraddress='<?php echo base64_encode($district_name);?>'"><li class="dist_list"><h3> <i class="fa fa-arrow-right" aria-hidden="true"></i><?php echo $district_name; ?></h3></li></a>
			<ul class="village_name">
			<?php 
			$this->db->select('*');
			$this->db->from('village_name');
			$this->db->where('dist_id',$district_id);
			
			$query = $this -> db-> get();
			if ($query->num_rows() > 0)  
			{
			foreach ($query->result() as $row)
			
			{ 
				
				$name= $row->name;
			?>
			
			<a href="alluserlist?useraddress='<?php echo base64_encode($name);?>'"><li class="villagelist"><h5><i class="fa fa-arrow-right" aria-hidden="true"></i> <?php echo $name; ?></h5></li></a>
			<?php
			}
			}
			?>
			</ul>
			<?php
			}
			}
			?>
			</ul>
			<?php
			}
			}
			?>
			</ul>
			<?php
			
	
		}
		}


?>


</ul>

</div>
</div>
</div>
</div>

