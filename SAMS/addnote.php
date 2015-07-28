<?php 
error_reporting(0);
$meta = '<meta http-equiv="Refresh" content="3" />';
 
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

?><div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Update Appointment</h4>
            </div>	<!-- /modal-header -->
            <div class="modal-body">
             
  <label style="font-size:20px;color:orange">Student Details</label>
 <?php
echo "<table style='font-size:15px;'><tr><td><b>Name</b></td><td>&nbsp;&nbsp;:</td><td>$sname </td></tr>";
echo "<tr ><td><b>Student ID </b></td><td>&nbsp;&nbsp;:</td><td>  $sid  </tr>";
echo "<tr><td><b>Phone #</b></td><td>&nbsp;&nbsp;:</td><td>		  $phone </td></tr>";
echo '<tr><td><b>E-Mail</b></td><td>&nbsp;&nbsp;:</td><td>   <a href="mailto:'.$email.'">'.$email.'</a> </td></tr> ';
echo "<tr><td><b>Concentration</b></td><td>&nbsp;&nbsp;:</td><td>  $major </td></tr>";
echo "<tr><td><b>Level</b></td><td>&nbsp;&nbsp;:</td><td>  $level</b> </tr></table>";
?>
	
	
	<?php
	
	 $st = mysql_fetch_row(mysql_query("select note,description  from appts where apptid = $q  "));
$updatenote= $st[0] ;	
$description=$st[1];
 
	?>
	
	</br>



<form id="my-form">
<label style="color:orange;font-size:20px">Purpose</label> 
<input type="text" class="form-control" name="epurpose" value="<?php echo $description;?>">

<label style="color:orange;font-size:20px">Notes</label> 
 

<input type="hidden" name="sid" id="sid" value="<?php echo $sid; ?>" />
<input type="hidden" name="time" id="time" value=""/>
<input type ="hidden" name="Purpose" id="Purpose" value="  " />
<input type ="hidden" name="appid" id="appid" value="<?php echo $q; ?>" />

<div class="table-responsive">  
  <table class="table" >
<tr><td>

<textarea name="Note" class="form-control" id="Note" rows="15" ><?php echo $updatenote; ?></textarea>&nbsp; </br>  </br>

</td></tr>
<tr>
<td><div class="form-group">
              <label for="usrname" style="color:orange;font-size:20px">Upload Files(Choose or Drag&Drop)</label>
			  <input name='documents[]' multiple='multiple' type='file' id="mulitplefileuploader"/>
			<!--  <input type="file" class="form-control" multiple> --> </div>
      <div id="status"></div> </td>
</tr>
<tr>
<td>

<input name="Submit" type="submit" onclick="return etext()" id="notesbutton" value="Submit" class="btn btn-warning" />
</td></tr>

 </tr>

</table></div>	
</form>
<div id="special"/>
</form>

 

 
<script>
    (function($){
        function processForm( e ){
            $.ajax({
                url: 'sampledata.php',
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: $(this).serialize(),
                success: function( data, textStatus, jQxhr ){
                    $('#response pre').html("Updated Successfully");
					$('#Note').html( data );
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
 
 
<script>

$(document).ready(function()
{
var st=document.getElementById('appid').value;
var settings = {
	url: "testingfile1.php",
	method: "POST",
	formData: {appid:st},
	allowedTypes:"jpg,png,gif,doc,pdf,zip",
	fileName: "myfile",
	multiple: true,
	onSuccess:function(files,data,xhr)
	{
		$("#status").html("<font color='green'>Upload is success</font>");
		
	},
    afterUploadAll:function()
    {
        alert("All files/images uploaded!!");
    },
	onError: function(files,status,errMsg)
	{		
		$("#status").html("<font color='red'>Upload Failed</font>");
	}
}
$("#mulitplefileuploader").uploadFile(settings);

});
</script>

	

 
<div class="table-responsive">    
 <label for="usrname" style="color:orange;font-size:20px">Uploaded Files</label>     
  <table class="table">
<tr height='15px' ><td style='border: 1px solid black;text-align:center'>S.No</td>
<td style='border: 1px solid black;width:2%'>Icon</td>
<td style='border: 1px solid black;text-align:center;valign=baseline'>Name</td>
 
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
	function Delete(vari1,vari2,vari3)
	{
		 
 window.location.href='files.php?id='+vari1+"&student="+vari2+"&aptid="+vari3;
		
	}
	</script>
	</table>
</div>	</div></div>   </div>	<!-- /modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>	<!-- /modal-footer -->
