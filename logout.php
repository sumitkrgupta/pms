
<?php
	
	session_start();
	$_SESSION['userrole']=null; // it null  session variable
	//session_unset();
	session_destroy();

	header("location:index.php");
?>