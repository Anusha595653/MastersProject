<?php
error_reporting(0);
 require_once ('mysql_connect.php');
# Script 11.9 - loggedin.php #2
// The user is redirected here from login.php.

include ('includes/mailer.inc.php');


$email=$_POST['email'];
 
 echo '<html>

<body>';
?>
 <script type="text/javascript">
function closewindow()
{
  ';

}
</script>
<?php
$userid="";
 
 
$dup = "select * from emails where  email = '".$_POST['email']."'";
	$r = @mysql_query ($dup);
		if (@mysql_num_rows($r) !=0) 
		{
			
			//open php rows if
			while ($row1 = @mysql_fetch_assoc($r))
			{//open php while
		    $user_id=$row1["sid"];
			 
	      	}//close php while
			$dup = "select * from Logins where  user_id= '".$user_id."'";
	$r = @mysql_query ($dup);
		if (@mysql_num_rows($r) !=0) 
		{
			while ($row1 = @mysql_fetch_assoc($r))
			{//open php while
		    $pwd=base64_decode($row1["pwd"]);
		    $uname=$row1["username"];

			 
	      	}
		}
			
			
			echo "<script>window.location = 'forgotpwd.php?msg=1'</script>";
		}//close php rows if
	 else
		 echo "<script>window.location = 'forgotpwd.php?msg=2'</script>";
 
 $subject = "Password Recovery";
$body = "Your User Name is ".$uname. "   and  Password is ".$pwd.".";
$faculty = $email;
sendmail();
 ?>
 <script type="text/javascript">
 
 </script>
</body>
</html>