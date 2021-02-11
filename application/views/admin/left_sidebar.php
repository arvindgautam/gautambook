<?php
			$session_data = $this->session->userdata('logged_in');
			$id = $session_data['userid'];
			$this->db->select('*');
			$this->db->from('users as us');
			$this->db->join('user_info as uf', 'us.id = uf.user_id');
			$this -> db -> where('us.id', $id);
			$query = $this->db->get();

			if ($query->num_rows() > 0)
			{

				$qry = $query->row();
				$user_photo = $qry->user_img;
			}
		?>
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php
			if(!empty($user_photo))
			{
				$users_photo = base_url().'assets/ajax/upload/'.$user_photo;
			}
			else
			{
				$users_photo = base_url().'assets/images/user.png'; 
			}
			?>
          <img src="<?php echo $users_photo; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php if(! is_null($username)) echo $username;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="active treeview">
          <a href="admin/dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
			<ul class="treeview-menu">
			<li class="active"><a href="admin"><i class="fa fa-circle-o"></i> Home</a></li>
			<li class="active">
			<a href="registeruser">
				<i class="fa fa-user"></i>
					<span>Registered users</span>
						<small class="label pull-right bg-red">3</small>
			</a>
		</li>
          
			<li class="active"><a href="Gotra"><i class="fa fa-circle-o"></i> Manage Gotra</a></li>
			<li class="active"><a href="Relations"><i class="fa fa-circle-o"></i> Manage Relation</a></li>
			  <li class="active">
          <a href="#"> 
            <i class="fa fa-envelope" ></i> <span>Mailbox</span>
            <small class="label pull-right bg-yellow">12</small>
          </a>
        </li>
		  <li class="active"><a href="profile"><i class="fa fa-circle-o"></i> Manage Profile</a></li>
			<li class="active">
			<a href="user_help">
				<i class="fa fa-user"></i>
					<span>User help</span>
					<?php
					$this -> db -> select('read1');
					$this -> db -> from('user_help');
					$this->db->where('read1',0);
					$query = $this -> db -> get();
					$help_msg_count = $query -> num_rows();
					?>
						<small class="label pull-right bg-red"><?php echo $help_msg_count; ?></small>
			</a>
		</li>
		<li class="active">
			<a href="user_feedback">
				<i class="fa fa-user"></i>
					<span>User feedback</span>
					<?php
					$this -> db -> select('read1');
					$this -> db -> from('feedback');
					$this->db->where('read1',0);
					$query = $this -> db -> get();
					$help_msg_count = $query -> num_rows();
					?>
						<small class="label pull-right bg-yellow"><?php echo $help_msg_count; ?></small>
			</a>
		</li>
		<li class="treeview">
		
		 <a href="">
            <i class="fa fa-picture-o"></i> <span>Albums</span>
            <small class="label pull-right bg-yellow"></small>
			<i class="fa fa-angle-left pull-right"></i>
          </a>
		  <ul class="treeview-menu" >
		
            <li><a href="createphotoalbum"><i class="fa fa-picture-o"></i>Create album</a></li> 
            <li><a href="allalbums"><i class="fa fa-picture-o"></i>all albums</a></li>  
            
         
			
          </ul>
        </li>
		<li class="active">
		
		 <a href="adminmatrimonial">
            <i class="fa fa-heart"></i> <span>Manage Metrimonial</span>
          </a>
		  </li>
		  
		  <li class="active">
		
		
		<li class="treeview">
		<a href="">
            <i class="fa fa-globe"></i> <span>Manage address</span>
            <small class="label pull-right bg-yellow"></small>
			<i class="fa fa-angle-left pull-right"></i>
          </a>
		  <ul class="treeview-menu" >
		  <li class="active">
		 <a href="addcountry">
           <i class="fa fa-globe" aria-hidden="true"></i><span>Add Country</span>
          </a>
		  </li>
		  <li class="active">
		
		 <a href="addstate">
           <i class="fa fa-globe" aria-hidden="true"></i><span>Add State</span>
          </a>
		  </li>
		  <li class="active">
		
		 <a href="adddistrict">
           <i class="fa fa-globe" aria-hidden="true"></i><span>Add District</span>
          </a>
		  </li>
		  <li class="active">
		
		 <a href="addvillage">
           <i class="fa fa-globe" aria-hidden="true"></i><span>Add Village/city</span>
          </a>
		  </li>
		 
          </ul>
		</li>
		<li class="active">
		
		 <a href="manageaddress">
            <i class="fa fa-globe"></i> <span>Address</span>
          </a>
		  </li>	
		<li class="active">
		
		 <a href="latestnews">
            <i class="fa fa-globe"></i> <span>Latest news</span>
          </a>
		  </li>
		  <li class="active">
		
		 <a href="upload">
            <i class="fa fa-globe"></i> <span>Upload File</span>
          </a>
		  </li>			  
          </a>
		  
        </li>
		 
       
		
      

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>