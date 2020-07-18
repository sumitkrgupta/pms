<?php 
	include ("../includes/db.php");
	
	$msg = "";
	if(isset($_GET['id']))
	{
		
		$id=$_GET['id'];
		
		$query = " DELETE from doctor WHERE doctor_id= '$id'; ";
		$result = mysqli_query($conn,$query);

		if($result)
		{
			$msg = "Delete Successful";
			header('Location:../doctor.php?msg=delete Successful');
		}
		else
		{	
			$msg = "Not Delete ";
			header('Location:../doctor.php?msg=not delete');
			
		}
		
 
	}
?> 

