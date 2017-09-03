<?php
//session_start();
define('DB_NAME', 'txtr');
define('DB_USER', 'root');
define('DB_PASSWORD', 'password');
define('DB_HOST', 'localhost');

$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

if(!$link){
	die('could not connect: '. mysql_error());
	
}
$db_selected = mysql_select_db(DB_NAME, $link);

if(!$db_selected){
	die('can\'t use' . DB_NAME . ':' . mysql_error());
}

//echo 'connection successful <br>';

$uname = $_POST["uname"];
$pass = $_POST["pass"];
$email = $_POST["email"];
$phone =$_POST["phone"];
//$carrier = $_POST["carrier"];
$sql = "INSERT INTO login(uname, pass, email, phoneNum, carrier) VALUES ('$uname', '$pass', '$email', '$phone', '$carrier')";
if(mysql_query($sql)){
   //$_SESSION['message']="Thank you for signing up for News SMS. Search for what news you want to know.";
   //$_SESSION['carrier']=$carrier;
   header("Location: sendMail.php?phone=".$phone."");
   //echo "success";
}else{
echo "fail".mysql_error();
}


mysql_close(); 
?>



