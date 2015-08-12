<?php
include('mysql_connect.php');
$st = mysql_query("update appts set note='$_POST[Note]',description='$_POST[epurpose]'   where apptid='$_POST[appid]'") ;
$close=$_POST['close'];
$appt=$_POST['appid'];
echo "Successfully Updated appointment notes";
?>
<script>
function()
{
    var x=<?php =$close ?>;
    var y=<?php =$appt ?>;
if(x)
{
    if (confirm("Do you want to continue to close the status of the appointment") == true) {
    window.location.href='closeit.php?apptid='+y+"&sid="+x;  
    } 
}	
}
</script>
