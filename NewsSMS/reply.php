<?php
/**
 *	Uses PHP IMAP extension, so make sure it is enabled in your php.ini,
 *	extension=php_imap.dll
  */
 set_time_limit(3000);
session_start(); 
 /* connect to gmail with your credentials */
$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
//I used my personal gmail account as the email server
$username = ''; # e.g somebody@gmail.com
$password = '';
/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
$emails = imap_search($inbox,'ALL');
/* useful only if the above search is set to 'ALL' */
$max_emails = 16;
/* if any emails found, iterate through each email */
if($emails) {
    $count = 1;
        /* put the newest emails on top */
    rsort($emails);
        /* for every email... */
    foreach($emails as $email_number) 
    {
        /* get information specific to this email */
  
       $overview = imap_fetch_overview($inbox,$email_number,0);
        /* get mail message */
        $message = imap_fetchbody($inbox,$email_number,1);
       $mess = explode("-", $message);
       echo $mess[0]; 
         $header = imap_headerinfo($inbox, $email_number);
	 $fromaddr = $header->from[0]->mailbox . "@" . $header->from[0]->host;
        echo $fromaddr;
	$_SESSION['fromAddr']=$fromaddr;
	imap_delete($inbox, $email_number);
	if($count++ >= $max_emails) break;
	header("Location: searchResults.php?messages=".$mess[0]);
    }
  } else{
    header("Refresh: 2, reply.php");
  }
/* close the connection */
imap_close($inbox);
echo "Done";

?>
