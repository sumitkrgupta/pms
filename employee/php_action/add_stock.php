<?php
	include ("../includes/db.php");
	session_start();
 	if($_SESSION['userrole']==null)
 	{
       	header("Location: ../../index.php"); 
  	} 
?>

<?php 
	
	
	if($_POST && !empty($_POST))
	{
		$drug_Name 		= $_POST['drug'];
		$batchN 		= $_POST['batchNo'];
		$drug_cat 		= $_POST['mcat'];
		$drug_type 		= $_POST['medicineType'];
		$mfdDate 		= $_POST['mfddate'];
		$expDate 		= $_POST['expdate'];
		$drugPower 		= $_POST['medicinePower'];
		$drugCompany	= $_POST['company'];
		$drugLocation 	= $_POST['location'];
		$drugDes 		= $_POST['mds'];
		$drugQuantity 	= $_POST['quantity'];

		
		
		$query = "INSERT into drugs(drug_name,drug_categories,drug_description,company_id,batch_no,drug_type,mfd_date,exp_date,power_ml,drug_location,quantity)values('$drug_Name ','$drug_cat ','$drugDes',(SELECT company_id from drug_company where company_name = '$drugCompany'),'$batchN','$drug_type','$mfdDate','$expDate','$drugPower','$drugLocation','$drugQuantity');";

		$result = mysqli_query($conn,$query);

		if($result)
		{
			$drug_ID = mysqli_insert_id($conn);


			$drugQuantity 	= $_POST['quantity'];
			$unitPrice 		= $_POST['unitPrice'];
			$total_price 	= $_POST['total'];
			$recivedID 		= $_SESSION['recived_id'];

			$query = "INSERT into supply(supply_quantity,drug_name_id,recive_id,unit_price,unit_total_price) values('$drugQuantity','$drug_ID','$recivedID','$unitPrice','$total_price');";

			$result = mysqli_query($conn,$query);

			if($result)
			{
				$_SESSION['message'] = 'Medicine Saved Successfully!';
				header('location: ../add_stock.php');
			}
			else
			{
				$_SESSION['message'] = 'Problem Found!';
				header('location: ../add_stock.php');
				
				//echo("Error description: " . mysqli_error($conn));
			}
		}
		else
		{
			$_SESSION['message'] = 'Data Not Found!';
			header('location: ../add_stock.php');
		}
	}
?>