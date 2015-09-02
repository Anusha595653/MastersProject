
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
	
	//alert("enteredfirst");
	//alert(errorCount);
	var dateARange =document.getElementById('showAT').style.display;
	//alert(dateARange.length);
	var dateGRange =document.getElementById('showAT').style.display;
	var admissionTo =document.forms.form1['admissionto'].value;
	var gradFrom =document.forms.form1['graduationfrom'].value;
	var gradTo =document.forms.form1['graduationto'].value;
	
	if (dateARange=="Between" && $("#admissionfrom").datepicker("getDate")==null)
	{
		inputError[0]=("\n Admission from date must be selected");
		errorCount=errorCount+1;
	}

	if (dateARange.style.display != "none" && admissionTo=="" )
	{
		inputError[1]=("\n Admission to date must be selected");
		errorCount=errorCount+1;
	}

	if (dateGRange.style.display != "none" && gradFrom=="")
	{
		inputError[2]=("\n Graduation from date must be selected");
		errorCount=errorCount+1;
	}

	if (dateGRange.style.display != "none" && gradTo=="" )
	{
		inputError[3]=("\n Graduation to date must be selected");
		errorCount=errorCount+1;
	}

	alert(errorCount);
	if (errorCount >0)
		alert(errorCount+" Error(s). "+inputError[0]+inputError[1]+inputError[2]+inputError[3]);
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
$query = "SELECT description FROM dropDowns where category ='concentration'"; 
$result = mysql_query($query); ?> 
<select name="major" class="form-control"> 
<option selected="selected">Any</option>
<?php while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?> 
<option value="<?php echo $line['description'];?>"> 
<?php echo $line['description'];?> </option>   <?php } ?> </select>  
      </div>
    </div>

	
	

    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Level:</label>
      <div class="col-sm-4">
<?php
$query = "SELECT description FROM dropDowns where category ='level'"; 
$result = mysql_query($query); ?> 
<select name="level" class="form-control"> 
<option selected="selected">Any</option>
<?php while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?> 
<option value="<?php echo $line['description'];?>"> 
<?php echo $line['description'];?> </option>   <?php } ?> </select>      </div>
    </div>


    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Status:</label>
      <div class="col-sm-4">
<?php
$query = "SELECT description FROM dropDowns where category ='status'"; 
$result = mysql_query($query); ?> 
<select name="status" id="status" class="form-control"> 
<option selected="selected">Any</option>
<?php while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?> 
<option value="<?php echo $line['description'];?>"> 
<?php echo $line['description'];?> </option>   <?php } ?> </select> </div>
    </div>

<div class="form-group">
	
      <label class="control-label col-sm-2" for="email" >Ethnicity:</label>
      <div class="col-sm-4">
<?php
$query = "SELECT description FROM dropDowns where category ='ethinicity'"; 
$result = mysql_query($query); ?> 
<select name="ethnic" class="form-control"> 
<option selected="selected">Any</option>
<?php while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?> 
<option value="<?php echo $line['description'];?>"> 
<?php echo $line['description'];?> </option>   <?php } ?> </select> </div>
    </div>
	
	
	
	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Residency:</label>
      <div class="col-sm-4">

<?php
$query = "SELECT description FROM dropDowns where category ='residency'"; 
$result = mysql_query($query); ?> 
<select name="residency" class="form-control"> 
<option selected="selected">Any</option>
<?php while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?> 
<option value="<?php echo $line['description'];?>"> 
<?php echo $line['description'];?> </option>   <?php } ?> </select> </div>
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

       <!-- <button type="submit" class="btn btn-warning"  name="submit">Submit</button>-->
	<button type="submit" class="btn btn-primary" onclick= "return errorcheck()" name="submit">Submit</button>
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
$grand="Students ";
if(!(empty($major)||$major=='Any'))
{
$grandquery=$grandquery."  major='".$major."' and ";
$grand=$grand." majoring in ".$major;
}
if(!(empty($level)||$level=='Any'))
{
	$grandquery=$grandquery."  level='".$level."' and ";
$grand=$grand." at the ".$level." level";
	}
if(!(empty($status)||$status=='Any'))
{
		$grandquery=$grandquery."  status='".$status."' and ";
$grand=$grand." with status ".$status;
}
if(!(empty($ethinicity)||$ethinicity=='Any'))
{
	$grandquery=$grandquery."  ethnic='".$ethinicity."' and ";
$grand=$grand." who are ".$ethinicity." s";
}
if(!(empty($residency)||$residency=='Any'))
{
	$grandquery=$grandquery."  residency='".$residency."' and ";
$grand=$grand." with residency status as ".$residency;
}
if(!empty($admissionfrom))
{
	if($adr=='Before')
	{
		$grandquery=$grandquery."  admissiondate <'".$admissionfrom."' and ";
		$grand=$grand." admitted before ".$admissionfrom;

	}
	if($adr=='On')
	{
		$grandquery=$grandquery."  admissiondate='".$admissionfrom."' and ";
		$grand=$grand." admitted on ".$admissionfrom;

	}

	if($adr=='After')
	{
		$grandquery=$grandquery."  admissiondate >'".$admissionfrom."' and ";
		$grand=$grand." admitted after ".$admissionfrom;

	}
	if($adr=='Between')
	{
		$grandquery=$grandquery."  admissiondate between'".$admissionfrom."' and '".$admissionto."' and ";
		$grand=$grand." admitted between ".$admissionfrom."and".$admissionto;

	}
		
//$grandquery=$grandquery."  admissiondate='".$admission."' and "; 
//$grand=$grand.", admissiondate=".$admission;
}
if(!empty($graduationfrom))
{
	if($gdr=='Before')
	{
		$grandquery=$grandquery."  graduationdate <'".$graduationfrom."' and ";
		$grand=$grand." graduated before ".$graduationfrom;

	}
	if($gdr=='On')
	{
		$grandquery=$grandquery."  graduationdate='".$graduationfrom."' and ";
		$grand=$grand." graduated on ".$graduationfrom;

	}

	if($gdr=='After')
	{
		$grandquery=$grandquery."  graduationdate >'".$graduationfrom."' and ";
		$grand=$grand." graduated after ".$graduationfrom;

	}
	if($gdr=='Between')
	{
		$grandquery=$grandquery."  graduationdate between'".$graduationfrom."' and '".$graduationto."' and ";
		$grand=$grand." graduated between".$graduationfrom."and".$graduationto;

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
 