
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
			$password=base64_decode($row3['pwd']);
		}//close php while
	}//close php rows if
	

?>
<script src="./content/jquery.js"></script>
<!-- JQUERY -->
<link href="jquery.custom.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#admission" ).datepicker({
      defaultDate: "+1w",
	dateFormat: 'yy-mm-dd',
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#graduation" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#graduation" ).datepicker({
      defaultDate: "+1w",
	dateFormat: 'yy-mm-dd',
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#admission" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
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
		inputError[0]=("\n First name must be entered");
		errorCount=errorCount+1;
	}

if (lname.length < 1 )
	{
		inputError[1]=("\n Last name must be entered");
		errorCount=errorCount+1;
	}


	if (phone.length < 1)
	{
		inputError[2] = ("\n Phone number must be entered");
		errorCount=errorCount+1;
	}

	if (email.length < 1)
	{
		inputError[3]=("\n Email must be entered");
		errorCount=errorCount+1;
	}

	//if (major.length < 1)
	//{
		//inputError[4] = ("\n Major must be entered");
		//errorCount=errorCount+1;
	//}

	
	if (status.length < 1)
	{
		inputError[4] = ("\n Status must be entered");
		errorCount=errorCount+1;
	}
	if (admission.length < 1)
	{
		inputError[5] = ("\n Admission date must be entered");
		errorCount=errorCount+1;
	}
	if (password.length < 1)
	{
		inputError[6] = ("\n Password must be entered");
		errorCount=errorCount+1;
	}
	if (password.length >= 1 && password != confirmed)
	{
		inputError[6] = ("\n Passwords do not Match");
		errorCount=errorCount+1;
	}
 
	if (errorCount >0)
		alert(errorCount+" Error(s). "+inputError[0]+inputError[1]+inputError[2]+inputError[3]+inputError[4]+inputError[5]+inputError[6]);
	if(errorCount == 0)
	{
		document.forms["form1"].submit();
	}
}// end errorcheck function

function cancel(sid)
{
window.location = 'studentsrch.php?sid='+sid;
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
	
      <label class="control-label col-sm-2" for="email">First Name : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
		<input type="text" name="fname" id="fname" class="form-control" value="<?php echo $sname1; ?>" />
       </div></div>    
<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Last Name : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
		<input type="text" class="form-control" name="lname" id="lname" value="<?php echo $sname2; ?>"/>
       </div></div>
	   
	   
	   
	   
	       
<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Phone : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
		<input type="text" class="form-control" name="phone" id="phone" value="<?php echo $phone; ?>"/>
       </div></div>
	   
	   
	   
	   <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Email : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
		<input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"/>
       </div></div>
	   
	   <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Concentration:</label>
      <div class="col-sm-4">
<?php
$query = "SELECT description FROM dropDowns where category ='concentration'"; 
$result = mysql_query($query); ?> 
<select name="major" class="form-control"> 
<?php while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?> 
<option value="<?php echo $line['description'];?>"> 
<?php echo $line['description'];?> </option>   <?php } ?> </select>  
<!--<input type="text" class="form-control"  name="major" id="major" placeholder="Enter Concentration">-->
 </div>
 </div>

	
	

    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Level  : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">

<?php
$query = "SELECT description FROM dropDowns where category ='level'"; 
$result = mysql_query($query); ?> 
<select name="level" class="form-control"> 
<?php while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?> 
<option value="<?php echo $line['description'];?>"> 
<?php echo $line['description'];?> </option>   <?php } ?> </select> </div>
    </div>


    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Status  : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">

<?php
$query = "SELECT description FROM dropDowns where category ='status'"; 
$result = mysql_query($query); ?> 
<select name="status" id="status" class="form-control"> 
<?php while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?> 
<option value="<?php echo $line['description'];?>"> 
<?php echo $line['description'];?> </option>   <?php } ?> </select></div>
    </div>


<div class="form-group">
	
      <label class="control-label col-sm-2" for="email" >Ethnicity  : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
<?php
$query = "SELECT description FROM dropDowns where category ='ethinicity'"; 
$result = mysql_query($query); ?> 
<select name="ethnic" class="form-control"> 
<?php while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?> 
<option value="<?php echo $line['description'];?>"> 
<?php echo $line['description'];?> </option>   <?php } ?> </select> </div>
    </div>
	
	
	
	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Residency  : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
<?php
$query = "SELECT description FROM dropDowns where category ='residency'"; 
$result = mysql_query($query); ?> 
<select name="residency" class="form-control"> 
<?php while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?> 
<option value="<?php echo $line['description'];?>"> 
<?php echo $line['description'];?> </option>   <?php } ?> </select> </div>
    </div>
			
			
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Admission Date : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
<input type="text" name ="admission" id="admission"  class="form-control" value="<?php echo $admissiondate; ?>">
</div></div>
	
 
	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Graduation Date :</label>
      <div class="col-sm-4">    
	  <input type="text" name="graduation" class="form-control" id="graduation" value="<?php echo $graddate; ?>"></div>
	  </div>
 
 
 
 
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Password : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
	<input type="password" name="password" id="password" class="form-control" value="<?php echo $password; ?>"> 
	 </div></div>
	 
    



	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Confirm-Password : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
	<input type="password" class="form-control" name="confirm" id="confirm" value="<?php echo $password; ?>"> </div></div>
	


<!---<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">(OR) Generate :</label>
      <div class="col-sm-4">
 <input type="hidden" name="thelength" size=3 value="8">
        <button type="button" class="btn btn-primary" onClick="populateform(this.form.thelength.value)">Generate</button>
 </div></div> --->
	
	


	
  
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Comments :</label>
      <div class="col-sm-4">
  <textarea name="comments" id="comments" rows=3 cols=20 class="form-control" style="float:left"><?php echo $comments; ?></textarea></div></div>

  </form><BR><p>
  	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email"> </label>
      <div class="col-sm-4">
<button class="btn btn-primary" onclick= "errorcheck()" name="submit" type="submit">Submit</button>
<button type="button" class="btn btn-warning" onclick= "cancel(<?php echo $_GET["student_id"];?>)" name="submit" id="myBtn">Cancel</button>
 
</div></div>

  </p>
 
  </div>  </div> </div>  
<?php
include('footer.php');
?>