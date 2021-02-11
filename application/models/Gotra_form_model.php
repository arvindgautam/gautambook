<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Gotra_form_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function valide_gotra(){
        // grab user input
		$gotra = $this->input->post('gotra');
		
		$this -> db -> select('gotra_name');
	   $this -> db -> from('user_gotra');
	   $this -> db -> where('gotra_name', $gotra);
	   //$this -> db -> limit(1);
	 
	   $query = $this -> db -> get();
	 //echo $query -> num_rows();
	   if($query -> num_rows() == 0)
	   {
       
			$this->db->query("insert into user_gotra (gotra_name) values('$gotra')");
			
			return true;
	   }
	   else
	   {
		    return false;
	   }
    }
	
	// edit gotra 
	public function edit_gotras()
	{
		$gotra_nm = $this->input->post('edit_gotra');
		$gotra_id = $this->input->post('run_codes');
		
		$this->db->query("update user_gotra set gotra_name='$gotra_nm' where id=$gotra_id");
		return true;
	}
	
	// delete gotra 
	public function delete_gotras($id)
	{
		$tables = 'user_gotra';
		$this->db->where('id', $id);
		$this->db->delete($tables);
		return true;
	}
	
}
?>