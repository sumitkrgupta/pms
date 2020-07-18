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
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		
		$query = "SELECT * FROM doctor where doctor_id = $id;";
		$result = mysqli_query($conn,$query);
		$result_set = mysqli_fetch_row($result);

		$doc_id     =  $result_set[0];
		$docName    = $result_set [1];
		$docJoin_date = $result_set[2];
		$doc_add     = $result_set[3];
		$doc_gender  = $result_set[4];
			
	}

	if(isset($_POST['updatedata']) && $_GET['id']!='')
	{
		$Udoc_id =  $_POST['uid'];
		$Udoc_Name= $_POST['udn'];
		$Udoc_date=  $_POST['udj'];
		$Udoc_add=  $_POST['uda'];
		$Udoc_gender=  $_POST['udg'];
		

		$query = "UPDATE doctor SET doctor_id ='$Udoc_id',doctor_name = '$Udoc_Name',Join_date = '$Udoc_date',address='$Udoc_add',gender='$Udoc_gender' WHERE doctor_id=$id; ";
		$result = mysqli_query($conn,$query);
		if($result)
		{
			$msg= "Update Success";
			header('Location:doctor.php?msg=update');
		}
		else
		{
			$msg=" Not Update";
			
			header('Location:doctor.php?msg=Not Update');
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
							    <label>Doctor ID*</label>
							    <input type="text" class="form-control" placeholder="Doctor Id" name="uid" value="<?php echo $doc_id;?>" required>
							</div>
							<div class="form-group">
							    <label>Doctor Name*</label>
							    <input type="text" class="form-control" placeholder="Doctor Name" name="udn" value="<?php echo $docName;?>" required>
							</div>
							<div class="form-group">
							    <label>Doctor Joining Date*</label>
							    <input type="Date" class="form-control" placeholder="" name="udj" value="<?php echo $docJoin_date;?>" required>
							</div>
							<div class="form-group">
							    <label>Address</label>
							    <input type="text" class="form-control" placeholder="Address" name="uda" value="<?php echo $doc_add;?>" required>
							</div>
							<div class="form-group">
							    <label>Gender*</label>
							    <input type="text" class="form-control" placeholder="Gender" name="udg" value="<?php echo $doc_gender;?>" required>
							</div>
							
							<button type="Submit" class="btn btn-primary" name="updatedata">Update</button>
			            </form>
					</div>
				</div>
			</div>
		</div>
</body>
</html>