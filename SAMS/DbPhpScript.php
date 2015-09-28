<?php

$dbh1 = mysql_connect("localhost","root","root") or die("Unable to connect to MySQL"); 
//Required when two databases are in different servers.
//$dbh2 = mysql_connect("localhost","root","root") or die("Unable to connect to MySQL");

// change database names here
$db1=sourceDb;
$db2=destinationDb;

// select the databases.
$db1_result=mysql_select_db($db1);
$db2_result=mysql_select_db($db2);

// select the databases if they are on different servers.
//$db1_result=mysql_select_db($db1,$dbh1);
//$db2_result=mysql_select_db($db2,$dbh2);

if($db1_result&&$db2_result)
{
	// Logins Table insertion
	echo "Logins table migration in progres.....\n";
	$LoginsSql="select * from ".$db1.".Logins";
	$result1=@mysql_query(LoginsSql);
	
	if (@mysql_num_rows($result1) !=0) 
	{//open php rows if

		while ($row1 = @mysql_fetch_assoc($result1))
		{//open php while
			$password=base64_encode($row1['pwd']);
			$sql2="insert into ".$db2.".Logins(user_id,username,pwd,user_type)values('".$row1['user_id']."','".$row1['username']."','".$password."','".$row1[user_type]."')";
			$result2=@mysql_query($sql2);
		}//close php while
	}//close php rows i
	echo "Logins table migration completed.\n";

	// logins table insertion
	/***$loginsSql="Insert into ".$db2.".Logins(user_id,username,pwd,user_type)SELECT user_id,username,pwd,user_type FROM ".$db1.".Logins";
	$loginsResult=@mysql_query($loginsSql);
	
	$updateSql="update".$db2.".Logins set pwd=base64_encode(pwd)";
	$resultupdate=@mysql_query($updateSql);***/


	echo "Users table migration in progres.....\n";
	// USERS table insertion
	$UsersSql="Insert into ".$db2.".users(user_id,First_Name,Last_Name,Add2,phone,email)SELECT user_id,First_Name,Last_Name,Add2,phone,email FROM ".$db1.".users";
	$UsersResult=@mysql_query($UsersSql);
	echo "Users table migration completed.\n";


	echo "StudentInfo table migration in progres.....\n";
	// StudentInfo table insertion
	$SdtinfoSql="Insert into ".$db2.".sdtinfo(user_id,level,major,status,ethnic,residency,addby,createdate,admissiondate,graduationdate)SELECT user_id,level,major,status,ethnic,residency,addby,createdate,admissiondate,graduationdate FROM ".$db1.".sdtinfo";
	$SdtinfoResult=@mysql_query($SdtinfoSql);
	echo "StudentInfo table migration completed.\n";

	echo "Appointments table migration in progres.....";
	// Appointments table insertion
	$AppsSql="Insert into ".$db2.".appts(apptid,sid,fid,start_date,end_date,start_time,stop_time,description,note,status)SELECT a1.apptid,a1.sid,a1.fid,a1.start_date,a1.end_date,1.start_time,a1.stop_time,a1.description,a2.note,a1.status FROM ".$db1.".appts a1,".$db1.".apptnote a2 where a1.apptid=a2.apptid";
	$AppsResult=@mysql_query($AppsSql);
	echo "Appointments table migration completed.\n";

	echo "Files table migration in progres.....\n";
	// Files table insertion
	$FilesSql="Insert into ".$db2.".file(id,name,mime,size,data,created,apptid)SELECT id,name,mime,size,data,created,apptid FROM ".$db1.".file";
	$FilesResult=@mysql_query($FilesSql);
	echo "Files table migration completed.\n";
	echo "Database table migration completed.Please check your new database content.\n";

}
else
{
	echo "Database not selected";
}
?>