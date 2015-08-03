<?php 

	require_once ('mysql_connect.php');
		$id1=$_GET['id'];
	     $query1 = "delete FROM `file` WHERE `id` = {$id1}";
       	$result12= @mysql_query($query1);
	
	echo "done"; 

?>