<?php 

	include ("../includes/db.php");
	
	
	if(isset($_GET['id']))
	{
		
		$id=$_GET['id'];
		//echo $id;
		
		$query = " DELETE from employee WHERE reg_id= '$id'; ";
		$result = mysqli_query($conn,$query);

		if($result)
		{
			header('Location:../add_staff.php?msg=delete');
		}
		else
		{	header('Location:../add_staff.php?msg=notdelete');
			
		}
		
 
	}
?> 

