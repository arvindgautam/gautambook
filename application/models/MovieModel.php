<?php
class MovieModel extends CI_Model {


 function getMovies($limit=null,$offset=NULL){
  $this->db->select("id,display_name,user_email,user_status");
  $this->db->from('users');
  $this->db->limit($limit, $offset);
  $query = $this->db->get();
  return $query->result();
 }

 function totalMovies(){
  return $this->db->count_all_results('users');
 }
}
?>