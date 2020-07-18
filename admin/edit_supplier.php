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
			
			$query = "SELECT contact_person_name,supplier_name,mobile_no,email,address,record_date FROM supplier where supplier_id = $id;";
			$result = mysqli_query($conn,$query);
			$result_set = mysqli_fetch_row($result);

			$conPerName =  $result_set[0];
			$SupName   = $result_set[1];
			$supMobile = $result_set[2];
			$supEmail = $result_set[3];
			$supAdd=  $result_set[4];
			$supdate =  $result_set[5];
			
	}

	if(isset($_POST['updatedata']) && $_GET['id']!='')
	{
		$Usup_Name = $_POST['usn'];
		$Usup_Contac = $_POST['upn'];
		$Usup_mob = $_POST['umn'];
		$Usup_email = $_POST['use'];
		$Usup_add = $_POST['usa'];
		$Usup_date = $_POST['udj'];
		

		$query = "UPDATE supplier SET contact_person_name ='$Usup_Contac',supplier_name = '$Usup_Name',mobile_no = '$Usup_mob',email='$Usup_email',address='$Usup_add',record_date='$Usup_date' WHERE supplier_id=$id;";
		$result = mysqli_query($conn,$query);
		if($result)
		{
			$msg= "Update Success";
			header('Location:supplier.php?msg=update');
		}
		else
		{
			$msg=" Not Update";
			
			header('Location:supplier.php?msg=Not Update');
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
					<h2 class="text-white text-center bg-dark" >Edit Doctors Details</h2>
				</div>
				<div class="card">
					<div class="card-body">
						<!--Display data from database-->
						<form action=" " method="post">
			            
							<div class="form-group">
							    <label>Supplier Name</label>
							    <input type="text" class="form-control" placeholder="Supplier Name" name="usn" value="<?php echo $SupName;?>" required>
							</div>
							<div class="form-group">
							    <label>Contact Person Name</label>
							    <input type="text" class="form-control" placeholder="Person Name" name="upn" value="<?php echo $conPerName;?>" required>
							</div>
							<div class="form-group">
							    <label>Mobile No.</label>
							    <input type="text" class="form-control" placeholder="Mobile No." name="umn" value="<?php echo $supMobile;?>" required>
							</div>
							<div class="form-group">
							    <label>Email</label>
							    <input type="text" class="form-control" placeholder="Email" name="use" value="<?php echo $supEmail;?>" required>
							</div>
							<div class="form-group">
							    <label>Address</label>
							    <input type="text" class="form-control" placeholder="Address" name="usa" value="<?php echo $supAdd;?>" required>
							</div>
							<div class="form-group">
							    <label>Date</label>
							    <input type="Date" class="form-control" placeholder="Join Date" name="udj" value="<?php echo $supdate;?>" required>
							</div>
							
							<button type="Submit" class="btn btn-primary" name="updatedata">Update</button>
			            </form>
					</div>
				</div>
			</div>
		</div>
</body>
</html>