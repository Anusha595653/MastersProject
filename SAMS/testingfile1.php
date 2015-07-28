<?php
//If directory doesnot exists create it.
require_once ('mysql_connect.php');
$output_dir = "Sample/";

define ('DB_USER', 'abestha');      // replace xxxx with your mysql username    
define ('DB_PASSWORD', 'abestha');  // replace yyyy with your mysql password
define ('DB_HOST', 'localhost');
define ('DB_NAME', 'db_Fall13_abestha'); // replace zzzzzz with your database name

// Connect to DB and select main DB
$dbc = @mysql_connect( DB_HOST, DB_USER, DB_PASSWORD) or
die('Could not connect to  MySQL: '. mysql_error());

@mysql_select_db(DB_NAME) or
die('Could not select the database: '. mysql_error());

 

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

?>