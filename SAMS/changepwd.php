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
<script type="text/javascript">
function nameSearch(str,divid)
	{
		var userId = "<?= $userId ?>";
		if (str.length<2)
		{ 
			document.getElementById(divid).innerHTML="";

			document.getElementById(divid).style.border="0px";
			return;
		}
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				if(divid=="oldPass")
				document.getElementById("oldPass").innerHTML=xmlhttp.responseText;
				  

			}
		}
	
		//when search function is called, send the search string, the search type (user vs appt), user id, and searcher type (faculty vs student)
		if(divid=="oldPass")
			xmlhttp.open("GET","namesearch.php?Pass="+str+"& userid="+userId,true);
		xmlhttp.send();
	}
function errorcheck()
{//begin inputCheck function
	var inputError=new Array(" "," "," "," "," "," "," "," ",""," ");
	var errorCount=0;
	var password =document.forms.form1['password'].value;
	var confirmed =document.forms.form1['confirm'].value;
	var con =document.getElementById('oldPass').innerHTML;
	//alert(con);
	if (con!="<o>Password entered is correct</o>") 
		{
		inputError[0] = ("\n Old password is incorrect.");
		errorCount=errorCount+1;

		}
	if (password.length < 8)
	{
		inputError[1] = ("\n Password is too short");
		errorCount=errorCount+1;
	}
	if (password.length >= 8 && password != confirmed)
	{
		inputError[1] = ("\n Passwords do not Match");
		errorCount=errorCount+1;
	}
	
	if (errorCount >0)
		alert(errorCount+" Error(s). "+inputError[0]+inputError[1]);
	if(errorCount == 0)
	{
		document.forms["form1"].submit();
	}
	else
		return false;
}// end errorcheck function

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


<script language='javascript' type='text/javascript'>
    function checkoldPass() {
	var con =document.getElementById('oldPass').innerHTML;
        if (con!="<o>Password entered is correct</o>") {
            //input.setCustomValidity('Old password is not correct');
		alert("Old password is not correct");
        } else {
            // input is valid -- reset the error message
            input.setCustomValidity('');
        }
    }
</script>

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
	 echo "<script>alert('Old password is not correct')</script>";  
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

<?php


include('footer.php');
?>