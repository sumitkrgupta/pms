<?php 
	include ("../includes/db.php");
	
	
	$msg = "";
	if(isset($_GET['id']) && !empty($_GET['id']))
	{
		
		$id=$_GET['id'];
		
		
		$query = " DELETE from patients WHERE p_reg_id = '$id'; ";
		$result = mysqli_query($conn,$query);

		if($result)
		{
			$msg = "Delete Successful";
			header('Location:../add_patients.php?msg=delete Successful');
		}
		else
		{	
			$msg = "Not Delete ";
			header('Location:../add_patients.php?msg=Not delete');

		}
		
 
	}
?> 

