<?php
error_reporting(0);
 
	require_once ('includes/login_functions.inc.php');
	require_once ('mysql_connect.php');
	list ($check, $data) = check_login($_POST['uid'], $_POST['pass']);
		if ($check)
		{// OK!
			session_start();
			// Set the session data:.
			//init_set('session.gc_maxlifetime','3600');
			$_SESSION['id'] = $data['user_id'];
			$_SESSION['user_id'] = $data['user_id'];
			if ($data['user_type']== 1);
				$_SESSION['admin'] = 'true';
			// Redirect:
			$url = absolute_url ('main.php');
			header("Location: $url");
			exit();
		} else 
		{ // Unsuccessful!
 
			$errors = $data;
		 
		}

?>
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

  
  <!-- Trigger the modal with a button -->
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span> Forgot Password</h4>
        </div>
        <div class="modal-body">
          <form role="form">
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span>Email</label>
              <input type="text" class="form-control" id="usrname" placeholder="Enter email">
            </div>
          
            <button type="submit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Submit</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
         
        </div>
      </div>
    </div>
  </div> 
 <div class="panel panel-primary" style="margin-top:-20px; border-radius:0px;">

      <div class="panel-body" >
	  <br><br><br>
  <div style="height:301px" >
 

<?php
//This page requires mysql_connect.php
/*Users are redirected here after a successful login. the welcome is displayed
and then the users is redirected to begin.php
*/
require_once ('mysql_connect.php');
session_start();


 

// If no session value is present,redirect the user:
	if (!isset($_SESSION['user_id'])) 
	{
		require_once ('includes/login_functions.inc.php');	
		$url = absolute_url();
		header("Location: $url");
		exit();
	}
//set $user to be the session user id
$user = $_SESSION['user_id'];
//create search for users first name based on the user_id
$q1="select First_Name, user_type from users,Logins where Logins.user_id = users.user_id and users.user_id= $user";

$r1 = @mysql_query ($q1);
if (@mysql_num_rows($r1) !=0) 
{//open php rows if
	while ($row1 = @mysql_fetch_assoc($r1))
	{//open php while
		$name = $row1['First_Name'];
		$u_type = $row1['user_type'];

		$_SESSION['f_name']=$name;
		$_SESSION['u_type']=$u_type;
		//check the user type returned by the search, if users is a student, set start=1 and redirect to student.php
		//if users is admin or faculty, redirect to begin.php
		if ($u_type == 3)
		{
			$_SESSION['stu_id']=$user;
			$meta = '<meta http-equiv="Refresh" content="3;url=student.php?q='.$_SESSION["user_id"].'&start=1" />';
		}
		else
		if ($u_type == 1)
		{
			$_SESSION['stu_id']=0;
			$meta = '<meta http-equiv="Refresh" content="3;url=faculty.php" />';
		}
		else
		if ($u_type == 2)
		{
			$_SESSION['stu_id']=$user;
			$meta = '<meta http-equiv="Refresh" content="3;url=begin.php" />';
		}
		else
		if ($u_type == 4)
		{
			$_SESSION['stu_id']=$user;
			$meta = '<meta http-equiv="Refresh" content="3;url=staff.php" />';
		}
		
	}
}

?>
 

 <?php
session_start();
echo $meta;
//print welcome with users name
echo ("<h3><br>Welcome to the Student Advisement System {$_SESSION['f_name']}.</h3>");
?>
<p>Please remember to log out of the system when finished.</p>
<p>Report all issues to the site administrator.</p>
<style>
h3,p{text-align:center}
</style> 
 </div>
    </div>

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
 <div class="panel panel-primary" style="margin-top:-20px;border-radius:0px;background-color:#00A4D3">
      <div class="panel-heading" style="border-radius:0px;background-color:#00A4D3"><div class="col span_16" style="text-align:center;border-radius:0px">
			5500 North St.Louis Ave, Chicago , IL , 60625
			</div></div>
</div>

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
