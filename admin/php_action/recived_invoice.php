<?php
	include ("../includes/db.php");
	session_start();

	
	if($_POST && !empty($_POST))
	{
		$reciveInvoice_No     = $_POST['reciveInvoiceNo'];
		$orderInvoice_No	  = $_POST['orderInvoiceNo'];	
		$Supplier_id      	  = $_POST['supplier'];
		$Recive_date 	 	  = $_POST['invoiceReciveDate'];
		$reciveInvoice_amount = $_POST['invoiceTotalAmount'];
		$Payment_type 		  = $_POST['paymentType'];
		$Payment_amount 	  = $_POST['paymentAmount'];
		$Due_amount 		  = $_POST['dueAmount'];
		$regi_id              = $_SESSION['reg_Id']; 


		$query = "SELECT orders_invoice_no from orders where orders_invoice_no = '$orderInvoice_No'";
		$result = mysqli_query($conn,$query);
		$count = mysqli_num_rows($result);

		if($count==1)
		{


			$query = "INSERT into recive_order_details(recive_invoice_no,supplier_id,order_id,recive_date,item_total_amount,payment_amount,payment_type,due_amount,reg_id) values('$reciveInvoice_No',(SELECT supplier_id from supplier where supplier_name ='$Supplier_id'),(SELECT orders_id from orders where orders_invoice_no ='$orderInvoice_No'),'$Recive_date','$reciveInvoice_amount','$Payment_amount','$Payment_type','$Due_amount','$regi_id');";

			$result = mysqli_query($conn,$query);

			if($result)
			{
				$receive_id = mysqli_insert_id($conn);
				$_SESSION['recived_id'] = $receive_id;
				$query = "UPDATE orders set orders_status =1 where orders_invoice_no ='$orderInvoice_No'";
				mysqli_query($conn,$query);
				
				$_SESSION['message'] = 'Added Successfully !';
				header('Location:../recived_invoice.php?msg=update');
			}
			else
			{
				$_SESSION['message'] = 'Problem Found !';
				header('Location:../recived_invoice.php?msg=not update');
			}
		}
		else
		{
			$_SESSION['message'] = 'Order Invoice Number not exist Please check !';
			header('Location:../recived_invoice.php?msg=not exist');
		}	
	}
	else
	{
		$_SESSION['message'] = 'Data not Found !';
		header('Location:../recived_invoice.php?msg=not update');
	}
?>