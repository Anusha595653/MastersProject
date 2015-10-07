
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
echo "<table><tr><td id='t'><b>Name</b></td><td>&nbsp;&nbsp;:&nbsp;</td><td>$sname</td></tr>";
echo "<tr><td id='t'><b>Student ID</b> </td><td>&nbsp;&nbsp;:&nbsp;</td><td> $q</td></tr>";
echo "<tr><td id='t'><b>Phone #</b></td><td>&nbsp;&nbsp;:&nbsp;</td><td>		 $phone</td></tr>";
echo '<tr><td id=t><b>E-Mail</b></td><td>&nbsp;&nbsp;:&nbsp;</td><td>  <a href="mailto:'.$email.'">'.$email.'</a></td></tr> ';
echo "<tr><td id='t'><b>Concentration</b></td><td>&nbsp;&nbsp;:&nbsp;</td><td>  $major</td></tr>";
echo "<tr><td id='t'><b>Level</b></td><td>&nbsp;&nbsp;:&nbsp;</td><td>  $level</td></tr>";
echo "<tr><td id='t'><b>Status</b></td><td>&nbsp;&nbsp;:&nbsp;</td><td>  $status</td></tr>";
echo "<tr><td id='t'><b>Processed On</b></td><td>&nbsp;&nbsp;:&nbsp;</td><td>  $admissiondate</td></tr>";
echo "<tr><td id='t'><b>Graduated On</b></td><td>&nbsp;&nbsp;:&nbsp;</td><td>  $graddate </td></tr>";
echo "<tr><td id='t'><b>Comments </b></td><td>&nbsp;&nbsp;:&nbsp;</td><td>  $comments </td></tr></table>";
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
	//$sql = 'SELECT distinct a.apptid as id, a.*,c.First_Name,c.Last_Name  FROM appts a,users c where c.user_id=a.fid and  a.sid='.$_GET['sid']." and a.fid = $user order by a.apptid desc";
	$sql = 'SELECT distinct a.apptid as id, a.*,c.First_Name,c.Last_Name  FROM appts a,users c where c.user_id=a.fid and  a.sid='.$_GET['sid']."  order by a.apptid desc";
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
		if($row2['fid']==$user)
		{
		$view="<a data-toggle='modal' href='addnote.php?aptid=$row2[apptid]&sid=$_GET[sid]&usertype=$session' data-target='#myModals'>".$purpose."</a>";
		//$image1="<span class='glyphicon glyphicon-user'></span>";
		$color1="black";
		$faculty=$row2['First_Name']."  ".$row2['Last_Name'];
		}
		else
		{
		$color1="grey";
		$view="<a data-toggle='modal' href='viewappoint.php?aptid=$row2[apptid]&sid=$_GET[sid]' data-target='#myModals'>".$purpose."</a>";
		$faculty=$row2['First_Name']."  ".$row2['Last_Name'];
		}
	
 }
 }
 if($row2['status']=='3')
 {
$status="Closed"; 
$color="red";
$view="<a data-toggle='modal' href='viewappoint.php?aptid=$row2[apptid]&sid=$_GET[sid]&usertype=$session' data-target='#myModals'>".$purpose."</a>";
if($row2['fid']==$user)
		{
		//$color1="<span class='glyphicon glyphicon-user'></span>";
		$color1="black";
		$faculty=$row2['First_Name']."  ".$row2['Last_Name'];
		}
		else
		{
		$color1="grey";
		$faculty=$row2['First_Name']."  ".$row2['Last_Name'];
		}

 }
$studentinfo="".
//"<td style='border: 1px solid black;width:2%;text-align:center;valign=baseline'>".$i."</td>".
//"<td style='border: 1px solid black;width:2%;text-align:center;valign=baseline'>".$row2['id']."</td>".
		 "<td style='border: 1px solid black;text-align:center;valign=baseline;'>".$row2['start_date']."</td>".
   "<td cellpadding=20 style='border: 1px solid black;width:auto;text-align:center;valign=baseline'>".$view."</td>".
	//"<td style='border: 1px solid black;width:auto;text-align:center;valign=baseline'>".$row2['First_Name']."  ".$row2['Last_Name']."</td>
	"<td style='border: 1px solid black;width:auto;text-align:center;valign=baseline'><font color='".$color1."'>".$faculty."</font></td>
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
    
<script>
 
$(document).ready(function()
{
 
var settings = {
    url: "App_sampledata.php?function=testingfile",
    method: "POST",
    fileName: "myfile",
    multiple: true,	
    onSuccess:function(files,data,xhr)
    {
        //$("#status").html("<font color='green'>Upload is success</font>"); 
	$( "#filesTable" ).load( "App_sampledata.php?function=filestable&createapp=1");
 	//location.reload();
    },
afterUploadAll:function()
    {	
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
<script type="text/javascript">

	$(document).ready(function()
	{
		$('table#delTable td a.delete').click(function()
		{
			
				var id = $(this).parent().attr('id');
				var data = 'id=' + id ;
				var parent = $(this).parent();

				$.ajax(
				{
					   type: "POST",
					   url: "delete_row.php?id="+id,
					   data: data,
					   cache: false,
					
					   success: function(data, textStatus, jQxhr)
					   {
						   if(data=='done'){
							  alert('Successfully Deleted');
						   parent.fadeOut('slow', function() {$(this).remove();});}
						 else
							 alert('failed  Try Again');
					   }
				 });				
		});
		
		// style the table with alternate colors
		// sets specified color for every odd row
		$('table#delTable tr:odd').css('background',' #FFFFFF');
	});
	
</script>	


     

<div class="modal fade" id="myModal1" role="dialog" data-backdrop="static" data-keyboard="false">
  <link href="upsrc/css/uploadfilemulti.css" rel="stylesheet">
 
<script src="upsrc/js/jquery.fileuploadmulti.min.js"></script>
<script src="upsrc/js/bootstrap-filestyle.js"></script>
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="">
	<form id="my-form">

          <button type="button" class="close" id="cross">&times;</button>
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
		  
	<div class="table-responsive">
	<table clas="table">
	<tr>
	<td>	  
	<div class="form-group">
  	
              <label for="usrname" style="color:orange;font-size:20px">Upload File</label>
		<table><tr><td>
            <input name='documents[]' multiple='multiple'  type='file'  id="mulitplefileuploader"/> <td><td><div></div></td></tr></table></div>
<div id="status"></div> </td>
<td style="padding:40px;">
<div class="form-group">
<input type="checkbox" name="close" style="width:18px;height:18px;" value="close"><font style="color:orange;font-size:20px">   Close Appointment</font>
</div>
</td>
</tr>
</table>
</div>
 
<div class="table-responsive" id="filesTable">    
<label for="usrname" style="color:orange;font-size:20px">Uploaded Files</label>  
<table class='table' id='delTable'> 
	<?php
	//set part1 to be blank
	$part1="";
	//set part 2 to be blank
	$part2="";
	$status="open";
	//if the appointment is still open, create the form for uploading files and attach it to $hint
	if ($status=="open")
	{
		/*$hint=$hint.'
			<p ><Br><br><label style=font-size:20px;color:orange>File Upload:</label>
			<form action="" method="post" enctype="multipart/form-data">
			<input type="file" name="uploaded_file" required class="btn btn-primary">
			<input type="submit" name="addfile" value="Upload file" class="btn btn-warning">
			<input type="hidden" name="apptid" id="apptid" value="'.$q.'"/>
			<input type="hidden" name="studentid" id="studentid" value="'.$sid.'"/>
			
			<br/><br/>';*/
	}
	$st1 = mysql_fetch_row(mysql_query("SELECT max(apptid) as apptid FROM appts"));
	$version1 = $st1[0] + 1;	
	$sql = "select *,Date_FORMAT(created,'%Y-%d-%m %h:%m %p') as created from file where apptid = ".$version1." order by id desc";
	//run the query
	$i=0;
	$result = @mysql_query($sql);
	// Check if it was successfull
	if (@mysql_num_rows($result) !=0) 
	{//open php rows if
 		// Print the top of a table
		
		$part1= '<tr>			
                </tr>';
 		$j=0;
		while ($row = @mysql_fetch_assoc($result))
		{//open php while
		$i++;
		$j++;	//pick icon
			//set $mime to be the mimetype of the file in the db
			$mime=$row['mime'];
			//check to see if the uploaded files matches the description of the known file types
			$position1 = substr_count($mime, 'word');
			$position2= substr_count($mime, 'text');
			$position3 = substr_count($mime, 'pdf');
			$position4 = substr_count($mime, 'presentation');
			$position5 = substr_count($mime, 'spre');
			if ($position1 != 0)
			{
				$iconLocation = "./icons/doc.bmp";
				$doctype = "Word Document";
			}
			else
			if ($position2 != 0)
			{
				$iconLocation = "./icons/text.bmp";
				$doctype = "Text Document";
			}
			else
			if ($position3 != 0)
			{
				$iconLocation = "./icons/pdf.bmp";
				$doctype = "PDF";
			}
			else
			if ($position4 != 0)
			{
				$iconLocation = "./icons/ppt.bmp";
				$doctype = "PowerPoint Document";
			}
			else
			if ($position5 != 0)
			{
				$iconLocation = "./icons/xls.bmp";
				$doctype = "Excel Document";
			}
			else
			{
				$iconLocation = "./icons/file.bmp";
				$doctype = "Document";
			}
			//once icon is determined, create the link and output file info in the table, do for each file found during looponclick='Download({$row['id']})'
			$part2="
                <td style='text-align:left; ' id='{$row['id']}'>
					<a href='#' onclick='Download({$row['id']})'><img src='".$iconLocation."' title='".$doctype."' width='25' height='25' /></a>
                   <a href='#' onclick='Download({$row['id']})'>{$row['name']}</a>
       
					";
					
			if($status == "open")
			{
				//if the appointment is still open, give link for deleting file, no file deleting after appointment is closed
				$part2=$part2."  <a href='#' class='delete'><span class='glyphicon glyphicon-remove'></span></a>";
			}
          $part2=$part2;
		  if($j>=5){
			$j=1;
			echo  "</tr><tr id='fortd1'>".$part2;
		  
		  }
		  else 
			  echo "</td>".$part2;
		/*  	if($i%2==0)
		  echo "<tr id='fortd1'>".$part2;
				else
		 		  echo "<tr id='fortd2'>".$part2;*/
			  
		}//close php while
		// Close table
		
        $part3='';

		//add all parts to $hint
		$hint=$hint.$part1.$part3;
		echo $hint;
		if($i==0)
			echo "<font color=red>Sorry No Records</font>";
	}//close php rows if
	//if no files have been uploaded
	else
	{	
		$hint=$hint."No uploaded files";
		echo $hint;
	}
	
	echo "<Br><br>";
	?>
	<?php
	if(isset($_POST['addfile']))
	{
		addfile();
                if($hint=="")
		 echo "<script>alert('Select file before you upload')</script>";
                  else
 		echo "<script>alert('File added successfully')</script>";
		echo $meta;
	}
	?>
	<script>
	function Download(vari1)
	{
		window.location.href='App_sampledata.php?function=get_file&id='+vari1;
		
	}
	function Delete(vari1)
	{
		var vari2="Delete";
 		window.location.href='App_sampledata.php?function=addfile&id1='+vari1+"&Delete="+vari2;
		
	}
	</script>
	</table>	
</div>
</br></br>
<table class="table">
<tr>
<td>
<button type="submit" class="btn btn-warning" style="float:left;" id="cancel"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
</td>
<td>		
<input name="apsubmit" type="submit" style="float: right;" value="Submit" class="btn btn-primary" /></td></tr></table>
	
	

	</form>
        </div>
        <div class="modal-footer">
          <!-- <button type="submit" class="btn btn-default btn-default pull-left" id="cancel"><span class="glyphicon glyphicon-remove"></span> Cancel</button>-->
         
        </div>
      </div>
    </div>
  </div> 
  
 <script>
    (function($){
        function processForm( e ){
            $.ajax({
                url: 'App_sampledata.php?function=createapp',
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

<script type="text/javascript">
var stid=<?=$q;?>;
    $(document).ready(function()
	{
        $('#cancel, #cross').click(function(){

            $.ajax({
                type: 'POST',
                url: 'App_sampledata.php?function=cancelapp&stid='+stid,
                success: function(data) {
			$('#myModal1').modal('hide');
			location.reload();
                }
            });
   });
});
</script>

<?php
include("footer.php");
 ?>