<?php
//use google\appengine\api\mail\Message;
//session_start();
$phone=$_GET['phone']."@txt.att.net";
if(mail($phone, "TXTR","thanks for joining TXTR")){
	echo "Thanks for using News SMS.";
	//header("Location : reply.php");
	
}else
  echo "failed";
//error_reporting(E_ALL | E_ALL);
  phpInfo();
?>

