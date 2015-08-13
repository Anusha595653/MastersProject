<?php
include('mysql_connect.php');
	 $st = mysql_query("update appts set note='$_POST[Note]',description='$_POST[epurpose]'   where apptid='$_POST[appid]'") ;
$close=$_POST['close'];
$apptid=$_POST['appid'];
if(!empty($close))
{

	$d1=("update appts set status =3 where apptid =".$apptid);
	$results1 = @mysql_query ($d1);

	echo "Successfully updated and closed appointment";
}
else
{
 echo "Successfully updated appointment";
}
?>
