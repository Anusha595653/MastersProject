<?php
error_reporting(0);
Session_start();
 require_once ('mysql_connect.php');
	session_start();
include("headers.php");
include("container.php");
getheader();
 
 $user = $_SESSION['user_id'];
 $q=$user;
$qa = "select apptid,status from appts where sid = $user and status = 2";
$q1="select * from users where user_id = $user";
$q2="select * from sdtinfo where user_id =$user";
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
	  
  <div style="height:100%" >
 
<label><b style="color:orange;font-size:20px">Student Details</b>&nbsp;&nbsp; 
 </label>
 
 <?php
echo "<table><tr><td>Name</td><td>&nbsp;&nbsp;:</td><td><b>$sname</b></td></tr>";
echo "<tr><td>Student ID </td><td>&nbsp;&nbsp;:</td><td><b> $q</b></td></tr>";
echo "<tr><td>Phone #</td><td>&nbsp;&nbsp;:</td><td>		<b> $phone</b></td></tr>";
echo '<tr><td>E-Mail</td><td>&nbsp;&nbsp;:</td><td><b>  <a href="mailto:'.$email.'">'.$email.'</a></b></td></tr> ';
echo "<tr><td>Concentration</td><td>&nbsp;&nbsp;:</td><td> <b> $major</b></td></tr>";
echo "<tr><td>Level</td><td>&nbsp;&nbsp;:</td><td><b>  $level</b></td></tr>";
echo "<tr><td>Status</td><td>&nbsp;&nbsp;:</td><td> <b> $status</b></td></tr>";
echo "<tr><td>Processed On</td><td>&nbsp;&nbsp;:</td><td> <b> $admissiondate</b></td></tr>";
echo "<tr><td>Graduated On</td><td>&nbsp;&nbsp;:</td><td><b>  $graddate </b></td></tr>";
echo "<tr><td>Comments </td><td>&nbsp;&nbsp;:</td><td><b>  $comments </b></td></tr></table>";
?>


</div>
 
<div class="table-responsive">          
  <table class="table">
<label><b style="color:orange;font-size:20px">Appointment History</b></label>


<tr height="15px" id="fordisplay"><td style='border: 1px solid black;text-align:center'>S.No</td>
<td style='border: 1px solid black;width:2%'>ID</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Appointment Date</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Purpose</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Faculty Name</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Status</td>
 
<td style='border: 1px solid black;text-align:center;valign=baseline'>View</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Edit</td>
 
</tr>
<script>
function selectaction(apptid,sid)
{
	  var x;
    if (confirm("Do you want to continue to close the status of the appointment") == true) {
    window.location.href='closeit2.php?apptid='+apptid+"&sid="+sid;  
    } 
	
	
}
</script>
  <?php
 

 
	$sql = "SELECT distinct a.apptid as id, a.*,c.First_Name,c.Last_Name  FROM appts a,users c where c.user_id=a.fid and  a.sid = ".$user." order by a.apptid desc";
 
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
//	$action="<a href=# onclick=selectaction('$row2[apptid]','$row2[Sid]')>Close Appointment</a>";
	$Note="<a href=addnote.php?aptid=$row2[apptid]&sid=$row2[sid]>Note</a>";
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
		 "<td style='border: 1px solid black;text-align:center;valign=baseline'>".$row2['start_date']."</td>".
   "<td cellpadding=20 style='border: 1px solid black;width:auto;text-align:center;valign=baseline'>".$row2['description']."</td>".
     "<td style='border: 1px solid black;width:auto;text-align:center;valign=baseline'>".$row2['First_Name'].$row2['Last_Name']."</td><td style='border: 1px solid black;text-align:center'>".$status."</td>"."
   <td style='border: 1px solid black;text-align:center;valign=baseline'><a href=viewappoint.php?aptid=$row2[apptid]&sid=$row2[sid]>View</a></td>".
  "<td style='border: 1px solid black;text-align:center;valign=baseline'>".$Note."</td> "; 
		if($i%2==0)
           echo "<tr id='fortd1'>".$studentinfo;
        else
		 echo "<tr id='fortd2'>".$studentinfo;
	   }  
 
mysql_close($conn);
 
?>
 
 
 
</tr>
</table>
 </div> </div> </div>
 

 
   <?php
include("footer.php");
 ?> 
 
