 
<?php 
error_reporting(0);
 
if (isset($_POST['submitted']))
{
	require_once ('includes/login_functions.inc.php');
	require_once ('mysql_connect.php');
	list ($check, $data) = check_login($_POST['uid'], $_POST['pass']);
		if ($check)
		{// OK!
			session_start();
			// Set the session data:.
			//init_set('session.gc_maxlifetime','3600');
			$_SESSION['id'] = $data['user_id'];
			$_SESSION['user_id'] = $data['user_id'];
			if ($data['user_type']== 1);
				$_SESSION['admin'] = 'true';
			// Redirect:
			$url = absolute_url ('main.php');
			header("Location: $url");
			exit();
		} else 
		{ // Unsuccessful!
 
			$errors = $data;
		 
		}
} 
else
// End of the main submit conditional.
//include login page
include ('includes/login_page.inc.php');


?>




