
<?php
 
include("headers.php");
include("container.php");
require_once ('mysql_connect.php');
getheader();
?>
<?php 
 
if($_SESSION['user_id']=='')
header ('location:index.php');
?>
<style>


</style>

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
    $( "#admissionfrom" ).datepicker({
      defaultDate: "+1w",
	dateFormat: 'yy-mm-dd',
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#graduationfrom" ).datepicker( "option", "minDate", selectedDate );
	$( "#admissionto" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#graduationfrom" ).datepicker({
      defaultDate: "+1w",
	dateFormat: 'yy-mm-dd',
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#admissionfrom" ).datepicker( "option", "maxDate", selectedDate );
	$( "#graduationto" ).datepicker( "option", "minDate", selectedDate );
      }
    });
  });

$(function() {
    $( "#admissionto" ).datepicker({
      defaultDate: "+1w",
	dateFormat: 'yy-mm-dd',
      changeMonth: true,
      numberOfMonths: 1,
onClose: function( selectedDate ) {
        $( "#admissionfrom" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });

$(function() {
    $( "#graduationto" ).datepicker({
      defaultDate: "+1w",
	dateFormat: 'yy-mm-dd',
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#graduationfrom" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
  </script>
<script type="text/javascript">
$(document).ready(function(){
    $('#ADR').on('change', function() {
      if ( this.value == 'Between')
      {
        $("#showAT").show();
      }
      else
      {
        $("#showAT").hide();
      }
    });
	$('#GDR').on('change', function() {
      if ( this.value == 'Between')
      {
        $("#showGT").show();
      }
      else
      {
        $("#showGT").hide();
      }
    });

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
        <?php
$query = "SELECT concentration FROM dropDown where concentration IS NOT NULL"; 
$result = mysql_query($query); ?> 
<select name="major" class="form-control"> 
<option selected="selected">Any</option>
<?php while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?> 
<option value="<?php echo $line['concentration'];?>"> 
<?php echo $line['concentration'];?> </option>   <?php } ?> </select>
      </div>
    </div>

	
	

    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Level:</label>
      <div class="col-sm-4">
<?php
$query = "SELECT level FROM dropDown where level IS NOT NULL"; 
$result = mysql_query($query); ?> 
<select name="level" class="form-control"> 
<option selected="selected">Any</option>
<?php while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?> 
<option value="<?php echo $line['level'];?>"> 
<?php echo $line['level'];?> </option>   <?php } ?> </select>      </div>
    </div>


    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Status:</label>
      <div class="col-sm-4">
<?php
$query = "SELECT status FROM dropDown where status IS NOT NULL"; 
$result = mysql_query($query); ?> 
<select name="status" id="status" class="form-control"> 
<option selected="selected">Any</option>
<?php while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?> 
<option value="<?php echo $line['status'];?>"> 
<?php echo $line['status'];?> </option>   <?php } ?> </select> </div>
    </div>

<div class="form-group">
	
      <label class="control-label col-sm-2" for="email" >Ethnicity:</label>
      <div class="col-sm-4">
<?php
$query = "SELECT ethinicity FROM dropDown where ethinicity IS NOT NULL"; 
$result = mysql_query($query); ?> 
<select name="ethnic" class="form-control"> 
<option selected="selected">Any</option>
<?php while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?> 
<option value="<?php echo $line['ethinicity'];?>"> 
<?php echo $line['ethinicity'];?> </option>   <?php } ?> </select> </div>
    </div>
	
	
	
	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Residency:</label>
      <div class="col-sm-4">

<?php
$query = "SELECT residency FROM dropDown where residency IS NOT NULL"; 
$result = mysql_query($query); ?> 
<select name="residency" class="form-control"> 
<option selected="selected">Any</option>
<?php while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?> 
<option value="<?php echo $line['residency'];?>"> 
<?php echo $line['residency'];?> </option>   <?php } ?> </select> </div>
    </div>
	

<div class="form-group">
	
<label class="control-label col-sm-2" for="email">Admission Date Range:</label>
<div class="col-sm-4">
<select name="ADR" id="ADR" class="form-control"> 
<option selected="selected" value="Before">Before</option>
<option value="On">On</option>
<option value="After">After</option>
<option value="Between">Between</option></select>
      </div>
    </div>
	
	
	<div class="form-group">
      <label class="control-label col-sm-2" for="email">Admission Date from:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="admissionfrom" id="admissionfrom" placeholder="Enter Admission Date">
      </div>
	</div>

	<div class="form-group" id="showAT" style="display:none;">
	
      <label class="control-label col-sm-2" for="email">Admission Date to:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="admissionto" id="admissionto" placeholder="Enter Admission Date">
      </div>
    </div>


<div class="form-group">
	
<label class="control-label col-sm-2" for="email">Graduation Date Range:</label>
<div class="col-sm-4">
<select name="GDR" id="GDR" class="form-control"> 
<option selected="selected">Before</option>
<option>On</option>
<option>After</option>
<option>Between</option></select>
      </div>
    </div>
	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Graduation Date From:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="graduationfrom" id="graduationfrom" placeholder="Enter Graduation Date">
      </div>
    </div>

<div class="form-group" id="showGT" style="display:none;">
	
      <label class="control-label col-sm-2" for="email">Graduation Date to:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="graduationto" id="graduationto" placeholder="Enter Graduation Date">
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
$major=$_POST["major"];
$level=$_POST["level"];
$status=$_POST["status"];
$ethinicity=$_POST["ethnic"];		
$residency=$_POST["residency"];	
$adr=$_POST["ADR"];	
$admissionfrom=$_POST["admissionfrom"];
$admissionto=$_POST["admissionto"];
$gdr=$_POST["GDR"];
$graduationfrom=$_POST["graduationfrom"];
$graduationto=$_POST["graduationto"];	
$grandquery="";
$grand="";
if(!(empty($major)||$major=='Any'))
{
$grandquery=$grandquery."  major='".$major."' and ";
$grand=$grand."major=".$major;
}
if(!(empty($level)||$level=='Any'))
{
	$grandquery=$grandquery."  level='".$level."' and ";
$grand=$grand.", level=".$level;
	}
if(!(empty($status)||$status=='Any'))
{
		$grandquery=$grandquery."  status='".$status."' and ";
$grand=$grand.", status=".$status;
}
if(!(empty($ethinicity)||$ethinicity=='Any'))
{
	$grandquery=$grandquery."  ethnic='".$ethinicity."' and ";
$grand=$grand.", ethinicity=".$ethinicity;
}
if(!(empty($residency)||$residency=='Any'))
{
	$grandquery=$grandquery."  residency='".$residency."' and ";
$grand=$grand.", residency=".$residency;
}
if(!empty($admissionfrom))
{
	if($adr=='Before')
	{
		$grandquery=$grandquery."  admissiondate <'".$admissionfrom."' and ";
		$grand=$grand.", admitted before ".$admissionfrom;

	}
	if($adr=='On')
	{
		$grandquery=$grandquery."  admissiondate='".$admissionfrom."' and ";
		$grand=$grand.", admitted on ".$admissionfrom;

	}

	if($adr=='After')
	{
		$grandquery=$grandquery."  admissiondate >'".$admissionfrom."' and ";
		$grand=$grand.", admitted after ".$admissionfrom;

	}
	if($adr=='Between')
	{
		$grandquery=$grandquery."  admissiondate between'".$admissionfrom."' and '".$admissionto."' and ";
		$grand=$grand.", admitted between ".$admissionfrom."and".$admissionto;

	}
		
//$grandquery=$grandquery."  admissiondate='".$admission."' and "; 
//$grand=$grand.", admissiondate=".$admission;
}
if(!empty($graduationfrom))
{
	if($gdr=='Before')
	{
		$grandquery=$grandquery."  graduationdate <'".$graduationfrom."' and ";
		$grand=$grand.", graduated before ".$graduationfrom;

	}
	if($gdr=='On')
	{
		$grandquery=$grandquery."  graduationdate='".$graduationfrom."' and ";
		$grand=$grand.", graduated on ".$graduationfrom;

	}

	if($gdr=='After')
	{
		$grandquery=$grandquery."  graduationdate >'".$graduationfrom."' and ";
		$grand=$grand.", graduated after ".$graduationfrom;

	}
	if($gdr=='Between')
	{
		$grandquery=$grandquery."  graduationdate between'".$graduationfrom."' and '".$graduationto."' and ";
		$grand=$grand.", graduated between".$graduationfrom."and".$graduationto;

	}





	//$grandquery=$grandquery."  graduationdate='".$graduation."' and ";
//$grand=$grand.", graduationdate=".$graduation;
}
$grandquery="select * from sdtinfo where ".$grandquery;
$grandquery=substr_replace($grandquery,"",-4);
//$grand=substr_replace($grand,"",-1);
$_SESSION["query"]=$grandquery;
$_SESSION["squery1"]=$grand;
echo "<script>window.location.href='chart1.php'</script>";
}

?> 

</div>
<?php
include('footer.php');
?>
 