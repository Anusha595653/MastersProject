<?php
 require_once ('mysql_connect.php');
# Script 11.9 - loggedin.php #2
// The user is redirected here from login.php.
session_start(); // Start the session.
// If no session value is present,redirect the user:
if (!isset($_SESSION['user_id'])) {
require_once ('includes/login_functions.inc.php');
$url = absolute_url();
header("Location: $url");
exit();
}



$_POST['updateid'];
 
$_POST['phone'];
$_POST['email'];

$_POST['major'];
$_POST['level'];
$_POST['status'];
$password=$_POST['password'];
$person=$_POST['updateid'];
$type=$_SESSION['u_type'];
 $comments=$_POST['comments'];
 


echo '<html>

<body>';
$q1="select * from users where user_id = $person";
$q2="select * from sdtinfo where user_id = $person";
$r1 = @mysql_query ($q1);
if (@mysql_num_rows($r1) !=0)
{
		//echo "1";
$d1=("update users set phone = '" . $_POST['phone'] . "' ,email = '" . $_POST['email'] . "' where user_id = $person");
$r12 = @mysql_query ($d1);
}
//echo "person".$person;
 
$r2 = @mysql_query ($q2);
	if (@mysql_num_rows($r2) !=0)
	{
	//echo "3";
$d2=("update sdtinfo set level ='" . $_POST['level'] . "' ,status ='" . $_POST['status'] . "',major ='" . $_POST['major'] . "', residency = '".$_POST['residency']."',graduationdate = '".$_POST['graduation']."',admissiondate = '".$_POST['admission']."',Comments = '".$comments."' where user_id = $person");
	$r13 = @mysql_query ($d2);
	}
 

if(strlen($password)>=8)
{
	$q3="select * from Logins where user_id = $person";
	$r3 = @mysql_query ($q3);
	if (@mysql_num_rows($r3) !=0)
	{
	$d3=("update Logins set pwd ='" . $_POST['password']."' where user_id = $person");
	}
}

$results = @mysql_query($d1);
$results3 = @mysql_query($d3);

 
$results2 = @mysql_query($d2);
 


if ($results){}
 //echo "<h3> Updating personal info </h3>";
else
{
// echo "<h3> Update Failure</h3>";  
//echo $qry;
//echo	@mysql_error(); 
}
 
if ($results2){}
 //echo "<h3> Updating student info</h3>";
else
{
 //echo "<h3> Update Failure</h3>";  
//echo $qry;
//echo	@mysql_error(); 
}
 
?>
 <script type="text/javascript">
 <?php
 echo "window.location = 'begin.php?update=1';";
?>
</script>
</body>
</html>