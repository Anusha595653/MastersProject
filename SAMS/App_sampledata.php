<?php
 
 require_once ('mysql_connect.php');
# Script 11.9 - loggedin.php #2
// The user is redirected here from login.php.
session_start(); // Start the session.
// If no session value is present,redirect the user:
 
//include ('includes/mailer.inc.php');
$fname=$_POST['Purpose'];
$lname=$_POST['Note'];
$sid=$_POST['studentid'];
$continue=0;
$today =  date('Y-m-d');
$student="";
$faculty="";
   
$q1="INSERT INTO appts (sid,fid,start_date,end_date,start_time,stop_time,description,note,status) VALUES ('".$_POST['studentid']."','".$_SESSION['user_id']."','".$today."','".$today."',CURTIME(),'".$_POST['time']."','".$_POST['Purpose']."','".$_POST['aNote']."',2)";
$newaptid="";
$time="";
$results1 = @mysql_query ($q1);
if($results1)
 echo "Successfully Created Appointment"; 
else
 echo " Try Again Later";  

 
 
?>
 