<?php

	include ("../includes/db.php");
	date_default_timezone_set('Asia/Kolkata');
	session_start();
	if(isset($_SESSION['status']))
	{
		unset($_SESSION['status']);
	}
	else
	{
		$_SESSION['status'] = 0;
	}


	if($_POST && !empty($_POST))
	{	
		$orderDate 			= date('Y-m-d H:i:s', strtotime($_POST['orderDate']));	
		$supllierName 		= $_POST['supplier'];
	  	$supplierContact 	= $_POST['ContactPerson'];
	  	$orderPersonId  	= $_SESSION['reg_Id']; 
	  	$status             = $_SESSION['status'];

	  	//Genrating Invoice Number
	  	$number = date('dhis');
	  	$invoiceNumber = "HCU-".str_pad($number, 7, "0", STR_PAD_LEFT);
	  	
	  	$query = "INSERT INTO orders(orders_date, supplier_id, reg_id,supplier_contact_person,orders_invoice_no,orders_status) VALUES ('$orderDate',(Select supplier_id from supplier where supplier_name = '$supllierName'),'$orderPersonId','$supplierContact','$invoiceNumber','$status')";
		
		if(mysqli_query($conn,$query))
		{
			$order_id = mysqli_insert_id($conn); //this is used function to get imediate inserted data id
			$_SESSION['order_id'] = $order_id;	
			
			for($i = 0; $i < count($_POST['drug']); $i++) 
			{			

				$drugName 		= $_POST['drug'][$i];
				$companyID  	= $_POST['dcn'][$i];
				$orderquantity	= $_POST['odrquantity'][$i];
				$drugpower 		= $_POST['mgpower'][$i];
				$drugtype 		= $_POST['mt'][$i];
				
				$queryItem = "INSERT into orders_item(orders_id,drug_type,drug_power,orders_quantity,company_id,drug_name)
					 values('$order_id','$drugtype','$drugpower','$orderquantity',(SELECT company_id from drug_company where company_name= '$companyID'),'$drugName')";	 

				$result = mysqli_query($conn,$queryItem);	 
			}
			
			$_SESSION['message'] = 'Orders Successfully !';
			header('Location: ../orders.php?msg=Update');
		}
		else
		{
			$_SESSION['message'] = 'Problem Found !';
			header('Location: ../orders.php?msg=Not Update');
			//echo("Error description: " . mysqli_error($conn));
		}
	} 
	else
	{
		$_SESSION['message'] = 'Data not Found !';
		header('Location: ../orders.php?msg=Data Not found');
	}
?>


