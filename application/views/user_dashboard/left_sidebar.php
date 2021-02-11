<?php
			$recv_email_id = $result->user_email;
			$user_photo = $result->user_img;
			
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
	  <?php
	             	$session_data = $this->session->userdata('logged_in');
					$id = $session_data['userid'];
					$user_id = base64_encode($id);
		?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <!--<li class="active treeview">
          <a href="dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
			<ul class="treeview-menu">
			<li class="active"><a href="/dashboard"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><a href="/userprofile?userid=<?php echo $user_id; ?>"><i class="fa fa-user"></i> My profile </a></li> 
            <li class="active"><a href="/profile"><i class="fa fa-user"></i>Manage profile</a></li> 
		
			
          </ul>
          </a>
        </li>-->
	
		
   
        <li class="active treeview">
		<?php
				
				$this -> db -> select('*');
				$this -> db -> from('user_message');
				$this -> db -> where('read1',0);
				$this -> db -> where('to_user',$recv_email_id);
				$query = $this -> db -> get();
				$rowcount = $query->num_rows();
				
					
		?>	
<!-- Email Functon -->		
<!--
          <a href="#">
            <i class="fa fa-envelope"></i> <span>MAILBOX</span>
            <small class="label pull-right bg-yellow"><?php echo $rowcount; ?></small>
			<i class="fa fa-angle-left pull-right"></i>
          </a>
		  <ul class="treeview-menu" >
            <li class="active"><a href="/compose"><i class="fa fa-compass"></i> Compose</a></li>
            <li class="active"><a href="/inbox"><i class="fa fa-inbox"></i> Inbox</a></li>
            <li class="active"><a href="/sentmail"><i class="fa fa-envelope"></i> Sent Mail</a></li>
			 
          </ul>
        </li>
		-->
			<?php
				
					$this->db->select('*');
					$this->db->from('user_info');
					$this->db->where('user_id',$id);
					$query = $this -> db -> get();
			        $query -> num_rows();
			        $qry = $query->row();
					$family_create_id= $qry->account_creater_id;
					if($family_create_id==0)
					{
		?>
			   <li class="active treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>FAMILY MEMBERS</span><i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
            <li class="active"><a href="Addfamilymember"><i class="fa fa-users"></i> Add Family</a></li>
            <li class="active"><a href="familylist"><i class="fa fa-users"></i> Your Family</a></li>
          </ul>
		  </a>
        </li>
		<?php
				}
		?>
		
		
		<li class="active treeview">
		 <a href="#">
            <i class="fa fa-trophy"></i> <span>ACHIEVEMENT</span>
            <small class="label pull-right bg-yellow"></small>
			<i class="fa fa-angle-left pull-right"></i>
          </a>
		  <ul class="treeview-menu" >
            <li class="active"><a href="addachievement"><i class="fa fa-trophy"></i> Add Achievement</a></li>
            <li class="active"><a href="listachievement"><i class="fa fa-trophy"></i> Your Achievements</a></li>
            		 
          </ul>
        </li>
		
		
		<li class="active treeview">
		
		 <a href="">
            <i class="fa fa-picture-o"></i> <span>AMBUMS</span>
            <small class="label pull-right bg-yellow"></small>
			<i class="fa fa-angle-left pull-right"></i>
          </a>
		  <ul class="treeview-menu" >
		
            <li class="active"><a href="allgallerylist"><i class="fa fa-picture-o"></i>All Albums</a></li> 
            
         
			
          </ul>
        </li>
		
		<li class="active treeview">
		
		 <a href="">
            <i class="fa fa-heart"></i> <span>MATRIMONIAL</span>
            <small class="label pull-right bg-yellow"></small>
			<i class="fa fa-angle-left pull-right"></i>
          </a>
		  <ul class="treeview-menu" >
		
            <li class="active"><a href="addmatrimony"><i class="fa fa-heart"></i>Add Matrimonial</a></li> 
			<li class="active"><a href="matrimoniallist"><i class="fa fa-heart"></i>Your Matrimonial </a></li>
			<li class="active"><a href="allmatrimoniallist"><i class="fa fa-heart"></i>All Matrimonial </a></li>
         
			
          </ul>
		  <a href="">
            <i class="fa fa-globe"></i> <span>OTHER</span>
            <small class="label pull-right bg-yellow"></small>
			<i class="fa fa-angle-left pull-right"></i>
          </a>
		  <ul class="treeview-menu" >
		   <li class="active"><a href="manageaddress"><i class="fa fa-globe"></i> Find User</a></li>
		   <li class="active"><a href="downloadfile"><i class="fa fa-globe"></i> Downloads</a></li>
		   </ul>
        </li>
		 
       <!-- this is for testing 
	   <li>
			
          <a href="#">
            <i class="fa fa-envelope"></i> <span>Events</span>
           <i class="fa fa-angle-left pull-right"></i>
          </a>
		  <ul class="treeview-menu" >
		    <li><a href="inbox"><i class="fa fa-inbox"> </i> All Events</a></li>
            <li><a href="compose"><i class="fa fa-compass"></i>Create Event</a></li>
			 <li><a href="compose"><i class="fa fa-compass"></i>Manage Event</a></li>
			 
          </ul>
        </li>
		
		<li>
			
          <a href="#">
            <i class="fa fa-envelope"></i> <span>Patrika</span>
           <i class="fa fa-angle-left pull-right"></i>
          </a>
		  <ul class="treeview-menu" >
		    <li><a href="inbox"><i class="fa fa-inbox"> </i> All Patrika</a></li>
            <li><a href="compose"><i class="fa fa-compass"></i>Create Patrika</a></li>
			 <li><a href="compose"><i class="fa fa-compass"></i>Manage Patrika</a></li>
			 
          </ul>
        </li>
		
		<li>
			
          <a href="#">
            <i class="fa fa-envelope"></i> <span>Family tree</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
		  <ul class="treeview-menu" >
		    
            <li><a href="/compose"><i class="fa fa-compass"></i>Create Tree</a></li>
			 <li><a href="/compose"><i class="fa fa-compass"></i>Manage Tree</a></li>
			 
          </ul>
        </li>
		
		--->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>