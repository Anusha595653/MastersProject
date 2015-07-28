<?php
include('mysql_connect.php');
	 $st = mysql_query("update appts set note='$_POST[Note]',description='$_POST[epurpose]'   where apptid='$_POST[appid]'") ;
 echo "Successfully Updated appointment notes";
?>
