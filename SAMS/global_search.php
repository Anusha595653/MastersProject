<?php
/*====================== Database Connection Code Start Here ======================= */

	require_once ('mysql_connect.php');
/*====================== Database Connection Code End Here ========================== */

// Here, we will get user input data and trim it, if any space in that user input data
$user_input = trim($_REQUEST['term']);

// Define two array, one is to store output data and other is for display
$display_json = array();
$json_arr = array();
 
$user_input = preg_replace('/\s+/', ' ', $user_input);
  $dquery="";
 $type="3";
$dquery='SELECT * FROM dup_users WHERE   user_id like "%'.$user_input.'%" or First_Name like "%'.$user_input.'%" or Last_Name like "%'.$user_input.'%"    ';
//WHERE bg.First_Name "%'.$user_input.'%"    and a.user_type="'.type.'" and bg.user_id=auser_id';				
//(bg.First_Name like "%'.$user_input.'%" or bg.Last_Name like "%'.$user_input.'%") or 	
$ip=0;
$query = $dquery;
$ip++;
	$recSql = mysql_query($query);
$ip++;
if(mysql_num_rows($recSql)>0){
$ip++;
while($recResult = mysql_fetch_assoc($recSql)) {
 $json_arr["id"] = "./studentsrch.php?sid=".$recResult['user_id'];
 //$json_arr["id"] = "./studentsrch.php?id="+$recResult['user_id'];

  $json_arr["value"] = $recResult['First_Name'];
  $json_arr["label"] =$recResult['First_Name']."-".$recResult['Last_Name']."(". $recResult['user_id'].")";
   
  array_push($display_json, $json_arr);
}
} else {


  $json_arr["id"] = "#";
  $json_arr["value"] = "";
  $json_arr["label"] = "No Result Found !"	;

  array_push($display_json, $json_arr);
}
 
	
$jsonWrite = json_encode($display_json); 
//encode that search data
print $jsonWrite;
?>