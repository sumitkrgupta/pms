<?php
	
	include ("../includes/db.php");
	session_start();

	$id = mysqli_real_escape_string($conn,preg_replace('/[\x00-\x1F\x7F-\xFF ?>]/', '', $_GET['id']));
	
	
	//check if product is already in the cart
	if(!in_array($id, $_SESSION['cart']))
	{
		array_push($_SESSION['cart'], $id);
		$_SESSION['message'] = 'Medicine added to cart';
	}
	else
	{
		$_SESSION['message'] = 'Medicine already in cart';
	}

	header('location: ../medicine_search.php');
?>