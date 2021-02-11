<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
 class image extends CI_Controller {  
 
  public function index()   
  {			                   		
$this->load->library('image_lib');
		
		$config['image_library'] = 'gd2';
			$config['new_image'] ='/home/isprasof/public_html/dev/community/assets/images/'.rand(0,1000).'arvind.jpg';
			$config['source_image'] = '/home/isprasof/public_html/dev/community/assets/images/1.jpg';
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = FALSE;
			$config['width']     = 50;
			$config['height']   = 50; 

			$this->image_lib->clear();
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			
			$config['image_library'] = 'gd2';
			$config['new_image'] ='/home/isprasof/public_html/dev/community/assets/images/'.rand(0,1000).'arvind.jpg';
			$config['source_image'] = '/home/isprasof/public_html/dev/community/assets/images/1.jpg';
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width']     = 50;
			$config['height']   = 50; 
		echo "Image created";


  }
  
  }
  ?>