 
<!DOCTYPE html>
<html lang="en">
<head>
  <title>SAMS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

  <link rel="stylesheet" href="localbootstrap.css">
  <script src="jquery.min.js"></script>
  <script src="bootstrap.min.js"></script>
</head>
<style>
h1,h2{color:orange}
body{background-color:#D8DDD8}
</style>
<body>
<br>
<div class="container">
  <div class="jumbotron" style="background-color:white;border-radius: 0px;height:auto;margin-top:-40px">
  
  <div class="row" style="overflow:auto" >
    <div class="col-sm-2 col-md-4">
    <h2><img src="clogo.gif" class="img-responsive" style="width:250px;"></h2> 

  </div>
    <div class="col-sm-2 col-md-8" >
<h2 style="color:#FFA834;font-family:bold;">&nbsp;&nbsp;&nbsp;DEPARTMENT OF COMPUTER SCIENCE</h2>

<h2 style="color:#00A4D3;font-family:bold">&nbsp;GRADUATE STUDENT ADVISING SYSTEM</h2>
    </div>
  </div>

  
  
  
  
  
  </div>
  <nav class="navbar navbar-inverse" style="margin-top:-65px;border-radius: 0px">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">&nbsp;</a>
    </div>
  <!--  <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Page 1</a></li>
        <li><a href="#">Page 2</a></li> 
        <li><a href="#">Page 3</a></li> 
		 <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Page 1-1</a></li>
            <li><a href="#">Page 1-2</a></li>
            <li><a href="#">Page 1-3</a></li> 
          </ul>
        </li>
      </ul>
    </div>-->
  </div>
</nav>

   
 <div class="panel panel-primary" style="margin-top:-20px; border-radius:0px;">

      <div class="panel-body" >
	  <br><br><br>
  <div style="height:301px" >
 
  <form class="form-horizontal" method="post" action="">
  
    <div class="form-group">
		<h3 style="color:orange;font-size:20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Database Configuration</h3>
   
      <label class="control-label col-sm-2" for="email">Host:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="host">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Database Name:</label>
      <div class="col-sm-4">          
        <input type="text" class="form-control"  name="dbn">
      </div>
    </div>


  
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
		 </div>
    </div></form>
  </div>
    </div>
		<?php
if(isset($_POST["submit"])&&isset($_POST["dbn"]))
{
	$conn=mysql_connect("localhost","root","");
	$sql="CREATE DATABASE ".$_POST["dbn"];
	if(mysql_query($sql,$conn))
	{
	 
	$db_result=mysql_select_db($_POST["dbn"]);
	if($db_result)
	{
	 

		$tablecreate1 ="CREATE TABLE  ".$_POST['dbn'].".`Logins` (`user_id` INT( 12 ) NOT NULL ,`username` VARCHAR( 20 ) NOT NULL ,`pwd` VARCHAR( 100 ) NOT NULL ,`user_type` INT( 1 ) NOT NULL,PRIMARY KEY(user_id) ) ENGINE = MYISAM";
$created1 = @mysql_query ($tablecreate1);

$tablecreate2 ="CREATE TABLE  ".$_POST['dbn'].".`users` (`user_id` INT( 12 ) NOT NULL ,`First_Name` VARCHAR( 15 ) NOT NULL,`Last_Name` VARCHAR( 15 ) NOT NULL,`Add2` VARCHAR( 15 ) NULL DEFAULT NULL,`phone` VARCHAR( 15 ) NOT NULL,`email` VARCHAR( 150 ) NOT NULL ) ENGINE = MYISAM";
$created2 = @mysql_query ($tablecreate2);

$tablecreate3 ="CREATE TABLE  ".$_POST['dbn'].".`sdtinfo` (`user_id` INT( 12 ) NOT NULL,`level` VARCHAR( 15 ) NOT NULL,`major` VARCHAR( 30 ) NOT NULL,`status` VARCHAR( 20 ) NOT NULL,`ethnic` VARCHAR( 20 ) NOT NULL,`residency` VARCHAR( 15 ) NOT NULL,`addby` INT( 12 ) NOT NULL ,`createdate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,`admissiondate` DATE NOT NULL,`graduationdate` DATE NULL DEFAULT NULL,`Comments` VARCHAR( 100 ) NOT NULL ) ENGINE = MYISAM";
$created3 = @mysql_query ($tablecreate3);

$tablecreate4 ="CREATE TABLE  ".$_POST['dbn'].".`appts` (`apptid` INT( 11 ) NOT NULL KEY AUTO_INCREMENT ,`sid` INT( 12 ) NOT NULL ,`fid` INT( 12 ) NOT NULL ,`start_date` DATE NOT NULL,`end_date` DATE NOT NULL,`start_time` TIME NOT NULL,`stop_time` TIME NOT NULL,`description` VARCHAR( 300 ) NOT NULL,`status` INT( 1 ) NOT NULL ) ENGINE = MYISAM";
$created4 = @mysql_query ($tablecreate4);

$tablecreate5 ="CREATE TABLE  ".$_POST['dbn'].".`apptnote` (`primary` INT( 11 ) NOT NULL ,`apptid` INT( 5 ) NOT NULL ,`date` DATE NOT NULL,`time` TIME NOT NULL, `fid` INT( 12 ) NOT NULL ,`note` VARCHAR( 300 ) NOT NULL) ENGINE = MYISAM";
$created5 = @mysql_query ($tablecreate5);

$tablecreate6 ="CREATE TABLE  ".$_POST['dbn'].".`file` (`id` INTEGER AUTO_INCREMENT PRIMARY KEY,`name` VARCHAR( 255 ) NOT NULL ,`mime` VARCHAR( 75 ) NOT NULL ,`size` BIGINT( 20 ) UNSIGNED NOT NULL ,`data` MEDIUMBLOB NOT NULL ,`created` DATETIME NOT NULL ,`apptid` INT( 10 ) NOT NULL) ENGINE = MYISAM";
$created6 = @mysql_query ($tablecreate6);


$tablecreate7 ="CREATE TABLE  ".$_POST['dbn'].".`dup_users` (`user_id` INT( 12 ) NOT NULL ,`First_Name` VARCHAR( 15 ) NOT NULL,`Last_Name` VARCHAR( 15 ) NOT NULL )";
$created7 = @mysql_query ($tablecreate7);


$tablecreate8 ="CREATE TABLE  ".$_POST['dbn'].".`emails` (`user_id` INT( 12 ) NOT NULL ,`email` VARCHAR( 15 ) NOT NULL )";
$created8 = @mysql_query ($tablecreate8);

$tablecreate9 ="CREATE TABLE  ".$_POST['dbn'].".`dropDown` (`concentration` VARCHAR( 50) ,`level` VARCHAR( 50) ,`status` VARCHAR( 50) ,`ethinicity` VARCHAR( 50) , `residency` VARCHAR( 50))";
$created9 = @mysql_query ($tablecreate9);



$q1="INSERT INTO users (user_id,First_Name, Last_Name,phone, email) VALUES ('000000','Admin','Admin','change me2','change me')";
$results1 = @mysql_query ($q1);

$password=base64_encode(administrator);

$createLogin = "INSERT INTO Logins (user_id,username,pwd,user_type) values ('000000','root','".$password."','2')";
$results3 = @mysql_query ($createLogin);

$i1="INSERT INTO dropDown(concentration,level,status,ethinicity,residency) VALUES ('Information Systems','Undergraduate','FULL','Caucasian','Resident')";
$results4 = @mysql_query ($i1);

$i2="INSERT INTO dropDown(concentration,level,status,ethinicity,residency) VALUES ('Computer Science','Graduate','PREQ','African American','Non-Resident')";
$results5 = @mysql_query ($i2);

$i3="INSERT INTO dropDown(level,status,ethinicity,residency) VALUES ('Post-Graduate','DENIED','Hispanic','International')";
$results6 = @mysql_query ($i3);

$i4="INSERT INTO dropDown(status,ethinicity) VALUES ('DEFERRED','Asian')";
$results7 = @mysql_query ($i4);

$i5="INSERT INTO dropDown(status,ethinicity) VALUES ('INACTIVE','Middle eastern')";
$results8 = @mysql_query ($i5);

$i6="INSERT INTO dropDown(ethinicity) VALUES ('Pacific Islander')";
$results9 = @mysql_query ($i6);

$i7="INSERT INTO dropDown(ethinicity) VALUES ('Native American/Alaskan')";
$results10 = @mysql_query ($i7);

$i8="INSERT INTO dropDown(ethinicity) VALUES ('Other')";
$results11 = @mysql_query ($i8);

$FileName = "mysql_connect.php";
$FileHandle = fopen($FileName, 'w') or die("can't open file");
$code="<?php  # mysql_connect.php
//required for all pages
// Define constants for connection
define ('DB_USER', 'root');      // replace xxxx with your mysql username    
define ('DB_PASSWORD', '');  // replace yyyy with your mysql password
define ('DB_HOST', 'localhost');
define ('DB_NAME', '".$_POST['dbn']."');      // replace zzzzzz with your database name

// Connect to DB and select main DB
\$dbc = @mysql_connect( DB_HOST, DB_USER, DB_PASSWORD) or
die('Could not connect to  MySQL: '. mysql_error());

@mysql_select_db(DB_NAME) or
die('Could not select the database: '. mysql_error());

?>
";
fwrite($FileHandle, $code);
fclose($FileHandle);
 
		echo "<script>window.location.href='index.php?msg=db'</script>
";
	}
	else
	{
	echo "<p style='color:red>Database is Already Existed!<br>Try Again";	
	}
}
else
	{
 	
	}
}
else
{
	echo "<p style='color:red>Please Enter the Details";	
}
 ?>




</div>
 <div class="panel panel-primary" style="margin-top:-20px;border-radius:0px;background-color:#00A4D3">
      <div class="panel-heading" style="border-radius:0px;background-color:#00A4D3"><div class="col span_16" style="text-align:center;border-radius:0px">
			5500 North St.Louis Ave, Chicago , IL , 60625
			</div></div>
</div>

<!--
  <div class="table-responsive" style=" border: 1px solid black;">          
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Firstname</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>       <div class="col-sm-5">
        <input type="email" class="form-control" id="email" placeholder="Enter email">
      </div>

</td>
      </tr>
      <tr>
        <td>2</td>
        <td>Debbie</td>
      </tr>
      <tr>
        <td>3</td>
        <td>John</td>
      </tr>
    </tbody>
  </table>
  </div>
-->

</body>
</html>
<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>
  <style>
  .modal-header, h4, .close {
      background-color: #5cb85c;
      color:white !important;
      text-align: center;
      font-size: 30px;
  }
  .modal-footer {
      background-color: #f9f9f9;
  }
  </style>
