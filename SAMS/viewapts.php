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
 
<label style="color:orange;font-size:20px">Appointment History</label>
<div class="table-responsive">          
  <table class="table">

<tr height="15px" id="fordisplay"><td style='border: 1px solid black;text-align:center'>S.No</td>
<td style='border: 1px solid black;width:2%'>ID</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Appointment Date</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Purpose</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Student Name</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Status</td>
 
<td style='border: 1px solid black;text-align:center;valign=baseline'>View</td>
<?php
if($_SESSION['u_type']!="4"){?>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Edit</td>
 <?php
}
?>
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
 

 
if($_SESSION['u_type']!="4")
	$sql = "SELECT distinct a.apptid as id,c.user_id,a.sid, a.*,c.First_Name,c.Last_Name  FROM appts a,users c where c.user_id=a.sid and a.fid=$user order by a.apptid desc";
else
	$sql = "SELECT distinct a.apptid as id,c.user_id,a.sid, a.*,c.First_Name,c.Last_Name  FROM appts a,users c where c.user_id=a.sid  order by a.apptid desc";

 
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
 	$action="<a href=# onclick=selectaction('$row2[apptid]','$row2[Sid]')>Close Appointment</a>";
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
     "<td style='border: 1px solid black;width:auto;text-align:center;valign=baseline'>".$row2['First_Name']."  ".$row2['Last_Name']."(<a href=studentsrch.php?sid=$row2[user_id]>View</a>)</td><td style='border: 1px solid black;text-align:center'>".$status."</td>"."
   <td style='border: 1px solid black;text-align:center;valign=baseline'><a href=viewappoint.php?aptid=$row2[apptid]&sid=$row2[sid]>View</a></td>";
 if($_SESSION['u_type']!="4")
$studentinfo=$studentinfo.  "<td style='border: 1px solid black;text-align:center;valign=baseline'>".$Note."</td> "; 
		if($i%2==0)
           echo "<tr id='fortd1'>".$studentinfo;
        else
		 echo "<tr id='fortd2'>".$studentinfo;
	   }  
 
mysql_close($conn);
 
?>
 
 
 
</tr>
</table>
</div></div>
 </div> <br> <br> <br> <br>
 </div>
 

 
   <?php
include("footer.php");
 ?> 
 
