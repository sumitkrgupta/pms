<?php
	session_start();
 	if($_SESSION['userrole']==null)
 	{
       	header("Location: ../index.php"); 
  	} 
?> 
<?php 
	include ("includes/db.php");
	//echo $_GET['id'];
	$msg = "";
	if(isset($_GET['id']))
	{
		
		$id=$_GET['id'];
		//echo $id;
		
		$query = " DELETE from drugs WHERE drug_name_id= '$id'; ";
		$result = mysqli_query($conn,$query);

		if($result)
		{
			$msg = "Delete Successful";
			header('Location:add_drugs.php?msg=delete Successful');
		}
		else
		{	
			$msg = "Not Delete ";
			header('Location:add_drugs.php?msg=notdelete');
			
		}
		
 
	}
?> 

