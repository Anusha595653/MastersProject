<?php 
error_reporting(0);
$meta = '<meta http-equiv="Refresh" content="3" />';
 
include("headers.php");
include("files.php");
include("container.php");
getheader();
if($_SESSION['user_id']=='')
header ('location:index.php');
 require_once ('mysql_connect.php');
 global $q,$hint,$sid;
	$q=$_GET['aptid'];
	$sid=$_GET['sid'];
?>
<?php
$usid = $_GET['sid'];
$qa = "select apptid,status from appts where sid = $usid and status = 2";
$q1="select * from users where user_id = $usid";
$q2="select * from sdtinfo where user_id =$usid";
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
 
  <label style="font-size:20px;color:orange">Student Details</label>
 <?php
echo "<table style='font-size:15px;'><tr><td>Name</td><td>&nbsp;&nbsp;:</td><td><b>$sname</b></td></tr>";
echo "<tr ><td>Student ID </td><td>&nbsp;&nbsp;:</td><td><b> $sid</b></td></tr>";
echo "<tr><td>Phone #</td><td>&nbsp;&nbsp;:</td><td>		<b> $phone</b></td></tr>";
echo '<tr><td>E-Mail</td><td>&nbsp;&nbsp;:</td><td><b>  <a href="mailto:'.$email.'">'.$email.'</a></b></td></tr> ';
echo "<tr><td>Concentration</td><td>&nbsp;&nbsp;:</td><td> <b> $major</b></td></tr>";
echo "<tr><td>Level</td><td>&nbsp;&nbsp;:</td><td><b>  $level</b></td></tr></table>";
?>
	
	
	

	
	
	</br>	<label style="color:orange;font-size:20px;">Enter Notes Here</label> 
<form id="newappt" name="newappt" method="post"  action="appupdate.php">
<input type="hidden" name="sid" id="sid" value="<?php echo $sid; ?>" />
<input type="hidden" name="time" id="time" value=""/>
<input type ="hidden" name="Purpose" id="Purpose" value="  " />
<input type ="hidden" name="appid" id="appid" value="<?php echo $q; ?>" />

<div class="table-responsive">  
  <table class="table" >
<tr><td>
<textarea name="Note" id="Note" rows="5" cols="100"></textarea>&nbsp; </br>  </br>
<input name="Submit" type="submit" onclick="return etext()" value="Submit" class="btn btn-warning" />
</td></tr></table></div>	
</form>

<br>

	

    <div class="table-responsive">    
  <table class="table">
    <thead>
 
<tr height='15px' id='fordisplay'><td style='border: 1px solid black;text-align:center'>S.No</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Created</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>By</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Note</td>

</tr>
    </thead>
 <?php
 if($_SESSION["updatecounter"]=="1")
 {
	 echo "<script>alert('Notes added successfully')</script>";
$_SESSION["updatecounter"]=0;
	 }
 if($_SESSION["updatecounter"]=="2")
 {
	 echo "<script>alert('File Deleted successfully')</script>";
$_SESSION["updatecounter"]=0;
	 }
	 $q1="select * from appts where apptid=".$q;
		$i1=0;
		$r1 = @mysql_query ($q1);
	if (@mysql_num_rows($r1) !=0) 
	{//open php rows if
	//	$sid=$row1['sid'];
	echo "</br><label style='color:orange;font-size:20px'>Notes</label>	
	";
		while ($row1 = @mysql_fetch_assoc($r1))
		{//open php while

		$part1="<p><u>Appointment Date:</u><br/> ".$row1['start_date']."<br/><br/> <u>Appointment Purpose: </u><br/> ".$row1['description']."<br/><br/>";
		$part2="</tr<tr>";
		$q2="select distinct *,TIME_FORMAT(time,'%h:%i %p') as time from apptnote where apptid = $q order by TIME_FORMAT(date,time) desc";
		$r2 = @mysql_query ($q2);
		if (@mysql_num_rows($r2) !=0) 
			{//open php rows if 2
			while ($row2 = @mysql_fetch_assoc($r2))
				{//open php while 2
			$i1++;
				$q3 = "select First_Name,Last_Name from users where user_id = ".$row2['fid'];
							$r3 = @mysql_query ($q3);
								$row3 = @mysql_fetch_assoc($r3);
			$part2=$part2."<td style='text-align:center; border: 1px solid black;'>".$i1."</td><td style='text-align:center; border: 1px solid black;'>".$row2['date']." &nbsp;".$row2['time']." </td><td style='text-align:center; border: 1px solid black;'>  ".$row3['First_Name']."  ".$row3['Last_Name']." </td><td style='text-align:center; border: 1px solid black;'>".$row2['note']."</td></tr>";
				}//close php while 2
			}//close php rows if 2
		}//close php while
		echo $part2;
		if($i1==0)
			echo "<font color=red><br>Sorry No Records</font>";
	}
	?>
	</table>
	</div>
  </div> 
<div class="table-responsive">    

	  <br>      
  <table class="table">
<tr height='15px' ><td style='border: 1px solid black;text-align:center'>S.No</td>
<td style='border: 1px solid black;width:2%'>Icon</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Name</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Size(Bytes)</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Created</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Download</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Delete</td>
</tr> 
	
	<?php
		 
	
	//set part1 to be blank
	$part1="";
	//set part 2 to be blank
	$part2="";
	$status="open";
	//if the appointment is still open, create the form for uploading files and attach it to $hint
	if ($status=="open")
	{
		$hint=$hint.'
			<p ><Br><br><label style=font-size:20px;color:orange>File Upload:</label>
			<form action="" method="post" enctype="multipart/form-data">
			<input type="file" name="uploaded_file"  class="btn btn-primary">
			<input type="submit" name="addfile" value="Upload file" class="btn btn-warning">
			<input type="hidden" name="apptid" id="apptid" value="'.$q.'"/>
			<input type="hidden" name="studentid" id="studentid" value="'.$sid.'"/>
			
			<br/><br/>';
	}
	//create title for uploaded files and attach to $hint
	$hint=$hint.'<p><label style=font-size:20px;color:orange>Uploaded Files</label><br/>';
	// Query for a list of all existing files and format the date
	$sql = "select *,Date_FORMAT(created,'%Y-%d-%m %h:%m %p') as created from file where apptid = ".$q." order by id desc";
	//run the query
	$i=0;
	$result = @mysql_query($sql);
	// Check if it was successfull
	if (@mysql_num_rows($result) !=0) 
	{//open php rows if
 		// Print the top of a table

		$part1= '
                <tr>
					
                </tr>';
 
		while ($row = @mysql_fetch_assoc($result))
		{//open php while
		$i++;
			//pick icon
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
			//once icon is determined, create the link and output file info in the table, do for each file found during loop
			$part2="</tr><tr>
                <td style='text-align:center; border: 1px solid black;'>".$i."</td>
					<td style='text-align:center; border: 1px solid black;'><a href='get_file.php?id={$row['id']}'><img src='".$iconLocation."' title='".$doctype."' width='25' height='25' /></a></td>
                    <td style='text-align:center; border: 1px solid black;'>{$row['name']}</td>
                    <td style='text-align:center; border: 1px solid black;'>{$row['size']}</td>
                    <td style='text-align:center; border: 1px solid black;'>{$row['created']}</td>
                    <td style='text-align:center; border: 1px solid black;'><a href='#' onclick='Download({$row['id']})'>Download</a></td>
					";
					
			if($status == "open")
			{
				//if the appointment is still open, give link for deleting file, no file deleting after appointment is closed
				$part2=$part2."<td style='border: 1px solid black;'><a href='#' onclick='Delete({$row['id']},$sid,$q)'>Delete</a></td>";
			}
          $part2=$part2;
		  	if($i%2==0)
		  echo "<tr id='fortd1'>".$part2;
				else
		 		  echo "<tr id='fortd2'>".$part2;
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
		$hint=$hint."No uploaded files found for appointment number ".$q;
		echo $hint;
	}
	
	echo "<Br><br>";
	?>
	<?php
	if(isset($_POST['addfile']))
	{
		addfile();
		 echo "<script>alert('File added successfully')</script>";
		echo $meta;
	}
	?>
	<script>
	function Download(vari1)
	{
		window.location.href='files.php?id='+vari1;
		
	}
	function Delete(vari1,vari2,vari3)
	{
		 
 window.location.href='files.php?id='+vari1+"&student="+vari2+"&aptid="+vari3;
		
	}
	</script>
	</table>
</div>	</div></div><?php
include('footer.php');
?>