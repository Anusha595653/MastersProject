
<?php
error_reporting(0);
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
h1,h2,h3{color:orange}
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
          <form role="form" id="newappt" name="newappt" method="post"  action="forgotprocess.php">
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span>Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
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
  <div style="height:301px" style="text-align:center">
 <?php
 
 if($_GET['msg']=="db")
 {
	 
	 echo "<script>alert('Database Created Successfully')</script>";
 }
 ?>
  <form class="form-horizontal" method="post" action="index1.php">
  <?php
  		    echo $errors[0];
?>
    <div class="form-group">
	<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login Here</h3>
      <label class="control-label col-sm-2" for="email">User Name:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="uid" placeholder="Enter User Name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-4">          
        <input type="password" class="form-control"  name="pass" placeholder="Enter password">
      </div>
    </div>
	
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Submit</button>
		<button type="button" class="btn btn-warning" id="myBtn">Forgot Password</button>
	 </div>
    </div>
  </form>
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
			</div><div class="col span_16" style="text-align:center;border-radius:0px">
			<i>Designed by: Anusha Bestha (abestha@neiu.edu)</i>
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
