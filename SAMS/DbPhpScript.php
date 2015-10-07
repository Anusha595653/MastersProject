<?php

$dbh1 = mysql_connect("localhost","root","root") or die("Unable to connect to MySQL"); 
//Required when two databases are in different servers.
//$dbh2 = mysql_connect("localhost","root","root") or die("Unable to connect to MySQL");

// change database names here
$db1=src;
$db2=dest1;

// select the databases.
$db1_result=mysql_select_db($db1) or die('unable to select database:'. mysql_error());
$db2_result=mysql_select_db($db2) or die('unable to select database:'. mysql_error());

// select the databases if they are on different servers.
//$db1_result=mysql_select_db($db1,$dbh1);
//$db2_result=mysql_select_db($db2,$dbh2);

if($db1_result&&$db2_result)
{
	// Logins Table insertion
	echo "Logins table migration in progress.....\n";
	$LoginsSql="select * from ".$db1.".Logins";
	$result1=@mysql_query($LoginsSql);
	$countRows=@mysql_num_rows($result1);
	if (@mysql_num_rows($result1) !=0) 
	{//open php rows if
		$countMigRows=0;
		while ($row1 = @mysql_fetch_assoc($result1))
		{//open php while
			$password=base64_encode($row1['pwd']);
			$sql2="insert into ".$db2.".Logins(user_id,username,pwd,user_type)values('".$row1['user_id']."','".$row1['username']."','".$password."','".$row1['user_type']."')";
			$result2=@mysql_query($sql2) or die('unable to migrate logins table:'. mysql_error());
			$countMigRows=$countMigRows+$result2;
		}//close php while
	}//close php rows 
	if($countRows==$countMigRows)
	echo "Logins table migration completed.\n";
	else
	echo "Error with Logins table migration.\n";


	echo "Users table migration in progress.....\n";
	// USERS table insertion
	$UsersSql="Insert into ".$db2.".users(user_id,First_Name,Last_Name,Add2,phone,email)SELECT user_id,First_Name,Last_Name,Add2,phone,email FROM ".$db1.".users";
	$UsersResult=@mysql_query($UsersSql) or die('unable to migrate users table:'. mysql_error());
	if($UsersResult>=1)
	echo "Users table migration completed.\n";
	else
	echo "Error with Users table migration.\n";



	echo "StudentInfo table migration in progress.....\n";
	// StudentInfo table insertion
	$SdtinfoSql="Insert into ".$db2.".sdtinfo(user_id,level,major,status,ethnic,residency,addby,createdate,admissiondate,graduationdate)SELECT user_id,level,major,status,ethnic,residency,addby,createdate,admissiondate,graduationdate FROM ".$db1.".sdtinfo";
	$SdtinfoResult=@mysql_query($SdtinfoSql) or die('unable to migrate sdtinfo table:'. mysql_error());
	if($SdtinfoResult>=1)
	echo "StudentInfo table migration completed.\n";
	else
	echo "Error with StudentInfo table migration.\n";



	echo "Appointments table migration in progres.....";

	$tempTable="CREATE TABLE  ".$db2.".`temp` (`apptid` INT( 12 ) NULL ,`note` VARCHAR( 1000 )  NULL) ENGINE = MYISAM";
	$tempResult=@mysql_query($tempTable) or die('unable to create table temp:'. mysql_error());
	$insertTemp="insert into ".$db2.".temp(apptid,note)SELECT apptid, GROUP_CONCAT(note) AS note FROM ".$db1.".apptnote GROUP BY apptid";
	$insertResult=@mysql_query($insertTemp) or die('unable to insert into table temp:'. mysql_error());
		

	// Appointments table insertion
	$AppsSql="Insert into ".$db2.".appts(apptid,sid,fid,start_date,end_date,start_time,stop_time,description,note,status)SELECT a1.apptid,a1.sid,a1.fid,a1.start_date,a1.end_date,1.start_time,a1.stop_time,a1.description,a2.note,a1.status FROM ".$db1.".appts a1,".$db2.".temp a2 where a1.apptid=a2.apptid";
	$AppsResult=@mysql_query($AppsSql) or die('unable to migrate appts table:'. mysql_error());	
	$dropTemp=@mysql_query("drop table ".$db2.".temp");
	if($AppsResult>=1)
	echo "Appointments table migration completed.\n";
	else
	echo "Error with Appointments table migration.\n";



	echo "Files table migration in progress.....\n";
	// Files table insertion
	$FilesSql="Insert into ".$db2.".file(id,name,mime,size,data,created,apptid)SELECT id,name,mime,size,data,created,apptid FROM ".$db1.".file";
	$FilesResult=@mysql_query($FilesSql) or die('unable to migrate files table:'. mysql_error());
	if($FilesResult>=1)
	echo "Files table migration completed.\n";
	else
	echo "Error with Files table migration.\n";

	echo "Database table migration completed.Please check your new database content.\n";

}
else
{
	echo "Database not selected";
}
?>