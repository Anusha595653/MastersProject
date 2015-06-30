<?php
error_reporting(0);

function addfile()
{
	require_once ('mysql_connect.php');
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

?> 