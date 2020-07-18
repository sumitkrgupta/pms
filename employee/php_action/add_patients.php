<?php
	include ("../includes/db.php");
	session_start();

	
	
	if($_POST && !empty($_POST))
	{
		$reg_Id = $_POST['RegiID'];
		$Name  	= $_POST['Name'];
		$Mobile = $_POST['mobile'];
		$gender = $_POST['gender'];
		$cat 	= $_POST['Categories'];
		$hostel = $_POST['Hostel'];
		$date 	= $_POST['date'];
		$empID	= $_SESSION['reg_Id'];

		$query = "SELECT p_reg_id from patients where p_reg_id = '$reg_Id'";
		
		if(mysqli_query($conn,$query))
		{
			$_SESSION['message'] = 'Registration Number already Exists!';

			header('location: ../add_patients.php');
		}
		else
		{

			$query = "INSERT INTO patients(p_reg_id,p_name,category,hostel_name,mobile,record_date,reg_id,gender) values('$reg_Id','$Name','$cat','$hostel','$Mobile','$date','$empID','$gender')";

			$result = mysqli_query($conn,$query); 

			if($result)
			{
				
				$_SESSION['message'] = 'Record Updated Successfully';
				header('location: ../add_patients.php');
			}
			else
			{

				$_SESSION['message'] = 'Problem Found';
				header('location: ../add_patients.php');
				
				//echo("Error description: " . mysqli_error($conn));
			}
		}	
	}
	else
	{
		$_SESSION['message'] = 'Data not Found';
		header('location: ../add_patients.php');	
	}
?>