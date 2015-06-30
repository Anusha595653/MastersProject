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
$apptid=$_GET['apptid'];
$sid=$_GET['sid'];
?>

<html>
<body>
<?php
	echo "hi";

$d1=("update appts set status =3 where apptid =".$_GET['apptid']);
$results1 = @mysql_query ($d1);

echo "<script>window.location.href='studentsrch.php?sid=$sid'</script>";	
 //echo "<input type=hidden name=sid id=sid value='$sid'>";
?>

 <script type="text/javascript">

</script>

</body>
</html>