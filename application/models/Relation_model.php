<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Relation_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function valide_relation(){
        // grab user input
		$relation = mysql_real_escape_string($this->input->post('relation'));
		
		$this -> db -> select('relation');
		$this -> db -> from('relationship');
		$this -> db -> where('relation', $relation);
	   //$this -> db -> limit(1);
	 
	   $query = $this -> db -> get();
	 //echo $query -> num_rows();
	   if($query->num_rows() == 0)
	   {
       
			$this->db->query("insert into relationship (relation) values('$relation')");
			
			return true;
	   }
	   else
	   {
		    return false;
	   }
    }
	
	// edit gotra 
	public function edit_relation()
	{
		$rel_nm = mysql_real_escape_string($this->input->post('relation_name'));
		$rel_id = $this->input->post('run_codes');
		
		$this->db->query("update relationship set relation='$rel_nm' where id=$rel_id");
		return true;
	}
	
}
?>