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
			
			$query = "SELECT reg_id,fullname,phone,gender,address FROM employee where reg_id = $id;";
			$result = mysqli_query($conn,$query);
			$result_set = mysqli_fetch_row($result);

			$emp_id    =  $result_set[0];
			$empName   = $result_set[1];
			$emp_mobile=  $result_set[2];
			$emp_gender=  $result_set[3];
			$emp_add=  $result_set[4];
			
	}

	if(isset($_POST['updatedata']) && $_GET['id']!='')
	{
		$Uemp_id =  $_POST['uid'];
		$Uemp_Name= $_POST['uen'];
		$Uemp_mobile=  $_POST['uem'];
		$Uemp_gen=  $_POST['ueg'];
		$Uemp_add=  $_POST['uea'];
		

		$query = "UPDATE employee SET reg_id ='$Uemp_id',fullname = '$Uemp_Name',phone = '$Uemp_mobile',gender='$Uemp_gen',address='$Uemp_add' WHERE reg_id=$id; ";
		$result = mysqli_query($conn,$query);
		if($result)
		{
			$msg= "Update Success";
			header('Location:add_staff.php?msg=update');
		}
		else
		{
			$msg=" Not Update";
			
			header('Location:add_staff.php?msg=Not Update');
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
					<h2 class="text-white text-center bg-dark" >Edit Employee </h2>
				</div>
				<div class="card">
					<div class="card-body">
						<!--Display data from database-->
						<form action=" " method="post">
			            
							<div class="form-group">
							    <label>Employee ID*</label>
							    <input type="text" class="form-control" placeholder="Employee ID" name="uid" value="<?php echo $emp_id ;?>" required>
							</div>
							<div class="form-group">
							    <label>Employee Name*</label>
							    <input type="text" class="form-control" placeholder="Employee Name" name="uen" value="<?php echo $empName;?>" required>
							</div>
							
							<div class="form-group">
							    <label>Mobile*</label>
							    <input type="text" class="form-control" placeholder="Mobile" name="uem" value="<?php echo $emp_mobile;?>" required>
							</div>
							
							<div class="form-group">
							    <label>Gender</label>
							    <input type="text" class="form-control"placeholder="Gender"name="ueg" value="<?php echo $emp_gender;?>">
							</div>
							<div class="form-group">
							    <label>Address</label>
							    <input type="text" class="form-control" placeholder="Join Date" name="uea" value="<?php echo $emp_add;?>">
							</div>
							
							<button type="Submit" class="btn btn-primary" name="updatedata">Update</button>
			            </form>
					</div>
				</div>
			</div>
		</div>
</body>
</html>