
<?php 
	include ("../includes/db.php");
	//echo $_GET['id'];
	$msg = "";
	if(isset($_GET['id']))
	{
		
		$id=$_GET['id'];
		
		
		$query = " DELETE from drug_company WHERE company_id= '$id'; ";
		$result = mysqli_query($conn,$query);

		if($result)
		{
			$msg = "Delete Successful";
			header('Location:../drug_company.php?msg=delete Successful');
		}
		else
		{	
			$msg = "Not Delete ";
			header('Location:../drug_company.php?msg=not delete');
			
		}
		
 
	}
?> 

