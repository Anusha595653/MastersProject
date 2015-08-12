
<?php
error_reporting(0);
Session_start();
 require_once ('mysql_connect.php');

 include("headers.php");
include("container.php");
getheader();
 
 
if($_SESSION['user_id']=='')
header ('location:index.php');
 
$q=$_GET["sid"];
$user = $_SESSION['user_id'];
 
$qa = "select apptid,status from appts where sid = $q and fid = $user and status = 2"; 
$q1="select * from users where user_id = $q";
$q2="select * from sdtinfo where user_id =$q";
$r1 = @mysql_query ($q1);
	if (@mysql_num_rows($r1) !=0) 
	{//open php rows if

		while ($row1 = @mysql_fetch_assoc($r1))
		{//open php while
		
			// create variables for the a items that will be searched and make them all lowercase (what we want to search through)
			$sname = $row1['First_Name']." ". $row1['Last_Name'];
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

 

 ?>
<div class="panel panel-primary" style="margin-top:-20px; border-radius:0px;">

      <div class="panel-body" >
	  
  <div style="height:301px" >

  
  <label style="color:orange;font-size:20px">
 Student Information</label></p> 
 
 
 <?php
echo "<table><tr><td id='t'><b>Name</b></td><td>&nbsp;&nbsp;:</td><td>$sname</td></tr>";
echo "<tr><td id='t'><b>Student ID</b> </td><td>&nbsp;&nbsp;:</td><td> $q</td></tr>";
echo "<tr><td id='t'><b>Phone #</b></td><td>&nbsp;&nbsp;:</td><td>		 $phone</td></tr>";
echo '<tr><td id=t><b>E-Mail</b></td><td>&nbsp;&nbsp;:</td><td>  <a href="mailto:'.$email.'">'.$email.'</a></td></tr> ';
echo "<tr><td id='t'><b>Concentration</b></td><td>&nbsp;&nbsp;:</td><td>  $major</td></tr>";
echo "<tr><td id='t'><b>Level</b></td><td>&nbsp;&nbsp;:</td><td>  $level</td></tr>";
echo "<tr><td id='t'><b>Status</b></td><td>&nbsp;&nbsp;:</td><td>  $status</td></tr>";
echo "<tr><td id='t'><b>Processed On</b></td><td>&nbsp;&nbsp;:</td><td>  $admissiondate</td></tr>";
echo "<tr><td id='t'><b>Graduated On</b></td><td>&nbsp;&nbsp;:</td><td>  $graddate </td></tr>";
echo "<tr><td id='t'><b>Comments </b></td><td>&nbsp;&nbsp;:</td><td>  $comments </td></tr></table>";
?>

 <?php
if($_SESSION['u_type']!="4")
{
 ?>
 

<button type="button" class="btn btn-warning" id="myBtn1">Create Appointment</button>
<script>
$(document).ready(function(){
    $("#myBtn1").click(function(){
        $("#myModal1").modal();
    });
});
</script>
  <style>
  .modal-header, h4, .close {
      background-color: #5cb85c;
      color:white !important;
      text-align: center;
      font-size: 30px;
  }
  .modal-footer {
      background-color: #f9f9f9;
  }
  </style>

<?php
}
?>
&nbsp; 
<?php
if($_SESSION['u_type']!=3)
{
$type=$_SESSION['u_type'];
 ?>
 <a href=AdminSupdate.php?student_id=<?php echo  $q;?>&type=<?php echo $type; ?> style='color:#00A4D3;font-size:15px;'>  
 <button type="button" class="btn btn-warning" id="myBtn2">Update Information</button>
</a>
<?php
}
?>
</label>

</div>

 <label style="color:orange;font-size:20px">Appointment History</label><br>
 

<script>
function selectaction(apptid,sid)
{
var x;
 if (confirm("Do you want to continue to close the status of the appointment") == true) {
    window.location.href='closeit.php?apptid='+apptid+"&sid="+sid;  
    } 
	
	
}
</script>
 
 
 <div class="table-responsive">          
 
 

 <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
      <script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.2.0/respond.js"></script>
	  

<div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
           </div> 
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->
  
  
  <div class="modal fade" id="myModals1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
           </div> 
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->
  
  <script>
  $(document).ready(function()
{
  $('#myModals').on('hidden.bs.modal', function () {
  $(this).removeData('bs.modal');
});
});
  </script>
    <script>
	$(document).ready(function()
{
  $('#myModals1').on('hidden.bs.modal', function () {
  $(this).removeData('bs.modal');
});
});
  </script>
<table class='table'>
<?php
 

 if($_SESSION['u_type']!="4")
	$sql = 'SELECT distinct a.apptid as id, a.*,c.First_Name,c.Last_Name  FROM appts a,users c where c.user_id=a.fid and  a.sid='.$_GET['sid']." and a.fid = $user order by a.apptid desc";
else
	$sql = 'SELECT distinct a.apptid as id, a.*,c.First_Name,c.Last_Name  FROM appts a,users c where c.user_id=a.fid and  a.sid='.$_GET['sid']."  order by a.apptid desc";
 
$retval = mysql_query( $sql);
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
if (@mysql_num_rows($retval) !=0) 
{
echo "<thead><tr height='15px' id='fordisplay'>";
echo "<th style='border: 1px solid black;text-align:center;valign=baseline'>Appointment Date</th>";
echo "<th style='border: 1px solid black;text-align:center;valign=baseline'>Purpose</th>";
echo "<th style='border: 1px solid black;text-align:center;valign=baseline'>Faculty Name</th>";
echo "<th style='border: 1px solid black;text-align:center;valign=baseline'>Status</th>";
echo "</tr></thead>";
$i=0;
$status="";
$image="";
while($row2 = mysql_fetch_array($retval, MYSQL_ASSOC))
{

	$apptid=$row2['apptid'];
	$q3="select * from file where apptid='$apptid'";
	$r3 = @mysql_query ($q3);
	$purpose=$row2['description'];
	if (@mysql_num_rows($r3) !=0) 
	{//open php rows if

		
		$image="<span class='glyphicon glyphicon-paperclip'></span>";
		$space=" ";
		$purpose=$purpose.$space.$image;
	}//close php rows if

$i++;
$action="";
$view="";
$Note="";
$color="";
$session=$_SESSION['user_id'];
 if($row2['status']=='2'){
	 $status="Open"; 
	$color="green";
	$view="<a data-toggle='modal' href='viewappoint.php?aptid=$row2[apptid]&sid=$_GET[sid]' data-target='#myModals'>".$purpose."</a>";
	  if($_SESSION['u_type']!="4")
	{
	$view="<a data-toggle='modal' href='addnote.php?aptid=$row2[apptid]&sid=$_GET[sid]&usertype=$session' data-target='#myModals'>".$purpose."</a>";
	
 }
 }
 if($row2['status']=='3')
 {
$status="Closed"; 
$color="red";
$view="<a data-toggle='modal' href='viewappoint.php?aptid=$row2[apptid]&sid=$_GET[sid]&usertype=$session' data-target='#myModals'>".$purpose."</a>";

 }
$studentinfo="".
//"<td style='border: 1px solid black;width:2%;text-align:center;valign=baseline'>".$i."</td>".
//"<td style='border: 1px solid black;width:2%;text-align:center;valign=baseline'>".$row2['id']."</td>".
		 "<td style='border: 1px solid black;text-align:center;valign=baseline;'>".$row2['start_date']."</td>".
   "<td cellpadding=20 style='border: 1px solid black;width:auto;text-align:center;valign=baseline'>".$view."</td>".
     "<td style='border: 1px solid black;width:auto;text-align:center;valign=baseline'>".$row2['First_Name']."  ".$row2['Last_Name']."</td>
	 <td style='border: 1px solid black;text-align:center'><font color='".$color."'>".$status."</font></td>";
	 
		if($i%2==0)
           echo "<tr id='fortd1'>".$studentinfo;
        else
		 echo "<tr id='fortd2'>".$studentinfo;
	   } 
}
else
{
	echo "No appointments for this student"; 

} 
 
mysql_close($conn);
 
?>
  </table>
  
  
  
</div></div>
 </html>

 <script type="text/javascript">
function closewindow()
{
	var x=document.getElementById('aptid').value;
	var x1=document.getElementById('sid').value;
 window.location.href='addnote.php?aptid='+x+'&sid='+x1;

}
</script>
<?php 
if(isset($_POST['apsubmit']))
 {
error_reporting(0);
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
include ('includes/mailer.inc.php');
$fname=$_POST['Purpose'];
$lname=$_POST['aNote'];
$sid=$_POST['studentid'];
$continue=0;
$today =  date('Y-m-d');
$student="";
$faculty="";
 




 
if($sid!=''){
$q1="INSERT INTO appts (sid,fid,start_date,end_date,start_time,stop_time,description,status) VALUES ('".$_POST['studentid']."','".$_SESSION['user_id']."','".$today."','".$today."',CURTIME(),'".$_POST['time']."','".$_POST['Purpose']."',2)";
$newaptid="";
$time="";
$results1 = @mysql_query ($q1);
if($results1)
{
	
//and stop_time='".$_POST['time']."'
	$lookup = "select apptid,TIME_FORMAT(start_time,'%H:%i %p') as start_time from appts where sid='".$_POST['studentid']."' and fid ='".$_SESSION['user_id']."' and start_date = '".$today."' ";
	$results2 = @mysql_query ($lookup);
	 
		if (@mysql_num_rows($results2) !=0) 
		{//open php rows if
 
			while ($row1 = @mysql_fetch_assoc($results2))
			{//open php while
			$time = $row1['start_time'];
			$newaptid = $row1['apptid'];
		
		//	echo "appointment id".$newaptid;
			}//close php while
		}//close php rows if

	$createnote = "INSERT INTO apptnote (apptid,date,time,fid,note) values ('".$newaptid."','".$today."','".$time."','".$_SESSION['user_id']."','".$_POST['aNote']."')";
	$results3 = @mysql_query ($createnote);
	if($results3)
		{
			
		echo "<div align='center'><h3>new appointment created</h3>";
		echo"Appointment #".$newaptid." has been created.";
			echo "<input type=hidden id='aptid' name='aptid' value='$newaptid'>";
		echo "<input type=hidden id='sid' name='aptid' value='$sid'>";
		//echo'<input name="Continue" type="button" value="Continue" onclick= "closewindow()" /></div>';
		}
		else
		{
 		echo "<h3> Update Failure</h3>";  
		echo $qry;
		echo	@mysql_error(); 
		}
		//echo "appt-".$newaptid;

}
else
{
 echo "<h3> Update Failure</h3>";  
echo $qry;
echo	@mysql_error(); 
}
/*
}//close continue if
*/
 
}
else
{
	echo "window.location.href=begin.php?aptid=$newaptid&sid='".$_POST['studentid']."'";
	
}
 

	
}	

?>



 <script type="text/javascript">
 closewindow();
 </script>
</body>
</html>


 

<style>
#mulitplefileuploader
{
	
}
</style>

 </div>
   <?php
include("footer.php");
 ?> <script>
 
$(document).ready(function()
{
 
var settings = {
    url: "testingfile.php",
    method: "POST",
    fileName: "myfile",
    multiple: true,	
    onSuccess:function(files,data,xhr)
    {
        $("#status").html("<font color='green'>Upload is success</font>"); 
 
    },
afterUploadAll:function()
    {
	$( "#myModal1" ).load( "studentsrch.php?aptid="+st+ " #myModal1 ");	
    },
    onError: function(files,status,errMsg)
    {       
        $("#status").html("<font color='red'>Upload is Failed</font>");
    }
}
$("#mulitplefileuploader").uploadFile(settings);
 


 $('#refresh').click(function() {
    location.reload(true);
});




});



</script>



<script>
  $("#mulitplefileuploader.upload form").text("Browse"); 
  </script>

     

<div class="modal fade" id="myModal1" role="dialog" >
  <link href="upsrc/css/uploadfilemulti.css" rel="stylesheet">
 
<script src="upsrc/js/jquery.fileuploadmulti.min.js"></script>
<script src="upsrc/js/bootstrap-filestyle.js"></script>
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="">
	<form id="my-form">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span> Create Appointment</h4>
        </div>
        <div class="modal-body">
          
            <div class="form-group">
			<input type="hidden" name="studentid" id="studentid" value="<?php echo $_GET['sid']; ?>"/>
<input type="hidden" name="time" id="time" value=""/>

              <label for="usrname" style="color:orange;font-size:20px">Purpose</label>
              <input type="text" class="form-control" name="Purpose" placeholder="Enter purpose" required>
            </div>
           <div class="form-group">
              <label for="usrname" style="color:orange;font-size:20px">Notes</label>
          <textarea  class="form-control" rows="15" name="aNote"></textarea>  </div>
		  
		  
		        <div class="form-group">
  
              <label for="usrname" style="color:orange;font-size:20px">Upload File(Choose or Drag&Drop)</label>
            <input name='documents[]' multiple='multiple'  type='file'  id="mulitplefileuploader"/> </div>   
		  
            <button type="submit" name="apsubmit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Submit</button>
	</tr>
       

		 </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
         
        </div>
      </div>
    </div>
  </div> 
  
 <script>
    (function($){
        function processForm( e ){
            $.ajax({
                url: 'App_sampledata.php',
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: $(this).serialize(),
                success: function( data, textStatus, jQxhr ){
                    $('#response pre').html( data );
			    alert(data);
   location.reload(true);
					 
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
                }
            });

            e.preventDefault();
        }

        $('#my-form').submit( processForm );
    })(jQuery);

   </script> 