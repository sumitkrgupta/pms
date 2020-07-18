<?php
	session_start();

	//remove the id from our cart array
	$id = mysqli_real_escape_string($conn,preg_replace('/[\x00-\x1F\x7F-\xFF ?>]/', '', $_GET['id']));
	$key = array_search($id, $_SESSION['cart']);	
	unset($_SESSION['cart'][$key]);

	unset($_SESSION['qty_array'][$_GET['index']]);
	//rearrange array after unset
	$_SESSION['qty_array'] = array_values($_SESSION['qty_array']);

	$_SESSION['message'] = "Product deleted from cart";
	header('location: ../view_cart.php');
?>