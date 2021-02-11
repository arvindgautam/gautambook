<?php

$name = "Arvind";
$email = 'registration@gautambook.com';
$message = 'ssssssssssssssssssss';

$to = 'gautam.arv@gmail.com'; 
$subject = 'Customer Inquiry';


$headers='';
$headers .= "Content-type: text/html\r\n";
$headers = 'From: registration@gautambook.com' . "\r\n";

mail($to, $subject, $message);

?>