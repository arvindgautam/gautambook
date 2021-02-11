<div class="content-wrapper">
<section class="content-header">
     
     
    </section>
<div class="container">
<div class="row">
           
            <div class="col-md-8">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Sent mail</h3>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <input type="text" class="form-control input-sm" placeholder="Search Mail"/>
                      <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
				<form name="hh" action="" method="post"> 
                <div class="box-body no-padding">
          
				  <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button class="btn btn-default btn-sm checkbox-toggle">
					<i class="fa fa-square-o"></i>
					</button>
                      <button type="submit" name="submit-checkbox" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                     <!-- /.btn-group -->
                    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
					
                    <div class="pull-right">
                      1-50/200
                      <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                      </div><!-- /.btn-group -->
                    </div><!-- /.pull-right -->
					</div>
                  </div>
                
				 <div class="table-responsive mailbox-messages">
                       <table class="table table-hover table-striped">
                      <tbody>
					  <?php
						$session_data = $this->session->userdata('logged_in');
						$ids = $session_data['userid'];
						$this->load->model('comman_function');
						$data = $this->comman_function->user_profile_info($ids);
						$from_email = $data->user_email;
						$this -> db -> select('*');
						$this -> db -> from('user_message');
						$this -> db -> where('from_user', $from_email);
						 $this->db->order_by("date","desc");
						$query = $this -> db -> get();
						
						if ($query -> num_rows()>0)
						{
							foreach ($query->result() as $row)
							{
								$email_id = $row->to_user;
								$mail_subject = $row->subject;
								$attch = $row->attachement;
								$mail_id = base64_encode($row->id);
								$user_info = $this->comman_function->email_basis_user_info($email_id);
								$sent_to = $user_info->display_name;
								$get_reg_date = strtotime($row->date);
								$reg_date = date(" jS M Y", $get_reg_date);
								
								
							  ?>
							  
								<tr class="active">
								  <td><input type="checkbox" name="checkbox[]" value=""/></td>
								  <td class="mailbox-name"><a href="sentmassage?id=<?php echo $mail_id; ?>"><?php echo $sent_to; ?></a></td>
								  <td class="mailbox-subject"><b><?php echo $mail_subject; ?></b></td>
								  <td class="mailbox-attachment">
								 <?php if(!empty($attch))
								 {
									 ?>
											<i class="fa fa-paperclip"></i>
									<?php
								 }
								 ?>
								  </td>
								  <td class="mailbox-date"><?php echo $reg_date;?></td>
								</tr>
						<?php
							}
						}
						?>
                      </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages -->
				 
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>                    
                    <div class="btn-group">
                      <button type="submit" class="btn btn-default btn-sm" name="submit-checkbox"><i class="fa fa-trash-o"></i></button>
                    </div><!-- /.btn-group -->
                   <a href="http://community.isprasoft.com/inbox/"> <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button></a>
                    <div class="pull-right">
                      1-50/200
                      <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                      </div><!-- /.btn-group -->
                    </div><!-- /.pull-right -->
                  </div>
                </div>
				 </form>
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->