
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
 

  <form class="form-horizontal" name="form1" id="form1" method="post" action="studentsubmit.php">
 
 <p align="left">
 <label style="color:orange;font-size:20px;">
 <img src="images/student.png" width="150px" height="150px">
 Enter Student Information</label></p><br />
    <div class="form-group" align="center">
	
      <label class="control-label col-sm-2" for="email">First Name  : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="fname" id="fname" placeholder="Enter First Name" required>
      </div>
    </div>
   
    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Last Name  : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="lname" id="lname" placeholder="Enter Last Name" required>
      </div>
    </div>
    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Phone #  : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="phone" id="phone" placeholder="Enter 10 digit PhoneNo" required pattern="[1-9]{1}[0-9]{9}">
      </div>
    </div>

    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Email  : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
        <input type="email" class="form-control"  name="email" id="email" placeholder="example@ex.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
      </div>
    </div>
		<div class="form-group">
	
      <label class="control-label col-sm-2" for="email"></label>
      <div class="col-sm-4" id="myemail">
      </div>
    </div>



	

        <input type="hidden" class="form-control"  name="usertypeadd" value="<?php echo $_GET['type'];?>">
	
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
<select name="level" class="form-control" required> 
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
<select name="status" id="status" class="form-control" required> 
<?php while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?> 
<option value="<?php echo $line['description'];?>"> 
<?php echo $line['description'];?> </option>   <?php } ?> </select> </div>
    </div>


<div class="form-group">
	
      <label class="control-label col-sm-2" for="email" >Ethnicity  : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
<?php
$query = "SELECT description FROM dropDowns where category ='ethinicity'"; 
$result = mysql_query($query); ?> 
<select name="ethnic" class="form-control" required> 
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
<select name="residency" class="form-control" required> 
<?php while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) { ?> 
<option value="<?php echo $line['description'];?>"> 
<?php echo $line['description'];?> </option>   <?php } ?> </select> </div>
    </div>
	
	
	
	
	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Admission Date : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="admission" id="admission" placeholder="Enter Admission Date" required>
      </div>
    </div>
		
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Graduation Date :</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="graduation" id="graduation" placeholder="Enter Graduation">
      </div>
    </div>


	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">User Name  : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="uname" id="uname" onkeyup="nameSearch(this.value,'name')" placeholder="Enter User Name" required>
      </div>
    </div>
		<div class="form-group">
	
      <label class="control-label col-sm-2" for="email"></label>
      <div class="col-sm-4" id="name">
      </div>
    </div>
	
	
	
	
	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">ID Number  : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="idn" id="idn" onkeyup="nameSearch(this.value,'idnumber')" placeholder="Enter ID Number" required>
      </div>
    </div>
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email"></label>
      <div class="col-sm-4" id="idnumber">
      </div>
    </div>
	





	
	
	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Password  : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
        <input type="password" class="form-control"  name="password" id="password" placeholder="Enter Password" required>
      </div>
    </div>
	
	
	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Confirm-Password  : <sup><font color="red" size="3">*</font></sup></label>
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
	
	
<!---	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">(OR) Generate Password :</label>
      <div class="col-sm-4">
		 <input type="hidden" name="thelength" size=3 value="8">
        <button type="button" class="btn btn-primary" onClick="populateform(this.form.thelength.value)">Generate</button>

		</div>
    </div>--->
	
	
	
    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Comments:</label>
      <div class="col-sm-4">
<textarea name="comments" class="form-control" id="comments" rows="3" cols="20" style="border:solid 2px #e3e3e3;" ></textarea>
      </div>
    </div>

	
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">

        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
		<button type="button" class="btn btn-warning" onclick= "cancel()" name="submit" id="myBtn">Cancel</button>
	 </div>
    </div>
  </form>
  </div>
    </div>

</div>
<?php
include('footer.php');
?>
 