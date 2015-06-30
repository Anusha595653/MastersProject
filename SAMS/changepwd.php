<?php
error_reporting(0);
include("headers.php");
include("container.php");
getheader();
 require_once ('mysql_connect.php');
 
if($_SESSION['user_id']=='')
header ('location:index.php');
?>

 <div class="panel panel-primary" style="margin-top:-20px; border-radius:0px;">


      <div class="panel-body" >
	  <br><br><br>
  <div style="height:350px" >
  <form class="form-horizontal" id="form1" name="form1" method="post"  action="changepwd.php">
 
 <p align="left">
 <label style="color:orange;font-size:20px;">
 <img src="images/chpwd.jpg" width="150px" height="150px">
 Change Password Here</label></p><br />
    <div class="form-group" align="center">
	
      <label class="control-label col-sm-2" for="email">Password:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="password" id="password" placeholder="Enter Password">
      </div>
    </div>
   
    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Confirm-Password:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="confirm" id="confirm" placeholder="Enter Confirm Password">
      </div>
    </div>
	
    <div class="form-group">
	  <label class="control-label col-sm-2" for="email">&nbsp;</label>
    
      <div class="col-sm-4">
<button class="btn btn-primary"   name="submit" type="submit">submit</button>


</div></div>
	</form>
 <?php
  if($_GET["password"]=="success")
  {
	 echo "<script>alert('Successfully Updated Your Password')</script>";  
  }
  ?>

  <?php
  if(isset($_POST["submit"]))
  {
	 if($_POST["password"]!=''){
	  $updatepwd = "update Logins set pwd='".$_POST["password"]."' where user_id='".$_SESSION["user_id"]."'";
	$results3 = @mysql_query ($updatepwd);
     if($results3=="1")
	 {	 
  echo "<script>window.location = 'changepwd.php?password=success';</script>";
     }
  }
  else
  {
	 echo "<label style=color:red>Please Enter Password and confirm password</label>";
	  
  }
  }
  ?>
  <input type="hidden" name="updateid" id="updateid" value="'.$user.'"/> 
 
  </div> </div></div> 

<?php


include('footer.php');
?>