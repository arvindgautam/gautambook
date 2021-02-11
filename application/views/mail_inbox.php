<div class="content-wrapper">
<section class="content-header">
     
      
    </section>
<div class="container">
<div class="row">
           
            <div class="col-md-8">
			
              <div class="box box-primary">
			  
                <div class="box-header with-border">
                  <h4>Inbox</h4> 
				    <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <input type="text" id="seach_mail" onkeyup="inbox_mail_search()" class="form-control input-sm" placeholder="Search Mail"/>
                      <span class="fa fa-search form-control-feedback"></span>
                    </div>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
          
				  <div class="mailbox-controls">
                    <!-- Check all button -->
                    <div id="al_select" class="btn btn-default">
					<i class="fa fa-square-o"></i><input id="selectall" type="checkbox">
					</div>
                      <button  onclick="delete_mail_inbox()" name="submit-checkbox" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                     <!-- /.btn-group -->
                    <a href="inbox"><button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button></a>
					
                    <div class="pull-right">
                      1-50/200
                      <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                        <button class="btn btn-default btn-sm" onclick="next_inbox_msg();"><i class="fa fa-chevron-right"></i></button>
                      </div><!-- /.btn-group -->
                    </div><!-- /.pull-right -->
					</div>
                  </div>
                <input type="hidden" id="show_mail_id" value=""> 
				 <div id="selected" class="table-responsive mailbox-messages">
                       <table class="table table-hover table-striped">
                      <tbody id="searched_data">
					  <?php
					  $all_mail_ids = '';
						$session_data = $this->session->userdata('logged_in');
						$ids = $session_data['userid'];
						$this->load->model('comman_function');
						$data = $this->comman_function->user_profile_info($ids);
						$from_email = $data->user_email;
						$this -> db -> select('*');
						$this -> db -> from('user_message');
						$this -> db -> where('to_user', $from_email);
						 $this->db->order_by("date","desc");
						$query = $this -> db -> get();
						
						if ($query -> num_rows()>0)
						{
							foreach ($query->result() as $row)
							{
								$email_id = $row->from_user;
								$mail_subject = $row->subject;
								$attch = $row->attachement;
								$mail_id = base64_encode($row->id);
								$user_info = $this->comman_function->email_basis_user_info($email_id);
								$sender_name = $user_info->display_name;
								$get_reg_date = strtotime($row->date);
								$reg_date = date(" jS M Y", $get_reg_date);
								$all_mail_ids .= $row->id.",";
								$read = $row->read1;
								if($read==0) 
								{
									$msgg = 'active';
								}
								else
								{
									$msgg = '';
								}
							  ?>
								
								<tr class="<?php echo $msgg; ?>">
								  <td><input id="<?php echo $row->id; ?>" type="checkbox" name="checkbox" value="" onclick="callback_set_stud_ids()"/></td>
								  <td class="mailbox-name"><a href="readmessage?id=<?php echo $mail_id; ?>"><?php echo $sender_name; ?></a></td>
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
				 <div class="all_mail_ids all_mail_remove"  id="<?php echo $all_mail_ids;?>"></div>
                </div><!-- /.box-body -->
               
				
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->