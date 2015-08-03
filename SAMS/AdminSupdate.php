
<?php
include("headers.php");
include("container.php");
getheader();
?>
<?php 
  require_once ('mysql_connect.php');
if($_SESSION['user_id']=='')
header ('location:index.php');
$q=$_GET["student_id"];
$q1="select * from users where user_id = $q";
$q2="select * from sdtinfo where user_id =$q";
$q3="select * from Logins where user_id =$q";
$r1 = @mysql_query ($q1);
	if (@mysql_num_rows($r1) !=0) 
	{//open php rows if

		while ($row1 = @mysql_fetch_assoc($r1))
		{//open php while
		
			// create variables for the a items that will be searched and make them all lowercase (what we want to search through)
			$sname1 = $row1['First_Name'];
			$sname2= $row1['Last_Name'];
			$phone = $row1['phone'];
			$email = $row1['email'];
			$password=$row2['Comments'];
			$confirmPass=$row2['Comments'];
		}//close php while
	}//close php rows if
	
$r2 = @mysql_query ($q2);
	if (@mysql_num_rows($r2) !=0) 
	{//open php rows if

		while ($row2 = @mysql_fetch_assoc($r2))
		{//open php while
		
			// create variables for the a items that will be searched and make them all lowercase (what we want to search through)
			$major = $row2['major'];
			$level = $row2['level'];
			$status =  $row2['status'];
			$admissiondate = $row2['admissiondate'];
			$graddate = $row2['graduationdate'];
			$comments = $row2['Comments'];
			
		}//close php while
	}//close php rows if

$r3 = @mysql_query ($q3);
	if (@mysql_num_rows($r3) !=0) 
	{//open php rows if

		while ($row3 = @mysql_fetch_assoc($r3))
		{//open php while
		
			// create variables for the a items that will be searched and make them all lowercase (what we want to search through)
			$password=$row3['pwd'];
		}//close php while
	}//close php rows if
	

?>
<script src="./content/jquery.js"></script>
<!-- JQUERY -->
<link href="./content/jquery.custom.css" rel="stylesheet" type="text/css"/>
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


<link href="jquery.custom.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>






<script type="text/javascript">
<!--
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

			}
		}
	
		//when search function is called, send the search string, the search type (user vs appt), user id, and searcher type (faculty vs student)
		if(divid=="name")
			xmlhttp.open("GET","namesearch.php?name="+str,true);
		if(divid=="idnumber")
			xmlhttp.open("GET","namesearch.php?idn="+str,true);
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
 
	if (errorCount >0)
		alert(errorCount+" Error(s). "+inputError[0]+inputError[1]+inputError[2]+inputError[3]+inputError[4]+inputError[5]+inputError[6]+inputError[7]+inputError[8]+inputError[9]);
	if(errorCount == 0)
	{
		document.forms["form1"].submit();
	}
}// end errorcheck function

function cancel()
{
window.location = 'begin.php';
}



//-->
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
 <style>
 
 #abcd{ height:55px;}
 #app{border:1;}
 </style>
 
 	 <div class="panel panel-primary" style="margin-top:-20px; border-radius:0px;">

      <div class="panel-body" >
	  <br><br><br>
  <div style="height:100%" >

   
 <label style="color:orange">
 <img src="images/student.png" width="150px" height="150px">
 Update Student Information</label><br />
<form id="form1" name="form1" method="post"  action="updatesinfo.php" class="form-horizontal">

  <input type="hidden" name="updateid" id="updateid" value="<?php echo $q; ?>">
  <input type="hidden" name="usertype"   value="<?php echo $_GET['type']; ?>">
    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">First Name:</label>
      <div class="col-sm-4">
		<input type="text" name="fname" id="fname" class="form-control" value="<?php echo $sname1; ?>" />
       </div></div>    
<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Last Name:</label>
      <div class="col-sm-4">
		<input type="text" class="form-control" name="lname" id="lname" value="<?php echo $sname2; ?>"/>
       </div></div>
	   
	   
	   
	   
	       
<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Phone:</label>
      <div class="col-sm-4">
		<input type="text" class="form-control" name="phone" id="phone" value="<?php echo $phone; ?>"/>
       </div></div>
	   
	   
	   
	   <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-4">
		<input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>"/>
       </div></div>
	   
	   <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Concentration:</label>
      <div class="col-sm-4">
		<input type="text" class="form-control" name="major" id="major" value="<?php echo $major; ?>"/>
       </div></div>
	   
	   
	   

	   <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Level:</label>
      <div class="col-sm-4">
		
<select name="level" class="form-control">
			<option>Undergraduate</option>
			<option selected="selected">Graduate</option>
			<option>Post-Graduate</option>
			</select>
		</div></div>    
	


	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Status:</label>
      <div class="col-sm-4">
		
<select name="status" class="form-control">
		 <option>FULL</option>
					 <option>PREQ</option>
					 <option>DENIED</option>
					 <option>DEFERRED</option>
					 <option>INACTIVE</option>
			</select>
		</div></div>    
	
	
  
  
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Ethnicity:</label>
      <div class="col-sm-4">
  <select name="ethnic" class="form-control">
			<option selected>Caucasian</option>
			<option>African American</option>
			<option>Hispanic</option>
			<option>Asian</option>
			<option>Middle eastern</option>
			<option>Pacific Islander</option>
			<option>Native American/Alaskan</option>
			<option>Other</option>
			</select>
			</div>
			</div>
	




	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Residency:</label>
      <div class="col-sm-4">
<select name="residency" class="form-control">
			<option selected="selected">Resident</option>
			<option>Non-Resident</option>
			<option>International</option>
			</select></div></div>
			
			
			
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Admission Date:</label>
      <div class="col-sm-4">
<input type="text" name ="admission" id="admission"  class="form-control" value="<?php echo $admissiondate; ?>">
</div></div>
	
 
	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Graduation Date:</label>
      <div class="col-sm-4">    
	  <input type="text" name="graduation" class="form-control" id="graduation" value="<?php echo $graddate; ?>"></div>
	  </div>
 
 
 
 
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Password:</label>
      <div class="col-sm-4">
	<input type="password" name="password" id="password" class="form-control" value="<?php echo $password; ?>"> 
	 </div></div>
	 
    



	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Confirm-Password:</label>
      <div class="col-sm-4">
	<input type="password" class="form-control" name="confirm" id="confirm" value="<?php echo $password; ?>"> </div></div>
	


<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">(OR) Generate:</label>
      <div class="col-sm-4">
 <input type="hidden" name="thelength" size=3 value="8">
        <button type="button" class="btn btn-primary" onClick="populateform(this.form.thelength.value)">Generate</button>
 </div></div>
	
	


	
  
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Comments:</label>
      <div class="col-sm-4">
  <textarea name="comments" id="comments" rows=3 cols=20 class="form-control">
	  <?php echo $comments; ?>
	  </textarea></div></div>

  </form><BR><p>
  	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email"> </label>
      <div class="col-sm-4">
<button class="btn btn-primary" onclick= "errorcheck()" name="submit" type="submit">Submit</button>
 
</div></div>

  </p>
 
  </div>  </div> </div>  
<?php
include('footer.php');
?>