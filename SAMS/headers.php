<?php
 function getheader(){
	 	 
 SESSION_sTART();
 
if($_SESSION['user_id']=='')
	header('location:index.php');
if($_SESSION['u_type']=='2'){
echo "
<!DOCTYPE html>
<html lang='en'>
<head>
  <title>SAMS</title>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
      <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>

  <link rel='stylesheet' href='localbootstrap.css'>
  <script src='jquery.min.js'></script>
  <script src='bootstrap.min.js'></script>
</head>
<style>
h1,h2{color:orange}
body{background-color:#D8DDD8}
</style>
<body>
<br>
<div class='container'>
  <div class='jumbotron' style='background-color:white;border-radius: 0px;height:auto;margin-top:-40px'>
  
  <div class='row' style='overflow:auto' >
    <div class='col-sm-2 col-md-4'>
    <h2><img src='clogo.gif' class='img-responsive' style='width:250px;'></h2> 

  </div>
    <div class='col-sm-2 col-md-8' >
<h2 style='color:#FFA834;font-family:bold;'>&nbsp;&nbsp;&nbsp;DEPARTMENT OF COMPUTER SCIENCE</h2>

<h2 style='color:#00A4D3;font-family:bold'>&nbsp;GRADUATE STUDENT ADVISING SYSTEM</h2>
<h5 style='color:green;font-family:bold;text-align:right'>&nbsp;
  Welcome     $_SESSION[f_name]</h5>

    </div>
  </div>

  
  
  
  
  </div>
  <nav class='navbar navbar-inverse' style='margin-top:-65px;border-radius: 0px'>
  <div class='container-fluid'>
    <div class='navbar-header'>
      <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span> 
      </button>
      <a class='navbar-brand' href='#'>&nbsp;</a>
    </div>
    <div class='collapse navbar-collapse' id='myNavbar'>
      <ul class='nav navbar-nav'>
	  
	  



        <li class='active'><a href='begin.php'>HOME</a></li>
        <li><a href='AddStudent.php?type=1'>ADD STUDENT</a></li>
        <li><a href='AddFaculty.php'>ADD FACULTY/STAFF</a></li> 
      
		<li><a href='Chart.php'>CHART BUILDER</a></li> 
		 <li class='dropdown'>
          <a class='dropdown-toggle' data-toggle='dropdown' href='#'>SETTINGS
          <span class='caret'></span></a>
          <ul class='dropdown-menu'>
            <li><a href='changepwd.php'>CHANGE PASSWORD</a></li>
            <li><a href='updateinfo.php?q=".$_SESSION['stu_id']."&t=1&u=1'>UPDATE PROFILE</a></li>
          </ul>
        </li>
      </ul>
	  <ul class='nav navbar-nav navbar-right'>
        <li><a href='logout.php'> <span class='glyphicon glyphicon-log-out'> LOGOUT</span></a></li>
      </ul>
    </div>
  </div>
</nav>

  
  <!-- Trigger the modal with a button -->
  
  <!-- Modal -->
  <div class='modal fade' id='myModal' role='dialog' >
    <div class='modal-dialog'>

      <!-- Modal content-->
      <div class='modal-content'>
        <div class='modal-header' style=''>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 style='color:red;'><span class='glyphicon glyphicon-lock'></span> Forgot Password</h4>
        </div>
        <div class='modal-body'>
          <form role='form'>
            <div class='form-group'>
              <label for='usrname'><span class='glyphicon glyphicon-user'></span>Email</label>
              <input type='text' class='form-control' id='usrname' placeholder='Enter email'>
            </div>
          
            <button type='submit' class='btn btn-default btn-success btn-block'><span class='glyphicon glyphicon-off'></span> Submit</button>
          </form>
        </div>
        <div class='modal-footer'>
          <button type='submit' class='btn btn-default btn-default pull-left' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancel</button>
         
        </div>
      </div>
    </div>
  </div> ";
 }
 if($_SESSION['u_type']=='3')
{
echo "
<!DOCTYPE html>
<html lang='en'>
<head>
  <title>SAMS</title>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
      <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>

  <link rel='stylesheet' href='localbootstrap.css'>
  <script src='jquery.min.js'></script>
  <script src='bootstrap.min.js'></script>
</head>
<style>
h1,h2{color:orange}
body{background-color:#D8DDD8}
</style>
<body>
<br>
<div class='container'>
  <div class='jumbotron' style='background-color:white;border-radius: 0px;height:auto;margin-top:-40px'>
  
  <div class='row' style='overflow:auto' >
    <div class='col-sm-2 col-md-4'>
    <h2><img src='clogo.gif' class='img-responsive' style='width:250px;'></h2> 

  </div>
    <div class='col-sm-2 col-md-8' >
<h2 style='color:#FFA834;font-family:bold;'>&nbsp;&nbsp;&nbsp;DEPARTMENT OF COMPUTER SCIENCE</h2>

<h2 style='color:#00A4D3;font-family:bold'>&nbsp;GRADUATE STUDENT ADVISING SYSTEM</h2>
<h5 style='color:green;font-family:bold;text-align:right'>&nbsp;Welcome     $_SESSION[f_name]</h5>
    </div>
  </div>

  
  
  
  
  
  </div>
  <nav class='navbar navbar-inverse' style='margin-top:-65px;border-radius: 0px'>
  <div class='container-fluid'>
    <div class='navbar-header'>
      <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span> 
      </button>
      <a class='navbar-brand' href='#'>&nbsp;</a>
    </div>
    <div class='collapse navbar-collapse' id='myNavbar'>
      <ul class='nav navbar-nav'>
	  
	 
 
      <li><a href='student.php'><span>HOME</span></a></li>
 
<li class='dropdown'>
          <a class='dropdown-toggle' data-toggle='dropdown' href='#'>SETTINGS
          <span class='caret'></span></a>
          <ul class='dropdown-menu'>


 <li><a href='changepwd.php'><span>CHANGE PASSWORD</span></a></li>
	 
	 <li><a href='updateinfo.php?q=".$_SESSION['stu_id']."&t=2&u=1'><span>UPDATE PROFILE</span></a>

	 
	 </li> </ul>
        </li>




      </ul>
	  <ul class='nav navbar-nav navbar-right'>
        <li><a href='logout.php'> <span class='glyphicon glyphicon-log-out'> LOGOUT</span></a></li>
      </ul>
    </div>
  </div>
</nav>

  
  <!-- Trigger the modal with a button -->
  
  <!-- Modal -->
  <div class='modal fade' id='myModal' role='dialog' >
    <div class='modal-dialog'>

      <!-- Modal content-->
      <div class='modal-content'>
        <div class='modal-header' style=''>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 style='color:red;'><span class='glyphicon glyphicon-lock'></span> Forgot Password</h4>
        </div>
        <div class='modal-body'>
          <form role='form'>
            <div class='form-group'>
              <label for='usrname'><span class='glyphicon glyphicon-user'></span>Email</label>
              <input type='text' class='form-control' id='usrname' placeholder='Enter email'>
            </div>
          
            <button type='submit' class='btn btn-default btn-success btn-block'><span class='glyphicon glyphicon-off'></span> Submit</button>
          </form>
        </div>
        <div class='modal-footer'>
          <button type='submit' class='btn btn-default btn-default pull-left' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancel</button>
         
        </div>
      </div>
    </div>
  </div> ";
 }

 
  if($_SESSION['u_type']=='4')
{
echo "
<!DOCTYPE html>
<html lang='en'>
<head>
  <title>SAMS</title>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
      <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>

  <link rel='stylesheet' href='localbootstrap.css'>
  <script src='jquery.min.js'></script>
  <script src='bootstrap.min.js'></script>
</head>
<style>
h1,h2{color:orange}
body{background-color:#D8DDD8}
</style>
<body>
<br>
<div class='container'>
  <div class='jumbotron' style='background-color:white;border-radius: 0px;height:auto;margin-top:-40px'>
  
  <div class='row' style='overflow:auto' >
    <div class='col-sm-2 col-md-4'>
    <h2><img src='clogo.gif' class='img-responsive' style='width:250px;'></h2> 

  </div>
    <div class='col-sm-2 col-md-8' >
<h2 style='color:#FFA834;font-family:bold;'>&nbsp;&nbsp;&nbsp;DEPARTMENT OF COMPUTER SCIENCE</h2>

<h2 style='color:#00A4D3;font-family:bold'>&nbsp;GRADUATE STUDENT ADVISING SYSTEM</h2>
<h5 style='color:green;font-family:bold;text-align:right'>&nbsp;Welcome     $_SESSION[f_name]</h5>
    </div>
  </div>

  
  
  
  
  
  </div>
  <nav class='navbar navbar-inverse' style='margin-top:-65px;border-radius: 0px'>
  <div class='container-fluid'>
    <div class='navbar-header'>
      <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span> 
      </button>
      <a class='navbar-brand' href='#'>&nbsp;</a>
    </div>
    <div class='collapse navbar-collapse' id='myNavbar'>
      <ul class='nav navbar-nav'>
	  
	        <li><a href='staff.php'><span>HOME</span></a></li>

        <li><a href='AddStudent.php?type=3'>ADD STUDENT</a></li>
<li class='dropdown'>
          <a class='dropdown-toggle' data-toggle='dropdown' href='#'>SETTINGS
          <span class='caret'></span></a>
          <ul class='dropdown-menu'>

	  <li><a href='changepwd.php'><span>CHANGE PASSWORD</span></a></li>
	 
	 <li><a href='updateinfo.php?q=".$_SESSION['stu_id']."&t=1&u=1'><span>UPDATE PROFILE</span></a>
 
	 </li>
          </ul>
        </li>
</ul>
	  <ul class='nav navbar-nav navbar-right'>
        <li><a href='logout.php'> <span class='glyphicon glyphicon-log-out'> LOGOUT</span></a></li>
      </ul>
    </div>
  </div>
</nav>

  
  <!-- Trigger the modal with a button -->
  
  <!-- Modal -->
  <div class='modal fade' id='myModal' role='dialog' >
    <div class='modal-dialog'>

      <!-- Modal content-->
      <div class='modal-content'>
        <div class='modal-header' style=''>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 style='color:red;'><span class='glyphicon glyphicon-lock'></span> Forgot Password</h4>
        </div>
        <div class='modal-body'>
          <form role='form'>
            <div class='form-group'>
              <label for='usrname'><span class='glyphicon glyphicon-user'></span>Email</label>
              <input type='text' class='form-control' id='usrname' placeholder='Enter email'>
            </div>
          
            <button type='submit' class='btn btn-default btn-success btn-block'><span class='glyphicon glyphicon-off'></span> Submit</button>
          </form>
        </div>
        <div class='modal-footer'>
          <button type='submit' class='btn btn-default btn-default pull-left' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancel</button>
         
        </div>
      </div>
    </div>
  </div> ";
 }

  if($_SESSION['u_type']=='1')
{
echo "
<!DOCTYPE html>
<html lang='en'>
<head>
  <title>SAMS</title>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
      <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>

  <link rel='stylesheet' href='localbootstrap.css'>
  <script src='jquery.min.js'></script>
  <script src='bootstrap.min.js'></script>
</head>
<style>
h1,h2{color:orange}
body{background-color:#D8DDD8}
</style>
<body>
<br>
<div class='container'>
  <div class='jumbotron' style='background-color:white;border-radius: 0px;height:auto;margin-top:-40px'>
  
  <div class='row' style='overflow:auto' >
    <div class='col-sm-2 col-md-4'>
    <h2><img src='clogo.gif' class='img-responsive' style='width:250px;'></h2> 

  </div>
    <div class='col-sm-2 col-md-8' >
<h2 style='color:#FFA834;font-family:bold;'>&nbsp;&nbsp;&nbsp;DEPARTMENT OF COMPUTER SCIENCE</h2>

<h2 style='color:#00A4D3;font-family:bold'>&nbsp;GRADUATE STUDENT ADVISING SYSTEM</h2>
<h5 style='color:green;font-family:bold;text-align:right'>&nbsp;Welcome     $_SESSION[f_name]</h5>
    </div>
  </div>

  
  
  
  
  
  </div>
  <nav class='navbar navbar-inverse' style='margin-top:-65px;border-radius: 0px'>
  <div class='container-fluid'>
    <div class='navbar-header'>
      <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span> 
      </button>
      <a class='navbar-brand' href='#'>&nbsp;</a>
    </div>
    <div class='collapse navbar-collapse' id='myNavbar'>
	

      <ul class='nav navbar-nav'>
	      <li><a href='faculty.php'><span>HOME</span></a></li>

        <li><a href='AddStudent.php?type=2'>ADD STUDENT</a></li>
     <!-- <li><a href='viewapts.php'><span>VIEW APPOINTMENTS</span></a></li>
	        <li><a href='viewstds.php'><span>VIEW STUDENTS</span></a></li>-->
<li class='dropdown'>
          <a class='dropdown-toggle' data-toggle='dropdown' href='#'>SETTINGS
          <span class='caret'></span></a>
          <ul class='dropdown-menu'>
	  <li><a href='changepwd.php'><span>CHANGE PASSWORD</span></a></li>
	 
	 <li><a href='updateinfo.php?q=".$_SESSION['stu_id']."&t=1&u=1'><span>UPDATE PROFILE</span></a>
 </ul>
        </li>
	 
	 </li>
  
	  </ul>
	  <ul class='nav navbar-nav navbar-right'>
        <li><a href='logout.php'> <span class='glyphicon glyphicon-log-out'> LOGOUT</span></a></li>
      </ul>
    </div>
  </div>
</nav>

  
  <!-- Trigger the modal with a button -->
  
  <!-- Modal -->
  <div class='modal fade' id='myModal' role='dialog' >
    <div class='modal-dialog'>

      <!-- Modal content-->
      <div class='modal-content'>
        <div class='modal-header' style=''>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 style='color:red;'><span class='glyphicon glyphicon-lock'></span> Forgot Password</h4>
        </div>
        <div class='modal-body'>
          <form role='form'>
            <div class='form-group'>
              <label for='usrname'><span class='glyphicon glyphicon-user'></span>Email</label>
              <input type='text' class='form-control' id='usrname' placeholder='Enter email'>
            </div>
          
            <button type='submit' class='btn btn-default btn-success btn-block'><span class='glyphicon glyphicon-off'></span> Submit</button>
          </form>
        </div>
        <div class='modal-footer'>
          <button type='submit' class='btn btn-default btn-default pull-left' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancel</button>
         
        </div>
      </div>
    </div>
  </div> ";
 }

 
 
 
 
 
 
 }
 ?>