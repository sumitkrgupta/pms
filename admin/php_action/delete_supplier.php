<?php 
	include ("../includes/db.php");
	//echo $_GET['id'];
	$msg = "";
	if(isset($_GET['id']))
	{
		
		$id=$_GET['id'];
		//echo $id;
		
		$query = " DELETE from supplier WHERE supplier_id= '$id'; ";
		$result = mysqli_query($conn,$query);

		if($result)
		{
			$msg = "Delete Successful";
			header('Location: ../supplier.php?msg=delete Successful');
		}
		else
		{	
			$msg = "Not Delete ";
			header('Location: ../supplier.php?msg=not delete');
			
		}
		
 
	}
?> 

