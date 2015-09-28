
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

function cancel()
{
window.location = 'begin.php';
}

</script>

<script>

function validatePhone(input) {

    //logically decide and set custom validation message

    if (document.getElementById('phone').validity.patternMismatch) 
	{
        input.setCustomValidity('Please enter only digits,min 6 digits and max 16 digits with optional "+" as first character');

    } else {

        // reset the validation message - makes it valid for checkValidity function

        input.setCustomValidity('');

    }

}

function validateEmail(input) {

    //logically decide and set custom validation message

    if (document.getElementById('email').validity.patternMismatch) 
	{
        input.setCustomValidity('Please enter correct format "example@ex.com"');

    } else {

        // reset the validation message - makes it valid for checkValidity function

        input.setCustomValidity('');

    }

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
 

  <form class="form-horizontal" name="form1" id="form1" method="post" action="facultysubmit.php">
 
 <p align="left">
 <label style="color:orange;font-size:20px;">
 <img src="images/faculty.png" width="150px" height="150px">
 Enter Faculty/Staff Information</label></p><br />
    <div class="form-group" align="center">
	
      <label class="control-label col-sm-2" for="email">First Name : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="fname" id="fname" placeholder="Enter First Name" required>
      </div>
    </div>
   
    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Last Name : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="lname" id="lname" placeholder="Enter Last Name" required>
      </div>
    </div>
    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Phone # : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="phone" id="phone" placeholder="+1234567" required pattern="[+]?([0-9]){6,16}" oninput="validatePhone(this)">
      </div>
    </div>

	
	
	
    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Email : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
        <input type="email" class="form-control"  name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="example@ex.com" required oninput="validateEmail(this)">
      </div>
    </div>
		<div class="form-group">
	
      <label class="control-label col-sm-2" for="email"></label>
      <div class="col-sm-4" id="myemail">
      </div>
    </div>


    <div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Office :</label>
      <div class="col-sm-4">
        <input type="text" class="form-control"  name="office" id="office" placeholder="Enter ">
      </div>
    </div>


	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">User Name : <sup><font color="red" size="3">*</font></sup></label>
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
	
      <label class="control-label col-sm-2" for="email">ID Number : <sup><font color="red" size="3">*</font></sup></label>
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
	
      <label class="control-label col-sm-2" for="email">Type : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
    <select name="type" class="form-control" required><option value="0" selected>Faculty</option><option value="1">Staff</option></select>  </div>
    </div>


	
	
	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Password : <sup><font color="red" size="3">*</font></sup></label>
      <div class="col-sm-4">
        <input type="password" class="form-control"  name="password" id="password" placeholder="Enter Password" required>
      </div>
    </div>
	
	
	
	<div class="form-group">
	
      <label class="control-label col-sm-2" for="email">Confirm-Password : <sup><font color="red" size="3">*</font></sup></label>
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
 