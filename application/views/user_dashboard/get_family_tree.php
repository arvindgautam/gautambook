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
<h4>Family Trees</h4>
<ul class="country">
<?php
	


			$session_data = $this->session->userdata('logged_in');
			$id = $session_data['userid'];
			$this->load->model('comman_function'); 
			//$results = $this->comman_function->user_profile_info($id);
			$user_levels = 0;
			$row = $this->db->query("SELECT MAX(user_level) AS `user_levels` FROM `user_info` where account_creater_id='$id'")->row(); 

			 $max_level = $row->user_levels;
			$arr    = array();
			$this->db->select('*');
			$this->db->from('user_info');
			$this->db->where('account_creater_id',$id);
			$query = $this -> db-> get();
			foreach ($query->result() as $rowss)
		
			{ 
				//echo $rowss->user_level;
				$arr[] = $rowss->user_level;
				
			}
		 $min_level  = min($arr);
		
		$get_family_tree='';
		for($i =$max_level; $i>=$min_level; $i--)	
		{
		$this->db->select('*');
		$this->db->from('user_info');
		$this->db->where('user_level',$i);
		$this->db->where('account_creater_id',$id);
		$query = $this -> db-> get();
		$family = $query->result();	
		echo '<ul>';
		foreach($family as $row)
		{
			 $parrent_id = $row->parrent_id;
			 $user_id = $row->user_id;
			 $parrent_nm = $row->first_name.' '.$row->last_name;
			echo '<li>'.$parrent_nm,'</li>';
		$levl = $max_level-1;	
		$this->db->select('*');
		$this->db->from('user_info');
		//$this->db->where('user_level',$levl);
		$this->db->where('account_creater_id',$id);
		$this->db->where('parrent_id',$user_id);
		$query = $this -> db-> get();
		$family = $query->result();	
		echo '<ul>';
		foreach($family as $row)
		{
			 $parrent_id = $row->parrent_id;
			 $user_id = $row->user_id;
			$parrent_nm = $row->first_name.' '.$row->last_name;
			echo '<li>'.$parrent_nm.'</li>';
		}
		echo '</ul>';
		}
		echo '</ul>';
		}
		
?>


</div>
</div>
</div>
<?

?>
</div>
