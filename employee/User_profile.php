
<?php include ("includes/db.php");?>
<?php
	session_start();
 	if($_SESSION['userrole']==null)
 	{
       	header("Location: ../index.php"); 
  	} 

  	if($_SESSION['userrole'] == "Student")
  	{
  		$userId = $_SESSION['reg_Id']; 
	  	$query = "SELECT reg_id,fullname,phone,role,join_date from employee where reg_id = '$userId'";
	  	$result = mysqli_query($conn, $query);

	  	while($row = mysqli_fetch_array($result))
	  	{
	  		$id=$row['reg_id'];
	  		$name=$row['fullname'];
	  		$mobile=$row['phone'];
	  		$Role=$row['role'];
	  		$DOJ=$row['join_date'];
	  		
	  	}
  	}
  	
?> 
<!DOCTYPE html>
<html lang="en">
<?php include ("includes/admin_header.php"); ?>


<body>
<?php include("includes/admin_navbar.php"); ?>
		<br><br>
		<div class="card">
		    <div class="card-body">
		        <div class="card-title mb-4">
		            <div class="d-flex justify-content-start">
		                <div class="image-container">
		                    <img src="../images/users/<?php echo $image; ?>" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail">
		                    <div class="middle"><br>
		                        <a href="profile.php?source=edit_profile&u_id=<?php echo $userID; ?>"><input type="button" class="btn btn-info" id="btnChangePicture" value="Edit Profile"></a>
		                        <a href="profile.php?source=change_password&u_id=<?php echo $userID; ?>"><input type="button" class="btn btn-danger" id="btnChangePicture" value="Change Password"></a>
		                    </div>
		                </div><br>
		            </div>
		        </div>

		        <div class="row">
		            <div class="col-11 offset-sm-1">
		                <div class="tab-content mt-2 ml-1">
		                    <div class="tab-pane show active" role="tabpanel" aria-labelledby="basicInfo-tab">
		                        <div class="row">
		                            <div class="col-sm-3 col-md-2 col-5">
		                                <label class="text-primary">Regitration Number</label>
		                            </div>
		                            <div class="col-md-8 col-6">
		                                <?php echo $id; ?>
		                            </div>
		                        </div>
		                        <hr />

		                        <div class="row">
		                            <div class="col-sm-3 col-md-2 col-5">
		                                <label class="text-primary">Name</label>
		                            </div>
		                            <div class="col-md-8 col-6">
		                                <?php echo $name; ?>
		                            </div>
		                        </div>
		                        <hr />
		                        <div class="row">
		                            <div class="col-sm-3 col-md-2 col-5">
		                                <label class="text-primary">Role</label>
		                            </div>
		                            <div class="col-md-8 col-6">
		                                <?php echo $Role; ?>
		                            </div>
		                        </div>
		                        <hr />
		                        <div class="row">
		                            <div class="col-sm-3 col-md-2 col-5">
		                                <label class="text-primary">Mobile Number</label>
		                            </div>
		                            <div class="col-md-8 col-6">
		                                <?php echo $mobile; ?>
		                            </div>
		                        </div>
		                        <hr />
		                        <div class="row">
		                            <div class="col-sm-3 col-md-2 col-5">
		                                <label class="text-primary">Date of Joining</label>
		                            </div>
		                            <div class="col-md-8 col-6">
		                                <?php echo $DOJ; ?>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>


		    </div>

</div>
</body>
</html>