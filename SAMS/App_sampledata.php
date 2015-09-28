<?php
require_once ('mysql_connect.php');
# Script 11.9 - loggedin.php #2
// The user is redirected here from login.php.
session_start(); // Start the session.
// If no session value is present,redirect the user:
//include ('assets/js/deletefile.js');
$function=$_GET['function'];
if($function==createapp)
	createapp();
if($function==addnote)
	addnote();
if($function==testingfile)
	testingfile();
if($function==testingfile1)
	testingfile1();
if($function==addfile)
	addfile();
if($function==deletefile)
	deletefile();
if($function==cancelapp)
	cancelapp();
if($function==filestable)
	filestable();
function createapp()
{
$fname=$_POST['Purpose'];
$lname=$_POST['Note'];
$sid=$_POST['studentid'];
$close=$_POST['close'];
$continue=0;
$today =  date('Y-m-d');
$student="";
$faculty="";
if(empty($close))
{
   
$q1="INSERT INTO appts (sid,fid,start_date,end_date,start_time,stop_time,description,note,status) VALUES ('".$_POST['studentid']."','".$_SESSION['user_id']."','".$today."','".$today."',CURTIME(),'".$_POST['time']."','".$_POST['Purpose']."','".$_POST['aNote']."',2)";
$newaptid="";
$time="";
$results1 = @mysql_query ($q1);
$data="";
if($results1)
{
	$data="Successfully Created Appointment";
 	echo $data; 
}
else
 echo "Try Again Later"; 
}
else
{
	echo "Cancelled the appointment creation"; 
}
} 

function addnote()
{
//echo "entered";
$st = mysql_query("update appts set note='$_POST[Note]',description='$_POST[epurpose]'   where apptid='$_POST[appid]'") ;
$close=$_POST['close'];
$apptid=$_POST['appid'];
if(!empty($close))
{

	$d1=("update appts set status =3 where apptid =".$apptid);
	$results2 = @mysql_query ($d1);
	echo "Successfully updated and closed appointment";
}
else
{
 echo "Successfully updated appointment";
}
}

function cancelapp()
{
$stid=$_GET['stid'];
$st = mysql_fetch_row(mysql_query("SELECT max(apptid) as apptid FROM appts"));
$version = $st[0] + 1;	
$d1=("delete from file where apptid =".$version);
$results1 = @mysql_query ($d1);
}

function testingfile()
{

if(isset($_FILES["myfile"]))
{

$st = mysql_fetch_row(mysql_query("SELECT max(apptid) as apptid FROM appts"));
$version = $st[0] + 1;		 
$newaptid1=$version;
$fileCount1 = count($_FILES["myfile"]['name']);
  for($key1=0; $key1 < $fileCount1; $key1++)
{
        $name =$_FILES['myfile']['name'] ;
        $mime = @mysql_real_escape_string($_FILES['myfile']['type']);
        $data = @mysql_real_escape_string(file_get_contents($_FILES['myfile']['tmp_name']));
        $size = intval($_FILES['myfile']['size']);
 
        // Create the SQL query
        $query = "
            INSERT INTO `file` (
                `name`, `mime`, `size`, `data`, `created`,`apptid`
            )
            VALUES (
                '{$name}', '{$mime}', {$size}, '{$data}', NOW(), '{$newaptid1}'
            )";
 
        // Execute the query
        $result = @mysql_query($query);
   
  } 		
	$ret = array();

	$error =$_FILES["myfile"]["error"];
   {
    
    	if(!is_array($_FILES["myfile"]['name'])) //single file
    	{
            $RandomNum   = time();
            
            $ImageName      = str_replace(' ','-',strtolower($_FILES['myfile']['name']));
            $ImageType      = $_FILES['myfile']['type']; //"image/png", image/jpeg etc.
         
            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt       = str_replace('.','',$ImageExt);
            $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;

       	 	move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir. $NewImageName);
       	 	 //echo "<br> Error: ".$_FILES["myfile"]["error"];
       	 	 
	       	 	 $ret[$fileName]= $output_dir.$NewImageName;
    	}
    	else
    	{
            $fileCount = count($_FILES["myfile"]['name']);
    		for($i=0; $i < $fileCount; $i++)
    		{
                $RandomNum   = time();
            
                $ImageName      = str_replace(' ','-',strtolower($_FILES['myfile']['name'][$i]));
                $ImageType      = $_FILES['myfile']['type'][$i]; //"image/png", image/jpeg etc.
             
                $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                $ImageExt       = str_replace('.','',$ImageExt);
                $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
                
                $ret[$NewImageName]= $output_dir.$NewImageName;
    		    move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$NewImageName );
   		}
    	}
/*	
	 	*/	
    }
    echo json_encode($ret);
}
}
function testingfile1()
{

if(isset($_FILES["myfile"]))
{

$st = mysql_fetch_row(mysql_query("SELECT max(apptid) as apptid FROM appts"));
$version = $st[0] + 1;		 
$newaptid1=$_POST['appid'];

 
		$fileCount1 = count($_FILES["myfile"]['name']);
  for($key1=0; $key1 < $fileCount1; $key1++)
{
        $name =$_FILES['myfile']['name'] ;
        $mime = @mysql_real_escape_string($_FILES['myfile']['type']);
        $data = @mysql_real_escape_string(file_get_contents($_FILES['myfile']['tmp_name']));
        $size = intval($_FILES['myfile']['size']);
 
        // Create the SQL query
        $query = "
            INSERT INTO `file` (
                `name`, `mime`, `size`, `data`, `created`,`apptid`
            )
            VALUES (
                '{$name}', '{$mime}', {$size}, '{$data}', NOW(), '{$newaptid1}'
            )";
 
        // Execute the query
        $result = @mysql_query($query);
   
  } 
		
		
		
	$ret = array();

	$error =$_FILES["myfile"]["error"];
   {
    
    	if(!is_array($_FILES["myfile"]['name'])) //single file
    	{
            $RandomNum   = time();
            
            $ImageName      = str_replace(' ','-',strtolower($_FILES['myfile']['name']));
            $ImageType      = $_FILES['myfile']['type']; //"image/png", image/jpeg etc.
         
            $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
            $ImageExt       = str_replace('.','',$ImageExt);
            $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;

       	 	move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir. $NewImageName);
       	 	 //echo "<br> Error: ".$_FILES["myfile"]["error"];
       	 	 
	       	 	 $ret[$fileName]= $output_dir.$NewImageName;
    	}
    	else
    	{
            $fileCount = count($_FILES["myfile"]['name']);
    		for($i=0; $i < $fileCount; $i++)
    		{
                $RandomNum   = time();
            
                $ImageName      = str_replace(' ','-',strtolower($_FILES['myfile']['name'][$i]));
                $ImageType      = $_FILES['myfile']['type'][$i]; //"image/png", image/jpeg etc.
             
                $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                $ImageExt       = str_replace('.','',$ImageExt);
                $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                $NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
                
                $ret[$NewImageName]= $output_dir.$NewImageName;
    		    move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$NewImageName );
   		}
    	}
/*	
	 	*/		
		
    }
    echo json_encode($ret);
}
}

function addfile()
{
require_once ('mysql_connect.php');

if($_GET['id1']&&$_GET['Delete']=="Delete")
{
	$query = "delete * FROM file WHERE id = ".$id;
   	$result = @mysql_query($query);
	$meta = '<meta http-equiv="Refresh" content="3;url=addnote.php" />';
}


// Check if a file has been uploaded

if(isset($_FILES['uploaded_file'])) {
    // Make sure the file was sent without errors
    if($_FILES['uploaded_file']['error'] == 0) 
	{
   
// If no session value is present,redirect the user:
	if (!isset($_SESSION['user_id'])) 
	{
	require_once ('includes/login_functions.inc.php');
	$url = absolute_url();
	header("Location: $url");
	exit();
	}
        // Gather all required data
		$apptid = $_POST['apptid'];
        $name = @mysql_real_escape_string($_FILES['uploaded_file']['name']);
        $mime = @mysql_real_escape_string($_FILES['uploaded_file']['type']);
        $data = @mysql_real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
        $size = intval($_FILES['uploaded_file']['size']);
 
        // Create the SQL query
        $query = "
            INSERT INTO `file` (
                `name`, `mime`, `size`, `data`, `created`,`apptid`
            )
            VALUES (
                '{$name}', '{$mime}', {$size}, '{$data}', NOW(), '{$apptid}'
            )";
 
        // Execute the query
        $result = @mysql_query($query);
 
        // Check if it was successfull
        if($result) {
            echo 'Success! Your file was successfully added!';
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$dbLink->error}</pre>";
        }
    }
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($_FILES['uploaded_file']['error']);
    }
}
else {
    echo 'Error! A file was not sent!';
}
 
// Echo a link back to the main page
$meta = '<meta http-equiv="Refresh" content="3;url=addnote.php" />';
//echo "window.location = 'addnote.php?sid=".$_POST['studentid']."&aptid=".$apptid."';";
}


if($_GET['id']&&$_GET['student']==''){
	$id=$_GET['id'];
 
	/*
This page is used for downloading files, the file id is passed by the link
the users click on  using get
*/
 require_once ('mysql_connect.php');
// Make sure an ID was passed
 
//open main if
// Get the ID
    $id =$id;
 
    // Make sure the ID is in fact a valid ID
    if($id <= 0) 
	{//open id if
        die('The ID is invalid!');
    }//close id if
    else 
	{//open else
       session_start(); 
		if (!isset($_SESSION['user_id'])) 
		{//open session if
			require_once ('includes/login_functions.inc.php');
			$url = absolute_url();
			header("Location: $url");
			exit();
		}//close session if
     }//close else
 
        // Fetch the file information
        $query = "
            SELECT `mime`, `name`, `size`, `data`
            FROM `file`
            WHERE `id` = {$id}";
       	$result = @mysql_query($query);
 
// Check if it was successfull
	if (@mysql_num_rows($result) ==1) 
		{//open if result
            // Make sure the result is valid
            // Get the row
			$row = @mysql_fetch_assoc($result);
            
                // Print headers
                header("Content-Type: ". $row['mime']);
                header("Content-Length: ". $row['size']);
                header("Content-Disposition: attachment; filename=". $row['name']);
 
                // Print data
                echo $row['data'];

        }//close if result
        else 
		{//open else
            echo "Error! Query failed: <pre>{$dbc->error}</pre>";
        }//close else 
}

if($_GET['id']&&$_GET['student']){
	require_once ('mysql_connect.php');
// Make sure an ID was passed
if(isset($_GET['id'])) 
{//open main if
// Get the ID
    $id = intval($_GET['id']);
 
    // Make sure the ID is in fact a valid ID
    if($id <= 0) 
	{//open id if
        die('The ID is invalid!');
    }//close id if
    else 
	{//open else
       session_start(); 
		// If no session value is present,redirect the user:
		if (!isset($_SESSION['user_id'])) 
		{//open session if
			require_once ('includes/login_functions.inc.php');
			$url = absolute_url();
			header("Location: $url");
			exit();
		}//close session if
     }//close else
}
 else 
{//open else
    echo 'Error! No ID was passed.';
}//close else	 

 // Fetch the file information
	$query = "SELECT * FROM file WHERE id = ".$id;
   	$result = @mysql_query($query);
 
// Check if it was successfull
	if (@mysql_num_rows($result) ==1) 
		{//open if result
            // Make sure the result is valid
            // Get the row
			$d1=("update file set apptid ='0' where id =".$id);
			$results2 = @mysql_query($d1);
			if ($results2)
			 echo "<h3> file deleted </h3>";
			else
			{
				echo "<h3> Update Failure</h3>";  
				echo $qry;
				echo	@mysql_error(); 
			}
        }//close if result
        else 
		{//open else
            echo "Error! Query failed: <pre>{$dbc->error}</pre>";
        }//close else
	

	$meta = '<meta http-equiv="Refresh" content="3"';
	echo $meta;
echo '<script type="text/javascript">';
$_SESSION["updatecounter"]=2;
echo "<script>window.location = 'addnote.php?sid=".$_GET['student']."&aptid=".$_GET['aptid']."';</script>";
 
echo '</script>';	
}

function deletefile()
{

	$id1=$_GET['id1'];
	$query1 = "delete FROM `file` WHERE `id` = {$id1}";
       	$result12= @mysql_query($query1);
	$meta = '<meta http-equiv="Refresh" content="3" />';
	echo $meta; 
}

function filestable()
{
	$createapp=$_GET['createapp'];
	echo "<label for='usrname' style='color:orange;font-size:20px'>Uploaded Files</label>";
	echo "<table class='table' id='delTable'> "; 
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
	if($createapp==1)
	{
	$st1 = mysql_fetch_row(mysql_query("SELECT max(apptid) as apptid FROM appts"));
	$version1 = $st1[0] + 1;	
	$sql = "select *,Date_FORMAT(created,'%Y-%d-%m %h:%m %p') as created from file where apptid = ".$version1." order by id desc";
	}
	else
	{
		$version1=$_GET['aptid'];
		$sql = "select *,Date_FORMAT(created,'%Y-%d-%m %h:%m %p') as created from file where apptid = ".$version1." order by id desc";
	}
	//run the query
	$i=0;
	$result = @mysql_query($sql);
	// Check if it was successfull
	//echo "<script type='text/javascript'>alert(".mysql_num_rows($result).")</script>";
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
					<a href='#' onclick='Download({$row['id']})'><img src='".$iconLocation."' title='".$doctype."' width='25' height='25' /></a>  <a href='#' onclick='Download({$row['id']})'>{$row['name']}</a>
       
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
	echo "<script type='text/javascript'>
	function Download(vari1)
	{
		window.location.href='App_sampledata.php?function=addfile&id='+vari1;
		
	}
	function Delete()
	{
		var vari2='Delete';
		//window.location.href='App_sampledata.php?function=delete;
	}
	</script>";
	echo "</table>";
	echo "<script type='text/javascript' src='assets/js/deletefile.js'></script>";
}
?>