<?php

class Imageupload extends CI_Controller {

	public function index(){
	
		$data1['title'] = "image upload";
		$this->load->view('header1',$data1);
		$this->load->view('imageform');
		$this->load->view('footer');
	
	}
	
	public function upload()
	{
		define ("MAX_SIZE","9000"); 
		function getExtension($str)
		{
				 $i = strrpos($str,".");
				 if (!$i) { return ""; }
				 $l = strlen($str) - $i;
				 $ext = substr($str,$i+1,$l);
				 return $ext;
		}
echo $_FILES['photos']['name'];

		$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
		if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") 
		{
			
			$uploaddir = "/home/isprasof/public_html/dev/community/assets/uploads/"; //a directory inside
			foreach ($_FILES['photos']['name'] as $name => $value)
			{
				
				$filename = stripslashes($_FILES['photos']['name'][$name]);
				$size=filesize($_FILES['photos']['tmp_name'][$name]);
				//get the extension of the file in a lower case format
				  $ext = getExtension($filename);
				  $ext = strtolower($ext);
				
				 if(in_array($ext,$valid_formats))
				 {
				   if ($size < (MAX_SIZE*1024))
				   {
				   $image_name=time().$filename;
				   echo "<img src='http://community.isprasoft.com/assets/uploads/".$image_name."' class='imgList'>";
				   $newname=$uploaddir.$image_name;
				   
				   if (move_uploaded_file($_FILES['photos']['tmp_name'][$name], $newname)) 
				   {
				
				   }
				   else
				   {
					echo '<span class="imgList">You have exceeded the size limit! so moving unsuccessful! </span>';
					}

				   }
				   else
				   {
					echo '<span class="imgList">You have exceeded the size limit!</span>';
				  
				   }
			   
				  }
				  else
				 { 
					echo '<span class="imgList">Unknown extension!</span>';
				   
				 }
				   
			 }
		}
	
	
	}
}

?>