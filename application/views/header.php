<!DOCTYPE html">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
  <title>Welcome <?php if(! is_null($username)) echo $username;?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/colorbox.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom_pop.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
   
  
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/_all-skins.min.css">
<script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/app.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

<script src="<?php echo base_url(); ?>assets/js/nicEdit.js" type="text/javascript"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.colorbox.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/custom_popup_script.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/wookmark.js"></script>
  <script>
     $.widget.bridge('uibutton', $.ui.button);	
</script>
<style>
.content-wrapper {
    background-color: #c0cbff;
   
    background-position: center;
    background-repeat: no-repeat;
    background-size: 400px auto;
    background-attachment: fixed;
}
.skin-blue {
    background-color: #c0cbff;
    background-image: url("/assets/images/bg.png");
    background-position: center;
    background-repeat: no-repeat;
    background-size: 400px auto;
    background-attachment: fixed;
}
</style>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-9737521905069208",
    enable_page_level_ads: true
  });
</script>
</head>
<?php
$session_data = $this->session->userdata('logged_in');
$id = $session_data['userid'];
$user_id = base64_encode($id);
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<header class="main-header">
    <!-- Logo -->
    <a href="/dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="Formget logo" style="height: 47px;"></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="Formget logo" style="height: 47px;">Welcome</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
	  <div class="col-sm-4">
	  
	 <div id="front-search">
	 <div id="login_search">
					<div class="something">
					 <input name="search_data" id="search_data" placeholder="Search Profile..." type="text" onkeyup="ajaxSearch();"><img src="<?php echo base_url(); ?>assets/images/search.png">
						<div id="suggestions">
							<div id="autoSuggestionsList">  
							</div>
						</div>
				</div>
	</div>
	  </div>
	  </div>
	  <div class="col-sm-3">
	<ul class="top-menu">
	<li><a href="/dashboard"><i class="fa fa-home"></i>Home</a></li>
	<li><a href="/userprofile?userid=<?php echo $user_id; ?>"><i class="fa fa-user"></i>My profile</a></li>
	</ul>
	  </div>
	  <div class="col-sm-4 pull-right" >
			<?php
			
			$this->db->select('*');
			$this->db->from('users as us');
			$this->db->join('user_info as uf', 'us.id = uf.user_id');
			$this -> db -> where('us.id', $id);
			$query = $this->db->get();

			if ($query->num_rows() > 0)
			{

				$qry = $query->row();
				$user_photo = $qry->user_img;
				$profile = $qry->profession;
				$get_reg_date = strtotime($qry->user_registered);
				$reg_date = date("F Y", $get_reg_date);
				$get_email = $qry->user_email;
				
			}
			
			
		?>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
		  <?php
			$this -> db -> select('*');
			$this -> db -> from('user_message');
			$this -> db -> where('to_user', $get_email);
			$this -> db -> where('read1', 0);
			$query = $this -> db -> get();
			$unread_count = $query -> num_rows(); 
		  ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"></span>
            </a>
            <ul class="dropdown-menu">
             
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
     
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
			  <?php 
				
						$this -> db -> select('*');
						$this -> db -> from('freind_request');
						$this -> db -> where('request_receive_id', $id);
						$this->db->where('read1',0);
						$query = $this -> db -> get();
						$unread_req = $query -> num_rows(); 
						
			  
			  ?>
              <span class="label label-warning"><?php echo $unread_req; ?></span>
            </a>
			<?php
			if(!empty($unread_req))
			{	
			?>
            <ul class="dropdown-menu">
			<li class="header">Friend Request Pending</li>
			
              <li>
               
                <ul class="menu">
				<?php
					foreach ($query->result() as $row)
					{
						$id = $row->friend_request_id;
						$this->db->select('first_name,last_name,user_img,current_dist,current_state');
						$this->db->from('user_info');
						$this -> db -> where('user_id', $id);
						$qryy = $this->db->get();
						$qry = $qryy->row();
						$photos = $qry->user_img;
						$f_name = $qry->first_name;
						$l_name = $qry->last_name;
						$city = $qry->current_dist;
						$state = $qry->	current_state;
						$user_disp_name = $f_name.' '.$l_name;
						if(!empty($photos))
						{
							$users_photos = base_url().'assets/ajax/upload/'.$photos;
						}
						else
						{
							$users_photos = base_url().'assets/images/user.png'; 
						}
					?>
					  <li id="<?php echo $id; ?>">
						<a id="accepted" href="userprofile?userid=<?php echo base64_encode($id); ?>">
						  <div class="user-block">
							<img alt="User Image" src="<?php echo $users_photos; ?>" class="img-circle">
							<span class="username"><?php echo $user_disp_name; ?></span><span class="description"><?php if(!empty($city)){echo $city.',';} ?> <?php echo $state; ?></span>
						  </div></a>
						  <div class="friend_reqs" id="noti_request_sent">
							<span id="request_action"><span class="reqs" id="<?php echo $id; ?>" onclick="accept_friend_req(this.id)">
							<i class="fa fa-check"></i></span> 
							<span class="reqs" id="<?php echo $id; ?>" onclick="friend_cancel(this.id)">
							<i class="fa fa-close"></i><span id="imgs_load" style="display:none;"><img src="<?php echo base_url(); ?>assets/images/LOOn0JtHNzb.gif" style="margin-left: 8px; margin-right: -5px;"></span></span></span><span id="imgs_load" style="display:none;"><img src="<?php echo base_url(); ?>assets/images/LOOn0JtHNzb.gif" style="margin-left: 8px; margin-right: -5px;"></span>							
							</div>
							<div class="clear"></div>
					  </li>
                  <?php
				  
					}
				  ?>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
			<?php
			  }
			  ?>
          </li>
       
        <!--  <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                
                <ul class="menu">
                  <li>
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                
                  <li>
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  
                  <li>
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a> 
                  </li>
                  
                  <li>
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                 
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li> -->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
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
              <img src="<?php echo $users_photo; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php if(! is_null($username)) echo $username;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
             <!-- <li class="user-header">
                <img src="<?php echo $users_photo; ?>" class="img-circle" alt="User Image">

                <p>
                  <?php if(! is_null($username)) echo $username;?>
				  <small><?php echo $profile; ?></small>
                  <small>Member since <?php echo $reg_date; ?></small>
                </p>
              </li>
			  -->
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="logout">
                  <a href="profile" class="btn btn-default btn-flat"><i class="fa fa-user"></i> Profile</a>
                </div>
				</li>
				<li class="user-footer">
                <div class="logout">
                  <a href="logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button --> 
        </ul>
      </div>
	  </div>
    </nav>
  </header>