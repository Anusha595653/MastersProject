<?php
error_reporting(0);
ob_start();
include("headers.php");
include("container.php");
getheader();
 require_once ('mysql_connect.php');
# Script 11.9 - loggedin.php #2
// The user is redirected here from login.php.
session_start(); // Start the session.
// If no session value is present,redirect the user:
if (!isset($_SESSION['user_id'])) {
require_once ('includes/login_functions.inc.php');
$url = absolute_url();
header("Location: $url");
exit();
}

$user = $_SESSION['user_id'];
$q=$user;
$t=$_GET["t"];
$u=$_GET["u"];


// initialize some varibles
$major='';
$level='';
$status='';
$admission='';
$graduation='';
$resident='';
$comments='';

$q1="select * from users where user_id =$q";
$q2="select * from sdtinfo where user_id =$q";

$r1 = @mysql_query ($q1);
	if (@mysql_num_rows($r1) !=0) 
	{//open php rows if

		while ($row1 = @mysql_fetch_assoc($r1))
		{//open php while
		
			// create variables for the a items that will be searched and make them all lowercase (what we want to search through)
			$phone = $row1['phone'];
			$email = $row1['email'];
			$office =  $row1['Add2'];

		}//close php while
	}//close php rows if
	
	if ($t == 2)
	{
		$r2 = @mysql_query ($q2);
			if (@mysql_num_rows($r2) !=0) 
				{//open php rows if

				while ($row2 = @mysql_fetch_assoc($r2))
					{//open php while
		
					// create variables for the a items that will be searched and make them all lowercase (what we want to search through)
					$major = $row2['major'];
					$level = $row2['level'];
					$status =  $row2['status'];
					$admission= $row2['admissiondate'];
					$graduation = $row2['graduationdate'];
					$resident = $row2['residency'];
					$comments = $row2['Comments'];
					}//close php while
				}//close php rows if
	}	
?>
    
<script type="text/javascript">

function setval()
{
	var graddate = "<?php echo $graduation?>";
	document.forms.form1['level'].value = "<?php echo $level?>";
	document.forms.form1['residency'].value = "<?php echo $resident?>";
	document.forms.form1['admission'].value = "<?php echo $admission?>";
	if (graddate == "0000-00-00")
	{
		document.forms.form1['graduation'].value = " ";
	}
	else
	{
		document.forms.form1['graduation'].value = "<?php echo $graduation?>";
	}

}

function errorcheck()
{//begin inputCheck function
	<?php echo 'var utype = '.$t.';';?>
	var inputError=new Array(" "," "," "," "," "," "," ");
	var errorCount=0;
	var office = document.forms.form1['office'].value;
	var phone = document.forms.form1['phone'].value;
	var email= document.forms.form1['email'].value;
	var returnto =document.forms.form1['returnto'].value;  
	
	
	if (office.length < 1 && utype ==1)
	{
		inputError[0]=("\n Invalid Office Location.");
		errorCount=errorCount+1;
	}

	if (phone.length < 1)
	{
		inputError[1] = ("\n Phone number must be entered.");
		errorCount=errorCount+1;
	}

	if (email.length < 1)
	{
		inputError[2]=("\n Email must be entered");
		errorCount=errorCount+1;
	}

 


	if (errorCount >0)
		alert(errorCount+" Error(s). "+inputError[0]+inputError[1]+inputError[2]);
	if(errorCount == 0)
	{
		document.forms["form1"].submit();
		
	}
}// end errorcheck function

function cancel()
{
var type="<?= $t ?>";
if(type==1)
window.location = 'begin.php';
if(type==2)
window.location = 'student.php';
}

</script>
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

 <div class="panel panel-primary" style="margin-top:-20px; border-radius:0px;">


      <div class="panel-body" >
	  <br><br><br>
  <div style="height:350px" >

<?php

echo '<label style=color:orange;font-size:20px>Update Personal Information</label><br>

<form id="form1" name="form1" method="post"  action="infosubmit.php">
  <p>
  <input type="hidden" name="updateid" id="updateid" value="'.$q.'"/>
  <input type="hidden" name="usertype" id="usertype" value="'.$u.'"/>
   <input type="hidden" name="returnto" id="returnto" value="'.$t.'"/>

  <table  width="100%" align=left>';
  
   if ($t == 1)
   {
    echo '<tr>
			<td align="right"><label>Office: </label></td>
      		<td><div class="col-sm-5"><input name="office" type="text"  class="form-control"  id="office" value="'.$office.'" /></div></td>
		</tr><tr><td>&nbsp;</td></tr>';
   }
   else
   	 {
   	 echo '<input type="hidden" name="office"  id="office" value="'.$office.'" />';
 	  }
   echo '<tr>
   			<td align="right"><label>Phone #: </label></td>
      		<td><div class="col-sm-5"><input  type="text"  name="phone"   class="form-control" id="phone" value="'.$phone.'"/></div></td>
		</tr><tr><td>&nbsp;</td></tr>
    	<tr>
			<td align="right"><label>E-mail:</label></td>
     		<td><div class="col-sm-5"> <input  type="text"  name="email" id="email"   class="form-control" value="'.$email.'"/></div></td>
		</tr><tr><td>&nbsp;</td></tr>
		';
if ($t == 2)
{	
/* echo ' <tr>
 			<td align="right"><label>Concentration: </label></td>
      		<td>'.$major .'</td>
		</tr><tr><td>&nbsp;</td></tr>
		<tr>
			<td align="right"><label>Level: </label></td> 
		 	<td>'.$level.'</td>
		</tr><tr><td>&nbsp;</td></tr>
 
    	<tr>
			<td align="right"><label>Status: </label></td>
       		<td>'.$status.'</td>
		</tr><tr><td>&nbsp;</td></tr>
 	 	<tr>
			<td align="right"> <label>Residency:</label></td>
	    	<td>'.$resident.'</td>
		</tr><tr><td>&nbsp;</td></tr>
	    <tr>
			<td align="right"><label>Admission Date: </label></td>
			<td>'.$admission.'</td>
			</tr>
		<tr><td>&nbsp;</td></tr>
	    <tr>
			<td align="right"><label>Graduation Date: </label></td>
       		<td>'.$graduation.'</td></tr>
			
			<tr>
	       <td align="right"><label>Comments: </label></td>
	       <td>'.$comments.'</td>
	    </tr><tr><td>&nbsp;</td></tr>
		
';*/
}
else
{	
 echo '
      <input  type="hidden"  name="major" id="major" value="'.$major .'"/>
      <input  type="hidden"  name="level" id="level"value="'.$level.'" />
      <input  type="hidden"  name="status" id="status" value="'.$status.'"/>
      <input  type="hidden"  name="residency" id="residency" value="'.$resident.'"/>
      <input  type="hidden"  name="admission" id="admission" value="'.$admission.'"/>
      <input  type="hidden"  name="graduation" id="graduation" value="'.$graduation.'"/>';
}
echo'</p></table></form>';
echo '<table align=center><tr><td><p><label>&nbsp;</label><input type = "button" value = "Submit" name = "submit" onclick= "errorcheck()" class="btn btn-primary"/>
    </p></td>';
echo '<td><p><label>&nbsp;</label><input type = "button" value = "cancel" name = "submit" onclick="cancel()" class="btn btn-warning"/>
    </p></td></tr></table>';
?>
 </div> </div> </div>
    	 
<script type="text/javascript">
setval();
</script>
<?php
include('footer.php');

?>