<?php
session_start();
function searchForNews($search, $phone){
	 //echo $search;
	 $parsedSearch= preg_replace("/[\s_]+/","%20", $search); 
//	 echo $parsedSearch;
	 $userIp="192.168.1.1";
	 $url="https://ajax.googleapis.com/ajax/services/search/news?v=1.0&q=".$parsedSearch."&userip=".$userIp;
//echo $url;
$jsondata=file_get_contents($url);
//echo $jsondata;
$json = json_decode($jsondata, true);
$urls=array();
$titles=array();
$summary = array();
$x=0;
while($x < 5){
$urls[]=$json['responseData'][results][$x][unescapedUrl];
$titles[]=$json['responseData'][results][$x][title];
$x++;
}
//print_r($titles);
$x=0;
while($x<count($urls)){
	$sumData=file_get_contents("http://clipped.me/algorithm/clippedapi.php?url=".$urls[$x]);
	$sumJSON = json_decode($sumData, true);
	$summary[] = $sumJSON[summary];
	//$titles = $sumJSON[title];
	//print_r($summary); 
	//print_r($titles);
	$x++;	
}
$x =0;

//echo $x;
//echo "<br>";
//print_r($summary[0]);
//echo "</br>";
//$reply = array();
//echo count($urls);
while($x<count($urls)){
	$subject = preg_replace("/\s?<b>\s?/", " ",$titles[$x]);
	$subject = preg_replace("/\s?</b>\s?/", " ",$titles[$x]);
	//echo $subject;
	//echo "</br>";
	$reply = preg_replace("/\s?<br>\s?/","", $summary[$x]);
	//echo $reply[$x];
	//echo "<br>";
	if($reply[$x]==" " ||$reply[$x]=="" ){
		$x++;
	}else{
	if(mail("".$phone."", "News SMS", "".$subject." ".$reply[$x]."")){
		echo "Thanks for using News SMS.";
		//header("Location : ");
	}
		$x++;
	}
	
}
header("Location: reply.php");
}


//echo $subject;
//echo $_GET['messages']; 
//echo 
searchForNews($_GET['messages'], $_SESSION['fromAddr']);
?>