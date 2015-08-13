<?php 
  require_once ('mysql_connect.php');
 global $q,$hint,$sid;
	$q=$_GET['aptid'];
	$sid=$_GET['sid'];
 
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
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Appointment Details</h4>
            </div>	<!-- /modal-header -->
            <div class="modal-body"> 
  
<label style="color:orange;font-size:20px">Student Details</label>
 <?php
echo "<table style='font-size:15px;'><tr><b><td><b>Name</b></td><td>&nbsp;&nbsp;:</td><td>$sname</td></tr>";
echo "<tr ><td><b>Student ID </b></td><td>&nbsp;&nbsp;:</td><td> $_GET[sid]</td></tr>";
echo "<tr><td><b>Phone #</b></td><td>&nbsp;&nbsp;:</td><td>	 $phone</td></tr>";
echo '<tr><td><b>E-Mail</b></td><td>&nbsp;&nbsp;:</td><td>  <a href="mailto:'.$email.'">'.$email.'</a></td></tr> ';
echo "<tr><td><b>Concentration</b></td><td>&nbsp;&nbsp;:</td><td> $major</td></tr>";
echo "<tr><td><b>Level</b></td><td>&nbsp;&nbsp;:</td><td> $level</td></tr></table>";
?>
<br>

<?php
	
$st = mysql_fetch_row(mysql_query("select note,description  from appts where apptid = $q  "));
$updatenote= $st[0] ;	
$description=$st[1];
 
?>

<label style="color:orange;font-size:20px">Purpose</label> 
<input type="text" style="background-color:white;" class="form-control" name="epurpose" value="<?php echo $description;?>" readonly>

<label style="color:orange;font-size:20px">Entered Notes</label><br/>
<div class='panel panel-default'>
<div><p><?php echo $updatenote;?></p></div></div>
<div class="table-responsive">    
<label for="usrname" style="color:orange;font-size:20px">Uploaded Files</label>     
<table class="table" id="delTable">
	<?php 
	$st1 = mysql_fetch_row(mysql_query("select status from appts where apptid = $q  "));
	$status= $st1[0] ;
	//set part1 to be blank
	$part1="";
	//set part 2 to be blank
	$part2="";
	//$status="open";
	//if the appointment is still open, create the form for uploading files and attach it to $hint
	if ($status==2)
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
	//create title for uploaded files and attach to $hint
	//$hint=$hint.'<p><label style=font-size:20px;color:orange>Uploaded Files</label><br/>';
	// Query for a list of all existing files and format the date
	$sql = "select *,Date_FORMAT(created,'%Y-%d-%m %h:%m %p') as created from file where apptid = ".$_GET['aptid']." order by id desc";
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
		<a href='#' onclick='Download({$row['id']})'><img src='".$iconLocation."' title='".$doctype."' width='25' height='25' /></a><br>
                <a href='#' onclick='Download({$row['id']})'>{$row['name']}</a>";
					
			if($status==2)
			{
				
				//if the appointment is still open, give link for deleting file, no file deleting after appointment is closed
				$part2=$part2."<br><a href='#' class='delete'><span class='glyphicon glyphicon-remove'></span></a>";
			}
          	//$part2=$part2;
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
		window.location.href='files.php?id='+vari1;
		
	}
	function Delete(vari1)
	{
		var vari2="Delete";
 window.location.href='files.php?id1='+vari1+"&Delete="+vari2;
		
	}
	</script>
	</table>
</div>
</div></div></div>	<!-- /modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            </div>	<!-- /modal-footer -->
