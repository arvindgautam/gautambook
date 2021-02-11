
<?php




echo "Test0";













/*
  // new dom object
  $dom = new DOMDocument();

  //load the html
  $html = $dom->loadHTMLFile("http://gautambook.com/crawler/d.html");

  //discard white space 
  $dom->preserveWhiteSpace = false; 

  //the table by its tag name
  $tables = $dom->getElementsByTagName('table'); 

  //get all rows from the table
  $rows = $tables->item(0)->getElementsByTagName('tr'); 
	$table='<table>
	<tr>
	<th>S/N</th>
	<th>Name</th>
	<th>Email ID</th>
	<th>Address</th>
	<th>Phone</th>
	<th>City</th>
	<th>State</th>
	<th>Occupation</th>
	
	</tr>';
  echo $table;
  $i=0;
  // loop over the table rows
  
  foreach ($rows as $row) 
  { 
  $cols = $row->getElementsByTagName('td'); 
  $this->load->model('Comman_function');
		$f_name = $cols->item(0)->nodeValue;
        $l_name = '';
		$email = $cols->item(1)->nodeValue;
		$pass = 'user@123';
		$phone = $cols->item(3)->nodeValue;
		$father_nm = 'Not Entered';
		$gender = 'male';
		$gotra = 'Not Entered';
		$perma_vill_nm = $cols->item(2)->nodeValue;
		$perma_vill_country = 'india';
		$perma_vill_distt = $cols->item(4)->nodeValue;
		$perma_vill_state = $cols->item(5)->nodeValue;
		$current_vill_nm = $cols->item(2)->nodeValue;
		$current_vill_country = 'india';
		$current_vill_dist = $cols->item(4)->nodeValue;
		$current_vill_state = $cols->item(5)->nodeValue;
		$occu= $cols->item(6)->nodeValue;
		$reference_link = $this->input->post('reference');
		$dob_day = '';
		$dob_month = '';
		$dob_year = '';
		$dob = '';
	
		$display_nm = $cols->item(0)->nodeValue;
        // Prep the query
       $this -> db -> select('username');
	   $this -> db -> from('users');
	   $this -> db -> where('username', $email);
	   //$this -> db -> limit(1);
	 
	   $query = $this -> db -> get();
	 //echo $query -> num_rows();
	  if($query -> num_rows() == 0)
	   { 
		   
			$data=array(
			'username'=>$email,
			'password'=>md5($pass),
			'user_email'=>$email,
			'user_registered'=>date('Y-m-d H:i:s'),
			'user_status'=>0,
			'user_role'=>1,
			'display_name'=>$display_nm
			);  
			$this->db->insert('users',$data);
			$user_id = $this->db->insert_id();
			$this->db->query("insert into user_info (user_id,first_name,last_name,father_name,contact_no,gender,gotra,ref_link,dob,current_vill_name,current_country,current_dist,current_state,perma_vill_name,perma_country,perma_dist, perma_state,profession,education) values('$user_id','$f_name','$l_name','$father_nm','$phone','$gender','$gotra','$reference_link','$dob','$perma_vill_nm','India','$perma_vill_distt','$perma_vill_state','$perma_vill_nm','India','$perma_vill_distt','$perma_vill_state','$occu','')");
			$code = sha1( $user_id . time() );
			
			$this->db->query("UPDATE users SET user_activation_key = '$code'  WHERE id = $user_id");
			

	   }		
	  
	   
  $i++;	
  echo "<tr>" ;
      
	  echo "<td>".$i."</td>";
      echo "<td>".$cols->item(0)->nodeValue."</td>";
	  echo "<td>".$cols->item(1)->nodeValue."</td>";
	  echo "<td>".$cols->item(2)->nodeValue."</td>";
	  echo "<td>".$cols->item(3)->nodeValue."</td>";
	  echo "<td>".$cols->item(4)->nodeValue."</td>";
	  echo "<td>".$cols->item(5)->nodeValue."</td>";
	  echo "<td>".$cols->item(6)->nodeValue."</td>";
	  
			  
     echo "</tr>";
    } 
echo "</table>";
*/






?>