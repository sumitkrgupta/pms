<?php include ("includes/db.php");?>
<?php
	session_start();
 	if($_SESSION['userrole']==null)
 	{
       	header("Location: ../index.php"); 
  	} 
?> 
<?php 

	$msg = "";
	If(isset($_GET['id']))
	{
			$id = $_GET['id'];
			
			$query = "SELECT company_name,record_date FROM drug_company where company_id = $id;";
			$result = mysqli_query($conn,$query);
			$result_set = mysqli_fetch_row($result);

			$comName     =  $result_set[0];
			$comDate    = $result_set [1];
			
			
	}

	if(isset($_POST['updatedata']) && $_GET['id']!='')
	{
		
		$Ucom_Name= $_POST['ucn'];
		$Ucom_date=  $_POST['ucj'];
		
		

		$query = "UPDATE drug_company SET company_name = '$Ucom_Name',record_date = '$Ucom_date' WHERE company_id=$id; ";
		$result = mysqli_query($conn,$query);
		if($result)
		{
			$msg= "Update Success";
			header('Location:drug_company.php?msg=update');
		}
		else
		{
			$msg=" Not Update";
			
			header('Location:drug_company.php?msg=Not Update');
		}
 
	}
?>

<!DOCTYPE html>
<html>
	<?php include "includes/admin_header.php"; ?>
<body>
	<?php include("includes/admin_navbar.php"); ?>

		<!-- body of card-->
		<div class="col-lg-5 m-auto">
			<div class="jumbotron">
				<div class="card">
					<h2 class="text-white text-center bg-dark" >Edit Company Details</h2>
				</div>
				<div class="card">
					<div class="card-body">
						<!--Display data from database-->
						<form action=" " method="post">
			            
							<div class="form-group">
							    <label>Company Name*</label>
							    <input type="text" class="form-control" placeholder="Company Name" name="ucn" value="<?php echo $comName ;?>" required>
							</div>
							<div class="form-group">
							    <label>Record Date*</label>
							    <input type="Date" class="form-control" placeholder="" name="ucj" value="<?php echo $comDate ;?>" required>
							</div>
							
							
							<button type="Submit" class="btn btn-primary" name="updatedata">Update</button>
			            </form>
					</div>
				</div>
			</div>
		</div>
</body>
</html>