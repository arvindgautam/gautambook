<?php
class Pagination_controller extends CI_Controller {


 public function index($offset=0){
    $this->load->model('Pagination_model');
  $this->load->library('pagination');
  $config['total_rows'] = $this->Pagination_model->totalMovies();
  
  $config['base_url'] = base_url()."Pagination_controller";
  $config['per_page'] = 5;
  $config['uri_segment'] = 2;

  $config['full_tag_open'] = '<div class="pagination"><ul>';
  $config['full_tag_close'] = '</ul></div>';

  $config['first_link'] = '« First';
  $config['first_tag_open'] = '<li class="prev page">';
  $config['first_tag_close'] = '</li>';

  $config['last_link'] = 'Last »';
  $config['last_tag_open'] = '<li class="next page">';
  $config['last_tag_close'] = '</li>';

  $config['next_link'] = 'Next →';
  $config['next_tag_open'] = '<li class="next page">';
  $config['next_tag_close'] = '</li>';

  $config['prev_link'] = '← Previous';
  $config['prev_tag_open'] = '<li class="prev page">';
  $config['prev_tag_close'] = '</li>';

  $config['cur_tag_open'] = '<li class="active"><a href="">';
  $config['cur_tag_close'] = '</a></li>';

  $config['num_tag_open'] = '<li class="page">';
  $config['num_tag_close'] = '</li>';
	$config['page_query_string'] = TRUE;
	

  $this->pagination->initialize($config);
   

  $query = $this->Pagination_model->getMovies(4,$this->uri->segment(2));
  
  $data['MOVIES'] = null;
  
  if($query){
   $data['MOVIES'] =  $query;
  }

  $this->load->view('pagination_view', $data);
 }
}
?>