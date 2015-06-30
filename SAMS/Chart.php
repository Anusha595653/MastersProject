
<?php
 
include("headers.php");
include("container.php");
getheader();
?>
<?php 
 
if($_SESSION['user_id']=='')
header ('location:index.php');
?>
<script src="./content/jquery.js"></script>
<!-- JQUERY -->
<link href="jquery.custom.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script>
$(function() {
    $( "#admission" ).datepicker({dateFormat: 'yy-mm-dd'});
	
});
$(function() {
    $( "#graduation" ).datepicker({dateFormat: 'yy-mm-dd'});
	
});
</script>
<script type="text/javascript">

function nameSearch(str,divid)
	{
			
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
				if(divid=="name")
				document.getElementById("name").innerHTML=xmlhttp.responseText;
			if(divid=="idnumber")
						document.getElementById("idnumber").innerHTML=xmlhttp.responseText;
					if(divid=="myemail")
				document.getElementById("myemail").innerHTML=xmlhttp.responseText;

			}
		}
	
		//when search function is called, send the search string, the search type (user vs appt), user id, and searcher type (faculty vs student)
		if(divid=="name")
			xmlhttp.open("GET","namesearch.php?name="+str,true);
		if(divid=="idnumber")
			xmlhttp.open("GET","namesearch.php?idn="+str,true);
		if(divid=="myemail")
			xmlhttp.open("GET","namesearch.php?email="+str,true);
		xmlhttp.send();
	}
	
function errorcheck()
{//begin inputCheck function
	var inputError=new Array(" "," "," "," "," "," "," "," ",""," ");
	var errorCount=0;
	var fname = document.forms.form1['fname'].value;
	var lname = document.forms.form1['lname'].value;
	var phone = document.forms.form1['phone'].value;
	var email= document.forms.form1['email'].value;
	var major =document.forms.form1['major'].value;
	var status = "TEMPFIX"; //document.forms.form1['status'].value;
	var admission =document.forms.form1['admission'].value;
	var password =document.forms.form1['password'].value;
	var confirmed =document.forms.form1['confirm'].value;
	var username =document.forms.form1['uname'].value;
	var idn =document.forms.form1['idn'].value;
	if (fname.length < 1)
	{
		inputError[0]=("\n Invalid first name.");
		errorCount=errorCount+1;
	}

if (lname.length < 1 )
	{
		inputError[1]=("\n Invalid last name");
		errorCount=errorCount+1;
	}

	if (phone.length < 1)
	{
		inputError[2] = ("\n Phone number must be entered.");
		errorCount=errorCount+1;
	}

	if (email.length < 1)
	{
		inputError[3]=("\n Email must be entered");
		errorCount=errorCount+1;
	}

	if (major.length < 1)
	{
		inputError[4] = ("\n Major must be entered");
		errorCount=errorCount+1;
	}

	
	if (status.length < 1)
	{
		inputError[5] = ("\n Status must be entered");
		errorCount=errorCount+1;
	}
	if (admission.length < 1)
	{
		inputError[6] = ("\n Admission Date must be entered");
		errorCount=errorCount+1;
	}
	if (password.length < 8)
	{
		inputError[7] = ("\n Password is too Short");
		errorCount=errorCount+1;
	}
	if (password.length >= 8 && password != confirmed)
	{
		inputError[7] = ("\n Passwords do not Match");
		errorCount=errorCount+1;
	}
	if (username.length <3)
	{
		inputError[8] = ("\n Username is too short (must be longer than 3 characters)");
		errorCount=errorCount+1;
	}
	if (username.length <1)
	{
		inputError[8] = ("\n Username must be entered");
		errorCount=errorCount+1;
	}
	
	if (document.getElementById('name').innerHTML=="<o>Name already in use</o>")
		{
		inputError[8] = ("\n Username is already in use");
		errorCount=errorCount+1;
		}
	
		
		if (idn.length <1)
	{
		inputError[9] = ("\n ID must be entered");
		errorCount=errorCount+1;
	}
	
	if (document.getElementById('idnumber').innerHTML=="<o>ID already in use</o>")
		{
		inputError[9] = ("\n ID number is already in use");
		errorCount=errorCount+1;
		}
	if (document.getElementById('myemail').innerHTML=="<o>Email already in use</o>")
		{
		inputError[10] = ("\n Email is already in use");
		errorCount=errorCount+1;
		}
	if (errorCount >0)
		alert(errorCount+" Error(s). "+inputError[0]+inputError[1]+inputError[2]+inputError[3]+inputError[4]+inputError[5]+inputError[6]+inputError[7]+inputError[8]+inputError[9]+inputError[10]);
	if(errorCount == 0)
	{
		document.forms["form1"].submit();
	}
	else
		return false;
}// end errorcheck function

function cancel()
{
window.location = 'begin.php';
}

</script>
<script>
var keylist="abcdefghijklmnopqrstuvwxyz123456789"
var temp=''
function generatepass(plength){
temp=''
for (i=0;i<plength;i++)
temp+=keylist.charAt(Math.floor(Math.random()*keylist.length))
return temp
}
function populateform(enterlength){
document.form1.password.value=generatepass(enterlength);
document.form1.confirm.value=document.form1.password.value;
}
</script>
 <div class="panel panel-primary" style="margin-top:-20px; border-radius:0px;">


      <div class="panel-body" >
	  <br><br><br>
  <div style="height:100%" >
 

  <form class="form-horizontal" name="form1" id="form1" method="post" action="Chart.php">
 
 <p align="left">
 <label style="color:orange;font-size:20px;">
 Chart Builder</label></p><br />
    
	    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Concentration:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="major" id="major" placeholder="Enter Concentration">
      </div>
    </div>

	
	

    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Level:</label>
      <div class="col-sm-4">
<select name="level" class="form-control">
			<option>Undergraduate</option>
			<option selected="selected">Graduate</option>
			<option>Post-Graduate</option>
			</select>      </div>
    </div>


    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Status:</label>
      <div class="col-sm-4">
<select name="status" id="status" class="form-control">
		    			 <option>FULL</option>
					 <option>PREQ</option>
					 <option>DENIED</option>
					 <option>DEFERRED</option>
					 <option>INACTIVE</option>
				</select>      </div>
    </div>

<div class="form-group">
	
      <label class="control-label col-sm-2" for="email" >Ethnicity:</label>
      <div class="col-sm-4">
<select name="ethnic" class="form-control">
			<option selected="selected">Caucasian</option>
			<option>African American</option>
			<option>Hispanic</option>
			<option>Asian</option>
			<option>Middle eastern</option>
			<option>Pacific Islander</option>
			<option>Native American/Alaskan</option>
			<option>Other</option>
			</select>      </div>
    </div>
	
	
	
	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Residency:</label>
      <div class="col-sm-4">

<select name="residency" class="form-control">
			<option selected="selected">Resident</option>
			<option>Non-Resident</option>
			<option>International</option>
			</select>      </div>
    </div>
	
	
	
	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Admission Date:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="admission" id="admission" placeholder="Enter Admission Date">
      </div>
    </div>
	
	
	
	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Graduation Date:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="graduation" id="graduation" placeholder="Enter Graduation">
      </div>
    </div>
	
	
	
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">

        <button type="submit" class="btn btn-warning"  name="submit">Submit</button>
		 </div>
    </div>
	
	
	
	
  </form>
  </div>
    </div>
<?php
if(isset($_POST["submit"]))
{
 
$level=$_POST["level"];
$status=$_POST["status"];		
$residency=$_POST["residency"];		
$admission=$_POST["admission"];
$graduation=$_POST["graduation"];	
$grandquery="";
if(!empty($level))
$grandquery=$grandquery."  level='".$level."' and ";
if(!empty($status))
$grandquery=$grandquery."  status='".$status."' and ";
if(!empty($residency))
$grandquery=$grandquery."  residency='".$residency."' and ";
if(!empty($admission))
$grandquery=$grandquery."  admissiondate='".$admission."' and ";
if(!empty($graduation))
$grandquery=$grandquery."  graduationdate='".$graduation."' and ";

$grandquery="select * from sdtinfo where ".$grandquery;
$grandquery=substr_replace($grandquery,"",-4);
$_SESSION["query"]=$grandquery;
echo "<script>window.location.href='chart1.php'</script>";
}

?> 

</div>
<?php
include('footer.php');
?>
 