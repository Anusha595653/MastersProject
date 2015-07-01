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
echo "<table><tr><td id='t'>Name</td><td>&nbsp;&nbsp;:</td><td><b>$sname</b></td></tr>";
echo "<tr><td id='t'>Student ID </td><td>&nbsp;&nbsp;:</td><td><b> $q</b></td></tr>";
echo "<tr><td id='t'>Phone #</td><td>&nbsp;&nbsp;:</td><td>		<b> $phone</b></td></tr>";
echo '<tr><td id=t>E-Mail</td><td>&nbsp;&nbsp;:</td><td><b>  <a href="mailto:'.$email.'">'.$email.'</a></b></td></tr> ';
echo "<tr><td id='t'>Concentration</td><td>&nbsp;&nbsp;:</td><td> <b> $major</b></td></tr>";
echo "<tr><td id='t'>Level</td><td>&nbsp;&nbsp;:</td><td><b>  $level</b></td></tr>";
echo "<tr><td id='t'>Status</td><td>&nbsp;&nbsp;:</td><td> <b> $status</b></td></tr>";
echo "<tr><td id='t'>Processed On</td><td>&nbsp;&nbsp;:</td><td> <b> $admissiondate</b></td></tr>";
echo "<tr><td id='t'>Graduated On</td><td>&nbsp;&nbsp;:</td><td><b>  $graddate </b></td></tr>";
echo "<tr><td id='t'>Comments </td><td>&nbsp;&nbsp;:</td><td><b>  $comments </b></td></tr></table>";
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
if($_SESSION['u_type']=="2")
{
 ?>
 <a href='AdminSupdate.php?student_id=<?php echo  $q;?>' style='color:#00A4D3;font-size:15px;'>  
 <button type="button" class="btn btn-warning" id="myBtn2">Update Information</button>
</a>
<?php
}
?>
</label>

</div>

 <label style="color:orange;font-size:20px">Appointment History</label>


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

  
 <table class="table" width="80px" >
    
<tr >
<td style='border: 1px solid black;text-align:center'>S.No</td>
<td style='border: 1px solid black;width:2%'>ID</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Appointment_Date</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Purpose</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Faculty_Name</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Status</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>View</td>
<?php
 if($_SESSION['u_type']!="4")
 {
 ?>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Action</td>

<td style='border: 1px solid black;text-align:center;valign=baseline'>Edit</td>
<?php
 }
?> 
</tr> <?php
 

 if($_SESSION['u_type']!="4")
	$sql = 'SELECT distinct a.apptid as id, a.*,c.First_Name,c.Last_Name  FROM appts a,users c where c.user_id=a.fid and  a.sid='.$_GET['sid']." and a.fid = $user order by a.apptid desc";
else
	$sql = 'SELECT distinct a.apptid as id, a.*,c.First_Name,c.Last_Name  FROM appts a,users c where c.user_id=a.fid and  a.sid='.$_GET['sid']."  order by a.apptid desc";
 
$retval = mysql_query( $sql);
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
$i=0;
$status="";
while($row2 = mysql_fetch_array($retval, MYSQL_ASSOC))
{
$i++;
$action="";
$view="";
$Note="";
 if($row2['status']=='2'){
	 $status="Open"; 
	  if($_SESSION['u_type']!="4"){
	$action="<a href=# onclick=selectaction('$row2[apptid]','$row2[sid]')>Close Appointment</a>";
	$Note="<a href=addnote.php?aptid=$row2[apptid]&sid=$_GET[sid]>Note</a>";
 }
 }
 if($row2['status']=='3')
 {
$status="Close"; 
 $action="Closed";
 $Note="No Edit";
 }
$studentinfo="".
"<td style='border: 1px solid black;width:2%;text-align:center;valign=baseline'>".$i."</td>".
"<td style='border: 1px solid black;width:2%;text-align:center;valign=baseline'>".$row2['id']."</td>".
		 "<td style='border: 1px solid black;text-align:center;valign=baseline;'>".$row2['start_date']."</td>".
   "<td cellpadding=20 style='border: 1px solid black;width:auto;text-align:center;valign=baseline'>".$row2['description']."</td>".
     "<td style='border: 1px solid black;width:auto;text-align:center;valign=baseline'>".$row2['First_Name'].$row2['Last_Name']."</td>
	 <td style='border: 1px solid black;text-align:center'>".$status."</td>
	 <td style='border: 1px solid black;text-align:center;valign=baseline'><a href=viewappoint.php?aptid=$row2[apptid]&sid=$_GET[sid]>View</a></td>
	 <td style='text-align:center;border: 1px solid black'>".$action."</td>".
  "<td style='border: 1px solid black;text-align:center;valign=baseline'>".$Note."</td> "; 
		if($i%2==0)
           echo "<tr id='fortd1'>".$studentinfo;
        else
		 echo "<tr id='fortd2'>".$studentinfo;
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


 



 </div>
   <?php
include("footer.php");
 ?> 
 
<div class="modal fade" id="myModal1" role="dialog" >
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="">
		<form id="newappt" name="newappt" method="post"  action=" ">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span> Create Appointment</h4>
        </div>
        <div class="modal-body">
          
            <div class="form-group">
			<input type="hidden" name="studentid" id="studentid" value="<?php echo $_GET['sid']; ?>"/>
<input type="hidden" name="time" id="time" value=""/>

              <label for="usrname">Purpose</label>
              <input type="text" class="form-control" name="Purpose" placeholder="Enter purpose">
            </div>
           <div class="form-group">
              <label for="usrname">Notes</label>
          <textarea colspan="15" class="form-control" rowspan="15" name="aNote"></textarea>  </div>
          
            <button type="submit" name="apsubmit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Submit</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
         
        </div>
      </div>
    </div>
  </div> 