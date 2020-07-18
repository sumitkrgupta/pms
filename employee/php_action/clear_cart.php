<?php
	session_start();
	unset($_SESSION['cart']);
	$_SESSION['message'] = 'Cleared successfully';
	header('location: ../medicine_search.php');
?>