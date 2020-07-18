
<?php
	include ("../includes/db.php");
	date_default_timezone_set('Asia/Kolkata');
	session_start();
	
 	if($_SESSION['userrole']==null)
 	{
       	header("Location: ../../index.php"); 
  	} 
?>
<?php 
	
	if($_POST && !empty($_POST))
	{
		// echo "<pre>";
		// print_r($_POST);
		// echo "<pre>"; 
		$number = date('dhis');
		$P_RegId = mysqli_real_escape_string($conn,$_POST['regId']);
		$Doctor= mysqli_real_escape_string($conn,$_POST['doctor']);
		$date  = mysqli_real_escape_string($conn,$_POST['billingDate']);
		$empId = $_SESSION['reg_Id'];
		$invoiceNumber = "HCUP-".str_pad($number, 7, "0", STR_PAD_LEFT);
		
		$query = "SELECT p_reg_id from patients where p_reg_id = '$P_RegId' ";
		$count=mysqli_num_rows(mysqli_query($conn,$query));
		if($count==1)
		{
			//echo 6;
			$query = "INSERT into prescribe(p_reg_id,doctor_id,prescribe_date,patient_invoice_no,reg_id) values('$P_RegId',(SELECT doctor_id from doctor where doctor_name = '$Doctor'),'$date','$invoiceNumber','$empId')";
			
			if(mysqli_query($conn,$query))
			{

				$prescrib_id = mysqli_insert_id($conn);

				for($i = 0; $i < count($_POST['DrugId']); $i++) 
				{
					$drugid = mysqli_real_escape_string($conn,$_POST['DrugId'][$i]);
					$RequiredDrugQuantity = mysqli_real_escape_string($conn,$_POST['qty_'][$i]);

					$MedicineQuery="SELECT drug_name from drugs where drug_name_id = '$drugid'";
					$MedicineName = mysqli_query($conn,$MedicineQuery);
					$row = mysqli_fetch_array($MedicineName);
					$MedName = $row['drug_name'];

					$PresentQuantity = "SELECT quantity from drugs where drug_name_id = '$drugid'";

					$PresentQuantityResult = mysqli_query($conn,$PresentQuantity);
					
					while($row = mysqli_fetch_array($PresentQuantityResult))
					{
						$qty=$row['quantity'];
						if($qty>=$RequiredDrugQuantity)
						{
						
							$updatedQuantityIs = $qty - $RequiredDrugQuantity;
						
							$query = "UPDATE drugs set quantity = '$updatedQuantityIs' where drug_name_id = '$drugid' ";
							$result=mysqli_num_rows(mysqli_query($conn,$query));

							if($result==1)
							{
								$query = "INSERT into prescribe_item(drug_name_id,quantity,	prescribe_id) values('$drugid','$RequiredDrugQuantity','$prescrib_id')";
								mysqli_query($conn,$query);
							}
						}
						else
						{
							$_SESSION['message'] = 'Required Quantity is Greater than Present Quantity of Medicine '.$MedName;
							header('location: ../medicine_search.php');
							// echo("Error" .mysqli_error($conn));
							// echo 'Required Quantity is Greater than Present Quantity of Medicine'.$MedName;
						}	
					}
					
				}
				
				$_SESSION['message'] = 'Billing Is Done';
				unset($_SESSION['cart']);
				header('location: ../medicine_search.php');
				// echo("Error" .mysqli_error($conn));
				
			}
			
		}
		else
		{	
			$_SESSION['message'] = 'Patients Data not found';
			unset($_SESSION['cart']);
			header('location: ../medicine_search.php');
			// echo("Error" .mysqli_error($conn));
			
		}
		
	}
	else
	{
		$_SESSION['message'] = 'Data Not Found';
		unset($_SESSION['cart']);
		header('location: ../medicine_search.php');
		// echo("Error description: " . mysqli_error($conn));
		
	}
	
?>