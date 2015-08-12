<?php
$con = mysql_connect("localhost","abestha","abestha");

if (!$con) {
  die('Could not connect: ' . mysql_error());
}
 
mysql_select_db("db_Fall13_abestha", $con);
session_start();
$query = mysql_query($_SESSION["query"]);

$category = array();
$category['name'] = 'Month';

$series1 = array();
$series1['name'] = 'Students who meet the search criteria('.$_SESSION["squery1"].')';

$series2 = array();
$series2['name'] = '';

$series3 = array();
$series3['name'] = 'Total Students';

$value=0;
while($r = mysql_fetch_array($query)) {
  
 $value++;
}
$value1=0;
$query1 = mysql_query("select * from sdtinfo ");
while($r = mysql_fetch_array($query1)) {$value1++;}
 
 $category['data'][] = "Students";
    $series1['data'][] =$value;
    $series3['data'][] =$value1;
$result = array();
array_push($result,$category);
array_push($result,$series1);
array_push($result,$series2);
array_push($result,$series3);


print json_encode($result, JSON_NUMERIC_CHECK);

mysql_close($con);
?> 
