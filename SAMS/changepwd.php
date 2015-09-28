<?php
error_reporting(0);
include("headers.php");
include("container.php");
getheader();
 require_once ('mysql_connect.php');
 
if($_SESSION['user_id']=='')
header ('location:index.php');
$userId=$_SESSION['user_id'];
$t=$_GET["t"];
?>
<script src="./content/jquery.js"></script>
<!-- JQUERY -->
<link href="jquery.custom.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
 <div class="panel panel-primary" style="margin-top:-20px; border-radius:0px;">


      <div class="panel-body" >
	  <br><br><br>
  <div style="height:400px" >
  <form class="form-horizontal" id="form1" name="form1" method="post"  action="changepwd.php">
 
 <p align="left">
 <label style="color:orange;font-size:20px;">
 <img src="images/chpwd.jpg" width="150px" height="150px">
 Change Password Here</label></p><br />

	<div class="form-group" align="center">
	
      <label class="control-label col-sm-2" for="email">Old Password:</label>
      <div class="col-sm-4">
        <input type="password" class="form-control"  name="pass" id="pass" onkeyup="nameSearch(this.value,'oldPass')" placeholder="Enter Old Password" required>
      </div>
    </div>

<div class="form-group">
	
      <label class="control-label col-sm-2" for="email"></label>
      <div class="col-sm-4" id="oldPass" style="display:none">
	 
      </div>
    </div>


    <div class="form-group" align="center">
	
      <label class="control-label col-sm-2" for="email">Password:</label>
      <div class="col-sm-4">
        <input type="password" class="form-control"  name="password" id="password" placeholder="Enter Password" required>
      </div>
    </div>
   
    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Confirm-Password:</label>
      <div class="col-sm-4">
        <input type="password" class="form-control"  name="confirm" id="confirm" placeholder="Enter Confirm Password" required oninput="check(this)">
      </div>
    </div>


<script language='javascript' type='text/javascript'>
    function check(input) {
        if (input.value != document.getElementById('password').value) {
            input.setCustomValidity('Password Must be Matching.');
        } else {
            // input is valid -- reset the error message
            input.setCustomValidity('');
        }
    }
</script>
	
    <div class="form-group">
	  <label class="control-label col-sm-2" for="email">&nbsp;</label>
    
      <div class="col-sm-4">
<button class="btn btn-primary"   name="submit" type="submit">submit</button>
<button type="button" class="btn btn-warning" onclick="cancel()" name="submit" id="myBtn">Cancel</button>


</div></div>
	</form>
 <?php
  if($_GET["password"]=="success")
  {
	 echo "<script>alert('Successfully Updated Your Password')</script>";  
  }
	if($_GET["password"]=="notsuccess")
  {
	 echo "<script>alert('Old password is not correct');window.location='changepwd.php?t=2';</script>";  
  }
  ?>

  <?php
  if(isset($_POST["submit"]))
  {
	$selectpwd = "select pwd from Logins where user_id='".$_SESSION["user_id"]."'";
	$results1 = @mysql_query ($selectpwd);
	if (@mysql_num_rows($results1) !=0)  
	{//open php rows if

		while ($row1 = @mysql_fetch_assoc($results1))
		{//open php while
		
			// create variables for the a items that will be searched and make them all lowercase (what we want to search through)
			$oldpass = base64_decode($row1['pwd']);
			if($_POST["pass"]==$oldpass)
			{
				if($_POST["password"]!=''){
				$password=base64_encode($_POST["password"]);
	  			$updatepwd = "update Logins set pwd='".$password."' where user_id='".$_SESSION["user_id"]."'";
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
			else
			{
				echo "<script>window.location = 'changepwd.php?password=notsuccess';</script>";
			}

		}//close php while
	}//close php rows if
  }
  ?>
  <input type="hidden" name="updateid" id="updateid" value="'.$user.'"/> 
 
  </div> </div></div> 
<script>
function cancel()
{
var type="<?= $t ?>";
//alert(type);
if(type==1)
window.location = 'begin.php';
if(type==2)
window.location = 'student.php';
}

</script>

<?php


include('footer.php');
?>