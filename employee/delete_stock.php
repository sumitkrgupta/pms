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
	
	if(isset($_GET['id']))
	{
		
		$id=$_GET['id'];
		
		
		$query = " DELETE from drugs_stocks WHERE drug_name_id= '$id'; ";
		$result = mysqli_query($conn,$query);

		if($result)
		{
			header('Location:view_stock.php?msg=delete');
		}
		else
		{	header('Location:view_stock.php?msg=notdelete');
			echo'<script>alert("Data not delete");</script>';
		}
		
 
	}
?> 

